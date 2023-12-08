@extends('layout.app')
@push('script')


@section( 'scripttop')
<style>

    .row-top-margin { margin-bottom:-5px;margin-top:-5px; }

    .topics tr {
        line-height: 13px;
    }
.escondido
{
  display:none;
}
.total-selecionado
{
  background-color:#b3d9ff;
  color:#003366;
  font-weight: bold;
  text-align:center;
}


.font-red
{
  color:red;
}
.linha-fundo-vermelho {
  background-color:#ff0000;
  color:#003366;

}

.linha-fundo-azul {
  background-color:#b3d9ff;
  color:#003366;
  font-weight: bold;
}
.linha-fundo-azul-center {
  background-color:#b3d9ff;
  color:#003366;
  font-weight: bold;
  text-align:center;
  font-size: 24px;

}
.linha-quitado {
  text-decoration: line-through;
  color:#80bfff;

}

.linha-desativado
{
  text-decoration: line-through;
  color: #ffad99;

}

.bg-orange
{
    background-color: orange;
}

.linha-desativado {
  text-decoration: line-through;
  color:#c2d6d6;
//  font-weight: bold;
}


.lbl-medidas-valores {
  text-align: center;
  font-size: 14px;
  font-weight: bold;
  color: #4682B4;
}

.div-center
{
  text-align:center;
  font-size: 12px;

}



.div-1 {
  background-color: lightblue;
}
.div-2 {
  background-color: #CCFFE5;
}
.div-3 {
  background-color: #87CEEB;
}

td
  {
    text-align:center;
  }
tr
  {
    font-size: 14px;
  }

.table-condensed{
  font-size: 20px;
}

.reg-lcf
{
  font-size: 10px;

}
.reg-lcf-content
{
  font-size: 13px;

}

.columncheck
{
    font-size:30px;
}

</style>



@endsection

@section('content')

<div class="modal"><!-- Place at bottom of page --></div>
<div class="col-md-12 div-center div-1" id="div-processando">
  <h3>Carregando informações. Aguarde....</h3>
</div>


@include( 'layout.modalacordo')


<!-- BEGIN CONTENT -->
<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <form  id="i-form-lancamento" onsubmit="return false;" >
                        <input type="hidden" id="i-contratopesquisa" value="{{$idcontratopesquisa}}">
                        <input type="hidden" id="IMB_IMB_IDMASTER" name="empresamaster"
                            value="{{ Auth::User()->IMB_IMB_ID }}"  >
                        <input type="hidden" id="I-IMB_CTR_ID-LF" value="{{$idcontratopesquisa}}">
                        <input type="hidden" id="I-IMB_IMV_ID">
                        <input type="hidden" id="i-codigocliente">
                        <input type="hidden" id="i-aberto">
                        <input type="hidden" id="i-dia">
                        <input type="hidden" id="i-taxaadministrativa">
                        <input type="hidden" id="i-taxaadministrativaforma">
                        <input type="hidden" id="i-aluguelgarantido">

                        <div class="form-body">

                            @include( 'layout.localizarcontrato')
                            @php
                              $fixos = app('App\Http\Controllers\ctrLancamentoFuturo')->fixosCount( $idcontratopesquisa);
                              $par = app('App\Http\Controllers\ctrImobiliaria')->parametros(Auth::user()->IMB_IMB_ID);
                            @endphp
                            <input type="hidden" id="i-quantidade-fixos" value="{{$fixos}}">
                            @if( $fixos > 0 )
                              <div  class="div-center">
                                <h4 class="font-red" id="i-label-temfixo">
                                  <a href="javascript:somenteFixos();">
                                  Este contrato possui {{$fixos}} lançamento(s) fixo(s). Click aqui para visualizá-los
                                  </a></h4>
                              </div>
                            @endif

                            <div class="portlet box blue i-div-informacoes">
                                <div class="portlet-title">
                                    <div class="tools">

                                      @php  
                                        $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'SelTodosLanContrato', 'Selecionar Todos Lançamentos de Valores em Contrato', 'ADM', 'Contratos','S', 'X', 'Botão')
                                      @endphp
                                     <button type="button" class="btn btn-primary btn-md {{$acesso}}" onClick="selecionarTodos()">Selec.Todos
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                      </button>
                                      
                                      <button type="button" class="btn btn-info btn-md " onClick="deselecionarTodos()">Tirar Todas Selec.
                                        <i class="fa fa-times-circle-o" aria-hidden="true"></i>
                                      </button>
                                      
                                        <button type="button" class="btn btn-warning btn-md " onClick="somenteFixos()" id="i-btn-fixo"> Fixos
                                          <i class="fa fa-tags"></i>
                                        </button>

                                        @php  
                                          $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'InativarLançamentosContrato', 'Inativar Lançamentos de Valores em Contrato', 'ADM', 'Contratos','S', 'X', 'Botão')
                                        @endphp

                                        <button type="button" class="btn btn-danger btn-md {{$acesso}}" onClick="inativarSelecionados()">Inativar Selec.
                                            <i class="fa fa-trash"></i>
                                        </button>

                                        @php  
                                          $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'RealizarAcordoContrato', 'Realizar Novos Acordos de Contratos', 'ADM', 'Contratos','S', 'X', 'Botão')
                                        @endphp
                                        <button type="button" class="btn btn-primary btn-md {{$acesso}}" onClick="separarItensAcordo()">Novo Acordo
                                            <i class="fa fa-handshake-o"></i>
                                        </button>
                                        @php  
                                          $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'LançamentosContrato', 'Inativar Lançamentos de Valores em Contrato', 'ADM', 'Contratos','S', 'X', 'Botão')
                                        @endphp
                                        <button title="Gerar Boleto dos Selecionados" type="button" class="btn btn-primary btn-md {{$acesso}}" onClick="gerarBoleto()"> Boleto
                                            <i class="fa fa-barcode"></i>
                                        </button>

                                        @php  
                                          $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'ReceberRepassarLF', 'Receber ou Repassar pela tela de Lançamentos', 'ADM', 'Contratos','S', 'X', 'Botão')
                                        @endphp
                                        <button title="Receber / Repassar dos selecionados" type="button" class="btn btn-primary btn-md  {{$acesso}}" onClick="receberRepassar()">Rec/Rep
                                            <i class="fa fa-money"></i>
                                        </button>
                                        <button title="Exibir todos sem filtro" type="button" class="btn btn-primary btn-md " onClick="reexibirTodos()">Reexibir Todos
                                            <i class="fa fa-money"></i>
                                        </button>
                                        <button title="Filtrar somente o que está em aberto ao locatário" type="button" class="btn btn-success btn-md " onClick="filtrarAbertoLocatario()">Aberto Locatario
                                            <i class="fa fa-money"></i>
                                        </button>
                                        <button title="Filtrar somente o que está em aberto ao locador"type="button" class="btn btn-success btn-md " onClick="filtrarAbertoLocador()">Aberto Locador
                                            <i class="fa fa-money"></i>
                                        </button>
                                        <button title="Filtrar por evento e por data de vencimento" type="button" class="btn btn-warning btn-md btn-outline" onClick="filtrar()">
                                            <i class="fa fa-search"></i>
                                        </button>

                                        @php  
                                          $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'NovLanctoValContrato', 'Incluir Novos Lançamentos de Valores em Contrato', 'ADM', 'Contratos','S', 'X', 'Botão')
                                        @endphp
                                        <button title="Criar novos lançamentos" type="button" class="btn dark btn-md btn-outline {{$acesso}}" onClick="novoLancamento()" id="i-btn-novo">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="portlet-body form" id="add">
                                    <table  id="i-tbllancamento-lf" class="table-striped table-bordered table-hover" >
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="reg-lcf div-center" width="50" > </th>
                                                <th width="150" class="reg-lcf div-center"> Ações </th>
                                                <th width="50" class="reg-lcf div-center escondido"> Parc. </th>
                                                <th width="50" class="reg-lcf div-center "> </th>
                                                <th width="200"class="reg-lcf div-center"> Evento </th>
                                                <th width="100"class="reg-lcf div-center"> Valor </th>
                                                <th width="100"class="reg-lcf div-center"> Locatário </th>
                                                <th width="100"class="reg-lcf div-center"> Locador </th>
                                                <th class="reg-lcf div-center" width="100"> Vencimento </th>
                                                <th width="50" class="reg-lcf div-center">Nº Controle</th>
                                                <th width="50" class="reg-lcf div-center"></th>
                                                <th width="200" class="reg-lcf div-center"> Direcionado para </th>
                                                <th width="100" class="reg-lcf div-center"> Receb. em </th>
                                                <th width="100" class="reg-lcf div-center"> Repasse em </th>
                                                <th width="500" class="reg-lcf div-center"> Descrição</th>
                                                <th width="100" class="reg-lcf div-center"> Dt. Lcto.</th>
                                                
                                            </tr>
                                        </thead>
                                        @php
                                          $lcfs = app( 'App\Http\Controllers\ctrLancamentoFuturo')->list( $idcontratopesquisa,'0',1,0,'x','0');
                                          //dd( $lcfs);
                                        @endphp
                                        <tbody>
                                        @foreach( $lcfs as $lf)
                                        
                                        @php
                                       
                                          $fixo =  $lf->IMB_LCF_FIXO;
                                          if( $fixo == 'S') 
                                           {
                                              $fixo = 'FIXO';
                                              $datavencimento="Todos Meses";
                                              $datavencimentoEUA = date( 'Y-m-d', strtotime( $lf->IMB_LCF_DATAVENCIMENTO));
                                          }
                                          else
                                          {
                                            $fixo = '';
                                            $datavencimento = date( 'd/m/Y', strtotime( $lf->IMB_LCF_DATAVENCIMENTO));
                                            $datavencimentoEUA = date( 'Y-m-d', strtotime( $lf->IMB_LCF_DATAVENCIMENTO));
                                          }

                                        
                                          $IMB_LCF_LOCADORCREDEB = $lf->IMB_LCF_LOCADORCREDEB;
                                          $IMB_LCF_LOCATARIOCREDEB = $lf->IMB_LCF_LOCATARIOCREDEB;

                                          $tdboleto='';
                                          if( $lf->IMB_CGR_ID <> null )
                                            $tdboleto="S";

                                          $nomelocador = $lf->IMB_CLT_NOMELOCADOR;
                                          if( $nomelocador == null ) $nomelocador='-';
                                          $datarecebimento = $lf->IMB_LCF_DATARECEBIMENTO;
                                          if( $datarecebimento <> null )
                                            $datarecebimento = date( 'd-m-Y', strtotime( $lf->IMB_LCF_DATARECEBIMENTO));
                                          
                                          $datapagamento = $lf->IMB_LCF_DATAPAGAMENTO;
                                          if( $datapagamento <>null )
                                            $datapagamento = date( 'd-m-Y', strtotime( $lf->IMB_LCF_DATAPAGAMENTO));

                                          $observacao = $lf->IMB_LCF_OBSERVACAO;
                                          if( $observacao == null ) $observacao ='';

                                          $datalancamento = date( 'd-m-Y', strtotime($lf->IMB_LCF_DATALANCAMENTO))             ;
                                          if( $lf->IMB_LCF_DATALANCAMENTO === null )
                                            $datalancamento='-';

                                            $trclasse = '';
                                          if ( ( $datapagamento and $datarecebimento  ) or
                                               ( $IMB_LCF_LOCADORCREDEB   <> 'N' and $IMB_LCF_LOCATARIOCREDEB =='N' and $datapagamento   ) or
                                               ( $IMB_LCF_LOCATARIOCREDEB <>'N' and $IMB_LCF_LOCADORCREDEB =='N' and $datarecebimento ) )
                                             $trclasse = 'linha-quitado';   
                                        @endphp
                                        <tr class="{{$trclasse}}">
                                          <td><input  id="{{$lf->IMB_LCF_ID}}" type="checkbox" name="registroslf" class="columncheck"></td>
                                          <td class="escondido" >{{$lf->IMB_LCF_ID}}</td>
                                          <td class="reg-lcf-content  div-center" >
                                            @if(  intval($lf->IMB_ACD_ID ) > 0 )
                                              <label class="bg-orange">EM ACORDO</label>
                                            @else
                                              <a href="javascript:selecionarLancamento('{{$lf->IMB_LCF_ID}}')" class="btn btn-sm btn-primary" title="Ver lançamento"><span class="glyphicon glyphicon-pencil"></span></a> 
                                              <a href="javascript:apagarLancamento('{{$lf->IMB_LCF_ID}}')" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash" title="Apagar Lançamento"></span></a> 
                                            
                                            @endif
                               
                                          </td> 
                                          <td class="reg-lcf-content  div-center escondido">{{$lf->IMB_LCF_NUMPARCONTRATO}}</td>
                                          <td class="reg-lcf-content  div-center"><b>{{$fixo}}</b></td>
                                          <td class="reg-lcf-content  div-center">{{$lf->IMB_TBE_NOME}}</td>
                                          <td class="reg-lcf-content div-right">{{number_format($lf->IMB_LCF_VALOR,2,',','.')}}</td>
                                          <td class="reg-lcf-content  div-center">{{$lf->IMB_LCF_LOCATARIOCREDEB}}</td>
                                          <td class="reg-lcf-content  div-center">{{$lf->IMB_LCF_LOCADORCREDEB}}</td>
                                          <td class="reg-lcf-content  div-center">
                                            <a href="javascript:resumoParcela({{$datavencimentoEUA}})">{{$datavencimento}}</a>
                                          </td>
                                          @if( $par->IMB_PRM_USARPARCELAS == 'S' )
                                             <td class="reg-lcf-content  div-center">{{$lf->IMB_LCF_NUMPARREAJUSTE}}</td>
                                          @else
                                             <td class="reg-lcf-content  div-center"></td>
                                          @endif

                                          <td class="reg-lcf-content  div-center" > @if( $tdboleto == 'S') <span class='glyphicon glyphicon-barcode'></span>@endif
                                          <td class="reg-lcf-content  div-center">{{$nomelocador}}</td>
                                          <td class="reg-lcf-content  div-center">{{$datarecebimento}}</td>
                                          <td class="reg-lcf-content  div-center">{{$datapagamento}}</td>
                                          <td class="reg-lcf-content  div-center">{{$observacao}}</td>
                                          <td class="reg-lcf-content  div-center">{{$datalancamento}}</td>
                                          @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal" tabindex="-1" role="dialog" id="modalboleto">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h3 class="modal-title">Geração de Boleto com Ítens Selecionados</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id='i-parcelasboleto'>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Data do Vencimento</label>
                                <input type="date" id="i-vencimento-boleto"
                                    class="form-control" required >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Conta do Boleto</label>
                                <select class="form-control" id="i-select-conta">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-primary btn-md form-control" onClick="gerarBoletoFase2()">Iniciar Geração
                                    <i class="fa fa-barcode"></i>
                                </button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal" tabindex="-1" role="dialog" id="modalitensselecionados">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ítens Selecionados</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table  id="i-tblselecionados" class="table table-bordered table-hover" >
                            <thead class="thead-dark">
                                <tr >
                                    <th class="escondido"> Ações </th>
                                    <th class="escondido"> IDlcf </th>
                                    <th width="20" style="text-align:center"> ID </th>
                                    <th width="200" style="text-align:center"> Evento </th>
                                    <th width="100" style="text-align:center"> Valor </th>
                                    <th width="100" style="text-align:center"> Locatário </th>
                                    <th width="100" style="text-align:center"> Locador </th>
                                    <th width="100" style="text-align:center"> Vencimento </th>
                                    <th width="200" style="text-align:center"> Direcionado para </th>
                                    <th width="500" style="text-align:center"> Descrição</th>
                                    <th class="escondido"> randon</th>
                                    <th class="escondido"> deletado</th>
                                    <th class="escondido"> clt_id</th>
                                    <th width="50" style="text-align:center"> Multa </th>
                                    <th width="50" style="text-align:center"> Juros </th>

                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2 ">
                            <div class="col-md-12 div-center ">
                                <label class="control-label">Data de Vencimento</label>
                                <input type="date" class="form-control" id="i-datadevencimentoavulso">
                            </div>
                            <div class="col-md-12 div-center ">
                                <label class="control-label">Data de Pagamento</label>
                                <input type="date" class="form-control" id="i-dataderecebimentoavulso">
                            </div>
                        </div>
                        <div class="col-md-3 ">
                            <div class="col-md-12 div-center ">
                                <label class="control-label">Total a Receber</label>
                                <input type="text" class="form-control div-center linha-fundo-azul-center valor" readonly id="i-totalareceber">
                            </div>
                            <div class="col-md-12 div-center ">
                                <label>&nbsp;</label>
                                <button type="button" class="btn btn-primary btn-md form-control" onClick="receberLocatario()">Receber
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6 div-3">
                            <div class="col-md-6 div-center">
                                <label class="control-label">Total Calculado</label>
                                <input type="text" class="form-control div-center valor" readonly id="i-totalarepassar">
                            </div>
                            <div class="col-md-6 div-center">
                                <label class="control-label">Tx Adm</label>
                                <input type="text" class="form-control div-center valor" readonly id="i-totaltaxaadm">
                            </div>
                            <div class="col-md-6 div-center ">
                                <label class="control-label">Total a Repassar</label>
                                <input type="text" class="form-control div-center valor"  readonly id="i-totalfinalrepassar">
                            </div>
                            <div class="col-md-6 div-center">
                                <label>&nbsp;</label>
                                <button type="button" class="btn btn-danger btn-md form-control" onClick="repassarLocador()">Repassar
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="col-md-8 div-3">
                        </div>
                    </div>
                </div>
                <hr>

                <div class="row">
                  <div class="col-md-12">
                    </div>
                    </div>
                </div>

                @include( 'layout.dadosreceber')
                @include( 'layout.dadosrepassar')

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="modalbuscaltctr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-body">

        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption">
              <i class="fa fa-gift"></i>Locatário/Contrato
            </div>
          </div>

          <input type="hidden" id="i-tipo-busca">
          <div class="portlet-body form">

            <div class="row">
              <hr>
            </div>

            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                      <input type="text" id="i-strcliente"
                      placeholder="digite aqui um pedaço do nome"
                      class="form-control">
                </div>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                  <button class="btn btn-primary" onClick="buscaIncremental()">Carregar Sugestões</button>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-10">
                <table  id="tblclientes" class="table table-bordered table-hover" >
                  <thead class="thead-dark">
                    <tr >
                      <th width="10%" style="text-align:center"> Situação </th>
                      <th width="10%" style="text-align:center"> Pasta </th>
                      <th width="20%" style="text-align:center"> Endereço </th>
                      <th width="20%" style="text-align:center"> Locador </th>
                      <th width="20%" style="text-align:center"> Locatário </th>
                      <th width="20%" style="text-align:center"> Ações </th>
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
      <div class="modal-footer">
        <div class="row">
          <div class="col-md-12">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">sair</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="modalfiltro">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Filtros</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        <div class="col-md-8">
              <div class="form-group">
                  <label for="i-select-evento-filtro" class="control-label">Evento</label>
                  <select class="form-control" id="i-select-evento-filtro">
                  </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                  <label for="i-select-vencimento-filtro" class="control-label">Vencimento</label>
                  <select class="form-control" id="i-select-vencimento-filtro">
                  </select>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onClick="processarFiltro()">Filtrar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="modallancamento" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" style="width:90%;"  role="document">
    <div class="modal-content" >
      <div class="modal-body">
        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption">
              <i class="fa fa-gift"></i>Informações para o Lançamento
            </div>

          </div>

          <div class="portlet-body form">
            <input type="hidden" id="I-IMB_LCF_ID">
            <div class="col-md-12">
              <div class="col-md-3">
                <div class="row">
                  <div class="form-group">
                    <label for="i-select-evento" class="control-label">Evento</label>
                    <select class="form-control" id="i-select-evento">
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-9">
                <div class="row">
                <div class="col-md-2  div-center">
                    <label class="label-control">FIXO(todos os meses)
                      <input type="checkbox" class="form-control" id="IMB_LCF_FIXO">
                    </label>
                  </div>                  
                    <div class="col-md-2  div-center escondido div-3" id="i-div-taxacontrato" >
                        <label class="label-control">Cobrar Tx Adm Neste Mês
                          <input type="checkbox" class="form-control" id="IMB_LCF_COBRARTAXADMMES">
                        </label>
                      </div>
                      <div class="col-md-2 div-center">
                    <label class="label-control">Incide Multa
                      <input type="checkbox" class="form-control" id="i-inc-multa">
                    </label>
                  </div>
                  <div class="col-md-2 div-center">
                    <label class="label-control">Incide Juros
                      <input type="checkbox" class="form-control" id="i-inc-juros">
                    </label>
                  </div>
                    <div class="col-md-2 div-center">
                    <label class="label-control">Incide IRRF
                      <input type="checkbox" class="form-control" id="i-inc-irrf">
                    </label>
                  </div>
                  <div class="col-md-2  div-center">
                    <label class="label-control">Incide Tx Adm
                      <input type="checkbox" class="form-control" id="i-inc-taxa">
                    </label>
                  </div>
                  <div class="col-md-2  div-center">
                    <label class="label-control">Incide ISS
                      <input type="checkbox" class="form-control" id="i-inc-iss">
                    </label>
                  </div>
                  
                  <div class="col-md-2  div-center escondido" >
                    <label class="label-control">Garantir
                      <input type="checkbox" class="form-control" id="i-garantia">
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="col-md-2">
                   <label class="control-label">Incidência Locador</label>
                  <select class="form-control"  id="i-locadorcredeb">
                    <option value="N">Nada</option>
                    <option value="C">Crédito</option>
                    <option value="D">Débito</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <label class="control-label">Incidência Locatário</label>
                  <select class="form-control" id="i-locatariocredeb">
                    <option value="N">Nada</option>
                    <option value="C">Crédito</option>
                    <option value="D">Débito</option>
                  </select>
                </div>

                <div class="col-md-3">
                  <label class="control-label">Iniciando em</label>
                  <input type="date" class="form-control" id="IMB_LCF_DATAVENCIMENTO" />
                </div>
                @if( $par->IMB_PRM_USARPARCELAS == 'S' )
                <div class="col-md-1" id="div-controle">
                  <label class="control-label">Controle</label>
                  <input type="number" class="form-control" id="IMB_LCF_NUMPARREAJUSTE" />
                </div>
                @endif
                <div class="col-md-1">
                  <label class="control-label" >Qtde. de</label>
                  <input type="text" class="form-control div-center" id="i-meses"
                  onkeypress="return isNumber(event)" onpaste="return false;">
                  <span>Parcelas</span>
                </div>

                <div class="col-md-2">
                  <label class="control-label">Valor R$</label>
                  <input class="form-control valor" id="IMB_LCF_VALOR" type="text">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="col-md-4">
                  <label class="control-label">Somente para o Locador Abaixo:</label>
                  <select class="form-control"  id="i-select-locadorsomente">
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="i-replicar">
                    <input  type="checkbox" class="icheck" id="i-replicar">
                    Em caso de alteração do registro, replicar para meses subsequentes
                  </label>
                  <label>
                    <input type="checkbox" class="icheck" id="i-autopreenchimento"> Auto-Preenchimento
                    
                  </label>
                </div>
                <div class="col-md-4 escondido " id="div-entreparcelas">
                  <div class="col-md-6">
                    <label class="control-label">Ref. Inicial</label>
                    <input class="form-control" type="number" id="i-ref-inicial">
                  </div>
                  <div class="col-md-6">
                    <label class="control-label">Ref. Final</label>
                    <input class="form-control" type="number" id="i-ref-final">
                  </div>
                  <label ></label>
                  
                </div>

              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="col-md-12">
                  <input class="form-control" id="i-descricao" type="text" maxlength="100"
                  placeholder="Descreva aqui informações sobre este lançamento" />

                </div>
              </div>
            </div>
            <div class="row escondido">
              <div class="col-md-12">
                <div class="col-md-3">
               </div>
                <div class="col-md-8">
                  <div class="col-md-4 div-1">
                    <input type="text" class="form-control" id="i-par-ini"
                    placeholder="De: "
                    onkeypress="return isNumber(event)" onpaste="return false;">
                  </div>
                  <div class="col-md-4 div-1">
                    <input type="text" class="form-control" id="i-par-fim"
                    placeholder="Até: "
                    onkeypress="return isNumber(event)" onpaste="return false;">
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <hr>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="col-md-5" id="i-div-gerarparcelas">
                  <button type="button" class="btn green btn-lg btn-outline" onClick="gerarParcelas()"
                        > Gerar Parcelas
                        <i class="fa fa-caret-circle-right"></i>
                  </button>
                </div>
                <div class="col-md-5" id="i-div-regerarparcelas">
                  <button type="button" class="btn red btn-lg btn-outline" onClick="gerarParcelas()"
                      > Regerar as Parcelas
                      <i class="fa fa-check-double"></i>
                  </button>
                </div>
                <div class="col-md-5" id="i-div-confirmarparcelas">
                  <button type="button" class="btn blue btn-lg btn-outline" onClick="gravarParcelasEmBanco()"
                      > Confirmar e gravar parcelas
                      <i class="fa fa-database"></i>
                  </button>
                </div>
                <div class="col-md-5" id="i-div-salvarparcelas">
                  <button type="button" class="btn green btn-lg btn-outline" onClick="salvarParcelas()"
                        > Salvar Alterações
                        <i class="fa fa-database"></i>
                  </button>
                </div>
                <div class="col-md-2">
                  <button type="button" class="btn red btn-lg btn-outline" data-dismiss="modal"
                        > Cancelar
                        <i class="fa fa-abort"></i>
                  </button>
                </div>

              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="portlet box green">
              <div class="portlet-title">
                <div class="caption">
                  <i class="fa fa-gift"></i>Prévia do(s) Lançamento(s)
                </div>
              </div>

              <div class="portlet-body form">

                <div class="row" id='i-parcelas'>
                  <div class="col-md-10">
                    <table  id="i-yyy" class="table table-bordered table-hover" >
                      <thead class="thead-dark">
                        <tr >
                          <th width="10%" style="text-align:center"> ID </th>
                          <th width="20%" style="text-align:center"> Evento </th>
                          <th width="10%" style="text-align:center"> Locador </th>
                          <th width="10%" style="text-align:center"> Locatário </th>
                          <th width="10%" style="text-align:center"> Vencimento </th>
                          <th width="10%" style="text-align:center"> Valor </th>
                          <th width="30%" style="text-align:center"> Observaçao </th>
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
</div>

