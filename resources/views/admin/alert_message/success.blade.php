@if (session('success'))
    <p class="alert alert-success">{{ session()->get('success'); }}</p>
@endif
