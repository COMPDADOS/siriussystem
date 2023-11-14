<div class="modal fade" id="modalencerraratendimento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered"style="width:90%;" >    
    <div class="modal-content ">
      <div class="modal-body">
        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption">
              <i class="fa fa-gift"></i>Encerrar Atendimento
            </div>
          </div>
      
          <div class="portlet-body form">
            <input type="hidden" id="IMB_CLA_ID_ENCERRAATM">
            <div class="row">
              <div class="col-md-12">
                <div class="col-md-1">
                  <label class="control-label">Iniciado</label>
                  <input class="form-control" type="text" id="i-inicio-atendimento" readonly>
                </div>
                <div class="col-md-3">
                  <label class="control-label">Nome do Cliente</label>
                  <input class="form-control" type="text" id="i-nome-cliente" readonly>
                </div>
                <div class="col-md-1">
                  <label class="control-label">Perspectiva de Negócio</label>
                  <select  class="form-control" id="IMB_CLA_PERSPECTIVA">
                    <option value="">Selecione</option>
                    <option value="Baixa">Baixa</option>
                    <option value="Média">Média</option>
                    <option value="Alta">Alta</option>

                  </select>
                </div>
                <div class="col-md-5">
                  <label class="control-label">Comentários sobre este atendimento</label>
                  <textarea  class="form-control" id="i-anotacoes-atendimento" cols="100%" rows="6"></textarea>
                </div>
                <div class="col-md-2">
                  <p><hr></p>
                  <button class="form-control btn btn-primary" onClick="confirmarEncerramentoAtendimento('encerrar')">Encerrar o Atendimento</button>
                  <p><hr></p>
                  <button class="form-control btn btn-success" onClick="confirmarEncerramentoAtendimento('manteraberto')">Manter o Atendimento em Aberto</button>
                  <p><hr></p>
                  <button class="form-control btn btn-secondary" data-dismiss="modal">Continuar o atendimento</button>
                </div>
              </div>

            </div>
          </div>            
        </div>
      </div>
    </div>
  </div>
</div>


@push('script')
<script>


function encerrarAtendimento()
{
  var idatendimento = getCookie("3wt2oowd3ooo2oowt4");
  var url = "{{route('atendimento.pegardadosatendimento')}}/"+idatendimento;
  console.log( url );
  $.ajax({
    url:url,
    dataType:'json',
    type:'get',
    success:function( data )
    {
      $("#i-inicio-atendimento").val( moment(data.IMB_CLA_DATAATENDIMENTO).format('DD/MM/YYYY HH:MM'));
      $("#i-nome-cliente").val(data.IMB_CLT_NOME);
      $("#i-anotacoes-atendimento").val(data.IMB_CLA_COMENTARIO);
      $("#modalencerraratendimento").modal('show');
    }
    })
}


function confirmarEncerramentoAtendimento( tipo)
{

  if( $("#IMB_CLA_COMENTARIO").val() == '' )
  {
    alert('Escreva algo sobre este atendimento, por favor.')
    return false;
  }
  if( $("#IMB_CLA_PERSPECTIVA").val() == '' )
  {
    alert('Por favor, informe a perspectiva de negócio.')
    return false;
  }
  var idatendimento = getCookie('3wt2oowd3ooo2oowt4');

  var url = "{{route('atendimento.fechar')}}";

  $.ajaxSetup(
  {
    headers:
    {
      'X-CSRF-TOKEN': "{{csrf_token()}}"
    }
  });

  dados =
  {
    IMB_CLA_ID : idatendimento,
    IMB_CLA_COMENTARIO : $("#IMB_CLA_COMENTARIO").val(),
    IMB_CLA_PERSPECTIVA: $("#IMB_CLA_PERSPECTIVA").val(),
    tipo:tipo
  };
  $.ajax(
  {
    url : url,
    type : 'post',
    data : dados,
    success:function()
    {
      eraseCookie( '3wt2oowd3ooo2oowt4');
      $("#modalencerraratendimento").modal('hide');
      if( tipo ==  'encerrar')
        alert('Atendimento Fechado!');
      if(  tipo == 'manteraberto')
        alert('O atendimento foi atualizado, mas continuará em aberto!')
    
    },
    error: function()
    {
      alert('Atendimento não pôde ser finalizado!');
    }
  });

}

</script>


@endpush

