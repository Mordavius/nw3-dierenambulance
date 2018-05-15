<?php
namespace App\Console\Commands;
use App\User;
use Illuminate\Console\Command;
use App\Ticket;

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
    protected $description = 'cron test written to test on mark his server';

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
        echo User::all();
    }

}
