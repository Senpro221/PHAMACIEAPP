<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Utilisateur;
use App\Http\Controllers\MedicamentControleur;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
//liste des medicaments acueil medicament
Route::get('/',[MedicamentControleur::class, 'indexcl'])->name('/');
Route::get('/listing',[MedicamentControleur::class, 'listing'])->name('listing');

//produits
Route::get('/listeproduits', [MedicamentControleur::class,'listeproduits'])->name('listeproduits');

//commande
Route::get('/commander',[MedicamentControleur::class,'order'])->name('commande');
Route::get('/commandValide',[MedicamentControleur::class,'commandValide'])->name('commandValide');
Route::get('/listerCommandes',[MedicamentControleur::class,'listerCommandes'])->name('listerCommandes');
Route::post('/detailleComme',[MedicamentControleur::class,'detailleComme'])->name('DetailsCommandes');
Route::get('/afficheDetails/{id}',[MedicamentControleur::class,'afficheDetails'])->name('afficheDetails');

Route::get('/listeCommandeAll', [Utilisateur::class, 'listeCommandeAll'])->name('listeCommandeAll');
Route::get('/DetailsCommandesGerant/{id}',[Utilisateur::class,'DetailsCommandesGerant'])->name('DetailsCommandesGerant');


//stok admin
Route::get('/stock', [Utilisateur::class,'stock'])->name('stock');
//=========================================================Au niveau de stock====================================================================//
Route::post('/ajoutNedoc/{id}',[Utilisateur::class,'ajoutMedoc'])->name('ajoutstock');
Route::post('/mettreAjour/{id}',[Utilisateur::class,'mettreAjour'])->name('mettreAjour');
Route::get('/medicaments/statut/{id}',[Utilisateur::class,'statutmedicaments'])->name('statutmedicaments');


//categorie
Route::get('/ajoutCat',[MedicamentControleur::class,'ajoutCat'])->name('ajouterCategorie');
Route::post('/ajoutcatego',[MedicamentControleur::class,'ajoutcatego'])->name('ajoutcatego');
Route::get('/listeCategorie',[MedicamentControleur::class,'listeCategorie'])->name('listeCategorie');
Route::get('/douleurFievre',[MedicamentControleur::class,'douleurFievre'])->name('douleurFievre');
Route::get('/digestion',[MedicamentControleur::class,'digestion'])->name('digestion');


Route::post('add/{medicament}', [MedicamentControleur::class,'add'])->name('panier.add')->Middleware('auth');
Route::get('/listepanier', [MedicamentControleur::class,'panier'])->name('listepanier')->Middleware('auth');
Route::post('update/{id}', [MedicamentControleur::class,'updatepanier'])->name('panier.update')->Middleware('auth');
Route::get('delete/{id}', [MedicamentControleur::class,'destroy'])->name('panier.delete')->Middleware('auth');



Route::get('/register', [Utilisateur::class, 'register'])->name('registration');
Route::post('/handleregister', [Utilisateur::class, 'handleRegistration'])->name('handleregistration');

//==========================connecter un utilisateur==========================================//
Route::get('/login',[Utilisateur::class, 'login'])->name('login');
Route::post('/handlelogin',[Utilisateur::class,'handleLogin'])->name('handlelogin');

//logout
Route::get('/logout',[Utilisateur::class, 'logout'])->name('logout');



Route::get('/index',[Utilisateur::class,'index'])->name('index');



Route::get('/ajoutMedoc',[MedicamentControleur::class,'index'])->name('ajoutMedicament');
Route::post('/ajoutMedo',[MedicamentControleur::class,'create'])->name('ajouterMedicament');

Route::get('/edit/{id}',[MedicamentControleur::class,'edit'])->name('medicament.edit');
Route::put('/update/{medicament}',[MedicamentControleur::class,'update'])->name('medicament.update');

Route::get('/listin',[MedicamentControleur::class,'show'])->name('listingMedoc');

Route::get('/vendre/{id}',[MedicamentControleur::class,'vendreMedicaments'])->name('vendre');

Route::post('/stockupdate/{id}',[MedicamentControleur::class,'stockupdate'])->name('stockupdate');
Route::get('/{medicament}', [MedicamentControleur::class, 'detail'])->name('medicaments.show')->withoutMiddleware('auth');


