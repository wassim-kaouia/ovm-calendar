<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class LogController extends Controller
{
    public function index(Request $request){

       $logs =  Activity::all();

       return view('logs.index',[
             'logs' => $logs
       ]);
    }

    public function show($id){
        $log = Activity::findOrFail($id);

        return view('logs.detail',[
            'log' => $log 
        ]);
    }
}
