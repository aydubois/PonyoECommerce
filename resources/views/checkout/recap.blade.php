@extends('layout')
@section('featured-section')


<div class="flex" style="display:flex;width:70%;margin:auto;justify-content:space-between;">
        @foreach ($listingProducts as $product)
    <div>

        <p>{{$product['name']}}</p>
        <p>qté : {{$product['quantity']}}</p>
        <p>ss total : {{$product['price_in_cents']/100}} </p>
    </div>
        @endforeach
</div>
<p><em>Total : </em><strong>{{$total}}</strong></p>


@endsection   