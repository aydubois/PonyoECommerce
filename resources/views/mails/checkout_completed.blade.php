@component('mail::message')
# Bonjour {{$address->name1}}, 

Pour voir le récapitulatif de votre commande, cliquez sur le bouton suivant : 

@component('mail::button', ['url' => $checkout])
Récapitulatif
@endcomponent

Merci de nous faire confiance,<br>
{{ config('app.name') }}
@endcomponent
