# Admin Dashboard & Layout

## Layout files

All admin pages extend one master layout:

```
resources/views/admin/layouts/
├── main.blade.php          master layout (@yield('content'))
├── head.blade.php          <head> + assets + @yield('title')
├── sidebar.blade.php       navigation (active state via request()->routeIs())
├── header.blade.php        topbar: theme toggle, profile dropdown, logout
├── footer.blade.php        footer
├── alerts.blade.php        session success/error + validation errors
└── page-heading.blade.php  reusable page title block
```

Previously every page duplicated the whole HTML document and used `@extends`
inside `@extends`, which Blade does not support (only the last `@extends` wins).
Layout parts are now `@include`d by `main.blade.php`, and pages use
`@extends('admin.layouts.main')` + `@section('content')`.

## Adding a new admin page

```blade
@extends('admin.layouts.main')

@section('title', 'My Page')

@section('content')
  @include('admin.layouts.page-heading', [
    'icon' => 'bi-star',
    'eyebrow' => 'Section',
    'title' => 'My Page',
    'subtitle' => 'Short description.',
    'actions' => '<a class="btn btn-primary btn-sm" href="#">Action</a>', // optional raw HTML
  ])

  <section class="panel mt-3"> ... </section>
@endsection

@push('scripts') <script>/* page JS */</script> @endpush
```

Add a link in `admin/layouts/sidebar.blade.php`.

## Dashboard data

`App\Http\Controllers\Admin\DashboardController@index` passes:

| Variable | Meaning |
|----------|---------|
| `productCount` | all products |
| `activeProductCount` | products with `status = active` |
| `categoryCount` | all categories |
| `userCount` | registered users |
| `latestProducts` | 5 newest products with their category |
| `topCategories` | 5 categories ordered by `products_count` |

All hardcoded template demo data (fake users, fake charts) was removed.

## Routes

`routes/admin.php`, prefix `admin`, name prefix `admin.`, middleware `auth:login`.
The dashboard route name was `' dashboard'` (leading space) and is now `dashboard`,
so `route('admin.dashboard')` works — that name is used by `AuthController@login`.
