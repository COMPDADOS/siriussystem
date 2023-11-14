<div class="modal fade" id="modalboletosvencendo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:90%;">
    <div class="modal-content">
      <div class="modal-body">
        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption">
              <i class="fa fa-gift"></i><span id="i-boletos-title">Boletos Emitidos para o Contrato</span> 
            </div>
          </div>

          <div class="portlet-body form">

            <div class="row">
              @php

                $req = app('App\Http\Controllers\ctrRotinas')->instanciarRequest();
                $req->semjson = 'S';
                $bvhs=app('App\Http\Controllers\ctrCobrancaGerada')->boletosVencendoCarga( $req);
              
              @endphp
              <input type="hidden" id="IMB_CTR_ID-BOLETO">
              <div class="col-md-12">
                <table  id="tblboletos-vencendo" class="table table-hover" >
                  <thead>
                    <tr >
                        <th >Pasta</th>
                        <th >Locatário</th>
                        <th  style="text-align:center"> Vencto Original </th>
                        <th  style="text-align:center"> Dt Vencimento </th>
                        <th  style="text-align:center"> Valor </th>
                        <th  style="text-align:center"> Situação </th>
                        <th  style="text-align:center"></th>
                        <th  style="text-align:center"> Ações </th>
                    </tr>
                  </thead>
                  @foreach( $bvhs as $bv)
                    @php
                      $classe='black-12-bold';
                      $situacao = 'aberto';
                      $status = 'Enviar Banco';
                      $classestatus = '';
                      if( $bv->IMB_CGR_ENTRADACONFIRMADA == 'S')
                      {
                        $status='Liberado ao Locatário';
                        $classestatus='liberado';
                      }
                      if( $bv->IMB_CGR_ENTRADACONFIRMADA == 'N')
                      {
                        $status='Rejeitado';
                        $classestatus='rejeitado';
                      }
      
                      if( $bv->IMB_CGR_DATABAIXA != null )
                      {
                        $situacao='Quitado';
                        $classe="Quitado";
                      };
                      $datapagamento = $bv->IMB_CGR_DATABAIXA;
                      if( $datapagamento === null )
                      {
                        $datapagamento = '';
                        $classe='atrasado';
                      }
                      else
                        $datapagamento = date( 'd/m/Y', strtotime( $datapagamento));
                      
                        if( $bv->IMB_CGR_DTHINATIVO <> null )
                        {
                          $classe="Cancelado";
                          $situacao='Cancelado';
                        }
                    @endphp
                    <tr>
                      <td class="div-center">{{$bv->IMB_CTR_REFERENCIA}}</td>
                      <td >{{$bv->LOCATARIO}}</td>
                      <td class="div-center">{{date( 'd/m/Y', strtotime($bv->IMB_CGR_VENCIMENTOORIGINAL))}}</td>
                      <td class="div-center">{{date( 'd/m/Y', strtotime($bv->IMB_CGR_DATAVENCIMENTO))}}</td>
                      <td class="div-center">{{number_format( $bv->IMB_CGR_VALOR,2,',','.')}}</td>
                      <td class="div-center {{$classestatus}}">{{$status}}</td>
                      <td class="div-center">
                        <a href="javascript:imprimirBoletoVencendo( {{$bv->IMB_CGR_ID}},{{$bv->FIN_CCI_BANCONUMERO}},'N' )" title="Imprimir"><i class="fa fa-print" aria-hidden="true"></i></a>
                        <a  class="btn btn btn-primary" href="javascript:modalEmailVencendo({{$bv->IMB_CGR_ID}},{{$bv->FIN_CCI_BANCONUMERO}},'S' )" title="Enviar por email"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                        <a  class="btn btn btn-warning" href="javascript:boletoSmsVen({{$bv->IMB_CGR_ID}},{{$bv->FIN_CCI_BANCONUMERO}},'S')" title="Enviar linha digitável por SMS"><i class="fas fa-sms"></i></a>
                    </td>                      
                  @endforeach
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row"><hr></div>
            <div class="col-md-12">
              <div class="col-md-4">

              </div>
              <div class="col-md-4 div-center">
                <button class="form-control btn btn-primary" onClick="enviarTodosWs()">Enviar por Whatsapp para todos acima</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="row">
            <button type="button" class="btn btn-primary" data-dismiss="modal">sair</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@include('layout.modalemail')
@include('layout.modalboletovencendosms')

@push('script')

<script>

