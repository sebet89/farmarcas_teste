<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use App\Repositories\ActivityTypeRepository;
use App\Models\ActivityType;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityTypeRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $activityTypeRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->activityTypeRepository = new ActivityTypeRepository(new ActivityType());
    }

    public function test_can_create_activity_type()
    {
        $data = [
            'name' => 'Test Activity Type',
        ];

        $activityType = $this->activityTypeRepository->create($data);

        $this->assertInstanceOf(ActivityType::class, $activityType);
        $this->assertEquals($data['name'], $activityType->name);
    }

    public function test_can_update_activity_type()
    {
        $activityType = ActivityType::factory()->create();
        $data = [
            'name' => 'Updated Name'
        ];

        $updatedActivityType = $this->activityTypeRepository->update($data, $activityType->id);

        $this->assertEquals($updatedActivityType->id, $activityType->id);
        $this->assertEquals($updatedActivityType->name, "Updated Name");
    }

    public function test_can_delete_activity_type()
    {
        $activityType = ActivityType::factory()->create();
        $activityTypeId = $activityType->id;

        $this->activityTypeRepository->delete($activityTypeId);

        $this->assertDatabaseMissing('activity_types', ['id' => $activityTypeId]);
    }

    public function test_can_find_activity_type()
    {
        $activityType = ActivityType::factory()->create();
        $foundActivityType = $this->activityTypeRepository->find($activityType->id);

        $this->assertInstanceOf(ActivityType::class, $foundActivityType);
        $this->assertEquals($foundActivityType->id, $activityType->id);
    }
}
