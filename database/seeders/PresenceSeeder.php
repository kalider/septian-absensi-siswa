<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PresenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('presences_times')->delete();
        DB::table('presences_times')->insert([
            'id' => 1,
            'schedule_id' => 1,
            'date' => '2022-12-01',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('presences')->delete();
        DB::table('presences')->insert([
            'id' => 1,
            'time_id' => 1,
            'student_id' => 1,
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);

    }
}
