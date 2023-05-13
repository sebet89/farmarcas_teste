<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Activity;
use App\Models\ActivityType;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityTypeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_many_activities()
    {
        $activityType = ActivityType::factory()->create();

        $activity = Activity::factory()->create([
            'activity_type_id' => $activityType->id,
        ]);

        $this->assertTrue($activityType->activities->contains($activity));
    }
}
