<?php

namespace App\Services\impl;

use App\Services\TeacherService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class TeacherServiceImpl implements TeacherService
{
    public function create(array $teacher): int
    {
        $teacher['created_at'] = date('Y-m-d H:i:s');
        return DB::table('teachers')->insertGetId($teacher);
    }

    public function update(int $id, array $teacher): bool
    {
        $teacher['updated_at'] = date('Y-m-d H:i:s');
        return DB::table('teachers')->where('id', $id)-> update($teacher);
    }

    public function delete(int $id): bool
    {
        return DB::table('teachers')->where('id', $id)->delete();
    }

    public function findAllByPage(int $perpage = 10): LengthAwarePaginator
    {
        return DB::table('teachers')->paginate($perpage);
    }

    public function findById(int $id): object|null
    {
        return DB::table('teachers')->find($id);
    }

    public function findAll(): array
    {
        return DB::table('teachers')->get()->toArray();
    }
}