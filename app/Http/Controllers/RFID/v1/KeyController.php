<?php

namespace App\Http\Controllers\RFID\v1;

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
        // gte all keys for specific person
        //$keys = Person::find(1)->keys;

        // !!! vrati mi osobu aj s jeho klucami
        //$person = Person::where('person_id',$id)->with('keys')->first();

        $keys = Key::with('person', 'keyType', 'keyState')->get();
//        var_dump($keys);
//        return response()->json($keys,200);
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $key_id)
    {
        $person = Person::where('person_id',$key_id)->first();
        $key = new Key();
        $key->key_type_id = $request->input('key_type_id');
        $key->key_state_id = $request->input('key_state_id');
        $key->person_id = $request->input('person_id');
        $key->key_string = Hash::make($request->input('key_string'));
        $person->keys()->save($key);

        return response()->json($key,201);

        //to delete keys
        // $person->keys()->delete();
        //$person->delete();
    }

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


    public function edit(Key $key)
    {
        //
    }


    public function update(Request $request, $person_id, $key_id)
    {
        $key = Key::where([['person_id',$person_id],['key_id',$key_id]])->first();
        if ($key != null){
            $key->key_type_id = $request->input('key_type_id');
            $key->key_state_id = $request->input('key_state_id');
            $key->person_id = $request->input('person_id');
            $key->key_string = Hash::make($request->input('key_string'));
            $key->save();
        }
        return response()->json($key, 200);
    }


    public function destroy($person_id, $key_id)
    {
        $key = Key::where([['person_id',$person_id],['key_id',$key_id]])->first();
        $key->delete();
        return response()->json('Key deleted', 200);
    }
}
