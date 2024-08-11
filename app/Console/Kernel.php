<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\GenerateSitemap;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected $commands = [
        GenerateSitemap::class,
    ];
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        // Schedule the sitemap:generate command to run weekly
        $schedule->command('sitemap:generate')->weekly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
