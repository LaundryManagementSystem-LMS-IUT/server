<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class OrderDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $orderDetails = [
            [
                'order_id' => '1001',
                'cloth_type' => 'T-Shirt',
                'operation' => 'Wash',
                'manager_email' => 'dummymanager@iut-dhaka.edu',
                'completed' => true,
                'quantity' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => '1001',
                'cloth_type' => 'T-Shirt',
                'operation' => 'Iron',
                'manager_email' => 'dummymanager@iut-dhaka.edu',
                'completed' => true,
                'quantity' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => '1002',
                'cloth_type' => 'T-Shirt',
                'operation' => 'Wash',
                'manager_email' => 'dummymanager@iut-dhaka.edu',
                'completed' => false,
                'quantity' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => '1002',
                'cloth_type' => 'T-Shirt',
                'operation' => 'Iron',
                'manager_email' => 'dummymanager@iut-dhaka.edu',
                'completed' => false,
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('order_details')->insert($orderDetails);
    }
}
