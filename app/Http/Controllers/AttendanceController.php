<?php

namespace App\Http\Controllers;

use App\Http\Requests\Attendance\CreateAttendanceRequest;
use App\Http\Requests\Attendance\UpdateAttendanceRequest;
use App\Http\Traits\ApiResponserTrait;
use App\Services\AttendanceService;

class AttendanceController extends Controller
{
    use ApiResponserTrait;

    protected AttendanceService $service;

    public function __construct(AttendanceService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            $attendances = $this->service->findAll();
            return $this->successResponse($attendances);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function store(CreateAttendanceRequest $request)
    {
        try {
            $attendance = $this->service->create($request->all());
            return $this->createdResponse($attendance);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $attendance = $this->service->show($id);
            return $this->successResponse($attendance);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function update(UpdateAttendanceRequest $request, $id)
    {
        try {
            $attendance = $this->service->update($request->all(), $id);
            return $this->successResponse($attendance);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function metrics()
    {
        try {
            $metrics = $this->service->getMetrics();
            return $this->successResponse($metrics);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $attendance = $this->service->delete($id);
            return $this->successResponse($attendance);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}
