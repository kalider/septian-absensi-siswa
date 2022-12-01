<?php

namespace Tests\Feature;

use App\Services\LessonService;
use Database\Seeders\LessonSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class LessonServiceTest extends TestCase
{
    use RefreshDatabase;

    private LessonService $lessonService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->lessonService = $this->app->make(LessonService::class);
    }

    public function testCreateLesson()
    {
        $this->assertIsInt($this->lessonService->create([
            'kd_lesson' => '023',
            'name_lesson' => 'Bahasa Indonesia',
        ]));
    }

    public function testUpdatelesson()
    {
        $this->seed(LessonSeeder::class);

        $this->assertTrue($this->lessonService->update(1, [
            'kd_lesson' => '023',
            'name_lesson' => 'Bahasa Indonesia',
        ]));
    }

    public function testDeleteClass()
    {
        $this->seed(LessonSeeder::class);

        $this->assertTrue($this->lessonService->delete(1));
    }

    public function testGetAllLessonWithPaging()
    {
        $this->seed(LessonSeeder::class);
        $this->assertInstanceOf(LengthAwarePaginator::class, $this->lessonService->findAllByPage(10));
    }

    public function testGetLessonById()
    {
        $this->seed([LessonSeeder::class]);

        $lesson = $this->lessonService->findById(1);

        $this->assertIsObject($lesson);
        $this->assertSame('021', $lesson->kd_lesson);
    }  
}
