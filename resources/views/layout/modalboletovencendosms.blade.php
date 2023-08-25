<div class="modal fade" id="modalsmsvencendo" tabindex="-1" role="dialog" a
  ria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
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
            <div class="caption" id="i-titulo-modal-sms">
              <i class="fa fa-gift"></i>
            </div>
          </div>

          <div class="portlet-body form">
            <div class="row">
              <div class="col-md-12">
                <textarea id="i-sms-conteudo" cols="100%" rows="3"></textarea>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="col-md-1">
                    <label class="control-label">DDD
                      <input class="form-control" type="text" id="I-SMS-DDD" >
                    </label>
                </div>
                <div class="col-md-2">
                    <label class="control-label">Número Celular
                      <input class="form-control" type="text" id="I-SMS-NUMEROCELULAR">
                    </label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="col-md-8">.</div>
                <div class="col-md-2"><button class="btn form-control btn-primary" onClick="enviarSMSVenc()">Enviar</button></div>
                <div class="col-md-2"><button class="btn form-control btn-danger" data-dismiss="modal">Cancelar</button></div>
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

    function enviarSMSVenc()
    {
      $("#modalboletosvencendo").modal('hide'); 
        var url = "{{route('sms.enviar')}}";
        var dados = 
        {
            ddd : $("#I-SMS-DDD").val(),
            numero :$("#I-SMS-NUMEROCELULAR").val(),
            conteudo :$("#i-sms-conteudo-vencendo").val(),
        }

        $.ajax( 
            {
                url:url,
                dataType:'json',
                type:'get',
                data:dados,
                complete:function(data)
                {
                  alert('Mensagem enviada para o celular informado. Poder demorar uns minutos até chegar ao destinatário')
                }

            }
        )
        
    }

</script>
@endpush


