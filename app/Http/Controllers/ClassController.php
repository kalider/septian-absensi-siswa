<?php

namespace App\Http\Controllers;

use App\Services\ClassService;
use App\Services\DepartmentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClassController extends Controller
{
    private ClassService $classService;
    private DepartmentService $departmentService;

    public function __construct(ClassService $classService, DepartmentService $departmentService)
    {
        $this->classService = $classService;
        $this->departmentService = $departmentService;
    }
    
    public function index(Request $request): Response
    {
        $q = $request->input('q');
        $classs = $this->classService->findAllByPage($q);
        return response()->view('class.index', [
            'title' => 'Kelas',
            'classs' => $classs
        ]);
    }

    public function create(Request $request): Response
    {
        $departments = $this->departmentService->FindAll();

        return response()->view('class.create', [
            'title' => 'Tambah Kelas',
            'departments' => $departments
        ]);
    }

    public function doCreate(Request $request): Response|RedirectResponse
    {
        $request->validate([
            'name_class' => 'required',
            'department_id' => 'required',
            'wali_class' => 'required',
        ]);

        $class = [
            'name_class' => $request->input('name_class'),
            'department_id' => $request->input('department_id'),
            'wali_class' => $request->input('wali_class'),
        ];

        if (!$this->classService->create($class)) {
            return response()->view('class.create', [
                'title' => 'Tambah Kelas',
                'error' => 'Tambah Kelas gagal'
            ]);
        }

        $request->session()->flash('success', 'Tambah Kelas berhasil');
        return redirect('/class');
    }

    public function edit(Request $request, int $id): Response|RedirectResponse
    {
        $class = $this->classService->findById($id);

        if (!$class) {
            $request->session()->flash('error', 'Data Kelas tidak ditemukan');
            return redirect('/class');
        }
        $departments = $this->departmentService->FindAll();

        return response()->view('class.edit', [
            'title' => 'Edit Kelas',
            'class' => $class,
            'departments' => $departments,
        ]);
    }

    public function doEdit(Request $request, int $id)
    {
        $request->validate([
            'name_class' => 'required',
            'department_id' => 'required',
            'wali_class' => 'required',
        ]);

        $class = [
            'name_class' => $request->input('name_class'),
            'department_id' => $request->input('department_id'),
            'wali_class' => $request->input('wali_class'),
        ];

        if (!$this->classService->update($id, $class)) {
            return response()->view('class.create', [
                'title' => 'Edit Kelas',
                'error' => 'Edit Kelas gagal'
            ]);
        }

        $request->session()->flash('success', 'Edit Kelas berhasil');
        return redirect('/class');
    }

    public function doDelete(Request $request, int $id): RedirectResponse
    {
        $class = $this->classService->findById($id);

        if (!$class) {
            $request->session()->flash('error', 'Data Kelas tidak ditemukan');
            return redirect('/class');
        }

        if (!$this->classService->delete($id)) {
            $request->session()->flash('error', 'Hapus Kelas gagal');
            return redirect('/class');
        }

        $request->session()->flash('success', 'Hapus Kelas berhasil');
        return redirect('/class');
    }

}
