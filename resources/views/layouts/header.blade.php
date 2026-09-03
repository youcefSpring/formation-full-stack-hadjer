 <!-- ═══════════ HEADER ═══════════ -->
    <header class="header" id="header">
        <div class="container">
            <nav class="nav">
                <a href="#" class="logo">
                    <span class="logo-icon"><i class="fas fa-bolt"></i></span>
                    <span>Nova</span>
                </a>

                <ul class="nav-links" id="navLinks">
                    <li><a href="{{ route('products.index') }}">Products</a></li>
                    <li><a href="{{ route('categories.index') }}">Categories</a></li>
                  
                </ul>

                <div class="nav-actions">
                   <div class="search-wrapper">
    <button class="icon-btn" id="searchToggle" aria-label="Search">
        <i class="fas fa-search"></i>
    </button>

    <form action="{{ route('products.search') }}" method="GET" class="search-form" id="searchForm">
        <input
            type="text"
            name="search"
            id="searchInput"
            placeholder="Search products..."
            value="{{ request('search') }}"
            autocomplete="off"
        >
    </form>

</div>
                    <button class="icon-btn cart-btn" aria-label="Cart">
                        <i class="fas fa-shopping-bag"></i>
                        <span class="badge">3</span>
                    </button>
                    <button class="hamburger" id="hamburger" aria-label="Menu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
                 @if(!auth()->guard('login')->check())
            <div class="auth-links">
                <a href="{{ route('show_register_form') }}" class="btn btn-primary">Register</a>
                <a href="{{ route('show_login_form') }}" class="btn btn-secondary">Login</a>
            </div>
        @else
            <div class="auth-links">
                <span>Welcome, {{ auth()->guard('login')->user()->name }}</span>
                 <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-secondary">Logout</button>
                </form>
            </div>
        @endif
            </nav>
        </div>
    </header>