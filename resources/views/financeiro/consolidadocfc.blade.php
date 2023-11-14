@extends('layout.app')
@section('scripttop')
<link href="{{asset('/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('scripttop')
<style>
.gi-2x{font-size: 2em;}
.gi-3x{font-size: 3em;}
.gi-4x{font-size: 4em;}
.gi-5x{font-size: 5em;}

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


.div-left
{
    text-align:left;
}

.Receita
{
    color:blue;
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

.font-11
{
    font-weight: bold;
    font-size:11px;
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
            <span class="caption-subject bold uppercase"> Consolidado - <b><i></i> Visão por CFC</i></b></span>
            <i class="fa fa-search font-blue"></i>
            <span id="i-totalizar"></span>
        </div>
        <div>
            <button class="btn btn-danger pull-right" type="button" id="btn-limpar"
            onClick="limparCampos()">Limpar Filtro</button>
        </div>

    </div>
    <div class="portlet-body form">
        <form role="form" id="btn-search-form">
            <input type="hidden" id="i-cfc-cons">
            <div class="col-md-12">
                <div class="col-md-2">
                    <div class="col-md-12">
                        <label class="label-control" for="i-data-inicio">Data Inicial
                        <input class="form-control" type="date" id="i-data-inicio-CONS" >
                        </label>
                    </div>
                    <div class="col-md-12">
                        <label class="label-control" for="i-data-fim">Data Final
                            <input class="form-control" type="date" id="i-data-fim-CONS">
                        </label>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="col-md-3">
                        <div class="col-md-12 div-center">
                            <label>Filtro(I)</label>
                            <select class="form-control" name="tipocompetencia" id="tipocompetencia">
                                <option value="E">Pela Data Efetivação</option>
                                <option value="C">Pela Data de Competência</option>
                            </select>
                        </div>
                        <div class="col-md-12 div-center">
                            <label>Filtro(II)</label>
                            <select class="form-control" name="tipocfc" id="tipocfc">
                                <option value="RC">Somente Contas de Receitas</option>
                                <option value="DP">Somente Contas de Despesas</option>
                                <option value="RP">Receitas e Despesas</option>
                                <option value="TR">Somente Transitórias</option>
                                <option value="TD">Todas</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 div-center">
                        <div class="col-md-12">
                            <label class="label-control">Somente da Sub-Conta</label>
                            @php
                                $sbc = app('App\Http\Controllers\ctrSubConta')->carga();
                            @endphp
                            <select class="select2" id="FIN_SBC_ID-CONSO">
                                <option value="-1">Selecione</option>
                                @foreach( $sbc as $sc)
                                    <option value="{{$sc->FIN_SBC_ID}}">{{$sc->FIN_SBC_DESCRICAO}}</option>
                                @endforeach
                            </select>
                        </div>
                        

                        <div class="col-md-12">
                            <label class="label-control">Somente do CFC</label>
                            <select class="select2" id="FIN_CFC_ID-CONS">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 div-center">
                        <div class="col-md-12 div-center">
                            <label class="control-label">Visão por CFC
                                <input class="form-control" type="checkbox" id="i-visao-cfc" checked>
                            </label>                        
                        </div>
                        <div class="col-md-12 div-center">
                            <label class="control-label">Visão por Centro Custo
                                <input class="form-control" type="checkbox" id="i-visao-subconta" >
                            </label>                        
                        </div>
                    </div>
                    <div class="col-md-2">  
                        <div class="col-md-12 div-center">
                            <label class="control-label">Somente Conciliados
                                <input class="form-control" type="checkbox" name="i-conciliados" id="i-conciliados" >
                            </label>                        
                        </div>
                    </div>

                    <div class="col-md-1"></div>
                    <div class="col-md-1 div-center">
                        <button class="btn blue  form-control" id='btn-search-form'>Processar</button>
                    </div>                    
                    <div class="col-md-1 div-center">
                        <button class="btn btn-dark form-control" onClick="relatorio()">Imprimir</button>
                    </div>                    
                </div>
            </div>
            <div class="col-md-12">

                
            </div>
        </form>
        <div class="row">
            <hr>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover"  id="resultTablecons">
                    <thead>
                        <th></th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="modalconsolidadodetalhado" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog "style="width:90%;" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalhamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject bold uppercase" id="i-cfc-detalhamento-cons">Detalhamento</span>
                            <i class="fa fa-search font-blue"></i>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="tblconsolidadodet"  class="table-striped table-bordered table-hover" >
                                    <thead>
                                        <tr>
                                            <th class="div-center" width="10%">Data Entrada</th>
                                            <th class="div-center" width="10%">Data Compet.</th>
                                            <th class="div-center" width="10%">Valor</th>
                                            <th class="div-center" width="10%">-</th>
                                            <th class="div-center" width="20%"></th>
                                            <th class="div-center" width="20%">Imóveis</th>
                                            <th class="div-center" width="20%">Informações</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
            </div>
        </div>
    </div>
</div>

@include('layout.modalcfcdetalhado')
@endsection
@push('script')

<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="{{asset('/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>

<script type="text/javascript">

    $(document).ready(function()
    {
        $("#sirius-menu").click();
        $(".select2").select2(
            {
                placeholder: 'Selecione ',
                width: null
        });

        cargaCFC();

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

        //i-cfc-cons

        $( "#i-data-inicio-CONS").val( moment().format('YYYY-MM-DD'));
        $( "#i-data-fim-CONS").val( moment().format('YYYY-MM-DD'));


    });



    var table = $('#resultTablecons').DataTable(
    {
        "pageLength": 50,
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
            url:"{{ route('caixa.cfcporperiodo') }}",
            data: function (d)
            {
                d.datainicio = $("#i-data-inicio-CONS").val();
                d.datafim = $("#i-data-fim-CONS").val();
                d.tipocompetencia = $("#tipocompetencia").val();
                d.tipocfc = $("#tipocfc").val();
                d.FIN_CFC_ID = $("#FIN_CFC_ID-CONS").val();
                d.FIN_SBC_ID= $("#FIN_SBC_ID-CONSO").val();
            }
        },
        columns:
        [
            {data: 'FIN_CFC_ID', render:getInformações },

        ],
        searching: false
    });

    $('#btn-search-form').on('submit', function(e) {
        table.draw();
        e.preventDefault();
    });


    $( document ).ready(function() 
    {    
        $("#i-visao-cfc").change( function()
        {
            if( $("#i-visao-cfc").prop('checked') )
            {
                $("#i-visao-subconta").prop( 'checked',false );
            }
        })
        $("#i-visao-subconta").change( function()
        {
            if( $("#i-visao-subconta").prop('checked') )
            {
                $("#i-visao-cfc").prop( 'checked',false );
            }
        })
    });
    
    function cargaFornecedores()
    {

        var url = "{{ route('fornecedores.list') }}";

        dados = { origem : 'carga'};

        $.ajax(
        {
            url:url,
            dataType:'json',
            type:'get',
            data:dados,
            success:function(data)
            {
                $("#IMB_EEP_ID").empty();
                linha ='<option value="">Selecione o Fornecedor</option>';
                $("#IMB_EEP_ID").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                    '<option value="'+data[nI].IMB_EEP_ID+'">'+
                        data[nI].IMB_EEP_NOMEFANTASIA+
                        "</option>";
                    $("#IMB_EEP_ID").append( linha );
                }
            }
        });
    }


    function formatarData( data, type, full, meta)
    {
        var classe="";
        var datapagamento = full.FIN_APD_DATAPAGAMENTO;

        if( datapagamento != null )
            var classe="font-blue";

        var valor =moment(data).format('DD/MM/YYYY');

        if ( valor == 'Invalid date')
            valor = '-';

        var str = full.FIN_APD_DATAVENCIMENTO;
        var date = new Date(str);
        var novaData = new Date();
        if(date < novaData && full.FIN_APD_DATAPAGAMENTO === null )
            classe="font-red-bold";

        if( full.FIN_APD_DTHINATIVADO != null )
            classe="inativado";

        return '<div class="div-center '+classe+'">'+valor+'</div>';

    }

    function formatarValor( data, type, full, meta)
    {
        var classe="";
        if( full.FIN_APD_DATAPAGAMENTO != null )
            var classe="font-blue";

        if( data !='' && data != null )
        {
            var valor = parseFloat( data );
            return '<div class="div-right '+classe+'">'+formatarBRSemSimbolo(valor)+'</div>';
        };

        var str = full.FIN_APD_DATAVENCIMENTO;
        var date = new Date(str);
        var novaData = new Date();
        if(date < novaData && full.FIN_APD_DATAPAGAMENTO === null )
           classe="font-red-bold";

        if( full.FIN_APD_DTHINATIVADO != null )
            classe="inativado";

        return '<div class="div-center '+classe+'">-</div>';

    }

    function outrosCampos( data, type, full, meta)
    {
        var classe="";
        if( full.FIN_APD_DATAPAGAMENTO != null )
            classe="font-blue";

        var str = full.FIN_APD_DATAVENCIMENTO;
        var date = new Date(str);
        var novaData = new Date();
        if(date < novaData && full.FIN_APD_DATAPAGAMENTO === null )
            classe="font-red-bold";

        if( full.FIN_APD_DTHINATIVADO != null )
            classe="inativado";

        return '<div class="div-center '+classe+'">'+data+'</div>';

    }

    function cargaCFC()
    {
        $.getJSON( "{{route('cfc.carga')}}", function( data )
        {
            $("#FIN_CFC_ID-CONS").empty();

            linha =  '<option value="">Informe um CFC</option>';
            $("#FIN_CFC_ID-CONS").append( linha );
            for( nI=0;nI < data.length;nI++)
            {
                linha =
                    '<option value="'+data[nI].FIN_CFC_ID+'">'+
                    data[nI].FIN_CFC_DESCRICAO+'<b>('+data[nI].FIN_CFC_ID+')</b></option>';
                $("#FIN_CFC_ID-CONS").append( linha );
            }
            $("#FIN_CFC_ID-CONS").select2({
                placeholder: 'Selecione o CFC',
                width: null
            });


        });


    }

    function cargaSubConta()
    {
        $.getJSON( "{{route('subconta.carga')}}", function( data )
        {
            $("#FIN_SBC_ID").empty();

            linha =  '<option value="">Informe um CFC</option>';
            $("#FIN_SBC_ID").append( linha );
            for( nI=0;nI < data.length;nI++)
            {
                linha =
                    '<option value="'+data[nI].FIN_SBC_ID+'">'+
                    data[nI].FIN_SBC_DESCRICAO+'</option>';
                $("#FIN_SBC_ID").append( linha );
            }
            $("#FIN_SBC_ID").select2({
                placeholder: 'Selecione a Sub-conta',
                width: null
            });


        });

    }

    function tipoCFC( data )
    {
        var tipo='';

        if( data == 'R') tipo='Receita';
        if( data == 'D') tipo='Despesa';
        if( data == 'T') tipo='Transtória';

        return '<div class="div-center '+tipo+'">'+tipo+'</div>';
    }

    function explodirLancamento( id, sbcid )
    {
        var url = "{{ route('caixa.consolidadodetalhado') }}";

        var dados =
        {
            cfc : id,
            sbcid :sbcid,
            datini : $('#i-data-inicio-CONS').val(),
            datfim : $('#i-data-fim-CONS').val(),
        }

        console.log( dados );
        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                data:dados,
                async:false,
                success:function( data )
                {
                    console.log( data );
                    linha = "";
                    $("#tblconsolidadodet>tbody").empty();
                    for( nI=0;nI < data.data.length;nI++)
                    {
                        var valor = parseFloat( data.data[nI].FIN_CAT_VALOR );
                        valor = formatarBRSemSimbolo(valor);
                        var origem = '';
                        if( data.data[nI].FIN_LCX_ORIGEM == 'RT') origem = 'RECEBIMENTO';
                        if( data.data[nI].FIN_LCX_ORIGEM == 'RD') origem = 'REPASSE';
                        if( data.data[nI].FIN_LCX_ORIGEM == 'CX') origem = 'LAÇTO CAIXA';
                        if( data.data[nI].FIN_LCX_ORIGEM == 'AP') origem = 'CONTAS A PAGAR';


                        var classe='';
                        if( data.data[nI].FIN_CAT_OPERACAO == 'D' ) classe="Despesa";
                        if( data.data[nI].FIN_CAT_OPERACAO == 'C' ) classe="Receita";
                        linha =
                            '<tr class="font-11 '+classe+'">'+
                            '   <td>'+moment(data.data[nI].FIN_LCX_DATAENTRADA).format('DD/MM/YYYY')+'</td>'+
                            '   <td>'+moment(data.data[nI].FIN_LCX_COMPETENCIA).format('DD/MM/YYYY')+'</td>'+
                            '   <td class="div-right">'+valor+'</td>'+
                            '   <td class="div-center">'+data.data[nI].FIN_CAT_OPERACAO+'</td>'+
                            '   <td class="div-center">'+origem+'</td>'+
                            '   <td>'+data.data[nI].ENDERECO+'</td>'+
                            '   <td>'+data.data[nI].FIN_LCX_HISTORICO+'</td>'+
                            '</tr>';

                        $("#tblconsolidadodet").append( linha );
                    }
                    $("#modalconsolidadodetalhado").modal('show');
                }
            }
        )

    }

    function getInformações(data, type, full, meta)
    {


        
        texto = '<div class="row">'+
        '   <div class="col-md-1"><a href="javascript:explodirCfc(\''+full.FIN_CFC_ID+'\',\''+$("#FIN_SBC_ID-CONSO").val()+'\');"><i class="fa fa-eye"></i></a></div>'+
        '   <div class="col-md-1">'+full.TIPO+'</div>'+
        '   <div class="col-md-7">'+full.FIN_CFC_ID+'-'+full.FIN_CFC_DESCRICAO+'</div>'+
        '   <div class="col-md-1 div-right">'+ full.Credito+'</div>'+
        '   <div class="col-md-1 div-right">'+ full.Debito+'</div>'+
        '   <div class="col-md-1 div-right">'+ full.Saldo+'</div>'+
        '</div>';

        console.log(texto);
        return texto;

    }

    function relatorio()
    {

        var datainicio = $("#i-data-inicio-CONS").val();
        var datafim = $("#i-data-fim-CONS").val();
        var tipocompetencia = $("#tipocompetencia").val();
        var tipocfc = $("#tipocfc").val();
        var FIN_CFC_ID = $("#FIN_CFC_ID-CONS").val();
        var FIN_SBC_ID= $("#FIN_SBC_ID-CONSO").val();

        var url = "{{ route('caixa.cfcporperiodo') }}?datainicio="+datainicio+"&datafim="+datafim+
                        "&tipocompetencia="+tipocompetencia+"&tipocfc="+tipocfc+"&FIN_CFC_ID="+FIN_CFC_ID+
                        "&FIN_SBC_ID="+FIN_SBC_ID+"&relatorio=S";
        window.open( url, '_blank');

    }




</script>
@endpush
