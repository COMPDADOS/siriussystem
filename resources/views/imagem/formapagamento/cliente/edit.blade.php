@extends('layout.app')

@push('script')

@section('content')
        <!-- BEGIN CONTENT -->
            <div class="page-bar">
              <ul class="page-breadcrumb">
                <li>
                  <a href="index.html">Home</a>
                  <i class="fa fa-circle"></i>
                </li>
                <li>
                  <span>Lista de Clientes</span>
                </li>
              </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <div class="row">
              <div class="col-md-12">
                <div class="tabbable-line boxless tabbable-reversed">
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">

                    <form name="form_cliente" id="i-form-cliente" class="horizontal-form">
                      <input type="hidden" id="i-numero-cliente" name="IMB_CLT_CODIGO" value="{{$cliente->IMB_CLT_ID}}">

                      <div class="portlet box blue">
                        <div class="portlet-title">
                          <div class="caption">
                            <i class="fa fa-gift"></i>Dados do Cliente
                          </div>
                          <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                          </div>
                        </div>

                        <div class="portlet-body form">
                          <!-- BEGIN FORM-->
                          <div class="form-body">

                            <div class="row">

                            <div class="col-md-2">
                                <div class="form-group">
                                  <label class="control-label">Código</label>
                                  <input type="text" name="IMB_CLT_ID" class="form-control"
                                  value="{{$cliente->IMB_CLT_ID}}"
                                  id="i-numero-cliente"
                                      readonly
                                  >
                                </div>
                              </div>

                              <div class="col-md-5">
                                <div class="form-group">
                                  <label class="control-label">Cadastrado por</label>
                                  <input type="text" name="" class="form-control"
                                      readonly
                                  >
                                </div>
                              </div>


                              <div class='col-md-2'>
                                <div class="form-group">
                                  <label class="control-label">Data Cadastro</label>
                                  <div class='input-group date' id='datacadastro'>
                                    <input type='date'  class="form-control" name="CIMB_CLT_DATACADASTRO"
                                    value="{{$cliente->IMB_CLT_DATACADASTRO}}"
                                    disabled
                                    >
                                  </div>
                                </div>
                              </div>

                              <div class='col-md-1'>
                              </div>

                              <div class='col-md-2'>
                                <div class="form-group">
                                  <label class="control-label">Última Alteração</label>
                                  <div class='input-group date' id='dataalteracao'>
                                    <input type='datetime'  class="form-control" name="CIMB_CLT_DTHALTERACAO"
                                      value="{{ date('d/m/Y', strtotime($cliente->IMB_CLT_DTHALTERACAO))}}" disabled
                                    >
                                  </div>
                                </div>
                              </div>
                            </div> <!--row-->

                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="control-label" >Nome</label>
                                  <input type="text" name="CIMB_CLT_NOME" class="form-control" id="i-nome"
                                        placeholder="Nome completo"
                                        value="{{$cliente->IMB_CLT_NOME}}"
                                        style="font-family: Tahoma; font-size: 16px">
                                </div>
                              </div>

                              <!--/span-->
                              <div class="col-md-3">
                                <div class="form-group">
                                <label class="control-label">Pessoa</label>
                                  <select name="CIMB_CLT_PESSOA"
                                  class="form-control" 
                                  id="i-pessoa">
                                    <option value="F"
                                    {{ ($cliente->IMB_CLT_PESSOA == 'F' ) ? 'selected' : null }}
                                     >Física
                                    </option>
                                    <option value="J"
                                      {{ ($cliente->IMB_CLT_PESSOA == 'J' ) ? 'selected' : null }}
                                     >Jurídica
                                    </option>
                                  </select>
                                </div>
                              </div>

                              <div class="col-md-3" id="i-div-estado-civil">
                                <div class="form-group">
                                  <label class="control-label">Estado Civil</label>
                                  <select name="CIMB_CLT_ESTADOCIVIL" class="form-control" id="i-estado-civil"
                                      >
                                    <option value="S"
                                      {{ ($cliente->IMB_CLT_ESTADOCIVIL == 'S' ) ? 'selected' : null }}
                                      >Solteiro
                                    </option>
                                    <option value="C"
                                    {{ ($cliente->IMB_CLT_ESTADOCIVIL == 'C' ) ? 'selected' : null }}
                                      >Casado</option>
                                    <option value="U"
                                      {{ ($cliente->IMB_CLT_ESTADOCIVIL == 'U' ) ? 'selected' : null }}
                                        echo "SELECTED"
                                      >União Estável
                                    </option>

                                    <option value="I"
                                    {{ ($cliente->IMB_CLT_ESTADOCIVIL == 'I' ) ? 'selected' : null }}
                                        echo "SELECTED"
                                      >Divorciado
                                    </option>

                                    <option value="V"
                                    {{ ($cliente->IMB_CLT_ESTADOCIVIL == 'V' ) ? 'selected' : null }}
                                      >Viúvo
                                    </option>
                                  </select>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-3"  id="i-div-sexo">
                                <div class="form-group">
                                  <label class="control-label">Sexo</label>
                                  <select name="CIMB_CLT_SEXO" class="form-control"
                                    >
                                    <option value="M"
                                    {{ ($cliente->IMB_CLT_SEXO == 'M' ) ? 'selected' : null }}
                                      >Masculino
                                    </option>
                                    <option value="F"
                                    {{ ($cliente->IMB_CLT_SEXO == 'F' ) ? 'selected' : null }}
                                      >Feminino
                                    </option>
                                  </select>
                                </div>
                              </div>

                              <div class="col-md-2">
                                <div class="form-group">
                                  <label class="control-label" id="i-lab-cpf">CPF/CNPJ</label>
                                  <input name="CIMB_CLT_CPF" id = "icpf"
                                    onkeydown="fMasc( this, mCNPJ )"
                                    type="text" class="form-control" placeholder="Somente números"
                                    value="{{$cliente->IMB_CLT_CPF}}"
                                    style="font-family: Tahoma; font-size: 16px">
                                  <p id="cpfresponse"></p>
                                </div>
                              </div>

                              <div class="col-md-3">
                                <div class="form-group">
                                  <label class="control-label">RG/Insc. Estadual</label>
                                    <input name="CIMB_CLT_RG" type="text" class="form-control" placeholder="Preencher ./-"
                                      value="{{$cliente->IMB_CLT_RG}}"
                                      style="font-family: Tahoma; font-size: 16px">
                                </div>
                              </div>

                              <div class="col-md-3" id="i-div-orgao">
                                <div class="form-group" >
                                  <label class="control-label">RG Orgão/UF</label>
                                  <input name="CIMB_CLT_RGORGAO" type="text" class="form-control" value=
                                  "{{$cliente->IMB_CLT_RGORGAO}}"
                                  >
                                </div>
                              </div>
                            </div>



                            <div class="row">
                              <div class='col-md-3'  id="i-div-data-nascimento">
                                <div class="form-group">
                                  <label class="control-label">Data Nascimento</label>
                                  <input type='date'  class="form-control" name="CIMB_CLT_DATNAS"
                                    value="{{$cliente->IMB_CLT_DATNAS}}"
                                  >
                                </div>
                              </div>

                              <div class='col-md-3' id="i-div-nacionalidade">
                                <div class="form-group" >
                                  <label class="control-label">Nacionalidade</label>
                                  <input type='text'  class="form-control" name="CIMB_CLT_NACIONALIDADE"
                                    value="{{$cliente->IMB_CLT_NACIONALIDADE}}"
                                  >
                                </div>
                              </div>

                              <div class="col-md-2">
                                <label>

                                <input name="CIMB_CLT_LOCADOR"]
                                    type="checkbox" class="icheck-primary" value="S" {{ ($cliente->IMB_CLT_LOCADOR == 'S' ) ? 'checked' : null }}
                                  > Locador
                                </label>
                              </div>

                              <div class="col-md-2">
                                <label>
                                <input name="CIMB_CLT_LOCATARIO"
                                    type="checkbox" class="icheck-primary" value="S"{{ ($cliente->IMB_CLT_LOCATARIO == 'S' ) ? 'checked' : null }}                                    
                                  > Locatário
                                </label>
                              </div>

                              <div class="col-md-2">
                                <label>
                                <input name="CIMB_CLT_FIADOR"
                                    type="checkbox" class="icheck-primary" value="S"
                                    {{ ($cliente->IMB_CLT_FIADOR == 'S' ) ? 'checked' : null }}
                                    > Fiador
                                </label>
                              </div>

                            </div>

                            <h3 class="form-section">Endereço Residencial</h3>
                            <div class="row">

                              <div class="col-md-6 ">
                                <div class="form-group">
                                  <label>Endereço</label>
                                  <input name="CIMB_CLT_RESEND"
                                    type="text" id="rua"class="form-control"
                                    value="{{$cliente->IMB_CLT_RESEND}}"
                                  >
                                </div>
                              </div>

                              <div class="col-md-2 ">
                                <div class="form-group">
                                  <label>Número</label>
                                  <input name="CIMB_CLT_RESENDNUM"
                                    type="text" class="form-control"
                                    value="{{$cliente->IMB_CLT_RESENDNUM}}"
                                  >
                                </div>
                              </div>

                              <div class="col-md-4 ">
                                <div class="form-group">
                                  <label>Complemento</label>
                                  <input name="CIMB_CLT_RESENDCOM"
                                    type="text" class="form-control"
                                    value="{{$cliente->IMB_CLT_RESENDCOM}}"
                                  >
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-2">
                                <div class="form-group">
                                  <label>Cep</label>
                                  <input name="CIMB_CLT_RESENDCEP"
                                      type="text" id="cep" class="form-control"
                                      value="{{$cliente->IMB_CLT_RESENDCEP}}"
                                  >
                                </div>
                              </div>

                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Bairro</label>
                                  <input name="CCEP_BAI_NOMERES"
                                      type="text" id="bairro" class="form-control"
                                      value="{{$cliente->CEP_BAI_NOMERES}}"
                                    >

                                </div>
                              </div>

                              <div class="col-md-5">
                                <div class="form-group">
                                  <label>Cidade</label>
                                  <input name="CCEP_CID_NOMERES"
                                    type="text" id="cidade" class="form-control"
                                    value="{{$cliente->CEP_CID_NOMERES}}"
                                  >
                                </div>
                              </div>

                              <div class="col-md-1">
                                <div class="form-group">
                                  <label>UF</label>
                                  <input  name="CCEP_UF_SIGLARES"
                                    type="text" id="uf" class="form-control"
                                    value="{{$cliente->CEP_UF_SIGLARES}}"
                                  >
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-12">
                                <div class="input-group">
                                  <span class="input-group-addon input-circle-left">
                                    <i class="fa fa-envelope"></i>
                                  </span>
                                  <input name="CIMB_CLT_EMAIL" type="email"
                                    class="form-control input-circle-right"
                                    placeholder="Endereço de Email"
                                    value="{{$cliente->CEP_UF_EMAIL}}"
                                  >
                                </div>
                              </div>
                            </div>


                            <!-- Botões -->
                            <div class="form-actions right">
                              <button type="cancel" class="btn default " id="i-btn-cancelar">Cancelar</button>
                              <button type="submit" class="btn blue " id="i-btn-gravar">
                                <i class="fa fa-check"></i> Gravar
                              </button>
                            </div>
                          </div>
                        </div>
                      </div> <!-- fim quadro -->


                      <div class="portlet box blue" >
                        <div class="portlet-title">
                          <div class="caption">
                            <i class="fa fa-gift"></i>Dados Profissionais
                          </div>
                          <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                          </div>
                        </div>

                        <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                          <div class="form-body" id="i-div-dados-profissioanis">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="control-label">Local de trabalho</label>
                                  <input name="CIMB_CLT_COMCOM"type="text" class="form-control"
                                    value="{{$cliente->IMB_CLT_COMCOM}}"
                                  >
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="control-label">Profissão</label>
                                  <input name="CIMB_CLT_PROFISSAO" type="text"  class="form-control"
                                    value="{{$cliente->IMB_CLT_PROFISSAO}}"
                                  >
                                </div>
                              </div>
                            </div>

                            <!-- Botões -->
                            <div class="form-actions right">
                              <button type="cancel" class="btn default " id="i-btn-cancelar">Cancelar</button>
                              <button type="submit" class="btn blue " id="i-btn-gravar">
                                <i class="fa fa-check"></i> Gravar
                              </button>
                            </div>
                          </div>
                        </div>
                      </div> <!-- fim quadro -->

                      <div class="portlet box blue" >

                        <div class="portlet-title">
                          <div class="caption">
                            <i class="fa fa-gift"></i> Dados do Conjuge
                          </div>
                          <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                          </div>
                        </div>

                        <div class="portlet-body form">

                          <div class="form-body" id="i-div-conjuge">

                            <div class="row">

                              <div class="col-md-4">
                                <div class="form-group">
                                  <label class="control-label">Nome</label>
                                  <input name="CIMB_CLTCJG_NOME" type="text" class="form-control"
                                  value="{{$cliente->IMB_CLTCJG_NOME}}"
                                  >
                                </div>
                              </div>

                              <div class="col-md-2">
                                <div class="form-group">
                                  <label class="control-label">CPF</label>
                                  <input name="CIMB_CLTCJG_CPF" type="text" id="icpfcjg"
                                    onkeydown="fMasc( this, mCPF )"
                                    class="form-control"
                                    value="{{$cliente->IMB_CLTCJG_CPF}}"
                                    >
                                </div>
                              </div>

                              <div class="col-md-2">
                                <div class="form-group">
                                  <label class="control-label">RG</label>
                                  <input  name="CIMB_CLTCJG_RG" type="text" class="form-control"
                                    value="{{$cliente->IMB_CLTCJG_RG}}"
                                  >
                                </div>
                              </div>

                              <div class="col-md-1">
                                <div class="form-group">
                                  <label class="control-label">Orgão</label>
                                  <input  name="CIMB_CLTCJG_RGORGAO" type="text" class="form-control"
                                  value="{{$cliente->IMB_CLTCJG_RGORGAO}}"
                                    >
                                </div>
                              </div>

                              <div class="col-md-1">
                                <div class="form-group">
                                  <label class="control-label">UF</label>
                                  <input  name="CIMB_CLTCJG_RGESTADO" type="text" class="form-control"
                                  value="{{$cliente->IMB_CLTCJG_RGESTADO}}"
                                  >
                                </div>
                              </div>

                              <div class="col-md-2">
                                <div class="form-group">
                                  <label class="control-label">Nacionalidade</label>]
                                  <input  name="CIMB_CLTCJG_NACIONALIDADE"
                                    type="text" class="form-control"
                                    value="{{$cliente->IMB_CLTCJG_NACIONALIDADE}}"
                                  >
                                </div>
                              </div>
                            </div> <!-- row -->


                            <div class="row">
                              <div class='col-md-3'>
                                <div class="form-group">
                                  <label class="control-label">Data Nascimento</label>
                                  <input type='date'  class="form-control"
                                    name="CIMB_CLTCJG_DATANASCIMENTO"
                                    value="{{$cliente->IMB_CLTCJG_DATANASCIMENTO}}"
                                  >
                                </div>
                              </div>


                              <div class="col-md-3">
                                <div class="form-group">
                                  <label class="control-label">Sexo</label>
                                  <select name="CIMB_CLTCJG_SEXO" class="form-control"
                                  >
                                    <option value="M"
                                    {{ ($cliente->IMB_CLTCJG_SEXO == 'M' ) ? 'selected' : null }}
                                      >Masculino
                                    </option>
                                    <option value="F"
                                    {{ ($cliente->IMB_CLTCJG_SEXO == 'F' ) ? 'selected' : null }}
                                    >Feminino
                                    </option>
                                  </select>
                                </div>
                              </div>

                              <div class="col-md-3">
                                <div class="form-group">
                                  <label class="control-label">Profissão</label>
                                  <input name="CIMB_CLTCJG_PROFISSAO"
                                    type="text" class="form-control"
                                    value="{{$cliente->IMB_CLTCJG_PROFISSAO}}"
                                  >
                                </div>
                              </div>
                            </div>


                            <!-- Botões -->
                            <div class="form-actions right">
                              <button type="cancel" class="btn default " id="i-btn-cancelar">Cancelar</button>
                              <button type="submit" class="btn blue " id="i-btn-gravar">
                                <i class="fa fa-check"></i> Gravar
                              </button>
                            </div>
                          </div><!-- end form-body-->
                        </div> <!--FIM Portlet-body form">-->


                        <div class="portlet box blue">
                        <div class="portlet-title">
                          <div class="caption">
                            <i class="fa fa-gift"></i>Representantes Legais
                          </div>
                          <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                          </div>
                        </div>

                        <div class="portlet-body form">
                          <div class="form-body">

                          <table  id="i-table-representantes" class="table table-striped table-bordered table-hover" >
                              <thead class="thead-dark">
                                <tr >
                                  <th width="600" style="text-align:center"> Nome do Representante </th>
                                  <th width="200" style="text-align:center"> Ações </th>
                                </tr>
                              </thead>
                              <tbody>

        
                              </tbody>
                            </table>

                            <div class="table-footer" >

                              <button style="font-family: Tahoma; font-size: 16px" type="button" class="btn btn-primary glyphicon glyphicon-insert " 
                                        data-toggle="modal" data-target="#modalRepInsert"
                                        data-whateveridmaster="{{$cliente->IMB_CLT_ID}}"                                        
                                        >Novo Representante</button>
                            </div>

                          </div><!-- end form-body-->

                        <div> <!--FIM Portlet-body form">-->

                        <div class="portlet box blue">
                        <div class="portlet-title">
                          <div class="caption">
                            <i class="fa fa-gift"></i>Observações Diversas / Observações de Negociação
                          </div>
                          <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                          </div>
                        </div>

                        <div class="portlet-body form">

                          <div class="form-body">

                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label class="control-label">Descreva a Observação</label>
                                  <textarea class="form-control" rows="3" name="IMB_CLT_OBSERVACAO"></textarea>
                                </div>
                              </div>
                            </div>

                            <!-- Botões -->
                            <div class="form-actions right">
                              <button type="cancel" class="btn default " id="i-btn-cancelar">Cancelar</button>
                              <button type="submit" class="btn blue " id="i-btn-gravar">
                                <i class="fa fa-check"></i> Gravar
                              </button>
                            </div>
                          </div>

                          </div><!-- end form-body-->

                        <div> <!--FIM Portlet-body form">-->

                        <div class="portlet box blue">
                        <div class="portlet-title">
                          <div class="caption">
                            <i class="fa fa-gift"></i>Telefones
                          </div>
                          <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                          </div>
                        </div>

                        <div class="portlet-body form">

                          <div class="form-body">

                          <table  id="telefone" class="table table-striped table-bordered table-hover" >
                              <thead class="thead-dark">
                                <tr >
                                  <th width="40" style="text-align:center"> DDD </th>
                                  <th width="150" style="text-align:center"> Número </th>
                                  <th style="text-align:center"> Tipo </th>
                                  <th width="200" style="text-align:center"> Ações </th>
                                </tr>
                              </thead>
                              <tbody>
                              <!--
                                @foreach( $telefones as $telefone )
                                  <tr>
                                    <td style="text-align:center">{{$telefone->IMB_TLF_DDD}}</td>
                                    <td style="text-align:center">{{$telefone->IMB_TLF_NUMERO}}</td>
                                    <td style="text-align:center">{{$telefone->IMB_TLF_TIPOTELEFONE}}</td>
                                    <td style="text-align:center">                                         
                                    <button type="button" class="btn btn-danger glyphicon glyphicon-trash " 
                                        data-toggle="modal" data-target="#modalTelefonesDelete" 
                                        data-whatever="{{$telefone->IMB_TLF_ID}}"
                                        data-whateverddd="{{$telefone->IMB_TLF_DDD}}"
                                        data-whatevernumero="{{$telefone->IMB_TLF_NUMERO}}"
                                        data-whatevertipo="{{$telefone->IMB_TLF_TIPOTELEFONE}}"
                                        data-whateverprocesso="delete"
                                        ></button>

                                        <button type="button" class="btn btn-primary glyphicon glyphicon-pencil " 
                                        data-toggle="modal" data-target="#modalTelefones" 
                                        data-whatever="{{$telefone->IMB_TLF_ID}}"
                                        data-whateverddd="{{$telefone->IMB_TLF_DDD}}"
                                        data-whatevernumero="{{$telefone->IMB_TLF_NUMERO}}"
                                        data-whatevertipo="{{$telefone->IMB_TLF_TIPOTELEFONE}}"
                                        data-whateverprocesso="edit"
                                        ></button>
                                    </td>
                                  </tr>
                                @endforeach
                                -->
        
                              </tbody>
                            </table>

                            <div class="table-footer" >

                              <button style="font-family: Tahoma; font-size: 16px" type="button" class="btn btn-primary glyphicon glyphicon-insert " 
                                        data-toggle="modal" data-target="#modalTelefonesInsert"
                                        data-whatever=""
                                        >Novo Telefone</button>
                            </div>


                          </div>
                          <!-- end form-body-->

                        <div> <!--FIM Portlet-body form">-->

                        <div class="portlet box blue">
                          <div class="portlet-title">
                            <div class="caption">
                              <i class="fa fa-gift"></i>Arquivos Anexos
                            </div>
                            <div class="tools">
                              <a href="javascript:;" class="collapse"> </a>
                            </div>
                          </div>

                          <div class="portlet-body form">
                            <div class="form-body">

                              <div class="row">
                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                  <thead>
                                    <tr>
                                    <th align="center" width="600"> Arquivo </th>
                                    <th width="100"> </th>
                                    <th width="100"> </th>
                                    </tr>
                                  </thead>

                                  <tbody>
                                  </tbody>
                                </table>
                              </div>


                              <div class="row">
                                  <div class="col-md-8">
                                    <button type="submit" name="enviar"
                                      formaction="uploadcliente/index.php?ncliente=$nclientepesquisa">Anexar Arquivos
                                    </button>
                                  </div>
                              <div>
                            </div>
                          </div><!-- end form-body-->
                        <div> <!--FIM Portlet-body form">-->

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
          <!-- BEGIN QUICK SIDEBAR -->
          <a href="javascript:;" class="page-quick-sidebar-toggler">
            <i class="icon-login"></i>
          </a>
          <div class="page-quick-sidebar-wrapper" data-close-on-body-click="false">
          </div>
          <!-- END QUICK SIDEBAR -->
        </div>
      </div>

      <div class="modal fade" id="modalTelefones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Alterar o Telefone</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{url('telefone/telefone/1')}}" method="get"> 
              <input name="IMB_TLF_ID" type="hidden" class="form-control" id="i-id">

                <div class="form-group">
                  <label for="ddd" class="col-form-label">DDD</label>
                  <input name="IMB_TLF_DDD" type="number" class="form-control" id="i-ddd">
                </div>
                <div class="form-group">
                  <label for="numero" class="col-form-label">Número</label>
                  <input name="IMB_TLF_NUMERO"  type="number" class="form-control" id="i-numero">
                </div>
                <div class="form-group">
                  <label for="tipo" class="col-form-label">Tipo</label>
                  <input name="IMB_TLF_TIPOTELEFONE"  type="text" class="form-control" id="i-tipo">
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary" id='i-save'>Salvar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalTelefonesDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Apagar o Telefone</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{url('telefone/telefone/apagar/1')}}" method="get"> 
              <input name="IMB_TLF_ID" type="hidden" class="form-control" id="i-id">

                <div class="form-group">
                  <label for="ddd" class="col-form-label">DDD</label>
                  <input name="IMB_TLF_DDD" type="number" class="form-control" id="i-ddd">
                </div>
                <div class="form-group">
                  <label for="numero" class="col-form-label">Número</label>
                  <input name="IMB_TLF_NUMERO"  type="number" class="form-control" id="i-numero">
                </div>
                <div class="form-group">
                  <label for="tipo" class="col-form-label">Tipo</label>
                  <input name="IMB_TLF_TIPOTELEFONE"  type="text" class="form-control" id="i-tipo">
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-danger" id='i-save'>Excluir</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalTelefonesInsert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Novo Telefone</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{url('telefone/telefone')}}" method="get"> 
              <input name="IMB_TLF_ID_CLIENTE" type="hidden" class="form-control" id="i-id">

                <div class="form-group">
                  <label for="ddd" class="col-form-label">DDD</label>
                  <input name="IMB_TLF_DDD" type="number" class="form-control" id="i-ddd">
                </div>
                <div class="form-group">
                  <label for="numero" class="col-form-label">Número</label>
                  <input name="IMB_TLF_NUMERO"  type="number" class="form-control" id="i-numero">
                </div>
                <div class="form-group">
                  <label for="tipo" class="col-form-label">Tipo</label>
                  <input name="IMB_TLF_TIPOTELEFONE"  type="text" class="form-control" id="i-tipo">
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary" id='i-save'>Salvar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      
      <div class="modal fade" id="modalRepDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Desvinculando um Representante</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{url('clienterepresentante/clienterepresentante/apagar/1')}}" method="get"> 
              <input name="IMB_CLR_ID" type="hidden" class="form-control" id="i-id">

                <div class="form-group">
                  <label for="numero" class="col-form-label"
                  style="font-family: Tahoma; font-size: 16px">Nome</label>
                  <input name="IMB_CLT_NOME"  type="text" class="form-control" id="i-nome" readonly>
                </div>


                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class=" btn btn-danger" id='i-save'>Desvincular</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>


      <div class="modal fade" id="modalRepInsert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Incluir um Representante</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{url('clienterepresentante/clienterepresentante')}}" method="get"> 
                <input name="IMB_CLT_IDMASTER" type="hidden" class="form-control" id="i-idmaster">

                <div class="form-group">

                  <select id="i-select-cliente" class="form-control" name="IMB_CLT_ID" style="width:400px">
                  </select>
                </div>


                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class=" btn btn-primary" id='i-save'>Vincular</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>


