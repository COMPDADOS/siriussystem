@extends('layout.app')

@section('scripttop')
<style>
    td{text-align:center;}
    .div-center
    {
        text-align:center;
    }

    .fundo-grey
    {
        background-color: #eff5f5;
    }
</style>
@endsection

@section('content')
<table  id="i-tbltipoimovel" class="table table-striped table-bordered table-hover" >
    <thead class="thead-dark">
        <tr >
        <th style="text-align:center"> Código Conta </th>
        <th style="text-align:center"> Tipo de Conta </th>
            <th style="text-align:center"> Nome da Conta </th>
            <th width="40" style="text-align:center">  Conta Bancária </th>
            <th width="40" style="text-align:center">  Situação </th>
            <th width="200" style="text-align:center"> Ações </th>        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<div class="table-footer" >
    <button id="i-button-novo" class="btn btn-primary" onClick="adicionar()">
        Adicionar
    </button>
</div>

<div class="modal" tabindex="-1" role="dialog" id="modalalteracao">
    <div class="modal-dialog "style="width:90%;" >
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Dados da Conta
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="FIN_CCX_ID" >
                <div class="portlet-body form">
                    <div class="form-body" >
                        <input type="hidden" id="FIN_CCX_ID" class="form-control" >
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Nome da Conta</label>
                                    <input type="text" name="FIN_CCX_DESCRICAO" class="form-control"
                                    id="FIN_CCX_DESCRICAO" maxlength="40">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="control-label">Tipo</label>
                                    <select class="form-control" id="FIN_CCX_TIPOCONTA">
                                    <option value="Caixa Interno">Caixa Interno</option>
                                    <option value="C/C">C/C</option>
                                    <option value="Poupança">Poupança</option>
                                    <option value="Investimento">Investimento</option>
                                    <option value="Cartão">Cartão</option>
                                    <option value="Outro">Outro</option>


                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" name="FIN_CCX_BANCO" class="form-control"
                                        data-checkbox="icheckbox_flat-blue" id="FIN_CCX_BANCO">
                                            Conta Bancária
                                </label>
                            </div>
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Desativado em</label>
                                    <input type="text" id=""  class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>NºBanco</label>
                                    <input type="text" class="form-control" id="FIN_CCI_BANCONUMERO"
                                    onkeypress="return isNumber(event)" onpaste="return false;">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Nome Banco</label>
                                    <input type="text" class="form-control" id="FIN_CCI_BANCONOME">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Nº Ag.</label>
                                    <input type="text" class="form-control" id="FIN_CCI_AGENCIANUMERO"
                                    onkeypress="return isNumber(event)" onpaste="return false;">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>DV Ag.</label>
                                    <input type="text" class="form-control" id="FIN_CCI_AGENCIADV">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Nome Agência.</label>
                                    <input type="text" class="form-control" id="FIN_CCI_AGENCIANOME">
                                </div>
                            </div>
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Coop.Nº</label>
                                    <input type="text" class="form-control" id="FIN_CCI_COOPNUMERO"
                                    onkeypress="return isNumber(event)" onpaste="return false;">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>DV</label>
                                    <input type="text" class="form-control" id="FIN_CCI_COOPDV">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Nº Conta Corrente</label>
                                    <input type="text" class="form-control" id="FIN_CCI_CONCORNUMERO"
                                    onkeypress="return isNumber(event)" onpaste="return false;">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>DV</label>
                                    <input type="text" class="form-control" id="FIN_CCI_CONCORDIGITO">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Nome Correntista</label>
                                    <input type="text" class="form-control" id="FIN_CCI_CONCORNOME" maxlength="40">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Pessoa</label>
                                    <select  class="form-control" id="FIN_CCI_PESSOA">
                                        <option value="F">Física</option>
                                        <option value="J">Jurídica</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>CPF/CNPJ</label>
                                    <input type="text" class="form-control" id="FIN_CCI_CGCCPF"
                                    onkeypress="return isNumber(event)" onpaste="return false;">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Endereço Correntista</label>
                                    <input type="text" class="form-control" id="FIN_CCI_ENDERECO" maxlength="40">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Cep</label>
                                    <input type="text" class="form-control" id="FIN_CCI_CEP"
                                    onkeypress="return isNumber(event)" onpaste="return false;">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Bairro</label>
                                    <input type="text" class="form-control" id="CEP_BAI_NOME" maxlength="20">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Cidade</label>
                                    <input type="text" class="form-control" id="CEP_CID_NOME" maxlength="20">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Orgão(UF)
                                    <select class="form-control" id="CEP_UF_SIGLA">
                                        <option value="AC">Acre</option>
                                        <option value="AL">Alagoas</option>
                                        <option value="AP">Amapá</option>
                                        <option value="AM">Amazonas</option>
                                        <option value="BA">Bahia</option>
                                        <option value="CE">Ceará</option>
                                        <option value="DF">Distrito Federal</option>
                                        <option value="ES">Espírito Santo</option>
                                        <option value="GO">Goiás</option>
                                        <option value="MA">Maranhão</option>
                                        <option value="MT">Mato Grosso</option>
                                        <option value="MS">Mato Grosso do Sul</option>
                                        <option value="MG">Minas Gerais</option>
                                        <option value="PA">Pará</option>
                                        <option value="PB">Paraíba</option>
                                        <option value="PR">Paraná</option>
                                        <option value="PE">Pernambuco</option>
                                        <option value="PI">Piauí</option>
                                        <option value="RJ">Rio de Janeiro</option>
                                        <option value="RN">Rio Grande do Norte</option>
                                        <option value="RS">Rio Grande do Sul</option>
                                        <option value="RO">Rondônia</option>
                                        <option value="RR">Roraima</option>
                                        <option value="SC">Santa Catarina</option>
                                        <option value="SP">São Paulo</option>
                                        <option value="SE">Sergipe</option>
                                        <option value="TO">Tocantins</option>
                                        <option value="EX">Estrangeiro</option>
                                    </select>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>ID Cliente Boleto</label>
                                    <input type="text" class="form-control" id="FIN_CCI_IDENTEMPRESA">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>ID Empresa Remessa</label>
                                    <input type="text" class="form-control" id="IMB_CCI_IDCLIENTEARQREM">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>$ Cobr.</label>
                                    <input type="text" class="form-control valor" id="FIN_CCI_COBRANCAVALOR">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Carteira</label>
                                    <input type="text" class="form-control" id="FIN_CCI_COBRANCACARTEIRA">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Variaçao</label>
                                    <input type="text" class="form-control" id="FIN_CCI_COBRANCAVARIACAO">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Código Transmissão</label>
                                    <input type="text" class="form-control" id="fin_cci_codigotransmissao">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Seq. Arq. Remessa</label>
                                    <input type="text" class="form-control" id="FIN_CCI_COBRANCAARQSEQ">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <label>Convênio</label>
                                <input type="text" class="form-control" id="FIN_CCI_CONVENIO">
                            </div>
                            <div class="col-md-2">
                                <label>Compl.Registro(033)</label>
                                <input type="text" class="form-control" id="FIN_CCI_COMPSANTANDERREMESSA">
                            </div>
                            <div class="col-md-2">
                                <label>Layout Cobrança</label>
                                <select class="form-control" id="FIN_CCO_COBRANCALAYOUT">
                                    <option value=""></option>
                                    <option value="CNAB240">CNAB240</option>
                                    <option value="CNAB400">CNAB400</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Forma Emissão/Distribuição</label>
                                <select class="form-control" id="FIN_CCI_TIPOEMISSAO">
                                    <option value=""></option>
                                    <option value="1">Somente Emite e não Registra no Banco</option>
                                    <option value="2">Banco emite e registra</option>
                                    <option value="3">Imobiliária emite e o banco somente processa o registro</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <label>Registrada
                                    <input type="checkbox"  class="form-control"
                                         id="FIN_CCI_COBRANCAREGISTRADA">
                                </label>
                            </div>
                            <div class="col-md-2">
                                <label>Rápida
                                    <input type="checkbox"  class="form-control"
                                        id="FIN_CCI_RAPIDAREGISTRO">
                                </label>
                            </div>
                            <div class="col-md-2">
                                <label>Novo Padrão
                                    <input type="checkbox"  class="form-control"
                                        id="FIN_CCX_ARQCOBRANCANOVOPADRAO">
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label>Forma</label>
                                <select class="form-control" id="FIN_CCI_TIPOEMISSAO">
                                    <option value=""></option>
                                    <option value="E">Impressão e entrega por responsabilidade da empresa</option>
                                    <option value="B">Impressão e entrega por responsabilidade do banco</option>
                                </select>

                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6 fundo-grey div-center">
                                <h4>Nosso Número</h4>
                                <div class="col-md-2">
                                    <label>Pré-fixo</label>
                                    <input type="text"  class="form-control"
                                         id="FIN_CCI_PREFIXONOSSONUMERO">
                                </div>
                                <div class="col-md-4">
                                    <label>Sequencia</label>
                                    <input type="text"  class="form-control"
                                         id="FIN_CCI_NOSSONUMERO"
                                         onkeypress="return isNumber(event)" onpaste="return false;">
                                </div>
                                <div class="col-md-2">
                                    <label>Algarismos</label>
                                    <input type="text"  class="form-control"
                                         id="FIN_CCI_NOSSONUMEROCASAS"
                                         onkeypress="return isNumber(event)" onpaste="return false;">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label>Nome do Layout</label>
                                    <input type="text"  class="form-control"
                                         id="fin_cci_LAYOUTCOBRANCA">
                            </div>
                            <div class="col-md-1">
                                <label>Flash</label>
                                    <input type="text"  class="form-control"
                                         id="FIN_CCI_CODIGOFLASH" title="Para cobranças ITAU">
                            </div>

                            <div class="col-md-3">
                                <label>Local Arquivos de Remessa</label>
                                    <input type="text"  class="form-control"
                                         id="FIN_CCI_COBRANCAARQREMLOC" >
                            </div>
                            <div class="col-md-5">
                                <label>Pix para boletos hibridos</label>
                                    <input type="text"  class="form-control"
                                         id="FIN_CCX_COBPIX" >
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <label>Convênio DOC/TED</label>
                                <input type="text"  class="form-control"
                                         id="fin_cci_conveniodocnovo" >
                            </div>
                            <div class="col-md-4">
                                <label>Local Arquivos Remessa DOC/TED</label>
                                <input type="text"  class="form-control"
                                         id="FIN_CCX_DOCPATH" >
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-primary" onClick="gravar()">Gravar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@push('script')
<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

