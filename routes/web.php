<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'App\Http\Controllers\Controller@welcomePage');

Route::get('/people', 'App\Http\Controllers\RFID\v1\PersonController@getAll'); //vlastny
Route::get('/people/{person_id}','App\Http\Controllers\RFID\v1\PersonController@get'); //vlastny > profil cloveka + jeho kluce + jeho profily + druhe faktory
Route::post('/people', 'App\Http\Controllers\RFID\v1\PersonController@create'); //vlastny > toto je submit formulara pre pridanie pridanie usera > napr button na /people
Route::post('people/{person_id}', 'App\Http\Controllers\RFID\v1\PersonController@update'); //NIE vlastny > toto je kam ide submit button pre /people/{person_id}
Route::delete('people/{person_id}','App\Http\Controllers\RFID\v1\PersonController@delete'); //NIE vlastny > v tabulke /people bude delete btn a tu ho presmeruje (treba alert ze are zou sure?)

Route::get('/keys', 'App\Http\Controllers\RFID\v1\KeyController@getAll');
Route::get('/keys/{key_id}','App\Http\Controllers\RFID\v1\KeyController@get');
Route::post('/keys', 'App\Http\Controllers\RFID\v1\KeyController@create');
Route::post('/keys/{key_id}', 'App\Http\Controllers\RFID\v1\KeyController@update');
Route::delete('/keys/{key_id}','App\Http\Controllers\RFID\v1\KeyController@delete');

Route::get('/profiles', 'App\Http\Controllers\RFID\v1\ProfileController@getAll');
Route::get('/profiles/{profile_id}','App\Http\Controllers\RFID\v1\ProfileController@get');
Route::post('/profiles', 'App\Http\Controllers\RFID\v1\ProfileController@create');
Route::post('/profiles/{profile_id}', 'App\Http\Controllers\RFID\v1\ProfileController@update');
Route::delete('/profiles/{profile_id}','App\Http\Controllers\RFID\v1\ProfileController@delete');

Route::get('/accesses', 'App\Http\Controllers\RFID\v1\AccessController@getAll');
Route::get('/accesses/{access_id}','App\Http\Controllers\RFID\v1\AccessController@get');
Route::post('/accesses', 'App\Http\Controllers\RFID\v1\AccessController@create');
Route::post('/accesses/{access_id}', 'App\Http\Controllers\RFID\v1\AccessController@update');
Route::delete('/accesses/{access_id}','App\Http\Controllers\RFID\v1\AccessController@delete');