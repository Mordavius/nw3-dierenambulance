<?php

namespace App\Http\Controllers;

use App\TicketExport;

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
        return view('administration.index');
    }

    // Export function for showing the page
    public function export()
    {
        return view('administration.export', compact('ticket'));
    }

    // Download the excel in xlsx format
    public function downloadExcel()
    {
        return $this->excel->download(new TicketExport, 'meldingen.xlsx');
    }
}
