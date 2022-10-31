<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;



class EventController extends Controller
{
    public function index(Request $request){
        if(auth()->user()->role == 'vendor'){
            // $data = Event::latest()->get();
            $data = Event::where('user_id','=',auth()->user()->id)->get();
            return response()->json($data,200);
        }
    }

    public function eventCreate(Request $request){
        // check wether the request has title
        // dd($request->has('title'));
        if(!$request->has('title')){
            // dd('no');
            Alert::error('Création de rendez-vous', 'Vous devez remplir tous les champs obligatoires !');
            return redirect('/');
        }
    
        $data = $request->validate([
            'title' => 'required',
            'assignedBy' => 'required',
            'assignedTo' => 'required',
            'start' => 'required',
            'description' => 'required',
            'phone_client' => 'required',
            'name_client' => 'required',
            'status' => 'required',
            'siteweb' => 'String'
        ]);
        // dd('ok');
        if($data){
            $event = Event::create([
                'title' => $request->title,
                'description' => $request->description,
                'start' => $request->start,
                'end'  => $request->start,
                'user_id' => auth()->user()->id,
                'siteweb' => $request->siteweb,
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
                return redirect()->back();
            }else{
                
                Alert::error('Création de rendez-vous', 'un probleme est survenu !');
                return redirect()->back();
            }
            
        }else{
            Alert::error('Création de rendez-vous', 'un probleme est survenu !!!!');
            return redirect()->back();
        }
           
        
    }

    public function getEventById(Request $request,$id){
        $data = Event::where('id','=',$id)->with('user')->first();
        return response()->json($data,200);
    }

    public function eventUpdate(Request $request){
        
        if($request->event_id == null){
            Alert::error('Modification de rendez-vous','Choisissez le rendez-vous a modifier avant de cliquer sur le button Modifier!');
            return redirect('/');
        }
        $event = Event::find($request->event_id);
        
        $event->title = $request->title;
        $event->description = $request->description;
        $event->start = $request->start;
        $event->end = $request->start;
        $event->status = $request->status;

        $event->save();

        Alert::success('Modification de rendez-vous', ' RDV Modifié avec succes!');
        return redirect()->back();
    }
}