@include( 'layout.resumoparcela')
@include( 'layout.resumoparcelapagar')


          <!-- BEGIN QUICK SIDEBAR -->

<a href="javascript:;" class="page-quick-sidebar-toggler">
  <i class="icon-login"></i>
</a>

<div class="page-quick-sidebar-wrapper" data-close-on-body-click="false">
</div>

@include('layout.modalpesquisaendereco')

@endsection
@push('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/funcoes-recibolocatario.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/funcoes-recibolocador.js')}}" type="text/javascript"></script>
<script src="{{asset('/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/form-input-mask.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/global/plugins/jquery.input-ip-address-control-1.0.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script type="text/javascript" src="{{asset('/js/jquery-ui-timepicker-addon.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/i18n/jquery-ui-timepicker-addon-i18n.min.js')}}"></script>

<script>
$( document ).ready(function()
  {
    
    $("#i-ref-final").val( 1) ;
      $("#i-ref-inicial").val(1);
      
    $("#i-meses").change( function()
    {
      $("#i-ref-final").val( $("#i-meses").val() ) ;
      $("#i-ref-inicial").val(1);
      
    })
    $("#div-entreparcelas").hide();
    $("#i-autopreenchimento").change( function()
    {
      if(  $("#i-autopreenchimento").prop('checked') ==  true )
       $("#div-entreparcelas").show();
        
    })

    $("#div-processando").show();
  $("#i-dataderecebimentoavulso").val(moment().format('YYYY-MM-DD'));
    $("#i-btn-novo").show();
//    $(".i-div-informacoes").hide();
    $("#i-parcelas").hide();
    $("#i-div-confirmarparcelas").hide();
    $("#i-div-regerarparcelas").hide();
    $("#i-div-salvarparcelas").hide();
    $("#i-div-gerarparcelas").hide();
    $("#i-aberto").val('N');

    $("#i-meses").change( function()
    {
//debugger;
      if( $("#IMB_LCF_FIXO").prop( "checked" )  == true ) 
      {

        alert('Para lancamentos fixos este campo deve ser preenchido com 1');
        $("#i-meses").val('1');
      }

    })

  


    setInterval(blink_textlf, 1000);


        $("#sirius-menu").click();

    cargaConta();
    cargaFormaRecebimento();
    cargaFPRepasse();      
    $("#i-total-dinheiro").blur( function()
    {
      calcularTotalRecebendo();
    });
    $("#i-total-cheque").blur( function()
    {
      calcularTotalRecebendo();
    });

    $("#i-total-dinheiro-locador").blur( function()
    {
      calcularTotalRecebendo();
    });
    $("#i-total-cheque-locador").blur( function()
    {
      calcularTotalRecebendo();
    });


    $.datepicker.setDefaults($.datepicker.regional['br']);
    $('.dpicker').datetimepicker({
      timeFormat: 'hh:mm',
      timeOnlyTitle: 'timeonly',
      timeText: 'Horário',
      hourText: 'Hora',
      minuteText: 'Minuto',
      secondText: 'Segundo',
      currentText: 'Agora',
      closeText: 'Sair',
      format: 'DD-MM-YYYY',
      minView: 2,
      showTimepicker: false
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
    
      $("#i-btn-previarecebimento").click( function()
      {

        calcularRecebimento();

      });

      $("#i-select-parcela").change(function()
      {
        var dataven =  $("#i-select-parcela").val();
        $("#IMB_LCF_DATAVENCIMENTO").val( dataven );

      });

//debugger;
      if( $("#i-contratopesquisa").val() != '0' )
      {

        selecionarContrato( $("#i-contratopesquisa").val() );
      }

      //cargaVencimentos();

      $("#div-processando").hide();



        //cargaLancamento( 1 );
  });


function mostrarModalPesquisa( tipo )
{
  $("#i-tipo-busca").val( tipo );

  $("#modalbuscaltctr").modal('show');

  $("#i-strcliente").val( $("#i-nome").val() );

  $("#i-ctrid").val('');

  buscaIncremental( );

}

function buscaIncremental()
    {

      var tipo = $("#i-tipo-busca").val();

      if( tipo == 'D' )
        {
          str = $("#i-strcliente").val();
          var url = "{{ route('contrato.buscaporld') }}"+"/"+str+"/"+
                $("#IMB_IMB_IDMASTER").val();
        };

        if( tipo == 'T' )
        {
          str = $("#i-strcliente").val();
          var url = "{{ route('contrato.buscaporlt') }}"+"/"+str+"/"+
                $("#IMB_IMB_IDMASTER").val();
        };

        if( tipo == 'E' )
        {
          str = $("#i-strcliente").val();
          var url = "{{ route('contrato.buscaporend') }}"+"/"+str+"/"+
                $("#IMB_IMB_IDMASTER").val();
        };

        $.getJSON( url, function( data)
        {
          linha = "";
          $("#tblclientes>tbody").empty();
          for( nI=0;nI < data.length;nI++)
          {
            if( data[nI].IMB_CTR_SITUACAO == 'ENCERRADO' )
            tr = '<tr class="linha-fundo-vermelho"  >';
            else
              tr = '<tr class="linha-fundo-azul">';


            linha =
              tr+
              '   <td>'+data[nI].IMB_CTR_SITUACAO+'</td>'+
              '   <td>'+data[nI].IMB_CTR_REFERENCIA+'</td>'+
              '   <td>'+data[nI].ENDERECOCOMPLETO+'</td>'+
              '   <td>'+data[nI].PROPRIETARIO+'</td>'+
              '   <td>'+data[nI].IMB_CLT_NOME_LOCATARIO+'</td>'+
              '   <td style="text-align:center"> '+
              '<a  class="btn btn-sm btn-primary" onclick="selecionarContrato( '+data[nI].IMB_CTR_ID+')">Selecionar</a>'+
            '    </td>'+
        '</tr>';
      $("#tblclientes").append( linha );
    }

        });
    }

    function pesquisar()
    {

      var radioValue = $("input[name='opcaoselecao']:checked").val();
      if(radioValue)
      {
        if ( radioValue == 'T' )
          mostrarModalPesquisa( 'T');
        if ( radioValue == 'D' )
          mostrarModalPesquisa( 'D');
        if ( radioValue == 'E' )
          mostrarModalPesquisa('E');
        if ( radioValue == 'P' )
          selecionarContratoPasta( $("#i-nome").val()  );
      }


    }

    function  selecionarCliente( id)
    {

      $("#modalbuscaltctr").modal('hide');

      var url = "{{ route('cliente.find') }}"+"/"+id;
      $.getJSON( url, function( data)
      {
        $("#i-ctrid").val( id );
        $("#i-nome").val( data.IMB_CLT_NOME  );
      });
    }


    function  selecionarContrato( id)
    {

      //debugger;
      
      $("#modalbuscaltctr").modal('hide');

      var url = "{{route('proximovenlt')}}/"+id;
      $.ajax(
      {
        url : url,
        dataType:'json',
        type:'get',
        async:false,
        success:function( data )
        {
          $("#I-LBL-RECEBIMENTO").html( 'Próx. Recto.: '+moment( data.proximovencimento).format('DD/MM/YYYY'));
          $("#IMB_LCF_DATAVENCIMENTO").val(data.proximovencimento);

        }
      });

      var url = "{{route('proximovenld')}}/"+id;
      $.ajax(
      {
        url : url,
        dataType:'json',
        type:'get',
        async:false,
        success:function( data )
        {
          $("#I-LBL-REPASSE").html( 'Próx. Recto.: '+moment(data.proximovencimento).format('DD/MM/YYYY'));
        }
      });

      url = "{{ route('contrato.find') }}"+"/"+id;
      $.ajax(
      {
        url:url,
        datatype:'json',
        async:false,
        success: function( data )
        {
          var ultimorecebimento = moment( data[0].ULTIMORECEBIMENTO ).format( 'DD/MM/YYYY');
          if( ultimorecebimento == 'Invalid date') ultimorecebimento ='<b>Nada Recebido</b>';
          var proximorecebimento = adicionarMes( data[0].IMB_CTR_DIAVENCIMENTO,
                                ultimorecebimento);

          $("#i-taxaadministrativa").val( data[0].IMB_CTR_TAXAADMINISTRATIVA );
          $("#i-taxaadministrativaforma").val( data[0].IMB_CTR_TAXAADMINISTRATIVAFORMA );
          proximorecebimento = moment( proximorecebimento ).format( 'YYYY-MM-DD');
          //alert( proximorecebimento );
//          $("#IMB_LCF_DATAVENCIMENTO").val(  proximorecebimento );
//          $("#IMB_LCF_DATAVENCIMENTO").val( moment('2021/06/06').format('YYYY-MM-DD'))
          $("#I-IMB_IMV_ID").val( data[0].IMB_IMV_ID );
          $("#I-IMB_CTR_ID-LF").val( id );
          $("#i-nome").val( data[0].IMB_CLT_NOME_LOCATARIO  );
          $("#I-LBL-IMB_IMV_ID").html( 'Imóvel: '+data[0].IMB_IMV_ID  );
          $("#I-LBL-IMB_CTR_REFERENCIA").html( 'Pasta: '+data[0].IMB_CTR_REFERENCIA  );
          $("#I-LBL-ENDERECOCOMPLETO").html( data[0].ENDERECOCOMPLETO+' - '+  data[0].BAIRRO);
          $("#I-LBL-PROPRIETARIO").html( 'Locador: '+data[0].PROPRIETARIO ) ;
          $("#I-LBL-LOCATARIO").html( 'Locatário: '+data[0].IMB_CLT_NOME_LOCATARIO)
          $("#I-LBL-DIAVENCIMENTO").html( 'Dia de Vencto: '+data[0].IMB_CTR_DIAVENCIMENTO );
          $("#I-LBL-ULTIMORECEBIMENTO").html( 'Útimo Vencto. Recebido: '+ultimorecebimento );
          $("#I-LBL-ULTIMOREPASSE").html( 'Útimo Vencto. Repassado: '+moment( data[0].ULTIMOREPASSE ).format( 'DD/MM/YYYY') );
          if( ultimorecebimento != '<b>Nada Recebido</b>' )
//
          $(".i-div-informacoes").show();

//          $("#IMB_LCF_DATAVENCIMENTO").val( moment( vencimento).format('DD/MM/YYYY'));


          //montarPaginacao();
          //cargaLancamento(1);
        }
      });
    }


    function  selecionarContratoFull( id)
    {

      $("#modalbuscaltctr").modal('hide');

      var url = "{{ route('contrato.findfull') }}"+"/"+id;
      $.ajax(
      {
        url:url,
        datatype:'json',
        async:false,
        success: function( data )
        {
          $("#i-dia").val( data.IMB_CTR_DIAVENCIMENTO);
          $("#i-meses").val( 1 );
          $("#IMB_CTR_COBRARBOLETO").val( data.IMB_CTR_COBRARBOLETO );
          $("#IMB_CTR_COBRANCAVALOR").val( data.IMB_CTR_COBRANCAVALOR );
          //$("#IMB_LCF_DATAVENCIMENTO").val( data.VENCIMENTOLOCATARIO );
        }
      });
    }


    function  selecionarContratoPasta( id )
    {

      var url = "{{ route('contrato.find.pasta') }}"+"/"+id;
      $.getJSON( url, function( data)
      {
        $("#i-ctrid").val( id );
        $("#i-nome").val( data[0].IMB_CLT_NOME_LOCATARIO  );
        selecionarContrato( data[0].IMB_CTR_ID  );

      });
    }

    function apagarLancamento( id )
    {



      if (confirm("Confirma a Inativação do(s) ítem(ns) selecionado(s)?") == true) 
      {
        $.ajaxSetup(
        {
          headers:
          {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
          }
        });

        var url = "{{ route('lancamento.desativar')}}/"+id;

        $.ajax
        ({
            url : url,
            dataType:'json',
            type:'post',
            success:function(data)
            {
              alert('Gravado!!!');
              cargaLancamento(1);
            }
        })

        cargaLancamento(1);

      }
    }
   

    function montarPaginacao( quantidade )
    {

      contrato = $("#I-IMB_CTR_ID-LF").val();
      imb = $("#IMB_IMB_IDMASTER").val();
      evento =  $("#i-select-evento-filtro").val();
      aberto = $("#i-aberto").val();

      var totalpaginas = Math.ceil(quantidade / 100);
      linha='"<ul class="pagination">';
      for( nI=1;nI <= totalpaginas;nI++)
      {
        linha+= '<li><a href="javascript:cargaLancamento('+nI+')">'+nI+'</a></li>';
      };
      linha+"</ul>";

      $("#i-div-pagination").html( linha );
    }

    function cargaLancamento( pagina )
    {
      debugger;
      str = $("#I-IMB_CTR_ID-LF").val();
    $("#modallancamento").modal('hide');
    $("#div-processando").show();

    empresamaster = "{{Auth::user()->IMB_IMB_ID}}";
    evento = $("#i-select-evento-filtro").val();
    aberto = $("#i-aberto").val();
    vencimento = $("#i-select-vencimento-filtro").val();

    var url = "{{ route('lancamento.list') }}"+"/"+str+'/'+empresamaster+'/'+pagina+'/'+evento+'/'+aberto+'/'+vencimento;
      
    moment.locale('pt-br');
    $.ajax(
    {
      url:url,
      datatype:'json',
      //async:false,
      success: function( data )
      {
        linha = "";
        $("#i-tbllancamento-lf>tbody").empty();
        var chave = '';
        for( nI=0;nI < data.data.length;nI++)
        {


          var datavencimento  = moment( data.data[nI].IMB_LCF_DATAVENCIMENTO).format('DD/MM/YYYY');
          var datapagamento   = data.data[nI].IMB_LCF_DATAPAGAMENTO;
          var datarecebimento = data.data[nI].IMB_LCF_DATARECEBIMENTO;
          var nomelocador = data.data[nI].IMB_CLT_NOMELOCADOR;


          tr = '<tr>';
          if ( ( datapagamento != null && datarecebimento != null ) ||
          ( data.data[nI].IMB_LCF_LOCADORCREDEB !='N' && data.data[nI].IMB_LCF_LOCATARIOCREDEB =='N' && datapagamento != null  ) ||
          ( data.data[nI].IMB_LCF_LOCATARIOCREDEB !='N' && data.data[nI].IMB_LCF_LOCADORCREDEB =='N' && datarecebimento != null  ) )
          tr = '<tr class="linha-quitado">';

          if ( datapagamento == null )
            datapagamento = '-'
          else
            datapagamento=moment(datapagamento  ).format('DD-MM-YYYY') ;

            if ( datarecebimento == null )
            datarecebimento = '-'
          else
            datarecebimento=moment( datarecebimento ).format('DD-MM-YYYY');

          if ( nomelocador == null )
            nomelocador = '-';

          if ( data.data[nI].IMB_LCF_DTHINATIVADO != null )
              tr = '<tr class="linha-desativado">';

          datalancamento = moment( data.data[nI].IMB_LCF_DATALANCAMENTO).format('DD-MM-YYYY')              ;
          if( datalancamento === null )
            datalancamento='-';

          if( datalancamento == 'Invalid date') datalancamento='-';

          valorlancamento = parseFloat(data.data[nI].IMB_LCF_VALOR);

          observacao = data.data[nI].IMB_LCF_OBSERVACAO;
          if( observacao == null )
            observacao = '';

          fixo =  data.data[nI].IMB_LCF_FIXO;
          if( fixo == 'S') 
          {
              fixo = '<b>FIXO</b>';
              datavencimento="Recorrente";
          }
          else
              fixo = '';
          

          console.log( data.data[nI]);
          tdnumerparcela = '<td></td>';
          if( data.data[nI].IMB_PRM_USARPARCELAS == 'S' && data.data[nI].IMB_LCF_NUMPARREAJUSTE != null)
            tdnumerparcela  = '<td class="reg-lcf-content  div-center">'+data.data[nI].IMB_LCF_NUMPARREAJUSTE+"</td>";


          tdboleto='';
          if( data.data[nI].IMB_CGR_ID != null )
            var tdboleto='<a href=javascript:imprimirBoleto('+data.data[nI].IMB_CGR_ID+','
                +data.data[nI].FIN_CCI_BANCONUMERO+') class="btn btn-sm btn-dark" title="Visualizar o Boleto" ><span class="glyphicon glyphicon-barcode"></span></a> ';

          linha =
            tr +
            '<td><center><input  id="'+data.data[nI].IMB_LCF_ID+'" type="checkbox" name="registroslf" class="columncheck"></center></td>'+
            '<td class="escondido" >'+data.data[nI].IMB_LCF_ID+'</td>'+
            '<td class="reg-lcf-content  div-center" > ';
            if(  data.data[nI].IMB_ACD_ID === null || data.data[nI].IMB_ACD_ID == 0 )
                linha = linha + '<a href=javascript:selecionarLancamento('+data.data[nI].IMB_LCF_ID+') class="btn btn-sm btn-primary" title="Ver lançamento"><span class="glyphicon glyphicon-pencil"></span></a> '+
                '<a href=javascript:apagarLancamento('+data.data[nI].IMB_LCF_ID+') class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash" title="Apagar Lançamento"></span></a> ';
            else
                linha = linha + '<label class="bg-orange">EM ACORDO</label>';
                               
            linha = linha +
            '</td> '+
            '<td class="reg-lcf-content  div-center escondido">'+data.data[nI].IMB_LCF_NUMPARCONTRATO+'</td>' +
            '<td class="reg-lcf-content  div-center">'+fixo+'</td>' +
            '<td class="reg-lcf-content  div-center">'+data.data[nI].IMB_TBE_NOME+'</td>' +
            '<td class="reg-lcf-content div-right">'+formatarBRSemSimbolo(valorlancamento)+'</td>' +
            '<td class="reg-lcf-content  div-center">'+data.data[nI].IMB_LCF_LOCATARIOCREDEB+'</td>' +
            '<td class="reg-lcf-content  div-center">'+data.data[nI].IMB_LCF_LOCADORCREDEB+'</td>' +
            '<td class="reg-lcf-content  div-center"><a href=javascript:resumoParcela("'+
            moment( data.data[nI].IMB_LCF_DATAVENCIMENTO).format('YYYY-MM-DD')+'")>'+datavencimento+'</a></td>' +
            tdnumerparcela+
            '<td class="reg-lcf-content  div-center">'+tdboleto+
            '<td class="reg-lcf-content  div-center">'+nomelocador+'</td>' +
            '<td class="reg-lcf-content  div-center">'+datarecebimento+'</td>' +
            '<td class="reg-lcf-content  div-center">'+datapagamento+'</td>' +
            '<td class="reg-lcf-content  div-center">'+observacao+'</td>'+
            '<td class="reg-lcf-content  div-center">'+datalancamento+'</td>';

              linha = linha +
                          '</tr>';
          $("#i-tbllancamento-lf").append( linha );
        }
      }
    });

    var url = "{{ route('lancamento.list') }}"+"/"+str+'/'+empresamaster+'/0/'+evento+'/'+aberto+'/null';
    moment.locale('pt-br');


    $.ajax(
    {
      url:url,
      datatype:'json',
      async:false,
      success: function( data )
      {
        montarPaginacao(data.recordsTotal);
      }
    })

    $("#div-processando").hide();



  }

  function cargaEventos( evento )
  {

    var url = "{{ route('eventos.carga')}}";
    $.ajax(
    {
      url:url,
      datatype:'json',
      async:false,
      success: function( data )
      {
        $("#i-select-evento").empty();
        $("#i-select-evento-filtro").empty();
        linha =  '<option value="0">Selecione o evento</option>';
        $("#i-select-evento").append( linha );
        $("#i-select-evento-filtro").append( linha );
        for( nI=0;nI < data.length;nI++)
        {

          if ( data[nI].IMB_TBE_ID  == evento )
          {
            linha =
              '<option value="'+data[nI].IMB_TBE_ID+'" selected>'+
                  data[nI].IMB_TBE_NOME+"</option>";
                  $("#i-select-evento").append( linha );
          }
          else
          {
            linha =
              '<option value="'+data[nI].IMB_TBE_ID+'">'+
                data[nI].IMB_TBE_NOME+"</option>";
                $("#i-select-evento").append( linha );
          }
          linha =
              '<option value="'+data[nI].IMB_TBE_ID+'">'+
                data[nI].IMB_TBE_NOME+"</option>";
                $("#i-select-evento-filtro").append( linha );

        }
      }
    });
  }

  function novoLancamento()
  {

      $("#modallancamento").modal('show');
      $("#i-div-confirmarparcelas").hide();
      $("#i-div-regerarparcelas").hide();
      $("#i-div-salvarparcelas").hide();
      $("#i-div-gerarparcelas").show();
      $("#div-controle").hide();
      $( "#i-inc-multa" ).prop( "checked", false );
      $( "#i-inc-juros" ).prop( "checked", false );
      $( "#i-inc-taxa" ).prop( "checked", false );
      $( "#i-inc-irrf" ).prop( "checked", false );
      $( "#i-garantia" ).prop( "checked", false );
      $( "#i-inc-iss" ).prop( "checked", false );
      $( "#IMB_LCF_FIXO" ).prop( "checked", false );
      $( "#IMB_LCF_COBRARTAXADMMES" ).prop( "checked", false );
  
      $("#i-locadorcredeb").val('N');
      $("#i-locatariocredeb").val('N');
      $("#i-descricao").val('');
      $("#IMB_LCF_NUMPARREAJUSTE").val('0');
      $("#i-ref-final").val( 1) ;
      $("#i-ref-inicial").val(1);
                  
      
      //$("#IMB_LCF_DATAVENCIMENTO").val(moment().format('DD/MM/YYYY') );
      $("#IMB_LCF_VALOR").val('');
      $("#I-IMB_LCF_ID").val('');
      $("#i-tblparcelas>tbody").empty();

      cargaEventos();
      cargaPropImovel(0);
      cargaSelectParcelas( $("#I-IMB_CTR_ID-LF").val(),'X' );
      selecionarContratoFull( $("#I-IMB_CTR_ID-LF").val() );

  }

  $("#i-select-evento").change(function()
  {
    var evento =  $("#i-select-evento").val();
    url = "{{ route('eventos.find')}}/"+evento;

    $("#i-div-taxacontrato").hide();
    if( evento == 7 || evento == 25) $("#i-div-taxacontrato").show();

    $.ajax(
    {
      url:url,
      datatype:'json',
      async:false,
      success: function( data )
      {

        $( "#i-inc-multa" ).prop( "checked", false );
        $( "#i-inc-juros" ).prop( "checked", false );
        $( "#i-inc-taxa" ).prop( "checked", false );
        $( "#i-inc-irrf" ).prop( "checked", false );
        $( "#i-garantia" ).prop( "checked", false );
        $( "#i-inc-iss" ).prop( "checked", false );
        $( "#IMB_LCF_COBRARTAXADMMES" ).prop( "checked", false );

        if ( data.IMB_TBE_MULTA == 'S'  )
          $( "#i-inc-multa" ).prop( "checked", true );
        if ( data.IMB_TBE_JUROS == 'S'  )
          $( "#i-inc-juros" ).prop( "checked", true );
        if ( data.IMB_TBE_TAXAADM == 'S'  )
          $( "#i-inc-taxa" ).prop( "checked", true );
        if ( data.IMB_TBE_IRRF == 'S'  )
          $( "#i-inc-irrf" ).prop( "checked", true );
        if ( data.IMB_TBE_GARANTIA == 'S'  )
          $( "#i-garantia" ).prop( "checked", true );
        if ( data.IMB_TBE_INCISS == 'S'  )
          $( "#i-inc-iss" ).prop( "checked", true );

        if( data.IMB_TBE_ID == '1' || data.IMB_TBE_ID == '241' )
        {
          $("#i-locadorcredeb").val( 'C');
          $("#i-locatariocredeb").val( 'D');
        }
      }
    });




  });


  function gerarParcelas()
  {

    debugger;
    dif = parseFloat($("#i-ref-final").val()) - parseFloat($("#i-ref-inicial").val()) + 1;
       
    if( $("#i-autopreenchimento").prop( 'checked') == true )
    {
      if( dif != $("#i-meses").val())
      {
        alert( 'Quantidade de meses informado não bate com o referencia inicial e final');
        return false;
        
      }
    }
    $("#i-dia").val( moment( $("#IMB_LCF_DATAVENCIMENTO").val()).format( 'DD') );

    lcont = true;

    var evento =  $("#i-select-evento").val();
    var valor = $("#IMB_LCF_VALOR").val();
    var nDiaVencimento = $("#i-dia").val();
    var nDiaVencimentoOriginal = $("#i-dia").val();
    var meses = $("#i-meses").val();

    var locadorcredeb   = $("#i-locadorcredeb").val();
    var locatariocredeb = $("#i-locatariocredeb").val();

    if( locadorcredeb =='N' && locatariocredeb =='N')
    {
      alert('Não se pode lançar "NADA" ao locador e o mesmo para o locatário');
      return false;

    }
    if( evento == 0 )
    { alert('É necessário informar o evento');
      return false;
    }

    if( valor == '' )
    {
      alert('O Valor está zerado!');
      return false;

    }

    if( $("#i-select-parcela").val() == '' )
    {
      alert('Informe em qual parcela será lançado ou iniciado os lançamentos!');
      return false;
    }

    /*
    if( evento == 1 )
    {

      var url = "{{route('lancamento.verificaralugueljalancado')}}/"+$("#I-IMB_CTR_ID").val();

      $.ajax(
        {
          url:url,
          dataTpe:'json',
          type:'get',
          async:false,
          success:function()
          {
            alert('Atenção! Já há aluguel lançado para este mês');
            lcont = false;
          }
        }
      );
    }
*/

    if( lcont == false )
    {
      return false;
    }

    debugger;

    $("#i-parcelas").show();

    var dFormatado = moment($("#IMB_LCF_DATAVENCIMENTO").val() ).format("M-D-YYYY");

    dFormatado = new Date( dFormatado );

    var datainicial     = new Date( dFormatado.getFullYear(),
                                    dFormatado.getMonth(),
                                    nDiaVencimento);

    nMes = 0;
    nAno = 0;
    linha = "";
    descricao='';
    nMes = datainicial.getMonth();
    nAno = datainicial.getFullYear();
    nIni = 1;
    nFim = $("#i-meses").val()
    nLinha = 0;
    nParcelas=1;
    if( $("#i-autopreenchimento").prop( 'checked' ) == true )
    {
        nIni = $("#i-ref-inicial").val();
        nFim = $("#i-ref-final").val();
    }
    $("#i-yyy>tbody").empty();
    for( nParcelas=nIni ;nParcelas <= nFim;nParcelas++)
    {
      if( nParcelas != nIni )
      {
        nMes++;
        if( nMes > 11 )
        {
          nMes = 0;
          nAno++;
        }
        nUltimoDia = ultimoDiaMes( nMes+1, nAno );

        nDiaVencimento = nDiaVencimentoOriginal;
        if ( nUltimoDia < nDiaVencimentoOriginal )
        nDiaVencimento = nUltimoDia;

        datainicial = new Date( nAno, nMes, nDiaVencimento );

      };

  
      nLinha++;
      descricao = $( "#i-descricao" ).val();

      if( $("#i-autopreenchimento").prop('checked') == true )
        descricao = $( "#i-descricao" ).val() + ' - Parcela '+(nParcelas)+'/' + nFim;

      linha =
        '<tr>'+
        '<td style="text-align:center valign="center">'+nParcelas+'</td>' +
        '<td style="text-align:center valign="center">'+$( "#i-select-evento option:selected" ).text()+'</td>' +
        '<td style="text-align:center valign="center">'+locadorcredeb+'</td>' +
        '<td style="text-align:center valign="center">'+locatariocredeb+'</td>' +
        '<td style="text-align:center valign="center">'+moment(datainicial).format('DD/MM/YYYY')+'</td>' +
        '<td style="text-align:center valign="center">'+valor+'</td>' +
        '<td  style="text-align:center valign="center"><div><input class="form-control" id="i-lf-inp'+nLinha+'" value="'+descricao+'"></div></td>'
        '</tr>';

      $("#i-yyy").append( linha );



    }   ;

    $("#i-div-confirmarparcelas").show();
    $("#i-div-regerarparcelas").show();
    $("#i-div-gerarparcelas").hide();


  }

  function gravarParcelasEmBanco()
  {
    debugger;

    aLF = [];
    var linha = 1;
    $('#i-yyy tbody tr').each(function ()
    {
      $.ajaxSetup(
      {
        headers:
        {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
        }
      });

      //debugger;
      var colunas = $(this).children();
        // Criar objeto para armazenar os dados (com JSON essa tarefa fica mais simples)
      var lf =
      {
          IMB_LCF_VALOR: realToDolar( $(colunas[5]).text()),
          IMB_LCF_LOCADORCREDEB: $(colunas[2]).text(),
          IMB_LCF_LOCATARIOCREDEB: $(colunas[3]).text(),
          IMB_LCF_DATAVENCIMENTO: $(colunas[4]).text(),
          IMB_LCF_OBSERVACAO: $("#i-lf-inp"+linha).val(),
	        IMB_LCF_TIPO: 'M' ,
          IMB_CTR_ID: $("#I-IMB_CTR_ID-LF").val(),
          IMB_IMV_ID: $("#I-IMB_IMV_ID").val(),
          IMB_TBE_ID: $("#i-select-evento").val(),
          IMB_LCF_INCMUL: $("#i-inc-multa").prop( "checked" )   ? 'S' : 'N',
          IMB_LCF_INCIRRF: $("#i-inc-irrf").prop( "checked" )   ? 'S' : 'N',
          IMB_LCF_INCTAX: $("#i-inc-taxa").prop( "checked" )   ? 'S' : 'N',
          IMB_LCF_INCJUROS: $("#i-inc-juros").prop( "checked" )   ? 'S' : 'N',
          IMB_LCF_INCCORRECAO: $("#i-inc-juros").prop( "checked" )   ? 'S' : 'N',
          IMB_LCF_GARANTIDO: $("#i-garantia").prop( "checked" )   ? 'S' : 'N',
          IMB_LCF_INCISS: $("#i-inc-iss").prop( "checked" )   ? 'S' : 'N',
          IMB_LCF_FIXO: $("#IMB_LCF_FIXO").prop( "checked" )   ? 'S' : 'N',
          IMB_LCF_COBRARTAXADMMES: $("#IMB_LCF_COBRARTAXADMMES").prop( "checked" )   ? 'S' : 'N',
          IMB_CLT_IDLOCADOR: $("#i-select-locadorsomente").val(),


      };

      linha = linha +1;
      aLF.push( lf );
    } );

    console.log( aLF )
    debugger;
     var url = "{{ route('lancamento.gravararray')}}";


        $.ajax(
        {
          url:url,
          type:'post',
          datatype:'json',
          async:false,
          data: { lfs : aLF},
          async:false,
          success:function( )
          {
            alert('Gravado!!!');

          },
          error: function()
          {
            alert('Erro na gravação do LF');
          }
        });
    console.log( aLF);
    cargaLancamento(1);


  }


  function salvarParcelas()
  {debugger;
    $.ajaxSetup(
    {
      headers:
      {
          'X-CSRF-TOKEN': "{{csrf_token()}}"
      }
    });

    var valor = $("#IMB_LCF_VALOR").val();
    valor = realToDolar( valor );

      // Criar objeto para armazenar os dados (com JSON essa tarefa fica mais simples)
    var lf =
    {
        IMB_IMB_ID: $("#I-IMB_IMB_IDMASTER").val(),
        IMB_LCF_ID: $("#I-IMB_LCF_ID").val(),
        IMB_CTR_ID: $("#I-IMB_CTR_ID-LF").val(),
        IMB_IMV_ID: $("#I-IMB_IMV_ID").val(),
        IMB_LCF_TIPO: 'M',
        IMB_LCF_VALOR: valor,
        IMB_ATD_ID: $("#IMB_ATD_ID").val(),
        IMB_LCF_LOCADORCREDEB: $("#i-locadorcredeb").val(),
        IMB_LCF_LOCATARIOCREDEB: $("#i-locatariocredeb").val(),
        IMB_LCF_DATAVENCIMENTO: $("#IMB_LCF_DATAVENCIMENTO").val(),
        IMB_LCF_OBSERVACAO:  $("#i-descricao").val(),
	      IMB_LCF_TIPO: 'M' ,
        IMB_CLT_IDLOCADOR: $("#i-select-locadorsomente").val(),
        IMB_TBE_ID: $("#i-select-evento").val(),
        IMB_LCF_INCMUL: $("#i-inc-multa").prop( "checked" )   ? 'S' : 'N',
        IMB_LCF_INCIRRF: $("#i-inc-irrf").prop( "checked" )   ? 'S' : 'N',
        IMB_LCF_INCTAX: $("#i-inc-taxa").prop( "checked" )   ? 'S' : 'N',
        IMB_LCF_INCJUROS: $("#i-inc-juros").prop( "checked" )   ? 'S' : 'N',
        IMB_LCF_INCCORRECAO: $("#i-inc-juros").prop( "checked" )   ? 'S' : 'N',
        IMB_LCF_GARANTIDO: $("#i-garantia").prop( "checked" )   ? 'S' : 'N',
        IMB_LCF_INCISS: $("#i-inc-iss").prop( "checked" )   ? 'S' : 'N',
        IMB_LCF_FIXO: $("#IMB_LCF_FIXO").prop( "checked" )   ? 'S' : 'N',
        replicaralteracao : $("#i-replicar").prop( "checked" )   ? 'S' : 'N',
        IMB_LCF_COBRARTAXADMMES: $("#IMB_LCF_COBRARTAXADMMES").prop( "checked" )   ? 'S' : 'N',        
        IMB_LCF_NUMPARREAJUSTE: $("#IMB_LCF_NUMPARREAJUSTE").val(),
    };
    var url = "{{ route('lancamento.gravar')}}";


    $.ajax(
    {
      url:url,
      type:'post',
      datatype:'json',
      async:false,
      data: lf,
      async:false,
      success:function( )
      {
        alert('Informações Gravadas com Sucesso')
      },
      error: function()
      {
        alert('Erro na gravação do LF');
      }
    });

    cargaLancamento(1);


  }


  function  selecionarLancamento( id )
  {



      $( "#i-inc-multa" ).prop( "checked", false );
      $( "#i-inc-juros" ).prop( "checked", false );
      $( "#i-inc-taxa" ).prop( "checked", false );
      $( "#i-inc-irrf" ).prop( "checked", false );
      $( "#i-garantia" ).prop( "checked", false );
      $( "#i-inc-iss" ).prop( "checked", false );
      $("#i-replicar").prop( "checked" , false );
      $("#IMB_LCF_FIXO").prop( "checked" , false );
      $("#div-controle").show();

      $("#IMB_LCF_COBRARTAXADMMES").prop( "checked" , false );

      $("#i-meses").val(1);
      $("#i-locadorcredeb").val('N');
      $("#i-locatariocredeb").val('N');
      $("#IMB_LCF_DATAVENCIMENTO").val('');
      $("#IMB_LCF_VALOR").val('');
      $("#i-tblparcelas>tbody").empty();

      $("#i-div-confirmarparcelas").hide();
      $("#i-div-regerarparcelas").hide();
      $("#i-div-salvarparcelas").show();
      $("#i-div-gerarparcelas").hide();

      url = "{{ route('lancamento.edit')}}/"+id;

      $.getJSON( url, function( data)
      {
        $("#I-IMB_LCF_ID").val( id );

        cargaEventos( data[0].IMB_TBE_ID );
        cargaPropImovel(data[0].IMB_CLT_IDLOCADOR );

        $("#i-div-taxacontrato").hide();
        if( data[0].IMB_TBE_ID == 7 || data[0].IMB_TBE_ID == 25) $("#i-div-taxacontrato").show();


      if ( data[0].IMB_LCF_INCMUL == 'S' )
        $( "#i-inc-multa" ).prop( "checked", true );

      if ( data[0].IMB_LCF_INCJUROS == 'S' )
        $( "#i-inc-juros" ).prop( "checked", true );

      if ( data[0].IMB_LCF_INCTAX == 'S' )
        $( "#i-inc-taxa" ).prop( "checked", true );

      if ( data[0].IMB_LCF_INCIRRF == 'S' )
        $( "#i-inc-irrf" ).prop( "checked", true );

      if ( data[0].IMB_LCF_GARANTIDO == 'S' )
        $( "#i-garantia" ).prop( "checked", true );

      if ( data[0].IMB_LCF_INCISS == 'S' )
        $( "#i-inc-iss" ).prop( "checked", true );
      if ( data[0].IMB_LCF_FIXO == 'S' )
        $( "#IMB_LCF_FIXO" ).prop( "checked", true );

    if ( data[0].IMB_LCF_COBRARTAXADMMES == 'S' )
        $( "#IMB_LCF_COBRARTAXADMMES" ).prop( "checked", true );



      $("i-select-evento").text( data[0].IMB_TBE_NOME );
      $("i-select-evento").val( data[0].IMB_TBE_ID );
      $("#i-locadorcredeb").val( data[0].IMB_LCF_LOCADORCREDEB);
      $("#i-locatariocredeb").val( data[0].IMB_LCF_LOCATARIOCREDEB );
      $("#IMB_LCF_DATAVENCIMENTO").val( data[0].IMB_LCF_DATAVENCIMENTO );
      $("#i-descricao").val( data[0].IMB_LCF_OBSERVACAO );
      $("#IMB_LCF_NUMPARREAJUSTE").val( data[0].IMB_LCF_NUMPARREAJUSTE );
      


      nValor = parseFloat( data[0].IMB_LCF_VALOR );
      nValor = formatarBRSemSimbolo( nValor );
      $("#IMB_LCF_VALOR").val( nValor );

      formatarBRSemSimbolo( nValor )

      $("#I-IMB_LCF_ID").val( id );

      $("#modallancamento").modal('show');

      });
    }


  $("#di-div-salvarparcelas").click( function()
  {
    salvarParcelas();
  });

  function cargaPropImovel( idlocador )
  {

    var id = $("#I-IMB_IMV_ID").val();
    url = "{{ route('propimo.carga')}}/"+id;
    $.getJSON( url, function( data )
    {
      $("#i-select-locadorsomente").empty();
      linha = '<option value="0"></option>';
      $("#i-select-locadorsomente").append( linha );
      for( nI=0;nI < data.length;nI++)
      {

        if( data[nI].IMB_CLT_ID == idlocador )
        {
          linha =
            '<option value="'+data[nI].IMB_CLT_ID+'" selected>'+
                              data[nI].IMB_CLT_NOME+"</option>"
        }
        else
        {
          linha =
            '<option value="'+data[nI].IMB_CLT_ID+'" >'+
                              data[nI].IMB_CLT_NOME+"</option>"

        }
        $("#i-select-locadorsomente").append( linha );

      }
    });
  }

/*  function carregarOpcao( modulo, opcao)
    {

        var usuario = $("#I-IMB_ATD_ID").val();


        direito="{{route('direito.checar')}}";

        var retorno = direitoAcesso( usuario, modulo, opcao, direito );

        if ( direitoAcesso( usuario, modulo, opcao, direito ) == 'N' )
        {
          Swal.fire({
              position: 'center',
                icon: 'abort',
            title: 'Sem permissão!',
            showConfirmButton: true,
            timer: 5000
            });

            return false;
//            if ( voltar )
              //window.history.back();
            }
        return true;

    }
*/
function filtrar()
    {
      $("#modalfiltro").modal('show');
      cargaEventos();

    }

    function filtrarAbertoLocador()
    {

      $("#i-aberto").val('D');
      cargaLancamento(1);
    }
    function filtrarAbertoLocatario()
    {

      $("#i-aberto").val('T');
      cargaLancamento(1);
    }

    function reexibirTodos()
    {
      window.location.reload();

    }

    function processarFiltro()
    {
      $("#i-codigocliente").val('N');
      cargaLancamento(1);
      $("#modalfiltro").modal('hide');

    }


    function verificarSelecao() {
      var chks = document.getElementById("i-tbllancamento-lf").getElementsByTagName("input");

      var regs = new Array();


      for (var i=0; i<chks.length; i++)
      {
        if (chks[i].type == "checkbox" &  chks[i].checked==true)
        {

          regs.push( chks[i].value );
          //console.log('uuuu '+url);
        }
      };

      url = "{{ route('boleto.gerarlf')}}";

       //url = "{{ route('boleto.gerarlf')}}/"+chks[i].value;
       $.ajaxSetup(
       {
         headers:
         {
           'X-CSRF-TOKEN': "{{csrf_token()}}"
         }
       });

       atm = {
         lf : regs,
         IMB_ATD_ID : $("#I-IMB_ATD_ID").val()
       }

      //alert( url );
       $.ajax(
       {
         url: url,
         type: "post",
         async:false,
         datatype:"json",
         data: atm,
         success: function( data )
         {

          cargaItensTemp();

         },
         error: function( error )
         {
           console.log('deu erro');
         }
       });


      //alert( regs );


   }


  function gerarBoleto()
  {

    if(  $("#i-aberto").val() =='N' )
    {
      alert('Primeiramente click em "Abertos Locatário');
      return false;

    }

    zerarBoletotmp();
    if (  verificarSelecao() == false )
    {
      alert('Nada selecionado');
      return false;
    }

    cargaContaCaixa();

    $("#modalboleto").modal('show');

  }

  function zerarBoletotmp()
  {
    url = "{{ route('boleto.zerartmp')}}/"+$("#I-IMB_ATD_ID").val();

        $("#tbllancamentosacordo>tbody").empty();


    $.ajax(
    {
      url: url,
      type: "GET",
      async:false,
      success: function( data )
      {

      }
    });
  }

  function cargaItensTemp()
  {
    url = "{{ route('boleto.cargaitenstmp')}}/"+$("#I-IMB_ATD_ID").val();
    $.ajax(
    {
        url: url,
        type: "GET",
        async:false,
        success: function( data )
        {

          var linha = "";
          var total = 0;
          var valorlancamento = 0;
          $("#i-tblparcelasboleto>tbody").empty();
          for( nI=0;nI < data.length;nI++)
          {
          //  alert( data[nI].IMB_RLT_LOCATARIOCREDEB  );

          if( data[nI].IMB_RLT_LOCATARIOCREDEB =='C' )
              total = total - parseInt( data[nI].IMB_LCF_VALOR )
            else
            if( data[nI].IMB_RLT_LOCATARIOCREDEB =='D' )
              total = total + parseInt( data[nI].IMB_LCF_VALOR);


            valorlancamento = data[nI].IMB_LCF_VALOR;

            linha =
              '<tr>'+
              '<td style="text-align:center valign="center">'+data[nI].IMB_TBE_ID+'</td>' +
              '<td style="text-align:center valign="center">'+data[nI].IMB_TBE_DESCRICAO+'</td>' +
              '<td style="text-align:center valign="center">'+data[nI].IMB_RLT_LOCATARIOCREDEB+'</td>' +
              '<td style="text-align:center valign="center">'+moment( data[nI].IMB_LCF_DATAVENCIMENTO).format('DD/MM/YYYY')+'</td>' +
              '<td style="text-align:center valign="center">'+valorlancamento+'</td>' +
              '<td style="text-align:center valign="center">'+data[nI].IMB_LCF_OBSERVACAO+'</td>' ;
                linha = linha +
                            '</tr>';
                            $("#i-tblparcelasboleto").append( linha );

          }

          var valorFormatado = total.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });


          $("#i-total-selecionado").html( 'Total Selecionado: R$ '+valorFormatado );
//          $("#tbllancamentosacordo").html( $("#i-tblparcelasboleto").html());
        }

     });

  }

  function cargaContaCaixa()
  {

    var url = "{{ route('contacaixa.carga')}}/S";
    $.ajax(
    {
      url:url,
      datatype:'json',
      async:false,
      success: function( data )
      {
        $("#i-select-conta").empty();
        linha =  '<option value="0">Selecione a conta banco</option>';
        for( nI=0;nI < data.length;nI++)
        {

            linha =
              '<option value="'+data[nI].FIN_CCX_ID+'">'+
                data[nI].FIN_CCX_DESCRICAO+"</option>";
            $("#i-select-conta").append( linha );

        }
      }
    });

  }


  function gerarBoletoFase2()
  {

    if( $("#i-vencimento-boleto").val() == '' )
    {

      alert('Data de vencimento é preenchimento obrigatório!');
      return false;

    }

    if( $("#FIN_CCX_ID_BOLETO").val() =='-1')
    {
        alert('Informe a conta de boleto');
        return false;
    }

    var asel = [];

    var url = "{{route('cobranca.geraravulso')}}";

    $.each($("input[name='registroslf']:checked"), function ()
    {
      var data = $(this).parents('tr:eq(0)');
      var lcf = $(data).find('td:eq(1)').text();



      asel.push( lcf )
    });

    var dados =
    {
       datavencimento : $("#i-vencimento-boleto").val(),
       contacobranca : $("#i-select-conta").val(),
       idcontrato: $("#I-IMB_CTR_ID-LF").val(),
       selecao : asel,

    }

    $.ajax(
    {
        url         : url,
        dataType    : 'json',
        type        : 'get',
        data        : dados,

        beforeSend: function()
        {
            alert('O sistema irá processar, e ao finalizar você será informado. Pressione OK para continuar');
        },
        success:function( data )
        {
            alert('Cobrança Gerada com Sucesso');
            window.location="{{route('cobrancabancaria.cobrancagerada')}}";

        },
        error:function()
        {
            alert( 'erro na geração');
        }
    });




  }
  function validaDat(campo,valor) {
	var date=valor;
	var ardt=new Array;
	var ExpReg=new RegExp("(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[012])/[12][0-9]{3}");
	ardt=date.split("/");
	erro=false;
	if ( date.search(ExpReg)==-1){
		erro = true;
		}
	else if (((ardt[1]==4)||(ardt[1]==6)||(ardt[1]==9)||(ardt[1]==11))&&(ardt[0]>30))
		erro = true;
	else if ( ardt[1]==2) {
		if ((ardt[0]>28)&&((ardt[2]%4)!=0))
			erro = true;
		if ((ardt[0]>29)&&((ardt[2]%4)==0))
			erro = true;
	}
	if (erro) {
		alert("data não é válida!!!");
//		campo.focus();
		campo.value = "";
		return false;
	}
	return true;
}


