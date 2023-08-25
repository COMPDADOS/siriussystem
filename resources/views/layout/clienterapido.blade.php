@section( 'scripttop')
<style>
.td-center
  {
    text-align:center;
  }

.fundo-cinza
{
    background-color: #DCDCDC;
}
</style>

@endsection

<div class="modal" tabindex="-1" role="dialog" id="modalnovocliente">
    <div class="modal-dialog "style="width:80%;" >
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Novo Cadastro do Cliente
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-5">
                                <label class="label-control">Nome</label>
                                <input type="text" class="form-control" id="IMB_CLT_NOME">
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Pessoa</label>
                                <select class="form-control"  id="IMB_CLT_PESSOA">
                                    <option value="F">Física</option>
                                    <option value="J">Jurídica</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="label-control">CPF</label>
                                <input type="text" class="form-control" id="IMB_CLT_CPF"
                                onkeypress="return isNumber(event)" onpaste="return false;">
                            </div>
                            <div class="col-md-3">
                                <label class="label-control">RG</label>
                                <input type="text" class="form-control" id="IMB_CLT_RG">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12 td-center">
                                <label class="label-control">Email</label>
                                <input type="email" class="form-control" id="IMB_CLT_EMAIL">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label>Endereço</label>
                                    <input maxlength="40" id="IMB_CLT_RESEND"
                                                type="text" class="form-control">
                                </div>
                            </div>
                    
                            <div class="col-md-2 ">
                                <div class="form-group">
                                    <label>Número</label>
                                    <input maxlength="10" id="IMB_CLT_RESENDNUM"
                                                type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4 ">
                                <div class="form-group">
                                    <label>Complemento</label>
                                    <input maxlength="20" name="IMB_CLT_RESENDCOM"
                                                type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                  
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Cep</label>
                                    <input maxlength="8" autocomplete="off"
                                      type="text" id="IMB_CLT_RESENDCEP" class="form-control"
                                      onkeypress="return isNumber(event)" onpaste="return false;">
                                </div>
                            </div>
                    
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Bairro</label>
                                    <input maxlength="20" id="CEP_BAI_NOMERES"
                                      type="text" class="form-control">
                                </div>
                            </div>
                    
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Cidade</label>
                                    <input maxlength="20" id="CEP_CID_NOMERES"
                                    type="text"  class="form-control">
                                </div>
                            </div>
                    
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>UF</label>
                                    <input  maxlength="2" id="CEP_UF_SIGLARES"
                                    type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                  <HR>
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="col-md-2">
                                <h4>Telefone (I)</h4>
                            </div>
                            <div class="col-md-2">
                                <label class="label-control">DDD</label>
                                <input type="text" class="form-control" id="IMB_CLT_DDD1" maxlength="2"
                                    onkeypress="return isNumber(event)" onpaste="return false;">

                            </div>
                            <div class="col-md-4">
                                <label class="label-control">Número</label>
                                <input type="text" class="form-control" id="IMB_CLT_TELEFONE1" 
                                    onkeypress="return isNumber(event)" onpaste="return false;" maxlength="10">

                            </div>
                            <div class="col-md-4">
                                <label class="label-control">Tipo</label>
                                <input type="text" class="form-control" id="IMB_TLF_TIPOTELEFONE1" maxlength="40"
                                    placeholder="Whatsapp, com., res., etc...">
                            </div>
                        </div>                                
                            <div class="col-md-12"> 
                                <div class="col-md-2">
                                    <h4>Telefone (II)</h4>
                                </div>
                                <div class="col-md-2">
                                    <label class="label-control">DDD</label>
                                    <input type="text" class="form-control" id="IMB_CLT_DDD2"
                                    onkeypress="return isNumber(event)" onpaste="return false;" maxlength="2">
                                </div>
                                <div class="col-md-4">
                                    <label class="label-control">Número</label>
                                    <input type="text" class="form-control" id="IMB_CLT_TELEFONE2"
                                    onkeypress="return isNumber(event)" onpaste="return false;" maxlength="10">
                                </div>
                                <div class="col-md-4">
                                    <label class="label-control">Tipo</label>
                                    <input type="text" class="form-control" id="IMB_TLF_TIPOTELEFONE2" maxlength="40"
                                        placeholder="Whatsapp, com., res., etc...">
                                </div>
                            </div>                                
                        
                    </div>
                    <hr>
                    <div class="form-actions right">
                        <button type="button" class="btn default " id="i-btn-cancelar" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn blue " id="i-btn-gravar" onclick="gravarCliente()">
                            <i class="fa fa-check"></i> Gravar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.c
om/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

<script>

