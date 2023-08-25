@extends("layout.app")
@section('scripttop')
<style>

.div-center
{
    align:center;
}

.font-14-red
{
    font-size:14px;
    color:red;
    font family: verdana, arial, helvetica;
    font-weight: bold;

}

.font-14-blue
{
    font-size:14px;
    color:blue;
    font family: verdana, arial, helvetica;
    font-weight: bold;

}


</style>
@endsection

@section('content')
<!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
                <!-- BEGIN CONTENT BODY -->
                    <!-- BEGIN THEME PANEL -->
                    
                    <!-- END THEME PANEL -->
                    
                    <!-- END PAGE HEADER-->
                    <!-- BEGIN : LISTS -->
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="portlet light portlet-fit ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-layers font-green"></i>
                                        <span class="caption-subject font-green bold uppercase">Sobre os Atendimentos</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="mt-element-list">
                                        <div class="mt-list-container list-todo" id="accordion1" role="tablist" aria-multiselectable="true">
                                            <div class="list-todo-line"></div>
                                            <ul>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-item blue">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#accordion1" onclick=" " href="#task-0" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title bold">Meus Atendimentos</div>
                                                                <div class="badge badge-default pull-right bold" id="i-meus-atendimentos"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse  collapse in" id="task-0">
                                                            <ul>
                                                                <li class="task-list-item done">
                                                                    <div class="task-icon">
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-database"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div >
                                                                    </div>
                                                                    <div class="task-content">
                                                                        <h4 class="uppercase bold font-14-blue">
                                                                            <a href="javascript:meusAtendimentoFinalizados();">Finalizados 
                                                                                <h4 class="font-14-blue" id="i-totalMeusAtendimentosFinalizados"></h4>
                                                                            </a>
                                                                        </h4>
                                                                        <p ></p>
                                                                    </div>
                                                                </li>
                                                                <li class="task-list-item">
                                                                    <div class="task-icon">
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-pencil"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="task-content">
                                                                        <h4 class="uppercase bold font-14-red">
                                                                            <a href="javascript:meusAtendimentoAbeto();">Abertos
                                                                            <h4 class="font-14-red" id="i-totalMeusAtendimentosEmAberto"></h4>
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                </li>
                                                                <li class="task-list-item">
                                                                    <div class="task-icon">
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-table"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="task-content">
                                                                        <h4 class="uppercase bold">
                                                                            <a href="javascript:meusAtendimentos()">Últimos Atendimentos</a>
                                                                        </h4>
                                                                        <p> </p>
                                                                    </div>
                                                                </li>
                                                                <li class="task-list-item">
                                                                    <div class="task-icon">
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-pencil"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="task-content">
                                                                        <h4 class="uppercase bold font-14-red">
                                                                            <a href="javascript:meusAtendimentoAP();">Alta Prioridade
                                                                                <h4 class="font-14-red" id="i-totalmeusatendimentosaltaprioridade"></h4>
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                            <div class="task-footer bg-grey">
                                                                <div class="row">
                                                                    <div class="col-xs-6">
                                                                        <a class="task-trash" href="javascript:;">
                                                                        </a>
                                                                    </div>
                                                                    <div class="col-xs-6">
                                                                        <a class="task-add" href="javascript:;">
                                                                            <i class="fa fa-plus"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-item green">
                                                        <a class="list-toggle-container" data-toggle="collapse" data-parent="#accordion1" onclick=" " href="#task-1" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title bold">Demais Corretores</div>
                                                                <div class="badge badge-default pull-right bold" id="i-outros-atendimentos"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse" id="task-1">
                                                            <ul>
                                                                <li class="task-list-item done">
                                                                    <div class="task-icon">
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-database"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div >
                                                                    </div>
                                                                    <div class="task-content">
                                                                        <h4 class="uppercase bold font-14-blue">
                                                                            <a href="javascript:;">Finalizados 
                                                                                <h4 class="font-14-blue" id="i-totalatendimentosfinalizadosdemaiscorretores"></h4>
                                                                            </a>
                                                                        </h4>
                                                                        <p ></p>
                                                                    </div>
                                                                </li>
                                                                <li class="task-list-item">
                                                                    <div class="task-icon">
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-pencil"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="task-content">
                                                                        <h4 class="uppercase bold font-14-red">
                                                                            <a href="javascript:;">Abertos
                                                                            <h4 class="font-14-red" id="i-totalatendimentosemabertodemaiscorretores"></h4>
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                </li>
                                                                <li class="task-list-item">
                                                                    <div class="task-icon">
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-table"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="task-content">
                                                                        <h4 class="uppercase bold">
                                                                            <a href="javascript:atendimentosDemais();">Últimos Atendimentos</a>
                                                                        </h4>
                                                                        <p> </p>
                                                                    </div>
                                                                </li>
                                                                <li class="task-list-item">
                                                                    <div class="task-icon">
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-pencil"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="task-content">
                                                                        <h4 class="uppercase bold font-14-red">
                                                                            <a href="javascript:;">Alta Prioridade
                                                                                <h4 class="font-14-red" id="i-totalatendimentosaltaprioridadedemaiscor"></h4>
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                            <div class="task-footer bg-grey">
                                                                <div class="row">
                                                                    <div class="col-xs-6">
                                                                        <a class="task-trash" href="javascript:;">
                                                                        </a>
                                                                    </div>
                                                                    <div class="col-xs-6">
                                                                        <a class="task-add" href="javascript:;">
                                                                            <i class="fa fa-plus"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </li>                                                
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="portlet light portlet-fit ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-layers font-green"></i>
                                        <span class="caption-subject font-green bold uppercase">Sobre Nossos Clientes</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="mt-element-list">
                                        <div class="mt-list-container list-todo">
                                            <div class="list-todo-line"></div>
                                            <ul>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-item blue">
                                                        <a class="list-toggle-container font-white" data-toggle="collapse" href="#task-1-1" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title bold">Meus Clientes</div>
                                                                <div class="badge badge-default pull-right bold" id="i-totalmeusclientes"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse in" id="task-1-1">
                                                            <ul>
                                                                <li class="task-list-item done">
                                                                    <div class="task-icon">
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-database"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="task-content">
                                                                        <h4 class="uppercase bold font-14-red">
                                                                            <a href="javascript:;">Interessados
                                                                                <h4 class="font-14-red" id="i-meusinteressados"></h4>
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                </li>
                                                                <li class="task-list-item">
                                                                    <div class="task-icon">
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-table"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="task-content">
                                                                        <h4 class="uppercase bold">
                                                                            <a href="javascript:;">Proprietários
                                                                                <h4 class="font-14-red" id="i-meusproprietarios"></h4>
                                                                            </a>
                                                                        </h4>
                                                                        <p></p>
                                                                    </div>
                                                                </li>
                                                                <li class="task-list-item">
                                                                    <div class="task-icon">
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-pencil"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="task-status">
                                                                        <a class="done" href="javascript:;">
                                                                            <i class="fa fa-check"></i>
                                                                        </a>
                                                                        <a class="pending" href="javascript:;">
                                                                            <i class="fa fa-close"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="task-content">
                                                                        <h4 class="uppercase bold">
                                                                            <a href="javascript:;">Desatualizados há mais de 60 dias</a>
                                                                        </h4>
                                                                        <p> </p>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                            <div class="task-footer bg-grey">
                                                                <div class="row">
                                                                    <div class="col-xs-6">
                                                                        <a class="task-add" href="javascript:;">
                                                                            <i class="fa fa-plus"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-item blue">
                                                        <a class="list-toggle-container font-white" data-toggle="collapse" href="#task-2-1" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title bold">Dos demais</div>
                                                                <div class="badge badge-default pull-right bold" id="i-totalmeusclientes"></div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse" id="task-2-1">
                                                            <ul>
                                                                <li class="task-list-item done">
                                                                    <div class="task-icon">
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-database"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="task-content">
                                                                        <h4 class="uppercase bold font-14-red">
                                                                            <a href="javascript:;">Interessados
                                                                                <h4 class="font-14-red" id="i-interessadosdemaiscorretores"></h4>
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                </li>
                                                                <li class="task-list-item">
                                                                    <div class="task-icon">
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-table"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="task-content">
                                                                        <h4 class="uppercase bold">
                                                                            <a href="javascript:;">Proprietários
                                                                                <h4 class="font-14-red" id="i-proprietariosdemaiscorretores"></h4>
                                                                            </a>
                                                                        </h4>
                                                                        <p></p>
                                                                    </div>
                                                                </li>
                                                                <li class="task-list-item">
                                                                    <div class="task-icon">
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-pencil"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="task-status">
                                                                        <a class="done" href="javascript:;">
                                                                            <i class="fa fa-check"></i>
                                                                        </a>
                                                                        <a class="pending" href="javascript:;">
                                                                            <i class="fa fa-close"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="task-content">
                                                                        <h4 class="uppercase bold">
                                                                            <a href="javascript:;">Desatualizados há mais de 60 dias</a>
                                                                        </h4>
                                                                        <p> </p>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                            <div class="task-footer bg-grey">
                                                                <div class="row">
                                                                    <div class="col-xs-6">
                                                                        <a class="task-add" href="javascript:;">
                                                                            <i class="fa fa-plus"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mt-list-item">
                                                        <div class="list-todo-item yellow">
                                                        <a class="list-toggle-container font-white" data-toggle="collapse" href="#task-3-1" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title bold">Leads</div>
                                                                <div class="badge badge-default pull-right bold">2</div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse" id="task-3-1">
                                                            <ul>
                                                                <li class="task-list-item done">
                                                                    <div class="task-icon">
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-navicon"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="task-status">
                                                                        <a class="done" href="javascript:;">
                                                                            <i class="fa fa-check"></i>
                                                                        </a>
                                                                        <a class="pending" href="javascript:;">
                                                                            <i class="fa fa-close"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="task-content">
                                                                        <h4 class="uppercase bold">
                                                                            <a href="javascript:;">Aguardando Atendimento do Site</a>
                                                                        </h4>
                                                                        <p>... </p>
                                                                    </div>
                                                                </li>
                                                                <li class="task-list-item">
                                                                    <div class="task-icon">
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-cube"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="task-status">
                                                                        <a class="done" href="javascript:;">
                                                                            <i class="fa fa-check"></i>
                                                                        </a>
                                                                        <a class="pending" href="javascript:;">
                                                                            <i class="fa fa-close"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="task-content">
                                                                        <h4 class="uppercase bold">
                                                                            <a href="javascript:;">Aguardando atendimento via Email</a>
                                                                        </h4>
                                                                        <p>... </p>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="portlet light portlet-fit ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-layers font-green"></i>
                                        <span class="caption-subject font-green bold uppercase">Sobre Nossos Imóveis</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="mt-element-list">
                                        <div class="mt-list-container list-todo">
                                            <div class="list-todo-line"></div>
                                            <ul>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-item blue-steel">
                                                        <a class="list-toggle-container font-white" data-toggle="collapse" href="#task-1-2" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title bold">Total</div>
                                                                <div class="badge badge-default pull-right bold" id="i-imoveistotal"></div>

                                                                
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse  collapse in" id="task-1-2">
                                                            <ul>
                                                                <li class="task-list-item done">
                                                                    <div class="task-icon">
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-database"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="task-content">
                                                                    <h4 class="uppercase bold">
                                                                            <a href="javascript:;">Imóveis Ativos
                                                                                <h4 class="uppercase bold" id="i-totalativos"></h4>
                                                                            </a>
                                                                        </h4>
                                                                        <p> </p>
                                                                    </div>
                                                                </li>
                                                                <li class="task-list-item done">
                                                                    <div class="task-icon">
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-database"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="task-content">
                                                                    <h4 class="uppercase bold">
                                                                            <a href="javascript:;">Novos Cadastros
                                                                                <h4 class="uppercase bold" id="i-totalnovosimoveis"></h4>
                                                                            </a>
                                                                        </h4>
                                                                        <p> </p>
                                                                    </div>
                                                                </li>
                                                                <li class="task-list-item">
                                                                    <div class="task-icon">
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-table"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="task-content">
                                                                        <h4 class="uppercase bold">
                                                                            <a href="javascript:;">Destaques
                                                                            <h4 class="uppercase bold" id="i-totalimoveisdestaque"></h4>
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                </li>
                                                                <li class="task-list-item">
                                                                    <div class="task-icon">
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-pencil"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="task-content">
                                                                        <h4 class="uppercase bold">
                                                                            <a href="javascript:;">Desatualizados há mais de 60 dias</a>
                                                                        </h4>
                                                                        <p> </p>
                                                                    </div>
                                                                </li>
                                                                <li class="task-list-item">
                                                                    <div class="task-icon">
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-pencil"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="task-content">
                                                                        <h4 class="uppercase bold">
                                                                            <a href="javascript:;">Fora do Site
                                                                               <h4 id="i-meusativosforadosite" class="uppercase bold"></h4>
                                                                            </a>
                                                                        </h4>
                                                                        <p> </p>
                                                                    </div>
                                                                </li>                                                                
                                                            </ul>
                                                            <div class="task-footer bg-grey">
                                                                <div class="row">
                                                                    <div class="col-xs-6">
                                                                    </div>
                                                                    <div class="col-xs-6">
                                                                        <a class="task-add" href="javascript:;">
                                                                            <i class="fa fa-plus"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mt-list-item">
                                                    <div class="list-todo-item green-meadow">
                                                        <a class="list-toggle-container font-white" data-toggle="collapse" href="#task-2-2" aria-expanded="false">
                                                            <div class="list-toggle done uppercase">
                                                                <div class="list-toggle-title bold">De Outros Corretores</div>
                                                                <div class="badge badge-default pull-right bold">3</div>
                                                            </div>
                                                        </a>
                                                        <div class="task-list panel-collapse collapse" id="task-2-2">
                                                            <ul>
                                                                <li class="task-list-item done">
                                                                    <div class="task-icon">
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-file-image-o"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="task-status">
                                                                        <a class="done" href="javascript:;">
                                                                            <i class="fa fa-check"></i>
                                                                        </a>
                                                                        <a class="pending" href="javascript:;">
                                                                            <i class="fa fa-close"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="task-content">
                                                                        <h4 class="uppercase bold">
                                                                            <a href="javascript:;">Novos Imóveis</a>
                                                                        </h4>
                                                                        <p>.... </p>
                                                                    </div>
                                                                </li>
                                                                <li class="task-list-item done">
                                                                    <div class="task-icon">
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-star-half-o"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="task-status">
                                                                        <a class="done" href="javascript:;">
                                                                            <i class="fa fa-check"></i>
                                                                        </a>
                                                                        <a class="pending" href="javascript:;">
                                                                            <i class="fa fa-close"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="task-content">
                                                                        <h4 class="uppercase bold">
                                                                            <a href="javascript:;">Em Destaque</a>
                                                                        </h4>
                                                                        <p>..... </p>
                                                                    </div>
                                                                </li>
                                                                <li class="task-list-item">
                                                                    <div class="task-icon">
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-thumbs-o-up"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="task-status">
                                                                        <a class="done" href="javascript:;">
                                                                            <i class="fa fa-check"></i>
                                                                        </a>
                                                                        <a class="pending" href="javascript:;">
                                                                            <i class="fa fa-close"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="task-content">
                                                                        <h4 class="uppercase bold">
                                                                            <a href="javascript:;">Desatualizados há mais de 60 dias</a>
                                                                        </h4>
                                                                        <p></p>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                            
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    

                    <form style="display: none" action="{{route('atendimento')}}" method="get" id="form-meu-finalizado"  target="_blank">            
                        <input type="hidden" id="i-filtro-atendendimento" name="filtroatendimento" />                
                        <input type="hidden" id="i-atendimento-status" name="atendimentostatus" />                
                    </form>

                    
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
            
            <!-- END QUICK SIDEBAR -->
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        
            <!-- END QUICK NAV -->
            <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<script src="../assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->

