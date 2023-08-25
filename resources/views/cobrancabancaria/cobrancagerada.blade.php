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

<div class="modal fade" id="alteracaovencimento-temp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:95%;">
    <div class="modal-content">
      <div class="modal-body">
        <div class="portlet box red">
          <div class="portlet-title">
            <input type="hidden" id="IMB_CGR_ID-REPR">
            <input type="hidden" id="IMB_CTR_ID-REPR">
            <input type="hidden" id="FIN_CCR_ID-REPR">
            <input type="hidden" id="basemulta">
            <input type="hidden" id="basejuros">
            <input type="hidden" id="i-ordem" value = "IMB_CTR_REFERENCIA">
            <div class="caption">
              <i class="fa fa-gift"></i>Reprogramação do Boleto
            </div>
          </div>

          <div class="portlet-body form">
            <div class="row">
              <div class="col-md-12">
                <div class="col-md-3">
                    <label class="control-label">Vencimento Original
                      <input class="form-control" type="date" id="REP-IMB_CGR_DATAVENCIMENTO" readonly>
                    </label>
                </div>
                <div class="col-md-3">
                    <label class="control-label">Valor Original
                      <input class="form-control" type="text" id="IMB_CGR_VALOR" readonly>
                    </label>
                </div>
                <div class="col-md-6">
                    <label class="control-label">Imóvel</label>
                      <input class="form-control" type="text" id="IMB_CGR_IMOVEL" readonly>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-12">
                <div class="col-md-2">
                    <label class="control-label">Novo Vencimento
                      <input class="form-control" type="date" id="i-novovencimento" >
                    </label>
                </div>
                <div class="col-md-2">
                    <label class="control-label">R$ Multa
                      <input title="Multa a Repassar" class="form-control valor encargos"
                        type="text" id="i-multarep" >
                    </label>
                </div>
                <div class="col-md-2">
                    <label class="control-label">R$ Multa II
                      <input title="Multa a Reter"  class="form-control valor encargos"
                        type="text" id="i-multaret" >
                    </label>
                </div>
                <div class="col-md-2">
                    <label class="control-label">R$ Juros
                      <input title="Juros a Repassar" class="form-control encargos"
                      type="text" id="i-jurosrep" >
                    </label>
                </div>
                <div class="col-md-2">
                    <label class="control-label">R$ Juros II
                      <input title="Juros a Reter"class="form-control encargos"
                      type="text" id="i-jurosret" >
                    </label>
                </div>
                <div class="col-md-2">
                    <label class="control-label">Total R$
                      <input class="form-control " type="text" id="i-total" >
                    </label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="col-md-8">.</div>
                <div class="col-md-2"><button class="btn form-control btn-primary" onClick="reprogramar()">Confirmar</button></div>
                <div class="col-md-2"><button class="btn form-control btn-danger" data-dismiss="modal">Cancelar</button></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="page-bar">
  <div class="col-md-12">
    <div class="col-md-1 div-center">
      <a href="#" title="Enviar por email aos selecionados"><img src="{{asset('/global/img/boleto-email-50.png')}}" alt=""></a>
    </div>
    <div class="col-md-1 div-center">
      <a href="javascript:relatorioConferencia()" title="Imprimir um Relatório com as Informações"><img src="{{asset('/global/img/printer-50.png')}}" alt=""></a>
    </div>
    <div class="col-md-1 div-center">
      <a href="javascript:gerarRemessa();" title="Gerar Arquivo Bancário"><img src="{{asset('/global/img/save-50.png')}}" alt=""></a>
    </div>
    <div class="col-md-1 div-center">
      <a href="javascript:exportTableToExcel('resultTable', 'cobrancas_geradas')"; title="Exportar para o Excel"><img src="{{asset('/global/img/excel-50.png')}}" alt=""></a>
    </div>
  </div>
</div>

