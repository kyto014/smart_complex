<?php

namespace App\Http\Controllers\RFID\v1;

use App\Models\RFID\v1\Access;
use App\Models\RFID\v1\Door;
use App\Models\RFID\v1\Person;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class AccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $accesses = Access::with('door','access')->get();
       $data = [
           "accesses" => $accesses
       ];
        return view('accesses.accesses', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAccess()
    {
        $accesses = Access::all();
        $doors = Door::all();
        $data = [
            "accesses" => $accesses,
            "doors" => $doors
        ];
        return view('accesses.addAccess', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(strtotime($request->input('access_time_from')) < strtotime($request->input('access_time_to'))) {
            $access = new Access();
            $access->access_name = $request->input('access_name');
            $access->time_from = str_replace("T", " ", $request->input('access_time_from')) . ":00";
            $access->time_to = str_replace("T", " ", $request->input('access_time_to')) . ":00";
            $access->door_id = $request->input('door_id');
            if ($request->input('next_access_id') != "") {
                $access->next_access_id = $request->input('next_access_id');
            }
            $access->save();

            $notification = array(
                'message' => 'Prístup bol vytvorený!',
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message' => 'Čas od musí byť menší ako čas do.',
                'alert-type' => 'error'
            );
        }
        $notification = array(
            'message' => 'Prístup bol vytvorený!',
            'alert-type' => 'success'
        );
        return redirect('accesses')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Access  $access_id
     * @return \Illuminate\Http\Response
     */
    public function get($access_id)
    {
        $access = Access::with('door', 'access')->where('access_id', $access_id)->first();
        $access->time_from = str_replace(" ", "T", $access->time_from);
        $access->time_to = str_replace(" ", "T", $access->time_to);
        $accesses = Access::all();
        $doors = Door::all();
        $data = [
            "accesses" => $accesses,
            "doors" => $doors,
            "access" => $access
        ];

        return view('accesses.access', $data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Access  $access_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $access_id)
    {
        if(strtotime($request->input('access_time_from')) < strtotime($request->input('access_time_to'))){
            $access = Access::where('access_id',$access_id)->first();
            $access->access_name = $request->input('access_name');
            $access->time_from = str_replace("T", " ", $request->input('access_time_from')).":00";
            $access->time_to = str_replace("T", " ", $request->input('access_time_to')).":00";
            $access->door_id = $request->input('door_id');
            if($request->input('next_access_id') != "") {
                $access->next_access_id = $request->input('next_access_id');
            }
            $access->save();


        }

        $notification = array(
            'message' => 'Zmeny boli uložené!',
            'alert-type' => 'success'
        );
        return redirect('accesses')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Access  $access_id
     * @return \Illuminate\Http\Response
     */
    public function delete($access_id)
    {
        $notification = array(
            'message' => 'Prístup bol odstránený!',
            'alert-type' => 'success'
        );
        Access::destroy($access_id);
        return redirect('accesses')->with($notification);
    }


}
