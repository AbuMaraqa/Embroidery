@extends('web.layouts.app')
@section('content')
<div class="row">
    <div class="col-dm-12">
        <h4 class="text-center mt-3 mb-3">الطلبات الخاصة بالمنشورات</h4>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover text-center">
                        <thead>
                            <tr>
                                <th></th>
                                <th style="width: 10%">رقم المنشور</th>
                                <th>عنوان المنشور</th>
                                <th>المطرز التي تمت الترسية عليه</th>
                                <th style="width: 10%">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($data->isEmpty())
                                <tr>
                                    <td colspan="3" class="test-center">لا توجد منشورات</td>
                                </tr>
                            @else
                                @foreach ($data as $key)
                                    <tr>
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="{{ route('web.message.index',['id'=>$key->id]) }}"><span class="fa fa-message"></span></a>
                                        </td>
                                        <td>{{ $key->id }}</td>
                                        <td>{{ $key->subject }}</td>
                                        <td>{{ $key->embroider->name ?? '' }}</td>
                                        <td>
                                            @if (empty($key->accept_embroider))
                                                <a class="btn btn-sm btn-dark" href="{{ route('web.embroidery_request.embroidery_request_details',['id'=>$key->id]) }}"><span class="fa fa-search"></span></a>
                                            @else
                                                تم ترسية مطرز
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
