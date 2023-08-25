
<div class="modal fade" id="modalsolicitacaoeventoscontrato" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content ">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Releases para o contrato <span id="i-enderecoimovelsoleve"></span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="row">
                            <input type="hidden" id="IMB_CTR_IDSOLEVECON">
                            <input type="hidden" id="IMB_SOL_IDRELEASES">
                            <div class="col-md-12">
                                <div class="col-md-12 div-cinza div-center-table-clientes">
                                    <table class="table  table-striped table-hover" id="tblreleasescontrato">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th width="10%" >Data/Hora</th>
                                                <th width="10%" >Fechado em</th>
                                                <th width="20%" >Funcionário</th>
                                                <th width="20%" >Título</th>
                                                <th width="30%" >Descrição</th>
                                                <th></th>

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
                        <button class="btn btn-primary" onClick="novoChamado()">Incluir Novo Chamado/Solicitação</button>
                    </div>

                    <div class="row">
                        <p></p>
                    </div>
                    <div class="col-md-12 escondido" id="div-novo-release-eve">
                        <div class="col-md-10">
                            <label class="control-label">Descrição do Release</label>
                            <textarea  id="IMB_SLE_DESCRICAO-ALT-RELEASE" cols="100%" rows="5"></textarea>
                        </div>
                        <div class="col-md-2">
                            <p><hr></p>
                            <button class="form-control btn btn-primary" onClick="gravarRelease()">Gravar Release</button>
                            <button class="form-control btn btn-danger" onClick="descartarEvento()">Descartar</button>
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

    function novoRelease( id )
    {
        $("#div-novo-release-eve").show();
        $("#div-botao-novo-release").hide();
        $("#IMB_SLE_DESCRICAO-ALT-RELEASE").val('');
        $("#IMB_SOL_IDRELEASES").val(id);
    }

    function gravarRelease()
    {
        $("#div-novo-release-eve").hide();

        var url = "{{ route('solicitacoeseventos.store') }}";

        var dados =
        {
            IMB_SOL_ID : $("#IMB_SOL_IDRELEASES").val(),
            IMB_SLE_DESCRICAO : $("#IMB_SLE_DESCRICAO-ALT-RELEASE").val(),
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
                    $("#modalsolicitacaoeventoscontrato").modal('hide');
                    $("#div-novo-release-eve").hide();
                    $("#div-botao-novo-release").show();
                    

                }
            }
        )

    }

    function cargaEventos( id )
    {
        alert('Entrando na área de solicitações do contrato. Click OK para prosseguir');
        var url = "{{route('contrato.findfull')}}/"+id;
        $("#tblreleasescontrato>tbody").empty();
        
        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                async:false,
                success:function( data )
                {
                    $("#i-enderecoimovelsoleve").html( 'Pasta: '+data.IMB_CTR_REFERENCIA+' - '+data.ENDERECOCOMPLETO );

                }
            }

        )
        $("#IMB_CTR_IDSOLEVECON").val(id);        
        $('#tblreleasescontrato').dataTable().fnClearTable();
        $('#tblreleasescontrato').dataTable().fnDestroy();
        var tablereleases = $('#tblreleasescontrato').DataTable(
            {
                "language":
                {
                    "sEmptyTable": "Nenhum registro encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    sLoadingRecords: '<div class="overlay"><img src="{{asset('/layouts/layout/img/loader.gif')}}"/></div>',
                    sProcessing: '<div class="overlay"><img src="{{asset('/layouts/layout/img/loader.gif')}}"/></div>',
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sSearch": "Pesquisar",
                    "oPaginate":
                    {
                        "sNext": "Próximo",
                        "sPrevious": "Anterior",
                        "sFirst": "1ª Página",
                        "sLast": "Últ. Página"
                    },
                    "oAria":
                    {
                        "sSortAscending": ": Ordenar colunas de forma ascendente",
                        "sSortDescending": ": Ordenar colunas de forma descendente"
                    }
                },
                processing: true,
                serverSide: true,
                pagingType: "full_numbers",

                ajax:
                {
                    url:"{{ route('solicitacoes.comevento') }}",
                    data: function (d)
                    {
                        d.IMB_SOL_ID = id;
                    }

                },
                columns: [

                    {  "data": 'IMB_SOL_ID', render:acoes },
                    {  "data": 'IMB_SLE_DATAHORA', render:formatarDataHoraConEve  },
                    {  "data": 'IMB_SOL_DATAFECHAMENTO', render:formatarDataConEve  },
                    {  "data": 'ATENDENTEDESTINO'  },
                    {  "data": 'IMB_SOL_TITULO' },
                    {  "data": 'IMB_SLE_DESCRICAO'},
                ],

                searching: false
            });
        }

        function formatarDataHoraConEve( data)
        {
            return moment( data ).format( 'DD-MM-YYYY HH:mm');

        }
        function formatarDataConEve( data)
        {
            if( data === null )
                return '-'
            else
                return moment( data ).format( 'DD-MM-YYYY');

        }

        function descartarEvento()
        {
            $("#div-novo-release-eve").hide();

        }

        function acoes( data )
        {
            return '<div><button class="btn-small" onClick="novoRelease( '+data+')">Novo Release</button><div>';
        }

        function novoChamado( )
        {
            $("#enderecoimovel-SOL").val( $("#i-enderecoimovelsoleve").html() );
            $("#IMB_CTR_ID-SOL").val( $("#IMB_CTR_IDSOLEVECON").val() );
            $("#IMB_CTR_ID-LOCIMV").val( $("#IMB_CTR_IDSOLEVECON").val() );
                        
            $("#modalsolicitacaoeventoscontrato").modal('hide');
            $("#modalsolicitacao").modal('show');
        
        }
        



</script>
@endpush