function resumoParcela( chave )
{

  
  var url = "{{route('parcelaaberta.locatario')}}/"+chave+'/'+$("#I-IMB_CTR_ID-LF").val()+'/S';

  $.ajax(
    {
      url         : url,
      type        : 'get',
      dataType    : 'json',
      async       : false,
      success     : function( data )
      {
        linha = "";
        $("#i-tlblf-resumo>tbody").empty();
        var chave = '';
        for( nI=0;nI < data.data.length;nI++)
        {


          var datavencimento  = moment( data.data[nI].IMB_LCF_DATAVENCIMENTO).format('DD/MM/YYYY');
          var nomelocador = data.data[nI].IMB_CLT_NOMELOCADOR;

          $("#i-lbl-header-modalresumoparcelas").html('Locatário: '+$("#i-nome").val() );


          $("#i-data-vencimento").val( moment( data.data[nI].IMB_LCF_DATAVENCIMENTO ).format('YYYY-MM-DD'));

          tr = '<tr>';

          if ( nomelocador == null )
            nomelocador = '-';

          if ( data.data[nI].IMB_LCF_DTHINATIVADO != null )
              tr = '<tr class="linha-desativado">';

          valorlancamento = parseFloat(data.data[nI].IMB_LCF_VALOR);

          linha =
            tr +
            '<td style="text-align:center valign="center">'+data.data[nI].IMB_LCF_ID+'</td>'+
            '<td style="text-align:center valign="center">'+data.data[nI].IMB_TBE_ID+'</td>' +
            '<td style="text-align:center valign="center">'+data.data[nI].IMB_TBE_NOME+'</td>' +
            '<td style="text-align:center valign="center">'+formatarBRSemSimbolo(valorlancamento)+'</td>' +
            '<td style="text-align:center valign="center">'+data.data[nI].IMB_LCF_LOCATARIOCREDEB+'</td>' +
            '<td style="text-align:center valign="center">'+data.data[nI].IMB_LCF_LOCADORCREDEB+'</td>' +
            '<td style="text-align:center valign="center">'+datavencimento+'</td>' +
            '<td style="text-align:center valign="center">'+nomelocador+'</td>' +
            '<td style="text-align:center valign="center">'+data.data[nI].IMB_LCF_OBSERVACAO+'</td>';
              linha = linha +
                          '</tr>';
          $("#i-tlblf-resumo").append( linha );
        }
      }
    });

    $("#i-data-base").val( moment().format( 'YYYY-MM-DD') );
    $("#modalresumoparcela").modal('show');
    $('#i-div-recebimento').hide();

    calcularRecebimento();
}


