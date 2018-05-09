<?php

namespace App\Models\RFID\v1;

use Illuminate\Database\Eloquent\Model;

/**
 * @property \Illuminate\Config\Repository|mixed second_factor_type_id
 */
class SecondFactor extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'second_factor';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'second_factor_id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    public function secondFactorType(){
        return $this->belongsTo('App\Models\RFID\v1\SecondFactorType','second_factor_type_id');
    }

    public function secondFactor(){
        return $this->belongsTo('App\Models\RFID\v1\SecondFactor','second_factor_id');
    }

    public function people(){
        return $this->belongsToMany('App\Models\RFID\v1\Person','person_second_factor','second_factor_id','person_id');
    }

    public function personSecondFactor(){
        return $this->belongsToMany('App\Models\RFID\v1\PersonSecondFactor','person_second_factor','second_factor_id','person_id');
    }
}
