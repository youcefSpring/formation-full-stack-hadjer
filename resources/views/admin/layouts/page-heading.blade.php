<div class="page-heading">
  <div class="page-heading-copy">
    <span class="page-icon"><i class="bi {{ $icon ?? 'bi-speedometer2' }}" aria-hidden="true"></i></span>
    <div>
      <p class="eyebrow mb-1">{{ $eyebrow ?? 'Overview' }}</p>
      <h1 class="h3 mb-1">{{ $title }}</h1>
      <p class="text-muted mb-0">{{ $subtitle ?? '' }}</p>
    </div>
  </div>
  @isset($actions)
    <div class="heading-actions">{!! $actions !!}</div>
  @endisset
</div>
