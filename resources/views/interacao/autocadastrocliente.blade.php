<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 4.7.5
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="pt-br">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Sirius System - Auto-cadastro pessoal</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Formulário para preenchimentos de dados cadastrais - Concreto Imóveis" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <script src="{{asset('/global/plugins/sweetalert/sweetalert2.min.js')}}"></script>
        <link rel="stylesheet" href="{{asset('/global/plugins/sweetalert/sweetalert2.min.css')}}">        
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/js/all.min.js" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="{{asset('global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{asset('global/css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{asset('global/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{{asset('layouts/layout/css/layout.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('layouts/layout/css/themes/darkblue.min.css')}}" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{asset('layouts/layout/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

        <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
            <div class="page-wrapper">
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="m-heading-1 border-green m-bordered">
                                    <h3>Auto-cadastro</h3>
                                    <p> Aqui você poderá cadastrar seus dados de forma individualizada,prática e segura e com total segurança. </p>
                                </div>
                                <input type="hidden" id="I-IMB_IMB_ID">
                                <input type="hidden" id="I-IMB_IMB_CODIGO" value = "{{$empresa}} ">
                                <div class="portlet light bordered" id="form_wizard_1">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class=" icon-layers font-red"></i>
                                            <span class="caption-subject font-red bold uppercase"> Cadastre-se facilmente neste passo-a-passo
                                                <span class="step-title"> Passo 1 e 4 </span>
                                            </span>
                                        </div>
                                        <div class="actions">
                                            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                                <i class="icon-cloud-upload"></i>
                                            </a>
                                            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                                <i class="icon-wrench"></i>
                                            </a>
                                            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                                <i class="icon-trash"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <form class="form-horizontal" action="#" id="submit_form">
                                            <input type="hidden" id="i-jacadastrado" value="N">
                                            <div class="form-wizard">
                                                <div class="form-body">
                                                    
                                                    <ul class="nav nav-pills nav-justified steps">
                                                        <li>
                                                            <a href="#tab1" data-toggle="tab" class="step">
                                                                <span class="number"> 1 </span>
                                                                <span class="desc">
                                                                    <i class="fa fa-check"></i> Documentação </span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#tab2" data-toggle="tab" class="step">
                                                                <span class="number"> 2 </span>
                                                                <span class="desc">
                                                                    <i class="fa fa-check"></i> Endereço</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#tab3" data-toggle="tab" class="step active">
                                                                <span class="number"> 3 </span>
                                                                <span class="desc">
                                                                    <i class="fa fa-check"></i> Contato </span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#tab4" data-toggle="tab" class="step">
                                                                <span class="number"> 4 </span>
                                                                <span class="desc">
                                                                    <i class="fa fa-check"></i> Confirmação </span>
                                                            </a>
                                                        </li>
                                                    </ul>

                                                    <div id="bar" class="progress progress-striped" role="progressbar">
                                                        <div class="progress-bar progress-bar-success"> </div>
                                                    </div>

                                                    <div class="tab-content">
                                                        
                                                        <div class="alert alert-danger display-none">
                                                            <button class="close" data-dismiss="alert"></button> Você tem erros nos campos. Por gentileza verifique os erros. 
                                                        </div>
                                                        
                                                        <div class="alert alert-success display-none">
                                                            <button class="close" data-dismiss="alert"></button> Parabéns, você cadastrou seus dados com sucesso! 
                                                        </div>
                                                        
                                                        <div class="tab-pane active" id="tab1">
                                                           <div class="form-group">
                                                                <label class="control-label col-md-3" id="i-lbl-nome">Nome
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control" name="nome" id="i-nome" />
                                                                    <span class="help-block" id="i-span-nome"> Nome completo </span>
                                                                </div>
                                                            </div>


                                                            <div class="form-group">

                                                                <label class="control-label col-md-3">CPF/CNPJ
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-3">
                                                                    <input type="text" class="form-control" name="cpf" id="i-cpf" 
                                                                    onkeypress="return isNumber(event)" onpaste="return false;" placeholder="CPF ou CNPJ"/>
                                                                    <span class="help-block"> Informe CPF ou CNPJ </span>
                                                                </div>  
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-3" id="i-lbl-rg">RG/Inscr.Estadual
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-2">
                                                                    <input type="text" class="form-control" name="rg" id="i-rg" 
                                                                    placeholder="RG ou Insc.Estadual"/>
                                                                    <span class="help-block" id="i-span-rg">  </span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-md-2">
                                                                        <select name="orgao-uf" id="i-rg-orgao-uf" class="form-control">                                                                    
                                                                            <option value="AC">Acre (AC)</option>
                                                                            <option value="AL">Alagoas (AL)</option>
                                                                            <option value="AP">Amapá (AP)</option>
                                                                            <option value="AM">Amazonas (AM)</option>
                                                                            <option value="BA">Bahia (BA)</option>
                                                                            <option value="CE">Ceará (CE)</option>
                                                                            <option value="DF">Distrito Federal (DF)</option>
                                                                            <option value="ES">Espírito Santo (ES)</option>
                                                                            <option value="GO">Goiás (GO)</option>
                                                                            <option value="MA">Maranhão (MA)</option>
                                                                            <option value="MT">Mato Grosso (MT)</option>
                                                                            <option value="MT">Mato Grosso do Sul (MS)</option>
                                                                            <option value="MG">Minas Gerais (MG)</option>
                                                                            <option value="PA">Pará (PA)</option>
                                                                            <option value="PB">Paraíba (PB)</option>
                                                                            <option value="PR">Paraná (PR)</option>
                                                                            <option value="PE">Pernambuco (PE)</option>
                                                                            <option value="PI">Piauí (PI)</option>
                                                                            <option value="RJ">Rio de Janeiro (RJ)</option>
                                                                            <option value="RN">Rio Grande do Norte (RN)</option>
                                                                            <option value="RS">Rio Grande do Sul (RS)</option>
                                                                            <option value="RO">Rondônia (RO)</option>
                                                                            <option value="RR">Roraima (RR)</option>
                                                                            <option value="SC">Santa Catarina (SC)</option>
                                                                            <option value="SP">São Paulo (SP)</option>
                                                                            <option value="SE">Sergipe (SE)</option>
                                                                            <option value="TO">Tocantins (TO)</option>
                                                                        </select>                                                                                                                                                
                                                                        <span class="help-block" id="i-span-rg-ug">UF do RG</span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Pessoa
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <select id="i-pessoa" class="form-control" name="pessoa">
                                                                        <option value="F">Física</option>
                                                                        <option value="J">Jurídica</option>
                                                                    </select>
                                                                </div>
                                                            </div>


                                                            <div class="form-group" id="i-div-sexo">
                                                                <label class="control-label col-md-3">Sexo
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <select id="i-sexo" class="form-control" name="sexo" >
                                                                        <option value="M">Masculino</option>
                                                                        <option value="F">Feminino</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group" id="i-div-estadocivil">
                                                                <label class="control-label col-md-3">Estado Civil
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <select id="i-estadocivil" class="form-control" name="estadocivil">
                                                                        <option value="S">Solteiro(a)</option>
                                                                        <option value="C">Casado(a)</option>
                                                                        <option value="P">Separado(a)</option>
                                                                        <option value="I">Divorciado(a)</option>
                                                                        <option value="V">Viúvo(a)</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group" id="i-div-nacionalidade">
                                                                <label class="control-label col-md-3">Nacionalidade</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control" name="nacionalidade" id="i-nacionalidade" value="BRASILEIRA"/>
                                                                    <span class="help-block">  </span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Data Nascto</label>
                                                                <div class="col-md-3">
                                                                    <input type='date'  class="form-control" id="i-datanascimento" name="datanascimento">
                                                                </div>  
                                                            </div>                                                            
                                                        </div>
                                                        
                                                        <div class="tab-pane" id="tab2">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">CEP
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control" name="cepresidencial" id="i-cep-residencial"  
                                                                        onkeypress="return isNumber(event)" onpaste="return false;"/>
                                                                    <span class="help-block"> CEP residencial </span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Endereco
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control" id="i-enderecoresidencial" name="logradouro"
                                                                    placeholder="logradouro"/>
                                                                    <span class="help-block"> Logradouro </span>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input type="text" class="form-control" id="i-enderecoresidencialnumero" 
                                                                    name="endereconumero" placeholder="Número"/>
                                                                    <span class="help-block"> Número </span>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input type="text" class="form-control" id="i-enderecoresidencialcomplemento" 
                                                                    name="enderecomplemento" placeholder="Complemento"
                                                                                />
                                                                    <span class="help-block"> Complemento </span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Bairro
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control" id="i-bairroresidencial" 
                                                                    name="bairroresidencial"  placeholder="Bairro"/>
                                                                    <span class="help-block"> Bairro residencial </span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Cidade
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control" id="i-cidaderesidencial" 
                                                                    name="cidaderesidencial"  placeholder="Cidade"/>
                                                                    <span class="help-block"> Cidade residencial </span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">UF</label>
                                                                <div class="col-md-4">
                                                                    <select id="i-ufresidencial" class="form-control" name="estadoresidencial">
                                                                        <option value="AC">Acre (AC)</option>
                                                                        <option value="AL">Alagoas (AL)</option>
                                                                        <option value="AP">Amapá (AP)</option>
                                                                        <option value="AM">Amazonas (AM)</option>
                                                                        <option value="BA">Bahia (BA)</option>
                                                                        <option value="CE">Ceará (CE)</option>
                                                                        <option value="DF">Distrito Federal (DF)</option>
                                                                        <option value="ES">Espírito Santo (ES)</option>
                                                                        <option value="GO">Goiás (GO)</option>
                                                                        <option value="MA">Maranhão (MA)</option>
                                                                        <option value="MT">Mato Grosso (MT)</option>
                                                                        <option value="MT">Mato Grosso do Sul (MS)</option>
                                                                        <option value="MG">Minas Gerais (MG)</option>
                                                                        <option value="PA">Pará (PA)</option>
                                                                        <option value="PB">Paraíba (PB)</option>
                                                                        <option value="PR">Paraná (PR)</option>
                                                                        <option value="PE">Pernambuco (PE)</option>
                                                                        <option value="PI">Piauí (PI)</option>
                                                                        <option value="RJ">Rio de Janeiro (RJ)</option>
                                                                        <option value="RN">Rio Grande do Norte (RN)</option>
                                                                        <option value="RS">Rio Grande do Sul (RS)</option>
                                                                        <option value="RO">Rondônia (RO)</option>
                                                                        <option value="RR">Roraima (RR)</option>
                                                                        <option value="SC">Santa Catarina (SC)</option>
                                                                        <option value="SP">São Paulo (SP)</option>
                                                                        <option value="SE">Sergipe (SE)</option>
                                                                        <option value="TO">Tocantins (TO)</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="tab-pane" id="tab3">
                                                        <div class="form-group">
                                                                <label class="control-label col-md-3">Email
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control" name="email" id="i-email" 
                                                                    placeholder="Email"/>
                                                                    <span class="help-block"> Informe um email válido </span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Confirmação de Email
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control" name="email2" 
                                                                    placeholder="Email Confirmação"
                                                                    id="i-email2" onpaste="return false;"/>
                                                                    <span class="help-block"> Redegite o email válido </span>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Telefone Celular:
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-1">
                                                                    <input type="text" name="ddd1" class="form-control" 
                                                                    id="i-ddd1" min='11' max='99'
                                                                    onkeypress="return isNumber(event)" onpaste="return false;" placeholder="DDD"/>
                                                                    <span class="help-block">DDD</span>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input type="text" name="numero1" class="form-control" 
                                                                    onkeypress="return isNumber(event)" onpaste="return false;"
                                                                    id='i-numero1' min="20000000" max="999999999"  placeholder="Nº Telefone"/>
                                                                    <span class="help-block"> Nº do Telefone(somente números) </span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Telefone Comercial:
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                 <div class="col-md-1">
                                                                    <input type="text" name="ddd2" class="form-control" 
                                                                    id='i-ddd2' min='11' max='99' placeholder="DDD"
                                                                    onkeypress="return isNumber(event)" onpaste="return false;"/>
                                                                    <span class="help-block">DDD</span>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input type="text" name="numero2" class="form-control" id='i-numero2' min="20000000" max="999999999"
                                                                    onkeypress="return isNumber(event)" onpaste="return false;" placeholder="Nº Telefone"/>
                                                                    <span class="help-block"> Nº do Telefone(somente números) </span>
                                                                </div>
                                                            </div>
                                                       </div>
                                                        <div class="tab-pane" id="tab4">
                                                            <h3 class="block">Informações de Cadastro</h3>
                                                            <h4 class="form-section">Dados Pessoais</h4>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Nome:</label>
                                                                <div class="col-md-4">
                                                                    <p class="form-control-static" data-display="nome"> </p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">CPF/CNPJ:</label>
                                                                <div class="col-md-4">
                                                                    <p class="form-control-static" data-display="cpf"> </p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">RG/Inc.Estadual:</label>
                                                                <div class="col-md-4">
                                                                    <p class="form-control-static" data-display="rg"> </p>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <p class="form-control-static" data-display="orgao-uf"> </p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Pessoa:</label>
                                                                <div class="col-md-4">
                                                                    <p class="form-control-static" data-display="pessoa"> </p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Sexo:</label>
                                                                <div class="col-md-4">
                                                                    <p class="form-control-static" data-display="sexo"> </p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Estado Civil:</label>
                                                                <div class="col-md-4">
                                                                    <p class="form-control-static" data-display="estadocivil"> </p>
                                                                </div>
                                                            </div>

                                                            <h4 class="form-section">Endereços</h4>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Email:</label>
                                                                <div class="col-md-4">
                                                                    <p class="form-control-static" data-display="email"> </p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Endereço</label>
                                                                <div class="col-md-3">
                                                                    <p class="form-control-static" data-display="logradouro" > </p>
                                                                </div>
                                                                <div class="col-md-1">
                                                                </div>
                                                                <div class="col-md-2">
                                                                <p class="form-control-static" data-display="endereconumero"> </p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Bairro:</label>
                                                                <div class="col-md-4">
                                                                    <p class="form-control-static" data-display="bairroresidencial"> </p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Cep:</label>
                                                                <div class="col-md-2">
                                                                    <p class="form-control-static" data-display="cepresidencial"> </p>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <p class="form-control-static" data-display="cidaderesidencial"> </p>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <p class="form-control-static" data-display="estadoresidencial"> </p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Telefone(I):</label>
                                                                <div class="col-md-2">
                                                                    <p class="form-control-static" data-display="ddd1"> </p>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <p class="form-control-static" data-display="numero1"> </p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Telefone(II):</label>
                                                                <div class="col-md-2">
                                                                    <p class="form-control-static" data-display="ddd2"> </p>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <p class="form-control-static" data-display="numero2"> </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-offset-3 col-md-9">
                                                            <a href="javascript:;" class="btn default button-previous">
                                                                <i class="fa fa-angle-left"></i> Voltar </a>
                                                            <a href="javascript:;" class="btn btn-outline green button-next"> Continuar
                                                                <i class="fa fa-angle-right"></i>
                                                            </a>
                                                            <a href="javascript:onGravar();" class="btn green button-submit" id="i-btn-salvar"> Salvar
                                                                <i class="fa fa-check"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
            </div>
        </div>
        <div class="quick-nav-overlay"></div>
        <!-- END QUICK NAV -->
        <!--[if lt IE 9]>
<script src="{{asset('global/plugins/respond.min.js')}}"></script>
<script src="{{asset('global/plugins/excanvas.min.js')}}"></script> 
<script src="{{asset('global/plugins/ie8.fix.min.js')}}"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="{{asset('global/plugins/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{asset('global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('global/plugins/jquery-validation/js/jquery.validate.js')}}" type="text/javascript"></script>
        <script src="{{asset('global/plugins/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.js')}}" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{asset('global/scripts/app.min.js')}}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="{{asset('pages/scripts/form-wizard.js')}}" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="{{asset('layouts/layout/scripts/layout.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('layouts/layout/scripts/demo.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('layouts/global/scripts/quick-nav.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <script>
            $(document).ready(function()
            {
                $('#clickmewow').click(function()
                {
                    $('#radio1003').attr('checked', 'checked');
                });

                pegarEmpresa();
            })


            $('#i-cep-residencial').on('blur', () => {

                let token = document.head.querySelector('meta[name="csrf-token"]');
                if (token) {
                    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
                } else {
                    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
                }

                if ($.trim($('#i-cep-residencial').val()) !== '') 
                {
                    $('#mensagem').html('(Aguarde, consultando CEP ...)');

                    // Guardar o CEP do input.
                    const cep = $('#i-cep-residencial').val();

                    // Construir a url com o CEP do input.
                    // IMPORTANTE: na url, informar o parametro formato=json ao invés de formato=javascript.
                    const urlBuscaCEP = `http://cep.republicavirtual.com.br/web_cep.php?formato=json&cep=${cep}`;

                    console.log('url '+urlBuscaCEP);

                    // Realizar uma requisição HTTP GET na url.
                    // O primeiro parâmetro é a url.
                    // O segundo parâmetro é o callback, ou seja,
                    // uma função que vai ser executada quando os dados forem retornados.
                    // Essa função recebe um parâmetro que são os dados que a API retornou.
                    $.get(urlBuscaCEP, (resultadoCEP) => {

                        console.log('API retornou: ');
                        console.log(resultadoCEP);

                        if (resultadoCEP.resultado) 
                        {
                        // /$('#rua').val(`${resultadoCEP['tipo_logradouro']} ${resultadoCEP['logradouro']}`);
                            $('#i-enderecoresidencial').val(resultadoCEP.logradouro);
                            $('#i-bairroresidencial').val( resultadoCEP.bairro.substr(0, 19));
                            $('#i-cidaderesidencial').val(resultadoCEP.cidade.substr( 0, 19 ));
                            $('#i-ufresidencial').val(resultadoCEP.uf);
                        } 
                        else 
                        {
                            console.error('Erro ao carregar os dados do CEP.');
                        }
                    });

                }
            });

          
            $('#i-cpf').on('blur', () => 
            {
                var len = $('#i-cpf').val().length;

                
                if( len == 11 )
                {
                  console.log('pessoa fisica');
                    if ( is_cpf( $('#i-cpf').val() ) )    
                    {
                        console.log('ok');
                        $('#i-span-rg').text( 'Informe o numero do RG');
                        $('#i-lbl-rg').text( 'N° R.G.');
                        $('#i-pessoa').val('F');
                        $("#i-div-sexo").show();
                        $("#i-div-nacionalidade").show();
                        $("#i-div-estadocivil").show();
                    }
                    else
                    {
                        $('#i-cpf').val(''); 
                        
                            Swal.fire({
                            title: 'Erro CPF',
                            text: 'Informe corretamente o CPF',
                            icon: 'warning',
                            confirmButtonText: 'abortar'
                        });
                        $('#i-cpf').val('');

                    }
                }
                else
                if( len == 14 )
                {
                  console.log('pessoa jurídica');
                    if ( is_cnpj( $('#i-cpf').val() ) )    
                    {
                        $('#i-span-rg').text( 'Informe a Inscr. Estadual');
                        $('#i-lbl-rg').text( 'N° Inscr.Estadual');
                        $('#i-pessoa').val('J');
                        $("#i-div-sexo").hide();
                        $("#i-div-nacionalidade").hide();
                        $("#i-div-estadocivil").hide();
                     }
                    else
                    {
                        $('#i-cpf').val(''); 
                            Swal.fire({
                            title: 'Erro CNPJ',
                            text: 'Informe corretamente o CNPJ',
                            icon: 'warning',
                            confirmButtonText: 'abortar'
                        });
                        $('#i-cpf').val('');
       
                    }
                }
                else
                {
                    $('#i-cpf').val(''); 
                            Swal.fire({
                            title: 'Erro CPF/CNPJ',
                            text: 'Informe corretamente o CPF/CNPJ',
                            icon: 'warning',
                            confirmButtonText: 'abortar'
                    });
                    $('#i-cpf').val('');
                }

                clienteJaCadastrado();
                //}
            });               

            function clienteJaCadastrado()
            { 
                str = $("#i-cpf").val();
                var url = "{{ route('autocadastro.cliente.cpf') }}"+"/"+str;
                console.log(url);
                
                $.getJSON( url, function( data)
                {
                if ( data.IMB_CLT_NOME != '' )
                {
                    alert( 'Já há um cliente com este CPF -> '+str );
                    $("#i-cpf").val('');
                }
                });
            }            


            function onGravar()
            {

                if ( $("#i-jacadastrado").val() == 'S' )
                {
                    Swal.fire({
                            title: 'Já cadastrado',
                            text: 'Você já cadastrou e um email deve ter sido enviado pra você!',
                            icon: 'abort',
                            confirmButtonText: 'ok'
                        });
                    return false;
                }

                if( $("#i-cpf").val()  == '' )
                {
                    Swal.fire({
                            title: 'Inconsistência',
                            text: 'cpf em branco',
                            icon: 'abort',
                            confirmButtonText: 'ok'
                        });
                    return false;
                }


                if( $("#i-email").val() != $("#i-email2").val() )
                {
                    Swal.fire({
                            title: 'Inconsistência',
                            text: 'O Email não está em confirmade com a confirmação do email',
                            icon: 'abort',
                            confirmButtonText: 'ok'
                        });
                    return false;
                }

                var ltelefone = 'S';


                if ( $("#i-ddd1").val() == '' &&  $("#i-numero1").val() == '' )
                {
                    ltelefone = 'N';
                };
                if ( $("#i-ddd1").val() != ''  && $("#i-numero1").val() == '' ) 
                {
                    ltelefone = 'N';
                };
                if ( $("#i-ddd1").val() == ''  && $("#i-numero1").val() != '' ) 
                {
                    ltelefone = 'N';
                };
                if( $("#i-ddd2").val() == ''  &&  $("#i-numero2").val() != '' ) 
                {
                    ltelefone = 'N';
                };
                if( $("#i-ddd2").val() != ''  &&  $("#i-numero2").val() == '' )
                {

                    ltelefone = 'N';
                };


                if( ltelefone == 'N')
                {
                    Swal.fire({
                            title: 'Inconsistência',
                            text: 'Verifique os dados de telefones ',
                            icon: 'abort',
                            confirmButtonText: 'ok'
                        });
                    return false;

                }


                var atm = 
                {
                    IMB_IMB_ID : $("#I-IMB_IMB_ID").val(),
                    IMB_IMB_ID2 :$("#I-IMB_IMB_ID").val(),
                    IMB_IMB_IDMASTER : $("#I-IMB_IMB_ID").val(),
                    IMB_CLT_NOME : $("#i-nome").val(),
                    IMB_CLT_NOME : $("#i-nome").val(),
                    IMB_CLT_CPF : $("#i-cpf").val(),
                    IMB_CLT_RG : $("#i-rg").val(),
                    IMB_CLT_RGESTADO : $("#i-rg-orgao-uf").val(),
                    IMB_CLT_PESSOA : $("#i-pessoa").val(),
                    IMB_CLT_SEXO : $("#i-sexo").val(),
                    IMB_CLT_ESTADOCIVIL : $("#i-estadocivil").val(),
                    IMB_CLT_NACIONALIDADE : $("#i-nacionalidade").val(),
                    IMB_CLT_DATNAS : $("#i-datanascimento").val(),
                    IMB_CLT_RESENDCEP : $("#i-cepresidencial").val(),
                    IMB_CLT_RESEND : $("#i-enderecoresidencial").val(),
                    IMB_CLT_RESENDNUM : $("#i-enderecoresidencialnumero").val(),
                    IMB_CLT_RESENDCOM : $("#i-enderecoresidencialcomplemento").val(),
                    CEP_BAI_NOMERES : $("#i-bairroresidencial").val(),
                    CEP_CID_NOMERES : $("#i-cidaderesidencial").val(),
                    CEP_CID_NOMERES : $("#i-cidaderesidencial").val(),
                    CEP_UF_SIGLARES : $("#i-ufresidencial").val(),                                 
                    IMB_CLT_EMAIL : $("#i-email").val(),                                 
                }
                
                var url="{{route('autocadastro.salvar')}}";

                $.ajaxSetup(
                {
                  headers:
                  {
                      'X-CSRF-TOKEN': "{{csrf_token()}}"
                  }
                });

                $.ajax(
                {
                    url: url,
                    dataType: 'JSON',
                    type: 'post',
                    data: atm,
                    async:false,
                    success: function( data, textStatus, jQxhr )
                    {
                        var id = data.IMB_CLT_ID;
                        var email = data.IMB_CLT_EMAIL;

                        gravarTelefone( id );
//                        enviarEmail( email );
                        $("#i-btn-salvar").hide();
                        $("#i-jacadastrado").val('S');

                        enviarEmail();
                    },
                    error: function( data )
                    {
                        alert('erro');
                    }
                });


            }

            function gravarTelefone( id )
            {
  
                $.ajaxSetup({
                headers:
                {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
                });

                telefone = 
                {
                    IMB_TLF_ID_CLIENTE : id,
                    IMB_TLF_DDD : $("#i-ddd1").val(),
                    IMB_TLF_NUMERO : $("#i-numero1").val(),
                    IMB_TLF_TIPOTELEFONE : 'Celular'

                };

                var url = "{{ route('autocadastro.telefone.salvar')}}";

                $.ajax(
                {
                    url: url,
                    dataType: 'JSON',
                    type: 'post',
                    data: telefone,
                    async:false,
                    success: function( data, textStatus, jQxhr )
                    {

                    },
                    error: function()
                    {
       //                 alert('erro na gravacao do telefone');
                    }
                });
            }

            function enviarEmail( email )
            {

                url="{{route('autocadastro.email.self')}}/"+email;

                console.log('ulr '+url);

                $.ajaxSetup({
                headers:
                {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
                });                

                $.ajax(
                {
                    url: url,
                    dataType: 'JSON',
                    type: 'post',
                    async:false,
                    success: function( data, textStatus, jQxhr )
                    {

                    },
                    error: function()
                    {
                        alert('Erro envio email');
                    }
                });





            }

            function enviarEmail()
            {
                swal({
                    title: "Seus dados foram gravados!",
                    text:"Agora uma senha será enviada a seu email e você poderá ter acesso a:"+
                    " Informes, extratos, segundas-vidas de boletos, e outras opções"
                    });

                var url = "{{ route( 'email.enviar.senha')}}/"+$("#i-email").val();
                $.ajax(
                {
                    type: "get",
                    url: url,
                    dataType: "json",
                    context: this,      
                    async:false,              
                    success: function( data ) 
                    {

                        swal({
                            title: "Senha gerada!",
                            text:'Senha enviada para: '+$("#i-email").val()+'. Verifique sua caixa de entrada e acesse com a nova senha'
                            });
                        

                    },
                    error: function()
                    {
                        alert( 'Senha enviada para: '+$("#i-email").val()+'. Verifique sua caixa de entrada e acesse com a nova senha');
                    },
                    complete: function()
                    {
                        window.location.href = "http://siriussystem.com.br/sys";
                    }

                });



            }

            function pegarEmpresa()
            {
                var codigo = $("#I-IMB_IMB_CODIGO").val();

                url = "{{route('autocadastro.pegarempresa')}}/"+codigo;

                $.ajax(
                {
                    type: "get",
                    url: url,
                    dataType: "json",
                    context: this,      
                    async:false,              
                    success: function( data ) 
                    {

                        $("#I-IMB_IMB_ID").val( data.IMB_IMB_ID);

                    },
                    error: function()
                    {
                        $("#I-IMB_IMB_ID").val( 1 );
                    }

                });
            }




        </script>
    </body>

</html>