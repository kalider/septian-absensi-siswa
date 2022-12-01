<?php

namespace App\Services\impl;

use App\Services\DepartmentService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class DepartmentServiceImpl implements DepartmentService
{
    public function create(array $department): int
    {
        $department['created_at'] = date('Y-m-d H:i:s');
        return DB::table('departments')->insertGetId($department);
    }

    public function update(int $id, array $department): bool
    {
        $department['updated_at'] = date('Y-m-d H:i:s');
        return DB::table('departments')->where('id', $id)-> update($department);
    }
   
    public function delete(int $id): bool
    {
        return DB::table('departments')->where('id', $id)->delete();
    }

    public function findAllByPage(int $perpage = 10): LengthAwarePaginator
    {
        return DB::table('departments')->paginate($perpage);
    }

    public function findById(int $id): object|null
    {
        return DB::table('departments')->find($id);
    }

    public function findAll(): array
    {
        return DB::table('departments')->get()->toArray();
    }
}