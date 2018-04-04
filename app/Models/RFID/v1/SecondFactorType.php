<?php

namespace App\Models\RFID\v1;

use Illuminate\Database\Eloquent\Model;

class SecondFactorType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'second_factor_type';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'second_factor_type_id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function secondFactors(){
        return $this->hasMany('App\Models\RFID\v1\SecondFactor','second_factor_type_id');
    }

    public function doors(){
        return $this->hasMany('App\Models\RFID\v1\Door','second_factor_type_id');
    }
}
