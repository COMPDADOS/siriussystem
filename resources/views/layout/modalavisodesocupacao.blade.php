@section('scripttop')
<style>

.cinza
{
  background-color: grey;

}
</style>
@endsection
<div class="modal fade" id="modalavisodesocupacao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:90%;" >
    <div class="modal-content ">
      <div class="modal-body">
        <div class="portlet box red">
          <div class="portlet-title">
            <div class="caption div-center">
              <i class="fa fa-gift"></i>Aviso de Desocupação
            </div>
          </div>
      
          <div class="portlet-body form">
            <div class="row " >
              <div class="col-md-12">
                <input type="hidden" id="avd-IMB_CTR_ID">
                <div class="col-md-2">
                  <label class="control-label">Data Locação</label>
                  <p><input class="form-control" type="text" id="avd-IMB_CTR_DATALOCACAO" readonly></p>
                </div>
                <div class="col-md-2">
                  <label  class="control-label">Inicio Contrato</label>
                  <p><input class="form-control"  type="text" id="avd-IMB_CTR_INICIO" readonly></p>
                </div>
                <div class="col-md-2">
                  <label  class="control-label">Inicio Término</label>
                  <p><input class="form-control"  type="text" id="avd-IMB_CTR_TERMINO" readonly></p>
                </div>
                <div class="col-md-1">
                  <label  class="control-label">Dia</label>
                  <p><input class="form-control"  type="text" id="avd-IMB_CTR_DIAVENCIMENTO" readonly></p>
                </div>
                <div class="col-md-3">
                  <label  class="control-label">Próximo Vencto.</label>
                  <p><input class="form-control"  type="date" id="avd-IMB_CTR_VENCIMENTOLOCATARIO" readonly></p>
                </div>
                <div class="col-md-2">
                  <label  class="control-label">Valor do Aluguel</label>
                  <p><input class="form-control"  type="text" id="avd-IMB_CTR_VALORALUGUEL" readonly></p>
                </div>
              </div>
            </div>
            <div class="portlet box blue">
              <div class="portlet-title">
                <div class="caption">
                  <i class="fa fa-gift"></i>Dados para Novo Aviso de Desocupação
                </div>
              </div>
              <div class="portlet-body form">
                <div class="row">
                  <div class="col-md-12">
                      <div class="col-md-3 div-center">
                        <label class="control-label"><b>Data Aviso</b></label>
                        <input class="form-control" type="date" id="IMB_AVD_DATAAVISO">
                      </div>
                      <div class="col-md-3 div-center">
                        <label class="control-label"><b>Data Previsao</b></label>
                        <input class="form-control" type="date" id="IMB_AVD_DATAPREVISAO">
                      </div>
                      <div class="col-md-3  div-center">
                        <label class="control-label"><b>Cancelado em</b></label>
                        <input class="form-control" type="text" id="IMB_AVD_DTHINATIVO" readonly >
                      </div>
                      <div class="col-md-3 div-center">
                        <label class="control-label">Liberado Multa Pelo Propr.
                          <input class="form-control" type="checkbox" id="IMB_AVD_LIBERADOPROP">
                        </label>
                      </div>                            
                      
                      <div class="row">
                        <hr>
                        <div class="col-md-12">
                          <div class="col-md-6">
                            <label class="control-label">Nome de Quem Está Avisando</label>
                              <input class="form-control" type="text" id="IMB_AVD_NOME">
                          </div>              
                      
                          <div class="col-md-3 ">
                            <label class="control-label">CPF                            </label>

                              <input class="form-control" type="text" id="IMB_AVD_CPF">
                          </div>                            
                          <div class="col-md-3">
                            <label class="control-label">RG                            </label>

                              <input class="form-control" type="text" id="IMB_AVD_RG">
                          </div>                            
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="col-md-6">
                            <label class="control-label">Observação
                              <textarea class="form-control" id="IMB_AVD_RELATO" cols="80" rows="3"></textarea>
                            </label>                            
                          </div>
                          <div class="col-md-3 div-center">
                            <p></p>
                            <button class="btn btn-primary" onClick="gravarAVD()">Confirmar Novo</button>
                          </div>
                          <div class="col-md-3 div-center">
                            <p></p>
                            <button class="btn btn-danger" data-dismiss="modal">Cancelar</button>
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
                  <i class="fa fa-gift"></i>Avisos já realizados neste contrato
                </div>
              </div>
              <div class="portlet-body form">
                <div class="row">
                  <div class="col-md-12">
                      <table class="table-striped table-bordered table-hover" id="tblavdrealizados">
                        <thead>
                          <tr>
                            <td width="10%"></td>
                            <td width="10%">Data Aviso</td>
                            <td width="10%">Data Previsao</td>
                            <td width="5%">Cancelado</td>
                            <td width="5%">Liberado</td>
                            <td width="20%">Usuário</td>
                            <td width="40%">Observação</td>
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

