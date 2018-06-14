<?php
namespace App\Console\Commands;
use App\QuartelyTicketExport;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromQuery;
use App\TicketExport;
use App\Quarterfinance;
use App\Ticket;
use Illuminate\Support\Facades\Storage;

class QuarterlyExport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'quartely export of the tickets';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(\Maatwebsite\Excel\Excel $excel)
    {

        $this->excel = $excel;
        parent::__construct();
    }

    /**
     * Saves an export of the tickets table as a file and in the database and notifies the user
     *
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function handle()
    {
        $quarter = date("Y-m-d h:i:s",strtotime("-3 Months"));
        $filename = 'Kwartaal-'.ceil(date("m")/3) . '-'.date('Y');
        $filelocation = 'exports/'.$filename.'.xlsx';
        try {
            if ($this->excel->store(new TicketExport(date(now()), $quarter), $filelocation)) {
                $quarteerfinance = new Quarterfinance([
                    'name' => $filename,
                    'year' => date('Y'),
                    'filepath' => 'storage/' . $filelocation,
                ]);
                $quarteerfinance->save();
                echo "Het nieuwste kwartaalverslag staat klaar\nGa nu naar het kwartaaloverzicht om de nieuwste versie te downloaden";
            }
        }
        catch (QueryException $e) {
            echo "Er is wat fout gegaan tijdens het automatisch exporteren, probeer dit handmatig";
            Log::channel('sentry')->critical("Critical error during quarterly export: " . $e);
        }
    }

}