<a href=""></a>
<div class="portlet box blue">
  <div class="portlet-title">
    <div class="caption">
      <i class="fa fa-gift"></i>Cobrança Gerada
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
            <th ><a href="javascript:ordem('IMB_CTR_REFERENCIA')">Pasta</a> </th>
            <th ><a href="javascript:ordem('IMB_IMV_ID')">Imóvel</a> </th>
            <th ><a href="javascript:ordem('IMB_CGR_ENDERECO')">Endereço</a> </th>
            <th ><a href="javascript:ordem('IMB_CGR_DESTINATARIO')">Locatário/Destinatário</a> </th>
            <th ><a href="javascript:ordem('IMB_CGR_DATAVENCIMENTO')">Vencimento</a> </th>
            <th>Limite</th>
            <th>Valor</th>
            <th></th>
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
<form style="display: none" action="{{route('contrato.edit')}}" method="POST" id="form-alterarcontrato"target="_blank">
@csrf
    <input type="hidden" id="i-idcontrato-alt" name="IMB_CTR_ID" />
</form>


@include('layout.modaldownload')
@include('layout.modalreajustar')

@endsection

@push('script')

<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/funcoes-recibolocatario.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/jquery.btechco.excelexport.js')}}"></script>
<script src="{{asset('/js/jquery.base64.js')}}"></script>

<script>

$( document ).ready(function()
{
  ordem( 'IMB_CTR_REFERENCIA');
    $("#sirius-menu").click();
    $('#i-novovencimento').blur(function()
    {
      basesEncargos();
      calcularMulta();
      calcularTotal()
    });
    $('.encargos').change(function()
    {
      calcularTotal()


    });

    $('.encargos').blur(function()
    {
      calcularTotal()


    });



});

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

function gerarExcel()
{
    $("#resultTable").btechco_excelexport(
        {
            containerid: "resultTable"
            , datatype: $datatype.Table
            , filename: 'Boletos'
        });

}

