@section('scripttop')
<style>
    .lbl-medidas-outrositens {
            text-align: left;
            font-size: 12px;
                color: #4682B4; 
    }

    .table-visitas {
            text-align: center;
            font-size: 10px;
                color: #4682B4; 
    }

.dot {
  height: 25px;
  width: 25px;
  background-color: green;
  border-radius: 50%;
  display: inline-block;
}

</style>

@endsection
@php  
    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'ImovelDadosRapidos', 'Visualização Rápida dos dados básicos do imovel', 'CRM', 'Imóveis','S', 'X', 'Botão')
@endphp

<div class="modal" tabindex="-1" role="dialog" id="modalimovel">
    <div class="modal-dialog" style="width:90%;" >
        <div class="modal-content">
            <div class="modal-body">
             

                <div class="portlet light bordered">
                    <div>
                        <div>
                            
                            <h3 id="i-bairrotipoimovel" class="bold uppercase "></h3>
                            <h6 class="bold uppercase  " id="i-modalendimovel"></h6>
                        </div>
                        <div>
                            <button class="btn btn-danger pull-right" type="button"  data-dismiss="modal" >Fechar
                            </button>
                        </div>
                    </div>
                    <div class="portlet-body form {{$acesso}}">
                        <input type="hidden" id="i-codigo-imovel">
                        <div class="row">
                            <div class="col-md-11">
                                @php  
                                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Imovel', 'Imóveis(Acessar/Incluir/alterar/excluir)', 'CRM', 'Imóveis','S', 'A', 'Botão')
                                @endphp

                                <div class="col-md-2 {{$acesso}} div-center">
                                    <h4>Alterar dados</h4>
                                    <a href="javascript:imovelAlterar()">
                                        <i class="glyphicon glyphicon-edit fa-2x" ></i>
                                    </a>
                                    
                                </div>
                                
                                @php  
                                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'ImovelStatus', 'Alterar Status do Imóvel', 'CRM', 'Imóveis','S', 'X', 'Botão')
                                @endphp
                                <div class="col-md-2 {{$acesso}}">
                                    <button type="button" class="btn btn-danger" onClick="mudarStatus()">Mudar Status
                                        <i class="glyphicon glyphicon glyphicon-transfer" ></i>
                                        </button>
                                </div>
                                @php  
                                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'ImovelFicha', 'Imprimir Ficha do Imóvel', 'CRM', 'Imóveis','S', 'X', 'Botão')
                                @endphp
                                <div class="col-md-2 {{$acesso}}">
                                    <button type="button" class="btn btn-light" onClick="fichaImovel()">Ficha do Imóvel
                                        <i class="glyphicon glyphicon glyphicon-print" ></i>
                                        </button>
                                </div>
                                @php  
                                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'ImovelProposta', 'Cadastrar Proposta para o Imóvel', 'CRM', 'Imóveis','S', 'X', 'Botão')
                                @endphp
                                <div class="col-md-2 {{$acesso}}">
                                    <button type="button" class="btn btn-green" onClick="proposta()" style="background-color:green;color:white">Nova Proposta
                                        <i class="fa fa-money " aria-hidden="true" style="color:black"></i>
                                        </button>
                                </div>
                            </div>
                        </div>
                        <div id="tabs">
                            <ul>
                                <li><a href="#tab-principal" id="h-principal"><span>Dados Gerais</span></a></li>
                                @php  
                                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'ImovelProprietarioVis', 'Visualizar Proprietário do Imóvel', 'CRM', 'Imóveis','S', 'X', 'Botão')
                                @endphp

                                <li class="{{$acesso}}"><a href="#tab-proprietario" id="h-proprietario"><span>Proprietário</span></a></li>
                                <li><a href="#tab-areainterna" id="h-areainterna"><span>Área Interna</span></a></li>
                                <li><a href="#tab-medidas" id="h-medidas"><span>Medidas</span></a></li>
                                <li><a href="#tab-lazer" id="h-lazer"><span>Lazer</span></a></li>
                                <li><a href="#tab-areaexterna" id="h-areaesxterna"><span>Área Externa</span></a></li>
                                <li><a href="#tab-atendimentos" id="h-atendimentos"><span>Atendimentos</span></a></li>
                                @php  
                                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'ImovelHistorico', 'Visualizar o Histórico do Imóvel', 'CRM', 'Imóveis','S', 'X', 'Botão')
                                @endphp
                                <li class="{{$acesso}}"><a href="#tab-historico" id="h-historico"><span>Histórico</span></a></li>
                                <li><a href="#tab-negociacoes" id="h-negociacoes"><span>Negociações/Observações</span></a></li>
                                <li><a href="#tab-chaves" id="h-chaves"><span>Informações sobre as Chaves</span></a></li>
                                <li><a href="#tab-visitas" id="h-visitas"><span>Visitas no Imóvel</span></a></li>
                                <li><a href="#tab-tour" id="h-tour"><span>Virtual Tour</span></a></li>
                            </ul>
                            <div id="tab-principal">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <TABLE class="table-striped table-bordered table-hover" id="tbldadosimovel" width="100%">
                                                <THEAD>
                                                    <TR>
                                                    <TH width="100%">Informações Básicas</TH>
                                                    </TR>
                                                </THEAD>
                                                <TBODY>
                                                </TBODY>
                                            </TABLE>         
                                        </div>
                                        <div class="col-md-6">
                                            <TABLE class="table-striped table-bordered table-hover" id="tbldescricao" width="100%">
                                                <THEAD>
                                                    <TR>
                                                        <TH width="100%">Descrição</TH>
                                                    </TR>
                                                </THEAD>
                                                <TBODY>
                                                </TBODY>
                                            </TABLE>         
                                        </div>
                                    </div>
                                
                                </div>                       
                            </div>
                            <div id="tab-proprietario">
                                <div class="row">
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
                                                        <th style="text-align:center" width="30%"> Proprietario </th>
                                                        <th style="text-align:center" width="5%" style="text-align:center"> Principal </th>
                                                        <th style="text-align:center" width="50%" style="text-align:center"> Telefones </th>
                                                        <th style="text-align:center" width="50%" style="text-align:center"> Email </th>
                                                        <th style="text-align:center" width="15%" style="text-align:center"> Cidade </th>
                                                    </tr>   
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>                                
                                </div>                       
                            </div>
                            <div id="tab-areainterna">
                                <h4 ><u><b>Área Interna</b></u>
                                </h4>                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class=" col-md-2">
                                                <div class="form-group">
                                                    <label class="lbl-medidas" >Dormitórios
                                                        <span class="lbl-medidas-valores" id="i-dormitorio-medida"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="lbl-medidas">Suítes
                                                        <span class="lbl-medidas-valores" id="i-suite-medida"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label class="lbl-medidas" >WC
                                                        <span class="lbl-medidas-valores" id="i-wc-medida"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label class="lbl-medidas" >Salas
                                                        <span class="lbl-medidas-valores" id="i-sala-medida"></span >
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label class="lbl-medidas" >Edícula
                                                        <span class="lbl-medidas-valores" id="i-edicula"></span>
                                                    </label>
                                                </div>
                                            </div>                                        
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="lbl-medidas" >Despensa
                                                        <span class="lbl-medidas-valores" id="i-despensa"></span>
                                                    </label>
                                                </div>
                                            </div>                                        
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="lbl-medidas" >Garagem
                                                    <span  class="lbl-medidas-valores" id="i-garagem-medida"></span> 
                                                    </label>
                                                </div>
                                            </div>  
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label class="label-control lbl-medidas" > Cozinha 
                                                        <span class="lbl-medidas-valores" id="i-cozinha-medida"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>      
                                    <div class="div-border-blue-center col-md-12">
                                        <span class="lbl-medidas-outrositens" id="i-outrosinternos"></span>
                                    </div>   
                                </div>                             
                            </div>
                            <div id="tab-medidas">
                                <div class="row">
                                    <h4 ><u><b>Medidas</b></u>
                                    </h4>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="lbl-medidas" >Área Total</label>
                                                    <span class="lbl-medidas-valores" id="i-areatotal">Área Total</span>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="lbl-medidas" >Área Const/Útil</label>
                                                    <span class="lbl-medidas-valores" id="i-areaconstruida">Área Const/Útil</span>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="lbl-medidas" >Área Comum</label>
                                                    <span class="lbl-medidas-valores" id="i-areacomum"></span>
                                                </div>
                                            </div>
                                            <div class=" col-md-2">
                                                <div class="form-group">
                                                    <label class="lbl-medidas" >Área Privativa</label>
                                                    <span class="lbl-medidas-valores" id="i-areaprivativa"></span>
                                                </div>
                                            </div>
                                            <div class=" col-md-2">
                                                <div class="form-group">
                                                    <label class="lbl-medidas" >Área Externa</label>
                                                    <span class="lbl-medidas-valores" id="i-areaexterna"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="lbl-medidas" >Medida Terreno</label>
                                                    <span class="lbl-medidas-valores" id="i-dimensaoterreno"></span>
                                                </div>
                                            </div>
                                        </div>      
                                    </div>
                                </div>
                            </div>
                            <div id="tab-lazer">
                                <div class="row">
                                    <h4><u><b>Lazer</b></u>
                                    </h4>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class=" col-md-1">
                                                <div class="form-group">
                                                    <label class="lbl-medidas" >Piscina</label>
                                                    <span class="lbl-medidas-valores" id="i-piscina"></span>
                                                </div>
                                            </div>
                                            <div class=" col-md-1">
                                                <div class="form-group">
                                                    <label class="lbl-medidas" >Sauna</label>
                                                    <span class="lbl-medidas-valores" id="i-sauna"></span>
                                                </div>
                                            </div>
                                            <div class="  col-md-2">
                                                <div class="form-group">
                                                    <label class="lbl-medidas" >Churrasqueira</label>
                                                    <span class="lbl-medidas-valores" id="i-churrasqueira"></span>
                                                </div>
                                            </div>
                                            <div class="  col-md-1">
                                                <div class="form-group">
                                                    <label class="lbl-medidas" >Quadra</label>
                                                    <span class="lbl-medidas-valores" id="i-quadra"></span>
                                                </div>
                                            </div>
                                            <div class="  col-md-2">
                                                <div class="form-group">
                                                    <label class="lbl-medidas" >Salão Festas</label>
                                                    <span class="lbl-medidas-valores" id="i-salao"></span>
                                                </div>
                                            </div>
                                            <div class="  col-md-1">
                                                <div class="form-group">
                                                    <label class="lbl-medidas" >Playgr.</label>
                                                    <span class="lbl-medidas-valores" id="i-playground"></span>
                                                </div>
                                            </div>
                                            <div class="  col-md-1">
                                                <div class="form-group">
                                                    <label class="lbl-medidas" >Quintal</label>
                                                    <span class="lbl-medidas-valores" id="i-quintal"></span>
                                                </div>
                                            </div>
                                            <div class="  col-md-1">
                                                <div class="form-group">
                                                    <label class="lbl-medidas" >Inst.TV</label>
                                                    <span class="lbl-medidas-valores" id="i-tvcabo"></span>
                                                </div>
                                            </div>
                                            <div class="  col-md-2">
                                                <div class="form-group">
                                                    <label class="lbl-medidas" >Campo Gramado</label>
                                                    <span class="lbl-medidas-valores" id="i-campogramado"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div id="tab-areaexterna">
                                <h4><u><b>Área Externa</b></u>
                                </h4>   
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="  col-md-1">
                                                <div class="form-group">
                                                    <label class="lbl-medidas" >Murado</label>
                                                    <span class="lbl-medidas-valores" id="i-murado"></span>
                                                </div>
                                            </div>
                                            <div class="  col-md-1">
                                                <div class="form-group">
                                                    <label class="lbl-medidas" >Esquina</label>
                                                    <span class="lbl-medidas-valores" id="i-esquina"></span>
                                                </div>
                                            </div>                                        
                                            <div class="  col-md-1">
                                                <div class="form-group">
                                                    <label class="lbl-medidas" >Agua</label>
                                                    <span class="lbl-medidas-valores" id="i-agua"></span>
                                                </div>
                                            </div>                                        
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label class="lbl-medidas" >Esgoto</label>
                                                    <span class="lbl-medidas-valores" id="i-esgoto"></span>
                                                </div>
                                            </div>                                        
                                            <div class="  col-md-2">
                                                <div class="form-group">
                                                    <label class="lbl-medidas" >Portão Eletr.</label>
                                                    <span class="lbl-medidas-valores" id="i-portao"></span>
                                                </div>
                                            </div>                                        
                                            <div class="  col-md-1">
                                                <div class="form-group">
                                                    <label class="lbl-medidas" >Sacada</label>
                                                    <span class="lbl-medidas-valores" id="i-sacada"></span>
                                                </div>
                                            </div>                                        
                                            <div class="  col-md-1">
                                                <div class="form-group">
                                                    <label class="lbl-medidas" >Asfalto</label>
                                                    <span class="lbl-medidas-valores" id="i-asfalto"></span>
                                                </div>
                                            </div>                                        
                                            <div class="  col-md-2">
                                                <div class="form-group">
                                                    <label class="lbl-medidas" >Sol da Manhã</label>
                                                    <span class="lbl-medidas-valores" id="i-solmanha"></span>
                                                </div>
                                            </div>                                            
                                            <div class="  col-md-2">
                                                <div class="form-group">
                                                    <label class="lbl-medidas" >Aquecedor</label>
                                                    <span class="lbl-medidas-valores" id="i-aquecedor"></span>
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-atendimentos">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered" id="tableatm">
                                            <thead>
                                                <th width="50" class="text-right">Ações</th>
                                                <th width="50">#ID</th>
                                                <th>Data/Hora</th>
                                                <th>Data Encer.</th>
                                                <th>Atendente</th>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-historico">
                                @include( 'layout.imovelhistorico')
                            </div>
                            <div id="tab-negociacoes">
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i>Dados da Negociação
                                        </div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body form ">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-4 bg-light">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Taxa Adm.%</label>
                                                                <input class="form-control" type="text" id="m-IMB_CLT_TAXAADM" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label class="control-label">Taxa Contrato</label>
                                                                <input class="form-control" type="text" id="m-IMB_CLT_TCPERC" readonly>
                                                                <span>% Sobre o Aluguel</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Parcelas</label>
                                                                <input class="form-control"type="number" id="m-IMB_CLT_TCPARCELAS" min="1" max="12" readonly>
                                                                <span>Qt.Parcelas</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 bg-info">
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <div class="form-group">
                                                                    <label class="control-label">Banco</label>
                                                                    <select class="form-control" id="m-GER_BNC_NUMERO" readonly>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Ag.</label>
                                                                        <input class="form-control" type="text" id="m-GER_BNC_AGENCIA" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="form-group">
                                                                        <label class="control-label">C/C</label>
                                                                        <input class="form-control" type="text" id="m-IMB_CLTCCR_NUMERO" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label class="control-label">DV</label>
                                                                        <input class="form-control" type="text" id="m-IMB_CLTCCR_DV" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="col-md-6">  
                                                                        <div class="form-group">
                                                                            <label class="control-label">Correntista
                                                                                <input class="form-control" type="text" id="m-IMB_CLTCCR_NOME" readonly>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">  
                                                                        <div class="form-group">
                                                                            <label class="control-label">CPF/CNPJ
                                                                                <input class="form-control" type="text" id="m-IMB_CLTCCR_CPF" readonly>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Poupança
                                                                            <input class="form-control" 
                                                                                type="checkbox" 
                                                                                data-checkbox="icheckbox_flat-blue" 
                                                                                name="aberto" id="m-IMB_CLTCCR_POUPANCA" readonly>
                                                                            </label>
                                                                        </div>
                                                                    </div>                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">  
                                                                <div class="form-group">
                                                                    <label class="control-label">Chave PIX
                                                                    <input class="form-control" type="text" id="m-IMB_CLT_CHAVEPIX" readonly>
                                                                </div>
                                                            </div>
                                                        </div>                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end form-body-->
                                    </div>
                                </div>
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i>Observações
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
                                                        <textarea class="form-control" rows="3" 
                                                            id="M-IMB_IMV_CONDICOESCOMERCIAIS" readonly></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end form-body-->
                                    </div>
                                </div><!--FIM Portlet-body form">-->

                            </div>
                            <div id="tab-chaves">
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i>informações sobre as Chaves
                                        </div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-3">
                                                        <label class="label-control">Local</label>
                                                        <select class="form-control" id="IMB_IMV_CHAVESSITUACAO" readonly>
                                                            <option value="0">Não Informado</option>
                                                            <option value="C">Corretor</option>
                                                            <option value="I">Imobiliária</option>
                                                            <option value="P">Proprietário</option>
                                                            <option value="O">Outro</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="label-control">Corretor</label>
                                                        <select class="form-control" id="IMB_ATD_IDCHAVE" readonly>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="label-control">Box </label>
                                                        <input class="form-control" id="IMB_IMV_CHABOX">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="label-control">Observações sobre as Chaves</label>
                                        <textarea rows="2" id="IMB_IMV_CHAVES" style="min-width: 100%" readonly></textarea>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-visitas">
                                @include('layout.modalvisitasimoveis')
                            </div>

                            <div id="tab-tour">
                                    <div class="row">
                                        <div class="col-md-12 escondido" id="i-div-gerartour" >
                                            <button class="btn btn-primary">Gerar Virtual Tour</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>      
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')

