<?php

namespace Tests\Feature;

use App\Services\PresenceService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PresenceServiceTest extends TestCase
{
    private PresenceService $presenceService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->presenceService = $this->app->make(PresenceService::class);
    }

    public function testPresenceTime()
    {
        $this->assertTrue($this->presenceService->createPresTime('2022-02-01', '1'));
        
        DB::table('presences_times')->truncate();        
    }

    public function testPres()
    {
        $this->assertTrue($this->presenceService->pres([
            ['student_id' => 1, 'time_id' => 1, 'status' => 1],
            ['student_id' => 2, 'time_id' => 2, 'status' => 2],
            ['student_id' => 3, 'time_id' => 3, 'status' => 3],
            ['student_id' => 4, 'time_id' => 4, 'status' => 4],
        ]));

        DB::table('presences')->truncate();
    }

}
