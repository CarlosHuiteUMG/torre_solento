<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use Illuminate\Console\Command;
use Carbon\Carbon;

class UpdateReservationStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservations:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update reservation statuses based on current time';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        // Update to 'en_curso' (In Progress)
        // Criteria: status is 'confirmed', start_time <= now, end_time > now
        $started = Reservation::where('status', 'confirmed')
            ->where('start_time', '<=', $now)
            ->where('end_time', '>', $now)
            ->update(['status' => 'en_curso']);

        if ($started > 0) {
            $this->info("Updated $started reservations to 'en_curso'.");
        }

        // Update to 'finalizada' (Finished)
        // Criteria: status is 'confirmed' or 'en_curso', end_time <= now
        $finished = Reservation::whereIn('status', ['confirmed', 'en_curso'])
            ->where('end_time', '<=', $now)
            ->update(['status' => 'finalizada']);

        if ($finished > 0) {
            $this->info("Updated $finished reservations to 'finalizada'.");
        }

        if ($started === 0 && $finished === 0) {
            $this->info('No reservations needed updating.');
        }
    }
}