<script>

    $(document).ready(function()
    {
        carga();
        $("#FIN_CCI_CGCCPF").on('blur', () =>
        {
            var pessoa = $("#FIN_CCI_PESSOA").val();
            if( pessoa == 'F')
            {
                if ( is_cpf( $("#FIN_CCI_CGCCPF").val() ) )
                {
                }
                else
                {
                    $('#FIN_CCI_CGCCPF').val('');
                    alert('Informe corretamente o CPF');
                }
            }
        })

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


        $('#FIN_CCI_CEP').on('blur', () =>
        {
            let token = document.head.querySelector('meta[name="csrf-token"]');
            if (token)
            {
                window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
            } else
            {
                console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
            }

            if ($.trim($('#FIN_CCI_CEP').val()) !== '')
            {
                $('#mensagem').html('(Aguarde, consultando CEP ...)');

                // NOVO CODIGO =============================================

                // Guardar o CEP do input.
                const cep = $('#FIN_CCI_CEP').val();

                // Construir a url com o CEP do input.
                // IMPORTANTE: na url, informar o parametro formato=json ao invés de formato=javascript.
                const urlBuscaCEP = `http://cep.republicavirtual.com.br/web_cep.php?formato=json&cep=${cep}`;

                // Realizar uma requisição HTTP GET na url.
                // O primeiro parâmetro é a url.
                // O segundo parâmetro é o callback, ou seja,
                // uma função que vai ser executada quando os dados forem retornados.
                // Essa função recebe um parâmetro que são os dados que a API retornou.
                $.get(urlBuscaCEP, (resultadoCEP) =>
                {
                    if (resultadoCEP.resultado)
                    {
                        // /$('#rua').val(`${resultadoCEP['tipo_logradouro']} ${resultadoCEP['logradouro']}`);
                        $('#FIN_CCI_ENDERECO').val(resultadoCEP.logradouro);
                        $('#CEP_BAI_NOME').val( resultadoCEP.bairro.substr(0, 19));
                        $('#CEP_CID_NOME').val(resultadoCEP.cidade.substr( 0, 19 ));
                        $('#CEP_UF_SIGLA').val(resultadoCEP.uf);
                    }
                    else
                    {
                        console.error('Erro ao carregar os dados do CEP.');
                    }
                });

            }
        });
    });



    function carga()
    {
        url = "{{route('contacaixa.carga')}}/N";
        console.log( url );

        $.getJSON( url, function( data)
        {

            linha = "";

            $("#i-tbltipoimovel>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
                var datainativo = moment( data[nI].FIN_CCX_DTHINATIVO ).format('DD/MM/YYYY');

                //alert( datainativo );

                if( datainativo == 'Invalid date' )
                datainativo = '-';



                linha =
                        '<tr>'+
                        '<td style="text-align:center valign="center">'+data[nI].FIN_CCX_ID+'</td>' +
                        '<td style="text-align:center valign="center">'+data[nI].FIN_CCX_TIPOCONTA+'</td>' +
                        '<td style="text-align:center valign="center">'+data[nI].FIN_CCX_DESCRICAO+'</td>' +
                        '<td style="text-align:center valign="center">'+data[nI].FIN_CCX_BANCO+'</td>' +
                        '<td style="text-align:center valign="center">'+datainativo+'</td>' +
                        '<td style="text-align:center" valign="center"> '+
                        '<a href=javascript:editar('+data[nI].FIN_CCX_ID+') class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"></span></a> '+
                        '<a href=javascript:apagar('+data[nI].FIN_CCX_ID+') class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a> '+
                        '<a href=javascript:dadosAdicionais('+data[nI].FIN_CCX_ID+') class="btn btn-sm btn-warning"><span title="Dados Adicionais" class="glyphicon glyphicon-tasks"></span></a> '+
                        '</td> '+
                        '</tr>';
                $("#i-tbltipoimovel").append( linha );
            }
        });

    }


    function adicionar( id )
    {

        $("#FIN_CCX_ID").val( '' )
        $("#FIN_CCX_DESCRICAO").val( '');
        $("#FIN_CCX_BANCO").val( '');
        $("#modalalteracao").modal('show');

    }

    function editar( id )
    {

        url = "{{route('contacaixa.find')}}/"+id;
        console.log( url );

        $.ajax(
        {
            url : url,
            datatype: 'json',
            async:false,
            success:function( data )
            {
//                alert( $("#FIN_CCX_DTHINATIVO").val());
                if( $("#FIN_CCX_DTHINATIVO").val() == '' )
                    var datainativo = 'ATIVO'
                else
                    var datainativo = moment( $("#FIN_CCX_DTHINATIVO").val() ).format('DD/MM/YYYY');


                    $("#FIN_CCX_TIPOCONTA").val( data.FIN_CCX_TIPOCONTA );
                    $("#FIN_CCX_ID").val( data.FIN_CCX_ID );
                $("#FIN_CCX_DESCRICAO").val( data.FIN_CCX_DESCRICAO );
                $("#FIN_CCX_BANCO").prop( 'checked',(data.FIN_CCX_BANCO == 'S') );
                $("#FIN_CCX_DTHINATIVO").val( datainativo );
                
                $("#FIN_CCI_BANCONUMERO").val( data.FIN_CCI_BANCONUMERO );
                $("#FIN_CCI_BANCONOME").val( data.FIN_CCI_BANCONOME );
                $("#FIN_CCI_AGENCIANUMERO").val( data.FIN_CCI_AGENCIANUMERO );
                $("#FIN_CCI_AGENCIADV").val( data.FIN_CCI_AGENCIADV );
                $("#FIN_CCI_AGENCIANOME").val( data.FIN_CCI_AGENCIANOME );
                $("#FIN_CCI_COOPNUMERO").val( data.FIN_CCI_COOPNUMERO );
                $("#FIN_CCI_COOPDV").val( data.FIN_CCI_COOPDV );
                $("#FIN_CCI_CONCORNUMERO").val( data.FIN_CCI_CONCORNUMERO );
                $("#FIN_CCI_CONCORDIGITO").val( data.FIN_CCI_CONCORDIGITO );
                $("#FIN_CCI_CONCORNOME").val( data.FIN_CCI_CONCORNOME );
                $("#FIN_CCI_PESSOA").val( data.FIN_CCI_PESSOA );
                $("#FIN_CCI_CGCCPF").val( data.FIN_CCI_CGCCPF );
                $("#FIN_CCI_ENDERECO").val( data.FIN_CCI_ENDERECO );
                $("#FIN_CCI_CEP").val( data.FIN_CCI_CEP );
                $("#CEP_BAI_NOME").val( data.CEP_BAI_NOME );
                $("#CEP_CID_NOME").val( data.CEP_CID_NOME );
                $("#CEP_UF_SIGLA").val( data.CEP_UF_SIGLA );
                $("#FIN_CCI_IDENTEMPRESA").val( data.FIN_CCI_IDENTEMPRESA );
                $("#IMB_CCI_IDCLIENTEARQREM").val( data.IMB_CCI_IDCLIENTEARQREM );
                $("#FIN_CCI_COBRANCAVALOR").val( dolarToReal(data.FIN_CCI_COBRANCAVALOR) );
                $("#FIN_CCI_COBRANCACARTEIRA").val( data.FIN_CCI_COBRANCACARTEIRA );
                $("#FIN_CCI_COBRANCAVARIACAO").val( data.FIN_CCI_COBRANCAVARIACAO );
                $("#fin_cci_codigotransmissao").val( data.fin_cci_codigotransmissao );
                $("#FIN_CCI_COBRANCAARQSEQ").val( data.FIN_CCI_COBRANCAARQSEQ );
                $("#FIN_CCI_CONVENIO").val( data.FIN_CCI_CONVENIO );
                $("#FIN_CCI_COMPSANTANDERREMESSA").val( data.FIN_CCI_COMPSANTANDERREMESSA );
                $("#FIN_CCO_COBRANCALAYOUT").val( data.FIN_CCO_COBRANCALAYOUT );
                $("#FIN_CCI_TIPOEMISSAO").val( data.FIN_CCI_TIPOEMISSAO );
                $("#FIN_CCI_COBRANCAREGISTRADA").prop( 'checked',(data.FIN_CCI_COBRANCAREGISTRADA == 'S') );
                $("#FIN_CCI_RAPIDAREGISTRO").prop( 'checked',(data.FIN_CCI_RAPIDAREGISTRO == 'S') );
                $("#FIN_CCX_ARQCOBRANCANOVOPADRAO").prop( 'checked',(data.FIN_CCX_ARQCOBRANCANOVOPADRAO == 'S') );
                $("#FIN_CCI_TIPOEMISSAO").val( data.FIN_CCI_TIPOEMISSAO );
                $("#FIN_CCI_PREFIXONOSSONUMERO").val( data.FIN_CCI_PREFIXONOSSONUMERO );
                $("#FIN_CCI_NOSSONUMERO").val( data.FIN_CCI_NOSSONUMERO );
                $("#FIN_CCI_NOSSONUMEROCASAS").val( data.FIN_CCI_NOSSONUMEROCASAS );
                $("#fin_cci_conveniodocnovo").val( data.fin_cci_conveniodocnovo );
                $("#FIN_CCX_DOCPATH").val( data.FIN_CCX_DOCPATH );
                $("#fin_cci_LAYOUTCOBRANCA").val( data.fin_cci_LAYOUTCOBRANCA );
                $("#FIN_CCI_CODIGOFLASH").val( data.FIN_CCI_CODIGOFLASH );
                $("#FIN_CCI_COBRANCAARQREMLOC").val( data.FIN_CCI_COBRANCAARQREMLOC );
                $("#FIN_CCX_COBPIX").val( data.FIN_CCX_COBPIX );
                
                $("#modalalteracao").modal('show');
            }
        });
    }

    function gravar()
    {

        url = "{{route('contacaixa.salvar')}}";

        var cobrancavalor = 0;
        if(  $("#FIN_CCI_COBRANCAVALOR").val() != '' )
            cobrancavalor = $("#FIN_CCI_COBRANCAVALOR").val();

        var sequenciarquivo=0;
        if(  $("#FIN_CCI_COBRANCAARQSEQ").val() != '' )
            sequenciarquivo = $("#FIN_CCI_COBRANCAARQSEQ").val();

        var carteira=0;
        if(  $("#FIN_CCI_COBRANCACARTEIRA").val() != '' )
            carteira = $("#FIN_CCI_COBRANCACARTEIRA").val();

        var variacao =0;
        if(  $("#FIN_CCI_COBRANCAVARIACAO").val() != '' )
            variacao = $("#FIN_CCI_COBRANCAVARIACAO").val();

            var casas =0;
        if(  $("#FIN_CCI_NOSSONUMEROCASAS").val() != '' )
            casas = $("#FIN_CCI_NOSSONUMEROCASAS").val();


        var coopnum =0;
        if(  $("#FIN_CCI_COOPNUMERO").val() != '' )
            coopnum = $("#FIN_CCI_COOPNUMERO").val();





        atm =
        {

            FIN_CCX_ID : $("#FIN_CCX_ID").val(),
            FIN_CCX_DESCRICAO : $("#FIN_CCX_DESCRICAO").val(),
            FIN_CCX_BANCO : simNao( $("#FIN_CCX_BANCO").prop('checked')),
            FIN_CCI_BANCONUMERO : $("#FIN_CCI_BANCONUMERO").val(),
            FIN_CCI_BANCONOME : $("#FIN_CCI_BANCONOME").val(),
            FIN_CCI_AGENCIANUMERO : $("#FIN_CCI_AGENCIANUMERO").val(),
            FIN_CCI_AGENCIADV     : $("#FIN_CCI_AGENCIADV").val(),
            FIN_CCI_AGENCIANOME : $("#FIN_CCI_AGENCIANOME").val(),
            FIN_CCI_COOPNUMERO     : coopnum,
            FIN_CCI_COOPDV     : $("#FIN_CCI_COOPDV").val(),
            FIN_CCI_CONCORNUMERO : $("#FIN_CCI_CONCORNUMERO").val(),
            FIN_CCI_CONCORDIGITO: $("#FIN_CCI_CONCORDIGITO").val(),
            FIN_CCI_CONCORNOME: $("#FIN_CCI_CONCORNOME").val(),
            FIN_CCI_PESSOA: $("#FIN_CCI_PESSOA").val(),
            FIN_CCI_CGCCPF : $("#FIN_CCI_CGCCPF").val(),
            FIN_CCI_ENDERECO : $("#FIN_CCI_ENDERECO").val(),
            FIN_CCI_CEP : $("#FIN_CCI_CEP").val(),
            CEP_BAI_NOME : $("#CEP_BAI_NOME").val(),
            CEP_CID_NOME : $("#CEP_CID_NOME").val(),
            CEP_UF_SIGLA : $("#CEP_UF_SIGLA").val(),
            FIN_CCI_IDENTEMPRESA : $("#FIN_CCI_IDENTEMPRESA").val(),
            IMB_CCI_IDCLIENTEARQREM : $("#IMB_CCI_IDCLIENTEARQREM").val(),
            FIN_CCI_COBRANCAVALOR : realToDolar( cobrancavalor ),
            FIN_CCI_COBRANCACARTEIRA : carteira,
            FIN_CCI_COBRANCAVARIACAO : variacao,
            fin_cci_codigotransmissao : $("#fin_cci_codigotransmissao").val(),
            FIN_CCI_COBRANCAARQSEQ : sequenciarquivo,
            FIN_CCI_CONVENIO : $("#FIN_CCI_CONVENIO").val(),
            FIN_CCI_COMPSANTANDERREMESSA : $("#FIN_CCI_COMPSANTANDERREMESSA").val(),
            FIN_CCO_COBRANCALAYOUT : $("#FIN_CCO_COBRANCALAYOUT").val(),
            FIN_CCI_TIPOEMISSAO : $("#FIN_CCI_TIPOEMISSAO").val(),
            FIN_CCI_COBRANCAREGISTRADA:  simNao( $("#FIN_CCI_COBRANCAREGISTRADA").prop('checked')),
            FIN_CCI_RAPIDAREGISTRO : simNao( $("#FIN_CCI_RAPIDAREGISTRO").prop('checked')),
            FIN_CCX_ARQCOBRANCANOVOPADRAO : simNao( $("#FIN_CCX_ARQCOBRANCANOVOPADRAO").prop('checked')),
            FIN_CCI_TIPOEMISSAO : $("#FIN_CCI_TIPOEMISSAO").val(),
            FIN_CCI_PREFIXONOSSONUMERO : $("#FIN_CCI_PREFIXONOSSONUMERO").val(),
            FIN_CCI_NOSSONUMERO : $("#FIN_CCI_NOSSONUMERO").val(),
            FIN_CCI_NOSSONUMEROCASAS : casas,
            fin_cci_conveniodocnovo : $("#fin_cci_conveniodocnovo").val(),
            FIN_CCX_DOCPATH : $("#FIN_CCX_DOCPATH").val(),
            fin_cci_LAYOUTCOBRANCA : $("#fin_cci_LAYOUTCOBRANCA").val(),
            FIN_CCI_CODIGOFLASH : $("#FIN_CCI_CODIGOFLASH").val(),
            FIN_CCI_COBRANCAARQREMLOC : $("#FIN_CCI_COBRANCAARQREMLOC").val(),
            FIN_CCX_COBPIX : $("#FIN_CCX_COBPIX").val(),
            FIN_CCX_TIPOCONTA : $("#FIN_CCX_TIPOCONTA").val(),
            
            
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
            url : url,
            datatype: 'json',
            async:false,
            data:atm,
            type:"post",
            success:function( data )
            {
                console.log(data);
                alert('Gravado');
                carga();
                $("#modalalteracao").modal('hide');

            }
        });
    }

    function cancelar()
    {
        $("#modalalteracao").modal('hide');
    }

    function apagar( id )
    {
        Swal.fire({
        title: 'Tem certeza que deseja Excluir?',
        text: "Se apagar o registro, será um processo irreversível!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Confirmar Exclusão'
        }).then((result) =>
        {
            if (result.value)
            {
                var url = "{{ route('contacaixa.inativar')}}/"+id;

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
                        console.log( data )
                        Swal.fire(
                        {
                            position: 'center',
                            icon: 'success',
                            title: 'Registro inativado com Sucesso!',
                            showConfirmButton: true,
                            timer: 3500
                        });
                        carga();
                    }
                });
            }
        });


    }

    function dadosAdicionais()
    {
        $("#modaldadosadicionais").modal('show');
    }

</script>
@endpush


