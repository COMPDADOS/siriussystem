<div class="modal fade" id="modalboletoscontrato" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:90%;">
    <div class="modal-content">
      <div class="modal-body">
        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption">
              <i class="fa fa-gift"></i>Boletos Emitidos para o Contrato
            </div>
          </div>
          @include('layout.modalenviandoemail')

          <div class="portlet-body form">

            <div class="row">
              <input type="hidden" id="IMB_CTR_ID-BOLETO">
              <div class="col-md-12">
                <table  id="tblboletos" class="table" >
                  <thead>
                    <tr >
                        <th width="10%" style="text-align:center"> Vencimento Original </th>
                        <th width="10%" style="text-align:center"> Data de Vencimento </th>
                        <th width="10%" style="text-align:center"> Data de Pagamento </th>
                      <th width="10%" style="text-align:center"> Valor </th>
                      <th width="10%" style="text-align:center"> Situação </th>
                      <th width="15%" style="text-align:center"></th>
                      <th width="35%" style="text-align:center"> Ações </th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-3 div-left" id="div-boletoproximovencimento">
              <a class="btn btn-success" href="javascript:gerarProximoVencimento()">Gerar Boleto para o Próximo Vencimento</a>
            </div>
            <button type="button" class="btn btn-primary" data-dismiss="modal">sair</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="alteracaovencimento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <div class="caption">
              <i class="fa fa-gift"></i>Reprogramação do Boleto
            </div>
          </div>

          <div class="portlet-body form">
            <div class="row">
              <div class="col-md-12">
                <div class="col-md-3">
                    <label class="control-label">Vencimento Original
                      <input class="form-control" type="date" id="IMB_CGR_DATAVENCIMENTO" readonly>
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
                <div class="col-md-4"><input class="check" id="i-pontualidade" type="checkbox">Manter Desconto Pontualididade</div>
                <div class="col-md-4"></div>
                <div class="col-md-2"><button class="btn form-control btn-primary" onClick="reprogramar()">Gerar</button></div>
                <div class="col-md-2"><button class="btn form-control btn-danger" data-dismiss="modal">Cancelar</button></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@include('layout.modalboletosms')
@include('layout.modalmensagemwhatsapp')

@push('script')

<script>
  $(document).ready(function()
  {
    cargaBoletos();

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

    $('#preloader').bind('ajaxStart', function()
    {
      $(this).show();
    }).bind('ajaxStop', function(){
        $(this).hide();
    });    


  });