function calcularRecebimento()
{

  var table = document.getElementById('i-tlblf-resumo');

  var nTotalaReceber = 0;
  var nBaseIRRF = 0;
  var nBaseMulta = 0;
  var nBaseJuros = 0;
  var nBaseTaxaAdm = 0;
  var nBaseCorrecao=0;
  var nIdLf = 0;
  var nIdTbe = 0;

  $("#div-processando").html('Em processamento. Aguarde.');

  for (var r = 1, n = table.rows.length; r < n; r++)
  {

    nValorLancamento          =  realToDolar(table.rows[r].cells[3].innerHTML);
    nValorLancamento          = parseFloat( nValorLancamento );
    cLocatarioDC              =  realToDolar(table.rows[r].cells[4].innerHTML);
    nIdLf                     = table.rows[r].cells[0].innerHTML
    nIdTbe                    = table.rows[r].cells[2].innerHTML


    if( cLocatarioDC == 'C' )
      nValorLancamento = nValorLancamento * -1;


    if( cLocatarioDC != 'N' )
      nTotalaReceber = nTotalaReceber + nValorLancamento;

    if( IncideMultaLT( nIdTbe, nIdLf )   == 'S' )
       nBaseMulta = nBaseMulta + nValorLancamento;

    if( IncideJurosLT( nIdTbe, nIdLf )  == 'S' )
       nBaseJuros = nBaseJuros + nValorLancamento;

    if( IncideCorrecaoLT( nIdTbe, nIdLf )  == 'S' )
      nBaseCorrecao = nBaseCorrecao + nValorLancamento;

    if( IncideTaxaAdministrativaLT( nIdTbe, nIdLf )   == 'S' )
      nBaseTaxaAdm = nBaseTaxaAdm + nValorLancamento;

    if( IncideIRRFLT( nIdTbe, nIdLf )   == 'S' )
      nBaseIRRF = nBaseIRRF + nValorLancamento;

    $("#i-valores-lancados").val( nTotalaReceber.toFixed(2) );

  };

  //VERIFICANDO O PROXIMO DIA UTIL CONFORME A DATA DE VENCIMENTO
  url = "{{route('proximodiautil')}}/"+$("#i-data-vencimento").val();
  $("#div-processando").html('Em processamento. Aguarde..');

  var datalimite = Date();
  $.ajax(
    {
      url     : url,
      type    : 'get',
      dataType:'Json',
      async   : false,
      success : function( data )
      {
        $("#div-processando").html('Em processamento. Aguarde...');
        datalimite = date;
      }
    }
  )

  var nDiferencaDias = 0;
  url = "{{route('diasdevencido')}}/"+$("#i-data-vencimento").val()+"/"+$("#i-data-base").val();
  $("#div-processando").html('Em processamento. Aguarde....');

  var datalimite = Date();
  $.ajax(
    {
      url     : url,
      type    : 'get',
      dataType:'Json',
      async   : false,
      success : function( data )
      {
        $("#div-processando").html('Em processamento. Aguarde......');

        nDiferencaDias = data;
      }
    }
  )

  var nBaseMultaImob = 0;
  var nBaseMultaNormal =0;

  var nValorJuros     = 0;
  var nValorCorrecao  = 0;
  var nMultaReter     = 0;
  var nMultaRepassar  = 0;
  var nValorBoleto    = 0;

  url = "{{route('pegarpercmultatabela')}}/"+nDiferencaDias;
  $("#div-processando").html('Em processamento. Aguarde.');

  var datalimite = Date();
  $.ajax(
    {
      url     : url,
      type    : 'get',
      dataType:'Json',
      async   : false,
      success : function( data )
      {
        $("#div-processando").html('Em processamento. Aguarde..');
        nBaseMultaImob = data.faixaimob;
        nBaseMultaNormal = data.faixanormal;
      }
    }
  )

  if( nDiferencaDias > 0 )
  {


    if( nBaseMultaImob != 0)
    {
      nMultaReter     = nBaseMulta * nBaseMultaImob / 100 ;


    }
    if( nBaseMultaNormal != 0)
    {
      nMultaRepassar     = nBaseMulta * nBaseMultaNormal / 100 ;

    }
  }

  url = "{{route('pegarbasescontrato')}}/"+$("#I-IMB_CTR_ID-LF").val();
  $("#div-processando").html('Em processamento. Aguarde...');

  var nPerJur = 0;
  var nPerCor = 0;
  var aluguelgarantido = ' ';
  var datalimite = Date();
  $.ajax(
  {
      url     : url,
      type    : 'get',
      dataType:'Json',
      async   : false,
      success : function( data )
      {
        $("#div-processando").html('Em processamento. Aguarde....');

        console.log( data );
        if( nDiferencaDias > 0 )
        {
          nPerJur = data.jurosdiario;
          if( nPerJur == null ) nPerJur = 0;
          nPerCor = data.correcaodiaria;
          if( nPerCor == null ) nPerCor = 0;
        }
        nValorBoleto = data.valorboleto;
        aluguelgarantido = data.aluguelgarantido;
        $("#i-aluguelgarantido").val( aluguelgarantido) ;
        if( nValorBoleto == null ) nValorBoleto = 0;

      }
  });

  if( nPerJur    != 0 )
  {
    nValorJuros   =  nBaseJuros * nPerJur / 100 * nDiferencaDias;
  }

  if( nPerCor     != 0 )
  {
    nValorCorrecao =  nBaseCorrecao * nPerCor / 100 * nDiferencaDias;
  }
  nMultaRepassar = parseFloat( nMultaRepassar);
  nMultaReter = parseFloat( nMultaReter);
  nValorJuros = parseFloat( nValorJuros);
  nValorCorrecao = parseFloat( nValorCorrecao);
  nValorBoleto = parseFloat( nValorBoleto);


  $("#div-processando").html('Em processamento. Aguarde......');




  if( $("#i-aluguelgarantido").val() == 'S' )
  {
    $("#i-jurosreter").val( formatarBRSemSimbolo( nValorJuros ) );
    $("#i-jurosrepassar").val( 0 ) ;
    $("#i-jurosrepassar").prop('disabled', true);
    $("#i-jurosreter").prop('disabled', false);

    $("#i-correcaoreter").val( formatarBRSemSimbolo( nValorCorrecao ) );
    $("#i-correcaorepassar").val( 0 ) ;
    $("#i-correcaorepassar").prop('disabled', true);
    $("#i-correcaoreter").prop('disabled', false);

    $("#i-multarepassar").val( 0) ;
    $("#i-multareter").val( formatarBRSemSimbolo( nMultaReter+nMultaRepassar ) );

  }
  else
  {
    $("#i-jurosrepassar").val( formatarBRSemSimbolo( nValorJuros ) );
    $("#i-jurosrepassar").prop('disabled', false);
    $("#i-jurosreter").val( 0 );
    $("#i-jurosreter").prop('disabled', true);

    $("#i-correcaorepassar").val( formatarBRSemSimbolo( nValorCorrecao ) );
    $("#i-correcaorepassar").prop('disabled', false);
    $("#i-correcaoreter").val( 0 );
    $("#i-correcaoreter").prop('disabled', true);

    $("#i-multarepassar").val( formatarBRSemSimbolo( nMultaRepassar ) );
    $("#i-multareter").val( formatarBRSemSimbolo( nMultaReter ) );


  }

  //calcular irrrf
  url = "{{route('calcularirrf')}}/"+$("#I-IMB_IMV_ID").val()+'/'+nBaseIRRF;
  var nValorTotalIRRF = 0;


  $.ajax(
  {
      url     : url,
      type    : 'get',
      dataType:'Json',
      async   : false,
      success : function( data )
      {

        for( nI=0;nI < data.length;nI++)
        {
          nValorTotalIRRF = nValorTotalIRRF + data[ nI ].valorIRRF;
        }

        $("#i-irrf").val( formatarBRSemSimbolo(nValorTotalIRRF) )


      }
  });



  $("#i-boleto").val( formatarBRSemSimbolo(nValorBoleto) );


  nTotalaReceber =  ( nTotalaReceber +
                      nMultaRepassar +
                      nMultaReter +
                      nValorJuros +
                      nValorCorrecao +
                      nValorBoleto)
                      -
                      (nValorTotalIRRF);


  $("#i-totalareceber").html( formatarBRSemSimbolo( nTotalaReceber.toFixed(2)) );
  $("#div-processando").html('');

  $('#i-div-recebimento').show();


}

