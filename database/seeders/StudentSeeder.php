<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->delete();
        DB::table('students')->insert([
            'id' => 1,
            'nis' => '10207080',
            'name' => 'Septian',
            'dob' => '2005-09-01',
            'pob' => 'Tasikmalaya',
            'gender' => '1',
            'class_id' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);
     
        foreach(range(2, 50) as $id) {
            DB::table('students')->insert([
                'id' => $id,
                'nis' => fake('id_ID')->randomNumber(8, true),
                'name' => fake('id_ID')->name(),
                'dob' => fake('id_ID')->date('Y-m-d', '2007-01-01'),
                'pob' => fake('id_ID')->city(),
                'gender' => fake('id_ID')->numberBetween(1,2),
                'class_id' => fake('id_ID')->numberBetween(1,21),
                'created_at' => date('Y-m-d H:i:s')
            ]); 
        }
        
    }

}
