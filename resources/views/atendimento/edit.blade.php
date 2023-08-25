@extends('layout.app')
@push('script')

@section('scripttop')

<style>
  .div-center
    {
      text-align: center;
    }
</style>
@endsection

@section('content')


<!-- BEGIN CONTENT -->
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <a href="{{route('home')}}">Home</a>
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
          <form id="i-form-cliente">
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
                        <input type="text" class="form-control"
                        value="{{$id}}" id="I-IMB_CLT_ID" readonly>
                        <input type="hidden" id="i-readonly" value = "{{$readonly}}" >
                      </div>
                    </div>
                    
                    <div class="col-md-5">
                      <div class="form-group">
                        <label class="control-label">Cadastrado por</label>
                        <input type="text" class="form-control"
                        id="I-IMB_CLT_NOMEINCLUSAO" readonly>
                      </div>
                    </div>
                    
                    <div class='col-md-2'>
                      <div class="form-group">
                        <label class="control-label" >Data Cadastro</label>
                        <div class='input-group date' >
                          <input type='date'  class="form-control" disabled
                          id='I-IMB_CLT_DATACADASTRO'>
                        </div>
                      </div>
                    </div>
                    
                    <div class='col-md-1'>
                    </div>
                    
                    <div class='col-md-2'>
                      <div class="form-group">
                        <label class="control-label">Última Alteração</label>
                        <div class='input-group date' >
                          <input type='text'  class="form-control"  disabled
                          id='I-IMB_CLT_DTHALTERACAO'>
                        </div>
                      </div>
                    </div>
                  </div> <!--row-->
                            
                  <div class="row">
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label" >Nome</label>
                        <input type="text" maxlength="40" class="form-control" id="I-IMB_CLT_NOME"
                                        placeholder="Nome completo"
                                        style="font-family: Tahoma; font-size: 16px"
                                        required >
                      </div>
                    </div>
                    
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Pessoa</label>
                        <select id="I-IMB_CLT_PESSOA" 
                          class="form-control" required>
                        </select>
                      </div>
                    </div>
                    
                    <div class="col-md-3" id="i-div-estado-civil">
                      <div class="form-group">
                        <label class="control-label">Estado Civil</label>
                        <select id="I-IMB_CLT_ESTADOCIVIL" class="form-control"  required>
                        </select>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-2"  id="i-div-sexo">
                      <div class="form-group">
                        <label class="control-label">Sexo</label>
                        <select id="I-IMB_CLT_SEXO" class="form-control">
                        </select>
                      </div>
                    </div>
                    
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label" id="i-lab-cpf">CPF/CNPJ</label>
                        <input id="I-IMB_CLT_CPF" onkeydown="fMasc( this, mCNPJ )"
                                    type="text" class="form-control" placeholder="Somente números"
                                    style="font-family: Tahoma; font-size: 16px"
                                    required>
                                  <p id="cpfresponse"></p>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">RG/Insc. Estadual</label>
                        <input maxlength="20"id="I-IMB_CLT_RG" type="text" class="form-control" 
                            placeholder="Preencher ./-"
                            style="font-family: Tahoma; font-size: 16px" required>
                      </div>
                    </div>
                    
                    <div class="col-md-3" id="i-div-orgao">
                      <div class="form-group" >
                                  <label class="control-label">RG Orgão/UF</label>
                                  <input maxlength="7" id="I-IMB_CLT_RGORGAO" type="text" class="form-control" >
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class='col-md-3'  id="i-div-data-nascimento">
                      <div class="form-group">
                        <label class="control-label" >Data Nascimento</label>
                          <input type='date'  class="form-control" id="I-IMB_CLT_DATANASCIMENTO">
                      </div>
                    </div>
                    
                    <div class='col-md-3' id="i-div-nacionalidade">
                      <div class="form-group" >
                        <label class="control-label">Nacionalidade</label>
                        <input type='text'  class="form-control" id="I-IMB_CLT_NACIONALIDADE">
                      </div>
                    </div>
                    
                    <div class="col-md-2">
                      <div id="i-div-locador" class="div-center">
                      </div>
                      
                      <div id="i-div-locatario" class="div-center">
                      </div>

                      <div id="i-div-fiador" class="div-center">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div id="i-div-precadastro" class="div-center">
                      </div>
                    </div>

                  </div>
                  
                  <h3 class="form-section">Endereço Residencial</h3>
                  
                  <div class="row">
                    <div class="col-md-6 ">
                      <div class="form-group">
                        <label>Endereço</label>
                        <input maxlength="40" id="I-IMB_CLT_RESEND"
                                    type="text" class="form-control">
                      </div>
                    </div>
                    
                    <div class="col-md-2 ">
                      <div class="form-group">
                        <label>Número</label>
                        <input maxlength="10" id="I-IMB_CLT_RESENDNUM"
                                    type="text" class="form-control">
                      </div>
                    </div>

                    <div class="col-md-4 ">
                      <div class="form-group">
                        <label>Complemento</label>
                        <input maxlength="20" name="I-IMB_CLT_RESENDCOM"
                                    type="text" class="form-control">
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Cep</label>
                        <input maxlength="8" name="I-IMB_CLT_RESENDCEP"
                                      type="number" id="cep" class="form-control">
                      </div>
                    </div>
                    
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Bairro</label>
                        <input maxlength="20" id="I-CEP_BAI_NOMERES"
                                      type="text" class="form-control">
                      </div>
                    </div>
                    
                    <div class="col-md-5">
                      <div class="form-group">
                        <label>Cidade</label>
                        <input maxlength="20" id="I-CEP_CID_NOMERES"
                                    type="text" id="cidade" class="form-control">
                      </div>
                    </div>
                    
                    <div class="col-md-1">
                      <div class="form-group">
                                  <label>UF</label>
                                  <input  maxlength="2" id="I-CEP_UF_SIGLARES"
                                    type="text" class="form-control">
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-12">
                      <div class="input-group">
                        <span class="input-group-addon input-circle-left">
                          <i class="fa fa-envelope"></i>
                        </span>
                        <input maxlength="100" id="I-IMB_CLT_EMAIL" type="email"
                                    class="form-control input-circle-right"
                                    placeholder="Endereço de Email" required>
                      </div>
                    </div>
                  </div>

                  <!-- Botões -->
                  <div class="form-actions right">
                    <button type="button" class="btn default " id="i-btn-cancelar" onClick="history.go(-1);">Cancelar</button>
                    <button type="button" class="btn blue " id="i-btn-gravar" onclick="onGravar()">
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
                        <input maxlength="40" id="I-IMB_CLT_COMCOM"type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">Profissão</label>
                        <input maxlength="20" id="I-IMB_CLT_PROFISSAO" type="text"  class="form-control">
                      </div>
                    </div>
                  
                  </div>
                  
                  <div class="form-actions right">
                    <button type="button" class="btn default " id="i-btn-cancelar" onClick="history.go(-1);">Cancelar</button>
                    <button type="button" class="btn blue " id="i-btn-gravar"  onclick="onGravar()">
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
                          <input maxlength="40" id="I-IMB_CLTCJG_NOME" type="text" class="form-control"
                                  >
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">CPF</label>
                        <input maxlength="14" id="I-IMB_CLTCJG_CPF" type="text" 
                                    onkeydown="fMasc( this, mCPF )"
                                    class="form-control">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">RG</label>
                        <input  maxlength="20" id="I-IMB_CLTCJG_RG" type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-1">
                      <div class="form-group">
                        <label class="control-label">Orgão</label>
                        <input  maxlength="3" id="I-IMB_CLTCJG_RGORGAO" type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-1">
                      <div class="form-group">
                        <label class="control-label">UF</label>
                        <input  maxlength="2" id="I-IMB_CLTCJG_RGESTADO" type="text" class="form-control">
                      </div>
                    </div>
                    
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">Nacionalidade</label>]
                        <input  maxlength="15" id="I-IMB_CLTCJG_NACIONALIDADE"
                                    type="text" class="form-control">
                      </div>
                    </div>
                  </div> <!-- row -->
                  <div class="row">
                    <div class='col-md-3'>
                      <div class="form-group">
                        <label class="control-label">Data Nascimento</label>
                        <input type='date'  class="form-control"
                                    id="I-IMB_CLTCJG_DATANASCIMENTO">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Sexo</label>
                        <select id="I-IMB_CLTCJG_SEXO" class="form-control">
                          </option>
                        </select>
                      </div>
                    </div>
                    
                    <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Profissão</label>
                        <input maxlength="20" id="I-IMB_CLTCJG_PROFISSAO"
                                    type="text" class="form-control">
                      </div>
                    </div>
                  </div> <!-- row -->
                  
                  <div class="form-actions right">
                    <button type="button" class="btn default " id="i-btn-cancelar" onClick="history.go(-1);">Cancelar</button>
                    <button type="button" class="btn blue " id="i-btn-gravar"  onclick="onGravar()">
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
                          name="I-IMB_CLT_OBSERVACAO" ></textarea>
                      </div>
                    </div>
                  </div>
                    
                  <div class="form-actions right">
                    <button type="button" class="btn default " id="i-btn-cancelar" onClick="histo ry.go(-1);">Cancelar</button>
                    <button type="button" class="btn blue " id="i-btn-gravar"  onclick="onGravar()">
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
                          <th width="200"> Arquivo </th>
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
                    <input type="hidden" id="I-IMB_CLT_IDMASTER" >
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script src="{{asset('/global/scripts/moment.min.js')}}" type="text/javascript"></script>

