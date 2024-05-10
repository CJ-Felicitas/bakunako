<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class VoucherActiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        DB::table('voucher_distribution_active')->insert([
            'vaccine_id' => 1,
        ]);
        DB::table('voucher_distribution_active')->insert([
            'vaccine_id' => 2,
        ]);
        DB::table('voucher_distribution_active')->insert([
            'vaccine_id' => 5,
        ]);
        DB::table('voucher_distribution_active')->insert([
            'vaccine_id' => 8,
        ]);
        DB::table('voucher_distribution_active')->insert([
            'vaccine_id' => 9,
        ]);
        DB::table('voucher_distribution_active')->insert([
            'vaccine_id' => 12,
        ]);
        DB::table('voucher_distribution_active')->insert([
            'vaccine_id' => 14,
        ]);
        DB::commit();
    }
}
