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
        $checkdate = strtotime('-1 month');
        $tickets = Ticket::all();
        foreach ($tickets as $ticket) {
            if (strtotime($ticket->created_at) <= $checkdate && $ticket->reporter_name != "anoniem") {
                $ticket->reporter_name = "anoniem";
                $ticket->telephone = "0000000000";
                $ticket->save();
            }
        }
    }
}
