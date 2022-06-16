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
{{-- description --}}
<div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="modal fade" id="modalDescription" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add image jumbotron</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/admin/home-description-update/1" method="POST">
                @method('put')
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Recipient:</label>
                        <textarea type="text" class="form-control" id="recipient-name" name="description_home" rows="8"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <div class="col-md-8" data-bs-toggle="modal" data-bs-target="#modalDescription">
    <h5 class="color-theme-primary">
        Deskripsi
    </h5>
    @foreach ($descriptions as $description)
        <textarea style="height: 182px !important" class="input100" id="exampleFormControlTextarea1" rows="8" placeholder="{{ $description->description_home }}"></textarea>
    @endforeach
    </div>
</div>
{{-- image jumbotron --}}
<div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add image jumbotron</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/admin/home-jumbotron-create" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Recipient:</label>
                        <input type="file" class="form-control" id="recipient-name" name="image_description">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <div class="row pt-5">
        <h5 class="color-theme-primary">
            Image Jumbotron
        </h5>
        @foreach ($jumbotrons as $jumbotron)
            <div class="col-md-3">
                <img class="" src="{{ asset('/upload/home/'. $jumbotron->image_description) }}" alt="your image" height="150"/>
                    {{-- <div class="file-upload">
                        <div id="image-upload-wrap" class="image-upload-wrap" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <input id="file-upload-image" class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                            <div class="drag-text">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"  width="60" height="60" fill="#4E944F" >
                                <path d="M194.6 32H317.4C338.1 32 356.4 45.22 362.9 64.82L373.3 96H448C483.3 96 512 124.7 512 160V416C512 451.3 483.3 480 448 480H64C28.65 480 0 451.3 0 416V160C0 124.7 28.65 96 64 96H138.7L149.1 64.82C155.6 45.22 173.9 32 194.6 32H194.6zM256 384C309 384 352 341 352 288C352 234.1 309 192 256 192C202.1 192 160 234.1 160 288C160 341 202.1 384 256 384z"/>
                                </svg>
                                <h5>Drag and drop a file or select add Image</h5>
                            </div>
                        </div>
                        <div id="file-upload-content" class="file-upload-content">
                            <img id="file-upload-image" class="file-upload-image" src="{{ asset('/upload/home/'. $jumbotron->image_description) }}" alt="your image" />
                            <div class="image-title-wrap">
                                <button type="button" onclick="removeUpload()" class="remove-image">Remove <span id="image-title" class="image-title">Uploaded Image</span></button>
                            </div>
                        </div>
                    </div> --}}
                    <form action="/admin/home-jumbotron-delete/{{ $jumbotron->id }}" method="post">
                        @method('delete')
                        @csrf
                        <button class="remove-image">
                            REMOVE
                        </button>
                    </form>
            </div>
            @endforeach
                <div class="col-md-3">
                    <div class="file-upload">
                        <div id="image-upload-wrap" class="image-upload-wrap" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <div class="drag-text">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"  width="60" height="60" fill="#4E944F" >
                                <path d="M194.6 32H317.4C338.1 32 356.4 45.22 362.9 64.82L373.3 96H448C483.3 96 512 124.7 512 160V416C512 451.3 483.3 480 448 480H64C28.65 480 0 451.3 0 416V160C0 124.7 28.65 96 64 96H138.7L149.1 64.82C155.6 45.22 173.9 32 194.6 32H194.6zM256 384C309 384 352 341 352 288C352 234.1 309 192 256 192C202.1 192 160 234.1 160 288C160 341 202.1 384 256 384z"/>
                                </svg>
                                <h5>Drag and drop a file or select add Image</h5>
                            </div>
                        </div>
                        <div id="file-upload-content" class="file-upload-content">
                            <img id="file-upload-image" class="file-upload-image" src="" alt="your image" />
                            <div class="image-title-wrap">
                                <button type="button" onclick="removeUpload()" class="remove-image">Remove <span id="image-title" class="image-title">Uploaded Image</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
{{-- image produk --}}
<div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="modal fade" id="modalProduk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add image produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/admin/home-produk-create" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Recipient:</label>
                        <input type="file" class="form-control" id="recipient-name" name="image_produk">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <div class="row pt-5">
        <h5 class="color-theme-primary">
            Image Produk
        </h5>
            @foreach ($produkHomes as $produkHome)
            <div class="col-md-3">
                        <img class="" src="{{ asset('/upload/home/'. $produkHome->image_produk) }}" alt="your image" height="150"/>
                        <form action="/admin/home-produk-delete/{{ $produkHome->id }}" method="post">
                            @method('delete')
                            @csrf
                            <button class="remove-image">
                                REMOVE
                            </button>
                        </form>
                </div>
                @endforeach
                <div class="col-md-3">
                    <div class="file-upload">
                        <div id="image-upload-wrap" class="image-upload-wrap" data-bs-toggle="modal" data-bs-target="#modalProduk">
                            <div class="drag-text">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"  width="60" height="60" fill="#4E944F" >
                                <path d="M194.6 32H317.4C338.1 32 356.4 45.22 362.9 64.82L373.3 96H448C483.3 96 512 124.7 512 160V416C512 451.3 483.3 480 448 480H64C28.65 480 0 451.3 0 416V160C0 124.7 28.65 96 64 96H138.7L149.1 64.82C155.6 45.22 173.9 32 194.6 32H194.6zM256 384C309 384 352 341 352 288C352 234.1 309 192 256 192C202.1 192 160 234.1 160 288C160 341 202.1 384 256 384z"/>
                                </svg>
                                <h5>Drag and drop a file or select add Image</h5>
                            </div>
                        </div>
                        <div id="file-upload-content" class="file-upload-content">
                            <img id="file-upload-image" class="file-upload-image" src="" alt="your image" />
                            <div class="image-title-wrap">
                                <button type="button" onclick="removeUpload()" class="remove-image">Remove <span id="image-title" class="image-title">Uploaded Image</span></button>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
