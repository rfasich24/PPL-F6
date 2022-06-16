@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-5 py-3">
      <img src="{{ asset('upload/produks/'. $produk->image) }}" class="img-fluid w-100 border-radius" alt="Responsive image">
    </div>
    <div class="col-md-7 d-flex flex-column justify-content-center">
      <h2 id="nama-produk" class="card-text">{{ $produk->name_produk }}</h2>
      <h1 class="card-text my-3 color-theme-primary">Rp. <span id="harga-produk"> {{ $produk->price }}</span></h1>
      <p class="txt1">
        {{ $produk->description }}
      </p>
      <h5 class="color-theme-primary">
        Varian
      </h5>
      <div>
        <input type="radio" id="html" name="product_variant" value="bulat">
        <label for="html">Bulat</label><br>
        <input type="radio" id="css" name="product_variant" value="panjang">
        <label for="css">Panjang</label><br>
      </div>

      <div class="wrap-input100 validate-input mt-3">
        <label for="quantity">
          <h5 class="color-theme-primary">
            Kuantitas
          </h5>
        </label>
        <input class="input100" type="number" name="price"  placeholder="Kuantitas" id="quantity">
      </div>

      <input type="hidden" value="">

      <div class="d-flex justify-content-end">
        <a href="" id="tombol-pesan" class="btn-product ">Pesan Sekarang</a>
        <a href="/produk" class="btn-product ml-3" style="
            color: var(--primary);
            background-color:var(--secondary_variant)
          ">Batal</a>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function(){
  $("#tombol-pesan").click(function(){
    let product_name = $("#nama-produk").text()
    let product_price = $("#harga-produk").text()
    let variasi = $("input[type='radio'][name='product_variant']:checked").val();
    let quantity = $("#quantity").val()
    var _href = $("#tombol-pesan").attr("href");

    $("#tombol-pesan").attr("href", _href + `https://wa.me/6281336797499?text=pembelian item ${product_name} jumlah ${quantity}, dengan jenis ${variasi}, total yang harus dibayarkan Rp ${product_price*quantity}`);
  });
});


// function sendWA() {
//   let product_name = $("#nama-produk").text()
//   let product_price = $("#harga-produk").text()
//   let variasi = $('input[name="product_variant"]:checked').val();
//   let quantity = $("#quantity").val()

//   return `https://wa.me/6281336797499?text=pembelian item ${product_name} jumlah ${quantity}, dengan jenis ${variasi}, total yang harus dibayarkan`
// }


</script>
@endsection
