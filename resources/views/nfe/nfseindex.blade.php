@extends('layout.app')

@section('scripttop')
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
        border:.5px;

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
        color:white;
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

    table.dataTable td 
    {
        font-size: 12px;
        color:black;
    }
</style>
@endsection

@section('content')


<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-blue">
            <span class="caption-subject bold uppercase"> Notas Fiscais de Servicos</span>
            <i class="fa fa-search font-blue"></i>
        </div>


    </div>
    <div class="portlet-body form">
        <form role="form" id="search-form">
            <div class="form-body">
                <div class="col-md-6">
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="date" class="form-control " name="inicio" placeholder="Data Inicial" id="i-inicio">
                        </div>
                    </div>                
                    <div class="col-md-2 div-center font-20">
                        <i class="fa fa-arrows-h" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="date" class="form-control " name="termino" placeholder="Data Final" id="i-termino">
                        </div>
                    </div>                
                </div>                    
            </div>
            <div class="form-actions noborder">
                <button class="btn blue pull-right" id='search-form' >Pesquisar</button>
            </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover"  id="resultTable">
                    <thead>
                        <th style="width: 6%">Atenção</th>
                        <th style="width: 6%">Dt Emissão NF</th>
                        <th style="width: 6%">Dt Pagto</th>
                        <th style="width: 6%">Taxa Adm.</th>
                        <th style="width: 6%">Taxa Cont.</th>
                        <th style="width: 6%">Nº Nota</th>
                        <th style="width: 6%">Nº Recibo</th>
                        <th style="width: 15%">Locador</th>
                        <th style="width: 20%">Imóvel</th>
                        <th style="width: 6%">$  Serviços</th>
                        <th style="width: 6%">$ ISS</th>
                        <th style="width: 6%">$ Retido</th>
                        <th width="15%">Ações</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade " id="modalerronota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:50%;">
        <div class="modal-content ">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Erro nota fiscal
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="row">
                            <div class="col-md-12">
                                    <textarea  class="form-control" id="i-erros" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">sair</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('script')
<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="{{asset('/global/scripts/moment.min.js')}}" type="text/javascript"></script>

<script>



