<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->delete();
        DB::table('departments')->insert([
            [
                'id' => 1,
                'kd' => 'J001',
                'name_department' => 'RPL', 
                'name_leader_department' => 'Dudun',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'kd' => 'J002',
                'name_department' => 'TKJ', 
                'name_leader_department' => 'Galih',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'kd' => 'J003',
                'name_department' => 'OTKP', 
                'name_leader_department' => 'Rida',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'kd' => 'J004',
                'name_department' => 'TKR', 
                'name_leader_department' => 'Pa Mustofa',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 5,
                'kd' => 'J005',
                'name_department' => 'TBSM', 
                'name_leader_department' => 'Pa Wawan',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 6,
                'kd' => 'J006',
                'name_department' => 'FARMASI', 
                'name_leader_department' => 'Pa Albi Rustandi',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 7,
                'kd' => 'J007',
                'name_department' => 'TELIN', 
                'name_leader_department' => 'Bu Titi',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);

    }
}
