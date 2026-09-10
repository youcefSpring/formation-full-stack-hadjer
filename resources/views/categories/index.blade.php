@extends('layouts.main')

@section('title', 'Categories')

@section('main-content')
<section class="page-head">
    <div class="container">
        <nav class="breadcrumbs" aria-label="Breadcrumb">
            <a href="{{ url('/') }}">Home</a> <span>/</span> <span>Categories</span>
        </nav>
        <h1>Collections, <span class="marker">shelf by shelf</span></h1>
        <p>Every category is grouped the way we would arrange a real shop — a few good things together.</p>
    </div>
</section>

<section class="featured">
    <div class="container">
        <div class="products-grid">
            @forelse ($categories as $category)
                <article class="product-card">
                    <span class="product-emoji">🗂️</span>
                    <h2 class="product-name">{{ $category->name }}</h2>

                    @if ($category->parent)
                        <p class="product-meta">Part of {{ $category->parent->name }}</p>
                    @endif

                    <span class="tag">
                        <i class="fas fa-box"></i> {{ $category->active_products_count }} available
                    </span>

                    @if ($category->inactive_products_count)
                        <span class="tag tag-muted">{{ $category->inactive_products_count }} out of stock</span>
                    @endif

                    @if ($category->allChildren->isNotEmpty())
                        <ul class="cat-tree">
                            @foreach ($category->allChildren as $child)
                                <li>{{ $child->name }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <a href="{{ route('categories.show', $category->id) }}" class="btn-add">
                        <i class="fas fa-arrow-right"></i> View products
                    </a>
                </article>
            @empty
                <div class="empty-state" style="grid-column: 1 / -1;">
                    <span class="emoji">🗃️</span>
                    <p>No categories yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
