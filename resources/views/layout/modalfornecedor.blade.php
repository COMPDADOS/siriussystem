<div class="modal fade" id="modalfornecedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog "style="width:90%;" >
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Fonecedor
                        </div>
                    </div>

                    <div class="portlet-body form">
                        <div class="row">
                            <hr>
                        </div>

                        <input type="hidden" id="IMB_EEP_ID">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2 div-center">
                                    <label class="control-label">Pessoa</label>
                                    <select class="form-control" id="IMB_EEP_PESSOA">
                                            <option value="">Selecione</option>
                                            <option value="F" selected >Física</option>
                                            <option value="J">Jurídica</option>
                                    </select>
                                </div>
                                <div class="col-md-2 div-center">
                                    <label class="control-label">CNPJ</label>
                                    <input class="form-control" type="text" id="IMB_EEP_CGC"
                                        onkeypress="return isNumber(event)" onpaste="return false;">
                                </div>
                                <div class="col-md-4 div-center">
                                    <label class="control-label">Razão Social</label>
                                    <input class="form-control" type="text" id="IMB_EEP_RAZAOSOCIAL" maxlength="40">

                                </div>
                                <div class="col-md-4 div-center">
                                    <label class="control-label">Nome Fantasia</label>
                                    <input class="form-control" type="text" id="IMB_EEP_NOMEFANTASIA" maxlength="20">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <hr>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2 div-center espaco-entre-cel">
                                    <label class="control-label">CEP</label>
                                    <input class="form-control" type="text" id="IMB_EEP_ENDERECOCEP"
                                        onkeypress="return isNumber(event)" onpaste="return false;" maxlength="8">
                                </div>
                                <div class="col-md-3 div-center espaco-entre-cel">
                                    <label class="control-label">Endereço(logradouro)</label>
                                    <input class="form-control" type="text" id="IMB_EEP_ENDERECO" maxlength="40">
                                </div>
                                <div class="col-md-1 div-center pad-left-zero">
                                    <label class="control-label">Nº</label>
                                    <input class="form-control" type="text" id="IMB_EEP_ENDERECONUMERO" maxlength="10">
                                </div>
                                <div class="col-md-3 div-center espaco-entre-cel">
                                    <label class="control-label">Bairro</label>
                                    <input class="form-control" type="text" id="CEP_BAI_NOME" maxlength="40">
                                </div>
                                <div class="col-md-2 div-center espaco-entre-cel">
                                    <label class="control-label">Cidade</label>
                                    <input class="form-control" type="text" id="CEP_CID_NOME" maxlength="30">
                                </div>
                                <div class="col-md-1 div-center espaco-entre-cel">
                                    <label class="control-label">UF</label>
                                    <select class="form-control" id="CEP_UF_SIGLA">
                                    <option value="AC">AC</option>
                                    <option value="AL">AL</option>
                                    <option value="AP">AP</option>
                                    <option value="AM">AM</option>
                                    <option value="BA">BA</option>
                                    <option value="CE">CE</option>
                                    <option value="DF">DF</option>
                                    <option value="ES">ES</option>
                                    <option value="GO">GO</option>
                                    <option value="MA">MA</option>
                                    <option value="MT">MT</option>
                                    <option value="MS">MS</option>
                                    <option value="MG">MG</option>
                                    <option value="PA">PA</option>
                                    <option value="PB">PB</option>
                                    <option value="PR">PR</option>
                                    <option value="PE">PE</option>
                                    <option value="PI">PI</option>
                                    <option value="RJ">RJ</option>
                                    <option value="RN">RN</option>
                                    <option value="RS">RS</option>
                                    <option value="RO">RO</option>
                                    <option value="RR">RR</option>
                                    <option value="SC">SC</option>
                                    <option value="SP">SP</option>
                                    <option value="SE">SE</option>
                                    <option value="TO">TO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <hr>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4 div-center">
                                    <label class="control-label">Contato (1)</label>
                                    <input class="form-control" type="text" id="IMB_EEP_CONTATO1" maxlength="40">
                                </div>
                                <div class="col-md-4 div-center">
                                    <label class="control-label">Contato (2)</label>
                                    <input class="form-control" type="text" id="IMB_EEP_CONTATO2" maxlength="40">
                                </div>
                                <div class="col-md-4 div-center">
                                    <label class="control-label">Contato (3)</label>
                                    <input class="form-control" type="text" id="IMB_EEP_CONTATO3" maxlength="40">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <hr>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6 div-center">
                                    <label class="control-label">URL(site)</label>
                                    <input class="form-control" type="text" id="IMB_EEP_URL" >
                                </div>
                                <div class="col-md-6 div-center">
                                    <label class="control-label">Email</label>
                                    <input class="form-control" type="email" id="IMB_EEP_EMAIL" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <hr>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <label class="control-label" >CFC Padrão</label>
                                    <select  class="select2" id="FIN_CFC_ID">
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label" >Sub-Conta Padrão</label>
                                    <select  class="select2" id="FIN_SBC_ID">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 div-center">
                                <div class="col-md-12 div-center">
                                    <label class="control-label">Deixe aqui gravado o PIX para este fornecedor</label>
                                    <input class="form-control div-center" type="text" id="IMB_EEP_PIX">
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-8">
                        </div>
                        <div class="co-md-2">
                            <button type="button" class="btn btn-primary form-control" onClick="gravarFornecedor()">Gravar</button>
                        </div>
                        <div class="co-md-2">
                            <button type="button" class="btn btn-danger form-control" data-dismiss="modal">Cancelar</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>


    cargaCfc();
    cargaSubConta();

    $('#IMB_EEP_ENDERECOCEP').on('blur', () => {

        let token = document.head.querySelector('meta[name="csrf-token"]');
         if (token) {
            window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
          } else {
            console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
        }

          if ($.trim($('#IMB_EEP_ENDERECOCEP').val()) !== '') {
            $('#mensagem').html('(Aguarde, consultando CEP ...)');

            // NOVO CODIGO =============================================

            // Guardar o CEP do input.
            const cep = $('#IMB_EEP_ENDERECOCEP').val();

            // Construir a url com o CEP do input.
            // IMPORTANTE: na url, informar o parametro formato=json ao invés de formato=javascript.
            const urlBuscaCEP = 'https://viacep.com.br/ws/'+cep+'/json';

            // Realizar uma requisição HTTP GET na url.
            // O primeiro parâmetro é a url.
            // O segundo parâmetro é o callback, ou seja,
            // uma função que vai ser executada quando os dados forem retornados.
            // Essa função recebe um parâmetro que são os dados que a API retornou.
            $.get(urlBuscaCEP, (resultadoCEP) => {

                $('#IMB_EEP_ENDERECO').val(resultadoCEP.logradouro);
                $('#CEP_BAI_NOME').val(resultadoCEP.bairro.substr(0,40));
                $('#CEP_CID_NOME').val(resultadoCEP.localidade.substr( 0, 30 ));
                $('#CEP_UF_SIGLA').val(resultadoCEP.uf);

            });

            // FIM NOVO CODIGO.
          }
        });

    function gravarFornecedor()
    {

        if( $("#IMB_EEP_RAZAOSOCIAL").val() == '' )
        {
            alert('Informe a razão social ou o nome civil, caso seja pessoa física');
            return false;
        }
        var id = $("#IMB_EEP_ID").val();

        var url = "{{ route('fornecedores.salvar') }}";


        var dados =
        {
            IMB_EEP_ID : $("#IMB_EEP_ID").val(),
            IMB_EEP_NOMEFANTASIA : $("#IMB_EEP_NOMEFANTASIA").val(),
            IMB_EEP_RAZAOSOCIAL : $("#IMB_EEP_RAZAOSOCIAL").val(),
            IMB_EEP_ENDERECO : $("#IMB_EEP_ENDERECO").val(),
            IMB_EEP_ENDERECONUMERO : $("#IMB_EEP_ENDERECONUMERO").val(),
            IMB_EEP_ENDERECOCEP : $("#IMB_EEP_ENDERECOCEP").val(),
            IMB_EEP_EMAIL : $("#IMB_EEP_EMAIL").val(),
            IMB_EEP_URL : $("#IMB_EEP_URL").val(),
            IMB_EEP_CONTATO1 : $("#IMB_EEP_CONTATO1").val(),
            IMB_EEP_CONTATO2 : $("#IMB_EEP_CONTATO2").val(),
            IMB_EEP_CONTATO3 : $("#IMB_EEP_CONTATO3").val(),
            IMB_EEP_CGC : $("#IMB_EEP_CGC").val(),
            IMB_EEP_PESSOA : $("#IMB_EEP_PESSOA").val(),
            IMB_EEP_OBSERVACAO : $("#IMB_EEP_OBSERVACAO").val(),
            CEP_BAI_NOME : $("#CEP_BAI_NOME").val(),
            CEP_CID_NOME : $("#CEP_CID_NOME").val(),
            CEP_UF_SIGLA : $("#CEP_UF_SIGLA").val(),
            FIN_CFC_ID : $("#FIN_CFC_ID").val(),
            FIN_SBC_ID : $("#FIN_SBC_ID").val(),
            IMB_EEP_PIX : $("#IMB_EEP_PIX").val(),

        }

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
                data:dados,
                success:function()
                {
                    alert('Registro gravado');
                    $("#modalfornecedor").modal('hide');

                }
            }
        )



    }

    function alterarFornecedor( id )
    {
        var url = "{{ route('fornecedores.find') }}/"+id;

        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                success:function( data )
                {
                    console.log(data);

                    $("#IMB_EEP_ID").val( data.IMB_EEP_ID);
                    $("#IMB_EEP_NOMEFANTASIA").val( data.IMB_EEP_NOMEFANTASIA );
                    $("#IMB_EEP_RAZAOSOCIAL").val(data.IMB_EEP_RAZAOSOCIAL );
                    $("#IMB_EEP_ENDERECO").val(data.IMB_EEP_ENDERECO );
                    $("#IMB_EEP_ENDERECONUMERO").val(data.IMB_EEP_ENDERECONUMERO );
                    $("#IMB_EEP_ENDERECOCEP").val(data.IMB_EEP_ENDERECOCEP );
                    $("#IMB_EEP_EMAIL").val(data.IMB_EEP_EMAIL );
                    $("#IMB_EEP_PIX").val(data.IMB_EEP_PIX );
                    $("#IMB_EEP_URL").val(data.IMB_EEP_URL );
                    $("#IMB_EEP_CONTATO1").val(data.IMB_EEP_CONTATO1 );
                    $("#IMB_EEP_CONTATO2").val(data.IMB_EEP_CONTATO2 );
                    $("#IMB_EEP_CONTATO3").val(data.IMB_EEP_CONTATO3 );
                    $("#IMB_EEP_CGC").val(data.IMB_EEP_CGC );
                    $("#IMB_EEP_PESSOA").val(data.IMB_EEP_PESSOA );
                    $("#IMB_EEP_OBSERVACAO").val(data.IMB_EEP_OBSERVACAO );
                    $("#CEP_BAI_NOME").val(data.CEP_BAI_NOME );
                    $("#CEP_CID_NOME").val(data.CEP_CID_NOME );
                    $("#CEP_UF_SIGLA").val(data.CEP_UF_SIGLA );
                    $("#FIN_CFC_ID").val(data.FIN_CFC_ID );
                    $("#FIN_SBC_ID").val(data.FIN_SBC_ID );

                    $("#modalfornecedor").modal('show');

                }
            }
        )

    }

    function novoFornecedor()
    {

        $("#IMB_EEP_ID").val('' );
        $("#IMB_EEP_NOMEFANTASIA").val('');
        $("#IMB_EEP_RAZAOSOCIAL").val( '');
        $("#IMB_EEP_ENDERECO").val('' );
        $("#IMB_EEP_ENDERECONUMERO").val('');
        $("#IMB_EEP_ENDERECOCEP").val('');
        $("#IMB_EEP_EMAIL").val('');
        $("#IMB_EEP_URL").val('');
        $("#IMB_EEP_CONTATO1").val('');
        $("#IMB_EEP_CONTATO2").val('');
        $("#IMB_EEP_CONTATO3").val('');
        $("#IMB_EEP_CGC").val('');
        $("#IMB_EEP_PESSOA").val('');
        $("#IMB_EEP_OBSERVACAO").val('');
        $("#CEP_BAI_NOME").val('');
        $("#CEP_CID_NOME").val('');
        $("#CEP_UF_SIGLA").val('');
        $("#FIN_CFC_ID").val('');
        $("#FIN_SBC_ID").val('');

        $("#modalfornecedor").modal('show');

    }

    function cargaCfc()
    {
        $.getJSON( "{{route('cfc.carga')}}", function( data )
        {
            $("#FIN_CFC_ID").empty();

            linha =  '<option value="">Informe um CFC</option>';
            $("#FIN_CFC_ID").append( linha );
            for( nI=0;nI < data.length;nI++)
            {
                linha =
                    '<option value="'+data[nI].FIN_CFC_ID+'">'+
                    data[nI].FIN_CFC_DESCRICAO+'<b>('+data[nI].FIN_CFC_ID+')</b></option>';
                $("#FIN_CFC_ID").append( linha );
            }
            $("#FIN_CFC_ID").select2({
                placeholder: 'Selecione o CFC',
                width: null
            });


        });


    }

    function cargaSubConta()
    {
        $.getJSON( "{{route('subconta.carga')}}", function( data )
        {
            $("#FIN_SBC_ID").empty();

            linha =  '<option value="">Informe um CFC</option>';
            $("#FIN_SBC_ID").append( linha );
            for( nI=0;nI < data.length;nI++)
            {
                linha =
                    '<option value="'+data[nI].FIN_SBC_ID+'">'+
                    data[nI].FIN_SBC_DESCRICAO+'</option>';
                $("#FIN_SBC_ID").append( linha );
            }
            $("#FIN_SBC_ID").select2({
                placeholder: 'Selecione a Sub-conta',
                width: null
            });


        });

    }


</script>
@endpush
