@extends('layout')
@section('featured-section')

@include('menus.checkout_steps', ['etape1'=> 'stepValid', 'etape2'=> 'enCours', 'etape3'=> 'enAttente', 'etape4'=> 'enAttente'])


<div class="checkout-section flex" style="display:flex;justify-content:center;">
    
    <div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <p> Il y a une erreur. Veuillez vérifier les champs à remplir.</p>
        </div>
        @endif
        <form action="{{ route('checkout.store') }}" method="POST" id="payment-form">
            @csrf
            <h2>Adresse de livraison</h2>

            <div class="form-group">
                <label for="name1">Nom / Prénom : </label>
                <input type="text" class="form-control" id="name" name="name1" value="{{ old('name') }}" placeholder="Durant Mathilde" >
            </div>
            <div class="form-group">
                <label for="line1">Addresse : </label>
                <input type="text" class="form-control" id="address" name="line1" value="{{ old('address') }}" placeholder="29 rue de la marmelade" required>
            </div>
            <div class="form-group">
                <label for="line2">Addresse - suite <span><i>(facultatif)</i></span>: </label>
                <input type="text" class="form-control" id="address" name="line2" value="{{ old('address') }}" placeholder="appartement 43" >
            </div>

            <div class="half-form">
                <div class="form-group">
                    <label for="city">Ville</label>
                    <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" placeholder="Zombieland" required>
                </div>
                <div class="form-group">
                    <label for="country">Pays</label>
                    <input type="text" class="form-control" id="country" name="country" value="{{ old('country') }}" placeholder="France"
                        required>
                </div>
            </div> <!-- end half-form -->

            <div class="half-form">
                <div class="form-group">
                    <label for="postcode">Code postal</label>
                    <input type="text" class="form-control" id="postalcode" name="postcode"
                        value="{{ old('postalcode') }}" placeholder="47000" required>
                </div>
            </div> <!-- end half-form -->


            {{-- <h2>Payment Details</h2>

            <div class="form-group">
                <label for="name_on_card">Name on Card</label>
                <input type="text" class="form-control" id="name_on_card" name="name_on_card" value="">
            </div>

            <div class="form-group">
                <label for="card-element">
                    Credit or debit card
                </label>
                <div id="card-element">
                    <!-- a Stripe Element will be inserted here. -->
                </div>

                <!-- Used to display form errors -->
                <div id="card-errors" role="alert"></div>
            </div>
            <div class="spacer"></div>

            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="{{ env('STRIPE_PUB_KEY') }}" data-amount="1999" data-name="Stripe Demo"
                data-description="Online course about integrating Stripe"
                data-image="https://stripe.com/img/documentation/checkout/marketplace.png" data-locale="auto"
                data-currency="eur">
                >

            </script> --}}
            <input class='button' type="submit" value="Passer à l'étape suivante">
        </form>
    </div>
</div>
@endsection
