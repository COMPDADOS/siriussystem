<div class="modal fade" id="modalsolicitacao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog "style="width:90%;" >
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Chamado
                        </div>
                    </div>

                    <div class="portlet-body form">

                        <input type="hidden" id="IMB_SOL_ID">
                        <input type="hidden" id="IMB_IMV_ID-SOL">
                        <input type="hidden" id="IMB_CLT_ID-SOL">
                        <input type="hidden" id="IMB_CTR_ID-SOL">

                        <div class="row row-top-margin-normal">
                            <div class="col-md-12 row-top-margin-normal">
                                <div class="col-md-2 div-center row-top-margin-normal">
                                    <label class="control-label">Tipo do Contato</label>
                                    <select class="form-control" id="IMB_SOL_TIPOSOLICITANTE">
                                        <option value=""></option>
                                        <option value="">Selecione</option>
                                        <option value="LT">Locatário</option>
                                        <option value="FD">Fiador</option>
                                        <option value="PP">Locador/Prop.venda</option>
                                        <option value="CP">Comprador</option>
                                    </select>
                                </div>
                                <div class="col-md-4 row-top-margin-normal">
                                    <label class="conttrol-label">
                                        <a href="javascript:pesquisarCliente();"> <i class="fa fa-search" aria-hidden="true"></i> </a>
                                        Cliente
                                    </label>
                                    <input class="form-control" type="text" id="IMB_CLT_NOME-SOL"
                                            readonly  placeholder="Click no botão para localizar o cliente">
                                </div>
                                <div class="col-md-4 row-top-margin-normal">
                                    <label class="conttrol-label">
                                        <a href="javascript:pesquisarImovelSol();"> <i class="fa fa-search" aria-hidden="true"></i> </a>
                                        Imóvel
                                    </label>
                                    <input class="form-control" type="text" id="enderecoimovel-SOL" readonly placeholder="Click no botão para localizar o imóvel">
                                </div>
                                <div class="col-md-2 row-top-margin-normal">
                                    <label class="conttrol-label">
                                        <a href="javascript:pesquisarImovelSol();"> <i class="fa fa-search" aria-hidden="true"></i> </a>
                                        Pasta
                                    </label>
                                    <input class="form-control" type="text" id="IMB_CTR_REFERENCIA-SOL" readonly >
                                </div>
                                

                                <div class="col-md-2 div-center encondido" id="dadoscontrato">
                                    <h6 id="i-referencia-sol"></h6>
                                    <p>
                                    <h6 id="i-contrato-situacao-sol"></h6></p>
                                </div>
                            </div>
                            <div class="col-md-12 row-top-margin-normal">
                                <div class="col-md-10 div-center row-top-margin-normal">
                                    <label class="control-label"><b><u>Titulo</u></b></label>
                                    <input class="form-control" type="text" id="IMB_SOL_TITULO-SOL">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="portlet box blue">

                    <div class="portlet-title">
                    </div>

                    <div class="portlet-body form">
                        <div class="row row-top-margin-normal">
                            <div class="col-md-12 row-top-margin-normal">
                                <div class="col-md-3 div-center row-top-margin-normal">
                                    <label class="control-label">Data</label>
                                    <input class="form-control" type="date" id="IMB_SOL_DTHATIVO-ALT" value="{{date('Y-m-d')}}">
                                </div>
                                <div class="col-md-3 div-center row-top-margin-normal">
                                    <label class="control-label">Fechar Até</label>
                                    <input class="form-control" type="date" id="IMB_SOL_DATAPREVISAO-ALT">
                                </div>
                                <div class="col-md-3 div-center row-top-margin-normal">
                                    <label class="control-label">Prioridade</label>
                                    <select class="form-control" id="IMB_SOL_PRIORIDADE-ALT">
                                        <option value="">Selecione</option>
                                        <option value="B">Baixa</option>
                                        <option value="M">Média</option>
                                        <option value="A">Alta</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-12 row-top-margin-normal">
                                <div class="col-md-3 div-center row-top-margin-normal">
                                    <label class="control-label">Tipo do Chamado</label>
                                    <select class="form-control" id="IMB_TPS_ID-ALT">
                                    </select>
                                </div>
                                <div class="col-md-3 div-center row-top-margin-normal">
                                    <label class="control-label">Direcionar para</label>
                                    <select class="form-control" id="IMB_ATD_IDDESTINO-ALT">
                                    </select>
                                </div>
                                <div class="col-md-2 div-center row-top-margin-normal">
                                    <label class="control-label">Atividade Pública</label>
                                    <input  class="form-control" type="checkbox" name="i-publica" id="i-publica" checked></label>
                                </div>
                                
                            </div>
                            <div class="col-md-12 row-top-margin-normal">
                                <div class="col-md-11 row-top-margin-normal">
                                    <h6 class="div-center"><u>Descrição do Chamado</u></h6>
                                    <textarea class="form-control" id="IMB_SOL_OBSERVACAO-alt" cols="100%" rows="5"></textarea>
                                </div>
                                <div class="col-md-1 row-top-margin-normal div-center">
                                    <p><hr></p>
                                    <p><hr></p>
                                    <a title="Visualizar os Releases" href="javascript:releases()">
                                        <i class="fa fa-commenting-o" style="font-size:36px;color:blue"></i>
                                     </a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label">Notificar também o colaborador</label>
                            <select class="form-control" id="IMB_ATD_IDNOTIFEXTRA-ALT">
                            </select>

                        </div>

                    </div>

                    <div class="col-md-12 div-center">
                        <span><h5 id="IMB_SOL_DATAFECHAMENTO-ALT"></h5></span>
                        <span class="escondido" id="i-reabrir"><button class="btn btn-success">Reabrir Chamado</button></span>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-8">
                        </div>
                        <div class="co-md-2">
                            <button type="button" class="btn btn-primary form-control" onClick="gravarSolicitacao()">Gravar</button>
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
@include('layout.modallocalizacliente')
<div class="modal fade" id="modallocimovelsol" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog"  style="width:90%;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Imovel
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
                </div>
                <div class="portlet-body form">
                    <input type="hidden" id="IMB_IMV_ID-LOCIMV">
                    <input type="hidden" id="IMB_CTR_ID-LOCIMV">
                    <input type="hidden" id="ENDIMOVEL-LOCIMV">
                    <input type="hidden" id="IMB_CLT_IDLOCADOR-SOL">
                    <input type="hidden" id="IMB_CLT_IDLOCATARIO-SOL">
                    <input type="hidden" id="IMB_CLT_IDFIADOR-SOL">

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="text" id="i-strimvsol"
                                placeholder="digite aqui um pedaço do endereço"
                                class="form-control">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <button class="btn btn-primary"
                                    onClick="buscaIncrementalImovelSolicitacao()">Carregar Sugestões
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-10 div-cinza div-center-table-clientes" id="div-listaimvsol">
                            <table class="table  table-striped table-hover" id="tblimvsol"  width=300 height=100>
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="10%" ># ID</th>
                                        <th width="30%" >Endereço</th>
                                        <th width="30%" >Bairro</th>
                                        <th width="10%" >Situação</th>
                                        <th width="10%" >Referência</th>
                                        <th width="10%"
                                            style="text-align:center"> -
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</div>

