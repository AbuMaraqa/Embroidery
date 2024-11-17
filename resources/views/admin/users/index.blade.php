@extends('admin.layouts.app')
@section('header_title', 'المستخدمين')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('admin.alert_message.success')
            @include('admin.alert_message.fail')
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('admin.users.add')}}" class="btn btn-dark">اضافة مستخدم</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>الاسم</th>
                                            <th>البريد الالكتروني</th>
                                            <th style="width: 100px" class="text-center">العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('admin.users.edit',['id'=>$user->id])}}" class="btn btn-success btn-sm"><span class="fa fa-edit"></span></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
