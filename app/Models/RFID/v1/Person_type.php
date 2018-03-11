<?php

namespace App\Models\RFID\v1;

use Illuminate\Database\Eloquent\Model;

class Person_type extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'person_type';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'person_type_id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function people(){
        return $this->hasMany('App\Models\RFID\v1\Person','person_type_id');
    }
}
