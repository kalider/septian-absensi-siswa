<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;

interface LessonService{

    public function create(array $lesson): int;
    public function update(int $id, array $lesson): bool;
    public function delete(int $id): bool;

    public function findAllByPage(int $perpage = 10): LengthAwarePaginator;  
    public function findById(int $id): object|null;
    public function findAll(): array;
}