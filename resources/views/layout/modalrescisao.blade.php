<div class="modal fade" id="modalrescisao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog"  style="width:90%;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Rescisão Contratual
                        </div>
                    </div>

                    <input type="hidden" id="i-rescisao-contrato">
                    <div class="portlet-body form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <label class="control-label">Endereço</label>
                                    <input class="form-control" type="text" id="i-rescisao-endereco" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label">Locatário</label>
                                    <input class="form-control" type="text" id="i-rescisao-locatario" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Valor Aluguel</label>
                                    <input class="form-control valor"type="text" id="i-rescisao-valoraluguel" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Prox.Vencimento</label>
                                    <input class="form-control" type="date" id="i-rescisao-proximovencimento" readonly>
                                </div>
                            </div>

                            <div class="col-md-12">

                                <div class="col-md-5">
                                    <div class="col-md-3"   >
                                        <label class="control-label">Data da Rescisão</label>
                                        <input class="form-control" type="date" id="i-rescisao-datarescisao">
                                    </div>
                                    <div class="col-md-9">
                                        @php
                                            $motivos  = app('\App\Http\Controllers\ctrRotinas')->motivoRescisaoCarga();
                                        @endphp
                                        <label class="control-label">Motivo Rescisão</label>
                                        <select class="form-control" id="i-rescisao-motivo">
                                            <option value="">Informe o Motivo</option>
                                            @foreach($motivos as $motivo)
                                                <option value="{{ $motivo->IMB_MTR_ID }}">{{ $motivo->IMB_MTR_DESCRICAO}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        @php
                                            $status  = app('\App\Http\Controllers\ctrStatusImovel')->carga(1);
                                        @endphp
                                        <Label class="control-label">Status do Imóvel após Rescição</Label>
                                        <select class="form-control" id="i-rescisao-statusimovel">
                                            <option value="">Informe o Status</option>
                                            @foreach($status as $st)
                                                <option value="{{ $st->VIS_STA_ID }}">{{ $st->VIS_STA_NOME}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-7 borda-1">
                                    <h6 class="div-center  gb-botoes">Acerto de Dias</h6>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label class="control-label">Dias</label>
                                            <input class="form-control" type="number" id="i-rescisao-dias">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label">Valor</label>
                                            <input class="form-control valor" type="text" id="i-rescisao-dias-valor">
                                        </div>
                                        <div class="col-md-7">
                                            <label class="control-label">Descrição</label>
                                            <input class="form-control" type="text" id="i-rescisao-dias-descricao">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6">

                                </div>
                                <div class="col-md-2" id="i-rescisao-btnreativar">
                                        <button class="btn btn-warning" onclick="reativarContrato()" >Reativar Contrato</button>
                                    </label>
                                </div>
                                <div class="col-md-2 div-center">
                                    <label> &nbsp;</label>
                                    <button class="btn btn-primary" onclick="confirmarRescisao()">Confirmar</button>
                                </div>

                                <div class="col-md-2 div-center">
                                    <label> &nbsp;
                                        <button class="btn btn-danger"  data-dismiss="modal">Cancelar</button>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 atrasado">
                                    <h3>Caso exista mais lançamentos a serem realizados, por favor utilize o módulo de lançamentos</h3>
                                </div>
                            </div>
                        <hr>
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


    $("#i-rescisao-statusimovel").val( 5 );

    $("#i-rescisao-datarescisao").blur( function()
    {
        var datavencimento = $("#i-rescisao-proximovencimento").val();
        var datarescisao= $("#i-rescisao-datarescisao").val();
        console.log( datavencimento);
        console.log( datarescisao);
        var diff = moment(datarescisao).diff(moment(datavencimento));
//        console.log(diff);
        var dias = moment.duration(diff).asDays();
        var valoraluguel = $("#i-rescisao-valoraluguel").val();
        var valoraluguel = realToDolar( valoraluguel );

        $("#i-rescisao-dias").val( dias );

        if( dias  > 31 || dias < -31 )
        {
            alert('Atenção! Por se tratar de uma diferença de dias maior que a de um mês, será necessário colocar a informação calculada manualmente!');
            return false;
        }

        $("#i-rescisao-dias-valor").val(0);
        $("#i-rescisao-dias-descricao").val( '');

        if( dias != 0 )
        {
            calculo =  valoraluguel / 30  * dias;
            calculo = formatarBRSemSimbolo( calculo );
            $("#i-rescisao-dias-valor").val( calculo);
            $("#i-rescisao-dias-descricao").val( 'Referente a '+dias+' de locação - Acerto Final' );
        }

    });


    function confirmarRescisao()
    {

        if( $("#i-rescisao-motivo").val() == '' )
        {
            alert('Informe o Motivo da Rescisão');
            return false;
        }

        let text = "Confirma a rescisão?";
        if (confirm(text) == true)
        {

            $.ajaxSetup(
                {
                headers:
                {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
                });

            var url = "{{ route('contrato.rescisao.confirmar') }}";

            var dados =
            {

                IMB_CTR_ID : $("#i-rescisao-contrato").val(),
                datarescisao: $("#i-rescisao-datarescisao").val(),
                dias : $("#i-rescisao-dias").val(),
                diasvalor : realToDolar( $("#i-rescisao-dias-valor").val() ),
                obervacao : $("#rescisao-dias-descricao").val(),
                statusimovel: $("#i-rescisao-statusimovel").val(),
            }

            $.ajax(
                {
                    url:url,
                    dataType:'json',
                    type:'post',
                    data:dados,
                    success:function( data )
                    {
                        alert( 'Rescisão Realizada');
                        $("#modalrescisao").modal('hide');

                    }
                }
            )
            }



    }

    function rescisao(id )
    {
        $("#modalrescisao").modal('show');
        $("#i-rescisao-contrato").val( id );
        $("#i-rescisao-datarescisao").val( moment().format('YYYY-MM-DD') );

        var url = "{{ route('contrato.findfull') }}/"+id;
        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                success:function(data )
                {
                    valoraluguel = dolarToReal( data.IMB_CTR_VALORALUGUEL);
                    $("#i-rescisao-endereco").val( data.ENDERECOCOMPLETO)
                    $("#i-rescisao-locatario").val( data.LOCATARIO);
                    $("#i-rescisao-valoraluguel").val(valoraluguel);
                    $("#i-rescisao-proximovencimento").val(data.IMB_CTR_VENCIMENTOLOCATARIO);
                    if( data.IMB_CTR_DATARESCISAO != null )
                        $("#i-rescisao-datarescisao").val(data.IMB_CTR_DATARESCISAO);

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

    function reativarContrato()
    {

        let text = "Confirma a Reativação do Contrato?";
        if (confirm(text) == true)
        {

            $.ajaxSetup(
                {
                headers:
                {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
                });

            var url = "{{ route('contrato.reativar') }}";

            var dados =
            {

                IMB_CTR_ID : $("#i-rescisao-contrato").val(),
            }

            $.ajax(
                {
                    url:url,
                    dataType:'json',
                    type:'post',
                    data:dados,
                    success:function( data )
                    {
                        alert( 'Reativação Realizada!');
                        $("#modalrescisao").modal('hide');

                    }
                }
            )
            }




    }


</script>


@endpush
