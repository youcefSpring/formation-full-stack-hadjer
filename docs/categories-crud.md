# Categories CRUD — classic (page based)

Full resource routes, one page per action.

## Routes

```php
Route::resource('categories', CategoryController::class);
```

| Method | URI | Name | Action |
|--------|-----|------|--------|
| GET | `/admin/categories` | `admin.categories.index` | paginated list |
| GET | `/admin/categories/create` | `admin.categories.create` | create form |
| POST | `/admin/categories` | `admin.categories.store` | save |
| GET | `/admin/categories/{category}` | `admin.categories.show` | details |
| GET | `/admin/categories/{category}/edit` | `admin.categories.edit` | edit form |
| PUT | `/admin/categories/{category}` | `admin.categories.update` | update |
| DELETE | `/admin/categories/{category}` | `admin.categories.destroy` | delete |

Route model binding is used everywhere (`Category $category`), so a missing id
returns 404 instead of a crash.

## Views

```
resources/views/admin/categories/
├── index.blade.php   table + pagination + delete confirm
├── create.blade.php  wraps form.blade.php
├── edit.blade.php    wraps form.blade.php (@method('PUT'))
├── form.blade.php    shared fields: name, parent_id, description
└── show.blade.php    details, products, sub-categories
```

`form.blade.php` expects `$category` (an empty `new Category()` on create) and
`$parents` (selectable parents; on edit the category itself is excluded so it
cannot become its own parent).

## Validation

```php
'name'        => required|string|max:255|unique:categories,name (ignoring current)
'description' => nullable|string|max:2000
'parent_id'   => nullable|exists:categories,id (never the current category)
```

## Delete rule

A category that still has products is not deleted; the user gets
`session('error')` back. Empty the category or reassign its products first.

## Flash messages

`success` / `error` and validation errors are rendered by
`admin/layouts/alerts.blade.php`, included once in the master layout.
