@extends('layout')
@section('featured-section')


<div class="allOrders Cart">
    <h1> Récapitulatif de votre commande </h1>
        @foreach ($listingProducts as $product)
    <div class="order flex Recap">

        <p>{{$product['name']}}</p>
        <p>qté : {{$product['quantity']}}</p>
        <p>ss total : {{$product['price_in_cents']*$product['quantity']/100}} euros</p>
    </div>
        @endforeach
</div>
<div class="paiement"><p>Total : {{$total/100}} euros</p></div>


@endsection   