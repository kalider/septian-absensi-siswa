<?php

namespace App\Services\Impl;

use App\Services\PresenceService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PresenceServiceImpl implements PresenceService
{
    public function createPresTime(string $date, int $schedule_id): bool
    {
        return DB::table('presences_times')->insert(['date' => $date, 'schedule_id' => $schedule_id ,'created_at' => date('Y-m-d H:i:s')]);
    }

    public function getPresTimeByPage(int $perpage = 10): LengthAwarePaginator
    {
        $paginator = DB::table('presences_times')
            ->join('schedules', 'presences_times.schedule_id', '=', 'schedules.id')
            ->leftJoin('teachers', 'schedules.teacher_id', '=', 'teachers.id')
            ->leftJoin('lessons', 'schedules.lesson_id', '=', 'lessons.id')
            ->leftJoin('classs', 'schedules.class_id', '=', 'classs.id')
            ->select('presences_times.*', 'schedules.time_to AS schedule', 'teachers.name_teacher AS teacher', 'lessons.name_lesson AS lesson' ,'classs.name_class AS class')
            ->paginate($perpage);

        return $paginator;
    }

    public function findPresTimeById(int $id): object
    {
        return DB::table('presences_times')
            ->join('schedules', 'presences_times.schedule_id', '=', 'schedules.id')
            ->leftJoin('teachers', 'schedules.teacher_id', '=', 'teachers.id')
            ->leftJoin('lessons', 'schedules.lesson_id', '=', 'lessons.id')
            ->leftJoin('classs', 'schedules.class_id', '=', 'classs.id')
            ->select('presences_times.*', 'schedules.class_id', 'schedules.time_to AS schedule', 'teachers.name_teacher AS teacher' , 'lessons.name_lesson' ,'classs.name_class AS class')
            ->where('presences_times.id', '=', $id)
            ->get()->first();
    }
    
    public function deletePresTimeById(int $id): bool
    {
        return DB::table('presences_times')->delete($id);
    }

    public function updatePresTimeById(int $id, string $date, int $schedule_id): bool
    {
        $data = [
            'updated_at' => date('Y-m-d H:i:s'),
            'date' => $date,
            'schedule_id' => $schedule_id
        ];
        
        return DB::table('presences_times')->where('id', $id)->update($data);
    }

    public function pres(array $items): bool
    {
        DB::beginTransaction();
        try {
            foreach ($items as $item) {
                if (empty($item['pres_id'])) DB::table('presences')->insert([
                    'student_id' => $item['student_id'],
                    'time_id' => $item['time_id'],
                    'status' => $item['status'],
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                else DB::table('presences')->where('id', '=', $item['pres_id'])->update([
                    'student_id' => $item['student_id'],
                    'time_id' => $item['time_id'],
                    'status' => $item['status'],
                    'updated_at' => date('Y-m-d H:i:s')
                ]); 
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function findAllPresWithStudentByTime(int $id, int $class_id): Collection
    {
        return DB::table('students')
            ->leftJoin('presences', function ($join) use ($id) {
                $join->on('presences.student_id', '=', 'students.id')
                    ->where('presences.time_id', '=', $id);
            })
            ->where('students.class_id', '=', $class_id)
            ->select('students.*', 'presences.status', 'presences.id as pres_id')->get();
    }
}
