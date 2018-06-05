<?php

namespace App\Http\Controllers;

use App\TicketExport;
use App\User;

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
            $users      = User::orderBy('name')->paginate(5); // Grab all existing users and paginate by 5 results
            $usersCount = User::count(); // Count the users
            return view("administration.index", compact('users', 'usersCount'));
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
