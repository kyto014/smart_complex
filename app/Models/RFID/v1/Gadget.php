<?php

namespace App\Models\RFID\v1;

use Illuminate\Database\Eloquent\Model;

class Gadget extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gadget';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'gadget_id';

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
