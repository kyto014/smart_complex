<?php

namespace App\Models\RFID\v1;

use Illuminate\Database\Eloquent\Model;

class Key_state extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'key_state';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'key_state_id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function keys(){
        return $this->hasMany('App\Models\RFID\v1\Key','key_state_id');
    }
}
