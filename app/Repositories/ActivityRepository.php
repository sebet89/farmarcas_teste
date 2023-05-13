<?php

namespace App\Repositories;

use App\Models\Activity;
use App\Interfaces\ActivityRepositoryInterface;
use DateTime;

class ActivityRepository implements ActivityRepositoryInterface
{
    protected $model;

    public function __construct(Activity $activity)
    {
        $this->model = $activity;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        $activity = $this->model->find($id);
        $activity->update($data);
        return $activity;
    }

    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }

    public function getActivitiesBetweenDates(DateTime $start, DateTime $end, $excludeId = null)
    {
        $query = $this->model->whereBetween('start_date', [$start, $end])
                         ->orWhereBetween('due_date', [$start, $end]);

        if ($excludeId) {
            $query = $query->where('id', '!=', $excludeId);
        }

        return $query->get();
    }
}
