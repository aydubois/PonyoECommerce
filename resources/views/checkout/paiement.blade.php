@extends('layout')
@section('featured-section')

@include('menus.checkout_steps', ['etape1'=> 'stepValid', 'etape2'=> 'stepValid', 'etape3'=> 'enCours', 'etape4'=>
'enAttente'])

<section class="recapitulatifSection">
    @if ($errors->any() )
<section class="containerMessages">
    <div class="alert alert-danger">
        <p>Une erreur s'est produite lors du paiement.<br/>
            Votre carte n'est peut-être pas compatible, veuillez contacter votre banque.
        </p>
    </div>
</section>
@endif
    <h1>Récapitulatif de la commande</h1>
    <div>
        <div class="recapPanier">
            @foreach ($productsWithQuantities as $product)
            <div>
                <h2>{{$product->product->title}}</h2>
                <img class="card-img-top" src="{{asset('pictures/'.$product->product->image) }}"
                    alt="Image de {{$product->product->title}}">
                <p>Quantité : {{$product->quantity}}</p>
                <p>Prix : {{$product->product->price_in_cents*$product->quantity/100}} euros</p>
            </div>
            @endforeach
        </div>
        <div class="recapBilling">
            <div class="sousSection">
                <div class="form-group">
                    <label for="name1">Nom / Prénom : </label>
                    <p name="name1">{{$address->name1}}</p>
                </div>
                <div class="form-group">
                    <label for="line1">Addresse : </label>
                    <p name="line11">{{$address->line1}}</p>
                </div>
                @if ($address->line2)
                <div class="form-group">
                    <label for="line2">Addresse - suite <span><i>(facultatif)</i></span> : </label>
                    <p name="line2"> {{$address->line2}}</p>
                </div>
                @endif
                
                <div class="half-form">
                    <div class="form-group">
                        <label for="city">Ville : </label>
                        <p name="city"> {{$address->city}}</p>
                    </div>
                    <div class="form-group">
                        <label for="country">Pays : </label>
                        <p name="country"> {{$address->country}}</p>
                    </div>
                </div> <!-- end half-form -->
                
                <div class="form-group">
                    <label for="postcode">Code postal : </label>
                    <p name="postcode"> {{$address->postcode}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="formPaiement">
        <form action="{{ route('checkout.paie') }}" method="POST" id="payment-form">
            @csrf
            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="{{ env('STRIPE_PUB_KEY') }}" data-amount="1999" data-name="Stripe Demo"
                data-description="Online course about integrating Stripe"
                data-image="https://stripe.com/img/documentation/checkout/marketplace.png" data-locale="auto"
                data-currency="eur">

            </script>
        </form>
    </div>
</section>

@endsection