function cargaGeradas( ordem)
{

    var url = "{{route('cobrancabancaria.cargageradas')}}";

    var dados = { ordem :ordem };
    $.ajax(
    {
        url         : url,
        dataType    : 'json',
        type        : 'get',
        data        : dados,
        success:function( data )
        {
            linha = "";
                $("#resultTable>tbody").empty();
                for( nI=0;nI < data.length;nI++)
                {
                    valor = parseFloat( data[nI].IMB_CGR_VALOR);
                    valor = formatarBRSemSimbolo( valor );
                    inconsist = data[nI].IMB_CGR_INCONSISTENCIA;
//                    inconsist = inconsist.substr(0,10)+'...';
                    pasta = data[nI].IMB_CTR_REFERENCIA;
                    if( pasta === null) pasta='';


                    if( data[nI].IMB_CGR_SELECIONADA == 'N' )
                        linha = '<tr class="naoselecionada">'
                    else
                        linha =
                            '<tr>';

                    linha = linha + '<td> ';

                    if( data[nI].IMB_CGR_INCONSISTENCIA != '')
                        linha = linha +
                            '<a href="javascript:verMensagem('+data[nI].IMB_CGR_ID+', '+data[nI].IMB_CTR_ID+', \''+ data[nI].IMB_CGR_INCONSISTENCIA+'\')" class="btn btn-sm btn-warning" title="'+
                                        data[nI].IMB_CGR_INCONSISTENCIA+'"><i class="fas fa-exclamation-triangle"></i></a> ';
                    linha = linha + '</td>';

                    linha = linha +
                        '<td width="200px">'+
                        '<a  class="btn btn-sm btn-success" href=javascript:alterarBoleto('+data[nI].IMB_CGR_ID+','+
                            data[nI].FIN_CCI_BANCONUMERO+',"S") title="Alterar Vencimento"><i class="fa fa-pencil" aria-hidden="true"></i></a>'+
                        '<a href=javascript:visualizarItensBoleto('+data[nI].IMB_CGR_ID+') class="btn btn-sm btn-primary"><i class="fas fa-search"></i></a> '+
                        '<a href=javascript:selecionarBoleto('+data[nI].IMB_CGR_ID+') class="btn btn-sm btn-success"><i class="fas fa-check"></i></a> '+
                        '<a href=javascript:bloquearBoleto('+data[nI].IMB_CGR_ID+') class="btn btn-sm btn-danger"><i class="fas fa-lock"></i></a> ';


                    linha = linha +
                        '</td> '+
                        '<td><a href="javascript:alterarContrato('+data[nI].IMB_CTR_ID+')">'+data[nI].IMB_CTR_REFERENCIA+'</a></td>' +
                        '<td>'+data[nI].IMB_IMV_ID+'</td>' +
                        '<td><a href="javascript:alterarContrato('+data[nI].IMB_CTR_ID+')">'+data[nI].IMB_CGR_ENDERECO+'</a></td>' +
                        '<td>'+data[nI].IMB_CGR_DESTINATARIO+'</td>' +
                        '<td>'+
                            moment( data[nI].IMB_CGR_DATAVENCIMENTO).format('DD/MM/YYYY')+'</td>' +
                        '<td>'+
                            moment(data[nI].IMB_CGR_DATALIMITE).format('DD/MM/YYYY')+'</td>' +
                        '<td class="div-right">'+valor+'</td>' +
                        '<td title="'+data[nI].IMB_CGR_INCONSISTENCIA+'">'+inconsist+'</td>' ;
                    linha = linha +
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

function visualizarItensBoleto( id )
{
    var url = "{{route('cobrancabancaria.cargaboletoheader')}}/"+id;
    $.ajax(
        {
            url     : url,
            dataType:'json',
            type:'get',
            success:function( data )
            {
                $("#i-titulo").html('Pasta: '+data.IMB_CTR_REFERENCIA
                    +'('+data.IMB_CGR_DESTINATARIO+')');
            }
        }
    )


    url = "{{route('cobrancabancaria.cargaitens')}}/"+id;

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
                    obs  = data[nI].IMB_LCF_OBSERVACAO;
                    if( obs == null ) obs = '';

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

function bloquearBoleto( id )
{

    var url = "{{route('cobrancabancaria.bloquearboleto')}}/"+id+'/N';

    $.ajax(
        {
            url         : url,
            dataType    : 'json',
            type        : 'get',
            success     : function( data )
            {
                cargaGeradas($("#i-ordem").val() );
            }
        }
    );
}
function selecionarBoleto( id )
{

    var url = "{{route('cobrancabancaria.bloquearboleto')}}/"+id+'/S';

    $.ajax(
        {
            url         : url,
            dataType    : 'json',
            type        : 'get',
            success     : function( data )
            {
              cargaGeradas($("#i-ordem").val() );
            }
        }
    );
}

function gerarPDF()
{
    alert('Essa operação pode levar algum tempo para ser processada!');
    var url =  "{{route('cobranca.pdfcobrancagerada')}}/"+$("#i-ordem").val();
    console.log( url );
    window.open( url, "_blank");

}

function boletoUnico( id )
{
    var url = "{{route('cobranca.gerarpermanente')}}";

    dados =
    {
        IMB_CGR_ID : id,
        operacao    : 'imprimir',
    }

    $.ajax(
        {
            url     : url,
            dataType: 'json',
            type    : 'get',
            data   : dados,
            success : function( data )
            {
                window.open("{{route('boleto.santander')}}/"+data+'/N', '_blank');

            }

        });

}

function gerarRemessa()
{
    if( confirm( 'Confirma a GERAÇÃO DO ARQUIVO REMESSA?') == true )
    {

      var url = "{{route('cobranca.remessa')}}";

      var dados = { "PERMANENTETOTEMP" : 'N' };

      $.ajax(
          {
              url     : url,
              dataType: 'json',
              type    : 'get',
              data    : dados,
              success : function( data )
              {


                  $("#i-div-resultado").hide();

                  var url = '<a href="'+data+'" download>Click no Link para Baixar</a>';
  //                $("#i-filename-title").html( 'Download do Arquivo de remessa: '+data );
                  $("#div-download").empty();
                  $("#div-download").append(url);
                  $("#modaldownload").modal('show');
                  $("#i-download").val( data );

              }

          });

        }

}


function alterarBoleto( id )
{
  var url = "{{route('cobrancabancaria.cargaboletoheader')}}/"+id;
  $("#IMB_CGR_ID-REPR").val( id );

  $.ajax(
    { url : url,
      dataType: 'json',
      type:'get',
      success:function( data )
      {
        $("#REP-IMB_CGR_DATAVENCIMENTO").val(  data.IMB_CGR_VENCIMENTOORIGINAL );
        $("#IMB_CGR_VALOR").val( formatarBRSemSimbolo( parseFloat( data.IMB_CGR_VALOR )));
        $("#IMB_CGR_IMOVEL").val( data.IMB_CGR_IMOVEL );
        $("#IMB_CTR_ID-REPR").val( data.IMB_CTR_ID );
        $("#i-novovencimento").val( moment( Date() ).format( 'YYYY-MM-DD') );
        $("#i-multarep").val(0);
        $("#i-multaret").val(0);
        $("#i-jurosrep").val(0);
        $("#i-jurosret").val(0);
        $('#alteracaovencimento-temp').modal('show');

      }

    }
  )

}

function calcularMulta()
{
  var basemulta = $("#basemulta").val();
  var contrato = $("#IMB_CTR_ID-REPR").val();
  var vencimento = moment( $("#REP-IMB_CGR_DATAVENCIMENTO").val()).format( 'YYYY-MM-DD');
  var pagamento = moment( $("#i-novovencimento").val()).format( 'YYYY-MM-DD');
  var url = "{{route('calcularmultaatraso')}}/"+
            contrato+"/"+
            vencimento+"/"+
            pagamento+"/"+
            basemulta;

  $.ajax(
    {
      url:url,
      dataType:'json',
      type:'get',
      async:false,
      success:function( data )
      {
        var valor = parseFloat(data.repassarvalor);
        valor = valor.toFixed(2);
        valor = dolarToReal( valor );

        var valoradd = parseFloat(data.retervalor);
        valoradd = valoradd.toFixed(2);
        valoradd = dolarToReal( valoradd );



        $("#i-multarep").val( valor );
        $("#i-multaret").val( valoradd );


      },
      complete:function( data )
      {
      }
  })

  var basejuros = $("#basejuros").val();
    var contrato = $("#IMB_CTR_ID-REPR").val();
    var vencimento = moment( $("#REP-IMB_CGR_DATAVENCIMENTO").val()).format( 'YYYY-MM-DD');
    var pagamento = moment( $("#i-novovencimento").val()).format( 'YYYY-MM-DD');
    var url = "{{route('calcularjurosatraso')}}/"+
              contrato+"/"+
              vencimento+"/"+
              pagamento+"/"+
              basemulta;

  $.ajax(
      {
        url:url,
        dataType:'json',
        type:'get',
        async:false,

        success:function( data )
        {
          var valor = parseFloat(data.repassarvalor);
          valor = valor.toFixed(2);
          valor = dolarToReal( valor );

          var valoradd = parseFloat(data.retervalor);
          valoradd = valoradd.toFixed(2);
          valoradd = dolarToReal( valoradd );

          console.log('Juros');
          console.log( valor )
          console.log( valoradd )
          $("#i-jurosrep").val( valor );
          $("#i-jurosret").val( valoradd );

        },
        complete:function( data )
        {
        }
      }
    )

}


function basesEncargos()
{
  var id = $("#IMB_CGR_ID-REPR").val();
  var url = "{{route('calcularbasesitemcobrancatmp')}}/"+id;
  $.ajax(
    {
      url : url,
      dataType:'json',
      type:'get',
      async:false,
      success:function( data )
      {
        $("#basemulta").val( data.basemulta);
        $("#basejuros").val( data.basejuros);
      }
    }
  )
}

function calcularTotal()
{
      var valororiginal = parseFloat( realToDolar($("#IMB_CGR_VALOR").val()));
      var multaRep = parseFloat( realToDolar($("#i-multarep").val()));
      var multaRet = parseFloat( realToDolar($("#i-multaret").val()));
      var jurosRep = parseFloat( realToDolar($("#i-jurosrep").val()));
      var jurosRet = parseFloat( realToDolar($("#i-jurosret").val()));

      if ( $("#i-multarep").val() =='' ) multaRep=0;
      if ($("#i-multaret").val() =='' ) multaRet=0;
      if ($("#i-jurosrep").val() =='' ) jurosRep=0;
      if ($("#i-jurosret").val() =='' ) jurosRet=0;

      var total = valororiginal + multaRep + multaRet + jurosRep + jurosRet;

      $("#i-total").val( formatarBRSemSimbolo( total ) );

}

function reprogramar()
{

  var url = "{{route('cobranca.reprogramartmp')}}";

  var dados =
  {
    IMB_CGR_ID:$("#IMB_CGR_ID-REPR").val(),
    multarep: realToDolar( $("#i-multarep").val()),
    multaret: realToDolar( $("#i-multaret").val()),
    jurosrep:  realToDolar( $("#i-jurosrep").val()),
    jurosret:  realToDolar( $("#i-jurosret").val()),
    datavencimento: moment( $("#i-novovencimento").val()).format('YYYY/MM/DD'),
    vencimentooriginal: moment( $("#REP-IMB_CGR_DATAVENCIMENTO").val()).format('YYYY/MM/DD'),
    valortotal:  realToDolar($("#i-total").val())
  }

  $.ajaxSetup
  ({

    headers:
    {
      'X-CSRF-TOKEN': "{{csrf_token()}}"
    }
  });

  $.ajax(
    {
      url : url,
      dataType:'json',
      type:'post',
      async:false,
      data:dados,
      success:function()
      {
        cargaGeradas($("#i-ordem").val() );
        $('#alteracaovencimento-temp').modal('hide');


      }
    }
  )



}

function ordem( ordem )
{
  $("#i-ordem").val( ordem );
  console.log( $("#i-ordem").val( ));

  cargaGeradas( ordem );
}

function verMensagem( id, idcontrato, msg )
{
  if( msg.substring(0, 5) == 'Reaju' )
  {
    let text = "Necessitando de reajuste. Deseja realizar o reajuste deste contrato agora pegando como base o indice cadastrado pra ele?";
    if (confirm(text) == true) 
    {
      realizarReajuste( idcontrato );
        
    }
  }
  else
    alert( msg);

}
function realizarReajuste( id )
{

    var url = "{{route('reajustar.realizar')}}";
    $("#i-ctr-id").val( id );


    var dados =
    {
        IMB_CTR_ID : id,
        valordigitado: 0,
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
            dataType:'json',
            type:'post',
            data:dados,
            success:function(data)
            {
                debugger;
                if( data[0].pasta === null )
                    pasta = ''
                else
                    pasta = data[0].pasta+' ';

                console.log( data );
                $("#i-endereco-rajuste").html( pasta+data[0].endereco);
                $("#i-data-reajuste").val( moment(data[0].IMB_CTR_DATAREAJUSTE).format('DD/MM/YYYY'));
                $("#i-valor-atual").val( formatarBRSemSimbolo( parseFloat(data[0].IMB_CTR_VALORALUGUEL ) ) );
                $("#i-indice").val( data[0].nomeindice+'('+data[0].indice+'%)' );
                $("#i-fator-indice").val( data[0].indice );
                $("#i-sugestao").val( formatarBRSemSimbolo( parseFloat(data[0].sugestao )));

                linha = "";
                $("#tblparcelasreajuste>tbody").empty();
                for( nI=0;nI < data[1].length;nI++)
                {
                    linha =
                    '<tr>'+
                        '<td >'+data[1][nI].parcela+'</td>'+
                        '<td >'+moment(data[1][nI].data).format( 'DD/MM/YYYY')+'</td>'+
                        '<td class="div-direia">'+formatarBRSemSimbolo( parseFloat(data[1][nI].valor))+'</td>'+
                        '<td >'+data[1][nI].observacao+'</td>'+
                      '</tr>';
                    $("#tblparcelasreajuste").append( linha );
                }

                $("#modalreajustar").modal('show');

                for( nI=0;nI < data[1].length;nI++)
                {
                    console.log( 'Parcela: '+data[1][nI].parcela
                        +' data '+data[1][nI].data
                        +' valor '+data[1][nI].valor );
                }


            },
            error:function( data )
            {
                alert( 'Índice não encontrado' );
            }
        }
    );

}

function alterarContrato( id )
{ 
  $("#i-valordigitado").val(0);
  $("#i-idcontrato-alt").val( id );
  $("#form-alterarcontrato").submit();
}

function refazerParcelas()
{
    var digitado =  $("#i-sugestao").val() ;
    digitado = digitado.replace( 'R$ ','');
    digitado = realToDolar( digitado );
    $("#i-valordigitado").val( digitado);
    realizarReajuste( $("#i-ctr-id").val() );
}

function relatorioConferencia()
{
    window.open( "{{route('cobranca.relatorioconferencia')}}",'_blank');
}


</script>

@endpush
