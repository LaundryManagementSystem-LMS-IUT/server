<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => 'Nafisa Maliyat',
                'email' => 'nafisamaliyat@iut-dhaka.edu',
                'email_verified' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'Dummy Manager',
                'email' => 'dummymanager@iut-dhaka.edu',
                'email_verified' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