<script>


$("#h-visitas").click( function()
{
   $("#i-imovel-saidachaves").val( $("#i-codigo-imovel").val() );
   $(document).ready(function() 
{
  tabelar();


});

});



function mostrarImovelModal( id )
        {
            

            $("#preloader").show();
            usuariocaptador = 'N'
            //verificar se o usuario do momento, também é o captador
            var url = "{{route('capimo.usuariocaptador')}}/{{Auth::user()->IMB_ATD_ID}}/"+id;
            $.ajax(
                {
                    url     : url,
                    type    : 'get',
                    dataType: 'json',
                    async   : false,
                    success : function( data )
                    {
                        usuariocaptador = data;
                        
                    },
                    error   : function()
                    {
                        alert('Erro ao verificar se o usuario é o captador');
                    }
                

                });
            $("#h-proprietario").show();
            if (  usuariocaptador !=  'S' && carregarOpcao( $("#I-IMB_ATD_ID").val(), 167,1, "{{route('direito.checar')}}",false) == false )  
            $("#h-proprietario").hide();


            CarregarPropImo( id );

            var url = "{{ route('imovel.mostrar') }}"+"/"+id;
            $("#i-imovel").val( id );

            $.ajax
            ({
                type: "get",
                url: url,
                dataType: "json",
                context: this,
                success: function( data )
                {

                    $("#preloader").hide();
                    CarregarImagens( data[0]['IMB_IMV_ID'] );

                    $("#i-codigo-imovel").val( data[0].IMB_IMV_ID);
//                    $("#i-statusatual").val( status );
                    

                    $("#tbldescricao>tbody").empty();
                    var observacoes='-';
                    if ( data[0]['IMB_IMV_OBSERV'] != null )
                    {
                        observacoes = data[0]['IMB_IMV_OBSERV'];
                    }

                    linha = 
                    '<tr>'+
                    '   <td> '+observacoes+'</td>'+
                    '</tr>';
                    $("#tbldescricao").append( linha );

                    var outrosinternos='';
                   if ( data[0]['IMB_IMV_COZPLA'] ='S' )
                    {
                        outrosinternos = '.Cozinha Planejada&nbsp;&nbsp;&nbsp;';
                    }

                    if ( data[0]['IMB_IMV_LAVABO'] ='S' )
                    {
                        outrosinternos = outrosinternos + '.Lavabo&nbsp;&nbsp;&nbsp;&nbsp;';
                    }


                    if ( data[0]['IMB_IMV_DORCLO'] ='S' )
                    {
                        outrosinternos = outrosinternos + '.Closet&nbsp;&nbsp;&nbsp;&nbsp;';
                    }

                    if ( data[0]['IMB_IMV_EMPDOR'] ='S' )
                    {
                        outrosinternos = outrosinternos + '.Dormitório Empregada&nbsp;&nbsp;&nbsp;&nbsp;';
                    }

                    if ( data[0]['IMB_IMV_EMPWC'] ='S' )
                    {
                        outrosinternos = outrosinternos + '.WC Empregada&nbsp;&nbsp;&nbsp;&nbsp;';
                    }

                    var condominio='';
                    if ( data[0]['CONDOMINIO'] != null )
                    {
                        condominio = data[0]['CONDOMINIO'];
                    }


                    var observacoesnet='Não Informado';
                    if ( data[0]['IMB_IMV_OBSWEB'] != null )
                    {
                        observacoesnet = data[0]['IMB_IMV_OBSWEB'];
                    }

                    var ae='';
                    if ( data[0]['IMB_IMV_DORAE'] == 'S' )
                    {
                        ae = 'C/ Armários';
                    }

                    var cozinha='Não';
                    if ( data[0]['IMB_IMV_COZINHA'] == 'S' )
                    {
                        cozinha = 'Sim';
                    }

                    var piscina='Não';
                    if ( data[0]['IMB_IMV_PISCIN'] == 'S' )
                    {
                        piscina = 'Sim';
                    }

                    var sauna='Não';
                    if ( data[0]['IMB_IMV_SAUNA'] == 'S' )
                    {
                        sauna = 'Sim';
                    }

                    var playground='Não';
                    if ( data[0]['IMB_IMV_PLAGRO'] == 'S' )
                    {
                        playground = 'Sim';
                    }
                    
                    var quadra='Não';
                    if ( data[0]['IMB_IMV_QUADRAPOLIESPORTIVA'] == 'S' )
                    {
                        quadra = 'Sim';
                    }
                                        
                    var churrasqueira='Não';
                    if ( data[0]['IMB_IMV_CHURRA'] == 'S' )
                    {
                        churrasqueira = 'Sim';
                    }
                                        
                    var quintal='Não';
                    if ( data[0]['IMB_IMV_QUINTA'] == 'S' )
                    {
                        quintal = 'Sim';
                    }
                                        
                    var salao='Não';
                    if ( data[0]['IMB_IMV_SALFES'] == 'S' )
                    {
                        salao = 'Sim';
                    }
                                        
                    var dormitorios='';
                    if ( data[0]['IMB_IMV_DORQUA'] != null )
                    {
                        dormitorios = data[0]['IMB_IMV_DORQUA']+ ' '+ae;
                    }

                    var wc ='';
                    if ( data[0]['IMB_IMV_WCQUA'] != null )
                    {
                        wc = data[0]['IMB_IMV_WCQUA'];
                    }

                    var hidro='';
                    if ( data[0]['IMB_IMV_SUIHID'] == 'S' )
                    {
                        hidro = 'C/ Hidro';
                    }

                    var suites='ND';
                    if ( data[0]['IMB_IMV_SUIQUA'] != null )
                    {
                        suites = data[0]['IMB_IMV_SUIQUA']+' ' + hidro;
                    }

                    var salas='ND';
                    if ( data[0]['IMB_IMV_SALQUA'] != null )
                    {
                        salas = data[0]['IMB_IMV_SALQUA'];
                    }

                    var vagascob='ND';
                    if ( data[0]['IMB_IMV_GARCOB'] != null )
                    {
                        vagascob = data[0]['IMB_IMV_GARCOB'];
                    }

                    var vagasdes='ND';
                    if ( data[0]['IMB_IMV_GARDES'] != null )
                    {
                        vagasdes = data[0]['IMB_IMV_GARDES'];
                    }

                        var financiamento='';
                    if ( data[0]['IMB_IMV_FINANC'] == 'S' )
                    {
                        financiamento = 'Aceita';
                    }
                    
                    var tvcabo='Não';
                    if ( data[0]['IMB_IMV_TVCABO'] == 'S' )
                    {
                        tvcabo = 'Sim';
                    }
                    
                    var campogramado='Não';
                    if ( data[0]['IMB_IMV_CAMFUT'] == 'S' )
                    {
                        campogramado = 'Sim';
                    }
                    

                    var murado='Não';
                    if ( data[0]['IMB_IMV_MURADO'] == 'S' )
                    {
                        murado = 'Sim';
                    }
                    
                    var esquina='Não';
                    if ( data[0]['IMB_IMV_ESQUIN'] == 'S' )
                    {
                        esquina = 'Sim';
                    }
                    
                    var cercaeletrica='Não';
                    if ( data[0]['IMB_IMV_ESQUIN'] == 'S' )
                    {
                        cercaeletrica = 'Sim';
                    }
                    
                    var agua='Não';
                    if ( data[0]['IMB_IMV_AGUA'] == 'S' )
                    {
                        agua = 'Sim';
                    }
                    
                    var esgoto='Não';
                    if ( data[0]['IMB_IMV_ESGOTO'] == 'S' )
                    {
                        esgoto = 'Sim';
                    }
                    
                    var sacada='Não';
                    if ( data[0]['IMB_IMV_SACADA'] == 'S' )
                    {
                        sacada = 'Sim';
                    }
                    
                    var asfalto='Não';
                    if ( data[0]['IMB_IMV_ASFALT'] == 'S' )
                    {
                        asfalto = 'Sim';
                    }
                    
                    var portao='Não';
                    if ( data[0]['IMB_IMV_PORELE'] == 'S' )
                    {
                        portao = 'Sim';
                    }
                    
                    var arcentral='Não';
                    if ( data[0]['IMB_IMV_ARCENTRAL'] == 'S' )
                    {
                        arcentral = 'Sim';
                    }
                    
                    
                    var edicula='Não';
                    if ( data[0]['IMB_IMV_EDICUL'] == 'S' )
                    {
                        edicula = 'Sim';
                    }
                    
                    
                    var solmanha='Não';
                    if ( data[0]['IMB_IMV_FACE'] == 'S' )
                    {
                        solmanha = 'Sim';
                    }
                    
                    var despensa='Não';
                    if ( data[0]['IMB_IMV_DESPENSA'] == 'S' )
                    {
                        despensa = 'Sim';
                    }
                    
                    var alarme='Não';
                    if ( data[0]['IMB_IMV_MONITORAMENTO'] == 'S' )
                    {
                        alarme = 'Sim';
                    }

                    var m2venda = '';
                    var m2locacao = '';
                    if( data[0]['IMB_IMV_ARECON'] != null && data[0]['IMB_IMV_ARECON'] != 0  && data[0]['IMB_IMV_VALVEN'] != 0  )
                    {
                        var arecon = parseFloat( data[0]['IMB_IMV_ARECON'] );
                        var valorm2v = data[0]['IMB_IMV_VALVEN'] / arecon;
                        m2venda = 'R$ '+ valorm2v.toFixed( 2 );
                    }

                    var valorvenda = parseFloat(data[0]['IMB_IMV_VALVEN']);
                    valorvenda = formatarBRSemSimbolo(valorvenda);


                    if( data[0]['IMB_IMV_ARECON'] != null && data[0]['IMB_IMV_ARECON'] != 0  && data[0]['IMB_IMV_VALLOC'] != 0  )
                    {
                        var arecon = parseFloat( data[0]['IMB_IMV_ARECON'] );

                        var valorm2l = data[0]['IMB_IMV_VALLOC'] / arecon;

                        m2locacao = 'R$ '+ valorm2l.toFixed( 2 );
                    }
                    var valorlocacao = parseFloat(data[0]['IMB_IMV_VALLOC']);
                    var valoriptu    = parseFloat(data[0]['IMB_IMV_VALORIPTU']);
                    valoriptu = formatarBRSemSimbolo(valoriptu);
                    valorlocacao = formatarBRSemSimbolo(valorlocacao);
                    var valorcondominio    = parseFloat(data[0]['imb_imv_valorcondominio']);
                    valorcondominio = formatarBRSemSimbolo(valorcondominio);

                    

                    var exclusividade='';
                    if ( data[0]['IMB_IMV_ESCLUSIVO'] == 'S' )
                    {
                        exclusividade='COM EXCLUSIVIDADE ATÉ ';
                    }


                    var cercaeletrica='Não';
                    if ( data[0]['IMB_IMV_CERCAELETRICA'] == 'S' )
                    {
                        cercaeletrica = 'Sim';
                    }
                    
                    var camera='Não';
                    if ( data[0]['IMB_IMV_CAMERA'] == 'S' )
                    {
                        camera = 'Sim';
                    }
                    
                    var interfone='Não';
                    if ( data[0]['IMB_IMV_INTERF'] == 'S' )
                    {
                        interfone = 'Sim';
                    }
                    
                    var p24='Não';
                    if ( data[0]['IMB_IMV_PORTAR'] == 'S' )
                    {
                        p24 = 'Sim';
                    }
                    
                    var aquecedor='Não';
                    if ( data[0]['IMB_IMV_AGUAQUENTE'] == 'S' )
                    {
                        aquecedor = 'Sim';
                    }

                    piso = 'Não Informado'                    
                    if ( data[0]['IMB_IMV_PISO'] != '') 
                    {
                        piso=data[0]['IMB_IMV_PISO'];
                    }
                                                                


                    linha = "";
                    $("#tbldadosimovel>tbody").empty();

                    linha = 
                    '<tr>'+
                    '   <td> Dormitórios: '+dormitorios+'</td>'+
                    '   <td> <H-LEFT>Venda: R$' + valorvenda+'</H-LEFT></td>'+
                    '</tr>';
                    $("#tbldadosimovel").append( linha );

                    linha = 
                    '<tr>'+
                    '   <td> Salas: '+salas+'</td>'+
                    '   <td> m2 Constr.: '+data[0][ 'IMB_IMV_ARECON']+'</td>'+
                    '</tr>';
                    $("#tbldadosimovel").append( linha );

                    linha = 
                    '<tr>'+
                    '   <td> Vagas Cob: '+vagascob+' / '+
                    'Vagas Des: '+vagasdes+'</td>'+
                    '   <td> Valor do m2 Venda: '+m2venda+' </td>'+
                    '</tr>';
                    $("#tbldadosimovel").append( linha );

                    linha = 
                    '<tr>'+
                    '   <td> Suites: '+data[0][ 'IMB_IMV_SUIQUA']+'</td>'+
                    '   <td> <H-LEFT>Locação: R$' + valorlocacao+'</H-LEFT></td>'+
                    '</tr>';
                    $("#tbldadosimovel").append( linha );

                    linha = 
                    '<tr>'+
                    '   <td> WC: '+data[0][ 'IMB_IMV_WCQUA']+'</td>'+
                    '   <td> Valor do M2 Locação: '+m2locacao+'</td>'+
                    '</tr>';
                    $("#tbldadosimovel").append( linha );


                    linha = 
                    '<tr>'+
                    '   <td> Terreno: '+data[0][ 'IMB_IMV_ARETOT']+'</td>'+
                    '   <td> $ IPTU: R$'+valoriptu+' - Valor Condomínio: R$'+valorcondominio+'</td>'+
                    '</tr>';
                    $("#tbldadosimovel").append( linha );

                    linha = 
                    '<tr>'+
                    '   <td> Condominio </td>'+
                    '   <td>'+condominio+'</td>'+
                    '</tr>';
                    $("#tbldadosimovel").append( linha );


                    linha = 
                    '<tr>'+
                    '   <td> Inform. no Site: </td>'+
                    '   <td> '+observacoesnet+'</td>'+
                    '</tr>';
                    $("#tbldadosimovel").append( linha );

                    linha = 
                    '<tr>'+
                    '   <td> Financiamento:</td>'+
                    '   <td>'+financiamento+'</td>'+
                    '</tr>';
                    $("#tbldadosimovel").append( linha );

                    var chavesmodal = data[0][ 'IMB_IMV_CHAVES'];
                    if( chavesmodal === null ) chavesmodal='';
                    linha = 
                    '<tr>'+
                    '   <td> Chaves:</td>'+
                    '   <td>'+chavesmodal+'</td>'+
                    '</tr>';
                    $("#tbldadosimovel").append( linha );

                    if( ( data[0][ 'IMB_IMV_NUMAPT'] !='') && (  data[0][ 'IMB_IMV_NUMAPT'] !='0') )
                    {
                        
                        var tipoimovel_modaldados = data[0]['IMB_TIM_DESCRICAO'];
                        var referencia_modaldados = data[0]['IMB_IMV_REFERE'];
                        if( referencia_modaldados == '' ) referencia_modaldados ='';

                        $("#i-bairrotipoimovel").html( referencia_modaldados+' '+data[0]['IMB_TIM_DESCRICAO'] +'/'+ data[0]['CEP_BAI_NOME'] );

                        $("#i-modalendimovel").html( data[0]['ENDERECOCOMPLETO'] );
                    }
                    else
                    {
                        $("#i-modalendimovel").html( data[0][ 'IMB_IMV_ENDERECO']+' '+
                        data[0][ 'IMB_IMV_ENDERECONUMERO']+' '+
                        data[0][ 'IMB_IMV_ENDERECOCOMPLEMENTO']+' - '
                        +data[0][ 'CEP_BAI_NOME']+' - CEP: '+data[0][ 'IMB_IMV_ENDERECOCEP']
                        );

                    }

                    $("#i-modalcondimovel").html( condominio);


                    //medidas
                    if ( ( data[0]['IMB_IMV_ARETOT'] != '') || ( data[0]['IMB_IMV_ARETOT'] != '0.00') )
                    {
                        $("#i-areatotal").html( '<br>'+data[0]['IMB_IMV_ARETOT']+' m2' );
                    }
                    else
                    {
                        $("#i-areatotal").html( '<br>Não Informado' );
                    }
                    
                    if ( ( data[0]['IMB_IMV_ARECON'] != '') || ( data[0]['IMB_IMV_ARECON'] != '0.00') )
                    {
                        $("#i-areaconstruida").html(  '<br>'+data[0]['IMB_IMV_ARECON']+' m2' );
                    }
                    else
                    {
                        $("#i-areaconstruida").html( '<br>Não Informado' );
                    }

                    $("#i-areacomum").html( '<br>Não Informado' );

                    $("#i-areaprivativa").html( '<br>Não Informado' );
                    $("#i-areaexterna").html( '<br>Não Informado' );
                    
                    if ( data[0]['IMB_IMV_MEDTER'] != '') 
                    {
                        $("#i-dimensaoterreno").html( '<br>'+data[0]['IMB_IMV_MEDTER']+' m2' );
                    }
                    else
                    {
                        $("#i-dimensaoterreno").html( '<br>Não Informado' );
                    }

                    
                    $("#IMB_IMV_CHABOX").val( data[0].IMB_IMV_CHABOX);
                    $("#i-dormitorio-medida").html( '<br>'+dormitorios );
                    $("#i-suite-medida").html( '<br>'+suites );
                    $("#i-wc-medida").html( '<br>'+wc );
                    $("#i-sala-medida").html( '<br>'+salas );
                    $("#i-cozinha-medida").html( '<br>'+cozinha );
                    $("#i-garagem-medida").html( '<br>Cob: '+vagascob+ ' / Des: '+vagasdes );
                    $("#i-piscina").html( '<br>'+piscina);
                    $("#i-playground").html( '<br>'+playground);
                    $("#i-quadra").html( '<br>'+quadra);
                    $("#i-churrasqueira").html( '<br>'+churrasqueira );
                    $("#i-quintal").html( '<br>'+quintal );
                    $("#i-sauna").html( '<br>'+sauna );
                    $("#i-salao").html( '<br>'+salao );
                    $("#i-tvcabo").html( '<br>'+tvcabo );
                    $("#i-campogramado").html( '<br>'+campogramado );
                    $("#i-murado").html( '<br>'+murado );
                    $("#i-esquina").html( '<br>'+esquina );
                    $("#i-agua").html( '<br>'+agua );
                    $("#i-esgoto").html( '<br>'+esgoto );
                    $("#i-sacada").html( '<br>'+sacada );
                    $("#i-asfalto").html( '<br>'+asfalto );
                    $("#i-portao").html( '<br>'+portao );
                    //$("#i-arcentral").html( arcentral );
                    $("#i-edicula").html( '<br>'+edicula );
                    $("#i-solmanha").html( '<br>'+solmanha );
                    $("#i-despensa").html( '<br>'+despensa );
                    $("#i-outrosinternos").html( outrosinternos );
                    $("#i-alarme").html( '<br>'+alarme );
                    $("#i-cercaeletrica").html( '<br>'+cercaeletrica );
                    $("#i-camera").html( '<br>'+camera );
                    $("#i-interfone").html( '<br>'+interfone  );
                    $("#i-p24").html( '<br>'+p24 );
                    $("#i-aquecedor").html( '<br>'+aquecedor );
                    $("#i-exclusividade").html( exclusividade );
                    $("#M-IMB_IMV_CONDICOESCOMERCIAIS").val( data[0].IMB_IMV_CONDICOESCOMERCIAIS);
                                        
                    $("#modalimovel").modal("show");
                    
                },
                complete:function()
                {
                    $("#preloader").hide();
                },
                error: function( error )
                {
                    console.log(error);
                }
            });
        }

    function proposta()
    {
        var id = $("#i-codigo-imovel").val();
        var url = "{{route('proposta.nova')}}/"+id;
        window.open( url, '_blank');
        
    }


    
</script>
@endpush