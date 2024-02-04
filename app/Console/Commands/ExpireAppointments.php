<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use App\Models\AppointmentStatus;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ExpireAppointments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointments:expire';

    protected $description = 'Update the status of expired appointments';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $expiredAppointments = Appointment::where('appointment_date', '<', Carbon::now())
            ->where('end_time', '>', Carbon::now()->format('H:i'))
            ->get();
        $status = AppointmentStatus::where('name', 'expired')->first();
        foreach ($expiredAppointments as $appointment) {
            $appointment->status = $status->id;
            $appointment->save();
        }

        $this->info('status of expired appointments has been updated.');
    }
}
