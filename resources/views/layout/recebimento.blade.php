@extends('layout.app')
@section('content')
@include('layout.localizarcontrato')
@endsection


@push('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="{{asset('/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/form-input-mask.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/global/plugins/jquery.input-ip-address-control-1.0.min.js')}}" type="text/javascript"></script>


<script>
  $( document ).ready(function() 
  {
    $(".i-div-informacoes").hide();
       
//    cargaLancamento( 1 );
  });


</script>



@endpush