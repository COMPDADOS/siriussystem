@extends('layout.app')

@push('script')
@endpush
@section('scripttop')

    <link href="{{asset('/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('/plugins/custom/prismjs/prismjs.bundle.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />

<style>
    .valores
    {
        text-align: center;    
        font-size: 20px;
        font-weight: bold;
    }

    .cardtitulo {
  text-align: left;
  font-size: 16px;
  color: #FFFFFF; 
  font-weight: bold;
  background: #FF0606;

}

</style>

@endsection


@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="#">Cadastro</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="#">Imóveis</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
        <span>---------------------------------------</span>
        </li>
        <li>
            <a href="https://youtu.be/Efc4ME20iCg" target="_blank">Tira dúvidas deta tela. Click aqui!</a>
            <i class="fa fa-circle"></i>
        </li>

        
    </ul>
</div>

<div class="portlet light bordered">
    <div class="portlet-body">
<!--        <form action="{{ route('imovel.store') }}" method="post" id="i-form-imovel"onsubmit="onGravar( this ); return false;" >
            @csrf-->
<!--                <ul class="nav nav-pills nav-justified">
                    <li class="active">
                        <a href="#tab_1_1_1" data-toggle="tab">Dados do Imóvel</a>
                    </li>
                    <li>
                        <a href="#tab_1_1_2" data-toggle="tab">Medidas / Imediações / Cômodos</a>
                    </li>
                    <li>
                        <a href="#tab_1_1_3" data-toggle="tab">Observações</a>
                    </li>
                    <li>
                        <a href="#tab_1_1_4" data-toggle="tab">Imagens</a>
                    </li>
                    <li>
                        <a href="#tab_1_1_5" data-toggle="tab">Corretor/Captador</a>
                    </li>
                </ul>
