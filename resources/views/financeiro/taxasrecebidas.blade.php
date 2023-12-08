@extends('layout.app')
@section('scriptop')
@endsection
@section('scripttop')
<style>
.gi-2x{font-size: 2em;}
.gi-3x{font-size: 3em;}
.gi-4x{font-size: 4em;}
.gi-5x{font-size: 5em;}


input[type=text] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    /*border: 1px solid #555;*/
    outline: none;
}


input[type=text]:focus {
    background-color: lightblue;
    color:black;
}
.row-top-margin-normal {
    margin-bottom:-1px;
    margin-top:-1px;
}

.col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
    position: relative;
    min-height: 1px;
    padding-right: 8px;
    padding-left: 8px;
}
.pad-left-zero
{
    position: relative;
    min-height: 1px;
    padding-right: 0px;
    padding-left: 0px;
}

.row-top-margin {
    background-color:antiquewhite;
    margin-bottom:-1px;
    margin-top:-1px;
}

.Receita
{
    color:blue;
}

.orange
{
    color:orange;
}

.bold
{
    font-weight: bold;
}

.Despesa
{
    color:red;
}
.inativado
{
    color: gray;
}

.escondido
{
    display:none;
}
.div-center {
    text-align: center;
  }

  .italic
{
    text-decoration: italic;
}
.font-10px
{
    font-size:10px;
}

.font-green
{
    color:green;
}
.font-blue
{
    color:blue;
}

.bg-direcionado
{
    background-color:beige;
}

.bg-white
{
    background-color: white;
}

.font-red-bold
{
    color: red;
    font-weight: bold;

}

.font-und-14px
{
    font-size:14px;
    color: grey;
    text-decoration: underline;
}
.font-red-bold-10px
{
    font-size:12px;
    color: red;
    font-weight: bold;

}
.bg-red-foreg-white
{
    background-color: red;
    color:white;
    font-size:14px;
    font-weight: bold;

}
.bg-blue-foreg-white
{
    background-color: blue;
    color:white;
    font-size:14px;
    font-weight: bold;
}
.bg-orange-foreg-black
{
    background-color: orange;
    color: black;
    font-size:14px;
    font-weight: bold;
}

.font-padrao
{
    font-size:12px;
}
.font-8
{
    font-size:8px;
}


.bg-peru-foreg-white
{
    background-color:peru;
    color:white;
    font-size:14px;
    font-weight: bold;

}

.bg-peru-green-white
{
    background-color:green;
    color:white;
    font-size:14px;
    font-weight: bold;

}

.bg-gray-fore-black
{
    background-color:darkorange;
    color:black;
    font-size:14px;
    font-weight: bold;

}

.font-10px-bold
{
    font-size:12px;
    color: #000099;
    font-weight: bold;

}
.font-10px
{
    font-size:12px;
    color: #000099;
}

h5 {
    text-align: center;
    color: #4682B4 ;
    font-size: 20px;
    font-weight: bold;
}

h1 {
    text-align: center;
    color: #4682B4 ;
    font-size: 20px;
    font-weight: bold;
}

.lbl-cliente {
  text-align: center;
  font-size: 14px;
  font-weight: bold;
  color: #4682B4;
}

.div-cor-fonte-white{
    color:white;
}
.div-cor-red {
  border-style: solid;
  border-color: red;
  color: white;
}

.div-cor-green {
    border-style: solid;
  border-color: green;
}

.div-cor-blue {
    background-color: blue;
    color: white;
}

.div-cor-white{
    border-style: solid;
  border-color: white;
}

td{text-align:center;}
th{text-align:center;}

.td-center{text-align:left;}

</style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>  

@endsection

@section('content')


<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{route('home')}}">home</a>
            <i class="fa fa-circle"></i>
        </li>
    </ul>
</div>


<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-blue">
            <span class="caption-subject bold uppercase"> Taxas/Eventos Recebidos e Retidos na Imobiliária</span>
            <i class="fa fa-search font-blue"></i>
        </div>
        <div>
            <button class="btn btn-danger pull-right" type="button" id="btn-limpar"
            onClick="limparCampos()">Limpar Filtro</button>
        </div>

    </div>
    <div class="portlet-body form">
            <div class="col-md-12">
                <div class="col-md-2 row-top-margin-normal">
                    <label class="label-control" for="i-data-inicio">Data Inicial
                    <input class="form-control" type="date" id="i-data-inicio-taxas" name="i-data-inicio-taxas">
                    </label>
                </div>
                <div class="col-md-2 row-top-margin-normal">
                    <label class="label-control" for="i-data-fim">Data Final
                        <input class="form-control" type="date" id="i-data-fim-taxas" name="i-data-fim-taxas">
                    </label>
                </div>
                <div class="col-md-1 div-center">
                    <label>Somente Dimob</label>
                    <select id="i-dimob" class="form-control">
                        <option value="D" selected>Somente Dimob</option>
                        <option value="T">Todos</option>
                    </select>
                </div>

<!--                <div class="col-md-1 div-center">
                    <label>Origem</label>
                    <select id="i-origem" class="form-control">
                        <option value="D" selected>Pelo Repasse</option>
                        <option value="T">Pelo Recebimento</option>
                    </select>
                </div>
            -->        
                <div class="col-md-2 div-center">
                    <div class="form-actions noborder">
                        <button class="btn blue pull-right" id='btn-search-form' onClick="carga()">Pesquisar</button>
                    </div>
                </div>



            </div>
        <div class="row">
            <hr>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover"  id="resultTableTaxas">
                    <thead>
                    <th>Data Pagto.</th>
                    <th>Data Vencto.</th>
                    <th>Taxa Administrativa</th>
                    <th>Taxa Taxa de Contrato</th>
                    <th># Imovel</th>
                    <th>Pasta</th>
                    <th>Endereço</th>
                    <th>Locador</th>
                    <th>CPF Locador</th>
                    <th>Locatário</th>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="div-center"></th>
                            <th class="div-center"></th>
                            <th class="td-direita"></th>                    
                            <th class="td-direita"></th>                    
                            <th class="div-center"></th>
                            <th class="div-center"></th>
                            <th class="div-left"></th>
                            <th class="div-left"></th>
                            <th class="div-left"></th>
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
<script src="https://cdn.datatables.net/plug-ins/1.10.20/api/sum().js"></script>

