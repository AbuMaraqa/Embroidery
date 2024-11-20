@extends('admin.layouts.app')
@section('header_title', 'تعديل مستخدم')
@section('content')
<div class="row">
    <div class="col-md-12">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    </div>
</div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                        <form class="row" action="{{ route('admin.users.update')}}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $data->id}}">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">اسم المستخدم</label>
                                    <input type="text" value="{{ old('name', $data->name)}}" name="name" placeholder="اسم المستخدم" class="form-control">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">البريد الالكتروني</label>
                                    <input type="email" value="{{ old('email', $data->email)}}" name="email" placeholder="البريد الالكتروني" class="form-control">
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
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
                                    <input type="text" value="{{ old('phone', $data->phone)}}" name="phone" placeholder="رقم الهاتف" class="form-control">
                                    @error('phone')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">تاريخ الميلاد</label>
                                    <input type="date" value="{{ old('dob', $data->dob)}}" name="dob" placeholder="تاريخ الميلاد" class="form-control">
                                    @error('dob')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">نوع المتسخدم</label>
                                    <select class="form-control" name="user_role" id="">
                                        <option @if(old('user_role', $data->user_role) == 'admin') selected @endif value="admin">ادمن</option>
                                        <option @if(old('user_role', $data->user_role) == 'embroider') selected @endif value="embroider">مطرز</option>
                                        <option @if(old('user_role', $data->user_role) == 'client') selected @endif value="client">عميل</option>
                                    </select>
                                    @error('user_role')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success">تعديل</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection
