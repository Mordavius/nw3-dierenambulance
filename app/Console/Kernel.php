<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\CrontTest::class,
        Commands\QuarterlyExport::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $schedule->command('crontest')
            ->everyMinute()
            ->before(function () {
                echo "task started \n";
            })
            ->emailOutputTo('g.w.n.h.iskondos@gmail.com')
            //->sendOutputTo($file)
            ->withoutOverlapping()
            ->after(function () {
                echo "task complete";
            });

        $schedule->command('export')
            ->everyFiveMinutes()
            ->emailOutputTo('g.w.n.h.iskondos@gmail.com')
            ->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
