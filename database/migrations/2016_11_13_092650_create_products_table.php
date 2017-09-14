<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_product')->unsigned()->index()->nullable();
            $table->foreign('parent_product')->references('id')->on('products')->onDelete('cascade');
	        $table->string('slug')->unique();
            $table->string('name');
            $table->string('description');
            $table->decimal('price');
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
	    Schema::dropIfExists('products');
	    Schema::dropIfExists('subscription_products');
	    DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
