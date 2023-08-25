<div class="modal" tabindex="-1" role="dialog" id="modalcpbaixa" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog "style="width:80%;" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Baixa de Compromisso no Contas a Pagar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="portlet light bordered">
                    <div class="portlet-body form">
                        <input type="hidden" id="FIN_APD_ID-BCP">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <label class="label-control" >Unidade</label>
                                    <input type="text" class="form-control" id="IMB_IMB_NOME-BCP" readonly>
                                </div>
                                <div class="col-md-2 baixado escondido font-red-jabaixado div-center" id="i-div-baixado">
                                    JÁ BAIXADO
                                </div>
                                <div class="col-md-6">
                                    <label class="label-control" for="FIN_EEP_RAZAOSOCIAL-BCP">Fornecedor</label>
                                    <input type="text"class="form-control" id="FIN_EEP_RAZAOSOCIAL-BCP" readonly>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <label>Tipo Documento</label>
                                    <input type="text" class="form-control" id="FIN_TPD_DESCRICAO-BCP" readonly></select>
                                </div>
                                <div class="col-md-2">
                                    <label>Data Documento</label>
                                    <input type="date" class="form-control" id="FIN_APD_DATADOCUMENTO-BCP" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label>Nº Documento</label>
                                    <input type="text" class="form-control" id="FIN_APD_NUMERODOCUMENTO-BCP"readonly>
                                </div>
                                <div class="col-md-2">
                                    <label>Data Vencto</label>
                                    <input type="date" class="form-control" id="FIN_APD_DATAVENCIMENTO-BCP"readonly>
                                </div>
                                <div class="col-md-2">
                                    <label>Valor</label>
                                    <input type="text" class="form-control valor div-right" id="FIN_APD_VALORVENCIMENTO-BCP"readonly>
                                </div>
                                <div class="col-md-2">
                                    <label>Desconto Até Vecto.</label>
                                    <input type="text" class="form-control valor div-right" id="FIN_APD_VALORDESCONTO-BCP"readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label>Descrição / Observação</label>
                                <input type="text" class="form-control" id="FIN_APD_OBSERVACAO-BCP">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="div-informacoesbaixar">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Informações para baixar o documento
                        </div>
                    </div>

                    <div class="portlet-body form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <label class="control-label">Forma de Pagamento</label>
                                    <select class="form-control" id="FIN_APD_FORMAPAGAMENTO-BCP">
                                        <option value="0">Cheque</option>
                                        <option value="1">Bancária com DOC</option>
                                        <option value="2">Bancária com TED</option>
                                        <option value="3">Transferência Bancária</option>
                                        <option value="4" selected>Dinheiro</option>
                                        <option value="5">Depósito</option>
                                        <option value="6">Débito em Conta</option>
                                        <option value="7">PIX</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label class="control-label">Conta de Pagamento</label>
                                    <select class="form-control" id="FIN_CCX_IDBAIXA-BCP">
                                    </select>
                                </div>
                                <div class="col-md-1  escondido" id="div-cheque">
                                    <label class="control-label">Nº Cheque </label>
                                    <input class="form-control" type="text" id="FIN_LCX_NUMEROCHEQUE-BCP">
                                </div>
                                <div class="col-md-6  escondido" id="div-pix">
                                    <label class="control-label">Nº PIX </label>
                                    <input class="form-control" type="text" id="IMB_EEP_PIX-BCP">
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        <label class="control-label">Data Pagamento</label>
                                        <input class="form-control" type="date" id="FIN_APD_DATAPAGAMENTO-BCP">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label">Valor Pago</label>
                                        <input class="form-control  valor" type="text" id="FIN_APD_VALORPAGO-BCP">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label">Valor Multa</label>
                                        <input class="form-control  valor" type="text" id="FIN_APD_VALORMULTA-BCP">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label">Valor Juros</label>
                                        <input class="form-control valor" type="text " id="FIN_APD_VALORJUROS-BCP">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label">Valor Desconto</label>
                                        <input class="form-control valor" type="text " id="FIN_APD_VALORDESCONTO-BAIXA">
                                    </div>
                                    <div class="col-md-1">
                                        <label class="control-label">&nbsp;</label>
                                        <button type="button" id="btn-confirmabaixa" class="btn btn-primary" onClick="confirmarBaixaCP()">Confirmar</button>
                                    </div>
                                    <div class="col-md-1">
                                        <label class="control-label">&nbsp;</label>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
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

<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>

<script type="text/javascript">

$(document).ready(function() 
{

    $("#FIN_APD_FORMAPAGAMENTO").change( function()
    {
        $("#div-pix").hide();
        $("#div-cheque").hide();

        if( $("#FIN_APD_FORMAPAGAMENTO").val() == 'C' )
        {
            $("#div-pix").hide();
            $("#div-cheque").show();
        }
        if( $("#FIN_APD_FORMAPAGAMENTO").val() == 'X' )
        {
            $("#div-pix").show();
            $("#div-cheque").hide();
        }
        
       

    });

    $("#FIN_APD_FORMAPAGAMENTO-BCP").change( function()
    {
        if($("#FIN_APD_FORMAPAGAMENTO-BCP") == 0)
            $("#div-cheque").show()
        else
            $("#div-cheque").hide();
        
    });

    $("#FIN_APD_VALORPAGO-BCP").change( function()
    {
        var valorpago = realToDolar( $("#FIN_APD_VALORPAGO-BCP").val()) ;
        var valordoc = realToDolar( $("#FIN_APD_VALORVENCIMENTO-BCP").val()) ;

        var dif = valorpago - valordoc;

        if( dif < 0 )
        {
            $("#FIN_APD_VALORMULTA-BCP").val( 0 );
            $("#FIN_APD_VALORJUROS-BCP").val( 0 );
            $("#FIN_APD_VALORDESCONTO-BAIXA").val( Math.abs( dif ));
        }
        else
        {
            $("#FIN_APD_VALORMULTA-BCP").val( dif );
            $("#FIN_APD_VALORJUROS-BCP").val( 0 );
            $("#FIN_APD_VALORDESCONTO-BAIXA").val( 0 );
        }
    })

    $("#FIN_APD_VALORMULTA-BCP").change( function()
    {
        
        var valorpago = realToDolar( $("#FIN_APD_VALORPAGO-BCP").val()) ;
        var valordoc = realToDolar( $("#FIN_APD_VALORVENCIMENTO-BCP").val()) ;
        var valormulta = realToDolar( $("#FIN_APD_VALORMULTA-BCP").val()) ;

        var dif = parseFloat(valorpago) - (parseFloat(valordoc) + parseFloat(valormulta));
        $("#FIN_APD_VALORJUROS-BCP").val( dif );
        $("#FIN_APD_VALORDESCONTO-BAIXA").val( 0 );
    })


});
    function cargaFPCP()
    {
        var url = "{{ route('formapagamento.carga') }}";

        $.ajax(
            {
                url : url,
                data:dados,
                dataType:'json',
                type:'get',
                success:function( data )
                {
                    $("#FIN_APD_FORMAPAGAMENTO").empty();
                    linha ='<option value="">Selecione a forma</option>';
                    $("#FIN_APD_FORMAPAGAMENTO").append( linha );
                    for( nI=0;nI < data.length;nI++)
                    {
                        linha =
                        '<option value="'+data[nI].IMB_FORPAG_ID+'">'+
                            data[nI].IMB_FORPAG_DESCRICAO+
                            "</option>";
                        $("#FIN_APD_FORMAPAGAMENTO").append( linha );
                    }
                }
            }
        )


    }

    function baixarCP( id )
    {

        $("#FIN_APD_ID-BCP").val( id );

        var url = "{{ route('contaspagar.buscar') }}/"+id;

        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                success:function(data )
                {
                    $("#FIN_EEP_RAZAOSOCIAL-BCP").val( data.IMB_EEP_RAZAOSOCIAL);
                    $("#IMB_IMB_NOME-BCP").val( data.IMB_IMB_NOME);
                    $("#FIN_TPD_DESCRICAO-BCP").val( data.FIN_TPD_DESCRICAO);
                    $("#FIN_APD_DATADOCUMENTO-BCP").val( data.FIN_APD_DATADOCUMENTO );
                    $("#FIN_APD_NUMERODOCUMENTO-BCP").val( data.FIN_APD_NUMERODOCUMENTO);
                    $("#FIN_APD_DATAVENCIMENTO-BCP").val( data.FIN_APD_DATAVENCIMENTO);
                    $("#FIN_APD_VALORVENCIMENTO-BCP").val( dolarToReal(data.FIN_APD_VALORVENCIMENTO));
                    $("#FIN_APD_VALORDESCONTO-BCP").val( dolarToReal(data.FIN_APD_VALORDESCONTO));
                    $("#FIN_APD_OBSERVACAO-BCP").val( data.FIN_APD_OBSERVACAO);
                    $("#FIN_APD_VALORPAGO-BCP").val( 0);
                    $("#FIN_APD_VALORMULTA-BCP").val( 0);
                    $("#FIN_APD_VALORJUROS-BCP").val( 0);
                    $("#FIN_APD_VALORDESCONTO-BAIXA").val( 0);
                    
                    $("#i-div-baixado").hide();
                    $("#div-informacoesbaixar").show();
                    if( data.FIN_APD_DATAPAGAMENTO != null )
                    {
                        $("#i-div-baixado").show();
                        $("#btn-confirmabaixa").hide();
                        $("#div-informacoesbaixar").hide();
                    }

                    cargaContaBaixaCp();

                    $("#FIN_APD_DATAPAGAMENTO-BCP").val( moment().format( 'YYYY-MM-DD'));

                    $("#modalcpbaixa").modal('show');

                }
            }
        )


    }


    function cargaContaBaixaCp()
    {

      $.getJSON( "{{ route('contacaixa.carga')}}/S", function( data )
      {
        $("#FIN_CCX_IDBAIXA-BCP").empty();
        linha =  '<option value="-1">Selecione a Conta </option>';
        $("#FIN_CCX_IDBAIXA-BCP").append( linha );
        for( nI=0;nI < data.length;nI++)
        {
          linha =
          '<option value="'+data[nI].FIN_CCX_ID+'">'+
                            data[nI].FIN_CCX_DESCRICAO+"</option>";
          $("#FIN_CCX_IDBAIXA-BCP").append( linha );
        }
      });

    }

    function confirmarBaixaCP()
    {

        var valorpago = realToDolar( $("#FIN_APD_VALORPAGO-BCP").val()) ;
        var valordoc = realToDolar( $("#FIN_APD_VALORVENCIMENTO-BCP").val()) ;
        var valormulta = realToDolar( $("#FIN_APD_VALORMULTA-BCP").val()) ;
        var valorjuros = realToDolar( $("#FIN_APD_VALORJUROS-BCP").val()) ;
        var valordesconto = realToDolar( $("#FIN_APD_VALORDESCONTO-BAIXA").val()) ;

        if( $("#FIN_CCX_IDBAIXA-BCP").val() == '-1' )
        {
            alert('Informe uma conta pra realizar a baixa deste comprimisso!');
            return false;
        }

        var dif = parseFloat(valorpago) - (parseFloat(valordoc) + parseFloat(valormulta) +  parseFloat(valorjuros ) - parseFloat(valordesconto )  );

        if( dif != 0 )
        {
            alert( 'Atenção. Verifique os valores informados como o total pago, multa e juros. Algo está errado!');
            return false;
        }

        var dados =
        {
            FIN_APD_ID : $("#FIN_APD_ID-BCP").val(),
            FIN_APD_FORMAPAGAMENTO : $("#FIN_APD_FORMAPAGAMENTO").val(),
            FIN_CCX_IDBAIXA : $("#FIN_CCX_IDBAIXA-BCP").val(),
            FIN_APD_DATAPAGAMENTO : $("#FIN_APD_DATAPAGAMENTO-BCP").val(),
            FIN_APD_VALORPAGO : realToDolar($("#FIN_APD_VALORPAGO-BCP").val()),
            FIN_APD_VALORMULTA : realToDolar( $("#FIN_APD_VALORMULTA-BCP").val()),
            FIN_APD_VALORJUROS: realToDolar( $("#FIN_APD_VALORJUROS-BCP").val()),
            FIN_LCX_NUMEROCHEQUE: realToDolar( $("#FIN_LCX_NUMEROCHEQUE-BCP").val()),
            FIN_APD_VALORDESCONTO: realToDolar( $("#FIN_APD_VALORDESCONTO-BAIXA").val()),
            
        }

        var url = "{{route( 'contaspagar.baixar')}}";

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
                success:function( data )
                {
                    alert('Baixado');
                    $("#modalcplancamento").modal('hide');
                    $("#modalcpbaixa").modal('hide');
                },
                error:function(err) 
                {
                    alert( err.responseText );
                    alert('Erro ao Baixar o Documento. Não baixado!');
                }
            })
    }

</script>
@endpush
