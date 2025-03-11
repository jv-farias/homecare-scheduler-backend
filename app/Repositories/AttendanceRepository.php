<?php

namespace App\Repositories;

use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceRepository
{
    protected Attendance $model;

    public function __construct(Attendance $attendance)
    {
        $this->model = $attendance;
    }

    public function findAll()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function findById($id)
    {
        $attendance = $this->model->find($id);

        if (!$attendance) {
            throw new \Exception("Attendance with ID {$id} not found.");
        }

        return $attendance;
    }

    public function update(array $data, $id)
    {
        $attendance = $this->model->find($id);

        if (!$attendance) {
            throw new \Exception("Attendance with ID {$id} not found.");
        }
        return $attendance->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}
