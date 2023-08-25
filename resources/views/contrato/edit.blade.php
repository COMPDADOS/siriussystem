@extends('layout.app')

@section('scripttop')
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

@endsection
@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="#">Gerenciamento</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Contratos</span>
        </li>
    </ul>
</div>

<div class="w3-bar w3-black">
    <button class="w3-bar-item w3-button tablink" onclick="openOption(event,'imovel')">Dados do Imovel</button>
    <button class="w3-bar-item w3-button tablink w3-red" onclick="openOption(event,'contrato')">Dados contratuais</button>
    <button class="w3-bar-item w3-button tablink" onclick="openOption(event,'locador')">Locadores</button>
    <button class="w3-bar-item w3-button tablink" onclick="openOption(event,'locatario')">Locatários</button>
    <button class="w3-bar-item w3-button tablink" onclick="openOption(event,'fiador')">Fiadores</button>
    <button class="w3-bar-item w3-button tablink" onclick="openOption(event,'captador')">Captadores/Corretores</button>
    <button class="w3-bar-item w3-button tablink" onclick="openOption(event,'juridico')">Jurídico</button>
    <button class="w3-bar-item w3-button tablink" onclick="openOption(event,'obs')">Observações</button>
</div>
<div class="row">
    <hr>
</div>

<div id="imovel" class="w3-container w3-border opcao"  style="display:none">
    
    <div class="portlet box blue-dark">
        <div class="row">
            <div class="col-md-1">
            </div>
        </div>
        
        <div class="portlet-title">

            <div class="caption">
                <i class="fa fa-gift"></i>Dados do Imóvel
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
            </div>


        </div>
        
        <div class="portlet-body form">
            <div class="form-body" id="galeria-imovel">
            </div>
            <table class="table" id="tblimagens">
                <thead class="thead-dark">
                    <tr>
                        <th >Titulo</th>
                        <th width="250" >Imagem</th>
                        <th width="250" style="text-align:center"> Ações </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div id="contrato" class="w3-container w3-border opcao">
    <div class='col-md-3 bg-info border border-dark'>
        <input type="hidden" id="i-codigo-imovel" value="{{$contrato->IMB_IMV_ID}}">
        <input type="hidden" id="i-codigo-contrato" value="{{$contrato->IMB_CTRID}}">
        <h6>Pasta: {{ $contrato->IMB_CTR_REFERENCIA}} <br>Imóvel: {{$contrato->IMB_IMV_ID}}</h6>
    </div>
    <div class='col-md-3 bg-info border border-dark' >
        <h6>Locador:<br> {{ $contrato->PROPRIETARIO}}</h6>
    </div>
    <div class='col-md-3 bg-info border border-dark'>
        <h6>Locatário:<br> {{'MARA SUELI'}}</h6>
    </div>
    <div class='col-md-3 bg-info border border-dark'>
        <h6>Fiador:<br> {{'Lindomar'}}</h6>
    </div>
    <div class="portlet box blue-dark">
        <div class="portlet-body form">

            <div class="tabbable-custom nav-justified">
                <ul class="nav nav-pills nav-justified">
                    <li class="active">
                        <a href="#tabvalor" data-toggle="tab">Valor/Vencto/Tolerância</a>
                    </li>
                    <li>
                        <a href="#tabdatas" data-toggle="tab">Duração/Período/Datas</a>
                    </li>
                    <li>
                        <a href="#tabtaxas" data-toggle="tab">Taxa Adm./Taxa Contrato</a>
                    </li>
                    <li>
                        <a href="#tabdescontos" data-toggle="tab">Descontos</a>
                    </li>
                    <li>
                        <a href="#tabmulta" data-toggle="tab">Multa/Encargos</a>
                    </li>
                    <li>
                        <a href="#tabiptu" data-toggle="tab">Iptu</a>
                    </li>
                    <li>
                        <a href="#tabimpostos" data-toggle="tab">Impostos</a>
                    </li>
                    <li>
                        <a href="#tabdiversos" data-toggle="tab">+ Informações/Obs.</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tabvalor">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group" >
                                        <label class="control-label">Valor R$</label>
                                        <input id="i-valor" 
                                            name="IMB_CTR_VALOR" class="form-control">
                                    </div>
                                </div>            
                                
                                <div class="col-md-2">
                                    <div class="form-group" >
                                        <label class="control-label">Finalidade</label>
                                        <select class="form-control" 
                                            class="form-control" name="IMB_CTR_FINALIDADE" 
                                            id="i-select-finalidade">
                                            <option value="Residencial">Residencial</option>
                                            <option value="Comercial">Comercial</option>
                                        </select>
                                    </div>
                                </div>            
                
                                <div class="col-md-1">
                                    <div class="form-group" >
                                        <label class="control-label">Dia</label>
                                        <input type="number" min="1" max="31" id="i-dia-vencimento" 
                                            name="IMB_CTR_DIAVENCIMENTO" class="form-control">
                                            <span>Vencto</span>
                                    </div>
                                </div>            

                                <div class="col-md-1">
                                    <div class="form-group" >
                                        <label class="control-label">Toler.</label>
                                        <input type="number"id="i-tolerancia"   
                                            name="IMB_CTR_TOLERANCIA" class="form-control">
                                            <span>Dias</span>
                                    </div>
                                </div>            
                
                                <div class="form-group">
                                    <label>Método Tolerância</label>
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="optionsRadios" id="optionsRadios4" value="1" checked> Dias Corridos
                                            <span></span>
                                        </label>

                                        <label class="mt-radio">
                                            <input type="radio" name="optionsRadios" id="optionsRadios5" value="2"> Dia do Mês
                                            <span></span>
                                        </label>
                                        <label class="mt-radio mt-radio-disabled">
                                            <input type="radio" name="optionsRadios" id="optionsRadios6" value="3"> Dias Úteis
                                            <span></span>
                                        </label>
                                        <label class="mt-radio mt-radio-disabled">
                                            <input type="radio" name="optionsRadios" id="optionsRadios6" value="4"> Antecipado
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>

                    <div class="tab-pane" id="tabdatas">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group" >
                                        <label class="control-label">Data Locação</label>
                                        <input type="text" id="i-datalocacao" 
                                            name="IMB_CTR_DATALOCACAO" class="form-control"
                                            readonly>
                                    </div>
                                </div>            

                                <div class="col-md-1">
                                    <div class="form-group" >
                                        <label class="control-label">Duração</label>
                                        <input id="i-duracao" 
                                            name="IMB_CTR_DURACAO" class="form-control">
                                        <span>Meses</span>
                                    </div>
                                </div>            
                                <div class="col-md-3">
                                    <div class="form-group" >
                                        <label class="control-label">Início</label>
                                        <input type="date" id="i-inicio" 
                                            name="IMB_CTR_INICIO" class="form-control">
                                    </div>
                                </div>            
                                <div class="col-md-3">
                                    <div class="form-group" >
                                        <label class="control-label">Término</label>
                                        <input type="date"  id="i-termino" 
                                            name="IMB_CTR_TEMINO" class="form-control">
                                    </div>
                                </div>            
                                <div class="col-md-3">
                                    <div class="form-group" >
                                        <label class="control-label">1º Vencto.</label>
                                        <input type="date"  id="i-primeirovencimento" 
                                            name="IMB_CTR_PRIMEIROVENCIMENTO" class="form-control">
                                    </div>
                                </div>            
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group" >
                                        <label class="control-label">Forma de Reajueste</label>
                                        <select class="form-control" 
                                            class="form-control" name="IMB_CTR_FORMAREAJUSTE" 
                                            id="i-select-formareajuste">
                                            <option value="1">Mensal</option>
                                            <option value="3">Trimestral</option>
                                            <option value="6">Semestral</option>
                                            <option value="12">Anual</option>
                                        </select>
                                    </div>
                                </div>            

                                <div class="col-md-3">
                                    <div class="form-group" >
                                        <label class="control-label">Próximo Reajuste</label>
                                        <input type="date"  id="i-proximoreajuste" 
                                            name="IMB_CTR_DATAREAJUSTE" class="form-control">
                                    </div>
                                </div>            
                                <div class="col-md-3">
                                    <div class="form-group" >
                                        <label class="control-label">Índice</label>
                                        <select class="form-control" 
                                            class="form-control" name="IMB_IRJ_ID" 
                                            id="i-select-indicereajuste">
                                        </select>
                                    </div>
                                </div>            
                                <div class="col-md-3">
                                    <div class="form-group" >
                                        <input type="checkbox" id="i-maiorindice"
                                        name="IMB_CTR_MAIORINDICE" class="icheck" data-checkbox="icheckbox_flat-blue">
                                        Pelo Maior Índice
                                    </div>
                                </div>            
                            </div>                            
                        </div>
                    </div>
                    <div class="tab-pane" id="tabmulta">
                        <div class="form-body">
                            <div class="row">
                            <div class="col-md-3">
                                    <div class="form-group" >
                                        <label class="control-label">% Multa</label>
                                        <input type="number" id="i-multapercenctual" 
                                            name="IMB_CTR_MULTA" class="form-control">
                                    </div>
                                </div>            
                                <div class="col-md-2">
                                    <div class="form-group" >
                                        <label class="control-label">% Juros/Dia</label>
                                        <input  type="number" id="i-jurosdia" 
                                                name="IMB_CTR_JUROS" class="form-control">
                                    </div>
                                </div>            
                                <div class="col-md-2">
                                    <div class="form-group" >
                                        <label class="control-label">Dias Protestar</label>
                                        <input  type="number" id="i-diasprotesto" 
                                                name="IMB_CTR_DIASPROTESTO" class="form-control">
                                    </div>
                                </div>  
                                <div class="col-md-5">
                                    <div class="form-group" >
                                        <label class="control-label">As informações deste quadro
                                        só dizem respeito a este contrato. Se nada for 
                                        informado, irá valer as regras gerais 
                                        para cobrança de multa e juros.</label>
                                    </div>
                                </div>  
                            </div>                            
                        </div>
                    </div>

                    <div class="tab-pane" id="tabdiversos">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-1">
                                    <div class="form-group" >
                                        <input type="checkbox" class="form-check-input" id="i-fci"
                                        name="IMB_CTR_FCI"  >
                                        F.C.I.
                                    </div>
                                </div>            
                                <div class="col-md-2">
                                    <div class="form-group" >
                                        <input type="checkbox" class="form-check-input" id="i-juridico"
                                        name="IMB_CTR_ADVOGADO"  >
                                        No Depto. Jurídico
                                    </div>
                                </div>            
                                <div class="col-md-2">
                                    <div class="form-group" >
                                        <input type="checkbox" class="form-check-input" id="i-juridico"
                                        name="IMB_CTR_IPTUINCLUSO"  >
                                        Com IPTU Incluso
                                    </div>
                                </div>            
                                <div class="col-md-2">
                                    <div class="form-group" >
                                        <input type="checkbox" class="form-check-input" id="i-juridico"
                                        name="IMB_CTR_IPTUINCLUSO"  >
                                        Com Pintura Nova
                                    </div>
                                </div>            
                                <div class="col-md-2">
                                    <div class="form-group" >
                                        <input type="checkbox" class="form-check-input" id="i-spc"
                                        name="IMB_CTR_SPC"  >
                                        Negativado SPC/Serasa
                                    </div>
                                </div>            
                                <div class="col-md-3">
                                    <div class="form-group" >
                                        <input type="checkbox" class="form-check-input" id="i-12meses"
                                        name="IMB_CTR_CLAUSULA12MESES"  >
                                        Com cláusula de liberação após 12 Meses
                                    </div>
                                </div>            
                            </div>                            
                            <div class="portlet box blue-dark">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>Observações para o Contrato
                                    </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group" >
                                                <label class="control-label">Observação para o Locatário(recibo e tela)</label>
                                                <input type="text" maxlength="100" id="i-obslocatario" 
                                                    name="IMB_CTR_OBSERVACAOLOCATARIO" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group" >
                                                <label class="control-label">Observação para o Locador(recibo e tela)</label>
                                                <input type="text" maxlength="100"  id="i-obslocador" 
                                                    name="IMB_CTR_OBSERVACAOLOCADOR" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group" >
                                                <label class="control-label">Observação para o Imóvel</label>
                                                <input type="texto" maxlength="100"  id="i-obsimovel" 
                                                    name="IMB_CTR_OBSERVACAO" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                        </div>
                    </div>

                    <div class="tab-pane" id="tabdescontos">
                        <div class="form-body">
                            <div class="row">
                                 <div class="col-md-3">
                                    <div class="form-group" >
                                        <label class="control-label">Desconto Pontualidade</label>
                                        <select class="form-control" 
                                            class="form-control" name="IMB_CTR_BONIFICACAOTIPO" 
                                            id="i-select-bonificacao">
                                            <option value="V">Em valor R$</option>
                                            <option value="P">Em Percentual %</option>
                                        </select>
                                    </div>
                                </div>            
                                <div class="col-md-2">
                                    <div class="form-group" >
                                        <input type="checkbox" class="form-check-input" id="i-juridico"
                                        name="IMB_CTR_IPTUINCLUSO"  >
                                        Com IPTU Incluso
                                    </div>
                                </div>            
                                <div class="col-md-3">
                                    <div class="form-group" >
                                        <label class="control-label">Valor do Desconto</label>
                                        <input type="number"  id="i-bonificacaovalor" 
                                            name="IMB_CTR_VALORBONIFICACAO4" class="form-control">
                                    </div>
                                </div>            
    
                                <div class="col-md-3">
                                    <div class="form-group" >
                                        <label class="control-label">Validade do Desconto</label>
                                        <input type="date"  id="i-bonificacaovalidade" 
                                            name="IMB_CTR_PONTUALIDADEVALIDADE" class="form-control">
                                    </div>
                                </div>            
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="tabiptu">
                        <div class="form-body">
                            <div class="row">
                                 <div class="col-md-2">
                                    <div class="form-group" >
                                        <label class="control-label">Posse do Carnê</label>
                                        <select class="form-control" 
                                            class="form-control" name="IMB_CTR_IPTUPOSSECARNE" 
                                            id="i-select-possecarne">
                                            <option value="0">Não Informado</option>
                                            <option value="1">Locador</option>
                                            <option value="3">Locatário</option>
                                        </select>
                                    </div>
                                </div>            

                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="form-group" >
                                                    <label class="control-label">Número</label>
                                                <input type="text"  id="i-iptu1numero" 
                                                    name="IMB_IMV_IPTU1" class="form-control">
                                        </div>
                                        <div class="form-group" >
                                                <label class="control-label">Referente</label>
                                                <input type="text"  id="i-iptu1referente" 
                                                    name="IMB_IMV_IPTU1REFERENTE" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="form-group" >
                                                <label class="control-label">Número</label>
                                                <input type="text"  id="i-iptu2numero" 
                                                    name="IMB_IMV_IPTU2" class="form-control">
                                        </div>
                                        <div class="form-group" >
                                                <label class="control-label">Referente</label>
                                                <input type="text"  id="i-iptu2referente" 
                                                    name="IMB_IMV_IPTU2REFERENTE" class="form-control">
                                        </div>
                                    </div>
                                </div>                                    
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="form-group" >
                                                <label class="control-label">Número</label>
                                                <input type="text"  id="i-iptu3numero" 
                                                    name="IMB_IMV_IPTU3" class="form-control">
                                        </div>
                                        <div  class="form-group" >
                                                <label class="control-label">Referente</label>
                                                <input type="text"  id="i-iptu3referente" 
                                                    name="IMB_IMV_IPTU3REFERENTE" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="form-group" >
                                                <label class="control-label">Número</label>
                                                <input type="text"  id="i-iptu4numero" 
                                                    name="IMB_IMV_IPTU4" class="form-control">
                                        </div>
                                        <div  class="form-group" >
                                                <label class="control-label">Referente</label>
                                                <input type="text"  id="i-iptu4referente" 
                                                    name="IMB_IMV_IPTU4REFERENTE" class="form-control">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="tabimpostos">
                        <div class="form-body">
                            <div class="row">
                                 <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="form-group" >
                                            <input type="checkbox" class="form-check-input" id="i-dimob"
                                            name="IMB_IMV_RELIRRF"  >
                                            Constar na DIMOB
                                        </div>
                                        <div class="form-group" >
                                            <input type="checkbox" class="form-check-input" id="i-iss"
                                            name="IMB_IMV_RELISS"  >
                                            Exibir no Relat. Mensal ISS
                                        </div>
                                        <div class="form-group" >
                                            <input type="checkbox" class="form-check-input" id="i-calcularirrf"
                                            name="IMB_CTR_IRRF"  >
                                            Cálcular IRRF Recto./Repasse
                                        </div>
                                        <div class="form-group" >
                                            <input type="checkbox" class="form-check-input" id="i-naoemitirnfe"
                                            name="IMB_CTR_NAOEMITIRNFE"  >
                                            Não Emitir NFE
                                        </div>
                                        <div class="form-group" >
                                            <input type="checkbox" class="form-check-input" id="i-reteriss"
                                            name="IMB_CTR_CALISS"  >
                                            Reter ISS no repasse
                                        </div>
                                    </div>
                                </div>            

                                <div class="col-md-1">
                                </div>
                                <div class="col-md-3">
                                    As informações ao lado é para calculo apenas deste contrato. 
                                    Se preenchida as informações, o sistema irá ignorar a tabela
                                    informada em "Tabelas Auxiliares"
                                </div>            


                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="form-group" >
                                            Aliquota IRRF
                                            <input type="number" class="form-check-input" id="i-aliquotairrf"
                                            name="IMB_CTR_IRPERC"  >
                                            
                                        </div>
                                        <div class="form-group" >
                                            Aliquota COFINS
                                            <input type="number" class="form-check-input" id="i-aliquotacofins"
                                            name="IMB_CTR_COFINS"  >
                                            
                                        </div>
                                        <div class="form-group" >
                                            Aliquota Assistencial
                                            <input type="number" class="form-check-input" id="i-assistencial"
                                            name="IMB_CTR_CONTSIND"  >
                                        </div>
                                        <div class="form-group" >
                                            Aliquota P.I.S.
                                            <input type="number" class="form-check-input" id="i-pis"
                                            name="IMB_CTR_PIS"  >
                                        </div>
                                    </div>
                                </div>            

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="tabtaxas">
                        <div class="form-body">
                            <div class="portlet box blue-dark">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>Taxa Administrativa
                                    </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>

                                
                                <div class="portlet-body form">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="input-group">
                                                <div class="form-group" >
                                                    <label class="control-label">Taxa Administrativa</label>
                                                    <input type="number"  id="i-taxaadministrativa" 
                                                    name="IMB_CTR_TAXAADMINISTRATIVA" class="form-control">
                                                </div>
                                                <div class="form-group" >
                                                    <label class="control-label">Método</label>
                                                    <select class="form-control" 
                                                        class="form-control" name="IMB_CTR_FINALIDADE" 
                                                        id="i-select-metodotaxa">
                                                        <option value="P">Percentual</option>
                                                        <option value="V">Valor</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                             <table class="table table-bordered" id="tbltaxaitens">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th width="700" style="text-align:center">Ítem</th>
                                                        <th width="150" style="text-align:center">Percentual</th>
                                                        <th width="250" style="text-align:center"> Ações </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <button type="submit" 
                                                        class="btn btn-primary btn-sm"
                                                         type="button">Novo Ítem Diferenciado</button>
                                                </tfoot>                                                
                                            </table>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <div class="form-group" >
                                                    <label class="control-label">Valor a Agregar no Aluguel</label>
                                                    <input type="number"  id="i-valoragregar" 
                                                    name="IMB_IMV_ALUGUELAGREGAR" class="form-control">
                                                </div>
                                                <div class="input-group">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group" >
                                                                <label class="control-label">Efeito Locador</label>
                                                                <select class="form-control" 
                                                                    class="form-control" name="IMB_IMV_AGREGADOLDCREDEB" 
                                                                    id="i-select-agregarefeitold">
                                                                    <option value="N">Nada</option>
                                                                    <option value="C">Crédito</option>
                                                                    <option value="D">Débito</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group" >
                                                                <label class="control-label">Efeito Locatário</label>
                                                                <select class="form-control" 
                                                                    class="form-control" name="IMB_IMV_AGREGADOLTCREDEB" 
                                                                    id="i-select-agregarefeitolt">
                                                                    <option value="N">Nada</option>
                                                                    <option value="C">Crédito</option>
                                                                    <option value="D">Débito</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group" >
                                                                <label class="control-label">Tx. Renovação</label>
                                                                <input type="number"  id="i-taxarenovacao" 
                                                                    name="IMB_CTR_PERTAXRENREA" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group" >
                                                                <label class="control-label">Tar.Deposito</label>
                                                                    <input type="number"  id="i-tarifadeposito" 
                                                                    name="IMB_IMV_TARIFADEPOSITO" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="portlet box blue-dark">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>Taxa de Contrato
                                    </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                
                                <div class="portlet-body form">
                                    <table class="table table-bordered" id="tbltaxacontrato">
                                        <thead class="thead-light">
                                            <tr>
                                                <th >Vencimento</th>
                                                <th >Valor</th>
                                                <th >Já Cobrado</th>
                                                <th >Cobrar Também Tx Adm. no Mesmo Mês  </th>
                                                <th >Incide no Cálculo da Tx Adm.  </th>
                                                <th >Observação  </th>
                                                <th width="250" style="text-align:center"> Ações </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>



