@extends('admin.layouts.app')
@section('header_title', 'الطلبيات الواردة')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('admin.alert_message.success')
            @include('admin.alert_message.fail')
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('admin.products.add')}}" class="btn btn-dark">اضافة صنف</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>رقم الطلب</th>
                                            <th>السعر</th>
                                            <th>حالة الطلبية</th>
                                            <th>حالة الدفعة</th>
                                            <th style="width: 100px"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            list_product_ajax();
        })
        function list_product_ajax(){
            $.ajax({
                url: '{{ route('admin.products.list_product_ajax') }}',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                },
                success: function(response) {
                    $('#list_product').html(response.view);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    </script>
@endsection
