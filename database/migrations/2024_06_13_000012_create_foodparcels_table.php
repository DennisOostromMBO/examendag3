<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodparcelsTable extends Migration
{
    public function up()
    {
        Schema::create('foodparcels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('family_id');
            $table->integer('parcel_number');
            $table->date('composition_date');
            $table->date('issue_date')->nullable();
            $table->string('status');
            $table->boolean('is_active');
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('family_id')->references('id')->on('families')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('foodparcels');
    }
}
