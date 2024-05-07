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
        Schema::create('voucher_distribution_active', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('vaccine_id');
            $table->foreign('vaccine_id')->references('id')->on('vaccines');
            
            $table->unsignedBigInteger('voucher_type_id')->nullable()->default(null);
            $table->foreign('voucher_type_id')->references('id')->on('voucher_type');
     

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
        Schema::dropIfExists('voucher_distribution_active');
    }
};
