<?php

namespace App\Http\Controllers\RFID\v1;

use App\Models\RFID\v1\Access;
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
        $accesses = Access::all();
       // return $accesses;
        return view('accesses.accesses', $accesses);
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
        $access = new Access();
        $access->access_name = $request->input('access_name');
        $access->time_from = $request->input('time_from');
        $access->time_to = $request->input('time_to');
        $access->door_id = $request->input('door_id');
        $access->next_access_id = $request->input('next_access_id');
        $access->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Access  $access_id
     * @return \Illuminate\Http\Response
     */
    public function get($access_id)
    {
        $access = Access::find($access_id);
        return $access;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Access  $access
     * @return \Illuminate\Http\Response
     */
    public function edit(Access $access)
    {
        //
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
        $access = Access::where('access_id',$access_id)->first();
        if ($access){
            $access->access_name = $request->input('access_name');
            $access->time_from = $request->input('time_from');
            $access->time_to = $request->input('time_to');
            $access->door_id = $request->input('door_id');
            $access->next_access_id = $request->input('next_access_id');
            $access->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Access  $access_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($access_id)
    {
        $access = Access::where('access_id',$access_id)->first();
        if ($access->next_access_id != null){


        }
    }
}
