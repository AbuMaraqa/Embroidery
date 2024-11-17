@extends('admin.layouts.app')
@section('header_title', 'تعديل تصنيف')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                        <form class="row" action="{{ route('admin.category.update')}}" method="post">
                            @csrf
                            <input type="text" name="id" value="{{ $data->id}}">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">اسم التصنيف</label>
                                    <input type="text" required value="{{ $data->category_name}}" name="category_name" placeholder="اسم التصنيف" class="form-control">
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection
