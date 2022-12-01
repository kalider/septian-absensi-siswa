<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface StudentService {

    public function create(array $student): int;
    public function update(int $id, array $student): bool;
    public function delete(int $id): bool;

    public function findAllByPage(?string $q,int $perpage = 10): LengthAwarePaginator;
    public function findById(int $id): object|null;
    public function findAll(): Collection;

    public function storePhoto(UploadedFile $uploadedFile): string|bool;
}