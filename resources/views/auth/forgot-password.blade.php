@extends('layouts.auth')
@section('main-content')

<section class="auth-section">
    <div class="auth-card">
        <div class="auth-head">
            <a href="{{ url('/') }}" class="auth-icon"><i class="fas fa-key"></i></a>
            <h1>{{ __('Forgot your password?') }}</h1>
            <p>{{ __('Enter your email and we will send you a reset link.') }}</p>
        </div>

        <form method="POST" action="{{ route('password.email') }}" class="auth-form">
            @csrf

            <div class="field">
                <label for="email">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="input @error('email') has-error @enderror"
                       name="email" value="{{ old('email') }}" placeholder="you@example.com" required autofocus>
                @error('email')
                    <span class="field-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-block">
                {{ __('Send reset link') }} <i class="fas fa-paper-plane"></i>
            </button>
        </form>

        <p class="auth-alt">
            <a href="{{ route('show_login_form') }}">{{ __('Back to login') }}</a>
        </p>
    </div>
</section>

@endsection
