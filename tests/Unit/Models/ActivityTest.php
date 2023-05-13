<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use App\Models\Activity;
use App\Models\ActivityType;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();

        $activity = Activity::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->assertEquals($user->id, $activity->user->id);
    }

    /** @test */
    public function it_belongs_to_an_activity_type()
    {
        $activityType = ActivityType::factory()->create();

        $activity = Activity::factory()->create([
            'activity_type_id' => $activityType->id,
        ]);

        $this->assertEquals($activityType->id, $activity->activityType->id);
    }
}
