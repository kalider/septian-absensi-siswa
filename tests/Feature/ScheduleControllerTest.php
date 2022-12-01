<?php

namespace Tests\Feature;

use Database\Seeders\ScheduleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ScheduleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testSchedulePage()
    {
        $this->withSession(['username' => 'aldi'])
        ->get('/schedule')
        ->assertSeeText('Jadwal Mengajar');
    }

    public function testScheduleCreatePost()
    {
        $this->withSession(['username' => 'aldi'])
            ->post('/schedule/create', [
                'lesson_id' => '1',
                'teacher_id' => '1',
                'class_id' => '1',
                'day' => '1',
                'time' => '11:00-12:00',
                'time_to' => '1-3'
            ])
            ->assertRedirect('/schedule')
            ->assertSessionHas('success');
    }

    public function testScheduleEditPost()
    {
        $this->seed(ScheduleSeeder::class);

        $this->withSession(['username' => 'aldi'])
            ->post('/schedule/1/edit', [
                'lesson_id' => '1',
                'teacher_id' => '1',
                'class_id' => '1',
                'day' => '2',
                'time' => '14:00-12:00',
                'time_to' => '1-6'
            ])
            ->assertRedirect('/schedule')
            ->assertSessionHas('success');
    }

    public function testScheduleDelete()
    {
        $this->seed(ScheduleSeeder::class);

        $this->withSession(['username' => 'aldi'])
            ->post('/schedule/1/delete')
            ->assertRedirect('/schedule')
            ->assertSessionHas('success');
    }
}
