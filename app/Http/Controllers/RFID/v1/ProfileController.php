<?php

namespace App\Http\Controllers;

use App\Models\RFID\v1\Person;
use App\Models\RFID\v1\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // get all profiles to specific person
        $profiles = Person::where('person_id',$id)->profiles;
                    //Person::where('person_id',$id)->with('profiles')->first();
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
    public function store(Request $request, $id)
    {
        // store profile for person
        $person = Person::find($id);
        $newProfile = new Profile();
        $person->profiles()->attach($newProfile);

        //delete profile
        //$person->profiles()->detach($newProfile);
        //delte all profile
        //$person->profiles()->detach();

        // === podmienka overuje takto
        //do buducna - ci sa v profiloch cloveka nachadza dany profil alebo nie
        // $person->profiles->contains($profile->id)

        // ako ocekovat ci sa nejake profily zmenili a ktore s auz nepouzivjau, aby ich mohol vymazat a aby mohol pridat nove
        // $person->profiles()->sync($profiles);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
