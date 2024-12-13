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
                                        <th>اسم المنتج</th>
                                        <th>حالة المنتج</th>
                                        <th>السعر</th>
                                        <th>الكمية</th>
                                        <th>المجموع</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($data->isEmpty())
                                        <tr>
                                            <td colspan="5" class="text-center">لا يوجد طلبات</td>
                                        </tr>
                                    @else
                                        @foreach ($data as $key)
                                            <tr>
                                                <td>{{ $key->product->product_name }}</td>
                                                <td>
                                                    <form action="{{ route('admin.orders.update_product_status') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $key->id }}">
                                                            <select name="status" id="">
                                                                <option @if ($key->status == 'pending')
                                                                    selected
                                                                @endif value="pending">قيد التحضير</option>
                                                                <option @if ($key->status == 'processing')
                                                                    selected
                                                                @endif value="processing">تم تجهيز المنتج</option>
                                                            </select>
                                                        <button class="btn btn-primary btn-sm" type="submit">تعديل</button>
                                                    </form>
                                                </td>
                                                <td>{{ $key->price }} <span>₪</span></td>
                                                <td>{{ $key->qty }}</td>
                                                <td>{{ $key->price * $key->qty }} <span>₪</span></td>
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
