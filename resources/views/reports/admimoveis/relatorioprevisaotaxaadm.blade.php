@extends("layout.app")
@section('scripttop')
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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>  

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
            <i class="fa fa-gift"></i>Previsão de Taxa Administrativa
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
        </div>
    </div>

        <div class="portlet-body form">
        <div class="row">
            <form role="form" id="search-form">
            <input type="hidden" id="i-mes-inicial" name="mesinicial">
            <div class="col-md-12">
                <div class="col-md-2 div-center">
                    <label class="control-label ">Mês</label>
                    <select class="form-control div-center" id="i-mes-inicial-aux" >
                        <option value="">Selecione</option>
                        <option value="01">Janeiro</option>
                        <option value="02">Fevereiro</option>
                        <option value="03">Março</option>
                        <option value="04">Abril</option>
                        <option value="05">Maio</option>
                        <option value="06">Junho</option>
                        <option value="07">Julho</option>
                        <option value="08">Agosto</option>
                        <option value="09">Setembro</option>
                        <option value="10">Outubro</option>
                        <option value="11">Novembro</option>
                        <option value="12">Dezembro</option>
                    </select>
                </div>
                <div class="col-md-1 div-center">
                    <label class="control-label">Ano</label>
                    <input class="form-control div-center" type="text" id="i-ano-inicial"
                            name="anoinicial"
                        onkeypress="return isNumber(event)" onpaste="return false;">
                </div>

                <div class="col-md-1">
                    <div class="form-actions noborder">
                        <button class="btn blue pull-right" id='search-form' >Calcular</button>
                    </div>
                </div>

                <div class="col-md-2 div-center lbl-medidas-valores">
                    <Label class="control-label div-center">Taxa Admistrativa:</label>
                    <input class="form-control div-center" type="text" id="i-total">
                </div>
                <div class="col-md-2 div-center lbl-medidas-valores">
                    <Label class="control-label div-center">Taxa de Contrato:</label>
                    <input class="form-control div-center" type="text" id="i-totaltc">
                </div>
                <div class="col-md-4 div-center">
                    <label><b>Atenção: Taxas Zeradas podem se as que já saíram da previsão, pois respectivo repasse já foi realizado.</b> </label>

                </div>
            </div>
            </form>
        </div>
        <div class="row">
            <div class="col-md-12 div-center" >
                <h3 class=" escondido" id="i-processamento">Em processamento....Aguarde o final!</h3>
            </div>
        </div>

        <div class="row" id="i-div-resultado">

            <div class="col-md-12">
                <table class="table table-bordered table-striped" id="resultTable">
                    <thead>
                        <th width="10%">Pasta</th>
                        <th width="10%">Imóvel</th>
                        <th width="30%">Endereço</th>
                        <th width="20%">Locador</th>
                        <th width="10%">Vencimento</th>
                        <th width="10%">$ Taxa Adminstrativa</th>
                        <th width="10%">$ Taxa Contrato</th>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="td-direita"></th>
                            <th class="td-direita"></th>
                            <th class="td-direita"></th>
                            <th class="td-direita"></th>
                            <th class="td-direita"></th>
                            <th class="td-direita"></th>
                            <th class="td-direita"></th>
                        </tr>
                    </tfoot>


                </table>
            </div>
        </div>
    </div>

</div>
@endsection

@push('script')

<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/funcoes-recibolocatario.js')}}" type="text/javascript"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.20/api/sum().js"></script>


<script>

$( document ).ready(function()
{

    $("#sirius-menu").click();

	var hoje = new Date();
    var nDia = hoje.getDate();
    var nMes = hoje.getMonth()+1;
    var nAno = hoje.getFullYear();

    $("#i-mes-inicial-aux").change( function()
    {
        $("#i-mes-inicial").val( $("#i-mes-inicial-aux").val() );
    })

    $("#i-ano-inicial").val( nAno);
});

var table = $('#resultTable').DataTable(
    {
        "pageLength": -1,
        dom: 'Bfrtip',
        buttons: [

            'excel'
        ],
        "language":
        {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            sLoadingRecords: '<img src="{{asset('/layouts/layout/img/loader.gif')}}"/>',
                sProcessing: '<img src="{{asset('/layouts/layout/img/loader.gif')}}"/>',
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate":
            {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
        },
        bLengthChange: false,
        bSort : false ,
        responsive: false,
        processing: true,
        serverSide: true,
        ajax:
        {
            url:"{{ route('previsaotaxaadm.calcular') }}",
            data: function (d)
            {
                d.mesinicial = $('input[name=mesinicial]').val();
                d.anoinicial = $('input[name=anoinicial]').val();
            },
            complete:function()
            {
                totalizar() ;
            }
        },
        "drawCallback":function()
        {
            //alert("La tabla se está recargando"); 
            var api = this.api();
            taxadm = api.column(5, {page:'current'}).data().sum();
            taxadm = taxadm.toFixed(2);
            taxadm = formatarValor( taxadm );

            var api = this.api();
            taxacontrato = api.column(6, {page:'current'}).data().sum();
            taxacontrato = taxacontrato.toFixed(2);
            taxacontrato = formatarValor( taxacontrato );

             


            $(api.column(5).footer()).html(
                          '<div class="div-right">'+taxadm+'</div>'
                      ),
            $(api.column(6).footer()).html(
                          '<div class="div-right">'+taxacontrato+'</div>'
                      )

        },

        columns:
        [
            { data: 'IMB_CTR_REFERENCIA' },
            { data: 'IMB_IMV_ID' },
            { data: 'ENDERECO' },
            { data: 'LOCADOR' },
            { data: 'DATAVENCIMENTO', render:formatarData },
            { data: 'VALORTAXA', render:formatarValor },
            { data: 'VALORTAXACONTRATO', render:formatarValor },
        ],


        searching: false
    });

$('#search-form').on('submit', function(e)
{
    table.clear();
    table.draw();
    e.preventDefault();
});

function formatarData( data )
{
    return moment(data).format('DD/MM/YYYY');

}
function formatarValor( data )
{
    //var valor = formatarBRSemSimbolo( parseFloat(data));
    return '<div class="div-right">'+data+'</div>';
//    return  valor;

}

function totalizar()
{
    var url = "{{ route('previsaotaxaadm.totalizar') }}";

    $.getJSON( url, function( data )
    {
        console.log( data );
        $("#i-total").val( formatarBRSemSimbolo(data[0].TAXAADM) );
        $("#i-totaltc").val( formatarBRSemSimbolo(data[0].TAXACONTRATO) );

    });

}

function redrawTable()
{
    
    $('#resultTable').DataTable().ajax.reload();
}



</script>
@endpush
