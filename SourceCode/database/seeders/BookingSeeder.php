<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    public function run()
    {
        DB::table('bookings')->insert([
            [
                'field_id' => 1,
                'user_id' => 1,
                'booking_date' => '2024-06-15',
                'start_time' => '09:00:00',
                'end_time' => '10:00:00',
                'total_price' => 315000,
                'status' => 'pending', // Thêm trường status cho khớp migration
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'field_id' => 2,
                'user_id' => 2,
                'booking_date' => '2024-06-16',
                'start_time' => '10:00:00',
                'end_time' => '11:00:00',
                'total_price' => 300000,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'field_id' => 3,
                'user_id' => 1,
                'booking_date' => '2024-06-17',
                'start_time' => '11:00:00',
                'end_time' => '12:00:00',
                'total_price' => 280000,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}