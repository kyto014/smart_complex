<?php
namespace App\Http\Controllers\RFID\v1;


use App\Http\Controllers\AuditLogController;
use App\Models\RFID\v1\Key;
use App\Models\RFID\v1\Key_type;
use App\Models\RFID\v1\Person;
use App\Models\RFID\v1\Person_type;
use App\Models\RFID\v1\Profile;
use App\Models\RFID\v1\Role;
use App\Models\RFID\v1\SecondFactorType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        //$people = Person::with('keys')->get();
        $people = Person::all();
        //return response()->json($people,200);
//        var_dump($people);
        $data = ['people' => $people];
        return view('people.people', $data);
//        return $people;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //$person_type = Person_type::find();
        $person = new Person();
        $person->person_type_id = $request->input('person_type_id');
        $person->role_id = $request->input('role_id');
        $person->forname = $request->input('forname');
        $person->surname = $request->input('surname');
        $person->email = $request->input('email');
//        $person->password = $request->input('password');
        $result = $person->save();

        $person_id = $person->person_id;

        AuditLogController::create("Person create", $result, $person_id,'');

        if ($request->input('key') != ""){
            if($request->input('key_string') != ""){
                //vytvor kluce ku osobe
                //urobit save pre vsetky kluce

                $person = Person::where('person_id',$person_id)->first();
                $key = new Key();
                $key->key_type_id = $request->input('key');
                $key->key_state_id = 1;
                $key->person_id = $person_id;
                $key->key_string = $request->input('key_string');
                $person->keys()->save($key);
                AuditLogController::create("Key create", '1', $person_id,'Vytvorenie kluca pre prave vytvoreneho pouzivatela');

            }
        }

        if ($request->input('profiles') != null ){
            foreach ($request->input('profiles') as $profile_id){
                if($profile_id != "") {
                    $profile = Profile::find($profile_id);
                    $person->profiles()->attach($profile);
                }
            }
        }

//        return response()->json($person,201);
   return redirect('people');
       // return redirect()->route('/people');
//        return redirect()->action('PersonController@getAll');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function get($person_id)
    {
        //$person = Person::find($id);
        $person = Person::with('profiles', 'secondFactors.secondFactorType','keys.keyState','keys.keyType', 'person_type', 'role')->where('person_id',$person_id)->first();
        $second_factor_types = SecondFactorType::all();
        $roles = Role::all();
        $types = Person_type::all();
        $data = ['person' => $person,
                'second_factor_types' => $second_factor_types,
                'roles' => $roles,
                'types' => $types];
        return view('people.person', $data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $person_id)
    {
        $person = Person::find($person_id);
        if ($person){
            $person->person_type_id = $request->input('person_type_id');
            $person->role_id = $request->input('role_id');
            $person->forname = $request->input('forname');
            $person->surname = $request->input('surname');
            $person->email = $request->input('email');
            $person->save();
        }

        if ($request->input('keys') != null){
            //prejst vsetky kluce
            $keysDB = Key::where('person_id',$person_id)->whereIn('key_id',$request->input('keys'))->get()->toArray();
            $person->keys()->delete();
            $person->keys()->createMany($keysDB);

        } else {
            $person->keys()->delete();
        }

//        if ($request->input('facts') != null) {
//            $factors = $person->secondFactors()->whereIn('second_factor.second_factor_id', $request->input('facts'))->get();
//            $person->secondFactors()->sync($factors);
//        } else {
//            $person->secondFactors()->detach();
//        }

        if ($request->input('profiles') != null) {
            $profiles = $person->profiles()->whereIn('profile.profile_id', $request->input('profiles'))->get();
            $person->profiles()->sync($profiles);
        } else {
            $person->profiles()->detach();
        }

//        return response()->json($person,201);
        return redirect('people');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */

    public function createPerson(){
        $roles = Role::all();
        $types = Person_type::all();
        $profiles = Profile::all();
        $keys = Key_type::all();
        $data = [
            'roles' => $roles,
            'types' => $types,
            'profiles' => $profiles,
            'keys' => $keys
        ];
        return view('people.addPerson', $data);
    }
    public function delete($person_id)
    {
        $person = Person::find($person_id);
        if ($person->profiles != null){
            $person->profiles()->detach();
        }

        if ($person->secondFactors != null){
            $person->secondFactors()->detach();
        }

        /*
        $keys = Key::where('person_id',$person_id)->get();
        $ids_to_delete = array_map(function($item){ return $item['key_id']; }, $keys);
        DB::table('keys')->whereIn('key_id', $ids_to_delete)->delete();
        */

        Person::destroy($person_id);
    }

}


