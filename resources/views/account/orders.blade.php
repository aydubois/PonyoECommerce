@extends('layout')
@section('featured-section')


<section class="accountSection">
    <nav class="sidebar">
        <ul>
            <li class="active"><a href="{{ route('account.index') }}">Mon profil</a></li>
            <li><a href="{{ route('account.orders', ['id'=> Auth::user()->id]) }}">Mes commandes</a></li>
            <li><a href="{{ route('account.address', ['id'=> Auth::user()->id]) }}">Mon adresse</a></li>
        </ul>
    </nav> <!-- end sidebar -->
    <div class="profile">
        <h1>Historique de mes commandes</h1>
        <div class="allOrders">
            @foreach ($checkouts as $value => $key)
            <div class="order">
                <span class="orderNb">Commande n°{{$value + 1}} </span>
                @if ( is_array($key) )

                    @foreach ($key as $data)
                        @if( !is_array($data) && !is_integer($data) )<p class="date">Date de la commande : {{$data}} <p></div>
                        @endif

                        @if ( is_array($data) )
                            <div>
                            @foreach ($data as $dt)
                            <div class="orderDetail">
                                <p> Article : {{$dt['nameProduct']}} </p>
                                <p> Quantité : {{$dt['quantity']}} </p>
                                <span> Sous-total : {{$dt['price']*$dt['quantity']/100}} euros</span>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        @if( !is_array($data) && is_integer($data) )<div class="orderTotal"><strong> Total : {{$data/100}} euros
                                </strong>
                        @endif
                    @endforeach
                @endif
            </div>

            @endforeach
        </>
    </div>
</section>
@endsection
