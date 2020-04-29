<div class="footer">


    <nav>
        <ul>
            <li><a type="button" class="btn btn-secondary" href="{{route('home_landing')}}">Accueil</a></li>
            <li><a type="button" class="btn btn-secondary" href="{{route('cart.index')}}">Panier</a></li>
            @if (Auth::user())
            <li><a type="button" class="btn btn-secondary" href="{{route('account.index')}}">Compte</a></li>
            @endif
        </ul>
    </nav>
    <h1><img src="{{ asset('pictures/ponyo.png') }}" alt="logo Ponyo">Ponyo e-Commerce</h1>
    <span>Copyright @Ponyo</span>
</div>
