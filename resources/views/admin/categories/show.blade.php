@extends('admin.layouts.main')

@section('title', 'Category Details')

@section('content')
  @include('admin.layouts.page-heading', [
    'icon' => 'bi-diagram-3',
    'eyebrow' => 'Catalog',
    'title' => $category->name,
    'subtitle' => $category->description ?: 'No description.',
    'actions' => '<a class="btn btn-outline-secondary btn-sm" href="' . route('admin.categories.index') . '">Back</a>'
                 . ' <a class="btn btn-primary btn-sm" href="' . route('admin.categories.edit', $category) . '">Edit</a>',
  ])

  <section class="row g-3 mt-1">
    <div class="col-12 col-xl-4">
      <div class="panel h-100">
        <div class="panel-header">
          <h2 class="h5 mb-0 section-title"><i class="bi bi-info-circle"></i><span>Details</span></h2>
        </div>
        <dl class="mb-0">
          <dt>ID</dt><dd>{{ $category->id }}</dd>
          <dt>Parent</dt><dd>{{ $category->parent?->name ?? '—' }}</dd>
          <dt>Sub-categories</dt><dd>{{ $category->children->count() }}</dd>
          <dt>Products</dt><dd>{{ $category->products->count() }}</dd>
          <dt>Created</dt><dd>{{ $category->created_at?->format('M d, Y') }}</dd>
        </dl>
      </div>
    </div>

    <div class="col-12 col-xl-8">
      <div class="panel h-100">
        <div class="panel-header">
          <h2 class="h5 mb-0 section-title"><i class="bi bi-box-seam"></i><span>Products</span></h2>
        </div>
        <div class="table-responsive">
          <table class="table align-middle mb-0">
            <thead><tr><th>Product</th><th>Status</th></tr></thead>
            <tbody>
              @forelse ($category->products as $product)
                <tr>
                  <td class="fw-semibold">{{ $product->name }}</td>
                  <td>
                    <span class="badge {{ $product->status === 'active' ? 'text-bg-success' : 'text-bg-secondary' }}">
                      {{ ucfirst($product->status) }}
                    </span>
                  </td>
                </tr>
              @empty
                <tr><td colspan="2" class="text-center text-muted py-4">No products in this category.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

  @if ($category->children->isNotEmpty())
    <section class="panel mt-3">
      <div class="panel-header">
        <h2 class="h5 mb-0 section-title"><i class="bi bi-diagram-2"></i><span>Sub-categories</span></h2>
      </div>
      <div class="d-flex flex-wrap gap-2">
        @foreach ($category->children as $child)
          <a class="btn btn-light btn-sm" href="{{ route('admin.categories.show', $child) }}">{{ $child->name }}</a>
        @endforeach
      </div>
    </section>
  @endif
@endsection
