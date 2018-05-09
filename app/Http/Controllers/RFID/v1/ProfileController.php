<?php

namespace App\Http\Controllers\RFID\v1;

use App\Models\RFID\v1\Access;
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
        $profiles = Profile::all();
        $data = ['profiles' => $profiles];
        return view('profiles.profiles', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createProfile()
    {
        $profiles = Profile::all();
        $accesses = Access::with('door','access')->get();
        $data =[
            'profiles' => $profiles,
            'accesses' => $accesses
        ];
        return view('profiles.addProfile', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //store new profile
        $profile = new Profile();
        $profile->profile_name = $request->input('name');
        if($request->input('desc') != "") {
            $profile->description = $request->input('desc');
        }

        $profile->save();
        if ($request->input('accesses') != null) {
            $profile = Profile::find($profile->profile_id);
            $accesses = Access::whereIn('access.access_id', $request->input('accesses'))->get();
            $profile->accesses()->attach($accesses);
        }

//        return response()->json($profile, 201);
//        return redirect('profiles');
        $notification = array(
            'message' => 'Profil bol vytvorený!',
            'alert-type' => 'success'
        );
        return redirect('profiles')->with($notification);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function get($profile_id)
    {
        $profile = Profile::with('accesses')->where('profile_id', $profile_id)->first();
        $accesses = Access::all();

        $data =[
            'profile' => $profile,
            'accesses' => $accesses
        ];
        return view('profiles.profile', $data);
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
            $profile->profile_name = $request->input('name');
            $profile->description = $request->input('desc');
            $profile->save();

            $profile->accesses()->sync($request->input('accesses'));

        }

        $notification = array(
            'message' => 'Zmeny boli uložené!',
            'alert-type' => 'success'
        );
        return redirect('profiles')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function delete($profile_id)
    {
        $profile = Profile::find($profile_id);
        if ($profile->accesses){
            $profile->accesses()->detach();
        }
        if ($profile->people){
            $profile->people()->detach();
        }
        Profile::destroy($profile_id);
        $notification = array(
            'message' => 'Profil bol odstránený!',
            'alert-type' => 'success'
        );
        return redirect('profiles')->with($notification);
    }
}
