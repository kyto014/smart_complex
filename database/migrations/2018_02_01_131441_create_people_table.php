<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('person', function (Blueprint $table) {
            $table->increments('person_id');
            $table->string('forname');
            $table->string('surname');
            $table->string('email');
            $table->string('password');
            $table->foreign('person_type_id')->references('person_type_id')->on('person_type')->onDelete('cascade');
            $table->foreign('role_id')->references('role_id')->on('role')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
