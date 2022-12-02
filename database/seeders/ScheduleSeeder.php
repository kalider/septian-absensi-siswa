<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schedules')->delete();
        DB::table('schedules')->insert([
            'id' => 1,
            'day' => '1',
            'time' => '10:20-12:00',
            'time_to' => '1-3',
            'teacher_id' => 1,
            'lesson_id' => 1,
            'class_id'  => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
