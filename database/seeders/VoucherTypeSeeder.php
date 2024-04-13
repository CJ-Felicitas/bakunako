<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class VoucherTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        DB::table('voucher_type')->insert([
            'name' => 'BCG',
            'description' => 'Bacillus Calmette-Guerin',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'days_count' => 0
        ]);
        DB::table('voucher_type')->insert([
            'name' => 'Hepatitis',
            'description' => 'Hepatitis B vaccine (HBV)',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'days_count' => 0
        ]);
        // pentavalent vaccine
        DB::table('voucher_type')->insert([
            'name' => 'Pentavalent 1',
            'description' => 'Diphtheria, Tetanus, Pertussis, Hepatitis B, Haemophilus influenzae type b',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'days_count' => 45
        ]);

        DB::table('voucher_type')->insert([
            'name' => 'Pentavalent 2',
            'description' => 'Diphtheria, Tetanus, Pertussis, Hepatitis B, Haemophilus influenzae type b',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'days_count' => 75
        ]);
        
        DB::table('voucher_type')->insert([
            'name' => 'Pentavalent 3',
            'description' => 'Diphtheria, Tetanus, Pertussis, Hepatitis B, Haemophilus influenzae type b',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'days_count' => 105
        ]);

        // opv
        DB::table('voucher_type')->insert([
            'name' => 'OPV 1',
            'description' => 'Oral Polio Vaccine',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'days_count' => 45
        ]);

        DB::table('voucher_type')->insert([
            'name' => 'OPV 2',
            'description' => 'Inactivated Polio Vaccine',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'days_count' => 75
        ]);

        DB::table('voucher_type')->insert([
            'name' => 'OPV 3',
            'description' => 'Inactivated Polio Vaccine',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'days_count' => 105
        ]);

        // IPV
        DB::table('voucher_type')->insert([
            'name' => 'IPV',
            'description' => 'Inactivated Polio Vaccine',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'days_count' => 105
        ]);
        // PCV
        DB::table('voucher_type')->insert([
            'name' => 'PCV 1',
            'description' => 'Pneumococcal Conjugate Vaccine',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'days_count' => 45
        ]);
        DB::table('voucher_type')->insert([
            'name' => 'PCV 2',
            'description' => 'Pneumococcal Conjugate Vaccine',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'days_count' => 75
        ]);
        DB::table('voucher_type')->insert([
            'name' => 'PCV 3',
            'description' => 'Pneumococcal Conjugate Vaccine',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'days_count' => 105
        ]);
        // MMR
        DB::table('voucher_type')->insert([
            'name' => 'MMR 1',
            'description' => 'Measles, Mumps, Rubella',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'days_count' => 270

        ]);

        DB::table('voucher_type')->insert([
            'name' => 'MMR 2' ,
            'description' => 'Measles, Mumps, Rubella',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'days_count' => 365

        ]);
        DB::commit();
    }
}
