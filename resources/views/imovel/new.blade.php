@extends('layout.app')

@push('script')
@endpush
@section('scripttop')
<link href="{{asset('/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

<style>
.footer {
  position: fixed;
  bottom: 0;
  width: 85%;
  height: 50px;
  background:#e0ebeb;
}
    .valores
    {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
    }

    .valores-direita
    {
        text-align: right;
        font-size: 20px;
        font-weight: bold;
    }


    .center
    {
        text-align: center;
    }

    .cardtitulo {
  text-align: left;
  font-size: 16px;
  color: #FFFFFF;
  font-weight: bold;
  background: #FF0606;

}

.lay-col-1{
  display: block;
  height: 60px;
  line-height: 60px;
  background: #dfdfdf; /* Não necessário */
  text-align: center; /* Não necessário */
}
.div-center
    {
        text-align:center;
    }
    .img-album
        {
            width: 100%;
            height: 300px;
            border-radius: 50%;
        }

</style>

@endsection


@section('content')

<div class="portlet light bordered">
    <div class="portlet-body">
<!--        <form action="{{ route('imovel.store') }}" method="post" id="i-form-imovel"onsubmit="onGravar( this ); return false;" >
            @csrf-->
            <div class="tabbable-custom nav-justified">
                <ul class="nav nav-tabs valores nav-justified">
                    <li class="active">
                        <a href="#tab_1_1_1" data-toggle="tab">Geral</a>
                    </li>
                    <li>
                        <a href="#tab_1_1_2" data-toggle="tab">Medidas/Cômodos</a>
                    </li>
                    <li>
                        <a href="#tab_1_1_3" data-toggle="tab">Observações / Chaves</a>
                    </li>
                    <li>
                        <a href="#tab_1_1_4" data-toggle="tab">Imagens</a>
                    </li>
                    <li>
                        <a href="#tab_1_1_5" data-toggle="tab">Condições Comerciais e Corretor/Captador</a>
                    </li>
                    <li>
                        <a href="#tab_1_1_6" data-toggle="tab">Portais</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1_1_1">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                <div class="col-md-2">
                                        <label class="label-control">Internet
                                            <input type="checkbox" id="IMB_IMV_WEBIMOVEL" class="form-control" data-checkbox="icheckbox_flat-blue">
                                        </label>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="label-control">Destaque
                                            <input type="checkbox" id="IMB_IMV_DESTAQUE" class="form-control" data-checkbox="icheckbox_flat-blue">
                                        </label>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="label-control">Super Destaque
                                            <input type="checkbox" id="IMB_IMV_SUPERDESTAQUE" class="form-control" data-checkbox="icheckbox_flat-blue">
                                        </label>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="label-control">Lançto.
                                            <input type="checkbox" id="IMB_IMV_WEBLANCAMENTO"  class="form-control"  data-checkbox="icheckbox_flat-blue">
                                        </label>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="label-control">Exclusivo
                                            <input type="checkbox" id="IMB_IMV_ESCLUSIVO" class="form-control" data-checkbox="icheckbox_flat-blue">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-2">
                                        <label >Sobrado
                                                <input type="checkbox" id="IMB_IMV_SOBRADO" class="form-control" data-checkbox="icheckbox_flat-blue">
                                        </label>
                                    </div>
                                    <div class="col-md-2">
                                        <label >Placa
                                            <input type="checkbox" id="IMB_IMV_PLACA"
                                            class="form-control" data-checkbox="icheckbox_flat-blue">
                                        </label>
                                    </div>
                                    <div class="col-md-3">
                                        <label >Ac. Financ.
                                            <input type="checkbox" id="IMB_IMV_ACEITAFINANC"class="form-control"  data-checkbox="icheckbox_flat-blue">
                                        </label>
                                    </div>
                                    <div class="col-md-2">
                                        <label >Permuta
                                            <input type="checkbox" id="IMB_IMV_PERMUTA"  class="form-control" data-checkbox="icheckbox_flat-blue">
                                        </label>
                                    </div>
                                    <div class="col-md-2">
                                        <label >Escritura
                                            <input type="checkbox" id="IMB_IMV_ESCRIT" class="form-control" data-checkbox="icheckbox_flat-blue">
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="form-body">

                            @include('layout.propimo')

                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>Localização
                                    </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>

                                <div class="portlet-body form">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="form-group">
                                                <label id="label-titulo">Título do Imóvel</label>
                                                <input type="text" id="IMB_IMV_TITULO"  class="form-control input-sm"
                                                style="font-family: Tahoma; font-size: 16px">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <label >&nbsp;</label>
                                            <button class="form-control btn btn-warning" onClick="gerarSugestaoTitulo();">Gerar Título</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Tipo</label>
                                                <select class="form-control" id="IMB_IMV_ENDERECOTIPO">
                                                    <option value="Acesso">Acesso</option>
                                                    <option value="Alameda">Alameda</option>
                                                    <option value="Avenida">Avenida</option>
                                                    <option value="Estrada">Estrada</option>
                                                    <option value="Praça">Praça</option>
                                                    <option value="Rodovia">Rodovia</option>
                                                    <option value="Rua">Rua</option>
                                                    <option value="Travessa">Travessa</option>
                                                    <option value="Viela">Viela</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label id="ilogradouro" >Logradouro</label>
                                                <input type="text" maxlength="40" id="IMB_IMV_ENDERECO"
                                                class="form-control  mr-sm-0 input-sm" style="font-family: Tahoma; font-size: 16px">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Número</label>
                                                <input type="text" maxlength="10"  id="IMB_IMV_ENDERECONUMERO"
                                                class="form-control input-sm" style="font-family: Tahoma; font-size: 16px">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Complemento</label>
                                                <input type="text" maxlength="20"  id="IMB_IMV_ENDERECOCOMPLEMENTO"
                                                class="form-control input-sm" style="font-family: Tahoma; font-size: 16px" >
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Apt.</label>
                                                <input type="text" id="IMB_IMV_NUMAPT" maxlength="5"
                                                class="form-control input-sm" style="font-family: Tahoma; font-size: 16px">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Condomínio</label>
                                                <select class="select2" id="IMB_CND_ID" >
                                                </select>
                                                <span><button class="btn green" onClick="buscarCondominio()">preencher endereço</button></span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nome Prédio</label>
                                                <input type="text" id="IMB_IMV_PREDIO"
                                                class="form-control input-sm" >
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Andar</label>
                                                <input type="text" id="IMB_IMV_ANDAR"
                                                class="form-control input-sm">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                @php
                                                    $bairros = app('App\Http\Controllers\ctrBairro')->carga( '');
                                                @endphp

                                                <label>Bairro&nbsp; &nbsp; &nbsp;</label><span><a href="javascript:cadastrarBairro()"> <b>Cadastrar Bairro</b> </a></span>
                                                <select class="form-control select2" id="CEP_BAI_ID">
                                                    <option value=""></option>
                                                    @foreach( $bairros as $bairro )
                                                    <option value="{{$bairro->CEP_BAI_ID}}">{{$bairro->CEP_BAI_NOME}}( {{$bairro->CEP_CID_NOME}} )</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-grupo">
                                            <div class="col-md-2">
                                                <label>Cep</label>
                                                <div class="input-group">
                                                    <input type="text"id="IMB_IMV_ENDERECOCEP"
                                                    class="form-control input-sm"
                                                    max="99999999"
                                                    placeholder="Somente Nºs" >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Cidade</label>
                                                <input type="text" id="IMB_IMV_CIDADE"
                                                maxlength="40"
                                                class="form-control input-sm" value="BAURU" >
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>UF</label>
                                                <input type="text"
                                                id="IMB_IMV_ESTADO" class="form-control input-sm"
                                                value="SP">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Quadra</label>
                                                <input type="text" id="IMB_IMV_QUADRA" class="form-control input-sm" >
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Lote</label>
                                                <input type="text" id="IMB_IMV_LOTE" class="form-control input-sm" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Pontos de Referência/Imediações</label>
                                                <input type="text" maxlength="80"  id="IMB_IMV_PROXIMIDADE"
                                                class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>Dados Básicos
                                    </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>

                                <div class="portlet-body form">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group" >
                                                <label class="control-label">Unidade</label>
                                                <select class="form-control" id="IMB_IMB_ID2" >
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ">
                                            <div class="form-group">
                                                <label>Tipo de Imóvel</label>
                                                <select class="form-control" id="IMB_TIM_ID">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ">
                                            <div class="form-group">
                                                <label>R$ Venda</label>
                                                    <input type="text"
                                                id="IMB_IMV_VALVEN" class="form-control valor valores-direita"
                                                type="text"
                                                value="0,00">
                                            </div>
                                        </div>

                                        <div class="col-md-3 ">
                                            <div class="form-group">
                                                <label>R$ Locação</label>
                                                <input type="text"
                                                id="IMB_IMV_VALLOC"  class="form-control valor valores-direita"
                                                value="0,00">
                                            </div>
                                        </div>

                                        <input  type="hidden" id="IMB_CLT_ID"  >
                                        <input  type="hidden" id="IMB_CLT_IDORIGINAL">
                                    </div>
                                    <div class="row">

                                        <div class="col-md-2 ">
                                            <label>Status</label>
                                            <select class="form-control" id="VIS_STA_ID">
                                            </select>
                                        </div>
                                        <div class="col-md-2 ">
                                            <label>Finalidade</label>
                                            <select class="form-control" id="IMB_IMV_FINALIDADE">
                                                <option value="">Não Informado</option>
                                                <option value="Residencial">Residencial</option>
                                                <option value="Comercial">Comercial</option>
                                                <option value="Misto">Misto</option>
                                            </select>
                                        </div>


                                        <div class="col-md-2">
                                            <div class="form-group" >
                                                <label>R$ IPTU</label>
                                                <input type="text"
                                                id="IMB_IMV_VALORIPTU"  class="form-control valor"
                                                value="0,00">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group" >
                                                <label>R$ Condomínio</label>
                                                <input type="text"
                                                id="imb_imv_valorcondominio"  class="form-control valor"
                                                value="0,00">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <label class="label-control">Manter no site mesmo que comercializado
                                            <input class="form-control" type="checkbox" id="IMB_IMV_MANTERSITE">
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <!-- Botões -->
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_1_1_2">

                        <div class="row">
                            <div class="col-md-2 lay-col-1">
                                Metragens
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">Medida Terreno</label>
                                            <input type="text" id="IMB_IMV_MEDTER"  class="form-control"
                                            placeholder="ex.: 10x20">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">Área Total(m2)</label>
                                            <input type="text" id="IMB_IMV_ARETOT"  class="form-control" >
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">Área Constr.(m2)</label>
                                            <input type="text" id="IMB_IMV_ARECON"   class="form-control" >
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">Área Útil(m2)</label>
                                            <input type="text" id="IMB_IMV_AREUTI"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">Posição Solar</label>
                                            <select class="form-control" id="IMB_IMV_ORIENTACAOSOLAR">
                                                <option value="0">Não Informado</option>
                                                <option value="L">Leste</option>
                                                <option value="M">Manhã</option>
                                                <option value="N">Norte</option>
                                                <option value="O">Oeste</option>
                                                <option value="S">Sul</option>
                                                <option value="T">Tarde</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">Posição</label>
                                            <select class="form-control" id="IMB_IMV_POSICAO">
                                                <option value="0">Não Informado</option>
                                                <option value="F">Frente</option>
                                                <option value="U">Fundo</option>
                                                <option value="L">Lateral</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 lay-col-1">
                                Infra-estrutura
                            </div>
                            <div class="col-md-10">
                                <div class="row">

                                <div class="col-md-1">
                                        <div class="form-group">
                                            <label>Alarme
                                            <input class="form-control" type="checkbox" id="IMB_IMV_ALARME">
                                            </label>
                                        </div>
                                    </div>


                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>Ar
                                            <input class="form-control" type="checkbox" id="IMB_IMV_ARAPARELHO">
                                            </label>
                                            <span>Condic.</span>
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>Aquecedor
                                            <input class="form-control" type="checkbox" id="IMB_IMV_AGUAQUENTE">
                                            </label>
                                            <span>Solar</span>
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>Lareira
                                            <input class="form-control" type="checkbox" id="IMB_IMV_LAREIRA">
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>Semi
                                            <input class="form-control" type="checkbox" id="IMB_IMV_SEMIMOB">
                                                <span>Mobiliado</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>Interfone
                                            <input class="form-control" type="checkbox" id="IMB_IMV_INTERF">
                                            </label>
                                        </div>
                                    </div>







                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 lay-col-1">
                                Metragens: Rural
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Hectares</label>
                                    <input type="text" id="IMB_IMV_HECTARES"  class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Alqueire Paulista</label>
                                    <input type="text" id="IMB_IMV_ALQPAU"  class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Alqueire Goiano</label>
                                    <input type="text" id="IMB_IMV_ALQGOI"  class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Alqueire Mineiro</label>
                                    <input type="text" id="IMB_IMV_ALQMIN"  class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Alqueire Norte</label>
                                    <input type="text" id="IMB_IMV_ALNOR"  class="form-control">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-2 lay-col-1">
                                Outras Informações
                            </div>
                            <div class="col-md-10">
                                <div class="col-md-3">
                                    <label class="control-label">Topografia</label>
                                    <select class="form-control" id="IMB_IMV_TOPOGR">
                                            <option value="-1">Não Informado</option>
                                            <option value="A">Aclive</option>
                                            <option value="D">Declive</option>
                                            <option value="P">Plano</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="control-label">Ano Construção</label>
                                    <input class="form-control" type="text" id="IMB_IMV_ANOCONSTRUCAO" >
                                </div>
                                <div class="col-md-3">
                                    <label class="control-label">Padrão</label>
                                    <select class="form-control" id="IMB_IMV_PADRAO">
                                            <option value="">Não Informado</option>
                                            <option value="A">Alto</option>
                                            <option value="M">Médio</option>
                                            <option value="B">Baixo</option>
                                    </select>

                                </div>

                            </div>
                        </div>


                        <hr>

                        <div class="row">
                            <div class="col-md-2 lay-col-1">
                                Cômodos
                            </div>
                            <div class="col-md-10">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Dorm.</label>
                                        <input class="form-control" type="number" id="IMB_IMV_DORQUA">

                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">suites</label>
                                        <input class="form-control" type="number" id="IMB_IMV_SUIQUA">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">WC</label>
                                        <input class="form-control" type="number" id="IMB_IMV_WCQUA">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Salas</label>
                                        <input class="form-control" type="number" id="IMB_IMV_SALQUA"
