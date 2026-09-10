# Storefront (user facing pages)

## Layout

Same fix as the admin side: `layouts/main.blade.php` used nested `@extends`,
which Blade ignores (only the last one wins), so pages rendered without a
header or footer. Layout parts are now `@include`d.

```
resources/views/layouts/
├── main.blade.php    head + header + flash + @yield('main-content') + footer
├── auth.blade.php    same shell, used by the login/register/reset pages
├── head.blade.php    <head>, fonts, stylesheet, @yield('title'), @stack('styles')
├── header.blade.php  logo, nav, search, cart, auth links
├── flash.blade.php   session success/error + validation errors
└── footer.blade.php  footer, shared JS, @stack('scripts'), </body>
```

A page is:

```blade
@extends('layouts.main')
@section('title', 'Products')
@section('main-content') ... @endsection
@push('scripts') <script>…</script> @endpush
```

## Pages

| Route | View | Notes |
|-------|------|-------|
| `/` (`home`) | `welcome.blade.php` | hero, latest 8 active products, categories, testimonials, newsletter |
| `/products` | `products/index.blade.php` | all products + category shelf list |
| `POST /products/search` | same view | search by name |
| `/categories` | `categories/index.blade.php` | category cards with stock counts and sub-category tree |
| `/categories/{id}` | `categories/show.blade.php` | products of the category + sub-collections |
| `/login`, `/register`, `/forgot-password`, `/reset-password/{token}` | `auth/*` | share `layouts.auth` |

Changes made:

* `/` is now `HomeController@index` instead of `Route::view`, so the home page
  shows real products and counts instead of hardcoded demo data.
* `CategoryController@show` loads the category itself (it only loaded products
  before, so the page could not show its own name) and renders an empty state
  instead of redirecting away when the category has no products.
* The product cards no longer print `$product->price` — the `products` table
  has no `price` column, so `number_format(null)` was a deprecation warning on
  every card. Cards show the category and stock status instead.
* The search form posts to `products.search` with a CSRF token (the route is
  `POST`; the header form was sending `GET`).
* `welcome.blade.php` had 1300 lines of inline CSS duplicating the stylesheet;
  it now uses the shared stylesheet.
* The demo `alert()` calls (newsletter, add-to-cart, category click) were
  removed — the newsletter confirms inline instead.

## Design direction — "humanized"

`public/assets/frontend/style.css` was rewritten. The old theme was a dark
purple neon gradient, the default look of a generated template. The new one
reads as a small physical shop:

| Choice | Value | Why |
|--------|-------|-----|
| Background | warm paper `#fbf7f0` + two faint radial washes | printed page, not a screen |
| Text | ink `#241f1c`, soft `#5c534c` | never pure black on pure white |
| Accent | clay/terracotta `#c4643c` | warm, one accent only |
| Secondary | olive `#5a6b4b`, honey, berry | for stock, tape, alerts |
| Display font | Fraunces (serif) | human, slightly old-fashioned |
| Body font | Inter | plain and readable |
| Corners | uneven radii (`26px 26px 30px 22px`) | hand-cut rather than machine-perfect |
| Cards | ±0.5° rotation on some cards, tape strip on the hero card | laid out by hand |
| `.marker` | soft blob highlight behind a word | drawn on with a marker pen |
| Copy | plain sentences, first person | written by a person |

Accessibility: all motion is disabled under `prefers-reduced-motion`, focus
states keep a visible border, and the accent colours meet contrast on paper.

To rebrand, change the custom properties in the `:root` block — nothing else
hardcodes a colour.
