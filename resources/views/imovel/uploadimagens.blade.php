@extends('layout.app')
@push('script')
@endpush

@section('scripttop')
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Upload Multiple Images using dropzone.js and Laravel</h1>
            <form action="{{route('dropzone.store')}}" enctype="multipart/form-data" class="dropzone" method="POST">
               <input type="text" name="idimovel">
               @csrf
               <div>
                  <h3>Upload Multiple Image By Click On Box</h3>
               </div>
            </form>
        </div>
    </div>
</div>

@endsection
@push('script')


<script type="text/javascript">
    Dropzone.autoDiscover = false;
        Dropzone.options.imageUpload = {
            maxFilesize         :       1,
            acceptedFiles: ".jpeg,.jpg,.png,.gif"
        };
</script>
@endpush

</body>
</html>