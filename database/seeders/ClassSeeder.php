<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classs')->delete();
        DB::table('classs')->insert([
           'id' => 1,
           'name_class' => '10 RPL',
           'wali_class' => 'Pa Nandang',
           'department_id' => 1,
           'created_at' => date('Y-m-d H:i:s') 
        ]);

        DB::table('classs')->insert([
            'id' => 2,
            'name_class' => '11 RPL',
            'wali_class' => 'Pa Budi',
            'department_id' => 1,
            'created_at' => date('Y-m-d H:i:s') 
         ]);

         DB::table('classs')->insert([
            'id' => 3,
            'name_class' => '12 RPL',
            'wali_class' => 'Pa Tatang',
            'department_id' => 1,
            'created_at' => date('Y-m-d H:i:s') 
         ]);

         DB::table('classs')->insert([
            'id' => 4,
            'name_class' => '10 TKJ',
            'wali_class' => 'Bu Rifa',
            'department_id' => 2,
            'created_at' => date('Y-m-d H:i:s') 
         ]);

         DB::table('classs')->insert([
            'id' => 5,
            'name_class' => '11 TKJ',
            'wali_class' => 'Pa Hendri',
            'department_id' => 2,
            'created_at' => date('Y-m-d H:i:s') 
         ]);

         DB::table('classs')->insert([
            'id' => 6,
            'name_class' => '12 TKJ',
            'wali_class' => 'Pa Wandi',
            'department_id' => 2,
            'created_at' => date('Y-m-d H:i:s') 
         ]);

         DB::table('classs')->insert([
            'id' => 7,
            'name_class' => '10 OTKP',
            'wali_class' => 'Bu Sovi',
            'department_id' => 3,
            'created_at' => date('Y-m-d H:i:s') 
         ]);

         DB::table('classs')->insert([
            'id' => 8,
            'name_class' => '11 OTKP',
            'wali_class' => 'Pa Pepen',
            'department_id' => 3,
            'created_at' => date('Y-m-d H:i:s') 
         ]);

         DB::table('classs')->insert([
            'id' => 9,
            'name_class' => '12 OTKP',
            'wali_class' => 'Bu Vivi',
            'department_id' => 3,
            'created_at' => date('Y-m-d H:i:s') 
         ]);

         DB::table('classs')->insert([
            'id' => 10,
            'name_class' => '10 TKR',
            'wali_class' => 'Pa Lampard',
            'department_id' => 4,
            'created_at' => date('Y-m-d H:i:s') 
         ]);

         DB::table('classs')->insert([
            'id' => 11,
            'name_class' => '11 TKR',
            'wali_class' => 'Pa Acep',
            'department_id' => 4,
            'created_at' => date('Y-m-d H:i:s') 
         ]);

         DB::table('classs')->insert([
            'id' => 12,
            'name_class' => '12 TKR',
            'wali_class' => 'Bu Layla',
            'department_id' => 4,
            'created_at' => date('Y-m-d H:i:s') 
         ]);

         DB::table('classs')->insert([
            'id' => 13,
            'name_class' => '10 TBSM',
            'wali_class' => 'Pa Nurdin',
            'department_id' => 5,
            'created_at' => date('Y-m-d H:i:s') 
         ]);

         DB::table('classs')->insert([
            'id' => 14,
            'name_class' => '11 TBSM',
            'wali_class' => 'Pa Wawan',
            'department_id' => 5,
            'created_at' => date('Y-m-d H:i:s') 
         ]);

         DB::table('classs')->insert([
            'id' => 15,
            'name_class' => '12 TBSM',
            'wali_class' => 'Pa Gery',
            'department_id' => 5,
            'created_at' => date('Y-m-d H:i:s') 
         ]);

         DB::table('classs')->insert([
            'id' => 16,
            'name_class' => '10 FARMASI',
            'wali_class' => 'Pa Samsul',
            'department_id' => 6,
            'created_at' => date('Y-m-d H:i:s') 
         ]);

         DB::table('classs')->insert([
            'id' => 17,
            'name_class' => '11 FARMASI',
            'wali_class' => 'Bu Sri Handayani',
            'department_id' => 6,
            'created_at' => date('Y-m-d H:i:s') 
         ]);

         DB::table('classs')->insert([
            'id' => 18,
            'name_class' => '12 FARMASI',
            'wali_class' => 'Pa Alfin',
            'department_id' => 6,
            'created_at' => date('Y-m-d H:i:s') 
         ]);

         DB::table('classs')->insert([
            'id' => 19,
            'name_class' => '10 TELIN',
            'wali_class' => 'Pa Abdul',
            'department_id' => 7,
            'created_at' => date('Y-m-d H:i:s') 
         ]);

         DB::table('classs')->insert([
            'id' => 20,
            'name_class' => '11 TELIN',
            'wali_class' => 'Pa Dio',
            'department_id' => 7,
            'created_at' => date('Y-m-d H:i:s') 
         ]);

         DB::table('classs')->insert([
            'id' => 21,
            'name_class' => '12 TELIN',
            'wali_class' => 'Bu Ghea',
            'department_id' => 7,
            'created_at' => date('Y-m-d H:i:s') 
         ]);
    }

    
        
    
}