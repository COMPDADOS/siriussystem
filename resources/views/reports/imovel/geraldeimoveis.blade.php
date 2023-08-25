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

.liberado
{
    color:white;
    background-color:green;
}
.rejeitado
{
    color:white;
    background-color:red;
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

@endsection
@section('content')


<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Imóveis
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
        </div>
    </div>
</div>

    <div class="row">
        <div class="col-md-2 div-center">
            <label class="control-label">Situação</label>
            <select class="form-control" id="i-situacao">
                <option value="T">Todos</option>
                <option value="A">Disponíveis</option>
                <option value="I">Indisponíveis</option>
            </select>
        </div>

        <div class="col-md-2 div-center">
            <label class="control-label">Internet</label>
            <select class="form-control" id="i-situacao-net">
                <option value="T">Todos</option>
                <option value="S">Marcados</option>
                <option value="N">Não Marcados</option>
            </select>
        </div>
        <div class="col-md-3 div-center">
            <label class="control-label">Classificação</label>
            <select id="i-ordem" class="form-control">
                <option value="endereco" selected>Endereço</option>
                <option value="IMB_IMV_REFERE">Referência</option>
            </select>

                
        </div>
        <div class="col-md-2">
            <button class="form-control btn btn-success" onClick="relatorioGeralImoveis()">Gerar Relatório</button>
            <button class="form-control btn btn-primary" onClick="cargaImoveis()">Carregar Informações</button>
        </div>
        <div class="col-md-2">
        </div>
        <div class="col-md-2 div-center">
            <a href="javascript:gerarExcel();" title="Exportar para o Excel"><img src="{{asset('/global/img/excel-50.png')}}" alt=""></a>
        </div>

    </div>
    <hr>

    <div class="portlet-body">
        <div class="row" id="i-div-resultado">
            <div class="col-md-12">
                <table class="table table-bordered table-striped" id="resultTable">
                    <thead>
                        <th >Referência</th>
                        <th>Tipo</th>
                        <th>Endereço</th>
                        <th>Internet</th>
                        <th>Destaque</th>
                    </thead>
                </table>
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

    
});

function gerarExcel()
{
    $("#resultTable").btechco_excelexport(
        {
            containerid: "resultTable"
            , datatype: datatype.Table
            , filename: 'Relatorioimoveis'
        });

}

function cargaImoveis()
{

    dados = 
    {
       situacao : $("#i-situacao").val(),
        situacao_net : $("#i-situacao-net").val(),
        origem:"xx",
        ordem : $("#i-ordem").val(),
    }
    
    var url = "{{route('carga.imovel.geral')}}";

    $.ajax(
    {
        url         : url,
        dataType    : 'json',
        type        : 'get',
        data        :dados ,
        success:function( data )
        {
            linha = "";
                $("#resultTable>tbody").empty();
                for( nI=0;nI < data.length;nI++)
                {
                    
                    var riscado = '';
                    if( data[nI].VIS_STA_SITUACAO == 'I')
                       riscado = 'naoselecionada';

                    linha = 
                        '<tr class="'+riscado+'">'+
                            '</td> '+
                            '<td>'+data[nI].IMB_IMV_REFERE+'</td>' +
                            '<td>'+data[nI].IMB_TIM_DESCRICAO+'</td>' +
                            '<td>'+data[nI].endereco+'</td>' +
                            '<td>'+data[nI].IMB_IMV_WEBIMOVEL+'</td>' +
                            '<td>'+data[nI].IMB_IMV_DESTAQUE+'</td>' +
                        '</tr>';
                    
                    $("#resultTable").append( linha );
                }
                
        },
        erro:function()
        {
            alert('erro');
        }
    });
    
    
}

function relatorioGeralImoveis()
{

    var situacao =  $("#i-situacao").val();
    var situacao_net = $("#i-situacao-net").val();
    var ordem = $("#i-ordem").val();
    
    var url = "{{route('carga.imovel.geral')}}?situacao="+
                situacao+"&situacao_net="+situacao_net+"&ordem="+ordem+
                "&origem=RELATORIO";
    window.open( url, '_blank' );

}

</script>

@endpush