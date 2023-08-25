@extends("layout.app")
@section('scripttop')

<meta http-equiv=\"content-type\" content=\"application/vnd.ms-excel; charset=UTF-8\">
<link href="{{asset('/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

<style>

.cinza
{
    color:red;
}
.Inativo
{
    text-decoration: line-through;
}
.Rejeitado
{
    color:red;
}
.Liberado
{
    color:Blue;
}
.Aguardando-Retorno
{
    color:Black;
}
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
<script src="{{asset('/global/plugins/sweetalert/sweetalert2.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('/global/plugins/sweetalert/sweetalert2.min.css')}}">

@endsection
@section('content')

<div class="page-bar">
    <div class="col-md-12">
        <div class="col-md-3">
            <input type="hidden" id="FIN_CCI_BANCONUMERO">
            <label class="label-control" for="FIN_CCX_ID">Conta de Cobrança</label>
                <select class="form-control" id="FIN_CCX_ID">
                </select>
            
        </div>
        <div class="col-md-2">
            <label class="label-control" for="i-data-inicio">Data Inicial</label>
            <input class="form-control" type="date" id="i-data-inicio">
            
        </div>
        <div class="col-md-2">
            <label class="label-control" for="i-data-fim">Data Final</label>
                <input class="form-control" type="date" id="i-data-fim">
            
        </div>
        <div class="col-md-2 div-center">
            <div class="row">
                <input type="checkbox" class="form-control" id="i-inativos">Exibir Boletos Cancelados
            </div>
        </div>
        <div class="col-md-2 div-center">
            <div class="row">
                <input type="checkbox" class="form-control" id="i-baixados">Exibir Quitados/Baixados

            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-4">
            <label> Locatário</label>
            <select  class="select2" id="i-locatario">
            </select>
        </div>
        <div class="col-md-2 ">
                <label >&nbsp;</label>
                <button class="btn btn-primary form-control" onClick="cargaCarteira('')">Carregar Informações</button>
        </div>
        <div class="col-md-2 ">
        <label >&nbsp;</label>
            <button class="btn-dark form-control" title="Selecionar todos" onClick="cargaCarteira('S')">
                Selecionar todos
            </button> 
        </div>
        <div class="col-md-2">
            <label >&nbsp;</label>
            <button class="btn-dark form-control" title="Selecionar todos" onClick="cargaCarteira('N')">
                Limpar Seleções
            </button> 
        </div>
    
        <div class="col-md-2 escondido">
            <label class="control-label">Pasta
                <input class="form-control" type="text" id="i-pasta">
            </label>
        </div>
        <div class="col-md-2 ">
            <label >&nbsp;</label>
            <button class="btn btn-danger form-control" onClick="limparFiltros()">Limpar Filtros</button>
        </div>

    </div>

</div>
<div class="page-bar">
    <div class="col-md-12">
        <div class="col-md-1 div-center">
            <a href="javascript:gerarVariosBoletos();" title="Impressão dos Boletos Selecionados"><img src="{{asset('/global/img/boleto-50.png')}}" alt=""></a>
        </div>
        <div class="col-md-1 div-center">
            <a href="javascript:enviarVariosBoletos()" title="Enviar por email aos selecionados"><img src="{{asset('/global/img/boleto-email-50.png')}}" alt=""></a>
        </div>
        <div class="col-md-1 div-center">
            <a href="javascript:gerarPDF()" title="Imprimir um Relatório com as Informações"><img src="{{asset('/global/img/printer-50.png')}}" alt=""></a>
        </div>
        <div class="col-md-1 div-center">
            <a href="javascript:gerarRemessa();" title="Gerar Arquivo Bancário"><img src="{{asset('/global/img/save-50.png')}}" alt=""></a>
        </div>
        <div class="col-md-1 div-center">
            <a href="javascript:exportTableToExcel('resultTable', 'boleto_da_carteira')" title="Exportar para o Excel"><img src="{{asset('/global/img/excel-50.png')}}" alt=""></a>
        </div>
    </div>

