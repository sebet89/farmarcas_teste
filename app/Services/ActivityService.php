<?php

namespace App\Services;

use App\Interfaces\ActivityRepositoryInterface;
use Illuminate\Support\Collection;
use DateTime;
use Exception;

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
        $startDate = new DateTime($data['start_date']);
        $endDate = new DateTime($data['end_date']);

        if ($this->isWeekend($startDate) || $this->isWeekend($endDate)) {
            throw new \Exception('Atividades não podem ser registradas nos finais de semana');
        }

        $overlappingActivities = $this->activityRepository->getActivitiesBetweenDates($startDate, $endDate);

        if ($overlappingActivities->count() > 0) {
            throw new Exception('Já existem atividades programadas para esse período de tempo');
        }

        return $this->activityRepository->create($data);
    }

    public function updateActivity(array $data, $id)
    {
        $startDate = new DateTime($data['start_date']);
        $endDate = new DateTime($data['end_date']);

        if ($this->isWeekend($startDate) || $this->isWeekend($endDate)) {
            throw new Exception('Atividades não podem ser registradas nos finais de semana');
        }

        $overlappingActivities = $this->activityRepository->getActivitiesBetweenDates($startDate, $endDate, $id);

        if ($overlappingActivities->count() > 0) {
            throw new Exception('Já existem atividades programadas para esse período de tempo');
        }

        return $this->activityRepository->update($data, $id);
    }

    public function deleteActivity($id)
    {
        return $this->activityRepository->delete($id);
    }

    public function getActivitiesBetweenDates(DateTime $start, DateTime $end)
    {
        return $this->activityRepository->getActivitiesBetweenDates($start, $end);
    }

    public function isWeekend(DateTime $date): bool
    {
        return $date->format('N') >= 6;
    }
}
