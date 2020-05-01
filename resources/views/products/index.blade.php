@extends('layout')
@section('featured-section')


<h1>Tous les animaux disponibles</h1>
<div class='manyProducts'>

    @foreach ($products as $product)
    <div class="wrapper">
        <a href="{{ route('products.show', ['id'=> $product->id]) }}">
            <div class="container">
                <div class="top">
                    <img class="card-img-top" src="{{asset('pictures/'.$product->image) }}" alt="Image de {{$product->title}}">
                </div>
                <div class="bottom">
                    <div class="details">
                        <h2>{{ $product->title }}</h2>
                        <p>{{ $product->price_in_cents/100}} €</p>
                    </div>
                    <div class="viewPlus">
                        <svg x="0px" y="0px" viewBox="0 0 426.667 426.667"
                            style="enable-background:new 0 0 426.667 426.667;" xml:space="preserve">
                            <g>
                                <g>
                                    <circle cx="42.667" cy="213.333" r="42.667" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <circle cx="213.333" cy="213.333" r="42.667" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <circle cx="384" cy="213.333" r="42.667" />
                                </g>
                        </svg>
                    </div>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>
<div class="pagination">{{ $products->links() }}</div>


@endsection
