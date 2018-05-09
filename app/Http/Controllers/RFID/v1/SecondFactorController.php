<?php

namespace App\Http\Controllers\RFID\v1;

use App\Models\RFID\v1\Person;
use App\Models\RFID\v1\PersonSecondFactor;
use App\Models\RFID\v1\SecondFactor;
use App\Models\RFID\v1\SecondFactorType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SecondFactorController extends Controller
{
    public function create()
    {
        //
    }

    public function getAll(){
        //$secondFactors = SecondFactor::with('people')->get();

        $secondFactors = SecondFactorType::with('secondFactors.people')->get();

        $data = [
            'secondFactors' => $secondFactors
        ];
        return view('second_factor.secondFactors', $data);
    }

    public function getAllPeople()
    {
        //$people = Person::all();
        $people = Person::with('keys.keyType')->get();

        $p = array();
        foreach ($people as $pe){
            foreach ($pe['keys'] as $key){
                if ($key['key_type_id'] == config('variables.key_types.tag')){
                    array_push($p, $pe);
                }
            }
        }

        // vraciam len ludi, ktory maju kluc typu Tag
        $data = ['people' => $p];

        return view('second_factor.addSecondFactor', $data);
    }

    public function createSecondFactor(Request $request){

        $token = true;
        $sf = 0;
        //$person_second_factor_check = PersonSecondFactor::where('person_id',$request->input('person_id'))->get();
        $person_second_factor_check = Person::where('person_id', $request->input('person_id'))->with('secondFactors')->get();
//        $person_second_factor_check = SecondFactor::with('people')->where('second_factor_type_id',config('variables.second_factor_type.password'))->get();
        if ($person_second_factor_check){
            //echo $person_second_factor_check[0]['secondFactors'];
            foreach ($person_second_factor_check as $person){
                //echo $person['secondFactors'];
                foreach ($person['secondFactors'] as $second_factor_check){
                    if($second_factor_check['second_factor_type_id'] == config('variables.second_factor_type.password')){
                        $token = false;
                        $sf = $second_factor_check['second_factor_id'];
                    }
                }
            }
        }

        if ($token){
            $second_factor = new SecondFactor();
            $second_factor->second_factor_type_id = config('variables.second_factor_type.password');
            $second_factor->second_factor_string = $request->input('key_string');
            $second_factor->valid_from = Carbon::now();
            $second_factor->valid_to = Carbon::now()->addYears(2);
            $second_factor->save();

            $second_factor_id = $second_factor->second_factor_id;

            $person_second_factor = new PersonSecondFactor();
            $person_second_factor->person_id = $request->input('person_id');
            $person_second_factor->second_factor_id = $second_factor_id;
            $person_second_factor->save();
            $notification = array(
                'message' => 'Druhý faktor bol vytvorený!',
                'alert-type' => 'success'
            );
        } else{
            SecondFactor::where('second_factor_type_id', config('variables.second_factor_type.password'))
                ->where('second_factor_id', $sf)->update(['second_factor_string' => $request->input('key_string'), 'valid_from' =>
                    Carbon::now(), 'valid_to' => Carbon::now()->addYears(2)]);
            $notification = array(
                'message' => 'Druhý faktor bol zmenený!',
                'alert-type' => 'success'
            );
        }

        return redirect('secondFactors')->with($notification);
    }


    public function delete($second_factor_id)
    {
//        $person_second_factor = PersonSecondFactor::where('second_factor_id',$second_factor_id)->first();
        $second_factor = SecondFactor::where('second_factor_id',$second_factor_id)->first();

//        $person_second_factor->delete();
        $second_factor->delete();
        $notification = array(
            'message' => 'Druhý faktor bol odstránený!',
            'alert-type' => 'success'
        );
        return redirect('secondFactors')->with($notification);
    }
}
