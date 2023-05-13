<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use App\Repositories\ActivityRepository;
use App\Models\Activity;
use App\Models\User;
use App\Models\ActivityType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;
use DateTime;

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

    public function test_can_get_activities_between_dates()
    {
        $user = User::factory()->create();
        $activityType = ActivityType::factory()->create();

        $startDate = new DateTime("2023-09-18");
        $endDate = new DateTime("2023-09-26");

        $activity1 = Activity::factory()->create([
            'user_id' => $user->id,
            'activity_type_id' => $activityType->id,
            'start_date' => "2023-09-18",
            'due_date' => "2023-09-21",
            'end_date' => "2023-09-22",
        ]);

        $activity2 = Activity::factory()->create([
            'user_id' => $user->id,
            'activity_type_id' => $activityType->id,
            'start_date' => "2023-09-21",
            'due_date' => "2023-09-22",
            'end_date' => "2023-09-25",
        ]);

        $activities = $this->activityRepository->getActivitiesBetweenDates($startDate, $endDate);

        $this->assertCount(2, $activities);
        $this->assertEquals($activity1->id, $activities[0]->id);
        $this->assertEquals($activity2->id, $activities[1]->id);
    }
}