</div>

<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Cobrança Carteira
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
        </div>
    </div>

    <div class="portlet-body form">
        <div class="row" id="i-div-resultado">
            <div class="col-md-12">
                <table class="table table-bordered table-striped" id="resultTable">
                    <thead>
                        <th></th>
                        <th></th>
                        <th >Pasta</th>
                        <th>Imovel</th>
                        <th>Endereco</th>
                        <th>Locatario/Destinatario</th>
                        <th>Vencimento</th>
                        <th>Limite</th>
                        <th>Valor</th>
                        <th>Status</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>

</div>

<div class="modal" tabindex="-1" role="dialog" id="modalitens">
  <div class="modal-dialog "style="width:80%;" >
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="div-center" id="i-titulo"></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered" id="tblitem">
                    <thead>
                        <th>#ID</th>
                        <th>Evento</th>
                        <th>C/D</th>
                        <th>Valor</th>
                        <th>Observaçao</th>
                    </thead>
                </table>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">sair</button>
      </div>
    </div>
  </div>
</div>

@include( 'layout.modaldownloadremessa')


@endsection

@push('script')

<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/funcoes-recibolocatario.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/jquery.btechco.excelexport.js')}}"></script>
<script src="{{asset('/js/jquery.base64.js')}}"></script>
<script src="{{asset('/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>


<script>

$( document ).ready(function()
{

    limparFiltros();
    //cargaCarteira();
    $("#sirius-menu").click();
    $("#FIN_CCX_ID").change( function()
    {
        var url = "{{ route('contacaixa.find') }}/"+$("#FIN_CCX_ID").val();
        console.log( url );
        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                success:function( data )
                {
                    $("#FIN_CCI_BANCONUMERO").val( data.FIN_CCI_BANCONUMERO );
                }

            }
        )


    })


    $(".select2").select2({
            placeholder: 'Selecione',
            width: null
        });

});

function gerarExcel()
{
    $("#resultTable").btechco_excelexport(
        {
            containerid: "resultTable"
            , datatype: $datatype.Table
            , filename: 'Boletos'
        });

}