>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <label>Copa
                                        <input class="form-control" type="checkbox" id="IMB_IMV_COPA">
                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <label>Escrit.
                                        <input class="form-control" type="checkbox" id="IMB_IMV_SALESC">
                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <label>Lavabo
                                        <input class="form-control" type="checkbox" id="IMB_IMV_LAVABO">
                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <label>Closet
                                        <input class="form-control" type="checkbox" id="IMB_IMV_SUICLO">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-2 lay-col-1">
                                Armários
                            </div>
                            <div class="col-md-10">

                                <div class="col-md-1">
                                    <label class="label-control">Dorm.
                                        <input class="form-control" type="checkbox" id="IMB_IMV_DORAE">
                                    </label>
                                </div>


                                <div class="col-md-1">
                                    <label class="label-control">Cozinha
                                        <input class="form-control" type="checkbox" id="IMB_IMV_COZAE">
                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <label class="label-control">Corredor
                                        <input class="form-control" type="checkbox" id="IMB_IMV_AECORREDOR">
                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <label class="label-control">Closet
                                        <input class="form-control" type="checkbox" id="IMB_IMV_AECLOSET">
                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <label class="label-control"> Salas
                                        <input class="form-control" type="checkbox" id="IMB_IMV_AESALA">
                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <label class="label-control">Escrit.
                                        <input class="form-control" type="checkbox" id="IMB_IMV_AEESCRITORIO">
                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <label class="label-control">Banheiro
                                        <input class="form-control" type="checkbox" id="IMB_IMV_WCAE">
                                    </label>
                                </div>

                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-2 lay-col-1">
                                Serviço
                            </div>
                            <div class="col-md-10">
                                <div class="col-md-1 center" >
                                    <label class="label-control">Cozinha
                                        <input class="form-control" type="checkbox" id="IMB_IMV_COZINHA">
                                    </label>
                                </div>
                                <div class="col-md-1 center" >
                                    <label class="label-control">A.Serv.
                                        <input class="form-control" type="checkbox" id="IMB_IMV_ARESER">
                                    </label>
                                </div>
                                <div class="col-md-1 center">
                                    <label class="label-control">WC
                                        <input class="form-control" type="checkbox" id="IMB_IMV_EMPWC">
                                        <span> Empreg.</span>
                                    </label>
                                </div>
                                <div class="col-md-1 center">
                                    <label class="label-control">Dorm.
                                        <input class="form-control" type="checkbox" id="IMB_IMV_EMPQUA">
                                        <span> Empreg.</span>
                                    </label>
                                </div>
                                <div class="col-md-1 center">
                                    <label class="label-control">Elevador
                                        <input class="form-control" type="checkbox" id="IMB_IMV_ELEVADORES">
                                    </label>
                                </div>
                                <div class="col-md-2 center">
                                    <label class="label-control">Despensa
                                        <input class="form-control" type="checkbox" id="IMB_IMV_DESPENSA">
                                    </label>
                                </div>
                                <div class="col-md-1 center">
                                    <label class="label-control">Sala
                                        <input class="form-control" type="checkbox" id="IMB_IMV_SALAAMOCO">
                                        <span> Almoço</span>
                                    </label>
                                </div>
                                <div class="col-md-2 center">
                                    <label class="label-control">Depósito
                                        <input class="form-control" type="checkbox" id="imb_imv_deposito">
                                    </label>
                                </div>


                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-2 lay-col-1">
                                Lazer
                            </div>
                            <div class="col-md-10">
                                <div class="col-md-1">
                                    <label class="label-control">Hidro
                                        <input class="form-control" type="checkbox" id="IMB_IMV_SUIHID">
                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <label class="label-control">Sacada
                                        <input class="form-control" type="checkbox" id="imb_imv_varandagourmet">
                                    </label>
                                    <span>Gourmet</span>
                                </div>
                                <div class="col-md-1">
                                    <label class="label-control">Piscina
                                        <input class="form-control" type="checkbox" id="IMB_IMV_PISCIN">
                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <label class="label-control">Churr.
                                        <input class="form-control" type="checkbox" id="IMB_IMV_CHURRA">
                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <label class="label-control">Sauna
                                        <input class="form-control" type="checkbox" id="IMB_IMV_SAUNA">
                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <label class="label-control">Quadra
                                        <input class="form-control" type="checkbox" id="IMB_IMV_QUADRAPOLIESPORTIVA">
                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <label class="label-control">Campo
                                        <input class="form-control" type="checkbox" id="IMB_IMV_CAMFUT">
                                    </label>
                                    <span>Futebol</span>
                                </div>
                                <div class="col-md-1">
                                    <label class="label-control">Salão
                                        <input class="form-control" type="checkbox" id="IMB_IMV_SALFES">
                                    </label>
                                    <span>Festas</span>
                                </div>
                                <div class="col-md-1">
                                    <label class="label-control">Play
                                        <input class="form-control" type="checkbox" id="IMB_IMV_PLAGRO">
                                    </label>
                                    <span>Ground</span>
                                </div>
                                <div class="col-md-1">
                                    <label class="label-control">Home
                                        <input class="form-control" type="checkbox" id="IMB_IMV_HOME">
                                    </label>
                                    <span>Teather</span>
                                </div>
                            </div>
                        </div>


                        <hr>

                        <div class="row">
                            <div class="col-md-2 lay-col-1">
                                Externo
                            </div>
                            <div class="col-md-10">
                                <div class="col-md-1 center">
                                    <label class="label-control">Quintal
                                        <input class="form-control" type="checkbox" id="IMB_IMV_QUINTA">
                                    </label>
                                </div>
                                <div class="col-md-1 center">
                                    <label class="label-control">Varanda
                                        <input class="form-control" type="checkbox" id="IMB_IMV_VARANDA">
                                    </label>
                                </div>
                                <div class="col-md-1 center">
                                    <label class="label-control">Sacada
                                        <input class="form-control" type="checkbox" id="IMB_IMV_SACADA">
                                    </label>
                                </div>
                                <div class="col-md-1 center">
                                    <label class="label-control">Edícula
                                        <input class="form-control" type="checkbox" id="IMB_IMV_EDICUL">
                                    </label>
                                </div>
                                <div class="col-md-1 center">
                                    <label class="label-control">Murado
                                        <input class="form-control" type="checkbox" id="IMB_IMV_MURADO">
                                    </label>
                                </div>
                                <div class="col-md-1 center">
                                    <label class="label-control">Portão
                                        <input class="form-control" type="checkbox" id="IMB_IMV_PORELE">
                                    </label>
                                    <span>Eletrônico</span>
                                </div>

                                <div class="col-md-2 center">
                                    <label class="control-label">Vagas Cobertas</label>
                                    <input type="text" id="IMB_IMV_GARCOB"class="form-control"
                                    onkeypress="return isNumber(event)" onpaste="return false;" >
                                </div>

                                <div class="col-md-2 center">
                                    <label class="control-label">Vagas Descob.</label>
                                    <input type="text" id="IMB_IMV_GARDES"   class="form-control"
                                    onkeypress="return isNumber(event)" onpaste="return false;">
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-2 lay-col-1">
                                Piso
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-1 center">
                                        <label class="label-control">Aquecido
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOAQUECIDO">
                                        </label>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label class="label-control">Ardósia
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOARDOSIA">
                                        </label>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label class="label-control">Bloquete
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOBLOQUETE">
                                        </label>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label class="label-control">Carpete
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOCARPETE">
                                        </label>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label class="label-control">Carp.Acril.
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOCARPETEACRIL">
                                        </label>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label class="label-control">Carp.Mad.
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOCARPETEMADEIRA">
                                        </label>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label class="label-control">Carp.Nylon
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOCARPETENYLON">
                                        </label>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label class="label-control">Cerâmica
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOCERAMICA">
                                        </label>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label class="label-control">Cimento
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOCIMENTO">
                                        </label>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label class="label-control">C/Piso
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOCONTRAPISO">
                                        </label>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label class="label-control">Emborrachado
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOEMBORRACHADO">
                                        </label>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label class="label-control">Porcelanato
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOPORCELANATO">
                                        </label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-1 center">
                                        <label class="label-control">Granito
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOGRANITO">
                                        </label>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label class="label-control">Laminado
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOLAMINADO">
                                        </label>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label class="label-control">Mármore
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOMARMORE">
                                        </label>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label class="label-control">Laminado
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOLAMINADO">
                                        </label>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label class="label-control">Tábua
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOTABUA">
                                        </label>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label class="label-control">Taco
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOTACOMADEIRA">
                                        </label>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label class="label-control">Vinílico
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOVINICULO">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                    </div>

                    <div class="tab-pane" id="tab_1_1_3">
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Local das Chaves
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                </div>
                            </div>

                            <div class="portlet-body form">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-3">
                                            <label class="label-control">Local</label>
                                            <select class="form-control" id="IMB_IMV_CHAVESSITUACAO">
                                                <option value="0">Não Informado</option>
                                                <option value="C">Corretor</option>
                                                <option value="I">Imobiliária</option>
                                                <option value="P">Proprietário</option>
                                                <option value="O">Outro</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                        <label class="label-control">Corretor</label>
                                            <select class="form-control" id="IMB_ATD_IDCHAVE">
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="label-control">Box </label>
                                            <input class="form-control" id="IMB_IMV_CHABOX">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="label-control">Observações sobre as Chaves</label>
                                        <textarea rows="2" id="IMB_IMV_CHAVES" style="min-width: 100%"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Observações do Imóvel(Uso interno)
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                </div>
                            </div>

                            <div class="portlet-body form">
                                <div class="form-body" ></div>
                                <div class="form-actions text-center">
                                    <textarea rows="5" id="IMB_IMV_OBSERV" style="min-width: 100%"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Observações na Internet(no site)
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                </div>
                            </div>

                            <div class="portlet-body form">
                                <div class="form-body" ></div>
                                <div class="form-actions text-center">
                                    <textarea rows="5"id="IMB_IMV_OBSWEB" style="min-width: 100%"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane" id="tab_1_1_4">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="IMB_IMV_LINKVIDEO">Link do Vídeo</label>
                                <input class="form-control" type="text" id="IMB_IMV_LINKVIDEO">
                            </div>
                        </div>
                        <div class="container">
                            <div class="col-md-12">
                                <h3 class="main-title div-center">Imagens Enviadas</h3>
                            </div>
                            <div id="galeria-imovel-inc"></div>
                        </div>
                        <div class="form-actions div-center">
                            <button type="button" id="galeria-imagem-btn" onClick="upLoadImagemDrop()" class="btn btn-primary"><i class="fa fa-camera-retro"></i> Fazer Upload</button>
                            <button title="Após fazer os uploads, click aqui" type="button" id="galeria-update-btn" onClick="CarregarImagensInc()" class="btn btn-success"><i class="fa fa-update"></i> Atualizar</button>
                        </div>
                    </div>



                    <div class="tab-pane" id="tab_1_1_5">

                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Corretor
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                </div>
                            </div>

                            <div class="portlet-body form">
                                <table  id="tbcorimo" class="table table-striped table-bordered table-hover" >
                                    <thead class="thead-dark">
                                        <tr>
                                        <th style="text-align:center"> ID </th>
                                        <th width="70%" style="text-align:center"> Corretor </th>
                                        <th width="10%" style="text-align:center"> Percentual </th>
                                        <th width="20%" style="text-align:center"> Ações </th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-footer" >
                                <a  class="btn btn-sm btn-primary"
                                role="button" onClick="adicionarCorImo()" >
                                Adicionar Corretor </a>
                                <!--data-toggle="modal" data-target="#modalFormaPagamento"-->
                            </div>

                        </div>

                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Captador
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                </div>
                            </div>

                            <div class="portlet-body form">
                                <table  id="tbcapimo" class="table table-striped table-bordered table-hover" >
                                    <thead class="thead-dark">
                                        <th style="text-align:center"> ID </th>
                                        <th width="70%" style="text-align:center"> Captador </th>
                                        <th width="10%" style="text-align:center"> Percentual </th>
                                        <th width="20%" style="text-align:center"> Ações </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-footer" >
                                <a  class="btn btn-sm btn-primary"
                                role="button" onClick="modalCaptadores()" >
                                Adicionar Captador </a>
                                <!--data-toggle="modal" data-target="#modalFormaPagamento"-->
                            </div>

                        </div>
                        <div class="row">
                                <div class="col-md-12">
                                    <label class="label-control">Condições Comerciais</label>
                                    <textarea rows="4" id="IMB_IMV_CONDICOESCOMERCIAIS" style="min-width: 100%"></textarea>
                                </div>
                        </div>

                    </div>
                    <div class="tab-pane" id="tab_1_1_6">
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Portais em que o imóvel está anunciado
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                </div>
                            </div>

                            <div class="portlet-body form">
                                <table  id="tbportalimovel" class="table table-striped table-bordered table-hover" >
                                    <thead class="thead-dark">
                                        <tr>
                                            <th style="text-align:center"> ID </th>
                                            <th style="text-align:center"> Portal </th>
                                            <th width="200" style="text-align:center"> Ações </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-footer" >
                                <a  class="btn btn-sm btn-primary"
                                role="button" onClick="imovelPortalInc()" >
                                    Adicional o Imóvel num Portal </a>
                            </div>
                        </div>
                        <div class="div-center">
                            <label class="label-control">Fazer Parte do Portal www.quadrodechaves.com.br
                                            <input type="checkbox" id="IMB_IMV_PORTALQUADROCHAVES" class="form-control" data-checkbox="icheckbox_flat-blue">
                                        </label>

                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="footer">
                                <div class="form-actions center">
                                    <button type="button" class="btn default botao-confirmacao " id="i-btn-cancelar" onClick="cancelarCadastro()">Cancelar</button>
                                    <button type="button" class="btn blue botao-confirmacao" id="i-btn-gravar-cadastro" onClick="onGravar()">
                                    <i class="fa fa-check"></i> Gravar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
