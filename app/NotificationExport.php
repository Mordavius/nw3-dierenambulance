<?php
namespace App;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class NotificationExport implements FromCollection
{
    use Exportable;

    public function collection()
    {
        return Notification::all();
    }

}
