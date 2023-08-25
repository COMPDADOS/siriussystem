@extends("layout.app")
@section('scripttop')
<style>

.div-center
{
  text-align:center;
}

.naoselecionada {
  text-decoration: line-through;
  color:red;
}

.div-right
{
    text-align:right;
}

.escondido
{
    display:none;
}

.lbl-medidas {
  text-align: center;
  font-size: 14px;

}
.lbl-medidas-valores {
  text-align: center;
  font-size: 14px;
  font-weight: bold;
  color: #4682B4;
}

.div-border-blue-center{
    border:solid 1px #4682B4;
    text-align: center;
}
.lbl-medidas-outrositens {
  text-align: left;
  font-size: 12px;
  color: #4682B4;
}

.cardtitulo {
  text-align: left;
  font-size: 16px;
  color: #4682B4;
  font-weight: bold;

}

.lbl-download-title {
  text-align: center;
  font-size: 20px;
  font-weight: bold;
}

hr {
    height: 2px;
}

div .half-size-line
{
    line-height: 92%;
}

td, th
{
    text-align:center;
}

</style>
<script src="{{asset('/global/plugins/sweetalert/sweetalert2.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('/global/plugins/sweetalert/sweetalert2.min.css')}}">

@endsection
@section('content')


<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Cobrança Bancária - Leitura do Arquivo Retorno
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
        </div>
    </div>

    <div class="portlet-body form">
        <div class="row">
            <hr>
        </div>
        <div class="row" >
            <div class="col-md-12">
                <form action="{{route('cobrancabancaria.lerretorno.passo2')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-3 div-center">
                      <input type="hidden" id="nomedoarquivooriginal" name="nomeoriginal">
                      <input type="hidden" id="ocor" name="ocor">

                        Conta da Cobranca
                        <select  class="form-control" id="FIN_CCX_ID" name="conta" required>
                        </select>
                    </div>
                    <div class="col-md-3 div-center">
                      <label class="control-label" for="file">Arquivo</label>
                      <input class="form-control" type="file" name="arquivo" id="arquivo" required><br>
                    </div>
                    <div class="col-md-3 div-center">
                      <label class="control-label">Filtro</label>
                      <select class="form-control" name="selocor" id="i-ocor">
                        <option value=""></option>
                        <option value="02">Entrada Confirmada</option>
                        <option value="03">Entrada Rejeitada</option>
                        <option value="06">Liquidações</option>
                        <option value="09">Baixa Manual Banco</option>
                        <option value="28">Débito de Custas</option>
                      </select>
                    </div>
                    <div class="col-md-3 div-center">
                      <button type="submit" class="btn btn-primary">Processar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
        <hr>
        </div>
    </div>
</div>

@endsection

@push('script')

<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/funcoes-recibolocatario.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/jquery.btechco.excelexport.js')}}"></script>
<script src="{{asset('/js/jquery.base64.js')}}"></script>

<script>

$( document ).ready(function()
{
    $("#sirius-menu").click();

    $("#arquivo").change( function()
    {
      $("#nomedoarquivooriginal").val( $("#arquivo").val() );
    });
    $("#i-ocor").change( function()
    {
      $("#ocor").val( $("#i-ocor").val() );
    });

    cargaConta();

});

function cargaConta()
{

  $.getJSON( "{{ route('contacaixa.carga')}}/S", function( data )
  {
    $("#FIN_CCX_ID").empty();
    linha =  '<option value="">Selecione a Conta </option>';
    $("#FIN_CCX_ID").append( linha );
    for( nI=0;nI < data.length;nI++)
    {
      linha =
      '<option value="'+data[nI].FIN_CCX_ID+'">'+
                        data[nI].FIN_CCX_DESCRICAO+"</option>";
      $("#FIN_CCX_ID").append( linha );
    }
  });

}





</script>

@endpush
