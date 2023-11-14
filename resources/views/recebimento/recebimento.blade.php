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

.evidencia-azul
{
  color:white;
  background-color:blue;
}

.backsuave
{
  background-color:#cccccc;
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

    @php
      app( 'App\Http\Controllers\ctrRecebimento')->limparTMP();
    @endphp

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
              <div class="col-md-4">
                <label class="label-control">Data Vencimento</label>
                <input type="date" class="form-control cardtitulo" id="i-data-vencimento-rec" readonly>
              </div>
              <div class="col-md-2">
                <label class="label-control">Tolerancia</label>
                <input type="text" class="form-control cardtitulo" id="i-tolerancia" readonly>
              </div>
              <div class="col-md-4">
                <label class="label-control">Data Limite</label>
                <input type="date" class="form-control cardtitulo" id="i-data-limite" readonly>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label class="label-control">Data de Recebimento</label>
                <input type="date" class="form-control cardtitulo" id="i-data-rec">
              </div>
              <div class="col-md-4">
                <button class="btn btn-success form-control" type="button" onClick="geraTMP()">Calcular</button>
                <button class="btn btn-danger form-control" type="button" onClick="avascript:window.close()">Cancelar</button>
              </div>

            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-2 div-center">
            <label class="control-label">Liberar Multa I
              <input class="form-check-input  form-control" type="checkbox" 
              id="id-liberarmultaI"  checked>
            </label>
              
          </div>
          <div class="col-md-2  div-center">
            <label class="control-label">Liberar  Multa II
              <input class="form-check-input  form-control" type="checkbox" 
                          id="id-liberarmultaII"  checked> 
            </label>
          </div>
  
          <div class="col-md-2  div-center">
            <label class="control-label">Liberar Juros
              <input class="form-check-input form-control " type="checkbox" 
                        id="id-liberarjuros"  checked>   
            </label>
                         
          </div>
          <div class="col-md-1  div-center">
              <a href="{{route('lancamento.index')}}?IMB_CTR_ID={{$id}}" target="_blank"><i class="btn btn-success fa fa-calculator" aria-hidden="true">Lançamentos</i></a>
          </div>
          
  
        </div>
      </div>      
    </div>
  </div>
</div>
@include( 'layout.resumoparcela')


<div class="modal fade" id="modalfixarvalorrec" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:60%;">
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
                            <button type="button" class="form-control btn btn-danger" data-dismiss="modal">sair</button>
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
    $("#i-div-btn-sim").hide()
    $("#i-div-btn-rec").show();
    $("#sirius-menu").click();

    $("#id-liberarmultaI").prop( 'checked',false );
    $("#id-liberarmultaII").prop( 'checked',false );
    $("#id-liberarjuros").prop( 'checked',false );

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

    contratoCarga()       ;
  

    $("#i-total-dinheiro").blur( function()
    {
      debugger;
      var nTotalApurado = realToDolar( $("#i-total-apurado").val() );
      var nTotalDinheiro = realToDolar( $("#i-total-dinheiro").val() );
      var nCheque =  parseFloat(nTotalApurado) - parseFloat(nTotalDinheiro);
//        console.log('cheque: '+nCheque );
      nTroco =  parseFloat(nTotalApurado) - 
                      ( parseFloat(nTotalDinheiro) +
                        parseFloat(nCheque) ) ;

      
    })

    debugger;
    $("#i-total-cheque").blur( function()
    {
      var nTotalApurado = realToDolar( $("#i-total-apurado").val() );
      var nTotalDinheiro = realToDolar( $("#i-total-dinheiro").val() );
      var nCheque = realToDolar( $("#i-total-cheque").val() );
      var nTroco =  parseFloat(nTotalApurado) - 
                      ( parseFloat(nTotalDinheiro) +
                        parseFloat(nCheque) ) ;
      
      if( nTroco != 0 )
      {
        $("#div-troco-futuro").show();
        if( nTroco > 0 ) 
        {
          $("#div-abater").show();
        }
        else
        if( nTroco < 0 )
        {
          $("#div-abater").hide();
        }
      }
      $("#i-troco").val(  formatarBRSemSimbolo( nTroco) );

    })

    $("#i-total-pix").blur( function()
    {
      var nTotalApurado = realToDolar( $("#i-total-apurado").val() );
      var nTotalDinheiro = realToDolar( $("#i-total-dinheiro").val() );
      var nCheque = realToDolar( $("#i-total-cheque").val() );
      var nPix = realToDolar( $("#i-total-pix").val() );


      var nTroco =  parseFloat(nTotalApurado) - 
                      ( parseFloat(nTotalDinheiro) +
                        parseFloat(nPix) +
                        parseFloat(nCheque) ) ;
      
      if( nTroco != 0 )
      {
        $("#div-troco-futuro").show();
        if( nTroco > 0 ) 
        {
          $("#div-abater").show();
        }
        else
        if( nTroco < 0 )
        {
          $("#div-abater").hide();
        }
      }
      $("#i-troco").val(  formatarBRSemSimbolo( nTroco) );

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
        /*
          if( data[0].IMB_CTR_SITUACAO == 'ATIVO' &&  
              data[0].IMB_CTR_VENCIMENTOLOCATARIO >  data[0].IMB_CTR_DATAREAJUSTE)
          {
            alert('Atenção! Reajuste vencido em '+moment(data[0].IMB_CTR_DATAREAJUSTE).format( 'DD-MM-YYYY'));
          }
          */
        var dDataLimite = adicionarDia( data[0].IMB_CTR_VENCIMENTOLOCATARIO, data[0].IMB_CTR_TOLERANCIA);
        $("#i-lbl-header-imovel").html('Contrato: '+data[0].IMB_CTR_REFERENCIA+' - Imóvel: '+
        data[0].ENDERECOCOMPLETO+'  -   Situação: '+data[0].IMB_CTR_SITUACAO);
        $("#i-locador").val( data[0].PROPRIETARIO);
        $("#i-locatario").val( data[0].IMB_CLT_NOME_LOCATARIO );
        $("#i-data-vencimento").val( data[0].IMB_CTR_VENCIMENTOLOCATARIO);
        $("#i-data-vencimento-rec").val( data[0].IMB_CTR_VENCIMENTOLOCATARIO);
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
            //geraTMP();
            //totalizar();

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
  }

  function confirmarRecebimento()
  {
    

    
  if ( $("#i-debito-futuro").prop( 'checked') &&  $("#i-abater").prop('checked') )
  {
    alert('Troco futuro e manter mês não pode estar os dois selecionados ao mesmo tempo');
    return false;
  }

    if($("#IMB_FORPAG-IDLOCATARIO").val() == '-1') 
    {
      alert('Informe a forma de pagamento');
      return false;
    }
    
    if($("#FIN_CCX_ID").val() == '-1') 
    {
      alert('Informe a Conta de Recebimento');
      return false;
    }

        
    $("#i-botoes-acao-conf-receber").hide();
    
    var nTotDin = parseFloat(realToDolar($("#i-total-dinheiro").val()));
    if ( isNaN( nTotDin) )
       nTotDin = 0;

    


    var nPix = realToDolar( $("#i-total-pix").val() );
    if ( isNaN( nPix) )
      nPix = 0;

    var nTotChe = parseFloat(realToDolar($("#i-total-cheque").val()));
    if ( isNaN( nTotChe) )
      nTotChe = 0;

    var nTroco = parseFloat(realToDolar($("#i-troco").val()));
    if ( isNaN( nTroco))
      nTroco = 0;

      abater = 'N';
      if( $("#i-abater").prop( "checked" ))
        abater = 'S';

    
      trocofuturo ='N';
      if( $("#i-troco-futuro").prop( "checked" ))
        trocofuturo = 'S';
    
        console.log('valor pix vai acessar a funcao');
        recibogerado = gerandoReciboLocatario(
      "i-tlblf-resumo",
      moment( $("#i-data-base").val()).format( 'YYYY-MM-DD'), 
      $("#IMB_FORPAG-IDLOCATARIO").val(), 
      $("#FIN_CCX_ID").val(), 
      moment( $("#i-data-base").val()).format( 'YYYY-MM-DD'),  
      $("#IMB_CTR_ID").val(), 
      nTotDin,
      nTotChe,
      nTroco,
      trocofuturo,
      "{{csrf_token()}}",
      parseFloat(realToDolar($("#i-total-apurado").val())),
      moment( $("#i-data-vencimento-rec").val() ).format( 'YYYY-MM-DD') ,
      'RECMES',
      abater,
      nPix

    );

    if( confirm( "Processo concluído. Deseja emitir o recibo?") )
    {  
      window.open( "{{route('recibolocatario.imprimir')}}/"+recibogerado+'/S','_blank');

    }

  }
  
    

  function geraTMP()
  {   


    var idcontrato = $("#IMB_CTR_ID").val();
    datavencimento= $("#i-data-vencimento-rec").val();
    datavencimento= moment(datavencimento ).format('YYYY-MM-DD')
    datapagamento = $("#i-data-rec").val();
    datapagamento= moment(datapagamento ).format('YYYY-MM-DD');
    var liberarmulta1 =$( '#id-liberarmultaI' ).prop( "checked" )   ? 'S' : 'N';
    var liberarmulta2 =$( '#id-liberarmultaII' ).prop( "checked" )   ? 'S' : 'N';
    var liberarjuros =$( '#id-liberarjuros' ).prop( "checked" )   ? 'S' : 'N';


    var url = "{{route('recebimento.calcular')}}/"+
        idcontrato+'/'+datavencimento+'/'+datapagamento+'/'+
        liberarmulta1+'/'+liberarmulta2+'/'+liberarjuros+'/x';

    console.log('parametros '+idcontrato+'/'+datavencimento+'/'+datapagamento);

    $.ajax(
    {
      url     : url,
      type    : 'get',
      dataType:'Json',
      async   : false,
      success   : function( data )
      {
        console.log( data );
        carregarTabela( data );
      },
      error     : function()
      {
        alert('erro!');
      }
    });

  }
  
  //funcao disparada pela template resumoparcela.blade
  function recalcular()
  {
    $("#i-data-rec").val( $("#i-data-base").val() );
    geraTMP();


  }

  function totalizar()
  {
    url = "{{ route('recebimento.totalizarlancamentos')}}";
    $.ajax(
      {
        url     : url,
        type    : 'get',
        dataType: 'json',
        async: false,
        success : function( data )
        {
          $("#i-valores-lancados").val( formatarBRSemSimbolo( data ) );
        }
      }
    );

    totalreceber =  $("#i-valores-lancados").val();
    $("#i-totalareceber").html( formatarBRSemSimbolo(totalreceber) );
    $("#i-valores-lancados").val( formatarBRSemSimbolo(totalreceber) );
    $("#i-total-apurado").val( formatarBRSemSimbolo(totalreceber) );
    $("#i-total-dinheiro").val( formatarBRSemSimbolo(totalreceber) );
    $("#i-div-dados-receber").show();

  }

  $("#modalresumoparcela").hide();
  //$('#i-div-recebimento').hide();

//  geraTMP();

function apagarLancamento( id )
  {
    url = "{{route('recebimento.item.delete')}}/"+id;
    console.log( url );

    $.ajax(
      {
        url     : url,
        type    : 'get',
        dataType: 'Json',
        async   : false,
        success : function( data )
        {
          alert('Registro apagado');
          recalcularRecebimento();
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

  function carregarTabela( data )
  {
    linha = "";
        $("#i-tlblf-resumo>tbody").empty();
    var chave = '';
    for( nI=0;nI < data.length;nI++)
    {
      var datavencimento  = moment( data[nI].IMB_REC_DATAVENCIMENTO).format('DD/MM/YYYY');
      var nomelocador     = data[nI].IMB_CLT_NOMELOCADOR;
      var idlocador = data[nI].IMB_CLT_ID;
      
      $("#i-lbl-header-modalresumoparcelas").html('Locatário: '+$("#i-locatario").val() );

      if ( nomelocador == null ) 
      {
        nomelocador = '-';
        var idlocador = 0;
      }
      
      valorlancamento = parseFloat(data[nI].IMB_LCF_VALOR);

      linha = '<tr>'+ 
                '<td style="text-align:center" valign="center"> '+
                  '<a href=javascript:alterarLancamento('+data[nI].IMB_REC_ID+') class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"></span></a> '+
                  '<a href=javascript:apagarLancamento('+data[nI].IMB_REC_ID+') class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a> '+
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
                '<td class="escondido">'+data[nI].TMP_REC_ID+'</td>'+
                '<td class="escondido">N</td>'+
                '<td class="escondido">'+idlocador+'</td>'+
              '</tr>';
      $("#i-tlblf-resumo").append( linha );
    }           

    totalizar();
    cargaConta();
    cargaFormaRecebimento();

    $("#i-data-base").val( $("#i-data-rec").val() );
    $("#modalresumoparcela").modal('show');
//    recalcularRecebimento();
//        $('#i-div-recebimento').show();


  }

  function recalcularRecebimento()
  {
    var idcontrato = $("#IMB_CTR_ID").val();
    var idimovel = $("#IMB_IMV_ID").val();
    datavencimento= $("#i-data-vencimento-rec").val();
    datavencimento= moment(datavencimento ).format('YYYY-MM-DD')
    datapagamento = $("#i-data-rec").val();
    datapagamento= moment(datapagamento ).format('YYYY-MM-DD');

    var url = "{{route('recebimento.recalcular')}}/"+idcontrato+'/'+idimovel+'/'+datavencimento+'/'+datapagamento;

    $.ajax(
    {
      url     : url,
      type    : 'get',
      dataType:'Json',
      async   : false,
      success   : function( data )
      {   
        carregarTabela( data );
//        totalizar();
      },
      error     : function()
      {
        alert('erro!');
      }
    });
  }  

  function alterarLancamento( id )
  {
    $("#i-tmp-rec-id").val( id );
    $("#i-novo-valor-lancamento").val(0);
    $("#modalfixarvalorrec").modal( 'show');
  }


  function confirmarFixarLancamento()
  {

    var dados =
    {
      TMP_REC_ID      : $("#i-tmp-rec-id").val(),
      IMB_LCF_VALOR   : parseFloat(realToDolar($("#i-novo-valor-lancamento").val()))
    }

    
    var url = "{{route('recebimento.fixarlancamento')}}";

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
        },
        error:function()
        {
          alert('erro');
        }
      }
    )




  }



  

</script>




@endpush