@extends('web.layouts.app')
@section('content')
<h3 class="text-center mt-3 mb-4">السلة الخاصة بي</h3>
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
                                <p class="card-text"><span>₪</span><span>{{ $key->product->product_price}}</span></p>
                                <input type="text" readonly class="form-control" value="{{ $key->name}}">
                                <button type="submit" class="btn btn-danger mt-3">ازالة من السلة</button>
                                </div>
                            </div>
                        </form>
                        @endforeach
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <a href="{{ route('orders.get_orders')}}" class="btn btn-dark">اتمام الطلب</a>
                                        </div>
                                        <div class="col-md-9 justify-content-center align-items-center">
                                            <h3 class="text-end me-5">المجموع الكلي: <span>₪</span><span>{{ $totalPrice}}</span></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
@endif
@endsection
