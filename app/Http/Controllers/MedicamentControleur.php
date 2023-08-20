<?php

namespace App\Http\Controllers;
use App\Models\Medicament;
use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MedicamentRequest;

class MedicamentControleur extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexcl()
    {
        $medicaments = DB::select('select * from medicaments');
        $medicaments =  Medicament::orderBy('id', 'desc')->get();
        return view('dashboardcl',[
             'medicaments'=>$medicaments
 
        ]);
    }

    public function listing(Medicament $medicament)
    {
        $medicaments = Medicament::paginate(5); 

        return view('medicaments.lister',[
             'medicaments'=>$medicaments
 
        ]);
    }

    public function index()
    {
        $medicaments = DB::select('select * from medicaments');
        $categories = DB::select('select * from categories');
        return view('medicaments.medicament',[
             'medicaments'=>$medicaments,
             'categories'=>$categories
 
        ]);
    }

    public function listeCategorie()
    {
        $medicaments = DB::select('select * from categories');
        return view('categories.listeCategorie',[
            'medicaments'=>$medicaments,
 
        ]);
    }

    public function douleurFievre()
    {
        //dd($id);
        $medicaments = DB::select("select * from medicaments where categorie='Doulleurs Fièvres'");
        return view('medicaments.DoulleursFievres',[
            'medicaments'=>$medicaments,
 
        ]);
    }

    public function digestion()
    {
        //dd($id);
        $medicaments = DB::select("select * from medicaments where categorie='Digestion'");
        return view('medicaments.listdigest',[
            'medicaments'=>$medicaments,
 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(MedicamentRequest $request)
    {
        $nom = $request->nom;
        $image = $request->image;
        $categorie = $request->categorie;
        $quantite = $request->quantite;
        $quantiteMin = $request->quantiteMin;
        $prix_unitaire = $request->prix_unitaire;
        $dlc = $request->dlc;
        $libelle = $request->libelle;
      
      DB::insert('insert into medicaments (nom, image, categorie, quantite, quantiteMin, prix_unitaire, dlc, libelle) values (?, ?, ?, ?, ?, ?, ?, ?)',
        [$nom,$image,$categorie,$quantite,$quantiteMin,$prix_unitaire,$dlc,$libelle]);
      
        return redirect()->back()->with('success','Le médicament a été ajouter avec succés');

    }

    //produits==============\
    public function listeproduits()
    {
        $produits = DB::select("select * from medicaments where categorie = 'produits'");
        return view('produits.listerProduit',compact('produits'));
    }

    /**
     * Store a newly created resource in storage.
     */

     public function detail(Medicament $medicament)
     {
         return view('medicaments.show',[
 
             'medicament'=>$medicament,
            
         ]);
     }
 

     public  function add(Medicament $medicament, Request $request) {
		$count=0;
		//$this->ajoutOrdonnance($request);
    	// Validation de la requête
    	$this->validate($request, [
    		"quantite" => "numeric|min:1",
			"image"=>"string"
    	]);
		$prod = Medicament::all();
		if($request['quantite'] > $medicament['quantite']) {
		    return back()->with('error','La quantité demandée n\'est pas disponible');
	
		}else{
			$user = Auth::user()->id;
			$panier = DB::select('select id from paniers where user_id = ?',[$user]);
			$c=$panier[0]->id;
	
			$id = $medicament->id;
			$quantite=$request->quantite;

		$select = DB::select('select id_panier,id_medoc from appartenirs where id_panier=? and id_medoc = ?', [$c,$id]);
			   if($select){
					foreach($select as $sel){
						if($sel->id_panier = $c){
						  return back()->with('error','Médicament existe  au panier');
						}else{
							$bc = DB::insert('insert into appartenirs (id_panier,quantites,id_medoc) values (?, ?, ?)', [$c,$quantite,$id]);				
							return back()->with('success','Produit ajouter au panier');
						}
					}			
				}else{
					$bc = DB::insert('insert into appartenirs (id_panier,quantites,id_medoc) values (?, ?, ?)', [$c,$quantite,$id]);				
					return back()->with('success','Médicament ajouté au panier');
								
				}	
	        }
		}

        public function panier(Request $request)
		{
			 $user = Auth::user()->id; 
             //dd($medicament);
			//=================id_panier de l'utilisateur connecter============================
			 $pane = DB::select('select id from paniers where user_id =?',[$user]);
			
			//print_r ($pane[0]->id);exit();
			
			 $medicament=DB::select('select * from appartenirs,medicaments where medicaments.id = appartenirs.id_medoc and id_panier=?',[$pane[0]->id]);
			 $app = DB::select('select * from appartenirs ');
			
			//=================id_panier de l'utilisateur connecter============================

			$panier=DB::select('select * from paniers ');
			return view("paniers.listpan",[
				'medicament'=>$medicament,
				'app'=>$app,
		
			]);
		 }

    public function ajoutCat(Request $request) {
         //categorie
         $categories = DB::select('select * from categories');
         return view('categories.ajoutCategorie',compact('categories'));
    }

    public function ajoutcatego(Request $request) {
        $nom = $request->nom;
        //dd($nom);
        DB::insert('insert into categories (nom) values (?)', [$nom]);

        return redirect()->back()->with('success','La catégorie a été ajouter avec succés');

    }
    /**
     * Display the specified resource.
     */
    public function show()
    {
        $medicaments = Medicament::all();

        return view('vendres.listing',compact('medicaments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $medicament = DB::select('select * from medicaments where id = ?', [$id]);
        $categories = DB::select('select * from categories');
        return view('medicaments.edit',compact('medicament','categories'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Medicament $medicament,Request $request)
    {
       $medicament->nom = $request->nom;
       $medicament->image = $request->image;
       $medicament->categorie = $request->categorie;
       $medicament->quantite = $request->quantite;
       $medicament->quantiteMin = $request->quantiteMin;
       $medicament->prix_unitaire = $request->prix_unitaire;
       $medicament->dlc = $request->dlc;
       $medicament->libelle = $request->libelle;
       $medicament->save();
       
       return redirect()->Route('ajoutMedicament')->with('success','Medicament mise en jour');
    }


    function updatepanier(Request $request,$id)
     {
        //dd($request->id);
        $ap= DB::update('update appartenirs set quantites ='.$request->quantite .' where idApp = ?', [$id]);
			
        return redirect('/listepanier')->with('success','La quantité a été mise à jour avec succés');
     
    }
//======================commande//==================================//
    public function order(Request $request)
    {
        return view('order.commande');
    }

    public  function detailleComme(Request $request){
        $user = Auth::user()->id;
       
        $livraison = $request->typeLivraison;
    
        $pane = DB::select('select id from paniers where user_id =?',[$user]);
    
        $medicament=DB::select('select * from appartenirs,medicaments where medicaments.id = appartenirs.id_medoc and id_panier=?',[$pane[0]->id]);
         //$this->updateStock();
    
        DB::insert('insert into commandes (user_id,typeLivraison) values (?,?)', [$user,$livraison]);
        $pa = DB::select('select id from commandes where user_id =?',[$user]);
        $pa= DB::table('commandes')->whereIn('user_id', [Auth::user()->id])->get(); 
        $pa =  Commande::orderBy('id', 'desc')->get();
        
         
       //$pa = DB::select('select id from commandes where user_id =?',[$user])->first();
      
        foreach($medicament as $medicament){
             $id = $medicament->id;
             
             $quantites  = $medicament->quantites;
             $this->updateStock();
    
             //dd($pa[0]->id) ;
            
            DB::insert('insert into orders (id_commande,id_medoc,quantiteCom) values (?,?,?)', [$pa[0]->id,$id,$quantites]);
            
            
    
            //=========================on vide le panier de l'utilisateurs=======================================
            DB::delete('delete from appartenirs where id_panier =?',[$pane[0]->id]);
            
           //dd($db)
          
          
        } 

        return redirect()->Route('commandValide');
       
    } 

    public function commandValide()
    {
        return view('order.validerCommande');
    }
    
    private function updateStock(){
        //dd($request->quantite);
         $app =  DB::select('select * from appartenirs,medicaments where appartenirs .id_medoc=medicaments.id');
       
        foreach($app as $pa){
   //dd($pa->quantites);
        DB::update('update medicaments set quantite = '. $pa->quantite - $pa->quantites.' where id = ?', [$pa->id]);
   
        }
    }
   

    public function listerCommandes(Request $request){
            $user =  Auth::user()->id;
            $listeCommande =  DB::select('select * from commandes  where  user_id=?',[$user]);
            //$listeCommande =  Commande::orderBy('id', 'desc')->get();
            return view('order.listerCommandes',[
                        'listeCommande'=>$listeCommande,
              ]);   
     }

    public function afficheDetails($id){
        $user = Auth::user()->id; 
			 $detailsCom=DB::select('SELECT m.nom,m.prix_unitaire,o.quantiteCom,m.image FROM orders o,commandes c,medicaments m ,users u WHERE o.id_medoc=m.id and o.id_commande = c.id and c.user_id= u.id and u.id=? and c.id=?',[$user,$id]);
			 
			
			//=================id_panier de l'utilisateur connecter============================

            return view('order.DetailsCommandes',[
                'detailsCom'=>$detailsCom,
		
			]);

        
    }  
     

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,Request $request)
    {
        //
         DB::delete('delete from appartenirs where idApp = ?', [$id]);
       	
         return redirect('/listepanier')->with('success','Le Médicament a été supprimer avec succés');
     
    }

    public function vendreMedicaments($id)
    {
            $medicament = DB::select('select * from medicaments  where id=?',[$id]);
            return view('vendres.vente',compact('medicament'));
    }


public function stockupdate(Request $request,$id){
  
    $quantiteVendue  = $request->quantite;
  
     $app =  DB::select('select * from medicaments where  medicaments.id=?',[$id]);
    
     foreach($app as $pa){
      
            if($quantiteVendue > $pa->quantite){

            return back()->with('error','la quantité saisie n\'est pas disponible');
            }else{
                
               DB::update('update medicaments set quantite = '.$pa->quantite - $request->quantite.' where id = ?', [$pa->id]);
               
               DB::insert('insert into vendres (user_id, id_medoc, quantiteVendue) values (?, ?, ?)', [Auth::user()->id,$id,$request->quantite]);

               return redirect()->Route('listingMedoc')->with('success','médicament vendu avec succés');
           }
       break;
       }
   }
}