function cargaCarteira( selecionar)
{
    debugger;

    if( $("#FIN_CCX_ID").val() == '-1' )
    {
        alert('Informe a conta bancária');
        return false;
    }

    if( $("#i-data-inicio").val() == '' )
    {
        alert('Informe a data inicio');
        return false;
    }


    if( $("#i-data-fim").val() == '' )
    {
        alert('Informe a data fim');
        return false;
    }

    debugger;
    dados =
    {
        FIN_CCX_ID : $("#FIN_CCX_ID").val(),
        datainicio: $("#i-data-inicio").val(),
        datafim: $("#i-data-fim").val(),
        inativados: $("#i-inativos").prop('checked') ? 'S' : 'N',
        baixados: $("#i-baixados").prop('checked') ? 'S' : 'N',
        contrato: $("#i-locatario").val(),
        pasta: $("#i-pasta").val(),
        selecionar:selecionar,


    }

    var url = "{{route('cobrancabancaria.cargacarteira')}}";

    $.ajax(
    {
        url         : url,
        dataType    : 'json',
        type        : 'get',
        data        :dados ,
        async       :false,
        success:function( data )
        {
            linha = "";
                $("#resultTable>tbody").empty();
                for( nI=0;nI < data.length;nI++)
                {
                    valor = parseFloat( data[nI].IMB_CGR_VALOR);
                    valor = formatarBRSemSimbolo( valor );
                    inconsist = data[nI].IMB_CGR_INCONSISTENCIA;
                    inconsist = inconsist.substr(0,10)+'...';


                    var selecionado = data[nI].Selecao;

                    if( selecionado != null )
                        selecionado = '<div><i class="far fa-check-circle"></i></div>'
                    else
                        selecionado = '<div></div>';

                    var status = data[nI].IMB_CGR_ENTRADACONFIRMADA;

                    var somenteemail = '';
                    if( data[nI].IMB_CTR_BOLETOVIAEMAIL =='S' )
                        somenteemail = '<b><br>**(somente por email)**</b>';


                    if( status == '' )
                        status = 'Aguardando-Retorno'
                    else
                    if( status == 'S' )
                        status = 'Liberado'
                    else
                    if( status == 'N' )
                        status = 'Rejeitado';

                    if( data[nI].IMB_CGR_DTHINATIVO )
                        status ="Inativo";

                    var pasta = data[nI].IMB_CTR_REFERENCIA;
                    if( pasta === null ) pasta='-';

                    linha =
                            '<tr class="'+status+'">';


                    linha = linha + '<td> '+selecionado+'</td>';

                    linha = linha +
                        '<td width="200px">'+
                        '<a href=javascript:visualizarItensBoleto('+data[nI].IMB_CGR_ID+') class="btn btn-sm btn-primary"><i class="fas fa-search"></i></a> ';

                    if( data[nI].Selecao == null )
                        linha = linha +
                            '<a href="javascript:selecionarBoleto('+data[nI].IMB_CGR_ID+',1,'+"'"+data[nI].IMB_CGR_ENTRADACONFIRMADA+"'"+')" class="btn btn-sm btn-success"><i class="fas fa-check"></i></a> '
                    else
                        linha = linha +
                                '<a href="javascript:selecionarBoleto('+data[nI].IMB_CGR_ID+',1,'+"'"+data[nI].IMB_CGR_ENTRADACONFIRMADA+"'"+')" class="btn btn-sm btn-danger"><i class="fas fa-lock"></i></a> ';

                    if( data[nI].IMB_CGR_ENTRADACONFIRMADA == 'S' )
                        linha = linha +
                            '<a href="javascript:boletoUnico('+data[nI].IMB_CGR_ID+','+
                            data[nI].FIN_CCI_BANCONUMERO+','+"'"+data[nI].IMB_CGR_ENTRADACONFIRMADA+"'"+')" class="btn btn-sm btn-dark" title="Imprimir Este Boleto"><i class="fas fa-barcode"></i></a> ';

                    linha = linha +
                        '<a href="javascript:inativarBoleto('+data[nI].IMB_CGR_ID+')" class="btn btn-sm btn-danger" title="Inativar Boleto"><i class="fas fa-trash"></i></a> ';

                    linha = linha +
                        '</td> '+
                        '<td>'+pasta+'</td>' +
                        '<td>'+data[nI].IMB_IMV_ID+'</td>' +
                        '<td>'+data[nI].IMB_CGR_ENDERECO+'</td>' +
                        '<td>'+data[nI].IMB_CGR_DESTINATARIO+somenteemail+'</td>' +
                        '<td>'+
                            moment( data[nI].IMB_CGR_DATAVENCIMENTO).format('DD/MM/YYYY')+'</td>' +
                        '<td>'+
                            moment(data[nI].IMB_CGR_DATALIMITE).format('DD/MM/YYYY')+'</td>' +
                        '<td class="div-right">'+valor+'</td>';

                    if( status == 'Liberado')
                        linha = linha +
                            '<td class="liberado" title="'+status+'">'+status+'</td>'
                    else
                    if( status == 'Rejeitado')
                        linha = linha +
                            '<td class="rejeitado" title="'+status+'">'+status+'</td>'
                    else
                        linha = linha +
                            '<td  title="'+status+'">'+status+'</td>';

                    linha = linha +
                        '</tr>';

                    $("#resultTable").append( linha );
                };


        },
        erro:function()
        {
            alert('erro');
        }
    });



}

