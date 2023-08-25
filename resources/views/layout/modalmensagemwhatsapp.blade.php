<div class="modal" tabindex="-1" role="dialog" id="modalmsgwhastapp">
    <div class="modal-dialog "style="width:90%;" >
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Mensagem por Whastapp
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
                </div>
                <div class="portlet-body form">
                    <input type="hidden" id="IMB_CTR_ID_MSGWS">
                    <input type="hidden" id="IMB_CLT_ID_MSGWS">
                    <input type="hidden" id="msgws_referente" >
                    <div class="form-body" >
                        <div class="row">
                            <div class="col-md-12">
                                    <label>Assunto</label>
                                    <input class="form-control" type="text" maxlength="200" id="wsmsg-assunto">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <label>Mensagem</label>
                                    <textarea class="form-control" id="wsmsg-mensagem" cols="100%" rows="10"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <table  id="tlbfonewsmsg" class="table table-striped table-bordered table-hover" >
                                        <thead class="thead-dark">
                                            <tr >
                                                <th width="10%" style="text-align:center"> DDI</th>
                                                <th width="10%" style="text-align:center"> DDD</th>
                                                <th width="40%" style="text-align:center"> Número </th>
                                                <th width="40%" style="text-align:center"> Cliente </th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <div class="row escondido" id="div-novonumero">
                                        <div class="col-md-12"><h5>Adicionar Número</h5>
                                            <div class="col-md-1">
                                                <label class="control-label">DDI</label>
                                                <input type="text" id="IMB_TLF_DDI" class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="control-label">DDD</label>
                                                <input type="text" id="IMB_TLF_DDD" class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="control-label">Número</label>
                                                <input type="text" id="IMB_TLF_NUMERO" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="control-label">Tipo</label>
                                                <input type="text" id="IMB_TLF_TIPOTELEFONE" class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="control-label">.</label>
                                                <button class="btn btn-primary form-control" onClick="EnviarMsgNumeroNovo()">Enviar</button>
                                            </div>

                                        </div>



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="cabcel" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push( 'script')
<script>
    function EnviarWsMsg( ddi, ddd,numero, idcontrato, idcliente)
    {
        var url = "{{route('whastapp.enviarmsg')}}";
        
        dados =
        {
            ddi:ddi,
            ddd:ddd,
            numero:numero,
            msg : $("#wsmsg-mensagem").val(),
            assunto: $("#wsmsg-assunto").val(),
            idcontrato: idcontrato,
            idcliente:idcliente,
        }

        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                data : dados,
                success:function( )
                {
                    alert('Mensagem enviada');
                }
            }
        )
    }

    function EnviarMsgNumeroNovo()
    {
        var ddi         = $("#IMB_TLF_DDI").val();
        var ddd         = $("#IMB_TLF_DDD").val(); 
        var numero      = $("#IMB_TLF_NUMERO").val();  
        var tipo        = $("#IMB_TLF_TIPOTELEFONE").val();  
        var idcontrato  = $("#IMB_CTR_ID_MSGWS").val(); 
        var idcliente   = $("#IMB_CLT_ID_MSGWS").val(); 

        $.ajaxSetup
        ({
          headers:
          {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
          }
        });

        var url = "{{route('telefone.salvarcomddi')}}/"+idcliente+"/"+ddi+"/"+ddd+"/"+numero+"/"+tipo;
        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'post',
                success:function()
                {
                    EnviarWsMsg( ddi, ddd,numero, idcontrato, idcliente);
                },
                error:function()
                {
                    alert(  'erro na gravacao do novo numero! Mensagem não enviada!');
                }
            }
        )

    }
</script>
@endpush