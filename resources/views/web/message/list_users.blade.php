@extends('web.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">قائمة الرسائل الواردة</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>اسم المرسل</th>
                                        <th>العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($data->isEmpty())
                                    <tr>
                                        <td colspan="2" class="text-center">لا يوجد رسائل</td>
                                    </tr>
                                    @else
                                    @foreach ($data as $key)
                                        <tr>
                                            <td>{{ $key->sender_name->name }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-primary" href="{{ route('web.message.index',['id'=>\app\Models\User::find($key->sender)->id]) }}"><span class="fa fa-message"></span></a>
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
    </div>
@endsection
