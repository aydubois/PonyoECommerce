@extends('layout')
@section('featured-section')


<section class="containerMessages">
    @if (session()->has('success_message'))
    <div class="alert alert-success">
        {{ session()->get('success_message') }}
    </div>
    @endif

    @if(count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</section>

<section class="accountSection">
    <nav class="sidebar">

        <ul>
            <li class="active"><a href="{{ route('account.index') }}">Mon profil</a></li>
            <li><a href="{{ route('account.orders', ['id'=> Auth::user()->id]) }}">Mes commandes</a></li>

            <li><a href="{{ route('account.address', ['id'=> Auth::user()->id]) }}">Mon adresse</a></li>
        </ul>
    </nav>
    <section class="profile">

        <section class="addresses">
            <h1>Mon addresse</h1>
            @if ($nbAddress === 0)
            <p>Vous n'avez pas encore saisi votre addresse</p>

            <div class="formAccount">
                <form action="{{ route('account.addAddress') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" value='{{$user->id}}' name="user_id" id="user_id">
                        <label for="name1">Nom / Prénom : </label>
                        <input type="text" id="name" name="name1" placeholder="Durant Mathilde">
                    </div>
                    <div class="form-group">
                        <label for="line1">Addresse : </label>
                        <input type="text" id="address" name="line1" placeholder="29 rue de la marmelade" required>
                    </div>
                    <div class="form-group">
                        <label for="line2">Addresse - suite <span><i>(facultatif)</i></span>: </label>
                        <input type="text" id="address" name="line2" placeholder="appartement 43">
                    </div>

                    <div class="half-form">
                        <div class="form-group">
                            <label for="city">Ville</label>
                            <input type="text" id="city" name="city" placeholder="Zombieland" required>
                        </div>
                        <div class="form-group">
                            <label for="country">Pays</label>
                            <input type="text" id="country" name="country" placeholder="France" required>
                        </div>
                    </div> <!-- end half-form -->

                    <div class="half-form">
                        <div class="form-group">
                            <label for="postcode">Code postal</label>
                            <input type="text" id="postalcode" name="postcode" placeholder="47000" required>
                        </div>
                    </div> <!-- end half-form -->
                    <div>
                        <button type="submit">Enregistrer</button>
                    </div>
                </form>
            </div>
            @endif 
            @if ($nbAddress === 1)
            <h3>Modifier mon adresse</h3>
            <div class="formAccount">
                <form action="{{ route('account.patchAddress') }}" method="POST">
                    @csrf
                    @method('patch')
                    
                    <div class="form-group">
                        <input type="hidden" value='{{$user->id}}' name="user_id" id="user_id">
                        <label for="name1">Nom / Prénom : </label>
                    <input type="text" id="name" name="name1" value="{{$Address->name1}}" placeholder="Durant Mathilde">
                    </div>
                    <div class="form-group">
                        <label for="line1">Addresse : </label>
                        <input type="text" id="address" name="line1"  value="{{$Address->line1}} " placeholder="29 rue de la marmelade" required>
                    </div>
                    <div class="form-group">
                        <label for="line2">Addresse - suite <span><i>(facultatif)</i></span>: </label>
                        <input type="text" id="address" name="line2"  value="{{$Address->line2}} " placeholder="appartement 43">
                    </div>

                    <div class="half-form">
                        <div class="form-group">
                            <label for="city">Ville</label>
                            <input type="text" id="city" name="city"  value="{{$Address->city}} " placeholder="Zombieland" required>
                        </div>
                        <div class="form-group">
                            <label for="country">Pays</label>
                            <input type="text" id="country" name="country"  value="{{$Address->country}} " placeholder="France" required>
                        </div>
                    </div> <!-- end half-form -->

                    <div class="half-form">
                        <div class="form-group">
                            <label for="postcode">Code postal</label>
                        <input type="text" value="{{$Address->postcode}}" id="postalcode" name="postcode" placeholder="47000" required>
                        </div>
                    </div> <!-- end half-form -->
                    <div>
                        <button type="submit">Enregistrer</button>
                    </div>
                </form>
            </div>
            @endif 
            @if($nbAddress > 1)
                <p>Plusieurs adresses sont enregistrées sur votre compte. </p>

            {{-- TODO: A FINALISER --}}
            @endif
        </section>
    </section>
</section>
@endsection
