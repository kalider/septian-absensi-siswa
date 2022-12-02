<?php

namespace App\Http\Controllers;

use App\Services\ClassService;
use App\Services\PresenceReportService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PresenceReportController extends Controller
{
    private PresenceReportService $presenceReportService;
    private ClassService $classService;

    public function __construct(PresenceReportService $presenceReportService, ClassService $classService)
    {
        $this->presenceReportService = $presenceReportService;
        $this->classService = $classService;
    }

    public function daily(Request $request): Response
    {
        $allClass = $this->classService->findAll();
        
        $date = $request->input('date') ?? date('Y-m-d');
        $class_id = $request->input('class_id') ?? reset($allClass)->id;
        
        $data = $this->presenceReportService->daily(['date' => $date, 'class_id' => $class_id]);
        
        return response()->view('report.daily', [
            'title' => 'Laporan Harian',
            'data' => $data,
            'allClass' => $allClass
        ]);
    }
}
