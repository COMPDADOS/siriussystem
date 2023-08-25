@extends('layout.app')
@section('scripttop')
   
@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="#">Cadastro</a>
            <i class="fa fa-circle"></i>
        </li>
    </ul>
</div>

<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-blue">
            <span class="caption-subject bold uppercase"> Contratos</span>
            <i class="fa fa-search font-blue"></i>
        </div>

        <div>
            <button class="btn btn-danger pull-right" type="button" id="btn-limpar"
            onClick="limparCampos()">Limpar Filtro</button>
        </div>

        <form action="{{route( 'imovel.index' )}}" method="get">
            <button type="submit" class="btn green pull-right" type="button">Novo Contrato</button>
        </form>        
    </div>

    <div class="portlet-body form">

        <form role="form" id="search-form">
        <!--<form role="form" action="{{ route('contrato.list')}}" method="get">-->
            <input type="hidden" id="IMB_IMB_IDMASTER" name="empresamaster" value="{{ Auth::User()->IMB_IMB_ID }}"> 
            <div class="form-body">
                <input type="hidden" id="i-unidade" name="agencia"> 

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="js-select-unidade" class="control-label">Unidade</label>
                            <select class="form-control" id="js-select-unidade">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="referencia" class="control-label">Pasta</label>
                            <input type="text" class="form-control" name="referencia" 
                            id="i-referencia">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="id_completus">Código Imóvel</label>
                            <input type="text" class="form-control" name="id_completus" id="i-idcompletus">
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="control-label" for="endereco">Endereco</label>
                            <input type="text" class="form-control" name="endereco" 
                            placeholder="Sugestão: coloque parte do endereço" id="i-endereco">
                        </div>
                    </div>
                
                </div>
                
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="condominio">Condomínio</label>
                            <input type="text" class="form-control" name="condominio" id="i-condominio"
                            placeholder="Sugestão:  parte do nome">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="cidade">Cidade</label>
                            <input type="text" class="form-control"
                            name="cidade" id="i-cidade" placeholder="Sugestão: parte do nome">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="bairro">Bairro</label>
                            <input type="text" class="form-control" name="bairro" 
                            id="i-bairro" placeholder="Sugestão: parte do nome">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="i-select-situacao">Situação</label>
                                <input type="hidden" name="situacao" id="i-situacao">
                                <select class="form-control" id="i-select-situacao">
                                    <option value="T" >Todos</option>
                                    <option value="A" selected >Ativos</option>
                                    <option value="E" >Encerrados</option>
                                </select>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="proprietario">Proprietário</label>
                            <input type="text" class="form-control" 
                            name="proprietario" id="i-proprietario"
                            placeholder="Sugestão: parte do nome proprietário">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="locatario">Locatário</label>
                            <input type="text" class="form-control" 
                            name="locatario" id="i-locatario"
                            placeholder="Sugestão: parte do nome locatário">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fiador">Fiador</label>
                            <input type="text" class="form-control" 
                            name="fiador" id="i-fiador"
                            placeholder="Sugestão: parte do nome fiador">
                        </div>
                    </div>
                </div>
                <div class="form-actions noborder">
                    <button class="btn blue pull-right" id='search-form'>Pesquisar</button>
                </div>
        </form>
            <hr style="margin-top: 40px;" />
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered" id="resultTable">
                    <thead>
                        
                        <th>Situação</th>
                        <th>ID.Imóv.</th>
                        <th>Pasta</th>
                        <th>Endereço</th>
                        <th>Bairro</th>
                        <th>Condomínio</th>
                        <th>Locatário</th>
                        <th>Proprietário</div>
                        <!--<th>Unidade</th>-->
                        <th class="text-right" width="120px">Ações</th>
                    </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<form style="display: none" action="{{route('contrato.novo')}}" method="POST" id="form-novocontrato">            
@csrf
    <input type="hidden" id="idimovelcontrato" name="idimovel" />                
</form>

<form style="display: none" action="{{route('lancamento.index')}}" method="GET" id="form-lancamentos">            
    <input type="hidden" id="i-idcontratopesquisa" name="IMB_CTR_ID" />                
</form>

@endsection
@push('script')
<script>
//    $(document).ready(function() {
        //$('#js-select-unidade').select2();
    //});

//    document.getElementById("myText").disabled = true;   
$( "#js-select-unidade" ).change(function() {
        var nUnidade = $('#js-select-unidade').val();
        $("#i-unidade").val( nUnidade);
    });    

    $( "#i-select-tipo" ).change(function() {
        var nTipo = $('#i-select-tipo').val();
        $("#i-tipo").val( nTipo);
    });    


