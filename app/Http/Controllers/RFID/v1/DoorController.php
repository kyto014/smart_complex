<?php

namespace App\Http\Controllers\RFID\v1;

use App\Http\Resources\KeyResource;
use App\Models\RFID\v1\Door;
use App\Models\RFID\v1\Key;
use App\Models\RFID\v1\Person;
use Carbon\Carbon;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class DoorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RFID\v1\Door  $door
     * @return \Illuminate\Http\Response
     */
    public function show(Door $door)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RFID\v1\Door  $door
     * @return \Illuminate\Http\Response
     */
    public function edit(Door $door)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RFID\v1\Door  $door
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Door $door)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RFID\v1\Door  $door
     * @return \Illuminate\Http\Response
     */
    public function destroy(Door $door)
    {
        //
    }

    public function enter()
    {
        $door = Door::where('door_uuid',\request()->get('door_uuid'))->first();
        $key = new KeyResource(Key::where('key_string',\request()->get('key_string'))->first());
        //chybova hlaska: neznamy kluc
        $person = Person::with('profiles.accesses')->where('person_id',$key->person_id)->first();
        //chybova hlaska: uzivatel nema ziadne profily
        $accesses = array();
        foreach ($person->profiles as $profile) {
            $arrayOfAccesses = $profile->accesses->where('door_id',$door->door_id);
            foreach ($arrayOfAccesses as $item) {
                array_push($accesses, $item);
            }
        }
        $now = Carbon::now();
        $resultCode = 0;
        foreach ($accesses as $access){
            if ($access->time_from <= $now && $access->time_to >= $now){
                $resultCode = 1;
                break;
            }
            else{
                $resultCode = 0;
            }
        }

        if ($resultCode == 1){ // && dvere pozaduju autentifikaciu 2 stupna
            // vykonaj druhu autentifikaciu
        }


        return $resultCode;
    }
}
