@extends('layout')
@section('featured-section')
    <h2>Catégories</h2>
    <div class='all-articles'>


        @foreach ($listin as $list)
        <a href="{{ route('category.index', ['id'=>$list->id]) }}">
        <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="/pictures/{{ $list->name_category }}.png"
                    alt="Image de {{$list->name_category}}">
                    <div class="card-body">
                        <h3 class="card-title">{{ $list->name_category }}</h3>
                    </div>
            </div>
        </a>
        @endforeach
    </div>
    <div class="pagination">{{ $listin->links() }}</div>

@endsection