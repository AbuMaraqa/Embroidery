@extends('web.layouts.app')
@section('content')
<div class="row">
    <div class="col-dm-12">
        <h4 class="text-center mt-3 mb-3">طلب تطريز جديد</h4>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('web.embroidery.create_post') }}" enctype="multipart/form-data" method="post" class="row">
                            @csrf
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="subject" class="form-control" placeholder="عنوان المنشور">
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <textarea name="notes" id="" cols="30" class="form-control" placeholder="وصف المنشور" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <button class="btn btn-primary">نشر المنشور</button>
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
