Mohjamad Maraqa
@extends('admin.layouts.app')
@section('header_title', 'طرق الشحن')
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
                            <a href="{{ route('admin.shipping_methods.add')}}" class="btn btn-dark">اضافة طريقة شحن</a>
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
                           <table class="table table-sm table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>اسم الطريقة</th>
                                        <th>السعر</th>
                                        <th style="width: 100px" class="text-center">العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($data->isEmpty())
                                        <tr>
                                            <td colspan="3" class="text-center">لا يوجد بيانات</td>
                                        </tr>
                                    @else
                                        @foreach ($data as $key)
                                            <tr>
                                                <td>{{ $key->shipping_name }}</td>
                                                <td>{{ $key->shipping_price }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('admin.shipping_methods.edit',['id'=>$key->id])}}" class="btn btn-success btn-sm"><span class="fa fa-edit"></span></a>
                                                    <a href="{{ route('admin.shipping_methods.delete',['id'=>$key->id])}}" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a>
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
