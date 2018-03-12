<?php

namespace App\Models\RFID\v1;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permission';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'permission_id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function roles(){
        return $this->belongsToMany('App\Models\RFID\v1\Role','permission_role','permission_id','role_id');
    }
}