<div id="locador" class="w3-container w3-border opcao" style="display:none"> 
    <div class="portlet box blue-dark">
        <div class="row">
            <div class="col-md-1">
            </div>
        </div>
        
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Informações de Locadores
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
            </div>
        </div>
        
        <div class="portlet-body form">
            <div class="form-body" >
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered" id="tbllocadores">
                            <thead class="thead-dark">
                            <tr>
                                <th width="400" style="text-align:center">Proprietário</th>
                                <th width="50" style="text-align:center">% Partic.</th>
                                <th width="20" style="text-align:center">Princ.</th>
                                <th width="100" style="text-align:center">Forma Pagto.</th>
                                <th width="100" style="text-align:center">Banco</th>
                                <th width="40" style="text-align:center">Agência</th>
                                <th width="30" style="text-align:center">DV</th>
                                <th width="100" style="text-align:center">Conta</th>
                                <th width="30" style="text-align:center">DV</th>
                                <th width="300" style="text-align:center">Correntista</th>
                                <th width="100" style="text-align:center">CPF/CNPJ</th>
                                <th width="200" style="text-align:center"> Ações </th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
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
                <i class="fa fa-gift"></i>Dados para Repasses
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
            </div>
        </div>
        
        <div class="portlet-body form">
            <div class="form-body" >
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="col-md-4">
                                <div class="form-group" >
                                    <label class="control-label">Data Base Próximo Repasse</label>
                                    <input type="text"  id="i-vencimentolocador" 
                                        name="IMB_CTR_VENCIMENTOLOCADOR" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" >
                                    <label class="control-label">Dias Pra Repassar</label>
                                    <input type="number"  id="i-diasrepassar" 
                                        name="IMB_CTR_REPASSEDIA" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" >
                                    <input type="checkbox" id="i-diautil"
                                        name="IMB_CTR_REPASSEUTIL" class="icheck" data-checkbox="icheckbox_flat-blue">
                                        Contar como dias úteis
                                </div>
                            </div>            
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    <div class="portlet box blue-dark">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Dados para dia fixo (concentração de repasses)
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
            </div>
        </div>

        <div class="portlet-body form">
            <div class="form-body" >
                <div class="row">   
                <div class="col-md-3">
                        <div class="form-group" >
                            <input type="number" id="i-diafixo"
                                name="IMB_CTR_REPASSEDIAFIXO">
                                Dia Fixo
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" >
                            <input type="text" id="i-proximorepassefixo"
                                name="IMB_CTR_PROXIMOREPASSE">
                                Próximo Repasse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div id="locatario" class="w3-container w3-border opcao" style="display:none"> 