<nav class="quick-nav">
        <a class="quick-nav-trigger" href="#0">
            <span aria-hidden="true"></span>
        </a>
        <ul>
        <li>
                <a href="javascript:onGravar('X');">
                    <span>Salvar Cadastro</span>
                    <i class="fas fa-save"></i>
                </a>
            </li>
            <li>
                <a href="javascript:window.history.back();">
                    <span>Cancelar</span>
                    <i class="fas fa-undo"></i>
                </a>
            </li>
        </ul>
        <span aria-hidden="true" class="quick-nav-bg"></span>
    </nav>
    <div class="quick-nav-overlay"></div>

<!--modal CORIMO -->
<div class="modal" tabindex="-1" role="dialog" id="modalcorimo">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Corretor do Imóvel
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
                </div>
                <form>
                        <input type="hidden" id="i-idcorimo" name="IMB_CORIMO_ID">
                        <input type="hidden" id="i-idimovel" name="IMB_IMV_ID"
                                                value="{{$id}}">
                        <input type="hidden" id="i-idcorretor" >
                        <input type="hidden" id="i-idempresa" name="IMB_IMB_ID"
                                               value="1">
                        <div class="portlet-body form">
                            <div class="form-body" >
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Corretor</label>
                                            <select class="form-control" id="i-select-corretor" name="IMB_ATD_ID">
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Percentual - %</label>
                                            <input type="text" class="form-control valor" id="i-percentual"  >

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-primary" onClick="adicionarTabCorImo()">Adicionar</button>
                        </div>
                    </form>


            </div>
        </div>
    </div>
</div>


<!--modal IMAGENS -->
<div class="modal" tabindex="-1" role="dialog" id="modalimagem">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Imagens do Imóvel - Alteração
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
                </div>
                    <form class="form-horizontal" id="formimagem">
                        <input type="hidden" id="i-idimg">
                        <input type="hidden" id="i-idimovel-img" name="IMB_IMV_ID"
                                                value="{{$id}}">
                        <input type="hidden" id="i-idempresa-img" name="IMB_IMB_ID"
                                               value="1">
                        <div class="portlet-body form">
                            <div class="form-body" >
                            <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nome da Imagem</label>
                                            <input type="text" maxlength="100"
                                            class="form-control" id="i-nomeimagem"
                                            name="IMB_IMG_NOME">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                            <input type="checkbox" name="IMB_IMG_PRINCIPAL"
                                                     class="icheck" data-checkbox="icheckbox_flat-blue"
                                                     id="i-imagemprincipal">
                                                Imagem Principal
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                            <input type="checkbox" name="IMB_IMG_CAPA"
                                                     class="icheck" data-checkbox="icheckbox_flat-blue"
                                                     id="i-imagemcapa">
                                                Mostrar na Capa do Site
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                            <input type="checkbox" name="IMB_IMG_NAOIRPROSITE"
                                                     class="icheck" data-checkbox="icheckbox_flat-blue"
                                                     id="i-imagemnaoirsite">
                                                NÃO Exibir no site
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="cabcel" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                            </div>
                        </div>
                    </form>


            </div>
        </div>
    </div>
</div>



<!--modal CAPIMO -->
<div class="modal" tabindex="-1" role="dialog" id="modalcapimo">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Captador do Imóvel
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
                </div>
                    <form class="form-horizontal" id="formCapImo">
                        <input type="hidden" id="i-idcapimo" name="IMB_CAPIMO_ID">
                        <input type="hidden" id="i-idimovel-cap" name="IMB_IMV_ID"
                                                value="{{$id}}">
                        <input type="hidden" id="i-idempresa-cap" name="IMB_IMB_ID"
                                               value="1">
                        <div class="portlet-body form">
                            <div class="form-body" >
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Captador</label>
                                            <select class="form-control" id="i-select-captador" name="IMB_ATD_ID">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Percentual</label>
                                            <input class="form-control valor" id="IMB_CAPIMO_PERCENTUAL">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-primary" onClick="adicionarTabCapImo()">Adicionar</button>
                        </div>
                    </form>


            </div>
        </div>
    </div>
</div>
<!--modal PORALIMO -->
<div class="modal" tabindex="-1" role="dialog" id="i-portalimovel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Portal de Anúncios
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="IMB_IMP_ID" >
                <div class="portlet-body form">
                    <div class="form-body" >
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Portal</label>
                                    <select class="form-control" id="IMB_POR_ID">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-primary" onClick="incPortalTable()">Gravar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form style="display: none" action="{{route('imovel.edit')}}" method="POST" id="form-alt"  >
@csrf
    <input type="hidden" id="id" name="id" />
    <input type="hidden" id="readonly" name="readonly"/>
</form>

<form style="display: none" action="{{route('imoveis.imagens.dragdrop')}}" method="get" id="form-img"  target="_blank">
    <input type="hidden" id="i-idimovel-imgdrag" name="id"/>
</form>

@include( 'layout.pesquisarclientes')
@include( 'layout.clienterapido')
@include( 'layout.modalCadBairro')

@endsection
@push('script')

<script type="text/javascript">
    $("#i-form-imovel :input").prop("disabled", false);
</script>
<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="{{asset('/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>

