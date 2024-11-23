@extends('admin.layouts.app')
@section('header_title', 'تعديل صنف')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                        <form class="row" action="{{ route('admin.products.update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="{{ $data->id }}" name="id">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">اسم الصنف</label>
                                            <input type="text" name="product_name" value="{{ old('product_name' , $data->product_name)}}" placeholder="اسم الصنف" class="form-control">
                                            @error('product_name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">سعر الصنف</label>
                                            <input type="text" name="product_price" value="{{ old('product_price' , $data->product_price)}}" placeholder="سعر الصنف" class="form-control">
                                            @error('product_price')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">تصنيف الصنف</label>
                                            <select class="form-control" name="category_id" id="">
                                                <option class="" value="">اختر تصنيف</option>
                                                @foreach ($category as $key)
                                                    <option @if (old('category_id' , $data->category_id) == $key->id)
                                                        selected
                                                    @endif value="{{ $key->id }}">{{ $key->category_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">وصف الصنف</label>
                                            <textarea name="product_description" class="form-control" id="" cols="30" rows="3" placeholder="وصف الصنف">{{ old('product_description' , $data->product_description)}}</textarea>
                                            @error('product_description')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button class="btn btn-success" type="submit">تعديل</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-center">
                                <p>رفع صورة الصنف</p>
                                @error('product_image')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <img style="width: 220px" src="{{ asset('storage/product/'.$data->product_image)}}" alt="">
                                <input name="product_image" type="file" class="form-control">
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection
