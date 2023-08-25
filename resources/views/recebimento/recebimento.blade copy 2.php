@extends('layout.app')
@section('scripttop')
<style>
.dashed{
    text-decoration: overline underline line-through;
    color:#999;
}
.td-rigth
  {
    text-align:right;
  }

.td-center
  {
    text-align:center;
  }

.total-selecionado 
{
  background-color:#b3d9ff;
  color:#003366;
  font-weight: bold;
  text-align:center;
}


.cardtitulo {
  text-align: left;
  font-size: 16px;
  color: #4682B4; 
  font-weight: bold;

}
.cardtitulo-20 {
  text-align: left;
  font-size: 20px;
  color: #4682B4; 
  font-weight: bold;

}

.escondido
{
  display:none;
}

</style>

@endsection

@section('content')
<div class="portlet box blue">
  <div class="portlet-title">
    <div class="caption" id="i-lbl-header-imovel" >
    </div>
  </div>
  <input type="hidden" id="i-chave">
  <input type="hidden" id="IMB_CTR_ID" value = "{{$id}}">
  <input type="hidden" id="IMB_IMV_ID">
  <div class="portlet-body form">

    <div class="row">
      <div class="col-md-12">
        <br>
        <div class="row">
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-12">
                <label class="label-control">Locatário</label>
                <input type="text" class="form-control cardtitulo" id="i-locatario" readonly>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <label class="label-control">Locador</label>
                <input type="text" class="form-control cardtitulo" id="i-locador" readonly>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-5">
                <label class="label-control">Data Vencimento</label>
                <input type="date" class="form-control cardtitulo" id="i-data-vencimento-rec" readonly>
              </div>
              <div class="col-md-2">
                <label class="label-control">Tolerancia</label>
                <input type="text" class="form-control cardtitulo" id="i-tolerancia" readonly>
              </div>
              <div class="col-md-5">
                <label class="label-control">Data Limite</label>
                <input type="date" class="form-control cardtitulo" id="i-data-limite" readonly>
              </div>
            </div>
            <div class="row">
              <div class="col-md-5">
                <label class="label-control">Data de Recebimento</label>
                <input type="date" class="form-control cardtitulo-20" id="i-data-rec">
              </div>
              <div class="col-md-4">
                <br>
                <button class="btn btn-success" type="button" onClick="resumoParcela()">Calcular</button>
              </div>
              <div class="col-md-3">
                <br>
                <button class="btn btn-danger" type="button">Cancelar</button>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include( 'layout.resumoparcela')

@endsection      

@push('script')

<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/funcoes-recibolocatario.js')}}" type="text/javascript"></script>


