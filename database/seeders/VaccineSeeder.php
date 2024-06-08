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
            'when_to_give'=> "At Birth",
            'protection_from'=>'HepatitisB',
            'days_count' => 0,
            'dir' => "vaccine_photos/BCG.png",
            'source' => 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_two' => 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_three'=> 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_four'=> 'https://www.who.int/news-room/fact-sheets/detail/tuberculosis',
            'protection_from_details' => 'Tuberculosis (TB) is a contagious infection that primarily targets the lungs, although in infants
and young children, it can also affect other parts of the body such as the brain, bones, joints, and internal
organs (known as extrapulmonary or miliary tuberculosis). Severe cases of TB can lead to serious
complications. Fortunately, the BCG vaccine has been shown to provide protection against meningitis and
disseminated TB in children.
Tuberculosis (TB) is a challenging disease to treat once contracted, with treatment often being
lengthy and not always successful. The 2020 World Health Organization global TB report revealed that
the Philippines has the highest TB incidence rate in Asia, with 554 cases per 100,000 Filipinos.'

        ]);
        DB::table('vaccines')->insert([


            'name' => 'Hepatitis B',
            'dose_number' => 1,
            'description' => 'Hepatitis B vaccine is a highly effective prevention measure that can protect individuals from
            contracting the virus. The vaccine works by helping the immune system build antibodies to fight off the
            virus if exposed in the future.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'when_to_give'=> "At Birth",
            'protection_from'=>'Tuberculosis',
            'days_count' => 0,
            'dir' => "vaccine_photos/HepatitisB.png",
            'source' => 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_two' => 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_three'=> 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_four'=> 'https://www.who.int/news-room/fact-sheets/detail/tuberculosis',
            'protection_from_details' => 'Hepatitis B virus is a serious liver infection that, when contracted in infancy, often remains
asymptomatic for many years. However, if left untreated, it can progress to cirrhosis and liver cancer in
adulthood. Children under the age of 6 who contract the hepatitis B virus are at the highest risk of
developing chronic infections. Hepatitis B virus is a serious liver infection that, when contracted in
infancy, often remains asymptomatic for many years. However, if left untreated, it can progress to cirrhosis
and liver cancer in adulthood. Children under the age of 6 who contract the hepatitis B virus are at the
highest risk of developing chronic infections.'
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
            'when_to_give'=> "6, 10 and 14 weeks from Birth",
            'protection_from'=>'Diphtheria, Pertussis, Tetanus, Haemophilus Influenzae type b and Hepatitis B',
            'days_count' => 45,
            'dir' => "vaccine_photos/pentavalent-vaccine.png",
            'source' => 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_two' => 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_three'=> 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_four'=> 'https://www.who.int/news-room/fact-sheets/detail/tuberculosis',
            'protection_from_details' => 'Diphtheria is a bacterial infection that primarily affects the nose, throat, tonsils, and skin. The
diphtheria toxin produced by the bacteria can lead to the formation of obstructive pseudo-membranes in
the upper respiratory tract, which can result in difficulty breathing and swallowing, particularly in children.
In severe cases, diphtheria can cause paralysis, heart failure, kidney failure, and in some instances, death.
It is crucial to seek medical attention promptly if diphtheria is suspected, as early treatment can
significantly improve outcomes.
Pertussis, commonly known as whooping cough, is a highly contagious respiratory disease that
can result in prolonged coughing spells lasting for weeks. In severe cases, it can lead to difficulty
breathing, pneumonia, and other serious complications.
Tetanus is a serious medical condition that results in excruciating muscle contractions. In children,
it can lead to the locking of neck and jaw muscles, a condition commonly known as lockjaw. This can
make it extremely difficult for children to perform basic functions such as opening their mouth,
swallowing, breastfeeding, or even breathing. Unfortunately, even with proper treatment, tetanus can often
prove to be fatal.
Haemophilus influenzae type b is a bacterium that can cause serious diseases such as meningitis
and pneumonia in infants and young children. These bacteria are commonly found in the human
nasopharynx and can be transmitted to others through droplets from nasopharyngeal secretions.
80-90% of infants infected with Hepatitis B within their first year of life are at a high risk of
developing chronic infections.'

        ]);

        DB::table('vaccines')->insert([
            'name' => 'Pentavalent 2',
            'dose_number' => 2,
            'description' => 'Pentavalent vaccine is a combination vaccine that protects against five different diseases. This vaccine
            is administered to infants and young children to provide immunity against these potentially dangerous
            infections.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'when_to_give'=> "6, 10 and 14 weeks from Birth",
            'protection_from'=>'Diphtheria, Pertussis, Tetanus, Haemophilus Influenzae type b and Hepatitis B',
            'days_count' => 75,
            'dir' => "vaccine_photos/pentavalent-vaccine.png",
            'source' => 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_two' => 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_three'=> 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_four'=> 'https://www.who.int/news-room/fact-sheets/detail/tuberculosis'

        ]);

        DB::table('vaccines')->insert([
            'name' => 'Pentavalent 3',
            'dose_number' => 3,
            'description' => 'Pentavalent vaccine is a combination vaccine that protects against five different diseases. This vaccine
            is administered to infants and young children to provide immunity against these potentially dangerous
            infections.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'when_to_give'=> "6, 10 and 14 weeks from Birth",
            'protection_from'=>'Diphtheria, Pertussis, Tetanus, Haemophilus Influenzae type b and Hepatitis B',
            'days_count' => 105,
            'dir' => "vaccine_photos/pentavalent-vaccine.png",
            'source' => 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_two' => 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_three'=> 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_four'=> 'https://www.who.int/news-room/fact-sheets/detail/tuberculosis'
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
            'when_to_give'=> "6, 10 and 14 weeks from Birth",
            'protection_from'=>'Poliovirus',
            'days_count' => 45,
            'dir' => "vaccine_photos/opv.png",
            'source' => 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_two' => 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_three'=> 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_four'=> 'https://www.who.int/news-room/fact-sheets/detail/tuberculosis',
            'protection_from_details' => 'Polio is a highly contagious virus that affects approximately 1 in 200 individuals who become
infected. Tragically, 5 to 10 percent of those cases result in death due to paralysis of the respiratory
muscles. Once paralysis occurs, there is currently no known cure for polio'

        ]);

        DB::table('vaccines')->insert([
            'name' => 'OPV 2',
            'dose_number' => 2,
            'description' => 'Oral Polio Vaccine (OPV) is a live attenuated vaccine that is administered orally to provide immunity
            against the poliovirus. Developed by Dr. Albert Sabin in the 1960s, OPV has played a crucial role in the
            global effort to eradicate polio',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'when_to_give'=> "6, 10 and 14 weeks from Birth",
            'protection_from'=>'Poliovirus',
            'days_count' => 75,
            'dir' => "vaccine_photos/opv.png",
            'source' => 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_two' => 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_three'=> 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_four'=> 'https://www.who.int/news-room/fact-sheets/detail/tuberculosis'
        ]);

        DB::table('vaccines')->insert([
            'name' => 'OPV 3',
            'dose_number' => 3,
            'description' => 'Oral Polio Vaccine (OPV) is a live attenuated vaccine that is administered orally to provide immunity
            against the poliovirus. Developed by Dr. Albert Sabin in the 1960s, OPV has played a crucial role in the
            global effort to eradicate polio',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'when_to_give'=> "6, 10 and 14 weeks from Birth",
            'protection_from'=>'Poliovirus',
            'days_count' => 105,
            'dir' => "vaccine_photos/opv.png",
            'source' => 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_two' => 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_three'=> 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_four'=> 'https://www.who.int/news-room/fact-sheets/detail/tuberculosis'
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
            'when_to_give'=> "14 weeks from Birth",
            'protection_from'=>'Poliovirus',
            'days_count' => 105,
            'dir' => "vaccine_photos/ipv.png",
            'source' => 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_two' => 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_three'=> 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_four'=> 'https://www.who.int/news-room/fact-sheets/detail/tuberculosis',
            'protection_from_details'=>'Polio is a highly contagious virus that affects approximately 1 in 200 individuals who become
infected. Tragically, 5 to 10 percent of those cases result in death due to paralysis of the respiratory
muscles. Once paralysis occurs, there is currently no known cure for polio.'
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
            'when_to_give'=> "6, 10 and 14 weeks from Birth",
            'protection_from'=>'Pneumonia and Meningitis',
            'days_count' => 45,
            'dir' => "vaccine_photos/pcv-v2.png",
            'source' => 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_two' => 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_three'=> 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_four'=> 'https://www.who.int/news-room/fact-sheets/detail/tuberculosis',
            'protection_from_details' => 'Pneumococcal diseases, such as pneumonia and meningitis, are prevalent worldwide, particularly
among children under 2 years old. These illnesses are a significant source of sickness and can have serious
consequences if left untreated.'

        ]);
        DB::table('vaccines')->insert([
            'name' => 'PCV 2',
            'dose_number' => 2,
            'description' => 'Pneumococcal Conjugate Vaccine is a highly effective immunization created using the conjugate
            vaccine method. It is specifically designed to safeguard infants, young children, and adults from
            illnesses caused by the bacterium Streptococcus pneumoniae',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'when_to_give'=> "6, 10 and 14 weeks from Birth",
            'protection_from'=>'Pneumonia and Meningitis',
            'days_count' => 75,
            'dir' => "vaccine_photos/pcv-v2.png",
            'source' => 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_two' => 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_three'=> 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_four'=> 'https://www.who.int/news-room/fact-sheets/detail/tuberculosis'

        ]);
        DB::table('vaccines')->insert([
            'name' => 'PCV 3',
            'dose_number' => 3,
            'description' => 'Pneumococcal Conjugate Vaccine is a highly effective immunization created using the conjugate
            vaccine method. It is specifically designed to safeguard infants, young children, and adults from
            illnesses caused by the bacterium Streptococcus pneumoniae',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'when_to_give'=> "6, 10 and 14 weeks from Birth",
            'protection_from'=>'Pneumonia and Meningitis',
            'days_count' => 105,
            'dir' => "vaccine_photos/pcv-v2.png",
            'source' => 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_two' => 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_three'=> 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_four'=> 'https://www.who.int/news-room/fact-sheets/detail/tuberculosis'
        ]);
        // MMR
        DB::table('vaccines')->insert([
            'name' => 'MMR 1',
            'dose_number' => 1,
            'description' => 'Measles, Mumps, Rubella (MMR) vaccine is a combination vaccine that protects against three serious
            and highly contagious viral diseases',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'when_to_give'=> "9 months and 1 year old from Birth",
            'protection_from'=>'Measles, Mumps and Rubella',
            'days_count' => 270,
            'dir' => "vaccine_photos/mmr.png",
            'source' => 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_two' => 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_three'=> 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_four'=> 'https://www.who.int/news-room/fact-sheets/detail/tuberculosis',
            'protection_from_details'=> 'Measles is an extremely contagious disease characterized by symptoms such as fever, runny nose,
white spots in the back of the mouth, and a rash. The most common complications associated with measles
include ear infections, diarrhea, and pneumonia. In severe cases, measles can lead to blindness, brain
swelling, and other serious health issues.
Mumps is a viral infection that can lead to various symptoms such as headaches, fatigue, fever,
and swelling of the salivary glands. In severe cases, complications may arise, including meningitis, orchitis
(inflammation of the testicles), and even deafness. It is important to seek medical attention if you suspect
you have mumps to prevent these potential complications.
Rubella infection typically presents as a mild illness in children and adults. However, in pregnant
women, it can have severe consequences such as miscarriage, stillbirth, or birth defects affecting the eyes,
ears, heart, and brain. This condition is known as Congenital Rubella Syndrome'

        ]);

        DB::table('vaccines')->insert([
            'name' => 'MMR 2',
            'dose_number' => 2,
            'description' => 'Measles, Mumps, Rubella (MMR) vaccine is a combination vaccine that protects against three serious
            and highly contagious viral diseases',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'when_to_give'=> "9 months and 1 year old from Birth",
            'protection_from'=>'Measles, Mumps and Rubella',
            'days_count' => 365,
            'dir' => "vaccine_photos/mmr.png",
            'source' => 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_two' => 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_three'=> 'https://www.unicef.org/philippines/stories/routine-immunization-children-philippines',
            'source_four'=> 'https://www.who.int/news-room/fact-sheets/detail/tuberculosis'


        ]);

        DB::commit();
    }
}
