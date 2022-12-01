<?php

namespace Tests\Feature;

use Database\Seeders\LessonSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LessonControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testLessonPage()
    {
        $this->withSession(['username' => 'aldi'])
            ->get('/lesson')
            ->assertSeeText('Mata Pelajaran');

    }

    public function testLessonCreatePost()
    {
        $this->withSession(['username' => 'aldi'])
            ->post('/lesson/create', [
                'kd_lesson' => '021',
                'name_lesson' => 'Bahasa Sunda'
            ])
            ->assertRedirect('/lesson')
            ->assertSessionHas('success');
    }

    public function testLessonEditPost()
    {
        $this->seed(LessonSeeder::class);

        $this->withSession(['username' => 'aldi'])
            ->post('/lesson/1/edit', [
                'kd_lesson' => '025',
                'name_lesson' => 'Mtk 2'
            ])
            ->assertRedirect('/lesson')
            ->assertSessionHas('success');
    }

    public function testLessonDelete()
    {
        $this->seed(LessonSeeder::class);

        $this->withSession(['username' => 'aldi'])
            ->post('/lesson/1/delete')
            ->assertRedirect('/lesson')
            ->assertSessionHas('success');
    }

}
