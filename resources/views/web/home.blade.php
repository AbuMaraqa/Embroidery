@extends('web.layouts.app')
@section('content')
<div class="row m-5">
    <div class="col-md-12">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                @foreach ($slider as $key)
                <div class="carousel-item active">
                    <img style="height: 700px" src="{{ asset('storage/slider/'.$key->image)}}" class="d-block w-100" alt="...">
                  </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">السابق</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">التالي</span>
            </button>
          </div>
    </div>
</div>
<div class="row mt-5 mb-5">
    @foreach ($products as $key)
        <form class="col-md-3" action="{{ route('cart.addToCart') }}" method="post">
            @csrf
            <input type="hidden" name="product_id" value="{{ $key->id}}">
            <div class="card" style="width: 18rem;">
                <img style="max-height: 300px;min-height: 300px" src="{{ asset('storage/product/'.$key->product_image)}}" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title">{{ $key->product_name}}</h5>
                <p class="card-text">{{ $key->user->name ?? ''}}</p>
                <button class="btn btn-dark">اضافة للسلة</button>
                </div>
            </div>
        </form>
    @endforeach
</div>
@endsection
@section('script')
    <script>
        $('.carousel').carousel({
  interval: 2000
})
$('.carousel').carousel()

    </script>
@endsection
