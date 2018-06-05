<?php

namespace App\Http\Controllers;

use App\Destination;

use Illuminate\Http\Request;

class testController extends Controller
{
    public function index()
    {
        $tasks = Destination::all();
       return view('ticket.test')->with('tasks',$tasks);
    }

    public function create(Request $request) {
        $task = Destination::create($request->all());

      //  $input = request()->all();

        return response()->json($task);

       // return Response::json($task);
    }

    public function edit(Request $request, $task_id) {

        $task = Destination::find($task_id);

        $task->postal_code = $request->postal_code;
        $task->city = $request->city;

        $task->save();

        return response()->json($task);

    }

    public function destroy($task_id) {
        $task = Destination::destroy($task_id);

        return response()->json($task);
    }
}
