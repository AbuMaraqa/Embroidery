@extends('admin.layouts.app')
@section('header_title', 'تعديل مستخدم')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                        <form class="row" action="{{ route('admin.users.update')}}" method="post">
                            @csrf
                            <input type="text" name="id" value="{{ $data->id}}">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">اسم المستخدم</label>
                                    <input type="text" value="{{ $data->name}}" name="name" placeholder="اسم المستخدم" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">البريد الالكتروني</label>
                                    <input type="email" value="{{ $data->email}}" name="email" placeholder="البريد الالكتروني" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">كلمة المرور</label>
                                    <input type="text" name="password" placeholder="كلمة المرور" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">رقم الهاتف</label>
                                    <input type="text" value="{{ $data->phone}}" name="phone" placeholder="رقم الهاتف" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">نوع المتسخدم</label>
                                    <select class="form-control" name="user_role" id="">
                                        <option @if($data->user_role == 'admin') selected @endif value="admin">ادمن</option>
                                        <option @if($data->user_role == 'embroider') selected @endif value="embroider">مطرز</option>
                                        <option @if($data->user_role == 'client') selected @endif value="client">عميل</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">رقم بطاقة العميل</label>
                                    <input type="text" value="{{ $data->num_of_card}}" name="num_of_card" placeholder="رقم بطاقة العميل" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">العنوان</label>
                                    <textarea class="form-control" name="address" placeholder="العنوان" name="" id="" cols="30" rows="3">{{ $data->address}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">معلومات عن العميل</label>
                                    <textarea class="form-control" name="information" placeholder="معلومات عن العميل" name="" id="" cols="30" rows="3">{{$data->information}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-success">اضافة</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection
