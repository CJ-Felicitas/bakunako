<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        DB::table('user_type')->insert([
            'type' => 'administrator'
        ]);
        DB::table('user_type')->insert([
            'type' => 'parent'
        ]);
        
        DB::commit();
    }
}
