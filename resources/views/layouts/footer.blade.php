<footer class="footer">
    <div class="container footer-inner">
        <p>© {{ date('Y') }} Nova — made by people, for people.</p>
        <div class="footer-links">
            <a href="{{ route('products.index') }}">Products</a>
            <a href="{{ route('categories.index') }}">Categories</a>
            @guest('login')
                <a href="{{ route('show_login_form') }}">Login</a>
            @endguest
        </div>
    </div>
</footer>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Search field slides open from the magnifier button
    var searchToggle = document.getElementById('searchToggle');
    var searchForm = document.getElementById('searchForm');
    var searchInput = document.getElementById('searchInput');

    if (searchToggle && searchForm && searchInput) {
        searchToggle.addEventListener('click', function () {
            searchForm.classList.toggle('active');
            if (searchForm.classList.contains('active')) searchInput.focus();
        });

        searchInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') { e.preventDefault(); searchForm.submit(); }
        });
    }

    // Mobile menu
    var hamburger = document.getElementById('hamburger');
    var navLinks = document.getElementById('navLinks');
    if (hamburger && navLinks) {
        hamburger.addEventListener('click', function () {
            this.classList.toggle('active');
            navLinks.classList.toggle('open');
        });
    }

    // Header gets a border once the page is scrolled
    var header = document.getElementById('header');
    if (header) {
        window.addEventListener('scroll', function () {
            header.classList.toggle('scrolled', window.scrollY > 40);
        });
    }
});
</script>
@stack('scripts')

</body>
</html>
