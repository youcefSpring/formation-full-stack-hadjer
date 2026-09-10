@extends('layouts.main')

@section('title', 'Home')

@section('main-content')

<section class="hero" id="hero">
    <div class="container hero-grid">
        <div>
            <p class="eyebrow">Small shop · real people</p>
            <h1>Good things, <span class="marker">chosen slowly</span>.</h1>
            <p>
                We keep a short list instead of an endless catalogue. Every item here was
                picked by someone who actually uses it, and written up in plain words.
            </p>

            <div class="hero-actions">
                <a href="{{ route('products.index') }}" class="btn btn-primary">
                    Browse the shelves <i class="fas fa-arrow-right"></i>
                </a>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">See collections</a>
            </div>

            <blockquote class="hero-note">
                “If we would not keep it in our own kitchen, it does not go on the shelf.”
            </blockquote>
        </div>

        <aside class="hero-card">
            <p class="eyebrow">Today in the shop</p>
            <h2 style="font-size:1.5rem;margin:8px 0 4px;">Fresh off the workbench</h2>
            <p style="color:var(--ink-soft);font-size:.95rem;">
                A quick look at what changed this week.
            </p>

            <div class="hero-stats">
                <div class="hero-stat">
                    <strong>{{ $productCount }}</strong>
                    <span>items in stock</span>
                </div>
                <div class="hero-stat">
                    <strong>{{ $categoryCount }}</strong>
                    <span>collections</span>
                </div>
                <div class="hero-stat">
                    <strong>1–2d</strong>
                    <span>packed by hand</span>
                </div>
            </div>
        </aside>
    </div>
</section>

<section class="featured" id="featured">
    <div class="container">
        <div class="section-title">
            <p class="eyebrow">On the shelf</p>
            <h2>Recently <span class="marker">added</span></h2>
            <p>The newest arrivals, still smelling of the packing paper.</p>
        </div>

        <div class="products-grid">
            @forelse ($products as $product)
                <article class="product-card">
                    <span class="product-emoji">🎁</span>
                    <h3 class="product-name">{{ $product->name }}</h3>
                    <span class="tag"><i class="fas fa-tag"></i> {{ $product->category?->name ?? 'Uncategorised' }}</span>
                    <a class="btn-add" href="{{ route('categories.show', $product->category_id) }}">
                        <i class="fas fa-arrow-right"></i> More like this
                    </a>
                </article>
            @empty
                <div class="empty-state" style="grid-column: 1 / -1;">
                    <span class="emoji">🧺</span>
                    <p>The shelves are being restocked. Come back in a moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<section class="categories" id="categories">
    <div class="container">
        <div class="section-title">
            <p class="eyebrow">Browse</p>
            <h2>Shop by <span class="marker">category</span></h2>
            <p>Grouped the way a shop is arranged, not the way a database is.</p>
        </div>

        <div class="categories-grid">
            @foreach ($categories as $category)
                <a class="category-item" href="{{ route('categories.show', $category->id) }}">
                    {{ $category->name }}
                    <span style="color:var(--ink-faint);">· {{ $category->active_products_count }}</span>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section class="testimonials" id="testimonials">
    <div class="container">
        <div class="section-title">
            <p class="eyebrow">In their words</p>
            <h2>What people <span class="marker">tell us</span></h2>
        </div>

        <div class="testimonials-grid">
            <figure class="testimonial">
                <p>“It arrived wrapped in newspaper with a note. I have never had that from a shop before.”</p>
                <figcaption class="testimonial-author">
                    <span class="testimonial-avatar">S</span>
                    <div><strong>Sarah A.</strong><small>Ordered twice this month</small></div>
                </figcaption>
            </figure>

            <figure class="testimonial">
                <p>“Fewer things to scroll through, and the descriptions actually say what the thing is.”</p>
                <figcaption class="testimonial-author">
                    <span class="testimonial-avatar">R</span>
                    <div><strong>Rafi K.</strong><small>Regular since last spring</small></div>
                </figcaption>
            </figure>

            <figure class="testimonial">
                <p>“I emailed with a question and a person answered. That is the whole review.”</p>
                <figcaption class="testimonial-author">
                    <span class="testimonial-avatar">N</span>
                    <div><strong>Nadia I.</strong><small>First order</small></div>
                </figcaption>
            </figure>
        </div>
    </div>
</section>

<section class="newsletter" id="newsletter">
    <div class="container">
        <div class="newsletter-inner">
            <p class="eyebrow">One letter a month</p>
            <h2>Notes from the shop</h2>
            <p>What came in, what we are reading, and the occasional mistake we made. No sales blasts.</p>

            <form class="newsletter-form" id="newsletterForm">
                <input type="email" name="email" placeholder="you@example.com" required aria-label="Email address">
                <button type="submit" class="btn btn-primary">Subscribe</button>
            </form>
            <p id="newsletterMsg" style="margin-top:14px;min-height:1.4em;"></p>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Demo-only newsletter: no backend endpoint yet, so confirm inline (never alert())
    var form = document.getElementById('newsletterForm');
    var msg = document.getElementById('newsletterMsg');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        var input = form.querySelector('input[type="email"]');
        if (!input.value.trim()) return;
        msg.textContent = 'Thank you — we will write to ' + input.value.trim() + ' soon.';
        msg.style.color = 'var(--olive)';
        input.value = '';
    });
});
</script>
@endpush
