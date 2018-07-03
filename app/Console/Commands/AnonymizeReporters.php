<?php

namespace App\Console\Commands;


use App\Ticket;
use Illuminate\Console\Command;

class AnonymizeReporters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'anonymize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Anonymize all reports older then 1 month';

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
     *  Anonymizes all reporters in records older than 1 month
     */
    public function handle()
    {
        $checkdate = date("Y-m-d h:i:s", strtotime('-1 month'));
            //strtotime('-1 month');
        $tickets = Ticket::where([['created_at', '<=', $checkdate], ['reporter_name', '!=', 'anoniem'],])->get();
        if ($tickets) {
            try {
                foreach ($tickets as $ticket) {
                        $ticket->reporter_name = "anoniem";
                        $ticket->telephone = "0000000000";
                        $ticket->save();
                }
            }
            catch (\Exception $e){
                Log::channel('sentry')->critical("Critical error anonymizing users ",$e->getMessage());
            }
        }
    }
}
