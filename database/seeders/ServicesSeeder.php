<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('services')->insert(
            // [
            // 'manager_email' => 'dummymanager@iut-dhaka.edu',
            // 'cloth_type' => 'T-Shirt',
            // 'operation' => 'Wash',
            // 'price' => 5
            // ],
            [
                'manager_email' => 'dummymanager@iut-dhaka.edu',
                'cloth_type' => 'T-Shirt',
                'operation' => 'Iron',
                'price' => 3
            ],
            [
                'manager_email' => 'dummymanager@iut-dhaka.edu',
                'cloth_type' => 'T-Shirt',
                'operation' => 'Wash',
                'price' => 10
            ],
            [
                'manager_email' => 'dummymanager@iut-dhaka.edu',
                'cloth_type' => 'Bedsheet',
                'operation' => 'Wash',
                'price' => 10
            ]
    );
    }
}
