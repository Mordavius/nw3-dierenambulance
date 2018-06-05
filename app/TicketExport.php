<?php
namespace App;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class TicketExport implements FromCollection
{
    use Exportable;

    // Grab all data from tickets
    public function collection()
    {
        return Ticket::all();
    }
}
