<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;

interface ScheduleService{

    public function create(array $schedule): int;
    public function update(int $id, array $schedule): bool;
    public function delete(int $id): bool;

    public function findAllByPage(int $perpage = 10): LengthAwarePaginator;  
    public function findById(int $id): object|null;
    public function findAll(): array;
}