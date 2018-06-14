<?php

namespace App\Http\Controllers;

use App\TicketExport;
use App\Quarterfinance;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\FileNotFoundException;
use Illuminate\Http\Request;
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

    public function quartexports(){
        $quarterlies = Quarterfinance::all();
        return view('administration.quarterly', compact('quarterlies'));
    }

    public function quartdownload($filename)
    {
        $storage = Storage::url('exports/');
        //storage_path('exports\\');
        $filepath = $storage . $filename;
        try {
            return Storage::download('exports/' . $filename);
        }
        catch (FileNotFoundException $e) {
            Log::channel('sentry')->error($e);
            return Redirect::back()->withErrors(['Het door u opgevraagde bestand bestaat niet, neem contact op met de webmaster of probeer dit handmatig']);
        }
    }


    // Download the excel in xlsx format
    public function downloadExcel(Request $request)
    {
        return $this->excel->download(new TicketExport($request->startdate, $request->enddate), 'meldingen.xlsx');
    }
}
