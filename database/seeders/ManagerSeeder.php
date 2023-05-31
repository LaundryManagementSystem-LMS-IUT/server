<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('managers')->insert([
            'email' => 'dummymanager@iut-dhaka.edu',
            'laundry_name' => 'ABC Laundry',
            'opening_time' => '08:00:00',
            'closing_time' => '18:00:00',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
