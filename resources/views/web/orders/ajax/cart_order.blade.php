<table class="table">
    <tbody>
        @php
            $price = 0;
        @endphp
        @foreach ($cartItems as $key)
            @php
                $price += $key->product->product_price * $key->qty;
            @endphp
            <tr>
                <td>
                    <img style="width: 40px" src="{{ asset('storage/product/'.$key->product->product_image)}}" alt="">
                </td>
                <td>{{ $key->product->product_name }}</td>
                <td><input type="number" onchange="update_qty({{ $key->id }},this.value)" value="{{ $key->qty }}" placeholder="الكمية" class="form-control w-25"></td>
                <td>{{ $key->product->product_price * $key->qty }} <span>₪</span></td>
            </tr>
        @endforeach
        <tr class="bg-dark">
            <td colspan="2"></td>
            <td>المجموع</td>
            <td>{{ $price }} <span>₪</span></td>
        </tr>
    </tbody>
</table>
