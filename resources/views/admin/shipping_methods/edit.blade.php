Mohjamad Maraqa
@extends('admin.layouts.app')
@section('header_title', 'تعديل طريقة شحن')
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
                    <form class="row" action="{{ route('admin.shipping_methods.update')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">اسم الطريقة</label>
                                    <input required value="{{ old('shipping_name', $data->shipping_name)}}" type="text" name="shipping_name" placeholder="اسم الطريقة" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">سعر الشحن</label>
                                    <input required type="text" value="{{ old('shipping_price', $data->shipping_price)}}" name="shipping_price" placeholder="سعر الشحن" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">تعديل</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
