<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllergyPersonTable extends Migration
{
    public function up()
    {
        Schema::create('allergy_person', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('allergy_id');
            $table->timestamps();

            $table->foreign('person_id')->references('id')->on('persons')->cascadeOnDelete();
            $table->foreign('allergy_id')->references('id')->on('allergies')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('allergy_person');
    }
}
