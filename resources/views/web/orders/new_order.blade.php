@extends('web.layouts.app')
@section('content')
<div class="row mt-3 mb-3">
    <div class="col-md-12">
        <h3>اتمام الطلب</h3>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="cart_order"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <h3>تفاصيل الطلب</h3>
    </div>
</div>
<div class="row mt-4 mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form class="row" action="{{ route('orders.processPayment')}}" method="post">
                            @csrf
                            <div class="col-md-12">
                                <div class="form-group">
                                    <p class="text-danger">لتغيير رقم الهاتف من المعلومات الشخصية</p>
                                    <label for="">رقم الهاتف الخاص بك</label>
                                    <input value="{{ auth()->user()->phone }}" required type="number" name="phone" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">العنوان</label>
                                    <textarea class="form-control" name="address" id="" cols="30" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label for="">منطقة التوصيل</label>
                                    <select required class="form-control" name="shipping_method" id="shipping_id">
                                        <option value="">يرجى تحديد المنطقة</option>
                                        @foreach ($shipping_methods as $key)
                                            <option value="{{ $key->id }}">{{ $key->shipping_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label for="">طريقة الدفع</label>
                                    <select required class="form-control" name="payment_method" id="payment_mothod">
                                        <option value="">يرجى تحديد طريقة الدفع</option>
                                        <option value="cash">كاش</option>
                                        <option value="visa">فيزا</option>
                                    </select>
                                </div>
                            </div>
                            {{-- <div id="card_style" style="display: none" class="col-md-12 mt-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">رقم الفيزا</label>
                                            <input type="text" name="card_number" placeholder="رقم الفيزا" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">التاريخ</label>
                                            <input type="date" name="card_date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">CVV</label>
                                            <input type="number" name="card_cvv" placeholder="CVV" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">اتمام الطلب</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $('#payment_mothod').change(function () {
            if ($(this).val() == 'visa') {
                $('#card_style').css('display', 'block');
            } else {
                $('#card_style').css('display', 'none');
            }
        })

        $(document).ready(function() {
            cart_order_ajax();
        })
        function cart_order_ajax(){
            $.ajax({
                url: '{{ route('orders.cart_order_ajax') }}',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                },
                success: function(response) {
                    $('#cart_order').html(response.view);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }

        function update_qty(product_id,qty){
            $.ajax({
                url: '{{ route('orders.update_qty') }}',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'), // Include CSRF token
                    qty:qty,
                    id:product_id
                },
                success: function(response) {
                    cart_order_ajax();
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }

        function update_name(product_id,name){
            $.ajax({
                url: '{{ route('orders.update_name') }}',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'), // Include CSRF token
                    name:name,
                    id:product_id
                },
                success: function(response) {
                    cart_order_ajax();
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    </script>
@endsection