@endsection
@push('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script>
                                    
                                    $('#modalTelefones').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Botão que acionou o modal
    var id = button.data('whatever') // Extrai informação dos atributos data-*
    var ddd = button.data('whateverddd') // Extrai informação dos atributos data-*
    var numero = button.data('whatevernumero') // Extrai informação dos atributos data-*
    var tipo = button.data('whatevertipo') // Extrai informação dos atributos data-*


    // Se necessário, você pode iniciar uma requisição AJAX aqui e, então, fazer a atualização em um callback.
    // Atualiza o conteúdo do modal. Nós vamos usar jQuery, aqui. No entanto, você poderia usar uma biblioteca de data binding ou outros métodos.
    var modal = $(this)

    modal.find('.modal-title').text('Alterando o Telefone')
    modal.find('#i-id').val(id)
    modal.find('#i-ddd').val(ddd)
    modal.find('#i-numero').val(numero)
    modal.find('#i-tipo').val(tipo)
  })

                                    
  $('#modalTelefonesDelete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Botão que acionou o modal
    var id = button.data('whatever') // Extrai informação dos atributos data-*
    var ddd = button.data('whateverddd') // Extrai informação dos atributos data-*
    var numero = button.data('whatevernumero') // Extrai informação dos atributos data-*
    var tipo = button.data('whatevertipo') // Extrai informação dos atributos data-*


    // Se necessário, você pode iniciar uma requisição AJAX aqui e, então, fazer a atualização em um callback.
    // Atualiza o conteúdo do modal. Nós vamos usar jQuery, aqui. No entanto, você poderia usar uma biblioteca de data binding ou outros métodos.
    var modal = $(this)

    modal.find('.modal-title').text('EXCLUINDO o Telefone')
    modal.find('#i-id').val(id)
    modal.find('#i-ddd').val(ddd)
    modal.find('#i-numero').val(numero)
    modal.find('#i-tipo').val(tipo)
  })
                                    
  $('#modalTelefonesInsert').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget) // Botão que acionou o modal
    var idCliente = button.data('whatever') // Extrai informação dos atributos data-*


    // Se necessário, você pode iniciar uma requisição AJAX aqui e, então, fazer a atualização em um callback.
    // Atualiza o conteúdo do modal. Nós vamos usar jQuery, aqui. No entanto, você poderia usar uma biblioteca de data binding ou outros métodos.
    var modal = $(this)

    modal.find('.modal-title').text('Incluindo um novo Telefone')
    modal.find('#i-id').val(idCliente)
    modal.find('#i-ddd').val('')
    modal.find('#i-numero').val('')
    modal.find('#i-tipo').val('')
  })

              
  $('#modalRepDelete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Botão que acionou o modal
    var id = button.data('whatever') // Extrai informação dos atributos data-*
    var nome = button.data('whatevernome') // Extrai informação dos atributos data-*
    
    // Se necessário, você pode iniciar uma requisição AJAX aqui e, então, fazer a atualização em um callback.
    // Atualiza o conteúdo do modal. Nós vamos usar jQuery, aqui. No entanto, você poderia usar uma biblioteca de data binding ou outros métodos.
    var modal = $(this)

    modal.find('.modal-title').text('Desvinculando um Representante')
    modal.find('#i-id').val(id)
    modal.find('#i-nome').val(nome)
  })
              
  $('#modalRepDelete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Botão que acionou o modal
    var id = button.data('whatever') // Extrai informação dos atributos data-*
    var nome = button.data('whatevernome') // Extrai informação dos atributos data-*
    
    // Se necessário, você pode iniciar uma requisição AJAX aqui e, então, fazer a atualização em um callback.
    // Atualiza o conteúdo do modal. Nós vamos usar jQuery, aqui. No entanto, você poderia usar uma biblioteca de data binding ou outros métodos.
    var modal = $(this)

    modal.find('.modal-title').text('Desvinculando um Representante')
    modal.find('#i-id').val(id)
    modal.find('#i-nome').val(nome)
  })

  
              
  $('#modalRepInsert').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Botão que acionou o modal
    var idmaster = button.data('whateveridmaster') // Extrai informação dos atributos data-*
    
    // Se necessário, você pode iniciar uma requisição AJAX aqui e, então, fazer a atualização em um callback.
    // Atualiza o conteúdo do modal. Nós vamos usar jQuery, aqui. No entanto, você poderia usar uma biblioteca de data binding ou outros métodos.
    var modal = $(this)

    modal.find('.modal-title').text('Vinculando um Representante')
    modal.find('#i-idmaster').val(idmaster)

  })


        function preencherClientes()
        {

            $.getJSON( '/cliente/carga', function( data )
            {
              nId = $("#idmaster").val();

                $("#i-select-cliente").empty();
                    for( nI=0;nI < data.length;nI++)
                    {
                        linha = 
                        '<option value="'+data[nI].IMB_CLT_ID+'">'+
                            data[nI].IMB_CLT_NOME;
                        linha = linha + "</option>";
                            $("#i-select-cliente").append( linha );
                        
                    }

                $("#i-select-cliente").val( nId );


            });
            
        }

