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
                    <div class="logo">
                    </div>
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
            @section('featured-section')
                @show
        </div>
        <footer>
            @include('menus.footer')
        </footer>
    </div>
</body>

</html>

