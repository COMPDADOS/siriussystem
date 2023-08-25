  @extends('layout.app')

@push('script')

@section('content')


<!-- BEGIN CONTENT -->
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <a href="/">Home</a>
      <i class="fa fa-circle"></i>
    </li>
    <li>
      <span>Lista de Clientes</span>
    </li>
  </ul>
  
</div>

<div class="row">
  <div class="col-md-12">
    <div class="tabbable-line boxless tabbable-reversed">
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <form action="{{ route('cliente.salvar') }}" method="post" id="i-form-cliente"  onsubmit="onGravar( this ); return false;" >
          @csrf
            <input type="hidden" id="i-numero-cliente" name="IMB_CLT_CODIGO" value="{{$cliente->IMB_CLT_ID}}">
            <input type="hidden" id="i-erros"  value="">
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
                <div class="form-body">
                  
                  <div class="row">
                    
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">Código</label>
                        <input type="text" name="IMB_CLT_ID" class="form-control"
                                  value="{{$cliente->IMB_CLT_ID}}"
                                  id="i-numero-cliente"
                                      readonly>
                      </div>
                    </div>
                    
                    <div class="col-md-5">
                      <div class="form-group">
                        <label class="control-label">Cadastrado por</label>
                        <input type="text" name="" class="form-control"
                                      readonly>
                      </div>
                    </div>
                    
                    <div class='col-md-2'>
                      <div class="form-group">
                        <label class="control-label" >Data Cadastro</label>
                        <div class='input-group date' id='datacadastro'>
                          <input type='date'  class="form-control" name="CIMB_CLT_DATACADASTRO"
                            value="{{$cliente->IMB_CLT_DATACADASTRO}}"
                            disabled>
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
                                      value="{{ date('d/m/Y', strtotime($cliente->IMB_CLT_DTHALTERACAO))}}" disabled>
                        </div>
                      </div>
                    </div>
                  </div> <!--row-->
                            
                  <div class="row">
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label" >Nome</label>
                        <input type="text" maxlength="40" name="CIMB_CLT_NOME" class="form-control" id="i-nome"
                                        placeholder="Nome completo"
                                        value="{{$cliente->IMB_CLT_NOME}}"
                                        style="font-family: Tahoma; font-size: 16px"
                                        required >
                      </div>
                    </div>
                    
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Pessoa</label>
                        <select name="CIMB_CLT_PESSOA" 
                          class="form-control" id="i-pessoa" required>
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
                        <select name="CIMB_CLT_ESTADOCIVIL" class="form-control" id="i-estado-civil" required>
                          <option value="S"
                                      {{ ($cliente->IMB_CLT_ESTADOCIVIL == 'S' ) ? 'selected' : null }}
                                      >Solteiro
                          </option>
                          
                          <option value="C"
                                    {{ ($cliente->IMB_CLT_ESTADOCIVIL == 'C' ) ? 'selected' : null }}
                                      >Casado
                          </option>
                          
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
                        <select name="CIMB_CLT_SEXO" class="form-control">
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
                                    style="font-family: Tahoma; font-size: 16px"
                                    required>
                                  <p id="cpfresponse"></p>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">RG/Insc. Estadual</label>
                        <input maxlength="20"name="CIMB_CLT_RG" type="text" class="form-control" placeholder="Preencher ./-"
                                      value="{{$cliente->IMB_CLT_RG}}"
                                      style="font-family: Tahoma; font-size: 16px" required>
                      </div>
                    </div>
                    
                    <div class="col-md-3" id="i-div-orgao">
                      <div class="form-group" >
                                  <label class="control-label">RG Orgão/UF</label>
                                  <input maxlength="7" name="CIMB_CLT_RGORGAO" type="text" class="form-control" value=
                                  "{{$cliente->IMB_CLT_RGORGAO}}">
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class='col-md-3'  id="i-div-data-nascimento">
                      <div class="form-group">
                        <label class="control-label" id="i-lbl-datanasc" >Data Nascimento</label>
                          <input type='date'  class="form-control" name="CIMB_CLT_DATNAS"
                                    value="{{$cliente->IMB_CLT_DATNAS}}"
                                  >
                      </div>
                    </div>
                    
                    <div class='col-md-3' id="i-div-nacionalidade">
                      <div class="form-group" >
                        <label class="control-label">Nacionalidade</label>
                        <input type='text'  class="form-control" name="CIMB_CLT_NACIONALIDADE"
                                    value="{{$cliente->IMB_CLT_NACIONALIDADE}}">
                      </div>
                    </div>
                    
                    <div class="col-md-2">
                      <label>
                        <input name="CIMB_CLT_LOCADOR"
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
                        <input maxlength="40" name="CIMB_CLT_RESEND"
                                    type="text" id="rua"class="form-control"
                                    value="{{$cliente->IMB_CLT_RESEND}}">
                      </div>
                    </div>
                    
                    <div class="col-md-2 ">
                      <div class="form-group">
                        <label>Número</label>
                        <input maxlength="10" name="CIMB_CLT_RESENDNUM"
                                    type="text" class="form-control"
                                    value="{{$cliente->IMB_CLT_RESENDNUM}}">
                      </div>
                    </div>

                    <div class="col-md-4 ">
                      <div class="form-group">
                        <label>Complemento</label>
                        <input maxlength="20" name="CIMB_CLT_RESENDCOM"
                                    type="text" class="form-control"
                                    value="{{$cliente->IMB_CLT_RESENDCOM}}">
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Cep</label>
                        <input maxlength="8" name="CIMB_CLT_RESENDCEP"
                                      type="number" id="cep" class="form-control"
                                      value="{{$cliente->IMB_CLT_RESENDCEP}}">
                      </div>
                    </div>
                    
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Bairro</label>
                        <input maxlength="20" name="CCEP_BAI_NOMERES"
                                      type="text" id="bairro" class="form-control"
                                      value="{{$cliente->CEP_BAI_NOMERES}}">
                      </div>
                    </div>
                    
                    <div class="col-md-5">
                      <div class="form-group">
                        <label>Cidade</label>
                        <input maxlength="20" name="CCEP_CID_NOMERES"  
                                    type="text" id="cidade" class="form-control"
                                    value="{{$cliente->CEP_CID_NOMERES}}">
                      </div>
                    </div>
                    
                    <div class="col-md-1">
                      <div class="form-group">
                                  <label>UF</label>
                                  <input  maxlength="2" name="CCEP_UF_SIGLARES"
                                    type="text" id="uf" class="form-control"
                                    value="{{$cliente->CEP_UF_SIGLARES}}">
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-12">
                      <div class="input-group">
                        <span class="input-group-addon input-circle-left">
                          <i class="fa fa-envelope"></i>
                        </span>
                        <input maxlength="100" name="CIMB_CLT_EMAIL" type="email"
                                    class="form-control input-circle-right"
                                    placeholder="Endereço de Email"
                                    value="{{$cliente->IMB_CLT_EMAIL}}" required>
                      </div>
                    </div>
                  </div>

                  <!-- Botões -->
                  <div class="form-actions right">
                    <button type="button" class="btn default " id="i-btn-cancelar" onClick="history.go(-1);">Cancelar</button>
                    <button type="submit" class="btn blue " id="i-btn-gravar">
                      <i class="fa fa-check"></i> Gravar
                    </button>
                  </div>
                </div><!--< FIM div class="form-body">-->
              </div> <!-- FIM <div class="portlet-body form">-->
            </div> <!-- fim quadro <div class="portlet box blue">-->


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
                        <input maxlength="40" name="CIMB_CLT_COMCOM"type="text" class="form-control"
                                    value="{{$cliente->IMB_CLT_COMCOM}}">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">Profissão</label>
                        <input maxlength="20" name="CIMB_CLT_PROFISSAO" type="text"  class="form-control"
                                    value="{{$cliente->IMB_CLT_PROFISSAO}}">
                      </div>
                    </div>
                  
                  </div>
                  
                  <div class="form-actions right">
                    <button type="button" class="btn default " id="i-btn-cancelar" onClick="history.go(-1);">Cancelar</button>
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
                          <input maxlength="40" name="CIMB_CLTCJG_NOME" type="text" class="form-control"
                                  value="{{$cliente->IMB_CLTCJG_NOME}}">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">CPF</label>
                        <input maxlength="14" name="CIMB_CLTCJG_CPF" type="text" id="icpfcjg"
                                    onkeydown="fMasc( this, mCPF )"
                                    class="form-control"
                                    value="{{$cliente->IMB_CLTCJG_CPF}}">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">RG</label>
                        <input  maxlength="20" name="CIMB_CLTCJG_RG" type="text" class="form-control"
                                    value="{{$cliente->IMB_CLTCJG_RG}}">
                      </div>
                    </div>
                    <div class="col-md-1">
                      <div class="form-group">
                        <label class="control-label">Orgão</label>
                        <input  maxlength="3" name="CIMB_CLTCJG_RGORGAO" type="text" class="form-control"
                                  value="{{$cliente->IMB_CLTCJG_RGORGAO}}">
                      </div>
                    </div>
                    <div class="col-md-1">
                      <div class="form-group">
                        <label class="control-label">UF</label>
                        <input  maxlength="2" name="CIMB_CLTCJG_RGESTADO" type="text" class="form-control"
                                  value="{{$cliente->IMB_CLTCJG_RGESTADO}}">
                      </div>
                    </div>
                    
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">Nacionalidade</label>]
                        <input  maxlength="15" name="CIMB_CLTCJG_NACIONALIDADE"
                                    type="text" class="form-control"
                                    value="{{$cliente->IMB_CLTCJG_NACIONALIDADE}}">
                      </div>
                    </div>
                  </div> <!-- row -->
                  <div class="row">
                    <div class='col-md-3'>
                      <div class="form-group">
                        <label class="control-label">Data Nascimento</label>
                        <input type='date'  class="form-control"
                                    name="CIMB_CLTCJG_DATANASCIMENTO"
                                    value="{{$cliente->IMB_CLTCJG_DATANASCIMENTO}}">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Sexo</label>
                        <select name="CIMB_CLTCJG_SEXO" class="form-control">
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
                        <input maxlength="20" name="CIMB_CLTCJG_PROFISSAO"
                                    type="text" class="form-control"
                                    value="{{$cliente->IMB_CLTCJG_PROFISSAO}}">
                      </div>
                    </div>
                  </div> <!-- row -->
                  
                  <div class="form-actions right">
                    <button type="button" class="btn default " id="i-btn-cancelar" onClick="history.go(-1);">Cancelar</button>
                    <button type="submit" class="btn blue " id="i-btn-gravar">
                                <i class="fa fa-check"></i> Gravar
                    </button>
                  </div>
                </div><!-- end form-body-->
              </div> <!--FIM Portlet-body form">-->
            </div> <!-- fimquadro -->

            <div class="portlet box blue" >
              <div class="portlet-body form">
                <div class="form-body">
                  <table  id="i-table-representantes" class="table table-striped table-bordered table-hover" >
                    <thead class="thead-dark">
                      <tr>
                        <th width="600" style="text-align:center"> Nome do Representante </th>
                        <th width="200" style="text-align:center"> Ações </th>
                      </tr>
                    </thead>
                    <tbody>
                      </tbody>
                  </table>
                    
                  <div class="table-footer" >
                    <div class="table-footer" >
                                <a  class="btn btn-sm btn-primary" 
                                role="button" onClick="modalRepresentante()" >
                                Adicionar Representante </a>
                                <!--data-toggle="modal" data-target="#modalFormaPagamento"-->
                    </div>                            
                  </div>
                </div><!-- end form-body-->
              <div> <!--FIM Portlet-body form">-->
            </div>
              
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
                          <textarea class="form-control" rows="3" 
                          name="IMB_CLT_OBSERVACAO" >{{$cliente->IMB_CLT_OBSERVACAO}}</textarea>
                      </div>
                    </div>
                  </div>
                    
                  <div class="form-actions right">
                    <button type="button" class="btn default " id="i-btn-cancelar" onClick="histo ry.go(-1);">Cancelar</button>
                    <button type="submit" class="btn blue " id="i-btn-gravar">
                        <i class="fa fa-check"></i> Gravar
                    </button>
                  </div>
                </div><!-- end form-body-->
              </div><!--FIM Portlet-body form">-->
            <div> 
              
              
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
                  <table  id="tbltelefone" class="table table-striped table-bordered table-hover" >
                    <thead class="thead-dark">
                      <tr >
                        <th width="40" style="text-align:center"> DDD </th>
                        <th width="150" style="text-align:center"> Número </th>
                        <th style="text-align:center"> Tipo </th>
                        <th width="200" style="text-align:center"> Ações </th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                    
                  <div class="table-footer" >
                                <a  class="btn btn-sm btn-primary" 
                                role="button" onClick="telefoneModal()" >
                                Adicionar Telefone </a>
                  </div>                            
                </div><!-- end form-body-->
              </div> <!--FIM Portlet-body form">-->
            </div>
              
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
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="tblanexos">
                      <thead>
                        <tr>
                          <th align="center" width="200"> Arquivo </th>
                          <th >Descrição</th>
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
                  </div>
                </div><!-- end form-body-->
              </div> <!--FIM Portlet-body form">-->
            </div>
          </form>
        </div> <!--class="tab-pane active" id="tab_1">-->
      </div><!--class="tab-content">-->
    </div><!--class="tabbable-line boxless tabbable-reversed">-->
  </div> <!--<div class="col-md-12">-->
