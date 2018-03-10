<?php

namespace App\Http\Controllers;

use App\Models\Person_type;
use Illuminate\Http\Request;

class PersonTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $people = Person_type::find(10)->people;
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
     * @param  \App\Models\Person_type  $person_type
     * @return \Illuminate\Http\Response
     */
    public function show(Person_type $person_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person_type  $person_type
     * @return \Illuminate\Http\Response
     */
    public function edit(Person_type $person_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person_type  $person_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person_type $person_type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person_type  $person_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person_type $person_type)
    {
        //
    }
}