function cargaBoletos()
{
  if( $("#IMB_CTR_ID-BOLETO").val() != '' )
  {

    url = "{{route('cobranca.cargaboletoscontrato')}}/"+$("#IMB_CTR_ID-BOLETO").val();
    $("#IMB_CTR_ID-REPR").val( $("#IMB_CTR_ID-BOLETO").val());
    console.log( url );

    $("#preloader").show();


    $.ajax(
      {
        url   : url,
        dataType: 'json',
        type:'get',
        success:function( data )
        {
          linha = "";
          $("#tblboletos>tbody").empty();
          for( nI=0;nI < data.length;nI++)
          {
            var valor = parseFloat( data[nI].IMB_CGR_VALOR );
            valor = formatarBRSemSimbolo( valor );
            var status='-';

            var classe='black-12-bold';

            var situacao = 'aberto';
            status = 'Enviar Banco';
            var classestatus = '';
            if( data[nI].IMB_CGR_ENTRADACONFIRMADA == 'S')
            {
              status='Liberado ao Locatário';
              classestatus='liberado';
            }
            if( data[nI].IMB_CGR_ENTRADACONFIRMADA == 'N')
            {
              status='Rejeitado';
              classestatus='rejeitado';
            }

            if( data[nI].IMB_CGR_DATABAIXA != null )
            {
              situacao='Quitado';
              classe="Quitado";
            };
            var datapagamento = data[nI].IMB_CGR_DATABAIXA;
            if( datapagamento === null )
            {
              datapagamento = '';
              classe='atrasado';
            }
            else
              datapagamento = moment( datapagamento).format('DD/MM/YYYY');
              if( data[nI].IMB_CGR_DTHINATIVO != null )
            {
              classe="Cancelado";
              situacao='Cancelado';
            }



            //DEPOIS VOU PRECISAR DO NUMERO DO CONTRATO

            linha =
              '<tr class="'+classe+'">'+
                '   <td style="text-align:center"><b>'+moment(data[nI].IMB_CGR_VENCIMENTOORIGINAL).format('DD/MM/YYYY')+'</b></td>'+
                '   <td style="text-align:center">'+moment(data[nI].IMB_CGR_DATAVENCIMENTO).format('DD/MM/YYYY')+'</td>'+
                '   <td style="text-align:center">'+datapagamento+'</td>'+
                '   <td style="text-align:center">R$ '+valor+'</td>'+


                '   <td style="text-align:center">'+situacao+'</td>'+
                '   <td style="text-align:center" class="'+classestatus+'">'+status+'</td>'+
                        '   <td style="text-align:center"> '+
                        '<a  class="btn btn btn-primary" href=javascript:imprimirBoleto('+data[nI].IMB_CGR_ID+',\''+
                            data[nI].FIN_CCI_BANCONUMERO+'\',"N") title="Imprimir"><i class="fa fa-print" aria-hidden="true"></i></a>'+
                            '<a  class="btn btn btn-primary" href=javascript:modalEmail('+data[nI].IMB_CGR_ID+','+
                            data[nI].FIN_CCI_BANCONUMERO+',"S") title="Enviar por email"><i class="fa fa-envelope" aria-hidden="true"></i></a>'+
                            '<a  class="btn btn btn-success" href=javascript:alterarBoleto('+data[nI].IMB_CGR_ID+','+
                            data[nI].FIN_CCI_BANCONUMERO+',"S") title="Alterar o boleto"><i class="fa fa-pencil" aria-hidden="true"></i></a>'+
                            '<a  class="btn btn btn-danger" href=javascript:inativarBoleto('+data[nI].IMB_CGR_ID+','+
                            data[nI].FIN_CCI_BANCONUMERO+',"S") title="Inativar o boleto"><i class="fa fa-trash" aria-hidden="true"></i></a>'+
                            '<a  class="btn btn btn-warning" href=javascript:boletoSms('+data[nI].IMB_CGR_ID+','+
                            data[nI].FIN_CCI_BANCONUMERO+',"S") title="Enviar linha digitável por SMS"><i class="fas fa-sms"></i></a>'+
                            '<a  class="btn btn btn-secondary" href=javascript:boletoWhatsApp('+data[nI].IMB_CGR_ID+','+
                            data[nI].FIN_CCI_BANCONUMERO+',"S") title="Enviar Link do Boleto por Whats"><i class="fa fa-whatsapp" aria-hidden="true" style="color:green"></i></a>'+
                '   </td>'+
              '</tr>';

              $("#tblboletos").append( linha );

          }
        }
        ,
          complete:function()
          {
            $("#preloader").hide();

          }
      }
    )
  }

}

function imprimirBoleto( id,banco )
{

  debugger;

    if( parseInt(banco) == 33 )
        window.open("{{route('boleto.santander')}}/"+id+'/N/X', '_blank');
    if(  parseInt(banco)  == 237 )
        window.open("{{route('boleto.237')}}/"+id+'/N/X', '_blank');
    if( parseInt(banco) == 341 )
        window.open("{{route('boleto.itau')}}/"+id+'/N/X', '_blank');
    if(  parseInt(banco)  == 756 )
        window.open("{{route('boleto.756')}}/"+id+'/N/X', '_blank');

    if(  parseInt(banco)  == 084 )
        window.open("{{route('boleto.084')}}/"+id+'/N/X', '_blank');

    if(  parseInt(banco)  == 77 )
        window.open("{{route('boleto.077')}}/"+id+'/N/X', '_blank');

    if(  parseInt(banco) == 1 )
        window.open("{{route('boleto.001')}}/"+id+'/N/X', '_blank');

    if(  parseInt(banco) == 748 )
        window.open("{{route('boleto.748')}}/"+id+'/N/X', '_blank');


}


function modalEmail(id,banco)
{
  //estes campos estão em modalemail.blade
  $("#i-imb_cgr_id_modalemail").val( id );
  $("#i-banco_modalemail").val(  banco );

  var url = "{{route('cobrancabancaria.cargaboletoheaderperm')}}/"+id;
  $.ajax(
    {
      url:url,
      dataType:'json',
      type:'get',
      async:false,
      success:function( data )
      {
        var contrato = data.IMB_CTR_ID;
        var url = "{{route('contrato.emaillocatarioprincipal')}}/"+contrato;
        $.ajax(
          {
            url : url,
            dataType:'json',
            type:'get',
            async:false,
            success:function( data )
            {
              $("#i-email-modal").val( data);
              $("#modalemail").modal('show');
            }
          }
        )
      }
    }
  )

}
function enviarBoletoPorEmail( )
{
  if( $("#i-email-modal").val() == '' )
  {
    alert('Informe um email');
    return false;

  }

  $("#modalemail").modal('hide');

  $("#modalenviandoemail").show();

  var id = $("#i-imb_cgr_id_modalemail").val();
  var banco =  $("#i-banco_modalemail").val();
  debugger;

  var url = '';
  var erro = 1;
  //debugger;
  $("#preloader").show();

  if( banco ==  1 )
  {
     url ="{{route('boleto.001')}}/"+id+'/S/'+$("#i-email-modal").val();
     $.ajax(
       {
         url    : url,
         dataType: 'json',
         type:'get',
         async:false,
         beforeSend: function()
         {
        },
         success:function()
         {
          $("#preloader").hide();
          alert('Email enviado!');
          $("#modalenviandoemail").hide();
          erro=0;
         },
         error:function()
         {
         }
       }
     );
  }
  if( banco == 33 )
  {
     url ="{{route('boleto.santander')}}/"+id+'/S/'+$("#i-email-modal").val();
     console.log('ATENCAO: '+url );
     $.ajax(
       {
         url    : url,
         dataType: 'json',
         type:'get',
         async:false,
         success:function()
         {
          alert('Email enviado!');
          $("#modalenviandoemail").hide();
          erro=0;


         },
         error:function(request, status, error)
         {
            alert(request.responseText);
         }
       }
     );
  }
  if( banco == 748 )
  {
     url ="{{route('boleto.748')}}/"+id+'/S/'+$("#i-email-modal").val();
     $.ajax(
       {
         url    : url,
         dataType: 'json',
         type:'get',
         async:false,
         success:function()
         {
          alert('Email enviado!');
          $("#modalenviandoemail").hide();
          erro=0;


         },
         error:function(request, status, error)
         {
            alert(request.responseText);
         }
       }
     );
  }

  if( banco == 756 )
  {
     url ="{{route('boleto.756')}}/"+id+'/S/'+$("#i-email-modal").val();
     $.ajax(
       {
         url    : url,
         dataType: 'json',
         type:'get',
         async:false,
         success:function()
         {
          alert('Email enviado!');
          $("#modalenviandoemail").hide();
          erro=0;

         }
       }
     );
  }

  
  if( banco == 341 )
  {
     url ="{{route('boleto.itau')}}/"+id+'/S/'+$("#i-email-modal").val();
     $.ajax(
       {
         url    : url,
         dataType: 'json',
         type:'get',
         async:false,
         success:function()
         {
          alert('Email enviado!');
          $("#modalenviandoemail").hide();
          erro=0;

         }
       }
     );
  }
  if( banco == 84 )
  {
     url ="{{route('boleto.084')}}/"+id+'/S/'+$("#i-email-modal").val();
     $.ajax(
       {
         url    : url,
         dataType: 'json',
         type:'get',
         async:false,
         success:function()
         {
          alert('Email enviado!');
          $("#modalenviandoemail").hide();
          erro=0;

         }
       }
     );
  }

  if( banco == 237 )
  {
     url ="{{route('boleto.237')}}/"+id+'/S/'+$("#i-email-modal").val();
     $.ajax(
       {
         url    : url,
         dataType: 'json',
         type:'get',
         async:false,
         success:function()
         {
          alert('Email enviado!');
          $("#modalenviandoemail").hide();
          erro=0;

         }
       }
     );
  }

  $("#preloader").hide();

  if( erro == 1 )
    alert('Email não enviado. Verifique se o endereço de email está correto!');
  $("#modalenviandoemail").hide();

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
            cargaBoletos();
        }


    });

}