</div> <!-- fim row unica -->

          <!-- BEGIN QUICK SIDEBAR -->

<a href="javascript:;" class="page-quick-sidebar-toggler">
  <i class="icon-login"></i>
</a>

<div class="page-quick-sidebar-wrapper" data-close-on-body-click="false">
</div>

      <div class="modal fade" id="modaltelefones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Adicionar  Telefone</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
      <!--        <form action="{{url('telefone/telefone/1')}}" method="get"> -->
              <input name="IMB_TLF_ID" type="hidden" class="form-control" id="i-id">

                <div class="row">
                  
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="ddd" class="col-form-label">DDD</label>
                      <input name="IMB_TLF_DDD" type="text" class="form-control" id="i-ddd" max="99" onkeypress="return isNumber(event)" onpaste="return false;"/>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="numero" class="col-form-label">Número</label>
                      <input name="IMB_TLF_NUMERO"  type="text" class="form-control" id="i-numero" onkeypress="return isNumber(event)" onpaste="return false;"/>
                    </div>
                  </div>

                  <div class="col-md-7">
                    <div class="form-group">
                      <label for="tipo" class="col-form-label">Tipo</label>
                      <input name="IMB_TLF_TIPOTELEFONE"  type="text" 
                      class="form-control" id="i-tipo" placeholder="Celular, recado, etc..">
                    </div>
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" onClick="telefoneSalvar()">Gravar</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
<!--              </form>-->
            </div>
          </div>
        </div>
      </div>

      <div class="modal" tabindex="-1" role="dialog" id="modalrepresentante">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <div class="portlet box blue">
                
                <div class="portlet-title">
                  <div class="caption">
                    <i class="fa fa-gift"></i>Representante do Locatário Pessoa Jurídica
                  </div>
                  
                  <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                  </div>
                </div>
              
                <div class="portlet-body">
                    <input type="hidden" id="i-imb-clt-id" name="IMB_CLT_IDMASTER" value="{{$cliente->IMB_CLT_ID}}">
                    <div class="form-body" >
      
                      <div class="row">
                        <div class="col-md-8">
                          <div class="form-group">
                            <label class="control-label">Digite abaixo a sugestão de nome</label>
                                <input type="text" id="i-str"  class="form-control">
                          </div>
                        </div>
                        <div class="col-md-1">
                          <div class="form-group">
                                <label class="control-label"></label>
                                <a class="btn btn-sm btn-primary" href="javascript:buscaIncremental()">
                                Carregar Sugestões</a>    
                          </div>
                        </div>
                      </div>

                      <div class="row"> 
                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Representante</label>
                              <select class="form-control" id="i-select-representante" name="IMB_CLT_ID">
                              </select>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" onClick="criarRepresentante()">Selecionar</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      


