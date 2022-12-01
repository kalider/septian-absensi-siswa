<?php

namespace App\Services\impl;

use App\Services\StudentService;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class StudentServiceImpl implements StudentService
{
    public function create(array $student): int
    {
        $student['created_at'] = date('Y-m-d H:i:s');
        return DB::table('students')->insertGetId($student);   
    }

    public function update(int $id, array $student): bool
    {
        $student['updated_at'] = date('Y-m-d H:i:s');
        return DB::table('students')->where('id', $id)-> update($student);
    }

    public function delete(int $id): bool
    {
        return DB::table('students')->where('id', $id)->delete();
    }

    public function findAllByPage(?string$q,int $perpage = 10): LengthAwarePaginator
    {
        return DB::table('students')
        ->leftJoin('classs', 'students.class_id', '=', 'classs.id')
        ->select('students.*', 'classs.name_class AS class')
        ->where('classs.name_class', 'LIKE', "%{$q}%")
        ->paginate($perpage);
    }

    public function findById(int $id): object|null
    {
       return DB::table('students')->find($id); 
    }

    public function findAll(): Collection
    {
        $data = DB::table('students')
            ->join('classs', 'students.class_id', '=', 'classs.id')
            ->select('students.*', 'classs.name_class AS class')
            ->get();

        return $data;
    }

    public function storePhoto(UploadedFile $uploadedFile): string|bool
    {
        if ($uploadedFile->getSize() <= 0) return false;
        
        $path = $uploadedFile->store('student_photos');
        
        return $path;
    }
}