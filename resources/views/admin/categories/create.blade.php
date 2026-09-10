@extends('admin.layouts.main')

@section('title', 'New Category')

@section('content')
  @include('admin.layouts.page-heading', [
    'icon' => 'bi-plus-circle',
    'eyebrow' => 'Catalog',
    'title' => 'New Category',
    'subtitle' => 'Add a new category to the catalog.',
  ])

  <section class="panel mt-3">
    <form method="POST" action="{{ route('admin.categories.store') }}">
      @csrf
      @include('admin.categories.form')

      <div class="d-flex gap-2 mt-4">
        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Save</button>
        <a class="btn btn-outline-secondary" href="{{ route('admin.categories.index') }}">Cancel</a>
      </div>
    </form>
  </section>
@endsection
