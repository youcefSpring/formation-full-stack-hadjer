@extends('layouts.main')
@section('main-content')
 
    <!-- ═══════════ FEATURED PRODUCTS (simplified) ═══════════ -->
    <section class="featured" id="featured">
        <div class="container">
            <div class="section-title">
                <h2>⭐ Featured <span>Products</span></h2>
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

    <!-- ═══════════ CATEGORIES (simplified) ═══════════ -->
    <section class="categories" id="categories">
        <div class="container">
            <div class="section-title">
                <h2>📂 Shop by <span>Category</span></h2>
                <p>Find exactly what you need — curated collections.</p>
            </div>

            <div class="categories-grid">
                @foreach ($categories as $category)
                    <div class="category-item">
                        <a href="{{ route('categories.show', $category->id) }}" class="cat-name">
                            {{ $category->name }}</a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

            </div>
        </div>
    </section>
@endsection
   

  

  