<script>


    $(document).ready(function()
    {
      

        $("#sirius-menu").click();

        $("#IMB_IMV_WEBIMOVEL").prop( "checked" ,true);

/*        $("#galeria-imagem-btn").click(function()
        {
            onGravar('MANTER');
        });
*/
        cargaStatus(5);
        preencherCorretoresChave(0);





        $(".select2").select2({
            placeholder: 'Selecione',
            width: null
        });




    });


    $('.valor').inputmask('decimal',
      {
        radixPoint:",",
        groupSeparator: ".",
        autoGroup: true,
        digits: 2,
        digitsOptional: false,
        placeholder: '0',
        rightAlign: false,
        onBeforeMask: function (value, opts)
        {
          return value;
        }
      });

      $('.valor-4').inputmask('decimal',
      {
        radixPoint:",",
        groupSeparator: ".",
        autoGroup: true,
        digits: 4,
        digitsOptional: false,
        placeholder: '0',
        rightAlign: false,
        onBeforeMask: function (value, opts)
        {
          return value;
        }
      });



    $('#IMB_IMV_ENDERECOCEP').on('blur', () =>
    {
        if ($.trim($('#IMB_IMV_ENDERECOCEP').val()) !== '' && $("#IMB_IMV_ENDERECO").val() == '' )
        {
                //console.log('passando');
            const cep = $('#IMB_IMV_ENDERECOCEP').val();
            pesquisacep( cep );
        }
    });


    function selecionarCliente()
    {
        var clienteselecionado = $("#selclientelike").val();
            $("#IMB_CLT_ID").val( clienteselecionado);
            $("#propModal").modal('hide');
            nomeprop = $('#selclientelike').find(":selected").text();
            $("#nomeprop").val( nomeprop );

    }

    function alterarProp()
    {
        var prop = $("#nomeprop").val();
            $("#propModal").modal('show');
            $("#i-str").val( prop );
            buscaIncremental();

    }

/*
    function buscaIncremental()
    {
        str = $("#i-str").val();
        if( isNaN( str) )
        {
            var url = "{{ route('buscaclienteincremental') }}"+"/"+str;
        }
        else
            var url = "{{ route('cliente.localizar.telefone') }}"+"/"+str;


        $.getJSON( url, function( data)
        {
        linha = "";
        $("#selclientelike").empty();
        for( nI=0;nI < data.length;nI++)
        {
            linha =
            '<option value="'+data[nI].IMB_CLT_ID+'">'+
            data[nI].IMB_CLT_NOME+"</option>";
            $("#selclientelike").append( linha );
        }
        });
    }
*/
    function adicionarCorImo()
    {
        $("#i-idcorimo").val('');
        modalCorretor();

    }
    //corretores do imovel

    function adicionarCapImo()
    {
        $("#i-idcapimo").val('');
        modalCaptadores();

    }

    function apagarCorImo( id )
    {

        if (confirm("Tem certeza que deseja excluir?"))
        {

          var textoid = '#corimo'+id;
          $( textoid ).remove();

        }

    }



    function apagarCapImo( id )
    {

        if (confirm("Tem certeza que deseja excluir?"))
        {

          var textoid = '#capimo'+id;
          $( textoid ).remove();

        }

    }




    function preencherCBCorretores( nidcorretor )
    {
        var empresa = $("#I-IMB_IMB_IDMASTER").val();
        var url = "{{ route('atendente.cargaativos')}}";

        $.getJSON( url, function( data )
        {
            linha = "";
            $("#i-select-corretor").empty();
            for( nI=0;nI < data.length;nI++)
            {

                if ( data[nI].IMB_ATD_ID  == nidcorretor )
                {
                    linha =
                        '<option value="'+data[nI].IMB_ATD_ID+'" selected>'+
                        data[nI].IMB_ATD_NOME+"</option>";
                    $("#i-select-corretor").append( linha )
                }
                else
                {
                linha =
                        '<option value="'+data[nI].IMB_ATD_ID+'">'+
                        data[nI].IMB_ATD_NOME+"</option>";
                    $("#i-select-corretor").append( linha );
                }
            }
        });

    }

    function modalCorretor()
    {
        var unidade = $("#IMB_IMB_ID2").val();
        $("#modalcorimo").modal('show');
        $("#i-percentual").val('0');

    }


