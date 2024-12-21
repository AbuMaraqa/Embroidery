@extends('web.layouts.app')
@section('content')
    <div class="row m-5">
        <div class="col-md-12">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    @foreach ($slider as $key)
                        <div class="carousel-item active">
                            <img style="height: 400px" src="{{ asset('storage/slider/' . $key->image) }}"
                                class="d-block w-100" alt="...">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">السابق</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">التالي</span>
                </button>
            </div>
        </div>
    </div>
    @if (auth()->check())
        @if (auth()->user()->user_role == 'embroider')
            @if (!$embroidery_request->isEmpty())
                <div class="row">
                    <div class="col-md-12">
                        <h4>المنشورات الخاصة بالعملاء</h4>
                    </div>
                    @foreach ($embroidery_request as $key)
                        @if (!App\Models\EmbroideryRequestSubmitModel::where('user_id', auth()->user()->id)->where('embroidery_request_id', $key->id)->first())
                            <form class="col-md-3" action="{{ route('web.embroidery_request.create') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $key->id }}">
                                <div class="card" style="width: 18rem;">
                                    <img style="max-height: 300px;min-height: 300px"
                                        src="{{ asset('storage/embroidery_request/' . $key->image) }}" class="card-img-top"
                                        alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $key->subject }}</h5>
                                        <p class="card-text">{{ $key->notes }}</p>
                                        <p class="card-text">{{ $key->user->name ?? '' }}</p>
                                        <textarea name="notes" id="" cols="30" rows="2" class="form-control mb-2" placeholder="كتابة وصف"></textarea>
                                        <input required type="number" name="price" class="form-control"
                                            placeholder="ضع عرض السعر">
                                        <button type="submit" class="btn btn-primary mt-2">ارسال</button>
                                        {{-- <a href="{{ route('embroider.order_details', $key->id) }}" class="btn btn-dark">تفاصيل الطلبية</a> --}}
                                    </div>
                                </div>
                            </form>
                        @endif
                    @endforeach
                </div>
            @endif
        @endif
    @endif
    <div class="row mt-5 mb-5">
        <div class="col-md-12">
            <h4>المنتجات</h4>
        </div>
        @if ($products->isEmpty())
            <div class="col-md-12">
                <h4>لا يوجد منتجات</h4>
            </div>
            @else
            @foreach ($products as $key)
            <form class="col-md-3 mb-4" action="{{ route('cart.addToCart') }}" method="post">
                @csrf
                <input type="hidden" name="product_id" value="{{ $key->id }}">
                <div class="card" style="width: 18rem;">
                    <a href="{{ route('product.index', ['id' => $key->id]) }}">
                        <img style="max-height: 300px;min-height: 300px"
                            src="{{ asset('storage/product/' . $key->product_image) }}" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $key->product_name }}</h5>
                        <p class="card-text">{{ $key->user->name ?? '' }}</p>
                        <p class="card-text"><span>₪</span><span>{{ $key->product_price }}</span></p>
                        <input type="text" class="form-control" placeholder="اكتب اسمك" name="name">
                        <button class="btn btn-dark mt-3">اضافة للسلة</button>
                    </div>
                </div>
            </form>
        @endforeach

        @endif
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" >
                <div class="modal-body p-0 text-center">
                    <div class="text-center p-3" style="height: 400px;background-color: #CAA184;border-radius: 5px">
                        <img style="width: 130px" class="mt-2" src="{{ asset('img/logo.png')}}" alt="">
                        <div>
                            <p style="color: #4D0800;font-size: 25px" class="mt-3">
                                في قلب التراث الفلسطيني، ينبض التطريز كحكاية
 تُسرد بالخيوط والألوان، حكاية تجمع بين الأصالة والهوية.
 موقعنا يهدف إلى إحياء هذا الفن العريق، ليكون بوابتك
 إلى عالم التطريزالفلسطيني بكل ما يحمله من تفاصيل
 أصيلة وجمال فريد.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#exampleModalLong').modal('show');
        });

        $('.carousel').carousel({
            interval: 2000
        })
        $('.carousel').carousel()
    </script>
@endsection
