<?php

namespace App\Http\Controllers\RFID\v1;

use App\Http\Resources\KeyResource;
use App\Http\Resources\PersonResource;
use App\Models\RFID\v1\Key;
use App\Models\RFID\v1\Key_state;
use App\Models\RFID\v1\Key_type;
use App\Models\RFID\v1\Person;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class KeyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $keys = Key::with('person', 'keyType', 'keyState')->get();

        $data = [
            'keys' => $keys
        ];

        return view('keys.keys', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createKey()
    {
        $key_types = Key_type::all();
        $key_states = Key_state::all();
        $people = Person::all();
        $data = [
            'key_types' => $key_types,
            'key_states' => $key_states,
            'people' => $people
        ];
        return view('keys.addKey', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $person = Person::where('person_id',$request->input('person_id'))->first();
        $key = new Key();
        $key->key_type_id = $request->input('key_type_id');
        $key->key_state_id = $request->input('key_state_id');
        $key->person_id = $request->input('person_id');
        $key->key_string = $request->input('key_value');
        $person->keys()->save($key);


        $notification = array(
            'message' => 'Kľúč bol vytvorený!',
            'alert-type' => 'success'
        );
        return redirect('keys')->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param $key_id
     * @return \Illuminate\Http\Response
     */
    public function get($key_id)
    {
        $key = Key::with('person', 'keyType', 'keyState')->where('key_id', $key_id)->first();
        $key_types = Key_type::all();
        $key_states = Key_state::all();
        $people = Person::all();
        $data = [
            'key' => $key,
            'key_types' => $key_types,
            'key_states' => $key_states,
            'people' => $people
        ];
        return view('keys.key', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $key_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $key_id)
    {
        //$person->person_type_id = $request->input('person_type_id');
        $key = Key::where([['key_id',$key_id]])->first();
        if ($key_id != null){
            $key->key_type_id = $request->input('key_type_id');
            $key->key_state_id = $request->input('key_state_id');
            $key->person_id = $request->input('person_id');
            $key->key_string = $request->input('key_value');
            $key->save();
        }
        $notification = array(
            'message' => 'Zmeny boli uložené!',
            'alert-type' => 'success'
        );
        return redirect('keys')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $key_id
     * @return \Illuminate\Http\Response
     */
    public function delete($key_id)
    {

        $key = Key::where('key_id',$key_id)->first();
        $key->delete();
        $notification = array(
            'message' => 'Kľúč bol odstránený!',
            'alert-type' => 'success'
        );
        return redirect('keys')->with($notification);
    }
}