function alterarBoleto( id )
{
  var url = "{{route('cobrancabancaria.cargaboletoheaderperm')}}/"+id;
  $("#IMB_CGR_ID-REPR").val( id );

  $.ajax(
    { url : url,
      dataType: 'json',
      type:'get',
      success:function( data )
      {
        $("#IMB_CGR_DATAVENCIMENTO").val(  data.IMB_CGR_VENCIMENTOORIGINAL );
        $("#IMB_CGR_VALOR").val( formatarBRSemSimbolo( parseFloat( data.IMB_CGR_VALOR )));
        $("#IMB_CGR_IMOVEL").val( data.IMB_CGR_IMOVEL );
        $("#IMB_CTR_ID-REPR").val( data.IMB_CTR_ID );
        $("#i-novovencimento").val( moment( Date() ).format( 'YYYY-MM-DD') );
        $('#alteracaovencimento').modal('show');
        $("#i-multarep").val(0);
        $("#i-multaret").val(0);
        $("#i-jurosrep").val(0);
        $("#i-jurosret").val(0);
      }

    }
  )

}

function calcularMulta()
{
  var basemulta = $("#basemulta").val();
  var contrato = $("#IMB_CTR_ID-REPR").val();
  var vencimento = moment( $("#IMB_CGR_DATAVENCIMENTO").val()).format( 'YYYY-MM-DD');
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
    var vencimento = moment( $("#IMB_CGR_DATAVENCIMENTO").val()).format( 'YYYY-MM-DD');
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
  var url = "{{route('calcularbasesitemcobranca')}}/"+id;
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

  var url = "{{route('cobranca.reprogramar')}}";

  var dados =
  {
    IMB_CGR_ID:$("#IMB_CGR_ID-REPR").val(),
    multarep: realToDolar( $("#i-multarep").val()),
    multaret: realToDolar( $("#i-multaret").val()),
    jurosrep:  realToDolar( $("#i-jurosrep").val()),
    jurosret:  realToDolar( $("#i-jurosret").val()),
    datavencimento: moment( $("#i-novovencimento").val()).format('YYYY/MM/DD'),
    valortotal:  realToDolar($("#i-total").val()),
    pontualidade:  $("#i-pontualidade").prop('checked') ? 'S' : 'N',
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
        debugger;
        window.location = "{{route('cobrancabancaria.cobrancagerada')}}";
      }
    }
  )



}
function boletoSms( id )
{

  $("#modalsms").modal('show');
  $("#i-titulo-modal-sms").html( 'Envio de Linha Digitável por SMS');

  var url = "{{route('cobrancabancaria.cargaboletoheaderperm')}}/"+id;

  $.ajax( 
    {
      url:url,
      dataType:'json',
      type:'get',
      async:false,
      success:function( data )
      {
        var linha = data.FIN_CCI_LINHADIGITAVEL;
//        linha = linha.split('.').join('');
        linha = linha.split(' ').join('.');
        
        alert(linha);
        $("#i-sms-conteudo").val( linha );
      }
    }
  )

}


function gerarProximoVencimento( )
{

  if ( ! confirm("Antes de prosseguir, verifique na lista acima se realmente "+
    "não há boleto gerado para o próximo vencimento! Certeza que ainda deseja gerar ?"))
    return false;


  var idcontrato = $("#IMB_CTR_ID-REPR").val();

  var url = "{{route('contrato.findfull')}}/"+idcontrato;
  console.log( url );

  $.getJSON( url, function( data )
  {


        //ajustando o ultimo dia do mes, tanto na inicial, como na final
        var nAno = moment(data.IMB_CTR_VENCIMENTOLOCATARIO).format('YYYY');
        var nMes = moment(data.IMB_CTR_VENCIMENTOLOCATARIO).format('MM');

    var nUltimoDia = ultimoDiaMes( nMes, nAno );

    var url = "{{route('cobranca.gerar')}}";


    var dados =
    {
        diainicial : 1,
        diafinal : nUltimoDia,
        mesinicial : nMes,
        mesfinal : nMes,
        anoinicial :nAno,
        anofinal : nAno,
        FIN_CCX_ID: data.FIN_CCR_ID_COBRANCA,
        IMB_CTR_ID: idcontrato,

    }

    console.log( dados );

    $.ajax(
    {
        url         : url,
        dataType    : 'json',
        type        : 'get',
        data        : dados,

        beforeSend: function()
        {
            alert('O sistema irá processar, e ao finalizar você será informado. Pressione OK para continuar');
        },
        success:function( data )
        {
            alert('Cobrança Gerada com Sucesso');
            window.location="{{route('cobrancabancaria.cobrancagerada')}}";

        },
        error:function()
        {
            alert( 'erro na geração');
        }
    });
  });



}


