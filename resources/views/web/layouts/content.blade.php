<div class="container" style="min-height: 100vh">
    <div class="row mb-3 mt-3">
        <div class="col-md-12">
            @include('admin.alert_message.success')
            @include('admin.alert_message.fail')
        </div>
    </div>
    @yield('content')
</div>
