<?php

namespace Tests\Feature;

use App\Services\TeacherService;
use Database\Seeders\TeacherSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class TeacherServiceTest extends TestCase
{
    use RefreshDatabase;

    private TeacherService $teacherService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->teacherService = $this->app->make(TeacherService::class);
    }

    public function testCreateTeacher()
    {
        $this->assertIsInt($this->teacherService->create([
            'nip' => '001',
            'name_teacher' => 'X RPL 1',
        ]));
    }

    public function testUpdateTeacher()
    {
        $this->seed(TeacherSeeder::class);

        $this->assertTrue($this->teacherService->update(1, [
            'nip' => '001',
            'name_teacher' => 'Pa Nasrulloh',
        ]));
    }

    public function testDeleteTeacher()
    {
        $this->seed(TeacherSeeder::class);

        $this->assertTrue($this->teacherService->delete(1));
    }

    public function testGetAllTeacherWithPaging()
    {
        $this->seed(TeacherSeeder::class);
        $this->assertInstanceOf(LengthAwarePaginator::class, $this->teacherService->findAllByPage(10));
    }

    public function testGetTeacherById()
    {
        $this->seed([TeacherSeeder::class]);

        $teacher = $this->teacherService->findById(1);

        $this->assertIsObject($teacher);
        $this->assertSame('001', $teacher->nip);
    }
}
