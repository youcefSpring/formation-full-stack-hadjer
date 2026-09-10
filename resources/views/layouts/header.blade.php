<header class="header" id="header">
    <div class="container">
        <nav class="nav">
            <a href="{{ url('/') }}" class="logo">
                <span class="logo-icon"><i class="fas fa-seedling"></i></span>
                <span>Nova</span>
            </a>

            <ul class="nav-links" id="navLinks">
                <li><a class="{{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">Products</a></li>
                <li><a class="{{ request()->routeIs('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}">Categories</a></li>
            </ul>

            <div class="nav-actions">
                <div class="search-wrapper">
                    <button class="icon-btn" id="searchToggle" type="button" aria-label="Search">
                        <i class="fas fa-search"></i>
                    </button>

                    <form action="{{ route('products.search') }}" method="POST" class="search-form" id="searchForm">
                        @csrf
                        <input type="text" name="search" id="searchInput"
                               placeholder="Search products…"
                               value="{{ request('search') }}" autocomplete="off">
                    </form>
                </div>

                <button class="icon-btn cart-btn" type="button" aria-label="Cart">
                    <i class="fas fa-shopping-bag"></i>
                    <span class="badge">3</span>
                </button>

                <button class="hamburger" id="hamburger" type="button" aria-label="Menu">
                    <span></span><span></span><span></span>
                </button>
            </div>

            @guest('login')
                <div class="auth-links">
                    <a href="{{ route('show_register_form') }}" class="btn btn-primary">Register</a>
                    <a href="{{ route('show_login_form') }}" class="btn btn-secondary">Login</a>
                </div>
            @else
                <div class="auth-links">
                    <span class="greeting">Hi, <strong>{{ auth('login')->user()->name }}</strong></span>
                    @if (auth('login')->user()->user_type === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-ghost">Dashboard</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-secondary">Logout</button>
                    </form>
                </div>
            @endguest
        </nav>
    </div>
</header>
