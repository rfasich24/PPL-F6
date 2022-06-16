@extends('layouts.main_dashboard')

@section('content')

<div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

  <div class="d-flex justify-content-end">
    <a href="/admin/produk-create" class="btn-product">
      <div class="mr-2">
        Add
      </div>
      <svg xmlns="http://www.w3.org/2000/svg"  width="24" height="24" viewBox="0 0 576 512" fill="#FFFFFF">
        <path d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99H192v-144c0-17.69 14.33-32.01 32-32.01s32 14.32 32 32.01v144h144C417.7 224 432 238.3 432 256z"/>
      </svg>
    </a>
  </div>

  <div class="table-responsive mt-4">
    <table class="table table-striped">
      <thead>
        <tr class="bg-success">
          <th class="txt1" scope="col">No</th>
          <th class="txt1" scope="col">Nama Produk</th>
          <th class="txt1" scope="col">Deskripsi</th>
          <th class="txt1" scope="col">Harga/100gr</th>
          <th class="txt1" scope="col">Stok</th>
          <th class="txt1" scope="col">Gambar</th>
          <th class="txt1" scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($produks as $produk)
            <tr class="table-success">
            <td class="txt1">{{ $loop->iteration }}</td>
            <td class="txt1">{{ $produk->name_produk }}</td>
            <td class="txt1">{{ $produk->description }}</td>
            <td class="txt1">Rp {{ $produk->price }}</td>
            <td class="txt1">{{ $produk->stock }}</td>
            <td><img src="{{ asset('/upload/produks/' . $produk->image)  }}" alt="" srcset="" width="24" height="24"></td>
            <td class="d-flex">
                <form action="/admin/produk-delete/{{ $produk->id }}" method="post">
                    @method('delete')
                    @csrf
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 576 512" fill="#FF0000">
                        <path d="M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM31.1 128H416V448C416 483.3 387.3 512 352 512H95.1C60.65 512 31.1 483.3 31.1 448V128zM111.1 208V432C111.1 440.8 119.2 448 127.1 448C136.8 448 143.1 440.8 143.1 432V208C143.1 199.2 136.8 192 127.1 192C119.2 192 111.1 199.2 111.1 208zM207.1 208V432C207.1 440.8 215.2 448 223.1 448C232.8 448 240 440.8 240 432V208C240 199.2 232.8 192 223.1 192C215.2 192 207.1 199.2 207.1 208zM304 208V432C304 440.8 311.2 448 320 448C328.8 448 336 440.8 336 432V208C336 199.2 328.8 192 320 192C311.2 192 304 199.2 304 208z"/>
                        </svg>
                    </button>
                </form>
                <a href="/admin/produk-edit/{{ $produk->id }}">
                <svg xmlns="http://www.w3.org/2000/svg"  width="24" height="24" viewBox="0 0 576 512" fill="#4E944F">
                    <path d="M362.7 19.32C387.7-5.678 428.3-5.678 453.3 19.32L492.7 58.75C517.7 83.74 517.7 124.3 492.7 149.3L444.3 197.7L314.3 67.72L362.7 19.32zM421.7 220.3L188.5 453.4C178.1 463.8 165.2 471.5 151.1 475.6L30.77 511C22.35 513.5 13.24 511.2 7.03 504.1C.8198 498.8-1.502 489.7 .976 481.2L36.37 360.9C40.53 346.8 48.16 333.9 58.57 323.5L291.7 90.34L421.7 220.3z"/>
                </svg>
                </a>
            </td>
            </tr>
        @endforeach

      </tbody>
    </table>
  </div>
</div>
@endsection
