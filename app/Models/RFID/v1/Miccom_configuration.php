<?php

namespace App\Models\RFID\v1;

use Illuminate\Database\Eloquent\Model;

class Miccom_configuration extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'miccom_configuration';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'miccom_configuration_id';

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
