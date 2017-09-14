<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
	        $table->string('title');
	        $table->longText('description');
	        $table->dateTime('date');
	        $table->dateTime('max_booking_date');
	        $table->integer('max_participants')->default(0);
	        $table->integer('owner')->unsigned()->index();
	        $table->foreign('owner')->references('id')->on('users')->onDelete('cascade');
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
	    DB::statement('SET FOREIGN_KEY_CHECKS = 0');
	    Schema::dropIfExists('events');
	    DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
