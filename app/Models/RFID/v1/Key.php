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

    public function role(){
        return $this->belongsTo('App\Models\Person');
    }

    public function people(){
        return $this->belongsTo('App\Models\Person','person_id');
    }
}
