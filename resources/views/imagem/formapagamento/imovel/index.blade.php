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
            <span class="caption-subject bold uppercase"> Imóveis</span>
            <i class="fa fa-search font-blue"></i>
        </div>

        <div>
            <button class="btn btn-danger pull-right" type="button" id="btn-limpar"
            onClick="limparCampos()">Limpar Filtro</button>
        </div>

        <form action="{{route( 'imovel.add' )}}" method="get">
            <button type="submit" class="btn green pull-right" type="button">Novo Imóvel</button>
        </form>        
    </div>

    <div class="portlet-body form">

        <form role="form" id="search-form">
        <!--<form role="form" action="{{ route('imovel.list')}}" method="get">-->
            <div class="form-body">
                <input type="hidden" id="i-unidade" name="agencia"> 
                <input type="hidden" id="i-tipo" name="tipoimovel"> 
                <input type="hidden" id="i-finalidade" name="finalidade"> 
                <input type="hidden" id="i-corretor" name="corretor"> 
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
                            <label for="referencia" class="control-label">Referencia</label>
                            <input type="text" class="form-control" name="referencia" 
                            placeholder="Ex.: CA-0003" id="i-referencia">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="id_completus">Cód Interno</label>
                            <input type="text" class="form-control" name="id_completus" id="i-idcompletus">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tipo" class="control-label">Tipo</label>
		    				<select class="form-control"  id="i-select-tipo">
							</select>
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="form-group">
                            <label for="tipo" class="control-label">Finalidade</label>
		    				<select class="form-control" id='i-select-finalidade'>
							</select>
                        </div>
                     </div>
                </div>

                <div class="row">

                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label" for="faixainicial">Faixa de </label>
                            <input type="number" class="form-control" name="faixainicial"
                             placeholder="De R$" id="i-faixainicial" >
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label" for="faixafinal">Até</label>
                            <input type="number" class="form-control" name="faixafinal" 
                            placeholder="De R$" id="i-faixafinal" >
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label" for="endereco">Endereco</label>
                            <input type="text" class="form-control" name="endereco" 
                            placeholder="Sugestão: coloque parte do endereço" id="i-endereco">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label" for="condominio">Condomínio</label>
                            <input type="text" class="form-control" name="condominio" id="i-condominio"
                            placeholder="Sugestão:  parte do nome">
                        </div>
                    </div>
                </div>

                <div class="row">

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
                    <div class="col-md-1">
                        <div class="form-group">
                            <label class="control-label" for="dormitorio">Dorm.</label>
                            <input type="number" class="form-control" name="dormitorio" 
                            id="i-dormitorio">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label class="control-label" for="suite">Suítes</label>
                            <input type="number" class="form-control" 
                            id="i-suite" name="suite" >
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="tipo" class="control-label">Status</label>
		    				<select class="form-control" name="status" id="i-status">
							</select>
                        </div>
                     </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tipo" class="control-label">Corretor</label>
		    				<select class="form-control" id="i-select-corretor" >
							</select>
                        </div>
                     </div>

                     <div class="col-md-3">
                        <div class="form-group">
                            <label for="proprietario">Proprietário</label>
                            <input type="text" class="form-control" 
                            name="proprietario" id="i-proprietario"
                            placeholder="Sugestão: parte do nome proprietário">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label>
                            <input type="checkbox" name="IMB_IMV_FINANC" 
                            data-checkbox="icheckbox_flat-blue" id="i-chk-financiamento" name="chkfinancliamento">
                                Aceita Financ.
                        </label>
                    </div>

                    <div class="col-md-2">
                        <label>
                            <input type="checkbox" name="IMB_IMV_PERMUT" 
                            data-checkbox="icheckbox_flat-blue" id="i-chk-permuta" name="chkpemuta">
                                Aceita Permuta
                        </label>
                    </div>

                </div>

                <div class="row">
                    <div class="caption font-blue">
                        <span class="caption-subject"> Mais detalhes</span>
                        <i class="fa fa-search font-blue"></i>
                    </div>

                        <div class="col-md-1">
                       <label>
                            <input type="checkbox" name="IMB_IMV_WEBIMOVEL" 
                            data-checkbox="icheckbox_flat-blue" id="i-chk-site" name="chksite">
                                Site
                        </label>
                        </div>

                        <div class="col-md-1">
                        <label>
                            <input type="checkbox" name="IMB_IMV_PLACA" class="icheck"
                             data-checkbox="icheckbox_flat-blue" id="i-chk-placa">
                            Placa
                        </label>
                    </div>

                    <div class="col-md-2">
                        <label>
                            <input type="checkbox" name="EMCONDOMINIO" class="icheck" 
                            data-checkbox="icheckbox_flat-blue" id="i-chk-condominio">
                            Cond Fechado
                        </label>
                    </div>

                    <div class="col-md-2">
                        <label>
                            <input type="checkbox" name="IMB_IMV_PISCIN" class="icheck" 
                            id="i-chk-piscina" data-checkbox="icheckbox_flat-blue">
                            Píscina
                        </label>
                    </div>

                    <div class="col-md-2">
                        <label>
                            <input type="checkbox" name="IMB_IMV_CHURRA" class="icheck" 
                            data-checkbox="icheckbox_flat-blue" id="i-chk-churrasqueira">
                            Churrasqueira
                        </label>
                    </div>


                </div>

                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="atuinicial">Atualizado</label>
                            <input type="text" class="form-control" name="atuadatainicial" 
                            placeholder="Desde dd/mm/yyyy" id="i-atualizado-ini">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="atuinicial">&nbsp;</label>
                            <input type="text" class="form-control" 
                            name="atuadatafinal" placeholder="Ate dd/mm/yyyy" id="i-atualizado-fim">
                        </div>
                    </div>


                    <div class="col-md-2">
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="atuinicial">Cadastrado</label>
                            <input type="text" class="form-control" name="caddatainicial" id="i-cadastrado-ini"
                            placeholder="Desde dd/mm/yyyy">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="atuinicial">&nbsp;</label>
                            <input type="text" class="form-control" name="caddatafinal" id="i-cadastrado-fim"
                            placeholder="Ate dd/mm/yyyy">
                        </div>
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
                        <th>#ID</th>
                        <th>Refer.</th>
                        <th>Endereço</th>
                        <th>Bairro</th>
                        <th style="display:none" >Cidade</th>
                        <th width="30px">Dorm. </th>
                        <th width="30px">Suít.</th>
                        <th width="30px">$ Locação</th>
                        <th width="30px">$ Venda</th>
                        <th >Condomínio</th>
                        <th >Proprietário</th>
                        <th>Unidade</th>
                        <th class="text-right" width="120px">Ações</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
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

    $( "#i-select-finalidade" ).change(function() {
        var cFinalidade = $('#i-select-finalidade').val();
        $("#i-finalidade").val( cFinalidade);
    });    

    $( "#i-select-corretor" ).change(function() {
        var cFinalidade = $('#i-select-corretor').val();
        $("#i-corretor").val( cFinalidade);
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
                url:"{{ route('imovel.list') }}",
                data: function (d) {
                    d.id_completus = $('input[name=id_completus]').val();
                    d.referencia = $('input[name=referencia]').val();
                    d.endereco = $('input[name=endereco]').val();
                    d.bairro = $('input[name=bairro]').val();
                    d.cidade = $('input[name=cidade]').val();
                    d.dormitorio = $('input[name=dormitorio]').val();
                    d.suite = $('input[name=suite]').val();
                    d.agencia = $('input[name=agencia]').val();
                    d.tipoimovel = $('input[name=tipoimovel]').val();
                    d.finalidade = $('input[name=finalidade]').val();
                    d.faixainicial = $('input[name=faixainicial]').val();
                    d.faixafinal = $('input[name=faixafinal]').val();
                    d.condominio = $('input[name=condominio]').val();
                    d.proprietario = $('input[name=proprietario]').val();
                    d.corretor = $('input[name=corretor]').val();
                }
            },
            columns: [
                {data: 'IMB_IMV_ID', name: 'IMB_IMV_ID'},
                {data: 'IMB_IMV_REFERE', name: 'IMB_IMV_REFERE'},
                {data: 'ENDERECOCOMPLETO', name: 'ENDERECOCOMPLETO'},
                {data: 'CEP_BAI_NOME', name: 'CEP_BAI_NOME'},
//                {data: 'IMB_IMV_CIDADE', name: 'IMB_IMV_CIDADE'},
                {data: 'IMB_IMV_DORQUA', name: 'IMB_IMV_DORQUA'},
                {data: 'IMB_IMV_SUIQUA', name: 'IMB_IMV_SUIQUA'},
                {data: 'IMB_IMV_VALLOC', name: 'IMB_IMV_VALLOC'},
                {data: 'IMB_IMV_VALVEN', name: 'IMB_IMV_VALVEN'},
                {data: 'CONDOMINIO', name: 'CONDOMINIO'},
                {data: 'IMB_CLT_NOME', name: 'IMB_CLT_NOME'},
                {data: 'UNIDADE', name: 'UNIDADE'},
            ],
            "columnDefs": [ 
                {
                    "targets": 11,
                    "data": null,
                    "defaultContent": "<div style='text-align:center'><button class='glyphicon glyphicon-trash btn btn-danger pull-right del-imv'></button><button class='glyphicon glyphicon-pencil btn btn-primary pull-right alt-imv'></button><button class='btn green-meadow glyphicon glyphicon-search pull-right show-imv'></button>",
                } 
            ],
            searching: false
        });

        $('#search-form').on('submit', function(e) {
            table.draw();
            e.preventDefault();
        });

        $('#resultTable tbody').on( 'click', '.show-imv', function () {
            var data = table.row( $(this).parents('tr') ).data();
            window.location = "{{ route('imovel.form') }}/" + data.IMB_IMV_ID;            
        });

        $('#resultTable tbody').on( 'click', '.alt-imv', function () {
            var data = table.row( $(this).parents('tr') ).data();
            window.location = "{{ route('imovel.edit') }}/" + data.IMB_IMV_ID;            
        });
  

        function preencherUnidades()
        {

            $.getJSON( '/imobiliaria/carga', function( data )
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

        function preencherFinalidade()
        {
            $("#i-select-finalidade").empty();  
            linha = '<option value="T">Finalidade</option>';
            $("#i-select-finalidade").append( linha );
            linha = '<option value="V">Venda</option>';
            $("#i-select-finalidade").append( linha );
            linha = '<option value="L">Locação</option>';
            $("#i-select-finalidade").append( linha );
        }

        function preencherTipoImovel()
        {

            $.getJSON( '/tipoimovel/carga', function( data )
            {
                $("#i-select-tipo").empty();
                linha = '<option value="0">Escolha o Tipo de Imóvel</option>';
                $("#i-select-tipo").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha = 
                    '<option value="'+data[nI].IMB_TIM_ID+'">'+
                        data[nI].IMB_TIM_DESCRICAO+"</option>";
                        $("#i-select-tipo").append( linha );
                        
                }

            });
            
        }

        function preencherCorretor()
        {

            $.getJSON( '/atendente/carga', function( data )
            {
                $("#i-select-corretor").empty();
                linha = '<option value="0">Escolha o Corretor</option>';
                $("#i-select-corretor").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha = 
                    '<option value="'+data[nI].IMB_ATD_ID+'">'+
                        data[nI].IMB_ATD_NOME+"</option>";
                        $("#i-select-corretor").append( linha );
                        
                }

            });
            
        }


        function preencherStatus()
        {

            $.getJSON( '/status/carga', function( data )
            {
                $("#i-status").empty();
                linha = '<option value="0"></option>';
                $("#i-status").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha = 
                    '<option value="'+data[nI].VIS_STA_ID+'">'+
                        data[nI].VIS_STA_NOME+"</option>";
                        $("#i-status").append( linha );
                        
                }

            });
            
        }

        function limparCampos( )
        {

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

        }


        function desabilitarCampos( )
        {

            document.getElementById( 'i-chk-site').disabled = true;
            document.getElementById( 'i-chk-piscina').disabled = true;
            document.getElementById( 'i-chk-churrasqueira').disabled = true;
            document.getElementById( 'i-chk-placa').disabled = true;
            document.getElementById( 'i-chk-condominio').disabled = true;

            document.getElementById( 'i-idcompletus').disabled = true;
            document.getElementById( 'i-faixainicial').disabled = true;
            document.getElementById( 'i-faixafinal').disabled = true;
            document.getElementById( 'i-endereco').disabled = true;
            document.getElementById( 'i-condominio').disabled = true;
            document.getElementById( 'i-bairro').disabled = true;
            document.getElementById( 'i-cidade').disabled = true;
            document.getElementById( 'i-dormitorio').disabled = true;
            document.getElementById( 'i-suite').disabled = true;
            document.getElementById( 'i-proprietario').disabled = true;
            document.getElementById( 'i-cadastrado-ini').disabled = true;
            document.getElementById( 'i-cadastrado-fim').disabled = true;
            document.getElementById( 'i-atualizado-ini').disabled = true;
            document.getElementById( 'i-atualizado-fim').disabled = true;
            document.getElementById( 'i-select-corretor').disabled = true;
            document.getElementById( 'js-select-unidade').disabled = true;
            document.getElementById( 'i-select-tipo').disabled = true;
            
                        


        }

        preencherStatus();
        preencherCorretor();
        preencherUnidades();
        preencherTipoImovel();
        preencherFinalidade();


    </script>
@endpush
