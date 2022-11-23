<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    
    public function index()
    {
        $users = User::all();

        return view('users.index',[
            'users' => $users
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show(User $user)
    {
        //
    }


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
            $user->color = $user->color == $request->color ? $user->color : $request->color;
            $user->textColor = $user->textColor == $request->textColor ? $user->textColor : $request->textColor;
            $user->role = $user->role != $request->role ? $request->role : $user->role;

            $events = Event::where('user_id',$request->user_id)->get();
            
            foreach($events as $event){
                //reponsible of changing the color of assignedTo colors - pay attention!
                //i can fixe it in next feature by adding a boolean field to check wether the event is being created for the user or affected to him by another one
                // if so i have to keep the same color of the old one so i can make difference 
                    $event->color = $request->color;
                    $event->textColor = $request->textColor;
                // if($event->assingnedBy != $user->name){
                //     $event->assignedBy = $user->name;
                // }
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
        
    }

    public function getProfile(Request $request,$id){



        $profile = User::findOrFail($id);
        return view('users.profile',[
            'profile' => $profile
        ]);
    }

    public function updateProfile(Request $request){
        $validator = Validator::make($request->all(),[
            'name'     => 'required',
            'email'    => 'email',
            'avatar'   => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        
        if($validator->fails()){
           Alert::error('Error', 'Erreur de Validation !');
           return redirect()->back();
        }
        
        $user = User::findOrFail($request->user_id);
        $user->name  = $request->name  == null ? $user->name : $request->name;
        $user->email = $request->email == null ? $user->email: $request->email;
        $user->password = $request->password == null ? $user->password : bcrypt($request->password);
        
        //upload photo avatar
        if($request->hasFile('avatar')){
            if(File::exists('storage/'.$user->avatar)){
                unlink('storage/'.$user->avatar);
            }
            $image_path = $request->file('avatar')->store('avatar', 'public');
            $user->avatar = $image_path;
        }
        $user->save();
        Alert::success('Modification', 'Les données sont mises à jour avec succès !');  
        return redirect()->back();
    }
    
    public function getAddPage(Request $request){
        return view('users.addUser');
    }

    public function addNewUser(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'color' => ['required'],
            'textColor' => ['required'],
        ]);
        
        if($validator->fails()){
            Alert::error('Error', 'Erreur de Validation !');
            return redirect()->back();
        }
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->color = $request->color;
        $user->textColor = $request->textColor;
        $user->role = $request->role;
        $user->save();
        
        Alert::success('Success', "L'utilisateur est créé avec succès !");
        return redirect()->back();
    }
}
