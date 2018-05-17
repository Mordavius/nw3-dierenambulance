<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\TicketExport;
use App\Quarterfinance;
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
    protected $description = 'quartely export of the finance';

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
     * Execute the console command.
     *
     * @return mixed
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function handle()
    {
        $filename = 'Kwartaal-'.ceil(date("m")/3) . '-'.date('Y');
        $filelocation = 'exports/'.$filename.'.xlsx';
        //return $this->excel->download(new TicketExport, 'meldingen.xlsx');
        if ($this->excel->store(new TicketExport, $filelocation)) {
            $quarteerfinance = new Quarterfinance([
                'name' => $filename,
                'year' => date('Y'),
                'filepath' => 'storage/'.$filelocation,
            ]);

            $quarteerfinance->save();
            echo "Het nieuwste kwartaalverslag staat klaar\n Ga nu naar het kwartaaloverzicht om de nieuwste versie te downloaden";
        }
        else{
            echo "Er is wat fout gegaan tijdens het automatisch exporteren";
        }
        //echo Storage::url($filelocation);
    }

}
