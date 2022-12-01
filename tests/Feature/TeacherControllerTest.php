<?php

namespace Tests\Feature;

use Database\Seeders\TeacherSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeacherControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testTeacherPage()
    {
        $this->withSession(['username' => 'aldi'])
        ->get('/teacher')
        ->assertSeeText('Guru');
    }

    public function testTeacherCreatePost()
    {
        $this->withSession(['username' => 'aldi'])
            ->post('/teacher/create', [
                'nip' => '001',
                'name_teacher' => 'Pa Junaedi'
            ])
            ->assertRedirect('/teacher')
            ->assertSessionHas('success');
    }

    public function testTeacherEditPost()
    {
        $this->seed(TeacherSeeder::class);

        $this->withSession(['username' => 'aldi'])
            ->post('/teacher/1/edit', [
                'nip' => '002',
                'name_teacher' => 'Pa Junaedi 1'
            ])
            ->assertRedirect('/teacher')
            ->assertSessionHas('success');
    }

    public function testTeacherDelete()
    {
        $this->seed(TeacherSeeder::class);

        $this->withSession(['username' => 'aldi'])
            ->post('/teacher/1/delete')
            ->assertRedirect('/teacher')
            ->assertSessionHas('success');
    }

}
