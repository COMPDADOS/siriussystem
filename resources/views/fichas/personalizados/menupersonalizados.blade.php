@extends('layout.app')

@section('scripttop')
<style>
.grey {
  background-color: #f0f5f5;
}

.div-center
{
    text-align:center;
}
</style>
@endsection

@section('content')

<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-blue">
            <span class="caption-subject bold uppercase"> Documentos Personalizados</span>
            <i class="fa fa-search font-blue"></i>
        </div>
    </div>
    <div class="portlet-body form">
        <div class="form-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-4 grey">
                        <div class="row div-center">
                            <button class="btn btn-primary">ENVIAR ARQUIVOS
                            </button>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <table  id="tbldocumentos" class="table table-striped table-bordered table-hover" >
                            <div class="col-md-10">
                                @foreach( $docs as $doc)
                                    <div class="row">
                                        <h3>{{$doc->IMB_DPS_TITULO}}</h3>
                                        <span>Cadastrado em {{$doc->IMB_DPS_DTHORA}}</span>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-1">

                                    <a href="http://www.siriussystem.com.br/sys/storage/docpersonalizados/{{Auth::user()->IMB_IMB_ID}}/{{$doc->IMB_DPS_ARQUIVO}}" download>Baixar</a>
                                    </div>
                                        <div class="col-md-1">
                                            <a href="">Excluir</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalmanutencao" tabindex="-1" role="dialog" 
        aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-lg">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Imóveis
                        </div>
                    </div>
      
                    <div class="portlet-body form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="control-label">Título</label>
                                        <input type="text" id="IMB_DPS_TITULO" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">

            <div class="row">
                <div class="col-md-12">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">sair</button>
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




