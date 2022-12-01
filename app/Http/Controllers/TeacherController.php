<?php

namespace App\Http\Controllers;

use App\Services\TeacherService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TeacherController extends Controller
{
    private TeacherService $teacherService;

    public function __construct(TeacherService $teacherService)
    {
        $this->teacherService = $teacherService;
    }

    public function index(): Response
    {
        $teachers = $this->teacherService->findAllByPage();
        return response()->view('teacher.index', [
            'title' => 'Guru',
            'teachers' => $teachers
        ]);
    }

    public function create(Request $request): Response
    {
        return response()->view('teacher.create', [
            'title' => 'Tambah Guru'
        ]);
    }

    public function doCreate(Request $request): Response|RedirectResponse
    {
        $request->validate([
            'nip' => 'required',
            'name_teacher' => 'required',
        ]);
        $teacher = [
            'nip' => $request->input('nip'),
            'name_teacher' => $request->input('name_teacher'),
        ];

        if (!$this->teacherService->create($teacher)) {
            return response()->view('teacher.create', [
                'title' => 'Tambah Guru',
                'error' => 'Tambah Guru gagal'
            ]);
         }
         $request->session()->flash('success', 'Tambah Guru berhasil');
        return redirect('/teacher');
    }

    public function edit(Request $request, int $id): Response|RedirectResponse
    {
        $teacher = $this->teacherService->findById($id);

        if (!$teacher) {
            $request->session()->flash('error', 'Data Guru tidak ditemukan');
            return redirect('/teacher');
        }

        return response()->view('teacher.edit', [
            'title' => 'Edit Guru',
            'teacher' => $teacher,
        ]);
    }

    public function doEdit(Request $request, int $id)
    {
        $request->validate([
            'nip' => 'required',
            'name_teacher' => 'required',
        ]);

        $teacher = [
            'nip' => $request->input('nip'),
            'name_teacher' => $request->input('name_teacher')
        ];

        if (!$this->teacherService->update($id, $teacher)) {
            return response()->view('teacher.create', [
                'title' => 'Edit Guru',
                'error' => 'Edit Guru gagal'
            ]);
        }

        $request->session()->flash('success', 'Edit Guru berhasil');
        return redirect('/teacher');
    }

    public function doDelete(Request $request, int $id): RedirectResponse
    {
        $teacher = $this->teacherService->findById($id);

        if (!$teacher) {
            $request->session()->flash('error', 'Data Guru tidak ditemukan');
            return redirect('/teacher');
        }

        if (!$this->teacherService->delete($id)) {
            $request->session()->flash('error', 'Hapus Guru gagal');
            return redirect('/teacher');
        }

        $request->session()->flash('success', 'Hapus Guru berhasil');
        return redirect('/teacher');
    }
}
