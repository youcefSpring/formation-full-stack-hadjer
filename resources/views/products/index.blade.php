@extends('layouts.main')

@section('title', 'Products')

@section('main-content')
<section class="page-head">
    <div class="container">
        <nav class="breadcrumbs" aria-label="Breadcrumb">
            <a href="{{ url('/') }}">Home</a> <span>/</span> <span>Products</span>
        </nav>
        <h1>Everything on the <span class="marker">shelves</span></h1>
        <p>
            @if (request('search'))
                Results for “{{ request('search') }}” — {{ $products->count() }} {{ Str::plural('item', $products->count()) }}.
            @else
                {{ $products->count() }} {{ Str::plural('item', $products->count()) }}, picked and described by hand.
            @endif
        </p>
    </div>
</section>

<section class="featured" id="featured">
    <div class="container">
        <div class="products-grid">
            @forelse ($products as $product)
                <article class="product-card">
                    <span class="product-emoji">🎁</span>
                    <h2 class="product-name">{{ $product->name }}</h2>
                    <span class="tag {{ $product->status === 'active' ? '' : 'tag-muted' }}">
                        <i class="fas fa-tag"></i> {{ $product->category?->name ?? 'Uncategorised' }}
                    </span>
                    <p class="product-meta">
                        {{ $product->status === 'active' ? 'In stock' : 'Currently unavailable' }}
                    </p>
                    <a class="btn-add" href="{{ route('categories.show', $product->category_id) }}">
                        <i class="fas fa-arrow-right"></i> More like this
                    </a>
                </article>
            @empty
                <div class="empty-state" style="grid-column: 1 / -1;">
                    <span class="emoji">🧺</span>
                    <p>Nothing here yet. Check back soon — we add things as we find them.</p>
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
            <p>Small, curated collections rather than endless aisles.</p>
        </div>

        <div class="categories-grid">
            @foreach ($categories as $category)
                <a class="category-item" href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a>
            @endforeach
        </div>
    </div>
</section>
@endsection
