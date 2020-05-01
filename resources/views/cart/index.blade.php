@extends('layout')

@section('featured-section')
<a class="breadcrumb" href="{{URL::previous()}}">Dernière page visitée</a>
<h1>Votre Panier</h1>
@if ($productsWithQuantities->isEmpty())
<div class="emptyCart">
    <p> Votre panier est vide.</p>
    <p><a class="button" href="{{route('products.index')}}">Voir les animaux disponibles</a></p>
</div>

@else

@include('menus.checkout_steps', ['etape1'=> 'enCours', 'etape2'=> 'enAttente', 'etape3'=> 'enAttente', 'etape4'=>
'enAttente'])

<div class="allOrders Cart">

    @foreach ($productsWithQuantities as $productWithQuantity)
    <div class="order flex">
        <h2>{{$productWithQuantity->product->title}}</h2>
        <img src="{{asset('pictures/'.$productWithQuantity->product->image) }}"
            alt="Image de {{$productWithQuantity->product->title}}">
        <p>Quantité : {{$productWithQuantity->quantity}}</p>
        <p>Prix : {{$productWithQuantity->product->price_in_cents*$productWithQuantity->quantity/100}} euros</p>
        <div class="formsCart flex">
            <form action="{{route('cart.update')}}" method="post" class="flex">
                {{method_field('PATCH')}}
                @csrf
                <input type="hidden" name="product_id" value="{{$productWithQuantity->product->id}}">
                <label>Changer la quantité voulue : </label>
                <input type="number" value="1" step="1" min="1" name="quantity" required>
                <input type='submit' class="button" value="valider les changements">
            </form>
            <form action="{{route('cart.delete')}}" method="post">
                {{method_field('DELETE')}}
                @csrf
                <input type="hidden" name="product_id" value="{{$productWithQuantity->product->id}}">
                <input type='submit' class="button" value="Supprimer l'article du panier">
            </form>
        </div>
    </div>
    @endforeach
</div>

<div class="paiement">
    <p>Total = {{App\Cart::getTotalPrice()}} euros</p>
    <a class='button' href="{{route('checkout.index')}}">Passer à l'étape suivante</a>
</div>
@endif
@endsection
