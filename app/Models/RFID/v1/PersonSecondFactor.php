<?php

namespace App\Models\RFID\v1;

use Illuminate\Database\Eloquent\Model;

class PersonSecondFactor extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'person_second_factor';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'person_second_factor_id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
