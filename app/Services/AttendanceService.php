<?php

namespace App\Services;

use App\Jobs\SendWhatsappNotificationJob;
use App\Repositories\AttendanceRepository;

class AttendanceService
{

    protected AttendanceRepository $repository;

    public function __construct(AttendanceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

    public function create(array $data)
    {
        $attendance = $this->repository->create($data);

        $protocolNumber = $this->generateProtocolNumber($attendance);
        $this->repository->update(['protocol_number' => $protocolNumber], $attendance->id);

        return $this->repository->findById($attendance->id);
    }

    public function show($id)
    {
        return $this->repository->findById($id);
    }

    public function update(array $data, $id)
    {
        $currentAttendance = $this->repository->findById($id);

        if (
            $currentAttendance->status === 'completed' &&
            isset($data['status']) &&
            $data['status'] !== 'completed'
        ) {
            throw new \Exception("Atendimento já foi finalizado e não pode ter seu status alterado.");
        }

        $this->repository->update($data, $id);
        $attendance = $this->repository->findById($id);

        if (isset($data['status']) && $data['status'] === 'completed' && $currentAttendance->status !== 'completed') {
            SendWhatsappNotificationJob::dispatch($attendance);
        }

        return $attendance;
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    public function getMetrics()
    {
        $totalAttendances = $this->repository->findAll()->count();
        $totalCompletedAttendances = $this->repository->findAll()->where('status', 'completed')->count();
        $totalPendingAttendances = $this->repository->findAll()->where('status', 'pending')->count();
        $totalCanceledAttendances = $this->repository->findAll()->where('status', 'canceled')->count();

        return [
            'total_attendances' => $totalAttendances,
            'total_completed_attendances' => $totalCompletedAttendances,
            'total_pending_attendances' => $totalPendingAttendances,
            'total_canceled_attendances' => $totalCanceledAttendances,
        ];
    }


    private function generateProtocolNumber($attendance): string
    {
        return $attendance->created_at->format('YmdHis') . random_int(100, 999);
    }
}
