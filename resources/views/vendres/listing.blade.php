@extends('./../layouts/app')


@section('page-content')


   <div class="home-content ">

    @if (session()->has('success'))
    <div class="alert alert-success">
      {{session()->get('success')}}
    </div>
    @endif
    <div class="overview-boxes">
  <!-- tables -->  
  <div class="box">
    <table class="mtable" border="1">
      <tr>
        <th>Nom</th>
        <th>Quantité</th>
        <th>Prix_Unitaire</th>
        <th>Catégorie</th>
        {{-- <th>DLC</th> --}}
        <th>Action</th>

      </tr>
       @forelse($medicaments as $medicament) 
         {{-- @if(Auth::user()->id===$medicament->user_id)  --}}
      <tr>
      
          <td>{{$medicament->nom}}</td>
          <td>{{$medicament->quantite}}</td>
          <td>{{$medicament->prix_unitaire}}</td>
          <td>{{$medicament->categorie}}</td>
          <td> 
            @if ($medicament->quantite === 0)
            
              <a role="link" aria-disabled="true" class="disabled btn btn-outline-danger mt-1" disabled='disabled'>vendre</a>
            @else
              <a  href="{{ route('vendre',$medicament->id) }}"  type="button" class="btn btn-outline-success mt-1" >vendre</a>

            @endif
         </td>

      </tr>
          {{-- @else 
        @endif --}}

      @empty

  @endforelse

  </table>
  </div>
</div>    

</body>
</html>



  @endsection
