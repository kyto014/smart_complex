<?php

namespace App\Http\Controllers\RFID\v1;

use App\Http\Resources\KeyResource;
use App\Http\Resources\PersonResource;
use App\Models\RFID\v1\Key;
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

        $keys = Key::all();
//        var_dump($keys);
//        return response()->json($keys,200);
        return view('keys.keys', $keys);
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Key  $key
     * @return \Illuminate\Http\Response
     */
    public function get($key_id)
    {
        $key = Key::find($key_id);
        //$key = Key::where([['person_id',$person_id],['key_id',$key_id]])->first();
        return response()->json($key,200);
        //return $key;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Key  $key
     * @return \Illuminate\Http\Response
     */
    public function edit(Key $key)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Key  $key
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Key  $key
     * @return \Illuminate\Http\Response
     */
    public function destroy($person_id, $key_id)
    {
        $key = Key::where([['person_id',$person_id],['key_id',$key_id]])->first();
        $key->delete();
        return response()->json('Key deleted', 200);
    }
}
