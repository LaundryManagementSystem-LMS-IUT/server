<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $orders = [
            [
                'order_id' => '1001',
                'customer_email' => 'nafisamaliyat@iut-dhaka.edu',
                'manager_email' => 'dummymanager@iut-dhaka.edu',
                'status' => 'COMPLETED',
                'payment'=>200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => '1002',
                'customer_email' => 'nafisamaliyat@iut-dhaka.edu',
                'manager_email' => 'dummymanager@iut-dhaka.edu',
                'status' => 'PROCESSING',
                'payment'=>345,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('orders')->insert($orders);

    }
}
