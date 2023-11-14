@extends('layout.app')

@section('scripttop')
<link href="{{asset('/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<style>

    .escondido
    {
        display:none;
    }
    .new-input{width:500px}    
    .new-input-200{width:200px}    
    .td-50
    {   
        height:50%;
    }

    .font-20
    {
        font-size:30px;
    }

    .td-center
    {   
        text-align:center;
    }
    
    .excluido {
      text-decoration: line-through;
    }
    .td-direita
    {   
        text-align:right;
    }

    table.dataTable tbody th, table.dataTable tbody td 
    {
        padding: 1px 10px; 
        text-align:center;

    }


    .div-center
    {
        text-align:center;
    }

    .fundo-grey
    {
        background-color: #eff5f5;
    }

    .azul
    {
        color:blue;
    }
    .font-white
    {
        color:whi;
    }
    .vermelho
    {
        color:red;
    }

    .fundo-azul
    {
        background-color:blue;
    }
    .fundo-black
    {
        background-color:black;
    }

</style>
@endsection

@section('content')


<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-blue">
            <span class="caption-subject bold uppercase"> Seguro Incêndio - Pesquisa</span>
            <i class="fa fa-search font-blue"></i>
        </div>
        <div>
            <button class="btn btn-danger pull-right" type="button" id="btn-limpar"
            onClick="limparCampos()">Limpar Filtro</button>
        </div>

        <button class="btn green pull-right escondido" id="btnnovo" type="button" onClick="novoSeguro()">Novo Seguro</button>


    </div>
    <div class="portlet-body form">
       <form role="form" id="search-form">
            @php
                $param2 = app( 'App\Http\Controllers\ctrRotinas')->parametros2( Auth::user()->IMB_IMB_ID );
                $idtbe = $param2->IMB_TBE_IDSEGINC;
                $idimovel='';

                $vencimentolocatario ='';
                if( $idcontrato<>'' )
                {
                    $contrato = app('App\Http\Controllers\ctrContrato')->findJson( $idcontrato );
                    $vencimentolocatario = $contrato->IMB_CTR_VENCIMENTOLOCATARIO;
                    $idimovel = $contrato->IMB_IMV_ID;
                }
            @endphp
           <input type="hidden" id="inc-IMB_CTR_ID" name="idcontrato" value = "{{$idcontrato}}">
           <input type="hidden" id="idseginc" value = "{{$idtbe}}">
           <input type="hidden" id="dataproxvenlt" value = "{{$vencimentolocatario}}">
           <input type="hidden" id="inc-IMB_IMV_ID" value = "{{$idimovel}}">
           
           <div class="form-body">
                <div class="col-md-3 fundo-grey">
                    <div class="form-group">
                        <input type="hidden" id="i-seguradora-go" name="seguradora-go" value ="">
                        <label  class="control-label">Seguradora</label>
    		    		<select class="select2" id="idseguradora" name="idseguradora" >
				    	</select>
                    </div>
                </div>
                
                <div class="col-md-2"></div>
                <div class="col-md-4 fundo-grey">
                    <div class="col-md-12 div-center fundo-black font-white">
                        Com Vencimento do Seguro Entre

                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="date" class="form-control" name="inicio" placeholder="Data Inicial" id="i-inicio">
                        </div>
                    </div>                
                    <div class="col-md-2 div-center font-20">
                    <i class="fa fa-arrows-h" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="date" class="form-control" name="termino" placeholder="Data Final" id="i-termino">
                        </div>
                    </div>                
                </div>
                <div class="form-actions noborder">
                    <button class="btn blue pull-right" id='search-form' >Pesquisar</button>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-3"  id="i-saldo-inicial">
                        </div>
                        <div class="col-md-9 td-direita"  id="i-saldo-final">
                        </div>                        
                    </div>
                </div>
                <table class="table table-striped table-hover"  id="resultTable">
                    <thead>
                        <th style="width: 25%">Seguradora</th>
                        <th style="width: 5%">Pasta</th>
                        <th style="width: 25%">Imóvel</th>
                        <th style="width: 20%">Locatário</th>
                        <th style="width: 10%">$ Seguro</th>
                        <th style="width: 10%">$ Cobertura</th>
                        <th style="width: 10%">Inicio Contrato</th>
                        <th style="width: 10%">Inicio Seguro</th>
                        <th style="width: 5%">Vencto. Seguro</th>
                        <th width="15%">Ações</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>