@endsection


@push('script')


<script>

$(document).ready(function() 
{
    totalizarMeusAtendimentos();
    totalizarAtendimentosOutros();
    totalMeusAtendimentosEmAberto();    
    totalMeusAtendimentosFinalizados();
    totalMeusAtendimentosAltaPrioridade();
    totalAtendimentosFinalizadosDemaisCorretores();
    totalAtendimentosEmAbertoDemaisCorretores();
    totalAtendimentosAltaPrioridadeDemaisCor();    
    totalMeusClientes();
    meusInteressados();
    meusProprietarios();
    interessadosDemaisCorretores();
    proprietariosDemaisCorretores();
    novosImoveisDash();
    totalImoveisDestaque();
    meusAtivosForadoSite();
    imoveisTotal();
    totalAtivos();    
});

function totalizarMeusAtendimentos()
{
    url = "{{route('atendimento.cliente.totalmeusatendimetos')}}";

    $.ajax( 
        {
            url     : url,
            dataType:'json',
            type:'get',
            success : function( data )
            {

                $("#i-meus-atendimentos").html( data );


            }
        });


}

function totalizarAtendimentosOutros()
{
    url = "{{route('atendimento.cliente.totalatendimetosoutroscorretores')}}";

    $.ajax( 
        {
            url     : url,
            dataType:'json',
            type:'get',
            success : function( data )
            {

                $("#i-outros-atendimentos").html( data );


            }
        });


}

