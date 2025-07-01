<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodwishFamilyTable extends Migration
{
    public function up()
    {
        Schema::create('foodwish_family', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('family_id');
            $table->unsignedBigInteger('foodwish_id');
            $table->timestamps();

            $table->foreign('family_id')->references('id')->on('families')->cascadeOnDelete();
            $table->foreign('foodwish_id')->references('id')->on('foodwishes')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('foodwish_family');
    }
}
