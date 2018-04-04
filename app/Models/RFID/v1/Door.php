<?php

namespace App\Models\RFID\v1;

use Illuminate\Database\Eloquent\Model;

class Door extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'door';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'door_id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function accesses(){
        return $this->hasMany('App\Models\RFID\v1\Access','door_id');
    }

    public function miccom(){
        return $this->belongsTo('App\Models\RFID\v1\Miccom','miccom_id');
    }

    public function secondFactorType(){
        return $this->belongsTo('App\Models\RFID\v1\SecondFactorType','second_factor_type_id');
    }
}