function totalMeusAtendimentosEmAberto()
{
    url = "{{route('atendimento.cliente.totalmeusatendimentosemaberto')}}";

    $.ajax( 
        {
            url     : url,
            dataType:'json',
            type:'get',
            success : function( data )
            {

                $("#i-totalMeusAtendimentosEmAberto").html( data );


            }
        });


}





function totalMeusAtendimentosFinalizados()
{
    url = "{{route('atendimento.cliente.totalmeusantendimentosfinalizados')}}";

    $.ajax( 
        {
            url     : url,
            dataType:'json',
            type:'get',
            success : function( data )
            {

                $("#i-totalMeusAtendimentosFinalizados").html( data );


            }
        });


}


function totalMeusAtendimentosAltaPrioridade()
{
    url = "{{route('atendimento.cliente.totalmeusatendimentosaltaprioridade')}}";

    $.ajax( 
        {
            url     : url,
            dataType:'json',
            type:'get',
            success : function( data )
            {

                $("#i-totalmeusatendimentosaltaprioridade").html( data );


            }
        });


}


function totalAtendimentosFinalizadosDemaisCorretores()
{
    url = "{{route('atendimento.cliente.totalatendimentosfinalizadosdemaiscorretores')}}";

    $.ajax( 
        {
            url     : url,
            dataType:'json',
            type:'get',
            success : function( data )
            {

                $("#i-totalatendimentosfinalizadosdemaiscorretores").html( data );


            }
        });


}

