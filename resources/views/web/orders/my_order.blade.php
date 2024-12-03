@extends('web.layouts.app')
@section('content')
    <div class="row mt-3">
        <div class="col-md-12">
            <h4 class="text-center">الطلبيات الخاصة بي</h4>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>رقم الطلب</th>
                                    <th>السعر</th>
                                    {{-- <th>حالة الطلبية</th> --}}
                                    <th>حالة الدفعة</th>
                                    <th style="width: 100px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->total_price }} <span>₪</span></td>
                                        {{-- <td>
                                            @if ($order->order_status == 1)
                                                <span class="">قيد التحضير</span>
                                            @endif
                                        </td> --}}
                                        <td>
                                            @if ($order->payment_status == 1)
                                                <span>تم الدفع</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="" class="btn btn-primary btn-sm">عرض</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
