<?php

namespace App\Repositories;

use App\Models\ActivityType;
use App\Interfaces\ActivityTypeRepositoryInterface;

class ActivityTypeRepository implements ActivityTypeRepositoryInterface
{
    protected $model;

    public function __construct(ActivityType $type)
    {
        $this->model = $type;
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
        $type = $this->model->find($id);
        $type->update($data);
        return $type;
    }

    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }
}
