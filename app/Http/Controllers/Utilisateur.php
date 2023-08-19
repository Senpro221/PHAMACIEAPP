<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Utilisateur extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return view('adminGerant');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function register()
    {
        return view('users.registre');
    }
   

    public function handleRegistration(User $user,Request $request)
    {
        $user->name = $request->name;
        $user->prenom = $request->prenom;
        $user->email = $request->email;
        $user->telephone = $request->telephone;
        $user->adresse = $request->adresse;
        $user->password = Hash::make($request->password);
        $user->save();



        $user = $user->id;
        $pan=DB::insert('insert into paniers (user_id) values (?)', [$user]);
        
        return redirect()->back()->with('success','Votre compte a été créé avec');
    }


    public function login()
    {
        return view('users.registre');
    }

    public function handleLogin(Request $request)
    {
       $credentials =  $request->validate([
            'email'=>['required','email'],
            'password'=> ['required'],
       ]);
       if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
             session();
           // dd($iiii);
            if(Auth::user()->role === 'admin'){
                return redirect('/index');
               // dd($iiii);
            }else{
                return redirect('/');
            }
            
        }else{
          return redirect()->back()->with('error','login ou mot de passe incorrecte');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    //======================================deconnexion d'un utilisateur===========================//
    public function logout()
    {
       Session::flush();
       Auth::logout();
       return redirect('login')->with('error','Deconnexion reussit');
    }
}
