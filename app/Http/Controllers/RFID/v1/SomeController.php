<?php

namespace App\Http\Controllers\v2;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SomeController extends Controller
{
    public function index()
    {
        $version = \request()->getRequestUri();

        $route = Route::current();
        //dump(\request());
        //sdebugbar()->info($route);
        $people = Person::with('keys')->get();
        //$people->surname = $route;
        //return response()->json(new PersonResource($people),200);
        //dump($people);
        //return (PersonResource::collection($people));
        return response()->json($people,200);
    }
}
