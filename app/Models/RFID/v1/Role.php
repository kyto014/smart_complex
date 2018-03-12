<?php

namespace App\Models\RFID\v1;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'role';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'role_id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function people(){
        return $this->hasMany('App\Models\RFID\v1\Person','role_id');
    }

    public function permissions(){
        return $this->belongsToMany('App\Models\RFID\v1\Permission','permission_role','role_id','permission_id');
    }
}
