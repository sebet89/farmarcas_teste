<?php

namespace Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use App\Services\ActivityTypeService;
use App\Interfaces\ActivityTypeRepositoryInterface;
use App\Models\ActivityType;

class ActivityTypeServiceTest extends TestCase
{
    protected $mockActivityTypeRepo;
    protected $activityTypeService;
    protected $activityType;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockActivityTypeRepo = $this->createMock(ActivityTypeRepositoryInterface::class);
        $this->activityTypeService = new ActivityTypeService($this->mockActivityTypeRepo);
        $this->activityType = $this->createMock(ActivityType::class);
    }

    public function test_can_create_activity_type()
    {
        $this->mockActivityTypeRepo->method('create')->willReturn(new ActivityType());

        $activityType = $this->activityTypeService->createType([]);

        $this->assertInstanceOf(ActivityType::class, $activityType);
    }

    public function test_can_update_activity_type()
    {
        $this->mockActivityTypeRepo->expects($this->once())
            ->method('update')
            ->willReturn($this->activityType);

        $activityType = $this->activityTypeService->updateType([], 1);

        $this->assertSame($this->activityType, $activityType);
    }

    public function test_can_delete_activity_type()
    {
        $this->mockActivityTypeRepo->method('delete')->willReturn(true);

        $result = $this->activityTypeService->deleteType(1);

        $this->assertTrue($result);
    }

    public function test_can_find_activity_type()
    {
        $this->mockActivityTypeRepo->expects($this->once())
            ->method('find')
            ->willReturn($this->activityType);

        $activityType = $this->activityTypeService->getTypeById(1);

        $this->assertSame($this->activityType, $activityType);
    }
}