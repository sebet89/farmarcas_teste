<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use App\Repositories\ActivityRepository;
use App\Models\Activity;
use App\Models\User;
use App\Models\ActivityType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;

class ActivityRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $activityRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->activityRepository = new ActivityRepository(new Activity());
    }

    public function test_can_create_activity()
    {
        $user = User::factory()->create();
        $activityType = ActivityType::factory()->create();

        $data = [
            'user_id' => $user->id,
            'activity_type_id' => $activityType->id,
            'title' => 'Test Activity',
            'description' => 'Test Activity Description',
            'start_date' => Carbon::now()->toDateTimeString(),
            'due_date' => Carbon::now()->addDays(2)->toDateTimeString(),
            'status' => 'open',
        ];

        $activity = $this->activityRepository->create($data);

        $this->assertInstanceOf(Activity::class, $activity);
        $this->assertEquals($data['title'], $activity->title);
        $this->assertEquals($data['description'], $activity->description);
    }

    public function test_can_update_activity()
    {
        $activity = Activity::factory()->create();

        $data = [
            'title' => 'Updated Title',
            'description' => 'updated description'
        ];

        $updatedActivity = $this->activityRepository->update($data, $activity->id);

        $this->assertEquals($updatedActivity->title, 'Updated Title');
        $this->assertEquals($updatedActivity->description, 'updated description');
    }

    public function test_can_delete_activity()
    {
        $activity = Activity::factory()->create();
        $activityId = $activity->id;

        $this->activityRepository->delete($activityId);

        $this->assertDatabaseMissing('activities', ['id' => $activityId]);
    }

    public function test_can_find_activity()
    {
        $activity = Activity::factory()->create();
        $foundActivity = $this->activityRepository->find($activity->id);

        $this->assertInstanceOf(Activity::class, $foundActivity);
        $this->assertEquals($foundActivity->id, $activity->id);
    }
}
