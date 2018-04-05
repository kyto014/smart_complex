<?php
namespace App\Http\Controllers\RFID\v1;


use App\Http\Resources\PersonResource;

use App\Models\RFID\v1\Key;
use App\Models\RFID\v1\Person;
use App\Models\RFID\v1\Person_type;
use App\Models\RFID\v1\Profile;
use App\Models\RFID\v1\Role;
use Barryvdh\Debugbar\LaravelDebugbar;
use Carbon\Carbon;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
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
        $person->password = $request->input('password');
        $person->save();

        $person_id = $person->id;

        if ($request->input('keys') != null){
            //vytvor kluce ku osobe
            //urobit save pre vsetky kluce
            $person = Person::where('person_id',$person_id)->first();
            $key = new Key();
            $key->key_type_id = $request->input('key_type_id');
            $key->key_state_id = $request->input('key_state_id');
            $key->person_id = $person_id;
            $key->key_string = Hash::make($request->input('key_string'));
            $person->keys()->save($key);

        }

        if ($request->input('profiles') != null ){
            foreach ($request->input('profiles') as $profile_id){
                $profile = Profile::find($profile_id);
                $person->profiles()->attach($profile);
            }
        }

        return response()->json($person,201);
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
        $person = Person::with('profiles', 'secondFactors','keys')->where('person_id',$person_id)->first();
        $data = ['person' => $person];
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
            $key = Key::where('person_id',$person_id);
            $key->key_type_id = $request->input('key_type_id');
            $key->key_state_id = $request->input('key_state_id');
            $key->person_id = $person_id;
            $key->key_string = Hash::make($request->input('key_string'));
            $person->keys()->save($key);

        }

        if ($request->input('profiles') != null ){
            $profiles = array();
            foreach ($request->input('profiles') as $profile_id){
                $profile = Profile::find($profile_id);
                array_push($profiles,$profile);
                $person->profiles()->sync($profiles);
            }
        }

        return response()->json($person,201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
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
