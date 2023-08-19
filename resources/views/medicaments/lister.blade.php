
@extends('./../layouts/entete')


@section('page-content')
<center><h1 class="mt-5">Médicaments en ligne livrés en 24h</h1></center>
<center class="mt-1">
<a href="#" type="button" class="btn btn-outline-success ms-2 fs-5">Dermatologie</a>
<a href="{{ route('digestion') }}" type="button" class="btn btn-outline-success ms-2 fs-5">Digestion</a>
<a href="{{ route('douleurFievre') }}" type="button" class="btn btn-outline-success ms-2 fs-5">Douleurs - Fièvre</a>
<a href="#" type="button" class="btn btn-outline-success ms-2 fs-5">Homéopathie</a>
<a href="#" type="button" class="btn btn-outline-success ms-2 fs-5">
Circulation veineuse</a>
<a href="#" type="button" class="btn btn-outline-success ms-2 fs-5">
Vitamines - Minéraux</a>

<center class="mt-1">
<a href="#" type="button" class="btn btn-outline-success mt-1 ms-2 fs-5">
Détente - Sommeil</a>
<a href="#" type="button" class="btn btn-outline-success ms-2 fs-5">
Soins bucco-dentaires</a>
<a type="button" class="btn btn-outline-success mt-1 ms-2 fs-5">
Autres médicaments</a>
</center>
</center>

<img src="{{ asset('image/banneres.jpg')}}" class="img-fluid" alt="..." style="height: 320px; width: 100%x; padding: 10px 10px;">
<hr>

@foreach($medicaments as $medicament)
   {{-- @if($medicament->statut == 1) --}}
<div class="nb card float-lg-start shadow p-3 mb-1 bg-body rounded" style="max-width: 315px; height:35rem;">
   <img src="image/{{ $medicament->image }}" class="card-img-top" alt="vous">
  <div class="card-body">
    <h5 class="card-title">
      <a href="{{route('medicaments.show',$medicament->id)}}" class="text-success" style="text-decoration: none;">{{$medicament->nom}}</a>
   </h5>
  
    <p class="card-text">{{$medicament->libelle}}</p>
      @if ($medicament->categorie === 'sous-ordonence')
         <h5 class="text-danger">Ordonnance obligatoire</h5>
      @endif
    <p
    
      @if($medicament->quantite ===0 )
         <span class="alert alert-danger p-1 mb-3 ms-0 w-1">Indisponible</span>
      @else
         <span class="alert alert-success p-1 mb-3 ms-1 w-1">En stock</span>

      @endif
   </p>
    <a href="{{route('medicaments.show',$medicament->id)}}"  class="btn btn-outline-success">Détail</a>
     <button type="button" class="btn btn-success ms-1">{{$medicament->prix_unitaire}} fcfa</button>
     
  </div>
</div>
{{-- @endif --}}
@endforeach
<div class='float-lg-start'>
  {{$medicaments->links()}}
  </div>
@endsection
