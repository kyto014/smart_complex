<?php

namespace App\Models\RFID\v1;

use Illuminate\Database\Eloquent\Model;

class Miccom_log extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'miccom_log';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'miccom_log_id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function miccom(){
        return $this->belongsTo('App\Models\RFID\v1\Miccom','miccom_id');
    }
}
