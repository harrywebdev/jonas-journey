@extends('layouts.app')

@section('title', 'Prihlaseni')

@section('content')
    <div class="content login-form">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            @if ($isAdmin)
                <input type="hidden" name="email" value="{{ config('auth.admin_email') }}">
            @else
                <input type="hidden" name="email" value="{{ config('auth.default_email') }}">
            @endif

            <div class="field">
                <label for="password" class="label">{{ __('global.login.title') }}</label>
                <div class="control">
                    <input id="password" type="password" class="input @error('email') is-danger @enderror"
                           name="password" required autocomplete="current-password"
                           placeholder="{{ __('global.login.fields.password') }}">
                </div>

                @error('email')
                <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field is-grouped">
                <p class="control">
                    <button type="submit" class="button is-primary">
                        {{ __('global.login.actions.login') }}
                    </button>
                </p>
            </div>
        </form>
    </div>
@endsection
