@extends('layout')

@section('featured-section')
<div class="container">
    @if(URL::previous() == URL::route('login'))
        <h2 style="text-align:center;">Bonjour {{Auth::user()->name}}</h2>
    @endif
    <p class="section-description">Vu la situation actuelle due au confinement générale, nous avons décidés de
        baisser nos prix afin que vous puissiez profiter de tout l'amour de nos animaux. Profitez-en</p>
        
        <p class="section-description">A la une : <p>
            <div class="products text-center">
                @foreach ($products as $product)
                <a href="{{ route('products.show', ['id'=> $product->id]) }}">
                    <div class="product">
                        <h2>{{$product->title}}</h2>
                        <img class="card-img-top" src="/pictures/{{ $product->image }}"
                        alt="Image de {{$product->title}}">
                        
                        <div class="product-name">{{ $product->name }}</div>
                        <div class="product-price">{{ $product->price_in_cents/100 }} euros</div>
                    </div>
                    </a>
                    @endforeach

                </div> <!-- end products -->

                <div class="text-center button-container">
                    <a href="{{ route('products.index') }}" class="button">Voir plus de boules de poils</a>
                </div>

    </div> <!-- end container -->
@endsection