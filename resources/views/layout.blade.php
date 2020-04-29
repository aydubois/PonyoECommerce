<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="{{ asset('assets/base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/responsive.css') }}">


</head>

<body>

    <div id="app">
        <header>
            <div class="top-nav container">
                <div class="top-nav-left">
                    @include('menus.main_menu')
                    <div>
                        @if (Auth::user())
                        <a type="button" class="btn btn-secondary" href="{{route('account.index')}}">{{Auth::user()->name}}</a>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="hero container">
                <div class="hero-copy">
                    <h1><img src="{{asset('pictures/ponyo.png')}}" alt="logo ponyo e-commerce" class="logo">Ponyo Ecommerce </h1>
                    <p>Venez adopter des animaux en tout genre. Que vous soyez plutôt du style féérique ou que vous
                        aimiez les petites bêtes, Ponyo E-commerce est fait pour vous !!</p>
                        
                </div> <!-- end hero -->
            </div>
            
        </header>

        <div class="featured-section">
            @section('featured-section')
                @show
        </div>
        <footer>
            @include('menus.footer')
        </footer>
    </div>
</body>

</html>

