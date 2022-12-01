<?php

namespace Tests\Feature;

use Database\Seeders\DepartmentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DepartmentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testDepartmentPage()
    {
        $this->withSession(['username' => 'aldi'])
        ->get('/department')
        ->assertSeeText('Jurusan');
    }

    public function testDepartmentCreatePost()
    {
        $this->withSession(['username' => 'aldi'])
            ->post('/department/create', [
                'kd' => 'J002',
                'name_department' => 'RPL',
                'name_leader_department' => 'abah'
            ])
            ->assertRedirect('/department')
            ->assertSessionHas('success');
    }

    public function testDepartmentEditPost()
    {
        $this->seed(DepartmentSeeder::class);

        $this->withSession(['username' => 'aldi'])
            ->post('/department/1/edit', [
                'kd' => 'J003',
                'name_department' => 'Multi',
                'name_leader_department' => 'Duda'
            ])
            ->assertRedirect('/department')
            ->assertSessionHas('success');
    }

    public function testDepartmentDelete()
    {
        $this->seed(DepartmentSeeder::class);

        $this->withSession(['username' => 'aldi'])
            ->post('/department/1/delete')
            ->assertRedirect('/department')
            ->assertSessionHas('success');
    }

}
