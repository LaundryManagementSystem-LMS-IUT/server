<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('notifications')->insert([
            [
                'notification_id' => '1',
                'email' => 'nafisamaliyat@iut-dhaka.edu',
                'message' => 'Notification 1 message',
                'read'=> 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'notification_id' => '2',
                'email' => 'nafisamaliyat@iut-dhaka.edu',
                'message' => 'Notification 2 message',
                'read'=> 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'notification_id' => '3',
                'email' => 'nafisamaliyat@iut-dhaka.edu',
                'message' => 'Notification 3 message',
                'read'=> 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'notification_id' => '4',
                'email' => 'dummymanager@iut-dhaka.edu',
                'message' => 'Notification 4 message',
                'read'=> 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'notification_id' => '5',
                'email' => 'dummymanager@iut-dhaka.edu',
                'message' => 'Notification 5 message',
                'read'=> 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'notification_id' => '6',
                'email' => 'dummymanager@iut-dhaka.edu',
                'message' => 'Notification 6 message',
                'read'=> 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more notification records as needed
        ]);
    }
}
