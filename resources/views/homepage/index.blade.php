<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Ponyo E-commerce</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat%7CRoboto:300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('assets/app.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/header.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/footer.css') }}">


        {{-- <link rel="stylesheet" href="{{ asset('css/responsive.css') }}"> --}}

    </head>
    <body>
        <div id="app">
            <header class="with-background">
                <div class="top-nav container">
                    <div class="top-nav-left">
                        <div class="logo"></div>
                        @include('menus.main_menu')
                    </div>
                </div> <!-- end top-nav -->
                <div class="hero container">
                    <div class="hero-copy">
                        <h1>Ponyo Ecommerce </h1>
                        <p>Venez adopter des animaux en tout genre. Que vous soyez plutôt du style féérique ou que vous aimiez les petites bêtes, Ponyo E-commerce est fait pour vous !!</p>
                        
                    </div> <!-- end hero-copy -->

                    <div class="hero-image">
                        <img src="{{ asset('pictures/ponyo.png') }}" alt="hero image">
                    </div> <!-- end hero-image -->
                </div> <!-- end hero -->
            </header>

            <div class="featured-section">

                <div class="container">
                    {{-- <h1 class="text-center">Laravel Ecommerce</h1> --}}

                    <p class="section-description">Vu la situation actuelle due au confinement générale, nous avons décidés de baisser nos prix afin que vous puissiez profiter de tout l'amour de nos animaux. Profitez-en</p>

                    {{-- <div class="text-center button-container">
                        <a href="#" class="button">Featured</a>
                        <a href="#" class="button">On Sale</a>
                    </div> --}}

                    {{-- <div class="tabs">
                        <div class="tab">
                            Featured
                        </div>
                        <div class="tab">
                            On Sale
                        </div>
                    </div> --}}

                    <p  class="section-description">A la une : <p>
                    <div class="products text-center">
                        @foreach ($products as $product)
                        <a href="{{ route('products.show', ['id'=> $product->id]) }}">
                            <div class="product">
                                <h2>{{$product->title}}</h2>
                                <img class="card-img-top" src="/pictures/{{ $product->title }}.png"
                                    alt="Image de {{$product->title}}">
                                    
                                <div class="product-name">{{ $product->name }}</div>
                                <div class="product-price">{{ $product->price_in_cents/100 }} euros</div>
                            </div>
                        </a>
                        @endforeach

                    </div> <!-- end products -->

                    <div class="text-center button-container">
                        <a href="{{ route('products.index') }}" class="button">Voir plus de boules de poils</a>
                    </div>

                </div> <!-- end container -->

            </div> <!-- end featured-section -->

            @include('menus.footer')

        </div> <!-- end #app -->
        <script src="js/app.js"></script>
    </body>
</html>