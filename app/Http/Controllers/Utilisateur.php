<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Commande;
use App\Models\Medicament;
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
        $ventes = DB::table('vendres')->count();
        //dd($ventes);
        $medoc = DB::table('medicaments')->count();

        $users = DB::table('users')->count();

        $commandes = DB::table('commandes')->count();

        $recentComm = DB::select("SELECT c.dateCommande,u.prenom,u.name,m.nom,m.prix_unitaire FROM orders o,commandes c,users u, medicaments m WHERE c.user_id=u.id and o.id_medoc = m.id and o.id_commande=c.id ORDER BY dateCommande DESC");

       // dd($recentComm);
       return view('adminGerant',[
        'ventes'=>$ventes,
        'medoc'=>$medoc,
        'users'=>$users,
        'commandes'=>$commandes,
        'recentComm'=>$recentComm
        ]);

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

    public function listeCommandeAll(Request $request)
    {
        //
        $listeCommande = DB::select('select c.id, c.dateCommande,c.statut,c.typeLivraison,u.prenom,u.name,u.telephone from commandes c,users u where c.user_id=u.id ');

        return view('order.listesCommandesAll',compact('listeCommande'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function DetailsCommandesGerant(Request $request,$id)
    {
		$data = Commande::find($id);
			//dd($data);
		
		$idcom = DB::select('select id from orders where id_commande = ?', [$id]);
		$detailsCom =  DB::select('select * from orders,medicaments,commandes where medicaments.id=orders.id_medoc and commandes.id=orders.id_commande and id_commande=?',[$data->id]);
	
		return view('order.DetailsCommandesPharma',[
			'detailsCom'=>$detailsCom,
				  
		]);
	}

    public function stock(Medicament $stocks,Request $request)
    {       
        $stocks = DB::select('select * from medicaments');
        return view('stock.stock',compact('stocks'));
        
    }
    /**
     * Display the specified resource.
     */
    public function ajoutMedoc(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function mettreAjour(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function statutmedicaments(Request $request, string $id)
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
