@extends('admin.layouts.main')

@section('title', 'Profile')

@section('content')
  @include('admin.layouts.page-heading', [
    'icon' => 'bi-person-gear',
    'eyebrow' => 'Account',
    'title' => 'My Profile',
    'subtitle' => 'Update your account information and password.',
  ])

  <section class="row g-3 mt-1">
    <div class="col-12 col-xl-6">
      <div class="panel h-100">
        <div class="panel-header">
          <div>
            <h2 class="h5 mb-1 section-title"><i class="bi bi-person"></i><span>Profile Information</span></h2>
            <p class="text-muted mb-0">Your name and email address.</p>
          </div>
        </div>

        <form method="POST" action="{{ route('admin.profile.update') }}">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label class="form-label" for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control"
                   value="{{ old('name', $user->name) }}" required>
          </div>

          <div class="mb-3">
            <label class="form-label" for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control"
                   value="{{ old('email', $user->email) }}" required>
          </div>

          <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Save changes</button>
        </form>
      </div>
    </div>

    <div class="col-12 col-xl-6">
      <div class="panel h-100">
        <div class="panel-header">
          <div>
            <h2 class="h5 mb-1 section-title"><i class="bi bi-shield-lock"></i><span>Change Password</span></h2>
            <p class="text-muted mb-0">Use a long, random password to stay secure.</p>
          </div>
        </div>

        <form method="POST" action="{{ route('admin.profile.password') }}">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label class="form-label" for="current_password">Current password</label>
            <input type="password" id="current_password" name="current_password" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label" for="password">New password</label>
            <input type="password" id="password" name="password" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label" for="password_confirmation">Confirm new password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
          </div>

          <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Update password</button>
        </form>

        <hr class="my-4">
        <p class="text-muted mb-2">Forgot your current password?</p>
        <a class="btn btn-outline-secondary btn-sm" href="{{ route('password.request') }}">
          <i class="bi bi-envelope"></i> Send a reset link by email
        </a>
      </div>
    </div>
  </section>
@endsection
