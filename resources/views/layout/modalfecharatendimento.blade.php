<div class="modal fade" id="modalfecharatendimento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog "style="width:70%;" >
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <h3 class="div-center" id="i-titulo-encatm">Encerrar o Atendimento</h3>
        </div>
        <div class="row"><hr></div>
        <input type="hidden" id="IMB_CLA_ID_FECHARATENDIMENTO">
        <div class="row">
          <div class="col-md-12 div-center">
            <div class="col-md-6">
              <label class="control-label">Nome do Cliente</label>
              <input type="text" class="form-control" id='i-nomecliente-encatm'>
            </div>            
            <div class="col-md-2">
              <label class="control-label">Início Atendimento</label>
              <input type="date" class="form-control" id='i-inicioatendimento-encatm' readonly>
            </div>       
            <div class="col-md-2">
              <label class="control-label">Encerramento Atendimento</label>
              <input type="date" class="form-control" id='i-encerramentoatendimento-encatm'>
            </div>
            <div class="col-md-2">
              <label class="control-label">Perspectiva Sucesso</label>
              <select  class="form-control" id="i-perpectivasucesso-encatm">
                <option value="">Selecione</option>
                <option value="Baixa">Baixa</option>
                <option value="Média">Média</option>
                <option value="Alta">Alta</option>
              </select>
            </div>
            <div class="row"><hr></div>
            <div class="row">
              <div class="col-md-12">
                <h3 class="div-center"><u>Observações</u></h3>
                <textarea class="form-control" id="i-observacao-encatm" cols="100%" rows="3"></textarea>
              </div>
            </div>
          </div>
          <div class="row"><hr></div>
          <div class="col-md-12">
            <div class="col-md-3"></div>
            <div class="col-md-3">
              <button class="form-control btn btn-primary" onClick="confirmarFechamentoAtendimento()">Confirmar Encerramento</button>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-3">
              <button class="form-control btn btn-danger">Não Encerrar</button>
            </div>
          </div>
          <div class="col-md-12">
            <hr>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@push('script')
<script>
  function finalizarAtendimento( id, status )
  {

    if( status =  'Finalizado') 
    {
      alert('Atendimento Já Finalizado. Não permitido finalizar este atendimento!');
      return false;
    }
    $("#IMB_CLA_ID_FECHARATENDIMENTO").val( id );
    var url = "{{route('listaratendimentos')}}";

    dados =
    {
      id : id
    };

    console.log( dados);
    console.log( url );
    $.ajax(
    {
      url     : url,
      data    : dados,
      type    : 'get',
      dataType: 'json',
      success : function( data )
      {
        console.log( data );
        $("#modalfecharatendimento").modal('show');
        console.log('data atm '+data.data[0].IMB_CLA_DATAATENDIMENTO);
        console.log( data.data[0]);
          var dataatd = moment( data.data[0].IMB_CLA_DATAATENDIMENTO ).format( 'YYYY-MM-DD');
            $("#i-nomecliente-encatm").val( data.data[0].IMB_CLT_NOME );
            $("#i-inicioatendimento-encatm").val( dataatd );
            $("#i-encerramentoatendimento-encatm").val( moment().format('YYYY-MM-DD') );
            $("#i-observacao-encatm").val( data.data[0].IMB_CLA_COMENTARIO);
            $("#i-titulo-encatm").html('Encerrar o atendimento de número: ' +data.data[0].IMB_CLA_ID );
        },
        error:function()
        {
            alert('erro');
        }
    });

  }

  function confirmarFechamentoAtendimento()
  {
    if( $("#i-perpectivasucesso-encatm").val() == '' )
    {
      alert('Informe a perspectiva de sucesso no negócio!');
      return false;
    }
    $.ajaxSetup({
            headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });

    var url = "{{route('atendimento.fechar')}}";
    
    var dados = 
    {
      IMB_CLA_COMENTARIO :  $("#i-observacao-encatm").val(),
      IMB_CLA_PERSPECTIVA : $("i-perpectivasucesso-encatm").val(),
      IMB_CLA_ID : $("#IMB_CLA_ID_FECHARATENDIMENTO").val(),
      tipo : 'encerrar',
    } 

    $.ajax(
      {
        url:url,
        dataType:'json',
        type:'post',
        data:dados,
        success:function(data)
        {
          alert('Procedimento realizado com sucesso!');
          $("#modalfecharatendimento").modal( 'hide');
        }
      }
    )

  }
            

</script>
@endpush