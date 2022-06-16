@extends('layouts.main_dashboard')

@section('content')

<div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="mt-2">
    <h2 class="color-theme-primary">FORM PENDAPATAN</h2>

    <div class="row">
      <div class="col-md-12">
        <div class="card-body">
          <form method="POST" action="/admin/incomes-store">
            @csrf

            <div class="wrap-input100 validate-input">
              <label for="product">
                <h5 class="color-theme-primary">
                  Nama Produk
                </h5>
              </label>
              <select class="input100" name="produk_id" placeholder="Nama Produk" id="product">
                <option selected disabled>Nama Produk</option>
                @foreach ($produks as $produk)
                    <option value="{{ $produk->id }}">{{ $produk->name_produk }}</option>
                @endforeach
              </select>
            </div>

            <div class="wrap-input100 validate-input mt-3">
              <label for="tanggal">
                <h5 class="color-theme-primary">
                  Tanggal
                </h5>
              </label>
              <input class="input100" type="date" name="date" id="tanggal">
            </div>

            {{-- <div class="wrap-input100 validate-input mt-3">
              <label for="harga">
                <h5 class="color-theme-primary">
                  Harga
                </h5>
              </label>
              <input class="input100" type="text" name="harga"  placeholder="Harga Produk" id="harga">
            </div> --}}

            <div class="wrap-input100 validate-input mt-3">
              <label for="stok">
                <h5 class="color-theme-primary">
                  Stok
                </h5>
              </label>
              <input class="input100" type="number" name="quantity"  placeholder="Stok Produk" id="stok">
            </div>

            <button type="submit" class="btn-product mt-4" style="border: none">Simpan</button>

          </form>
        </div>
      </div>
    </div>


  </div>
</div>
@endsection
