<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsTable extends Migration
{
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('family_id')->nullable();
            $table->string('first_name');
            $table->string('insertion')->nullable();
            $table->string('last_name');
            $table->date('birth_date');
            $table->string('person_type');
            $table->boolean('is_representative');
            $table->boolean('is_active');
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('family_id')->references('id')->on('families')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('persons');
    }
}
