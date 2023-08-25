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

  .div-left
  {
    text-align:left;
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

@php
  app( 'App\Http\Controllers\ctrRepasse')->limparTMP();
@endphp

<div class="modal fade" id="modalfixarvalorrec" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:40%;">
        <div class="modal-content ">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Fixar Valor
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <input type="hidden" id="i-tmp-rec-id">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <input class="form-control valor" type="text" id="i-novo-valor-lancamento">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                    <div class="col-md-2">
                        </div>
                        <div class="col-md-5">
                            <button class="form-control  btn btn-primary" onClick="confirmarFixarLancamento()">Confirmar Novo Valor</button>
                        </div>
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="form-control btn btn-danger" onClick="sairAlteracao();">sair</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="portlet box red">
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
          <div class="col-md-5">
            <div class="row">
              <div class="col-md-12">
                <label class="label-control">Locatário</label>
                <input type="text" class="form-control cardtitulo" id="i-locatario" readonly>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 div-left">
                <label class="label-control">Locador</label>
                
                <textarea class="form-control cardtitulo div-left" cols="100%" rows="1">
                  @php
                    $contrato = app('App\Http\Controllers\ctrContrato')->findFull( $id );
                    $ppis = app('App\Http\Controllers\ctrPropImo')->cargaSemJson( $contrato->IMB_IMV_ID);
                  @endphp
                  @foreach( $ppis as $registro )
                    {{$registro->IMB_CLT_NOME}}({{$registro->IMB_IMVCLT_PERCENTUAL4}}%),
                  @endforeach

                </textarea>
                

                
              </div>
            </div>
          </div>
          <div class="col-md-7">
            <div class="row">
              <div class="col-md-5">
                <label class="label-control">Data Vencimento</label>
                <input type="date" class="form-control cardtitulo" id="i-data-vencimento-rec" readonly>
              </div>
              <div class="col-md-2">
                <label class="label-control">Dias p/ Repasse</label>
                <input type="text" class="form-control cardtitulo" id="i-tolerancia" readonly>
              </div>
              <div class="col-md-5 escondido  div-center" id="i-div-repassenormal">
                <label class="label-control">Repassar até</label>
                <input type="date" class="form-control cardtitulo-20 div-center" id="i-data-limite" readonly>
              </div>
              <div class="col-md-5 escondido   div-center" id="i-div-repassediafixo"> 
                <label class="label-control">Repasse dia Fixo</label>
                <input type="date" class="form-control cardtitulo-20 div-center" id="i-data-limite-fixo" readonly>
              </div>

            </div>
            <div class="row">
              <div class="col-md-3">
                <label class="label-control">Data de Repasse</label>
                <input type="date" class="form-control cardtitulo-20" id="i-data-rec">
              </div>
              <div class="col-md-2 " id="div-calcular">
                <br>
                <a class="form-control btn btn-success" href="javascript:geraTMP()">Calcular</a>
              </div>
              <div class="col-md-2">
                <br>
                <a class="form-control btn btn-primary" href="javascript:novoPagamento()">Novo Pagto.</a>
              </div>
              <div class="col-md-2">
                <br>
                <a class="form-control btn btn-warning" href="{{route('lancamento.index')}}?IMB_CTR_ID={{$id}}" target="_blank">Lançamentos</a>
             </div>

              <div class="col-md-2">
                <br>
                <button class="form-control btn btn-danger" type="button" onClick="javascript:window.close()">Sair</button>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@include( 'layout.modalbuscaltctr-repasse');

<form style="display: none" action="{{route('repasse')}}" method="POST" id="form-repassar"target="_blank">
    @csrf
    <input type="hidden" id="i-idcontrato-repassar" name="IMB_CTR_ID" />
</form>



<div id="i-loader" class="div-center escondido">
  <img src="{{asset('/layouts/layout/img/loader.gif')}}"/>
</div>

@include( 'layout.resumoparcelapagar')

@endsection

@push('script')

<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/funcoes-recibolocador.js')}}" type="text/javascript"></script>


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
    $("#sirius-menu").click();

    $("#i-total-dinheiro-locador").blur( function()
    {
      var nTotalApurado = realToDolar( $("#i-total-apurado-locador").val() );
      var nTotalDinheiro = realToDolar( $("#i-total-dinheiro-locador").val() );
      var nCheque =  parseFloat(nTotalApurado) - parseFloat(nTotalDinheiro);
      $("#i-total-cheque-locador").val(  formatarBRSemSimbolo( nCheque ) );
    })

    $("#i-total-cheque-locador").blur( function()
    {
      var nTotalApurado = realToDolar( $("#i-total-apurado-locador").val() );
      var nTotalDinheiro = realToDolar( $("#i-total-dinheiro-locador").val() );
      var nCheque = realToDolar( $("#i-total-cheque-locador").val() );
      var nTroco =  parseFloat(nTotalApurado) -
                      ( parseFloat(nTotalDinheiro) +
                        parseFloat(nCheque) ) ;

      if( nTroco < 0 )
      {
        $("#div-credito-futuro-locador").show();
        $("#div-abater-locador").hide();
        $("#div-debito-futuro-locador").hide();
      }
      else
      if( nTroco > 0 )
      {
        $("#div-abater-locador").show();
        $("#div-debito-futuro-locador").show();
        $("#div-credito-futuro-locador").hide();
      }
      $("#i-troco-locador").val(  formatarBRSemSimbolo( nTroco ) );

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
        if( data[0].IMB_CTR_VENCIMENTOLOCADOR == null )
        {
          alert('Este contrato já se encontra encerrado, e não há valores pendentes a repassar!');
          window.close();
        }

/*        if( data[0].IMB_CTR_SITUACAO == 'ATIVO' &&
              data[0].IMB_CTR_VENCIMENTOLOCADOR >  data[0].IMB_CTR_DATAREAJUSTE)
          {
            alert('Atenção! Reajuste vencido em '+moment(data[0].IMB_CTR_DATAREAJUSTE).format( 'DD-MM-YYYY'));
//            window.close();
          }
*/
          var dDataLimite = adicionarDia( data[0].IMB_CTR_VENCIMENTOLOCADOR, data[0].IMB_CTR_REPASSEDIA);
          var dDataLimitefixo = data[0].IMB_CTR_PROXIMOREPASSE;

          if( data[0].IMB_CTR_REPASSEDIAFIXO > 0 )
          {
            $("#i-div-repassediafixo").show();
            $("#i-div-repassenormal").hide();
          }
          else
          {
            $("#i-div-repassediafixo").hide();
            $("#i-div-repassenormal").show();
          }

        $("#i-lbl-header-imovel").html('*** REPASSE *** Contrato: '+data[0].IMB_CTR_REFERENCIA+' - Imóvel: '+
        data[0].ENDERECOCOMPLETO+'  -   Situação: '+data[0].IMB_CTR_SITUACAO);
        //$("#i-locador").val( data[0].PROPRIETARIO);
        $("#i-locatario").val( data[0].IMB_CLT_NOME_LOCATARIO );
        $("#i-data-vencimento").val( data[0].IMB_CTR_VENCIMENTOLOCADOR);
        $("#i-data-vencimento-rec").val( data[0].IMB_CTR_VENCIMENTOLOCADOR);
        $("#i-data-limite").val( dDataLimite)
        $("#i-data-limite-fixo").val( dDataLimitefixo)

        $("#i-data-base").val( moment().format( 'YYYY-MM-DD'));
        $("#i-data-rec").val( moment().format( 'YYYY-MM-DD'));
        $("#i-tolerancia").val( data[0].IMB_CTR_TOLERANCIA );
        $("#IMB_IMV_ID").val( data[0].IMB_IMV_ID );


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


    url = "{{ route( 'verificarsereajusta')}}/"+$("#IMB_CTR_ID").val()+'/'+$("#i-data-vencimento").val()+'/S';

    $.ajax(
    {
      url : url,
      type: 'get',
      dataType: 'json',
      async:false,
      success:function(data )
      {
        if( data == 'S' )
        {
          alert('Reajuste Vencido! Não permitido a baixa');
          //window.close();
        }
      }
    });

  }


  function cargaConta()
  {
    var url = "{{ route('contacaixa.carga')}}/N";
    $.getJSON( url , function( data )
    {
      $("#FIN_CCX_ID_LOCADOR").empty();
      linha =  '<option value="-1">Selecione</option>';
      $("#FIN_CCX_ID_LOCADOR").append( linha );
      for( nI=0;nI < data.length;nI++)
      {
        linha =
        '<option value="'+data[nI].FIN_CCX_ID+'">'+
                          data[nI].FIN_CCX_DESCRICAO+"</option>";
        $("#FIN_CCX_ID_LOCADOR").append( linha );
      }
    });

  }

  function cargaFormaRecebimento()
  {

    $.getJSON( "{{ route('formapagamento.carga')}}", function( data )
    {
      $("#IMB_FORPAG-IDLOCADOR-repasse").empty();

      linha =  '<option value="-1">Forma Pagamento</option>';
      $("#IMB_FORPAG-IDLOCADOR-repasse").append( linha );
      for( nI=0;nI < data.length;nI++)
      {
        linha =
          '<option value="'+data[nI].IMB_FORPAG_ID+'">'+
                        data[nI].IMB_FORPAG_NOME+"</option>";
        $("#IMB_FORPAG-IDLOCADOR-repasse").append( linha );
      }
    });

  }

  function gerarToken()
  {
    var ctoken = "{{csrf_token()}}";
  }

  function confirmarRepasse()
  {
    var table = document.getElementById( 'i-tlblf-resumo' );

    if(  table.rows.length  <=1 )
    {
      alert('Nada a baixar!');
      return false;
    }


    if( $("#FIN_CCX_ID_LOCADOR").val() == '-1' )
    {
      alert('Informe a conta pra baixa!');
      return false;
    }
    if( $("#IMB_FORPAG-IDLOCADOR").val() == '-1' )
    {
      alert('Informe a forma de pagamento!');
      return false;
    }


    $("#i-botoes-acao-conf-repassar").hide();

    var nTotDin = parseFloat(realToDolar($("#i-total-dinheiro-locador").val()));
    if ( isNaN( nTotDin) )
       nTotDin = 0;


    var nTotChe = parseFloat(realToDolar($("#i-total-cheque-locador").val()));
    if ( isNaN( nTotChe) )
      nTotChe = 0;

    var nTroco = parseFloat(realToDolar($("#i-troco-locador").val()));
    if ( isNaN( nTroco))
      nTroco = 0;

    var nRecibo = gerandoReciboLocador(
      "i-tlblf-resumo",
      moment( $("#i-data-base").val()).format( 'YYYY-MM-DD'),
      $("#IMB_FORPAG-IDLOCADOR-repasse").val(),
      $("#FIN_CCX_ID_LOCADOR").val(),
      moment( $("#i-data-base").val()).format( 'YYYY-MM-DD'),
      $("#IMB_CTR_ID").val(),
      nTotDin,
      nTotChe,
      nTroco,
      nTroco,
      "{{csrf_token()}}",
      parseFloat(realToDolar($("#i-total-apurado-locador").val())),
      moment( $("#i-data-vencimento-rec").val() ).format( 'YYYY-MM-DD')  ,
      'RECMES'

    );

    $("#btn-confirmar").hide();

    if( confirm( "Processo concluído. Deseja emitir o recibo?") )
    {  
      window.open( "{{route('recibolocador.imprimir')}}/"+nRecibo+'/S', '_blank');
    }

    $("#modalresumoparcela").modal('hide');
    $("#div-calcular").hide();
    alert('Processo finalizado!');

//    novoPagamento();
    





  }



  function geraTMP()
  {

    var idcontrato = $("#IMB_CTR_ID").val();
    datavencimento= $("#i-data-vencimento-rec").val();
    datavencimento= moment(datavencimento ).format('YYYY-MM-DD')
    datapagamento = $("#i-data-rec").val();
    datapagamento= moment(datapagamento ).format('YYYY-MM-DD');

    var url = "{{route('repasse.calcular')}}/"+idcontrato+'/'+datavencimento+'/'+datapagamento+'/S';

    // O parametro 'N' significa pra pegar tudo em aberto e não somente o do mes

    //console.log( url );



    $.ajax(
    {
      url     : url,
      type    : 'get',
      dataType:'Json',
      async   : false,
      beforeSend: function(data)
      {
        $("#i-loader").show();
      },
      success   : function( data )
      {

      },
      complete: function (data)
      {
        //console.log('gera tmp');
        //console.log(data);
        if( data)
        carregarTable( data );
        cargaConta();
        cargaFormaRecebimento();
        $("#i-loader").hide();


      }
    });

    recalcularRepasse();

  }

  //funcao disparada pela template resumoparcela.blade
  function recalcular()
  {
    $("#i-data-rec").val( $("#i-data-base").val() );
    geraTMP();


  }

  function totalizar(total)
  {
    /*
    url = "{{ route('repasse.totalizarlancamentos')}}";
    $.ajax(
      {
        url     : url,
        type    : 'get',
        dataType: 'json',
        async   : false,
        success : function( data )
        {
          alert('Total: '+data);
          $("#i-valores-lancados").val( formatarBRSemSimbolo( data ) );
        }
      }
    );
    
*/

    $("#i-valores-lancados").val(formatarBRSemSimbolo(total));
      totalreceber =  $("#i-valores-lancados").val();
      $("#i-total-apurado-locador").val( formatarBRSemSimbolo(totalreceber) );
      $("#i-valores-lancados").val( formatarBRSemSimbolo(totalreceber) );
  //    $("#i-total-apurado").val( formatarBRSemSimbolo(totalreceber) );
      $("#i-total-dinheiro-locador").val( formatarBRSemSimbolo(totalreceber) );
      $("#i-div-dados-repassar").show();
  }

  function apagarLancamento( id )
  {
    url = "{{route('repasse.item.delete')}}/"+id;

    $.ajax(
      {
        url     : url,
        type    : 'get',
        dataType: 'Json',
        async   : false,
        success : function( data )
        {
          alert('Registro apagado');
          recalcularRepasse();
        },
        erro: function()
        {
          alert( "erro ao excluir! Não excluído!");
          return false;
        }
      }
    );
    return true;
  }

  $("#modalresumoparcela").hide();
  //$('#i-div-recebimento').hide();

//  geraTMP();


  function carregarTable( data )
  {

        linha = "";
        $("#i-tlblf-resumo>tbody").empty();
        var chave = '';
        total=0;
        for( nI=0;nI < data.length;nI++)
        {
          var datavencimento  = moment( data[nI].IMB_PAG_DATAVENCIMENTO).format('DD/MM/YYYY');
          var nomelocador     = data[nI].IMB_CLT_NOMELOCADOR;
          var idlocador       = data[nI].IMB_CLT_ID;

          //console.log( data[nI].IMB_CLT_NOMELOCADOR);
          $("#i-lbl-header-modalresumoparcelas").html('Locatário: '+$("#i-locatario").val() );

          if ( idlocador === null )
          {
            var idlocador = 0;
          }

          valorlancamento = parseFloat(data[nI].IMB_LCF_VALOR);

          if(data[nI].IMB_LCF_LOCADORCREDEB == 'D')
            total = total - valorlancamento
          else
          if(data[nI].IMB_LCF_LOCADORCREDEB == 'C')
            total = total + valorlancamento;

          var inctax = data[nI].IMB_LCF_INCTAX;
          if( inctax == 'S') 
                inctax='<i class="fa fa-check" aria-hidden="true"></i>'
          else  
              inctax = '-';
          

          if( data[nI].IMB_TBE_ID == 1 && data[nI].IMB_LCF_LIBERADOREPASSE=='N' )
          {
            alert('Não liberado para repasse! Possivelmente não é aluguel garantido e o locatário ainda não realizou o pagamento!');
            $("#i-tlblf-resumo>tbody").empty();
//            window.close();
          }
        

          recebido = 'Não Recebido';
          if( data[nI].RECEBIDO == 'S')
            recebido = 'RECEBIDO';
          //alert( data[nI].IMB_TBE_ID);
          var nomelocador = data[nI].NOMELOCADOR;
          if( nomelocador === null ) nomelocador='-';
          observacao =  data[nI].IMB_LCF_OBSERVACAO;
          if( observacao === null ) observacao = '-';
          linha = '<tr>'+
                    '<td style="text-align:center" valign="center"> '+
                      '<a href=javascript:alterarLancamento('+data[nI].IMB_PAG_ID+','+data[nI].IMB_TBE_ID+') class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"></span></a> '+
                      '<a href=javascript:apagarLancamento('+data[nI].IMB_PAG_ID+') class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a> '+
                    '</td> '+
                    '<td class="td-center escondido">'+data[nI].IMB_LCF_ID+'</td>'+
                    '<td class="td-center">'+data[nI].IMB_TBE_ID+'</td>' +
                    '<td class="td-center">'+data[nI].IMB_TBE_NOME+'</td>' +
                    '<td class="td-rigth">'+formatarBRSemSimbolo(valorlancamento)+' </td>' +
                    '<td class="td-center">'+data[nI].IMB_LCF_LOCATARIOCREDEB+'</td>' +
                    '<td class="td-center">'+data[nI].IMB_LCF_LOCADORCREDEB+'</td>' +
                    '<td class="td-center">'+datavencimento+'</td>' +
                    '<td class="td-center">'+nomelocador+'</td>' +
                    '<td class="td-center">'+observacao+'</td>'+
                    '<td class="td-center">'+inctax+'</td>'+
                    '<td class="escondido">'+data[nI].TMP_REC_ID+'</td>'+
                    '<td class="escondido">N</td>'+
                    '<td class="escondido">'+idlocador+'</td>'+
                    '<td >'+recebido+'</td>'+
                  '</tr>';
          $("#i-tlblf-resumo").append( linha );

        }

        totalizar(total);

        $("#i-data-base").val( $("#i-data-rec").val() );
        $("#modalresumoparcela").modal('show');
//        $('#i-div-recebimento').show();


  }

  function recalcularRepasse()
  {
    var idcontrato = $("#IMB_CTR_ID").val();
    var idimovel = $("#IMB_IMV_ID").val();
    datavencimento= $("#i-data-vencimento-rec").val();
    datavencimento= moment(datavencimento ).format('YYYY-MM-DD')
    datapagamento = $("#i-data-rec").val();
    datapagamento= moment(datapagamento ).format('YYYY-MM-DD');

    var url = "{{route('repasse.recalcular')}}/"+idcontrato+'/'+idimovel+'/'+datavencimento+'/'+datapagamento;

    $.ajax(
    {
      url     : url,
      type    : 'get',
      dataType:'Json',
      async   : false,
      success   : function( data )
      {
        //console.log( data);
        carregarTable( data );
        totalizar(total);
      },
      error     : function()
      {
        alert('erro!');
      }
    });
  }

  function alterarLancamento( id, tbe )
  {
    if( tbe != 6 )
    {
      alert('Alteração só permitida para taxa administrativa');
      return false;
    }
    $("#i-tmp-rec-id").val( id );
    $("#i-novo-valor-lancamento").val(0);
    $("#modalfixarvalorrec").modal( 'show');
    $("#modalresumoparcela").modal('hide');
  }

function sairAlteracao()
{
  $("#modalresumoparcela").modal('show');
  $("#modalfixarvalorrec").modal( 'hide');

}

function confirmarFixarLancamento()
  {

    var dados =
    {
      TMP_REC_ID      : $("#i-tmp-rec-id").val(),
      IMB_LCF_VALOR   : parseFloat(realToDolar($("#i-novo-valor-lancamento").val()))
    }

    
    var url = "{{route('repasse.fixarlancamento')}}";

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
        data:dados,
        async:false,
        success:function()
        {
          recalcular();  
          $("#modalfixarvalorrec").modal('hide');
          $("#modalresumoparcela").modal('show');

        },
        error:function()
        {
          alert('erro');
        }
      }
    )




  }

  function novoPagamento()
  {
    $("#modalbuscaltctr-rep").modal('show');
    

  }
  

</script>




@endpush