</script>    
<script type="text/javascript">
        var table = $('#resultTable').DataTable({
            "language": 

{
    "sEmptyTable": "Nenhum registro encontrado",
    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
    "sInfoPostFix": "",
    "sInfoThousands": ".",
    "sLengthMenu": "_MENU_ resultados por página",
    "sLoadingRecords": "Carregando...",
    "sProcessing": "Processando...",
    "sZeroRecords": "Nenhum registro encontrado",
    "sSearch": "Pesquisar",
    "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
    },
    "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
    }
},
            processing: true,
            serverSide: true,
            ajax: {
                url:"{{ route('contrato.list') }}",
                data: function (d) {
                    d.id_completus = $('input[name=id_completus]').val();
                    d.referencia = $('input[name=referencia]').val();
                    d.endereco = $('input[name=endereco]').val();
                    d.bairro = $('input[name=bairro]').val();
                    d.condominio = $('input[name=condominio]').val();
                    d.cidade = $('input[name=cidade]').val();
                    d.proprietario = $('input[name=proprietario]').val();
                    d.agencia = $('input[name=agencia]').val();
                    d.situacao = $('input[name=situacao]').val();
                    d.locatario = $('input[name=locatario]').val();
                    d.empresamaster = $('input[name=empresamaster]').val();

                }
            },
            columns: [
                {data: 'IMB_CTR_SITUACAO', name: 'IMB_CTR_SITUACAO'},
                {data: 'IMB_IMV_ID', name: 'IMB_IMV_ID'},
                {data: 'IMB_CTR_REFERENCIA', name: 'IMB_CTR_REFERENCIA  '},
                {data: 'ENDERECOCOMPLETO', name: 'ENDERECOCOMPLETO'},
                {data: 'CEP_BAI_NOME', name: 'CEP_BAI_NOME'},
                {data: 'CONDOMINIO', name: 'CONDOMINIO'},
                {data: 'IMB_CLT_NOMELOCATARIO', name: 'IMB_CLT_NOMELOCATARIO'},
                {data: 'IMB_CLT_NOME', name: 'IMB_CLT_NOME'},
                //{data: 'IMB_CTR_ID', name: 'IMB_CTR_ID'},
//                {data: 'UNIDADE', name: 'UNIDADE'},
            ],
            "columnDefs": [ 
                {
                    "targets": 8,
                    "data": null,
                    "defaultContent": 
                    "<div style='text-align:center'>"+
                    "<button class='glyphicon glyphicon-trash btn btn-primary bg-red pull-right del-ctr'></button>"+
                    "<button class='glyphicon glyphicon-pencil btn btn-primary pull-right alt-ctr'></button>"+
                    "<button class='btn yellow-meadow glyphicon glyphicon-circle-arrow-up pull-right btn-receber'></button>"+
                    "<button class='btn green-meadow glyphicon glyphicon-circle-arrow-down pull-right btn-pagar'></button>"+
                    "<button class='btn btn-primary bg-lime glyphicon glyphicon-usd pull-right show-lf'></button>"+
                    "<button class='btn btn-primary mb1 black bg-yellow glyphicon glyphicon-search pull-right show-imv'></button>",
                } 
            ],
            searching: false
        });


        $("#i-select-situacao").change( function(){
            var situacao =  $("#i-select-situacao").val();
            $("#i-situacao").val( situacao );
        });
        $('#search-form').on('submit', function(e) {

            table.draw();
            e.preventDefault();
        });

        $('#resultTable tbody').on( 'click', '.show-imv', function () {
            var data = table.row( $(this).parents('tr') ).data();
            window.location = "{{ route('imovel.form') }}/" + data.IMB_IMV_ID;            
        });

        $('#resultTable tbody').on( 'click', '.alt-ctr', function () {
            var data = table.row( $(this).parents('tr') ).data();
               window.location = "{{ route('contrato.edit') }}/" + data.IMB_CTR_ID;            
        });


        $('#resultTable tbody').on( 'click', '.show-lf', function () {
            var data = table.row( $(this).parents('tr') ).data();
            $("#i-idcontratopesquisa").val( data.IMB_CTR_ID );
            $("#form-lancamentos").submit();
        });


        function preencherUnidades()
        {

            $.getJSON( "{{route('imobiliaria.carga')}}/"+$("#IMB_IMB_IDMASTER").val(), function( data )
            {
                
                $("#js-select-unidade").empty();
                
                linha =  '<option value="0">Todas Unidades</option>';
                $("#js-select-unidade").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha = 
                    '<option value="'+data[nI].IMB_IMB_ID+'">'+
                        data[nI].IMB_IMB_NOME+"</option>";
                        $("#js-select-unidade").append( linha );
                        
                }

            });
            
        }


        function limparCampos( )
        {
/*
            document.getElementById( 'i-chk-site').checked = false;;
            document.getElementById( 'i-chk-piscina').checked = false;;
            document.getElementById( 'i-chk-churrasqueira').checked = false;;
            document.getElementById( 'i-chk-placa').checked = false;;
            document.getElementById( 'i-chk-condominio').checked = false;;
            document.getElementById( 'i-chk-financiamento').checked = false;;
            document.getElementById( 'i-chk-permuta').checked = false;;

            preencherUnidades();
            preencherTipoImovel();
            preencherFinalidade();
            preencherCorretor();
            preencherStatus();

            $("#i-idcompletus").val('');
            $("#i-referencia").val('');
            $("#i-faixainicial").val('');
            $("#i-faixafinal").val('');
            $("#i-endereco").val('');
            $("#i-condominio").val('');
            $("#i-bairro").val('');
            $("#i-cidade").val('');
            $("#i-dormitorio").val('');
            $("#i-suite").val('');
            $("#i-proprietario").val('');
            $("#i-cadastrado-ini").val('');
            $("#i-cadastrado-fim").val('');
            $("#i-atualizado-ini").val('');
            $("#i-atualizado-fim").val('');

*/
        }

        preencherUnidades();


    </script>
@endpush
