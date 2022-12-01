<?php

namespace App\Services\impl;

use App\Services\LessonService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class LessonServiceImpl implements LessonService
{
    public function create(array $lesson): int
    {
        $lesson['created_at'] = date('Y-m-d H:i:s');
        return DB::table('lessons')->insertGetId($lesson);
    }

    public function update(int $id, array $lesson): bool
    {
        $lesson['updated_at'] = date('Y-m-d H:i:s');
        return DB::table('lessons')->where('id', $id)-> update($lesson);
    }
   
    public function delete(int $id): bool
    {
        return DB::table('lessons')->where('id', $id)->delete();
    }

    public function findAllByPage(int $perpage = 10): LengthAwarePaginator
    {
        return DB::table('lessons')->paginate($perpage);
    }

    public function findById(int $id): object|null
    {
        return DB::table('lessons')->find($id);
    }

    public function findAll(): array
    {
        return DB::table('lessons')->get()->toArray();
    }
}