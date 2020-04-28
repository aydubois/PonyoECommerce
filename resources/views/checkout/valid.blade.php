@extends('layout')
@section('featured-section')

@include('menus.checkout_steps', ['etape1'=> 'stepValid', 'etape2'=> 'stepValid', 'etape3'=> 'stepValid', 'etape4'=> 'stepValid'])


<div>
    <h2>Paiement Validé</h2>
    <p>Félicitation {{$name}}, votre paiement réalisé avec la carte XXXX XXXX XXXX {{$last4}} a été accepté. 
        Vous allez recevoir très prochainement un email récapitulatif à l'addresse mail suivante {{$email}}.
    </p>
</div>

<div>
    <a type="button" class="btn btn-secondary" href="{{route('home_landing')}}">Retour à l'accueil</a>

</div>

@endsection