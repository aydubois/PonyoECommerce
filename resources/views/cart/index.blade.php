<h2>Votre Panier</h2>
@if ($productsWithQuantities->isEmpty())
    <p> Votre panier est vide.</p>
<a class="button" href="{{route('products.index')}}">Voir les animaux disponibles</a>
@endif
@foreach ($productsWithQuantities as $productWithQuantity)
<div style="display:flex;flex-direction:row;align-items:center;border:1px solid black;">
    <h2>{{$productWithQuantity->product->title}}<h2>
    <img class="card-img-top" src="/pictures/{{$productWithQuantity->product->image}}"
        alt="Image de {{$productWithQuantity->product->title}}"
        style="width:150px;">
    <p>Quantité : {{$productWithQuantity->quantity}}</p>
    <p>Prix : {{$productWithQuantity->product->price_in_cents*$productWithQuantity->quantity/100}}</p>
    <div class="flex">
        <form action="{{route('cart.update')}}" method="post">
            {{method_field('PATCH')}}
            @csrf
            <input type="hidden" name="product_id" value="{{$productWithQuantity->product->id}}">
            <label>Changer la quantité voulue : </label><input type="number" value="1" name="quantity" required>
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

<div class="paiement">
    <p>Total = {{App\Cart::getTotalPrice()}} euros</p>
<a class='button' href="{{route('checkout.index')}}">Paiement</a>
    
</div>
