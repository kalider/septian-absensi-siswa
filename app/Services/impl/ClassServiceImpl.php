<?php

namespace App\Services\impl;

use App\Services\ClassService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ClassServiceImpl implements ClassService
{
    public function create(array $class): int
    {
        $class['created_at'] = date('Y-m-d H:i:s');
        return DB::table('classs')->insertGetId($class);
    }

    public function update(int $id, array $class): bool
    {
        $class['updated_at'] = date('Y-m-d H:i:s');
        return DB::table('classs')->where('id', $id)-> update($class);
    }
   
    public function delete(int $id): bool
    {
        return DB::table('classs')->where('id', $id)->delete();
    }

    public function findAllByPage(?string $q,int $perpage = 10): LengthAwarePaginator
    {
        return DB::table('classs')
        ->leftJoin('departments', 'classs.department_id', '=', 'departments.id')
        ->select('classs.*', 'departments.name_department AS department')
        ->where('name_class', 'LIKE', "%{$q}%")
        ->paginate($perpage);
    }

    public function findById(int $id): object|null
    {
        return DB::table('classs')->find($id);
    }

    public function findAll(): array
    {
        return DB::table('classs')->get()->toArray();
    }
}