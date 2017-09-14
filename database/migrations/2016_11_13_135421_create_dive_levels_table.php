<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiveLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dive_levels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('level')->unsigned()->index();
            $table->foreign('level')->references('id')->on('dive_labels')->onDelete('cascade');
            $table->string('licence');
            $table->string('instructor');
            $table->string('origin');
            $table->string('origin_number');
            $table->date('date');
	        $table->boolean('archive')->default(0);
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
        Schema::dropIfExists('dive_levels');
        Schema::dropIfExists('dive_labels');
    }
}
