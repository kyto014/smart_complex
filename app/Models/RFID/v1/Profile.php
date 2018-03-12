<?php

namespace App\Models\RFID\v1;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profile';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'profile_id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function people(){
        return $this->belongsToMany('App\Models\RFID\v1\Person','person_profile','profile_id','person_id');
    }

    public function accesses(){
        return $this->belongsToMany('App\Models\RFID\v1\Access','access_profile','profile_id','access_id');
    }
}
