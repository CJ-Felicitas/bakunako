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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('infants_id');
            $table->foreign('infants_id')->references('id')->on('infants');
            $table->unsignedBigInteger('vaccines_id');
            $table->foreign('vaccines_id')->references('id')->on('vaccines');
            $table->date('date')->nullable();
            $table->time('time_schedule_start');
            $table->time('time_schedule_end');
            $table->integer('dose_number');

            // $table->string('hospital_address');
            // $table->string('hospital_name');]

            // // healthcare provider -> remove
            // $table->unsignedBigInteger('healthcare_provider_id'); -> remove
            // $table->foreign('healthcare_provider_id')->references('id')->on('users'); ->remove
            $table->string('status');
            $table->string('remarks')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('last_updated_by')->nullable();
            $table->foreign('last_updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule');
    }
};
