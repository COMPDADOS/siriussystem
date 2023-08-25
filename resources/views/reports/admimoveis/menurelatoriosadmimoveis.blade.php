@extends('layout.app')

@section('scripttop')
@endsection
@section('content')

<div class="portlet box blue-dark">
    <div class="row">
        <div class="col-md-1">
        </div>
    </div>

    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Relatórios Imóveis
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"></a>
        </div>
    </div>

    <div class="portlet-body form">
        <div class="row">
            <div class="col-md-12">
                <div><hr></div>
                <div class="col-md-2 div-center">
                    <a href="{{ route('rel.imovel.geral') }}">
                        <i class="fa fa-print" style="font-size:30px;color:blue">
                        </i>
                        <p>Geral de Imóveis</p>
                    </a>
                </div>
                <div class="col-md-2 div-center">
                    <a href="{{ route('rel.imovel.proprietarios') }}">
                        <i class="fa fa-print" style="font-size:30px;color:blue">
                        </i>
                        <p>Imóveis x Proprietários</p>
                    </a>
                </div>
                <div class="col-md-2 div-center">
                    <a href="{{ route('avisodesocupacao') }}">
                        <i class="fa fa-print" style="font-size:30px;color:blue">
                        </i>
                        <p>Imóveis Com Aviso Desocupação</p>
                    </a>
                </div>
                <div class="col-md-2 div-center">
                    <a href="{{route('imoveisinscricoes')}}">
                        <i class="fa fa-print" style="font-size:30px;color:blue">
                        </i>
                        <p>Imóveis / Inscrições</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="portlet box blue-dark">
    <div class="row">
        <div class="col-md-1">
        </div>
    </div>

    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Relatórios Contratos
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"></a>
        </div>
    </div>

    <div class="portlet-body form">
        <div class="row">
            <div class="col-md-12">
                <div><hr></div>
                <div class="col-md-2 div-center">
                    <a href="{{route('renovar.index')}}">
                        <i class="fa fa-print" style="font-size:30px;color:blue">
                        </i>
                        <p>Vencimento de Contratos</p>
                    </a>
                </div>
                <div class="col-md-2 div-center">
                    <a href="{{route('reajustar.index')}}">
                        <i class="fa fa-print" style="font-size:30px;color:blue">
                        </i>
                        <p>Reajustes de Contratos</p>
                    </a>
                </div>
                <div class="col-md-2 div-center">
                    <a href="{{ route('reajustados.index') }}">
                        <i class="fa fa-print" style="font-size:30px;color:blue">
                        </i>
                        <p>Reajustes Realizados</p>
                    </a>
                </div>
                <div class="col-md-2 div-center">
                    <a href="{{route('rellocrealizadas')}}">
                        <i class="fa fa-print" style="font-size:30px;color:blue">
                        </i>
                        <p>Locações Realizadas</p>
                    </a>
                </div>
                <div class="col-md-2 div-center">
                    <a href="">
                        <i class="fa fa-print" style="font-size:30px;color:blue">
                        </i>
                        <p>Locações Realizadas(2)</p>
                    </a>
                </div>
                <div class="col-md-2 div-center">
                    <a href="{{ route('relresrealizadas') }}">
                        <i class="fa fa-print" style="font-size:30px;color:blue">
                        </i>
                        <p>Rescisões Realizadas</p>
                    </a>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-2 div-center">
                    <a href="{{route('rellancamentos')}}">
                        <i class="fa fa-print" style="font-size:30px;color:blue">
                        </i>
                        <p>Lançamentos</p>
                    </a>
                </div>
                <div class="col-md-2 div-center">
                    <a href="{{route('contrato.relatoriogeral.tela')}}">
                        <i class="fa fa-print" style="font-size:30px;color:blue">
                        </i>
                        <p>Geral de Contratos</p>
                    </a>
                </div>
                <div class="col-md-2 div-center">
                    <a href="">
                        <i class="fa fa-print" style="font-size:30px;color:blue">
                        </i>
                        <p>Contratos e Seus Envolvidos</p>
                    </a>
                </div>
                <div class="col-md-2 div-center">
                    <a href="{{route('acordos.index')}}">
                        <i class="fa fa-print" style="font-size:30px;color:blue">
                        </i>
                        <p>Acordos Realizados</p>
                    </a>
                </div>
                <div class="col-md-2 div-center">
                    <a href="{{ route('caucao.index') }}">
                        <i class="fa fa-print" style="font-size:30px;color:blue">
                        </i>
                        <p>Com Caução</p>
                    </a>
                </div>
                <div class="col-md-2 div-center">
                    <a href="{{ route('seguroincendio.index') }}">
                        <i class="fa fa-print" style="font-size:30px;color:blue">
                        </i>
                        <p>Seguros</p>
                    </a>
                </div>
                
                <div class="col-md-2 div-center">
                    <a href="{{ route('segurofianca.contratosmarcados') }}">
                        <i class="fa fa-print" style="font-size:30px;color:blue">
                        </i>
                        <p>Contatos Seguro Fiança</p>
                    </a>
                </div>
                


            </div>

        </div>
    </div>
