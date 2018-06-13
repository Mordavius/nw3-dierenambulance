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
        Commands\QuarterlyExport::class,
        Commands\AnonymizeReporters::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //Save a quarterly export of the tickets
        $schedule->command('export')
            ->everyMinute()
//            ->emailOutputTo('g.w.n.h.iskondos@gmail.com');
        ->sendOutputTo('storage/logs/koekoek.log');
//                ->output()
            //->withoutOverlapping();

        //Anonymize reporters older than a month
        $schedule->command('anonymize')
            ->daily()
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
