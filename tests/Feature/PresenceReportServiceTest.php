<?php

namespace Tests\Feature;

use App\Services\PresenceReportService;
use Database\Seeders\ClassSeeder;
use Database\Seeders\LessonSeeder;
use Database\Seeders\PresenceSeeder;
use Database\Seeders\ScheduleSeeder;
use Database\Seeders\StudentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;
use Tests\TestCase;

class PresenceReportServiceTest extends TestCase
{
    use RefreshDatabase;

    private PresenceReportService $presenceReportService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->presenceReportService = $this->app->make(PresenceReportService::class);
    }

    public function testDailyReport()
    {
        $this->seed([StudentSeeder::class, ClassSeeder::class, LessonSeeder::class, ScheduleSeeder::class, PresenceSeeder::class]);

        $data = $this->presenceReportService->daily(['date' => '2022-12-01', 'class_id' =>  1]);

        $this->assertIsArray($data);
        $this->assertArrayHasKey('students', $data);
        $this->assertArrayHasKey('schedules', $data);
        
        $this->assertInstanceOf(Collection::class, $data['students']);
    }
}
