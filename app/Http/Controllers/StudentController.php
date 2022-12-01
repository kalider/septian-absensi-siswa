<?php

namespace App\Http\Controllers;

use App\Services\ClassService;
use App\Services\StudentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;

class StudentController extends Controller
{
    private StudentService $studentService;
    private ClassService $classService;

    public function __construct(StudentService $studentService, ClassService $classService)
    {
        $this->studentService = $studentService;
        $this->classService = $classService;
    }

    public function index(Request $request): Response
    {
        $q = $request->input('q');
        $students = $this->studentService->findAllByPage($q);
        return response()->view('student.index', [
            'title' => 'Siswa',
            'students' => $students
        ]);
    }

    public function create(Request $request): Response
    {
        $classs = $this->classService->findAll();

        return response()->view('student.create', [
            'title' => 'Tambah Siswa',
            'classs' => $classs
        ]);
    }

    public function doCreate(Request $request): Response|RedirectResponse
    {
        $request->validate([
            'nis' => 'required|unique:students,nis',
            'name' => 'required',
            'class_id'=> 'required',
            'dob' => 'required',
            'pob' => 'required',
            'gender' => 'required',
        ]);

        $student = [
            'nis' => $request->input('nis'),
            'name' => $request->input('name'),
            'class_id' => $request->input('class_id'),
            'dob' => $request->input('dob'),
            'pob' => $request->input('pob'),
            'gender' => $request->input('gender'),
        ];

        if ($path = $this->studentService->storePhoto($request->file('photo'))) {
            $student['photo'] = $path;
        }

        if (!$this->studentService->create($student)) {
            return response()->view('student.create', [
                'title' => 'Tambah Siswa',
                'error' => 'Tambah Siswa gagal'
            ]);
         }
         $request->session()->flash('success', 'Tambah siswa berhasil');
        return redirect('/student');
    }

    public function edit(Request $request, int $id): Response|RedirectResponse
    {
        $student = $this->studentService->findById($id);

        if (!$student) {
            $request->session()->flash('error', 'Data Siswa tidak ditemukan');
            return redirect('/student');
        }
        $classs = $this->classService->findAll();

        return response()->view('student.edit', [
            'title' => 'Edit Siswa',
            'student' => $student,
            'classs' => $classs,
        ]);
    }

    public function doEdit(Request $request, int $id)
    {
        $request->validate([
            'nis' => 'required|unique:students,nis',
            'name' => 'required',
            'class_id'=> 'required',
            'dob' => 'required',
            'pob' => 'required',
            'gender' => 'required',
        ]);

        $student = [
            'nis' => $request->input('nis'),
            'name' => $request->input('name'),
            'class_id' => $request->input('class_id'),
            'dob' => $request->input('dob'),
            'pob' => $request->input('pob'),
            'gender' => $request->input('gender'),
        ];

        if ($path = $this->studentService->storePhoto($request->file('photo'))) {
            $student['photo'] = $path;
        }
        
        if (!$this->studentService->update($id, $student)) {
            return response()->view('student.create', [
                'title' => 'Edit Siswa',
                'error' => 'Edit Siswa gagal'
            ]);
        }

        $request->session()->flash('success', 'Edit Siswa berhasil');
        return redirect('/student');
    }

    public function doDelete(Request $request, int $id): RedirectResponse
    {
        $student = $this->studentService->findById($id);

        if (!$student) {
            $request->session()->flash('error', 'Data Siswa tidak ditemukan');
            return redirect('/student');
        }

        if (!$this->studentService->delete($id)) {
            $request->session()->flash('error', 'Hapus Siswa gagal');
            return redirect('/student');
        }

        $request->session()->flash('success', 'Hapus Siswa berhasil');
        return redirect('/student');
    }

}
