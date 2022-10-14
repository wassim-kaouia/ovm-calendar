<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request){

        //if received ajax request from view
        if($request->ajax()){
            $data = Event::whereDate('rdv','=',$request->start)->get();
            dd($data);
            return response()->json($data);
        }
        
        return view('calendar.index');
    }


    public function eventCreate(Request $request){
        dd($request->all());
    }
}
