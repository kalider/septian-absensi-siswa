<?php

namespace Tests\Feature;

use App\Services\DepartmentService;
use App\Services\UserService;
use Database\Seeders\DepartmentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class DepartmentServiceTest extends TestCase
{
    use RefreshDatabase;

    private DepartmentService $departmentService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->departmentService = $this->app->make(DepartmentService::class);
    }

    public function testCreateDepartment()
    {
        $this->assertIsInt($this->departmentService->create([
            'kd' => 'J001',
            'name_department' => 'RPL',
            'name_leader_department' => 'maman'
        ]));
    }

    public function testUpdateDepartment()
    {
        $this->seed(DepartmentSeeder::class);

        $this->assertTrue($this->departmentService->update(1,[
            'kd' => 'J002',
            'name_department' => 'RPL',
            'name_leader_department' => 'abah'
        ]));
    }

    public function testDeleteDepartment()
    {
        $this->seed(DepartmentSeeder::class);

        $this->assertTrue($this->departmentService->delete(1));
    }

    public function testGetAllDepartmentWithPaging()
    {
        $this->seed(DepartmentSeeder::class);
        $this->assertInstanceOf(LengthAwarePaginator::class, $this->departmentService->findAllByPage(10));
    }

    public function testGetDepartmentById()
    {
        $this->seed([DepartmentSeeder::class]);

        $department = $this->departmentService->findById(1);

        $this->assertIsObject($department);
        $this->assertSame('J001', $department->kd);
    }

    public function testDepartmentFindAll()
    {
        $this->seed(DepartmentSeeder::class);

        $this->assertIsArray($this->departmentService->findAll());
    }
}
