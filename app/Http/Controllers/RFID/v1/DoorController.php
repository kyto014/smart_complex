<?php

namespace App\Http\Controllers\RFID\v1;

use App\Http\Controllers\AuditLogController;
use App\Http\Resources\KeyResource;
use App\Models\RFID\v1\Door;
use App\Models\RFID\v1\Key;
use App\Models\RFID\v1\Person;
use App\Models\RFID\v1\PersonSecondFactor;
use App\Models\RFID\v1\SecondFactor;
use Carbon\Carbon;
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
        $key = Key::where('key_string',\request()->get('key_string'))->first();

        // pokial sa jedna z veci nenachadza v databaze, vrati sa resultCode 0
        if ($door and $key){
            $key = new KeyResource($key);
            $person = Person::with('profiles.accesses')->where('person_id',$key->person_id)->first();
            $person_id = $person->person_id;
            $accesses = array();


            foreach ($person->profiles as $profile) {
                $arrayOfAccesses = $profile->accesses->where('door_id',$door->door_id);
                foreach ($arrayOfAccesses as $item) {
                    array_push($accesses, $item);
                }
            }
            $now = Carbon::now();
            $resultCode = config('variables.operation_code.access_denied');
            foreach ($accesses as $access){
                if ($access->time_from <= $now && $access->time_to >= $now){
                    $resultCode = config('variables.operation_code.access_allowed');
                    break;
                }
                else{
                    $resultCode = config('variables.operation_code.access_denied');
                }
            }

            if ($resultCode == config('variables.operation_code.access_allowed')) {
                if ($key->key_type_id == config('variables.key_types.tag')) {// key_type_id hovorim o tom, ze je to TAG cize mobil
                    $second_factor_type_id = $door->second_factor_type_id;
                    if ($second_factor_type_id == config('variables.second_factor_type.code')) {
                        $bytes = random_bytes(3);

                        $person_second_factors = PersonSecondFactor::where('person_id', $key->person_id)->get();
                        foreach ($person_second_factors as $person_second_factor) {
                            $second_factor_type = SecondFactor::where('second_factor_id', $person_second_factor->second_factor_id)->first();
                            if ($second_factor_type->second_factor_type_id == config('variables.second_factor_type.code')) {
                                SecondFactor::where('second_factor_type_id', config('variables.second_factor_type.code'))
                                    ->where('second_factor_id', $second_factor_type->second_factor_id)->update(['second_factor_string' => bin2hex($bytes), 'valid_from' =>
                                    Carbon::now(), 'valid_to' => Carbon::now()->addMinutes(3)]);
                            }
                        }
                    } else if ($second_factor_type_id == config('variables.second_factor_type.none')) {// dvere nevyzaduju druhy faktor
                        AuditLogController::create("Prítup do objektu", config('variables.operation_code.access_allowed'), $person_id,'No second factor authentication needed.');
                        return response()->json(['operation_code' => config('variables.operation_code.access_allowed')], 200);
                    }
                    AuditLogController::create("Prítup do objektu", $second_factor_type_id, $person_id,'Second factor authentication needed.');
                    return response()->json(['operation_code' => $second_factor_type_id], 200);
                }
            }
        } else{
            $resultCode = config('variables.operation_code.access_denied');
        }

        return response()->json(['operation_code' => $resultCode],200);
    }

    public function second_factor(){
        // pride mi key_string, second_factor_type_id, kooood,
        $resultCode = config('variables.operation_code.access_denied');
        $now = Carbon::now();

        if (\request()->get('second_factor_type_id') == config('variables.second_factor_type.password')){
            //viem, ze chce ako druhy faktor heslo
            $key = Key::where('key_string', \request()->get('key_string'))->first();
            if ($key){
                $person_second_factors = PersonSecondFactor::where('person_id', $key->person_id)->get();
                foreach ($person_second_factors as $person_second_factor){
                    $second_factor_type = SecondFactor::where('second_factor_id',$person_second_factor->second_factor_id)->first();
                    if ($second_factor_type->second_factor_type_id == 2){
                        if (\request()->get('code') == $second_factor_type->second_factor_string and $second_factor_type->valid_from <= $now and $second_factor_type->valid_to >= $now){
                            $resultCode = config('variables.operation_code.access_allowed');
                        }
                    }
                }
            }
        } else if (\request()->get('second_factor_type_id') == config('variables.second_factor_type.code')){
            $key = Key::where('key_string', \request()->get('key_string'))->first();
            if ($key){
                $person_second_factors = PersonSecondFactor::where('person_id', $key->person_id)->get();
                foreach ($person_second_factors as $person_second_factor){
                    $second_factor_type = SecondFactor::where('second_factor_id',$person_second_factor->second_factor_id)->first();
                    if ($second_factor_type->second_factor_type_id == config('variables.second_factor_type.code')){
                        if (\request()->get('code') == $second_factor_type->second_factor_string and $second_factor_type->valid_from <= $now and $second_factor_type->valid_to >= $now){
                            $resultCode = config('variables.operation_code.access_allowed');
                            SecondFactor::where('second_factor_type_id', config('variables.second_factor_type.code'))->where('second_factor_id', $second_factor_type->second_factor_id)
                                ->update(['second_factor_string' => '', 'valid_from' => '', 'valid_to' => '']);
                        }
                    }
                }
            }
        }

        AuditLogController::create("Prítup do objektu - zadanie druheho faktora", $resultCode, $key->person_id,\request()->get('code'));
        return response()->json(['operation_code' => $resultCode],200);
    }
}
