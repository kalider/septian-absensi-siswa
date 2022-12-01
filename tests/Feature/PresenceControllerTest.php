<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PresenceControllerTest extends TestCase
{
    public function testPresencePage()
    {
        $response = $this
            ->withSession([
                'username' => 'aldi'
            ])
            ->get('/presence');

        $response->assertStatus(200)->assertSeeText('Presensi');
    }

    public function testPresTimeCreatePage()
    {
        $this
            ->withSession(['username' => 'aldi'])
            ->get('/presence/create')
            ->assertStatus(200)
            ->assertSeeText('Tambah Presensi');
    }

    public function testPresTimeCreatePost()
    {
        $this
            ->withSession(['username' => 'aldi'])
            ->post('/presence/create', [
                'date' => '2022-09-11',
                'schedule_id' => '1'
            ])
            ->assertRedirect('/presence')
            ->assertSessionHas('success');
    }

}
