@extends('admin.layouts.main')

@section('title', 'Categories')

@section('content')
  @include('admin.layouts.page-heading', [
    'icon' => 'bi-diagram-3',
    'eyebrow' => 'Catalog',
    'title' => 'Categories',
    'subtitle' => 'Create, edit and organize your category tree.',
    'actions' => '<a class="btn btn-primary btn-sm" href="' . route('admin.categories.create') . '"><i class="bi bi-plus-lg"></i> New Category</a>',
  ])

  <section class="panel mt-3">
    <div class="panel-header">
      <div>
        <h2 class="h5 mb-1 section-title"><i class="bi bi-list-ul" aria-hidden="true"></i><span>All Categories</span></h2>
        <p class="text-muted mb-0">{{ $categories->total() }} categories found.</p>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table align-middle mb-0">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Category</th>
            <th scope="col">Parent</th>
            <th scope="col">Products</th>
            <th scope="col" class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($categories as $category)
            <tr>
              <td>{{ $category->id }}</td>
              <td class="fw-semibold">{{ $category->name }}</td>
              <td>{{ $category->parent?->name ?? '—' }}</td>
              <td>{{ $category->products_count }}</td>
              <td class="text-end">
                <a class="btn btn-light btn-sm" href="{{ route('admin.categories.show', $category) }}">View</a>
                <a class="btn btn-light btn-sm" href="{{ route('admin.categories.edit', $category) }}">Edit</a>
                <form class="d-inline-block" method="POST"
                      action="{{ route('admin.categories.destroy', $category) }}"
                      onsubmit="return confirm('Delete category {{ $category->name }}?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="5" class="text-center text-muted py-4">No categories yet.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-3">{{ $categories->links() }}</div>
  </section>
@endsection
