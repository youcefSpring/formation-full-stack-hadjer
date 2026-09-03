@extends('layouts.main')
@section('main-content')

<section class="auth-section">
    <div class="auth-card">
        <div class="auth-head">
            <div class="auth-icon"><i class="fas fa-bolt"></i></div>
            <h1>{{ __('Welcome back') }}</h1>
            <p>{{ __('Sign in to continue shopping on Nova') }}</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="auth-form">
            @csrf

            <div class="field">
                <label for="email">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="input @error('email') has-error @enderror" name="email" value="{{ old('email') }}" placeholder="you@example.com" required autocomplete="email" autofocus>
                @error('email')
                    <span class="field-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" class="input @error('password') has-error @enderror" name="password" placeholder="••••••••" required autocomplete="current-password">
                @error('password')
                    <span class="field-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-block">
                {{ __('Login') }} <i class="fas fa-arrow-right"></i>
            </button>
        </form>

        <p class="auth-alt">
            {{ __("Don't have an account?") }}
            <a href="{{ route('show_register_form') }}">{{ __('Create one') }}</a>
        </p>
    </div>
</section>

@endsection
