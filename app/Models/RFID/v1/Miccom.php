<?php

namespace App\Models\RFID\v1;

use Illuminate\Database\Eloquent\Model;

class Miccom extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'miccom';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'miccom_id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function doors(){
        return $this->hasMany('App\Models\RFID\v1\Door','miccom_id');
    }

    public function gadgets(){
        return $this->hasMany('App\Models\RFID\v1\Gadget','miccom_id');
    }

    public function miccomLogs(){
        return $this->hasMany('App\Models\RFID\v1\Miccom_log','miccom_id');
    }

    public function miccomConfigurations(){
        return $this->hasMany('App\Models\RFID\v1\Miccom_configuration','miccom_id');
    }
}
