@extends('layouts.auth')
@section('main-content')

<section class="auth-section">
    <div class="auth-card">
        <div class="auth-head">
            <a href="{{ url('/') }}" class="auth-icon"><i class="fas fa-lock"></i></a>
            <h1>{{ __('Reset password') }}</h1>
            <p>{{ __('Choose a new password for your account.') }}</p>
        </div>

        <form method="POST" action="{{ route('password.update') }}" class="auth-form">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="field">
                <label for="email">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="input @error('email') has-error @enderror"
                       name="email" value="{{ old('email', $email) }}" required autofocus>
                @error('email')
                    <span class="field-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label for="password">{{ __('New password') }}</label>
                <input id="password" type="password" class="input @error('password') has-error @enderror"
                       name="password" placeholder="••••••••" required autocomplete="new-password">
                @error('password')
                    <span class="field-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label for="password_confirmation">{{ __('Confirm password') }}</label>
                <input id="password_confirmation" type="password" class="input"
                       name="password_confirmation" placeholder="••••••••" required autocomplete="new-password">
            </div>

            <button type="submit" class="btn btn-primary btn-block">
                {{ __('Reset password') }} <i class="fas fa-arrow-right"></i>
            </button>
        </form>
    </div>
</section>

@endsection
