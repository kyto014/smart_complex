<?php

namespace App\Models\RFID\v1;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'person';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'person_id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'forname','surname', 'email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public function person_type(){
        return $this->belongsTo('App\Models\RFID\v1\Person_type','person_type_id');
    }

    public function role(){
        return $this->belongsTo('App\Models\RFID\v1\Role','role_id');
    }

    public function keys(){
        return $this->hasMany('App\Models\RFID\v1\Key','person_id');
    }

    public function auditLogs(){
        return $this->hasMany('App\Models\RFID\v1\Audit_log','person_id');
    }

    public function profiles(){
        return $this->belongsToMany('App\Models\RFID\v1\Profile','person_profile','person_id','profile_id');
    }

    public function secondFactors(){
        return $this->belongsToMany('App\Models\RFID\v1\SecondFactor','person_second_factor','person_id','second_factor_id');
    }
}