//INICIO CAPTADORES
function modalCaptadores()
    {
        $("#modalcapimo").modal('show');
        $("#IMB_CAPIMO_TIPO").val('Venda');
        $("#i-percentual-cap").val('0');

        preencherCBCaptadores();
    }



    function preencherCBCaptadores( nidcorretor )
    {
        var empresa = $("#I-IMB_IMB_IDMASTER").val();
        var url = "{{ route('atendente.cargaativos')}}";

    $.getJSON( url, function( data )
        {
            linha = "";
            $("#i-select-captador").empty();
            for( nI=0;nI < data.length;nI++)
            {

                if ( data[nI].IMB_ATD_ID  == nidcorretor )
                {
                    linha =
                        '<option value="'+data[nI].IMB_ATD_ID+'" selected>'+
                        data[nI].IMB_ATD_NOME+"</option>";
                    $("#i-select-captador").append( linha )
                }
                else
                {
                linha =
                        '<option value="'+data[nI].IMB_ATD_ID+'">'+
                        data[nI].IMB_ATD_NOME+"</option>";
                    $("#i-select-captador").append( linha );
                }
            }
        });
    }







        //área de IMAGENS
    function CarregarImagensInc()
    {
        nId = $("#i-idimovel").val();

        $("#galeria-update-btn").hide();        
        var url = "{{ route( 'imagens.imoveis')}}/"+nId;

        var empresa = "{{Auth::user()->IMB_IMB_ID}}";
//        console.log('imagens '+url );
        $.getJSON( url, function( data)
        {
            $( "#galeria-imovel-inc" ).empty();
            contador = 4;
            texto='';
            for( nI=0;nI < data.length;nI++)
            {

                if( data[nI].IMB_IMG_PRINCIPAL !='S')
                    principal = '<a title="Definir essa imagem como a imagem principal" href=javascript:imagemPrincipal('+data[nI].IMB_IMV_ID+','+
                                    data[nI].IMB_IMG_ID+') class="btn btn-sm btn-warning"><i class="fa fa-check-square-o" aria-hidden="true"></i></a> '
                else
                    principal =
                        '<a class="btn btn-sm btn-success">Principal</a> ';
                bloqnet = '';
                if( data[nI].IMB_IMG_NAOIRPROSITE == 'S')
                    bloqnet = '<a title="Não vai pro site"><i class="fa fa-ban" aria-hidden="true"></i><a>';

                texto = '<div class="col-md-3">'+
                        '   <div class="card">'+
                        '       <div class="card-body"> '+
                        '          <h5 class="card-title div-center">'+data[nI].IMB_IMG_NOME+'</h5>' +
                        '       </div> '+
                        '       <img class="img-album" src={{url('')}}/storage/images/'+empresa+'/imoveis/'+data[nI].IMB_IMV_ID+'/'+data[nI].IMB_IMG_ARQUIVO+'>'+
                        '       <a title="Alterar ou complementar informações para esta imagem" href=javascript:editarImagem('+data[nI].IMB_IMG_ID+') class="btn btn-sm btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>'+
                        '       &nbsp;&nbsp;<a title="Excluir a imagem" href=javascript:apagarImagem('+data[nI].IMB_IMG_ID+') class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>'+
                        '      &nbsp;&nbsp;'+principal+
                        '      &nbsp;&nbsp;'+bloqnet+
                        '   </div> '+
                        '</div>';
                $( "#galeria-imovel-inc" ).append( texto );                

            }


        });
    }


    function imagemPrincipal( idimovel, idimagem)
    {
        $.ajaxSetup({
            headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
            });

            var url = "{{ route('imagem.principal') }}"+"/"+idimovel+"/"+idimagem;

        $.ajax(
            {
                type: "post",
                url: url,
                context: this,
                success: function()
                {
                    CarregarImagensInc();
                },
                error: function( error )
                {
                    console.log(error);
                }

        });


    }

    function apagarImagem( id )
    {
        if (confirm("Tem certeza que deseja excluir a Imagem?"))
        {

            $.ajaxSetup({
            headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
            });

            var url = "{{ route('imagem.apagar') }}"+"/"+id;
            $.ajax
            (
                {
                    type: "delete",
                    url: url,
                    context: this,
                    success: function(){
                        CarregarImagensInc();
                    },
                    error: function( error ){
                        console.log(error);
                    }
                }
            );
            }

    }

    function editarImagem( id )
    {

        var url = "{{ route('imagem.editar') }}"+"/"+id;
        $.getJSON( url, function( data)
        {
            $("#i-idimg").val(data.IMB_IMG_ID);
            $("#i-nomeimagem").val(data.IMB_IMG_NOME);
            $("#i-imagemprincipal" ).prop( "checked", (data.IMB_IMG_PRINCIPAL =='S') );
            $("#i-imagemnaoirsite").prop( "checked", (data.IMB_IMG_NAOIRPROSITE =='S') );
            $("#i-imagemcapa").prop( "checked", (data.IMB_IMG_CAPA =='S') );
//            setarSelectCorretor(data.IMB_ATD_ID);
            $("#modalimagem").modal('show');
        });

    }

    $("#formimagem").submit
        ( function( event )
        {
            id = $("#i-idimg").val();
            event.preventDefault();
            //alert($("#i-idcorimo").val());
                   salvarImagem( id );

            CarregarImagensInc();

         });


    function salvarImagem( idimagem )
    {
        $.ajaxSetup({
            headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });
        var url = "{{ route('imagem.salvar') }}"+"/"+idimagem;

        imagem =
        {
            IMB_IMB_ID : 1,
            IMB_IMV_ID : $("#i-idimovel").val(),
            IMB_IMG_NOME: $("#i-nomeimagem").val(),
            IMB_IMG_PRINCIPAL: $( '#i-imagemprincipal' ).prop( "checked" )  ==true ? 'S' : 'N',
            IMB_IMG_NAOIRPROSITE: $( '#i-imagemnaoirsite' ).prop( "checked" )  ==true ? 'S' : 'N',
            IMB_IMG_CAPA: $( '#i-imagemcapa' ).prop( "checked" )  ==true ? 'S' : 'N'
        };

        $.post( url, imagem, function(data)
        {
                $("#modalimagem").modal("hide");
                CarregarImagensInc();
        });


    }

    function preencherUnidades()
    {
        $.getJSON( "{{route('imobiliaria.carga')}}/"+$("#I-IMB_IMB_IDMASTER").val(),
        function( data )
        {
            for( nI=0;nI < data.length;nI++)
            {
                linha =
                    '<option value="'+data[nI].IMB_IMB_ID+'">'+
                        data[nI].IMB_IMB_NOME;
                linha = linha + "</option>";
                        $("#IMB_IMB_ID2").append( linha );
            }
        });


    }

    function preencherTipoImovel()
    {
        var url = "{{ route('tipoimovel.carga')}}";
        $.getJSON( url, function( data )
        {
            $("#IMB_TIM_ID").empty();
            var linha =  '<option value="0">Informe  o tipo de imóvel</option>';
            $("#IMB_TIM_ID").append( linha );
            for( nI=0;nI < data.length;nI++)
            {
                linha =
                    '<option value="'+data[nI].IMB_TIM_ID+'">'+
                        data[nI].IMB_TIM_DESCRICAO;
                linha = linha + "</option>";
                $("#IMB_TIM_ID").append( linha );

            }

        });

    }

    function onGravar( acao )
    {

        debugger;
        if ( ! checarCampos()  )
            return false; 

        if ( ! ( $("#IMB_IMV_WEBIMOVEL").prop( "checked" ) ) )
        {
            if ( ! ( confirm("Este imóvel não está selecionado para ir pro site. Isso mesmo, posso continuar?") ))
            return false;
        }

        var valorvenda = realToDolar( $("#IMB_IMV_VALVEN").val() );
        if( $("#IMB_IMV_VALVEN").val() == '' )
            valorvenda = 0;


            var valorlocacao = realToDolar( $("#IMB_IMV_VALLOC").val() );
        if( $("#IMB_IMV_VALLOC").val() == '' )
            valorvenda = 0;

        var valoriptu = realToDolar( $("#IMB_IMV_VALORIPTU").val() );
        if( $("#IMB_IMV_VALORIPTU").val() == '' )
            valoriptu = 0;

        var valorcondominio = realToDolar( $("#imb_imv_valorcondominio").val() );
        if( $("#imb_imv_valorcondominio").val() == '' )
            valorcondominio = 0;


        var valorinformado =
            valorvenda + valorlocacao;



        $("#btn-gravar-cadastro").hide();

        var web = 'N';
        if ( $("#IMB_IMV_WEBIMOVEL").prop( "checked" ) )
            web = 'S';

            var exclusivo = 'N';
        if ( $("#IMB_IMV_ESCLUSIVO").prop( "checked" ) )
           exclusivo = 'S';

        var destaque = 'N';
        if ( $("#IMB_IMV_DESTAQUE").prop( "checked" ) )
        destaque = 'S';


        var lancamento = 'N';
        if ( $("#IMB_IMV_WEBLANCAMENTO").prop( "checked" ) )
        lancamento = 'S';


        var terrea = 'N';
        if ( $("#IMB_IMV_TERREA").prop( "checked" ) )
        terrea = 'S';

        var sobrado = 'N';
        if ( $("#IMB_IMV_SOBRADO").prop( "checked" ) )
        sobrado = 'S';


        var placa = 'N';
        if ( $("#IMB_IMV_PLACA").prop( "checked" ) )
        placa = 'S';

        var financiamento = 'N';
        if ( $("#IMB_IMV_ACEITAFINANC").prop( "checked" ) )
        financiamento = 'S';

        var permuta = 'N';
        if ( $("#IMB_IMV_PERMUTA").prop( "checked" ) )
        permuta = 'S';

        var dorae = 'N';
        if ( $("#IMB_IMV_DORAE").prop( "checked" ) )
        dorae = 'S';

        var suitehid = 'N';
        if ( $("#IMB_IMV_SUIHID").prop( "checked" ) )
        suitehid = 'S';

        var dorclo = 'N';
        if ( $("#IMB_IMV_DORCLO").prop( "checked" ) )
        dorclo = 'S';

        var cozinha = 'N';
        if ( $("#IMB_IMV_COZINHA").prop( "checked" ) )
        cozinha = 'S';

        var suspenso = 'N';
        if ( $("#IMB_IMV_SUSPENSO").prop( "checked" ) )
        suspenso = 'S';

        cep = $("#IMB_IMV_ENDERECOCEP").val();
        cep = cep.replace('-','');

        var cozpla = $("#IMB_IMV_COZPLA").prop('checked') ? 'S' : 'N';
        var lavabo = $("#IMB_IMV_LAVABO").prop('checked') ? 'S' : 'N';
        var empdor = $("#IMB_IMV_EMPQUA").prop('checked') ? 'S' : 'N';
        var empwc = $("#IMB_IMV_EMPWC").prop('checked') ? 'S' : 'N';
        var despensa = $("#IMB_IMV_DESPENSA").prop('checked') ? 'S' : 'N';
        var piscina = $("#IMB_IMV_PISCIN").prop('checked') ? 'S' : 'N';
        var edicula = $("#IMB_IMV_EDICUL").prop('checked') ? 'S' : 'N';
        var sacada = $("#IMB_IMV_SACADA").prop('checked') ? 'S' : 'N';
        var elevadores = $("#IMB_IMV_ELEVADORES").prop('checked') ? 'S' : 'N';
        var quintal = $("#IMB_IMV_QUINTA").prop('checked') ? 'S' : 'N';
        var churra = $("#IMB_IMV_CHURRA").prop('checked') ? 'S' : 'N';
        var portaoele = $("#IMB_IMV_PORELE").prop('checked') ? 'S' : 'N';
        var terrea= $("#IMB_IMV_TERREA").prop('checked') ? 'S' : 'N';
        var cozpla = $("#IMB_IMV_COZPLA").prop('checked') ? 'S' : 'N';
        var sauna = $("#IMB_IMV_SAUNA").prop('checked') ? 'S' : 'N';
        var quadrapoli = $("#IMB_IMV_QUADRAPOLIESPORTIVA").prop('checked') ? 'S' : 'N';
        var salaofes = $("#IMB_IMV_SALFES").prop('checked') ? 'S' : 'N';
        var plagro = $("#IMB_IMV_PLAGRO").prop('checked') ? 'S' : 'N';
        var escritura = $("#IMB_IMV_ESCRIT").prop('checked') ? 'S' : 'N';
        var dorae = $("#IMB_IMV_DORAE").prop('checked') ? 'S' : 'N';
        var superdestaque = $("#IMB_IMV_SUPERDESTAQUE").prop('checked') ? 'S' : 'N';

        var alarme = $("#IMB_IMV_ALARME").prop('checked') ? 'S' : 'N';
        var arcondicionado = $("#IMB_IMV_ARAPARELHO").prop('checked') ? 'S' : 'N';
        var lareira = $("#IMB_IMV_LAREIRA").prop('checked') ? 'S' : 'N';
        var semimobiliado = $("#IMB_IMV_SEMIMOB").prop('checked') ? 'S' : 'N';
        var interfone = $("#IMB_IMV_INTERF").prop('checked') ? 'S' : 'N';
        var aguaquente = $("#IMB_IMV_AGUAQUENTE").prop('checked') ? 'S' : 'N';
        var portalquadrochaves = $("#IMB_IMV_PORTALQUADROCHAVES").prop('checked') ? 'S' : 'N';


        var imoveis =
        {

            
            IMB_IMV_ID : $("#i-idimovel").val(),
            IMB_IMB_ID : $("#I-IMB_IMB_IDMASTER").val(),
            IMB_IMB_ID2 : $("#IMB_IMB_ID2").val(),
            IMB_CLT_ID : $("#IMB_CLT_ID").val(),
            IMB_IMV_ENDERECO : $("#IMB_IMV_ENDERECO").val(),
            IMB_IMV_ENDERECONUMERO : $("#IMB_IMV_ENDERECONUMERO").val(),
            IMB_IMV_ENDERECOCOMPLEMENTO : $("#IMB_IMV_ENDERECOCOMPLEMENTO").val(),
            IMB_IMV_WEBIMOVEL : web,
            IMB_IMV_DESTAQUE : destaque,
            IMB_IMV_WEBLANCAMENTO : lancamento,
            IMB_IMV_ESCLUSIVO :  exclusivo,
            IMB_IMV_TERREA : terrea,
            IMB_IMV_SOBRADO : sobrado,
            IMB_IMV_PLACA : placa,
            IMB_IMV_ACEITAFINANC : financiamento,
            IMB_IMV_PERMUTA : permuta,
            IMB_IMV_COZPLA : cozpla,
            IMB_IMV_LAVABO : lavabo,
            IMB_IMV_EMPQUA : empdor,
            IMB_IMV_EMPWC : empwc,
            IMB_IMV_DESPENSA : despensa,
            IMB_IMV_PISCIN : piscina,
            IMB_IMV_EDICUL : edicula,
            IMB_IMV_SACADA : sacada,
            IMB_IMV_ELEVADORES : elevadores,
            IMB_IMV_QUINTA :quintal,
            IMB_IMV_CHURRA : churra,
            IMB_IMV_PORELE :portaoele,
            IMB_IMV_SAUNA : sauna,
            IMB_IMV_QUADRAPOLIESPORTIVA :quadrapoli,
            IMB_IMV_SALFES : salaofes,
            IMB_IMV_PLAGRO : plagro,
            IMB_IMV_DATACADASTRO : $("#IMB_IMV_DATACADASTRO").val(),
            IMB_IMV_DATSUS : $("#IMB_IMV_DATSUS").val(),
            IMB_IMV_REFERE : $("#IMB_IMV_REFERE").val(),
            IMB_IMV_ENDERECOTIPO : $("#IMB_IMV_ENDERECOTIPO").val(),
            IMB_IMV_NUMAPT : $("#IMB_IMV_NUMAPT").val(),
            IMB_IMV_PREDIO : $("#IMB_IMV_PREDIO").val(),
            IMB_IMV_ANDAR : $("#IMB_IMV_ANDAR").val(),
            CEP_BAI_NOME : $("#CEP_BAI_NOME").val(),
            CEP_BAI_ID : $("#CEP_BAI_ID").val(),
            IMB_IMV_ENDERECOCEP :cep,
            IMB_IMV_CIDADE : $("#IMB_IMV_CIDADE").val(),
            IMB_IMV_ESTADO : $("#IMB_IMV_ESTADO").val(),
            IMB_IMV_QUADRA : $("#IMB_IMV_QUADRA").val(),
            IMB_IMV_LOTE : $("#IMB_IMV_LOTE").val(),
            IMB_IMV_PROXIMIDADE : $("#IMB_IMV_PROXIMIDADE").val(),
            IMB_IMV_MEDTER : $("#IMB_IMV_MEDTER").val(),
            IMB_IMV_ARETOT : $("#IMB_IMV_ARETOT").val(),
            IMB_IMV_AREUTI : $("#IMB_IMV_AREUTI").val(),
            IMB_IMV_ARECON : $("#IMB_IMV_ARECON").val(),
            IMB_IMV_DORQUA : $("#IMB_IMV_DORQUA").val(),
            IMB_IMV_SUIQUA :  $("#IMB_IMV_SUIQUA").val(),
            IMB_IMV_DORAE : dorae,
            IMB_IMV_SUIHID : suitehid,
            IMB_IMV_DORCLO : dorclo,
            IMB_IMV_COZINHA : cozinha,
            IMB_IMV_GARCOB : $("#IMB_IMV_GARCOB").val(),
            IMB_IMV_GARDES : $("#IMB_IMV_GARDES").val(),
            IMB_IMV_IDADE : $("#IMB_IMV_IDADE").val(),
            IMB_IMV_OBSERV : $("#IMB_IMV_OBSERV").val(),
            IMB_IMV_OBSWEB : $("#IMB_IMV_OBSWEB").val(),
            IMB_TIM_ID : $("#IMB_TIM_ID").val(),
            IMB_IMV_SUSPENSO : suspenso,
            IMB_IMV_ESCRIT : escritura,
            IMB_IMV_SUPERDESTAQUE : superdestaque,
            IMB_IMV_TITULO: $("#IMB_IMV_TITULO").val(),
            IMB_ATD_ID: $("#I-IMB_ATD_ID").val(),
            IMB_IMV_WCQUA : $("#IMB_IMV_WCQUA").val(),
            imb_imv_varandagourmet: $("#I-imb_imv_varandagourmet").val(),
            IMB_IMV_ARESER: simNao( $("#IMB_IMV_ARESER").prop('checked') ),
            IMB_IMV_CHAVES:  $("#IMB_IMV_CHAVES").val(),
            IMB_IMV_ORIENTACAOSOLAR: $("#IMB_IMV_ORIENTACAOSOLAR").val(),
            IMB_IMV_POSICAO: $("#IMB_IMV_POSICAO").val(),
            IMB_IMV_ALQPAU: $("#IMB_IMV_ALQPAU").val(),
            IMB_IMV_ALQGOI: $("#IMB_IMV_ALQGOI").val(),
            IMB_IMV_ALQMIN: $("#IMB_IMV_ALQMIN").val(),
            IMB_IMV_ALNOR: $("#IMB_IMV_ALNOR").val(),
            IMB_IMV_ALNOR: $("#IMB_IMV_ALNOR").val(),
            IMB_IMV_TOPOGR: $("#IMB_IMV_TOPOGR").val(),
            IMB_IMV_AECORREDOR: simNao( $("#IMB_IMV_AECORREDOR").prop('checked')),
            IMB_IMV_AECLOSET: simNao( $("#IMB_IMV_AECLOSET").prop('checked')),
            IMB_IMV_AESALA: simNao( $("#IMB_IMV_AESALA").prop('checked')),
            IMB_IMV_AEESCRITORIO: simNao( $("#IMB_IMV_AEESCRITORIO").prop('checked')),
            IMB_IMV_SALAAMOCO: simNao( $("#IMB_IMV_SALAAMOCO").prop('checked')),
            imb_imv_deposito: simNao( $("#imb_imv_deposito").prop('checked')),
            IMB_IMV_QUADRAPOLIESPORTIVA: simNao( $("#IMB_IMV_QUADRAPOLIESPORTIVA").prop('checked')),
            IMB_IMV_CAMFUT: simNao( $("#IMB_IMV_CAMFUT").prop('checked')),
            IMB_IMV_SALESC: simNao( $("#IMB_IMV_SALESC").prop('checked')),
            IMB_IMV_HOME: simNao( $("#IMB_IMV_HOME").prop('checked')),
            IMB_IMV_VARANDA : simNao( $("#IMB_IMV_VARANDA").prop('checked')),
            IMB_IMV_MURADO  : simNao( $("#IMB_IMV_MURADO").prop('checked')),
            IMB_IMV_PISOAQUECIDO   : simNao( $("#IMB_IMV_PISOAQUECIDO").prop('checked')),
            IMB_IMV_PISOARDOSIA    : simNao( $("#IMB_IMV_PISOARDOSIA").prop('checked')),
            IMB_IMV_PISOBLOQUETE     : simNao( $("#IMB_IMV_PISOBLOQUETE").prop('checked')),
            IMB_IMV_PISOCARPETE      : simNao( $("#IMB_IMV_PISOCARPETE").prop('checked')),
            IMB_IMV_PISOCARPETEACRIL       : simNao( $("#IMB_IMV_PISOCARPETEACRIL").prop('checked')),
            IMB_IMV_PISOCARPETEMADEIRA        : simNao( $("#IMB_IMV_PISOCARPETEMADEIRA").prop('checked')),
            IMB_IMV_PISOCARPETENYLON         : simNao( $("#IMB_IMV_PISOCARPETENYLON").prop('checked')),
            IMB_IMV_PISOCERAMICA          : simNao( $("#IMB_IMV_PISOCERAMICA").prop('checked')),
            IMB_IMV_PISOCIMENTO           : simNao( $("#IMB_IMV_PISOCIMENTO").prop('checked')),
            IMB_IMV_PISOCONTRAPISO            : simNao( $("#IMB_IMV_PISOCONTRAPISO").prop('checked')),
            IMB_IMV_PISOEMBORRACHADO             : simNao( $("#IMB_IMV_PISOEMBORRACHADO").prop('checked')),
            IMB_IMV_PISOGRANITO              : simNao( $("#IMB_IMV_PISOGRANITO").prop('checked')),
            IMB_IMV_PISOLAMINADO               : simNao( $("#IMB_IMV_PISOLAMINADO").prop('checked')),
            IMB_IMV_PISOMARMORE                : simNao( $("#IMB_IMV_PISOMARMORE").prop('checked')),
            IMB_IMV_PISOLAMINADO                 : simNao( $("#IMB_IMV_PISOLAMINADO").prop('checked')),
            IMB_IMV_PISOTABUA                  : simNao( $("#IMB_IMV_PISOTABUA").prop('checked')),
            IMB_IMV_PISOTACOMADEIRA                   : simNao( $("#IMB_IMV_PISOTACOMADEIRA").prop('checked')),
            IMB_IMV_PISOVINICULO                    : simNao( $("#IMB_IMV_PISOVINICULO").prop('checked')),
            IMB_IMV_CHAVESSITUACAO : $("#IMB_IMV_CHAVESSITUACAO ").val(),
            IMB_IMV_CHAVES  : $("#IMB_IMV_CHAVES  ").val(),
            IMB_IMV_VALVEN : valorvenda,
            IMB_IMV_VALLOC : valorlocacao,
            IMB_IMV_VALORIPTU: realToDolar( $("#IMB_IMV_VALORIPTU").val()),
            imb_imv_valorcondominio: realToDolar( $("#imb_imv_valorcondominio").val()),
            IMB_IMV_CHAVESSITUACAO: $("#IMB_IMV_CHAVESSITUACAO").val(),
            IMB_ATD_IDCHAVE: $("#IMB_ATD_IDCHAVE").val(),
            IMB_IMV_CHAVES: $("#IMB_IMV_CHAVES").val(),
            IMB_IMV_MANTERSITE: simNao( $("#IMB_IMV_MANTERSITE").prop('checked')),
            VIS_STA_ID: $("#VIS_STA_ID").val(),
            IMB_IMV_PADRAO: $("#IMB_IMV_PADRAO").val(),
            IMB_IMV_FINALIDADE: $("#IMB_IMV_FINALIDADE").val(),
            IMB_IMV_ANOCONSTRUCAO: $("#IMB_IMV_ANOCONSTRUCAO").val(),
            IMB_IMV_CONDICOESCOMERCIAIS: $("#IMB_IMV_CONDICOESCOMERCIAIS").val(),
            IMB_IMV_PISOPORCELANATO: simNao( $("#IMB_IMV_PISOPORCELANATO").prop('checked')),
            IMB_IMV_CHABOX: $("#IMB_IMV_CHABOX").val(),
            IMB_CND_ID: $("#IMB_CND_ID").val(),
            

            IMB_IMV_ALARME: alarme,
            IMB_IMV_ARAPARELHO: arcondicionado,
            IMB_IMV_LAREIRA: lareira,
            IMB_IMV_SEMIMOB: semimobiliado,
            IMB_IMV_INTERF: interfone,
            IMB_IMV_AGUAQUENTE: aguaquente,

            IMB_IMV_PORTALQUADROCHAVES: portalquadrochaves,
        }

        console.log( imoveis );
        console.log( $("#i-idimovel").val());
        
        url = "{{route('imovel.store')}}"

        $.ajaxSetup({
                headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });

        $.ajax(
        {
            url : url,
            type:'post',
            datatype:'json',
            data: imoveis,
            async:false,
            success : function(data)
            {
                gravarPropImoBD( data.IMB_IMV_ID );
                salvarCorImoBD(data.IMB_IMV_ID);
                salvarCapImoBD(data.IMB_IMV_ID);
                salvarPorImoBD(data.IMB_IMV_ID);
                $("#i-imb_imagem").val( data.IMB_IMB_ID);
                $("#i-imv-id").val( data.IMB_IMV_ID);
                if( acao != 'MANTER')
                {
                    alert('Novo Imovel Cadatrado: Referência -> '+data.IMB_IMV_REFERE );
                    window.close();
                    return true;
                };

                
                if( $("#i-idimovel-imgdrag").val() == '' )
                    alert('Gravado. Agora vamos às imagens!');
                    $("#i-idimovel-imgdrag").val( data.IMB_IMV_ID );
                    $("#i-idimovel").val( data.IMB_IMV_ID );
                
                $("#id").val( data.IMB_IMV_ID );
                $("#form-img").submit();


            },
            error: function()
            {
                alert('erro');
            }
        });



    }

    function onCancelar()

    {

        $.ajaxSetup({
                headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });

        if ( $("#i-referencia").val() == '')
           {
            str = $("#i-codigoimovel").val();
            var url = "{{ route('imovel.apagar') }}"+"/"+str;


            $.ajax({
                    type: "delete",
                        url: url,
                        context: this,
                        error: function( error )
                        {
                            console.log(error);
                        }
                    });
        }
        window.history.back();
    }

    function preencherCondominio()
    {
        url = "{{ route('condominio.carga')}}/"+$("#I-IMB_IMB_IDMASTER").val();

        $("#IMB_CND_ID").empty();

        var linha = '<option value="0">Opcional</option>';
        $("#IMB_CND_ID").append( linha );

        $.getJSON( url, function( data )

        {
            for( nI=0;nI < data.length;nI++)
            {
                linha =
                    '<option value="'+data[nI].IMB_CND_ID+'">'+
                        data[nI].IMB_CND_NOME;
                linha = linha + "</option>";
                $("#IMB_CND_ID").append( linha );


            }
        });

    }


    //proprietarios
    function apagarPropImo( id )
    {
        var url = "{{ route('propimo.apagar') }}"+"/"+id;

        if (confirm("Tem certeza que deseja excluir?"))
        {
            $.ajaxSetup({
                headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
            });
            $.ajax
            ({
                type: "delete",
                url: url,
                context: this,
                success: function()
                {
                    CarregarPropImo();
                },
                error: function( error )
                {
                    console.log(error);
                }
            });
        };

    }

    function editarPropImo( id )
    {
        var url = "{{ route('propimo.editar') }}"+"/"+id;
        $.getJSON( url, function( data)
        {
            $("#i-idpropimo").val( data.IMB_PPI_ID),
            $("#i-idimovel-prop").val( data.IMB_IMV_ID),
            $('#i-principal-prop' ).prop( "checked" , (data.IMB_IMVCLT_PRINCIPAL =='S') );
            $("#i-percentual-prop").val( data.IMB_IMVCLT_PERCENTUAL4);
            $("#i-str").val( data.IMB_CLT_NOME );
            $("#propModal").modal('show');
            buscaIncremental();

        });
    }


    /*function totalParProp()
    {
        var id = $("#i-codigoimovel").val();
        var url = "{{ route('propimo.parttotal') }}"+"/"+id;
        var total =  0;
        $.getJSON( url, function( data)
        {
            total = parseFloat(data);
            return total;


        });
        return total;
    }
*/

    function adicionarPropImo()
    {
        var prop = $("#nomeprop").val();
        $("#selclientelike").empty()
        $("#tblclientes").empty()


        $("#propModal").modal('show');
        $("#i-idpropimo").val('');
        $("#i-str").val( prop );
        $('#i-principal-prop').prop('checked', 'true');
        $("#i-percentual-prop").val(100);

//        buscaIncremental();
    }


    function criarPropImo()
    {
        var cprincipal = '-';
        if( $('#i-principal-prop').prop('checked') )
            cprincipal = 'Principal';


        var cliente = $("#selclientelike option:selected" ).val();

        if( cliente != undefined)
        {
            linha =
                    '<tr id="'+cliente+'">'+
                    '   <td style="text-align:center">'+$("#selclientelike option:selected" ).val()+'</td>'+
                    '   <td style="text-align:center">'+$("#selclientelike option:selected" ).text()+'</td>'+
                    '   <td style="text-align:center">'+$("#i-percentual-prop").val()+'</td>'+
                    '   <td style="text-align:center">'+cprincipal+'</td>'+
                    '   <td style="text-align:center"> '+
                    '<a  class="btn btn-sm btn-danger" href=javascript:removerLinha('+cliente+')>Apagar</a>'+
                    '   </td>'+
                    '</tr>';
            $("#tbpropimo").append( linha );
            $("#propModal").modal('hide');
        }
        else
            alert('É necessário selecionar um cliente antes de confirmar');


    };

    function calcularPerProp()
    {

        var table = document.getElementById('tbpropimo');
        var total = 0;
        for (var r = 1, n = table.rows.length; r < n; r++)
        {

            var percentual = parseFloat( table.rows[r].cells[2].innerHTML );
            total = total + percentual;
        }

        return total;


    }

    function temPrincipal()
    {
        var table = document.getElementById('tbpropimo');
        var total = 0;
        for (var r = 1, n = table.rows.length; r < n; r++)
        {

            if( table.rows[r].cells[3].innerHTML  == 'Principal' )
            {
                total = total + 1;
                $("#IMB_CLT_ID").val( table.rows[r].cells[0].innerHTML );
            }
        }

        return total;

    }


    function removerLinha(id)
    {

      var textoid = '#'+id;

      $( textoid ).remove();

    }

    $("#formPropImo").submit
        ( function( event )
        {
            event.preventDefault();
            //alert($("#i-idcorimo").val());
                   criarPropImo();

            CarregarPropImo();

         });


