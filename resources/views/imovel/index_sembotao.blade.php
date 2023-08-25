@extends('layout.app')

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
            <button class="btn btn-danger pull-right" type="button" id="btn-limpar">Limpar Filtro</button>
        </div>

        <form action="{{route( 'imovel.add' )}}" method="get">
            <button type="submit" class="btn green pull-right" type="button">Novo Imóvel</button>
        </form>        
    </div>

    <div class="portlet-body form">

        <form role="form" id="search-form">
        <!--<form role="form" action="{{ route('imovel.list')}}" method="get">-->
            <div class="form-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="unidade" class="control-label">Unidade</label>
                            <select class="form-control" name="agencia">
                                <option value=""></option>
                                @foreach( $tabela as $imobiliaria )
                                    <option value="{{$imobiliaria->IMB_IMB_ID}}">{{$imobiliaria->IMB_IMB_NOME}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="referencia" class="control-label">Referencia</label>
                            <input type="text" class="form-control" name="referencia" placeholder="Ex.: CA-0003">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="id_completus">Cód Interno</label>
                            <input type="text" class="form-control" name="id_completus">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tipo" class="control-label">Tipo</label>
		    				<select class="form-control" name="tipoimovel">
								<option value="0" selected>Tipo</option>
								@foreach( $tipoimovel as $tipo)
									<option value="{{$tipo->IMB_TIM_ID}}">{{$tipo->IMB_TIM_DESCRICAO}}</option>
								@endforeach
							</select>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                            <label for="tipo" class="control-label">Finalidade</label>
		    				<select class="form-control" name="finalidade">
								<option value="0" selected>Tipo</option>
                                <option value="V">Venda</option>
                                <option value="L">Locação</option>
							</select>
                        </div>
                     </div>
                </div>

                <div class="row">

                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label" for="endereco">Faixa de </label>
                            <input type="number" class="form-control" name="faixainicial" placeholder="De R$ ">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label" for="endereco">Até</label>
                            <input type="number" class="form-control" name="faixafinal" placeholder="De R$ ">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label" for="endereco">Endereco</label>
                            <input type="text" class="form-control" name="endereco" placeholder="Sugestão: coloque parte do endereço">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label" for="endereco">Condomínio</label>
                            <input type="text" class="form-control" name="condominio" placeholder="Sugestão:  parte do nome">
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="bairro">Cidade</label>
                            <input type="text" class="form-control" name="cidade" placeholder="Sugestão: parte do nome">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="bairro">Bairro</label>
                            <input type="text" class="form-control" name="bairro" placeholder="Sugestão: parte do nome">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label class="control-label" for="dormitorio">Dorm.</label>
                            <input type="number" class="form-control" name="dormitorio" >
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label class="control-label" for="suite">Suítes</label>
                            <input type="number" class="form-control" name="suite" >
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="tipo" class="control-label">Status</label>
		    				<select class="form-control" name="status">
								<option value="0" selected>Status</option>
								@foreach( $status as $sta)
									<option value="{{$sta->VIS_STA_ID}}">{{$sta->VIS_STA_NOME}}</option>
								@endforeach
							</select>
                        </div>
                     </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tipo" class="control-label">Corretor</label>
		    				<select class="form-control" name="atendente">
								<option value="0" selected>Corretor</option>
								@foreach( $atendente as $atd)
									<option value="{{$atd->IMB_ATD_ID}}">{{$atd->IMB_ATD_NOME}}</option>
								@endforeach
							</select>
                        </div>
                     </div>

                     <div class="col-md-3">
                        <div class="form-group">
                            <label for="bairro">Proprietário</label>
                            <input type="text" class="form-control" name="proprietario" placeholder="Sugestão: parte do nome proprietário">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="caption font-blue">
                        <span class="caption-subject"> Mais detalhes</span>
                        <i class="fa fa-search font-blue"></i>
                    </div>

                    <div class="col-md-1">
                        <label>
                            <input type="checkbox" name="IMB_IMV_WEBIMOVEL" class="icheck" data-checkbox="icheckbox_flat-blue">
                                Site
                        </label>
                        </div>

                        <div class="col-md-1">
                        <label>
                            <input type="checkbox" name="IMB_IMV_PLACA" class="icheck" data-checkbox="icheckbox_flat-blue">
                            Placa
                        </label>
                    </div>

                    <div class="col-md-2">
                        <label>
                            <input type="checkbox" name="EMCONDOMINIO" class="icheck" data-checkbox="icheckbox_flat-blue">
                            Cond Fechado
                        </label>
                    </div>

                    <div class="col-md-2">
                        <label>
                            <input type="checkbox" name="IMB_IMV_PISCIN" class="icheck" data-checkbox="icheckbox_flat-blue">
                            Píscina
                        </label>
                    </div>

                    <div class="col-md-2">
                        <label>
                            <input type="checkbox" name="IMB_IMV_CHURRA" class="icheck" data-checkbox="icheckbox_flat-blue">
                            Churrasqueira
                        </label>
                    </div>


                </div>

                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="atuinicial">Atualizado</label>
                            <input type="text" class="form-control" name="atuadatainicial" placeholder="Desde dd/mm/yyyy">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="atuinicial">&nbsp;</label>
                            <input type="text" class="form-control" name="atuadatafinal" placeholder="Ate dd/mm/yyyy">
                        </div>
                    </div>


                    <div class="col-md-2">
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="atuinicial">Cadastrado</label>
                            <input type="text" class="form-control" name="caddatainicial" placeholder="Desde dd/mm/yyyy">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="atuinicial">&nbsp;</label>
                            <input type="text" class="form-control" name="caddatafinal" placeholder="Ate dd/mm/yyyy">
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
                        <th width="40px">Dormit </th>
                        <th width="40px">Suítes</th>
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
                    d.unidade = $('input[name=unidade]').val();
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
                {data: 'UNIDADE', name: 'UNIDADE'},
            ],
            "columnDefs": [ 
                {
                    "targets": 7,
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

        
    </script>
@endpush