<div class="portlet box blue-dark">
        <div class="row">
            <div class="col-md-1">
            </div>
        </div>
        
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Informações de Locatários
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
            </div>
        </div>
        
        <div class="portlet-body form">
            <div class="form-body" >
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered" id="tbllocatário">
                            <thead class="thead-dark">
                            <tr>
                                <th width="400" style="text-align:center">Locatário</th>
                                <th width="50" style="text-align:center">% Partic.</th>
                                <th width="20" style="text-align:center">Princ.</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group" >
                                        <label class="control-label">Forma de Recebimento</label>
                                        <select class="form-control" 
                                                class="form-control" name="IMB_FORPAG_ID_LOCATARIO" 
                                                id="i-select-forpag-locatario">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" >
                                        <label class="control-label">Conta de Cobrança</label>
                                        <select class="form-control" 
                                                class="form-control" name="FIN_CCR_ID_COBRANCA" 
                                                id="i-select-contacobranca">
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="form-group" >
                                <input type="checkbox" id="i-cobrantarifaboleto"
                                        name="IMB_CTR_COBRARBOLETO" class="icheck" data-checkbox="icheckbox_flat-blue">
                                        Cobrar Tar.Boleto
                            </div>
                            <div class="form-group" >
                                <label class="control-label">Valor Boleto</label>
                                <input class="form-control" type="number" id="i-valorboleto"
                                            name="IMB_CTR_COBRANCAVALOR" >
                            </div>
                        </div>            
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" >
                            <input type="checkbox" id="i-boletoviaemail"
                                        name="IMB_CTR_BOLETOVIAEMAIL" class="icheck" data-checkbox="icheckbox_flat-blue">
                                        Boleto via email
                        </div>
                    </div>            
                    <div class="col-md-3">
                        <div class="form-group" >
                            <input type="checkbox" id="i-boletoimpresso"
                                        name="IMB_CTR_IMPRIMIRBOLETO" class="icheck" data-checkbox="icheckbox_flat-blue">
                                        Boleto Impresso
                        </div>
                    </div>            
                </div>
            </div>
        </div>
    </div>
    <div class="portlet box blue-dark">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Endereço de Cobrança
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
            </div>
        </div>
        
        <div class="portlet-body form">
            <div class="form-body" >
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="col-md-4">
                                <div class="form-group" >
                                    <label class="control-label">Data Base Próximo Repasse</label>
                                    <input type="text"  id="i-vencimentolocador" 
                                        name="IMB_CTR_VENCIMENTOLOCADOR" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" >
                                    <label class="control-label">Dias Pra Repassar</label>
                                    <input type="number"  id="i-diasrepassar" 
                                        name="IMB_CTR_REPASSEDIA" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" >
                                    <input type="checkbox" id="i-diautil"
                                        name="IMB_CTR_REPASSEUTIL" class="icheck" data-checkbox="icheckbox_flat-blue">
                                        Contar como dias úteis
                                </div>
                            </div>            
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    <div class="portlet box blue-dark">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Email para envio de boletos
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
            </div>
        </div>

        <div class="portlet-body form">
            <div class="form-body" >
                <div class="row">   
                <div class="col-md-3">
                        <div class="form-group" >
                            <input type="number" id="i-diafixo"
                                name="IMB_CTR_REPASSEDIAFIXO">
                                Dia Fixo
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" >
                            <input type="text" id="i-proximorepassefixo"
                                name="IMB_CTR_PROXIMOREPASSE">
                                Próximo Repasse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div id="fiador" class="w3-container w3-border opcao" style="display:none"> 
    <div class="portlet box blue-dark">
        <div class="row">
            <div class="col-md-1">
            </div>
        </div>
        
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Fiadores do Contrato
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
            </div>
        </div>
        
        <div class="portlet-body form">
            <div class="form-body" id="galeria-imovel">
            </div>
            <table class="table" id="tblimagens">
                <thead class="thead-dark">
                    <tr>
                        <th >Titulo</th>
                        <th width="250" >Imagem</th>
                        <th width="250" style="text-align:center"> Ações </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="captador" class="w3-container w3-border opcao" style="display:none"> 
    <div class="portlet box blue-dark">
        <div class="row">
            <div class="col-md-1">
            </div>
        </div>
        
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Captadores/Corretores do Contrato
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
            </div>
        </div>
        
        <div class="portlet-body form">
            <div class="form-body" id="galeria-imovel">
            </div>
            <table class="table" id="tblimagens">
                <thead class="thead-dark">
                    <tr>
                        <th >Titulo</th>
                        <th width="250" >Imagem</th>
                        <th width="250" style="text-align:center"> Ações </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div id="juridico" class="w3-container w3-border opcao" style="display:none"> 
    <div class="portlet box blue-dark">
        <div class="row">
            <div class="col-md-1">
            </div>
        </div>
        
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Departamento Juridico
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
            </div>
        </div>
        
        <div class="portlet-body form">
            <div class="form-body" id="galeria-imovel">
            </div>
            <table class="table" id="tblimagens">
                <thead class="thead-dark">
                    <tr>
                        <th >Titulo</th>
                        <th width="250" >Imagem</th>
                        <th width="250" style="text-align:center"> Ações </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div id="obs" class="w3-container w3-border opcao" style="display:none"> 
    <div class="portlet box blue-dark">
        <div class="row">
            <div class="col-md-1">
            </div>
        </div>
        
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Observações para o Contrato e as partes
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
            </div>
        </div>
        
        <div class="portlet-body form">
            <div class="form-body" id="galeria-imovel">
            </div>
            <table class="table" id="tblimagens">
                <thead class="thead-dark">
                    <tr>
                        <th >Titulo</th>
                        <th width="250" >Imagem</th>
                        <th width="250" style="text-align:center"> Ações </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- BEGIN QUICK NAV -->
