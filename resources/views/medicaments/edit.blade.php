

@extends('./../layouts/app')


@section('page-content')


   <div class="home-content ">
     @if (session()->has('success'))
              <div class="alert alert-success">
                {{session()->get('success')}}
              </div>
           @endif
           
      <div class="overview-boxes">
      
          <div class="box">
            @foreach ($medicament as $medoc)
            <form action="{{ route('medicament.update',$medoc->id) }}" method="POST">
             
             <h2 class="text-success">Modifier le {{ $medoc->nom }}</h2>
             <hr>
            @csrf
            @method('put')
           
              
              <label for="nom_medoc">Nom medicament</label>
              <input type="text" name="nom" id="nom" placeholder="Nom du médicament" value="{{$medoc->nom}}">

              <label for="nom_medoc">Image</label>
            <input required type="file" name="image" id="iamge" values="{{ $medoc->image }}">
              
           
             
            <label for="nom_medoc">Catégorie</label>
            <select id="categorie"  name="categorie" >
              @foreach ($categories as $categorie )
                  <option value="{{$categorie->nom }}"> {{ $categorie->nom}} </option>     
              @endforeach
            </select>

            
            <label for="nom_medoc">Quantité</label>
              <input type="number" min="1" name="quantite" value="{{ $medoc->quantite}}">

                
             <label for="nom_medoc">Quantité Minimum</label>
             <input type="number" min="1" name="quantiteMin" id="quantiteMin" value="{{ $medoc->quantiteMin}}">

              <label for="nom_medoc">Prix unitaire</label>
              <input type="number" min="1" name="prix_unitaire" value="{{$medoc->prix_unitaire}}">

              <label for="nom_medoc">Date de peremtion</label>
              <input type="date" name="dlc" id="dlc"  value="{{$medoc->dlc}}">


               <label for="nom_medoc">Libelle</label>
              <textarea name="libelle" >{{$medoc->libelle}}</textarea>


              <button type="submit" class="btn btn-success mt-1">Editer</button>
             
            </form>
            @break
            @endforeach
          </div>
     
      <!-- tables -->  

    
  </div>    
  </body>
  @endsection
</html>