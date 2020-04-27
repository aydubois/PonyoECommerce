<nav class="navheader">
    <ul>
        <li class="souslist"><a type="button" class="btn btn-secondary" href="{{route('category.listing')}}">Catégories</a>
            <ul>
                <li><a type="button" class="btn btn-secondary" href="{{route('category.index', ['id'=>'1'])}}">Fantastique</a></li>
                <li><a type="button" class="btn btn-secondary" href="{{route('category.index', ['category'=>'savanna'])}}">Savane</a></li>
                <li><a type="button" class="btn btn-secondary" href="{{route('category.index', ['category'=>'farm'])}}">Ferme</a></li>
                <li><a type="button" class="btn btn-secondary" href="{{route('category.index', ['category'=>'insect'])}}">Insecte</a></li>
            </ul>
        </li>
        <li><a type="button" class="btn btn-secondary" href="{{route('home_landing')}}">Accueil</a></li>
        <li><a type="button" class="btn btn-secondary" href="{{route('account')}}">Compte</a></li>
        <li><a type="button" class="btn btn-secondary" href="{{route('cart.index')}}">Panier</a></li>
        {{-- <li><a type="button" class="btn btn-secondary" href="{{route('contact.index')}}">Contact</a></li> --}}
    </ul>
</nav>