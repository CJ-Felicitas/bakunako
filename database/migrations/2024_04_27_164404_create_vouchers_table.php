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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('voucher_type_id');
            $table->unsignedBigInteger('infant_id');
            $table->foreign('voucher_type_id')->references('id')->on('voucher_type');
            $table->foreign('infant_id')->references('id')->on('infants');
            $table->string('voucher_code');
            $table->boolean('is_reedeemable')->default(false);
            $table->boolean('is_redeemed')->default(false);
            $table->dateTime('redeemed_at')->nullable();
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
        Schema::dropIfExists('vouchers');
    }
};
