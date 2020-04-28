@extends('layouts.app')

@section('title', 'Prihlaseni')

@section('content')
    <div class="content login-form">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <input type="hidden" name="email" value="{{ config('auth.default_email') }}">

            <div class="field">
                <label for="password" class="label">{{ __('Prihlaseni') }}</label>
                <div class="control">
                    <input id="password" type="password" class="input @error('email') is-danger @enderror"
                           name="password" required autocomplete="current-password" placeholder="Heslo">

                </div>

                @error('email')
                <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field is-grouped">
                <p class="control">
                    <button type="submit" class="button is-primary">
                        {{ __('Prihlasit') }}
                    </button>
                </p>
            </div>
        </form>
    </div>
@endsection