<nav class="quick-nav">
    <a class="quick-nav-trigger" href="#0">
        <span aria-hidden="true"></span>
    </a>
    <ul>
        <li>
            <a href="#" target="_blank" class="active">
                <span>Receber</span>
                <i class="icon-basket"></i>
            </a>
        </li>
        <li>
            <a href="#" target="_blank">
                <span>Repassar</span>
                <i class="icon-users"></i>
            </a>
        </li>
        <li>
            <a href="#" target="_blank">
                <span>Lançamentos</span>
                <i class="icon-user"></i>
            </a>
        </li>
        <li>
            <a href="#" target="_blank">
                <span>Histórico Financeiro</span>
                <i class="icon-graph"></i>
            </a>
        </li>
        <li>
            <a href="#" target="_blank">
                <span>Espelho do Contrato</span>
                <i class="icon-graph"></i>
            </a>
        </li>
        <li>
            <a href="#" target="_blank">
                <span>Telefones do Envolvidos</span>
                <i class="icon-graph"></i>
            </a>
        </li>
        <li>
            <a href="#" target="_blank">
                <span>Rescisão</span>
                <i class="icon-graph"></i>
            </a>
        </li>
        <li>
            <a href="#" target="_blank">
                <span>Documento Quitação de Débitos</span>
                <i class="icon-graph"></i>
            </a>
        </li>
        
    </ul>
    <span aria-hidden="true" class="quick-nav-bg"></span>