<script>
  
  aDeletados = [];
  aDeletados.push();    
  nTotalaReceber = 0;
  nBaseIRRF = 0;
  nBaseMulta = 0;
  nBaseJuros = 0;
  nBaseTaxaAdm = 0;
  nBaseCorrecao=0;
  nIdLf = 0;
  nIdTbe = 0;
  nIdLf = 0;
  nIdTbe = 0;
  nIRRFLancado = 0;
  lMulRetExc    = false;
  lMulRepExc   = false;
  lJurExc       = false;
  lCorExc       = false;
  lIRRFExc      = false;
  lBolExc       = false;

  function zerarBases( )
  {
    nTotalaReceber = 0;
    nBaseIRRF = 0;
    nBaseMulta = 0;
    nBaseJuros = 0;
    nBaseTaxaAdm = 0;
    nBaseCorrecao=0;
  }
  
  vencimento   = $("#i-data-vencimento-rec").val();

  $( document ).ready(function() 
  {

    $("#i-div-btn-rec").hide(); //botões desnecessarios no recebimeto
    contratoCarga()       ;
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

      //botoes para essa tela de recebimento
      $("#lbl-data-vencimento").html('Data Pagamento');
      
      $("#i-div-btn-sim").hide()
      $("#i-div-btn-rec").show();

/*      $("#i-multarepassar").blur( function()
      {
        fuRecalcular();
      });
      $("#i-multareter").blur( function()
      {
        fuRecalcular();
      });
      $("#i-jurosrepassar").blur( function()
      {
        fuRecalcular();
      });

      $("#i-jurosreter").blur( function()
      {
        fuRecalcular();
      });

      $("#i-correcaorepassar").blur( function()
      {
        fuRecalcular();
      });

      $("#i-correcaoreter").blur( function()
      {
        fuRecalcular();
      });

      $("#i-boleto").blur( function()
      {
        fuRecalcular();
      });

      $("#i-irrf").blur( function()
      {
        fuRecalcular();
        });
      */



      $("#i-total-dinheiro").blur( function()
      {
        var nTotalApurado = realToDolar( $("#i-total-apurado").val() );
        var nTotalDinheiro = realToDolar( $("#i-total-dinheiro").val() );
        var nCheque =  parseFloat(nTotalApurado) - parseFloat(nTotalDinheiro);
//        console.log('cheque: '+nCheque );
        $("#i-total-cheque").val(  formatarBRSemSimbolo( nCheque ) );
      })

      $("#i-total-cheque").blur( function()
      {
        var nTotalApurado = realToDolar( $("#i-total-apurado").val() );
        var nTotalDinheiro = realToDolar( $("#i-total-dinheiro").val() );
        var nCheque = realToDolar( $("#i-total-cheque").val() );
        var nTroco =  parseFloat(nTotalApurado) - 
                      ( parseFloat(nTotalDinheiro) +
                        parseFloat(nCheque) ) ;
        ;

        if( nTroco < 0 )
        {
          $("#div-credito-futuro").show();
          $("#div-abater").hide();
          $("#div-debito-futuro").hide();
        }
        else
        if( nTroco > 0 )
        {
          $("#div-abater").show();
          $("#div-debito-futuro").show();
          $("#div-credito-futuro").hide();
        }
        $("#i-troco").val(  formatarBRSemSimbolo( nTroco ) );

      })

  });



  

    function contratoCarga()
  {

    
    url = "{{ route( 'contrato.find')}}/"+$("#IMB_CTR_ID").val();
    $.ajax(
    {
      url : url,
      type: 'get',
      dataType: 'json',
      async:false,
      success: function( data )
      {
        var dDataLimite = adicionarDia( data[0].VENCIMENTOLOCATARIO, data[0].IMB_CTR_TOLERANCIA);
        $("#i-lbl-header-imovel").html('Contrato: '+data[0].IMB_CTR_REFERENCIA+' - Imóvel: '+
        data[0].ENDERECOCOMPLETO+'  -   Situação: '+data[0].IMB_CTR_SITUACAO);
        $("#i-locador").val( data[0].PROPRIETARIO);
        $("#i-locatario").val( data[0].IMB_CLT_NOME_LOCATARIO );
        $("#i-data-vencimento").val( data[0].VENCIMENTOLOCATARIO);
        $("#i-data-vencimento-rec").val( data[0].VENCIMENTOLOCATARIO);
        $("#i-data-limite").val( dDataLimite);
        $("#i-data-base").val( moment().format( 'YYYY-MM-DD'));
        $("#i-data-rec").val( moment().format( 'YYYY-MM-DD'));
        $("#i-tolerancia").val( data[0].IMB_CTR_TOLERANCIA );
        $("#IMB_IMV_ID").val( data[0].IMB_IMV_ID );

                
        console.log('carga contrato: i-data-rec->'+$("#i-data-rec").val());
        var dados = { datavencimento : moment(dDataLimite ).format('YYYY/MM/DD') };

        url = "{{route('proximodiautil')}}";

        $.ajax(
          {
            url       : url,
            type      : 'get',
            dataType  : 'json',
            async     : false,
            data      : dados,
            success   : function( data )
            {
              $("#i-data-limite").val( data);
            },
            error:function( data )
            {
              alert('erro para apurar a data limite');
            }
          });
      }
    });
  }
  
  function resumoParcela2()
  {

  var chave = moment( $("#i-data-vencimento-rec").val() ).format('YYYY-MM-DD') ;
  var url = "{{route('parcelaaberta.locatario')}}/"+chave+'/'+$("#IMB_CTR_ID").val()+'/N/[]';

  $("#i-valores-lancados").val(0);
  $("#i-multarepassar").val(0);
  $("#i-jurosreter").val(0);
  $("#i-jurosrepassar").val(0);
  $("#i-correcaorepassar").val(0);
  $("#i-correcaoreter").val(0);
  $("#i-boleto").val(0);
  $("#i-irrf").val(0);

  console.log( 'url parcelaaberta.locatario: '+url );

  $.ajax(
    {
      url         : url,
      type        : 'get',
      dataType    : 'json',
      async       : false,
      success     : function( data )
      {
        linha = "";
        $("#i-tlblf-resumo>tbody").empty();
        var chave = '';
        for( nI=0;nI < data.data.length;nI++)
        {
        

          var datavencimento  = moment( data.data[nI].IMB_LCF_DATAVENCIMENTO).format('DD/MM/YYYY');
          var nomelocador = data.data[nI].IMB_CLT_NOMELOCADOR;
          var idlocador = data.data[nI].IMB_CLT_IDLOCADOR;
          
          $("#i-lbl-header-modalresumoparcelas").html('Locatário: '+$("#i-locatario").val() );


          //$("#i-data-vencimento-rec").val( moment( data.data[nI].IMB_LCF_DATAVENCIMENTO ).format('YYYY-MM-DD'));

          var idrandom = gerarRandomico();
          tr = '<tr id="'+idrandom+'">';

          if ( nomelocador == null ) 
          {
            nomelocador = '-';
            var idlocador = 0;
          }
          


          if ( data.data[nI].IMB_LCF_DTHINATIVADO != null )
              tr = '<tr class="linha-desativado" id="'+idrandom+'">';

          valorlancamento = parseFloat(data.data[nI].IMB_LCF_VALOR);

          linha = tr + 
            '<td style="text-align:center" valign="center"> '+
              '<a href=javascript:apagarLancamento('+idrandom+','+
              data.data[nI].IMB_TBE_ID+','+
              data.data[nI].IMB_LCF_ID+') class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a> '+
            '</td> '+

            '<td class="td-center escondido">'+data.data[nI].IMB_LCF_ID+'</td>'+
            '<td class="td-center">'+data.data[nI].IMB_TBE_ID+'</td>' +
            '<td class="td-center">'+data.data[nI].IMB_TBE_NOME+'</td>' +
            '<td class="td-rigth">'+formatarBRSemSimbolo(valorlancamento)+' </td>' +
            '<td class="td-center">'+data.data[nI].IMB_LCF_LOCATARIOCREDEB+'</td>' +
            '<td class="td-center">'+data.data[nI].IMB_LCF_LOCADORCREDEB+'</td>' +
            '<td class="td-center">'+datavencimento+'</td>' +
            '<td class="td-center">'+nomelocador+'</td>' +
            '<td class="td-center">'+data.data[nI].IMB_LCF_OBSERVACAO+'</td>'+
            '<td class="escondido">'+idrandom+'</td>'+
            '<td >N</td>'+
            '<td class="escondido">'+idlocador+'</td>';

              linha = linha +
                          '</tr>';
          $("#i-tlblf-resumo").append( linha );
        }
      }
    });

    $("#i-data-base").val( moment().format( 'YYYY-MM-DD') );
    $("#modalresumoparcela").modal('show');
    $('#i-div-recebimento').hide();

    calcularRecebimento('N');
}


function calcularBases()
{
  
  zerarBases()


  $("#i-valores-lancados").val( 0 );
  
  var table = document.getElementById('i-tlblf-resumo');


  $("#i-data-base").val( $("#i-data-rec").val() ); 
  var vencimento = moment(  $("#i-data-vencimento").val()).format( 'DD/MM/YYYY') ;
  $("#i-data-base").attr('readonly', true);

  $("#div-processando").html('Em processamento. Aguarde.');
  for (var r = 1, n = table.rows.length; r < n; r++)  
  {

    nValorLancamento          =  realToDolar(table.rows[r].cells[4].innerHTML);   
    nValorLancamento          = parseFloat( nValorLancamento );
    cLocatarioDC              =  table.rows[r].cells[5].innerHTML;   
    nIdLf                     = table.rows[r].cells[1].innerHTML;
    nIdTbe                    = table.rows[r].cells[2].innerHTML;
    nIdrandom                    = table.rows[r].cells[10].innerHTML
    

    if( nIdTbe == 18 ) nIRRFLancado = nValorLancamento;

//    console.log( 'coluna 11 '+table.rows[r].cells[11].innerHTML);
    if( table.rows[r].cells[11].innerHTML =='S' )
    {
      aDeletados.push( nIdTbe );    
      aDeletados.push( nIdTbe );    
    }
    else
    {
      if( IncideMultaLT( nIdTbe, nIdLf )   == 'S' )
       nBaseMulta = nBaseMulta + nValorLancamento;

      if( IncideJurosLT( nIdTbe, nIdLf )  == 'S' )
       nBaseJuros = nBaseJuros + nValorLancamento;

      if( IncideCorrecaoLT( nIdTbe, nIdLf )  == 'S' )
      nBaseCorrecao = nBaseCorrecao + nValorLancamento;

      if( IncideTaxaAdministrativaLT( nIdTbe, nIdLf )   == 'S' )
      nBaseTaxaAdm = nBaseTaxaAdm + nValorLancamento;

      if( IncideIRRFLT( nIdTbe, nIdLf )   == 'S' )
      nBaseIRRF = nBaseIRRF + nValorLancamento;
      console.log('Base IRRF '+nBaseIRRF );
    };

  };

/*  nMultaRepassar = parseFloat( realToDolar( $("#i-multa-repassar").val() ) );
  if( isNaN( nMultaRepassar) ) nMultaRepassar = 0;
  if( IncideIRRFLT( 2, 0 )   == 'S' )
     nBaseIRRF = nBaseIRRF + nMultaRepassar;
    
     nMultaReter = parseFloat( realToDolar( $("#i-multa-reter").val() ) );
  if( isNaN( nMultaReter) ) nMultaReter = 0;
  if( IncideIRRFLT( 36, 0 )   == 'S' )
     nBaseIRRF = nBaseIRRF + nMultaReter;

     nJurosReter = parseFloat( realToDolar( $("#i-juros-reter").val() ) );
  if( isNaN( nJurosReter) ) nJurosReter = 0;
  if( IncideIRRFLT( 3, 0 )   == 'S' )
     nBaseIRRF = nBaseIRRF + nJurosReter;

     nJurosRepassar = parseFloat( realToDolar( $("#i-juros-repassar").val() ) );
  if( isNaN( nJurosRepassar) ) nJurosRepassar = 0;
  if( IncideIRRFLT( 3, 0 )   == 'S' )
     nBaseIRRF = nBaseIRRF + nJurosRepassar;


     nCorrecaoReter = parseFloat( realToDolar( $("#i-correcao-reter").val() ) );
  if( isNaN( nCorrecaoReter) ) nCorrecaoReter = 0;
  if( IncideIRRFLT( 4, 0 )   == 'S' )
     nBaseIRRF = nBaseIRRF + nCorrecaoReter;

     nCorrecaoRepassar = parseFloat( realToDolar( $("#i-correcao-repassar").val() ) );
  if( isNaN( nCorrecaoRepassar ) ) nCorrecaoRepassar = 0;
  if( IncideIRRFLT( 4, 0 )   == 'S' )
     nBaseIRRF = nBaseIRRF + nCorrecaoRepassar;
     */

}
function calcularRecebimentoold( recalcular )
{


  calcularBases();

  
    //VERIFICANDO O PROXIMO DIA UTIL CONFORME A DATA DE VENCIMENTO
  url = "{{route('proximodiautil')}}/"+$("#i-data-vencimento").val();
  $("#div-processando").html('Em processamento. Aguarde..');

  var datalimite = Date();
  $.ajax(
  {
    url     : url,
    type    : 'get',
    dataType:'Json',
    async   : false,
    success : function( data )
    {
      $("#div-processando").html('Em processamento. Aguarde...');
      datalimite = date;
    }
  });

  var nDiferencaDias = 0;
  url = "{{route('diasdevencido')}}/"+$("#i-data-vencimento").val()+"/"+$("#i-data-base").val();
  $("#div-processando").html('Em processamento. Aguarde....');

  var datalimite = Date();
  $.ajax(
  {
    url     : url,
    type    : 'get',
    dataType:'Json',
    async   : false,
    success : function( data )
    {
      $("#div-processando").html('Em processamento. Aguarde......');
        
      nDiferencaDias = data;
    }
  });

  var nBaseMultaImob = 0;
  var nBaseMultaNormal =0;

  var nValorJuros     = 0;
  var nValorCorrecao  = 0;
  var nMultaReter     = 0;
  var nMultaRepassar  = 0;
  var nValorBoleto    = 0;


  url = "{{route('pegarpercmultatabela')}}/"+nDiferencaDias;
//  console.log('URL MULTA '+url);
  $("#div-processando").html('Em processamento. Aguarde.');

  var datalimite = Date();
  $.ajax(
  {
    url     : url,
    type    : 'get',
    dataType:'Json',
    async   : false,
    success : function( data )
    {
      $("#div-processando").html('Em processamento. Aguarde..');
      nBaseMultaImob = data.faixaimob;
      nBaseMultaNormal = data.faixanormal;
    }
  });

  if( nDiferencaDias > 0 )
  {
    if( nBaseMultaImob != 0)
      nMultaReter     = nBaseMulta * nBaseMultaImob / 100 ;


    if( nBaseMultaNormal != 0)
        nMultaRepassar     = nBaseMulta * nBaseMultaNormal / 100 ;

/*        
    if( IncideIRRFLT( 2, 0 )   == 'S' )
      nBaseIRRF = nBaseIRRF + nMultaRepassar + nMultaReter;

    console.log( 'baseirrf '+nBaseIRRF );
*/

  }

  if( nMultaReter != 0 && ! lMulRetExc ) 
  {
    var idrandom = gerarRandomico();
    var nMultaReter = formatarBRSemSimbolo( nMultaReter) ;
    tr = '<tr id="'+idrandom+'">';
    linha = tr+
    '<td style="text-align:center" valign="center"> '+
      '<a href=javascript:apagarLancamento('+idrandom+',36,0'+') class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a> '+
    '</td> '+
    '<td class="td-center escondido">0</td>'+
    '<td class="td-center">36</td>' +
    '<td class="td-center">Multa por Atraso</td>' + 
    '<td class="td-rigth">'+nMultaReter+'</td>' +  //valorirrf
    '<td class="td-center">D</td>' +
    '<td class="td-center">N</td>' +
    '<td class="td-center">'+vencimento+'</td>' + //datavencimento
    '<td class="td-center">-</td>' + //cliente
    '<td class="td-center">Multa por Atraso</td>'+ //'
    '<td class="escondido">'+idrandom+'</td>'+
    '<td >N</td>'+
    '<td class="escondido"></td></tr>'; //idlocador
    $("#i-tlblf-resumo").append( linha );        
  }



  //alert('Multa a repassar '+lMulRepExc);
  if( nMultaRepassar != 0 && ! lMulRepExc ) 
  {
    var idrandom = gerarRandomico();
    var nMultaRepassar = formatarBRSemSimbolo( nMultaRepassar) ;

    tr = '<tr id="'+idrandom+'">';
    linha = tr+
    '<td style="text-align:center" valign="center"> '+
      '<a href=javascript:apagarLancamento('+idrandom+',2,0'+') class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a> '+
    '</td> '+
    '<td class="td-center escondido">0</td>'+
    '<td class="td-center">2</td>' +
    '<td class="td-center">Multa (II) por Atraso no Pagamento</td>' + 
    '<td class="td-rigth">'+nMultaRepassar+'</td>' +  //valorirrf
    '<td class="td-center">D</td>' +
    '<td class="td-center">C</td>' +
    '<td class="td-center">'+vencimento+'</td>' + //datavencimento
    '<td class="td-center">-</td>' + //cliente
    '<td class="td-center">Multa(II) por Atraso no Pagamento</td>'+ //'
    '<td class="escondido">'+idrandom+'</td>'+
    '<td >N</td>'+
    '<td class="escondido"></td></tr>'; //idlocador
    $("#i-tlblf-resumo").append( linha );        
  }


  url = "{{route('pegarbasescontrato')}}/"+$("#IMB_CTR_ID").val();
  //console.log('bases '+url);
  $("#div-processando").html('Em processamento. Aguarde...');

  var nPerJur = 0;
  var nPerCor = 0;
  var aluguelgarantido = ' ';
  var datalimite = Date();
  $.ajax(
  {
    url     : url,
    type    : 'get',
    dataType:'Json',
    async   : false,
    success : function( data )
    {
      $("#div-processando").html('Em processamento. Aguarde....');
        
      if( nDiferencaDias > 0 )
      {
        nPerJur = data.jurosdiario;
        if( nPerJur == null ) nPerJur = 0;
        nPerCor = data.correcaodiaria;
        if( nPerCor == null ) nPerCor = 0;
      }
      nValorBoleto = data.valorboleto;
      aluguelgarantido = data.aluguelgarantido;
      if( nValorBoleto == null ) nValorBoleto = 0;
       
    }
  });

  if( nPerJur    != 0 )
    nValorJuros   =  nBaseJuros * nPerJur / 100 * nDiferencaDias;

  if( nPerCor     != 0 )
    nValorCorrecao =  nBaseCorrecao * nPerCor / 100 * nDiferencaDias;

  nMultaRepassar = parseFloat( nMultaRepassar);
  nMultaReter = parseFloat( nMultaReter);
  nValorJuros = parseFloat( nValorJuros);
  nValorCorrecao = parseFloat( nValorCorrecao);
  nValorBoleto = parseFloat( nValorBoleto);


  if( nValorJuros != 0 && ! lJurExc )
  {

    var idrandom = gerarRandomico();
    var juroscredito = 'C';
    if( aluguelgarantido == 'S' )
      juroscredito = 'N';

    var nValorJuros = formatarBRSemSimbolo( nValorJuros) ;

    tr = '<tr id="'+idrandom+'">';
    linha = tr+
      '<td style="text-align:center" valign="center"> '+
        '<a href=javascript:apagarLancamento('+idrandom+',3,0'+') class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a> '+
      '</td> '+
      '<td class="td-center escondido">0</td>'+
      '<td class="td-center">3</td>' +
      '<td class="td-center">Juros no Atraso</td>' + 
      '<td class="td-rigth">'+nValorJuros+'</td>' +  //valorirrf
      '<td class="td-center">D</td>' +
      '<td class="td-center">'+juroscredito+'</td>' +
      '<td class="td-center">'+vencimento+'</td>' + //datavencimento
      '<td class="td-center">-</td>' + //cliente
      '<td class="td-center">Juros por Atraso no Pagamento</td>'+ //'
      '<td class="escondido">'+idrandom+'</td>'+
      '<td >N</td>'+
      '<td class="escondido"></td></tr>'; //idlocador
      $("#i-tlblf-resumo").append( linha );        
  }

 
  
  if( nValorCorrecao != 0 && ! lCorExc )

  {
    var correcaocredito = 'C';
    if( aluguelgarantido == 'S' )
      correcaocredito = 'N';
    if( nValorJuros != 0 && ! lJurExc )

    var idrandom = gerarRandomico();

    var correcaocredito = formatarBRSemSimbolo( nValorJuros) ;

    tr = '<tr id="'+idrandom+'">';
    linha = tr+
      '<td style="text-align:center" valign="center"> '+
        '<a href=javascript:apagarLancamento('+idrandom+',4,0'+') class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a> '+
      '</td> '+
      '<td class="td-center escondido">0</td>'+
      '<td class="td-center">4</td>' +
      '<td class="td-center">Correção Monetária</td>' + 
      '<td class="td-rigth">'+correcaocredito+'</td>' +  //valorirrf
      '<td class="td-center">D</td>' +
      '<td class="td-center">'+correcaocredito+'</td>' +
      '<td class="td-center">'+vencimento+'</td>' + //datavencimento
      '<td class="td-center">-</td>' + //cliente
      '<td class="td-center">Correção Monetária pelo Atraso</td>'+ //'
      '<td class="escondido">'+idrandom+'</td>'+
      '<td >N</td>'+
      '<td class="escondido"></td></tr>'; //idlocador
      $("#i-tlblf-resumo").append( linha );        
  }

  $("#div-processando").html('Em processamento. Aguarde......');

  if( nValorBoleto != 0 ) 
  {
     


    $("#i-boleto").val( formatarBRSemSimbolo( nValorBoleto ) );


  }

  if( aluguelgarantido == 'S' )
  {
    $("#i-jurosreter").val( formatarBRSemSimbolo( nValorJuros ) );
    $("#i-jurosrepassar").val( 0 ) ;
 //   $("#i-jurosrepassar").prop('readonly', true);    
  //  $("#i-jurosreter").prop('readonly', false);    

    $("#i-correcaoreter").val( formatarBRSemSimbolo( nValorCorrecao ) );
    $("#i-correcaorepassar").val( 0 ) ;
    //$("#i-correcaorepassar").prop('readonly', true);    
    //$("#i-correcaoreter").prop('readonly', false);    

    $("#i-multarepassar").val( 0) ;
    $("#i-multareter").val( formatarBRSemSimbolo( nMultaReter+nMultaRepassar ) );

  }
  else
  {
    $("#i-jurosrepassar").val( formatarBRSemSimbolo( nValorJuros ) );
    //$("#i-jurosrepassar").prop('readonly', false);    
    $("#i-jurosreter").val( 0 );
    //$("#i-jurosreter").prop('readonly', true);    

    $("#i-correcaorepassar").val( formatarBRSemSimbolo( nValorCorrecao ) );
    //$("#i-correcaorepassar").prop('readonly', false);    
    $("#i-correcaoreter").val( 0 );
    //$("#i-correcaoreter").prop('readonly', true);    

    $("#i-multarepassar").val( formatarBRSemSimbolo( nMultaRepassar ) );
    $("#i-multareter").val( formatarBRSemSimbolo( nMultaReter ) );


  }

  if( ! lIRRFExc )
  {
    calcularBases();
    //calcular irrrf
    url = "{{route('calcularirrf')}}/"+$("#IMB_IMV_ID").val()+'/'+nBaseIRRF;
//    console.log('url irrf: '+url);
    var nValorTotalIRRF = 0;
    
    $.ajax(
    {
      url     : url,
      type    : 'get',
      dataType:'Json',
      async   : false,
      success : function( data )
      {
//        console.log('registros IRRF '+data.length);
        var linha='';
        for( nI=0;nI < data.length;nI++)
        {
          //console.log('entrei');
          var valorirrf = formatarBRSemSimbolo( data[ nI ].valorIRRF ) ;
          var vencimento = moment(  $("#i-data-vencimento").val()).format( 'DD/MM/YYYY') ;
          var cliente = data[ nI ].cliente;
          var cpf = data[ nI ].cpf;
          var idlocador = data[ nI ].IMB_CLT_ID;
          var idrandom = gerarRandomico();
        
          tr = '<tr id="'+idrandom+'">';
          //console.log( 'tr '+tr );
        
          linha = tr+
            '<td style="text-align:center" valign="center"> '+
              '<a href=javascript:apagarLancamento('+idrandom+',18,0'+') class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a> '+
            '</td> '+
            '<td class="td-center escondido">0</td>'+
            '<td class="td-center">18</td>' +
            '<td class="td-center">I.R.R.F.</td>' + 
            '<td class="td-rigth">'+valorirrf+'</td>' +  //valorirrf
            '<td class="td-center">C</td>' +
            '<td class="td-center">D</td>' +
            '<td class="td-center">'+vencimento+'</td>' + //datavencimento
            '<td class="td-center">'+cliente+'</td>' + //cliente
            '<td class="td-center">'+cliente+' - CPF: '+cpf+'</td>'+ //'
            '<td class="escondido">'+idrandom+'</td>'+
            '<td >N</td>'+
            '<td class="escondido"></td></tr>'; //idlocador
//            console.log('linha '+linha );

            $("#i-tlblf-resumo").append( linha );        


          $("#i-irrf").val( formatarBRSemSimbolo(nValorTotalIRRF) )
        }
      }
    });
  }
 

  totalizar();

  $("#i-boleto").val( formatarBRSemSimbolo(nValorBoleto) );
  $("#div-processando").html('');
  $("#i-div-dados-receber").show();
  //$("#i-div-recebimento").show();
  cargaFormaRecebimento();
  cargaConta();
  //fuRecalcular();

}

