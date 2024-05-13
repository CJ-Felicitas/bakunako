<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\SmsService;
use App\Models\Schedule;
use Carbon\Carbon;

class SendSms extends Command
{
    protected $signature = 'sms:send';
    protected $description = 'Send SMS messages';

    public function handle()
    {
        // Instantiate SmsService
        $smsService = new SmsService();
        $schedules = Schedule::all();
        $current_date = Carbon::now();

        // check the day before the schedule
        foreach ($schedules as $schedule) {
            $schedule_date = Carbon::parse($schedule->date);
            $diff = $current_date->diffInDays($schedule_date);

            if ($diff == 2) {
                $phoneNumbers = [$schedule->infant->user->phone_number];

                $message = 'You have a schedule tomorrow for ' . $schedule->infant->infant_firstname . ' ' . $schedule->infant->infant_lastname . ' at ' . $schedule->time_schedule_start . 'to' . $schedule->time_schedule_end . ' for ' . $schedule->vaccine->vaccine_name . ' vaccine.';

                $smsService->sendSms($phoneNumbers, $message);

            }
        }

        $this->info('SMS messages sent successfully.');
    }
}
