<?php
namespace App\Http\Controllers\RFID\v1;


use App\Http\Resources\PersonResource;

use App\Models\RFID\v1\Person;
use App\Models\RFID\v1\Person_type;
use App\Models\RFID\v1\Role;
use Barryvdh\Debugbar\LaravelDebugbar;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $version = \request()->getRequestUri();

        $route = Route::current();
        //dump(\request());
        //sdebugbar()->info($route);
        $people = Person::with('keys')->get();
        //$people->surname = $route;
        //return response()->json(new PersonResource($people),200);
        //dump($version);
        //return (PersonResource::collection($people));
        if (\request()->get("key") == "36069191763196932"){
            return response()->json("access granted",200);
        }else{
            return response()->json("access denied",200);

        }
        //return "aaa";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // iba na vytvorenie form
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        return response()->json($person,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // zobraz jedneho

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        // edit form
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        // update do DB
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        //
    }

    public function version(){
        return "verisonnnn";
    }
}
