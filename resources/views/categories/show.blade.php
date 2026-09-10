@extends('layouts.main')

@section('title', $category->name)

@section('main-content')
<section class="page-head">
    <div class="container">
        <nav class="breadcrumbs" aria-label="Breadcrumb">
            <a href="{{ url('/') }}">Home</a> <span>/</span>
            <a href="{{ route('categories.index') }}">Categories</a> <span>/</span>
            <span>{{ $category->name }}</span>
        </nav>
        <h1>{{ $category->name }}</h1>
        <p>{{ $category->description ?: 'A small collection we keep coming back to.' }}</p>
    </div>
</section>

<section class="featured">
    <div class="container">
        <div class="products-grid">
            @forelse ($products as $product)
                <article class="product-card">
                    <span class="product-emoji">🎁</span>
                    <h2 class="product-name">{{ $product->name }}</h2>
                    <span class="tag {{ $product->status === 'active' ? '' : 'tag-muted' }}">
                        {{ $product->status === 'active' ? 'In stock' : 'Out of stock' }}
                    </span>
                </article>
            @empty
                <div class="empty-state" style="grid-column: 1 / -1;">
                    <span class="emoji">🍃</span>
                    <p>This shelf is empty for now.</p>
                </div>
            @endforelse
        </div>

        @if ($category->children->isNotEmpty())
            <div class="section-title" style="margin-top:56px;">
                <p class="eyebrow">Also inside</p>
                <h2>Sub-collections</h2>
            </div>
            <div class="categories-grid">
                @foreach ($category->children as $child)
                    <a class="category-item" href="{{ route('categories.show', $child->id) }}">{{ $child->name }}</a>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
