@extends('layout.app')

@push('script')

@section('scripttop')
<style>
.atrasado
{
    color:white;
    background-color:red;
    font-weight: bold;
    font-size:20px;

}

.bg-1
{
  background-color: #f0ede4;

} 

.H5 {
    text-align: center;
    color: #4682B4 ;
    font-size: 20px;
    font-weight: bold;

}
.H2 {
    text-align: center;
    color: #4682B4 ;
    font-size: 14px;
    font-weight: bold;

}
.span-class {
    text-align: center;
    color: red ;
    font-size: 10px;
    font-weight: bold;

}

.span-check-class {
    color       : blue ;
    font-size   : 12px;
    font-weight : bold;
    font-family: Verdana;
}

.span-multa-class {
    color       : blue ;
    font-size   : 10px;
    font-weight : bold;
    font-family: Verdana;
}


.div-center
{
  text-align:center;
  font-size: 12px;

}

.span-aba-title
{
  font-weight: bold;
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
      <a href="{{route('contrato.index')}}">Lista de Contratos</a>
      <i class="fa fa-circle"></i>
    </li>
    <li>
      <a href="#">Alteração de contrato de Locação</a>
    </li>
  </ul>

</div>
<div class="row">
  @php
    $ctr = app('App\Http\Controllers\ctrContrato')->findFull( $idcontratopesquisa);
    $imv = app('App\Http\Controllers\ctrImovel')->carga( $ctr->IMB_IMV_ID);
    $soctr = app('App\Http\Controllers\ctrContrato')->findSoContrato( $idcontratopesquisa);
    
  @endphp

  <div class="col-md-2">
      <label class="control-label">Pasta</label>
      <input cass="form-control" type="Text" id="IMB_CTR_REFERENCIA" value = "{{$ctr->IMB_CTR_REFERENCIA}}">
  </div>
  <div class="col-md-9 H5" id="i-endereco">
  </div>
</div>

<div class="row escondido" id="div-geral">
  <input type="hidden" id="i-idimovelcontrato">
  <input type="hidden" id="i-condominio">
  <input type="hidden" id="IMB_CLT_ID">
  <input type="hidden" id="IMB_CTR_ID" value = "{{$idcontratopesquisa}}">

  <div id="tabs">
    <ul>
      <li><a href="#tab-imovel" id="h-imovel"><span>Imóvel</span></a></li>
      <li><a href="#tab-locador" id="h-locador"><span>Locador</span></a></li>
      <li><a href="#tab-locatario" id="h-locatario"><span>Locatário</span></a></li>
      <li><a href="#tab-fiador" id="h-fiador"><span>Fiador</span></a></li>
      <li><a href="#tab-datas" id="h-datas"><span>Datas/Encargos</span></a></li>
      <li><a href="#tab-corretores" id="h-corretores"><span>Corretores/Captadores</span></a></li>
      <li><a href="#tab-taxas" id="h-multa"><span>Descontos/Taxas/Repasses</span></a></li>
      <li><a href="#tab-outras" id="h-outras"><span>Outras Informações/Jurídico</a></li>
      <li><a href="#tab-iptu" id="h-iptu"><span>IPTU/Seguro/Impostos</span></a></li>
    </ul>

    <div id="tab-imovel">
      <div class="row">
        <div class="col-md-2">
          <label class="label-form">Unidade da Locação</label>
          @php
            $imbs = app( 'App\Http\Controllers\ctrImobiliaria')->carga( 0 );
          @endphp
          <select class="form-control" id="IMB_IMB_ID2">
            @foreach( $imbs as $imb )
              <option value="{{$imb->IMB_IMB_ID}}" @if( $imb->IMB_IMB_ID == $ctr->IMB_IMB_ID2) selected @endif>{{$imb->IMB_IMB_NOME}}</option>
            @endforeach
          </select>
        </div>

          <div class="col-md-1">
            <label class="label-control">Código</label>
            <input class="form-control" type="text" id="IMB_IMV_ID" value="{{$ctr->IMB_IMV_ID}}" readonly>
          </div>
          <div class="col-md-1">
            <label class="label-control">Refer.</label>
            <input class="form-control" type="text" id="IMB_IMV_REFERE" value="{{$ctr->IMB_IMV_REFERE}}" readonly>
          </div>
          <div class="col-md-4">
            <label class="label-control">Endereço</label>
            <input class="form-control" type="text" id="IMB_IMV_ENDERECO" value="{{$ctr->IMB_IMV_ENDERECO}}" readonly>
          </div>
          <div class="col-md-2">
            <label class="label-control">Nº Apto.</label>
            <input class="form-control" type="text" id="IMB_IMV_ENDERECONUMERO"  value="{{$ctr->IMB_IMV_ENDERECONUMERO}}"  readonly>
          </div>
          <div class="col-md-2">
            <label class="label-control">Complemento</label>
            <input class="form-control" type="text" id="IMB_IMV_ENDERECOCOMPLEMENTO"  value="{{$ctr->IMB_IMV_ENDERECOCOMPLEMENTO}}"  readonly>
          </div>
      </div>
      <div class="row">
        <div class="col-md-2">
          <label class="label-control">Cep</label>
          <input class="form-control" type="text" id="IMB_IMV_ENDERECOCEP"  value="{{$ctr->IMB_IMV_ENDERECOCEP}}"  readonly>
        </div>
        <div class="col-md-3">
          <label class="label-control">Bairro</label>
          <input class="form-control" type="text" id="CEP_BAI_NOME" readonly  value="{{$ctr->CEP_BAI_NOME}}" >
        </div>
        <div class="col-md-3">
          <label class="label-control">Condomínio</label>
          <input class="form-control" type="text" id="IMB_CND_NOME" value="{{$ctr->IMB_CND_NOME}}" readonly>
        </div>
        <div class="col-md-3">
          <label class="label-control">Cidade</label>
          <input class="form-control" type="text" id="IMB_IMV_CIDADE"  value="{{$ctr->IMB_IMV_CIDADE}}"  readonly>
        </div>
        <div class="col-md-1">
          <label class="label-control">UF</label>
          <input class="form-control" type="text" id="IMB_IMV_ESTADO"  value="{{$ctr->IMB_IMV_ESTADO}}"readonly>
        </div>
      </div>
      <div class="row">
        <hr>
      </div>
      <div class="row">
        <div class="col-md-4">
          <label class="label-form">Tipo de Contrato</label>
          <select class="form-control" id="IMB_CTR_FINALIDADE" value="{{$ctr->IMB_CTR_FINALIDADE}}">
            <option value="-1">Selecione</option>
            <option value="Residencial"  @if( $ctr->IMB_CTR_FINALIDADE=='Residencial')selected }}@endif >Residencial</option>
              <option value="Comercial" @if( $ctr->IMB_CTR_FINALIDADE=='Comercial')selected }}@endif >Comercial</option>
          </select>
        </div>

        <div class="col-md-4">
          <label class="label-form">Forma de Fiança </label>
          <select class="form-control" id="IMB_CTR_EXIGENCIA" value="{{$ctr->IMB_CTR_EXIGENCIA}}">
            <option value="-1">Selecione </option>
            <option value="F" @if( $ctr->IMB_CTR_EXIGENCIA=='F')selected @endif>Fiador</option>
            <option value="C" @if( $ctr->IMB_CTR_EXIGENCIA=='C') selected @endif>Caução</option>
            <option value="S" @if( $ctr->IMB_CTR_EXIGENCIA=='S') selected @endif>Seguro Fiança</option>
            <option value="V" @if( $ctr->IMB_CTR_EXIGENCIA=='V') selected @endif>Cartão de Crédito</option>
            <option value="P" @if( $ctr->IMB_CTR_EXIGENCIA=='P') selected @endif>Titulo Capitalização</option>
            <option value="D" @if( $ctr->IMB_CTR_EXIGENCIA=='D') selected  @endif>Dispensado</option>
          </select>
        </div>

      </div>
      <div class="row">
        <hr>
      </div>
      <div class="row">
      <div class="col-md-4">
          <label class="label-control">Alugado com Pintura Nova
          <input type="checkbox" class="form-control" id="IMB_CTR_PINTURANOVA" @if( $ctr->IMB_CTR_PINTURANOVA=='S') Checked @endif>
          </label>
        </div>
        <div class="col-md-6">
          <label class="label-control">Liberado Multa Contratual (12 meses )
            <input type="checkbox" class="form-control" id="IMB_CTR_CLAUSULA12MESES" @if( $ctr->IMB_CTR_CLAUSULA12MESES=='S') Checked @endif>
          </label>
        </div>
        <div class="col-md-2 escondido">
          <label class="label-control">Com FCI
            <input type="checkbox" class="form-control" id="IMB_CTR_FCI" @if( $ctr->IMB_CTR_FCI=='S') Checked @endif >
          </label>
        </div>
        <div class="col-md-2 ">
          <label class="label-control">Código IBGE
            <input type="text" class="form-control" id="imb_imv_codigocidaderaiz" value="{{$imv->imb_imv_codigocidaderaiz}}">
          </label>
        </div>
      </div>

    </div>
    <div id="tab-locador">
      <div class="row">
        <div class="portlet box blue-hoki">
          <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Locador(es)
            </div>

            @php
              $ppis = app('App\Http\Controllers\ctrPropImo')->cargaSemJson( $ctr->IMB_IMV_ID);
            @endphp

            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
            </div>
          </div>

          <div class="portlet-body form">
            <div class="form-body">
              <table  id="tbpropimo" class="table table-striped table-bordered table-hover" >
                <thead class="thead-dark">
                  <tr>
                    <th width="5%"  style="text-align:center"> </th>
                    <th width="70%"  style="text-align:center"> Proprietario </th>
                    <th width="20%" style="text-align:center"> Percentual </th>
                    <th width="10%" style="text-align:center"> Principal </th>
                  </tr>
                </thead>
                <tbody>
                @foreach( $ppis as $ppi )
                  <tr>
                    <td style="text-align:center"> 
                      <a  class="btn btn-sm btn-primary" data-toggle="tooltip" title="Dados Bancário / Informações para Pagamento" href="javascript:dadosBancarios( {{$ppi->IMB_PPI_ID}})">Dados Bancários</a>
                    </td>
                    <td style="text-align:center"><a href="javascript:ClienteCargaEnvolvido( {{$ppi->IMB_CLT_ID}})">{{$ppi->IMB_CLT_NOME}}</a></td>
                    <td style="text-align:center">{{number_format($ppi->IMB_IMVCLT_PERCENTUAL4,4,',','.')}}%</td>
                    <td style="text-align:center">{{$ppi->principal}}</td>
                  </tr>
                @endforeach
              </table>
              <span class="H2">Permitido alteração do proprietário do imóvel somente na tela de alteração do imóvel</span>
            </div>
          </div>
        </div>
      </div>
      <div class="row" style="display:none" id="i-div-dadosbancarios">
        <div class="portlet box green">
          <div class="portlet-title">
            <div class="caption" id="i-nome-proprietario">
                <i class="fa fa-gift"></i>Dados para Repasse
            </div>

            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
            </div>
          </div>

          @include('layout.dadosbancarios')
        </div>
      </div>
    </div>
    <div id="tab-locatario">
      <div class="row">
        <div class="portlet box blue-hoki">
          <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Locatários
            </div>

            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
            </div>
          </div>

          @php
            $locatarios = app( 'App\Http\Controllers\ctrLocatarioContrato')->carga( $idcontratopesquisa );
          @endphp
          <div class="portlet-body form">
            <div class="form-body">
              <table  id="tbllocatarios" class="table table-striped table-bordered table-hover" >
                <thead class="thead-dark">
                  <tr >
                    <th width="5%" style="text-align:center"> ID </th>
                    <th width="50%" style="text-align:center"> Nome </th>
                    <th width="10%" style="text-align:center"> Principal </th>
                    <th width="1%" style="display: none" > REG </th>
                    <th width="10%" style="text-align:center"> Ações </th>
                  </tr>
                </thead>
                <tbody>
                @foreach( $locatarios as $locatario )
                  <tr id="{{$locatario->IMB_CLT_ID}}">
                    <td style="text-align:center">{{$locatario->IMB_CLT_ID}}</td>
                    <td style="text-align:center" ><a href="javascript:ClienteCargaEnvolvido( {{$locatario->IMB_CLT_ID}})" style="text-align:center">{{$locatario->IMB_CLT_NOME}}</td>
                    <td style="text-align:center">{{$locatario->IMB_LCTCTR_PRINCIPAL}}</td>
                    <td style="display: none">0</td>
                    <td style="text-align:center">
                      <a  class="btn btn-sm btn-danger" href="javascript:apagarLocatario( {{$locatario->IMB_LCTCTR_ID}})">Apagar</a>
                    </td>
                  </tr>
                @endforeach

                </tbody>
              </table>

              <div class="table-footer" >
                            <a  class="btn btn-sm btn-primary"
                            role="button" onClick="adicionarLocatarioContrato()" >
                            Adicionar Locatário </a>
                            <span class="span-check-class" >para alterar, apague o locatário e relacione-o novo com as informações corretas</span>
              </div>
              <div class="">
              </div>
              <div class="row">
                <hr>
              </div>
              <div class="row">
                <div class="col-md-4">
                  @php
                    $forrecs = app('App\Http\Controllers\ctrFormaPagamento')->carga();
                  @endphp
                  <label class="label-control">Forma de Recebimento</label>
                  <select select class="form-control" id="IMB_FORPAG_ID_LOCATARIO">
                    <option value="-1">Selecione a Forma</option>

                    @foreach( $forrecs as $forrec)
                    <option value="{{ $forrec->IMB_FORPAG_ID}}" 
                          @if($forrec->IMB_FORPAG_ID == $ctr->IMB_FORPAG_ID_LOCATARIO) selected @endif>{{ $forrec->IMB_FORPAG_NOME}} </option>
                    @endforeach

                  </select>

                </div>
                <div class="col-md-4">
                  <label class="label-control">Conta da Cobrança Bancária</label>
                  @php
                    $ccxcobs = app('App\Http\Controllers\ctrContaCaixa')->carga('n');
                  @endphp

                  <select class="form-control" id="FIN_CCR_ID_COBRANCA">
                    @foreach( $ccxcobs as $contacaixa)
                      <option value="{{$contacaixa->FIN_CCX_ID}}"
                      @if( $contacaixa->FIN_CCX_ID == $ctr->FIN_CCR_ID_COBRANCA) selected @endif>{{$contacaixa->FIN_CCX_DESCRICAO}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-4 div-center">
                  <label class="label-control">Cobrar Tarifa Boleto  
                    <input type="checkbox" class="form-control" id="IMB_CTR_COBRARBOLETO" 
                    @if( $ctr->IMB_CTR_COBRARBOLETO == 'S' ) checked @endif>

                  </label>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 div-center">
                  <label class="label-control">Boleto somente via email
                  <input type="checkbox" class="form-control" id="IMB_CTR_BOLETOVIAEMAIL"
                    @if( $ctr->IMB_CTR_BOLETOVIAEMAIL == 'S' ) checked @endif>
                  </label>
                </div>
                <div class="col-md-8">
                  <label class="label-control">Email</label>
                  <input type="email" class="form-control" id="IMB_CTR_EMAIL" value="{{ $ctr->IMB_CTR_EMAIL}}">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <div id="tab-fiador">
      <div class="row">
        <div class="portlet box blue-hoki">
          <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Fiador(es)
            </div>

            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
            </div>
          </div>

          <div class="portlet-body form">
            <div class="form-body">
              <table  id="tblfiadores" class="table table-striped table-bordered table-hover" >
                <thead class="thead-dark">
                  <tr >
                    <th width="5%" style="text-align:center"> ID </th>
                    <th width="50%" style="text-align:center"> Nome </th>
                    <th width="10%" style="text-align:center"> Ações </th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $fds = app('App\Http\Controllers\ctrFiadorContrato')->carga( $idcontratopesquisa);
                  @endphp
                  @foreach( $fds as $fd )
                    <tr id="{{$fd->IMB_CLT_ID}}">
                      <td style="text-align:center">{{$fd->IMB_FDC_ID}}</td>
                      <td style="text-align:center"><a href="javascript:ClienteCargaEnvolvido({{$fd->IMB_CLT_ID}})">{{$fd->IMB_CLT_NOME}}</a></td>
                      <td style="text-align:center">
                        <a  class="btn btn-sm btn-danger" href="javascript:apagarFiador({{$fd->IMB_FDC_ID}})">Apagar</a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>


              </table>

              <div class="table-footer" >
                            <a  class="btn btn-sm btn-primary"
                            role="button" onClick="adicionarFiadorContrato()" >
                            Adicionar Fiador </a>
                            <span class="span-check-class">para alterar, apague o fiador e relacione-o novo com as informações corretas</span>
              </div>
            </div><!-- end form-body-->
          </div>
        </div>
      </div>
    </div>
    
    <div id="tab-geral">
      <div class="row">
        <div id="tabs-nomes">
          <ul>
          </ul>
          
          

        </div>
      </div>
    </div>

    <div id="tab-datas">
      <div class="row">
        <div class="row">
          <div class="col-md-2">
            <div class="form-group">
              <label>Data Locação</label>
                <input type="date" id="IMB_CTR_DATALOCACAO" class="form-control"  
                  value = "{{$ctr->IMB_CTR_DATALOCACAO}}" >
            </div>
          </div>
          <div class="col-md-1">
            <div class="form-group">
              <label>Dia</label>
                <input type="text" id="IMB_CTR_DIAVENCIMENTO"
                  class="form-control"
                  onkeypress="return isNumber(event)" onpaste="return false;" value="{{$ctr->IMB_CTR_DIAVENCIMENTO}}">
                <span class="span-class">Vencto</span>
            </div>
          </div>

          <div class="col-md-1">
            <div class="form-group">
              <label>Duração</label>
              <input type="text" id="IMB_CTR_DURACAO"
                    class="form-control" value="{{$ctr->IMB_CTR_DURACAO}}"
                    onkeypress="return isNumber(event)" onpaste="return false;">
                    <span class="span-class">em Meses</span>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label>Início </label>
              <input type="date" id="IMB_CTR_INICIO"  value = "{{$ctr->IMB_CTR_INICIO}}"
                    class="form-control" >
                    <span class="span-class">Data de Início</span>

            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label>Término</label>
              <input type="date" id="IMB_CTR_TERMINO"  
                    class="form-control "  value = "{{$ctr->IMB_CTR_TERMINO}}" >
              <span class="span-class">Data de Término</span>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label>Prox. Recebimento</label>
              <input type="date" id="IMB_CTR_VENCIMENTOLOCATARIO"  
                    class="form-control "  value = "{{$ctr->IMB_CTR_VENCIMENTOLOCATARIO}}" >
              <span class="span-class">Data Base</span>
            </div>
          </div>
          



        </div>

        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Reajuste</label>
              <select class="form-control" id="IMB_CTR_FORMAREAJUSTE">
                <option value="1" @if( $ctr->IMB_CTR_FORMAREAJUSTE == '1') selecte @endif>Mensal</option>
                <option value="3" @if( $ctr->IMB_CTR_FORMAREAJUSTE == '3') selected @endif>Trimestral</option>
                <option value="6" @if( $ctr->IMB_CTR_FORMAREAJUSTE == '6') selected @endif>Semestral</option>
                <option value="12" @if( $ctr->IMB_CTR_FORMAREAJUSTE == '12') selected @endif>Anual</option>
              </select>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label>Prox.Reajuste</label>
              <input type="date" id="IMB_CTR_DATAREAJUSTE"
                    class="form-control" value="{{$ctr->IMB_CTR_DATAREAJUSTE}}">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Índice de Reajuste</label>
              @php
                $irjs = app('App\Http\Controllers\ctrIndiceReajuste')->carga( Auth::user()->IMB_IMB_ID );
              @endphp
              <select class="form-control" id="IMB_IRJ_ID">
                  @foreach( $irjs as $ir )
                    <option value="{{$ir->IMB_IRJ_ID}}"
                      @if( $ir->IMB_IRJ_ID == $ctr->IMB_IRJ_ID ) selected @endif>{{$ir->IMB_IRJ_NOME}}</option>
                  @endforeach
              </select>
              <span class="span-check-class">
              <input type="checkbox"
                  id="IMB_CTR_MAIORINDICE"
                  @if( $ctr->IMB_CTR_MAIORINDICE =='S' ) checked @endif>Utilizar o Maior Índice
                  </span>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="control-label">Valor Aluguel</label>
              <input type="text" id="IMB_CTR_VALORALUGUEL" value="{{ number_format( $ctr->IMB_CTR_VALORALUGUEL,2,',','.' )}}"
                    class="form-control valor">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="portlet box blue-hoki">
              <div class="portlet-title">
                <div class="caption">
                  <i class="fa fa-gift"></i>Dados para o Primeiro Pagamento
                </div>
                <div class="tools">
                  <a href="javascript:;" class="collapse"> </a>
                </div>
              </div>
              <div class="portlet-body">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Primeiro Vencto</label>
                      <input type="date" id="IMB_CTR_PRIMEIROVENCIMENTO" value="{{$ctr->IMB_CTR_PRIMEIROVENCIMENTO}}"
                        class="form-control">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>$ Acerto Dias</label>
                      <input type="text" id="IMB_CTR_DIASVALOR"
                        class="form-control valor" value='0'
                        value="{{ number_format( $ctr->IMB_CTR_DIASVALOR,2,',','.' )}}">
                      <span class="span-check-class" id="span-diferenca"></span>

                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Valor 1º Aluguel</label>
                      <input type="text" id="IMB_CTR_VALORPRIMVEN"
                      value="{{ number_format( $ctr->IMB_CTR_VALORPRIMVEN,2,',','.' )}}"
                        class="form-control valor" >
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>$ Condomínio</label>
                      <input type="text" id="IMB_CTR_VALORCOND"
                        class="form-control valor" 
                        value="{{ number_format( $ctr->IMB_CTR_VALORCOND,2,',','.' )}}"                        
                        >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="portlet box blue-hoki">
              <div class="portlet-title">
                <div class="caption">
                  <i class="fa fa-gift"></i>Metodologia para Multa/Juros e Período de Pagamento
                </div>
                <div class="tools">
                  <a href="javascript:;" class="collapse"> </a>
                </div>
              </div>
              <div class="portlet-body">
                <div class="row">
                  <div class="col-md-1">
                    <div class="form-group">
                      <label class="control-label span-multa-class">Tolerância</label>
                      <input type="text" id="IMB_CTR_TOLERANCIA"
                        class="form-control"
                        onkeypress="return isNumber(event)" onpaste="return false;"
                        value="{{$ctr->IMB_CTR_TOLERANCIA}}"
                        >
                        <span class="span-multa-class">Em dias</span>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label span-multa-class">Multa</label>
                      <input type="text" id="IMB_CTR_MULTA"
                        class="form-control valor"  placeholder='%' value='0'
                        value="{{ number_format( $ctr->IMB_CTR_MULTA,2,',','.' )}}"       
                        >
                        <span class="span-multa-class"></span>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label span-multa-class">% Juros</label>
                      <input type="text" id="IMB_CTR_JUROSDIARIO"
                        class="form-control valor" placeholder='%' 
                        value="{{ number_format( $ctr->IMB_CTR_JUROSDIARIO,3,',','.' )}}" >
                      <span class="span-multa-class">Diário</span>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label span-multa-class">% Correção</label>
                      <input type="text" id="IMB_CTR_PERMANDIARIA"
                        class="form-control valor"  placeholder='%' 
                        value="{{ number_format( $ctr->IMB_CTR_PERMANDIARIA,3,',','.' )}}" >

                        <span class="span-multa-class">Diário</span>
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label span-multa">Protestar</label>
                      <input type="text" id="IMB_CTR_DIASPROTESTO"
                        class="form-control"
                        onkeypress="return isNumber(event)" onpaste="return false;" 
                        value="{{$ctr->IMB_CTR_DIASPROTESTO}}" >

                        <span class="span-multa-class"> Após Dias</span>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="control-label span-multa-class">Método do Período</label>
                      <select   class="form-control" id="IMB_CTR_TOLERANCIAFATOR">
                        <option value="2" @if( $ctr->IMB_CTR_TOLERANCIAFATOR == '1' ) selected @endif>Normal</option>
                        <option value="3" @if( $ctr->IMB_CTR_TOLERANCIAFATOR == '3' ) selected @endif>Mês Fechado</option>
                        <option value="4" @if( $ctr->IMB_CTR_TOLERANCIAFATOR == '4' ) selected @endif>Antecipado</option>
                        <option value="5" @if( $ctr->IMB_CTR_TOLERANCIAFATOR == '5' ) selected @endif>Texto: "Aluguel do Mês</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="tab-taxas">
      <div class="row">
        <div class="row">
          <div class="col-md-12">
            <div class="class-md-6">
              <div class="portlet box blue-hoki">
                <div class="portlet-title">
                  <div class="caption">
                    <i class="fa fa-gift"></i>Descontos Para os Primeiros Meses / Pontualidade
                  </div>
                  <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                  </div>
                </div>
                <div class="portlet-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="col-md-6">
                        <label class="label-control">Primeiros Meses</label>
                        <input type="text" class="form-control" id="IMB_CTR_DESCONTOMESES"
                          onkeypress="return isNumber(event)" onpaste="return false;"
                          placeholder="Qtde de Meses" 
                          value="{{$ctr->IMB_CTR_DESCONTOMESES}}" >
                        <span>
                          <input type="text" class="form-control valor" id="IMB_CTR_DESCONTO"
                            placeholder="Valor do Desconto" 
                            value="{{ number_format( $ctr->IMB_CTR_DESCONTO,2,',','.' )}}" >
                        </span>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="row">
                            <span class="span-check-class">
                              <input type="checkbox"
                                id="IMB_CTR_PERDEBONAPOSVEN"
                                @if( $ctr->IMB_CTR_PERDEBONAPOSVEN =='S') checked @endif>
                                Perder desconto pontual. após vencto. sem a tolerância
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="row">
                        <div class="col-md-6">
                          <label class="label-control">R$ ou % Até o Vencimento</label>
                          <input type="text" class="form-control valor"
                          id="IMB_CTR_VALORBONIFICACAO4" placeholder="Pontual. R$ ou %" 
                          value="{{ number_format( $ctr->IMB_CTR_VALORBONIFICACAO4,2,',','.' )}}"                        
                          >
                          <span class="span-multa-class" >
                            <select class="form-control" id="IMB_CTR_BONIFICACAOTIPO">
                              <option value="P" @if( $ctr->IMB_CTR_BONIFICACAOTIPO =='P') selected @endif>Em Percentual</option>
                              <option value="V" @if( $ctr->IMB_CTR_BONIFICACAOTIPO =='V') selected @endif>Em Valor</option>
                            </select>
                          </span>
                        </div>

                        <div class="col-md-6">
                          <label class="label-control">Validade</label>
                          <input type="date" class="form-control" id="IMB_CTR_PONTUALIDADEVALIDADE" value="{{$ctr->IMB_CTR_PONTUALIDADEVALIDADE}}">
                          <span class="span-class">Em branco será sem data limite</span>
                        </div>
                      </div>
                      <div class="row">
                        <span class="span-check-class">
                          <input type="checkbox"
                            id="IMB_CTR_BONIF_NAOINC_TA"
                            @if( $ctr->IMB_CTR_BONIF_NAOINC_TA == "S" ) checked @endif>Não incluir desconto pontual.no cálculo da taxa admin.
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="row">
          <div class="col-md-12">
            <div class="class-md-6">
              <div class="portlet box blue-hoki">
                <div class="portlet-title">
                </div>
                <div class="portlet-body">
                  <div class="row">
                    <div class="col-md-1">
                      <label class="label-control">Taxa Adm.</label>
                      <input type="text" class="form-control valor"
                        id="IMB_CTR_TAXAADMINISTRATIVA"
                        placeholder="R$ ou %" 
                        value="{{ number_format( $ctr->IMB_CTR_TAXAADMINISTRATIVA,2,',','.' )}}" >
                      <span>
                        <select class="form-control" id="IMB_CTR_TAXAADMINISTRATIVAFORMA">
                        <option value="P" @if( $ctr->IMB_CTR_TAXAADMINISTRATIVAFORMA =='P') selected @endif>Em %</option>
                        <option value="V" @if( $ctr->IMB_CTR_TAXAADMINISTRATIVAFORMA =='V') selected @endif>Valor Fixo</option>
                        </select>
                      </span>
                    </div>
                    <div class="col-md-1">
                      <label class="label-control">Repassar</label>
                      <input type="text" class="form-control"
                        id="IMB_CTR_REPASSEDIA"   onkeypress="return isNumber(event)" onpaste="return false;" 
                        value='{{$ctr->IMB_CTR_REPASSEDIA}}'>
                      <span class="span-check-class">
                          Após dias
                      </span>
                    </div>
                    <div class="col-md-1 div-center">
                      <label class="label-control">Garantido
                        <input type="checkbox" class="form-control"
                          id="IMB_CTR_ALUGUELGARANTIDO" 
                          @if( $ctr->IMB_CTR_ALUGUELGARANTIDO =='S') checked @endif>
                      </label>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Prox. Repasse</label>
                        <input type="date" id="IMB_CTR_VENCIMENTOLOCADOR"  
                              class="form-control "  value = "{{$ctr->IMB_CTR_VENCIMENTOLOCADOR}}" >
                        <span class="span-class">Data Base</span>
                      </div>
                    </div>                    

                    <div class="col-md-4 bg-1">
                      <div class="col-md-12 div-center span-class"><b><u>Para repasses em dia fixo</u></b></div>
                      <div class="col-md-4">
                        <label class="control-label">Dia do Mês</label>
                        <input type="number" class="form-control" id="IMB_CTR_REPASSEDIAFIXO"
                        value="{{$ctr->IMB_CTR_REPASSEDIAFIXO}}">
                      </div>
                      <div class="col-md-8">Dia do Mês
                        <label class="control-label">Próximo Repasse</label>
                        <input type="date" class="form-control" id="IMB_CTR_PROXIMOREPASSE"
                        value="{{$ctr->IMB_CTR_PROXIMOREPASSE}}">


                      </div>
                      

                    </div>
                  </div> <!--row -->
                </div> <!--portlet body-->
              </div> <!-- portlet-->
              <div class="col-md-12">
                <div class="col-md-8">
                  <div class="portlet box blue-hoki">
                    <div class="portlet-title">
                      <div class="caption">
                        <i class="fa fa-gift"></i>Taxa de Contrato
                      </div>
                      <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                      </div>
                    </div>

                    <div class="portlet-body">
                        
                      <div class="row">
                          <div class="col-md-3">
                            <label class="label-control">Valor Tx Contrato
                              <input type="text" class="form-control valor"
                              id="IMB_CTR_CONTRATOVALOR" value="{{number_format( $ctr->IMB_CTR_CONTRATOVALOR,2,',','.' )}}">
                            </label>
                            <label class="label-control">Parcelas
                            <input type="text" class="form-control"
                                  id="IMB_CTR_CONTRATOPARCELAS"
                              onkeypress="return isNumber(event)" onpaste="return false;" 
                              value="{{$ctr->IMB_CTR_CONTRATOPARCELAS}}" >
                            </label>
                          </div>
                        <div class="col-md-2">
                          <label class="label-control">Vencimento 1ª Parcela</label>
                          <input type="date" class="form-control" id="IMB_CTR_CONTRATOVENPAR1"
                            value="{{$ctr->IMB_CTR_CONTRATOVENPAR1}}">
                          <span>
                            <input type="text" class="form-control valor" id="IMB_CTR_CONTRATOVALPAR1"
                            value="{{ number_format( $ctr->IMB_CTR_CONTRATOVALPAR1,2,',','.' )}}" >
                          </span>
                          <span class="span-check-class">
                            <input type="checkbox"
                              id="IMB_CTR_COBTAXAADM1" @if( $ctr->IMB_CTR_COBTAXAADM1 =='S' ) checked @endif>Cobrar Tx Adm. no Mês
                          </span>
                        </div>
                        <div class="col-md-2">
                          <label class="label-control">Vencimento 2ª Parcela</label>
                          <input type="date" class="form-control" id="IMB_CTR_CONTRATOVENPAR2"
                          value="{{$ctr->IMB_CTR_CONTRATOVENPAR2}}" >
                          <span>
                            <input type="text" class="form-control valor" id="IMB_CTR_CONTRATOVALPAR2"
                            placeholder="Valor em R$" 
                            value="{{ number_format( $ctr->IMB_CTR_CONTRATOVALPAR2,2,',','.' )}}" >
                          </span>
                          <span class="span-check-class">
                            <input type="checkbox"
                              id="IMB_CTR_COBTAXAADM2" @if( $ctr->IMB_CTR_COBTAXAADM2 =='S' ) checked @endif>
                              Cobrar Tx Adm. no Mês
                              
                          </span>
                        </div>
                        <div class="col-md-2">
                          <label class="label-control">Vencimento 3ª Parcela</label>
                          <input type="date" class="form-control" id="IMB_CTR_CONTRATOVENPAR3">
                          <span>
                            <input type="text" class="form-control valor" id="IMB_CTR_CONTRATOVALPAR3"
                            placeholder="Valor em R$" value='0'>
                          </span>
                          <span class="span-check-class">
                            <input type="checkbox"
                            id="IMB_CTR_COBTAXAADM3" @if( $ctr->IMB_CTR_COBTAXAADM3 =='S' ) checked @endif>Cobrar Tx Adm. no Mês
                          </span>
                        </div>
                        <div class="col-md-2">
                          <label class="label-control">Vencimento 4ª Parcela</label>
                          <input type="date" class="form-control" id="IMB_CTR_CONTRATOVENPAR4">
                          <span>
                            <input type="text" class="form-control valor" id="IMB_CTR_CONTRATOVALPAR4"
                              placeholder="Valor em R$" value='0'>
                          </span>
                          <span class="span-check-class">
                            <input type="checkbox"
                              id="IMB_CTR_COBTAXAADM4" @if( $ctr->IMB_CTR_COBTAXAADM4 =='S' ) checked @endif>Cobrar Tx Adm. no Mês
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  
                  <div class="portlet box green">
                    
                    <div class="portlet-title">
                      <div class="col-md-12 div-center">
                        <input type="checkbox" class="form-control" id="IMB_IMV_13COBRAR" 
                        @if( $ctr->IMB_IMV_13COBRAR =='S' ) checked @endif>><b> Cobrar 13ª Parcela</b>
                      </div>
                    </div>

                    <div class="portlet-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="col-md-4">
                            <h5 class="div-center"><u> 1ª Parcela</u></h5>
                            <label class="control-label">% Sobre Alug.</label>
                            <input class="form-control valor" type="text" id="IMB_IMV_13PERCENTUAL"
                            value="{{number_format( $ctr->IMB_IMV_13PERCENTUAL,2,',','.' )}}">
                            <label class="control-label">Cobrar no Mês</label>
                            <input class="form-control" type="number" id="IMB_IMV_13MES" max="12" min="1"
                            value="{{$ctr->IMB_IMV_13MES}}">
                          </div>
                          <div class="col-md-4">
                            <h5 class="div-center"><u> 2ª Parcela</u></h5>
                            <label class="control-label">% Sobre Alug.</label>
                            <input class="form-control valor" type="text" id="IMB_IMV_13_2PERCENTUAL"
                            value="{{number_format( $ctr->IMB_IMV_13_2PERCENTUAL,2,',','.' )}}">
                            <label class="control-label">Cobrar no Mês</label>
                            <input class="form-control" type="number" id="IMB_IMV_13_2MES"  max="12" min="1"
                            value="{{$ctr->IMB_IMV_13_2MES}}">
                          </div>
                          <div class="col-md-4">
                           <h5 class="div-center"><u> 3ª Parcela</u></h5>
                           <label class="control-label">% Sobre Alug.</label>
                           <input class="form-control valor" type="text" id="IMB_IMV_13_3PERCENTUAL"
                           value="{{number_format( $ctr->IMB_IMV_13_3PERCENTUAL,2,',','.' )}}">
                           
                           <label class="control-label">Cobrar no Mês</label>
                            <input class="form-control" type="number" id="IMB_IMV_13_3MES"  max="12" min="1"
                            value="{{$ctr->IMB_IMV_13_3MES}}">
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
    </div>
    <div id="tab-corretores">
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-6">
            <div class="portlet box blue-hoki">
              <div class="portlet-title">
                <div class="caption">
                  <i class="fa fa-gift"></i>Corretor
                </div>
                <div class="tools">
                  <a href="javascript:;" class="collapse"> </a>
                </div>
              </div>

              <div class="portlet-body form">
                <table  id="tbcorctr" class="table table-striped table-bordered table-hover" >
                  <thead class="thead-dark">
                    <tr>
                      <th style="text-align:center"> Corretor </th>
                      <th width="100" style="text-align:center"> Percentual </th>
                      <th width="200" style="text-align:center"> Ações </th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <div class="table-footer div-right" >
                <a  class="btn btn-sm btn-success"
                              role="button" onClick="adicionarCorCtr()" >
                              Adicionar Corretor </a>
                              <!--data-toggle="modal" data-target="#modalFormaPagamento"-->
              </div>

            </div>
          </div>            
          <div class="col-md-6">
            <div class="portlet box blue-hoki">
              <div class="portlet-title">
                <div class="caption">
                  <i class="fa fa-gift"></i>Captador
                </div>
                <div class="tools">
                  <a href="javascript:;" class="collapse"> </a>
                </div>
              </div>

              <div class="portlet-body form">
                <table  id="tbcapctr" class="table table-striped table-bordered table-hover" >
                  <thead class="thead-dark">
                    <tr>
                      <th style="text-align:center"> Captador </th>
                      <th width="100" style="text-align:center"> Percentual </th>
                      <th width="200" style="text-align:center"> Ações </th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <div class="table-footer div-right" >
                <a  class="btn btn-sm btn-success"
                              role="button" onClick="adicionarCapCtr()" >
                              Adicionar Captador </a>

              </div>

            </div>
          </div>
        </div>

      </div>    
    </div>
    <div id="tab-outras">
      <div class="row">
        <div class="col-md-12">
          <label class="label-control">Mensagem Locador(informes) até 200 caracteres</label>
          <input class="form-control" type="text" id="IMB_CTR_OBSERVACAOLOCADOR" maxlength="200" value="{{$ctr->IMB_CTR_OBSERVACAOLOCADOR}}">
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <label class="label-control">Mensagem Locatário até 200 caracteres</label>
          <input class="form-control" type="text" id="IMB_CTR_OBSERVACAOLOCATARIO" maxlength="200" value="{{$ctr->IMB_CTR_OBSERVACAOLOCATARIO}}">
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <label class="label-control">Mensagem Imóvel/contrato até 200 caracteres</label>
          <input class="form-control" type="text" id="IMB_CTR_OBSERVACAO" maxlength="200" value="{{$ctr->IMB_CTR_OBSERVACAO}}">
        </div>
      </div>

      <div class="row">
          <div class="col-md-2">
            <label class="label-control">Valor a Agregar</label>
            <input class="form-control valor" type="text" id="IMB_IMV_ALUGUELAGREGAR" value="{{$imv->IMB_IMV_ALUGUELAGREGAR}}">
          </div>
          <div class="col-md-2">
            <label class="label-control">Locador</label>
            <select class="form-control" id="IMB_IMV_AGREGADOLDCREDEB">
              <option value="N"  @if( $ctr->IMB_IMV_AGREGADOLDCREDEB =='N') selected @endif>Nada</option>
              <option value="C" @if( $ctr->IMB_IMV_AGREGADOLDCREDEB =='C') selected @endif>Crédito</option>
              <option value="D" @if( $ctr->IMB_IMV_AGREGADOLDCREDEB =='D') selected @endif>Débito</option>

            </select>
          </div>
          <div class="col-md-2">
            <label class="label-control">Locatário</label>
            <select class="form-control" id="IMB_IMV_AGREGADOLTCREDEB">
            <option value="N"  @if( $ctr->IMB_IMV_AGREGADOLTCREDEB =='N') selected @endif>Nada</option>
              <option value="C" @if( $ctr->IMB_IMV_AGREGADOLTCREDEB =='C') selected @endif>Crédito</option>
              <option value="D" @if( $ctr->IMB_IMV_AGREGADOLTCREDEB =='D') selected @endif>Débito</option>
            </select>
          </div>
          <div class="col-md-2">
            <label class="label-control">Incr. En. Elétrica</label>
            <input class="form-control" type="text" id="IMB_IMV_CPFLINSCRICAO"  value="{{$ctr->IMB_IMV_CPFLINSCRICAO}}">
          </div>
          <div class="col-md-2">
            <div class="col-12">
              <label class="label-control">Incr. Agua Esgoto</label>
              <input class="form-control" type="text" id="IMB_IMV_DAEINSCRICAO" value="{{$ctr->IMB_IMV_DAEINSCRICAO}}">
            </div>
            <div class="col-12">
              <label class="label-control">Senha</label>
              <input class="form-control" type="text" id="IMB_IMV_DAESENHA" value="{{$ctr->IMB_IMV_DAESENHA}}">
            </div>
          </div>
      </div>
      <hr>
      <div class="row">  
        <div class="col-md-12 div-center">
          <label class="label-control"><span class="atrasado">JURÍDICO</span>
            <input type="checkbox" class="form-control" id="IMB_CTR_ADVOGADO" @if( $ctr->IMB_CTR_ADVOGADO=='S') Checked @endif>
          </label>
        </div>
        <div class="col-md-12">
            <h3 class="div-center"><u> Anotações para o Jurídico</u></h3>
            <textarea cols="100%" rows="5" class="form-control" id="IMB_CTR_JURIDICOANOTACOES">{{$ctr->IMB_CTR_JURIDICOANOTACOES}}</textarea>
        </div>
      </div>
    </div>
    <div id="tab-iptu">
      <div class="row">
        <div class="row">
          <div class="col-md-12">
              <div class="portlet box blue-hoki">
                <div class="portlet-title">
                  <div class="caption">
                    <i class="fa fa-gift"></i>IPTU
                  </div>
                  <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                  </div>
                </div>
                <div class="portlet-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-3">
                        <label class="label-control">Valor do IPTU</label>
                        <input type="text" class="form-control valor" id="IMB_CTR_IPTUVALOR" value="{{number_format($ctr->IMB_CTR_IPTUVALOR,2,',','.')}}">
                        <span class="span-check-class">
                            <input type="checkbox"
                              id="IMB_CTR_IPTUINCLUSO">Já Incluso no Aluguel
                        </span>
                      </div>
                      <div class="col-md-2">
                        <label class="label-control">Qt.Parcelas</label>
                        <input type="number" class="form-control" id="IMB_CTR_IPTUQTDEPARCLAS"
                        min="0" max="99" value='0' value="{{$ctr->IMB_CTR_IPTUQTDEPARCLAS}}">
                      </div>

                      <div class="col-md-3">
                        <label class="label-control">Locador</label>
                        <select  class="form-control" id="IMB_CTR_IPTULOCADOR" >
                        <option value="N"  @if( $ctr->IMB_CTR_IPTULOCADOR =='N') selected @endif>Nada</option>
                        <option value="C" @if( $ctr->IMB_CTR_IPTULOCADOR =='C') selected @endif>Crédito</option>
                        <option value="D" @if( $ctr->IMB_CTR_IPTULOCADOR =='D') selected @endif>Débito</option>
                        </select>
                        <span class="span-check-class">
                          Crédito/Débito/Nada
                        </span>
                      </div>
                      <div class="col-md-3">
                        <label class="label-control">Locatário</label>
                        <select  class="form-control"  id="IMB_CTR_IPTULOCATARIO">
                        <option value="N"  @if( $ctr->IMB_CTR_IPTULOCATARIO =='N') selected @endif>Nada</option>
                        <option value="C" @if( $ctr->IMB_CTR_IPTULOCATARIO =='C') selected @endif>Crédito</option>
                        <option value="D" @if( $ctr->IMB_CTR_IPTULOCATARIO =='D') selected @endif>Débito</option>
                        </select>
                        <span class="span-check-class">
                          Crédito/Débito/Nada
                        </span>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                  <div class="col-md-3 div-center">
                    <div class="col-md-12">
                       <label class="control-label">I.P.T.U.</label>
                       <input class="form-control" type="text" id="IMB_IMV_IPTU1"  value="{{$imv->IMB_IMV_IPTU1}}">
                      </div>
                      <div class="col-md-12">
                       <label class="control-label">Referente</label>
                       <input class="form-control" type="text" id="IMB_IMV_IPTU1REFERENTE"  value="{{$imv->IMB_IMV_IPTU1REFERENTE}}">
                      </div>
                    </div>
                    <div class="col-md-3 div-center">
                      <div class="col-md-12">
                        <label class="control-label">I.P.T.U.</label>
                        <input class="form-control" type="text" id="IMB_IMV_IPTU2"  value="{{$imv->IMB_IMV_IPTU2}}">
                      </div>
                      <div class="col-md-12">
                       <label class="control-label">Referente</label>
                       <input class="form-control" type="text" id="IMB_IMV_IPTU2REFERENTE" value="{{$imv->IMB_IMV_IPTU2REFERENTE}}">
                      </div>
                    </div>
                    <div class="col-md-3 div-center">
                      <div class="col-md-12">
                        <label class="control-label">I.P.T.U.</label>
                        <input class="form-control" type="text" id="IMB_IMV_IPTU3"  value="{{$imv->IMB_IMV_IPTU3}}">
                      </div>
                      <div class="col-md-12">
                       <label class="control-label">Referente</label>
                       <input class="form-control" type="text" id="IMB_IMV_IPTU3REFERENTE"   value="{{$imv->IMB_IMV_IPTU3REFERENTE}}">
                      </div>
                    </div>
                    <div class="col-md-3 div-center">
                      <div class="col-md-12">
                        <label class="control-label">I.P.T.U.</label>
                        <input class="form-control" type="text" id="IMB_IMV_IPTU4" value="{{$imv->IMB_IMV_IPTU4}}">
                      </div>
                      <div class="col-md-12">
                       <label class="control-label">Referente</label>
                       <input class="form-control" type="text" id="IMB_IMV_IPTU4REFERENTE"  value="{{$imv->IMB_IMV_IPTU4REFERENTE}}">
                      </div>
                    </div>

                  </div>

                </div>
              </div>

          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
              <div class="portlet box red">
                <div class="portlet-title">
                  <div class="caption">
                    <i class="fa fa-gift"></i>Impostos
                  </div>
                  <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                  </div>
                </div>
                <div class="portlet-body">
                  <div class="row">
                    <div class="col-md-12">

                    <div class="col-md-2">
                        <label class="label-control">Informar na DIMOB
                          <input type="checkbox" class="form-control" id="IMB_IMV_RELIRRF" @if( $ctr->IMB_IMV_RELIRRF=='S') Checked @endif>
                        </label>
                      </div>

                      <div class="col-md-2">
                        <label class="label-control">Calc. IRRF Rectos/Repasses
                          <input type="checkbox" class="form-control" id="IMB_CTR_IRRF" @if( $ctr->IMB_CTR_IRRF=='S') Checked @endif>
                        </label>
                      </div>
                      <div class="col-md-2">
                        <label class="label-control">Não Emitir NFE
                          <input type="checkbox" class="form-control" id="imb_ctr_naoemitirnfe" @if( $ctr->imb_ctr_naoemitirnfe=='S') Checked @endif>
                        </label>
                      </div>
                      <div class="col-md-2">
                      <label class="label-control">Reter ISS Repasse
                          <input type="checkbox" class="form-control" id="IMB_CTR_CALISS" @if( $ctr->IMB_CTR_CALISS=='S') Checked @endif>
                        </label>
                      </div>
                      <div class="col-md-2">
                      <label class="label-control">Nunca Calcular IRRF
                         <input type="checkbox" class="form-control" id="IMB_CTR_NUNCARETEIRRF"  @if( $ctr->IMB_CTR_NUNCARETEIRRF=='S') Checked @endif>
                        </label>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
              <div class="portlet box blue-hoki">
                <div class="portlet-title">
                  <div class="caption">
                    <i class="fa fa-gift"></i>Alíquotas para Cálculo de Impostos
                  </div>
                  <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                  </div>
                </div>
                <div class="portlet-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-3">
                        <label class="label-control">% Alíquota IR </label>
                        <input type="text" class="form-control valor" id="IMB_CTR_IRPERC" value="{{$ctr->IMB_CTR_IRPERC}}">
                      </div>
                      <div class="col-md-3">
                        <label class="label-control">% Alíquota Cofins </label>
                        <input type="text" class="form-control valor" id="IMB_CTR_COFINS" value="{{$ctr->IMB_CTR_COFINS}}">
                      </div>
                      <div class="col-md-3">
                        <label class="label-control">% Alíquota Assistencial </label>
                        <input type="text" class="form-control valor" id="IMB_CTR_CONTSIND" value="{{$ctr->IMB_CTR_CONTSIND}}">
                      </div>
                      <div class="col-md-3">
                        <label class="label-control">% Alíquota Assistencial </label>
                        <input type="text" class="form-control valor" id="IMB_CTR_PIS" value="{{$ctr->IMB_CTR_PIS}}">
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



<a href="javascript:;" class="page-quick-sidebar-toggler">
  <i class="icon-login"></i>
</a>

<div class="page-quick-sidebar-wrapper" data-close-on-body-click="false">
</div>

<div class="modal fade" id="locatariosModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Locatário(s) do Contrato
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
                                <input type="text" id="i-str-locatario"
                                placeholder="digite aqui um pedaço do nome"
                                class="form-control">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <button class="btn btn-primary"
                                    onClick="buscaIncrementalLocatario()">Carregar Sugestões
                                </button>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="i-idlocatariocontrato" name="IMB_LCTCTR_ID">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label class="control-label">Selecione abaixo</label>
                                <select class="form-control" id="selclientelike-locatario">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Principal
                                    <input type="checkbox"
                                        class="form-control" data-checkbox="icheckbox_flat-blue"
                                        id="i-principal-locatario">

                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-success" href="{{route('cliente.add')}}">Cadastro de um Novo Cliente</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" onClick="gravarLocatarios()">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="fiadoresModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Fiador do Contrato
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
                                <input type="text" id="i-str-fiador"
                                placeholder="digite aqui um pedaço do nome"
                                class="form-control">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <button class="btn btn-primary"
                                    onClick="buscaIncrementalFiador()">Carregar Sugestões
                                </button>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="i-idfiadorcontrato" name="IMB_FDC_ID">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Selecione abaixo</label>
                                <select class="form-control" id="selclientelike-fiador">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <a class="btn btn-success" href="{{route('cliente.add')}}">Cadastro de um Novo Cliente</a>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                  <button type="button" class="btn btn-primary" onClick="gravarFiadores()">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modalresumo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Resumo do Contrato (lançamentos)
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
                </div>
                <div class="portlet-body form">
                  <table  id="tblparcelas" class="table table-bordered table-hover" >
                    <thead class="thead-dark">
                      <tr >

                        <th width="1%" style="display: none"> order </th>
                        <th width="5%" style="text-align:center"> ID </th>
                        <th width="20%" style="text-align:center"> Evento </th>
                        <th width="10%" style="text-align:center"> Locador </th>
                        <th width="10%" style="text-align:center"> Locatário </th>
                        <th width="10%" style="text-align:center"> Vencimento </th>
                        <th width="15%" style="text-align:center"> Valor </th>
                        <th width="30%" style="text-align:center"> Observaçao </th>
                        <th width="1%" style="display: none"> INC TX ADM </th>
                        <th width="1%" style="display: none"> controle </th>

                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" onClick="confirmarContrato()">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<form style="display: none" action="{{route('cliente.edit')}}" method="POST" id="form-cliente-env"  target="_blank">
@csrf
    <input type="hidden" id="id-cliente-env" name="id" />
    <input type="hidden" id="readonly" name="readonly" value="readonly"/>
</form>

<div class="modal fade" id="modalprocessando" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
              <h2>Processando Aguarde.....</h2>
            </div>
        </div>
    </div>
</div>

@include('layout.modalcapctr')
@include('layout.modalcorctr')


<nav class="quick-nav">
  <a class="quick-nav-trigger" href="#0">
      <span aria-hidden="true"></span>
  </a>
  <ul>
    <li>
          <a href="javascript:ConcluirContrato()">
              <span>Salvar Contrato</span>
              <i class="icon-check"></i>
          </a>
      </li>
      <li>
          <a href="javascript:window.close()">
              <span>Cancelar Ediçoes</span>
              <i class="icon-check"></i>
          </a>
      </li>
  </ul>
  <span aria-hidden="true" class="quick-nav-bg"></span>
</nav>
<div class="quick-nav-overlay"></div>
@endsection
@push('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>

 <script>

    $(document).ready(function()
    {
        $("#sirius-menu").click();



      $("#div-geral").show();
      setarSelects();
//      imovelCarga();
      CarregarCorCtr( $("#IMB_CTR_ID").val() );
      CarregarCapCtr( $("#IMB_CTR_ID").val() );
//      contratoCarga();
//      preencherUnidades();

    $("#IMB_CTR_VENCIMENTOLOCADOR").change( function()
      {
        alert('Atenção, se informe com seu supervisor quando você pode fazer este tipo de alteração no campo próximo repasse!');
        return false;

      })

      $("#IMB_CTR_VENCIMENTOLOCATARIO").change( function()
      {
        alert('Atenção, se informe com seu supervisor quando você pode fazer este tipo de alteração no campo próximo recebimento!');
        return false;

      })


      $("#h-caucao").click( function()
      {
        cargaBancos();
      })

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


      $( "#tabs" ).tabs( {
             active: 4
      });
      $( "#tabs-env" ).tabs();
      $( "#tabs-nomes" ).tabs();


    });


    function contratoCarga()
    {
      alert('carga');
      url = "{{ route( 'contrato.findfull')}}/"+$("#IMB_CTR_ID").val();
      $.ajax(
      {
        url : url,
        type: 'get',
        datatype: 'json',
        async:false,
        success: function( data )
        {

          var pasta = data.IMB_CTR_REFERENCIA;
          if( pasta === null ) pasta = data.IMB_IMV_ID;
          console.log( 'ref '+pasta);

//          $("#i-div-pasta").html( 'Contrato: '+pasta );

          $("#IMB_IMV_ID").val( data.IMB_IMV_ID );
//          $("#IMB_CTR_ID").val( data.IMB_CTR_ID );
          $("#IMB_CTR_INICIO").val( moment(data.IMB_CTR_INICIO).format('YYYY-MM-DD'));
          $("#IMB_CTR_TERMINO").val( moment(data.IMB_CTR_TERMINO).format('YYYY-MM-DD'));
          $("#IMB_CTR_VALORALUGUEL").val( dolarToReal(data.IMB_CTR_VALORALUGUEL));
          $("#IMB_CTR_TOLERANCIA").val( data.IMB_CTR_TOLERANCIA);
          $("#IMB_CTR_PRIMEIROVENCIMENTO").val( data.IMB_CTR_PRIMEIROVENCIMENTO);
          $("#IMB_CTR_DATALOCACAO").val( moment(data.IMB_CTR_DATALOCACAO).format('YYYY-MM-DD'));
          $("#IMB_CTR_DATAREAJUSTE").val( moment(data.IMB_CTR_DATAREAJUSTE).format('YYYY-MM-DD')) ;
          $("#IMB_CTR_MULTA").val( dolarToReal(data.IMB_CTR_MULTA));
          $("#IMB_CTR_DURACAO").val( data.IMB_CTR_DURACAO);
          $("#IMB_CTR_DIAVENCIMENTO").val( data.IMB_CTR_DIAVENCIMENTO);
          $("#IMB_CTR_DESCONTO").val( dolarToReal(data.IMB_CTR_DESCONTO));
          $("#IMB_CTR_DESCONTOMESES").val( data.IMB_CTR_DESCONTOMESES);
          $("#IMB_CTR_CONTRATOPARCELAS").val( data.IMB_CTR_CONTRATOPARCELAS);
          $("#IMB_CTR_OBSERVACAOLOCADOR").val( data.IMB_CTR_OBSERVACAOLOCADOR);
          $("#IMB_CTR_OBSERVACAOLOCATARIO").val( data.IMB_CTR_OBSERVACAOLOCATARIO);
          $("#IMB_CTR_OBSERVACAO").val( data.IMB_CTR_OBSERVACAO);
          $("#imb_imv_codigocidaderaiz").val( data.imb_imv_codigocidaderaiz);
          $("#IMB_CTR_JURIDICOANOTACOES").val( data.IMB_CTR_JURIDICOANOTACOES);
                              

          $("#IMB_CTR_CONTRATOVALOR").val( dolarToReal(data.IMB_CTR_CONTRATOVALOR));
          console.log( 'ven par 1 '+data.IMB_CTR_CONTRATOVENPAR1);
          $("#IMB_CTR_CONTRATOVENPAR1").val( data.IMB_CTR_CONTRATOVENPAR1);
          $("#IMB_CTR_CONTRATOVENPAR2").val( data.IMB_CTR_CONTRATOVENPAR2);
          $("#IMB_CTR_CONTRATOVENPAR3").val( data.IMB_CTR_CONTRATOVENPAR3);
          $("#IMB_CTR_CONTRATOVENPAR4").val( data.IMB_CTR_CONTRATOVENPAR4);
          $("#IMB_CTR_CONTRATOVALPAR1").val( dolarToReal(data.IMB_CTR_CONTRATOVALPAR1) );
          $("#IMB_CTR_CONTRATOVALPAR2").val( dolarToReal(data.IMB_CTR_CONTRATOVALPAR2) );
          $("#IMB_CTR_CONTRATOVALPAR3").val( dolarToReal(data.IMB_CTR_CONTRATOVALPAR3) );
          $("#IMB_CTR_CONTRATOVALPAR4").val( dolarToReal(data.IMB_CTR_CONTRATOVALPAR4) );
          $("#IMB_CTR_COBTAXAADM1").prop( "checked", false );
          $("#IMB_CTR_COBTAXAADM2").prop( "checked", false );
          $("#IMB_CTR_COBTAXAADM3").prop( "checked", false );
          $("#IMB_CTR_COBTAXAADM4").prop( "checked", false );
          $("#IMB_CTR_ADVOGADO").prop( "checked", false );


          if( data.IMB_CTR_COBTAXAADM1 == 'S' )
            $("#IMB_CTR_COBTAXAADM1").prop( "checked", true );
          if( data.IMB_CTR_COBTAXAADM2 == 'S' )
            $("#IMB_CTR_COBTAXAADM2").prop( "checked", true );
          if( data.IMB_CTR_COBTAXAADM3 == 'S' )
            $("#IMB_CTR_COBTAXAADM3").prop( "checked", true );
          if( data.IMB_CTR_COBTAXAADM4 == 'S' )
            $("#IMB_CTR_COBTAXAADM4").prop( "checked", true );
          if( data.IMB_CTR_ADVOGADO == 'S' )
            $("#IMB_CTR_ADVOGADO").prop( "checked", true );

          $("#IMB_IMV_DAESENHA").val( data.IMB_IMV_DAESENHA);
          $("#IMB_IMV_DAEINSCRICAO").val( data.IMB_IMV_DAEINSCRICAO);
          $("#IMB_IMV_CPFLINSCRICAO").val( data.IMB_IMV_CPFLINSCRICAO);

          console.log( data );
          $("#IMB_IMV_13PERCENTUAL").val( data.IMB_IMV_13PERCENTUAL);
          $("#IMB_IMV_13MES").val( data.IMB_IMV_13MES);
          $("#IMB_IMV_13_2PERCENTUAL").val( data.IMB_IMV_13_2PERCENTUAL);
          $("#IMB_IMV_13_2MES").val( data.IMB_IMV_13_2MES);
          $("#IMB_IMV_13_3PERCENTUAL").val( data.IMB_IMV_13_3PERCENTUAL);
          $("#IMB_IMV_13_3MES").val( data.IMB_IMV_13_3MES);
          $("#IMB_CTR_SITUACAO").val( data.IMB_CTR_SITUACAO);
          $("#IMB_CTR_FINALIDADE").val( data.IMB_CTR_FINALIDADE);
          $("#IMB_IRJ_ID").val( data.IMB_IRJ_ID);
          $("#IMB_CTR_FORMAREAJUSTE").val( data.IMB_CTR_FORMAREAJUSTE);
          $("#IMB_CTR_BONIFICACAOTIPO").val( data.IMB_CTR_BONIFICACAOTIPO);
          $("#IMB_IMV_ID").val( data.IMB_IMV_ID);
          $("#IMB_CTR_TAXAADMINISTRATIVA").val( dolarToReal(data.IMB_CTR_TAXAADMINISTRATIVA));
          $("#IMB_CTR_TAXAADMINISTRATIVAFORMA").val( data.IMB_CTR_TAXAADMINISTRATIVAFORMA);
          $("#IMB_CTR_REPASSEDIA").val( data.IMB_CTR_REPASSEDIA);
          $("#IMB_FORPAG_ID_LOCATARIO").val( data.IMB_FORPAG_ID_LOCATARIO);
          $("#IMB_CTR_EXIGENCIA").val( data.IMB_CTR_EXIGENCIA);
          $("#IMB_CTR_COBRARBOLETO").prop( "checked",false );
          if( data.IMB_CTR_COBRARBOLETO == 'S' )
            $("#IMB_CTR_COBRARBOLETO").prop( "checked",true );
          $("#IMB_CTR_ALUGUELGARANTIDO").prop( "checked",false );
          if( data.IMB_CTR_ALUGUELGARANTIDO == 'S' )
            $("#IMB_CTR_ALUGUELGARANTIDO").prop( "checked",true );
          $("#FIN_CCR_ID_COBRANCA").val( data.FIN_CCR_ID_COBRANCA);
          $("#IMB_CTR_COBRANCAVALOR").val( dolarToReal(data.IMB_CTR_COBRANCAVALOR));
          $("#IMB_CTR_EMAIL").val( dolarToReal(data.IMB_CTR_EMAIL));
          
          $("#IMB_CTR_IPTUINCLUSO").prop( "checked",false );
          if( data.IMB_CTR_IPTUINCLUSO == 'S' )
            $("#IMB_CTR_IPTUINCLUSO").prop( "checked",true );

          $("#IMB_ATD_ID").val( data.IMB_ATD_ID);
          $("#IMB_CTR_FINALIDADEDESCRICAO").val( data.IMB_CTR_FINALIDADEDESCRICAO);
          $("#IMB_CTR_REFERENCIA").val( pasta);
          $("#IMB_CTR_JUROSDIARIO").val( dolarToReal(data.IMB_CTR_JUROSDIARIO));
          $("#IMB_CTR_PERMANDIARIA").val( dolarToReal(data.IMB_CTR_PERMANDIARIA));

          $("#IMB_CTR_PINTURANOVA").prop( "checked",false );
          if( data.IMB_CTR_PINTURANOVA == 'S' )
            $("#IMB_CTR_PINTURANOVA").prop( "checked",true );

          $("#IMB_CTR_BOLETOVIAEMAIL").prop( "checked",false );
          if( data.IMB_CTR_BOLETOVIAEMAIL == 'S' )
            $("#IMB_CTR_BOLETOVIAEMAIL").prop( "checked",true );

            $("#IMB_CTR_MAIORINDICE").prop( "checked",false );
          if( data.IMB_CTR_MAIORINDICE == 'S' )
            $("#IMB_CTR_MAIORINDICE").prop( "checked",true );

          $("#IMB_CTR_CLAUSULA12MESES").prop( "checked",false );
          if( data.IMB_CTR_CLAUSULA12MESES == 'S' )
            $("#IMB_CTR_CLAUSULA12MESES").prop( "checked",true );

          $("#IMB_CTR_PONTUALIDADEVALIDADE").val( moment(data.IMB_CTR_PONTUALIDADEVALIDADE).format('DD/MM/YYYY'));
          $("#IMB_CTR_TOLERANCIAFATOR").val( data.IMB_CTR_TOLERANCIAFATOR);
          $("#IMB_CTR_VALORPRIMVEN").val( dolarToReal(data.IMB_CTR_VALORPRIMVEN));
          $("#IMB_CTR_VALORCOND").val( dolarToReal(data.IMB_CTR_VALORCOND));
          $("#IMB_CTR_SEGUROVALOR").val( dolarToReal(data.IMB_CTR_SEGUROVALOR));

          $("#IMB_CTR_BONIF_NAOINC_TA").prop( "checked",false );
          if( data.IMB_CTR_BONIF_NAOINC_TA == 'S' )
            $("#IMB_CTR_BONIF_NAOINC_TA").prop( "checked",true );

          $("#IMB_CTR_CORRETAGEMPERC").val( dolarToReal(data.IMB_CTR_CORRETAGEMPERC));
          $("#IMB_CTR_CAPTAPERC").val( dolarToReal(data.IMB_CTR_CAPTAPERC));
          $("#IMB_CTR_VALORBONIFICACAO4").val( dolarToReal(data.IMB_CTR_VALORBONIFICACAO4));

          $("#imb_ctr_seguroparcelas").val( data.imb_ctr_seguroparcelas);

          $("#IMB_CTR_FCI").prop( "checked",false );
          if( data.IMB_CTR_FCI == 'S' )
            $("#IMB_CTR_FCI").prop( "checked",true );


            $("#IMB_SGR_ID").val( data.IMB_SGR_ID);
            $("#IMB_IMB_ID2").val( data.IMB_IMB_ID2);
            $("#IMB_CTR_IPTUVALOR").val( dolarToReal(data.IMB_CTR_IPTUVALOR));
          $("#IMB_CTR_IPTULOCADOR").val( data.IMB_CTR_IPTULOCADOR);
          $("#IMB_CTR_IPTULOCATARIO").val( data.IMB_CTR_IPTULOCATARIO);
          $("#IMB_CTR_IPTUQTDEPARCLAS").val( data.IMB_CTR_IPTUQTDEPARCLAS);
          $("#IMB_CTR_DIASACERTO").val( dolarToReal(data.IMB_CTR_DIASACERTO));
          $("#IMB_CTR_DIASVALOR").val(  dolarToReal(data.IMB_CTR_DIASVALOR));
          $("#IMB_IMV_ALUGUELAGREGAR").val(  dolarToReal(data.IMB_IMV_ALUGUELAGREGAR));
          $("#IMB_IMV_AGREGADOLDCREDEB").val(  dolarToReal(data.IMB_IMV_AGREGADOLDCREDEB));
          $("#IMB_IMV_AGREGADOLTCREDEB").val(  dolarToReal(data.IMB_IMV_AGREGADOLTCREDEB));

          console.log( 'irrf: '+data.IMB_CTR_IRRF)

            $("#IMB_CTR_IRRF").prop( "checked",false );
          if( data.IMB_CTR_IRRF == 'S' )
            $("#IMB_CTR_IRRF").prop( "checked",true );

            $("#imb_ctr_naoemitirnfe").prop( "checked",false );
          if( data.imb_ctr_naoemitirnfe == 'S' )
            $("#imb_ctr_naoemitirnfe").prop( "checked",true );

            $("#IMB_CTR_CALISS").prop( "checked",false );
          if
          ( data.IMB_CTR_CALISS == 'S' )
            $("#IMB_CTR_CALISS").prop( "checked",true );



            $("#IMB_CTR_NUNCARETEIRRF").prop( "checked",false );
          if
          ( data.IMB_CTR_NUNCARETEIRRF == 'S' )
            $("#IMB_CTR_NUNCARETEIRRF").prop( "checked",true );

            $("#IMB_CTR_IRPERC").val( dolarToReal(data.IMB_CTR_IRPERC));
            $("#IMB_CTR_COFINS").val( dolarToReal(data.IMB_CTR_COFINS));
            $("#IMB_CTR_CONTSIND").val( dolarToReal(data.IMB_CTR_CONTSIND));
            $("#IMB_CTR_PIS").val( dolarToReal(data.IMB_CTR_PIS));

            $("#IMB_CTR_REPASSEDIAFIXO").val( data.IMB_CTR_REPASSEDIAFIXO);
            $("#IMB_CTR_PROXIMOREPASSE").val( data.IMB_CTR_PROXIMOREPASSE);
        }
      });

    }

    function imovelCarga()
    {
      url = "{{ route( 'imovel.carga')}}/"+$("#IMB_IMV_ID").val();
      $.ajax(
      {
        url : url,
        type: 'get',
        datatype: 'json',
        async:false,
        success: function( data )
        {
          console.log( data );
          if( data.IMB_IMV_NUMAPT != 0 )
          {
              var enderecoimovel =
                data.IMB_IMV_ENDERECOTIPO+' '+
                data.IMB_IMV_ENDERECO+' '+
                data.IMB_IMV_ENDERECONUMERO+' '+
                data.IMB_IMV_NUMAPT+' '+
                data.IMB_IMV_ENDERECOCOMPLEMENTO;
              enderecoimovel = enderecoimovel.replace( 'null','');
              enderecoimovel = enderecoimovel.replace( 'null','');
              enderecoimovel = enderecoimovel.replace( 'null','');
              enderecoimovel = enderecoimovel.replace( 'null','');

            $("#i-endereco").text( 'Imóvel: ('+
                            data.IMB_IMV_ID+
                            ') - '+enderecoimovel );

          }
          else
          {
            var enderecoimovel =
                data.IMB_IMV_ENDERECOTIPO+' '+
                data.IMB_IMV_ENDERECO+' '+
                data.IMB_IMV_ENDERECONUMERO+' '+
                data.IMB_IMV_ENDERECOCOMPLEMENTO;
                enderecoimovel = enderecoimovel.replace( 'null','');
                enderecoimovel = enderecoimovel.replace( 'null','');
                enderecoimovel = enderecoimovel.replace( 'null','');
                enderecoimovel = enderecoimovel.replace( 'null','');
                $("#i-endereco").text( 'Imóvel: ('+
                          data.IMB_IMV_ID+
                          ') - '+enderecoimovel );
        };

          $("#IMB_CLT_ID").val( data.IMB_CLT_ID );
          $("#IMB_IMV_REFERE").val( data.IMB_IMV_REFERE );
          
          tipoendereco = data.IMB_IMV_ENDERECOTIPO;
          if( tipoendereco === null ) 
            tipoendereco=''
          else
            tipoendereco= tipoendereco +' ';
          $("#IMB_IMV_ENDERECO").val( tipoendereco+data.IMB_IMV_ENDERECO );           
          $("#IMB_IMV_ENDERECONUMERO").val( data.IMB_IMV_ENDERECONUMERO );
            $("#IMB_IMV_ENDERECOCOMPLEMENTO").val( data.IMB_IMV_ENDERECONUMEROCOMPLEMENTO );
            $("#IMB_IMV_NUMAPT").val( data.IMB_IMV_NUMAPT );
            $("#IMB_IMV_ENDERECOCEP").val( data.IMB_IMV_ENDERECOCEP );
            $("#IMB_IMV_CIDADE").val( data.IMB_IMV_CIDADE );
            $("#CEP_BAI_NOME").val( data.CEP_BAI_NOME );
            $("#IMB_IMV_ESTADO").val( data.IMB_IMV_ESTADO );
          if( $("#i-condominio").val() != '' )
            $("#i-endereco").text( $("#i-endereco").text()
            +' - Condomínio: '+$("#i-condominio").val() );

            $("#IMB_IMV_RELIRRF").prop( "checked",false );
          if( data.IMB_IMV_RELIRRF == 'S' )
            $("#IMB_IMV_RELIRRF").prop( "checked",true );

            $("#IMB_IMV_IPTU1").val(data.IMB_IMV_IPTU1);
            $("#IMB_IMV_IPTU1REFERENTE").val(data.IMB_IMV_IPTU1REFERENTE);
            
            $("#IMB_IMV_IPTU2").val(data.IMB_IMV_IPTU2);
            $("#IMB_IMV_IPTU2REFERENTE").val(data.IMB_IMV_IPTU2REFERENTE);
            
            $("#IMB_IMV_IPTU3").val(data.IMB_IMV_IPTU3);
            $("#IMB_IMV_IPTU3REFERENTE").val(data.IMB_IMV_IPTU3REFERENTE);
            
            $("#IMB_IMV_IPTU4").val(data.IMB_IMV_IPTU4);
            $("#IMB_IMV_IPTU4REFERENTE").val(data.IMB_IMV_IPTU4REFERENTE);


        }

      });

      function buscarCondominio( id )
      {
        url = "{{ route( 'condominio.buscar' )}}/"+id;
        $.ajax(
          {
            url : url,
            type: 'get',
            datatype: 'json',
            async:false,
            success : function( data )
            {
              $("#i-condominio").val( data.IMB_CND_NOME );
            },

            error: function()
            {
              $("#i-condominio").val('');
            }

          }
        )
      }
    }

    function selecionarLocatario()
    {
        var clienteselecionado = $("#selclientelike-locatario").val();
            $("#IMB_CLT_ID").val( clienteselecionado);
            $("#locatariosModal").modal('hide');
            var nomelocatario = $('#selclientelike-locatario').find(":selected").text();
    }


    function adicionarLocatarioContrato()
    {

        $("#locatariosModal").modal('show');
        $("#i-idlocatariocontrato").val('');
//        $("#i-str").val( prop );
        $('#i-principal-locatario').prop('checked', 'true');

        buscaIncrementalLocatario();
    }


    function buscaIncrementalLocatario()
    {
        str = $("#i-str-locatario").val();
        var url = "{{ route('buscaclienteincremental') }}"+"/"+str;

        $.getJSON( url, function( data)
        {
        linha = "";
        $("#selclientelike-locatario").empty();
        for( nI=0;nI < data.length;nI++)
        {
            linha =
            '<option value="'+data[nI].IMB_CLT_ID+'">'+
            data[nI].IMB_CLT_NOME+"</option>";
            $("#selclientelike-locatario").append( linha );
        }
        });
    }

    function criarLocatarioContrato()
    {
        var cprincipal = '-';
        if( $('#i-principal-locatario').prop('checked') )
            cprincipal = 'Principal';

        var cliente = $("#selclientelike-locatario option:selected" ).val();
        linha =
                    '<tr id="'+cliente+'">'+
                    '   <td style="text-align:center">'+$("#selclientelike-locatario option:selected" ).val()+'</td>'+
                    '   <td style="text-align:center">'+$("#selclientelike-locatario option:selected" ).text()+'</td>'+
                    '   <td style="text-align:center">'+cprincipal+'</td>'+
                    '   <td style="display: none">0</td>'+
                    '   <td style="text-align:center"> '+
                    '<a  class="btn btn-sm btn-danger" href=javascript:apagarLocatario('+cliente+')>Apagar</a>'+
                    '   </td>'+
                    '</tr>';
        $("#tbllocatarios").append( linha );

    };



    function fiadorLocatario()
    {
        var clienteselecionado = $("#selclientelike-fiador").val();
            $("#fiadoresModal").modal('hide');
            var nomelocatario = $('#selclientelike-fiadores').find(":selected").text();
    }


    function adicionarFiadorContrato()
    {

        $("#fiadoresModal").modal('show');

        buscaIncrementalLocatario();
    }

    function buscaIncrementalFiador()
    {
        str = $("#i-str-fiador").val();
        var url = "{{ route('buscaclienteincremental') }}"+"/"+str;

        $.getJSON( url, function( data)
        {
        linha = "";
        $("#selclientelike-fiador").empty();
        for( nI=0;nI < data.length;nI++)
        {
            linha =
            '<option value="'+data[nI].IMB_CLT_ID+'">'+
            data[nI].IMB_CLT_NOME+"</option>";
            $("#selclientelike-fiador").append( linha );
        }
        });
    }


    function criarFiadorContrato()
    {
        var cliente = $("#selclientelike-fiador option:selected" ).val();
        linha =
                    '<tr id="'+cliente+'">'+
                    '   <td style="text-align:center">'+$("#selclientelike-fiador option:selected" ).val()+'</td>'+
                    '   <td style="text-align:center">'+$("#selclientelike-fiador option:selected" ).text()+'</td>'+
                    '   <td style="text-align:center"> '+
                    '<a  class="btn btn-sm btn-danger" href=javascript:removerLinha('+cliente+')>Apagar</a>'+
                    '   </td>'+
                    '</tr>';
        $("#tblfiadores").append( linha );

    };






    function removerLinha(id)
    {

      var textoid = '#'+id;

      $( textoid ).remove();

    }

    function cargaIndiceReajuste(id)
    {

      $.getJSON( "{{ route('indicereajuste.carga')}}/"+$("#I-IMB_IMB_IDMASTER").val(), function( data )
            {

              $("#IMB_IRJ_ID").empty();

                linha =  '<option value="-1">Índice de Reajuste</option>';
                $("#IMB_IRJ_ID").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                    '<option value="'+data[nI].IMB_IRJ_ID+'">'+
                        data[nI].IMB_IRJ_NOME+"</option>";
                        $("#IMB_IRJ_ID").append( linha );

                }
                $("#IMB_IRJ_ID").val( id );


            });

    }

    function ConcluirContrato()
    {


      var dFormatado = moment($("#IMB_CTR_PRIMEIROVENCIMENTO").val()).format("M-D-YYYY");


      dFormatado = new Date( dFormatado );

      var datainicial     = new Date( dFormatado.getFullYear(),
                                      dFormatado.getMonth(),
                                      $("#IMB_CTR_DIAVENCIMENTO").val() );

      var nMes = 0;
      var nAno = 0;

      var nDia = dFormatado.getDate();

      console.log('Primeiro vencto: '+dFormatado+'   -  Dia: '+nDia );


      if( $("#IMB_CTR_FINALIDADE").val() == '-1' )
      {
        alert( 'Informe o tipo de contrato RESIDENCIAL ou COMERCIAL!');
        return false;
      }

      if( $("#IMB_CTR_EXIGENCIA").val() == '-1' )
      {
        alert( 'Informe a forma de fiança!');
        return false;
      }


      if( $("#IMB_CTR_EXIGENCIA").val() == 'F' && document.getElementById('tblfiadores').rows.length == 1 )
      {
        alert( 'Você informou a forma de fiança como FIADOR, mas não informou ainda o(s) fiador(es)!');
        return false;

      }

      if(  document.getElementById('tbllocatarios').rows.length == 1 )
      {
        alert( 'Você ainda não informou o locatário!');
        return false;

      }

/*      if( $("#IMB_CTR_DIAVENCIMENTO").val() != nDia )
      {
        alert('Atenção! O dia de vencimento contratual, está diferente do dia informado no primeiro vencimento');
        return  false;
      }
*/
      if( $("#IMB_CTR_DATAREAJUSTE").val() =='' )
      {
        alert('Atenção! Confirma a forma de reajuste clicando sobre o campo FORMA DE REAJUSTE');
        return  false;
      }

      if( $("#IMB_CTR_TERMINO").val() =='' )
      {
        alert('Atenção! Informe a duração do contrato');
        return  false;
      }


      if( $("#IMB_CTR_DIAVENCIMENTO").val() =='' )
      {
        alert('Atenção! Informe o dia de vencimento');
        return  false;
      }


      if ( ! consistirLocatario() )
        return false;

      confirmarContrato()


    }



    function cargaLocatarioContrato( idcontrato )
    {
        var url = "{{ route('locatariocontrato.carga') }}"+"/"+idcontrato;
        $.getJSON( url, function( data)
        {
            linha = "";
            $("#tbllocatarios>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
              linha =
                    '<tr id="'+data[nI].IMB_CLT_ID+'">'+
                    '   <td style="text-align:center">'+data[nI].IMB_CLT_ID+'</td>'+
                    '   <td style="text-align:center"><a href="javascript:ClienteCargaEnvolvido('+data[nI].IMB_CLT_ID+')">'+data[nI].IMB_CLT_NOME+'</a></td>'+
                    '   <td style="text-align:center">'+data[nI].IMB_LCTCTR_PRINCIPAL+'</td>'+
                    '   <td style="display: none">'+data[nI].IMB_LCTCTR_ID+'</td>'+
                    '   <td style="text-align:center"> '+
                    '<a  class="btn btn-sm btn-danger" href=javascript:apagarLocatario('+data[nI].IMB_LCTCTR_ID+')>Apagar</a>'+
                    '   </td>'+
                    '</tr>';
              $("#tbllocatarios").append( linha );
            }
        });
    }

    function cargaFiadorContrato( idcontrato )
    {
        var url = "{{ route('fiadorcontrato.carga') }}"+"/"+idcontrato;
        $.getJSON( url, function( data)
        {
            linha = "";
            $("#tblfiadores>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
              linha =
                    '<tr id="'+data[nI].IMB_CLT_ID+'">'+
                    '   <td style="text-align:center">'+data[nI].IMB_FDC_ID+'</td>'+
                    '   <td style="text-align:center"><a href="javascript:ClienteCargaEnvolvido('+data[nI].IMB_CLT_ID+')">'+data[nI].IMB_CLT_NOME+'</a></td>'+
                    '   <td style="text-align:center"> '+
                    '<a  class="btn btn-sm btn-danger" href=javascript:apagarFiador('+data[nI].IMB_FDC_ID+')>Apagar</a>'+
                    '   </td>'+
                    '</tr>';
              $("#tblfiadores").append( linha );
            }
        });
    }

    function CarregarPropImo( imovel )
    {
        var url = "{{ route('propimo.carga') }}"+"/"+imovel;
        $.getJSON( url, function( data)
        {
            linha = "";
            $("#tbpropimo>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
                linha =
                    '<tr>'+
                    '   <td style="text-align:center"> '+
                    '     <a  class="btn btn-sm btn-primary" data-toggle="tooltip" title="Dados Bancário / Informações para Pagamento" href=javascript:dadosBancarios('+data[nI].IMB_PPI_ID+')>Dados Bancários</a>'+
                    '   </td>'+
                    '   <td style="text-align:center"><a href="javascript:ClienteCargaEnvolvido('+data[nI].IMB_CLT_ID+')">'+data[nI].IMB_CLT_NOME+'</a></td>'+
                    '   <td style="text-align:center">'+data[nI].IMB_IMVCLT_PERCENTUAL4+'%</td>'+
                    '   <td style="text-align:center">'+data[nI].principal+'</td>'+
                    '</tr>';

                $("#tbpropimo").append( linha );

            }
        });
    }
    function sortTable()
    {
      var table, rows, switching, i, x, y, shouldSwitch;
      table = document.getElementById("tblparcelas");
      switching = true;
      /*Make a loop that will continue until
      no switching has been done:*/
      while (switching) {
        //start by saying: no switching is done:
        switching = false;
        rows = table.rows;
        /*Loop through all table rows (except the
        first, which contains table headers):*/
        for (i = 1; i < (rows.length - 1); i++) {
          //start by saying there should be no switching:
          shouldSwitch = false;
          /*Get the two elements you want to compare,
          one from current row and one from the next:*/
          x = rows[i].getElementsByTagName("TD")[ 0];
          y = rows[i + 1].getElementsByTagName("TD")[0];
          //check if the two rows should switch place:
          if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            //if so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
          }
        }
        if (shouldSwitch) {
          /*If a switch has been marked, make the switch
          and mark that a switch has been done:*/
          rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
          switching = true;
        }
      }
    }

    function CarregarCorCtr( nId )
    {
        var url = "{{ route('corctr.carga') }}"+"/"+nId;
        debugger;
        $.getJSON( url, function( data)
        {
            linha = "";
            $("#tbcorctr>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
              var perc = parseFloat( data[nI].IMB_CORIMO_PERCENTUAL );
              var percbr = formatarBRSemSimbolo( perc );
                linha =
                    '<tr id="l-cor'+data[nI].IMB_ATD_ID+'">'+
                    '   <td>'+data[nI].IMB_ATD_NOME+'</td>'+
                    '   <td>'+percbr+'%</td>'+
                    '   <td style="text-align:center"> '+
                    '<a  class="btn btn-sm btn-primary" href=javascript:editarCorImo('+data[nI].IMB_CORCTR_ID+')>     Editar</a>'+
                    '<a  class="btn btn-sm btn-danger" href=javascript:apagarCorCtr('+data[nI].IMB_CORCTR_ID+')>     Apagar</a>'+
                    '   </td>'+
                    '</tr>';

                $("#tbcorctr").append( linha );

            }
        });
    }

    function CarregarCapCtr( nId )
    {
        var url = "{{ route('capctr.carga') }}"+"/"+nId;
        $.getJSON( url, function( data)
        {
            linha = "";
            $("#tbcapctr>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
              var perc = parseFloat( data[nI].IMB_CAPIMO_PERCENTUAL );
              var percbr = formatarBRSemSimbolo( perc );

                linha =
                    '<tr>'+
                    '   <td>'+data[nI].IMB_ATD_NOME+'</td>'+
                    '   <td>'+percbr+'%</td>'+
                    '   <td style="text-align:center"> '+
//                    '<a  class="btn btn-sm btn-primary" href=javascript:editarCorImo('+data[nI].IMB_CORIMO_ID+')>Editar</a>&nbsp;&nbsp;&nbsp;&nbsp;'+
//                    '           <button class="btn btn-sm btn-primary" onclick="editarCorImo('+data[nI].IMB_CORIMO_ID+' )">Editar</button>'+
//                    '           <button class="btn btn-sm btn-danger" onclick="apagarCorImo('+data[nI].IMB_CORIMO_ID+' )">Apagar</button>'+
                    '<a  class="btn btn-sm btn-primary" href=javascript:editarCapImo('+data[nI].IMB_CAPCTR_ID+')>     Editar</a>'+
                    '<a  class="btn btn-sm btn-danger" href=javascript:apagarCapCtr('+data[nI].IMB_CAPCTR_ID+')>     Apagar</a>'+
                    '   </td>'+
                    '</tr>';

                $("#tbcapctr").append( linha );

            }
        });
    }

    function confirmarContrato()
    {

      url="{{ route('contrato.sequencia') }}";

      /*
      debugger;
      var diavencimento = $("#IMB_CTR_DIAVENCIMENTO").val();
      var diarec = moment( $("#IMB_CTR_VENCIMENTOLOCATARIO").val()).format( 'DD');
      var diarep = moment( $("#IMB_CTR_VENCIMENTOLOCADOR").val()).format( 'DD');
      if( diavencimento != diarep || diavencimento != diarec)
      {
        if( diavencimento == 29 || diavencimento == 30  || diavencimento == 31 )
        {
          var ultimodiamesrec = ultimoDiaMes( 
          moment( $("#IMB_CTR_VENCIMENTOLOCATARIO").val()).format( 'MM'),
          moment( $("#IMB_CTR_VENCIMENTOLOCATARIO").val()).format( 'YYYY'));
      
          if( diarec < diavencimento && ultimodiamesrec < diavencimento )
          {
            alert('Atenção para a data do proximo recebimento!');
            return false;
          }
          
          var ultimodiamesrep = ultimoDiaMes( 
            moment( $("#IMB_CTR_VENCIMENTOLOCADOR").val()).format( 'MM'),
            moment( $("#IMB_CTR_VENCIMENTOLOCADOR").val()).format( 'YYYY'));
      
          if( diarep < diavencimento && ultimodiamesrep < diavencimento )
          {
            alert('Atenção para a data do proximo repasse!');
            return false;
          }
        }
        else
        {
          alert('Atenção para as datas base do próximo recebimento e próximo repasse. O dia de vencimento não está em acordo com os dias nestas datas informadas!');
          return false;
        }
      }
*/


      $.ajax(
      {
          url : url,
          dataType : 'json',
          async : false,
          type : 'get',
          success : function( data )
          {
            var sequencia = '';

            if( $("#IMB_CTR_ID").val() == '' )
              sequencia = data;
            else
              sequencia =  $("#IMB_CTR_REFERENCIA").val();

            var contrato =
            {
              IMB_CTR_ID: $("#IMB_CTR_ID").val(),
              IMB_CTR_INICIO : $("#IMB_CTR_INICIO").val(),
              IMB_IMB_ID : $("#I-IMB_IMB_IDMASTER").val(),
              IMB_CTR_TERMINO :  $("#IMB_CTR_TERMINO").val(),
              IMB_CTR_VALORALUGUEL : realToDolar($("#IMB_CTR_VALORALUGUEL").val()),
              IMB_CTR_TOLERANCIA : $("#IMB_CTR_TOLERANCIA").val(),
              IMB_CTR_PRIMEIROVENCIMENTO :$("#IMB_CTR_PRIMEIROVENCIMENTO").val(),
              IMB_CTR_DATALOCACAO : $("#IMB_CTR_DATALOCACAO").val(),
              IMB_CTR_DATAREAJUSTE : $("#IMB_CTR_DATAREAJUSTE").val(),
              IMB_CTR_MULTA : realToDolar( $("#IMB_CTR_MULTA").val() ),
              IMB_CTR_DURACAO : $("#IMB_CTR_DURACAO").val(),
              IMB_CTR_DIAVENCIMENTO : $("#IMB_CTR_DIAVENCIMENTO").val(),
              IMB_CTR_DESCONTO : realToDolar( $("#IMB_CTR_DESCONTO").val()),
              IMB_CTR_DESCONTOMESES : $("#IMB_CTR_DESCONTOMESES").val(),
              IMB_CTR_CONTRATOPARCELAS : $("#IMB_CTR_CONTRATOPARCELAS").val(),
              IMB_CTR_CONTRATOVALOR : realToDolar( $("#IMB_CTR_CONTRATOVALOR").val()),
              IMB_CTR_CONTRATOVENPAR1 :  $("#IMB_CTR_CONTRATOVENPAR1").val(),
              IMB_CTR_CONTRATOVENPAR2 :  $("#IMB_CTR_CONTRATOVENPAR2").val(),
              IMB_CTR_CONTRATOVENPAR3 :  $("#IMB_CTR_CONTRATOVENPAR3").val(),
              IMB_CTR_CONTRATOVENPAR4 :  $("#IMB_CTR_CONTRATOVENPAR4").val(),
              IMB_CTR_CONTRATOVALPAR1 : realToDolar($("#IMB_CTR_CONTRATOVALPAR1").val()),
              IMB_CTR_CONTRATOVALPAR2 : realToDolar($("#IMB_CTR_CONTRATOVALPAR2").val()),
              IMB_CTR_CONTRATOVALPAR3 : realToDolar($("#IMB_CTR_CONTRATOVALPAR3").val()),
              IMB_CTR_CONTRATOVALPAR4 : realToDolar($("#IMB_CTR_CONTRATOVALPAR4").val()),
              IMB_CTR_COBTAXAADM1 : $("#IMB_CTR_COBTAXAADM1").prop( "checked" )   ? 'S' : 'N',
              IMB_CTR_COBTAXAADM2 : $("#IMB_CTR_COBTAXAADM2").prop( "checked" )   ? 'S' : 'N',
              IMB_CTR_COBTAXAADM3 : $("#IMB_CTR_COBTAXAADM3").prop( "checked" )   ? 'S' : 'N',
              IMB_CTR_COBTAXAADM4 : $("#IMB_CTR_COBTAXAADM4").prop( "checked" )   ? 'S' : 'N',
              IMB_CTR_SITUACAO : 'ATIVO',
              IMB_CTR_FINALIDADE : $("#IMB_CTR_FINALIDADE").val(),
              IMB_CTR_EMAIL : $("#IMB_CTR_EMAIL").val(),
                            
              IMB_IRJ_ID : $("#IMB_IRJ_ID").val(),
              IMB_CTR_FORMAREAJUSTE : $("#IMB_CTR_FORMAREAJUSTE").val(),
              IMB_CTR_BONIFICACAOTIPO : $("#IMB_CTR_BONIFICACAOTIPO").val(),
              IMB_IMV_ID : $("#IMB_IMV_ID").val(),
              IMB_CTR_TAXAADMINISTRATIVA : realToDolar($("#IMB_CTR_TAXAADMINISTRATIVA").val()),
              IMB_CTR_TAXAADMINISTRATIVAFORMA : $("#IMB_CTR_TAXAADMINISTRATIVAFORMA").val(),
              IMB_CTR_VENCIMENTOLOCADOR :  $("#IMB_CTR_VENCIMENTOLOCADOR").val(),
              IMB_CTR_VENCIMENTOLOCATARIO : $("#IMB_CTR_VENCIMENTOLOCATARIO").val(),
              IMB_CTR_REPASSEDIA : $("#IMB_CTR_REPASSEDIA").val(),
              IMB_FORPAG_ID_LOCATARIO : $("#IMB_FORPAG_ID_LOCATARIO").val(),
              IMB_CTR_EXIGENCIA : $("#IMB_CTR_EXIGENCIA").val(),
              IMB_CTR_COBRARBOLETO : $("#IMB_CTR_COBRARBOLETO").prop( "checked" )   ? 'S' : 'N',
              IMB_CTR_ALUGUELGARANTIDO : $("#IMB_CTR_ALUGUELGARANTIDO").prop( "checked" )   ? 'S' : 'N',
              FIN_CCR_ID_COBRANCA : $("#FIN_CCR_ID_COBRANCA").val(),
              IMB_CTR_COBRANCAVALOR : realToDolar($("#IMB_CTR_COBRANCAVALOR").val()),
              IMB_CTR_IPTUINCLUSO : $("#IMB_CTR_IPTUINCLUSO").prop( "checked" )   ? 'S' : 'N',
              IMB_ATD_ID : $("#I-IMB_ATD_ID").val(),
              IMB_CTR_FINALIDADEDESCRICAO : $("#IMB_CTR_FINALIDADEDESCRICAO").val(),
              IMB_IMB_ID2 : $("#IMB_IMB_ID2").val(),
              IMB_CTR_REFERENCIA : sequencia,
              IMB_CTR_JUROSDIARIO : realToDolar($("#IMB_CTR_JUROSDIARIO").val()),
              IMB_CTR_PERMANDIARIA : realToDolar($("#IMB_CTR_PERMANDIARIA").val()),
              IMB_CTR_PINTURANOVA : $("#IMB_CTR_PINTURANOVA").prop( "checked" )   ? 'S' : 'N',
              IMB_CTR_BOLETOVIAEMAIL : $("#IMB_CTR_BOLETOVIAEMAIL").prop( "checked" )   ? 'S' : 'N',
              IMB_CTR_BOLETOVIAEMAIL : $("#IMB_CTR_BOLETOVIAEMAIL").prop( "checked" )   ? 'S' : 'N',
              IMB_CTR_BOLETOVIAEMAIL : $("#IMB_CTR_BOLETOVIAEMAIL").prop( "checked" )   ? 'S' : 'N',
              IMB_CTR_JURIDICOANOTACOES : $("#IMB_CTR_JURIDICOANOTACOES").val(),
                            
              IMB_CTR_PARCELALT : 1,
              IMB_CTR_PARCELALD : 1,
              IMB_CTR_MAIORINDICE : $("#IMB_CTR_MAIORINDICE").prop( "checked" )   ? 'S' : 'N',
              
              IMB_CTR_PONTUALIDADEVALIDADE : $("#IMB_CTR_PONTUALIDADEVALIDADE").val(),
              IMB_CTR_CLAUSULA12MESES : $("#IMB_CTR_CLAUSULA12MESES").prop( "checked" )   ? 'S' : 'N',
              IMB_CTR_TOLERANCIAFATOR : $("#IMB_CTR_TOLERANCIAFATOR").val(),
              IMB_CTR_VALORPRIMVEN : realToDolar($("#IMB_CTR_VALORPRIMVEN").val()),
              IMB_CTR_VALORCOND : realToDolar($("#IMB_CTR_VALORCOND").val()),
              IMB_CTR_SEGUROVALOR : realToDolar($("#IMB_CTR_SEGUROVALOR").val()),
              IMB_CTR_BONIF_NAOINC_TA : $("#IMB_CTR_BONIF_NAOINC_TA").prop( "checked" )   ? 'S' : 'N',
              IMB_CTR_CORRETAGEMPERC : realToDolar($("#IMB_CTR_CORRETAGEMPERC").val()),
              IMB_CTR_CAPTAPERC : realToDolar($("#IMB_CTR_CAPTAPERC").val()),
              imb_ctr_seguroparcelas : $("#imb_ctr_seguroparcelas").val(),
              IMB_CTR_VALORBONIFICACAO4 : realToDolar($("#IMB_CTR_VALORBONIFICACAO4").val()),
              IMB_CTR_FCI : $("#IMB_CTR_FCI").prop( "checked" )   ? 'S' : 'N',
              IMB_SGR_ID : $("#IMB_SGR_ID").val(),
              IMB_CTR_IPTUVALOR : realToDolar($("#IMB_CTR_IPTUVALOR").val()),
              IMB_CTR_IPTULOCADOR : $("#IMB_CTR_IPTULOCADOR").val(),
              IMB_CTR_IPTULOCATARIO : $("#IMB_CTR_IPTULOCATARIO").val(),
              IMB_CTR_IPTUQTDEPARCLAS : $("#IMB_CTR_IPTUQTDEPARCLAS").val(),
              IMB_CTR_DIASACERTO : $("#IMB_CTR_DIASACERTO").val(),
              IMB_CTR_DIASVALOR : realToDolar($("#IMB_CTR_DIASVALOR").val()),
              IMB_IMV_ALUGUELAGREGAR: realToDolar($("#IMB_IMV_ALUGUELAGREGAR").val()),
              IMB_IMV_AGREGADOLDCREDEB: $("#IMB_IMV_AGREGADOLDCREDEB").val(),
              IMB_IMV_AGREGADOLTCREDEB: $("#IMB_IMV_AGREGADOLTCREDEB").val(),
              IMB_CTR_OBSERVACAOLOCADOR: $("#IMB_CTR_OBSERVACAOLOCADOR").val(),
              IMB_CTR_OBSERVACAOLOCATARIO: $("#IMB_CTR_OBSERVACAOLOCATARIO").val(),
              IMB_CTR_OBSERVACAO: $("#IMB_CTR_OBSERVACAO").val(),
              imb_imv_codigocidaderaiz: $("#imb_imv_codigocidaderaiz").val(),

              IMB_CTR_ADVOGADO : $("#IMB_CTR_ADVOGADO").prop( "checked" )   ? 'S' : 'N',

              IMB_IMV_13PERCENTUAL: realToDolar($("#IMB_IMV_13PERCENTUAL").val()),
              IMB_IMV_13MES: $("#IMB_IMV_13MES").val(),

              IMB_IMV_13_2PERCENTUAL: realToDolar($("#IMB_IMV_13_2PERCENTUAL").val()),
              IMB_IMV_13_2MES: $("#IMB_IMV_13_2MES").val(),

              IMB_IMV_13_3PERCENTUAL: realToDolar($("#IMB_IMV_13_3PERCENTUAL").val()),
              IMB_IMV_13_3MES: $("#IMB_IMV_13_3MES").val(),


              IMB_IMV_DAESENHA: $("#IMB_IMV_DAESENHA").val(),
              IMB_IMV_DAEINSCRICAO: $("#IMB_IMV_DAEINSCRICAO").val(),
              IMB_IMV_CPFLINSCRICAO: $("#IMB_IMV_CPFLINSCRICAO").val(),

              
              
              IMB_IMV_13COBRAR : $("#IMB_IMV_13COBRAR").prop( "checked" )   ? 'S' : 'N',

              IMB_IMV_RELIRRF : $("#IMB_IMV_RELIRRF").prop( "checked" )   ? 'S' : 'N',
              IMB_CTR_IRRF : $("#IMB_CTR_IRRF").prop( "checked" )   ? 'S' : 'N',
              imb_ctr_naoemitirnfe : $("#imb_ctr_naoemitirnfe").prop( "checked" )   ? 'S' : 'N',
              IMB_CTR_CALISS : $("#IMB_CTR_CALISS").prop( "checked" )   ? 'S' : 'N',
              IMB_CTR_NUNCARETEIRRF : $("#IMB_CTR_NUNCARETEIRRF").prop( "checked" )   ? 'S' : 'N',

              IMB_CTR_IRPERC : realToDolar($("#IMB_CTR_IRPERC").val()),
              IMB_CTR_COFINS : realToDolar($("#IMB_CTR_COFINS").val()),
              IMB_CTR_CONTSIND : realToDolar($("#IMB_CTR_CONTSIND").val()),
              IMB_CTR_PIS : realToDolar($("#IMB_CTR_PIS").val()),

              IMB_IMV_IPTU1          :  $("#IMB_IMV_IPTU1").val(),
              IMB_IMV_IPTU1REFERENTE :  $("#IMB_IMV_IPTU1REFERENTE").val(),

              IMB_IMV_IPTU2          :  $("#IMB_IMV_IPTU2").val(),
              IMB_IMV_IPTU2REFERENTE :  $("#IMB_IMV_IPTU2REFERENTE").val(),

              IMB_IMV_IPTU3          :  $("#IMB_IMV_IPTU3").val(),
              IMB_IMV_IPTU3REFERENTE :  $("#IMB_IMV_IPTU3REFERENTE").val(),

              IMB_IMV_IPTU4          :  $("#IMB_IMV_IPTU4").val(),
              IMB_IMV_IPTU4REFERENTE :  $("#IMB_IMV_IPTU4REFERENTE").val(),

              IMB_CTR_REPASSEDIAFIXO :  $("#IMB_CTR_REPASSEDIAFIXO").val(),
              IMB_CTR_PROXIMOREPASSE :  $("#IMB_CTR_PROXIMOREPASSE").val(),
                            

          };

          $.ajaxSetup({
            headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
          });


          url = "{{route('contrato.gravarnovo')}}";


          $.ajax(
          {
            url : url,
            dataType:'json',
            data : contrato,
            type : 'post',
            async : false,
            success: function( data )
            {

              alert('Gravado!!!')
              window.close();
            },
            error : function()
            {
              alert('erro');
            }

          });
        }
      });


    }

    function gravarLocatarios()
    {
        $.ajaxSetup
        ({
          headers:
          {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
          }
        });

        var cprincipal = '-';
        if( $('#i-principal-locatario').prop('checked') )
            cprincipal = 'Principal';

        lf =
        {
          IMB_CTR_ID                : $("#IMB_CTR_ID").val(),
          IMB_CLT_ID                : $("#selclientelike-locatario option:selected" ).val(),
          IMB_LCTCTR_PRINCIPAL      : cprincipal,
          IMB_IMB_ID                : $("#I-IMB_IMB_IDMASTER").val(),
        };

        var url = "{{ route('locatariocontrato.store')}}";

        $.ajax(
        {
          url:url,
          type:'post',
          datatype:'json',
          async:false,
          data: lf,
          success:function()
          {
            cargaLocatarioContrato( $("#IMB_CTR_ID").val() );

          },
          error: function()
          {
            alert('Erro na gravação do Locatario no Contrato');
          }
        });



    }


    function gravarFiadores()
    {
      $.ajaxSetup
        ({
          headers:
          {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
          }
        });

        lf =
        {
          IMB_CTR_ID                : $("#IMB_CTR_ID").val(),
          IMB_CLT_ID                : $("#selclientelike-fiador option:selected" ).val(),
          IMB_IMB_ID                : $("#I-IMB_IMB_IDMASTER").val(),
        };

        var url = "{{ route('fiadorcontrato.store')}}";

        $.ajax(
        {
          url:url,
          type:'post',
          datatype:'json',
          async:false,
          data: lf,
          success:function()
          {
            cargaFiadorContrato( $("#IMB_CTR_ID").val() );

          },
          error: function()
          {
            alert('Erro na gravação do Locatario no Contrato');
          }
        });



    }


    function consistirLocatario()
    {
      var table = document.getElementById('tbllocatarios');

      var nCont = 0;
      for (var r = 1, n = table.rows.length; r < n; r++)
      {
        if( table.rows[r].cells[2].innerHTML == 'S')
           nCont++;

      }

      if( nCont == 0 )
        alert( 'Informe pelo menos um locatário como locatário principal!');

      if( nCont > 1 )
        alert( 'Informe somente um locatário como locatário principal!');

      if ( nCont == 1 )
        return true
      else
        return false;

    }


    function cargaFormaRecebimento( id )
    {

      $.getJSON( "{{ route('formapagamento.carga')}}", function( data )
            {

                $("#IMB_FORPAG_ID_LOCATARIO").empty();

                linha =  '<option value="-1">Forma Pagamento</option>';
                $("#IMB_FORPAG_ID_LOCATARIO").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                    '<option value="'+data[nI].IMB_FORPAG_ID+'">'+
                        data[nI].IMB_FORPAG_NOME+"</option>";
                        $("#IMB_FORPAG_ID_LOCATARIO").append( linha );

                };
                $("#IMB_FORPAG_ID_LOCATARIO").val( id );

            });

    }

    function cargaFormaRepasse( id )
    {
      var url = "{{ route('formapagamento.carga')}}";
      console.log( url );
      $.getJSON( url , function( data )
            {

                $("#IMB_FORPAG-IDLOCADOR").empty();

                linha =  '<option value="-1">Forma Repasse</option>';
                $("#IMB_FORPAG-IDLOCADOR").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                    '<option value="'+data[nI].IMB_FORPAG_ID+'">'+
                        data[nI].IMB_FORPAG_NOME+"</option>";
                        $("#IMB_FORPAG-IDLOCADOR").append( linha );

                };

                $("#IMB_FORPAG-IDLOCADOR").val( id );


            });

    }

    function cargaContaCobranca(id)
    {

      $.getJSON( "{{ route('contacaixa.carga')}}/S", function( data )
            {

                $("#FIN_CCR_ID_COBRANCA").empty();

                linha =  '<option value="-1">Selecione</option>';
                $("#FIN_CCR_ID_COBRANCA").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                    '<option value="'+data[nI].FIN_CCX_ID+'">'+
                        data[nI].FIN_CCX_DESCRICAO+"</option>";
                        $("#FIN_CCR_ID_COBRANCA").append( linha );

                }
                $("#FIN_CCR_ID_COBRANCA").val(id);


            });

    }


    function cargaBancosRepasse(id)
    {
      $.getJSON( "{{ route('bancos.distinct')}}", function( data )
            {

                $("#GER_BNC_NUMERO-REP").empty();

                linha =  '<option value="-1">Selecione</option>';
                $("#GER_BNC_NUMERO-REP").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                    '<option value="'+data[nI].GER_BNC_NUMERO+'">'+
                        data[nI].GER_BNC_NOME+"</option>";
                        $("#GER_BNC_NUMERO-REP").append( linha );

                }
                $("#GER_BNC_NUMERO-REP").val( id );

            });


    }

    function cargaBancos(id)
    {
      $.getJSON( "{{ route('bancos.distinct')}}", function( data )
            {

                $("#GER_BNC_NUMERO").empty();

                linha =  '<option value="-1">Selecione</option>';
                $("#GER_BNC_NUMERO").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                    '<option value="'+data[nI].GER_BNC_NUMERO+'">'+
                        data[nI].GER_BNC_NOME+"</option>";
                        $("#GER_BNC_NUMERO-REP").append( linha );

                }
                $("#GER_BNC_NUMERO").val( id );

            });


    }

    function apagarLocatario( id)
    {

      var r = confirm("Confirma a Exclusão?");
      if (r != true)
         return false;


      $.ajaxSetup
        ({
          headers:
          {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
          }
        });

        var url = "{{ route('locatariocontrato.destroy')}}/"+id;

        $.ajax(
        {
          url:url,
          type:'post',
          datatype:'json',
          async:false,
          success:function( )
          {
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Locatario Apagado!!!!',
            showConfirmButton: true,
            timer: 3500
            });

            cargaLocatarioContrato( $("#IMB_CTR_ID").val() );

          },
          error: function()
          {
            alert('Erro na exclusão do locatário');
          }
        });


    }

    function apagarFiador( id)
    {

      var r = confirm("Confirma a Exclusão do Fiador Deste Contrato?");
      if (r != true)
         return false;


      $.ajaxSetup
        ({
          headers:
          {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
          }
        });

        var url = "{{ route('fiadorcontrato.destroy')}}/"+id;

        $.ajax(
        {
          url:url,
          type:'post',
          datatype:'json',
          async:false,
          success:function( )
          {
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Fiador Apagado!!!!',
            showConfirmButton: true,
            timer: 3500
            });

            cargaFiadorContrato( $("#IMB_CTR_ID").val() );

          },
          error: function()
          {
            alert('Erro na exclusão do fiador');
          }
        });


    }

    function dadosBancarios( id )
    {
      url = "{{route('propimo.editar')}}/"+id;

      $.ajax(
        {
          url       : url,
          type      : 'get',
          dataType  : 'json',
          async     :' json',
          success   : function( data )
          {
            $("#i-nome-proprietario").html('Dados para Repasse a '+data.IMB_CLT_NOME);
            cargaFormaRepasse( data.IMB_FORPAG_ID);
            cargaBancosRepasse( data.GER_BNC_NUMERO);


            var banco = ( data.GER_BNC_NUMERO == '' ? '0' : data.GER_BNC_NUMERO )
            var taxa = ( data.IMB_IMVCLT_TAXAADMINISTRAT == '' ? '0' : data.IMB_IMVCLT_TAXAADMINISTRAT )
            $("#IMB_CLT_ID-REP").val(data.IMB_CLT_ID);
            $("#IMB_IMV_ID-REP").val(data.IMB_IMV_ID);
            $("#IMB_IMVCLT_PERCENTUAL4").val( dolarToReal(data.IMB_IMVCLT_PERCENTUAL4));
            $("#IMB_FORPAG-IDLOCADOR").val( data.IMB_FORPAG_ID);
            $("#IMB_IMV_CHEQUENOMINAL").val( data.IMB_IMV_CHEQUENOMINAL);
            $("#GER_BNC_NUMERO-REP").val( banco );
            $("#GER_BNC_AGENCIA").val( data.GER_BNC_AGENCIA);
            $("#IMB_BNC_AGENCIADV").val( data.IMB_BNC_AGENCIADV);
            $("#IMB_CLTCCR_NUMERO").val( data.IMB_CLTCCR_NUMERO);
            $("#IMB_CLTCCR_NOME").val( data.IMB_CLTCCR_NOME);
            $("#IMB_CLTCCR_DV").val( data.IMB_CLTCCR_DV);
            $("#IMB_CLTCCR_PESSOA").val( data.IMB_CLTCCR_PESSOA);
            $("#IMB_CLTCCR_CPF").val( data.IMB_CLTCCR_CPF);
            $("#IMB_IMVCLT_PIX").val( data.IMB_IMVCLT_PIX);
            if( data.IMB_IMVCLT_PRINCIPAL == 'S')
              $("#IMB_IMVCLT_PRINCIPAL").prop( "checked",true );
            if( data.IMB_CLTCCR_DOC == 'S')
              $("#IMB_CLTCCR_DOC").prop( "checked",true );
            if( data.IMB_CLTCCR_POUPANCA == 'S')
              $("#IMB_CLTCCR_POUPANCA").prop( "checked",true );
            $("#IMB_IMVCLT_TAXAADMINISTRAT").val( dolarToReal( taxa ) );
            $("#IMB_IMVCLT_TAXAADMINISTRATFORMA").val( data.IMB_IMVCLT_TAXAADMINISTRATFORMA);
            $("#IMB_PPI_ID").val( data.IMB_PPI_ID);
            $(".readonly-db").attr('readonly', true);
          }
        }
      )




      $("#i-div-dadosbancarios").show();


    }

    function habilitarDB()
    {
      $(".readonly-db").attr('readonly', false);

      $("#i-btn-hab-db").attr("disabled", true) ;
      $("#i-btn-gra-db").attr("disabled", false) ;
      $("#i-btn-can-db").attr("disabled", false);
    }

    function cancelarDadosBancarios()
    {
      $(".readonly-db").attr('readonly', true);
      $("#i-btn-hab-db").attr("disabled", false) ;
      $("#i-btn-gra-db").attr("disabled", true) ;
      $("#i-btn-can-db").attr("disabled", true);
    }

    function gravarDadosBancarios()
    {

      url = "{{route('propimo.salvar')}}";

      $.ajaxSetup
        ({
          headers:
          {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
          }
        });


        console.log('$("#GER_BNC_AGENCIA").val() '+$("#GER_BNC_AGENCIA").val() );
      var banco = $("#GER_BNC_NUMERO-REP").val();
      if( banco == null || banco == '') banco = 0;
      var agencia = $("#GER_BNC_AGENCIA").val();
      if( agencia == null || agencia == '' ) agencia = 0;
      var forma = $("#IMB_FORPAG-IDLOCADOR").val();
      if( forma == null || forma =='' ) forma = 0;
      var cpf = $("#IMB_CLTCCR_CPF").val();
      if( cpf == null || cpf == '' ) cpf = 0;
      var taxa = $("#IMB_IMVCLT_TAXAADMINISTRAT").val();
      if( taxa == null ||taxa == '' ) taxa = '0';
      console.log('agecia '+agencia);


      dados =
        {

          IMB_IMVCLT_PERCENTUAL4              : realToDolar($("#IMB_IMVCLT_PERCENTUAL4").val() ),
          IMB_CLT_ID                          : $("#IMB_CLT_ID-REP").val(),
          IMB_IMV_ID                          : $("#IMB_IMV_ID-REP").val(),
          IMB_FORPAG_ID                       : forma,
          IMB_IMV_CHEQUENOMINAL               : $("#IMB_IMV_CHEQUENOMINAL").val(),
          GER_BNC_NUMERO                      : banco,
          GER_BNC_AGENCIA                     : agencia,
          IMB_BNC_AGENCIADV                   : $("#IMB_BNC_AGENCIADV").val(),
          IMB_CLTCCR_NUMERO                   : $("#IMB_CLTCCR_NUMERO").val(),
          IMB_CLTCCR_NOME                     : $("#IMB_CLTCCR_NOME").val(),
          IMB_CLTCCR_DV                       : $("#IMB_CLTCCR_DV").val(),
          IMB_CLTCCR_PESSOA                   : $("#IMB_CLTCCR_PESSOA").val(),
          IMB_CLTCCR_CPF                      : cpf,
          IMB_IMVCLT_PIX                      : $("#IMB_IMVCLT_PIX").val(),
          IMB_IMVCLT_TAXAADMINISTRAT          : realToDolar( taxa ),
          IMB_IMVCLT_TAXAADMINISTRATFORMA     : $("#IMB_IMVCLT_TAXAADMINISTRATFORMA").val(),
          IMB_PPI_ID                          : $("#IMB_PPI_ID").val(),
          IMB_CLTCCR_DOC                      : $("#IMB_CLTCCR_DOC").prop( "checked" )   ? 'S' : 'N',
          IMB_CLTCCR_POUPANCA                 : $("#IMB_CLTCCR_POUPANCA").prop( "checked" )   ? 'S' : 'N',
          IMB_IMVCLT_PRINCIPAL                : $("#IMB_IMVCLT_PRINCIPAL").prop( "checked" )   ? 'S' : 'N',
        }

      $.ajax(
        {
          url             : url,
          type            : 'post',
          dataType        : 'json',
          async           : false,
          data            : dados,
          success         : function()
          {

            CarregarPropImo( $("#IMB_IMV_ID").val() );
            dadosBancarios( $("#IMB_PPI_ID").val() );

          },
          error: function()
          {
            alert('Erro ao gravar os dados bancários');
          }
        }
      )

      $(".readonly-db").attr('readonly', true);
      $("#i-btn-hab-db").attr("disabled", false) ;
      $("#i-btn-gra-db").attr("disabled", true) ;
      $("#i-btn-can-db").attr("disabled", true);
    }


  function cargaCaptadores()
  {


    var url = "{{ route('atendente.cargaativos')}}";

    $.getJSON( url, function( data )
    {
        linha = "";
        $("#i-select-captador-ctr").empty();
        for( nI=0;nI < data.length;nI++)
        {

            linha =
                    '<option value="'+data[nI].IMB_ATD_ID+'">'+
                    data[nI].IMB_ATD_NOME+"</option>";
                $("#i-select-captador-ctr").append( linha );
            }
    });
  }

    function adicionarCapCtr()
    {
      cargaCaptadores();
      $("#i-tela-origem").val('contratoedit');
      $("#i-idcontrato-cap").val( $("#IMB_CTR_ID").val() );
      $("#modalcapctr").modal('show');
    }

    
    function ClienteCargaEnvolvido( id )
  {
    $("#id-cliente-env").val( id );
    $("#form-cliente-env").submit();
  }
  function setarSelects()
  {
//    $("#IMB_CTR_FINALIDADE").val( $("#IMB_CTR_FINALIDADE").val() );    

  }

  function apagarCapCtr( id )
  {

    if( confirm( 'Confirma apagar este captador do contrato?') == true )
    {
      var url = "{{route('capctr.apagar')}}/"+id;
      console.log( 'rota: '+url );

      $.ajaxSetup({
            headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
          });


      $.ajax(
      {
        url : url,
        dataType:'json',
        type : 'post',
        async : false,
        success: function( data )
        {
          alert('Apagado!!');
          CarregarCapCtr( $("#IMB_CTR_ID").val() );
        },
        error : function()
        {
          alert('erro');
        }

      });
    }
  }


  function apagarCorCtr( id )
    {
        var url = "{{ route('corctr.apagar') }}"+"/"+id;

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
                    CarregarCorCtr( $("#IMB_CTR_ID").val() );
                },
                error: function( error )
                {
                    console.log(error);
                }
            });
        };

    }

  

</script>



@endpush
