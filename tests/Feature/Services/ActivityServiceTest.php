<?php

namespace Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use App\Services\ActivityService;
use App\Interfaces\ActivityRepositoryInterface;
use App\Models\Activity;

class ActivityServiceTest extends TestCase
{
    protected $mockActivityRepo;
    protected $activityService;
    protected $activity;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockActivityRepo = $this->createMock(ActivityRepositoryInterface::class);
        $this->activityService = new ActivityService($this->mockActivityRepo);
        $this->activity = $this->createMock(Activity::class);
    }

    public function test_can_create_activity()
    {
        $this->mockActivityRepo->method('create')->willReturn(new Activity());

        $activity = $this->activityService->createActivity([]);

        $this->assertInstanceOf(Activity::class, $activity);
    }

    public function test_can_update_activity()
    {
        $this->mockActivityRepo->expects($this->once())
            ->method('update')
            ->willReturn($this->activity);

        $activity = $this->activityService->updateActivity([], 1);

        $this->assertSame($this->activity, $activity);
    }

    public function test_can_delete_activity()
    {
        $this->mockActivityRepo->method('delete')->willReturn(true);

        $result = $this->activityService->deleteActivity(1);

        $this->assertTrue($result);
    }

    public function test_can_find_activity()
    {
        $this->mockActivityRepo->method('find')->willReturn(new Activity());

        $activity = $this->activityService->getActivityById(1);

        $this->assertInstanceOf(Activity::class, $activity);
    }
}