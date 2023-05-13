<?php

namespace App\Services;

use App\Interfaces\ActivityRepositoryInterface;

class ActivityService
{
    protected $activityRepository;

    public function __construct(ActivityRepositoryInterface $activityRepository)
    {
        $this->activityRepository = $activityRepository;
    }

    public function getAllActivites()
    {
        return $this->activityRepository->all();
    }

    public function getActivityById($id)
    {
        return $this->activityRepository->find($id);
    }

    public function createActivity(array $data)
    {
        return $this->activityRepository->create($data);
    }

    public function updateActivity(array $data, $id)
    {
        return $this->activityRepository->update($data, $id);
    }

    public function deleteActivity($id)
    {
        return $this->activityRepository->delete($id);
    }
}
