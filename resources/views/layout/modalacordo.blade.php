<div class="modal fade" id="modalacordo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog"  style="width:90%;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Acordo
                        </div>
                    </div>

                    <input type="hidden" id="i-acordo-contrato">
                    <div class="portlet-body form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <label class="control-label">Endereço</label>
                                    <input class="form-control" type="text" id="i-acordo-endereco" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label">Locatário</label>
                                    <input class="form-control" type="text" id="i-acordo-locatario" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Valor Aluguel</label>
                                    <input class="form-control valor"type="text" id="i-acordo-valoraluguel" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Prox.Vencimento</label>
                                    <input class="form-control" type="date" id="i-acordo-proximovencimento" readonly>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <label class="control-label">Data do Acordo</label>
                                    <input class="form-control" type="date" id="i-acordo-dataacordo">
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Valor do Acordo</label>
                                    <input class="form-control valor" type="text" id="i-acordo-valor" readonly>
                                    <span>$ total ítens selecionados</span>

                                </div>
                                <div class="col-md-1">
                                    <label class="control-label">Parc.</label>
                                    <input class="form-control" type="number" id="i-acordo-parcelas">
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">$ Entrada</label>
                                    <input class="form-control valor" type="texto" id="i-acordo-entrada">
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Data Entrada</label>
                                    <input class="form-control " type="date" id="i-acordo-dataentrada">
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">1º Vencimento</label>
                                    <input class="form-control " type="date" id="i-acordo-primven">
                                </div>
                                <div class="col-md-2">
                                </div>
                            </div>
                            <div class="col-md-12 row-top-margin">
                                <hr>
                            </div>
                            <div class="col-md-12 div-center row-top-margin">
                            </div>
                            <div class="col-md-12 row-top-margin">
                                <div class="col-md-2 div-center">
                                    <b>Descreva ao lado o motivo ou observações para este acordo</b>
                                </div>
                                <div class="col-md-5">
                                    <textarea class="form-control" id="i-acordo-motivo" cols="100%" rows="10"></textarea>
                                </div>
                                <div class="col-md-3">
                                    <table id="tblparcelasacordo"  class="table-striped table-bordered table-hover" >
                                        <thead>
                                            <tr>
                                                <th class="div-center" width="10%"></th>
                                                <th class="div-center" width="30%">Data</th>
                                                <th class="div-center" width="20%">Parcela</th>
                                                <th class="div-center" width="40%">Valor</th>
                                            </tr>
                                        </thead>
                                    </table>

                                </div>
                                <div class="col-md-2">
                                    <p>
                                        <input type="checkbox" id="i-acordo-juntoaluguel">
                                        <label class="control-label">Cobrar Junto Aluguel</label>
                                    </p>
                                    <p>
                                        <input type="checkbox" id="i-acordo-detalhar" >
                                        <label class="control-label">Detalhar</label>
                                    </p>
                                    <p>
                                        <button class="form-control btn btn-primary" onClick="gerarParcelamento()">1º Gerar Parcelas</button>
                                    </p>
                                    <p>
                                        <button class="form-control  btn btn-danger" data-dismiss="modal">Cancelar</button>
                                    </p>
                                    <p>
                                        <button class="form-control  btn btn-success" onclick="confirmarAcordo()">2º Confirmar Acordo</button>
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <hr>
                        </div>
                        <div class="portlet box red">
                            <div class="portlet-title div-center">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Ítens Selecionados Para o Acordo
                                </div>
                            </div>

                            <div class="portlet-body form">
                                <div class="row">
                                    <div class="col-md-8">
                                        <table  id="tbllancamentosacordo" class="topics" >
                                            <thead class="thead-dark">
                                            <tr >
                                                <th class="escondido"> Ações </th>
                                                <th class="escondido"> IDlcf </th>
                                                <th width="150" style="text-align:center"> Evento </th>
                                                <th width="100" style="text-align:center"> Valor </th>
                                                <th width="50" style="text-align:center"> Locatário </th>
                                                <th width="100" style="text-align:center"> Vencimento </th>
                                                <th width="500" style="text-align:center"> Descrição</th>
                                                <th class="escondido"> randon</th>
                                                <th class="escondido"> deletado</th>
                                                <th class="escondido"> tbe_id</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Resumo</h5>
                                        

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




    function acordo()
    {
        var id = $("#i-acordo-contrato").val();

        $("#modalacordo").modal('show');
        $("#i-acordo-contrato").val( id );
        $("#i-acordo-dataacordo").val( moment().format('YYYY-MM-DD') );
        $("#i-acordo-dataentrada").val( moment().format('YYYY-MM-DD') );

        $("#i-acordo-entrada").val(0);
        $("#i-acordo-parcelas").val(1);

        var url = "{{ route('contrato.findfull') }}/"+id;
        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                success:function(data )
                {
                    valoraluguel = dolarToReal( data.IMB_CTR_VALORALUGUEL);
                    $("#i-acordo-endereco").val( data.ENDERECOCOMPLETO)
                    $("#i-acordo-locatario").val( data.LOCATARIO);
                    $("#i-acordo-valoraluguel").val(valoraluguel);
                    $("#i-acordo-proximovencimento").val(data.IMB_CTR_VENCIMENTOLOCATARIO);

                },
                complete:function(data)
                {
                },
                done:function(data)
                {
                }
            }
        );

    }


    function gerarParcelamento()
    {

        var valor = realToDolar( $("#i-acordo-valor").val() );
        entrada = realToDolar( $("#i-acordo-entrada").val())
        if( valor <= 0 )
        {
            alert('Valor total do acordo não permite a realização de acordo');
            return false;
        }

        if( $("#i-acordo-primven").val() == '' )
        {
            alert('Informe a data para o primeiro vencimento');
            return false;
        }
        if( entrada ==0 && $("#i-acordo-dataentrada").val() == '' )
        {
            alert('Informe a data de entrada');
            return false;
        }

        var datavencimento = moment( $("#i-acordo-primven").val(), "YYYY-MM-DD");

        var dia = datavencimento.format('D');

        var valoraparcelar = valor - entrada;

        console.log(valoraparcelar);

        var parcelas = $("#i-acordo-parcelas").val();

        var idcontrato = $("#i-acordo-contrato").val();

        var url = "{{route('rotina.gerarparcelamentojson')}}/"+dia+'/'+parcelas+'/'+
                    moment(  $("#i-acordo-primven").val()).format("YYYY-MM-DD")+'/0/'+valoraparcelar+'/'+idcontrato;
        console.log( url );


        $.ajax(
          {
            url : url,
            dataType:'json',
            type:'get',
            success:function(data )
            {
              console.log( data );
              $("#tblparcelasacordo>tbody").empty();
              linha = "";
              if( entrada > 0)
              {
                linha =
                '<tr id="tr0">'+
                    '<td class="div-center"><button class="btn btn-primary btn-sm" onclick="alterarParcela(0)"><i class="fa fa-pencil" aria-hidden="true"></i></button></td>'+
                    '<td class="div-center">'+moment( $("#i-i-acordo-dataentrada").val()).format('DD/MM/YYYY')+'</td>' +
                    '<td class="div-center">ENTRADA</td>' +
                    '<td class="div-right">'+$("#i-acordo-entrada").val()+'</td>' +
                '</tr>';
                $("#tblparcelasacordo").append( linha );
                }

              for( nI=0;nI < data.length;nI++)
              {
                valor = parseFloat( data[nI].valor );
                valor = formatarBRSemSimbolo( valor );

                linha =       '<tr id="tr'+(nI+1)+'">'+
                              '<td class="div-center"><button class="btn btn-primary btn-sm"  onclick="alterarParcela('+(nI+1)+')"><i class="fa fa-pencil" aria-hidden="true"></i></button></td>'+
                              '<td class="div-center">'+moment( data[nI].data ).format('DD/MM/YYYY')+'</td>' +
                              '<td class="div-center">'+data[nI].parcela+'/'+parcelas+'</td>' +
                              '<td class="div-right">'+valor+'</td>' ;

                linha = linha +'</tr>';

                $("#tblparcelasacordo").append( linha );
              }

            }
          }
        )




    }

    function alterarParcela( id )
    {
        alert('Sem permissão, gere o parcelamento de acordo com valores e datas! Se necessário acesse os lançamentos e faça as alterações necessárias por lá!');
    }

    function confirmarAcordo()
    {

        var table = document.getElementById('tblparcelasacordo');
        var tablelf = document.getElementById('tbllancamentosacordo');

        if(table.rows.length < 2 )
        {
            alert('Gere o parcelamento antes de confirmar o contrato!');
            return false;

        }

        var valoracordo = realToDolar( $("#i-acordo-valor").val() );
        valoracordo = parseFloat( valoracordo );

        debugger;
        var total=0;
        for (var r = 1, n = table.rows.length; r < n; r++)
        {
            valor = table.rows[r].cells[3].innerHTML;
            valor = realToDolar( valor );
            total = total + parseFloat(valor);
        }

        if( valoracordo != total.toFixed(2))
        {
            alert('O valor total de acordo não condiz com o total em parcelas');
            return false;

        }

        var regs = new Array();
        var lancamentos = new Array();


        for (var r = 1, n = tablelf.rows.length; r < n; r++)
        {
            regs.push(  tablelf.rows[r].cells[1].innerHTML );
        }

        for (var r = 1, n = table.rows.length; r < n; r++)
        {
            valorparcela = realToDolar(table.rows[r].cells[3].innerHTML);
            lancamentos.push( [ table.rows[r].cells[1].innerHTML,
                         table.rows[r].cells[2].innerHTML,
                         valorparcela]);

        }







        let text = "Confirma o Acordo?";
        if (confirm(text) == true)
        {

            $.ajaxSetup(
            {
                headers:
                {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
                });



            var url = "{{ route('acordo.gravar') }}";

            var dados =
            {

                IMB_CTR_ID : $("#i-acordo-contrato").val(),
                IMB_ACD_DATAACORDO : moment( $("#i-acordo-dataacordo").val()).format('YYYY/MM/DD'),
                IMB_ACD_MOTIVOACORDO : $("#i-acordo-motivo").val(),
                IMB_ACD_VALOR : realToDolar( $("#i-acordo-valor").val() ),
                IMB_ACD_PARCELAS : $("#i-acordo-parcelas").val(),
                IMB_ACD_ITENS : tablelf.rows.length-1,
                IMB_ACD_COBRARCOMALUGUEL:  $("#i-acordo-juntoaluguel").prop( "checked" )   ? 'S' : 'N',
                IMB_ACD_VALORENTRADA : realToDolar( $("#i-acordo-entrada").val() ),
                IMB_ACD_DATAENTRADA : moment( $("#i-acordo-dataentrada").val()).format('YYYY/MM/DD'),
                lfs : regs,
                parcelas: lancamentos,
                detalhar:  $("#i-acordo-detalhar").prop( "checked" )   ? 'S' : 'N',
                

            }

            console.log( dados );
            $.ajax(
                {
                    url:url,
                    dataType:'json',
                    type:'post',
                    data:dados,
                    success:function( data )
                    {
                        alert( 'Acordo Realizado!');
                        Swal.fire('ATENÇÃO! É importante que você acesse este contrato e faça a alteração de vencimento '+
                        'para que o sistema posicione o próximo vencimento do locatário')
                        $("#modalacordo").modal('hide');
                        window.close();

                    }
                }
            )
        };




    }

</script>


@endpush
