@extends('web.layouts.app')
@section('content')
<div class="row">
    <div class="row m-3">
        @foreach ($data as $key)
        <form class="col-md-3" action="{{ route('cart.addToCart') }}" method="post">
            @csrf
            <input type="hidden" value="{{ $key->id }}" name="product_id">
            <div class="card" style="width: 18rem;">
                <img style="max-height: 300px;min-height: 300px" src="{{ asset('storage/product/'.$key->product_image)}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">{{ $key->product_name}}</h5>
                  <p class="card-text">{{ $key->user->name ?? ''}}</p>
                  <p class="card-text"><span>₪</span><span>{{ $key->product_price}}</span></p>
                  <td><input onchange="update_name({{ $key->id }},this.value)" type="text" class="form-control w-50" placeholder="اكتب اسمك" value="{{ $key->name }}"></td>
                  <button type="submit" class="btn btn-dark mt-3">اضافة للسلة</button>
                </div>
            </div>
        </form>
        @endforeach
    </div>
</div>
@endsection