@include( 'layout.modalSolicitacaoEventos')


@push('script')
<script>


$(document).ready(function()
{
        //$('#js-select-unidade').select2();
    //});
//    document.getElementById("myText").disabled = true;

    usuarioDestinoPesquisa();
    usuarioOrigemPesquisa();
    idcontrato = $("#IMB_CTR_ID-SOL").val();

    $("#IMB_CLT_IDLOCADOR-SOL").val(0);
    $("#IMB_CLT_IDLOCATARIO-SOL").val(0);
    $("#IMB_CLT_IDFIADOR-SOL").val(0);

    $("#IMB_SOL_TIPOSOLICITANTE").change( function()
    {

        if( $("#IMB_SOL_TIPOSOLICITANTE").val() == 'LT' )
        {
            var url = "{{route('locatario.principal')}}/"+ $("#IMB_CTR_ID-SOL").val();
            console.log( url );
            $.ajax(
                {
                    url:url,
                    dataType:'json',
                    type:'get',
                    async:false,
                    success:function( data )
                    {
                        $("#IMB_CLT_IDLOCATARIO-SOL").val(data.IMB_CLT_ID);
                        $("#IMB_CLT_NOME-SOL").val( data.IMB_CLT_NOME);
                    }
                }
            )
        }
      
    })

    $("#IMB_SOL_TIPOSOLICITANTE").change( function()
    {

        if( $("#IMB_SOL_TIPOSOLICITANTE").val() == 'PP' )
        {
            var url = "{{route('imovel.locadorprincipal')}}/"+ $("#IMB_IMV_ID-SOL").val();
            console.log( url );
            $.ajax(
                {
                    url:url,
                    dataType:'json',
                    type:'get',
                    async:false,
                    success:function( data )
                    {
                        $("#IMB_CLT_IDLOCADOR-SOL").val(data.IMB_CLT_ID);
                        $("#IMB_CLT_NOME-SOL").val( data.IMB_CLT_NOME);
                    }
                }
            )
        }
      
    })
    


})

    function pesquisarCliente()
    {
        $("#dadoscontrato").hide();
        $("#enderecoimovel-SOL").val('');
        $("#i-referencia-sol").html('');
        $("#i-contrato-situacao-sol").html('');
        $("#IMB_CTR_ID-LOCIMV").val('' );


        if( $("#IMB_SOL_TIPOSOLICITANTE").val() == ''  )
        {
            alert('É necessário que informe o tipo de contato');
            $("#IMB_SOL_TIPOSOLICITANTE").focus();
            return false;
        }
        $("#tblclientes>tbody").empty();

        $("#i-tipo-cliente").val($("#IMB_SOL_TIPOSOLICITANTE").val());
        $("#modallocalizarcliente").modal('show');
    }

    function selecionarCliLoc( id )
    {


        $("#IMB_CLT_ID-SOL").val(id);
        $("#IMB_CLT_IDLOCADOR-SOL").val(0);
        $("#IMB_CLT_IDLOCATARIO-SOL").val(0);
        $("#IMB_CLT_IDFIADOR-SOL").val(0);
        if( $("#IMB_SOL_TIPOSOLICITANTE").val() == 'LT')
        {
            tp = 'LT';
            $("#IMB_CLT_IDLOCATARIO-SOL").val(id);

        }
        else
        if( $("#IMB_SOL_TIPOSOLICITANTE").val() == 'PP')
        {
            $("#IMB_CLT_IDLOCADOR-SOL").val(id);
            tp = 'PP';
        }
        else
        if( $("#IMB_SOL_TIPOSOLICITANTE").val() == 'FD')
        {
            $("#IMB_CLT_IDFIADOR-SOL").val(id);
            tp = 'FD';
        }

        var url = "{{ route('imoveis.pessoas') }}/"+


        $("#IMB_CLT_NOME-SOL").val('');

        var url = "{{route('cliente.find')}}/"+id;

        $.ajax
        (
            {
                url         : url,
                type        : 'get',
                dataType    : 'json',
                async       : false,
                success     : function( data )
                {
                    $("#IMB_CLT_NOME-SOL").val(data.IMB_CLT_NOME);
                }

            }
        )
        $("#div-listaclientes").hide();
        $("#modallocalizarcliente").modal('hide');


    }


    function buscaIncrementalImovelSolicitacao()
    {

        var tp ='';
        if( $("#IMB_SOL_TIPOSOLICITANTE").val() == 'LT')
            tp = 'LT'
        else
        if( $("#IMB_SOL_TIPOSOLICITANTE").val() == 'PP')
            tp = 'P';
        else
        if( $("#IMB_SOL_TIPOSOLICITANTE").val() == 'FD')
            tp = 'FD';

            var url = "{{ route('imoveis.pessoas') }}/"+
            $("#IMB_CLT_ID-SOL").val()+'/'+tp;

        console.log( url );

        $.ajax(
            {
                url : url,
                dataType:'json',
                type:'get',
                success:function(data)
                {
                    linha = "";
                    $("#tblimvsol>tbody").empty();
                    for( nI=0;nI < data.length;nI++)
                    {
                        linha =
                            '<tr>'+
                            '<td style="text-align:center valign="center">'+data[nI].IMB_IMV_ID+'</td>' +
                            '<td style="text-align:center valign="center">'+data[nI].ENDERECOCOMPLETO+'</td>' +
                            '<td style="text-align:center valign="center">'+data[nI].CEP_BAI_NOME+'</td>' +
                            '<td style="text-align:center valign="center">'+data[nI].IMB_CTR_SITUACAO+'</td>' +
                            '<td style="text-align:center valign="center">'+data[nI].IMB_CTR_REFERENCIA+'</td>' +
                            '<td style="text-align:center" valign="center"> '+
                                '<a href=javascript:selecionarImSol('+data[nI].IMB_IMV_ID+','+data[nI].IMB_CTR_ID+',"'+data[nI].IMB_CTR_REFERENCIA+'","'+data[nI].IMB_CTR_SITUACAO+'") class="btn btn-sm btn-primary">Selecionar</a> '+
                            '</td> ';
                        linha = linha +
                            '</tr>';

                        $("#tblimvsol").append( linha );

                    }



                }
            }
        )

    }

    function pesquisarImovelSol()
    {
        $("#modallocimovelsol").modal('show');

    }

    function selecionarImSol( id, idcontrato, referencia, situacao)
    {
        if( idcontrato != 0 )
        {
            $("#dadoscontrato").show();
            $("#i-contrato-situacao-sol").html( situacao );
            $("#i-referencia-sol").html( referencia );
        }

        var url = "{{ route('imovel.enderecocompleto') }}/"+id;

        $.getJSON( url, function( data )
        {
            $("#IMB_IMV_ID-LOCIMV").val( id );
            $("#IMB_CTR_ID-LOCIMV").val( idcontrato );
            $("#ENDIMOVEL-LOCIMV").val( data );
            $("#enderecoimovel-SOL").val( data );
            $("#tblimvsol>tbody").empty();
            $("#modallocimovelsol").modal('hide');
        })
    }

    function cargaTipoSolicitacao()
    {
        var url = "{{ route('solicitacoes.tipo.carga') }}";
        $.getJSON( url, function( data )
        {
            $("#IMB_TPS_ID-ALT").empty();
            linha = '<option value="0">Tipo Solicitação</option>';
            $("#IMB_TPS_ID-ALT").append( linha );
            for( nI=0;nI < data.length;nI++)
            {
                linha =
                '<option value="'+data[nI].IMB_TPS_ID+'">'+
                    data[nI].IMB_TPS_DESCRICAO+"</option>";
                    $("#IMB_TPS_ID-ALT").append( linha );

            }

        });


    }

    function usuarioDestinoSol()
    {
        var url = "{{ route('atendente.cargaativos')}}";
        $.getJSON( url, function( data )
        {

            $("#IMB_ATD_IDDESTINO-ALT").empty();
            linha = '<option value="0">Escolha o responsável</option>';
            $("#IMB_ATD_IDDESTINO-ALT").append( linha );

            for( nI=0;nI < data.length;nI++)
            {
                linha =
                '<option value="'+data[nI].IMB_ATD_ID+'">'+
                    data[nI].IMB_ATD_NOME+"</option>";
                $("#IMB_ATD_IDDESTINO-ALT").append( linha );
            }


        });

    }

    function usuarioDestinoPesquisa()
    {
        var url = "{{ route('atendente.cargaativos')}}";
        $.getJSON( url, function( data )
        {

            $("#COLABORADORRESPONSAVEL").empty();
            $("#IMB_ATD_IDNOTIFEXTRA-ALT").empty();

            linha = '<option value=""></option>';
            $("#COLABORADORRESPONSAVEL").append( linha );
            $("#IMB_ATD_IDNOTIFEXTRA-ALT").append( linha );

            for( nI=0;nI < data.length;nI++)
            {
                linha =
                '<option value="'+data[nI].IMB_ATD_ID+'">'+
                    data[nI].IMB_ATD_NOME+"</option>";
                    $("#COLABORADORRESPONSAVEL").append( linha );
                    $("#IMB_ATD_IDNOTIFEXTRA-ALT").append( linha );

            }
        });
    }

    function usuarioOrigemPesquisa()
    {
        var url = "{{ route('atendente.cargaativos')}}";
        $.getJSON( url, function( data )
        {

            $("#COLABORADORORIGEM").empty();
            linha = '<option value=""></option>';
            $("#COLABORADORORIGEM").append( linha );

            for( nI=0;nI < data.length;nI++)
            {
                linha =
                '<option value="'+data[nI].IMB_ATD_ID+'">'+
                    data[nI].IMB_ATD_NOME+"</option>";
                $("#COLABORADORORIGEM").append( linha );
            }
        });
    }

    function gravarSolicitacao()
    {

        if( (   $("#IMB_SOL_TIPOSOLICITANTE").val() == 'LT' ||
                $("#IMB_SOL_TIPOSOLICITANTE").val() == 'LD' ||
                $("#IMB_SOL_TIPOSOLICITANTE").val() == 'FD'  )
            && ( $("#enderecoimovel-SOL").val() == '' ) )
        {
            alert( 'O tipo de solicitante requer um imovel!');
            return false;
        }


        if($("#IMB_SOL_TIPOSOLICITANTE").val() =='' )
        {
            alert('Tipo de Solicitante é necessário');
            return false;
        }

        if( $("#IMB_SOL_TITULO-SOL").val() =='' )
        {
            alert('O titulo é Necessário!');
            return false;
        }

        if( $("#IMB_SOL_DTHATIVO-ALT").val() =='' )
        {
            alert('Informe a data corretamente!');
            return false;
        }

        if( $("#IMB_TPS_ID-ALT").val() =='' )
        {
            alert('Informe o tipo de solicitação!');
            return false;
        }

        if( $("#IMB_ATD_IDDESTINO-ALT").val() =='' )
        {
            alert('Informe qual coloborador é o responsavel(direcionado)');
            return false;
        }

        var url = "{{ route('solicitacoes.store') }}";

        var dados =
        {
            IMB_SOL_ID : $("#IMB_SOL_ID").val(),
            IMB_CLT_ID : $("#IMB_CLT_ID-SOL").val(),
            IMB_SOL_TIPOSOLICITANTE : $("#IMB_SOL_TIPOSOLICITANTE").val(),
            IMB_SOL_TITULO : $("#IMB_SOL_TITULO-SOL").val(),
            IMB_CLT_NOME : $("#IMB_CLT_NOME-SOL").val(),
            IMB_SOL_DTHATIVO : $("#IMB_SOL_DTHATIVO-ALT").val(),
            IMB_SOL_DATAPREVISAO : $("#IMB_SOL_DATAPREVISAO-ALT").val(),
            IMB_TPS_ID : $("#IMB_TPS_ID-ALT").val(),
            IMB_ATD_IDDESTINO : $("#IMB_ATD_IDDESTINO-ALT").val(),
            IMB_SOL_OBSERVACAO : $("#IMB_SOL_OBSERVACAO-alt").val(),
            IMB_CTR_ID  : $("#IMB_CTR_ID-LOCIMV").val(),
            IMB_CLT_IDLOCADOR : $("#IMB_CLT_IDLOCADOR-SOL").val(),
            IMB_CLT_IDLOCATARIO : $("#IMB_CLT_IDLOCATARIO-SOL").val(),
            IMB_CLT_IDFIADOR : $("#IMB_CLT_IDFIADOR-SOL").val(),
            IMB_SOL_PRIORIDADE : $("#IMB_SOL_PRIORIDADE-ALT").val(),
            IMB_ATD_IDNOTIFEXTRA : $("#IMB_ATD_IDNOTIFEXTRA").val(),
            IMB_SOL_PUBLICA : $("#i-publica").prop( "checked" )   ? 'S' : 'N',
        }

        $.ajaxSetup
        ({
          headers:
          {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
          }
        });

        $.ajax(
            {
                url : url,
                dataType:'json',
                type:'post',
                data:dados,
                success:function()
                {
                    alert('Gravado!')
                    $('#modalsolicitacao').modal('hide');
                }
            }
        )
    }

    function releases()
    {
        $("#IMB_SOL_ID-HIST").val( $("#IMB_SOL_ID").val());
        $("#modalsolicitacaoeventos").modal( 'show');
        $("#div-novo-release").hide();
        $("#div-botao-novo-release").show();
        cargaReleases();
    }

    function encerrarSolicitacao(id)
    {

        var proceed = confirm("Confirma o encerramento do Chamado?");
        if (proceed)
        {
            var url = "{{ route('solicitacoeseventos.store') }}";

            var dados =
            {
                IMB_SOL_ID : id,
                IMB_SLE_DESCRICAO : $("#IMB_SLE_DESCRICAO-ALT").val(),
                fechamento:'S'
            }

            $.ajaxSetup
            ({
            headers:
            {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
            });

            $.ajax(
                {
                    url : url,
                    dataType:'json',
                    type:'post',
                    data:dados,
                    success:function()
                    {
                        alert( 'Chamado Encerrado!');
                        table = $('#resultTablesol');
                        table.ajax.url( url ).load();
                    }
                }
            )
        }


    }

    function reabrirSolicitacao(id)
    {

        var proceed = confirm("Confirma a reabertura do Chamado?");
        if (proceed)
        {
            var url = "{{ route('solicitacoeseventos.store') }}";

            var dados =
            {
                IMB_SOL_ID : id,
                IMB_SLE_DESCRICAO : $("#IMB_SLE_DESCRICAO-ALT").val(),
                reabrir:'S'
            }

            $.ajaxSetup
            ({
            headers:
            {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
            });

            $.ajax(
                {
                    url : url,
                    dataType:'json',
                    type:'post',
                    data:dados,
                    success:function()
                    {
                        alert( 'Chamado Reaberto!');
                        table = $('#resultTablesol');
                        table.ajax.url( url ).load();
                    }
                }
            )
        }


    }



</script>
@endpush