</nav>
<div class="quick-nav-overlay"></div>


<!-- BEGIN QUICK NAV -->
<nav class="quick-nav">
    <a class="quick-nav-trigger" href="#0">
        <span aria-hidden="true"></span>
    </a>
    <ul>
        <li>
            <a href="#" target="_blank" class="active">
                <span>Receber</span>
                <i class="icon-basket"></i>
            </a>
        </li>
        <li>
            <a href="#" target="_blank">
                <span>Repassar</span>
                <i class="icon-users"></i>
            </a>
        </li>
        <li>
            <a href="#" target="_blank">
                <span>Lançamentos</span>
                <i class="icon-user"></i>
            </a>
        </li>
        <li>
            <a href="#" target="_blank">
                <span>Histórico Financeiro</span>
                <i class="icon-graph"></i>
            </a>
        </li>
        <li>
            <a href="#" target="_blank">
                <span>Espelho do Contrato</span>
                <i class="icon-graph"></i>
            </a>
        </li>
        <li>
            <a href="#" target="_blank">
                <span>Telefones do Envolvidos</span>
                <i class="icon-graph"></i>
            </a>
        </li>
        <li>
            <a href="#" target="_blank">
                <span>Rescisão</span>
                <i class="icon-graph"></i>
            </a>
        </li>
        <li>
            <a href="#" target="_blank">
                <span>Documento Quitação de Débitos</span>
                <i class="icon-graph"></i>
            </a>
        </li>
        
    </ul>
    <span aria-hidden="true" class="quick-nav-bg"></span>