/*        $('#i-select-cliente').select2(
        {

        });

*/
        preencherClientes();
        carregarRepresentantes();


        function carregarRepresentantes()
        {
            str = $("#i-numero-cliente").val();
            console.log(str);
            $.getJSON( '/representantes/'+str, function( data)
            {
                linha = "";
                $("#i-table-representantes>tbody").empty();
                for( nI=0;nI < data.length;nI++)
                {
                    linha = 
                        '<tr>'+
                        '<td style="text-align:center valign="center">'+data[nI].IMB_CLT_NOME+'</td>' +
                        '<td style="text-align:center" valign="center"> '+
                            '<a href="#" class="btn btn-sm btn-primary">Editar</a> '+
                            '<a href=javascript:apagarRepresentante('+data[nI].IMB_CLT_ID+') class="btn btn-sm btn-danger">Excluir</a> '+
                          '</td> ';

                        linha = linha +
                        '</tr>';
                    
                    $("#i-table-representantes").append( linha );
                        
                }
                
            });

        }

        function apagarRepresentante( id )
        {
            if (confirm("Tem certeza que deseja desvincular este representante?")) 
            {
    
                $.ajax(
                    {
                        type: "delete",
//                        url: "/api/imagem/"+id,
                        context: this,
                        success: function(){
                          carregarRepresentantes();
            
                        },
                        error: function( error ){
                            console.log(error);
                        }

                    }
                );
            }

        }
 // Método para consultar o CEP
 $('#cep').on('blur', () => {
    if ($.trim($('#cep').val()) !== '') {
      $('#mensagem').html('(Aguarde, consultando CEP ...)');

      // NOVO CODIGO =============================================

      // Guardar o CEP do input.
      const cep = $('#cep').val();

      // Construir a url com o CEP do input.
      // IMPORTANTE: na url, informar o parametro formato=json ao invés de formato=javascript.
      const urlBuscaCEP = `http://cep.republicavirtual.com.br/web_cep.php?formato=json&cep=${cep}`;

      // Realizar uma requisição HTTP GET na url.
      // O primeiro parâmetro é a url.
      // O segundo parâmetro é o callback, ou seja,
      // uma função que vai ser executada quando os dados forem retornados.
      // Essa função recebe um parâmetro que são os dados que a API retornou.
      $.get(urlBuscaCEP, (resultadoCEP) => {
        console.log('API retornou: ');
        console.log(resultadoCEP);

        if (resultadoCEP.resultado) {
          // /$('#rua').val(`${resultadoCEP['tipo_logradouro']} ${resultadoCEP['logradouro']}`);
          $('#tipologradouro').val(resultadoCEP.tipo_logradouro);
          $('#rua').val(resultadoCEP.logradouro);
          $('#bairro').val(resultadoCEP.bairro);
          $('#cidade').val(resultadoCEP.cidade);
          $('#uf').val(resultadoCEP.uf);
        } else {
          console.error('Erro ao carregar os dados do CEP.');
        }
      });

      // FIM NOVO CODIGO.
    }
  });



</script>



@endpush