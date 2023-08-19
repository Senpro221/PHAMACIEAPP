
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> page accueil</title>
  <link rel="stylesheet" href="{{asset('build/assets/app.css')}}">
	<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<!-- Scripts -->
<!-- JavaScript Bundle with Popper -->
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous" defer></script>

  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/aos.css">
</head>
<header>

<nav class="navbar  p-3 bg-success text-white">

  <div class="img-fluid" style="position: absolute">
    <!-- Notifications -->
    <img src="{{ asset('image/log.png')}}"  alt="..." class="mt-2" style="margin-left:-12px; height: 130px; width:250px; color:white;">
  </div>
  <center>
    {{-- @include('partials.search2'); --}}

   </center>
   <div class="sear1">
    @auth
    <center>
      <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-cart  mt-4 me-1" viewBox="0 0 16 16">0
         <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
       </svg>
    </center>

   <a href="{{ route('listepanier') }}" style="text-decoration: none; color:#fff" >  <p class="me-1 mt-0 ">Panier</p></a>
   <span class="mnm position-absolute top-4 start-60 me-1 translate-middle badge rounded-pill bg-danger">
  
 
<?php 
$user = Auth::user()->id;
 $panes = DB::select('select id from paniers where user_id = ?',[$user]);
 // $s=DB::table('possedes')->where('id_panier',$panes[0]->id)->count();

//=================id_panier de l'utilisateur connecter============================
  $pane = DB::select('select id from paniers where user_id = ?',[$user]);
  $c=DB::table('appartenirs')->where('id_panier',$pane[0]->id)->count(); ?>
  {{ $c }}
 
    @endauth 

   {{-- @guest
   0
   @endguest   --}}
  
</span>
  </div>
  
    @guest
    <div class="sear">
    <center>
      <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="boi bi bi-person-circle me-5 mt-4" viewBox="0 0 16 16">
        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
      </svg>
    </center>
   <a href="{{ route('registration') }}" style="text-decoration: none; color:#fff" >  <p class="me-5 mt-0 ">Inscription</p></a>
</div> 
    @endguest
    
</nav>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light  shadow " style=" height:53px ;">
  <!-- Container wrapper -->
  <div class="container-fluid">
    <!-- Toggle button -->
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
    <i class="fa fa-bars" aria-hidden="true"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Navbar brand -->
      
      <a class="navbar-brand" href="#"><span class="text-success">SEN</span>PHARMACIE</a>
       <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-bs-target="#navbarSupportedContent" data-bs-toggle="collapse" type="button">
      <span class="navbar-toggler-icon"></span>
      </button>
      
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-3 mb-lg-0">
        <li class="nav-item">
          <a style="margin-left: 90px; text-transform: uppercase;" class="nav-link mt-2" href="/">Accueil</a>
        </li>
         <li class="nav-item">
          <a style="text-transform: uppercase;" class="nav-link  mt-2" href="{{ route('listing') }}">Médicaments</a></li>
        </li>
         <li class="nav-item">
          <a style="text-transform: uppercase;" class="nav-link  mt-2" href="{{ route('listeproduits') }}">Produits</a></li>
        </li>
        @auth
        <li class="nav-item">
          <a style="text-transform: uppercase;" class="nav-link  mt-2" href="{{ route('listerCommandes') }}">Commandes</a></li>
        </li>
        @endauth
        
        <li class="nav-item">
          <a style="text-transform: uppercase;" class="nav-link  mt-2" href="{{ route('listeCategorie') }}">Catégories</a>
          </li>
          <li class="nav-item">
            <a style="text-transform: uppercase;" class="nav-link active mt-2" href="#">A propos</a></li>
          </li>
          <li class="nav-item">
            <a style="text-transform: uppercase;" class="nav-link active mt-2" href="#">Contacts</a></li>
          </li>
  
      </ul>
      <!-- Left links -->
    </div>
    <!-- Collapsible wrapper -->

    <!-- Right elements -->
    <div class="d-flex align-items-center">
      <!-- Icon -->
      <a class="text-reset me-3" href="#">
        <i class="fas fa-shopping-cart"></i>
      </a>

      @auth

      <div class="dropdown">

        <a href="#" style="text-decoration:none; color:black;" class=" dropdown-toggle ms-1" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
        <img
            src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp"
            class="rounded-circle"
            height="50"
            alt="Black and White Portrait of a Man"
            loading="lazy"
          style="margin-top: 9px;"/>
          {{Auth::user()->name}}
       
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
        <li>
            <a  style="text-decoration:none;" class="dropdown-item" href="#">Mon profile</a>
          </li>
          <li>
            <a  style="text-decoration:none;" class="dropdown-item" href="{{ route('logout') }}">Déconnexion</a>
          </li>
        </ul>
      @endauth
    <!-- Right elements -->
  </div>

  <!-- Container wrapper -->
</nav>
@yield('page-content')
<!-- Navbar -->
</div>
</header>
@include('layouts.footer' )












































