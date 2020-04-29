@extends('layout')
@section('featured-section')



<section class="containerMessages">
    @if (session()->has('success_message'))
        <div class="alert alert-success">
            {{ session()->get('success_message') }}
        </div>
    @endif

    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</section>

<section class="accountSection">
    <nav class="sidebar">

        <ul>
          <li class="active"><a href="{{ route('account.index') }}">Mon profil</a></li>
          <li><a href="{{ route('account.orders', ['id'=> Auth::user()->id]) }}">Mes commandes</a></li>
        </ul>
    </nav> <!-- end sidebar -->
    <div class="profile">

            <h1>Modifier mon profil</h1>


        <div class="formAccount">
            <form action="{{ route('account.update') }}" method="POST">
                @method('patch')
                @csrf
                <div class="form-group">
                    <div class="half-form">
                        <label for="name"> Identifiant : </label>
                        <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Name" required>
                    </div>
                    <div class="half-form"">
                        <label for="email"> Email : </label>
                        <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Email" required>
                    </div>
                </div>
                <div class="form-group">
                    <span>Laisse les mots de passe vides si tu ne souhaite pas le modifier.</span>
                    <div class="half-form">
                        <label for="password"> Nouveau mot de passe : </label>

                        <input id="password" type="password" name="password" placeholder="Password">
                    </div>
                    <div class="half-form">
                        <label for="password-confirm"> Confirmation du nouveau mot de passe : </label>
                        <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm Password">
                    </div>
                </div>
                <div>
                    <button type="submit">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection