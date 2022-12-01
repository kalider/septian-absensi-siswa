<?php

namespace App\Http\Controllers;

use App\Services\DepartmentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;

class DepartmentController extends Controller
{
    private DepartmentService $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }
    
    public function index(): Response
    {
        $departments = $this->departmentService->findAllByPage();
        return response()->view('department.index', [
            'title' => 'Jurusan',
            'departments' => $departments
        ]);
    }

    public function create(Request $request): Response
    {
        return response()->view('department.create', [
            'title' => 'Tambah Jurusan'
        ]);
    }

    public function doCreate(Request $request): Response|RedirectResponse
    {
        $request->validate([
            'kd' => 'required',
            'name_department' => 'required',
            'name_leader_department' => 'required',
        ]);

        $department = [
            'kd' => $request->input('kd'),
            'name_department' => $request->input('name_department'),
            'name_leader_department' => $request->input('name_leader_department'),
        ];

        if (!$this->departmentService->create($department)) {
            return response()->view('department.create', [
                'title' => 'Tambah Jurusan',
                'error' => 'Tambah Jurusan gagal'
            ]);
         }
         $request->session()->flash('success', 'Tambah Jurusan Berhasil');
        return redirect('/department');
    }

    public function edit(Request $request, int $id): Response|RedirectResponse
    {
        $department = $this->departmentService->findById($id);

        if (!$department) {
            $request->session()->flash('error', 'Data Jurusan tidak ditemukan');
            return redirect('/department');
        }

        return response()->view('department.edit', [
            'title' => 'Edit Jurusan',
            'department' => $department
        ]);
    }

    public function doEdit(Request $request, int $id)
    {
        $request->validate([
            'kd' => 'required',
            'name_department' => 'required',
            'name_leader_department' => 'required',
        ]);

        $department = [
            'kd' => $request->input('kd'),
            'name_department' => $request->input('name_department'),
            'name_leader_department' => $request->input('name_leader_department'),
        ];

        if (!$this->departmentService->update($id, $department)) {
            return response()->view('department.create', [
                'title' => 'Edit Jurusan',
                'error' => 'Edit Jurusan gagal'
            ]);
        }

        $request->session()->flash('success', 'Edit Jurusan berhasil');
        return redirect('/department');
    }

    public function doDelete(Request $request, int $id): RedirectResponse
    {
        $department = $this->departmentService->findById($id);

        if (!$department) {
            $request->session()->flash('error', 'Data Jurusan tidak ditemukan');
            return redirect('/department');
        }

        if (!$this->departmentService->delete($id)) {
            $request->session()->flash('error', 'Hapus Jurusan gagal');
            return redirect('/department');
        }

        $request->session()->flash('success', 'Hapus Jurusan berhasil');
        return redirect('/department');
    }

}
