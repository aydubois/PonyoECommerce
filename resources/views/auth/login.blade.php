@extends('layout')

@section('featured-section')
@if(count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<section class="accountSection Login">
    <h1>Connexion</h1>
    <div class="profile">

        <div class="formAccount">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Adresse E-mail : </label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>

                    <input id="password" type="password" name="password" required>
                </div>


                <input type="submit" value="Se connecter">

            </form>
        </div>
    </div>
</section>
@endsection
