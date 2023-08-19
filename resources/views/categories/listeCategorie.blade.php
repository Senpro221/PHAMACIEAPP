@extends('./../layouts/entete')


@section('page-content')
<center><h1 class="mt-5">Liste des Catégorie !!!</h1></center>
<hr>
<center class="mt-1">
@foreach ($medicaments as $medicament)

    <a href="{{ route('douleurFievre',$medicament->id) }}" type="button" class="btn btn-outline-success ms-2 fs-5">{{ $medicament->nom }}</a>

@endforeach


</center>
@endsection