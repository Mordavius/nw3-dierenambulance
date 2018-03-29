<?php

namespace App\Http\Controllers;

use App\NotificationExport;



class AdministrationController extends Controller
{

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

    public function export() {
        return view('administration.export', compact('notification'));
    }

    public function downloadExcel()
    {
        return $this->excel->download(new NotificationExport, 'meldingen.xlsx');
    }






}
