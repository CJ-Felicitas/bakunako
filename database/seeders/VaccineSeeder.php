<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;
class VaccineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        DB::table('vaccines')->insert([
            'name' => 'BCG',
            'dose_number' => 1,
            'description' => 'Bacillus Calmette–Guérin (BCG) vaccine - is a live attenuated vaccine derived from a strain of
            Mycobacterium bovis that has been cultured and modified in such a way that it is safe for human use.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'days_count' => 0
        ]);
        DB::table('vaccines')->insert([
            'name' => 'Hepatitis B',
            'dose_number' => 1,
            'description' => 'Hepatitis B vaccine is a highly effective prevention measure that can protect individuals from
            contracting the virus. The vaccine works by helping the immune system build antibodies to fight off the
            virus if exposed in the future.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'days_count' => 0
        ]);
        // pentavalent vaccine
        DB::table('vaccines')->insert([
            'name' => 'Pentavalent 1',
            'dose_number' => 1,
            'description' => 'Pentavalent vaccine is a combination vaccine that protects against five different diseases. This vaccine
            is administered to infants and young children to provide immunity against these potentially dangerous
            infections.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'days_count' => 45
        ]);

        DB::table('vaccines')->insert([
            'name' => 'Pentavalent 2',
            'dose_number' => 2,
            'description' => 'Pentavalent vaccine is a combination vaccine that protects against five different diseases. This vaccine
            is administered to infants and young children to provide immunity against these potentially dangerous
            infections.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'days_count' => 75
        ]);

        DB::table('vaccines')->insert([
            'name' => 'Pentavalent 3',
            'dose_number' => 3,
            'description' => 'Pentavalent vaccine is a combination vaccine that protects against five different diseases. This vaccine
            is administered to infants and young children to provide immunity against these potentially dangerous
            infections.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'days_count' => 105
        ]);

        // opv
        DB::table('vaccines')->insert([
            'name' => 'OPV 1',
            'dose_number' => 1,
            'description' => 'Oral Polio Vaccine (OPV) is a live attenuated vaccine that is administered orally to provide immunity
            against the poliovirus. Developed by Dr. Albert Sabin in the 1960s, OPV has played a crucial role in the
            global effort to eradicate polio',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'days_count' => 45
        ]);

        DB::table('vaccines')->insert([
            'name' => 'OPV 2',
            'dose_number' => 2,
            'description' => 'Oral Polio Vaccine (OPV) is a live attenuated vaccine that is administered orally to provide immunity
            against the poliovirus. Developed by Dr. Albert Sabin in the 1960s, OPV has played a crucial role in the
            global effort to eradicate polio',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'days_count' => 75
        ]);

        DB::table('vaccines')->insert([
            'name' => 'OPV 3',
            'dose_number' => 3,
            'description' => 'Oral Polio Vaccine (OPV) is a live attenuated vaccine that is administered orally to provide immunity
            against the poliovirus. Developed by Dr. Albert Sabin in the 1960s, OPV has played a crucial role in the
            global effort to eradicate polio',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'days_count' => 105
        ]);

        // IPV
        DB::table('vaccines')->insert([
            'name' => 'IPV',
            'dose_number' => 1,
            'description' => 'Inactivated Polio Vaccine (IPV) is a type of vaccine that is used to protect against poliovirus, the
            virus that causes polio. IPV is made using a virus that has been killed, or inactivated, making it unable to
            cause infection. When a person is vaccinated with IPV, their immune system recognizes the inactivated
            virus as a threat and produces antibodies to attack it',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'days_count' => 105
        ]);
        // PCV
        DB::table('vaccines')->insert([
            'name' => 'PCV 1',
            'dose_number' => 1,
            'description' => 'Pneumococcal Conjugate Vaccine is a highly effective immunization created using the conjugate
            vaccine method. It is specifically designed to safeguard infants, young children, and adults from
            illnesses caused by the bacterium Streptococcus pneumoniae',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'days_count' => 45
        ]);
        DB::table('vaccines')->insert([
            'name' => 'PCV 2',
            'dose_number' => 2,
            'description' => 'Pneumococcal Conjugate Vaccine is a highly effective immunization created using the conjugate
            vaccine method. It is specifically designed to safeguard infants, young children, and adults from
            illnesses caused by the bacterium Streptococcus pneumoniae',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'days_count' => 75
        ]);
        DB::table('vaccines')->insert([
            'name' => 'PCV 3',
            'dose_number' => 3,
            'description' => 'Pneumococcal Conjugate Vaccine is a highly effective immunization created using the conjugate
            vaccine method. It is specifically designed to safeguard infants, young children, and adults from
            illnesses caused by the bacterium Streptococcus pneumoniae',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'days_count' => 105
        ]);
        // MMR
        DB::table('vaccines')->insert([
            'name' => 'MMR 1',
            'dose_number' => 1,
            'description' => 'Measles, Mumps, Rubella (MMR) vaccine is a combination vaccine that protects against three serious
            and highly contagious viral diseases',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'days_count' => 270

        ]);

        DB::table('vaccines')->insert([
            'name' => 'MMR 2',
            'dose_number' => 2,
            'description' => 'Measles, Mumps, Rubella (MMR) vaccine is a combination vaccine that protects against three serious
            and highly contagious viral diseases',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'days_count' => 365

        ]);

        DB::commit();
    }
}
