<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::group(['namespace' => 'App\Http\Controllers\v1'], function (){
//Route::prefix(config('app.api_version'))->group(function (){

//} );

Route::post('/doors/enter', 'App\Http\Controllers\RFID\v1\DoorController@enter');

/*Route::get('/{people/{id}/keys}', 'KeyController@index');
Route::post('/people/{id}/keys', 'KeyController@store');
Route::get('/people/{person_id}/keys/{key_id}', 'KeyController@show');
Route::put('people/{person_id}/keys/{key_id}', 'KeyController@update');
Route::delete('people/{person_id}/keys/{key_id}','KeyController@destroy');*/