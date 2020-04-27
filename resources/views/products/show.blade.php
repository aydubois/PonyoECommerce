<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/header.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/categories.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/footer.css') }}">
</head>

<body>

    <div id="app">
        <header class="with-background">
            <div class="top-nav container">
                <div class="top-nav-left">
                    <div class="logo"></div>
                    @include('menus.main_menu')
                </div>

            </div>

            <div class="hero container">
                <div class="hero-copy">
                    <h1>Ponyo Ecommerce </h1>
                    <p>Venez adopter des animaux en tout genre. Que vous soyez plutôt du style féérique ou que vous
                        aimiez les petites bêtes, Ponyo E-commerce est fait pour vous !!</p>

                </div> <!-- end hero -->
            </div>
        </header>

        <div class="featured-section">
            <div class="container">
                <p>
                    @if (session()->has('success_message'))
                    <div class="alert alert-success">
                        {{ session()->get('success_message') }}
                    </div>
                @endif
                </p>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="all-articles articleOnly products text-center">
                            <div class="card product" style="width: 50rem; height:50rem;">
                                <div class="card-header">
                                    {{$product->title}}
                                </div>
                                <div class="card-body">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <div style="width: 50rem; height:50rem;">
                                        <img class="card-img-top" src="/pictures/{{$product->image}}"
                                            alt="Image de {{$product->title}}" style="width: 25rem; ">
                                        <div class="card-body">
                                            <p class="card-text">Description : {{$product->description}}</p>
                                            <p class="card-text">Payx d'origine : {{$product->origin_country}}</p>
                                            <p class="card-text">Prix : {{ $product->price_in_cents/100}} euros </p>
                                        </div>
                                        <form class="card-body" action="{{ route('cart.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <input type="number" min="0" step="1" value="1" name="quantity" required>
                                            <input type="submit" class="button" value="Ajouter au panier">
                                        </form>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            @include('menus.footer')
        </footer>
    </div>
</body>

</html>
