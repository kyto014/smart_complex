<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person_profile extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'person_profile';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'person_profile_id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
