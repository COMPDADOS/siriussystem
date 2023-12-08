@extends('layout.app')

@section('scripttop')
@endsection
@section('content')

<div class="portlet box blue-dark" id="div-adm">
    <div class="row">
        <div class="col-md-1">
        </div>
    </div>

    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Atalhos da Administração de Imóveis
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"></a>
        </div>
    </div>

    <div class="portlet-body form">
        <div class="row">
            <div class="col-md-12">
                @php
                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Contratos', 'Contratos Locação', 'ADM', 'Contratos','S', 'X', 'Botão');
                @endphp

                <div class="col-md-2 div-center {{$acesso}}">
                    <a href="{{route('contrato.index')}}">
                        <img src="{{asset('global/img/contratos.png')}}" alt="">
                        <p>Gerenciador de Contratos</p>
                    </a>

                </div>
                @php
                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Clientes', 'Clientes', 'CRM', 'Clientes','S', 'X', 'Botão');
                @endphp

                <div class="col-md-2 div-center {{$acesso}}">
                    <a href="{{route('cliente.index')}}">
                        <img src="{{asset('global/img/clientes.png')}}" alt="">
                        <p>Clientes</p>
                    </a>
                </div>

                @php
                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Imovel', 'Imóveis(Acessar/Incluir/alterar/excluir)', 'CRM', 'Imóveis','S', 'X', 'Botão')
                @endphp
                <div class="col-md-2 div-center {{$acesso}}">
                    <a href="{{route('imovel.index')}}">
                        <img src="{{asset('global/img/alugar.png')}}" alt="">
                        <p>Imóveis / Novo Contrato</p>
                    </a>
                </div>
                @php
                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'ImoveisAprovacao', 'Aprovação de Contratos', 'ADM', 'Contratos','S', 'X', 'Botão');
                @endphp
                <div class="col-md-2 div-center {{$acesso}}">
                    <a href="#">
                        <img src="{{asset('global/img/aprovacao.png')}}" alt="">
                        <p>Em Aprovaçao</p>
                    </a>
                </div>
                @php
                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'CobrancaBancaria', 'Cobrança Bancária', 'ADM', 'Cobrança Bancária','S', 'X', 'Botão');
                @endphp
                <div class="col-md-2 div-center {{$acesso}}">
                    <a href="{{route('cobranca.index')}}">
                        <img src="{{asset('global/img/cobrancabancaria.png')}}" alt="">
                        <p>Cobrança Bancária</p>
                    </a>
                </div>
                @php
                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'PainelVistorias', 'Painel de Vistorias', 'ADM', 'Vistorias','S', 'X', 'Botão');
                @endphp

                <div class="col-md-2 div-center {{$acesso}}">
                    <a href="{{route('besoft.painel')}}">
                        <img src="{{asset('global/img/vistoria.png')}}" alt="">
                        <p>Vistorias</p>
                    </a>
                </div>
            </div>
            <div class="col-md-12">
                @php
                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'ReajustesAlugel', 'Reajuste de Aluguéres', 'ADM', 'Reajustes','S', 'X', 'Botão');
                @endphp
                <div class="col-md-2 div-center {{$acesso}}">
                    <a href="{{route('reajustar.index')}}">
                        <img src="{{asset('global/img/reajustar.png')}}" alt="">
                        <p>Planilha de Contratos a Reajustar</p>
                    </a>
                </div>
                @php
                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'CentralRepasse', 'Central de Repasses', 'ADM', 'Repasses ao Locador','S', 'X', 'Botão');
                @endphp
                <div class="col-md-2 div-center {{$acesso}}">
                    <a href="">
                        <img src="{{asset('global/img/centralrepasse.png')}}" alt="">
                        <p>Central de Repasses</p>
                    </a>
                </div>
                @php
                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'RelatórioAdministtrativos', 'Menu do Relatórios Administrativos', 'ADM', 'Relatórios','S', 'X', 'Botão');
                @endphp
                <div class="col-md-2 div-center {{$acesso}}">
                    <a href="{{route('admimoveis.relatorios')}}">
                        <img src="{{asset('global/img/relcontratos.png')}}" alt="">
                        <img src="{{asset('global/img/relcontratos.png')}}" alt="">
                        <p>Relatórios Administrativos</p>
                    </a>
                </div>

                @php
                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Inadimplentes', 'Inadimplentes(Aluguéres em Atraso)', 'ADM', 'Inadimplen','S', 'X', 'Botão');
                @endphp
                <div class="col-md-2 div-center {{$acesso}}">
                    <a href="{{route('inadimplentes')}}">
                        <img src="{{asset('global/img/devedores.png')}}" alt="">
                        <p>Inadimplentes(atrasados)</p>
                    </a>
                </div>
                @php
                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'RelPreRepasses', 'Relat. Previsão Repasses Locador', 'ADM', 'Repasses ao Locador','S', 'X', 'Botão');
                @endphp
                <div class="col-md-2 div-center {{$acesso}}">
                    <a href="{{route('relatorioprevisaorepasse')}}">
                        <img src="{{asset('global/img/relcontratos.png')}}" alt="">
                        <p>Previsão de Repasses</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="portlet box blue-dark" id="div-finan">
    <div class="row">
        <div class="col-md-1">
        </div>
    </div>

    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Atalhos da Área Financeira
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"></a>
        </div>
    </div>

    <div class="portlet-body form">
        <div class="row">
            <div class="col-md-12">
            @php
                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'PlanilhaRepasses', 'Planilha Repasse ao Locador', 'ADM', 'Repasses ao Locador','S', 'X', 'Botão');
                @endphp
                <div class="col-md-2 div-center {{$acesso}}">
                    <a href="{{route('planilhadepositos.index')}}">
                        <img src="{{asset('global/img/centralrepasse.png')}}" alt="">
                        <p>Planilha Depósito</p>
                    </a>

                </div>

                
                @php
                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'ContasCaixa', 'Contas Banco/Caixa', 'FIN', 'Tesouraria - Bancos/Caixa','S', 'X', 'Botão');
                @endphp
                <div class="col-md-2 div-center {{$acesso}}">
                    <a href="{{route('contacaixa')}}">
                        <img src="{{asset('global/img/contasdecaixa.png')}}" alt="">
                        <p>Contas de Caixa</p>
                    </a>

                </div>
                    @php
                        $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'ConsultaCaixa', 'Consulta Bancos/Caixa', 'FIN', 'Tesouraria - Bancos/Caixa','S', 'X', 'Botão');
                    @endphp
                <div class="col-md-2 div-center {{$acesso}}">
                    <a href="{{route('caixa.index')}}">
                        <img src="{{asset('global/img/consultarcaixa.png')}}" alt="">
                        <p>Consulta de Caixa</p>
                    </a>
                </div>
                @php
                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'TabelaCFC', 'Tabela de Classificação Financeira(CFC)', 'FIN', 'Tesouraria - Bancos/Caixa','S', 'X', 'Botão');
                @endphp
                <div class="col-md-2 div-center {{$acesso}}">
                    <a href="{{route('cfc')}}">
                        <img src="{{asset('global/img/cfc.png')}}" alt="">
                        <p>Tabela de Classificação Financeira(CFC)</p>
                    </a>
                </div>

                @php
                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'ContasPagar', 'Contas a Pagar', 'FIN', 'Contas a Pagar','S', 'X', 'Botão');
                @endphp
                <div class="col-md-2 div-center {{$acesso}}">
                    <a href="{{ route('contasapagar') }}">
                        <img src="{{asset('global/img/contasapagar.png')}}" alt="">
                        <p>Contas a Pagar</p>
                    </a>
                </div>
                @php
                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'NotasFiscais', 'Notas Fiscais', 'FIN', 'Notas Fiscais','S', 'X', 'Botão');
                @endphp
                <div class="col-md-2 div-center {{$acesso}}">
                    <a href="{{ route('nfe.index') }}">
                        <p></p>
                        <i class="fa fa-file-code-o fa-3x" aria-hidden="true"></i>                        
                        <p>Notas Fiscais</p>
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>

