
@extends('layout.app')

@section('scripttop')
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endsection

@section('content')

<div class="container-fluid">
    <br>
    <h3 align="center">Upload using laravel</h3>
    <br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Selecione a Imagem</h3>
        </div>
        <div class="panel-body">
            <form id="dopzoneForm" class="dropzone" action="{{route('dropzone.upload')}}">
                <input type='file' name='files[]' multiple />
                @csrf
            </form>
            <div align="center">
                <button type="button" class="btn btn-info" id="submit-all">Upload</button>
            </div>
        </div>
        <br>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Imagens Gravadas</h3>
            </div>
            <div class="panel-body" id="uploaded_image">

            </div>

        </div>
    </div>
</div>

@endsection

@push('script')

<script>
Dropzone.options.mydropzone =
  {
      autoProcessQueue: false,
     addRemoveLinks: true,
      dictMaxFilesExceeded: "Maximum upload limit reached",
       dictInvalidFileType: "upload only JPG/PNG/JPEG/GIF/BMP",
    acceptedFiles: '.png,.jpg,.jpeg,.gif,.bmp',
        parallelUploads: 10,
          // uploadMultiple: true,
     init: function ()
    {
      var submitButton = document.querySelector('#submit-all');
       myDropzone = this;


        submitButton.addEventListener("click", function(){
           myDropzone.processQueue();
        });


       this.on("complete", function(){
      if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) 
      {
        var _this = this;
        _this.removeAllFiles();
      }
      //console.log(this.getUploadingFiles());
    });

    },

  };
</script>



@endpush