-->

                <div class="col-xl-6">
                    <!--begin::Card-->
                    <div class="card-body">
                        <div class="example">
							<div class="example-preview">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home">
                                            <span class="nav-icon">
                                            <i class="flaticon2-chat-1"></i>
                                            </span>
                                            <span class="nav-text">Localização/Proprietário</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" aria-controls="profile">
                                            <span class="nav-icon">
                                                <i class="flaticon2-layers-1"></i>
                                            </span>
                                            <span class="nav-text">Profile</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" aria-controls="contact">
                                            <span class="nav-icon">
                                                <i class="flaticon2-rocket-1"></i>
                                            </span>
                                            <span class="nav-text">Contact</span>
                                        </a>
                                    </li>
                                </ul>
                                
                                <div class="tab-content mt-5" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <div class="col-md-2">
                                                        <label class="label-control">Site
                                                            <input type="checkbox" id="IMB_IMV_WEBIMOVEL" class="form-control" data-checkbox="icheckbox_flat-blue">
                                                        </label>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <label class="label-control">Radar
                                                            <input type="checkbox" id="IMB_IMV_RADAR" class="form-control" data-checkbox="icheckbox_flat-blue">
                                                        </label>        
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="label-control">Destaque
                                                            <input type="checkbox" id="IMB_IMV_DESTAQUE" class="form-control" data-checkbox="icheckbox_flat-blue">
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
                                                    
                                                    <div class="col-md-2">
                                                        <label class="label-control">Térrea
                                                            <input type="checkbox" id="IMB_IMV_TERREA"  class="form-control"  data-checkbox="icheckbox_flat-blue">
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
                                            <div class="portlet box blue">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-gift"></i>Proprietário(s) do Imóvel
                                                    </div>
                                                    <div class="tools">
                                                        <a href="javascript:;" class="collapse"> </a>
                                                    </div>
                                                </div>

                                                <div class="portlet-body form">
                                                    <table  id="tbpropimo" class="table table-striped table-bordered table-hover" >
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th style="text-align:center"> ID </th>
                                                                <th style="text-align:center"> Proprietario </th>
                                                                <th style="text-align:center" width="100" style="text-align:center"> Percentual </th>
                                                                <th style="text-align:center" width="100" style="text-align:center"> Principal </th>
                                                                <th width="200" style="text-align:center"> Ações </th>
                                                            </tr>   
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                
                                                    <div class="table-footer" >
                                                        <a  class="btn btn-sm btn-primary" role="button" onClick="adicionarPropImo()" >
                                                            Adicionar Proprietário </a>
                                                            <!--data-toggle="modal" data-target="#modalFormaPagamento"-->
                                                        <input type="hidden" id="i-totalperc">
                                                        <input type="hidden" id="i-temprincipal">
                                                    </div>                            
                                                </div>
                                            </div>

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
                                                        <input type="text" pattern="[0-9]+([.\,][0-9]+)?" step="1" 
                                                            text-align: right id="IMB_IMV_VALVEN" class="form-control valores" 
                                                            type="text" 
                                                            placeholder="Não informar centavos">
                                                    </div>
                                                </div>

                                                <div class="col-md-3 ">
                                                    <div class="form-group">
                                                        <label>R$ Locação</label>
                                                        <input type="text" pattern="[0-9]+([.\,][0-9]+)?" 
                                                            step="1"  class="form-control valores" 
                                                            id="IMB_IMV_VALLOC" 
                                                            placeholder="Não informar centavos">
                                                    </div>
                                                </div>

                                                <input  type="hidden" id="IMB_CLT_ID"  >
                                                <input  type="hidden" id="IMB_CLT_IDORIGINAL">
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h3>Endereço / Localização / Título</h3>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Título do Imóvel</label>
                                                        <input type="text" id="IMB_IMV_TITULO"  class="form-control input-sm" style="font-family: Tahoma; font-size: 16px" placeholder="Ex.: casa da rua aimores">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Tipo</label>
                                                        <input type="text" id="IMB_IMV_ENDERECOTIPO"  class="form-control input-sm" style="font-family: Tahoma; font-size: 16px" placeholder="Rua,Avenida,Praça...">
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
                                                        <input type="text" maxlength="10"  id="IMB_IMV_ENDERECOCOMPLEMENTO"
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

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Condomínio</label>
                                                        <select class="form-control" id="IMB_CND_ID" >
                                                        </select>
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
                                                        <label>Bairro</label>
                                                        <input type="text" 
                                                        id="CEP_BAI_NOME" 
                                                        maxlength="20"
                                                        class="form-control input-sm" >
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
                                                            max="99999999">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Cidade</label>
                                                        <input type="text" id="IMB_IMV_CIDADE"
                                                        maxlength="20"
                                                        class="form-control input-sm">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>UF</label>
                                                        <input type="text" id="IMB_IMV_ESTADO" class="form-control input-sm" >
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

                                            <!-- Botões -->
                                            <div class="form-actions right">
                                                <button type="button" class="btn default"  onClick="onCancelar()">Cancelar</button>
                                                <button type="button" class="btn blue " onClick="onGravar()" id="i-btn-gravar">
                                                    <i class="fa fa-check"></i> Gravar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">Tab content 2</div>
                                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">Tab content 3</div>
								</div>
 							</div>
                        </div>
                    </div>
                </div>

                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1_1_1">
                        
                    </div>
                    <div class="tab-pane" id="tab_1_1_2">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Imediações</label>
                                    <input type="text" maxlength="40"  id="IMB_IMV_PROXIMIDADE" 
                                    class="form-control input-sm" >
                                </div>
                            </div>
                        </div>


                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Medida Terreno</label>
                                    <input type="text" id="IMB_IMV_MEDTER"  class="form-control" 
                                     placeholder="ex.: 10x20">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Área Total(m2)</label>
                                    <input type="text" id="IMB_IMV_ARETOT"  class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Área Construída(m2)</label>
                                    <input type="text" id="IMB_IMV_ARECON"   class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Área Útil(apto)(m2)</label>
                                    <input type="text" id="IMB_IMV_AREUTI"  class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Dorm.</label>
                                    <input type="number" id="IMB_IMV_DORQUA"  
                                    min="0" max="999"
                                    class="form-control input-sm">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">suites</label>
                                    <input type="number" id="IMB_IMV_SUIQUA"   
                                    class="form-control input-sm" >
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="checkbox icheck-primary">
                                    <input type="checkbox" id="IMB_IMV_DORAE">
                                    <label class="form-check-label">AE</label>
                                </div>

                                <div class="checkbox icheck-primary">
                                    <input type="checkbox" id="IMB_IMV_SUIHID" >
                                    <label class="form-check-label">Hidro </label>
                                </div>

                                <div class="checkbox icheck-primary">
                                    <input type="checkbox"  id="IMB_IMV_DORCLO" >
                                    <label class="form-check-label">Closet</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Salas</label>
                                    <input type="number" id="IMB_IMV_SALQUA" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="checkbox icheck-primary">
                                    <input type="checkbox" id="IMB_IMV_COZINHA" >
                                    <label class="form-check-label">Cozinha</label>
                                </div>

                                <div class="checkbox icheck-primary">
                                    <input type="checkbox" id="IMB_IMV_COZPLA">
                                    <label class="form-check-label">Planejada</label>
                                </div>

                                <div class="checkbox icheck-primary">
                                    <input type="checkbox" id="IMB_IMV_LAVABO">
                                    <label class="form-check-label">Lavabo</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="checkbox icheck-primary">
                                    <input type="checkbox"  id="IMB_IMV_EMPQUA">
                                    <label class="form-check-label">Dorm. Empr.</label>
                                </div>
                                <div class="checkbox icheck-primary">
                                    <input type="checkbox"  id="IMB_IMV_EMPWC">
                                    <label class="form-check-label">WC Empreg.</label>
                                </div>

                                <div class="checkbox icheck-primary">
                                    <input type="checkbox"  id="IMB_IMV_DESPENSA" >
                                    <label class="form-check-label">Despensa</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-1">
                            </div>

                            <div class="col-md-2">
                                <div class="checkbox icheck-primary">   
                                    <input type="checkbox"  id="IMB_IMV_PISCIN">
                                    <label class="form-check-label">Piscina</label>
                                </div>

                                <div class="checkbox icheck-primary">
                                    <input type="checkbox"   id="IMB_IMV_EDICUL">
                                    <label class="form-check-label">Edícula</label>
                                </div>

                                <div class="checkbox icheck-primary">
                                    <input type="checkbox"   id="IMB_IMV_QUINTA">
                                    <label class="form-check-label">Quintal</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="checkbox icheck-primary">
                                    <input type="checkbox"   id="IMB_IMV_CHURRA">
                                    <label class="form-check-label">Churrasqueira</label>
                                </div>

                                <div class="checkbox icheck-primary">
                                    <input type="checkbox"   id="IMB_IMV_PORELE">
                                    <label class="form-check-label">Portão Eletr.</label>
                                </div>

                                <div class="checkbox icheck-primary">
                                    <input type="checkbox"   id="IMB_IMV_SAUNA">
                                    <label class="form-check-label">Sauna</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="checkbox icheck-primary">
                                    <input type="checkbox"   id="IMB_IMV_QUADRAPOLIESPORTIVA" >
                                    <label class="form-check-label">Quadra</label>
                                </div>

                                <div class="checkbox icheck-primary">
                                    <input type="checkbox" id="IMB_IMV_SALFES">
                                    <label class="form-check-label">Salão Festas</label>
                                </div>

                                <div class="checkbox icheck-primary">
                                    <input type="checkbox" id="IMB_IMV_PLAGRO">
                                    <label class="form-check-label">Playground</label>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="control-label">Vagas Cobertas</label>
                                    <input type="number" id="IMB_IMV_GARCOB"   min="0" class="form-control"  >
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="control-label">Vagas Descob.</label>
                                    <input type="number" id="IMB_IMV_GARDES"  min="0" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label"><br>Idade Imóvel</label>
                                    <input type="text" id="IMB_IMV_IDADE" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-actions right">
                            <button type="button" class="btn default"    onClick="onCancelar()">Cancelar</button>
                            <button type="button" class="btn blue " onClick="onGravar()" id="i-btn-gravar-2">
                                <i class="fa fa-check"></i> Gravar
                            </button>
                        </div>

                    </div>

                    <div class="tab-pane" id="tab_1_1_3">
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
                                    <textarea rows="10" id="IMB_IMV_OBSERV" style="min-width: 100%"></textarea>
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
                                    <textarea rows="10"id="IMB_IMV_OBSWEB" style="min-width: 100%"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions right">
                            <button type="button" class="btn default"   onClick="onCancelar()" >Cancelar</button>
                            <button type="submit" class="btn blue " id="i-btn-gravar-3" onClick="onGravar()">
                                <i class="fa fa-check"></i> Gravar
                            </button>
                        </div>
                    </div>

                    <div class="tab-pane" id="tab_1_1_4">

                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Imagens
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                </div>
                            </div>



                            <div class="portlet-body form ">
                                <div class="col-md-12 cardtitulo">
                                    As imagens só poderão ser cadastradas após você gravar os dados 
                                    e entrar para alterar os dados do imóvel
                                </div>
                            </div>

                            

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
                                            <th style="text-align:center"> Corretor </th>
                                            <th width="100" style="text-align:center"> Percentual </th>
                                            <th width="200" style="text-align:center"> Ações </th>
                                        </tr>
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
                                        <tr>
                                            <th style="text-align:center"> ID </th>
                                            <th style="text-align:center"> Captador </th>
                                            <th width="100" style="text-align:center"> Tipo </th>
                                            <th width="200" style="text-align:center"> Ações </th>
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

                    </div>

                </div>
            </div>
    </div>