function boletoWhatsApp( id,banco )
{

  $("#IMB_TLF_DDI").val('');
  $("#IMB_TLF_DDD").val(''); 
  $("#IMB_TLF_NUMERO").val('');  
  $("#IMB_TLF_TIPOTELEFONE").val('');  

//alert( id );

    url = "{{route('boleto.pegartellocatarios')}}/"+id;
  //  console.log( url );

    $.ajax(
      {
        url:url,
        dataType:'json',
        type:'get',
        success : function( data )
        {
          linha = "";
          $("#tlbfonewsmsg>tbody").empty();
          for( nI=0;nI < data.length;nI++)
          {
            $("#i-nomecliente-telefone").html( data[nI].IMB_CLT_NOME) ;
            $("#IMB_CTR_ID_MSGWS").val( data[nI].IMB_CTR_ID );
            $("#IMB_CLT_ID_MSGWS").val(data[nI].IMB_CLT_ID ); 

            var ddi = '55';
            if( data[nI].IMB_TLF_DDI != null && data[nI].IMB_TLF_DDI != '')
              ddi = data[nI].IMB_TLF_DDI;
            linha = 
              '<tr>'+
                  '<td >'+ddi+'</td>'+
                  '<td >'+data[nI].IMB_TLF_DDD+'</td>'+
                    '<td >'+data[nI].IMB_TLF_NUMERO+'</td>' +
                    '<td >'+data[nI].IMB_CLT_NOME+'</td>' +
                    '<td ><button title="Enviar Mensagem" class="btn btn-primary" onClick="EnviarWsMsg( '+
                    data[nI].IMB_TLF_DDI+','+data[nI].IMB_TLF_DDD+','+data[nI].IMB_TLF_NUMERO+','+data[nI].IMB_CTR_ID+','+data[nI].IMB_CLT_ID+
                    ')"><i class="fa fa-paper-plane" aria-hidden="true"></i></button></td>'+
                    '<td ><button title="Incluir novo telefone para o cadastro"  class="btn btn-primary" onClick="adicionarNovoFone( '+data[nI].IMB_CLT_ID+')"><i class="fa fa-plus" aria-hidden="true"></i></button></td>'+
              '</tr>';
            $("#tlbfonewsmsg").append( linha );
          }
          if( banco == 33 )
            var link= "{{route('boleto.santander')}}/"+id+'/N/X';

          if( banco == 237 )
            var link=  "{{route('boleto.237')}}/"+id+'/N/X';
          if( banco == 341 )
            var link= "{{route('boleto.itau')}}/"+id+'/N/X';
          
          if( banco == 756 )
            var link=  "{{route('boleto.756')}}/"+id+'/N/X';

          if( banco == 84 )
            var link=  "{{route('boleto.084')}}/"+id+'/N/X';

          if( banco == 1 )
            var link= "{{route('boleto.001')}}/"+id+'/N/X';

          if( banco == 748 )
            var link= "{{route('boleto.748')}}/"+id+'/N/X';


            $("#modalmsgwhastapp").modal('show');
          $("#wsmsg-assunto").val( 'Segue seu boleto');
          $("#wsmsg-mensagem").val( 'Prezado cliente. Segue o link para que você possa pegar seu boleto de forma prática e segura. Link: '+
          link);

        }
      }
    )
     

}

function adicionarNovoFone( id )
    {
      debugger;
      $("#IMB_CLT_ID_MSGWS").val( id  );
      $("#IMB_TLF_DDI").val('55');
      $("#IMB_TLF_DDD").val(''); 
      $("#IMB_TLF_NUMERO").val('');  
      $("#IMB_TLF_TIPOTELEFONE").val('');  
      $("#div-novonumero").show();

    }


</script>

@endpush
