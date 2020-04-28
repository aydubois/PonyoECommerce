@extends('layout')
@section('featured-section')


            <div>
                <h1>Vous êtes dans la catégorie {{ $category->name_category }} </h1>
                <div class='all-articles articleOnly products text-center'>

                    @foreach ($listingProductsCategory as $product)
                    <a href="{{ route('products.show', ['id'=> $product->id]) }}">
                    <div class="card product" style="width: 18rem;">
                        <img class="card-img-top" src="/pictures/{{$product->image}}"
                            alt="Image de {{$product->title}}">
                        <div class="card-body">
                            <h3 class="card-title">{{ $product->title }}</h3>

                            <p class="card-text">{{ $product->price_in_cents/100}} euros </p>
                        </div>
                    </div>
                    </a>
                    @endforeach
                </div>
                <div class="pagination">{{ $listingProductsCategory->links() }}</div>
            </div>
@endsection