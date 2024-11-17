@if (session('fail'))
    <p class="alert alert-success">{{ $message }}</p>
@endif
