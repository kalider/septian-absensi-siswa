<?php

namespace App\Http\Controllers;

use App\Services\ClassService;
use App\Services\impl\ClassServiceImpl;
use App\Services\LessonService;
use App\Services\ScheduleService;
use App\Services\TeacherService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ScheduleController extends Controller
{
    private ScheduleService $scheduleService;
    private LessonService $lessonService;
    private TeacherService $teacherService;
    private ClassService $classService;

    public function __construct(ScheduleService $scheduleService, LessonService $lessonService, TeacherService $teacherService, ClassService $classService)
    {
        $this->scheduleService = $scheduleService;
        $this->lessonService = $lessonService;
        $this->teacherService = $teacherService;
        $this->classService = $classService;
    }
    
    public function index(): Response
    {
        $schedules = $this->scheduleService->findAllByPage();
        return response()->view('schedule.index', [
            'title' => 'Jadwal Mengajar',
            'schedules' => $schedules
        ]);
    }

    public function create(Request $request): Response
    {
        $lessons = $this->lessonService->findAll();
        $teachers = $this->teacherService->findAll();
        $classs = $this->classService->findAll();
        return response()->view('schedule.create', [
            'title' => 'Tambah Jadwal',
            'lessons' => $lessons,
            'teachers' => $teachers,
            'classs' => $classs,
        ]);
    }

    public function doCreate(Request $request): Response|RedirectResponse
    {
        $request->validate([
            'day' => 'required',
            'lesson_id' => 'required',
            'teacher_id' => 'required',
            'class_id' => 'required',
            'time' => 'required',
            'time_to' => 'required',
        ]);

        $schedule = [
            'day' => $request->input('day'),
            'lesson_id' => $request->input('lesson_id'),
            'teacher_id' => $request->input('teacher_id'),
            'class_id' => $request->input('class_id'),
            'time' => $request->input('time'),
            'time_to' => $request->input('time_to'),
        ];

        if (!$this->scheduleService->create($schedule)) {
            return response()->view('schedule.create', [
                'title' => 'Tambah Jadwal',
                'error' => 'Tambah Jadwal gagal'
            ]);
         }
         $request->session()->flash('success', 'Tambah Jadwal Berhasil');
        return redirect('/schedule');
    }

    public function edit(Request $request, int $id): Response|RedirectResponse
    {
        $schedule = $this->scheduleService->findById($id);

        if (!$schedule) {
            $request->session()->flash('error', 'Data Jadwal tidak ditemukan');
            return redirect('/schedule');
        }
        $lessons = $this->lessonService->findAll();
        $teachers = $this->teacherService->findAll();
        $classs = $this->classService->findAll();
        return response()->view('schedule.edit', [
            'title' => 'Edit Jadwal',
            'schedule' => $schedule,
            'lessons' => $lessons,
            'teachers' => $teachers,
            'classs' => $classs,
        ]);
    }

    public function doEdit(Request $request, int $id)
    {
        $request->validate([
            'day' => 'required',
            'lesson_id' => 'required',
            'teacher_id' => 'required',
            'class_id' => 'required',
            'time' => 'required',
            'time_to' => 'required'
        ]);

        $schedule = [
            'day' => $request->input('day'),
            'lesson_id' => $request->input('lesson_id'),
            'teacher_id' => $request->input('teacher_id'),
            'class_id' => $request->input('class_id'),
            'time' => $request->input('time'),
            'time_to' => $request->input('time_to')
        ];

        if (!$this->scheduleService->update($id, $schedule)) {
            return response()->view('schedule.create', [
                'title' => 'Edit Jadwal',
                'error' => 'Edit Jadwal gagal'
            ]);
        }

        $request->session()->flash('success', 'Edit Jadwal berhasil');
        return redirect('/schedule');
    }

    public function doDelete(Request $request, int $id): RedirectResponse
    {
        $schedule = $this->scheduleService->findById($id);

        if (!$schedule) {
            $request->session()->flash('error', 'Data Jadwal tidak ditemukan');
            return redirect('/schedule');
        }

        if (!$this->scheduleService->delete($id)) {
            $request->session()->flash('error', 'Hapus Jadwal gagal');
            return redirect('/schedule');
        }

        $request->session()->flash('success', 'Hapus Jadwal berhasil');
        return redirect('/schedule');
    }
}