function totalAtendimentosEmAbertoDemaisCorretores()
{
    url = "{{route('atendimentosemabdemaiscor')}}";

    $.ajax( 
        {
            url     : url,
            dataType:'json',
            type:'get',
            success : function( data )
            {

                $("#i-totalatendimentosemabertodemaiscorretores").html( data );


            }
        });


}

function totalAtendimentosAltaPrioridadeDemaisCor()
{
    url = "{{route('totalatendimentosaltaprioridadedemaiscor')}}";

    $.ajax( 
        {
            url     : url,
            dataType:'json',
            type:'get',
            success : function( data )
            {

                $("#i-totalatendimentosaltaprioridadedemaiscor").html( data );


            }
        });


}




function totalMeusClientes()
{
    url = "{{route('totalmeusclientes')}}";

    $.ajax( 
        {
            url     : url,
            dataType:'json',
            type:'get',
            success : function( data )
            {
                $("#i-totalmeusclientes").html( data );
            }
        });


}

function meusProprietarios()
{
    url = "{{route('meusproprietarios')}}";

    $.ajax( 
    {
        url     : url,
        dataType:'json',
        type:'get',
        success : function( data )
        {
            $("#i-meusproprietarios").html( data );
        }
    });


}



function meusInteressados()
{
    url = "{{route('meusinteressados')}}";

    $.ajax( 
    {
        url     : url,
        dataType:'json',
        type:'get',
        success : function( data )
        {
            $("#i-meusinteressados").html( data );
        }
    });


}