function visualizarItensBoleto( id )
{
    var url = "{{route('cobrancabancaria.cargaboletoheaderperm')}}/"+id;
    $.ajax(
        {
            url     : url,
            dataType:'json',
            type:'get',
            success:function( data )
            {
                valor = parseFloat( data.IMB_CGR_VALOR);
                    valor = formatarBRSemSimbolo( valor );

                $("#i-titulo").html('Pasta: '+data.IMB_CTR_REFERENCIA
                    +'('+data.IMB_CGR_DESTINATARIO+')<br>Valor: '+valor);
            }
        }
    )


    url = "{{route('cobrancabancaria.cargaitensperm')}}/"+id;

    $.ajax(
        {
            url             : url,
            dataType        : 'json',
            type            : 'get',
            success          : function( data )
            {
                linha = "";
                $("#tblitem>tbody").empty();
                for( nI=0;nI < data.length;nI++)
                {
                    valor = parseFloat( data[nI].IMB_LCF_VALOR);
                    valor = formatarBRSemSimbolo( valor );

                    linha =
                        '<tr>'+
                        '<td>'+data[nI].IMB_TBE_ID+'</td>' +
                        '<td>'+data[nI].IMB_TBE_NOME+'</td>' +
                        '<td>'+data[nI].IMB_RLT_LOCATARIOCREDEB+'</td>' +
                        '<td class="div-right">R$ '+valor+'</td>' +
                        '<td>'+data[nI].IMB_LCF_OBSERVACAO+'</td>' ;
                    linha = linha +
                        '</tr>';

                    $("#tblitem").append( linha );
                }
                $("#modalitens").modal('show');

            }


        }
    )
}

function bloquearBoleto( id, refresh )
{

    var url = "{{route('cobrancabancaria.bloquearboleto')}}/"+id+'/N';

    $.ajax(
        {
            url         : url,
            dataType    : 'json',
            type        : 'get',
            success     : function( data )
            {
                cargaGeradas();
            }
        }
    );
}
function selecionarBoleto( id, refresh, status )
{
    if( status == 'N')
    {
        alert('Boleto Não liberado');
        return false;
    }

    var url = "{{route('cobrancabancaria.carteira.selecionarcobrancaperm')}}/"+id;

    $.ajax(
        {
            url         : url,
            dataType    : 'json',
            type        : 'get',
            success     : function( data )
            {
                if( refresh == 1 ) cargaCarteira();
            }
        }
    );
}

function gerarPDF()
{
    alert('Essa operação pode levar algum tempo para ser processada!');
    window.open( "{{route('cobranca.pdfcobrancagerada')}}", "_blank");

}

function boletoUnico( id,banco, status )
{

    if( status == 'N')
    {
        alert('Boleto Não liberado');
        return false;
    }
    if( banco == 33 )
        window.open("{{route('boleto.santander')}}/"+id+'/N', '_blank')
        else
    if( banco == 756 )
        window.open("{{route('boleto.756')}}/"+id+'/N', '_blank');
        else
    if( banco == 748 )
        window.open("{{route('boleto.748')}}/"+id+'/N', '_blank');
}

function gerarRemessa()
{
    var url = "{{route('cobranca.remessa')}}";

    var dados = { "PERMANENTETOTEMP" : 'S' };

    console.log( url );

    $.ajax(
        {
            url     : url,
            dataType: 'json',
            type    : 'get',
            data    : dados,
            success : function( data )
            {


                var url = '<a href="'+data+'" download>Click no Link para Baixar</a>';
//                $("#i-filename-title").html( 'Download do Arquivo de remessa: '+data );
                $("#div-download").empty();
                $("#div-download").append(url);
                $("#modaldownload").modal('show');
                $("#i-download").val( data );

                cargaCarteira();

            }

        });

}



    function cargaConta()
{

    console.log('entrando');

    url = "{{ route('contacaixa.carga')}}/S";

    $.ajax(
        {
            url:url,
            dataType:'json',
            type:'get',
            async:false,
            success:function( data )
            {
                linha =  '<option value="-1">Selecione a Conta </option>';
                console.log(linha);
                $("#FIN_CCX_ID").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                  linha =
                '<option value="'+data[nI].FIN_CCX_ID+'">'+
                                data[nI].FIN_CCX_DESCRICAO+"</option>";
                    $("#FIN_CCX_ID").append( linha );
                    console.log(linha );
                }
            },
            complete:function(data)
            {
            },
            error:function()
            {
            }
    });

}

