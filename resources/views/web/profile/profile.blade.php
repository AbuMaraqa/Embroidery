@extends('web.layouts.app')
@section('content')
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div><span class="text-danger">{{ $error }}</span></div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="text-center">المعلومات الشخصية</h4>
                        </div>
                    </div>
                    <form class="row" action="{{ route('web.profile.update') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $users->id }}">
                        <div class="col-md-12 mt-3">
                            <div class="form-group">
                                <label for="">الاسم</label>
                                <input required type="text" value="{{ $users->name }}" name="name"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="form-group">
                                <label for="">الايميل</label>
                                <input required type="email" value="{{ $users->email }}" name="email"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="form-group">
                                <label for="">رقم الهاتف</label>
                                <input required type="number" value="{{ $users->phone }}" name="phone"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="form-group">
                                <label for="">كلمة المرور القديمة</label>
                                <input type="old_password" name="old_password" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="form-group">
                                <label for="">كلمة المرور</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="form-group">
                                <button class="btn btn-success">تعديل</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