@if( $idcontrato <> 0  )
<div class="modal"  role="dialog" id="modalnovoseguro">
    <div class="modal-dialog" style="width:90%;" >
        <div class="modal-content">
            <div class="modal-body">
                @include('layout.cabecalhocontrato')
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Seguro Incêndio
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
          
                    <input type="hidden" id="inc-IMB_SCT_ID" value = "">
                    <div class="portlet-body form">
                        <div class="form-body" >
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="control-label" for="i-seguradora"> Seguradora</label>
                                    <select class="select2" id="inc-seguradora" name="inc-seguradora" >
            				    	</select>
                                </div>

                                <div class="col-md-2">
                                    <label class="control-label" for="inc-IMB_CTR_DATAAQUISICAO"> Data Aquisição</label>
                                    <input type="date" class="form-control "  id="inc-IMB_CTR_DATAAQUISICAO">                        
                                    
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label" for="inc-IMB_CTR_VIGENCIAINICIO"> Início Vigência</label>
                                    <input type="date" class="form-control "  id="inc-IMB_CTR_VIGENCIAINICIO">                        
                                    
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label" for="inc-IMB_CTR_VIGENCIATERMINO"> Término Vigência</label>
                                    <input type="date" class="form-control "  id="inc-IMB_CTR_VIGENCIATERMINO">                        
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="control-label" for="inc-IMB_SCT_VALORSEGURO"> Valor Seguro</label>
                                    <input type="text" class="form-control valor "  id="inc-IMB_SCT_VALORSEGURO">                        
                                    
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label" for="inc-IMB_SCT_VALORCOBERTURA"> Valor Cobertura</label>
                                    <input type="text" class="form-control valor"  id="inc-IMB_SCT_VALORCOBERTURA">                        
                                </div>
                                <div class="col-md-8">
                                    <label class="control-label" for="inc-IMB_SCT_OBSERVACAO"> Observação</label>
                                    <textarea  class="form-control" id="inc-IMB_SCT_OBSERVACAO" rows="3"></textarea>                              
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="com-md-12">
                                    <div class="col-md-4">
                                        <div class="col-md-4">
                                            <label class="control-label">Valor Mensal</label>
                                            <input type="text" class="form-control valor" id= "INC-IMB_SCT_VALORMES">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label">Qtde. Parcelas</label>
                                            <input type="number" class="form-control" id= "INC-IMB_SCT_MESES">
                                        </div>
                                        <div class="col-md-5">
                                            <label class="control-label">Dt. 1ª Parc.</label>
                                            <input type="date" class="form-control" id= "INC-IMB_SCT_DATAPRIMEIRAPARCELA">
                                            <button class="btn btn-primary form-control" onClick="lancarSeguroIncendio()">Gerar Parcelas</button>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row escondido" id='i-parcelas'>
                                            <div class="col-md-12">
                                                <table  id="i-yyy" class="table table-bordered table-hover" >
                                                    <thead class="thead-dark">
                                                        <tr >
                                                            <th width="10%" style="text-align:center"> ID </th>
                                                            <th  width="15%" style="text-align:center"> Vencimento </th>
                                                            <th  width="15%"style="text-align:center"> Valor </th>
                                                            <th width="60%" style="text-align:center"> Observaçao </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-5" id="div-valoreslancados">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
      
            <div class="modal-footer">
                <div class="form-actions right">
                                <button type="cancel" class="btn red"data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn blue " id="i-btn-gravar" onClick="gravarRegistro()">
                                    <i class="fa fa-check"></i> Gravar
                                </button>
                            </div>
            </div>
        </div>
    </div>
</div>
@endif


@endsection

@push('script')
<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script src="{{asset('/global/scripts/moment.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('/js/jquery-ui-timepicker-addon.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/i18n/jquery-ui-timepicker-addon-i18n.min.js')}}"></script>
<script src="{{asset('/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>

