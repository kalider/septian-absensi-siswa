<?php

namespace Tests\Feature;

use App\Services\ClassService;
use App\Services\UserService;
use Database\Seeders\ClassSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class ClassServiceTest extends TestCase
{
    use RefreshDatabase;

    private ClassService $classService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->classService = $this->app->make(ClassService::class);
    }

    public function testCreateClass()
    {
        $this->assertIsInt($this->classService->create([
            'name_class' => 'X RPL 1',
            'wali_class' => 'Pa Nandang',
            'department_id' => 1
        ]));
    }

    public function testUpdateClass()
    {
        $this->seed(ClassSeeder::class);

        $this->assertTrue($this->classService->update(1, [
            'name_class' => 'X RPL 2',
            'wali_class' => 'Pa Nasrulloh',
            'department_id' => 1
        ]));
    }

    public function testDeleteClass()
    {
        $this->seed(ClassSeeder::class);

        $this->assertTrue($this->classService->delete(1));
    }

    public function testGetAllClassWithPaging()
    {
        $this->seed(ClassSeeder::class);
        $this->assertInstanceOf(LengthAwarePaginator::class, $this->classService->findAllByPage(10));
    }

    public function testGetClassById()
    {
        $this->seed([ClassSeeder::class]);

        $class = $this->classService->findById(1);

        $this->assertIsObject($class);
        $this->assertSame('10 RPL', $class->name_class);
    }
}

