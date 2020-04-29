@extends('layout')
@section('featured-section')

@include('menus.checkout_steps', ['etape1'=> 'stepValid', 'etape2'=> 'stepValid', 'etape3'=> 'stepValid', 'etape4'=> 'stepValid'])

<section class="validation">

    <div>
        <h1>Paiement Validé</h1>
        <p>Félicitation {{$name}}, <br/>votre paiement réalisé avec la carte XXXX XXXX XXXX {{$last4}} a été accepté. <br/>
            Vous allez recevoir très prochainement un email récapitulatif à l'addresse mail suivante {{$email}}.
        </p>
    </div>
    
    <div>
        <a type="button" class="button" href="{{route('home_landing')}}">Retour à l'accueil</a>
    </div>
</section>

@endsection