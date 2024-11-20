@extends('admin.layouts.app')
@section('header_title', 'تعديل تصنيف')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                        <form class="row" action="{{ route('admin.category.update')}}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $data->id}}">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">اسم التصنيف</label>
                                    <input type="text" required value="{{ old('category_name', $data->category_name)}}" name="category_name" placeholder="اسم التصنيف" class="form-control">
                                    @error('category_name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
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
