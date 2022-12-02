<?php

namespace App\Services\impl;

use App\Services\PresenceReportService;
use Illuminate\Support\Facades\DB;

class PresenceReportServiceImpl implements PresenceReportService {
    public function daily(array $filters): array
    {
        $sudents = DB::table('students')->where('class_id', '=', $filters['class_id'])->get();
        
        $presences_schedules = DB::table('presences_times')
            ->leftJoin('schedules', 'presences_times.schedule_id', '=', 'schedules.id')
            ->leftJoin('lessons', 'schedules.lesson_id', '=', 'lessons.id')
            ->leftJoin('classs', 'schedules.class_id', '=', 'classs.id')
            ->select(['presences_times.*', 'classs.name_class AS class', 'lessons.kd_lesson AS lesson_code','lessons.name_lesson AS lesson_name'])
            ->where('presences_times.date', '=', $filters['date'])
            ->where('classs.id', '=', $filters['class_id'])
            ->get();

        $presences = DB::table('presences')
            ->select('presences.*')
            ->leftJoin('presences_times', 'presences.time_id', '=', 'presences_times.id')
            ->where('presences_times.date', '=', $filters['date'])
            ->get();

        $sudents = $sudents->map(function($student) use($presences, $presences_schedules) {
            $studentModified = clone $student;

            $statusTexts = [1 => 'H', 'S', 'I', 'A'];
            
            // Mencari data presensi berdasarkan siswa dan jadwal 
            $presencesStudent = [];
            foreach ($presences_schedules as $_schedule) {
                $schedule = clone $_schedule;
                $presence = $presences->where(function($item) use($student, $schedule) {
                    return $item->student_id == $student->id && $item->time_id == $schedule->id;
                })->first();

                $schedule->presence = isset($presence->status) ? $presence->status: 4;
                $schedule->presenceText = $statusTexts[$schedule->presence];
                
                array_push($presencesStudent, $schedule);
            };

            // Menggabungkan status presensi sejenis dan menghitung totalnya
            $presencesGroupByStatus = collect($presencesStudent)->groupBy('presence');
            $presencesGroupByStatus = $presencesGroupByStatus->map(function($group, $status) {
                return (object) [
                    'status' => $status,
                    'total' => $group->count()
                ];
            });

            // Mapping data status presensi ke setiap staus presensi
            $allStatus = collect((object) array_keys($statusTexts));
            $calcStatus = $allStatus->map(function($status) use ($presencesGroupByStatus) {
                $_status = $presencesGroupByStatus->where('status', $status)->first();
                
                return (object) [
                    'status' => $status,
                    'total' => !$_status ? 0: $_status->total
                ];
            });

            // Set data presensi dan total ke object siswa
            $studentModified->presences = $presencesStudent;
            $studentModified->calcStatus = $calcStatus;
            $studentModified->prosentase = count($presencesStudent) == 0 ? 0 :round($calcStatus->where('status', '<=', 3)->sum('total') / count($presencesStudent) *100);
            
            return $studentModified;
        });

        // set untuk response balikan
        $data = [
            'students' => $sudents,
            'schedules' => $presences_schedules
        ];
        
        return $data;   
    }

    public function monthly(array $filters): array
    {
        return [];
    }
}