function interessadosDemaisCorretores()
{
    url = "{{route('interessadosdemaiscorretores')}}";

    $.ajax( 
    {
        url     : url,
        dataType:'json',
        type:'get',
        success : function( data )
        {
            $("#i-interessadosdemaiscorretores").html( data );
        }
    });


}


function proprietariosDemaisCorretores()
{
    url = "{{route('proprietariosdemaiscorretores')}}";

    $.ajax( 
    {
        url     : url,
        dataType:'json',
        type:'get',
        success : function( data )
        {
            $("#i-proprietariosdemaiscorretores").html( data );
        }
    });


}


function novosImoveisDash()
{

    url = "{{route('novosimoveisatdqtd')}}";

    $.ajax(
    {
        url     : url,
        dataType:'json',
        type:'get',
        async:false,
        success:function(data)
        {
            $("#i-totalnovosimoveis").html( data );
        }
    });

}


function totalImoveisDestaque()
{
    url = "{{route('totalimoveisdestaque')}}";

    $.ajax( 
    {
        url     : url,
        dataType:'json',
        type:'get',
        success : function( data )
        {
            $("#i-totalimoveisdestaque").html( data );
        }
    });


}

function meusAtivosForadoSite()
{
    url = "{{route('meusativosforadosite')}}";

    $.ajax( 
    {
        url     : url,
        dataType:'json',
        type:'get',
        success : function( data )
        {
            $("#i-meusativosforadosite").html( data );
        }
    });
    
}

