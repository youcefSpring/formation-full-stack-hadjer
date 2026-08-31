<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nova — Modern Ecommerce</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/style.css') }}" />
</head>
<body>

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
                    <button class="icon-btn" aria-label="Search">
                        <i class="fas fa-search"></i>
                    </button>
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
            </nav>
        </div>
    </header>

 
    <!-- ═══════════ FEATURED PRODUCTS (simplified) ═══════════ -->
    <section class="featured" id="featured">
        <div class="container">
            <div class="section-title">
                <h2>⭐ Featured <span>Categories</span></h2>
                <p>Handpicked favorites — don't miss out on these bestsellers.</p>
            </div>

            <div class="products-grid">
                <!-- Card 1 -->
                 @foreach ($products as $product)
                <div class="product-card">
                    <span class="product-emoji">🎧</span>
                    <div class="product-name">
                        {{ $product->name }}
                    </div>
                    <div class="product-price">${{ number_format($product->price, 2) }}</div>
                    <button class="btn-add"><i class="fas fa-plus"></i> category : {{ $product->category->name }}</button>
                </div>
                @endforeach
            </div>
        </div>
    </section>


            </div>
        </div>
    </section>

   

  

  

    <!-- ═══════════ JAVASCRIPT ═══════════ -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ─── Hamburger ───
            const hamburger = document.getElementById('hamburger');
            const navLinks = document.getElementById('navLinks');

            hamburger.addEventListener('click', function() {
                this.classList.toggle('active');
                navLinks.classList.toggle('open');
            });

            // Close nav on link click (mobile)
            navLinks.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    hamburger.classList.remove('active');
                    navLinks.classList.remove('open');
                });
            });

            // ─── Header scroll effect ───
            const header = document.getElementById('header');
            let lastScroll = 0;

            window.addEventListener('scroll', function() {
                const currentScroll = window.pageYOffset || document.documentElement.scrollTop;
                if (currentScroll > 50) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
                lastScroll = currentScroll;
            });

            // ─── Newsletter ───
            const newsletterForm = document.getElementById('newsletterForm');
            newsletterForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const input = this.querySelector('input[type="email"]');
                if (input.value.trim()) {
                    alert('🎉 Thanks for subscribing! You\'ll hear from us soon.');
                    input.value = '';
                }
            });

            // ─── "Add to Cart" buttons ───
            const addButtons = document.querySelectorAll('.btn-add');
            addButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const card = this.closest('.product-card');
                    const name = card.querySelector('.product-name')?.textContent || 'Product';
                    // Animate feedback
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-check"></i> Added!';
                    this.style.background = '#00c49a';
                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.style.background = '';
                    }, 1500);

                    // Update badge count (demo)
                    const badge = document.querySelector('.badge');
                    if (badge) {
                        let count = parseInt(badge.textContent) || 0;
                        badge.textContent = count + 1;
                    }
                });
            });

            // ─── Category click ───
            document.querySelectorAll('.category-item').forEach(item => {
                item.addEventListener('click', function() {
                    const name = this.querySelector('.cat-name')?.textContent || 'Category';
                    alert(`🛍️ Exploring ${name} — coming soon!`);
                });
            });

            // ─── Smooth anchor scroll ───
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    const targetEl = document.querySelector(targetId);
                    if (targetEl) {
                        e.preventDefault();
                        const offset = 80;
                        const top = targetEl.getBoundingClientRect().top + window.pageYOffset - offset;
                        window.scrollTo({ top, behavior: 'smooth' });
                    }
                });
            });

        });
    </script>

</body>
</html>