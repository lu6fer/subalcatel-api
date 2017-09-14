<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('status_id')->unsigned()->index();
            $table->foreign('status_id')->references('id')->on('subscription_statuses')->onDelete('cascade');
	        $table->integer('origin_id')->unsigned()->index();
	        $table->foreign('origin_id')->references('id')->on('membership_origins')->onDelete('cascade');
            $table->date('expiration_date');
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
	    Schema::dropIfExists('subscriptions');
	    Schema::dropIfExists('subscription_statuses');
	    DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
