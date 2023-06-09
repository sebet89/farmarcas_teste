<?php

namespace App\Interfaces;
use DateTime;

interface ActivityRepositoryInterface
{
    public function all();

    public function find($id);

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function getActivitiesBetweenDates(DateTime $start, DateTime $end);
}