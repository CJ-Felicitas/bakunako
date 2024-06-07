<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher_type', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('partner_id')->nullable(); // Make partner_id nullable
            $table->foreign('partner_id')->references('id')->on('partners');
            $table->string('item_name');
            $table->integer('total_quantity');
            $table->integer('remaining_quantity');
            $table->integer('redeemed_quantity')->default(0);
            $table->unsignedBigInteger('vaccine_id');
            $table->foreign('vaccine_id')->references('id')->on('vaccines');
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
        Schema::dropIfExists('voucher_type');
    }
};
