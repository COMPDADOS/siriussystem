<div class="modal fade" id="modalalteracaovencimento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:70%;" >
    <div class="modal-content ">
      <div class="modal-body">
        <div class="portlet box red">
          <div class="portlet-title">
            <div class="caption">
              <i class="fa fa-gift"></i>Alteracão Vencimento
            </div>
          </div>
      
          <div class="portlet-body form">
            <div class="row">
              <div class="col-md-12">
                <input type="hidden" id="av-IMB_CTR_ID">
                <input class="escondido" type="date" id="i-dataperiodoinicial">
                <div class="col-md-2">
                  <label class="control-label">Data Locação</label>
                  <p><input class="form-control" type="text" id="av-IMB_CTR_DATALOCACAO" readonly></p>
                </div>
                <div class="col-md-2">
                  <label  class="control-label">Inicio Contrato</label>
                  <p><input class="form-control"  type="text" id="av-IMB_CTR_INICIO" readonly></p>
                </div>
                <div class="col-md-2">
                  <label  class="control-label">Inicio Término</label>
                  <p><input class="form-control"  type="text" id="av-IMB_CTR_TERMINO" readonly></p>
                </div>
                <div class="col-md-1">
                  <label  class="control-label">Dia</label>
                  <p><input class="form-control"  type="text" id="av-IMB_CTR_DIAVENCIMENTO" readonly></p>
                </div>
                <div class="col-md-3">
                  <label  class="control-label">Próximo Vencto.</label>
                  <p><input class="form-control"  type="date" id="av-IMB_CTR_VENCIMENTOLOCATARIO" readonly></p>
                </div>
                <div class="col-md-2">
                  <label  class="control-label">Valor do Aluguel</label>
                  <p><input class="form-control"  type="text" id="av-IMB_CTR_VALORALUGUEL" readonly></p>
                </div>
              </div>
            </div>
            <div class="portlet box blue">
              <div class="portlet-title">
                <div class="caption">
                  <i class="fa fa-gift"></i>Dados Novo Vencimento
                </div>
              </div>
              <div class="portlet-body form">
              <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-3 div-center">
                        <label class="control-label"><b>Nova Data de Vencimento</b></label>
                        <input class="form-control" type="date" id="av-novadata">
                      </div>
                      <div class="col-md-1  div-center">
                        <label class="control-label"><b>Dias</b></label>
                        <input class="form-control" type="text" id="av-dias" readonly >
                      </div>
                      <div class="col-md-6  div-center">
                        <label class="control-label"><b>Período</b></label>
                        <input class="form-control" type="text" id="av-periodo" >
                      </div>
                      <div class="col-md-2  div-center">
                        <label class="control-label "><b>Valor</b></label>
                        <input class="form-control valor" type="text" id="av-valor" >
                      </div>
                      <div class="row">
                        <div class="col-md-4 div-center">
                          <label class="control-label">Liberado pelo proprietário
                            <input class="form-control" type="checkbox" id="av-liberado">
                          </label>
                        </div>                            
                        <div class="col-md-6">
                          <label class="control-label">Observação
                            <textarea class="form-control" id="av-observacao" cols="80" rows="3"></textarea>
                          </label>                            
                        </div>
                        <div class="col-md-2">
                          <p></p>
                          <button class="btn btn-primary" onClick="gravarAltVen()">Confirmar</button>
                          <button class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 div-right">
                          <div class="col-md-6">
                          </div>
                          <div class="col-md-6">
                            <div class="col-md-3">
                            </div>
                          </div>
                        </div>                          
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="portlet box yellow">
              <div class="portlet-title">
                <div class="caption">
                  <i class="fa fa-gift"></i>Alterações já realizadas para este contrato
                </div>
              </div>
              <div class="portlet-body form">
                <div class="row">
                  <div class="col-md-12">
                      <table class="table-striped table-bordered table-hover" id="tblrealizadas">
                        <thead>
                          <tr>
                            <td>Data Alteraçao</td>
                            <td>De</td>
                            <td>Para</td>
                            <td>Á partir de</td>
                            <td>$ Acerto Dias</td>
                            <td>Liberado</td>
                            <td>Feito por</td>
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
        </div>
      </div>

      <div class="modal-footer">
        <div class="row">
          <div class="col-md-12">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">sair</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@push('script')
<script>
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

function alteracaoVencimentoCargaCampos( id )
{
  url = "{{route('contrato.findfull')}}/"+id;



  $("#av-dias").val('');
  $("#av-novadata").val('');
  $("#av-IMB_CTR_VENCIMENTOLOCATARIO").val('');
  $("#av-valor").val('');
    
  $("#av-observacao").val('');
  $("#av-liberado").prop( "checked", false ) ;     
  $("#av-periodo").val('');

  $.ajax(
    {
      url:url,
      dataType:'json',
      type:'get',
      success:function(data )
      {
        $("#av-IMB_CTR_DATALOCACAO").val( moment( data.IMB_CTR_DATALOCACAO).format('DD/MM/YYYY'));
        $("#av-IMB_CTR_INICIO").val( moment( data.IMB_CTR_INICIO).format('DD/MM/YYYY'));
        $("#av-IMB_CTR_TERMINO").val( moment( data.IMB_CTR_TERMINO).format('DD/MM/YYYY'));
        $("#av-IMB_CTR_DIAVENCIMENTO").val( data.IMB_CTR_DIAVENCIMENTO);
        $("#av-IMB_CTR_VENCIMENTOLOCATARIO").val( data.IMB_CTR_VENCIMENTOLOCATARIO);
        $("#av-IMB_CTR_VALORALUGUEL").val( formatarBRSemSimbolo(parseFloat( data.IMB_CTR_VALORALUGUEL)));
        $("#av-IMB_CTR_ID").val( id );
        cargaJaRealizadas( id );
      }
    }
  )
}

function confirmar()
{
  if($("#av-novadata").val() =='' )
  {
    alert('Informe o novo vencimento');
    return false;
  }

}

$("#av-novadata").blur( function()
{
  var url = "{{route('periodoinicial')}}/"+$("#av-IMB_CTR_ID").val()+'/'+$("#av-IMB_CTR_VENCIMENTOLOCATARIO").val();
  dataperiodoinicial = moment().format( 'YYYY-MM-DD');
  $.ajax(
    {
      url:url,
      dataType:'json',
      type:'get',
      async:false,
      success:function( data )
      {
        debugger;
        let dataString = data.split("/");
        let dataperiodoinicial = new Date(dataString[2], dataString[1]-1, dataString[0]);

        dataperiodoinicial = moment( dataperiodoinicial ).format( 'YYYY-MM-DD');
        $("#i-dataperiodoinicial").val( dataperiodoinicial);
  
        console.log( dataperiodoinicial);
        console.log( data);

        



      }
    }
  );

  console.log( 'dataperiodoinicial: '+dataperiodoinicial);
  console.log( '$("#av-novadata").val(): '+$("#av-novadata").val());
  if( $("#av-novadata").val() < $("#av-IMB_CTR_VENCIMENTOLOCATARIO").val() )
     $("#av-dias").val( diferencaDias(   $("#i-dataperiodoinicial").val(), $("#av-novadata").val()  ) )
  else
     $("#av-dias").val( diferencaDias( $("#av-novadata").val(), $("#av-IMB_CTR_VENCIMENTOLOCATARIO").val() ) );
  
 
  $("#av-periodo").val( 'Referente a '+$("#av-dias").val()+' dias conforme alteração de vencimento');
  var valoralugel = realToDolar($("#av-IMB_CTR_VALORALUGUEL").val() );
  var valordias = valoralugel  / 30 * $("#av-dias").val();
  valordias = valordias.toFixed(2)
  $("#av-valor").val( dolarToReal(valordias));

  
})

function gravarAltVen()
{

  var idcontrato = $("#av-IMB_CTR_ID").val();

  var url = "{{route('contrato.altven')}}";

  var data=moment($("#av-novadata").val(), 'YYYY/MM/DD');

  var dados = 
  {
    IMB_CTR_ID : idcontrato,
    IMB_CAV_DIASDELOCACAO : $("#av-dias").val(),
    IMB_CAV_PERIODODATAFIM: $("#av-novadata").val(),
    IMB_CAV_PERIODODATAINICIO:  $("#av-IMB_CTR_VENCIMENTOLOCATARIO").val(),
    IMB_CAV_VALOR: realToDolar($("#av-valor").val()),
    IMB_CAV_DIAATUAL    : data.format('D'),
    IMB_CAV_OBSERVACAO    : $("#av-observacao").val(),
    IMB_CAV_LIBERADO : $("#av-liberado").prop( "checked" )   ? 'S' : 'N',     
    IMB_CAV_OBSERVACAO : $("#av-periodo").val(),
  }

  $.ajaxSetup({
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
      success:function( data )
      {
        alert('Processo efetivado!');
        $("#modalalteracaovencimento").modal( 'hide');
      }
    }
  )
  
}

function cargaJaRealizadas( id )
{
  var url = "{{route( 'contrato.altven.carga')}}/"+id;

  $.ajax(
  {
    url     : url,
    dataType: 'json',
    type    : 'get',
    success : function( data )
    {
      linha = "";
      $("#tblrealizadas>tbody").empty();
      for( nI=0;nI < data.length;nI++)
      {
        linha = 
          '<tr>'+
            '<td >'+moment(data[nI].IMB_CAV_DATA).format('DD/MM/YYYY')+'</td>'+
            '<td >'+data[nI].IMB_CAV_DIAANTERIOR+'</td>' +
            '<td >'+data[nI].IMB_CAV_DIAATUAL+'</td>' +
            '<td >'+moment(data[nI].IMB_CAV_PERIODODATAINICIO).format('DD/MM/YYYY')+'</td>' +
            '<td >'+dolarToReal(data[nI].IMB_CAV_VALOR)+'</td>' +
            '<td >'+data[nI].IMB_CAV_LIBERADO+'</td>' +
            '<td >'+data[nI].IMB_ATD_NOME+'</td>' +
          '</tr>';
        $("#tblrealizadas").append( linha );
      }
    }
  });

}



</script>


@endpush