function avisoDesocupacaoCargaCampos( id )
{
  url = "{{route('contrato.findfull')}}/"+id;
  console.log( url );

  $.ajax(
    {
      url:url,
      dataType:'json',
      type:'get',
      success:function(data )
      {
        $("#avd-IMB_CTR_DATALOCACAO").val( moment( data.IMB_CTR_DATALOCACAO).format('DD/MM/YYYY'));
        $("#avd-IMB_CTR_INICIO").val( moment( data.IMB_CTR_INICIO).format('DD/MM/YYYY'));
        $("#avd-IMB_CTR_TERMINO").val( moment( data.IMB_CTR_TERMINO).format('DD/MM/YYYY'));
        $("#avd-IMB_CTR_DIAVENCIMENTO").val( data.IMB_CTR_DIAVENCIMENTO);
        $("#avd-IMB_CTR_VENCIMENTOLOCATARIO").val( data.IMB_CTR_VENCIMENTOLOCATARIO);
        $("#avd-IMB_CTR_VALORALUGUEL").val( formatarBRSemSimbolo(parseFloat( data.IMB_CTR_VALORALUGUEL)));
        $("#avd-IMB_CTR_ID").val( id );
        cargaAVDRealizados( id );
      }
    }
  )
}


function novoAvisoDesocupacao( id )
{0
  $("#modalavisodesocupacao").modal( 'show');
  $("#IMB_AVD_DATAAVISO").val( moment().format( 'YYYY-MM-DD'));
  $("#IMB_AVD_DATAPREVISAO").val(  moment().add(30, 'd').format('YYYY-MM-DD' ));
  $("#IMB_AVD_RELATO").val('');
  $("#IMB_AVD_LIBERADOPROP").prop( "checked", false);
 
 
  pegarLocatario( id );
  avisoDesocupacaoCargaCampos( id );
}


function confirmarAVD()
{
  if($("#IMB_AVD_DATAAVISO").val() =='' )
  {
    alert('Informe a data do aviso');
    return false;
  }
  if($("#IMB_AVD_DATAPREVISAO").val() =='' )
  {
    alert('Informe a data Previsao');
    return false;
  }

}


function gravarAVD()
{


  var idcontrato = $("#avd-IMB_CTR_ID").val();

  var url = "{{route('avisodesocupacao.store')}}";

  var data=moment($("#IMB_AVD_DATAAVISO").val(), 'YYYY/MM/DD');
  var data=moment($("#IMB_AVD_DATAPREVISAO").val(), 'YYYY/MM/DD');
  if( $("#IMB_AVD_RELATO").val() == '' )
  {
    alert('É importante que descreva algo na observação');
    return
  }

  var dados = 
  {

    IMB_CTR_ID            : idcontrato,
    IMB_AVD_DATAAVISO     : $("#IMB_AVD_DATAAVISO").val(),
    IMB_AVD_DATAPREVISAO  : $("#IMB_AVD_DATAPREVISAO").val(),
    IMB_AVD_RELATO        : $("#IMB_AVD_RELATO").val(),
    IMB_AVD_LIBERADOPROP  : $("#IMB_AVD_LIBERADOPROP").prop( "checked" )   ? 'S' : 'N', 
    IMB_AVD_NOME          : $("#IMB_AVD_NOME").val(),
    IMB_AVD_CPF           : $("#IMB_AVD_CPF").val(),
    IMB_AVD_RG            : $("#IMB_AVD_RG").val(),
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
        cargaAVDRealizados($("#avd-IMB_CTR_ID").val() );
        $("#modalavisodesocupacao").modal( 'hide');

      }
    }
  )
  
}

