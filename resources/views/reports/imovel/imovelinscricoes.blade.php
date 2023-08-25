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
            <i class="fa fa-gift"></i>Imóveis x Incrições IPTU / Água e Esgoto / Energia
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
        </div>
    </div>
</div>

    <div class="row">
    <div class="col-md-3 div-center">
            <input type="hidden" id="i-ordem-ok">

            <div class="row">
                <input type="checkbox" class="form-control" id="i-ativos">Exibir Somente  C/ Contratos Ativos
            </div>
        </div>
        <div class="col-md-2 div-center">
            <label class="control-label">Classificação</label>
            <select id="i-ordem" class="form-control">
                <option value="ENDERECO" selected>Endereço</option>
                <option value="IMB_IMV_ID">ID Imóvel</option>
                <option value="PROPRIETARIO">Proprietário</option>
            </select>


        </div>
        <div class="col-md-2">
            <label for="">&nbsp;</label>
            <button class="btn btn-primary" onClick="cargaImoveis()">Carregar Informações</button>
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
                        <th>Situação</th>
                        <th >ID Imóvel</th>
                        <th>Endereço</th>
                        <th>Proprietário</th>
                        <th>CPF</th>
                        <th>Inscr. Energia</th>
                        <th>Inscr. Água</th>
                        <th>Senha Agua</th>
                        <th>Inscr. IPTU(1)</th>
                        <th>Inscr. IPTU(2)</th>
                        <th>Inscr. IPTU(3)</th>
                        <th>Inscr. IPTU(4)</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>


@endsection

@push('script')

<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>

<script>

$( document ).ready(function()
{



    $("#sirius-menu").click();
    $("#i-ordem-ok").val( $("#i-ordem").val() );
    $("#i-ordem").change( function()
    {
        $("#i-ordem-ok").val( $("#i-ordem").val() );
    })



});

function gerarExcel()
{
    $("#resultTable").btechco_excelexport(
        {
            containerid: "resultTable"
            , filename: 'Relatorioimoveis'
        });

}

function cargaImoveis()
{

    dados =
    {
        situacao : $("#i-ativos").prop( "checked" )  ==true ? 'A' : 'T',
        ordem    : $("#i-ordem-ok").val(),
    }

    var url = "{{route('imoveis.incricoes.carga')}}";
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

                       linha =
                        '<tr">'+

                            '<td>'+data[nI].SITUACAO+'</td>' +
                            '<td>'+data[nI].IMB_IMV_ID+'</td>' +
                            '<td>'+data[nI].ENDERECO+'</td>' +
                            '<td>'+data[nI].PROPRIETARIO+'</td>' +
                            '<td>'+data[nI].CPF+'</td>' +
                            '<td>'+data[nI].IMB_IMV_CPFLINSCRICAO+'</td>' +
                            '<td>'+data[nI].IMB_IMV_DAEINSCRICAO+'</td>' +
                            '<td>'+data[nI].IMB_IMV_DAESENHA+'</td>' +
                            '<td>'+data[nI].IMB_IMV_IPTU1+'</td>' +
                            '<td>'+data[nI].IMB_IMV_IPTU2+'</td>' +
                            '<td>'+data[nI].IMB_IMV_IPTU3+'</td>' +
                            '<td>'+data[nI].IMB_IMV_IPTU4+'</td>' ;
                        '</tr>';

                    $("#resultTable").append( linha );
                }

        },
        erro:function()
        {
            alert('erro');
        },
        complete:function()
        {
        }
    });


}


</script>

@endpush
