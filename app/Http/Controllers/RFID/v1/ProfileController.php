<?php

namespace App\Http\Controllers\RFID\v1;

use App\Models\RFID\v1\Person;
use App\Models\RFID\v1\Profile;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        //$profiles = Person::where('person_id',$id)->profiles;
        $profiles = Profile::all();
                    //Person::where('person_id',$id)->with('profiles')->first();
        //return $profiles;
        return view('profiles.profiles', $profiles);
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
        //store new profile
        $profile = new Profile();
        $profile->profile_name = $request->input('profile_name');
        $profile->description = $request->input('description');
        $profile->save();

        // store profile for person
        //$person = Person::find($person_id);
        //$newProfile = new Profile();
        //$person->profiles()->attach($newProfile);

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
    public function get($profile_id)
    {
        $profile = Profile::find($profile_id);
        return $profile;
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
    public function update(Request $request, $profile_id)
    {
        $profile = Profile::find($profile_id);
        if ($profile){
            $profile->profile_name = $request->input('profile_name');
            $profile->description = $request->input('description');
            $profile->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy($profile_id)
    {
        $profile = Profile::find($profile_id);
        if ($profile->accesses){
            $profile->accesses()->detach();
        }
        if ($profile->people){
            $profile->people()->detach();
        }
        Profile::destroy($profile_id);
    }
}