function cargaSelectParcelas( idcontrato, ldlt )
{

  var url = "{{route('parcelaaberta.vencimentonumeroparcela')}}/"+idcontrato+"/"+ldlt;
  $.ajax(
    {
      url:url,
      datatype:'json',
      async:false,
      success: function( data )
      {
        $("#i-select-parcela").empty();
        linha =  '<option value="">Selecione a parcela/vencimento</option>';
        $("#i-select-parcela").append( linha );
        if( data.length > 0 )
        {
          for( nI=0;nI < data.length;nI++)
          {

              var parcela = data[nI].IMB_LCF_NUMPARCONTRATO;
              parcela = (parcela+'').padStart(3,'0');
              linha =
                '<option value="'+data[nI].IMB_LCF_DATAVENCIMENTO+'">'+
                'Parcela: '+parcela+' - Vencto:'+moment(data[nI].IMB_LCF_DATAVENCIMENTO).format('DD/MM/YYYY')+"</option>";
                $("#i-select-parcela").append( linha );
          }

        }
      }
    });


}

function imprimirBoleto( id,banco )
{


  if( banco == 33 )
    window.open("{{route('boleto.santander')}}/"+id+'/N', '_blank');

}
function receberRepassar()
{
    
  debugger;
  $("#preloader").show();  
  $("#i-div-dados-receber").hide();
  $("#i-div-dados-repassar").hide();
  linha = "";
  $("#i-tblselecionados>tbody").empty();
  var chave = '';
  var totallocador=0;
  var totallocatario=0;
  var valor=0;
  var baseIRRF=0;
  var baseISS=0;
  var baseTA=0;
  var totalmulta=0;
  var totaljuros=0;
  cargaFPRepasse();  
  $.each($("input[name='registroslf']:checked"), function ()
  {
    var data = $(this).parents('tr:eq(0)');
    var lcf = $(data).find('td:eq(1)').text();

  


    url = "{{route('lancamento.edit')}}/"+lcf;

    $.ajax(
    {
      url : url,
      dataType:'json',
      type:'get',
      async:false,
      success:function( data )
      {

        datapagamento   = data[0].IMB_LCF_DATAPAGAMENTO;
        datarecebimento = data[0].IMB_LCF_DATARECEBIMENTO;

          tr = '<tr id="row_'+data[0].IMB_LCF_ID+'">';
        if ( ( datapagamento != null && datarecebimento != null ) ||
               ( data[0].IMB_LCF_LOCADORCREDEB !='N'    && data[0].IMB_LCF_LOCATARIOCREDEB =='N' && datapagamento != null  ) ||
               ( data[0].IMB_LCF_LOCATARIOCREDEB !='N'  && data[0].IMB_LCF_LOCADORCREDEB =='N' && datarecebimento != null  ) )
               tr = '<tr id="row_'+data[0].IMB_LCF_ID+'"class="linha-quitado">';


        valorlancamentolocatario = parseFloat( data[0].IMB_LCF_VALOR);
        valorlancamentolocador = parseFloat( data[0].IMB_LCF_VALOR);

        if( data[0].IMB_LCF_DATARECEBIMENTO != null )
          valorlancamentolocatario = 0;
        if( data[0].IMB_LCF_DATAPAGAMENTO != null )
          valorlancamentolocador = 0;

        if ( data[0].IMB_LCF_DTHINATIVADO != null )
          valorlancamento = 0;

        if( data[0].IMB_LCF_LOCADORCREDEB == 'D' )
           valorlancamentolocador = valorlancamentolocador * -1;

        if( data[0].IMB_LCF_LOCATARIOCREDEB == 'C' )
          valorlancamentolocatario = valorlancamentolocatario * -1;


        if( data[0].IMB_LCF_LOCADORCREDEB != 'N' )
          totallocador = totallocador + valorlancamentolocador;

        if( data[0].IMB_LCF_LOCATARIOCREDEB != 'N' )
          totallocatario = totallocatario + valorlancamentolocatario;


        tbeid = data[0].IMB_TBE_ID;
        lcfid = data[0].IMB_LCF_ID;
        if( data[0].IMB_LCF_INCIRRF == 'S' )
        {
          baseIRRF = baseIRRF + valorlancamentolocador;
        }

        if( data[0].IMB_LCF_INCISS == 'S' )
        {
          baseISS = baseISS + valorlancamentolocador;
        }

        if( data[0].IMB_LCF_INCTAX == 'S' )
        {
          baseTA = baseTA + valorlancamentolocador;
        }

        if ( datapagamento == null )
              datapagamento = '-'
        else
              datapagamento=moment(datapagamento  ).format('DD-MM-YYYY') ;

        if ( datarecebimento == null )
              datarecebimento = '-'
        else
              datarecebimento=moment( datarecebimento ).format('DD-MM-YYYY');


        if ( data[0].IMB_LCF_DTHINATIVADO != null )
            tr = '<tr id="row_'+data[0].IMB_LCF_ID+'" class="linha-desativado">';


              valorlancamento =  parseFloat(data[0].IMB_LCF_VALOR);
              valorlancamento =formatarBRSemSimbolo(valorlancamento);


        $("#i-datadevencimentoavulso").val( data[0].IMB_LCF_DATAVENCIMENTO);
        $("#i-aluguelgarantido").val(data[0].IMB_CTR_ALUGUELGARANTIDO)        ;
        observacao = data[0].IMB_LCF_OBSERVACAO;
        if( observacao === null )
              observacao = '';

          multa = 0;
          juros = 0;
          if( data[0].IMB_LCF_DATARECEBIMENTO == null )
          {
            multa =calcularMulta(data[0].IMB_LCF_ID, data[0].IMB_CTR_ID);
            juros =calcularJuros(data[0].IMB_LCF_ID, data[0].IMB_CTR_ID);
            totalmulta = totalmulta + multa;
            totaljuros = totaljuros + juros;
          }

        linha =
            tr +
            '<td class="escondido"></td>'+
            '<td class="escondido">'+data[0].IMB_LCF_ID+'</td>'+
            '<td class="reg-lcf-content  div-center">'+data[0].IMB_TBE_ID+'</td>' +
            '<td class="reg-lcf-content  div-center">'+data[0].IMB_TBE_NOME+'</td>' +
            '<td class="reg-lcf-content  div-right">'+valorlancamento+'</td>'+
            '<td class="reg-lcf-content  div-center">'+data[0].IMB_LCF_LOCATARIOCREDEB+'</td>' +
            '<td class="reg-lcf-content  div-center">'+data[0].IMB_LCF_LOCADORCREDEB+'</td>' +
            '<td class="reg-lcf-content  div-center">'+moment( data[0].IMB_LCF_DATAVENCIMENTO).format('DD-MM-YYYY')+'</td>' +
            '<td class="reg-lcf-content  div-center"></td>'+
            '<td class="reg-lcf-content  div-center">'+observacao+'</td>'+
            '<td class="escondido"></td>'+
            '<td class="escondido">N</td>'+
            '<td class="escondido"></td>'+
            '<td class="escondido">0</td>'+
            '<td class="font-red" ><div><input type="text" class="valor multa" id="multa'+data[0].IMB_LCF_ID+'" value="'+formatarBRSemSimbolo( multa )+'"></div></td>'+
            '<td class="font-red" ><div><input type="text" class="valor juros" id="juros'+data[0].IMB_LCF_ID+'" value="'+formatarBRSemSimbolo( juros )+'"></div></td>'+

            '</td> ';

        linha = linha + '</tr>';
        $("#i-tblselecionados").append( linha );
      },
    
      complete:function()
      {
        $("#preloader").hide();
      }
      
    });
  });

  linhasEncargos( totalmulta, totaljuros)



  debugger;

  totalreceb = totalmulta + totaljuros + totallocatario;
  
  totalreceb = totalreceb.toFixed(2);
  totalreceb = dolarToReal( totalreceb );
  totalreceb = formatarBRSemSimbolo( totalreceb )
  
  totallocador = totallocador.toFixed(2);
  totallocador = dolarToReal( totallocador );
  totallocador = formatarBRSemSimbolo( totallocador )

  $("#i-totalareceber").val(totalreceb );
  $("#i-totalarepassar").val( totallocador );
  $("#modalitensselecionados").modal('show');


  $("#i-total-apurado").val(totalreceb);
  $("#i-total-dinheiro").val(totalreceb );

  //coloquei aqui para a confirmar receto no layout dadoreceber

  //debugger;
  var taxacalculada = 0;
  if( baseTA != 0 )
  {
    if( $("#i-taxaadministrativaforma").val() == 'P' )
    {
      taxacalculada = baseTA * $( "#i-taxaadministrativa").val() / 100;

    }
  }

  totallocador = parseFloat(totallocador);
  totallocador = totallocador.toFixed(2);
  
  taxacalculada = taxacalculada.toFixed(2);

  $("#i-totaltaxaadm").val(  dolarToReal(taxacalculada ) );
  $("#i-totalfinalrepassar").val(  formatarBRSemSimbolo( parseFloat(totallocador)-parseFloat(taxacalculada)  ) );

  $("#i-total-apurado-locador").val( $("#i-totalfinalrepassar").val() );
  $("#i-total-dinheiro-locador").val( $("#i-totalfinalrepassar").val() );
  $('.valor').inputmask('decimal',
      {
        radixPoint:",",
        groupSeparator: ".",
        autoGroup: true,
        digits: 2,
        digitsOptional: false,
        placeholder: '0',
        rightAlign: true,
        onBeforeMask: function (value, opts)
        {
          return value;
        }
      });


      $(".multa").change( function() 
    {
      totalizar();

    });

    $(".juros").change( function() 
    {
      totalizar();

    });

    $("#i-dataderecebimentoavulso").change( function() 
    {
      $(".encargos").remove();
      recalcular();

    });

    


}

