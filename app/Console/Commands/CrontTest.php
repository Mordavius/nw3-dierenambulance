<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;

class CrontTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crontest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'cron test';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //return view('crontest.index');
        echo "time to test cron";
    }

}