$(document).ready(function() 
    {

        $("#sirius-menu").click();


        $("#i-inicio").val( moment().format('YYYY-MM-DD') );
        $("#i-termino").val( moment().format('YYYY-MM-DD') );



    });

    
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
            url:"{{ route('listarnfes') }}",
            data: function (d) 
            {
                d.inicio = $('input[name=inicio]').val();
                d.termino = $('input[name=termino]').val();
            }

        },
        columns: 
        [
                        
            {data: 'IMB_IMV_RELIRRF', render:dimob},
            {data: 'IMB_NFE_DATAEMISSAO', render:formatarData},
            {data: 'IMB_RLD_DATAPAGAMENTO',render:formatarData},
            {data: 'TOTALTAXAADM',render:formatarValor},
            {data: 'TOTALTAXACONT',render:formatarValor},
                      
            {data: 'IMB_NFE_NOTA', render:notafiscal},
            {data: 'IMB_RLD_NUMERO'},
            {data: 'IMB_CLT_NOME'},
            {data: 'ENDERECO' },
            {data: 'IMB_NFE_VALORISSBASE',render:formatarValor},
            {data: 'IMB_NFE_VALORISS',render:formatarValor},
            {data: 'IMB_NFE_VALORRETENCAO',render:formatarValor},
        ],


        "columnDefs": 
        [ 
            {
                "targets": 12,
                "data": null,
                "defaultContent": "<div style='text-align:center'>"+
                "<button title='Cancelar Nota Fiscal' class='btn btn-danger glyphicon glyphicon-trash pull-right del-lcx btn-sm '></button>"+
                "<button class='btn btn-primary btn-sm pull-right btn-pdf'>PDF</button>"+
                "<button class='btn btn-primary btn-sm  pull-right btn-xml'>XML</button>"+
                "<button class='btn btn-primary btn-sm  pull-right btn-gerar'>Gerar</button>",
            },
        ],
        searching: false
    });

    $('#search-form').on('submit', function(e) {
        table.draw();
        e.preventDefault();
    });

        

    $('#resultTable tbody').on( 'click', '.del-lcx', function () 
        {
            var data = table.row( $(this).parents('tr') ).data();
            cancelarNFS( data.IMB_NFE_CHAVE );
            table.draw();
        });

        $('#resultTable tbody').on( 'click', '.btn-gerar', function () 
        {
            
            var data = table.row( $(this).parents('tr') ).data();

            var taxacontrato = data.TOTALTAXACONT;
            var taxaadm = data.TOTALTAXAADM;
            if(  taxacontrato === null )    taxacontrato    = 0;
            if(  taxaadm === null )         taxaadm         = 0;

            debugger;
            if( data.IMB_IMV_RELIRRF == 'N')
            {
                alert('Imóvel não incluído na dimob. Emissão de nota não permitida!');
                return false;
            }

            if( taxaadm == 0 && taxacontrato == 0  )
            {
                alert('Imóvel com taxas zeradas! Emissão de nota não permitida!');
                return false;
            }


            $("#preloader").show();
            gerarNFS( data.IMB_RLD_NUMERO );
            table.draw();
        });

        $('#resultTable tbody').on( 'click', '.btn-pdf', function () 
        {
            var data = table.row( $(this).parents('tr') ).data();
            gerarPDF( data.IMB_NFE_CHAVE );
        });

        $('#resultTable tbody').on( 'click', '.btn-xml', function () 
        {
            var data = table.row( $(this).parents('tr') ).data();
            gerarPDF( data.IMB_NFE_CHAVE );
        });


        $('#resultTable tbody').on( 'click', '.show-lcx', function () 
        {
            var data = table.row( $(this).parents('tr') ).data();
  //          verLcx( data.FIN_LCX_ID );
        });


         
        


    function redrawTable()
    {
        $('#resultTable').DataTable().ajax.reload();
    }

    function formatarData(data)
    {
        if( data != null)
            return moment(data).format('DD/MM/YYYY')
        else    
            return '-';

    }

    function formatarValor(data)
    {
//        debugger;
        if( data ==  '' || data === null ) return '0,00';
        var valor = parseFloat(data);
        return formatarBRSemSimbolo( valor )
            

    }

    function  cancelarNFS( chave )
    {
        var url = "{{route('cancelanfes')}}";

        var dados = { chave : chave };

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
                alert("Nota cancelada!");
                redrawTable();
            },
            error:function(data)
            {
                console.log( data );
                alert('erro ao cancelar nota '+data);
            }
        });



    }
        

    function  gerarNFS( recibo )
    {
        var url = "{{route('gerarnfes')}}";

        var dados = { recibo : recibo };

        $("#preloader").show();
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
                $("#preloader").hide();
                alert("Nota Gerada!");
                
                redrawTable();
            },
            error:function(data)
            {
                $("#i-erros").html(data.responseText );
                $("#preloader").hide();
                if( confirm('Houve erro na geração. Deseja ver o erro?' ) == true )
                    $("#modalerronota").modal('show');

            },
            complete:function()
            {
                $("#preloader").hide();

            }
        });




    }

    function gerarPDF( chave )
    {
        var url = "{{route('gerarnfepdf')}}?chave="+chave;

        window.open( url, '_blank');

    }
   function gerarXML( chave )
    {
        var url = "{{route('gerarnfexml')}}?chave="+chave;

        window.open( url, '_blank');

    }

    function dimob( data )
    {
        if( data != 'S' ) 
            return '<div><b>Não Dimob</b></div>'
        else
            return '<div>-</div>';
    
    }

    function notafiscal( data )
    {
        if( data === null )
            return '<div>-</div>';
        return '<div><h5><b>'+data+'</b></h5></div>';
    }
        
    
    
</script>
@endpush


