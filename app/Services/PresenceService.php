<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface PresenceService{
    public function createPresTime(string $date, int $schedule_id): bool;
    public function updatePresTimeById(int $id, string $date, int $schedule_id): bool;
    public function getPresTimeByPage(int $perpage = 10): LengthAwarePaginator;
    public function findPresTimeById(int $id): object;
    public function deletePresTimeById(int $id): bool;

    public function pres(array $item): bool;
    public function findAllPresWithStudentByTime(int $id, int $schedule_id): Collection;

}