</div>

<div class="portlet box green">
    <div class="row">
        <div class="col-md-1">
        </div>
    </div>

    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Relatórios Financeiros
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"></a>
        </div>
    </div>

    <div class="portlet-body form">
        <div class="row">
            <div class="col-md-12">
                <div><hr></div>

                <div class="col-md-2 div-center">
                    <a href="{{route('relatorioprevisaorepasse')}}">
                        <i class="fa fa-print" style="font-size:30px;color:blue">
                        </i>
                        <p>Previsão de Repasses</p>
                    </a>
                </div>
                <div class="col-md-2 div-center">
                    <a href="{{ route('planilharecebimento.index') }}">
                        <i class="fa fa-print" style="font-size:30px;color:blue">
                        </i>
                        <p>Aluguéres Recebidos/Panilha Recto.</p>
                    </a>
                </div>
                <div class="col-md-2 div-center">
                    <a href="{{ route('planilharepasse.index') }}">
                        <i class="fa fa-print" style="font-size:30px;color:blue">
                        </i>
                        <p>Aluguéres Repassados</p>
                    </a>
                </div>
                <div class="col-md-2 div-center">
                    <a href="{{ route('recebimento.previsao') }}">
                        <i class="fa fa-print" style="font-size:30px;color:blue">
                        </i>
                        <p>Previsão Recebimento</p>
                    </a>
                </div>
                <div class="col-md-12">
                    <div class="col-md-2 div-center">
                        <a href="{{route('caixa.analiticosubconta')}}">
                        <i class="fa fa-print" style="font-size:30px;color:blue">
                        </i>
                        <p>Relatório de Despesas</p>
                        </a>
                    </div>
                    <div class="col-md-2 div-center">
                        <a href="{{route('taxasrecebidas.index')}}">
                        <i class="fa fa-print" style="font-size:30px;color:blue">
                        </i>
                        <p>Taxas Recebidas</p>
                        </a>
                    </div>
                    <div class="col-md-2 div-center">
                        <a href="{{route('movimentacaoevento')}}">
                        <i class="fa fa-print" style="font-size:30px;color:blue">
                        </i>
                        <p>Movimentação Por Evento</p>
                        </a>
                    </div>
                    <div class="col-md-2 div-center">
                        <a href="{{route('planilhadepositos.index')}}">
                        <i class="fa fa-print" style="font-size:30px;color:blue">
                        </i>
                        <p>Planilha de Depósito</p>
                        </a>
                    </div>
                    <div class="col-md-2 div-center">
                        <a href="{{route('previsaotaxaadm')}}">
                        <i class="fa fa-print" style="font-size:30px;color:blue">
                        </i>
                        <p>Previsão de Taxa Adm.</p>
                        </a>
                    </div>
                    @php
                        $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'PlanilhaRecebimentos', 'Planilha Recebimento', 'ADM', 'Recebimentos','S', 'X', 'Botão');
                    @endphp
                </div>
            </div>

        </div>
    </div>
</div>

<div class="portlet box red">
    <div class="row">
        <div class="col-md-1">
        </div>
    </div>

    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Clientes
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"></a>
        </div>
    </div>

    <div class="portlet-body form">
        <div class="row">
            <div class="col-md-12">
                <div><hr></div>

            <div class="col-md-2 div-center">
                    <a href="{{route('recibolocador.demonstrativosindex')}}">
                        <i class="fa fa-print" style="font-size:30px;color:blue">
                        </i>
                        <p>Extrato de Repasse</p>
                    </a>
                </div>
                <div class="col-md-2 div-center">
                    <a href="">
                        <i class="fa fa-print" style="font-size:30px;color:blue">
                        </i>
                        <p>Informe de IRRF</p>
                    </a>
                </div>
                <div class="col-md-2 div-center">
                    <a href="{{route('cliente.relemailtelefone')}}">
                        <i class="fa fa-print" style="font-size:30px;color:blue">
                        </i>
                        <p>Email/Telefones de Clientes</p>
                    </a>
                </div>
                <div class="col-md-2 div-center">
                    <a href="">
                        <i class="fa fa-print" style="font-size:30px;color:blue">
                        </i>
                        <p>Curva ABC de Locadores</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="quick-nav-overlay"></div>


@endsection
@push('script')
    <script>



     </script>
@endpush
