<?php

namespace App;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Ticket;

class QuartelyTicketExport implements FromQuery, WithHeadings
{
    use Exportable;

    public function __construct(string $quarter)
    {
        $this->quarter = $quarter;
    }

    /**
     * @return array add headings to excel export
     */
    public function headings(): array
    {
        return [
            'datum',
            'adress',
            'gift',
        ];
    }

    // Grab all data from tickets between now and 3 months ago
    public function query()
    {
        return Ticket::query()->select(['date','address','gifts'])->whereBetween('date', [$this->quarter, date(now())]);
    }
}