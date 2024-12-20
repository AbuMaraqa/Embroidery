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
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table class="table table-sm table-hover">
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
                                    @if ($data->isEmpty())
                                        <tr>
                                            <td colspan="4" class="text-center">لا يوجد طلبات</td>
                                        </tr>
                                    @else
                                        @foreach ($data as $key)
                                            <tr>
                                                <td>{{ $key->id }}</td>
                                                <td>{{ $key->total_price }} <span>₪</span></td>
                                                <td>{{ $key->status }}</td>
                                                <td>{{ $key->payment_status }}</td>
                                                <td class="text-center">
                                                    <a href="#" class="btn btn-primary btn-sm">عرض</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