<script>

  
  

  carregarRepresentantes();

  $( document ).ready(function() 
  {
    if  ( carregarOpcao( $("#I-IMB_ATD_ID").val(), 14,3, "{{route('direito.checar')}}", false) == false )
    {
      Swal.fire({
        title: 'Acesso Negado',
        showClass: {
          popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
          popup: 'animate__animated animate__fadeOutUp'
        }
      })
      window.history.back();
    }

    carregarCliente();
    carregarRepresentantes();
    telefoneCarregar()
    carregarAnexos();
    if( $("#i-readonly").val() == 'S')
    $('#i-form-cliente *').attr('readonly', 'readonly');

  });
  
  $('#I-IMB_CLT_PESSOA').on('change', function () {

    var pessoa = $("#I-IMB_CLT_PESSOA").val();
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
  
  $('#I-IMB_CLT_SEXO').change( () => 
    {
      console.log('entrei....')
      var sexo = $("#I-IMB_CLT_SEXO").val();
    
      console.log('Sexo '+sexo);
      if( $("#I-IMB_CLT_NACIONALIDADE").val() == '' )
      {
        if( sexo == 'F')
          $("#I-IMB_CLT_NACIONALIDADE").val('BRASILEIRA');
        else
          $("#I-IMB_CLT_NACIONALIDADE").val('BRASILEIRO');
      }
    });
  
  $('#I-IMB_CLT_CPF').on('blur', () => 
    {
      var pessoa = $("#I-IMB_CLT_PESSOA").val();
    if( pessoa == 'F') 
      {
      console.log('pessoa fisica');
      
      if ( is_cpf( $("#I-IMB_CLT_CPF").val() ) )    
      {
        console.log('ok');
      }
      else
      {
        $('#I-IMB_CLT_CPF').val(''); 
        Swal.fire({
        title: 'Erro CPF/CNPJ',
        text: 'Informe corretamente o CPF',
        icon: 'warning',
        confirmButtonText: 'abortar'
        })
      }
    }
  });

        // Método para consultar o CEP
 $('#I-IMB_CLT_RESENDCEP').on('blur', () => {

  let token = document.head.querySelector('meta[name="csrf-token"]');
   if (token) {
      window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    } else {
      console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
  }

    if ($.trim($('#I-IMB_CLT_RESENDCEP').val()) !== '') {
      $('#mensagem').html('(Aguarde, consultando CEP ...)');

      // NOVO CODIGO =============================================

      // Guardar o CEP do input.
      const cep = $('#I-IMB_CLT_RESENDCEP').val();

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
          $('#I-IMB_CLT_RESEND').val(resultadoCEP.logradouro);
          $('#I-CEP_BAI_NOMERES').val( resultadoCEP.bairro.substr(0, 19));
          $('#I-CEP_CID_NOMERES').val(resultadoCEP.cidade.substr( 0, 19 ));
          $('#I-CEP_UF_SIGLARES').val(resultadoCEP.uf);
        } else {
          console.error('Erro ao carregar os dados do CEP.');
        }
      });

      // FIM NOVO CODIGO.
    }
  });

  //preencherClientes();

  function carregarRepresentantes()
    { 
    str = $("#I-IMB_CLT_ID").val();
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
    
    $.ajaxSetup(
    {
      headers:
      {
        'X-CSRF-TOKEN': "{{csrf_token()}}"
      }
    });
  
  if ( $("#i-select-representante").val() == '' )
    {
      Swal.fire({
        title: 'Inclusão de Representante',
        text: 'Selecione um representante',
        icon: 'ok',
        confirmButtonText: 'ok'
      })
    }
    else
    {
      corimo = 
      {
        IMB_CLT_ID :  $("#i-select-representante").val(),
        IMB_CLT_IDMASTER : $("#I-IMB_CLT_ID").val(),

      };

      var url = "{{ route('representante.save')}}/"+$("#I-IMB_CLT_ID").val();

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
    str = $("#I-IMB_CLT_ID").val();
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
      Swal.fire({
        title: 'DDD ',
        text: 'Informe corretamente um DDD',
        icon: 'ok',
        confirmButtonText: 'ok'
      })

    }
    else
    if ( $("#i-numero").val() == '' )
    {
      Swal.fire({
        title: 'Número de telefone',
        text: 'Informe corretamente um numero de telefone',
        icon: 'ok',
        confirmButtonText: 'ok'
      })
    }
    else
    {
      telefone = 
      {
        IMB_TLF_ID_CLIENTE : $("#I-IMB_CLT_ID").val(),
        IMB_TLF_DDD : $("#i-ddd").val(),
        IMB_TLF_NUMERO : $("#i-numero").val(),
        IMB_TLF_TIPOTELEFONE : $("#i-tipo").val()

      };

      var url = "{{ route('telefone.salvar')}}/"+
      $("#I-IMB_CLT_ID").val()+'/'+
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
    str = $("#I-IMB_CLT_ID").val();
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

    

    function onGravar()
    {
     
      
      telefoneCarregar();
      if ( $("#tbltelefone>tbody>tr").length == 0 ) 
      {

        Swal.fire({
          title: 'Mínimo de Informações',
          text: 'Informe pelo menos um número de telefone para contato',
          icon: 'ok',
          confirmButtonText: 'ok'
        })
        return false;
      }

      var email = $("#I-IMB_CLT_EMAIL").val();

      if (  email.length  < 7 )
      {
        Swal.fire({
        title: 'Email necessário',
        text: 'Informe um email para contato',
        icon: 'ok',
        confirmButtonText: 'ok'
      })
        return false;

      }

      $.ajaxSetup({
        headers:
        {
          'X-CSRF-TOKEN': "{{csrf_token()}}"
        }
      });

      cpf=$("#I-IMB_CLT_CPF").val();
      cpf = cpf.replace('.','');
      cpf = cpf.replace('.','');
      cpf = cpf.replace('.','');
      cpf = cpf.replace('-','');
      cpf = cpf.replace('/','');
      console.log(cpf);
      cpfcjg=$("#I-IMB_CLT_CPF").val();
      cpfcjg = cpfcjg.replace('.','');
      cpfcjg = cpfcjg.replace('-','');
      cpfcjg = cpfcjg.replace('/','');

      var cliente = 
      {

        IMB_CLT_ID      : $("#I-IMB_CLT_ID").val(),
        IMB_CLT_NOME      : $("#I-IMB_CLT_NOME").val(),
        IMB_CLT_RESEND      : $("#I-IMB_CLT_RESEND").val(),
        IMB_CLT_RESENDNUM      : $("#I-IMB_CLT_RESENDNUM").val(),
        IMB_CLT_RESENDCOM      : $("#I-IMB_CLT_RESENDCOM").val(),
        IMB_CLT_EMAIL      : $("#I-IMB_CLT_EMAIL").val(),
        IMB_CLT_RESENDCEP      : $("#I-IMB_CLT_RESENDCEP").val(),
        IMB_CLT_COMEND      : $("#I-IMB_CLT_COMEND").val(),
        IMB_CLT_DATNAS      : $("#I-IMB_CLT_DATANASCIMENTO").val(),
        IMB_CLT_COMNUM      : $("#I-IMB_CLT_COMNUM").val(),
        IMB_CLT_COMCOM      : $("#I-IMB_CLT_COMCOM").val(),
        IMB_CLT_COMCEP      : $("#I-IMB_CLT_COMCEP").val(),
        IMB_CLT_OBSERVACAO      : $("#I-IMB_CLT_OBSERVACAO").val(),
        IMB_CLT_CPF      : cpf,
        IMB_CLT_COMCEP      : $("#I-IMB_CLT_COMCEP").val(),
        IMB_CLT_RG      : $("#I-IMB_CLT_RG").val(),
        IMB_CLT_RGORGAO      : $("#I-IMB_CLT_RGORGAO").val(),
        IMB_CLT_RGESTADO      : $("#I-IMB_CLT_RGESTADO").val(),
        IMB_CLT_PROFISSAO      : $("#I-IMB_CLT_PROFISSAO").val(),
        IMB_ATD_ID      : $("#I-IMB_ATD_ID").val(),
        IMB_CLT_RG_DATAEXPEDICAO      : $("#I-IMB_CLT_RG_DATAEXPEDICAO").val(),
        IMB_TIPCLI_ID      : $("#I-IMB_CLT_RGESIMB_TIPCLI_IDTADO").val(),
        IMB_CLT_NACIONALIDADE      : $("#I-IMB_CLT_NACIONALIDADE").val(),
        IMB_CLT_RENDA      : $("#I-IMB_CLT_RENDA").val(),
        CEP_BAI_NOMERES      : $("#I-CEP_BAI_NOMERES").val(),
        CEP_CID_NOMENAT      : $("#I-CEP_CID_NOMENAT").val(),
        CEP_UF_SIGLANAT      : $("#I-CEP_UF_SIGLANAT").val(),
        CEP_UF_SIGLARES      : $("#I-CEP_UF_SIGLARES").val(),
        IMB_CLT_RAZAOSOCIAL      : $("#I-IMB_CLT_RAZAOSOCIAL").val(),
        IMB_CLT_PRECADASTRO      : $("#I-IMB_CLT_PRECADASTRO").val(),
        IMB_CLT_DTHALTERACAO      :'2020-01-01', //$("#I-IMB_CLT_DTHALTERACAO").val(),
        IMB_CLT_DTHINATIVO      : $("#I-IMB_CLT_DTHINATIVO").val(),
        IMB_IMB_ID2      : $("#I-IMB_IMB_IDAGENCIA").val(),
        IMB_CLT_SENHA      : $("#I-IMB_CLT_SENHA").val(),
        IMB_CLTCJG_CPF      : cpfcjg,
        IMB_CLTCJG_PROFISSAO      : $("#I-IMB_CLTCJG_PROFISSAO").val(),
        IMB_CLTCJG_RG      : $("#I-IMB_CLTCJG_RG").val(),
        IMB_CLTCJG_RGORGAO      : $("#I-IMB_CLTCJG_RGORGAO").val(),
        IMB_CLTCJG_NOME      : $("#I-IMB_CLTCJG_NOME").val(),
        IMB_CLTCJG_DATANASCIMENTO      : $("#I-IMB_CLTCJG_DATANASCIMENTO").val(),
        IMB_CLTCJG_NACIONALIDADE      : $("#I-IMB_CLTCJG_NACIONALIDADE").val(),
        IMB_CLTCJG_RGESTADO      : $("#I-IMB_CLTCJG_RGESTADO").val(),
        IMB_CLTCJG_SALARIO      : $("#I-IMB_CLTCJG_SALARIO").val(),
        CEP_CID_NOME      : $("#I-CEP_CID_NOME").val(),
        CEP_UF_SIGLA      : $("#I-IMB_CLTCJG_RGESTCEP_UF_SIGLAADO").val(),
        CEP_CID_NOMENATURAL      : $("#I-CEP_CID_NOMENATURAL").val(),
        CEP_UF_SIGLANATURAL      : $("#I-CEP_UF_SIGLANATURAL").val(),
        IMB_CLTCJG_RGESTADO      : $("#I-IMB_CLTCJG_RGESTADO").val(),
        IMB_IMB_IDAGENCIA       : $("#I-IMB_IMB_IDAGENCIA").val(),
        IMB_IMB_IDMASTER       : $("#I-IMB_IMB_IDMASTER").val(),
        IMB_CLT_PESSOA      : $("#I-IMB_CLT_PESSOA").val(),
               
      };


      console.log(         
          'IMB_CLT_ID      :'+ $("#I-IMB_CLT_ID").val()+'   '+
          'IMB_CLT_NOME      :'+ $("#I-IMB_CLT_NOME").val()+'   '+
        'IMB_CLT_RESEND      :'+ $("#I-IMB_CLT_RESEND").val()+'   '+
        'IMB_CLT_RESENDNUM      :'+ $("#I-IMB_CLT_RESENDNUM").val()+'   '+
        'IMB_CLT_RESENDCOM      :'+ $("#I-IMB_CLT_RESENDCOM").val()+'   '+
        'IMB_CLT_EMAIL      :'+ $("#I-IMB_CLT_EMAIL").val()+'   '+
        'IMB_CLT_RESENDCEP      :'+ $("#I-IMB_CLT_RESENDCEP").val()+'   '+
        'IMB_CLT_COMEND      :'+ $("#I-IMB_CLT_COMEND").val()+'   '+
        'IMB_CLT_DATNAS      :'+ $("#I-IMB_CLT_DATANASCIMENTO").val()+'   '+
        'IMB_CLT_COMNUM      :'+ $("#I-IMB_CLT_COMNUM").val()+'   '+
        'IMB_CLT_COMCOM      :'+ $("#I-IMB_CLT_COMCOM").val()+'   '+
        'IMB_CLT_COMCEP      :'+ $("#I-IMB_CLT_COMCEP").val()+'   '+
        'IMB_CLT_OBSERVACAO      :'+ $("#I-IMB_CLT_OBSERVACAO").val()+'   '+
        'IMB_CLT_CPF      :'+ $("#I-IMB_CLT_CPF").val()+'   '+
        'IMB_CLT_COMCEP      :'+ $("#I-IMB_CLT_COMCEP").val()+'   '+
        'IMB_CLT_RG      :'+ $("#I-IMB_CLT_RG").val()+'   '+
        'IMB_CLT_RGORGAO      :'+ $("#I-IMB_CLT_RGORGAO").val()+'   '+
        'IMB_CLT_RGESTADO      :'+ $("#I-IMB_CLT_RGESTADO").val()+'   '+
        'IMB_CLT_PROFISSAO      :'+ $("#I-IMB_CLT_PROFISSAO").val()+'   '+
//        'IMB_ATD_ID      :'+ $("#I-IMB_ATD_ID").val()+'   '+
        'IMB_CLT_RG_DATAEXPEDICAO      :'+ $("#I-IMB_CLT_RG_DATAEXPEDICAO").val()+'   '+
        'IMB_TIPCLI_ID      :'+ $("#I-IMB_CLT_RGESIMB_TIPCLI_IDTADO").val()+'   '+
        'IMB_CLT_NACIONALIDADE      :'+ $("#I-IMB_CLT_NACIONALIDADE").val()+'   '+
        'IMB_CLT_RENDA      :'+ $("#I-IMB_CLT_RENDA").val()+'   '+
        'CEP_BAI_NOMERES      :'+ $("#I-CEP_BAI_NOMERES").val()+'   '+
        'CEP_CID_NOMENAT      :'+ $("#I-CEP_CID_NOMENAT").val()+'   '+
        'CEP_UF_SIGLANAT      :'+ $("#I-CEP_UF_SIGLANAT").val()+'   '+
        'CEP_UF_SIGLARES      :'+ $("#I-CEP_UF_SIGLARES").val()+'   '+
        'IMB_CLT_RAZAOSOCIAL      :'+ $("#I-IMB_CLT_RAZAOSOCIAL").val()+'   '+
        'IMB_CLT_PRECADASTRO      :'+ $("#I-IMB_CLT_PRECADASTRO").val()+'   '+
        'IMB_CLT_DTHALTERACAO      :'+ $("#I-IMB_CLT_DTHALTERACAO").val()+'   '+
        'IMB_CLT_DTHINATIVO      :'+ $("#I-IMB_CLT_DTHINATIVO").val()+'   '+
        'IMB_IMB_ID2      :'+ $("#I-IMB_IMB_IDAGENCIA").val()+'   '+
        'IMB_IMB_IDMASTER      :'+ $("#I-IMB_IMB_IDMASTER").val()+'   '+
        'IMB_CLT_SENHA      :'+ $("#I-IMB_CLT_SENHA").val()+'   '+
        'IMB_CLTCJG_CPF      :'+ $("#I-IMB_CLTCJG_CPF").val()+'   '+
        'IMB_CLTCJG_PROFISSAO      :'+ $("#I-IMB_CLTCJG_PROFISSAO").val()+'   '+
        'IMB_CLTCJG_RG      :'+ $("#I-IMB_CLTCJG_RG").val()+'   '+
        'IMB_CLTCJG_RGORGAO      :'+ $("#I-IMB_CLTCJG_RGORGAO").val()+'   '+
        'IMB_CLTCJG_NOME      :'+ $("#I-IMB_CLTCJG_NOME").val()+'   '+
        'IMB_CLTCJG_DATANASCIMENTO      :'+ $("#I-IMB_CLTCJG_DATANASCIMENTO").val()+'   '+
        'IMB_CLTCJG_NACIONALIDADE      :'+ $("#I-IMB_CLTCJG_NACIONALIDADE").val()+'   '+
        'IMB_CLTCJG_RGESTADO      :'+ $("#I-IMB_CLTCJG_RGESTADO").val()+'   '+
        'IMB_CLTCJG_SALARIO      :'+ $("#I-IMB_CLTCJG_SALARIO").val()+'   '+
        'CEP_CID_NOME      :'+ $("#I-CEP_CID_NOME").val()+'   '+
        'CEP_UF_SIGLA      :'+ $("#I-IMB_CLTCJG_RGESTCEP_UF_SIGLAADO").val()+'   '+
        'CEP_CID_NOMENATURAL      :'+ $("#I-CEP_CID_NOMENATURAL").val()+'   '+
        'CEP_UF_SIGLANATURAL      :'+ $("#I-CEP_UF_SIGLANATURAL").val()+'   '+
        'IMB_CLTCJG_RGESTADO      :'+ $("#I-IMB_CLTCJG_RGESTADO").val()
      );

      console.log('la vai');

      url = "{{ route( 'cliente.salvarajax' ) }}";

      $.post( url, cliente, function(data)
      {
        Swal.fire('Gravado com Sucesso');
        window.history.back();


      });


     
    }

    function cargaComboSexo( sexo )
    {
      $("#I-IMB_CLT_SEXO").empty();

      if ( sexo == 'M' )
        linha = '<option value="M" selected>Masculino</option>';
      else
        linha = '<option value="M">Masculino</option>';
      $("#I-IMB_CLT_SEXO").append( linha );
      console.log('linha '+linha);

      if ( sexo == 'F' )
        linha = '<option value="F" selected>Feminino</option>';
      else
        linha = '<option value="F">Feminino</option>';
        console.log('linha '+linha);
      $("#I-IMB_CLT_SEXO").append( linha );

    }

    function cargaPessoa( sexo )
    {
      $("#I-IMB_CLT_PESSOA").empty();

      if ( sexo == 'F' )
        linha = '<option value="F" selected>Física</option>';
      else
      linha = '<option value="F">Física</option>';
      $("#I-IMB_CLT_PESSOA").append( linha );
      console.log('linha '+linha);

      if ( sexo == 'J' )
        linha = '<option value="J" selected>Jurídica</option>';
      else
        linha = '<option value="J">Jurídica</option>';
        console.log('linha '+linha);
      $("#I-IMB_CLT_PESSOA").append( linha );

    }

    function cargaEstadoCivil( estado )
    {
      $("#I-IMB_CLT_ESTADOCIVIL").empty();

      if ( estado == 'S' )
        linha = '<option value="S" selected>Solteiro(a)</option>';
      else
       linha = '<option value="S">Solteiro(a)</option>';
       $("#I-IMB_CLT_ESTADOCIVIL").append( linha );

       if ( estado == 'C' )
        linha = '<option value="C" selected>Casado(a)</option>';
      else
       linha = '<option value="C">Casado(a)</option>';
       $("#I-IMB_CLT_ESTADOCIVIL").append( linha );

       if ( estado == 'U' )
        linha = '<option value="U" selected>União Estável</option>';
      else
       linha = '<option value="U">União Estável</option>';
       $("#I-IMB_CLT_ESTADOCIVIL").append( linha );

       if ( estado == 'I' )
        linha = '<option value="I" selected>Divorcido(a)</option>';
      else
       linha = '<option value="I">Divorcido(a)</option>';
       $("#I-IMB_CLT_ESTADOCIVIL").append( linha );

       if ( estado == 'V' )
        linha = '<option value="V" selected>Viúva(a)</option>';
      else
       linha = '<option value="V">Viúva(a)</option>';

       $("#I-IMB_CLT_ESTADOCIVIL").append( linha );

    }

    function carregarCliente()
    {

      var id = $('#I-IMB_CLT_ID').val();
      
      url="{{ route('cliente.find')}}/"+id;
      console.log('url: '+url);
      $.getJSON( url, function( data)
      {

        if( data.IMB_IMB_ID != $("#I-IMB_IMB_IDMASTER").val() )
        {
          window.history.back();
          return false;
        }
        cargaComboSexo( data.IMB_CLT_SEXO );
        cargaPessoa( data.IMB_CLT_PESSOA );
        cargaEstadoCivil( data.IMB_CLT_ESTADOCIVIL );

        $("#I-IMB_CLT_NOME").val( data.IMB_CLT_NOME );
        $("#I-IMB_CLT_RESEND").val( data.IMB_CLT_RESEND );
        $("#I-IMB_CLT_RESENDNUM").val( data.IMB_CLT_RESENDNUM );
        $("#I-IMB_CLT_RESENDCOM").val( data.IMB_CLT_RESENDCOM );
        $("#I-IMB_CLT_RESENDCOM").val( data.IMB_CLT_RESENDCOM );
        $("#I-IMB_CLT_EMAIL").val( data.IMB_CLT_EMAIL );
        $("#I-IMB_CLT_RESENDCEP").val( data.IMB_CLT_RESENDCEP );
        $("#I-IMB_CLT_DATANASCIMENTO").val( data.IMB_CLT_DATNAS );
        $("#I-IMB_CLT_COMEND").val( data.IMB_CLT_COMEND );
        $("#I-IMB_CLT_COMNUM").val( data.IMB_CLT_COMNUM );
        $("#I-IMB_CLT_COMCOM").val( data.IMB_CLT_COMCOM );
        $("#I-IMB_CLT_COMCEP").val( data.IMB_CLT_COMCEP );
        $("#I-IMB_CLT_OBSERVACAO").val( data.IMB_CLT_OBSERVACAO );
        $("#I-IMB_CLT_CPF").val( data.IMB_CLT_CPF );
        $("#I-IMB_CLT_RG").val( data.IMB_CLT_RG );
        $("#I-IMB_CLT_RGORGAO").val( data.IMB_CLT_RGORGAO );
        $("#I-IMB_CLT_RGESTADO").val( data.IMB_CLT_RGESTADO );
        $("#I-IMB_CLT_PROFISSAO").val( data.IMB_CLT_PROFISSAO );
//        $("#I-IMB_CLT_PESSOA").val( data.IMB_CLT_PESSOA);
        $("#I-IMB_ATD_ID").val( data.IMB_ATD_ID);
        $("#I-IMB_CLT_RG_DATAEXPEDICAO").val( data.IMB_CLT_RG_DATAEXPEDICAO);
        $("#I-IMB_TIPCLI_ID").val( data.IMB_TIPCLI_ID);
        //$("#I-IMB_CLT_ESTADOCIVIL").val( data.IMB_CLT_ESTADOCIVIL);
        $("#I-IMB_CLT_NACIONALIDADE").val( data.IMB_CLT_NACIONALIDADE);
        
        
        $("#I-IMB_CLT_RENDA").val( data.IMB_CLT_RENDA);
        $("#I-CEP_BAI_NOMERES").val( data.CEP_BAI_NOMERES);
        $("#I-CEP_CID_NOMENAT").val( data.CEP_CID_NOMENAT);
        $("#I-CEP_UF_SIGLANAT").val( data.CEP_UF_SIGLANAT);
        $("#I-CEP_UF_SIGLARES").val( data.CEP_UF_SIGLARES);
        $("#I-IMB_CLT_RAZAOSOCIAL").val( data.IMB_CLT_RAZAOSOCIAL);
        $("#I-IMB_CLT_PRECADASTRO").val( data.IMB_CLT_PRECADASTRO);
        $("#I-IMB_CLT_DTHALTERACAO").val( moment(data.IMB_CLT_DTHALTERACAO).format('DD/MM/YYYY') );
        $("#I-IMB_CLT_DTHINATIVO").val( data.IMB_CLT_DTHINATIVO);
        $("#I-IMB_CLT_DTHINATIVO").val( data.IMB_CLT_DTHINATIVO);
        $("#I-IMB_OBS_PROCESSO").val( data.IMB_OBS_PROCESSO);
//        $("#I-IMB_IMB_ID2").val( data.IMB_IMB_ID2);
//        $("#I-IMB_IMB_IDMASTER").val( data.IMB_IMB_IDMASTER);
        $("#I-IMB_CLT_SENHA").val( data.IMB_CLT_SENHA);
        $("#I-IMB_CLTCJG_CPF").val( data.IMB_CLTCJG_CPF);
        $("#I-IMB_CLTCJG_PROFISSAO").val( data.IMB_CLTCJG_PROFISSAO);
        $("#I-IMB_CLTCJG_RG").val( data.IMB_CLTCJG_RG);
        $("#I-IMB_CLTCJG_RGORGAO").val( data.IMB_CLTCJG_RGORGAO);
        $("#I-IMB_CLTCJG_NOME").val( data.IMB_CLTCJG_NOME);
        $("#I-IMB_CLTCJG_DATANASCIMENTO").val( data.IMB_CLTCJG_DATANASCIMENTO);
        $("#I-IMB_CLTCJG_NACIONALIDADE").val( data.IMB_CLTCJG_NACIONALIDADE);
        $("#I-IMB_CLTCJG_RGESTADO").val( data.IMB_CLTCJG_RGESTADO);
        $("#I-IMB_CLTCJG_SALARIO").val( data.IMB_CLTCJG_SALARIO);
        $("#I-IMB_CLTCJG_SALARIO").val( data.IMB_CLTCJG_SALARIO);
        $("#I-CEP_CID_NOME").val( data.CEP_CID_NOME);
        $("#I-CEP_UF_SIGLA").val( data.CEP_UF_SIGLA);
        $("#I-CEP_CID_NOMENATURAL").val( data.CEP_CID_NOMENATURAL);
        $("#I-CEP_UF_SIGLANATURAL").val( data.CEP_UF_SIGLANATURAL);
        //$("#I-IMB_CLT_DTHALTERACAO").val( data.IMB_CLT_DTHALTERACAO);
        $("#I-IMB_CLT_DATACADASTRO").val( data.IMB_CLT_DATACADASTRO);

        if ( data.IMB_CLT_PESSOA == 'J')
          $("#I-IMB_CLT_CPF").mask("99.999.999/9999-99");
        else
        $("#I-IMB_CLT_CPF").mask("999.999.999-99");

        $("#I-IMB_CLTCJG").mask("999.999.999-99");

        url="{{ route('cliente.tipo')}}/"+id;
        console.log('url: '+url);
        $.getJSON( url, function( data)
        {

          $("#i-div-locador").html('');
          $("#i-div-locatario").html('');
          $("#i-div-fiador").html('');
          $("#i-div-precadastro").html('');

          $("#i-div-locador").css("background","#FFFFFF");                
          $("#i-div-locatario").css("background","#FFFFFF");                
          $("#i-div-fiador").css("background","#FFFFFF");                
          $("#i-div-precadastro").css("background","#FFFFFF");                

          if( data[0].LOCADOR != null )
          {
            $("#i-div-locador").html('É PROPRIETÁRIO');
            $("#i-div-locador").css("color","blue");                
            $("#i-div-locador").css("background","#0000ff");                
            $("#i-div-locador").css("background","#669900");                
            
          };

          if( data[0].LOCATARIO != null )
          {
            $("#i-div-locatario").html('É LOCATÁRIO');
            $("#i-div-locatario").css("color","white");                
            $("#i-div-locatario").css("background","#669900");                
          };
            
          if( data[0].FIADOR != null )
          {
            $("#i-div-fiador").html('É FIADOR');
            $("#i-div-fiador").css("color","white");                
            $("#i-div-fiador").css("background","#996633");                
          };

          console.log( 'pre: '+data[0].IMB_CLT_PRECADASTRO );
          console.log('locador '+data[0].LOCADOR );
          console.log('locatario '+data[0].LOCATARIO );
          console.log('fiador '+data[0].FIADOR );

          if( data[0].LOCADOR == null && 
              data[0].LOCATARIO == null && 
              data[0].FIADOR == null)
          {
            if ( data[0].IMB_CLT_PRECADASTRO =='S' ) 
            {

              $("#i-div-precadastro").html('PRÉ-CADASTRO');
              $("#i-div-precadastro").css("background","#EF5555");                
            }
            

          }


        });


      });

    }



</script>



@endpush