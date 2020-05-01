@extends('layout')

@section('featured-section')
<div class="containerhomePage">
    @if(URL::previous() == URL::route('login'))
    <h2 style="text-align:center;">Bonjour {{Auth::user()->name}}</h2>
    @endif
    <p class="section-description">&#9888; AAAAAA - Vu la situation actuelle due au confinement générale,<br/> nous avons décidés de
        baisser nos prix afin que vous puissiez profiter de tout l'amour de nos animaux. <br/> Profitez-en ! &#9888;</p>

    <div class="manyProducts homePage">

        @foreach ($products as $product)
        <div class="wrapper">
            <a href="{{ route('products.show', ['id'=> $product->id]) }}">
                <div class="container">
                    <div class="top">
                        <img class="card-img-top" src="{{asset('pictures/'.$product->image) }}"
                            alt="Image de {{$product->title}}">
                    </div>
                    <div class="bottom">
                        <div class="details">
                            <h2>{{$product->title}}</h2>
                            <p>{{ $product->price_in_cents/100 }} €</p>
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

    </div> <!-- end products -->

    <div class="text-center button-container">
        <a href="{{ route('products.index') }}" class="button">Voir plus de boules de poils</a>
    </div>

</div> <!-- end container -->
@endsection
