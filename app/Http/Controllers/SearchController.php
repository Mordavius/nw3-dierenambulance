<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Destination;
use DB;

class SearchController extends Controller
{
    public function index()
    {
        return view('ticket.search');
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $search = DB::table('destinations')->where('city','LIKE','%'.$request->search."%")->get();

            if($search) {
                foreach ($search as $key => $city) {
                    $output.='<tr>'.
                        '<td>'.$city->id.'</td>'.
                        '<td>'.$city->city.'</td>'.
                        '</tr>';
                }
                return Response($output);
            }
        }
    }
}