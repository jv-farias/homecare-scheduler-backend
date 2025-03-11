<?php

namespace App\Jobs;

use App\Models\Attendance;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendWhatsappNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Attendance $attendance;

    public function __construct(Attendance $attendance)
    {
        $this->attendance = $attendance;
    }

    public function handle()
    {
        $userPhone = $this->attendance->phone;
        $lastDigit = (int) substr($userPhone, -1);

        if ($lastDigit % 2 === 0) {
            Log::info("WhatsApp notification sent successfully for protocol {$this->attendance->protocol_number} (requested at {$this->attendance->created_at}).");
        } else {
            Log::error("WhatsApp notification failed for protocol {$this->attendance->protocol_number} (requested at {$this->attendance->created_at}).");
            throw new \Exception("Failed to send WhatsApp notification.");
        }
    }
}
