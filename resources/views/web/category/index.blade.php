@extends('web.layouts.app')
@section('content')
<div class="row">
    <div class="row m-3">
        @foreach ($data as $key)
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('storage/product/'.$key->product_image)}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">{{ $key->product_name}}</h5>
                  <p class="card-text">{{ $key->product_description}}</p>
                  <a href="#" class="btn btn-dark">اضافة للسلة</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
