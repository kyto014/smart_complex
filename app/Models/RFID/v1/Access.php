<?php

namespace App\Models\RFID\v1;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'access';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'access_id';

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
        'access_name','time_from','time_to','door_id'
    ];

    public function door(){
        return $this->belongsTo('App\Models\RFID\v1\Door','door_id');
    }

    public function profiles(){
        return $this->belongsToMany('App\Models\RFID\v1\Profile','access_profile','access_id','profile_id');
    }

    public  function access(){
        return $this->belongsTo('App\Models\RFID\v1\Access','next_access_id');
    }
}
