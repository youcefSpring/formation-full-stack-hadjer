@extends('layouts.main')
@section('main-content')

<section class="auth-section">
    <div class="auth-card">
        <div class="auth-head">
            <div class="auth-icon"><i class="fas fa-user-plus"></i></div>
            <h1>{{ __('Create your account') }}</h1>
            <p>{{ __('Join Nova and start shopping today') }}</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="auth-form">
            @csrf

            <div class="field">
                <label for="name">{{ __('Name') }}</label>
                <input id="name" type="text" class="input @error('name') has-error @enderror" name="name" value="{{ old('name') }}" placeholder="Jane Doe" required autocomplete="name" autofocus>
                @error('name')
                    <span class="field-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label for="email">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="input @error('email') has-error @enderror" name="email" value="{{ old('email') }}" placeholder="you@example.com" required autocomplete="email">
                @error('email')
                    <span class="field-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" class="input @error('password') has-error @enderror" name="password" placeholder="••••••••" required autocomplete="new-password">
                @error('password')
                    <span class="field-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="input" name="password_confirmation" placeholder="••••••••" required autocomplete="new-password">
            </div>

            <button type="submit" class="btn btn-primary btn-block">
                {{ __('Register') }} <i class="fas fa-arrow-right"></i>
            </button>
        </form>

        <p class="auth-alt">
            {{ __('Already have an account?') }}
            <a href="{{ route('show_login_form') }}">{{ __('Sign in') }}</a>
        </p>
    </div>
</section>

@endsection
