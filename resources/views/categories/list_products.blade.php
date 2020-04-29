@extends('layout')
@section('featured-section')


<h1>Vous êtes dans la catégorie {{ $category->name_category }} </h1>
<div class="manyProducts">

    @foreach ($listingProductsCategory as $product)
    <div class="wrapper">
        <a href="{{ route('products.show', ['id'=> $product->id]) }}">
            <div class="container">
                <div class="top">
                    <img class="card-img-top" src="/pictures/{{$product->image}}" alt="Image de {{$product->title}}">
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

    <div class="pagination">{{ $listingProductsCategory->links() }}</div>

</div>
@endsection

{{-- <div class='all-articles articleOnly products text-center'>

    @foreach ($listingProductsCategory as $product)
    <a href="{{ route('products.show', ['id'=> $product->id]) }}">
<div class="card product" style="width: 18rem;">
    <img class="card-img-top" src="/pictures/{{$product->image}}" alt="Image de {{$product->title}}">
    <div class="card-body">
        <h3 class="card-title">{{ $product->title }}</h3>

        <p class="card-text">{{ $product->price_in_cents/100}} euros </p>
    </div>
</div>
</a>
@endforeach
</div>
<div class="pagination">{{ $listingProductsCategory->links() }}</div>
</div> --}}