function receberLocatario()
{

/*  if( $("#i-totalareceber").val() == '0,00' )
  {
    alert('Nada a receber');
    return false;
  }
*/
  $("#i-div-dados-receber").show();
  


}


function repassarLocador()
{

  /*
  if( $("#i-totalarepassar").val() == '0,00' )
  {
    alert('Nada a repassar');
    return false;
  }
  */

  $("#i-div-dados-repassar").show();


}

function calcularTotalRecebendo()
{
  $("#i-total-dinheiro").blur( function()
    {
      //debugger;
      var nTotalApurado = realToDolar( $("#i-total-apurado").val() );
      var nTotalDinheiro = realToDolar( $("#i-total-dinheiro").val() );
      var nCheque =  parseFloat(nTotalApurado) - parseFloat(nTotalDinheiro);
//        console.log('cheque: '+nCheque );
      nTroco =  parseFloat(nTotalApurado) - 
                      ( parseFloat(nTotalDinheiro) +
                        parseFloat(nCheque) ) ;

      
    })

    $("#i-total-pix").blur( function()
    {
      var nTotalApurado = realToDolar( $("#i-total-apurado").val() );
      var nTotalDinheiro = realToDolar( $("#i-total-dinheiro").val() );
      var nCheque = realToDolar( $("#i-total-cheque").val() );
      var nPix = realToDolar( $("#i-total-pix").val() );


      var nTroco =  parseFloat(nTotalApurado) - 
                      ( parseFloat(nTotalDinheiro) +
                        parseFloat(nPix) +
                        parseFloat(nCheque) ) ;
      
      if( nTroco != 0 )
      {
        $("#div-troco-futuro").show();
        if( nTroco > 0 ) 
        {
          $("#div-abater").show();
        }
        else
        if( nTroco < 0 )
        {
          $("#div-abater").hide();
        }
      }
      $("#i-troco").val(  formatarBRSemSimbolo( nTroco) );

    })

    $("#i-total-cheque").blur( function()
    {
      var nTotalApurado = realToDolar( $("#i-total-apurado").val() );
      var nTotalDinheiro = realToDolar( $("#i-total-dinheiro").val() );
      var nCheque = realToDolar( $("#i-total-cheque").val() );
      var nTroco =  parseFloat(nTotalApurado) - 
                      ( parseFloat(nTotalDinheiro) +
                        parseFloat(nCheque) ) ;
      
      if( nTroco != 0 )
      {
        $("#div-troco-futuro").show();
        if( nTroco > 0 ) 
        {
          $("#div-abater").show();
        }
        else
        if( nTroco < 0 )
        {
          $("#div-abater").hide();
        }
      }
      $("#i-troco").val(  formatarBRSemSimbolo( nTroco) );

    })


}


