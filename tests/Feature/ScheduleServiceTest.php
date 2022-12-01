<?php

namespace Tests\Feature;

use App\Services\ScheduleService;
use Database\Seeders\ScheduleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class ScheduleServiceTest extends TestCase
{
    use RefreshDatabase;

    private ScheduleService $scheduleService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->scheduleService = $this->app->make(ScheduleService::class);
    }

    public function testCreateSchedule()
    {
        $this->assertIsInt($this->scheduleService->create([
            'lesson_id' => '1',
            'teacher_id' => '1',
            'class_id' => '1',
            'day' => '1',
            'time' => '11:00-12:00',
            'time_to' => '1-3'
        ]));
    }

    public function testUpdateSchedule()
    {
        $this->seed(ScheduleSeeder::class);

        $this->assertTrue($this->scheduleService->update(1,[
            'lesson_id' => '1',
            'teacher_id' => '1',
            'class_id' => '1',
            'day' => '2',
            'time' => '12:00-14:00',
            'time_to' => '2-4'
        ]));
    }

    public function testDeleteSchedule()
    {
        $this->seed(ScheduleSeeder::class);

        $this->assertTrue($this->scheduleService->delete(1));
    }

    public function testGetAllScheduleWithPaging()
    {
        $this->seed(ScheduleSeeder::class);
        $this->assertInstanceOf(LengthAwarePaginator::class, $this->scheduleService->findAllByPage(10));
    }

    public function testGetScheduleById()
    {
        $this->seed([ScheduleSeeder::class]);

        $schedule = $this->scheduleService->findById(1);

        $this->assertIsObject($schedule);
        $this->assertSame('1-3', $schedule->time_to);
    }

}
