<?php

namespace Tests\Feature;

use Database\Seeders\ClassSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClassControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testClassPage()
    {
        $this->withSession(['username' => 'aldi'])
        ->get('/class')
        ->assertSeeText('Kelas');
    }

    public function testClassCreatePost()
    {
        $this->withSession(['username' => 'aldi'])
            ->post('/class/create', [
                'name_class' => 'XII TKJ',
                'wali_class' => 'Pa SAha',
                'department_id' => 1
            ])
            ->assertRedirect('/class')
            ->assertSessionHas('success');
    }

    public function testClassEditPost()
    {
        $this->seed(ClassSeeder::class);

        $this->withSession(['username' => 'aldi'])
            ->post('/class/1/edit', [
                'name_class' => 'TKRO 5',
                'wali_class' => 'Pa SAha',
                'department_id' => 1
            ])
            ->assertRedirect('/class')
            ->assertSessionHas('success');
    }

    public function testClassDelete()
    {
        $this->seed(ClassSeeder::class);

        $this->withSession(['username' => 'aldi'])
            ->post('/class/1/delete')
            ->assertRedirect('/class')
            ->assertSessionHas('success');
    }

}
