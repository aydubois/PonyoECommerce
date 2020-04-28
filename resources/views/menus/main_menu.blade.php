<nav class="navheader">
    <ul>
        <li><a type="button" class="btn btn-secondary" href="{{route('home_landing')}}">Accueil</a></li>
        <li class="souslist"><a type="button" class="btn btn-secondary" href="{{route('category.listing')}}">Catégories</a>
            <ul>
                <li><a type="button" class="btn btn-secondary" href="{{route('category.index', ['id'=>'1'])}}">Fantastique</a></li>
                <li><a type="button" class="btn btn-secondary" href="{{route('category.index', ['id'=>'2'])}}">Savane</a></li>
                <li><a type="button" class="btn btn-secondary" href="{{route('category.index', ['id'=>'3'])}}">Insecte</a></li>
                <li><a type="button" class="btn btn-secondary" href="{{route('category.index', ['id'=>'4'])}}">Ferme</a></li>
            </ul>
        </li>
        {{-- <li><a type="button" class="btn btn-secondary" href="{{route('account.index')}}">Compte</a></li> --}}
        <li><a type="button" class="btn btn-secondary" href="{{route('cart.index')}}">Panier</a></li>

        @if (!Auth::user())
            <li><a type="button" class="btn btn-secondary" href="{{route('login')}}">Connexion</a></li>
            <li><a type="button" class="btn btn-secondary" href="{{route('register')}}">Inscription</a></li>
        @else
            <li><a type="button" class="btn btn-secondary" href="{{route('logout')}}">Déconnexion</a></li>
            <li><a type="button" class="btn btn-secondary" href="{{route('account.index')}}">Mon Compte</a></li>

        @endif
    </ul>
</nav>