</nav>
<div class="quick-nav-overlay"></div>


@endsection
@push('script')
    <script type="text/javascript">
    
        $("#frmCadastro :input").prop("disabled", false);
    </script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>

        $.ajaxSetup({
            headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"

            }

        });

        function openOption(evt, cityName) {
            var i, x, tablinks;
            x = document.getElementsByClassName("opcao");
            for (i = 0; i < x.length; i++) 
            {
                x[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < x.length; i++) 
            {
                tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " w3-red";
        }


        function CarregarPropImo()
    {
        str = $("#i-imv-id").val();
        var url = "{{ route('propimo.carga') }}"+"/"+str;
        $.getJSON( url, function( data)
        {
            linha = "";
            $("#tbllocadores>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
                linha = 
                    '<tr>'+
                    '   <td style="text-align:center">'+data[nI].IMB_CLT_NOME+'</td>'+
                    '   <td style="text-align:center">'+data[nI].IMB_IMVCLT_PERCENTUAL4+'%</td>'+
                    '   <td style="text-align:center">'+data[nI].principal+'</td>'+
                    '   <td style="text-align:center"> '+
//                    '<a  class="btn btn-sm btn-primary" href=javascript:editarCorImo('+data[nI].IMB_CORIMO_ID+')>Editar</a>&nbsp;&nbsp;&nbsp;&nbsp;'+
//                    '           <button class="btn btn-sm btn-primary" onclick="editarCorImo('+data[nI].IMB_CORIMO_ID+' )">Editar</button>'+ 
//                    '           <button class="btn btn-sm btn-danger" onclick="apagarCorImo('+data[nI].IMB_CORIMO_ID+' )">Apagar</button>'+ 
                    '<a  class="btn btn-sm btn-primary" href=javascript:editarPropImo('+data[nI].IMB_PPI_ID+')>     Editar</a>'+
                    '<a  class="btn btn-sm btn-danger" href=javascript:apagarPropImo('+data[nI].IMB_PPI_ID+')>     Apagar</a>'+
                    '   </td>'+
                    '</tr>';

                $("#tbpropimo").append( linha );
                        
            }
        });
    }


     </script>
@endpush