/*    window.onbeforeunload = function(){
        if( $("#i-referencia").val() == '' )
            return 'Tchau';
    };
    */

/*    $("#i-str").keyup( function()
        {
            if ( $("#i-str").val().length >= 5 )
            {
                buscaIncremental();
            }

    });
    */

    $("#valorlocacao").blur(function()
    {
        var texto = $("#valorlocacao").val();
        texto = texto.replace( 'R$','');
        texto = texto.replace( '.','');
        texto = texto.replace( '.','');
        texto = texto.replace( '.','');


        console.log('texto '+texto );

        var atual = Number( texto );

        //com R$
        var f = atual.toLocaleString('pt-br',{minimumFractionDigits: 0});

        //sem R$
        //var f2 = atual.toLocaleString('pt-br', {minimumFractionDigits: 2});

        $("#valorlocacao").val( f );

    });
    $("#valorvenda").blur(function()
    {
        var texto = $("#valorvenda").val();
        texto = texto.replace( 'R$','');
        texto = texto.replace( '.','');
        texto = texto.replace( '.','');
        texto = texto.replace( '.','');


        console.log('texto '+texto );

        var atual = Number( texto );

        //com R$
        var f = atual.toLocaleString('pt-br',{minimumFractionDigits: 0});

        //sem R$
        //var f2 = atual.toLocaleString('pt-br', {minimumFractionDigits: 2});

        $("#valorvenda").val( f );

    });

    function adicionarTabCorImo()
    {
        var cliente = $("#i-select-corretor option:selected" ).val();
        linha =
            '<tr id="corimo'+cliente+'">'+
            '   <td class="div-center">'+$("#i-select-corretor option:selected" ).val()+'</td>'+
            '   <td class="div-center">'+$("#i-select-corretor option:selected" ).text()+'</td>'+
            '   <td class="div-center">'+$("#i-percentual").val()+'</td>'+
            '   <td style="text-align:center"> '+
            '       <a  class="btn btn-sm btn-danger" href=javascript:apagarCorImo('+cliente+')>Apagar</a>'+
            '   </td>'+
            '</tr>';
        $("#tbcorimo").append( linha );

    }

    function adicionarTabCapImo()
    {
        var cliente = $("#i-select-captador option:selected" ).val();
        linha =
            '<tr id="capimo'+cliente+'">'+
            '   <td class="div-center">'+$("#i-select-captador").val()+'</td>'+
            '   <td class="div-center">'+$("#i-select-captador option:selected" ).text()+'</td>'+
            '   <td class="div-center">'+$("#IMB_CAPIMO_PERCENTUAL").val()+'</td>'+
            '   <td style="text-align:center"> '+
            '       <a  class="btn btn-sm btn-danger" href=javascript:apagarCapImo('+cliente+')>Apagar</a>'+
            '   </td>'+
            '</tr>';
        $("#tbcapimo").append( linha );
        

    }

    function salvarCapImoBD( id )
    {
        var table = document.getElementById('tbcapimo');
        for (var r = 1, n = table.rows.length; r < n; r++)
        {

            $.ajaxSetup(
            {
                headers:
                {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            });

            corimo =
            {
                IMB_ATD_ID : table.rows[r].cells[0].innerHTML,
                IMB_CAPIMO_PERCENTUAL : realToDolar(table.rows[r].cells[2].innerHTML),
                IMB_CAPIMO_ID : '',
                IMB_IMB_ID : $("#IMB_IMB_ID2").val(),
                IMB_IMV_ID : id,
            };


            var url = "{{ route('capimo.salvar')}}";

            $.ajax(
            {
                url:url,
                type:'post',
                datatype:'json',
                async:false,
                data: corimo,
                success:function( data)
                {
                },
                error: function()
                {
                    alert('Erro na gravação do captador no imovel '+
                    table.rows[r].cells[0].innerHTML);

                }
            });

        }
    }


    function salvarCorImoBD( id )
    {
        var table = document.getElementById('tbcorimo');
        for (var r = 1, n = table.rows.length; r < n; r++)
        {

            $.ajaxSetup(
            {
                headers:
                {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            });

            corimo =
            {
                IMB_ATD_ID : table.rows[r].cells[0].innerHTML,
                IMB_CORIMO_PERCENTUAL : realToDolar(table.rows[r].cells[2].innerHTML),
                IMB_CORIMO_ID : '',
                IMB_IMB_ID : $("#IMB_IMB_ID2").val(),
                IMB_IMV_ID : id,
                IMB_ATD_IDALTERACAO: $("#I-IMB_ATD_ID").val(),
            };


            console.log(

                'IMB_ATD_ID: '+corimo.IMB_ATD_ID+' - '+
                'IMB_CORIMO_PERCENTUAL '+corimo.IMB_CORIMO_PERCENTUAL+' - '+
                'IMB_CORIMO_ID '+corimo.IMB_CORIMO_ID+' - '+
                'IMB_IMB_ID2 '+corimo.IMB_IMB_ID2+' - '+
                'IMB_IMV_ID '+corimo.IMB_IMV_ID+' - '+
                'IMB_ATD_IDALTERACAO '+corimo.IMB_ATD_IDALTERACAO
            )
            var url = "{{ route('corimo.salvar')}}";

            $.ajax(
            {
                url:url,
                type:'post',
                datatype:'json',
                async:false,
                data: corimo,
                success:function( data)
                {
                },
                error: function( erro)
                {
                    alert('Erro na gravação do corretor no imovel '+
                    table.rows[r].cells[1].innerHTML+' - erro:'+erro);

                }
            });

        }
    }

    function gravarPropImoBD( id )
    {
        var table = document.getElementById('tbpropimo');
        for (var r = 1, n = table.rows.length; r < n; r++)
        {

            $.ajaxSetup(
            {
                headers:
                {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            });

            var principal = table.rows[r].cells[3].innerHTML;
            var propimo =
            {
                IMB_PPI_ID : '',
                IMB_IMV_ID : id,
                IMB_IMB_ID : $("#IMB_IMB_ID2").val(),
                IMB_CLT_ID : table.rows[r].cells[0].innerHTML,
                IMB_IMVCLT_PERCENTUAL4 : table.rows[r].cells[2].innerHTML,
                IMB_IMVCLT_PRINCIPAL : principal.substring(0, 1) == 'P' ? 'S' : 'N'

            };


            var url = "{{ route('propimo.salvar')}}";

            $.ajax(
            {
                url:url,
                type:'post',
                datatype:'json',
                async:false,
                data: propimo,
                success:function( data)
                {
                },
                error: function()
                {
                    alert('Erro na gravação do proprietario '+
                    table.rows[r].cells[1].innerHTML);
                }
            });

        }

    }

    function preencherCorretoresChave()
    {
        var empresa = $("#I-IMB_IMB_IDMASTER").val();
        var url = "{{ route('atendente.carga')}}";

        console.log('url carga atendente: '+url );

        $.getJSON( url+"/"+empresa, function( data )
        {
            $("#IMB_ATD_IDCHAVE").empty();
            linha = '<option value="0"></option>';
            $("#IMB_ATD_IDCHAVE").append( linha )
            for( nI=0;nI < data.length;nI++)
            {

                linha =
                        '<option value="'+data[nI].IMB_ATD_ID+'">'+
                        data[nI].IMB_ATD_NOME+"</option>";
                    $("#IMB_ATD_IDCHAVE").append( linha );
            }

        });
        $("#IMB_ATD_IDCHAVE").val(0);

    }


    function cargaStatus( id )
    {
        url = "{{route('statusimovel.carga')}}/0";

        $.ajax(
        {
            url     : url,
            datatype: 'json',
            type    : 'get',
            async   : false,
            success : function( data )
            {
                console.log( data );
                linha = "";
                $("#VIS_STA_ID").empty();
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                        '<option value="'+data[nI].VIS_STA_ID+'">'+
                        data[nI].VIS_STA_NOME+"</option>";
                    $("#VIS_STA_ID").append( linha );
                }
            },
            error   : function( e )
            {
                alert('Erro ao carregar os Status'+e);
            }

        });

        $("#VIS_STA_ID").val( id );

    }

    function novoCadastroCliente()
    {

        window.open("{{ route('cliente.add') }}", "_blank" );

    }


    
    preencherUnidades();
    preencherTipoImovel();
    preencherCondominio();
    preencherCBCorretores(999999);
    $("#tbcorimo>tbody").empty();

    function gerarSugestaoTitulo()
    {

        debugger;
        var tipo = $("#IMB_TIM_ID option:selected").text();
        var valorvenda  = $("#IMB_IMV_VALVEN").val();
        var valorlocacao  = $("#IMB_IMV_VALLOC").val();
        var dormitorios = $("#IMB_IMV_DORQUA").val();
        var bairro = $("#CEP_BAI_NOME").val();
        var cidade = $("#IMB_IMV_CIDADE").val();
        var nomecondominio =$("#IMB_CND_ID option:selected").text();

        var finalidade='';
        if( valorvenda !='0,00' && valorlocacao != '0,00' )
           finalidade = 'Vender ou Alugar';

        if( valorvenda != '0,00' && valorlocacao == '0,00' )
           finalidade = 'Vender';
        if( valorvenda == '0,00' && valorlocacao != '0,00' )
           finalidade = 'Alugar';
        
        

        if( $("#IMB_CND_ID option:selected").val() != 0 )
            $("#IMB_IMV_TITULO").val( tipo+' para '+finalidade+' em '+cidade+' no bairro '+bairro+' no Condominio '+nomecondominio)
        else
            $("#IMB_IMV_TITULO").val( tipo+' para '+finalidade+' em '+cidade+' no bairro '+bairro );





    }
    function cargaPortal()
    {
        var url = "{{ route('portais.carga')}}/"+$("#I-IMB_IMB_IDMASTER").val();

        $.ajax(
        {
            url     : url,
            datatype: 'json',
            type    : 'get',
            async   : false,
            success : function( data )
            {
                linha = "";
                $("#IMB_POR_ID").empty();
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                        '<option value="'+data[nI].IMB_POR_ID+'">'+
                        data[nI].IMB_POR_NOME+"</option>";
                    $("#IMB_POR_ID").append( linha );
                }
            },
            error   : function( e )
            {
                alert('Erro ao carregar os portais!'+e);
            }

        });

    }


    function imovelPortalInc()
    {
        $("#i-portalimovel").modal('show');
        $("#IMB_IMP_ID").val('');
        $("#IMB_POR_ID").val('');
        cargaPortal();
    }

    function incPortalTable()
    {
        var cliente = $("#IMB_POR_ID option:selected" ).val();
        linha =
            '<tr id="porimo'+cliente+'">'+
            '   <td>'+$("#IMB_POR_ID option:selected" ).val()+'</td>'+
            '   <td>'+$("#IMB_POR_ID option:selected" ).text()+'</td>'+
            '   <td style="text-align:center"> '+
            '       <a  class="btn btn-sm btn-danger" href=javascript:apagarPorImo('+cliente+')>Apagar</a>'+
            '   </td>'+
            '</tr>';
        $("#tbportalimovel").append( linha );

    }

    function apagarPorImo( id )
    {

        if (confirm("Tem certeza que deseja excluir portal do imóvel?"))
        {

          var textoid = '#porimo'+id;
          $( textoid ).remove();

        }

    }

    function salvarPorImoBD( id )
    {
        var table = document.getElementById('tbportalimovel');
        for (var r = 1, n = table.rows.length; r < n; r++)
        {

            $.ajaxSetup(
            {
                headers:
                {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            });


            var url = "{{ route('portalimovel.gravar')}}";

            dados =
            {
                IMB_IMV_ID : id,
                IMB_POR_ID : table.rows[r].cells[0].innerHTML,
            };

            $.ajaxSetup(
            {
                headers:
                {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            });

            $.ajax(
            {
                url     : url,
                data    : dados,
                type    : 'post',
                datatype: 'json',
                async   : false,
                success : function()
                {
                },
                error   : function(e)
                {
                    alert('Erro ao gravar portal '+e);
                }
            });

        }
    }

    function buscarCondominio()
    {
        var id = $("#IMB_CND_ID").val();
        var url = "{{route('condominio.buscar')}}/"+id;


        $.ajax(
            {
                url     : url,
                dataType: 'json',
                type    : 'get',
                success : function( data )
                {
                    $("#IMB_IMV_ENDERECO").val( data.IMB_CND_ENDERECO);
                    $("#IMB_IMV_ENDERECONUMERO").val( data.IMB_CND_ENDERECONUMERO);
                    $("#IMB_IMV_ENDERECOMPLEMENTO").val( data.IMB_CND_ENDERECOCOMPLEMENTO);
                    $("#IMB_IMV_ENDERECOCEP").val( data.IMB_CND_CEP);
                    $("#CEP_BAI_NOME").val( data.CEP_BAI_NOME);
                    $("#CEP_CID_NOME").val( data.CEP_CID_NOME);
                    $("#CEP_UF_SIGLA").val( data.CEP_UF_SIGLA);
                    $("#imb_imv_valorcondominio").val( data.IMB_CND_VALCON);
                }
            }
        )

    }

    function pesquisacep(valor) {

//Nova variável "cep" somente com dígitos.
var cep = valor.replace(/\D/g, '');

//Verifica se campo cep possui valor informado.
if (cep != "") {

    //Expressão regular para validar o CEP.
    var validacep = /^[0-9]{8}$/;

    //Valida o formato do CEP.
    if(validacep.test(cep)) {

        //Preenche os campos com "..." enquanto consulta webservice.
        $('#IMB_IMV_ENDERECOTIPO').val('');
            $('#IMB_IMV_ENDERECO').val('');
            $('#CEP_BAI_NOME').val('');
            $('#IMB_IMV_CIDADE').val('');
            $('#IMB_IMV_ESTADO').val('');

        //Cria um elemento javascript.
        var script = document.createElement('script');

        //Sincroniza com o callback.
        script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

        //Insere script no documento e carrega o conteúdo.
        document.body.appendChild(script);

    } //end if.
    else {
        //cep é inválido.
        //limpa_formulário_cep();
        alert("Formato de CEP inválido.");
    }
} //end if.
else {
    //cep sem valor, limpa formulário.
    //limpa_formulário_cep();
}
};

function meu_callback(conteudo) {
        if (!("erro" in conteudo))
        {
            //Atualiza os campos com os valores.
            // /$('#rua').val(`${resultadoCEP['tipo_logradouro']} ${resultadoCEP['logradouro']}`);
            $('#IMB_IMV_ENDERECOTIPO').val('');
            $('#IMB_IMV_ENDERECO').val(conteudo.logradouro.substr( 0, 40 ));
            $('#CEP_BAI_NOME').val(conteudo.bairro.substr( 0, 60 ).toUpperCase());
            $('#IMB_IMV_CIDADE').val(conteudo.localidade.substr( 0, 40 ).toUpperCase());
            $('#IMB_IMV_ESTADO').val(conteudo.uf);

            verificarBairroCadastrado( $('#CEP_BAI_NOME').val(), $('#IMB_IMV_CIDADE').val(), $('#IMB_IMV_ESTADO').val(),'S' );




        } //end if.
        else {
            //CEP não Encontrado.
        //    limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }

function cadastrarBairro()
{
    $("#modalcadbairro").modal('show');
}

function upLoadImagemDrop()
    {
//        if ( ! onGravar('MANTER') ) return false;
        $("#galeria-update-btn").show();
        $("#i-idimovel-imgdrag").val( $("#i-idimovel").val());
        $("#form-img").submit();

    }

function checarCampos()
{

//        calcularPerProp();
        //temPrincipal()
        var valorvenda = realToDolar( $("#IMB_IMV_VALVEN").val() );
        if( $("#IMB_IMV_VALVEN").val() == '' )
            valorvenda = 0;


            var valorlocacao = realToDolar( $("#IMB_IMV_VALLOC").val() );
        if( $("#IMB_IMV_VALLOC").val() == '' )
            valorvenda = 0;

        var valoriptu = realToDolar( $("#IMB_IMV_VALORIPTU").val() );
        if( $("#IMB_IMV_VALORIPTU").val() == '' )
            valoriptu = 0;

        var valorcondominio = realToDolar( $("#imb_imv_valorcondominio").val() );
        if( $("#imb_imv_valorcondominio").val() == '' )
            valorcondominio = 0;


        var valorinformado =
            valorvenda + valorlocacao;

        var principal = temPrincipal();

        var nerros = 0;
        var cerros = '';

        /*var count =  $('#tbcorimo tr').length
        if ( count == 1)
        {
            nerros = nerros  + 1;
            cerros = cerros + 'Obrigatório informar o corretor\n';
        }
   */

        if( $("#IMB_IMV_ENDERECOCEP").val() > 99999999 )
        {
            nerros = nerros  + 1;
            cerros = cerros + 'Cep com erro!\n';
        }
        if ( calcularPerProp() != 100 )
        {
            nerros = nerros  + 1;
            cerros = cerros + 'O total de participação em proprietário(s)  está dando '+
                                calcularPerProp()+'%, mas não pode ser diferente de 100%\n';
        }

        if ( principal == 0 )
        {
            nerros = nerros  + 1;
            cerros = cerros + 'Deve haver pelo menos um proprietário como principal\n';
        }

        if ( principal > 1 )
        {
            nerros = nerros  + 1;
            cerros = cerros + 'Somente um único proprietário pode ser o principal\n';
        }

        if ( valorinformado == '0.000.00' )
        {
            nerros = nerros  + 1;
            cerros = cerros + 'Faltando informar o valor de venda e/ou locação \n';
        }

        if ($('#IMB_TIM_ID').val() == '0' )
        {
            nerros = nerros  + 1;
            cerros = cerros + 'Informe o tipo de imóvel \n';
        }

        if ($('#IMB_IMB_ID2').val() == null )
        {
            nerros = nerros  + 1;
            cerros = cerros + 'Informe qual agência(unidade) pertence o imóvel\n';
        }

        if ($('#IMB_IMV_ENDERECO').val() == '' )
        {
            nerros = nerros  + 1;
            cerros = cerros + 'Informe o Endereço do Imovel\n';
        }


        if ($('#IMB_IMV_CIDADE').val() == '' )
        {
            nerros = nerros  + 1;
            cerros = cerros + 'Informe a Cidade do Imóvel\n';
        }

        if ($('#IMB_IMV_ESTADO').val() == '' )
        {
            nerros = nerros  + 1;
            cerros = cerros + 'Informe o Estado(UF) do imóvel\n';
        }

        if ($('#CEP_BAI_ID').val() == '' )
        {
            nerros = nerros  + 1;
            cerros = cerros + 'Informe o BAIRRO do imóvel\n';
        }

        if(nerros>0)
        {
            alert( cerros );
            return false;
	    }

        return true;
}

    function imagemPrincipal( idimovel, idimagem)
    {
        $.ajaxSetup({
            headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
            });

            var url = "{{ route('imagem.principal') }}"+"/"+idimovel+"/"+idimagem;

        $.ajax(
            {
                type: "post",
                url: url,
                context: this,
                success: function()
                {
                    CarregarImagens(idimovel );
                },
                error: function( error )
                {
                    console.log(error);
                }

        });


    }

    function apagarImagem( id )
    {
        if (confirm("Tem certeza que deseja excluir a Imagem?"))
        {

            $.ajaxSetup({
            headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
            });

            var url = "{{ route('imagem.apagar') }}"+"/"+id;
            console.log( url );
            $.ajax
            (
                {
                    type: "get",
                    url: url,
                    context: this,
                    success: function(){
                        CarregarImagens( $("#IMB_IMV_ID").val() );
                    },
                    error: function( error ){
                        console.log(error);
                    }
                }
            );
            }

    }

    function editarImagem( id )
    {

        var url = "{{ route('imagem.editar') }}"+"/"+id;
        $.getJSON( url, function( data)
        {
            $("#i-idimg").val(data.IMB_IMG_ID);
            $("#i-nomeimagem").val(data.IMB_IMG_NOME);
            $("#i-imagemprincipal" ).prop( "checked", (data.IMB_IMG_PRINCIPAL =='S') );
            $("#i-imagemnaoirsite").prop( "checked", (data.IMB_IMG_NAOIRPROSITE =='S') );
            $("#i-imagemcapa").prop( "checked", (data.IMB_IMG_CAPA =='S') );
//            setarSelectCorretor(data.IMB_ATD_ID);
            $("#modalimagem").modal('show');
        });

    }

    function cancelarCadastro()
    {
        if( confirm('Certeza que deseja cancelar este novo cadastro?') == true )
        {

            var url = "{{route('imagem.apagarimovel')}}/"+$("#i-idimovel").val();
        $.ajaxSetup({
            headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
            });

        $.ajax(
            {
                type: "post",
                url: url,
                context: this,
                success: function()
                {
                    
                },
                error: function( error )
                {
                }

            });
        }

        alert('Cancelando o cadastro!');
        window.close();

    }
</script>
@endpush