function confirmarRecebimento()
{


  if( $("#FIN_CCX_ID").val() == "-1" )
  {
    alert('Informe a conta para efetivação de recebimento');
    return false;
  }



  var nTotDin = parseFloat(realToDolar($("#i-total-dinheiro").val()));
    if ( isNaN( nTotDin) )
       nTotDin = 0;

    var nTotChe = parseFloat(realToDolar($("#i-total-cheque").val()));
    if ( isNaN( nTotChe) )
      nTotChe = 0;

    var nTroco = parseFloat(realToDolar($("#i-troco").val()));
    if ( isNaN( nTroco))
      nTroco = 0;



    var nPix = realToDolar( $("#i-total-pix").val() );
    if ( isNaN( nPix) )
      nPix = 0;


      if( $("#i-debito-futuro").prop( "checked" ) ||  $("#i-credito-futuro").prop( "checked" ) )
        nTroco = nTroco
      else
        nTroco = 0;



      recibogerado = gerandoReciboLocatario(
      "i-tblselecionados",
      moment( $("#i-dataderecebimentoavulso").val()).format( 'YYYY-MM-DD'),
      $("#IMB_FORPAG-IDLOCATARIO").val(),
      $("#FIN_CCX_ID").val(),
      moment( $("#i-dataderecebimentoavulso").val()).format( 'YYYY-MM-DD'),
      $("#I-IMB_CTR_ID-LF").val(),
      nTotDin,
      nTotChe,
      nTroco,
      nTroco,
      "{{csrf_token()}}",
      parseFloat(realToDolar($("#i-total-apurado").val())),
      moment( $("#i-datadevencimentoavulso").val()).format( 'YYYY-MM-DD'),
      'L',
      'N',
      nPix
    );

    if( confirm( "Processo concluído. Deseja emitir o recibo?") )
    {  
      window.open( "{{route('recibolocatario.imprimir')}}/"+recibogerado+'/S', '_blank');
    
    }
    window.close();


}
function cargaFormaRecebimento()
  {

    $.getJSON( "{{ route('formapagamento.carga')}}", function( data )
    {
      $("#IMB_FORPAG-IDLOCATARIO").empty();

      linha =  '<option value="-1">Forma Pagamento</option>';
      $("#IMB_FORPAG-IDLOCATARIO").append( linha );
      for( nI=0;nI < data.length;nI++)
      {
        linha =
          '<option value="'+data[nI].IMB_FORPAG_ID+'">'+
                        data[nI].IMB_FORPAG_NOME+"</option>";
        $("#IMB_FORPAG-IDLOCATARIO").append( linha );
      }
    });

  }

  function cargaConta()
  {
    $.getJSON( "{{ route('contacaixa.carga')}}/N", function( data )
    {
      $("#FIN_CCX_ID").empty();
      $("#FIN_CCX_ID_LOCADOR").empty();
      linha =  '<option value="-1">Selecione</option>';
      $("#FIN_CCX_ID").append( linha );
      $("#FIN_CCX_ID_LOCADOR").append( linha );
      for( nI=0;nI < data.length;nI++)
      {
        linha =
        '<option value="'+data[nI].FIN_CCX_ID+'">'+
                          data[nI].FIN_CCX_DESCRICAO+"</option>";
        $("#FIN_CCX_ID").append( linha );
        $("#FIN_CCX_ID_LOCADOR").append( linha );
      }
    });

  }

function confirmarRepasse()
{


  if( $("#FIN_CCX_ID_LOCADOR").val() == "-1" )
  {
    alert('Informe a conta para efetivação de repassse');
    return false;
  }

    var nTotDin = parseFloat(realToDolar($("#i-total-dinheiro-locador").val()));
    if ( isNaN( nTotDin) )
       nTotDin = 0;


    var nTotChe = parseFloat(realToDolar($("#i-total-cheque-locador").val()));
    if ( isNaN( nTotChe) )
      nTotChe = 0;

    var nTroco = parseFloat(realToDolar($("#i-troco-locador").val()));
    if ( isNaN( nTroco))
      nTroco = 0;

      //debugger;
      var nvalortaxaadm = parseFloat(realToDolar( $("#i-totaltaxaadm").val() ));

    if( nvalortaxaadm > 0 )
    {
      nvalortaxaadm =formatarBRSemSimbolo(nvalortaxaadm);

      var linha =
            '<tr>'+
            '<td class="escondido"></td>'+
            '<td class="escondido">0</td>'+
            '<td class="reg-lcf-content  div-center">6</td>' +
            '<td class="reg-lcf-content  div-center">Taxa Admininstrativa</td>' +
            '<td class="reg-lcf-content  div-right">'+nvalortaxaadm  +'</td>'+
            '<td class="reg-lcf-content  div-center">N</td>' +
            '<td class="reg-lcf-content  div-center">D</td>' +
            '<td class="reg-lcf-content  div-center">'+moment( $("#i-datadevencimentoavulso").val()).format( 'YYYY-MM-DD')+'</td>' +
            '<td class="reg-lcf-content  div-center"></td>'+
            '<td class="reg-lcf-content  div-center"></td>'+
            '<td class="escondido"></td>'+
            '<td class="escondido">N</td>'+
            '<td class="escondido"></td>'+
            '<td class="escondido">0</td>'+
            '</td> '+ 
            '</tr>';
        $("#i-tblselecionados").append( linha );
        alert('Valor da taxa administrativa adicionada!');
            
    }
    gerandoReciboLocador(
      "i-tblselecionados",
      moment( $("#i-dataderecebimentoavulso").val()).format( 'YYYY-MM-DD'),
      $("#IMB_FORPAG-IDLOCADOR-repasse").val(),
      $("#FIN_CCX_ID_LOCADOR").val(),
      moment( $("#i-dataderecebimentoavulso").val()).format( 'YYYY-MM-DD'),
      $("#I-IMB_CTR_ID-LF").val(),
      nTotDin,
      nTotChe,
      nTroco,
      nTroco,
      "{{csrf_token()}}",
      parseFloat(realToDolar($("#i-total-apurado-locador").val())),
      moment( $("#i-datadevencimentoavulso").val() ).format( 'YYYY-MM-DD')
    );
    alert('Baixa Realizada!');
    window.close();







}

function calcularTotalRepasse()
{
  //debugger;
  var totalapurado = parseFloat( realToDolar( $("#i-total-apurado-locador").val() ));
  var totaldinheiro = parseFloat( realToDolar( $("#i-total-dinheiro-locador").val() ));
  var totalcheque =  parseFloat( realToDolar( $("#i-total-cheque-locador").val() ));
  //$("#i-total-cheque").val(0);
  var troco = 0;

  if( isNaN(totaldinheiro) )
     totaldinheiro = 0;
  if( isNaN(totalcheque) )
  totalcheque = 0;

  troco = ( totaldinheiro + totalcheque ) - totalapurado;


  $("#i-total-cheque-locador").val( totalcheque );
  $("#i-troco-locador").val(troco );

}

