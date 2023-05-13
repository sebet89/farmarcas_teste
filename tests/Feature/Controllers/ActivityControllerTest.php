<?php

namespace Tests\Feature\Controllers;

use App\Models\Activity;
use App\Models\ActivityType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Carbon\Carbon;
use Laravel\Sanctum\Sanctum;

class ActivityControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_user_can_create_activity()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');
        
        $activityType = ActivityType::factory()->create();

        $activityData = [
            'title' => $this->faker->sentence,
            'user_id' => $user->id,
            'description' => $this->faker->paragraph,
            'start_date' => "2023-09-18",
            'due_date' => "2023-09-21",
            'end_date' => "2023-09-22",
            'status' => 'open',
            'activity_type_id' => $activityType->id,
        ];

        Sanctum::actingAs($user, ['*']);

        $response = $this->postJson('/api/activities', $activityData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('activities', $activityData);
    }

    public function test_user_can_update_activity()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');
        
        $activity = Activity::factory()->create(['user_id' => $user->id]);

        $activityData = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'start_date' => "2023-09-18",
            'due_date' => "2023-09-21",
            'end_date' => "2023-09-22",
            'status' => 'completed',
        ];

        Sanctum::actingAs($user, ['*']);

        $response = $this->putJson("/api/activities/{$activity->id}", $activityData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('activities', $activityData);
    }

    public function test_user_can_delete_activity()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $activity = Activity::factory()->create(['user_id' => $user->id]);

        Sanctum::actingAs($user, ['*']);

        $response = $this->deleteJson("/api/activities/{$activity->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('activities', ['id' => $activity->id]);
    }

    public function test_user_can_get_activities_between_dates()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');
        
        $activity = Activity::factory()->create(['user_id' => $user->id]);

        $startDate = Carbon::now()->toDateTimeString();
        $endDate = Carbon::now()->addDays(2)->toDateTimeString();

        Sanctum::actingAs($user, ['*']);

        $response = $this->getJson("/api/activities?start_date={$startDate}&end_date={$endDate}");

        $response->assertStatus(200);
        $response->assertJsonCount(1);
    }
}