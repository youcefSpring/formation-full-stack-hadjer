@include('admin.layouts.head')
<body>
  <div class="admin-shell">
    <div class="sidebar-backdrop" data-sidebar-close></div>

    @include('admin.layouts.sidebar')

    <div class="admin-main">
      @include('admin.layouts.header')

      <main class="dashboard-content">
        <div class="container-fluid px-3 px-lg-4 py-4">
          @include('admin.layouts.alerts')
          @yield('content')
        </div>
      </main>

      @include('admin.layouts.footer')
    </div>
  </div>

  <script src="{{ asset('template_admin/assets/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('template_admin/assets/js/main.js') }}"></script>
  @stack('scripts')
</body>
</html>
