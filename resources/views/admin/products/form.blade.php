@php($isActiveForm = old('form') === $formId)
<div class="mb-3">
  <label class="form-label" for="name_{{ $formId }}">Name <span class="text-danger">*</span></label>
  <input type="text" id="name_{{ $formId }}" name="name"
         class="form-control @if($isActiveForm) @error('name') is-invalid @enderror @endif"
         value="{{ $isActiveForm ? old('name') : '' }}" required>
  @if ($isActiveForm)
    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
  @endif
</div>

<div class="mb-3">
  <label class="form-label" for="category_id_{{ $formId }}">Category <span class="text-danger">*</span></label>
  <select id="category_id_{{ $formId }}" name="category_id"
          class="form-select @if($isActiveForm) @error('category_id') is-invalid @enderror @endif" required>
    <option value="">— Select a category —</option>
    @foreach ($categories as $category)
      <option value="{{ $category->id }}" @selected($isActiveForm && old('category_id') == $category->id)>
        {{ $category->name }}
      </option>
    @endforeach
  </select>
  @if ($isActiveForm)
    @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
  @endif
</div>

<div class="mb-0">
  <label class="form-label" for="status_{{ $formId }}">Status <span class="text-danger">*</span></label>
  <select id="status_{{ $formId }}" name="status"
          class="form-select @if($isActiveForm) @error('status') is-invalid @enderror @endif" required>
    <option value="active" @selected($isActiveForm ? old('status') === 'active' : true)>Active</option>
    <option value="inactive" @selected($isActiveForm && old('status') === 'inactive')>Inactive</option>
  </select>
  @if ($isActiveForm)
    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
  @endif
</div>
