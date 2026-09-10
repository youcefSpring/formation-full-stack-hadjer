# Products CRUD — modal based

Everything happens on `/admin/products`: create, edit and delete open a
Bootstrap 5 modal, submit a normal form and redirect back to the list.

## Routes

```php
Route::resource('products', ProductController::class)
    ->only(['index', 'store', 'update', 'destroy']);
```

No `create` / `edit` / `show` pages exist — the modals replace them.

| Method | URI | Name |
|--------|-----|------|
| GET | `/admin/products` | `admin.products.index` |
| POST | `/admin/products` | `admin.products.store` |
| PUT | `/admin/products/{product}` | `admin.products.update` |
| DELETE | `/admin/products/{product}` | `admin.products.destroy` |

## Views

```
resources/views/admin/products/
├── index.blade.php   table + filters + 3 modals + modal JS
└── form.blade.php    shared fields: name, category_id, status
```

## How the modals get their data

The Edit and Delete buttons carry `data-*` attributes:

```blade
<button data-bs-toggle="modal" data-bs-target="#productEditModal"
        data-action="{{ route('admin.products.update', $product) }}"
        data-name="{{ $product->name }}"
        data-category="{{ $product->category_id }}"
        data-status="{{ $product->status }}">Edit</button>
```

On Bootstrap's `show.bs.modal` event the script reads `event.relatedTarget`
and fills the form action and inputs. No AJAX, no extra endpoint.

## Validation errors inside a modal

A failed validation redirects back, so the modal would normally close. Each
form posts a hidden `form` field (`create` / `edit`); on reload the page
re-opens the matching modal and re-renders old input plus `is-invalid`
messages. The edit form also posts `form_action` so its action URL survives
the round trip.

## Filters

The panel header has a GET form with `search` (name LIKE) and `category_id`.
Pagination keeps the filters via `withQueryString()`.

## Validation rules

```php
'name'        => required|string|max:255|unique:products,name (ignoring current)
'category_id' => required|exists:categories,id
'status'      => required|in:active,inactive
```

`status` was added to `Product::$fillable` so it can be mass assigned.
