<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;



class EventController extends Controller
{
    public function index(Request $request){

        if(auth()->user()->role == 'admin'){
            $data = Event::all();
            return response()->json($data,200);
        }

        if(auth()->user()->role == 'vendeur'){
            $data = Event::whereHas('user',function(Builder $query){
                $query->where('role','=','webmaster')->orWhere('role','=','vendeur');
            })->get();
            return response()->json($data,200);
        }
        
        if(auth()->user()->role == 'webmaster'){
            $data = Event::whereHas('user',function(Builder $query){
                $query->where('role','=','webmaster')->orWhere('role','=','assistant');
            })->get();
            return response()->json($data,200);
        }

        if(auth()->user()->role == 'assistant'){
            $data = Event::whereHas('user',function(Builder $query){
                $query->where('role','=','webmaster')->orWhere('role','=','assistant');
            })->get();
            return response()->json($data,200);
        }

        if(auth()->user()->role == 'superviseur'){
            $data = Event::whereHas('user',function(Builder $query){
                $query->where('role','=','webmaster')->orWhere('role','=','vendeur')->orWhere('role','=','assistant')->orWhere('role','=','superviseur');
            })->get();
            return response()->json($data,200);
        }

    }

    public function eventCreate(Request $request){
        // check wether the request has title
        if(!$request->filled('title') || !$request->filled('assignedTo') || !$request->filled('start') ||
        !$request->filled('description') || !$request->filled('name_client') || !$request->filled('status') 
        ){
            Alert::error('Création de rendez-vous', 'Vous devez remplir tous les champs obligatoires !');
            return redirect('/');
        }
        $data = $request->validate([
            'title' => 'required',
            'assignedTo' => 'required|numeric',
            'start' => 'date',
            'description' => 'required',
            'name_client' => 'required',
            'status' => 'required',
        ]);

        if($data){ 
            $event = new Event();
            $event->title = $request->title;
            $event->description = $request->description;
            $event->start = $request->start;
            $event->end = $request->start;
            $event->user_id = $request->assignedTo == '0' ? auth()->user()->id : $request->assignedTo;
            $event->siteweb = $request->siteweb;
            $event->status = $request->status;
            $event->phone_client = $request->phone_client;
            $event->name_client = $request->name_client;
            $event->priority = $request->priority == 'on' ? true : false;
            $event->color = auth()->user()->color;
            $event->textColor = auth()->user()->textColor;
            $event->note = $request->note;

            $event->assignedBy = auth()->user()->name;
            $event->assignementDate = now();
            $event->save();

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
    
    public function getAssignedToName(Request $request,$id){
        
        $assignedTo = User::findOrFail($id)->name;
        return response()->json($assignedTo,200);
    }

    public function checkVendorUpdatability($id){    
        if(Auth::user()->role == 'vendeur' && Auth::user()->id == $id ){
            return response()->json('vendorCanUpdate',200);
        }else if(Auth::user()->role == 'vendeur' && Auth::user()->id != $id){
            return response()->json('vendorCantUpdate',200);
        }else{
            return response()->json('freeAccess',200);
        }
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
        $event->user_id = $request->assignedTo == '0' ? $event->user_id : $request->assignedTo;
        $event->priority = $request->priority == 'on' ? '1' : '0';
        // $event->assignedBy
        $event->status = $request->status;
        $event->save();
        
        Alert::success('Modification de rendez-vous', ' RDV Modifié avec succes!');
        return redirect()->back();
    }
}
