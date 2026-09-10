<aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">
  <div class="sidebar-header">
    <a class="brand-mark" href="{{ route('admin.dashboard') }}" aria-label="adminHMD dashboard">
      <span class="brand-icon"><i class="bi bi-grid-1x2-fill" aria-hidden="true"></i></span>
      <span class="brand-copy">
        <span class="brand-title">adminHMD</span>
        <span class="brand-subtitle">Admin Template</span>
      </span>
    </a>
  </div>

  <nav class="sidebar-nav">
    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
       href="{{ route('admin.dashboard') }}"
       @if(request()->routeIs('admin.dashboard')) aria-current="page" @endif>
      <span class="nav-icon"><i class="bi bi-speedometer2" aria-hidden="true"></i></span>
      <span class="nav-text">Dashboard</span>
    </a>
    <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"
       href="{{ route('admin.categories.index') }}">
      <span class="nav-icon"><i class="bi bi-diagram-3" aria-hidden="true"></i></span>
      <span class="nav-text">Categories</span>
    </a>
    <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}"
       href="{{ route('admin.products.index') }}">
      <span class="nav-icon"><i class="bi bi-box-seam" aria-hidden="true"></i></span>
      <span class="nav-text">Products</span>
    </a>
    <a class="nav-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}"
       href="{{ route('admin.profile.edit') }}">
      <span class="nav-icon"><i class="bi bi-person-gear" aria-hidden="true"></i></span>
      <span class="nav-text">Profile</span>
    </a>
  </nav>

  <div class="sidebar-user">
    <img class="avatar-img avatar-md sidebar-user-avatar"
         src="{{ asset('template_admin/assets/images/avatar/avatar.jpg') }}"
         alt="{{ auth()->user()?->name }}">
    <strong>{{ auth()->user()?->name ?? 'Admin' }}</strong>
    <small>Active Workspace</small>
  </div>

  <div class="sidebar-footer">
    <span class="status-dot"></span>
    <span class="sidebar-footer-text">System running smoothly</span>
  </div>
</aside>
