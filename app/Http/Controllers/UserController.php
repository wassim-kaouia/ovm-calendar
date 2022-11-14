<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('users.index',[
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $user = User::find($id);
        return view('users.edit',[
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'name' => 'required|min:4|String',
            'email' => 'required|email',
            'color' => 'required|String',
            'textColor' => 'required|String',
            'role' => 'required|String',
        ]);

        if($data){
            $user = User::find($request->user_id);

            $user->name  = $user->name != $request->name ? $request->name : $user->name;
            $user->email = $user->email != $request->email ? $request->email : $user->email;
            $user->color = $user->color != $request->color ? $request->color : $user->color;
            $user->textColor = $user->textColor != $request->textColor ? $request->textColor : $user->textColor;
            $user->role = $user->role != $request->role ? $request->role : $user->role;

            $events = Event::where('user_id',$request->user_id)->get();
            
            foreach($events as $event){
                $event->color = $user->color;
                $event->textColor = $user->textColor;
                $event->save();
            }
            if($request->password != null){
                $user->password = Hash::make($request->password);
            }
            $user->save();
            Alert::success('Modification', 'Les données sont mises à jour avec succès !');
            return redirect()->back();

         }else{
            Alert::error('Error', 'Erreur de Validation !');
            return redirect()->back();
        }
    }

    public function getUsersList(Request $request){
        $user = User::all();
        
        return response()->json($user,200);
    }
    
    public function destroy(User $user)
    {
        //
    }
}
