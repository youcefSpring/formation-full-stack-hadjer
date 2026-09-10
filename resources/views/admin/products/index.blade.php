@extends('admin.layouts.main')

@section('title', 'Products')

@section('content')
  @include('admin.layouts.page-heading', [
    'icon' => 'bi-box-seam',
    'eyebrow' => 'Catalog',
    'title' => 'Products',
    'subtitle' => 'Create, edit and delete products without leaving the page.',
    'actions' => '<button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#productCreateModal"><i class="bi bi-plus-lg"></i> New Product</button>',
  ])

  <section class="panel mt-3">
    <div class="panel-header">
      <div>
        <h2 class="h5 mb-1 section-title"><i class="bi bi-list-ul" aria-hidden="true"></i><span>All Products</span></h2>
        <p class="text-muted mb-0">{{ $products->total() }} products found.</p>
      </div>

      <form class="d-flex gap-2" method="GET" action="{{ route('admin.products.index') }}">
        <input class="form-control form-control-sm" type="search" name="search"
               value="{{ request('search') }}" placeholder="Search products">
        <select class="form-select form-select-sm" name="category_id">
          <option value="">All categories</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{ $category->name }}</option>
          @endforeach
        </select>
        <button class="btn btn-outline-secondary btn-sm" type="submit">Filter</button>
      </form>
    </div>

    <div class="table-responsive">
      <table class="table align-middle mb-0">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Product</th>
            <th scope="col">Category</th>
            <th scope="col">Status</th>
            <th scope="col" class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($products as $product)
            <tr>
              <td>{{ $product->id }}</td>
              <td class="fw-semibold">{{ $product->name }}</td>
              <td>{{ $product->category?->name ?? '—' }}</td>
              <td>
                <span class="badge {{ $product->status === 'active' ? 'text-bg-success' : 'text-bg-secondary' }}">
                  {{ ucfirst($product->status) }}
                </span>
              </td>
              <td class="text-end">
                <button class="btn btn-light btn-sm" type="button"
                        data-bs-toggle="modal" data-bs-target="#productEditModal"
                        data-action="{{ route('admin.products.update', $product) }}"
                        data-name="{{ $product->name }}"
                        data-category="{{ $product->category_id }}"
                        data-status="{{ $product->status }}">Edit</button>
                <button class="btn btn-danger btn-sm" type="button"
                        data-bs-toggle="modal" data-bs-target="#productDeleteModal"
                        data-action="{{ route('admin.products.destroy', $product) }}"
                        data-name="{{ $product->name }}">Delete</button>
              </td>
            </tr>
          @empty
            <tr><td colspan="5" class="text-center text-muted py-4">No products found.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-3">{{ $products->links() }}</div>
  </section>

  {{-- Create modal --}}
  <div class="modal fade" id="productCreateModal" tabindex="-1" aria-labelledby="productCreateLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <form class="modal-content" method="POST" action="{{ route('admin.products.store') }}">
        @csrf
        <input type="hidden" name="form" value="create">
        <div class="modal-header">
          <h5 class="modal-title" id="productCreateLabel">New Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          @include('admin.products.form', ['formId' => 'create'])
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>

  {{-- Edit modal --}}
  <div class="modal fade" id="productEditModal" tabindex="-1" aria-labelledby="productEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <form class="modal-content" method="POST" action="" id="productEditForm">
        @csrf
        @method('PUT')
        <input type="hidden" name="form" value="edit">
        <input type="hidden" name="form_action" id="productEditAction" value="">
        <div class="modal-header">
          <h5 class="modal-title" id="productEditLabel">Edit Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          @include('admin.products.form', ['formId' => 'edit'])
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>

  {{-- Delete modal --}}
  <div class="modal fade" id="productDeleteModal" tabindex="-1" aria-labelledby="productDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <form class="modal-content" method="POST" action="" id="productDeleteForm">
        @csrf
        @method('DELETE')
        <div class="modal-header">
          <h5 class="modal-title" id="productDeleteLabel">Delete Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="mb-0">Delete <strong id="productDeleteName"></strong>? This cannot be undone.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var editModal = document.getElementById('productEditModal');
    editModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget;
      if (!button) return;
      document.getElementById('productEditForm').action = button.dataset.action;
      document.getElementById('productEditAction').value = button.dataset.action;
      document.getElementById('name_edit').value = button.dataset.name;
      document.getElementById('category_id_edit').value = button.dataset.category;
      document.getElementById('status_edit').value = button.dataset.status;
    });

    var deleteModal = document.getElementById('productDeleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget;
      if (!button) return;
      document.getElementById('productDeleteForm').action = button.dataset.action;
      document.getElementById('productDeleteName').textContent = button.dataset.name;
    });

    @if ($errors->any() && old('form'))
      @if (old('form') === 'edit' && old('form_action'))
        document.getElementById('productEditForm').action = @json(old('form_action'));
        document.getElementById('productEditAction').value = @json(old('form_action'));
      @endif
      new bootstrap.Modal(document.getElementById('product{{ ucfirst(old('form')) }}Modal')).show();
    @endif
  });
</script>
@endpush
