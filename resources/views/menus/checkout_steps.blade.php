<div class="flex " style="display: flex;justify-content:space-between;width:80%;margin:auto;">
    <div class="ValidationPanier {{$etape1}}" style="border: 1px black solid;">
        <h3>Etape 1 :</h3>
        <p>Validation du panier</p>
    </div>
    <div class="ValidationAdresse {{$etape2}}" style="border: 1px black solid;">
        <h3>Etape 2 :<h3>
                <p>Validation de l'adresse de facturation</p>
    </div>
    <div class="Paiement {{$etape3}}" style="border: 1px black solid;">
        <h3>Etape 3 :<h3>
                <p>Paiement par CB</p>
    </div>
    <div class="ValidationPaiement {{$etape4}}" style="border: 1px black solid;">
        <h3>Etape 4 :<h3>
                <p>Validation du paiement</p>
    </div>
</div>