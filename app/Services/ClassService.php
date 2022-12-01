<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;

interface ClassService{

    public function create(array $class): int;
    public function update(int $id, array $class): bool;
    public function delete(int $id): bool;

    public function findAllByPage(?string $q,int $perpage = 10): LengthAwarePaginator;  
    public function findById(int $id): object|null;  
    public function findAll(): array;  

}