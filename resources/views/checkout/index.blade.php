@extends('layout')
@section('featured-section')

@include('menus.checkout_steps', ['etape1'=> 'stepValid', 'etape2'=> 'enCours', 'etape3'=> 'enAttente', 'etape4'=>
'enAttente'])


<section class="containerMessages">
    @if ($errors->any())
    <div class="alert alert-danger">
        <p> Il y a une erreur. Veuillez vérifier les champs à remplir.</p>
    </div>
    @endif
</section>
<section class="accountSection">
    <div class="profile checkout">
        <h1>Adresse de livraison</h1>
        <div class="formAccount">

            <form action="{{ route('checkout.store') }}" method="POST" id="payment-form">
                @csrf
                <input type="hidden" name="formType" value="livraison">
                <div class="form-group">
                    <label for="name1">Nom / Prénom : </label>
                    <input type="text" class="form-control" id="name" name="name1" 
                    @if($address)
                    value=" {{ $address->name1 }}"
                    @endif
                        placeholder="Durant Mathilde">
                </div>
                <div class="form-group">
                    <label for="line1">Addresse : </label>
                    <input type="text" class="form-control" id="address" name="line1" 
                    @if($address)
                    value=" {{ $address->line1 }}"
                    @endif
                        placeholder="29 rue de la marmelade" required>
                </div>
                <div class="form-group">
                    <label for="line2">Addresse - suite <span><i>(facultatif)</i></span>: </label>
                    <input type="text" class="form-control" id="address" name="line2" 
                    @if($address)
                    value=" {{ $address->line2 }}"
                    @endif
                        placeholder="appartement 43">
                </div>

                <div class="half-form">
                    <div class="form-group">
                        <label for="city">Ville</label>
                        <input type="text" class="form-control" id="city" name="city" 
                        @if($address)
                    value=" {{ $address->city }}"
                    @endif
                            placeholder="Zombieland" required>
                    </div>
                    <div class="form-group">
                        <label for="country">Pays</label>
                        <input type="text" class="form-control" id="country" name="country"
                        @if($address)
                    value=" {{ $address->country }}"
                    @endif
                            placeholder="France" required>
                    </div>
                </div> <!-- end half-form -->

                <div class="half-form">
                    <div class="form-group">
                        <label for="postcode">Code postal</label>
                        <input type="text" class="form-control" id="postalcode" name="postcode"
                        @if($address)
                    value=" {{ $address->postcode }}"
                    @endif
                    placeholder="47000" required>
                    </div>
                </div> <!-- end half-form -->
                <div class="form-group checkbox">
                    <label for="typeaddress">Mon adresse de livraison et celle de facturation sont identiques</label>
                    <label class="toggle">

                        <input type="checkbox" class="form-control" id="typeaddress" name="typeaddress" checked hidden>
                        <span class="circle"></span>
                    </label>
                </div>
                <input class='button' type="submit" value="Passer à l'étape suivante">
            </form>
        </div>
    </div>
</section>
@endsection