<div class="portlet box green" id="div-areacomercial">
    <div class="row">
        <div class="col-md-1">
        </div>
    </div>

    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Atalhos do CRM - Área Comercial
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"></a>
        </div>
    </div>

    <div class="portlet-body form">
        <div class="row">
            <div class="col-md-12">
                @php
                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'ConsultarImóveis', 'Consultar Imóveis', 'CRM', 'Imóveis','S', 'X', 'Botão');
                @endphp

                <div class="col-md-2 div-center {{$acesso}}">
                    <a href="{{route('imovel.index')}}">
                        <img src="{{asset('global/img/alugar.png')}}" alt="">
                        <p>Consultar Imóveis</p>
                    </a>
                </div>
                @php
                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Clientes', 'Cadastro de Clientes', 'CRM', 'Clientes','S', 'X', 'Botão');
                @endphp
                <div class="col-md-2 div-center {{$acesso}}">
                    <a href="{{route('cliente.index')}}">
                        <img src="{{asset('global/img/clientes.png')}}" alt="">
                        <p>Clientes</p>
                    </a>
                </div>

                @php
                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Atendimentos', 'Atendimentos', 'CRM', 'Atendimento','S', 'X', 'Botão');
                @endphp
                <div class="col-md-2 div-center {{$acesso}}">
                    <a href="{{route('atendimento')}}">
                        <img src="{{asset('global/img/atendimentos.png')}}" alt="">
                        <p>Atendimentos</p>
                    </a>
                </div>

                @php
                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'ControlChaves', 'Controle de Chaves', 'CRM', 'Controle de Chaves','S', 'X', 'Botão');
                @endphp
                <div class="col-md-2 div-center {{$acesso}}">
                    <a href="{{route('chaves')}}">
                        <img src="{{asset('global/img/chaves.png')}}" alt="">
                        <p>Controle de Chaves</p>
                    </a>
                </div>


                @php
                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Equipes', 'Equipes de Vendas/Ações', 'CRM', 'Equipes','S', 'X', 'Botão');
                @endphp
                <div class="col-md-2 div-center {{$acesso}}">
                    <a href="{{route('equipe')}}">
                        <img src="https://www.siriussystem.com.br/sys/assets/global/img/equipes.png" alt="">
                        <p>Equipes</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="portlet box yellow" id="div-estatisticas">
    <div class="row">
        <div class="col-md-1">
        </div>
    </div>

    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Estatísticas
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"></a>
        </div>
    </div>

    <div class="portlet-body form">
        <div class="row">
            <div class="col-md-12">
                @php
                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'DashboardAdm', 'Dashboard Adm Imóveis', 'ADM', 'Dashboards','S', 'X', 'Botão');
                @endphp

                <div class="col-md-2 div-center {{$acesso}}">
                <p>
                    <a href="{{route('estatistica.admimovel')}}">
                        <img src="{{asset('global/img/estatisticas.png')}}" alt="">
                            <p>Estatística na Adm. Imóveis</p>
                    </a>
                    </p>                    
                </div>
                @php
                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'DashboardCRM', 'Dashboard CRM', 'CRM', 'Dashboards','S', 'X', 'Botão');
                @endphp

                <div class="col-md-2 div-center  {{$acesso}}">
                    <p>
                    <a href="{{route('estatistica.crm')}}">
                        <img src="{{asset('global/img/estatisticas.png')}}" alt="">
                            <p>Estatística do CRM</p>
                    </a>
                    </p>                    
                </div>
                @php
                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'DashboardFin', 'Dashboard Financeiro', 'FIN', 'Dashboards','S', 'X', 'Botão');
                @endphp

                <div class="col-md-2 div-center  {{$acesso}}">
                <p>
                    <a href="#">
                        <img src="{{asset('global/img/estatisticas.png')}}" alt="">
                            <p>Estatística do Financeiro</p>
                    </a>
                    </p>                    
                </div>
            </div>
        </div>
    </div>

    
