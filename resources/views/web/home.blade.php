@extends('web.layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="{{ asset('img/logo.png')}}" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="{{ asset('img/logo.png')}}" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="{{ asset('img/logo.png')}}" class="d-block w-100" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
    </div>
</div>
<div class="row m-3">
    @foreach ($products as $key)
    <div class="col-md-4">
        <div class="card" style="width: 18rem;">
            <img src="{{ asset('img/logo.png')}}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{ $key->product_name}}</h5>
              <p class="card-text">{{ $key->product_description}}</p>
              <a href="#" class="btn btn-dark">اضافة للسلة</a>
            </div>
        </div>
    </div>
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
