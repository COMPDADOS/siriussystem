@extends("layout.app")
@section('scripttop')
<link href="{{asset('/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

<style>

.div-center
{
  text-align:center;
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

.lbl-medidas-left {
  text-align: left;
  font-size: 16px;
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

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="#">Voltar</a>
            <i class="fa fa-circle"></i>
        </li>
    </ul>
</div>



<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Previsão de Recebimento
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
        </div>
    </div>

    <div class="portlet-body form">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-1 div-center">
                    <div class="row">
                        Dia Inicial
                        <input class="form-control div-center"type="text" id="i-dia-inicial"
                        onkeypress="return isNumber(event)" onpaste="return false;" >
                    </div>
                    <div class="row">
                        Dia Final
                        <input class="form-control div-center"type="text" id="i-dia-final"
                        onkeypress="return isNumber(event)" onpaste="return false;">
                    </div>
                </div>
                <div class="col-md-1 div-center">
                    <div class="row">
                        Mês Inicial
                        <input class="form-control div-center"type="text" id="i-mes-inicial"
                        onkeypress="return isNumber(event)" onpaste="return false;">
                    </div>
                    <div class="row">
                        Mês Final
                        <input class="form-control div-center" type="text" id="i-mes-final"
                        onkeypress="return isNumber(event)" onpaste="return false;">
                    </div>
                </div>
                <div class="col-md-1 div-center">
                    <div class="row">
                        Ano Inicial
                        <input class="form-control div-center" type="text" id="i-ano-inicial"
                        onkeypress="return isNumber(event)" onpaste="return false;">
                    </div>
                    <div class="row">
                        Ano Final
                        <input class="form-control div-center" type="text" id="i-ano-final"
                        onkeypress="return isNumber(event)" onpaste="return false;">
                    </div>
                </div>
                
                <div class="col-md-2">
                    <div class="form-actions right">
                        <button type="button" class="btn blue " onClick="iniciarGeracao()" >
                                    <i class="fa fa-check"></i> Iniciar Geração
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 div-center" >
                <h3 class=" escondido" id="i-processamento">Em processamento....Aguarde o final!</h3>
            </div>
        </div>

        <div class="row escondido" id="i-div-resultado">

            <div class="col-md-12">
                <table class="table table-bordered table-striped" id="resultTable">
                    <thead>
                        <th></th>
                        <th >Pasta</th>
                        <th>Imóvel</th>
                        <th>Endereço</th>
                        <th>Locatário/Destinatário</th>
                        <th>Vencimento</th>
                        <th>Limite</th>
                        <th>Valor</th>
                        <th>Selecionado</th>
                    </thead>
                </table>

            </div>
        
        </div>

    </div>
</div>
@endsection

@push('script')

<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/funcoes-recibolocatario.js')}}" type="text/javascript"></script>
<script src="{{asset('/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>


<script>

$( document ).ready(function() 
{    
    $(".select2").select2({
            placeholder: 'Selecione',
            width: null
        });


    cargaConta();
    cargaContratosLt();
    $("#sirius-menu").click();
    
	var hoje = new Date();
    var nDia = hoje.getDate();
    var nMes = hoje.getMonth()+1;
    var nAno = hoje.getFullYear();      
    var nUltimoDia = ultimoDiaMes( nMes, nAno );

    


    $("#i-dia-final").val( nUltimoDia );
    $("#i-dia-inicial").val(1);
    $("#i-mes-inicial").val( nMes);
    $("#i-mes-final").val( nMes);
    $("#i-ano-inicial").val( nAno);
    $("#i-ano-final").val( nAno);
    
    
});


function cargaConta()
{

  $.getJSON( "{{ route('contacaixa.carga')}}/S", function( data )
  {
    $("#FIN_CCX_ID").empty();
    linha =  '<option value="-1">Selecione a Conta </option>';
    $("#FIN_CCX_ID").append( linha );
    for( nI=0;nI < data.length;nI++)
    {
        selecionada = '';
        if( data[nI].FIN_CCX_BANCO =='S')
         selecionada = 'selected';
      linha = 
      '<option value="'+data[nI].FIN_CCX_ID+'" '+selecionada+'">'+
                        data[nI].FIN_CCX_DESCRICAO+"</option>";
      $("#FIN_CCX_ID").append( linha );
    }
  });

}

function iniciarGeracao()
{
    //ajustando o ultimo dia do mes, tanto na inicial, como na final
    var nAno = $("#i-ano-inicial").val();
    var nMes =  $("#i-mes-inicial").val();
    nMes = parseInt( nMes );
    nAno = parseInt( nAno );
    var nUltimoDia = ultimoDiaMes( nMes, nAno );
    
    var nDia =  $("#i-dia-inicial").val();
    nDia = parseInt( nDia );

    if( nDia > nUltimoDia )
        $("#i-dia-inicial").val( nUltimoDia );

    var nAno = $("#i-ano-final").val();
    var nMes =  $("#i-mes-final").val();
    nMes = parseInt( nMes );
    nAno = parseInt( nAno );
    var nUltimoDia = ultimoDiaMes( nMes, nAno );
    
    var nDia =  $("#i-dia-final").val();
    nDia = parseInt( nDia );

    if( nDia > nUltimoDia )
        $("#i-dia-final").val( nUltimoDia );

    if(  $("#i-ano-inicial").val() >  $("#i-ano-final").val() )
    {
        alert('Atenção! O ano inicial deve ser igual ou menor que o ano final');
        return false;

    }

    $("#i-processamento").show();

    var url = "{{route('recebimento.previsao.gerar')}}";

    var dados = 
    {
        diainicial : $("#i-dia-inicial").val(),
        diafinal : $("#i-dia-final").val(),
        mesinicial : $("#i-mes-inicial").val(),
        mesfinal : $("#i-mes-final").val(),
        anoinicial : $("#i-ano-inicial").val(),
        anofinal : $("#i-ano-final").val(),
    }

    diainicial = $("#i-dia-inicial").val(),
    diafinal = $("#i-dia-final").val(),
    mesinicial = $("#i-mes-inicial").val(),
    mesfinal  = $("#i-mes-final").val(),
    anoinicial  = $("#i-ano-inicial").val(),
    anofinal  = $("#i-ano-final").val(),

    $.ajax(
    {
        url         : url,
        dataType    : 'json',
        type        : 'get',
        data        : dados,

        beforeSend: function() 
        {
            alert('O sistema irá processar, e ao finalizar você será informado. Pressione OK para continuar');
        },
        success:function( data )
        {
            periodo = diainicial+'-'+mesinicial+'-'+anoinicial+' a '+diafinal+'-'+mesfinal+'-'+anofinal;
            window.open( "{{route('recebimento.previsao.relatorio')}}/"+periodo);
            
        },
        error:function()
        {
            alert( 'erro na geração');
        }
    });
    
}


function cargaContratosLt()
{
    $.getJSON( "{{route('locatariocontrato.cargaativos')}}", function( data )
    {
        $("#IMB_CTR_ID").empty();
                
        linha =  '<option value="">Escolha um contrato</option>';
        $("#IMB_CTR_ID").append( linha );
        for( nI=0;nI < data.length;nI++)
        {
            linha = 
                '<option value="'+data[nI].IMB_CTR_ID+'">'+
                '<b>'+data[nI].IMB_CLT_NOME+'</b>('+
                data[nI].ENDERECOCOMPLETO+')</option>';
            $("#IMB_CTR_ID").append( linha );
                        
        }

    });
            
}


</script>
@endpush