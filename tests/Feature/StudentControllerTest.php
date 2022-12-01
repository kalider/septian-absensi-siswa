<?php

namespace Tests\Feature;

use Database\Seeders\StudentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testStudentPage()
    {
        $this->withSession(['username' => 'aldi'])
            ->get('/student')
            ->assertSeeText('Siswa');

    }

    public function testStudentCreatePost()
    {
        $this->withSession(['username' => 'aldi'])
            ->post('/student/create', [
                'nis' => '12345678',
                'name' => 'Renaldy',
                'dob' => '2005-09-01',
                'pob' => 'Tasikmalaya',
                'gender' => '1',
                'class_id' => 1
            ])
            ->assertRedirect('/student')
            ->assertSessionHas('success');
    }

    public function testStudentEditPost()
    {
        $this->seed(StudentSeeder::class);

        $this->withSession(['username' => 'aldi'])
            ->post('/student/1/edit', [
                'nis' => '12345678',
                'name' => 'Renaldy 1',
                'dob' => '2005-09-01',
                'pob' => 'Tasikmalaya',
                'gender' => '1',
                'class_id' => 1
            ])
            ->assertRedirect('/student')
            ->assertSessionHas('success');
    }

    public function testStudentDelete()
    {
        $this->seed(StudentSeeder::class);

        $this->withSession(['username' => 'aldi'])
            ->post('/student/1/delete')
            ->assertRedirect('/student')
            ->assertSessionHas('success');
    }

}
