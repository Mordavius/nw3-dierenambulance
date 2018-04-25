<?php
namespace App;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class TicketExport implements FromCollection
{
    use Exportable;

    public function collection()
    {
        return Ticket::all();
    }
}
