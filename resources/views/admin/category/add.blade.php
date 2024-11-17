@extends('admin.layouts.app')
@section('header_title', 'اضافة تصنيف')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                        <form class="row" action="{{ route('admin.category.create')}}" method="post">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">اسم المستخدم</label>
                                    <input type="text" name="category_name" placeholder="اسم التصنيف" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">اضافة</button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection
