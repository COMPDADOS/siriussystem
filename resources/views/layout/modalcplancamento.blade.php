<div class="modal" style="overflow:hidden;" role="dialog" id="modalcplancamento" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog "style="width:80%;" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Contas a Pagar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject bold uppercase">Informações do Lançamento</span>
                            <i class="fa fa-search font-blue"></i>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <input type="hidden" id="FIN_APD_ID-LAN">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <label class="label-control empresa" for="IMB_IMB_ID2_LANCP">Unidade</label>
                                    <select class="form-control" id="IMB_IMB_ID2_LANCP">
                                    </select>
                                </div>
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-6">
                                <label class="label-control" for="FIN_EEP_ID_LANCP">Fornecedor</label>
                                <select class="select2" id="FIN_EEP_ID_LANCP">
                                </select>
                                <span><a class="btn dark" href="{{route('fornecedores.index')}}" target="_blank">Cadastrar Novo</a></span>
                                <span><a class="btn success" href="javascript:cargaFornecedoresModalCpLan();">Atualizar</a></span>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                &nbsp;
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <label>Tipo Documento</label>
                                    <select class="form-control" id="FIN_TPD_ID-LAN"></select>
                                </div>
                                <div class="col-md-2">
                                    <label>Data Documento</label>
                                    <input type="date" class="form-control" id="FIN_APD_DATADOCUMENTO-LAN">
                                </div>
                                <div class="col-md-2">
                                    <label>Nº Documento</label>
                                    <input type="text" class="form-control" id="FIN_APD_NUMERODOCUMENTO-LAN">
                                </div>
                                <div class="col-md-2">
                                    <label>Data Vencto</label>
                                    <input type="date" class="form-control" id="FIN_APD_DATAVENCIMENTO-LAN">
                                </div>
                                <div class="col-md-2">
                                    <label>Valor</label>
                                    <input type="text" class="form-control valor div-right" id="FIN_APD_VALORVENCIMENTO-LAN">
                                </div>
                                <div class="col-md-2">
                                    <label>Desconto Até Vecto.</label>
                                    <input type="text" class="form-control valor div-right" id="FIN_APD_VALORDESCONTO-LAN">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 div-parcelamento">
                                <div class="col-md-1">
                                    <label class="control-label">Qtd.Parc.</label>
                                    <input class="form-control" type="number" id="FIN_APD_PARCELAS" min="1" value='1'>
                                </div>
                                <div class="col-md-2">
                                    <label>Primeiro Vencto</label>
                                    <input type="date" class="form-control" id="i-primeiro-vencimento-LAN">
                                </div>

                                <div class="col-md-1">
                                    <label class="control-label">&nbsp;</label>
                                    <button class="form-control btn btn-primary" onClick="gerarParcelamentoLanCp()">Gerar</button>
                                </div>
                                <div class="col-md-8">
                                    <table id="tblparcelaslancp"  class="table-striped table-bordered table-hover" >
                                        <thead>
                                            <tr>
                                                <th class="div-center" width="20%">Data</th>
                                                <th class="div-center" width="60%">Parcela</th>
                                                <th class="div-center" width="20%">Valor</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                &nbsp;
                            </div>

                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label>Descrição - Observação</label>
                                    <input type="text" class="form-control" id="FIN_APD_OBSERVACAO-LAN">
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
                                    <select  class="select2" id="FIN_CFC_ID-LAN" >
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label" >Sub-Conta Padrão</label>
                                    <select  class="select2" id="FIN_SBC_ID-LAN">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onClick="gravarLanCp()">Confirmar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
            </div>
        </div>
    </div>
</div>


@push('script')

<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>

<script type="text/javascript">

    $("#FIN_APD_DATAVENCIMENTO-LAN").blur( function()
    {
        $("#i-primeiro-vencimento-LAN").val( $("#FIN_APD_DATAVENCIMENTO-LAN").val() );
    })
    function cargaFornecedoresModalCpLan()
    {

        var url = "{{ route('fornecedores.list') }}";

        dados = { origem : 'carga'};

        $.ajax(
        {
            url:url,
            dataType:'json',
            type:'get',
            data:dados,
            async:false,
            success:function(data)
            {
                console.log(data );
                $("#FIN_EEP_ID_LANCP").empty();
                linha ='<option value="">Selecione o Fornecedor</option>';
                $("#FIN_EEP_ID_LANCP").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                    '<option value="'+data[nI].IMB_EEP_ID+'">'+
                    data[nI].IMB_EEP_RAZAOSOCIAL+'('+data[nI].IMB_EEP_NOMEFANTASIA+')'+
                        "</option>";
                    $("#FIN_EEP_ID_LANCP").append( linha );
                }
            }
        });
    }


    function preencherUnidadesModalCpLan()
    {
        var url = "{{ route('imobiliaria.carga')}}/"+"{{Auth::user()->IMB_IMB_ID}}";
        console.log( url );
        $.getJSON( url, function( data )
        {
            $("#IMB_IMB_ID2_LANCP").empty();
            for( nI=0;nI < data.length;nI++)
            {
                linha =
                '<option value="'+data[nI].IMB_IMB_ID+'">'+
                    data[nI].IMB_IMB_NOME+"</option>";
                    $("#IMB_IMB_ID2_LANCP").append( linha );

            }
            $("#IMB_IMB_ID2_LANCP").val( "{{ Auth::user()->IMB_IMB_ID }}");
        });

    }

    function cargaTipoDocumento()
    {
        var url = "{{ route('tipodocumento.carga') }}";

        $.ajax(
        {
            url:url,
            dataType:'json',
            type:'get',
            async:false,
            success:function(data)
            {
                console.log(data );
                $("#FIN_TPD_ID-LAN").empty();
                linha ='<option value="">Selecione</option>';
                $("#FIN_TPD_ID-LAN").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                    '<option value="'+data[nI].FIN_TPD_ID+'">'+
                        data[nI].FIN_TPD_DESCRICAO+
                        "</option>";
                    $("#FIN_TPD_ID-LAN").append( linha );
                }
            }
        });

    }


    function cargaCfcLanCp()
    {
        $.ajax(
        { 
            url : "{{route('cfc.carga')}}",
            dataType:'json',
            type:'get',
            async:false, 
            success:function(data)
            {
                    
                $("#FIN_CFC_ID-LAN").empty();

                linha =  '<option value="">Informe um CFC</option>';
                $("#FIN_CFC_ID-LAN").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                    '<option value="'+data[nI].FIN_CFC_ID+'">'+
                    data[nI].FIN_CFC_DESCRICAO+'<b>('+data[nI].FIN_CFC_ID+')</b></option>';
                    $("#FIN_CFC_ID-LAN").append( linha );
                }
                $("#FIN_CFC_ID-LAN").select2({
                    placeholder: 'Selecione o CFC',
                    width: null
                });
            }


        });


    }

    function cargaSubContaLanCp()
    {
        $.ajax(
        {
            url: "{{route('subconta.carga')}}",
            dataType:'json',
            type:'get',
            async:false,
            success:function( data ) 
            {
                $("#FIN_SBC_ID-LAN").empty();
                linha =  '<option value="">Informe um CFC</option>';
                $("#FIN_SBC_ID-LAN").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                        '<option value="'+data[nI].FIN_SBC_ID+'">'+
                        data[nI].FIN_SBC_DESCRICAO+'</option>';
                    $("#FIN_SBC_ID-LAN").append( linha );
                }
                $("#FIN_SBC_ID-LAN").select2({
                    placeholder: 'Selecione a Sub-conta',
                    width: null
                });
            }


        });

    }

    function gravarLanCp()
    {
        if( $("#FIN_EEP_ID_LANCP").val() == '' )
        {
            alert('Informe o fornecedor');
            return false;
        }
        if( $("#FIN_TPD_ID-LAN").val() == '' )
        {
            alert('Informe o Tipo de Lançamento');
            return false;
        }

        if( $("#FIN_APD_DATADOCUMENTO-LAN").val() == '' )
        {
            alert('Data do Lançamento inválida');
            return false;
        }

        if( $("#FIN_APD_NUMERODOCUMENTO-LAN").val() == '' )
        {
            alert('Informe o número de documento');
            return false;
        }

        if( $("#FIN_APD_DATAVENCIMENTO-LAN").val() == '' )
        {
            alert('Data de Vencimento Inválida');
            return false;
        }

        if( $("#FIN_APD_VALORVENCIMENTO-LAN").val() <= 0 )
        {
            alert('Informe o valor do documento');
            return false;
        }

        if( $("#FIN_APD_VALORDESCONTO-LAN").val() > $("#FIN_APD_VALORVENCIMENTO-LAN").val()  )
        {
            alert('O valor do desconto não pode ser maior que o valor do documento');
            return false;
        }

        if( $("#FIN_CFC_ID-LAN").val() =='' )
        {
            alert('Falta informar o CFC');
            return false;
        }

        var table = document.getElementById('tblparcelaslancp');
        if( $("#FIN_APD_ID-LAN").val() == '' && $("#FIN_APD_PARCELAS").val() != table.rows.length - 1 )
        {
            alert('Numero de parcelas geradas não é a mesma quantidade de parcelas informadas!');
            return false;
        }

        var lancamentos = new Array();
        for (var r = 1, n = table.rows.length; r < n; r++)
        {
            valorparcela = realToDolar(table.rows[r].cells[2].innerHTML);
            lancamentos.push( [ $("#i-dtven"+r).val(),
                         $("#i-parc"+r).val(),
                        valorparcela]);

        }





        var url = "{{ route('contaspagar.gravarnovo') }}";

        var dados =
        {
            FIN_EEP_ID : $("#FIN_EEP_ID_LANCP").val(),
            FIN_APD_ID : $("#FIN_APD_ID-LAN").val(),
            FIN_TPD_ID : $("#FIN_TPD_ID-LAN").val(),
            FIN_APD_DATADOCUMENTO:$("#FIN_APD_DATADOCUMENTO-LAN").val(),
            FIN_APD_NUMERODOCUMENTO : $("#FIN_APD_NUMERODOCUMENTO-LAN").val(),
            FIN_APD_DATAVENCIMENTO : $("#FIN_APD_DATAVENCIMENTO-LAN").val(),
            FIN_APD_VALORVENCIMENTO : realToDolar($("#FIN_APD_VALORVENCIMENTO-LAN").val()),
            FIN_APD_VALORDESCONTO : realToDolar($("#FIN_APD_VALORDESCONTO-LAN").val()),
            FIN_APD_NUMEROPARCELA : $("#FIN_APD_PARCELAS").val(),
            "i-parcelas" : $("#FIN_APD_PARCELAS").val(),
            'i-primeiro-vencimento' : $("#i-primeiro-vencimento-LAN").val(),
            FIN_APD_OBSERVACAO : $("#FIN_APD_OBSERVACAO-LAN").val(),
            FIN_CFC_ID : $("#FIN_CFC_ID-LAN").val(),
            FIN_SBC_ID : $("#FIN_SBC_ID-LAN").val(),
            IMB_IMB_ID2: $("#IMB_IMB_ID2_LANCP").val(),
            parcelas: lancamentos,

        }

        console.log( dados );
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
                dataType:'json',
                type:'post',
                data:dados,
                success:function( data)
                {
                    alert('Gravado');
                    $("#modalcplancamento").modal('hide');

                }
            }
        )




    }

    function gerarParcelamentoLanCp()
    {

        if( $("#i-primeiro-vencimento-LAN").val() == '' )
        {
            alert('Informe o primeiro vencimento');
            return false;
        }

        if( $("#FIN_APD_VALORVENCIMENTO-LAN").val() == '' )
        {
            alert('Informe o valor de vencimento');
            return false;
        }


        var valor = realToDolar( $("#FIN_APD_VALORVENCIMENTO-LAN").val() );

        var datavencimento = moment( $("#i-primeiro-vencimento-LAN").val(), "YYYY-MM-DD");

        var dia = datavencimento.format('D');

        var valoraparcelar = valor

        console.log(valoraparcelar);

        var parcelas = $("#FIN_APD_PARCELAS").val();

        var url = "{{route('rotina.gerarparcelamento')}}/"+dia+'/'+parcelas+'/'+
                    moment( $("#i-primeiro-vencimento-LAN").val()).format("YYYY-MM-DD")+'/'+valoraparcelar+'/0';

        $.ajax(
          {
            url : url,
            dataType:'json',
            type:'get',
            success:function(data )
            {
              console.log( data );
              $("#tblparcelaslancp>tbody").empty();
              linha = "";

              for( nI=0;nI < data.length;nI++)
              {
                valor = parseFloat( data[nI].valor );
                valor = formatarBRSemSimbolo( valor );

                linha =       '<tr id="tr'+(nI+1)+'">'+
                              '<td class="div-center"><input class="form-control"  type="date" id="i-dtven'+(nI+1)+'" value="'+data[nI].data +'"></td>' +
                              '<td class="div-center"><input class="form-control" type="text" id="i-parc'+(nI+1)+'" value="Parcela '+(nI+1)+'"></td>' +
                              '<td class="div-right">'+valor+'</td>' ;

                linha = linha +'</tr>';

                $("#tblparcelaslancp").append( linha );
              }

            }
          }
        )



    }


    function limparCampos()
    {

        $("#tblparcelaslancp>tbody").empty();
        $("#FIN_EEP_ID_LANCP").val('');
        $("#FIN_APD_ID-LAN").val('');
        $("#FIN_TPD_ID-LAN").val('');
        $("#FIN_APD_DATADOCUMENTO-LAN").val( moment().format('YYYY-MM-DD') );
        $("#FIN_APD_NUMERODOCUMENTO-LAN").val('');
        $("#FIN_APD_DATAVENCIMENTO-LAN").val('');
        $("#FIN_APD_VALORVENCIMENTO-LAN").val('');
        $("#FIN_APD_VALORDESCONTO-LAN").val('');
        $("#FIN_APD_PARCELAS").val(1);
        $("#i-primeiro-vencimento-LAN").val('');
        $("#FIN_APD_OBSERVACAO-LAN").val('');
        $("#FIN_CFC_ID-LAN").val('');
        $("#FIN_SBC_ID-LAN").val('');
    }


</script>
@endpush
