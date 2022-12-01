<?php

namespace App\Http\Controllers;

use App\Services\LessonService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LessonController extends Controller
{
    private LessonService $lessonService;

    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
    }

    public function index(): Response
    {
        $lessons = $this->lessonService->findAllByPage();
        return response()->view('lesson.index', [
            'title' => 'Mata Pelajaran',
            'lessons' => $lessons
        ]);
    }

    public function create(Request $request): Response
    {
        return response()->view('lesson.create', [
            'title' => 'Tambah Mata Pelajaran'
        ]);
    }

    public function doCreate(Request $request): Response|RedirectResponse
    {
        $request->validate([
            'kd_lesson' => 'required',
            'name_lesson' => 'required',
        ]);
        $lesson = [
            'kd_lesson' => $request->input('kd_lesson'),
            'name_lesson' => $request->input('name_lesson'),
        ];

        if (!$this->lessonService->create($lesson)) {
            return response()->view('lesson.create', [
                'title' => 'Tambah Mata Pelajaran',
                'error' => 'Tambah Mata Pelajaran gagal'
            ]);
         }
         $request->session()->flash('success', 'Tambah Mata Pelajaran berhasil');
        return redirect('/lesson');
    }

    public function edit(Request $request, int $id): Response|RedirectResponse
    {
        $lesson = $this->lessonService->findById($id);

        if (!$lesson) {
            $request->session()->flash('error', 'Data Mata Pelajaran tidak ditemukan');
            return redirect('/lesson');
        }

        return response()->view('lesson.edit', [
            'title' => 'Edit Mata Pelajaran',
            'lesson' => $lesson,
        ]);
    }

    public function doEdit(Request $request, int $id)
    {
        $request->validate([
            'kd_lesson' => 'required',
            'name_lesson' => 'required',
        ]);

        $lesson = [
            'kd_lesson' => $request->input('kd_lesson'),
            'name_lesson' => $request->input('name_lesson'),
        ];

        if (!$this->lessonService->update($id, $lesson)) {
            return response()->view('lesson.create', [
                'title' => 'Edit Mata Pelajaran',
                'error' => 'Edit Mata Pelajaran gagal'
            ]);
        }

        $request->session()->flash('success', 'Edit Mata Pelajaran berhasil');
        return redirect('/lesson');
    }

    public function doDelete(Request $request, int $id): RedirectResponse
    {
        $lesson = $this->lessonService->findById($id);

        if (!$lesson) {
            $request->session()->flash('error', 'Data Mata Pelajaran tidak ditemukan');
            return redirect('/lesson');
        }

        if (!$this->lessonService->delete($id)) {
            $request->session()->flash('error', 'Hapus Mata Pelajaran gagal');
            return redirect('/lesson');
        }

        $request->session()->flash('success', 'Hapus Mata Pelajaran berhasil');
        return redirect('/lesson');
    }
}
