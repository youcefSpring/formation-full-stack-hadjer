@extends('admin.layouts.main')

@section('title', 'Dashboard')

@section('content')
  @include('admin.layouts.page-heading', [
    'icon' => 'bi-speedometer2',
    'eyebrow' => 'Overview',
    'title' => 'Dashboard',
    'subtitle' => 'Monitor products, categories and users from one clean workspace.',
  ])

  <section class="row g-3 mt-1" aria-label="Dashboard metrics">
    <div class="col-12 col-sm-6 col-xl-3">
      <article class="metric-card metric-primary">
        <div class="metric-top">
          <span class="metric-label">Products</span>
          <span class="metric-icon"><i class="bi bi-box-seam" aria-hidden="true"></i></span>
        </div>
        <div class="metric-value">{{ $productCount }}</div>
        <div class="metric-meta"><span>total products</span></div>
      </article>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
      <article class="metric-card metric-success">
        <div class="metric-top">
          <span class="metric-label">Active Products</span>
          <span class="metric-icon"><i class="bi bi-check2-circle" aria-hidden="true"></i></span>
        </div>
        <div class="metric-value">{{ $activeProductCount }}</div>
        <div class="metric-meta"><span>status active</span></div>
      </article>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
      <article class="metric-card metric-warning">
        <div class="metric-top">
          <span class="metric-label">Categories</span>
          <span class="metric-icon"><i class="bi bi-diagram-3" aria-hidden="true"></i></span>
        </div>
        <div class="metric-value">{{ $categoryCount }}</div>
        <div class="metric-meta"><span>including sub-categories</span></div>
      </article>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
      <article class="metric-card metric-danger">
        <div class="metric-top">
          <span class="metric-label">Users</span>
          <span class="metric-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
        </div>
        <div class="metric-value">{{ $userCount }}</div>
        <div class="metric-meta"><span>registered accounts</span></div>
      </article>
    </div>
  </section>

  <section class="row g-3 mt-1">
    <div class="col-12 col-xl-7">
      <div class="panel h-100">
        <div class="panel-header">
          <div>
            <h2 class="h5 mb-1 section-title"><i class="bi bi-box-seam" aria-hidden="true"></i><span>Latest Products</span></h2>
            <p class="text-muted mb-0">Most recently created products.</p>
          </div>
          <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.products.index') }}">Manage Products</a>
        </div>
        <div class="table-responsive">
          <table class="table align-middle mb-0">
            <thead>
              <tr>
                <th scope="col">Product</th>
                <th scope="col">Category</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($latestProducts as $product)
                <tr>
                  <td class="fw-semibold">{{ $product->name }}</td>
                  <td>{{ $product->category?->name ?? 'N/A' }}</td>
                  <td>
                    <span class="badge {{ $product->status === 'active' ? 'text-bg-success' : 'text-bg-secondary' }}">
                      {{ ucfirst($product->status) }}
                    </span>
                  </td>
                </tr>
              @empty
                <tr><td colspan="3" class="text-center text-muted py-4">No products yet.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-12 col-xl-5">
      <div class="panel h-100">
        <div class="panel-header">
          <div>
            <h2 class="h5 mb-1 section-title"><i class="bi bi-diagram-3" aria-hidden="true"></i><span>Top Categories</span></h2>
            <p class="text-muted mb-0">Categories ranked by product count.</p>
          </div>
          <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.categories.index') }}">Manage</a>
        </div>
        <div class="table-responsive">
          <table class="table align-middle mb-0">
            <thead>
              <tr>
                <th scope="col">Category</th>
                <th scope="col" class="text-end">Products</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($topCategories as $category)
                <tr>
                  <td class="fw-semibold">{{ $category->name }}</td>
                  <td class="text-end">{{ $category->products_count }}</td>
                </tr>
              @empty
                <tr><td colspan="2" class="text-center text-muted py-4">No categories yet.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
@endsection
