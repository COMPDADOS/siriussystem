@extends('layout.app')

@section('scripttop')
<style>
.btn {
  background-color: #f0f5f5;
  border: 2px;
  color: white;
  padding: 10px 2px;
  font-size: 16px;
  cursor: pointer;
}
</style>
@endsection



@section('content')

<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-blue">
            <span class="caption-subject bold uppercase"> Fichas para Captação de Empreendimentos/Condomínios</span>
            <i class="fa fa-search font-blue"></i>
        </div>
    </div>
    <div class="portlet-body form">
        <div class="form-body">
            <div class="row">

                <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.captacaoempreendimentos')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Empreendimento
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection

@push('script')

<script src="{{asset('/global/plugins/jquery-minicolors/jquery.minicolors.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/components-color-pickers.min.js')}}" type="text/javascript"></script>

<script>


</script>

@endpush