</div>
<div class="portlet box dark" id="div-diversos">
    <div class="row">
        <div class="col-md-1">
        </div>
    </div>

    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Atalhos Diversos
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"></a>
        </div>
    </div>

    <div class="portlet-body form">
        <div class="row">
            <div class="col-md-12">
                @php
                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Dimob', 'Dimob', 'ADM', 'Dimob','S', 'X', 'Botão');
                @endphp

                <div class="col-md-2 div-center  {{$acesso}}">
                    <a href="{{route('dimob.index')}}">
                        <img src="{{asset('global/img/dimob.png')}}" alt="">
                        <p>Dimob</p>
                    </a>
                </div>
                @php
                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Auditoria', 'Auditoria', 'Geral', 'Auditoria','S', 'X', 'Botão');
                @endphp
                <div class="col-md-2 div-center  {{$acesso}}">
                    <a href="{{route('auditoria')}}">
                        <img src="{{asset('global/img/auditoria.png')}}" alt="">
                        <p>Auditoria</p>
                    </a>
                </div>
                @php
                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Chamados', 'Chamados/Solicitações', 'Geral', 'Chamados/Solicitações','S', 'X', 'Botão');
                @endphp
                <div class="col-md-2 div-center  {{$acesso}}">
                    <a href="{{route('solicitacoes.index')}}">
                        <img src="{{asset('global/img/chamados.png')}}" alt="">
                        <p>Chamados</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    
