
<div class="modal fade" id="modalsolicitacaoeventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content ">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Históricos / Releases
                        </div>
                    </div>

                    <input type="hidden" id="IMB_SOL_ID-HIST">
                    <div class="portlet-body form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-10 div-cinza div-center-table-clientes">
                                    <table class="table  table-striped table-hover" id="tblreleases">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th width="10%" >Data/Hora</th>
                                                <th width="20%" >Funcionário</th>
                                                <th width="70%" >Descrição</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 div-center" id="div-botao-novo-release">
                        <button class="btn btn-primary" onClick="novoRelase()">Incluir Novo Release</button>
                    </div>
                    <div class="row">
                        <p></p>
                    </div>
                    <div class="col-md-12 escondido" id="div-novo-release">
                        <div class="col-md-10">
                            <label class="control-label">Descrição do Release</label>
                            <textarea  id="IMB_SLE_DESCRICAO-ALT" cols="100%" rows="5"></textarea>
                        </div>
                        <div class="col-md-2">
                            <p><hr></p>
                            <button class="form-control btn btn-primary" onClick="gravarRelease()">Gravar Release</button>
                            <button class="form-control btn btn-danger">Descartar</button>
                            <p><hr></p>

                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12 div-center">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">sair</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>

    function cargaReleases()
    {
        var url = "{{ route('solicitacoes.eventos.carga') }}/"+$("#IMB_SOL_ID-HIST").val();
        console.log( url );
        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                success:function( data )
                {
                    console.log( data );
                    linha = "";
                    $("#tblreleases>tbody").empty();
                    for( nI=0;nI < data.length;nI++)
                    {
                        linha =
                            '<tr>'+
                            '<td><div class="font-10px"> '+moment(data[nI].IMB_SLE_DATAHORA).format('DD/MM/YYYY HH:mm')+'</div></td>' +
                            '<td><div class="font-10px"> '+data[nI].IMB_ATD_NOME+'</div></td>' +
                            '<td><div class="font-10px"> '+data[nI].IMB_SLE_DESCRICAO+'</div></td> ';
                        linha = linha +
                        '</tr>';

                        $("#tblreleases").append( linha );
                    }

                }
            })


    }

    function novoRelase()
    {
        $("#div-novo-release").show();
        $("#div-botao-novo-release").hide();
    }

    function gravarRelease()
    {
        var url = "{{ route('solicitacoeseventos.store') }}";

        var dados =
        {
            IMB_SOL_ID : $("#IMB_SOL_ID-HIST").val(),
            IMB_SLE_DESCRICAO : $("#IMB_SLE_DESCRICAO-ALT").val(),
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
                    alert('Release Gravado!');
                    $("#div-novo-release").hide();
                    $("#div-botao-novo-release").show();
                }
            }
        )

    }





</script>
@endpush
