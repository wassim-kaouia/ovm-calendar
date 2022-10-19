<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;



class EventController extends Controller
{
    public function index(Request $request){
        if(auth()->user()->role == 'vendor'){
            $data = Event::latest()->get();
            return response()->json($data,200);
        }
        
    }

    public function eventCreate(Request $request){
        if($request){
            $event = Event::create([
                'title' => $request->title,
                'description' => $request->description,
                'start' => $request->start,
                'end'  => $request->start,
                'user_id' => auth()->user()->id,
                'status' => $request->status,
                'phone_client' => $request->phone_client,
                'name_client' => $request->name_client,
                'priority' => 'priority',
                'color' => auth()->user()->color,
                'textColor' => auth()->user()->textColor,
                'note' => $request->note,
            ]);

            if($event){
                Alert::success('Création de rendez-vous', 'rendez vous créé avec succès');
            }else{
                Alert::error('Création de rendez-vous', 'un probleme est survenu !');
            }
            return redirect()->back();
        }
    }

    public function getEventById(Request $request,$id){
        $data = Event::where('id','=',$id)->with('user')->first();
        return response()->json($data,200);
    }
}
