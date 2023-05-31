<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('customers')->insert([
            'email' => 'nafisamaliyat@iut-dhaka.edu',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