function cargaBoletosVecendo()
{
  $("#i-boletos-title").html('Boletos vencendo hoje');
    url = "{{route('cobrancabancaria.boletosvencendocarga')}}";
    console.log( url );
    $("#modalboletosvencendo").modal('show');
    return false;
    
    $.ajax(
      {
        url   : url,
        dataType: 'json',
        type:'get',
        async:false,
        success:function( data )
        {
          console.log(data);
          debugger;
          linha = "";
          $("#tblboletos-vencendo>tbody").empty();
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
              '<tr clas"'+classe+'">'+
              '   <td style="text-align:center"><b>'+data[nI].IMB_CTR_REFERENCIA+'</b></td>'+
              '   <td style="text-align:center"><b>'+data[nI].LOCATARIO+'</b></td>'+
                '   <td style="text-align:center"><b>'+moment(data[nI].IMB_CGR_VENCIMENTOORIGINAL).format('DD/MM/YYYY')+'</b></td>'+
                '   <td style="text-align:center">'+moment(data[nI].IMB_CGR_DATAVENCIMENTO).format('DD/MM/YYYY')+'</td>'+
                
                '   <td style="text-align:center">R$ '+valor+'</td>'+


                '   <td style="text-align:center">'+situacao+'</td>'+
                '   <td style="text-align:center" class="'+classestatus+'">'+status+'</td>'+
                        '   <td style="text-align:center"> '+
                        '<a  class="btn btn btn-primary" href=javascript:imprimirBoletoVencendo('+data[nI].IMB_CGR_ID+','+
                            data[nI].FIN_CCI_BANCONUMERO+',"N") title="Imprimir"><i class="fa fa-print" aria-hidden="true"></i></a>'+
                            '<a  class="btn btn btn-primary" href=javascript:modalEmailVencendo('+data[nI].IMB_CGR_ID+','+
                            data[nI].FIN_CCI_BANCONUMERO+',"S") title="Enviar por email"><i class="fa fa-envelope" aria-hidden="true"></i></a>'+
                            '<a  class="btn btn btn-warning" href=javascript:boletoSmsVen('+data[nI].IMB_CGR_ID+','+
                            data[nI].FIN_CCI_BANCONUMERO+',"S") title="Enviar linha digitável por SMS"><i class="fas fa-sms"></i></a>'+
                                                        
                 '   </td>'+
              '</tr>';

              $("#tblboletos-vencendo").append( linha );

          }
          $("#modalboletosvencendo").modal('show');
        },
        error:function()
        {
          alert('error');
        }
      }
    )
  
}

function imprimirBoletoVencendo( id,banco )
{


    if( banco == 33 )
        window.open("{{route('boleto.santander')}}/"+id+'/N/X', '_blank');
    if( banco == 237 )
        window.open("{{route('boleto.237')}}/"+id+'/N/X', '_blank');
    if( banco == 341 )
        window.open("{{route('boleto.itau')}}/"+id+'/N/X', '_blank');
    if( banco == 756 )
        window.open("{{route('boleto.756')}}/"+id+'/N/X', '_blank');

    if( banco == 84 )
        window.open("{{route('boleto.084')}}/"+id+'/N/X', '_blank');

    if( banco == 1 )
        window.open("{{route('boleto.001')}}/"+id+'/N/X', '_blank');

    if( banco == 748 )
        window.open("{{route('boleto.748')}}/"+id+'/N/X', '_blank');


}
function modalEmailVencendo(id,banco)
{
  //estes campos estão em modalemail.blade
  $("#i-imb_cgr_id_modalemail").val( id );
  $("#i-banco_modalemail").val(  banco );
  $("#modalboletosvencendo").modal('hide');
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
        var url = "{{route('locatario.principal')}}/"+contrato;
        $.ajax(
          {
            url : url,
            dataType:'json',
            type:'get',
            async:false,
            success:function( data )
            {
              $("#i-email-modal").val( data.IMB_CLT_EMAIL);
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
  if( banco == 1 )
  {
     url ="{{route('boleto.001')}}/"+id+'/S/'+$("#i-email-modal").val();
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

function boletoSmsVen( id )
{

  $("#modalsms").modal('show');
  $("#i-titulo-modal-sms").html( 'Envio de Linha Digitável por SMS');
  $("#modalboletosvencendo").modal('hide');
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

function enviarTodosWs()
{

  var url = "{{route('whastapp.boletoshoje')}}";

  $.ajax( 
    {
      url:url, 
      dataType:'json',
      type:'get',
      success:function( data )
      {
        alert('Boletos enviados por whatsapp a todos com vencimento para hoje com sucesso!')

      }
    }
  )

}

    
</script>

@endpush