function cargaConta()
{

  $.getJSON( "{{ route('contacaixa.carga')}}/N", function( data )
  {
    $("#FIN_CCX_ID").empty();
    linha =  '<option value="-1">Selecione</option>';
    $("#FIN_CCX_ID").append( linha );
    for( nI=0;nI < data.length;nI++)
    {
      linha = 
      '<option value="'+data[nI].FIN_CCX_ID+'">'+
                        data[nI].FIN_CCX_DESCRICAO+"</option>";
      $("#FIN_CCX_ID").append( linha );
    }
  });

}

function cargaFormaRecebimento()
    {
      
      $.getJSON( "{{ route('formapagamento.carga')}}", function( data )
            {
                
                $("#IMB_FORPAG-IDLOCATARIO").empty();
                
                linha =  '<option value="-1">Forma Pagamento</option>';
                $("#IMB_FORPAG-IDLOCATARIO").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha = 
                    '<option value="'+data[nI].IMB_FORPAG_ID+'">'+
                        data[nI].IMB_FORPAG_NOME+"</option>";
                        $("#IMB_FORPAG-IDLOCATARIO").append( linha );
                        
                }

            });

    }

  function gerarToken()
  {
      var ctoken = "{{csrf_token()}}";
      //console.log( ctoken );

  }

  function confirmarRecebimento()
  {
    
    var nTotDin = parseFloat(realToDolar($("#i-total-dinheiro").val()));
    if ( isNaN( nTotDin) )
       nTotDin = 0;

      
    var nTotChe = parseFloat(realToDolar($("#i-total-cheque").val()));
    if ( isNaN( nTotChe) )
      nTotChe = 0;

    var nTroco = parseFloat(realToDolar($("#i-troco").val()));
    if ( isNaN( nTroco))
      nTroco = 0;

/*
    var nMulRet = parseFloat(realToDolar($("#i-multareter").val()));
    if ( isNaN( nMulRet))
    nMulRet = 0;

    var nMulRep = parseFloat(realToDolar($("#i-multarepassar").val()));
    if ( isNaN( nMulRep))
    nMulRep = 0;


      var nJurRet = parseFloat(realToDolar($("#i-jurosreter").val()));
      if ( isNaN( nJurRet))
      nJurRet = 0;


    var nJurRep = parseFloat(realToDolar($("#i-jurosrepassar").val()));
    if ( isNaN( nJurRep))
    nJurRep = 0;



    var nCorRet = parseFloat(realToDolar($("#i-correcaoreter").val()));
    if ( isNaN( nCorRet))
    nCorRet = 0;


    var nCorRep = parseFloat(realToDolar($("#i-correcaorepassar").val()));
    if ( isNaN( nCorRep))
    nCorRep = 0;


    var nBoleto = parseFloat(realToDolar($("#i-boleto").val()));
    if ( isNaN( nBoleto))
    nBoleto = 0;

    var nIRRF = parseFloat(realToDolar($("#i-irrf").val()));
    if ( isNaN( nIRRF))
    nIRRF = 0;

    nTotalRecibo =  ( nTotDin+
                      nTotChe+
                      nTroco+
                      nMulRet+
                      nMulRep+
                      nJurRet+
                      nJurRep+
                      nCorRet+
                      nCorRep+
                      nBoleto)-nIRRF;
*/    
    gerandoReciboLocatario(
      "i-tlblf-resumo",
      moment( $("#i-data-base").val()).format( 'YYYY-MM-DD'), 
      $("#IMB_FORPAG").val(), 
      $("#FIN_CCX_ID").val(), 
      moment( $("#i-data-base").val()).format( 'YYYY-MM-DD'),  
      $("#IMB_CTR_ID").val(), 
      nTotDin,
      nTotChe,
      nTroco,
      nTroco,
      "{{csrf_token()}}",
      nTotalaReceber,
      moment( $("#i-data-vencimento-rec").val() ).format( 'YYYY-MM-DD')  
    );

  }
  
  function apagarLancamento (id, evento, lf) 
  {
      
      

    $("#i-tlblf-resumo").find('tr#'+id).find('td:eq(11)').html('S');    
    $("tr#"+id).addClass('dashed');

                        
    if( evento == 18 )  lIRRFExc = true;
    if( evento == 3 )   lJurExc = true;
    if( evento == 2 )   lMulRepExc = true;
    if( evento == 4 )   lMulCorExc = true;
    if( evento == 36 )   lMulRetExc = true;
    if( evento == 23 )   llBolExc = true;


    refazerCalculados();
    calcularRecebimento();

      

  }        

    function verificarDeletados( id )
    {
      //console.log( 'aDeletados ---> '+aDeletados );

      for (var nDel = 0, n = aDeletados.length; nDel < n; nDel++)  
      {
        if( aDeletados[ nDel ] == id ) 
        {
          //console.log('localizado como excluido ');
          return true;
        }
      }
      return false;

      
    }

    function setRowPrice(table, rowId, colNum, newValue)
    {
        
    };

    function fuRecalcular()  //obsoleto
    {
      nMultaRepassar =  0;
      if( $("#i-multarepassar").val()  !='' )
        nMultaRepassar = parseFloat(realToDolar($("#i-multarepassar").val() ));
      
      nMultaReter =  0;
      if( $("#i-multareter").val()  !='' )
        nMultaReter = parseFloat(realToDolar($("#i-multareter").val() ));

      nJurosReter =  0;
      if( $("#i-jurosreter").val()  !='' )
        nJurosReter = parseFloat(realToDolar($("#i-jurosreter").val() ));

      nJurosRepassar =  0;
      if( $("#i-jurosrepassar").val()  !='' )
        nJurosRepassar = parseFloat(realToDolar($("#i-jurosrepassar").val() ));

      nJurosReter =  0;
      if( $("#i-jurosreter").val()  !='' )
        nJurosReter = parseFloat(realToDolar($("#i-jurosreter").val() ));
      
      nCorrecaoRepassar =  0;
      if( $("#i-correcaorepassar").val()  !='' )
        nCorrecaoRepassar = parseFloat(realToDolar($("#i-correcaorepassar").val() ));

        nCorrecaoReter =  0;
      if( $("#i-correcaoreter").val()  !='' )
        nCorrecaoReter = parseFloat(realToDolar($("#i-correcaoreter").val() ));

      nBoleto =  0;
      if( $("#i-boleto").val()  !='' )
        nBoleto = parseFloat(realToDolar($("#i-boleto").val() ));

      nIrrf =  0;
      if( $("#i-irrf").val()  !='' )
        nIrrf = parseFloat(realToDolar($("#i-irrf").val() ));

      nTotalaReceber = 
                    ( parseFloat(realToDolar($("#i-valores-lancados").val())) +
                      nMultaRepassar +
                      nMultaReter +
                      nJurosReter +
                      nJurosRepassar +
                      nCorrecaoRepassar +
                      nCorrecaoReter +
                      nBoleto )
                      -
                      nIrrf;
      $("#i-totalareceber").html( formatarBRSemSimbolo(nTotalaReceber) );
      $("#i-total-apurado").val( formatarBRSemSimbolo(nTotalaReceber) );
      $("#i-total-dinheiro").val( formatarBRSemSimbolo(nTotalaReceber) );

    }


    function refazerCalculados()
    {

      $("#i-tlblf-resumo").find('tr#42012866').find('td:eq(3)').html('S'); 



      var table = document.getElementById('i-tlblf-resumo');
      for (var r = 1, n = table.rows.length; r < n; r++)  
      {

        var idLCF = table.rows[r].cells[1].innerHTML;
        var idrandom = table.rows[r].cells[10].innerHTML;

        //console.log( 'idevento '+idLCF );
        //console.log( 'idrandom '+idrandom );

        if( idLCF == '0' )
        {
          $("#i-tlblf-resumo").find('tr#'+idrandom).find('td:eq(11)').html('S');         
          $("tr#"+idrandom).addClass('escondido');
        
        };

      }

      zerarBases();
      
    }

    function totalizar()
    {
      nTotalaReceber = 0;
      var table = document.getElementById('i-tlblf-resumo');
      for (var r = 1, n = table.rows.length; r < n; r++)  
      {
        nValorLancamento = 0;
        if( table.rows[r].cells[11].innerHTML != 'S' )
        {
          nValorLancamento          =  realToDolar(table.rows[r].cells[4].innerHTML);   
          nValorLancamento          = parseFloat( nValorLancamento );
          cLocatarioDC              =  table.rows[r].cells[5].innerHTML;   

          if( cLocatarioDC == 'C' ) 
            nValorLancamento = nValorLancamento * -1;

          if( cLocatarioDC != 'N' )  
            nTotalaReceber = nTotalaReceber + nValorLancamento;
        };

      }

            
      $("#i-totalareceber").html( formatarBRSemSimbolo(nTotalaReceber) );
      $("#i-valores-lancados").val( formatarBRSemSimbolo(nTotalaReceber) );
      $("#i-total-apurado").val( formatarBRSemSimbolo(nTotalaReceber) );
      $("#i-total-dinheiro").val( formatarBRSemSimbolo(nTotalaReceber) );

    }

    function geraTMP()
    {

      var idcontrato = $("#IMB_CTR_ID").val();
      datavencimento= $("#i-data-vencimento-rec").val();
      datavencimento= moment(datavencimento ).format('YYYY-MM-DD')
      datapagamento = $("#i-data-rec").val();
      datapagamento= moment(datapagamento ).format('YYYY-MM-DD');

      var url = "{{route('recebimento.calcular')}}/"+idcontrato+'/'+datavencimento+'/'+datapagamento;

      console.log('parametros '+idcontrato+'/'+datavencimento+'/'+datapagamento);

      $.ajax(
      {
        url     : url,
        type    : 'get',
        dataType:'Json',
        async   : false,
          success   : function( data )
          {
            linha = "";
            $("#i-tlblf-resumo>tbody").empty();
            var chave = '';
            for( nI=0;nI < data.length;nI++)
            {

              var datavencimento  = moment( data[nI].IMB_LCF_DATAVENCIMENTO).format('DD/MM/YYYY');
              var nomelocador     = data[nI].IMB_CLT_NOMELOCADOR;
              var idlocador = data[nI].IMB_CLT_ID;
          
              $("#i-lbl-header-modalresumoparcelas").html('Locatário: '+$("#i-locatario").val() );

              //$("#i-data-vencimento-rec").val( datavencimento);

              var idrandom = gerarRandomico();
              tr = '<tr id="'+idrandom+'">';

              if ( nomelocador == null ) 
              {
                nomelocador = '-';
                var idlocador = 0;
              }
          
              valorlancamento = parseFloat(data[nI].IMB_LCF_VALOR);

              linha = tr + 
                '<td style="text-align:center" valign="center"> '+
                  '<a href=javascript:apagarLancamento('+idrandom+','+
                  data[nI].IMB_TBE_ID+','+
                  data[nI].IMB_LCF_ID+') class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a> '+
                '</td> '+
                '<td class="td-center escondido">'+data[nI].IMB_LCF_ID+'</td>'+
                '<td class="td-center">'+data[nI].IMB_TBE_ID+'</td>' +
                '<td class="td-center">'+data[nI].IMB_TBE_NOME+'</td>' +
                '<td class="td-rigth">'+formatarBRSemSimbolo(valorlancamento)+' </td>' +
                '<td class="td-center">'+data[nI].IMB_LCF_LOCATARIOCREDEB+'</td>' +
                '<td class="td-center">'+data[nI].IMB_LCF_LOCADORCREDEB+'</td>' +
                '<td class="td-center">'+datavencimento+'</td>' +
                '<td class="td-center">'+nomelocador+'</td>' +
                '<td class="td-center">'+data[nI].IMB_LCF_OBSERVACAO+'</td>'+
                '<td class="escondido">'+idrandom+'</td>'+
                '<td >N</td>'+
                '<td class="escondido">'+idlocador+'</td>';
              linha = linha +
                            '</tr>';
              $("#i-tlblf-resumo").append( linha );
            }           

            $("#i-data-base").val( moment().format( 'YYYY-MM-DD') );
            $("#modalresumoparcela").modal('show');
            $('#i-div-recebimento').hide();


          },
          error     : function()
          {
            alert('erro!');
          }
        }
      )

    }

    function resumoParcela2()
  {

  var chave = moment( $("#i-data-vencimento-rec").val() ).format('YYYY-MM-DD') ;
  var url = "{{route('parcelaaberta.locatario')}}/"+chave+'/'+$("#IMB_CTR_ID").val()+'/N/[]';

  $("#i-valores-lancados").val(0);
  $("#i-multarepassar").val(0);
  $("#i-jurosreter").val(0);
  $("#i-jurosrepassar").val(0);
  $("#i-correcaorepassar").val(0);
  $("#i-correcaoreter").val(0);
  $("#i-boleto").val(0);
  $("#i-irrf").val(0);

  console.log( 'url parcelaaberta.locatario: '+url );

  $.ajax(
    {
      url         : url,
      type        : 'get',
      dataType    : 'json',
      async       : false,
      success     : function( data )
      {
        linha = "";
        $("#i-tlblf-resumo>tbody").empty();
        var chave = '';
        for( nI=0;nI < data.data.length;nI++)
        {
        

          var datavencimento  = moment( data.data[nI].IMB_LCF_DATAVENCIMENTO).format('DD/MM/YYYY');
          var nomelocador = data.data[nI].IMB_CLT_NOMELOCADOR;
          var idlocador = data.data[nI].IMB_CLT_IDLOCADOR;
          
          $("#i-lbl-header-modalresumoparcelas").html('Locatário: '+$("#i-locatario").val() );


          $("#i-data-vencimento-rec").val( moment( data.data[nI].IMB_LCF_DATAVENCIMENTO ).format('YYYY-MM-DD'));

          var idrandom = gerarRandomico();
          tr = '<tr id="'+idrandom+'">';

          if ( nomelocador == null ) 
          {
            nomelocador = '-';
            var idlocador = 0;
          }
          


          if ( data.data[nI].IMB_LCF_DTHINATIVADO != null )
              tr = '<tr class="linha-desativado" id="'+idrandom+'">';

          valorlancamento = parseFloat(data.data[nI].IMB_LCF_VALOR);

          linha = tr + 
            '<td style="text-align:center" valign="center"> '+
              '<a href=javascript:apagarLancamento('+idrandom+','+
              data.data[nI].IMB_TBE_ID+','+
              data.data[nI].IMB_LCF_ID+') class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a> '+
            '</td> '+

            '<td class="td-center escondido">'+data.data[nI].IMB_LCF_ID+'</td>'+
            '<td class="td-center">'+data.data[nI].IMB_TBE_ID+'</td>' +
            '<td class="td-center">'+data.data[nI].IMB_TBE_NOME+'</td>' +
            '<td class="td-rigth">'+formatarBRSemSimbolo(valorlancamento)+' </td>' +
            '<td class="td-center">'+data.data[nI].IMB_LCF_LOCATARIOCREDEB+'</td>' +
            '<td class="td-center">'+data.data[nI].IMB_LCF_LOCADORCREDEB+'</td>' +
            '<td class="td-center">'+datavencimento+'</td>' +
            '<td class="td-center">'+nomelocador+'</td>' +
            '<td class="td-center">'+data.data[nI].IMB_LCF_OBSERVACAO+'</td>'+
            '<td class="escondido">'+idrandom+'</td>'+
            '<td >N</td>'+
            '<td class="escondido">'+idlocador+'</td>';

              linha = linha +
                          '</tr>';
          $("#i-tlblf-resumo").append( linha );
        }
      }
    });

    $("#i-data-base").val( moment().format( 'YYYY-MM-DD') );
    $("#modalresumoparcela").modal('show');
    $('#i-div-recebimento').hide();

    calcularRecebimento('N');
}



</script>




@endpush