</div>

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
                                            <input type="number" class="form-control" id="i-percentual" min="1" >
                                            
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
    <div class="modal-dialog" role="document">
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Captador</label>
                                            <select class="form-control" id="i-select-captador" name="IMB_ATD_ID">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Tipo</label>
                                            <select class="form-control" id="IMB_CAPIMO_TIPO">
                                                <option value="Venda">Venda</option>
                                                <option value="Locação">Locação</option>
                                                <option value="Ambos">Ambos</option>
                                            </select>
                                            
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

<!-- Modal -->
<div class="modal fade" id="propModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Proprietário do Imóvel
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="text" id="i-str"  
                                placeholder="digite aqui um pedaço do nome" 
                                class="form-control">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <button class="btn btn-primary" 
                                    onClick="buscaIncremental()">Carregar Sugestões
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <input type="hidden" id="i-idpropimo" name="IMB_PPI_ID">
                    <input type="hidden" id="i-idimovel-prop" name="IMB_IMV_ID" 
                                                value="{{$id}}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Selecione abaixo</label>
                                <select class="form-control" id="selclientelike">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="control-label">% Partic.</label>
                                    <input type="number" id="i-percentual-prop"  min="0.01"
                                    class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Principal
                                    <input type="checkbox" 
                                        class="form-control" data-checkbox="icheckbox_flat-blue"
                                        id="i-principal-prop">
                                        
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" onClick="criarPropImo()">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('script')

