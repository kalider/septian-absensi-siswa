<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teachers')->delete();
        DB::table('teachers')->insert([
            [
                'id' => 1,
                'nip' => '001',
                'name_teacher' => 'Fatmawati S.pd',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'nip' => '002',
                'name_teacher' => 'Fitri Apriyanti S.pd',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'nip' => '003',
                'name_teacher' => 'Pudding S.pd',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'nip' => '004',
                'name_teacher' => 'Jajang Nurjaman S.pd',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 5,
                'nip' => '005',
                'name_teacher' => 'Linlin M.pd',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 6,
                'nip' => '006',
                'name_teacher' => 'Rudi Salam S.pd',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 7,
                'nip' => '007',
                'name_teacher' => 'Dedi Mulyana S.pd',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 8,
                'nip' => '008',
                'name_teacher' => 'Yeti Miyanti S.pd',
                'created_at' => date('Y-m-d H:i:s')
            ],  
        ]);
    }
}
