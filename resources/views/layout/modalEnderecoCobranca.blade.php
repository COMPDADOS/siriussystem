<div class="modal fade" id="modalEnderecoCobranca" tabindex="-1"
            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
                data-backdrop="static" >
     <div class="modal-dialog "style="width:90%;" >

    <div class="modal-content modal-md">
      <div class="modal-body">
        <input type="hidden" id="IMB_CTR_ID-ENDCOB">
        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption">Endereço de Cobrança
            </div>
          </div>

          <div class="portlet-body form">

            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-4">
                        <label class="control-label">Destinatário</label>
                        <input class="form-control" type="text" id="IMB_CCB_DESTINATARIO-ALT" maxlength="40">
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">Endereço</label>
                        <input class="form-control" type="text" id="IMB_CCB_ENDERECO-ALT" maxlength="40">
                    </div>
                    <div class="col-md-2">
                        <label class="control-label">Número</label>
                        <input class="form-control" type="text" id="IMB_CCB_ENDERECONUMERO-ALT" maxlength="10">
                    </div>
                    <div class="col-md-2">
                        <label class="control-label">Complemento</label>
                        <input class="form-control" type="text" id="IMB_CCB_ENDERECOCOMPLEMENTO-ALT" maxlength="10">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-2">
                        <label class="control-label">CEP</label>
                        <input class="form-control" type="text" id="IMB_CCB_CEP-ALT"
                        onkeypress="return isNumber(event)" onpaste="return false;">
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">Bairro</label>
                        <input class="form-control" type="text" id="IMB_CCB_BAIRRO-ALT">
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">Cidade</label>
                        <input class="form-control" type="text" id="CEP_CID_NOME-ALT">
                    </div>
                    <div class="col-md-1">
                        <label class="control-label">UF</label>
                        <input class="form-control" type="text" id="CEP_UF_SIGLA-ALT">
                    </div>
                    <div class="col-md-1">
                        <label class="control-label">&nbsp;</label>
                        <button class="btn btn-primary form-control" onClick="gravarEnderecoCobranca()">Gravar</button>
                    </div>
                    <div class="col-md-1">
                        <label class="control-label">&nbsp;</label>
                        <button class="btn btn-secondary form-control" data-dismiss="modal">Cancelar</button>
                    </div>
                    <div class="col-md-1">
                        <label class="control-label">&nbsp;</label>
                        <button class="btn btn-danger form-control" onClick="EnderecoExcluir()">Excluir</button>
                    </div>
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

    $('#IMB_CCB_CEP-ALT').on('blur', () =>
    {
        if( $("#IMB_CCB_ENDERECO").val() != '' )
        {
            let token = document.head.querySelector('meta[name="csrf-token"]');
            if (token)
            {
                window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
            }
            else
            {
                console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
            }


            if ($.trim($('#IMB_CCB_CEP-ALT').val()) !== '')
            {
                //console.log('passando');
                $('#mensagem').html('(Aguarde, consultando CEP ...)');

                // NOVO CODIGO =============================================

                // Guardar o CEP do input.
                const cep = $('#IMB_CCB_CEP-ALT').val();

                // Construir a url com o CEP do input.
                // IMPORTANTE: na url, informar o parametro formato=json ao invés de formato=javascript.

                const urlBuscaCEP = 'https://viacep.com.br/ws/'+cep+'/json';

                // Realizar uma requisição HTTP GET na url.
                // O primeiro parâmetro é a url.
                // O segundo parâmetro é o callback, ou seja,
                // uma função que vai ser executada quando os dados forem retornados.
                // Essa função recebe um parâmetro que são os dados que a API retornou.
                $.get(urlBuscaCEP, (resultadoCEP) =>
                {

                        // /$('#rua').val(`${resultadoCEP['tipo_logradouro']} ${resultadoCEP['logradouro']}`);
                        $('#IMB_CCB_ENDERECO-ALT').val(resultadoCEP.logradouro);
                        $('#IMB_CCB_BAIRRO-ALT').val(resultadoCEP.bairro.substr( 0, 19 ));
                        $('#CEP_CID_NOME-ALT').val(resultadoCEP.localidade.substr( 0, 19 ));
                        $('#CEP_UF_SIGLA-ALT').val(resultadoCEP.uf);
                });
            }
        }
    });

    function alterarEnderecoCobranca( id )
    {

        var url = "{{ route('enderecocobranca.find') }}/"+id;

        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                success:function( data )
                {
                    $('#IMB_CCB_ENDERECO-ALT').val(data.IMB_CCB_ENDERECO);
                    $('#IMB_CCB_BAIRRO-ALT').val(data.IMB_CCB_BAIRRO);
                    $('#CEP_CID_NOME-ALT').val(data.CEP_CID_NOME);
                    $('#IMB_CCB_DESTINATARIO-ALT').val(data.IMB_CCB_DESTINATARIO);
                    $('#IMB_CCB_ENDERECONUMERO-ALT').val(data.IMB_CCB_ENDERECONUMERO);
                    $('#IMB_CCB_ENDERECOCOMPLEMENTO-ALT').val(data.IMB_CCB_ENDERECOCOMPLEMENTO);
                    $('#IMB_CCB_CEP-ALT').val(data.IMB_CCB_CEP);
                    $("#IMB_CTR_ID-ENDCOB").val( id );
                    $("#modalEnderecoCobranca").modal('show');
                }
            }
        )


    }

    function gravarEnderecoCobranca()
    {
        var url = "{{ route('enderecocobranca.gravar') }}";

        var dados =
        {
            IMB_CCB_ENDERECO            : $("#IMB_CCB_ENDERECO-ALT").val(),
            IMB_CCB_BAIRRO              : $("#IMB_CCB_BAIRRO-ALT").val(),
            CEP_CID_NOME                : $("#CEP_CID_NOME-ALT").val(),
            IMB_CCB_DESTINATARIO        : $("#IMB_CCB_DESTINATARIO-ALT").val(),
            IMB_CCB_ENDERECONUMERO      : $("#IMB_CCB_ENDERECONUMERO-ALT").val(),
            IMB_CCB_ENDERECOCOMPLEMENTO : $("#IMB_CCB_ENDERECOCOMPLEMENTO-ALT").val(),
            IMB_CCB_CEP                 : $("#IMB_CCB_CEP-ALT").val(),
            CEP_UF_SIGLA                 : $("#CEP_UF_SIGLA-ALT").val(),
            IMB_CTR_ID                  : $("#IMB_CTR_ID-ENDCOB").val(),

        }

        console.log( dados );

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
                success:function()
                {
                    alert('Registro Gravado!')
                    $("#modalEnderecoCobranca").modal('hide');
                }
            }
        )


    }

    function EnderecoExcluir()
    {

        if (confirm("Confirma a exclusão deste endereço de cobrança?") == true)
        {
            var url = "{{ route('enderecocobranca.excluir') }}/"+$("#IMB_CTR_ID-ENDCOB").val();

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
                type:'post',
                success:function()
                {
                    alert('Endereço Excluído!')
                    $("#modalEnderecoCobranca").modal('hide');
                }
            });
        }


    }


</script>
@endpush
