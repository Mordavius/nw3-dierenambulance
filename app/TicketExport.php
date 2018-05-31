<?php
namespace App;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class TicketExport implements FromCollection
{
    use Exportable;
    public function __construct(string $startdate = null, string $enddate = null)
    {
        $this->startdate = $startdate;
        $this->enddate   = $enddate;
    }
    // Grab all data from tickets
    public function collection()
    {
        if ($this->startdate === null && $this->enddate === null){
            return Ticket::all();
        }
        else {
            return Ticket::query()->whereBetween('date', [$this->enddate, $this->startdate]);
        }
    }
}
