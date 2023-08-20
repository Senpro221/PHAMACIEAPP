
@extends('./layouts/app')


@section('page-content')
<div class="home-content" style="margin-left: 5rem;">
     @if (session()->has('success'))
              <div class="alert alert-success">
                {{session()->get('success')}}
              </div>
           @endif
    <div class="overview-boxes ms-5 mt-1">
        <div class="box">
            <table class="mtable" border="1">
                <tr>
                    <th>Nom médicaments</th>
                    <th>Quantité en stock</th>
                    <th>Quantité minimum</th>
                    <th>Date actuelle</th>
                    <th>Date de péremption</th>
                    <th>Action</th>
                </tr>
                @foreach($stocks as $stock ) 
                    @php
                        $date = gmdate('d-M-Y');
                        $current_datetime = Carbon\Carbon::now();
                    @endphp
                    @if ($stock->quantite < $stock->quantiteMin )
                        <tr class="alert alert-warning" style="background-color: rgb(254, 187, 109); ">
                            <td>{{ $stock->nom }}</td>
                                
                            <td>{{ $stock->quantite }}</td>
                        
                            <td>{{ $stock->quantiteMin }}</td>
                    
                            <td>{{ $current_datetime }}</td>
      
                            <td>{{ $stock->dlc }}</td> 
                            <td>{{ $stock->dlc }}</td>
        
                            <form action="{{ route('ajoutstock',$stock->id) }}" method="POST">
                                @csrf
                                <td> <button type="submit" class="btn btn-success">Ajouter</button></td> 
                            </form>   
                            {{-- <td> <a href="{{ route('statutmedicaments',$stock->id) }}" class="btn btn-danger">Suppimer</a> </td>              --}}
                                
                        </tr>
                        @elseif ($current_datetime >= $stock->dlc)
                        <tr class="alert alert-danger">
                            <td>{{ $stock->nom }}</td>
                                
                            <td>{{ $stock->quantite }} minimum</td>
           
                            <td>{{ $stock->quantite }}</td>
                        
                            <td>{{ $stock->quantiteMin }}</td>
                    
                            <td>{{ $current_datetime }}</td>
             
                            <td>{{ $stock->dlc }}</td> 
                                    
                            <td> <a href="{{ route('statutmedicaments',$stock->id) }}" class="btn btn-danger">Suppimer</a> </td>             
                                
                            </tr>
                    @else        
                    <tr class="">
                        <td>{{ $stock->nom }}</td>
                            
                        <td>{{ $stock->quantite }}</td>
                    
                        <td>{{ $stock->quantiteMin }}</td>
                
                        <td>{{ $current_datetime }}</td>     
                        <td>{{ $stock->dlc }}</td> 
                        <td>{{ $stock->dlc }}</td>
    
                      
                    </tr>
                @endif            
                            
                    </tr>
                        
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection