@extends('layout.app')

@section('scripttop')
<style>

hr {
border-top:3px dotted black;
/*Rest of stuff here*/
}

    .cor-itenscalculado
    {
        background-color: #e6f7ff;
    }
    .cor-itenscalculado-direita
    {
        background-color: #e6f7ff;
        font-size:12px;
        text-decoration: italic;
        text-align:right;
    }
    .cor-itenscalculado-center
    {
        background-color: #e6f7ff;
        font-size:12px;
        text-decoration: italic;
        text-align:center;
    }


.cor-itensboleto
    {
        background-color: #ffffe6;
    }
    .cor-itensboleto-direita
    {
        background-color: #ffffe6;
        font-size:12px;
        text-decoration: italic;
        text-align:right;
    }
    .cor-itensboleto-center
    {
        background-color: #ffffe6;
        font-size:12px;
        text-decoration: italic;
        text-align:center;
    }
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
        font-size:20px;
    }
    .font-15
    {
        font-size:15px;
    }

    .font-azul
    {
        color:blue;
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

    .font-10
    {
        font-size: 10px;
    }

    .font-bold
    {
        font-weight: bold;
    }

</style>
@endsection

@section('content')


<div class="portlet light bordered">
    <div class="portlet-title">
        @php
            $param = app( 'App\Http\Controllers\ctrParametrizacao')->pegarParametrosTodos( Auth::user()->IMB_IMB_ID );
            $repassar = $param->IMB_PRM_REPASSENORECTO;
        @endphp
        <div class="caption font-blue">
            <span class="caption-subject bold uppercase"> * Prévia para Baixa de Títulos Bancários *</span>
            <i class="fa fa-search font-blue"></i>
        </div>
        <div class="td-direita">
            <button class="btn btn-danger pull-right" type="button" id="btn-baixar"
                  onClick="baixaAutomatica()">Baixa Automática</button>
            <button class="btn btn-primary pull-right" type="button" id="btn-baixar"
                  onClick="imprimir()">Imprimir</button>
        </div>


    </div>
    <div class="portlet-body form">
       <form role="form" id="search-form">
            <div class="form-body">
            </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover"  id="resultTable">
                </table>
            </div>
        </div>
    </div>
</div>
<form style="display: none" action="{{route('repasse')}}" method="POST" id="form-repassar-baixaautomatica"target="_blank">
    @csrf
    <input type="hidden" id="i-idcontrato-repassar" name="IMB_CTR_ID" />
</form>
@endsection


@push('script')
<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script src="{{asset('/global/scripts/moment.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('/js/jquery-ui-timepicker-addon.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/i18n/jquery-ui-timepicker-addon-i18n.min.js')}}"></script>

<script>



    $(document).ready(function()
    {

        $("#sirius-menu").click();
        $("#preloader").show();        


    });


    var table = $('#resultTable').DataTable(
    {
        "pageLength": 500,
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
        autoWidth: false,      
        searching: false,


        ajax:
        {
            url:"{{ route('cobrancabancaria.cargatmpretorno') }}",
            data: function (d)
            {
                d.somentebaixados = 'S';
            }
        },
        columns:
        [

            {data: 'SELECIONADO', render:selecionar},
            {data: 'IMB_CTR_REFERENCIA', render:montarDados},
        ],

    });

    $('#search-form').on('submit', function(e) 
    {
        if( $("#FIN_CCX_ID").val() == '' )
        {
            alert('A informação da conta é necessária!');
            return false;
        }
        $("#i-limpar").val( 'S');
        table.draw();
        e.preventDefault();
        totalizar();
    });


    function redrawTable()
    {
        $('#resultTable').DataTable().ajax.reload();
    }

  

    function formatarData( data )
    {
        return moment(data).format('DD/MM/YYYY');

    }

    function formatarValor( data )
    {
        var valor = parseFloat( data );
        return formatarBRSemSimbolo(valor);
    }


    function selecionarOnOff( id) 
    {

        var url = "{{route('selecionardepositoonoff')}}";

        $("#i-limpar").val('N');

        var dados = { id : id };

        $.ajaxSetup(
        {
            headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });

        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'post',
                data:dados,
                success:function()
                {
                    $('#resultTable').DataTable().ajax.reload();
                }
            })
    
    }


    function selecionar( data, type, full, meta) 
    {
        $("#preloader").hide();
        if( full.selecionado == 'N')
            return '<dir class="row"><div><a href="javascript:selecionarOnOff('+full.idtable+')" ><i class="fa fa-square-o fa-2x" aria-hidden="true"></i></a></div></div>';
        return '<dir class="row"><div><a href="javascript:selecionarOnOff('+full.idtable+')" ><i class="fa fa-check-square-o fa-2x" aria-hidden="true"></i></a></div></div>';
    }

    function montarDados( data, type, full, meta) 
    {

        var url = "{{route('cobrancabancaria.cargaboletoheaderperm')}}/"+full.id;
        valorbonificacaoboleto=0;
        valortotalboleto = 0;
        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                async:false,
                success:function( data )
                {

                    valorbonificacaoboleto = data.IMB_CGR_VALORPONTUALIDADE;
                    valortotalboleto = data.IMB_CGR_VALOR;
                }
            }
            

        )
        

        var url = "{{route('cobrancabancaria.cargaitensperm')}}/"+full.id;
        
        japago = 0;
        pagocomdiferenca = 0;
        tableitem='';
        totalitensboleto = 0;
        totalitenscalculado = 0;
        $.ajax( 
            {
                url:url,
                dataType:'json',
                type:'get',
                async:false,
                success:function( data)
                {
                    tableitem = '<table class="cor-itensboleto">';
                    var totalcalculado=0;

                    totalcalculado = totalcalculado - valorbonificacaoboleto;

                    for( nI=0;nI < data.length;nI++)
                    {

                        cobs = data[nI].IMB_LCF_OBSERVACAO;

                        if( data[nI].IMB_LCF_OBSERVACAO === null) cobs ='';

                        
                        if( data[nI].IMB_RLT_LOCATARIOCREDEB == 'D')
                           totalcalculado = totalcalculado + parseFloat(data[nI].IMB_LCF_VALOR);
                        else

                        if( data[nI].IMB_RLT_LOCATARIOCREDEB == 'C')
                            totalcalculado = totalcalculado - parseFloat(data[nI].IMB_LCF_VALOR);


                        tableitem = tableitem +
                        '<tr class="cor-itensboleto">'+
                        '   <td class="cor-itensboleto-center">'+data[nI].IMB_TBE_NOME+'</td>'+
                        '   <td class="cor-itensboleto-direita">'+formatarValor(data[nI].IMB_LCF_VALOR)+'</td>'+
                        '   <td class="cor-itensboleto-center">'+cobs+'</td>'+
                        '</tr>';
                    }
                    {
                        tableitem = tableitem +
                        '<tr class="cor-itensboleto">'+
                        '   <td class="cor-itensboleto-center"><b>$ Boleto</b></td>'+
                        '   <td class="cor-itensboleto-direita"><div class="td-direita"><b>'+formatarValor(valortotalboleto)+'</b></div></td>'+
                        '   <td class="cor-itensboleto-center"></td>'+
                        '</tr>';
                    }

                    tableitem = tableitem + '</table>'
                    totalitensboleto = totalcalculado;

                }
            });

        var url ="{{route('recebimento.calcular')}}/"+full.IMB_CTR_ID+'/'+full.IMB_CGR_VENCIMENTOORIGINAL+'/'+full.datapagamento+'/N/N/N/boleto';

        tableitemcalculado='';
        totalcalculado=0;
        $.ajax( 
            {
                url:url,
                dataType:'json',
                type:'get',
                async:false,
                success:function( data)
                {
                    tableitemcalculado = '<table class="cor-itenscalculado">';
                    totalcalculadoapagar=0;
                    for( nI=0;nI < data.length;nI++)
                    {
                        cobs = data[nI].IMB_LCF_OBSERVACAO;
                        if( data[nI].IMB_LCF_OBSERVACAO === null) cobs='';
                        if( data[nI].IMB_LCF_LOCATARIOCREDEB == 'D')
                            totalcalculadoapagar = totalcalculadoapagar + parseFloat(data[nI].IMB_LCF_VALOR)
                        else
                            totalcalculadoapagar = totalcalculadoapagar - parseFloat(data[nI].IMB_LCF_VALOR);

                        tableitemcalculado = tableitemcalculado +
                        '<tr class="cor-itenscalculado">'+
                        '   <td class="cor-itenscalculado-center">'+data[nI].IMB_TBE_NOME+'</td>'+
                        '   <td class="cor-itenscalculado"><div class="td-direita">'+formatarValor(data[nI].IMB_LCF_VALOR)+'</div></td>'+
                        '   <td class="cor-itenscalculado-center">'+cobs+'</td>'+
                        '</tr>';
                    }


                    if( full.valorjapago != 0 )
                    {
                        $("#btnbx"+full.id).hide();
                        japago = 1;
                        tableitemcalculado = tableitemcalculado +
                        '<tr>'+
                        '   <td width="100%"><div class="div-center"><b>****** JÁ PAGO ******</b></div></td>'+
                        '</tr>';
                    }
                    else
                    {
                        tableitemcalculado = tableitemcalculado +
                        '<tr class="cor-itenscalculado">'+
                        '   <td class="cor-itenscalculado-center"><b>Total Calculado</b></td>'+
                        '   <td class="cor-itenscalculado"><div class="td-direita"><b>'+formatarValor(totalcalculadoapagar)+'</b></div></td>'+
                        '   <td class="cor-itenscalculado-center"></td>'+
                        '</tr>';
                    }
                    tableitemcalculado = tableitemcalculado + '</table>'
                    totalitenscalculado = totalcalculadoapagar;

                }
            });


            totalitenscalculado = totalitenscalculado.toFixed(2);
            diferenca = parseFloat(totalitenscalculado) - parseFloat( full.valorpago )          ;
            console.log( 'full.valorpago '+full.valorpago);
            console.log( 'totalitenscalculado '+totalitenscalculado);
            console.log( 'totalitensboleto '+totalitensboleto);

 
        

        texto = 
            '<div class="row">.</div>'+
            '<div class="row" id="titulo'+full.id+' onclick="return TABLE1_onclick()">'+
            '   <div class="col-md-12">'+
            '(<b>'+full.imb_ctr_referencia+')'+full.locatario+'</b> - Imóvel: <b>('+full.imb_imv_id+')'+full.endereco+
            '</b> Vcto: '+moment(full.IMB_CGR_VENCIMENTOORIGINAL).format('DD/MM/YYYY')+
            ' Pagto: <b>'+moment(full.datapagamento).format('DD/MM/YYYY')+
            '</b> $ Pago: <b>'+formatarValor(full.valorpago)+
            ' </b>  </div>'+
            '</div>';

            texto = texto +
            '<div class="row">'+
            '   <div class="col-md-12">'+
            '       <div class="col-md-5 div-center cor-itensboleto">'+tableitem+
        
            '       </div>'+
            '       <div class="col-md-6 div-center tbcalculado" >'+tableitemcalculado+
            '       </div>';

             
            console.log('full.selecionado '+full.selecionado);
            console.log( 'pagocomdiferenca '+pagocomdiferenca);
            console.log(' japago '+japago );

            diferenca = diferenca.toFixed(2);
            diferenca = Math.abs(diferenca);
            console.log('Diferenca ---->'+diferenca);
            if( full.selecionado == 'S' && pagocomdiferenca == 0 && japago == 0 &&  ( diferenca >= 0 && diferenca <= .03))
                texto = texto +
                    '       <div class="col-md-1 div-center">'+
                    '           <a id="btnbx'+full.id+'" class="btn btn-success form-control" href="javascript:baixarTitulo( '+full.id+
                            ', \''+moment(full.datapagamento).format('YYYY-MM-DD')+'\', '+
                            ' \''+moment(full.IMB_CGR_VENCIMENTOORIGINAL).format('YYYY-MM-DD')+'\', '+
                            ' \''+moment(full.datapagamento).format('YYYY-MM-DD')+'\', '+
                            full.FIN_CCX_ID+','+full.valorpago+','+full.IMB_CTR_ID+')" '+
                                '>Baixar</a>'+
                    '       </div>'
            else
            {
                if( diferenca != 0 )
                {
                   texto = texto +
                            '       <label><b>C/ Diferença</b></label>';
                    pagocomdiferenca = 1;
                }

            }

            texto = texto +
            '   </div>'+
            '</div>';

            texto = texto +

            '<div class="row"><hr></div>';


        return texto;
    }

    function impressaoCheques()
    {
        $("#i-limpar").val('i');

        var url = "{{route('recibolocador.planilhadepositosgerar')}}?limpar=I";

        window.open( url, "_blank");
        

    }

    function baixarTitulo( id, datpag, datven, datcre, conta, valpago, idcontrato )
    {
       
        var url = "{{route('cobrancabancaria.baixatitulo')}}/"+id+'/'+datpag+'/'+datven+'/'+datcre+'/'+conta+'/'+valpago;

        $.ajaxSetup(
        {
            headers:
            {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });

        $.ajax(
        {
            url:url,
            dataType:'json',
            type:'post',
            async:false,
            complete:function(data)
            {

                if (confirm("Baixado! Deseja imprimir o recibo?") == true) 
                {
                    window.open("{{route('recibolocatario.imprimir')}}/"+data+'/S ', '_blank');
                }

                var repassar = "{{$repassar}}";
                if( repassar == 'S' )
                {
                    if( confirm( "Quer aproveitar e fazer o repasse?") ==true )
                    repassarnaBA( idcontrato );
                }

                $("#btnbx"+id).hide();
                $("#titulo"+id).hide();
            }
        });




    }

    function baixaAutomatica()
    {

        if( confirm( 'Atençao! Esta baixa será realizada e os recibos não serão impressos. Esta é uma operação de baixa automatica! '+
                    'Caso necessite realizar as baixas e imprimir os recibos (locatário e repasse) em cada baixa, por favor clicar em "BAIXAR" em cada registro!') != true )
        return false;
        
        $("#btn-baixar").hide();

        var url = "{{route('cobrancabancaria.baixaautomatica')}}";

        $.ajaxSetup(
        {
        headers:
        {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
        }
        });

        $.ajax(
        {
            url:url,
            dataType:'json',
            type:'get',
            success:function( data )
            {
                alert(
                    'Baixa Automática Realizada! Os registros que precisavam ser baixados, '+
                    'foram baixados. Faça a leitura do arquivo novamente para ver se algum registro '+
                    'nao foi baixado automaticamente!'
                );

                window.close();//cargaTmpRetornoold();
               
            }
        });
    }


    function imprimir()
    {
        $(".tbcalculado").hide();
        window.print();
//        $(".tbcalculado").show();
    }

    function repassarnaBA( id )
        {

            $("#i-idcontrato-repassar").val( id );
            $("#form-repassar-baixaautomatica").submit();
        }


</script>
@endpush


