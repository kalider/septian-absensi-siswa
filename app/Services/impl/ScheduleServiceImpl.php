<?php

namespace App\Services\impl;

use App\Services\ScheduleService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ScheduleServiceImpl implements ScheduleService
{
    public function create(array $schedule): int
    {
        $schedule['created_at'] = date('Y-m-d H:i:s');
        return DB::table('schedules')->insertGetId($schedule);
    }

    public function update(int $id, array $schedule): bool
    {
        $schedule['updated_at'] = date('Y-m-d H:i:s');
        return DB::table('schedules')->where('id', $id)-> update($schedule);
    }
   
    public function delete(int $id): bool
    {
        return DB::table('schedules')->where('id', $id)->delete();
    }

    public function findAllByPage(int $perpage = 10): LengthAwarePaginator
    {
        $paginator = DB::table('schedules')
        ->leftJoin('teachers','schedules.teacher_id', '=', 'teachers.id')
        ->leftJoin('lessons','schedules.lesson_id', '=', 'lessons.id')
        ->leftJoin('classs', 'schedules.class_id', '=', 'classs.id')
        ->select('schedules.*', 'teachers.name_teacher AS teacher', 'lessons.name_lesson AS lesson', 'classs.name_class AS class')
        
        ->paginate($perpage);

        $days = ['1' => 'Senin', '2' => 'Selasa', '3' => 'Rabu', '4' => 'Kamis', '5' => 'Jumat'];
        foreach($paginator->items() as $item) {
            $item->day = $days[$item->day];
        }

        return $paginator;
    }

    public function findById(int $id): object|null
    {
        return DB::table('schedules')->find($id);
    }

    public function findAll(): array
    {
        return  DB::table('schedules')->get()->toArray();
    }
}
