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
        $userdate = strtotime(User::all()->first()->created_at);
        $checkdate = strtotime('-1 minute');

        if ($userdate <= $checkdate){
            echo User::all();
        }
        else{
            echo "niks is kleiner dan een minuut";
        }


        echo "\n". strtotime(User::all()->first()->created_at);
        //echo "\n". strtotime('now');
        echo "\n". strtotime('-1 minute');

        echo "\n". date('r', strtotime(User::all()->first()->created_at));
        echo "\n". date('r', strtotime('now'));

    }

}
