@extends('web.layouts.app')
@section('content')
<h4 class="text-center mt-3">السلة الخاصة بي</h4>
@if ($cartItems->isEmpty())
                    لا توجد أصناف بالسلة
                @else
                    <div class="row">
                        @foreach ($cartItems as $key)
                        <form action="{{ route('cart.removeFromCart')}}" method="post" class="col-md-3">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $key->product_id}}">
                            <div class="card" style="width: 18rem;">
                                <img style="max-height: 300px;min-height: 300px" src="{{ asset('storage/product/'.$key->product->product_image)}}" class="card-img-top" alt="...">
                                <div class="card-body">
                                <h5 class="card-title">{{ $key->product->product_name}}</h5>
                                @if (auth()->check())
                                <p class="card-text">{{ $key->user->name}}</p>
                                @endif
                                <button type="submit" class="btn btn-danger">ازالة من السلة</button>
                                </div>
                            </div>
                        </form>
                        @endforeach
                    </div>
@endif
@endsection