function cargaAVDRealizados( id )
{
  var url = "{{route( 'avisodesocupacao.list')}}/";

  var dados = { idcontrato : id };

  $.ajax(
  {
    url     : url,
    dataType: 'json',
    type    : 'get',
    data    : dados,
    success : function( data )
    {
      linha = "";
      $("#tblavdrealizados>tbody").empty();
      for( nI=0;nI < data.data.length;nI++)
      {
        inativado = moment(data.data[nI].IMB_AVD_DTHINATIVO).format('DD/MM/YYYY');

        classe='class=""';
        if( inativado == 'Invalid date') 
          inativado= '-'
        else
          classe='class="cinza"';

          var obs = data.data[nI].IMB_AVD_RELATO;
          if ( obs === null ) obs='';

       var liberado = data.data[nI].IMB_AVD_LIBERADOPROP;
       if (liberado == 'S' )
       {
          liberado='Sim' 
       }
       else
       {

        liberado='Não';
       }

        linha = 
          '<tr '+classe+'>'+
          '<td '+classe+'><button title="Cancelar o aviso" class="btn btn-danger" onClick="inativar('+data.data[nI].IMB_AVD_ID+')"><i class="fa fa-trash" aria-hidden="true"></i></button>'+
          '<button title="Gerar o Documento" class="btn btn-primary" onClick="imprimirAvisoDesoc('+data.data[nI].IMB_AVD_ID+')"><i class="fa fa-print" aria-hidden="true"></i></button></td>'+
          '<td >'+moment(data.data[nI].IMB_AVD_DATAAVISO).format('DD/MM/YYYY')+'</td>'+
          '<td >'+moment(data.data[nI].IMB_AVD_DATAPREVISAO).format('DD/MM/YYYY')+'</td>'+
          '<td >'+inativado+'</td>'+
          '<td >'+liberado+'</td>' +
          '<td >'+data.data[nI].IMB_ATD_NOME+'</td>' +
          '<td><textarea class="form-control" readonly>'+obs+'</textarea></td>' +
          '</tr>';
        $("#tblavdrealizados").append( linha );
      }
    }
  });

  

}

function pegarLocatario( id )
{
  debugger;
  var url = "{{route('locatario.principal')}}/"+id;
  $.ajax(
    {
      url:url,
      dataType:'json',
      type:'get',
      success:function( data )
      {
        $("#IMB_AVD_NOME").val( data.IMB_CLT_NOME);
        $("#IMB_AVD_CPF").val( data.IMB_CLT_CPF);
        $("#IMB_AVD_RG").val( data.IMB_CLT_RG);
      },
      error:function( data )
      {
      },
      complete:function( data )
      {
      }
    }
  )
}

function imprimirAvisoDesoc( id )
{
  var url = "{{route('avisodesocupacao')}}/"+id;

  window.open( url, '_blank');

}

function inativar( id )
{
    if( confirm("Confirma a inativação do aviso?") == true )
    {           
      var url = "{{ route('avisodesocupacao.inativar')}}/"+id;
                
      $.ajaxSetup(
      {
          headers:
          {
              'X-CSRF-TOKEN': "{{csrf_token()}}"
          }
      });

      $.ajax(
      {
          url : url,
          datatype: 'json',
          async:false,
          type:"post",
          success:function( data )
          {
            alert( 'Inativado!');
            cargaAVDRealizados();
          }
      });
    };
      

}

</script>


@endpush