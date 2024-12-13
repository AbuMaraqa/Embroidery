@extends('web.layouts.app')
@section('content')
<div class="row">
    <div class="col-dm-12">
        <h4 class="text-center mt-3 mb-3">تفاصيل منشور</h4>
    </div>
</div>

@if ($data->isEmpty())
    <p class="text-center">لا توجد منشورات</p>
@else
    @foreach ($data as $key)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('web.embroidery_request.accept_embroidery') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $key->embroidery_request_id }}">
                            <input type="hidden" name="user_id" value="{{ $key->user_id}}">
                            <h5 class="card-text">{{ $key->user->name ?? ''}}</h5>
                            <p class="card-text">{{ $key->notes }}</p>
                            <p>عرض السعر : <span>{{ $key->price }}</span></p>
                            <button type="submit" class="btn btn-success">قبول</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
@endsection
