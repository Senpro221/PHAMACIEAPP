
@extends('./../layouts/entete')


@section('page-content')
<center><h1>Médicaments en ligne livrés en 24h</h1></center>
@forelse($medicaments as $medicament)
<div class="nb card float-lg-start shadow p-3 mb-1 bg-body rounded" style="width: 315px; height:35rem;">
   <img src="/image/{{ $medicament->image }}" class="card-img-top" alt="vous">
  <div class="card-body">
    <h5 class="card-title"><a href="/medicaments/{{$medicament->id}}" class="text-success" style="text-decoration: none;">{{$medicament->nom}}</a></h5>
    <p class="card-text">{{$medicament->libelle}}</p>
    <p
    @if($medicament->quantite ===0 )
    <span class="alert alert-danger p-1 mb-3 ms-0 w-1">Indisponible</span>
   @else
   <span class="alert alert-success p-1 mb-3 ms-1 w-1">En stock</span>

@endif</p>
    <a href="{{route('medicaments.show',$medicament->id)}}"  class="btn btn-outline-success">Détail</a>
      <button type="button" class="btn btn-success">{{$medicament->prix_unitaire}} fcfa</button>
  </div>
</div>

@empty

@endforelse
  @endsection
