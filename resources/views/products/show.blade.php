@extends('layout')
@section('featured-section')

<div class="container">
    <p>
        @if (session()->has('success_message'))
        <div class="alert alert-success">
            {{ session()->get('success_message') }}
        </div>
        @endif
    </p>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="all-articles articleOnly products text-center">
                <div class="card product" style="width: 50rem; height:50rem;">
                    <div class="card-header">
                        {{$product->title}}
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <div style="width: 50rem; height:50rem;">
                            <img class="card-img-top" src="/pictures/{{$product->image}}"
                                alt="Image de {{$product->title}}" style="width: 25rem; ">
                            <div class="card-body">
                                <p class="card-text">Description : {{$product->description}}</p>
                                <p class="card-text">Pays d'origine : {{$product->origin_country}}</p>
                                <p class="card-text">Prix : {{ $product->price_in_cents/100}} euros </p>
                            </div>
                            <form class="card-body" action="{{ route('cart.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <input type="number" min="0" step="1" value="1" name="quantity" required>
                                <input type="submit" class="button" value="Ajouter au panier">
                            </form>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