<script type="text/javascript">

    $(document).ready(function()
    {
        $("#sirius-menu").click();
        $(".select2").select2(
            {
                placeholder: 'Selecione ',
                width: null
        });

        $('.valor').inputmask('decimal',
        {
          radixPoint:",",
          groupSeparator: ".",
          autoGroup: true,
          digits: 2,
          digitsOptional: false,
          placeholder: '0',
          rightAlign: false,
          onBeforeMask: function (value, opts)
          {
            return value;
          }
        });

        $( "#i-data-inicio").val( moment().format('YYYY-MM-DD'));
        $( "#i-data-fim").val( moment().format('YYYY-MM-DD'));


    });


    function getInformações( data, type, full, meta)
    {


        var texto = '<div class="row">'+
                    '   <div class="col-md-3">Data: <span class="bg-blue-foreg-white">'+moment( full.IMB_ACD_DATAACORDO ).format('DD/MM/YYYY')+'</span></div>'+
                    '   <div class="col-md-1">Pasta: <span class="font-10px-bold">'+full.IMB_CTR_REFERENCIA+'</span></div>'+
                    '   <div class="col-md-3">Locatário: <span class="font-10px-bold">'+full.Locatario+'</span></div>'+
                    '   <div class="col-md-3">Imovél: (<span class="font-10px-bold">'+full.IMB_IMV_ID+')<span class="font-10px-bold">'+full.Endereco+'</span></div>'+
                    '   <div class="col-md-1">$ Acordo: <span class="bg-blue-foreg-white">'+full.IMB_ACD_VALOR+'</span></div>'+
                    '   <div class="col-md-1">Parcelas: <span class="font-10px-bold">'+full.IMB_ACD_PARCELAS+'</span></div>'+
                    '</div>'+
                    '<div class="row">'+
                    '   <div class="col-md-3">Data/Valor Entrada: <span class="font-10px-bold">'+moment(full.IMB_ACD_DATAENTRADA).format( 'DD/MM/YYYY')+' / R$ '+full.IMB_ACD_VALORENTRADA+'<span></div>'+
                    '   <div class="col-md-9"><span class="font-10px-bold">'+full.IMB_ACD_MOTIVOACORDO+'</span></div>'+
                    '</div>';
        return texto;
    }

    function formatarValor( data, type, full, meta)
    {
        
  //      alert( data );
        var valor = parseFloat( data );
        return '<div class="div-right">'+formatarBRSemSimbolo(valor)+'</div>';

    }

    function formatarData( data, type, full, meta)
    {
//        alert( data );
        var data = moment(data).format('DD/MM/YYYY');
        return '<div class="div-center">'+data+'</div>';

    }


    function carga()
    {

        url = "{{ route('recibolocatario.planilharecebimento') }}";

        console.log( url );
        $('#resultTableTaxas').dataTable().fnClearTable();
        $('#resultTableTaxas').dataTable().fnDestroy();
        var table = $('#resultTableTaxas').DataTable(
        {
            "pageLength": -1,
            dom: 'Blfrtip',

            buttons: [
            'excel',
            'print'
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
            paging:         false,
            fixedColumns:   true, 

            ajax:
            {
                url : url,
                data: function (d) 
                {
                    d.datafim = $('#i-data-fim-taxas').val();
                    d.datainicio = $('#i-data-inicio-taxas').val();
                    d.dimob =  $("#i-dimob").val();
                    d.origem = $("#i-origem").val();
                    d.metodologia = $("#i-metodologia").val();
                }
            },
            "drawCallback":function()
            {
                //alert("La tabla se está recargando"); 
                var api = this.api();
                taxaadm = api.column(2, {page:'current'}).data().sum();
                taxaadm = taxaadm.toFixed(2);
                taxaadm = formatarValor( taxaadm );

                taxacontrato = api.column(3, {page:'current'}).data().sum();
                taxacontrato = taxacontrato.toFixed(2);
                taxacontrato = Math.abs(taxacontrato);
                taxacontrato = formatarValor( taxacontrato );

                $(api.column(2).footer()).html('<div class="td-direita">'+taxaadm+'</div>'),
                $(api.column(3).footer()).html('<div class="td-direita">'+taxacontrato+'</div>')
            },                 
            columns: 
            [
                {data: 'IMB_RLT_DATAPAGAMENTO', render:formatarData},
                {data: 'IMB_RLT_DATACOMPETENCIA', render:formatarData},
                {data: 'TAXAADM', render:formatarValor},
                {data: 'TAXACONTRATO', render:formatarValor},
                {data: 'IMB_IMV_ID'},
                {data: 'IMB_CTR_REFERENCIA'},
                {data: 'ENDERECOIMOVEL'},
                {data: 'NOMELOCADOR'},
                {data: 'CPFLOCADOR'},
                {data: 'NOMELOCATARIO'},
            ],
            searching: false
        });

        $('#search-form').on('submit', function(e) 
        {
            $("#i-totaltaxas").val(0);
            table.draw();
            e.preventDefault();
        });


    }


</script>
@endpush
