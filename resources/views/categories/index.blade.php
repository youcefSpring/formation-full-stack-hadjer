@extends('layouts.main')
@section('main-content')
 
    <!-- ═══════════ FEATURED PRODUCTS (simplified) ═══════════ -->
    <section class="featured" id="featured">
        <div class="container">
            <div class="section-title">
                <h2>⭐ Featured <span>Categories</span></h2>
                <p>Handpicked favorites — don't miss out on these bestsellers.</p>
            </div>

            <div class="products-grid">
                <!-- Card 1 -->
                 @foreach ($categories as $category)
                <div class="product-card">
                    <span class="product-emoji">🎧</span>
                    <div class="product-name">
                        {{ $category->name }}
                    </div>
                    <a href="{{ route('categories.show', $category->id) }}" class="btn-add"><i class="fas fa-plus"></i> View products</a>
                </div>
                @endforeach
            </div>
        </div>
    </section>


            </div>
        </div>
    </section>

   
@endsection