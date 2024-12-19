@extends('web.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">الرسائل</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if ($data->isEmpty())
                            <div class="col-md-12">
                                <h3 class="text-center">لا يوجد رسائل</h3>
                            </div>
                        @else
                            @foreach ($data as $key)
                                @if ($key->sender == auth()->user()->id)
                                    <div class="col-md-6">
                                        {{ $key->message }}
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                @else
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6">
                                        {{ $key->message }}
                                    </div>
                                @endif
                            @endforeach
                        @endif
                        <form class="col-md-12 mt-3 d-flex" method="POST" action="{{ route('web.message.create') }}">
                            @csrf
                            <input type="hidden" name="receive" value="{{ $id }}">
                            <input type="text" name="message" class="form-control" placeholder="اكتب رسالة">
                            <button class="btn btn-primary" type="submit">ارسال</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
