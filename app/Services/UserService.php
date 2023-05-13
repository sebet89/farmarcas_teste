<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->all();
    }

    public function getUserById($id)
    {
        return $this->userRepository->find($id);
    }

    public function createUser(array $data)
    {
        return $this->userRepository->create($data);
    }

    public function updateUser(array $data, $id)
    {
        return $this->userRepository->update($data, $id);
    }

    public function deleteUser($id)
    {
        return $this->userRepository->delete($id);
    }
}
