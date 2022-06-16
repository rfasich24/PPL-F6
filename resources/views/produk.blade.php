@extends('layouts.app')

@section('content')
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="./images/slider_1.png" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="./images/kerupuk_gepeng.png" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="./images/kerupuk_bunder.png" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </button>
  </div>

  <div class="container mt-4">
    <div class="row">
        @foreach ($produks as $produk)
        <div  class="col-md-3 mb-4">
            <a style="text-decoration: none !important" href="/produk-detail/{{ $produk->id }}">
                <div class="card">
                    <img src="{{ asset('upload/produks/' . $produk->image) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                    <p style="color: black" class="card-text">{{ $produk->name_produk }}</p>
                    <h5 style="color: black" class="card-title">{{ $produk->price }}</h5>
                    <div class="d-flex">
                        <img src="./images/star.svg" alt="" srcset="">
                        <p style="color: black" class="my-auto ml-1 txt1">
                        | terjual 750+
                        </p>
                    </div>
                    </div>
                </div>
              </a>
          </div>
        @endforeach
    </div>
  </div>
@endsection
