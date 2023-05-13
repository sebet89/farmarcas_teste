<?php

namespace Tests\Feature\Controllers;

use App\Models\ActivityType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class ActivityTypeControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_user_can_create_activity_type()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $activityTypeData = [
            'name' => $this->faker->word,
        ];

        Sanctum::actingAs($user, ['*']);

        $response = $this->postJson('/api/activity_types', $activityTypeData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('activity_types', $activityTypeData);
    }

    public function test_user_can_update_activity_type()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $activityType = ActivityType::factory()->create();

        $activityTypeData = [
            'name' => $this->faker->word,
        ];

        Sanctum::actingAs($user, ['*']);

        $response = $this->putJson("/api/activity_types/{$activityType->id}", $activityTypeData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('activity_types', $activityTypeData);
    }

    public function test_user_can_delete_activity_type()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $activityType = ActivityType::factory()->create();

        Sanctum::actingAs($user, ['*']);

        $response = $this->deleteJson("/api/activity_types/{$activityType->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('activity_types', ['id' => $activityType->id]);
    }
}