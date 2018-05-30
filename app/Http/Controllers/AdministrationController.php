<?php

namespace App\Http\Controllers;

use App\TicketExport;
use App\Quarterfinance;
use Illuminate\Support\Facades\Storage;


class AdministrationController extends Controller
{
    // Setup construct for the Excel library
    public function __construct(\Maatwebsite\Excel\Excel $excel)
    {
        $this->excel = $excel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all(); // Get the correct user by id
        return view('administration.index', compact('user'));
    }

    // Export function for showing the page
    public function export()
    {
        return view('administration.export', compact('ticket'));
    }

    public function quartexports(){
        $quarterlies = Quarterfinance::all();
        return view('administration.quarterly', compact('quarterlies'));
    }

    public function quartdownload($filename)
    {
        $storage = Storage::url('exports/');
        //storage_path('exports\\');
        $filepath = $storage . $filename;
        return Storage::download('exports/'.$filename);
    }


    // Download the excel in xlsx format
    public function downloadExcel()
    {
        return $this->excel->download(new TicketExport, 'meldingen.xlsx');
    }
}
