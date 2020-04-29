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
    <h1>Inscription</h1>
    <div class="profile">
        <div class="formAccount Register">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name"> Identifiant : </label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                </div>

                <div class="form-group">
                    <label for="first_name"> Nom :</label>
                    <input id="first_name" type="text" value="{{ old('first_name') }}" required autofocus>
                </div>

                <div class="form-group">
                    <label for="last_name"> Prénom : </label>
                    <input id="last_name" type="text" value="{{ old('last_name') }}" required autofocus>
                </div>

                <div class="form-group">
                    <label for="email">Adresse E-mail : </label>
                    <input id="email" type="email" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe : </label>
                    <input id="password" type="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="password-confirm">Confirmation du mot de passe : </label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        required>
                </div>

                @if(config('settings.reCaptchStatus'))
                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-4">
                        <div class="g-recaptcha" data-sitekey="{{ config('settings.reCaptchSite') }}"></div>
                    </div>
                </div>
                @endif
                <input type="submit" value="S'enregistrer">
            </form>
        </div>
    </div>
</section>
@endsection
