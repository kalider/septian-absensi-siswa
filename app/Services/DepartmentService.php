<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;

interface DepartmentService{

    public function create(array $department): int;
    public function update(int $id, array $department): bool;
    public function delete(int $id): bool;

    public function findAllByPage(int $perpage = 10): LengthAwarePaginator;  
    public function findById(int $id): object|null;  
    public function findAll(): array;
}