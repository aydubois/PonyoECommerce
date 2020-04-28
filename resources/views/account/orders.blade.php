@extends('layout')
@section('featured-section')

<h2>Historique de mes dernières commandes</h2>
<div class="allOrders" style="border:1px solid blue;">   
    @foreach ($checkouts as $value => $key)
     
       <div class="order" style="border:1px solid red;">
        @if ( is_array($key) )
            
            @foreach ($key as $data)
                @if( !is_array($data) && !is_integer($data) )<p>Date de la commande :  {{$data}} <p>@endif

                @if ( is_array($data) )

                    @foreach ($data as $dt)
                
                    
                        <p>Commande n° {{$dt['checkout']}} </p>
                        <p> Article : {{$dt['nameProduct']}} </p>
                        <p> Quantité : {{$dt['quantity']}} </p>
                        <p><span> Sous-total : {{$dt['price']*$dt['quantity']/100}} euros</span><p>
                    @endforeach
                @endif
            
                @if( !is_array($data) && is_integer($data) )<strong> Total : {{$data/100}} euros </strong>@endif 
            @endforeach
        @endif
        </div>
    
    @endforeach
</div>
@endsection