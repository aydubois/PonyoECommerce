<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listing Categories</title>
    <link rel="stylesheet" href="{{ asset('assets/header.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/categories.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/contact.css') }}">
</head>

<body>

    <header>
        @include('app')
    </header>

    <h2>Catégories</h2>
    <div class='all-articles'>


        @foreach ($listin as $list)
        {{-- <a href="{{ route('category.index', ['category'=>$list->name_category]) }}"> --}}
        <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="/pictures/{{ $list->name_category }}.png"
                    alt="Image de {{$list->name_category}}">
                    <div class="card-body">
                        <h3 class="card-title">{{ $list->name_category }}</h3>
                    </div>
            </div>
        {{-- </a> --}}
        @endforeach
    </div>
    <div class="pagination">{{ $listin->links() }}</div>

    <footer>
        {{-- @include('includes.footer') --}}
    </footer>

</body>

</html>
