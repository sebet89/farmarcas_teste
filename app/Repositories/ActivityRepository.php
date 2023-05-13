<?php

namespace App\Repositories;

use App\Models\Activity;
use App\Interfaces\ActivityRepositoryInterface;

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
}