function gerarVariosBoletos()
{

    if( $("#FIN_CCI_BANCONUMERO").val() == 748 )
       window.open("{{route('boleto.748.lote')}}", '_blank');

    if( $("#FIN_CCI_BANCONUMERO").val() == 84 )
        window.open("{{route('boleto.084.lote')}}", '_blank');

    if( $("#FIN_CCI_BANCONUMERO").val() ==1 )
    {
//        alert('vamos lá');
       window.open("{{route('boleto.001.lote')}}", '_blank');
    }
       


}

function enviarVariosBoletos()
{
    
    if (confirm("Esta opção enviará todos os boletos "+
            "RESPEITANDO O PERÍODO INFORMADO. Você pode confirmar e o sistema tratará de enviar os boleto. "+
            "Assim você poderá continuar seu trabalho normalmente enquanto o sistema envia os boletos. "+
            "Posso continuar?") == true) 
    {
        
        
        var dados = 
        {
            datainicio  : moment( $("#i-data-inicio").val()).format( 'YYYY-MM-DD'),
            datafim     : moment( $("#i-data-fim").val()).format( 'YYYY-MM-DD'),
        }

        var url = "{{route('processosautomaticos')}}";

        $.ajax
        (
            {
                url:url,
                dataType:'json',
                type:'get',
                data:dados,
                success:function()
                {
                    alert('Os boletos enviados por email para o periodo, foram enviados!');
                }
            }
        )

    }
    
    

}

function inativarBoleto( id )
{
    var url = "{{route('cobrancabancaria.inativar')}}/"+id;


    $.ajax(
    {
        url : url,
        dataType:'json',
        type:'get',
        success:function( data )
        {
            alert('Inativado');
            cargaCarteira();
        }


    });

}

function cargaLocatarios()
{

    $.getJSON( "{{ route('locatarios.carga')}}", function( data )
    {
        $("#i-locatario").empty();
        linha ='<option value="">Selecione o Locatário</option>';
        $("#i-locatario").append( linha );
        for( nI=0;nI < data.length;nI++)
        {
            linha =
                '<option value="'+data[nI].IMB_CTR_ID+'">'+
                    data[nI].IMB_CLT_NOME+'('+
                    data[nI].IMB_CTR_SITUACAO+')'+
                    "</option>";
            $("#i-locatario").append( linha );
        }
    });
}

function limparFiltros()
{
    cargaLocatarios();
    cargaConta();
    $("#i-data-inicio").val(moment().format('YYYY-MM-DD'));
    $("#i-data-fim").val(moment().format('YYYY-MM-DD'));
    $("#i-inativos").prop( 'checked',false );
    $("#i-baixados").prop( 'checked',false );
    $("#i-pasta").val('');
}

function selecionarTodos()
{

    var url = "{{ route('cobranca.selecionartodas') }}";

    $.ajax(
        {
            url:url,
            dataTpe:'json',
            type:'get',
            async:false,
            success:function()
            {
                cargaCarteira();
            }
        }
    )


}
function tirarSelecones()
{

    var url = "{{ route('cobranca.tirarselecoes') }}";

    $.ajax(
        {
            url:url,
            dataTpe:'json',
            type:'get',
            async:false,
            success:function()
            {
                alert('Seleções canceladas!')
                cargaCarteira();

            }
        }
    )


}

function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}

</script>

@endpush
