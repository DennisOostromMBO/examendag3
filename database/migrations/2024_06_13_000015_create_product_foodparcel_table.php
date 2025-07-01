<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductFoodparcelTable extends Migration
{
    public function up()
    {
        Schema::create('product_foodparcel', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('foodparcel_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('product_unit_count');
            $table->timestamps();

            $table->foreign('foodparcel_id')->references('id')->on('foodparcels')->cascadeOnDelete();
            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_foodparcel');
    }
}
