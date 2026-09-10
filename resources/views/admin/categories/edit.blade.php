@extends('admin.layouts.main')

@section('title', 'Edit Category')

@section('content')
  @include('admin.layouts.page-heading', [
    'icon' => 'bi-pencil-square',
    'eyebrow' => 'Catalog',
    'title' => 'Edit Category',
    'subtitle' => $category->name,
  ])

  <section class="panel mt-3">
    <form method="POST" action="{{ route('admin.categories.update', $category) }}">
      @csrf
      @method('PUT')
      @include('admin.categories.form')

      <div class="d-flex gap-2 mt-4">
        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Update</button>
        <a class="btn btn-outline-secondary" href="{{ route('admin.categories.index') }}">Cancel</a>
      </div>
    </form>
  </section>
@endsection
