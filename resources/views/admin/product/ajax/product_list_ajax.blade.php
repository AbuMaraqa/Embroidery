<table class="table table-sm table-hover table-bordered">
    <thead>
        <tr>
            <th></th>
            <th>اسم المنتج</th>
            <th>السعر</th>
            <th style="width: 20%" class="text-center">العمليات</th>
        </tr>
    </thead>
    <tbody>
        @if ($data->isEmpty())
            <tr>
                <td colspan="4" class="text-center">لا يوجد أصناف</td>
            </tr>
        @else
            @foreach ($data as $key)
                <tr>
                    <td>
                        <img style="width: 40px" src="{{asset('storage/product/'.$key->product_image)}}" alt="">
                    </td>
                    <td>{{ $key->product_name }}</td>
                    <td>{{ $key->product_price }}</td>
                    <td class="text-center">
                        @if ($key->status == 1)
                            <a href="{{ route('admin.products.deactiveProduct',['id'=>$key->id])}}" class="btn btn-sm btn-danger"><span class="fa fa-ban"></span></a>
                        @else
                            <a href="{{ route('admin.products.activeProduct',['id'=>$key->id])}}" class="btn btn-sm btn-success"><span class="fa fa-check"></span></a>

                        @endif
                        <a href="{{ route('admin.products.edit',['id'=>$key->id])}}" class="btn btn-success btn-sm"><span class="fa fa-edit"></span></a>
                        <a href="{{ route('admin.products.delete',['id'=>$key->id])}}" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