</div>


<div class="portlet box red" id="div-lembretes">
    <div class="row">
        <div class="col-md-1">
        </div>
    </div>

    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Informações de Lembretes e Chamados
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"></a>
        </div>
    </div>

    <div class="portlet-body form">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover"  id="resultTablesol">
                    <thead>
                        <th></th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row" id='id-advertencia'>
    <h2 class="div-center font-20-red-white">ADVERTÊNCIAS IMPORTANTES</h2>
    @php
        $boletos = app( 'App\Http\Controllers\ctrCobrancaGerada')->boletosAVencerSemRegistrar();
        $qtboletossemretorno = 0;
        foreach ($boletos  as $boleto)
        {
            $qtboletossemretorno = $qtboletossemretorno + 1;
        }
    @endphp
    @if( $qtboletossemretorno > 0 )
        <div class="col-md-12" id="i-adv-boletos-sem-registro">
            <h3 class="font-red div-center">Boletos sem Informações de Retorno(Não foi lido o retorno)</h3>
            @foreach( $boletos as $boleto)
                <div class="row">
                    <div class="col-md-1">
                        Pasta: <b>{{ app('App\Http\Controllers\ctrRotinas')->pegarReferencia( $boleto->IMB_CTR_ID)}}</b>
                    </div>
                    <div class="col-md-3">
                        Vencto: <b>{{date( 'd/m/Y', strtotime( $boleto->IMB_CGR_DATAVENCIMENTO))}}</b>
                    </div>
                    <div class="col-md-2">
                        Valor: <b> R$ {{ number_format( $boleto->IMB_CGR_VALOR,2,',','.')}}</b>
                    </div>
                    <div class="col-md-3">
                        <b>{{$boleto->IMB_CGR_IMOVEL}}</b>
                    </div>
                    <div class="col-md-3">
                        <b>{{$boleto->IMB_CGR_DESTINATARIO}}</b>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    

</div>



@include('layout.modalsolicitacao');
@include('layout.pesquisarclientes');

<div class="quick-nav-overlay"></div>