$('#IMB_CLT_RESENDCEP').on('blur', () => {

let token = document.head.querySelector('meta[name="csrf-token"]');
 if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
  } else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

console.log('entrou');
  if ($.trim($('#IMB_CLT_RESENDCEP').val()) !== '') {
    $('#mensagem').html('(Aguarde, consultando CEP ...)');

    // NOVO CODIGO =============================================

    // Guardar o CEP do input.
    const cep = $('#IMB_CLT_RESENDCEP').val();

    // Construir a url com o CEP do input.
    // IMPORTANTE: na url, informar o parametro formato=json ao invés de formato=javascript.
    const urlBuscaCEP = `http://cep.republicavirtual.com.br/web_cep.php?formato=json&cep=${cep}`;

    // Realizar uma requisição HTTP GET na url.
    // O primeiro parâmetro é a url.
    // O segundo parâmetro é o callback, ou seja,
    // uma função que vai ser executada quando os dados forem retornados.
    // Essa função recebe um parâmetro que são os dados que a API retornou.
    $.get(urlBuscaCEP, (resultadoCEP) => {

      console.log('API retornou: ');
      console.log(resultadoCEP);

      if (resultadoCEP.resultado) {
        // /$('#rua').val(`${resultadoCEP['tipo_logradouro']} ${resultadoCEP['logradouro']}`);
        $('#IMB_CLT_RESEND').val(resultadoCEP.tipo_logradouro+' '+resultadoCEP.logradouro);
        $('#CEP_BAI_NOMERES').val( resultadoCEP.bairro.substr(0, 19));
        $('#CEP_CID_NOMERES').val(resultadoCEP.cidade.substr( 0, 19 ));
        $('#CEP_UF_SIGLARES').val(resultadoCEP.uf);
      } else {
        console.error('Erro ao carregar os dados do CEP.');
      }
    });

    // FIM NOVO CODIGO.
  }
});

    function gravarCliente()
    {

    
/*        if( $("#IMB_CLT_EMAIL").val() == '' )
        {
            alert('Informe o email!');
            return false;
        }
*/
        if( $("#IMB_CLT_DDD1").val() == '' )
        {
            alert('Informe dados completos do primeiro telefone incluindo o DDD');
            return false;
        }

        if( $("#IMB_CLT_TELEFONE1").val() == '' )
        {
            alert('Informe dados completos do primeiro telefone incluindo o DDD');
            return false;
        }

        if( $("#IMB_CLT_DDD1").val() == '' )
        {
            alert('Informe dados completos do primeiro telefone incluindo o DDD');
            return false;
        }

        if( $("#IMB_CLT_TELEFONE2").val() == '' && $("#IMB_CLT_DDD2").val() != '' )
        {
            alert('Verifique informações no telefone II');
            return false;
        }

        if( $("#IMB_CLT_TELEFONE2").val() != '' && $("#IMB_CLT_DDD2").val() == '' )
        {
            alert('Verifique informações no telefone II');
            return false;
        }


        cliente = 
        {
            IMB_CLT_NOME    : $("#IMB_CLT_NOME").val(),
            IMB_CLT_CPF     : $("#IMB_CLT_CPF").val(),
            IMB_CLT_RG      : $("#IMB_CLT_RG").val(),
            IMB_CLT_EMAIL   : $("#IMB_CLT_EMAIL").val(),
            IMB_CLT_RESEND : $("#IMB_CLT_RESEND").val(),
            CEP_BAI_NOMERES : $("#CEP_BAI_NOMERES").val(),
            CEP_CID_NOMERES : $("#CEP_CID_NOMERES").val(),
            CEP_UF_SIGLARES : $("#CEP_UF_SIGLARES").val(),
            IMB_CLT_RESENDCEP : $("#IMB_CLT_RESENDCEP").val(),
            IMB_CLT_PESSOA : $("#IMB_CLT_PESSOA").val(),
            IMB_CLT_PRECADASTRO: 'S',
        }


        $.ajaxSetup({
            headers:
            {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });

        console.log( cliente );



        url = "{{ route( 'cliente.store' ) }}";

        $.ajax( 
            {
                url     : url,
                type    : 'post',
                dataType: 'json',
                data    : cliente,
                async   : false,
                success : function(data)
                {
                    telefonesSalvarRapido( data );
                    alert('Cliente cadastrado com sucesso!');
                    $("#modalnovocliente").modal('hide');   
                },
                error   : function (xhr, ajaxOptions, thrownError) 
                {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });



    }

    function telefonesSalvarRapido( id )
    {

        alert('id '+id );
        $.ajaxSetup({
            headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });
  
        telefone = 
        {
            IMB_TLF_ID_CLIENTE      : id,
            IMB_TLF_DDD             : $("#IMB_CLT_DDD1").val(),
            IMB_TLF_NUMERO          :  $("#IMB_CLT_TELEFONE1").val(),
            IMB_TLF_TIPOTELEFONE    : $("#IMB_TLF_TIPOTELEFONE1").val(),
        };

        var url = "{{ route('telefone.salvar')}}/"+
            id+'/'+
                $("#IMB_CLT_DDD1").val()+'/'+
                $("#IMB_CLT_TELEFONE1").val()+'/'+
                $("#IMB_TLF_TIPOTELEFONE1").val();
    
        console.log( 'url fone: '+url );

        $.ajax(
        {
            url:url,
            type:'post',
            datatype:'json',
            async:false,
            success:function()
            {

            },
            error: function()
            {
            }
        });

        //TELEFONE2
        if( $("#IMB_CLT_DDD2").val() != '' )
        {

            $.ajaxSetup({
                headers:
                {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            });
  
            telefone = 
            {
                IMB_TLF_ID_CLIENTE      : id,
                IMB_TLF_DDD             : $("#IMB_CLT_DDD2").val(),
                IMB_TLF_NUMERO          :  $("#IMB_CLT_TELEFONE2").val(),
                IMB_TLF_TIPOTELEFONE    : $("#IMB_TLF_TIPOTELEFONE2").val(),
            };

            var url = "{{ route('telefone.salvar')}}/"+
                
            id+'/'+
                $("#IMB_CLT_DDD2").val()+'/'+
                $("#IMB_CLT_TELEFONE2").val()+'/'+
                $("#IMB_TLF_TIPOTELEFONE2").val();

            $.ajax(
            {
                url:url,
                type:'post',
                datatype:'json',
                async:false,
                success:function()
                {

                },
                error: function()
                {
                    alert('Erro na gravação do telefone -> '+
                    id+'/'+
                    $("#IMB_CLT_DDD2").val()+'/'+
                    $("#IMB_CLT_TELEFONE2").val()+'/'+
                    $("#IMB_TLF_TIPOTELEFONE2").val());
                }
            });

        }
    }
  
</script>

@endpush
