<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infants', function (Blueprint $table) {
            $table->id();
            $table->string('infant_firstname');
            $table->string('infant_lastname');
            $table->string('infant_middlename');
            $table->date('date_of_birth');
            $table->string('place_of_birth');
            $table->string('father_firstname');
            $table->string('father_lastname');
            $table->string('father_middlename');
            $table->string('mother_firstname');
            $table->string('mother_lastname');
            $table->string('mother_middlename');
            $table->string('address');
            $table->string('sex');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('infants');
    }
};