@endsection
@push('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>

<script>

  
  carregarRepresentantes();
  
  $('#i-pessoa').on('change', function () {

    var pessoa = $("#i-pessoa").val();
    $("#i-div-estado-civil").show();
    $("#i-div-sexo").show();
    $("#i-lbl-datanasc").html('Data Nascimento');
    if( pessoa == 'J') 
    {
      $("#i-div-estado-civil").hide();
      $("#i-div-sexo").hide();
      $("#i-lbl-datanasc").html('Data Abertura');
    }

  });
  
  
  $('#icpf').on('blur', () => 
    {
      var pessoa = $("#i-pessoa").val();
    if( pessoa == 'F') 
      {
      console.log('pessoa fisica');
      
      if ( is_cpf( $("#icpf").val() ) )    
      {
        console.log('ok');
      }
      else
      {
        $('#icpf').val(''); 
        alert('Erro nas informações do CPF');
  //        $('#icpf').focus();
        
//         alert('Erro de validação de CPF!');
        console.log('not ok');
        }
    }
  });

        // Método para consultar o CEP
 $('#cep').on('blur', () => {

  let token = document.head.querySelector('meta[name="csrf-token"]');
   if (token) {
      window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    } else {
      console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
  }

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
          $('#bairro').val( resultadoCEP.bairro.substr(0, 19));
          $('#cidade').val(resultadoCEP.cidade.substr( 0, 19 ));
          $('#uf').val(resultadoCEP.uf);
        } else {
          console.error('Erro ao carregar os dados do CEP.');
        }
      });

      // FIM NOVO CODIGO.
    }
  });

  //preencherClientes();
  carregarRepresentantes();
  telefoneCarregar()


  function carregarRepresentantes()
  { 
    str = $("#i-numero-cliente").val();
    var url = "{{ route('representante.carga') }}"+"/"+str;
      console.log(url);
    
    $.getJSON( url, function( data)
    {
      linha = "";
      $("#i-table-representantes>tbody").empty();
      for( nI=0;nI < data.length;nI++)
      {
        linha = 
                        '<tr>'+
                        '<td style="text-align:center valign="center">'+data[nI].IMB_CLT_NOME+'</td>' +
                        '<td style="text-align:center" valign="center"> '+
                              '<a href=javascript:apagarRepresentante('+data[nI].IMB_CLR_ID+') class="btn btn-sm btn-danger">Excluir</a> '+
                          '</td> ';

                        linha = linha +
                        '</tr>';
        $("#i-table-representantes").append( linha );
      }
    });
  }



  function apagarRepresentante( id )
  {
    if (confirm("Tem certeza que deseja tirar este representante?")) 
    {
      if ( id != '')
      {
        var url = "{{ route( 'representante.apagar' )}}/"+id;

        $.getJSON( url, function( data)
        {
          console.log(data);
        });
      }
      
      carregarRepresentantes();
    }
  }
  

  
  function modalRepresentante()
  {
    $("#modalrepresentante").modal('show');
  }

  function criarRepresentante()
  {
  //        console.log('$("#i-imb-clt-id").val()' + $("#i-numero-cliente").val() );
          //console.log('$("#i-select-representante").val()' + $("#i-select-representante").val() );
    
          $.ajaxSetup({
    headers:
    {
      'X-CSRF-TOKEN': "{{csrf_token()}}"
    }
  });
  
  if ( $("#i-select-representante").val() == '' )
    {
      alert('Selecione um representante!');
    }
    else
    {
      corimo = 
      {
        IMB_CLT_ID :  $("#i-select-representante").val(),
        IMB_CLT_IDMASTER : $("#i-numero-cliente").val(),

      };

      var url = "{{ route('representante.save')}}/"+$("#i-numero-cliente").val();

  //            console.log( corimo );
      $.post( url, corimo, function(data)
      {
      //console.log( data );
        $("#modalrepresentante").modal("hide");
        carregarRepresentantes();
      });
    }
  };  
      

  function buscaIncremental()
  {
    str = $("#i-str").val();
    var url = "{{ route('buscaclienteincremental') }}"+"/"+str;
    
    $.getJSON( url, function( data)
    {
      linha = "";
      $("#i-select-representante").empty();
      for( nI=0;nI < data.length;nI++)
      {
        linha = 
        '<option value="'+data[nI].IMB_CLT_ID+'">'+
        data[nI].IMB_CLT_NOME+"</option>";
        $("#i-select-representante").append( linha );
      }
      console.log( linha );
      console.log('busca incremenal');
    });
  }

  function telefoneModal()
  {

//    $("#i-numero-cliente").val('');
    $("#i-ddd").val('');
    $("#i-numero").val('');
    $("#i-tipo").val('');
    $("#modaltelefones").modal('show');
  }

    function telefoneCarregar()
  { 
    str = $("#i-numero-cliente").val();
    var url = "{{ route('telefone.carga') }}"+"/"+str;
    console.log( url ); 
    $.getJSON( url, function( data)
    {
      linha = "";
      $("#tbltelefone>tbody").empty();
      for( nI=0;nI < data.length;nI++)
      {
        linha = 
                        '<tr>'+
                        '<td style="text-align:center valign="center">'+data[nI].IMB_TLF_DDD+'</td>' +
                        '<td style="text-align:center valign="center">'+data[nI].IMB_TLF_NUMERO+'</td>' +
                        '<td style="text-align:center valign="center">'+data[nI].IMB_TLF_TIPOTELEFONE+'</td>' +
                        '<td style="text-align:center" valign="center"> '+
                              '<a href=javascript:telefoneApagar('+data[nI].IMB_TLF_ID+') class="btn btn-sm btn-danger">Excluir</a> '+
                          '</td> ';

                        linha = linha +
                        '</tr>';
        $("#tbltelefone").append( linha );
      }
    });
  }

  function telefoneApagar( id )
  {
    if (confirm("Tem certeza que deseja excluir este telefone?")) 
    {
      if ( id != '')
      {
        var url = "{{ route( 'telefone.apagar' )}}/"+id;
        $.getJSON( url, function( data)
        {
          console.log(data);
        });
        telefoneCarregar();
      }
    }
  }
  
  function telefoneSalvar()
  {
  
    $.ajaxSetup({
    headers:
    {
      'X-CSRF-TOKEN': "{{csrf_token()}}"
    }
  });
  
    if ( $("#i-ddd").val() == '' )  
    {
      alert('Informe um DDD!');
    }
    else
    if ( $("#i-numero").val() == '' )
    {
      alert('Informe um Numero de Telefone!');
    }
    else
    {
      telefone = 
      {
        IMB_TLF_ID_CLIENTE : $("#i-numero-cliente").val(),
        IMB_TLF_DDD : $("#i-ddd").val(),
        IMB_TLF_NUMERO : $("#i-numero").val(),
        IMB_TLF_TIPOTELEFONE : $("#i-tipo").val()

      };

      var url = "{{ route('telefone.salvar')}}/"+
      $("#i-numero-cliente").val()+'/'+
      $("#i-ddd").val()+'/'+
      $("#i-numero").val()+'/'+
      $("#i-tipo").val();
      

  //            console.log( corimo );
      $.post( url, telefone, function(data)
      {
      //console.log( data );
        $("#modaltelefones").modal("hide");
        telefoneCarregar();
      });
    }
  };  
      
  function carregarAnexos()
  {
    str = $("#i-numero-cliente").val();
    var url = "{{ route('clienteanexo.carga') }}"+"/"+str;
    $.getJSON( url, function( data)
    {
        linha = "";
        $("#tblanexos>tbody").empty();
        for( nI=0;nI < data.length;nI++)
        {
          linha = 
            '<tr>'+
            '<td style="text-align:center valign="center">'+data[ nI ].IMB_CLA_ARQUIVO+'</td>' +
            '<td style="text-align:center valign="center">'+data[ nI ].IMB_CLA_DESCRICAO+'</td>' +
            '</tr>';
          $("#tblanexos").append( linha );
        }
      });
    };

    carregarAnexos();


    function onGravar()
    {
     
      
      telefoneCarregar();
      if ( $("#tbltelefone>tbody>tr").length == 0 ) 
      {
        alert('É necessário no minimo um telefone!');
        return false;
      }

        //alert('erros '+nErros);
        frm.submit;


     
    }

</script>



@endpush