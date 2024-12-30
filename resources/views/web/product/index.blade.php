@extends('web.layouts.app')
@section('content')
    <form class="row" method="post" action="{{ route('cart.addToCart') }}">
        @csrf
        <input type="hidden" name="product_id" value="{{ $data->id }}">

        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <img style="max-height: 500px;min-height: 500px"
                        src="{{ asset('storage/product/' . $data->product_image) }}" class="card-img-top" alt="...">
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <h4>{{ $data->product_name }}</h4>
                </div>
                <div class="col-md-12">
                    <p>{{ $data->product_description }}</p>
                </div>
                <div class="col-md-12">
                    <p><span>₪</span><span>{{ $data->product_price }}</span></p>
                </div>
                <div class="col-md-12">
                    <button class="btn btn-dark">اضافة للسلة</button>
                </div>

            </div>

        </div>
    </form>
@endsection
