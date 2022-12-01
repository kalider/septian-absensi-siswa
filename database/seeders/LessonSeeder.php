<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lessons')->delete();
        DB::table('lessons')->insert([
            [
            'id' => 1,
            'kd_lesson' => '021',
            'name_lesson' => 'Bahasa Indonesia',
            'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'kd_lesson' => '078',
                'name_lesson' => 'Bahasa Sunda',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'kd_lesson' => '019',
                'name_lesson' => 'Fisika',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'kd_lesson' => '012',
                'name_lesson' => 'Kimia',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 5,
                'kd_lesson' => '026',
                'name_lesson' => 'PKN',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 6,
                'kd_lesson' => '090',
                'name_lesson' => 'Matematika',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 7,
                'kd_lesson' => '078',
                'name_lesson' => 'PAI',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 8,
                'kd_lesson' => '065',
                'name_lesson' => 'Seni Budaya',
                'created_at' => date('Y-m-d H:i:s')
            ],
        ]);
    }
}
