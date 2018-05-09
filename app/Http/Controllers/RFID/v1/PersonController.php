<?php
namespace App\Http\Controllers\RFID\v1;


use App\Http\Controllers\AuditLogController;
use App\Models\RFID\v1\Key;
use App\Models\RFID\v1\Key_type;
use App\Models\RFID\v1\Person;
use App\Models\RFID\v1\Person_type;
use App\Models\RFID\v1\PersonSecondFactor;
use App\Models\RFID\v1\Profile;
use App\Models\RFID\v1\Role;
use App\Models\RFID\v1\SecondFactor;
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

        $people = Person::all();

        $data = ['people' => $people];
        return view('people.people', $data);

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

        $result = $person->save();

        $person_id = $person->person_id;

        AuditLogController::create("Person create", $result, $person_id,'');

        if ($request->input('key') != ""){
            if($request->input('key_string') != ""){


                $person = Person::where('person_id',$person_id)->first();
                $key = new Key();
                $key->key_type_id = $request->input('key');
                $key->key_state_id = 1;
                $key->person_id = $person_id;
                $key->key_string = $request->input('key_string');
                $person->keys()->save($key);
                AuditLogController::create("Key create", '1', $person_id,'Vytvorenie kluca pre prave vytvoreneho pouzivatela');

                if ($request->input('key') == config('variables.key_types.tag')){
                    $second_factor = new SecondFactor();
                    $second_factor->second_factor_type_id = config('variables.second_factor_type.code');
                    $second_factor->second_factor_string = '';
                    $second_factor->save();

                    $second_factor_id = $second_factor->second_factor_id;

                    $person_second_factor = new PersonSecondFactor();
                    $person_second_factor->person_id = $person_id;
                    $person_second_factor->second_factor_id = $second_factor_id;
                    $person_second_factor->save();

                }
            }
        }

        if ($request->input('profiles') != null ){
            $person = Person::find($person_id);
            $person->profiles()->attach($request->input('profiles'));
        }


        $notification = array(
            'message' => 'Osoba bola vytvorená!',
            'alert-type' => 'success'
        );
        return redirect('people')->with($notification);

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
        $profiles = Profile::all();
        $data = ['person' => $person,
                'second_factor_types' => $second_factor_types,
                'roles' => $roles,
                'types' => $types,
                'profiles' => $profiles];
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




        if ($request->input('profiles') != null) {
            $person->profiles()->sync($request->input('profiles'));
        } else {
            $person->profiles()->detach();
        }

        $notification = array(
            'message' => 'Zmeny boli uložené!',
            'alert-type' => 'success'
        );
        return redirect('people')->with($notification);

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



        Person::destroy($person_id);
        $notification = array(
            'message' => 'Osoba bol odstránená!',
            'alert-type' => 'success'
        );
        return redirect('people')->with($notification);
    }

}