@endsection
@push('script')
    <script>


        $(document).ready(function() 
        {
   
            $('#div-finan .portlet-title').click();
            $('#div-diversos .portlet-title .collapse').click();
            $('#div-areacomercial .portlet-title .collapse').click();
            $('#div-estatisticas .portlet-title .collapse').click();

            var table = $('#resultTablesol').DataTable(
    {
        "paging":   false,
        "ordering": false,
        "info":     false,
        "language":

        {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            sLoadingRecords: '<img src="{{asset('/layouts/layout/img/loader.gif')}}"/>',
            sProcessing: '<img src="{{asset('/layouts/layout/img/loader.gif')}}"/>',
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate":
            {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
        },
        bSort : false ,
        processing: true,
        serverSide: true,
        pagingType: "full_numbers",

        ajax:
        {
            url:"{{ route('solicitacoes.list') }}",
            data: function (d) {
                
                d.abertas ='S';
            }
        },
        columns: [
            {data: 'IMB_SOL_ID', render:getInformações},
        ],
        searching: false
    });

        $('#search-form').on('submit', function(e) 
        {
            table.draw();
            e.preventDefault();
        });
    });

    function getInformações( data, type, full, meta)
    {
        var datavisualizacao = full.IMB_SOL_DTHVISUALIZACAO;
        if( datavisualizacao === null )
            datavisualizacao = 'Não Visualizado'
        else
            datavisualizacao = moment( full.IMB_SOL_DTHVISUALIZACAO ).format('DD/MM/YYYY  HH:mm');

        var obs = full.IMB_SOL_OBSERVACAO;
        if( full.IMB_SOL_OBSERVACAO===null) obs='';

        var titulo = full.IMB_SOL_TITULO;
        if( full.IMB_SOL_TITULO===null) titulo='';

        abertopor = full.ATENDENTEABERTURA;
        if( full.IMB_CLT_IDABERTURA != null )
            var abertopor = '</i>**Aberto Pelo Cliente**</i>';

        var tiposolicitacao = full.TIPOSOLICITACAO;
        if( tiposolicitacao === null) tiposolicitacao = 'Não Informado';

        var dataprevisao = full.IMB_SOL_DATAPREVISAO;
        if( dataprevisao === null )
            dataprevisao = 'Sem Previsão    '
        else
        dataprevisao = moment(full.IMB_SOL_DATAPREVISAO).format('DD/MM/YYYY');

        var  imovel = '';
        if( full.ENDERECOCOMPLETO != '' )
            imovel = 'Imóvel: <b><span class="font-blue">'+full.ENDERECOCOMPLETO+'</span><b>';

        var cliente ='';
        if( full.IMB_CLT_IDLOCADOR != 0 )
        {
            cliente = 'Locador: <b><span class="font-blue">'+full.NOMELOCADOR+'</span><b>';
        }
        if( full.IMB_CLT_IDLOCATARIO != 0 )
        {
            cliente = 'Locatário: <b><span class="font-blue">'+full.NOMELOCATARIO+'</span><b>';
        }
        if( full.IMB_CLT_IDFIADOR != 0 )
        {
            cliente = 'Fiador: <b><span class="font-blue">'+full.NOMEFIADOR+'</span><b>';
        }


        var classeprioridade = '';
        var prioridade = '';
        if( full.IMB_SOL_PRIORIDADE == 'A' )
        {
            classeprioridade = 'Class="font-red bold"';
            prioridade = 'Prioridade: **** ALTA ***';
        }
        else
        if( full.IMB_SOL_PRIORIDADE == 'M' )
        {
            classeprioridade = 'Class="font-orange bold"';
            prioridade = 'Prioridade: ** MÉDIA **';
        }
        else
        if( full.IMB_SOL_PRIORIDADE == 'B' )
        {
                classeprioridade = 'Class="font-blue bold"';
                prioridade = 'Prioridade: * BAIXA *';
        }

        var situacao = '';
        if( full.IMB_SOL_DATAFECHAMENTO ===null  )
            situacao = 'ABERTA'
        else
            situacao = 'FECHADA EM '+moment( full.IMB_SOL_DATAFECHAMENTO  ).format( 'DD/MM/YYYY');


//        if(  dataprevisao = 'Invalid date') dataprevisao = 'Sem Previsão';

        var texto = '<div class="row receita bold font-padrao">'+
                '   <div class="col-md-1 row-top-margin bold font-padrao">Pasta: <b>('+full.IMB_CTR_REFERENCIA+')</b></div>'+
                '   <div class="col-md-2 row-top-margin bold font-padrao">'+
                '       Data Abertura: <b>'+moment(full.IMB_SOL_DTHATIVO).format('DD/MM/YYYY')+'</b>'+
                '   </div>'+
                '   <div class="col-md-2 row-top-margin bold font-padrao">'+
                '       Resolver até: <b>'+dataprevisao+'</b>'+
                '   </div>'+
                '   <div class="col-md-3 row-top-margin bold font-padrao">'+
                '       Tipo Solicitação: <b>'+tiposolicitacao+'</b>'+
                '   </div>'+
                '   <div class="col-md-4 row-top-margin bold font-padrao">'+
                '       Abertura: <b>'+abertopor+'</b>'+
                '   </div>';
                                            //final de linha
            texto = texto +'</div>';




            texto = texto +
                '<div class="row receita bold font-padrao">'+
                    '<div class="col-md-2 row-top-margin bg-direcionado font-padrao">Direcionado para: <b>'+full.ATENDENTEDESTINO+'</b>'+
                    '   <p>Visualizado em: '+datavisualizacao+'</p>'+
                    '</div>';
            texto = texto +
                    '<div class="col-md-8 row-top-margin bg-white font-padrao">'+
                    '   <div class="row receita bold font-padrao"> '+
                        '      <div class="col-md-4">'+cliente+'</div>'+
                        '      <div class="col-md-4">'+imovel+'</div>'+
                        '   </div>'+
                    '   <b>'+titulo+'</b>'+
                    '   <p>'+obs+'</p>'+
                    '   <p><span '+classeprioridade+'>'+prioridade+'</span>'+
                    '       <span>'+situacao+'</span> '+
                    '   </p>'+
                    '</div>';

            texto = texto +
                    '<div class="col-md-2 row-top-margin bg-white font-8">'+
                    '<p><div class="row">'+
                    '<div class="col-md-12">'+
                    '  <a title="inativar solicitacao"'+
                    '       href="inativarSolicitacao( '+full.IMB_SOL_ID+')"> '+
                    '       <i class="fa fa-trash" style="font-size:24px;color:red"></i>'+
                    '  </a> '+
                    '  <a title="Alterar Informações"'+
                    '       href="javascript:alterarSolicitacao( '+full.IMB_SOL_ID+');"> '+
                    '       <i class="fa fa-edit" style="font-size:24px;color:blue"></i>'+
                    '  </a> '+
                    '  <a title="Anexar Documentos"'+
                    '       href="alterarSolicitacao( '+full.IMB_SOL_ID+')"> '+
                    '       <i class="fa fa-paperclip" style="font-size:24px;color:black"></i>'+
                    '  </a> ';

            if( full.IMB_SOL_DATAFECHAMENTO ===null  )
                texto = texto +
                    '  <a title="Fechar essa solicitação"'+
                    '       href="javascript:encerrarSolicitacao('+full.IMB_SOL_ID+')"> '+
                    '       <i class="fa fa-check-square-o" style="font-size:24px;color:green"></i>'+
                    '  </a> '
            else
                texto = texto +
                '  <a title="Reabrir essa solicitação"'+
                '       href="javascript:reabrirSolicitacao('+full.IMB_SOL_ID+')"> '+
                '       <i class="far fa-clone" style="font-size:24px;color:green"></i>'+
                '  </a> ';

            texto = texto +
                    '</div> '+
                    '</div></p> '+
                    '</div>';


        //final de linha
        var texto = texto +
                    '</div>';



        return texto;
    }

    function formatarValor( data, type, full, meta)
    {
        var classe="";
        if( full.FIN_APD_DATAPAGAMENTO != null )
            var classe="font-blue";

        if( data !='' && data != null )
        {
            var valor = parseFloat( data );
            return '<div class="div-right '+classe+'">'+formatarBRSemSimbolo(valor)+'</div>';
        };

        var str = full.FIN_APD_DATAVENCIMENTO;
        var date = new Date(str);
        var novaData = new Date();
        if(date < novaData && full.FIN_APD_DATAPAGAMENTO === null )
           classe="font-red-bold";

        if( full.FIN_APD_DTHINATIVADO != null )
            classe="inativado";

        return '<div class="div-center '+classe+'">-</div>';

    }

    function alterarSolicitacao( id )
    {

        var url = "{{ route('solicitacoes.find') }}/"+id;

        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                success:function(data)
                {
                    console.log( data);
                    $("#IMB_SOL_ID").val(data.IMB_SOL_ID);
                    $("#IMB_SOL_TIPOSOLICITANTE").val(data.IMB_SOL_TIPOSOLICITANTE);
                    $("#IMB_SOL_TITULO-SOL").val(data.IMB_SOL_TITULO);
                    $("#IMB_SOL_DTHATIVO-ALT").val( data.IMB_SOL_DTHATIVO);
                    $("#IMB_SOL_DATAPREVISAO-ALT").val(data.IMB_SOL_DATAPREVISAO);
                    $("#IMB_TPS_ID-ALT").val(data.IMB_TPS_ID);
                    $("#IMB_ATD_IDDESTINO-ALT").val(data.IMB_ATD_IDDESTINO);
                    $("#IMB_SOL_OBSERVACAO-alt").val(data.IMB_SOL_OBSERVACAO);
                    $("#IMB_SOL_PRIORIDADE-ALT").val(data.IMB_SOL_PRIORIDADE);
                    $("#IMB_ATD_IDNOTIFEXTRA-ALT").val(data.IMB_ATD_IDNOTIFEXTRA);                    
                    $("#IMB_CLT_NOME-SOL").val(data.NOMECLIENTE);
                    $("#IMB_CLT_IDLOCADOR-SOL").val(data.IMB_CLT_IDLOCADOR);
                    $("#IMB_CLT_IDLOCATARIO-SOL").val(data.IMB_CLT_IDLOCATARIO);
                    $("#IMB_CLT_IDFIADOR-SOL").val(data.IMB_CLT_IDFIADOR);
                    $("#enderecoimovel-SOL").val(data.ENDERECOIMOVEL);
                    $("#IMB_IMV_ID-LOCIMV").val(data.IMB_CLT_IDIMOVEL);
                    $("#IMB_CTR_ID-LOCIMV").val(data.IMB_CTR_ID);

                    $("#IMB_CTR_REFERENCIA-SOL").val(data.IMB_CTR_REFERENCIA);
                    $("#IMB_SOL_DATAFECHAMENTO-ALT").html( '');
                    $("#i-reabrir").hide();
                    if( data.IMB_SOL_DATAFECHAMENTO != null)
                    {
                        $("#IMB_SOL_DATAFECHAMENTO-ALT").html( 'Fechada em: '+moment(data.IMB_SOL_DATAFECHAMENTO).format( 'DD/MM/YYYY'));
                        $("#i-reabrir").show();
                    }

                    $('#modalsolicitacao').modal({backdrop:'static',keyboard:false, show:true});
                }
            }
        );


    }

    function incluirSolicitacao()
    {
        $("#IMB_SOL_ID").val('');
        $("#IMB_SOL_TIPOSOLICITANTE").val('');
        $("#IMB_SOL_TITULO-SOL").val('');
        $("#IMB_CLT_NOME-SOL").val('');
        $("#enderecoimovel-SOL").val('');
        $("#IMB_SOL_DTHATIVO-ALT").val( moment().format('YYYY-MM-DD'));
        $("#IMB_SOL_DATAPREVISAO-ALT").val('');
        $("#IMB_TPS_ID-ALT").val('');
        $("#IMB_ATD_IDDESTINO-ALT").val('');
        $("#IMB_SOL_OBSERVACAO-alt").val('');
        $("#IMB_CTR_REFERENCIA-SOL").val('');
      
        $('#modalsolicitacao').modal({backdrop:'static',keyboard:false, show:true});

    }


        


     </script>
@endpush