</div>
{{-- image suggestion --}}
<div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="modal fade" id="modalSuggestion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add image penyajian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/admin/home-suggestion-create" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Recipient:</label>
                        <input type="file" class="form-control" id="recipient-name" name="image_suggestion">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <div class="row pt-5">
        <h5 class="color-theme-primary">
            Image Suggestion
        </h5>
            @foreach ($suggestionHomes as $suggestionHome)
            <div class="col-md-3">
                        <img class="" src="{{ asset('/upload/home/'. $suggestionHome->image_suggestion) }}" alt="your image" height="150"/>
                        <form action="/admin/home-suggestion-delete/{{ $suggestionHome->id }}" method="post">
                            @method('delete')
                            @csrf
                            <button class="remove-image">
                                REMOVE
                            </button>
                        </form>
                </div>
                @endforeach
                <div class="col-md-3">
                    <div class="file-upload">
                        <div id="image-upload-wrap" class="image-upload-wrap" data-bs-toggle="modal" data-bs-target="#modalSuggestion">
                            <div class="drag-text">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"  width="60" height="60" fill="#4E944F" >
                                <path d="M194.6 32H317.4C338.1 32 356.4 45.22 362.9 64.82L373.3 96H448C483.3 96 512 124.7 512 160V416C512 451.3 483.3 480 448 480H64C28.65 480 0 451.3 0 416V160C0 124.7 28.65 96 64 96H138.7L149.1 64.82C155.6 45.22 173.9 32 194.6 32H194.6zM256 384C309 384 352 341 352 288C352 234.1 309 192 256 192C202.1 192 160 234.1 160 288C160 341 202.1 384 256 384z"/>
                                </svg>
                                <h5>Drag and drop a file or select add Image</h5>
                            </div>
                        </div>
                        <div id="file-upload-content" class="file-upload-content">
                            <img id="file-upload-image" class="file-upload-image" src="" alt="your image" />
                            <div class="image-title-wrap">
                                <button type="button" onclick="removeUpload()" class="remove-image">Remove <span id="image-title" class="image-title">Uploaded Image</span></button>
                            </div>
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

