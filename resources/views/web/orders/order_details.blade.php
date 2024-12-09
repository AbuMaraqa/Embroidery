@extends('web.layouts.app')
@section('content')
<div class="row mt-3 mb-3">
    <div class="col-md-12">
        <h3>تفاصيل الطلب</h3>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4>تفاصيل الطلب</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <p>رقم الطلبية : {{ $data->id }}</p>
                            </div>
                            <div class="col-md-4">
                                <p>تاريخ الطلبية : {{ $data->created_at }}</p>

                            </div>
                            <div class="col-md-4">
                                <p>حالة الطلبية : {{ $data->order_status }}</p>

                            </div>
                            {{-- <div class="col-md-3">
                                <p>ملاحظات : {{ $data->notes }}</p>

                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                                    <th>حالة المنتج</th>
                                    <th>اسم المطرز</th>
                                    <th>اسم المنتج</th>
                                    <th>الكمية</th>
                                    <th>السعر</th>
                                    <th>المجموع</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($data->order_items->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center">لا يوجد بيانات</td"></td>
                                    </tr>
                                    @else
                                    @foreach ($data->order_items as $key)
                                    <tr>
                                        <td>
                                            @if ($key->status == 'pending')
                                                قيد التحضير
                                            @else
                                                مكتمل
                                            @endif
                                        </td>
                                        <td>{{ $key->product->user->name }}</td>
                                        <td>{{ $key->product->product_name }}</td>
                                        <td>{{ $key->qty }}</td>
                                        <td>{{ $key->price }}</td>
                                        <td>{{ $key->qty * $key->price }} <span>₪</span></td>
                                    </tr>
                                    @endforeach
                                @endif
                                <tr>
                                    <td colspan="5" class="text-center bg-dark text-white">المجموع</td>
                                    <td>{{ $data->total_price }} <span>₪</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