function meusAtendimentoFinalizados()
{
    
    $("#i-filtro-atendendimento").val('MEU');
    $("#i-atendimento-status").val('Finalizado');
    $("#form-meu-finalizado").submit();
    

}
function meusAtendimentoAbeto()
{
    
    $("#i-filtro-atendendimento").val('MEU');
    $("#i-atendimento-status").val('Aberto');
    $("#form-meu-finalizado").submit();
    

}
function meusAtendimentoAP()
{
    
    $("#i-filtro-atendendimento").val('MEU');
    $("#i-atendimento-status").val('Alta');
    $("#form-meu-finalizado").submit();
    

}
function meusAtendimentos()
{
    
    $("#i-filtro-atendendimento").val('MEU');
    $("#form-meu-finalizado").submit();
    

}
function atendimentosDemais()
{
    
    $("#i-filtro-atendendimento").val('DEMAIS');
    $("#form-meu-finalizado").submit();
    

}
function imoveisTotal()
{
    
    url = "{{route('imoveistotal')}}";

    $.ajax( 
    {
        url     : url,
        dataType:'json',
        type:'get',
            success : function( data )
        {
            $("#i-imoveistotal").html( data );
        }
    });


}

function totalAtivos()
{
    
    url = "{{route('dashboard.comercial.imoveisativos')}}";

    $.ajax( 
    {
        url     : url,
        dataType:'json',
        type:'get',
            success : function( data )
        {
            $("#i-totalativos").html( data );
        }
    });


}



</script>



@endpush