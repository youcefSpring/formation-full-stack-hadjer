@if (session('success') || session('error') || $errors->any())
    <div class="flash-stack">
        @if (session('success'))
            <div class="flash flash-success"><i class="fas fa-circle-check"></i><span>{{ session('success') }}</span></div>
        @endif

        @if (session('error'))
            <div class="flash flash-error"><i class="fas fa-circle-exclamation"></i><span>{{ session('error') }}</span></div>
        @endif

        @if ($errors->any())
            <div class="flash flash-error">
                <i class="fas fa-circle-exclamation"></i>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endif
