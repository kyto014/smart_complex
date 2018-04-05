<?php

namespace App\Models\RFID\v1;

use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'key';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'key_id';

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
        'key_type_id','key_state_id','person_id'
    ];


    public function person(){
        return $this->belongsTo('App\Models\RFID\v1\Person','person_id');
    }

    public function keyType(){
        return $this->belongsTo('App\Models\RFID\v1\Key_type','key_type_id');
    }

    public function keyState(){
        return $this->belongsTo('App\Models\RFID\v1\Key_state','key_state_id');
    }
}