<script type="text/javascript">
    $("#i-form-imovel :input").prop("disabled", false);
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="assets/plugins/global/plugins.bundle.js"></script>
<script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
<script src="assets/js/scripts.bundle.js"></script>

<script>

    $(document).ready(function() {
        if  ( carregarOpcao( $("#I-IMB_ATD_ID").val(), 17,2, "{{route('direito.checar')}}") == false )  
            window.history.back();
    });

    $('#IMB_IMV_ENDERECOCEP').on('blur', () => 
        {
            let token = document.head.querySelector('meta[name="csrf-token"]');
            if (token) {
                window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
            } else 
            {
              console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
            }

            if ($.trim($('#IMB_IMV_ENDERECOCEP').val()) !== '') 
            {
                //console.log('passando');
                $('#mensagem').html('(Aguarde, consultando CEP ...)');

                // NOVO CODIGO =============================================

                // Guardar o CEP do input.
                const cep = $('#IMB_IMV_ENDERECOCEP').val();

                // Construir a url com o CEP do input.
                // IMPORTANTE: na url, informar o parametro formato=json ao invés de formato=javascript.
                const urlBuscaCEP = `http://cep.republicavirtual.com.br/web_cep.php?formato=json&cep=${cep}`;

                // Realizar uma requisição HTTP GET na url.
                // O primeiro parâmetro é a url.
                // O segundo parâmetro é o callback, ou seja,
                // uma função que vai ser executada quando os dados forem retornados.
                // Essa função recebe um parâmetro que são os dados que a API retornou.
                $.get(urlBuscaCEP, (resultadoCEP) => 
                {

                    if (resultadoCEP.resultado) 
                    {
                        // /$('#rua').val(`${resultadoCEP['tipo_logradouro']} ${resultadoCEP['logradouro']}`);
                        $('#IMB_IMV_ENDERECOTIPO').val(resultadoCEP.tipo_logradouro);
                        $('#IMB_IMV_ENDERECO').val(resultadoCEP.logradouro);
                        $('#CEP_BAI_NOME').val(resultadoCEP.bairro.substr( 0, 19 ));
                        $('#IMB_IMV_CIDADE').val(resultadoCEP.cidade.substr( 0, 19 ));
                        $('#IMB_IMV_ESTADO').val(resultadoCEP.uf);
                    } 
                    else 
                    {
                    console.error('Erro ao carregar os dados do CEP.');
                    }
                });        
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
        
        
    function buscaIncremental()
    {
        str = $("#i-str").val();
        var url = "{{ route('buscaclienteincremental') }}"+"/"+str;
        
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
        var url = "{{ route('atendente.carga')}}";

        $.getJSON( url+"/"+empresa, function( data )
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
        $("#i-percentual").val('100');
        
    }


//INICIO CAPTADORES
function modalCaptadores()
    {
        $("#modalcapimo").modal('show');
        $("#i-percentual-cap").val('100');
        $("#IMB_CAPIMO_TIPO").val('Venda');
        preencherCBCaptadores();
    }

    
    
    function preencherCBCaptadores( nidcorretor )
    {
        var empresa = $("#I-IMB_IMB_IDMASTER").val();
        var url = "{{ route('atendente.carga')}}";

        $.getJSON( url+"/"+empresa, function( data )
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
    function CarregarImagens()
    {
        str = $("#i-imv-id").val();
        $.getJSON( "{{ route( 'imagens.imoveis')}}/"+str, function( data)
        {
            linha = "";
            $("#tblimagens>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
                var nome = data[nI].IMB_IMG_NOME;
                if( nome == null)
                    nome = "";
                linha = 
                        '<tr>'+
                        '<td style="text-align:center valign="center">'+nome+'</td>' +
                        '<td><img class="card-img-top" src="/rb/storage/images/imoveis/thumb/180_135_'+data[nI].IMB_IMG_ARQUIVO+'"></td>'+
                        '<td style="text-align:center" valign="center"> '+
                            '<a href=javascript:editarImagem('+data[nI].IMB_IMG_ID+') class="btn btn-sm btn-primary">Editar</a> '+
                            '<a href=javascript:apagarImagem('+data[nI].IMB_IMG_ID+') class="btn btn-sm btn-danger">Excluir</a> ';

                if( data[nI].IMB_IMG_PRINCIPAL !='S')
                    linha = linha + 
                                '<a href=javascript:imagemPrincipal('+data[nI].IMB_IMV_ID+','+
                                data[nI].IMB_IMG_ID+') class="btn btn-sm btn-default">Definir</a> '+
                            '</td> ';
                else
                    linha = linha + 
                                '<a class="btn btn-sm btn-success">Definida</a> '+
                            '</td> ';
                    linha = linha +
                        '</tr>';
                    
                $("#tblimagens").append( linha );
                        
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
                    CarregarImagens();
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
                        CarregarImagens();
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

            CarregarImagens();
            
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
                CarregarImagens();
        });


    }

    function preencherUnidades()
    {
        $.getJSON( "{{route('imobiliaria.carga')}}/"+$("#I-IMB_IMB_IDMASTER").val(), 
        function( data )
        {
            var linha =  '<option value="0">Informe a Unidade</option>';
            $("#IMB_IMB_ID2").append( linha );
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
            var linha =  '<option value="0">Informeo o tipo de imóvel</option>';            
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

    function onGravar()
    {
        var valorinformado =
            parseFloat($("#IMB_IMV_VALLOC").val() )  +
            parseFloat($("#IMB_IMV_VALVEN").val() );
        
//        calcularPerProp();
        //temPrincipal()
        
        var principal = temPrincipal();
                 
        var nerros = 0;
        var cerros = '';

        var count =  $('#tbcorimo tr').length
        if ( count == 1)
        {
            nerros = nerros  + 1;
            cerros = cerros + 'Obrigatório informar o corretor\n';
        }
   

        if( $("#IMB_IMV_ENDERECOCEP").val() > 99999999 )
        {
            nerros = nerros  + 1;
            cerros = cerros + 'Cep com erro!\n';
        }
        if ( calcularPerProp() != 100 )        
        {
            nerros = nerros  + 1;
            cerros = cerros + 'O total de participação em proprietário(s)  está dando '+
                                calcularPerProp()+'%, mas não pode ser diferente de 100%';
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

        if ( valorinformado == 0 )
        {
            nerros = nerros  + 1;
            cerros = cerros + 'Faltando informar o valor de venda e/ou locação \n';
        }

        if ($('#IMB_TIM_ID').val() == null )
        {
            nerros = nerros  + 1;
            cerros = cerros + 'Informe o tipo de imóvel \n';
        }

        if ($('#IMB_IMB_ID2').val() == null )
        {
            nerros = nerros  + 1;
            cerros = cerros + 'Informe qual agência(unidade) pertence o imóvel\n';
        }

        if(nerros>0){
            alert( cerros );
            return false;
	    }

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

        var cozinha = 'N';
        if ( $("#IMB_IMV_COZINHA").prop( "checked" ) )
        cozinha = 'S';

        var suspenso = 'N';
        if ( $("#IMB_IMV_SUSPENSO").prop( "checked" ) )
        suspenso = 'S';

        var cozpla = $("#IMB_IMV_COZPLA").prop('checked') ? 'S' : 'N';
        var lavabo = $("#IMB_IMV_LAVABO").prop('checked') ? 'S' : 'N';
        var empdor = $("#IMB_IMV_EMPQUA").prop('checked') ? 'S' : 'N';
        var empwc = $("#IMB_IMV_EMPWC").prop('checked') ? 'S' : 'N';
        var despensa = $("#IMB_IMV_DESPENSA").prop('checked') ? 'S' : 'N';
        var piscina = $("#IMB_IMV_PISCIN").prop('checked') ? 'S' : 'N';
        var edicula = $("#IMB_IMV_EDICUL").prop('checked') ? 'S' : 'N';
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
        var radar = $("#IMB_IMV_RADAR").prop('checked') ? 'S' : 'N';

        var imoveis =
        {
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
            IMB_IMV_VALVEN : $("#IMB_IMV_VALVEN").val(),
            IMB_IMV_VALLOC : $("#IMB_IMV_VALLOC").val(),
            IMB_IMV_ENDERECOTIPO : $("#IMB_IMV_ENDERECOTIPO").val(),
            IMB_IMV_NUMAPT : $("#IMB_IMV_NUMAPT").val(),
            IMB_IMV_PREDIO : $("#IMB_IMV_PREDIO").val(),
            IMB_IMV_ANDAR : $("#IMB_IMV_ANDAR").val(),
            CEP_BAI_NOME : $("#CEP_BAI_NOME").val(),
            IMB_IMV_ENDERECOCEP : $("#IMB_IMV_ENDERECOCEP").val(),
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
            IMB_IMV_RADAR : radar,
            IMB_IMV_TITULO: $("#IMB_IMV_TITULO").val(),
            
        }                                                   

        url = "{{route('imovel.store')}}";

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
                gravarPropImoBD( data );
                salvarCorImoBD(data);
                salvarCapImoBD(data);
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Gravado com Sucesso!',
                showConfirmButton: true,
                timer: 3500
              });
              window.history.back();
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

        $("#propModal").modal('show');
        $("#i-idpropimo").val('');
        $("#i-str").val( prop );
        $('#i-principal-prop').prop('checked', 'true');
        $("#i-percentual-prop").val(100);

        buscaIncremental();
    }


    function criarPropImo()
    {
        var cprincipal = '-';
        if( $('#i-principal-prop').prop('checked') )
            cprincipal = 'Principal';


        var cliente = $("#selclientelike option:selected" ).val();
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
    
    $("#i-str").keyup( function()
        {
            if ( $("#i-str").val().length >= 5 )
            { 
                buscaIncremental();
            }

    });

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
            '   <td>'+$("#i-select-corretor option:selected" ).val()+'</td>'+
            '   <td>'+$("#i-select-corretor option:selected" ).text()+'</td>'+
            '   <td>'+$("#i-percentual").val()+'</td>'+
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
            '   <td>'+$("#i-select-captador option:selected" ).val()+'</td>'+
            '   <td>'+$("#i-select-captador option:selected" ).text()+'</td>'+
            '   <td>'+$("#IMB_CAPIMO_TIPO").val()+'</td>'+
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
                IMB_CAPIMO_TIPO : table.rows[r].cells[2].innerHTML,
                IMB_CAPIMO_PERCENTUAL : 100,
                IMB_CAPIMO_ID : '',
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
                    table.rows[r].cells[1].innerHTML);

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
                IMB_CORIMO_PERCENTUAL : table.rows[r].cells[2].innerHTML,
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



    preencherUnidades();
    preencherTipoImovel();
    preencherCondominio();
    preencherCBCorretores(999999);
    $("#tbcorimo>tbody").empty();

    
</script>
@endpush