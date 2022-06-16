@extends('layouts.main_dashboard')

@section('style')
  <style>
  .file-upload {
    background-color: #ffffff;
    margin: 0 auto;
  }

  .file-upload-btn {
    width: 100%;
    margin: 0;
    color: #fff;
    background: #1FB264;
    border: none;
    padding: 10px;
    border-radius: 4px;
    border-bottom: 4px solid #15824B;
    transition: all .2s ease;
    outline: none;
    text-transform: uppercase;
    font-weight: 700;
  }

  .file-upload-btn:hover {
    background: var(--primary-color);
    color: #ffffff;
    transition: all .2s ease;
    cursor: pointer;
  }

  .file-upload-btn:active {
    border: 0;
    transition: all .2s ease;
  }

  .file-upload-content {
    display: none;
    text-align: center;
  }

  .file-upload-input {
    position: absolute;
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
    outline: none;
    opacity: 0;
    cursor: pointer;
  }

  .image-upload-wrap {
    /* margin-top: 20px; */
    border-radius: 25px;
    border: 4px dashed var(--grey);
    position: relative;
  }

  .image-dropping,
  .image-upload-wrap:hover {
    background-color: #1FB264;
    border: 4px dashed #ffffff;
  }

  .image-title-wrap {
    padding: 0 15px 15px 15px;
    color: #222;
  }

  .drag-text {
    text-align: center;
    padding: 30px;
  }

  .drag-text h5 {
    font-weight: 100;
    text-transform: uppercase;
    color: #15824B;
  }

  .drag-text h5:hover{
    color: #ffffff;
  }

  .file-upload-image {
    max-height: 200px;
    max-width: 200px;
    margin: auto;
    padding: 20px;
  }

  .remove-image {
    width: 200px;
    margin: 0;
    color: #fff;
    background: #cd4535;
    border: none;
    padding: 10px;
    border-radius: 4px;
    border-bottom: 4px solid #b02818;
    transition: all .2s ease;
    outline: none;
    text-transform: uppercase;
    font-weight: 700;
  }

  .remove-image:hover {
    background: #c13b2a;
    color: #ffffff;
    transition: all .2s ease;
    cursor: pointer;
  }

  .remove-image:active {
    border: 0;
    transition: all .2s ease;
  }
  </style>
@endsection

@section('content')
<div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="mt-2">
    {{-- <h2 class="color-theme-primary">FORM PENDAPATAN</h2> --}}

    <div class="row">
      <div class="col-md-12">
        <div class="card-body">
          <form action="/admin/produk-store" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="wrap-input100 validate-input">
              <label for="product">
                <h5 class="color-theme-primary">
                  Nama Produk
                </h5>
              </label>
              <input class="input100" type="text" name="name_produk"  placeholder="Nama Produk" id="harga">
            </div>

            <div class="wrap-input100 validate-input mt-3">
              <label for="harga">
                <h5 class="color-theme-primary">
                  Harga
                </h5>
              </label>
              <input class="input100" type="number" name="price"  placeholder="Harga Produk" id="harga">
            </div>

            <div class="wrap-input100 validate-input mt-3">
              <label for="deskripsi">
                <h5 class="color-theme-primary">
                  deskripsi
                </h5>
              </label>
              <input class="input100" type="text" name="description"  placeholder="Deskripsi Produk" id="deskripsi">
            </div>

            <div class="wrap-input100 validate-input mt-3">
              <label for="stok">
                <h5 class="color-theme-primary">
                  Stok
                </h5>
              </label>
              <input class="input100" type="number" name="stock"  placeholder="Stok Produk" id="stok">
            </div>

            <h5 class="color-theme-primary">
              Image
            </h5>
            <div class="file-upload">
              <div class="image-upload-wrap">
                <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" name="image" />
                <div class="drag-text">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"  width="60" height="60" fill="#4E944F" >
                    <path d="M194.6 32H317.4C338.1 32 356.4 45.22 362.9 64.82L373.3 96H448C483.3 96 512 124.7 512 160V416C512 451.3 483.3 480 448 480H64C28.65 480 0 451.3 0 416V160C0 124.7 28.65 96 64 96H138.7L149.1 64.82C155.6 45.22 173.9 32 194.6 32H194.6zM256 384C309 384 352 341 352 288C352 234.1 309 192 256 192C202.1 192 160 234.1 160 288C160 341 202.1 384 256 384z"/>
                  </svg>
                  <h5>Drag and drop a file or select add Image</h5>
                </div>
              </div>
              <div class="file-upload-content">
                <img class="file-upload-image" src="#" alt="your image" />
                <div class="image-title-wrap">
                  <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                </div>
              </div>
            </div>
            <button type="submit" class="btn-product mt-4" style="border: none">Simpan</button>
          </form>
        </div>
      </div>
    </div>


  </div>
</div>
@endsection


@section('script')
  <script>
    function readURL(input) {
      if (input.files && input.files[0]) {

        var reader = new FileReader();

        reader.onload = function(e) {
          $('.image-upload-wrap').hide();

          $('.file-upload-image').attr('src', e.target.result);
          $('.file-upload-content').show();

          $('.image-title').html(input.files[0].name);
        };

        reader.readAsDataURL(input.files[0]);

      } else {
        removeUpload();
      }
    }

    function removeUpload() {
      $('.file-upload-input').replaceWith($('.file-upload-input').clone());
      $('.file-upload-content').hide();
      $('.image-upload-wrap').show();
    }
    $('.image-upload-wrap').bind('dragover', function () {
        $('.image-upload-wrap').addClass('image-dropping');
      });
      $('.image-upload-wrap').bind('dragleave', function () {
        $('.image-upload-wrap').removeClass('image-dropping');
    });
  </script>
@endsection
