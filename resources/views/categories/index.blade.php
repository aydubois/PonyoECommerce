@extends('layout')
@section('featured-section')
    <h1>Catégories</h1>
    <div class='allCategories'>
        @foreach ($listin as $list)
        <div class="wrapper">
            <a href="{{ route('category.index', ['id'=>$list->id]) }}">
                <div class="container">
                    <div class="top">
                        <img class="card-img-top" src="/pictures/{{ $list->name_category }}.png"
                        alt="Image de {{$list->name_category}}">
                    </div>
                    <div class="bottom">
                            <h2>{{ $list->name_category }}</h2>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    <div class="pagination">{{ $listin->links() }}</div>
@endsection