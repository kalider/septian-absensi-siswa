<?php

namespace Tests\Feature;

use App\Services\UserService;
use App\Services\StudentService;
use Database\Seeders\StudentSeeder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StudentServiceTest extends TestCase
{
    use RefreshDatabase;

    private StudentService $studentService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->studentService = $this->app->make(StudentService::class);
    }

    public function testCreateStudent()
    {
        $this->assertIsInt($this->studentService->create([
            'nis' => '10607056',
            'name' => 'Septiana Renaldy',
            'class_id' => 1,
            'dob' => '2005-09-01',
            'pob' => 'Tasikmalaya',
            'gender' => '1'
        ]));
    }

    public function testUpdateStudent()
    {
        $this->seed(StudentSeeder::class);

        $this->assertTrue($this->studentService->update(1, [
            'nis' => '09009990',
            'name' => 'Septiana Renaldy 1',
            'class_id' => 1,
            'dob' => '2005-08-02',
            'pob' => 'Tasikmalaya 2',
            'gender' => '2'
        ]));
    }

    public function testDeleteStudent()
    {
        $this->seed(StudentSeeder::class);

        $this->assertTrue($this->studentService->delete(1));
    }

    public function testGetAllStudentWithPaging()
    {
        $this->seed(StudentSeeder::class);
        $this->assertInstanceOf(LengthAwarePaginator::class, $this->studentService->findAllByPage(10));
    }

    public function testGetStudentById()
    {
        $this->seed([StudentSeeder::class]);

        $student = $this->studentService->findById(1);

        $this->assertIsObject($student);
        $this->assertSame('Septian', $student->name);
    }

    public function testStudentFindAll()
    {
        $this->seed(StudentSeeder::class);

        $this->assertInstanceOf(Collection::class, $this->studentService->FindAll());
    }

    public function testStudentUploadPhoto()
    {
        $uploadedFile = UploadedFile::fake()->image('photo.jpg');
        $path = $this->studentService->storePhoto($uploadedFile);

        $this->assertTrue(Storage::disk('local')->exists($path));
    }

}
