<?php

namespace App\Services;

use App\Interfaces\ActivityTypeRepositoryInterface;

class ActivityTypeService
{
    protected $typeRepository;

    public function __construct(ActivityTypeRepositoryInterface $typeRepository)
    {
        $this->typeRepository = $typeRepository;
    }

    public function getAllTypes()
    {
        return $this->typeRepository->all();
    }

    public function getTypeById($id)
    {
        return $this->typeRepository->find($id);
    }

    public function createType(array $data)
    {
        return $this->typeRepository->create($data);
    }

    public function updateType(array $data, $id)
    {
        return $this->typeRepository->update($data, $id);
    }

    public function deleteType($id)
    {
        return $this->typeRepository->delete($id);
    }
}
