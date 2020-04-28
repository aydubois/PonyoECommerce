<div class="footer">
    <div>
        <img src="{{ asset('pictures/ponyo.png') }}" alt="logo Ponyo">
        <h1>Ponyo e-Commerce</h1>
        <p>Copyright @Ponyo</p>
    </div>
    <nav class="navheader">
        <ul>
            <li><a type="button" class="btn btn-secondary" href="{{route('home_landing')}}">Accueil</a></li>
            {{-- <li><a type="button" class="btn btn-secondary" href="{{route('account.edit')}}">Compte</a></li> --}}
            <li><a type="button" class="btn btn-secondary" href="{{route('cart.index')}}">Panier</a></li>
        </ul>
    </nav>
</div>