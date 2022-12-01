<?php

namespace App\Http\Controllers;


use App\Services\PresenceService;
use App\Services\ScheduleService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PresenceController extends Controller
{
    private PresenceService $presenceService;
    private ScheduleService $scheduleService;

    public function __construct(PresenceService $presenceService,scheduleService $scheduleService)
    {
        $this->presenceService = $presenceService;
        $this->scheduleService = $scheduleService;
    }

    public function index(Request $request): Response
    {
        return response()->view('presence.index', [
            'title' => 'Presensi',
            'pres_times' => $this->presenceService->getPresTimeByPage()
        ]);
    }

    public function create(Request $request): Response
    {
        $schedules = $this->scheduleService->findAll();
        return response()->view('presence.create', [
            'title' => 'Tambah Presensi',
            'schedules' => $schedules,
        ]);
    }

    public function doCreate(Request $request): Response|RedirectResponse
    {
        $request->validate([
            'date' => 'required',
            'schedule_id' => 'required',
        ]);

        if (!$this->presenceService->createPresTime($request->input('date'), $request->input('schedule_id'))) {
            return response()->view('presence.create', [
                'title' => 'Tambah Presensi',
                'error' => 'Tambah Presensi gagal'
            ]);
        }

        $request->session()->flash('success', 'Tambah Presensi berhasil');
        return redirect('/presence');
    }

    public function edit(Request $request, int $id): Response|RedirectResponse
    {
        $presence = $this->presenceService->findPresTimeById($id);
        
        if (!$presence) {
            $request->session()->flash('error', 'Data Presensi tidak ditemukan');
            return redirect('/presence');
        }

        $schedules = $this->scheduleService->findAll();

        return response()->view('presence.edit', [
            'title' => 'Edit Presensi',
            'presence' => $presence,
            'schedules' => $schedules
        ]);
    }

    public function doEdit(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'date' => 'required',
            'schedule_id' => 'required',
        ]);

        if (!$this->presenceService->updatePresTimeById($id, $request->input('date'), $request->input('schedule_id'))) {
            return response()->view('presence.create', [
                'title' => 'Edit Presensi',
                'error' => 'Edit Presensi gagal'
            ]);
        }

        $request->session()->flash('success', 'Edit Presensi berhasil');
        return redirect('/presence');
    }

    public function doDelete(Request $request, int $id): RedirectResponse
    {
        $student = $this->presenceService->findPresTimeById($id);

        if (!$student) {
            $request->session()->flash('error', 'Data Presensi tidak ditemukan');
            return redirect('/presence');
        }

        if (!$this->presenceService->deletePresTimeById($id)) {
            $request->session()->flash('error', 'Hapus Presensi gagal');
            return redirect('/presence');
        }

        $request->session()->flash('success', 'Hapus Presensi berhasil');
        return redirect('/presence');
    }

    public function pres(Request $request, int $id): Response
    {
        $presence = $this->presenceService->findPresTimeById($id);
        $students = $this->presenceService->findAllPresWithStudentByTime($id, $presence->schedule_id);

        return response()->view('presence.pres', [
            'title' => 'Presensi',
            'presence' => $presence,
            'students' => $students
        ]);
    }

    public function doPres(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'press' => 'required',
        ]);

        $items = [];
        foreach($request->input('press') as $student_id => $pres) array_push($items, [
            'student_id' => $student_id,
            'time_id' => $id,
            'status' => $pres['status'],
            'pres_id' => $pres['pres_id']
        ]);

        if (!$this->presenceService->pres($items)) {
            return response()->view('presence.Pres', [
                'title' => 'Presensi',
                'error' => 'Presensi gagal'
            ]);
        }

        $request->session()->flash('success', 'Presensi berhasil');
        return redirect("/presence/{$id}/pres");
    }

}