function cargaContaBoleto()
  {
    $.getJSON( "{{ route('contacaixa.carga')}}/S", function( data )
    {
      $("#FIN_CCX_ID_BOLETO").empty();
      linha =  '<option value="-1">Selecione</option>';
      $("#FIN_CCX_ID_BOLETO").append( linha );
      for( nI=0;nI < data.length;nI++)
      {
        linha =
        '<option value="'+data[nI].FIN_CCX_ID+'">'+
                          data[nI].FIN_CCX_DESCRICAO+"</option>";
        $("#FIN_CCX_ID_BOLETO").append( linha );
      }
    });

  }


  function cargaVencimentos()
  {

    var id = $("#I-IMB_CTR_ID-LF").val();
    url = "{{ route('lancamentovencimentos.select')}}/"+id;
    $.getJSON( url, function( data )
    {
      $("#i-select-vencimento-filtro").empty();
      linha =
        '<option value="null">Selecione pra filtrar</option>';
        $("#i-select-vencimento-filtro").append( linha );

      for( nI=0;nI < data.length;nI++)
      {
        var dataven = moment(data[nI].IMB_LCF_DATAVENCIMENTO).format('DD/MM/YYYY');
        var dataymd=moment(data[nI].IMB_LCF_DATAVENCIMENTO).format('YYYY-MM-DD');

        linha =
            '<option value="'+dataymd+'">'+dataven+'</option>';
        $("#i-select-vencimento-filtro").append( linha );

      }
    });
  }


  function inativarSelecionados()
  {
      if (confirm("Confirma a Inativaçao da Seleção?" ) )
      {
        var table = document.getElementById('i-tbllancamento-lf');
        var chks = document.getElementById("i-tbllancamento-lf").getElementsByTagName("input");
        var valores = document.getElementById("i-tbllancamento-lf").getElementsByTagName("valores");

        var regs = new Array();

        var inativados= 0;
        for (var i=0; i<chks.length; i++)
        {
          if (chks[i].type == "checkbox" &  chks[i].checked==true)
          {

            regs.push( table.rows[i+1].cells[1].innerHTML );
            inativados++;

            //console.log('uuuu '+url);
          }
        };
      }

      $.ajaxSetup(
      {
        headers:
        {
          'X-CSRF-TOKEN': "{{csrf_token()}}"
        }
      });

      var url = "{{ route('lancamento.desativarlote')}}/"+regs;
      console.log('destativando...');
      console.log( regs );

      $.ajax(
        {
          url:url,
          dataType:'json',
          type:'post',
          async:false,
          success:function(data )
          {
            alert('Inativados!!!');
          }
        });
      cargaLancamento(1);

  }


  function verificarSelecaoAcordo() {
    var chks = document.getElementById("i-tbllancamento-lf").getElementsByTagName("input");

    var regs = new Array();


    for (var i=0; i<chks.length; i++)
    {
      if (chks[i].type == "checkbox" &  chks[i].checked==true)
      {

        regs.push( chks[i].value );
      }
    };

    url = "{{ route('boleto.gerarlf')}}";

     //url = "{{ route('boleto.gerarlf')}}/"+chks[i].value;
     $.ajaxSetup(
     {
       headers:
       {
         'X-CSRF-TOKEN': "{{csrf_token()}}"
       }
     });

     atm = {
       lf : regs,
       IMB_ATD_ID : $("#I-IMB_ATD_ID").val()
     }

    //alert( url );
     $.ajax(
     {
       url: url,
       type: "post",
       async:false,
       datatype:"json",
       data: atm,
       success: function( data )
       {

        cargaItensTemp();

       },
       error: function( error )
       {
         console.log('deu erro');
       }
     });


    //alert( regs );


 }




 function separarItensAcordo()
{


    zerarBoletotmp();

  linha = "";
  $("#i-tbllancamentosacordo>tbody").empty();
  var totallocador=0;
  var totallocatario=0;
  var valor=0;
  var baseIRRF=0;
  var baseISS=0;
  var baseTA=0;
  quitado=0;
  inativado=0;
  $.each($("input[name='registroslf']:checked"), function ()
  {
    var data = $(this).parents('tr:eq(0)');
    var lcf = $(data).find('td:eq(1)').text();

    url = "{{route('lancamento.edit')}}/"+lcf;

    resumo = [];

    $.ajax(
    {
      url : url,
      dataType:'json',
      type:'get',
      async:false,
      success:function( data )
      {

        datapagamento   = data[0].IMB_LCF_DATAPAGAMENTO;
        datarecebimento = data[0].IMB_LCF_DATARECEBIMENTO;

        tr = '<tr class="row-top-margin">';
        if ( ( datapagamento != null && datarecebimento != null ) ||
               ( data[0].IMB_LCF_LOCADORCREDEB !='N'    && data[0].IMB_LCF_LOCATARIOCREDEB =='N' && datapagamento != null  ) ||
               ( data[0].IMB_LCF_LOCATARIOCREDEB !='N'  && data[0].IMB_LCF_LOCADORCREDEB =='N' && datarecebimento != null  ) )
               tr = '<tr class="linha-quitado">';

        if ( datarecebimento != null ) quitado = 1;
        if ( data[0].IMB_LCF_DTHINATIVADO != null ) inativado = 1;


        valorlancamentolocatario = parseFloat( data[0].IMB_LCF_VALOR);
        valorlancamentolocador = parseFloat( data[0].IMB_LCF_VALOR);

        if( data[0].IMB_LCF_DATARECEBIMENTO != null )
          valorlancamentolocatario = 0;
        if( data[0].IMB_LCF_DATAPAGAMENTO != null )
          valorlancamentolocador = 0;

        if ( data[0].IMB_LCF_DTHINATIVADO != null )
          valorlancamento = 0;

        if( data[0].IMB_LCF_LOCADORCREDEB == 'D' )
           valorlancamentolocador = valorlancamentolocador * -1;

        if( data[0].IMB_LCF_LOCATARIOCREDEB == 'C' )
          valorlancamentolocatario = valorlancamentolocatario * -1;


        if( data[0].IMB_LCF_LOCADORCREDEB != 'N' )
          totallocador = totallocador + valorlancamentolocador;

        if( data[0].IMB_LCF_LOCATARIOCREDEB != 'N' )
          totallocatario = totallocatario + valorlancamentolocatario;

          observacao = '';
          if( data[0].IMB_LCF_OBSERVACAO != null )  observacao = data[0].IMB_LCF_OBSERVACAO;
          
          valorlancamento = valorlancamento;

          debugger;

//          alert( data[0].IMB_TBE_ID);
  //        resumo[data[0].IMB_TBE_ID ] = 0 + resumo[data[0].IMB_TBE_ID ] + valorlancamento;

        linha =
            tr +
            '<td class="escondido"></td>'+
            '<td class="escondido">'+data[0].IMB_LCF_ID+'</td>'+
            '<td class="reg-lcf-content  div-center">'+data[0].IMB_TBE_NOME+'</td>' +
            '<td class="reg-lcf-content  div-right">'+data[0].IMB_LCF_VALOR+'</td>'+
            '<td class="reg-lcf-content  div-center">'+data[0].IMB_LCF_LOCATARIOCREDEB+'</td>' +
            '<td class="reg-lcf-content  div-center">'+moment( data[0].IMB_LCF_DATAVENCIMENTO).format('DD-MM-YYYY')+'</td>' +
            '<td class="reg-lcf-content  div-center">'+observacao+'</td>'+
            '<td class="escondido"></td>'+
            '<td class="escondido">N</td>'+
            '<td class="reg-lcf-content  div-center">'+data[0].IMB_TBE_ID+'</td>' +

            '</td> ';

        linha = linha + '</tr>';
        $("#tbllancamentosacordo").append( linha );
      }
    });
  });

  $("#i-acordo-valor").val( formatarBRSemSimbolo(totallocatario) );


  console.log('--------------------------------------------')
  console.log(resumo);
  
  //coloquei aqui para a confirmar receto no layout dadoreceber


  if( quitado == 1)
  {
      alert('Você selecionou um registro que já foi quitado. Selecione apenas registros em aberto!')
      return false;
  };

  if( inativado == 1)
  {
      alert('Você selecionou um registro que já foi inativado. Selecione apenas registros em aberto!')
      return false;
  };


   $("#i-acordo-contrato").val( $("#i-contratopesquisa").val() );
  acordo();




}


function tirardoacordo( id )
{
    var url = "{{ route('boleto.selec.excluir') }}/"+id;

    $.ajax(
        {
        url:url,
        datatype:'json',
        type:'get',
        success:function()
        {
            separarItensAcordo();
        }
    } );

}


function cargaFPRepasse()
{
    var url = "{{ route('formapagamento.carga')}}";
    $.ajax(
    {
      url:url,
      datatype:'json',
      async:false,
      success: function( data )
      {
        $("#IMB_FORPAG-IDLOCADOR-repasse").empty();
        linha =  '<option value="">Selecione</option>';
        for( nI=0;nI < data.length;nI++)
        {

            linha =
              '<option value="'+data[nI].IMB_FORPAG_ID+'">'+
                data[nI].IMB_FORPAG_NOME+"</option>";
            $("#IMB_FORPAG-IDLOCADOR-repasse").append( linha );

        }
      }
    });
  }

  function somenteFixos()
  {
    $("#i-aberto").val('F');
      cargaLancamento(1);    
  }

  function selecionarTodos()
  {

    if(  $("#i-aberto").val() =='N' )
    {
      alert('Primeiramente click em "Abertos Locatário" ');
      return false;

    }
    $(".columncheck").prop('checked',true);
  }

  function deselecionarTodos()
  {


    $(".columncheck").prop('checked',false);
  }

  function calcularMulta ( idlf, idcont )
  {
    var url = "{{route('calcularmultaumlancto') }}/"+idcont+'/'+idlf+'/'+$("#i-dataderecebimentoavulso").val();
    console.log( url );
  
    valor =0;
    $.ajax(
      {
        url:url,
        dataType:'json',
        type:'get',
        async:false,
        success:function( data )
        {
          valor = data.repassarvalor + data.retervalor;
        }
      }
    )
    return valor;
  }

  function calcularJuros( idlf, idcont )
{
  var url = "{{route('calcularjurosumlancto') }}/"+idcont+'/'+idlf+'/'+$("#i-dataderecebimentoavulso").val();
    console.log( url );
  
    valor =0;
    $.ajax(
      {
        url:url,
        dataType:'json',
        type:'get',
        async:false,
        success:function( data )
        {
          valor = data.repassarvalor + data.retervalor;
        }
      }
    )
    return valor;
}

function blink_textlf() 
    {
      //alert( $("#i-quantidade-fixos").val() );
        if( $("#i-quantidade-fixos").val() > 0 )
        {
            $("#i-label-temfixo").fadeOut(500);
            $("#i-label-temfixo").fadeIn(500);
        }
    }

function recalcular()
{
  var table = document.getElementById('i-tblselecionados');
  for (var r = 1, n = table.rows.length; r < n; r++)
  {        

    idlf = table.rows[r].cells[1].innerHTML ;

    valjuros = calcularJuros( idlf, $("#I-IMB_CTR_ID-LF").val() );
    valjuros = parseFloat( valjuros );
    valjuros = valjuros.toFixed(2);
    valjuros = dolarToReal( valjuros );
    $("#juros"+idlf).val( formatarBRSemSimbolo(valjuros) );

    valmulta = calcularMulta( idlf, $("#I-IMB_CTR_ID-LF").val() );
    valmulta = parseFloat( valmulta );
    valmulta = valmulta.toFixed(2);
    valmulta = dolarToReal( valmulta );
    $("#multa"+idlf).val( formatarBRSemSimbolo(valmulta) );

  }

  totalizar();

}

function totalizar()
{
  var table = document.getElementById('i-tblselecionados');
  var totalmulta = 0;
  var totaljuros = 0;
  var totalitem = 0;
  $(".encargos").remove();

  for (var r = 1, n = table.rows.length; r < n; r++)
  {  
    idlf = table.rows[r].cells[1].innerHTML ;
      
    multa = realToDolar( $("#multa"+idlf).val() );
    multa = parseFloat( multa );
    totalmulta = parseFloat( totalmulta ) + multa ;
      
    juros = realToDolar( $("#juros"+idlf).val() );
    juros = parseFloat( juros );
    totaljuros = parseFloat( totaljuros ) + juros ;

    item = realToDolar(  table.rows[r].cells[4].innerHTML );
    item = parseFloat( item );
    if( table.rows[r].cells[5].innerHTML =='D' )
      totalitem = parseFloat( totalitem ) + item ;
    if( table.rows[r].cells[5].innerHTML =='C' )
      totalitem = parseFloat( totalitem ) - item ;

  }

  total = totalmulta + totaljuros + totalitem ;

  total = parseFloat( total.toFixed(2) );
  total =  formatarBRSemSimbolo(total);
//

  $("#i-totalareceber").val( formatarBRSemSimbolo(total)) ;
  $("#i-total-apurado").val(formatarBRSemSimbolo(total)) ;
  $("#i-total-dinheiro").val(formatarBRSemSimbolo(total) );

  linhasEncargos( totalmulta, totaljuros)


}

function linhasEncargos( totalmulta, totaljuros)
{

  totalmulta = parseFloat( totalmulta.toFixed(2) );
  totalmulta =  formatarBRSemSimbolo(totalmulta);
//  totalmulta = realToDolar( totalmulta.toString() );

  totaljuros = parseFloat( totaljuros.toFixed(2) );
  totaljuros =  formatarBRSemSimbolo(totaljuros);
  //totaljuros = realToDolar( totaljuros );

  var cdld = 'C';
  if( $("#i-aluguelgarantido").val() == 'S')
    cdld='N';
  if( totalmulta != 0)
  {


    linha =
        '<tr class="encargos" >'+
            '<td class="escondido"></td>'+
            '<td class="escondido">0</td>'+
            '<td class="reg-lcf-content  div-center">2</td>' +
            '<td class="reg-lcf-content  div-center">Multa Por Atraso</td>' +
            '<td class="reg-lcf-content  div-right">'+totalmulta+'</td>'+
            '<td class="reg-lcf-content  div-center">D</td>' +
            '<td class="reg-lcf-content  div-center">'+cdld+'</td>' +
            '<td class="reg-lcf-content  div-center">'+moment( $("#i-datadevencimentoavulso").val()).format('DD-MM-YYYY')+'</td>' +
            '<td class="reg-lcf-content  div-center"></td>'+
            '<td class="reg-lcf-content  div-center">Multa por atraso</td>'+
            '<td class="escondido"></td>'+
            '<td class="escondido">N</td>'+
            '<td class="escondido"></td>'+
            '<td class="escondido">0</td>'+
            '<td class="font-red" ></td>'+
            '<td class="font-red" ></td>'+
          '</tr>';
        $("#i-tblselecionados").append( linha );
  }

    if( totaljuros != 0)
    {
    linha =
        '<tr class="encargos"  >'+
            '<td class="escondido"></td>'+
            '<td class="escondido">0</td>'+
            '<td class="reg-lcf-content  div-center">3</td>' +
            '<td class="reg-lcf-content  div-center">Juros Por Atraso</td>' +
            '<td class="reg-lcf-content  div-right">'+totaljuros+'</td>'+
            '<td class="reg-lcf-content  div-center">D</td>' +
            '<td class="reg-lcf-content  div-center">'+cdld+'</td>' +
            '<td class="reg-lcf-content  div-center">'+moment( $("#i-datadevencimentoavulso").val()).format('DD-MM-YYYY')+'</td>' +
            '<td class="reg-lcf-content  div-center"></td>'+
            '<td class="reg-lcf-content  div-center">Juros por atraso</td>'+
            '<td class="escondido"></td>'+
            '<td class="escondido">N</td>'+
            '<td class="escondido"></td>'+
            '<td class="escondido">0</td>'+
            '<td class="font-red" ></td>'+
            '<td class="font-red" ></td>'+
        '</tr>';
        $("#i-tblselecionados").append( linha );
    }

}

</script>




@endpush
