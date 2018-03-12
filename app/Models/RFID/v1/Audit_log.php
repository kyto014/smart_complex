<?php

namespace App\Models\RFID\v1;

use Illuminate\Database\Eloquent\Model;

class Audit_log extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'audit_log';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'audit_log_id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function person(){
        return $this->belongsTo('App\Models\RFID\v1\Person','person_id');
    }
}