<script>



    $(document).ready(function() 
    {

        $("#sirius-menu").click();

        $("#i-inicio").val( moment().format('YYYY-MM-DD') );
        $("#i-termino").val( moment().format('YYYY-MM-DD') );

        $("#idseguradora").select2(
        {
            placeholder: 'Selecione',
            width: null,
        });

        $("#inc-seguradora").select2(
        {
            width: null,
            dropdownParent: $("#modalnovoseguro")
        });

        cargaSeguradora();

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

        if( $("#inc-IMB_CTR_ID").val() != '0' ) 
        {
            $("#btnnovo").show();
        }


    });

    
    url = "{{ route('seguroincendio.carga') }}";
    console.log( url );
    var table = $('#resultTable').DataTable(
    {        
        "pageLength": -1,
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
            url: url,
            data: function (d) 
            {
                d.inicio = $('input[name=inicio]').val();
                d.termino = $('input[name=termino]').val();
                d.idcontrato = $("#inc-IMB_CTR_ID").val();
            }

        },
        columns: 
        [
            {data: 'SEGURADORA'},
            {data: 'IMB_CTR_REFERENCIA'},
            {data: 'ENDERECO'},
            {data: 'LOCATARIO'},
            {data: 'IMB_SCT_VALORSEGURO', render:formatarValor},
            {data: 'IMB_SCT_VALORCOBERTURA', render:formatarValor},
                        
            {data: 'IMB_CTR_INICIO', render: formatarDataInicioContrato },
            {data: 'IMB_CTR_VIGENCIAINICIO', render: formatarDataVigInicio},
            {data: 'IMB_CTR_VIGENCIATERMINO', render: formatarDataVigTermino},
        ],


        "columnDefs": 
        [ 
            {
                "targets": 9,
                "data": null,
                "defaultContent": "<div style='text-align:center'>"+
                "<button class='btn btn-primary glyphicon glyphicon-pencil pull-right alt-lcx'></button>"+
                "<button class='btn btn-danger glyphicon glyphicon-trash pull-right del-lcx'></button>",                
            },
        ],
        searching: false
    });

    $('#search-form').on('submit', function(e) {
        table.draw();
        e.preventDefault();
    });

        
    $("#idseguradora").change( function()
    {
        var seg = $("#idseguradora").val();
        $("#i-seguradora-go").val( seg  );
        

    })

    $('#resultTable tbody').on( 'click', '.alt-lcx', function () 
        {
            var data = table.row( $(this).parents('tr') ).data();
            alterar( data.IMB_SCT_ID, data.IMB_CTR_ID );
            table.draw();
        });


        $('#resultTable tbody').on( 'click', '.show-lcx', function () 
        {
            var data = table.row( $(this).parents('tr') ).data();
  //          verLcx( data.FIN_LCX_ID );
        });


         
        function formatarDataInicioContrato(data, type, full, meta)
    {
        return moment(full.IMB_CTR_INICIO).format('DD/MM/YYYY');

    }
    function formatarDataVigInicio(data, type, full, meta)
    {
        return moment(full.IMB_CTR_VIGENCIAINICIO).format('DD/MM/YYYY');

    }
    
    function formatarDataVigTermino(data, type, full, meta)
    {
        return moment(full.IMB_CTR_VIGENCIATERMINO).format('DD/MM/YYYY');

    }

    
    function gravarRegistro()
    {

        if( ! validarData( $("#inc-IMB_CTR_VIGENCIAINICIO").val() ) ) 
        {
            alert( 'Data de INÍCIO DA VIGÊNCIA Inválida!');
            return false;
        }


        if( ! validarData( $("#inc-IMB_CTR_VIGENCIATERMINO").val() ) ) 
        {
            alert( 'Data de TERMINO DA VIGÊNCOA Inválida!');
            return false;
        }

        if( ! validarData( $("#inc-IMB_CTR_DATAAQUISICAO").val() ) ) 
        {
            alert( 'Data de AQUISIÇÃO Inválida!');
            return false;
        }

        
        if( $("#inc-seguradora").val() == '' )
        {
            alert('Informe a Seguradora!');
            return false;
        }

        url = "{{route('seguroincendio.update')}}";


        dados = 
        {
            IMB_SCT_ID : $("#inc-IMB_SCT_ID").val(),
            IMB_CTR_DATAAQUISICAO :      $("#inc-IMB_CTR_DATAAQUISICAO").val() ,
            IMB_CTR_VIGENCIAINICIO :     $("#inc-IMB_CTR_VIGENCIAINICIO").val(),
            IMB_CTR_VIGENCIATERMINO :    $("#inc-IMB_CTR_VIGENCIATERMINO").val(),
            IMB_CLT_ID :  $('#inc-seguradora').val(),
            IMB_SCT_OBSERVACAO : $("#inc-IMB_SCT_OBSERVACAO").val(),
            IMB_CTR_ID:  $("#inc-IMB_CTR_ID").val(),
            IMB_SCT_VALORCOBERTURA : realToDolar( $("#inc-IMB_SCT_VALORCOBERTURA").val() ),
            IMB_SCT_VALORSEGURO : realToDolar( $("#inc-IMB_SCT_VALORSEGURO").val() ),

        }
        $.ajaxSetup({
        headers:    
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });

        $.ajax(
            {
                url     : url,
                dataType: 'json',
                type    : 'post',
                data:dados,
                async:false,
                success: function( data )
                {
                    alert("Registro gravado!");
                    redrawTable();
                    $("#modalnovoseguro").modal( 'hide');
                    if( $("#inc-IMB_CTR_ID").val() != '0' )
                    { //quando vier de uma tela de contrato
                        gravarParcelasEmBanco();
                       window.close();
                    }



                },
                error:function()
                {
                    alert('erro na gravacao do Registro');
                }
            }
        )


    }
    
    function validarData(data)
    {
        var ret = true;
        if( data.length != 10 ) ret = false
        else
		    ret = moment( data, 'DD-MM-YYYY').isValid() ;
        return ret;
	}

    function cargaSeguradora()
    {
        var url = "{{ route('cliente.carga')}}";

//        console.log('url carga atendente: '+url );

        $.getJSON( url, function( data )
        {
            linha = "";
            $("#idseguradora").empty();
            $("#inc-seguradora").empty();
            $("#idseguradora").append( '<option value="">Selecione a Seguradora</option>' );
            $("#inc-seguradora").append( '<option value="">Selecione a Seguradora</option>' );
            for( nI=0;nI < data.length;nI++)
            {

                linha = 
                        '<option value="'+data[nI].IMB_CLT_ID+'">'+
                        data[nI].IMB_CLT_NOME+"</option>";
                $("#idseguradora").append( linha );
                $("#inc-seguradora").append( linha );
            }       
        });
            
    }

    function alterar( id, idcontrato )
    {

        pegarContrato( idcontrato )

        var dados = { id : id };

        var urlseg = "{{route('seguroincendio.carga')}}";

        $.ajax(
        {
            url:urlseg,
            dataType:'json',
            type:'get',
            data:dados,
            success:function( data )
            {
                $("#inc-IMB_SCT_ID").val(data.data[0].IMB_SCT_ID);
                $("#inc-IMB_CTR_ID").val(data.data[0].IMB_CTR_ID);
                $("#inc-IMB_CTR_DATAAQUISICAO").val( moment(data.data[0].IMB_CTR_DATAAQUISICAO).format('YYYY-MM-DD'));
                $("#inc-IMB_CTR_VIGENCIAINICIO").val(  moment(data.data[0].IMB_CTR_VIGENCIAINICIO).format('YYYY-MM-DD'));
                $("#inc-IMB_CTR_VIGENCIATERMINO").val(  moment(data.data[0].IMB_CTR_VIGENCIATERMINO).format('YYYY-MM-DD'));
                $('#inc-seguradora').val(data.data[0].IMB_CLT_ID).select2();
                $("#inc-IMB_SCT_OBSERVACAO").val( data.data[0].IMB_SCT_OBSERVACAO);
                $("#inc-IMB_SCT_OBSERVACAO").val( data.data[0].IMB_SCT_OBSERVACAO);
                $("#inc-IMB_SCT_VALORCOBERTURA").val( formatarBRSemSimbolo( parseFloat(data.data[0].IMB_SCT_VALORCOBERTURA )));
                $("#inc-IMB_SCT_VALORSEGURO").val( formatarBRSemSimbolo( parseFloat(data.data[0].IMB_SCT_VALORSEGURO)));
                carregarParcelas(data.data[0].IMB_CTR_ID); 
            }
        });

        $("#modalnovoseguro").modal( 'show');

    }

    function limparCampos()
    {

    }

    function novoSeguro()
    {
        var idcontrato = $("#inc-IMB_CTR_ID").val();
            
        var diahoje=moment().format('DD');

        $("#INC-IMB_SCT_DATAPRIMEIRAPARCELA").val( $("#dataproxvenlt").val() );

        $("#inc-IMB_SCT_ID").val('');
        $("#inc-IMB_CTR_DATAAQUISICAO").val( moment().format('DD/MM/YYYY') );
        $("#inc-IMB_CTR_VIGENCIAINICIO").val( moment().format('DD/MM/YYYY') );
        $('#inc-seguradora').val('');
        $("#inc-IMB_SCT_OBSERVACAO").val( '');


        var ddata = moment().format('YYYY/MM/DD');
        for( nI=0;nI < 12;nI++ )
        {
            ddata = adicionarMes( diahoje, ddata );
	    }
        $("#inc-IMB_CTR_VIGENCIATERMINO").val( moment(ddata).format('DD/MM/YYYY') );
                
        pegarContrato( idcontrato )

        $("#modalnovoseguro").modal( 'show');


    }

    function  pegarContrato( idcontrato )
    {
        var url = "{{route('contrato.find')}}/"+idcontrato;

        $.ajax(
            {
                url : url,
                type:'get',
                dataType:'json',
                success:function(data)
                {
                    $("#i-locatario").val( data[0].IMB_CLT_NOME_LOCATARIO);
                    $("#i-locador").val( data[0].PROPRIETARIO);
                    if( data[0].IMB_CTR_REFERENCIA != '' )
                        $("#i-pasta").val( data[0].IMB_CTR_REFERENCIA )
                    else
                        $("#i-pasta").val( data[0].IMB_IMV_ID );

                    $("#i-iniciocontrato").val( moment(data[0].IMB_CTR_INICIO).format('DD/MM/YYYY'));
                    $("#i-proximoreajuste").val( moment(data[0].IMB_CTR_DATAREAJUSTE).format('DD/MM/YYYY'));
                }
            }
        );
    }

    function redrawTable()
    {
        $('#resultTable').DataTable().ajax.reload();
    }


    function formatarValor( data )
    {
        if( data === null )
            return formatarBRSemSimbolo(0);                

        return formatarBRSemSimbolo(parseFloat(data));        
    }

    function carregarParcelas( idcontrato )
    {
        var idseginc = "{{$param2->IMB_TBE_IDSEGINC}}";
        var idempresa = "{{Auth::user()->IMB_IMB_ID}}";
        console.log( idseginc);
        $("#i-yyy>tbody").empty();
        var url = "{{route('lancamento.list')}}/"+idcontrato+"/"+idempresa+"/1/"+idseginc+"/ORDEMCRESCENTE/0";

        $.ajax
        (
         {
             url:url,
            dataType:'json',
            type:'get',
            success:function( data )
            {
                $("#div-valoreslancados").empty;
                console.log( data );
                for( nI=0;nI < data.data.length;nI++)
                {
                    console.log( linha)
                    linha= 
                    '<div class="col-md-3">Vencto: '+moment(data.data[nI].IMB_LCF_DATAVENCIMENTO).format('DD/MM/YYYY')+'</div>'+
                    '<div class="col-md-3">Valor R$: '+dolarToReal(data.data[nI].IMB_LCF_VALOR)+'</div>'+
                    '<div class="col-md-6">'+data.data[nI].IMB_LCF_OBSERVACAO+'</div>';
                    $("#div-valoreslancados").append( linha );

                }

               }   
            }
        )
    }
    
    function lancarSeguroIncendio()
    {
        if( $("#INC-IMB_SCT_VALORMES").val() == '' )
        {
            alert('Informe o valor mensal!');
            return false;
        }
        if( $("#INC-IMB_SCT_MESES").val() == '' )
        {
            alert('Informe a quantidade de parcelas!');
            return false;
        }
        var tbeid=$("#idseginc").val();

        if( tbeid == '' )
        {
            alert('Código do ítem seguro incêndio não definido na parametrização!')
            return false;

        }

        var nDiaVencimento = moment( $("#INC-IMB_SCT_DATAPRIMEIRAPARCELA").val()).format( 'DD');        

        var valor = $("#INC-IMB_SCT_VALORMES").val() ;
        var dFormatado = moment($("#INC-IMB_SCT_DATAPRIMEIRAPARCELA").val() ).format("M-D-YYYY");

        dFormatado = new Date( dFormatado );

        var datainicial     = new Date( dFormatado.getFullYear(),
                                    dFormatado.getMonth(),
                                    nDiaVencimento);

        nMes = 0;
        nAno = 0;
        linha = "";
        descricao='';
        nMes = datainicial.getMonth();
        nAno = datainicial.getFullYear();
        nIni = 1;
        nFim = $("#INC-IMB_SCT_MESES").val()
        nLinha = 0;
        //nFim = nParcelas;
        $("#i-yyy>tbody").empty();
        for( nParcelas=nIni ;nParcelas <= nFim;nParcelas++)
        {
            if( nParcelas != nIni )
            {
                nMes++;
                if( nMes > 11 )
                {
                    nMes = 0;
                    nAno++;
                }
                nUltimoDia = ultimoDiaMes( nMes+1, nAno );
        
                if ( nUltimoDia < nDiaVencimento )
                    nDiaVencimento = nUltimoDia;

                datainicial = new Date( nAno, nMes, nDiaVencimento );

            };


            nLinha++;

            linha =
            '<tr>'+
                '<td style="text-align:center valign="center">'+nParcelas+'</td>' +
                '<td style="text-align:center valign="center">'+moment(datainicial).format('DD/MM/YYYY')+'</td>' +
                '<td style="text-align:center valign="right">'+valor+'</td>' +
                '<td  style="text-align:center valign="center">'+$("#inc-seguradora").select2('data')[0].text+' - Parcela '+nParcelas+'</td>'+
            '</tr>';

            $("#i-yyy").append( linha );

        }   ;
        $("#i-parcelas").show();



    }
    
    function gravarParcelasEmBanco()
    {

        aLF = [];
        var linha = 1;
        $('#i-yyy tbody tr').each(function ()
        {
            $.ajaxSetup(
            {
                headers:
                {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            });

            var colunas = $(this).children();
            // Criar objeto para armazenar os dados (com JSON essa tarefa fica mais simples)
            var lf =
            {
                IMB_LCF_VALOR: realToDolar( $(colunas[2]).text()),
                IMB_LCF_LOCADORCREDEB: 'N',
                IMB_LCF_LOCATARIOCREDEB: 'D',
                IMB_LCF_DATAVENCIMENTO: $(colunas[1]).text(),
                IMB_LCF_OBSERVACAO: $(colunas[3]).text(),
    	        IMB_LCF_TIPO: 'M' ,
                IMB_CTR_ID: $("#inc-IMB_CTR_ID").val(),
                IMB_IMV_ID: $("#inc-IMB_IMV_ID").val(),
                IMB_TBE_ID: $("#idseginc").val(),
                IMB_LCF_INCMUL: 'S',
                IMB_LCF_INCIRRF: 'N',
                IMB_LCF_INCTAX: 'N',
                IMB_LCF_INCJUROS: 'S',
                IMB_LCF_INCCORRECAO: 'S',
                IMB_LCF_GARANTIDO:'N',
                IMB_LCF_INCISS: 'N',
                IMB_LCF_FIXO:'N',
                IMB_LCF_COBRARTAXADMMES:'',
                IMB_CLT_IDLOCADOR:'',

            };

            linha = linha +1;
            aLF.push( lf );
        } );

        console.log( aLF )
        debugger;
        var url = "{{ route('lancamento.gravararray')}}";

        $.ajax(
        {
          url:url,
          type:'post',
          datatype:'json',
          async:false,
          data: { lfs : aLF},
          async:false,
          success:function( )
          {
            alert('Gravado!!!');

          },
          error: function()
          {
            alert('Erro na gravação do LF');
          }
        });
        
  }

    
</script>
@endpush


