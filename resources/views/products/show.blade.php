@extends('layout')
@section('featured-section')
@if (session()->has('success_message'))
<section class="containerMessages">
    <div class="alert alert-success">
        {{ session()->get('success_message') }}
    </div>
</section>
@else
<a class="breadcrumb" href="{{URL::previous()}}">Dernière page visitée</a>
@endif
<section class="oneProductSection">
    <h1>{{$product->title}}</h1>
    <div>
        <article>
            <img src="{{asset('pictures/'.$product->image) }}" alt="Image de {{$product->title}}"
            style="width: 25rem; ">
        </article>
        <article>
            <p>Description : {{$product->description}}</p>
            <p>Pays d'origine : {{$product->origin_country}}</p>
            <p>Prix : {{ $product->price_in_cents/100}} euros </p>
            
            <form action="{{ route('cart.store') }}" method="post">
                @csrf
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <input type="number" min="0" step="1" value="1" name="quantity" required>
                <input type="submit" class="button" value="Ajouter au panier">
            </form>
        </article>
    </div>
</section>
@endsection
