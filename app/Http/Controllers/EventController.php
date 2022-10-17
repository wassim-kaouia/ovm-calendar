<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;



class EventController extends Controller
{
    public function index(Request $request){
        $data = Event::latest()->get();
        return response()->json($data,200);
    }

    public function eventCreate(Request $request){
        if($request){
            Event::create([
                'title' => $request->title,
                'description' => $request->description,
                'start' => $request->start,
                'end'  => $request->start,
                'task_id' => Auth()->user()->id,
                'user_id' => Auth()->user()->id,
                'status' => $request->status,
                'access' => $request->access,
                'priority' => 'priority',
                'color' => $request->color,
                'textColor' => $request->textColor,
                'note' => $request->note,
            ]);
            Alert::success('Création de rendez-vous', 'rendez vous créé avec succès');
            return redirect()->back();
        }
    }

    public function getEventById(Request $request,$id){
        $data = Event::where('id','=',$id)->first();
        return response()->json($data,200);
    }
}
