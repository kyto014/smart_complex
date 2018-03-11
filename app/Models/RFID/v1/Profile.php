<?php

namespace App\Models\RFID;

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
        return $this->belongsToMany('App\Models\Person');
    }
}
