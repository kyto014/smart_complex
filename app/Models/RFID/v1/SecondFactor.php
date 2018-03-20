<?php

namespace App\Models\RFID\v1;

use Illuminate\Database\Eloquent\Model;

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

    public function doors(){
        return $this->hasMany('App\Models\RFID\v1\Door','second_factor_id');
    }

    public function secondFactorType(){
        return $this->belongsTo('App\Models\RFID\v1\SecondFactorType','second_factor_type_id');
    }

    public function people(){
        return $this->belongsToMany('App\Models\RFID\v1\Person','person_second_factor','second_factor_id','person_id');
    }
}