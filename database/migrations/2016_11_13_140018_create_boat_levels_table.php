<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoatLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boat_levels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('level')->unsigned()->index();
            $table->foreign('level')->references('id')->on('boat_labels')->onDelete('cascade');
            $table->string('licence');
            $table->string('instructor')->nullable();
            $table->string('origin')->nullable();
            $table->string('origin_number')->nullable();
            $table->date('date')->nullable();
            $table->boolean('vhf_licence')->nullable();
            $table->string('vhf_licence_number')->nullable();
            $table->date('vhf_date')->nullable();
	        $table->boolean('archive')->default(0);;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boat_levels');
        Schema::dropIfExists('boat_labels');
    }
}
