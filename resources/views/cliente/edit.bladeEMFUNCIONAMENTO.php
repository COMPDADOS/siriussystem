@extends('layout.app')
@push('script')

@section('scripttop')

<style>
.valores-direita
    {
        text-align: right;
        font-size: 12px;
        font-weight: bold;
    }


.div-background-perfil
{
  background-color: #f0f5f5;
}
  .div-center
    {
      text-align: center;
    }
    .footer {
  position: fixed;
  bottom: 0;
  width: 85%;
  height: 50px;
  background:#e0ebeb;
}
.is-invalid .select2-selection,
.needs-validation ~ span > .select2-dropdown{
  border-color:red !important;
}
.escondido
{
  display: none;
}

.tamanho-box-200
{
  width:150px;
}
.tamanho-box-100
{
  width:100px;
}

.div-right {
    text-align: right;
}

.font-12px-blue
{
  color:blue;
  font-size:12px;
  font-weight: bold;

}

.font-bold
{
    font-weight: bold;

}
.font-8px-blue-italic
{
  color:blue;
  font-size:10px;
  font-weight: bold;
  text-decoration:italic;

}
.font-8px-blue
{
  color:blue;
  font-size:8px;

}
.font-10px-blue
{
  color:blue;
  font-size:10px;

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
          <form id="i-form-cliente" autocomplete="off">
          <input type="hidden" id="i-erros"  value="">
          <input type="hidden" id="i-somenteleitura" value="{{$readonly}}">
            <div class="row" height="50%">
              <div class="col-md-2">
                <input type="hidden" class="form-control"
                  value="{{$id}}" id="I-IMB_CLT_ID" readonly>
                <label class="control-label" id="i-lbl-codigo">Código</label>
              </div>

              <div class='col-md-3'>
                <div class="form-group">
                  <label class="control-label" id="i-lbl-datacadastro" >Data Cadastro</label>
                </div>
              </div>

              <div class='col-md-3'>
                  <label class="control-label" id="i-lbl-dataatualizacao">Última Alteração</label>
              </div>
              <div class='col-md-3'>
                  <label class="control-label" id="i-lbl-whastapp"></label>
              </div>
            </div> <!--row-->


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

                  <div class="row" height="50%">

                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label" >Nome</label>

                          <input type="text" maxlength="40" class="form-control" id="I-IMB_CLT_NOME"
                                        placeholder="Nome completo"
                                        autocomplete="off"
                                        style="font-family: Tahoma; font-size: 16px"
                                        required
                                        {{$readonly}}>
                          <span>
                            <img id="i-div-interessado" class= "escondido" src="http://siriussystem.com.br/sys/assets/layouts/layout/img/labelinteressado.png" alt="prop">
                            <img id="i-div-prop" class= "escondido"  src="http://siriussystem.com.br/sys/assets/layouts/layout/img/labelproprietario.png" alt="prop">
                            <img id="i-div-locatario" class= "escondido"  src="http://siriussystem.com.br/sys/assets/layouts/layout/img/labellocatario.png" alt="prop">
                            <img id="i-div-fiador" class= "escondido"  src="http://siriussystem.com.br/sys/assets/layouts/layout/img/labelfiador.png" alt="prop">
                          </span>

                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">Pessoa</label>
                        <select id="I-IMB_CLT_PESSOA"
                          class="form-control" required {{$readonly}}>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-2" id="i-div-estado-civil">
                      <div class="form-group">
                        <label class="control-label">Estado Civil</label>
                        <select id="I-IMB_CLT_ESTADOCIVIL" class="form-control"  required {{$readonly}}>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">Status</label>
                        <select id="I-IMB_CLT_ATIVO" class="form-control" {{$readonly}}>
                          <option value="S">Ativo</option>
                          <option value="N">Inativo</option>
                        </select>
                      </div>
                    </div>

                  </div>


                  <div class="row" height="50%">

                    <div class="col-md-1"  id="i-div-sexo">
                      <div class="form-group">
                        <label class="control-label">Sexo</label>
                        <select id="I-IMB_CLT_SEXO" class="form-control">
                        </select>
                      </div>
                    </div>


                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label" id="i-lab-cpf">CPF/CNPJ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-  </label>
                          <input type="checkbox" id="I-IMB_CLT_MEI">MEI
                        <input id="I-IMB_CLT_CPF" onkeydown="fMasc( this, mCNPJ )"
                                    type="text" class="form-control" placeholder="Somente números"
                                    style="font-family: Tahoma; font-size: 16px"
                                    required>
                                  <p id="cpfresponse"></p>
                        <span>

                        </span>


                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">RG/Insc. Estadual
                          <input maxlength="20"id="I-IMB_CLT_RG" type="text" class="form-control"

                            placeholder="Preencher ./-"
                            style="font-family: Tahoma; font-size: 16px" required>
                        </label>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">Orgão(UF)
                          <select class="form-control" id="I-IMB_CLT_RGORGAO">
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                            <option value="EX">Estrangeiro</option>
                          </select>
                        </label>
                      </div>
                    </div>
                    <div class='col-md-2'  id="i-div-data-nascimento">
                      <div class="form-group">
                        <label class="control-label" >Data Nascimento</label>
                          <input type='date'  class="form-control" id="I-IMB_CLT_DATANASCIMENTO">
                      </div>
                    </div>

                    <div class='col-md-2' id="i-div-nacionalidade">
                      <div class="form-group" >
                        <label class="control-label">Nacionalidade</label>
                        <input type='text'  class="form-control" id="I-IMB_CLT_NACIONALIDADE">
                      </div>
                    </div>
                  </div>

                  <div class="row" height="50%">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Endereço</label>
                        <input maxlength="40" id="I-IMB_CLT_RESEND"
                                    type="text" class="form-control">
                      </div>
                    </div>

                    <div class="col-md-1">
                      <div class="form-group">
                        <label>Número</label>
                        <input maxlength="10" id="I-IMB_CLT_RESENDNUM"
                                    type="text" class="form-control">
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Complemento</label>
                        <input maxlength="20" name="I-IMB_CLT_RESENDCOM"
                                    type="text" class="form-control">
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Cep</label>
                        <input maxlength="8" name="I-IMB_CLT_RESENDCEP" autocomplete="off"
                                      type="text" id="cep" class="form-control"
                                      max="99999999"
                                      onkeypress="return isNumber(event)" onpaste="return false;"/>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Bairro</label>
                        <input maxlength="20" id="I-CEP_BAI_NOMERES"
                                      type="text" class="form-control">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Cidade</label>
                        <input maxlength="20" id="I-CEP_CID_NOMERES"
                                    type="text"  class="form-control">
                      </div>
                    </div>

                    <div class="col-md-1">
                      <div class="form-group">
                        <label>UF</label>
                          <select class="form-control" id="I-CEP_UF_SIGLARES">
                            <option value="AC">AC</option>
                            <option value="AL">AL</option>
                            <option value="AP">AP</option>
                            <option value="AM">AM</option>
                            <option value="BA">BA</option>
                            <option value="CE">CE</option>
                            <option value="DF">DF</option>
                            <option value="ES">ES</option>
                            <option value="GO">GO</option>
                            <option value="MA">MA</option>
                            <option value="MT">MT</option>
                            <option value="MS">MS</option>
                            <option value="MG">MG</option>
                            <option value="PA">PA</option>
                            <option value="PB">PB</option>
                            <option value="PR">PR</option>
                            <option value="PE">PE</option>
                            <option value="PI">PI</option>
                            <option value="RJ">RJ</option>
                            <option value="RN">RN</option>
                            <option value="RS">RS</option>
                            <option value="RO">RO</option>
                            <option value="RR">RR</option>
                            <option value="SC">SC</option>
                            <option value="SP">SP</option>
                            <option value="SE">SE</option>
                            <option value="TO">TO</option>
                            <option value="EX">EX</option>
                          </select>
                        </label>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Cód.IBGE</label>
                        <input maxlength="10" id="I-IMB_CLT_CIDADEIBGE"
                                    type="text"  class="form-control">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">Local de trabalho</label>
                        <input maxlength="40" id="I-IMB_CLT_COMCOM"type="text" class="form-control"
                        autocomplete="off">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Profissão</label>
                        <input maxlength="20" id="I-IMB_CLT_PROFISSAO" type="text"  class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-2">
                          <button type="button" class="btn btn-danger btn-sm" onClick="apagarFone(1)">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                          </button>
                          <label class="control-label">Telefone (I)</label>
                          <input type="hidden" id="i-telefone-id1">
                          <input type="text" class="form-control telefone input-8" id="i-telefone1"  >
                          <label class="control-label">Tipo</label>
                          <input type="text" class="form-control" id="i-telefone1-tipo" maxlength="40"
                            placeholder="Whatsapp, com., res., etc...">
                        </div>
                        <div class="col-md-2">
                          <button type="button" class="btn btn-danger btn-sm" onClick="apagarFone(2)">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                          </button>
                          <label class="control-label">Telefone (II)</label>
                          <input type="hidden" id="i-telefone-id2">
                          <input type="text" class="form-control telefone  input-8" id="i-telefone2" >
                          <label class="control-label">Tipo</label>
                          <input type="text" class="form-control" id="i-telefone2-tipo" maxlength="40"
                            placeholder="Whatsapp, com., res., etc...">
                        </div>
                        <div class="col-md-2">
                          <button type="button" class="btn btn-danger btn-sm" onClick="apagarFone(3)">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                          </button>
                          <label class="control-label">Telefone (III)</label>
                          <input type="hidden" id="i-telefone-id3">
                          <input type="text" class="form-control telefone  input-8" id="i-telefone3" >
                          <label class="control-label">Tipo</label>
                          <input type="text" class="form-control" id="i-telefone3-tipo" maxlength="40"
                            placeholder="Whatsapp, com., res., etc...">
                          </div>
                        <div class="col-md-2">
                          <button type="button" class="btn btn-danger btn-sm" onClick="apagarFone(4)">
                              <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                          </button>
                          <label class="control-label">Telefone (IV)</label>
                          <input type="text" class="form-control telefone  input-8" id="i-telefone4">
                          <input type="hidden" id="i-telefone-id4">
                          <label class="control-label">Tipo</label>
                          <input type="text" class="form-control" id="i-telefone4-tipo" maxlength="40"
                            placeholder="Whatsapp, com., res., etc...">
                          </div>
                        <div class="col-md-2">
                        <button type="button" class="btn btn-danger btn-sm" onClick="apagarFone(5)">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                          </button>
                          <input type="hidden" id="i-telefone-id5">
                          <label class="control-label">Telefone (V)</label>
                          <input type="text" class="form-control telefone  input-8" id="i-telefone5" >
                          <label class="control-label">Tipo</label>
                          <input type="text" class="form-control" id="i-telefone5-tipo" maxlength="40"
                            placeholder="Whatsapp, com., res., etc...">
                          </div>
                        <div class="col-md-2">
                          <button type="button" class="btn btn-danger btn-sm" onClick="apagarFone(6)">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                          </button>
                          <label class="control-label">Telefone (VI)</label>
                          <input type="hidden" id="i-telefone-id6">

                          <input type="text" class="form-control telefone  input-8" id="i-telefone6"onchange="procurarTelefone( this)" >
                          <label class="control-label">Tipo</label>
                          <input type="text" class="form-control" id="i-telefone6-tipo" maxlength="40"
                            placeholder="Whatsapp, com., res., etc...">
                        </div>


                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="input-group">
                        <span class="input-group-addon input-circle-left">
                          <i class="fa fa-envelope"></i>
                        </span>
                        <input maxlength="100" name="CIMB_CLT_EMAIL" type="email"
                                    id="IMB_CLT_EMAIL"
                                    class="form-control input-circle-right"
                                    placeholder="Endereço de Email" autocomplete="off" required>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div> <!-- fim quadro -->

            <div class="portlet box green" >
              <div class="portlet-title">
                <div class="caption">
                  <i class="fa fa-gift"></i> Corretor(es) para Este Cliente
                </div>

                <div class="tools">
                  <a href="javascript:;" class="collapse"> </a>
                </div>
              </div>

              <div class="portlet-body form">
                <div class="form-body" >
                  <div class="row">
                    <table  id="tbcluusu" class="table table-striped table-bordered table-hover" >
                      <thead class="thead-dark">
                        <tr>
                          <th width="50" style="text-align:center"> Ações </th>
                          <th class="div-center"> ID </th>
                          <th class="div-center"> Corretor </th>
                          <th class="div-center"> Atendido como </th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                    </div>
                    <div class="table-footer" >
                      <a  class="btn btn-sm btn-primary"
                      role="button" onClick="adicionarCliUsu()" >
                      Adicionar Corretor </a>
                                <!--data-toggle="modal" data-target="#modalFormaPagamento"-->
                  </div> <!-- row -->
                </div><!-- end form-body-->
              </div> <!--FIM Portlet-body form">-->
            </div> <!-- fimquadro -->

            <div class="portlet box blue" >
              <div class="portlet-title">
                <div class="caption">
                  <i class="fa fa-gift"></i>Perfis Informados ao Cliente
                </div>

                <div class="tools">
                  <a href="javascript:;" class="collapse"> </a>
                </div>
              </div>

              <div class="portlet-body form">
                <div class="form-body">
                  <div class="row">
                    <div class="col-md-12">
                      <table class="table table-bordered" id="tableperfil">
                        <thead>
                          <th class="div-center"></th>
                          <th class="div-center">Tipo</th>
                          <th class="div-center">Venda Até R$</th>
                          <th class="div-center">Locação Até R$</th>
                          <th class="div-center">Finalidade</th>
                          <th class="div-center">Bairro</th>
                          <th class="div-center">Dorm.</th>
                          <th class="div-center">Suíte</th>
                          <th class="div-center">Garag.</th>
                        </thead>
                        <div class="table-footer" >
                            <div class="table-footer" >
                              <a  class="btn btn-sm btn-primary"
                                  role="button" onClick="adicionarPerfil()" >
                              Adicionar Perfil </a>
                              <!--data-toggle="modal" data-target="#modalFormaPagamento"-->
                          </div>
                        </div>
                       </table>
                       <div class="row">
                          <div class="col-md-12 div-right">
                            <input type="button" class="btn btn-success">Buscar Imóveis Conforme Perfil(s) cadastrado(s)
                          </div>
                        </div>

                    </div>
                  </div>
                </div>

              </div>
            </div>

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
                    <div class="col-md-3">
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
                    <div class="col-md-2">
                      <div class="form-group">
                      <label>UF</label>
                          <select class="form-control" id="I-IMB_CLTCJG_RGESTADO">
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                            <option value="EX">Estrangeiro</option>
                          </select>
                        </label>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">Nacionalidade</label>
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

                </div><!-- end form-body-->
              </div> <!--FIM Portlet-body form">-->
            </div> <!-- fimquadro -->


            <div class="portlet box blue" >
              <div class="portlet-title">
                <div class="caption">
                  <i class="fa fa-gift"></i>Representantes Legais do Locatário(Pessoa Jurídica)
                </div>

                <div class="tools">
                  <a href="javascript:;" class="collapse"> </a>
                </div>
              </div>

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
              </div> <!--FIM Portlet-body form">-->
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
                          id="I-IMB_CLT_OBSERVACAO" name="I-IMB_CLT_OBSERVACAO" ></textarea>
                      </div>
                    </div>
                  </div>

                </div><!-- end form-body-->
              </div><!--FIM Portlet-body form">-->
            </div>
            <div class="portlet box red">
              <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Informações Imóvel do Fiador Deixado como Garantia
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
                          <label class="control-label">Descreva as informações referentes ao imóvel( poderão aparecer no contrato)</label>
                          <textarea class="form-control" rows="3"
                          id="IMB_CLT_IMOVELGARANTIA"name="IMB_CLT_IMOVELGARANTIA"></textarea>
                      </div>
                    </div>
                  </div>

                </div><!-- end form-body-->
              </div><!--FIM Portlet-body form">-->
            <div>


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

          <div class="row">
            <div class="col-md-12">
              <div class="footer">
                <div class="form-actions div-center">
                    <button type="button" class="btn blue escondido" id="i-botao-habilitaredicao" onClick="javascript:habilitarEdicao()">Alterar</button>
                    <button type="button" class="btn default botao-confirmacao " id="i-btn-cancelar" onClick="avascript:window.close()">Cancelar</button>
                    <button type="button" class="btn blue botao-confirmacao" id="i-btn-gravar-agenda" onClick="onGravar()">
                      <i class="fa fa-check"></i> Gravar
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> <!--class="tab-pane active" id="tab_1">-->
      </div><!--class="tab-content">-->
    </div><!--class="tabbable-line boxless tabbable-reversed">-->
  </div> <!--<div class="col-md-12">-->
</div> <!-- fim row unica -->

<form style="display: none" action="{{route('cliente.edit')}}" method="POST" id="form-alt" >
@csrf
    <input type="hidden" id="id" name="id" />
    <input type="hidden" id="readonly" name="readonly"/>
</form>

<div class="modal" tabindex="-1" role="dialog" id="modalcliusu">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption">
              <i class="fa fa-gift"></i>Corretor que Atende o Cliente
            </div>
            <div class="tools">
              <a href="javascript:;" class="collapse"> </a>
            </div>
          </div>

          <div class="portlet-body form">
            <div class="form-body" >
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                  <label>Corretor</label>
                    <select class="form-control" id="i-select-corretor">
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Atendendo como</label>
                    <select  class="form-control" id="i-select-tipocliente">
                      <option value="Interessado">Interessado</option>
                      <option value="Interessado">Proprietário</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" onClick="adicionarTabCliUsu()">Adicionar</button>
      </div>
    </div>
  </div>
</div>


@include('layout.modalperfil')
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
                      <select class="form-control  input-8" id="i-tipo">
                        <option value="Residencial">Residencial</option>
                        <option value="Comercial">Comercial</option>
                        <option value="Celular">Celular</option>
                        <option value="Whatsapp">Whatsapp</option>
                        <option value="Recado">Recado</option>
                      </select>

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

    $("#sirius-menu").click();
    $('.telefone').mask('(00) 0000-00009');
      $('.telefone').blur(function(event)
      {
        if($(this).val().length == 15){ // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
          $('.telefone').mask('(00) 00000-0009');
        } else
        {
          $('.telefone').mask('(00) 0000-00009');
        }
      });

      preencherCBCorretores();


      $("#i-valorvenda").on( "change", function()
    {
      calcularMargem();
    });
    $("#i-valorlocacao").on( "change", function()
    {
      calcularMargem();
    });

    $("#i-margem").on( "change", function()
    {
      calcularMargem();
    });

    $("#i-venda").on("change", function()
    {
      if ( $("#i-venda").prop( "checked" ) )
        $("#div-valorvenda").show()
      else
        $("#div-valorvenda").hide();
    });
    $("#i-locacao").on("change", function()
    {
      if ( $("#i-locacao").prop( "checked" ) )
        $("#div-valorlocacao").show()
      else
        $("#div-valorlocacao").hide();
    });

    $("#i-select-finalidade").on("change", function()
    {
      if ( $("#i-select-finalidade").val() == 'Residencial'
          || $("#i-select-finalidade").val() == 'Temporada'
          || $("#i-select-finalidade").val() == 'Rural' )
      {
          $("#div-dormitorio").show();
          $("#div-suite").show();
      }
      else
      {
        $("#div-dormitorio").hide();
        $("#div-suite").hide();

      }
    });

    $("#i-select-tipo").on("change", function()
    {
      var areautil = [ '1','4','8','10','17','18','25','14','26','27','28','29','30','33'];
      var areatotal = [ '2','5','6','7','9','11','13','14','15','16','19','22','23','24','31','32'];
      var areaconstruida = [ '3','5','6','7','9','14','15','16','19','23','24','31','32' ];

      var selecao=$("#i-select-tipo").val();
      var opcao = areautil.indexOf(selecao )

      $("#div-areautil").hide();
      $("#div-areatotal").hide();
      $("#div-areaconstruida").hide();

      if ( areautil.indexOf(selecao ) > -1 )
        $("#div-areautil").show();

        if ( areatotal.indexOf(selecao ) > -1 )
        $("#div-areatotal").show();

        if ( areaconstruida.indexOf(selecao ) > -1 )
        $("#div-areaconstruida").show();



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


    preencherTipoImovel();
    carregarCliente();
    carregarRepresentantes();
    telefoneCarregar()
    carregarAnexos();
    if( $("#i-somenteleitura").val() == 'readonly')
    {


      
        $("#i-botao-habilitaredicao").show();
        $("#i-btn-cancelar").html('OK');
            $("#i-btn-gravar-agenda").hide();
            $('#i-form-cliente *').attr('readonly', 'readonly');
    };



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
      var sexo = $("#I-IMB_CLT_SEXO").val();

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

      if ( is_cpf( $("#I-IMB_CLT_CPF").val() ) )
      {
      }
      else
      {
        alert( 'Informe corretamente o CPF');
        $('#I-IMB_CLT_CPF').val('');
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
      const urlBuscaCEP = 'https://viacep.com.br/ws/'+cep+'/json';

      // Realizar uma requisição HTTP GET na url.
      // O primeiro parâmetro é a url.
      // O segundo parâmetro é o callback, ou seja,
      // uma função que vai ser executada quando os dados forem retornados.
      // Essa função recebe um parâmetro que são os dados que a API retornou.
      $.get(urlBuscaCEP, (resultadoCEP) => {

          $('#tipologradouro').val('');
          $('#I-IMB_CLT_RESEND').val(resultadoCEP.logradouro);
          $('#I-CEP_BAI_NOMERES').val(resultadoCEP.bairro.substr(0,19));
          $('#I-CEP_CID_NOMERES').val(resultadoCEP.localidade.substr( 0, 19 ));
          $('#I-CEP_UF_SIGLARES').val(resultadoCEP.uf);

      });

      // FIM NOVO CODIGO.
    }
  });

  //preencherClientes();

  function carregarRepresentantes()
    {
    str = $("#I-IMB_CLT_ID").val();
    var url = "{{ route('representante.carga') }}"+"/"+str;

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
     
      alert('Selecione um representante')
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
      });
      $("#modalrepresentante").modal("hide");
      carregarRepresentantes();

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
    $.getJSON( url, function( data)
    {
      for( nI=0;nI < data.length;nI++)
      {
        $("#i-telefone"+(nI+1)).val( '('+data[nI].IMB_TLF_DDD+') '+data[nI].IMB_TLF_NUMERO ) ;
        $("#i-telefone"+(nI+1)+'-tipo').val(data[nI].IMB_TLF_TIPOTELEFONE) ;
        $("#i-telefone-id"+(nI+1)).val(data[nI].IMB_TLF_ID) ;
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

      if( ! $("#i-div-perfil").is(":hidden") )
      {
        alert('Atençao! Você precisa finalizar as informações de perfil que ainda não gravou!')
        return false;
      };

      if ( $("#i-telefone1").val() == '' )
        $("#i-telefone-id1").val('');

        if ( $("#i-telefone2").val() == '' )
        $("#i-telefone-id2").val('');

        if ( $("#i-telefone3").val() == '' )
        $("#i-telefone-id3").val('');

        if ( $("#i-telefone4").val() == '' )
        $("#i-telefone-id4").val('');

        if ( $("#i-telefone5").val() == '' )
        $("#i-telefone-id5").val('');

        if ( $("#i-telefone6").val() == '' )
        $("#i-telefone-id6").val('');


      if ( $("#i-telefone1").val() == '' &&
          $("#i-telefone2").val() == '' &&
          $("#i-telefone3").val() == '' &&
          $("#i-telefone4").val() == '' &&
          $("#i-telefone5").val() == '' &&
          $("#i-telefone6").val() == '' )
          alert( 'É necessário pelo menos um telefone')
      else
      if( $("#i-telefone1").val().length < 8 )
        alert('Verifique o telefone I')
      else
      if( $("#i-telefone2").val() != '' && $("#i-telefone2").val().length < 8 )
        alert('Verifique o telefone II')
      else
      if( $("#i-telefone3").val() != '' && $("#i-telefone3").val().length < 8 )
        alert('Verifique o telefone III')
      else
      if( $("#i-telefone4").val() != '' && $("#i-telefone4").val().length < 8 )
        alert('Verifique o telefone IV')
      else
      if( $("#i-telefone5").val() != '' && $("#i-telefone5").val().length < 8 )
        alert('Verifique o telefone V')
      else
      if( $("#i-telefone6").val() != '' && $("#i-telefone6").val().length < 8 )
        alert('Verifique o telefone VI')
      else
      {

        var email = $("#IMB_CLT_EMAIL").val();

  /*      if (  email.length  < 7 )
        {
          Swal.fire({
          title: 'Email necessário',
          text: 'Informe um email para contato',
          icon: 'ok',
          confirmButtonText: 'ok'
        })
          return false;

        }
  */
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
        cpfcjg=$("#I-IMB_CLTCJG_CPF").val();
        cpfcjg = cpfcjg.replace('.','');
        cpfcjg = cpfcjg.replace('.','');
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
          IMB_CLT_EMAIL      : $("#IMB_CLT_EMAIL").val(),
          IMB_CLT_RESENDCEP      : $("#cep").val(),
          IMB_CLT_COMEND      : $("#I-IMB_CLT_COMEND").val(),
          IMB_CLT_DATNAS      : $("#I-IMB_CLT_DATANASCIMENTO").val(),
          IMB_CLT_COMNUM      : $("#I-IMB_CLT_COMNUM").val(),
          IMB_CLT_COMCOM      : $("#I-IMB_CLT_COMCOM").val(),
          IMB_CLT_COMCEP      : $("#I-IMB_CLT_COMCEP").val(),
          IMB_CLT_OBSERVACAO      : $("#I-IMB_CLT_OBSERVACAO").val(),
          IMB_CLT_CPF      : cpf,
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
          CEP_CID_NOMERES      : $("#I-CEP_CID_NOMERES").val(),
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
          CEP_CID_NOMERES      : $("#I-CEP_CID_NOMERES").val(),
          CEP_UF_SIGLA      : $("#I-IMB_CLTCJG_RGESTCEP_UF_SIGLAADO").val(),
          CEP_CID_NOMENATURAL      : $("#I-CEP_CID_NOMENATURAL").val(),
          CEP_UF_SIGLANATURAL      : $("#I-CEP_UF_SIGLANATURAL").val(),
          IMB_CLTCJG_RGESTADO      : $("#I-IMB_CLTCJG_RGESTADO").val(),
          IMB_IMB_IDAGENCIA       : $("#I-IMB_IMB_IDAGENCIA").val(),
          IMB_IMB_IDMASTER       : $("#I-IMB_IMB_IDMASTER").val(),
          IMB_CLT_PESSOA      : $("#I-IMB_CLT_PESSOA").val(),
          IMB_CLTCJG_SEXO     : $("#I-IMB_CLTCJG_SEXO").val(),
          IMB_CLT_SEXO     : $("#I-IMB_CLT_SEXO").val(),
          IMB_CLT_ATIVO     : $("#I-IMB_CLT_ATIVO").val(),
          IMB_CLT_IMOVELGARANTIA      : $("#IMB_CLT_IMOVELGARANTIA").val(),
          IMB_CLT_CIDADEIBGE       : $("#I-IMB_CLT_CIDADEIBGE").val(),
          IMB_CLT_MEI       : $("#I-IMB_CLT_MEI").prop( "checked" )   ? 'S' : 'N',
          IMB_CLT_ESTADOCIVIL       : $("#I-IMB_CLT_ESTADOCIVIL").val(),


        };

        url = "{{ route( 'cliente.salvarajax' ) }}";

        $.post( url, cliente, function(data)
        {
          telefonesSalvar( $("#I-IMB_CLT_ID").val() );
          alert('Gravado com Sucesso');
          window.close();
        });

      }

    }

    function cargaComboSexo( sexo )
    {
      $("#I-IMB_CLT_SEXO").empty();

      if ( sexo == 'M' )
        linha = '<option value="M" selected>Masculino</option>';
      else
        linha = '<option value="M">Masculino</option>';
      $("#I-IMB_CLT_SEXO").append( linha );

      if ( sexo == 'F' )
        linha = '<option value="F" selected>Feminino</option>';
      else
        linha = '<option value="F">Feminino</option>';
      $("#I-IMB_CLT_SEXO").append( linha );

    }

    function cargaComboSexocjg( sexo )
    {
      $("#I-IMB_CLTCJG_SEXO").empty();

      if ( sexo == 'M' )
        linha = '<option value="M" selected>Masculino</option>';
      else
        linha = '<option value="M">Masculino</option>';
      $("#I-IMB_CLTCJG_SEXO").append( linha );

      if ( sexo == 'F' )
        linha = '<option value="F" selected>Feminino</option>';
      else
        linha = '<option value="F">Feminino</option>';
      $("#I-IMB_CLTCJG_SEXO").append( linha );

    }

    function cargaPessoa( sexo )
    {
      $("#I-IMB_CLT_PESSOA").empty();

      if ( sexo == 'F' )
        linha = '<option value="F" selected>Física</option>';
      else
      linha = '<option value="F">Física</option>';
      $("#I-IMB_CLT_PESSOA").append( linha );

      if ( sexo == 'J' )
        linha = '<option value="J" selected>Jurídica</option>';
      else
        linha = '<option value="J">Jurídica</option>';
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
      $.getJSON( url, function( data)
      {

        if( data.IMB_IMB_ID != $("#I-IMB_IMB_IDMASTER").val() )
        {
          window.history.back();
          return false;
        }
        cargaComboSexo( data.IMB_CLT_SEXO );
        cargaComboSexocjg( data.IMB_CLTCJG_SEXO );

        cargaPessoa( data.IMB_CLT_PESSOA );
        cargaEstadoCivil( data.IMB_CLT_ESTADOCIVIL );
        cargaPerfil( data.IMB_CLT_ID );
        cargaCorretoresCliente( data.IMB_CLT_ID );

        $("#I-IMB_CLT_NOME").val( data.IMB_CLT_NOME );
        $("#I-IMB_CLT_RESEND").val( data.IMB_CLT_RESEND );
        $("#I-IMB_CLT_RESENDNUM").val( data.IMB_CLT_RESENDNUM );
        $("#I-IMB_CLT_RESENDCOM").val( data.IMB_CLT_RESENDCOM );
        $("#I-IMB_CLT_RESENDCOM").val( data.IMB_CLT_RESENDCOM );
        $("#IMB_CLT_EMAIL").val( data.IMB_CLT_EMAIL );
        $("#cep").val( data.IMB_CLT_RESENDCEP );
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
        //$("#I-IMB_ATD_ID").val( data.IMB_ATD_ID);
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
        $("#I-CEP_CID_NOMERES").val( data.CEP_CID_NOMERES);
        $("#I-CEP_UF_SIGLARES").val( data.CEP_UF_SIGLARES);
        $("#I-CEP_CID_NOMENATURAL").val( data.CEP_CID_NOMENATURAL);
        $("#I-CEP_UF_SIGLANATURAL").val( data.CEP_UF_SIGLANATURAL);
        $("#I-IMB_CLT_ATIVO").val( data.IMB_CLT_ATIVO);
        $("#IMB_CLT_IMOVELGARANTIA").val( data.IMB_CLT_IMOVELGARANTIA);
        $("#I-IMB_CLT_CIDADEIBGE").val( data.IMB_CLT_CIDADEIBGE);

        //$("#I-IMB_CLT_DTHALTERACAO").val( data.IMB_CLT_DTHALTERACAO);
        $("#i-lbl-datacadastro").html( 'Data Cadastro: '+ moment(data.IMB_CLT_DATACADASTRO).format( 'DD/MM/YYYY'));
        $("#i-lbl-codigo").html( "Referência: "+data.IMB_CLT_ID);
        $("#i-lbl-dataatualizacao").html( 'Data Atualização: '+moment(data.IMB_CLT_DTHALTERACAO).format( 'DD/MM/YYYY'));
        if( data.IMB_CLT_WHATSID != null && data.IMB_CLT_WHATSID != '' )
          $("#i-lbl-whastapp").html( 'Ident. Whastapp: '+data.IMB_CLT_WHATSID);
        
        $("#I-IMB_CLT_MEI").prop( "checked",false );
        if( data.IMB_CLT_MEI == 'S' )
          $("#I-IMB_CLT_MEI").prop( "checked",true );

      //  var url = "http://www.siriussystem.com.br/sys/atendente/find/"+data.IMB_CLT_ID

/*
      getUsuario(data.IMB_ATD_ID, function(resultado){
	          $("#i-lbl-cadastradopor").html( 'Cadastrado por '+resultado.IMB_ATD_NOME );
        });
  */

        pegarTipoCliente(data.IMB_CLT_ID, function(resultado)
        {
          var tipointeressao = resultado.INTERESSADO;
          var tipoproprietario = resultado.LOCADOR;
          var tipofiador = resultado.FIADOR;
          var tipolocatario = resultado.LOCATARIO;
          console.log('TIPO DE DADOS DO LOCADOR: '+typeof resultado.LOCADOR);
          console.log( 'lOCADOR: '+resultado.LOCADOR );

          console.log( 'INTERESSAODO: '+tipointeressao);
          console.log( 'tipoproprietario: '+tipoproprietario);
          console.log( 'tipofiador: '+tipofiador);
          console.log( 'tipolocatario: '+tipolocatario);
          console.log( 'tipo de dados locador: '+typeof tipoproprietario );
          console.log( 'tipo de dados tipointeressao: '+typeof tipointeressao );
          console.log( 'tipo de dados tipofiador: '+typeof tipofiador );
          console.log( 'tipo de dados tipolocatario: '+typeof tipolocatario );

          tipoproprietario=typeof tipoproprietario ;
          tipointeressao=typeof tipointeressao ;
          tipofiador=typeof tipofiador ;
          tipolocatario=typeof tipolocatario ;

          if(  tipointeressao=="string" )
          {
            $("#i-div-interessado").show();
          }

          if(  tipoproprietario=="string"  )
          {
            $("#i-div-prop").show();
          }
        });


/*        if ( data.IMB_CLT_PESSOA == 'J')
          $("#I-IMB_CLT_CPF").mask("99.999.999/9999-99");
        else
        $("#I-IMB_CLT_CPF").mask("999.999.999-99");
*/
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

    function cargaPerfil( id )
        {
            var url = "{{ route('cliente.perfil') }}/"+id;

            $.ajax(
            {
            url:url,
            datatype:'json',
            async:false,
            success: function( data )
            {
                linha = "";
                $("#tableperfil>tbody").empty();
                console.log('leng: '+data.length);

                for( nI=0;nI < data.length;nI++)
                {
                    var datacad = moment(data[nI].IMB_CLP_DATACADASTRO).format('DD/MM/YYYY');
                    var valorvenda =  parseFloat(data[nI].IMB_CLP_VALVENFIM);
                    valorvenda =formatarBRSemSimbolo(  valorvenda );

                    var valorlocacao =  parseFloat(data[nI].IMB_CLP_VALLOCFIM);
                    valorlocacao =formatarBRSemSimbolo(  valorlocacao );

                  linha =
                    '<tr>' +
                    '<td style="text-align:center" valign="center"> '+
                      '<a href=javascript:alterarPerfil('+data[nI].IMB_CLP_ID+') class="glyphicon glyphicon glyphicon-trash"></a> '+
                      '<a href=javascript:excluirPerfil('+data[nI].IMB_CLP_ID+') class="glyphicon glyphicon glyphicon-pencil"></a> '+
                    '</td> '+
                    '<td style="text-align:center valign="center">'+data[nI].IMB_TIM_DESCRICAO+'</td>' +
                    '<td class="div-right">'+valorvenda+'</td>' +
                    '<td class="div-right">'+valorlocacao+'</td>' +
                    '<td class="div-center">'+data[nI].IMB_IMV_FINALIDADE+'</td>' +
                    '<td class="div-center">'+data[nI].IMB_CLP_BAIRRO+'</td>' +
                    '<td class="div-center">'+data[nI].IMB_IMV_DORQUA+'</td>' +
                    '<td class="div-center">'+data[nI].IMB_IMV_SUIQUA+'</td>' +
                    '<td class="div-center">'+data[nI].IMB_IMV_GARAGEM+'</td>' +
                    '</tr>';
                $("#tableperfil").append( linha );
                }
            }
            });
        }

        function adicionarPerfil()
        {
          preencherTipoImovel();
          preecherCondominio();

          $("#modalperfil").modal('show');
          //$("#i-div-perfil").show();

        }

        function preencherTipoImovel()
        {

            $.getJSON( "{{ route('tipoimovel.carga')}}", function( data )
            {
                $("#i-select-tipo").empty();
                linha = '<option value="">Selecione....</option>'
                $("#i-select-tipo").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                    '<option value="'+data[nI].IMB_TIM_ID+'">'+
                        data[nI].IMB_TIM_DESCRICAO+"</option>";
                        $("#i-select-tipo").append( linha );

                }

            });

        }


        function preecherCondominio()
        {
          var url = "{{route('condominio.carga')}}/x";
          $.ajax(
            {
              url       : url,
              dataType  : 'json',
              type      : 'get',
              success   : function(data)
              {
                $("#i-select-condominio").empty();
                linha = '<option value="">Selecione....</option>'
                $("#i-select-condominio").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                    '<option value="'+data[nI].IMB_CND_ID+'">'+
                        data[nI].IMB_CND_NOME+"</option>";
                        $("#i-select-condominio").append( linha );
                }

              }
            });
          }

          function cargaCorretoresCliente( id )
          {
            url = "{{route('cliente.corretores')}}/"+id;
            $.ajax
            (
              {
                url       : url,
                dataType  : 'json',
                type      : 'get',
                async     : false,
                success   : function( data )
                {
                  $("#tbcluusu>tbody").empty();
                  for( nI=0;nI < data.length;nI++)
                  {
                    linha =
                    '<tr>'+
                    '   <td class="div-center"> '+
                    '       <a  class="btn btn-sm btn-danger" href=javascript:apagarCliUsu('+data[ nI ].IMB_CLU_ID+')>Apagar</a>'+
                    '   </td>'+
                    '   <td class="div-center">'+data[ nI ].IMB_ATD_ID+'</td>'+
                    '   <td class="div-center">'+data[ nI ].IMB_ATD_NOME+'</td>'+
                    '   <td class="div-center">'+data[ nI ].IMB_CLU_TIPO+'</td>'+
                    '</tr>';
                    $("#tbcluusu").append( linha );
                  }
                }
              });


          }
          function preencherCBCorretores()
    {
        var url = "{{ route('atendente.cargaativos')}}";

        $.ajax(
          {
            url     : url,
            dataType: 'json',
            type    : 'get',
            async:  false,
            success:function(data)
            {
              linha = "";
              $("#i-select-corretor").empty();
              for( nI=0;nI < data.length;nI++)
              {
                linha =
                  '<option value="'+data[nI].IMB_ATD_ID+'">'+
                  data[nI].IMB_ATD_NOME+"</option>";
                  $("#i-select-corretor").append( linha );
              }   ;
            }

        });
    }

    function adicionarCliUsu()
    {
      $("#modalcliusu").modal('show');
      $("#i-select-corretor").val( "{{Auth::user()->IMB_ATD_ID}}" );
      $("#i-select-tipocliente").val('Interessado');
    }

    function apagarCliUsu( id )
    {
      if (confirm("Tem certeza que deseja excluir?"))
      {

        var url = "{{route('cliente.corretores.deletar')}}";

        $.ajaxSetup({
            headers:
            {
              'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
          });


        $.ajax(
          {
            url     : url,
            type    : 'post',
            dataType: 'json',
            data    : { 'IMB_CLU_ID' : id },
            async:  false,
            success : function()
            {
              console.log('excluindo '+id );
              cargaCorretoresCliente( id );
            }
          });
        }

    }

    function adicionarTabCliUsu()
    {
      var url = "{{route('cliente.corretores.salvar')}}";

      var dados =
      {
        IMB_ATD_ID    : $("#i-select-corretor").val(),
        IMB_CLT_ID    : $('#I-IMB_CLT_ID').val(),
        IMB_CLU_TIPO  : $("#i-select-tipocliente").val(),
      }

      $.ajaxSetup(
      {
        headers:
        {
          'X-CSRF-TOKEN': "{{csrf_token()}}"
        }
      });

      $.ajax(
        {
          url : url,
          type:'post',
          dataType:'json',
          data:dados,
          async:false,
          success:function()
          {
            $("#modalcliusu").modal('show');
            cargaCorretoresCliente($('#I-IMB_CLT_ID').val());
          }
        }
      );
    }

    function telefonesSalvar( nId )
  {


    var telefones = [];

    if( $("#i-telefone1").val() != '' )
    {
          // Criar objeto para armazenar os dados (com JSON essa tarefa fica mais simples)
      var tel = $("#i-telefone1").val();
      var pos = tel.indexOf("-");
      var ddd = tel.substr(1,2);
      if( pos ==-1 )
        var telefone = tel.substr(5,11)
      else
        var telefone = tel.substr(5,pos-1-4)+tel.substr(pos+1,4);

      telefones.push( [ ddd, telefone, $("#i-telefone1-tipo").val(), $("#i-telefone-id1").val() ] )
      console.log('telefone 1'+$("#i-telefone1").val() );
      console.log('array '+telefones );
    }

    if( $("#i-telefone2").val() != '' )
    {
          // Criar objeto para armazenar os dados (com JSON essa tarefa fica mais simples)
      var tel = $("#i-telefone2").val();
      var pos = tel.indexOf("-");
      var ddd = tel.substr(1,2);
      if( pos ==-1 )
        var telefone = tel.substr(5,11)
      else
        var telefone = tel.substr(5,pos-1-4)+tel.substr(pos+1,4);

      telefones.push( [ ddd, telefone, $("#i-telefone2-tipo").val(), $("#i-telefone-id2").val() ] )
    }

    if( $("#i-telefone3").val() != '' )
    {
          // Criar objeto para armazenar os dados (com JSON essa tarefa fica mais simples)
      var tel = $("#i-telefone3").val();
      var pos = tel.indexOf("-");
      var ddd = tel.substr(1,2);
      if( pos ==-1 )
        var telefone = tel.substr(5,11)
      else
        var telefone = tel.substr(5,pos-1-4)+tel.substr(pos+1,4);

      telefones.push( [ ddd, telefone, $("#i-telefone3-tipo").val(), $("#i-telefone-id3").val() ] )
    }

    if( $("#i-telefone4").val() != '' )
    {
          // Criar objeto para armazenar os dados (com JSON essa tarefa fica mais simples)
      var tel = $("#i-telefone4").val();
      var pos = tel.indexOf("-");
      var ddd = tel.substr(1,2);
      if( pos ==-1 )
        var telefone = tel.substr(5,11)
      else
        var telefone = tel.substr(5,pos-1-4)+tel.substr(pos+1,4);

      telefones.push( [ ddd, telefone, $("#i-telefone4-tipo").val(), $("#i-telefone-id4").val() ] )
    }

    if( $("#i-telefone5").val() != '' )
    {
          // Criar objeto para armazenar os dados (com JSON essa tarefa fica mais simples)
      var tel = $("#i-telefone5").val();
      var pos = tel.indexOf("-");
      var ddd = tel.substr(1,2);
      if( pos ==-1 )
        var telefone = tel.substr(5,11)
      else
        var telefone = tel.substr(5,pos-1-4)+tel.substr(pos+1,4);

      telefones.push( [ ddd, telefone, $("#i-telefone5-tipo").val(), $("#i-telefone-id5").val() ] )

    }

    if( $("#i-telefone6").val() != '' )
    {
          // Criar objeto para armazenar os dados (com JSON essa tarefa fica mais simples)
      var tel = $("#i-telefone6").val();
      var pos = tel.indexOf("-");
      var ddd = tel.substr(1,2);
      if( pos ==-1 )
        var telefone = tel.substr(5,11)
      else
        var telefone = tel.substr(5,pos-1-4)+tel.substr(pos+1,4);
      telefones.push( [ ddd, telefone, $("#i-telefone6-tipo").val(), $("#i-telefone-id6").val() ] )
    }




    var dados =
    {
      numeros : telefones,
      IMB_CLT_ID : nId,
    }

    $.ajaxSetup(
      {
        headers:
        {
          'X-CSRF-TOKEN': "{{csrf_token()}}"
        }
      });

    var url = "{{route('telefone.salvarlote')}}";


    $.ajax(
      {
        url     : url,
        type    : 'post',
        dataType:'json',
        data: dados,
        success : function data()
        {

        },
        error   : function()
        {
          //alert('erro gravacao fone' )
        }

      }
    )

    console.log( telefones );

  }

  function cancelarPerfil()
  {
    $("#modalperfil").modal('hide');
  }

  function calcularMargem()
  {
    var margem = parseFloat($("#i-margem").val());

    var valorlocacao = parseFloat(realToDolar( $("#i-valorlocacao").val() ));
    var valorvenda = parseFloat(realToDolar( $("#i-valorvenda").val() ));

    $("#i-margemvenda").html( '' );
    $("#i-margemlocacao").html( '' );

    if( valorvenda != 0 && (! isNaN(valorvenda)) )
    {
      console.log('valorvenda '+valorvenda);
      var margemini = valorvenda - ( valorvenda * margem / 100 );
      var margemfim = valorvenda + ( valorvenda * margem / 100 );
      $("#i-margemvenda").html( 'De: '+formatarBRSemSimbolo( margemini )+
                              ' a: '+formatarBRSemSimbolo( margemfim ));
      $("#i-venda-minima").val(margemini);
      $("#i-venda-maxima").val(margemfim);

    }
    if( valorlocacao != 0 && (! isNaN(valorlocacao)) )
    {
      console.log('valorlocacao '+valorlocacao);
      var margemini = valorlocacao - ( valorlocacao * margem / 100 );
      var margemfim = valorlocacao + ( valorlocacao * margem / 100 );
      $("#i-margemlocacao").html( 'De: '+formatarBRSemSimbolo( margemini )+
                              ' a: '+formatarBRSemSimbolo( margemfim ));


      $("#i-locacao-minima").val(margemini);
      $("#i-locacao-maxima").val(margemfim);

    }

  }

  function gravarPerfil()
  {

    if ( ( ! $("#i-venda").prop( "checked" ) )  &&
         ( ! $("#i-locacao").prop( "checked" ) )  )
      alert('Informe se a procura é para comprar ou para alugar')
    else
    if ( $("#i-venda").prop( "checked" ) && $("#i-valorvenda").val()=='')
      alert( 'Informe o valor de venda que procura')
    else
    if ( $("#i-locacao").prop( "checked" ) && $("#i-valorlocacao").val()=='')
      alert( 'Informe o valor de locacao que procura')
    else
    if ( $("#i-regiao").val()=='' )
      alert( 'Informe a Região')
    else
    if ( $("#i-select-finalidade").val()=='' )
      alert( 'Informe a Finalidade')
    else
    if ( $("#i-select-tipo").val()=='' )
      alert( 'Informe o tipo de imóvel')
    else
    {
      dados =
      {

        IMB_CLT_ID: $('#I-IMB_CLT_ID').val(),
        IMB_CLP_VALVENINI : $("#i-venda-minima").val(),
        IMB_CLP_VALVENFIM : $("#i-venda-maxima").val(),
        IMB_CLP_VALLOCINI: $("#i-locacao-minima").val(),
        IMB_CLP_VALLOCFIM: $("#i-locacao-maxima").val(),
        IMB_TIM_ID  : $("#i-select-tipo").val(),
        IMB_IMV_FINALIDADE  : $("#i-select-finalidade").val(),
        REGIAO  : $("#i-regiao").val(),
        IMB_IMV_DORQUA  : $("#i-Dormitorio").val(),
        IMB_IMV_GARAGEM  : $("#i-garagem").val(),
        IMB_IMV_SUIQUA  : $("#i-suite").val(),
        IMB_IMV_AREUTI  : $("#i-area-util").val(),
        IMB_CLP_AREACONSTRUIDA  : $("#i-area-construida").val(),
        IMB_CLP_AREATOTAL  : $("#i-area-total").val(),
        IMB_IMV_EMCONDOMINIO :$("#i-condominio-fechado").val(),
      }

      $.ajaxSetup(
        {
          headers:
          {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
          }
        });

      var url = "{{route('cliente.perfil.gravar')}}";

      $.ajax(
        {
          url     : url,
          dataType: 'json',
          type    : 'post',
          data    : dados,
          success : function( data )
          {
            $("#modalperfil").modal('hide');
            cargaPerfil( $('#I-IMB_CLT_ID').val() );
          },
          error:function()
          {
            alert('Erro para gravar o perfil');
          }
        }
      );
    }

  }

  function apagarFone( rec )
  {
    var id= $("#i-telefone-id"+rec).val();

    telefoneApagar( id );

    $("#i-telefone-id"+rec).val('');
    $("#i-telefone"+rec).val('');
    $("#i-telefone"+rec+"-tipo").val('');

  }

  function habilitarEdicao()
  {
    $("#id").val( $("#I-IMB_CLT_ID").val() );
    $("#readonly").val('N');
    $("#form-alt").submit();

  }

</script>



@endpush
