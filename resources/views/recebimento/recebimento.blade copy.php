@extends('layout.app')
@push('script')


@section( 'scripttop')

<style>

.total-selecionado 
{
  background-color:#b3d9ff;
  color:#003366;
  font-weight: bold;
  text-align:center;
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
.linha-quitado {
  text-decoration: line-through;
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

.i-h5-datarecebimento {
  text-align: center;
  font-size: 20px;
  font-weight: bold;
  color: #4682B4; 
}


.div-1 {
  background-color: lightblue;
}
.div-2 {
  background-color: #CCFFE5;
}

td{text-align:center;}
</style>



@endsection

@section('content')


<!-- BEGIN CONTENT -->
<div class="row">
  <div class="col-md-12">
    <div class="tabbable-line boxless tabbable-reversed">
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <form  id="i-form-lancamento" onsubmit="return false;" >
            <input type="hidden" id="IMB_IMB_IDMASTER" name="empresamaster" 
                value="{{ Auth::User()->IMB_IMB_ID }}"> 
            <input type="hidden" id="I-IMB_CTR_ID">
            <input type="hidden" id="I-IMB_IMV_ID">
            <input type="hidden" id="i-codigocliente">
            <input type="hidden" id="i-aberto">
            <div class="form-body">

             @include( 'layout.localizarcontrato')

            <div class="portlet box blue i-div-informacoes">
              <div class="portlet-title">
                <div class="tools">
                  <button type="button" class="btn btn-primary btn-md " onClick="gerarBoleto()">Gerar Boleto 
                    <i class="fa fa-barcode"></i>
                  </button>
                  <button type="button" class="btn btn-primary btn-md " onClick="receberRepassar()">Receber/Repassar 
                    <i class="fa fa-money"></i>
                  </button>
                  <button type="button" class="btn btn-primary btn-md " onClick="reexibirTodos()">Reexibir Todos 
                    <i class="fa fa-money"></i>
                  </button>
                  <button type="button" class="btn btn-primary btn-md " onClick="filtrarAberto()">Todos em Aberto 
                    <i class="fa fa-money"></i>
                  </button>
                  <button type="button" class="btn green btn-md btn-outline" onClick="filtrar()"> 
                    <i class="fa fa-search"></i>
                  </button>
                  <button type="button" class="btn green btn-md btn-outline" onClick="novoLancamento()" id="i-btn-novo"> 
                    <i class="fa fa-plus"></i>
                  </button>
                </div>

              </div>
              
              <div class="portlet-body form">
                <table  id="i-tbllancamento" class="table table-striped table-bordered table-hover" >
                  <thead class="thead-dark">
                    <tr>
                      <th width="50" style="text-align:center"> </th>
                      <th width="150" style="text-align:center"> Ações </th>
                      <th width="20" style="text-align:center"> ID </th>
                      <th width="200" style="text-align:center"> Evento </th>
                      <th width="100" style="text-align:center"> Valor </th>
                      <th width="100" style="text-align:center"> Locatário </th>
                      <th width="100" style="text-align:center"> Vencimento </th>
                      <th width="500" style="text-align:center"> Descrição</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <div id="i-div-pagination">
              </div>
            </div>
          </form>
        </div> <!--class="tab-pane active" id="tab_1">-->
      </div><!--class="tab-content">-->
    </div><!--class="tabbable-line boxless tabbable-reversed">-->
  </div> <!--<div class="col-md-12">-->
</div> <!-- fim row unica -->


<div class="modal" tabindex="-1" role="dialog" id="modaldatapagamento">
  <div class="modal-dialog" role="document">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title i-h5-datarecebimento" id="i-h5-vencimento">Vencimento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row" id='i-datapagamento'>
          <div class="col-md-12">
            <div class="col-md-6">
              <div class="form-group">
                <label>Data do Pagamento</label>
                <input type="text" class="form-control dpicker" 
                placeholder="data pagto." id="i-data-pagamento">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
              <label>&nbsp;</label>
              <button type="button" class="btn btn-primary btn-md form-control" onClick="calcularRecebimento()">Calcular/Recalcular
                    <i class="fa fa-barcode"></i>
                  </button>
              </div>
            </div>
          </div>
        </div>
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
            <div class="col-md-12">
              <div class="form-group">
                  <label for="i-select-evento-filtro" class="control-label">Evento</label>
                  <select class="form-control" id="i-select-evento-filtro">
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




<div class="modal fade" id="modallancamento" tabindex="-1" role="dialog" 
    aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-body">
        
        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption">
              <i class="fa fa-gift"></i>Dados
            </div>
          </div>
      
          <div class="portlet-body form">
            <input type="hidden" id="I-IMB_LCF_ID">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="i-select-evento" class="control-label">Evento</label>
                  <select class="form-control" id="i-select-evento">
                  </select>
                </div>
              </div>  
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="input-group">
                <div class="icheck-inline">
                    <label>
                      <input type="checkbox" class="icheck" id="i-inc-multa"> Incide Multa 
                    </label>
                    <label>
                      <input type="checkbox" class="icheck" id="i-inc-juros"> Incide Juros/Corr.
                    </label>
                    <label>
                      <input type="checkbox" class="icheck" id="i-inc-irrf"> Incide IRRF 
                    </label>
                    <label>
                      <input type="checkbox" class="icheck" id="i-inc-taxa"> Incide Taxa Adm. 
                    </label>
                    <label>
                      <input type="checkbox" class="icheck" id="i-inc-iss"> Incide ISS
                    </label>
                    <label>
                      <input type="checkbox" class="icheck" id="i-garantia"> Garantir no Repasse
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">

              <div class="portlet light bordered">
                <div class="portlet-title">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-2">
                        <label class="control-label" >Qt. Meses</label>
                        <input type="number" class="form-control" id="i-meses" min="1" max="999">
                      </div>

                      <div class="col-md-3">
                          <label class="control-label">Iniciando em</label>
                          <input class="form-control" id="mask_date2" type="text" />
                      </div>
                      <div class="col-md-3">
                        <label class="control-label">Valor R$</label>
                          <input class="form-control" id="mask_currency" type="text" 
                          data-inputmask="
                          'radixPoint': ',',
                          'alias': 'numeric', 'groupSeparator': ',',
                           'autoGroup': true, 'digits': 2, 'digitsOptional': false, 
                           'prefix': 'R$ ', 'placeholder': '0'"/>
                      </div>
                      <div class="col-md-4">
                        <label class="control-label">Somente para:</label>
                        <select class="form-control"  id="i-select-locadorsomente">
                        </select>
                      </div>                        

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-3">
                        <label class="control-label">Incidência Locatário</label>
                        <select class="form-control" id="i-locatariocredeb">
                          <option value="N">Nada</option>
                          <option value="C">Crédito</option>
                          <option value="D">Débito</option>
                        </select>
                      </div>                        
                      <div class="col-md-3">
                        <label class="control-label">Incidência Locador</label>
                        <select class="form-control"  id="i-locadorcredeb">
                          <option value="N">Nada</option>
                          <option value="C">Crédito</option>
                          <option value="D">Débito</option>
                        </select>
                      </div>                        

                      <div class="col-md-6">
                        <label>
                          <input type="checkbox" class="icheck" id="i-autopreenchimento"> Auto-Preenchimento
                        </label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-10">
                        <label class="control-label">Informações sobre o lançamento</label>
                        <input class="form-control" id="i-descricao" type="text" maxlength="100" />
                      </div>
                    </div>
                    <div class="row">
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
                    </div>
                  </div>
                  <div class="row" id='i-parcelas'>
                    <div class="col-md-10">
                      <table  id="i-yyy" class="table table-bordered table-hover" >
                        <thead class="thead-dark">
                          <tr >
                            <th width="10%" style="text-align:center"> ID </th>
                            <th width="30%" style="text-align:center"> Evento </th>
                            <th width="10%" style="text-align:center"> Locador </th>
                            <th width="10%" style="text-align:center"> Locatário </th>
                            <th width="10%" style="text-align:center"> Vencimento </th>
                            <th width="20%" style="text-align:center"> Valor </th>
                            <th width="100" style="text-align:center"> Observaçao </th>
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
</div>



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
<script src="{{asset('/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/form-input-mask.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/global/plugins/jquery.input-ip-address-control-1.0.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/global/scripts/moment.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('/js/jquery-ui-timepicker-addon.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/i18n/jquery-ui-timepicker-addon-i18n.min.js')}}"></script>

<script>
$( document ).ready(function() 
  {
    $("#i-btn-novo").show();
    $(".i-div-informacoes").hide();
    $("#i-parcelas").hide();
    $("#i-div-confirmarparcelas").hide();
    $("#i-div-regerarparcelas").hide();
    $("#i-div-salvarparcelas").hide();
    $("#i-div-gerarparcelas").hide();
    $("#i-aberto").val('N');    
    if ( carregarOpcao( $("#I-IMB_ATD_ID").val(), 53, 2, "{{route('direito.checar')}}", true)  == false )
        $("#i-btn-novo").hide();

    //    cargaLancamento( 1 );

    $.datepicker.regional['br'] = {
        closeText: 'ok',
        prevText: 'Anterior',
        nextText: 'Próximo',
        currentText: 'corrent',
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho',
        'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun',
        'Jul','Ago','Set','Out','Nov','Dez'],
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
        dayNamesShort: ['D','S','T','Q','Q','S', 'S'],
        dayNamesMin:  ['D','S','T','Q','Q','S', 'S'],
        weekHeader: 'wh',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
	};

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



  });



//mantendo padrão para localizacao de contratos
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

      $("#modalbuscaltctr").modal('hide');
       
      var url = "{{ route('contrato.find') }}"+"/"+id;
      $.ajax(
      {
        url:url,
        datatype:'json',
        async:false,
        success: function( data )
        {
          vencimento = data[0].VENCIMENTOLOCATARIO;

          $("#I-IMB_IMV_ID").val( data[0].IMB_IMV_ID );
          $("#I-IMB_CTR_ID").val( id );
          $("#i-nome").val( data[0].IMB_CLT_NOME_LOCATARIO  );
          $("#I-LBL-IMB_IMV_ID").html( 'ID: '+data[0].IMB_IMV_ID  );
          $("#I-LBL-IMB_CTR_REFERENCIA").html( data[0].IMB_CTR_REFERENCIA  );
          $("#I-LBL-ENDERECOCOMPLETO").html( 'Endereço: '+data[0].ENDERECOCOMPLETO+' - '+  data[0].BAIRRO);
          $("#I-LBL-PROPRIETARIO").html( 'Locador: '+data[0].PROPRIETARIO+' - Prox. Repasse: '+moment( data[0].VENCIMENTOLOCADOR ).format( 'DD/MM/YYYY')) ;
          $("#I-LBL-LOCATARIO").html( 'Locatário: '+data[0].IMB_CLT_NOME_LOCATARIO+' - Prox. Recto.: '+moment( data[0].VENCIMENTOLOCATARIO ).format( 'DD/MM/YYYY'));
          $(".i-div-informacoes").show();
          $("#mask_date2").val( moment( vencimento).format('DD/MM/YYYY'));

          $("#i-h5-vencimento").html( 'Vencimento: '+ moment( vencimento).format('DD/MM/YYYY'));

          //montarPaginacao();
          $("#modaldatapagamento").modal('show');
          

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
          console.log('dia '+$("#i-dia").val() );
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
      });
    }


    function cargaLancamento( pagina )
    { 
      str = $("#I-IMB_CTR_ID").val();
    $("#modallancamento").modal('hide');
    empresamaster = $("#IMB_IMB_IDMASTER").val();
    evento = $("#i-select-evento-filtro").val();
    aberto = $("#i-aberto").val();
    
    
    console.log('pagina '+pagina);

    var url = "{{ route('lancamento.list') }}"+"/"+str+'/'+empresamaster+'/'+pagina+'/'+evento+'/'+aberto;
    console.log('url -------> '+url);
    moment.locale('pt-br');
    $.ajax(
    {
      url:url,
      datatype:'json',
      async:false,
      success: function( data )
      {
        linha = "";
        $("#i-tbllancamento>tbody").empty();
        for( nI=0;nI < data.data.length;nI++)
        {
          

          var datavencimento  = moment( data.data[nI].IMB_LCF_DATAVENCIMENTO).format('DD-MM-YYYY');
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


          linha = 
            tr +
            '<td><center><input type="checkbox" name="free" value="'+data.data[nI].IMB_LCF_ID+'"></center></td>'+
            '<td style="text-align:center" valign="center"> '+
              '<a href=javascript:selecionarLancamento('+data.data[nI].IMB_LCF_ID+') class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"></span></a> '+
              '<a href=javascript:apagarLancamento('+data.data[nI].IMB_LCF_ID+') class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a> '+
            '</td> '+
            '<td style="text-align:center valign="center">'+data.data[nI].IMB_TBE_ID+'</td>' +
            '<td style="text-align:center valign="center">'+data.data[nI].IMB_TBE_NOME+'</td>' +
            '<td style="text-align:center valign="center">'+data.data[nI].IMB_LCF_VALOR+'</td>' +
            '<td style="text-align:center valign="center">'+data.data[nI].IMB_LCF_LOCATARIOCREDEB+'</td>' +
            '<td style="text-align:center valign="center">'+data.data[nI].IMB_LCF_LOCADORCREDEB+'</td>' +
            '<td style="text-align:center valign="center">'+datavencimento+'</td>' +
            '<td style="text-align:center valign="center">'+nomelocador+'</td>' +
            '<td style="text-align:center valign="center">'+datarecebimento+'</td>' +
            '<td style="text-align:center valign="center">'+datapagamento+'</td>' +
            '<td style="text-align:center valign="center">'+data.data[nI].IMB_LCF_OBSERVACAO+'</td>';
              linha = linha +
                          '</tr>';
          $("#i-tbllancamento").append( linha );
        }
        montarPaginacao(data.recordsTotal);
      }
    });
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
      $( "#i-inc-multa" ).prop( "checked", false );
      $( "#i-inc-juros" ).prop( "checked", false );
      $( "#i-inc-taxa" ).prop( "checked", false );
      $( "#i-inc-irrf" ).prop( "checked", false );
      $( "#i-garantia" ).prop( "checked", false );
      $( "#i-inc-iss" ).prop( "checked", false );
      $("#i-locadorcredeb").val('N');    
      $("#i-locatariocredeb").val('N');    
      $("#mask_date2").val('');    
      $("#mask_currency").val('');    
      $("#I-IMB_LCF_ID").val('');    
      $("#i-tblparcelas>tbody").empty();
            
      cargaEventos();
      cargaPropImovel(0);
      selecionarContratoFull( $("#I-IMB_CTR_ID").val() );

  }

  $("#i-select-evento").change(function()
  {
    var evento =  $("#i-select-evento").val();
    url = "{{ route('eventos.find')}}/"+evento;

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
      }
    });


  });


  function gerarParcelas()
  {

    $("#i-parcelas").show();
    
    var evento =  $("#i-select-evento").val();
    var datainicial = $("#mask_date2").val();
    var valor = $("#mask_currency").val();
    var dia = $("#i-dia").val();
    var meses = $("#i-meses").val();

        


    valor = valor.replace("R$ ", "");
    valor = valor.replace(".", "");
    valor = valor.replace(".", "");
    valor = valor.replace(".", "");
    valor = valor.replace(",", ".");
    datainicial = datainicial.substr( 6,4 )+'-'+
                  datainicial.substr( 3,2 )+'-'+
                  datainicial.substr( 0,2 );
                  //15-04-2020
                  

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
      alert('O Valor está zerado! Esta é uma informação apenas de alerta, já que você pode lançar um valor zerado!');
    }
  
    
    url = "{{ route('rotina.gerarparcelamento')}}/1/"+meses+'/'+datainicial+'/'+valor+'/S';
    console.log('parcelamento: '+url );

    $.ajax(
    {
      url:url,
      datatype:'json',
      async:false,
      success: function( data )
      {

        console.log('dados: '+data );
        console.log( 'data.length'+data.length );

        linha = "";
        var descricao = $( "#i-descricao" ).val();
        $("#i-tblparcelas>tbody").empty();
        for( nI=0;nI < data.length;nI++)
        {
        
          
          if( $("#i-autopreenchimento").is(":checked") == true )
          {
            descricao = $( "#i-descricao" ).val() + ' - Parcela '+(nI+1)+'/' + $( "#i-meses" ).val();

          }
          console.log( 'data['+nI+'].length'+data[nI].valor );
          linha = 
            '<tr>'+
            '<td style="text-align:center valign="center">'+(nI+1)+'</td>' +
            '<td style="text-align:center valign="center">'+$( "#i-select-evento option:selected" ).text()+'</td>' +
            '<td style="text-align:center valign="center">'+locatariocredeb+'</td>' +
            '<td style="text-align:center valign="center">'+locadorcredeb+'</td>' +
            '<td style="text-align:center valign="center">'+moment( data[nI].data).format('DD/MM/YYYY')+'</td>' +
            '<td style="text-align:center valign="center">'+data[nI].valor+'</td>' +
            '<td style="text-align:center valign="center">'+descricao+'</td>';
              linha = linha +
                          '</tr>';
          $("#i-tblparcelas").append( linha );
        }        
        $("#i-div-confirmarparcelas").show();
        $("#i-div-regerarparcelas").show();
        $("#i-div-gerarparcelas").hide();

      }
    });


  }

  function gravarParcelasEmBanco()
  {
    $('#i-tblparcelas tbody tr').each(function () 
    {
      $.ajaxSetup(
      {
        headers:
        {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
        }
      });

        
      var colunas = $(this).children();

        // Criar objeto para armazenar os dados (com JSON essa tarefa fica mais simples)
      var lf = 
      {
          IMB_LCF_ID: $("#I-IMB_LCF_ID").val(),
          IMB_LCF_VALOR: $(colunas[5]).text(),
          IMB_IMB_ID: $("#IMB_IMB_IDMASTER").val(),
          IMB_ATD_ID: $("#IMB_ATD_ID").val(),
          IMB_LCF_LOCADORCREDEB: $(colunas[2]).text(),
          IMB_LCF_LOCATARIOCREDEB: $(colunas[3]).text(),
          IMB_LCF_DATAVENCIMENTO: $(colunas[4]).text(),
          IMB_LCF_OBSERVACAO: $(colunas[6]).text(),
	        IMB_LCF_TIPO: 'M' ,
          IMB_CTR_ID: $("#I-IMB_CTR_ID").val(),
          IMB_IMV_ID: $("#I-IMB_IMV_ID").val(),
          IMB_TBE_ID: $("#i-select-evento").val(),
          IMB_LCF_INCMUL: $("#i-inc-multa").val(),
          IMB_LCF_INCIRRF: $("#i-inc-irrf").val(),
          IMB_LCF_INCTAX: $("#i-inc-taxa").val(),
          IMB_LCF_INCJUROS: $("#i-inc-juros").val(),
          IMB_LCF_INCCORRECAO: $("#i-inc-juros").val(),
          IMB_LCF_GARANTIDO: $("#i-garantia").val(),
          IMB_LCF_INCISS: $("#i-inc-iss").val(),
      };


      console.log(

        'IMB_LCF_ID: '+lf.IMB_LCF_ID+' '+
        'IMB_LCF_VALOR: '+lf.IMB_LCF_VALOR+' '+
          'IMB_IMB_ID: '+lf.IMB_IMB_ID+' '+
          'IMB_LCF_LOCADORCREDEB: '+lf.IMB_LCF_LOCADORCREDEB +' '+
          'IMB_LCF_LOCATARIORCREDEB: '+lf.IMB_LCF_LOCATARIOCREDEB +' '+
          'IMB_LCF_DATAVENCIMENTO: '+lf.IMB_LCF_DATAVENCIMENTO +' '+
          'IMB_LCF_OBSERVACAO: '+lf.IMB_LCF_OBSERVACAO +' '+
	        'IMB_LCF_TIPO: '+lf.IMB_LCF_TIPO+' '+
          'IMB_CTR_ID: '+lf.IMB_CTR_ID +' '+
          'IMB_IMV_ID: '+lf.IMB_IMV_ID +' '+
          'IMB_TBE_ID: '+lf.IMB_TBE_ID +' '+
          'IMB_LCF_INCMUL: '+lf.IMB_LCF_INCMUL +' '+
          'IMB_LCF_INCIRRF: '+lf.IMB_LCF_INCIRRF +' '+
          'IMB_LCF_INCTAX: '+lf.IMB_LCF_INCTAX +' '+
          'IMB_LCF_INCJUROS: '+lf.IMB_LCF_INCJUROS +' '+
          'IMB_LCF_INCCORRECAO: '+lf.IMB_LCF_INCCORRECAO +' '+
          'IMB_LCF_GARANTIDO: '+lf.IMB_LCF_GARANTIDO +' '+
          'IMB_LCF_INCISS: '+lf.IMB_LCF_INCISS
          );

      var url = "{{ route('lancamento.gravar')}}";
      
      $.post( url, lf, function(data)
      {
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Informações Gravadas com Sucesso!',
          showConfirmButton: true,
          timer: 3500
        });

      });
    });
    cargaLancamento(1);


  }


  function salvarParcelas()
  {
      $.ajaxSetup(
      {
        headers:
        {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
        }
      });

      var valor = $("#mask_currency").val();
      valor = valor.replace("R$ ", "");
      valor = valor.replace(".", "");
      valor = valor.replace(".", "");
      valor = valor.replace(".", "");
      valor = valor.replace(",", ".");
       
        // Criar objeto para armazenar os dados (com JSON essa tarefa fica mais simples)
      var lf = 
      {
          IMB_IMB_ID: $("#I-IMB_IMB_IDMASTER").val(),
          IMB_LCF_ID: $("#I-IMB_LCF_ID").val(),
          IMB_CTR_ID: $("#I-IMB_CTR_ID").val(),
          IMB_IMV_ID: $("#I-IMB_IMV_ID").val(),
          IMB_LCF_TIPO: 'M',
          IMB_LCF_VALOR: valor,
          IMB_ATD_ID: $("#IMB_ATD_ID").val(),
          IMB_LCF_LOCADORCREDEB: $("#i-locadorcredeb").val(),
          IMB_LCF_LOCATARIOCREDEB: $("#i-locatariocredeb").val(),
          IMB_LCF_DATAVENCIMENTO: $("#mask_date2").val(),
          IMB_LCF_OBSERVACAO:  $("#i-descricao").val(),
	        IMB_LCF_TIPO: 'M' ,
          IMB_CLT_IDLOCADOR: $("#i-select-locadorsomente").val(),
          IMB_TBE_ID: $("#i-select-evento").val(),
          IMB_LCF_INCMUL: $("#i-inc-multa").val(),
          IMB_LCF_INCIRRF: $("#i-inc-irrf").val(),
          IMB_LCF_INCTAX: $("#i-inc-taxa").val(),
          IMB_LCF_INCJUROS: $("#i-inc-juros").val(),
          IMB_LCF_INCCORRECAO: $("#i-inc-juros").val(),
          IMB_LCF_GARANTIDO: $("#i-garantia").val(),
          IMB_LCF_INCISS: $("#i-inc-iss").val(),
      };


      console.log(

        'IMB_LCF_ID: '+lf.IMB_LCF_ID+' '+
        'IMB_LCF_VALOR: '+lf.IMB_LCF_VALOR+' '+
          'IMB_LCF_LOCADORCREDEB: '+lf.IMB_LCF_LOCADORCREDEB +' '+
          'IMB_LCF_LOCATARIORCREDEB: '+lf.IMB_LCF_LOCATARIOCREDEB +' '+
          'IMB_LCF_DATAVENCIMENTO: '+lf.IMB_LCF_DATAVENCIMENTO +' '+
          'IMB_LCF_OBSERVACAO: '+lf.IMB_LCF_OBSERVACAO +' '+
          'IMB_TBE_ID: '+lf.IMB_TBE_ID +' '+
          'IMB_LCF_INCMUL: '+lf.IMB_LCF_INCMUL +' '+
          'IMB_LCF_INCIRRF: '+lf.IMB_LCF_INCIRRF +' '+
          'IMB_LCF_INCTAX: '+lf.IMB_LCF_INCTAX +' '+
          'IMB_LCF_INCJUROS: '+lf.IMB_LCF_INCJUROS +' '+
          'IMB_LCF_INCCORRECAO: '+lf.IMB_LCF_INCCORRECAO +' '+
          'IMB_LCF_GARANTIDO: '+lf.IMB_LCF_GARANTIDO +' '+
          'IMB_LCF_INCISS: '+lf.IMB_LCF_INCISS
          );

      var url = "{{ route('lancamento.gravar')}}";
      
      $.post( url, lf, function(data)
      {
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Informações Gravadas com Sucesso!',
          showConfirmButton: true,
          timer: 3500
        });

      });
    
    cargaLancamento(1);


  }


  function  selecionarLancamento( id )
  {

    if( carregarOpcao( $("#I-IMB_ATD_ID").val(), 53,3, "{{route('direito.checar')}}", true) )
    {

      $( "#i-inc-multa" ).prop( "checked", false );
      $( "#i-inc-juros" ).prop( "checked", false );
      $( "#i-inc-taxa" ).prop( "checked", false );
      $( "#i-inc-irrf" ).prop( "checked", false );
      $( "#i-garantia" ).prop( "checked", false );
      $( "#i-inc-iss" ).prop( "checked", false );
      $("#i-meses").val(1);    
      $("#i-locadorcredeb").val('N');    
      $("#i-locatariocredeb").val('N');    
      $("#mask_date2").val('');    
      $("#mask_currency").val('');    
      $("#i-tblparcelas>tbody").empty();
      
      $("#i-div-confirmarparcelas").hide();
      $("#i-div-regerarparcelas").hide();
      $("#i-div-salvarparcelas").show();
      $("#i-div-gerarparcelas").hide();
          
      url = "{{ route('lancamento.edit')}}/"+id;

      $.getJSON( url, function( data)
      {
        console.log( 'DATA: '+data[0].IMB_LCF_DATAVENCIMENTO );
        $("#I-IMB_LCF_ID").val( id );    

        cargaEventos( data[0].IMB_TBE_ID );
        cargaPropImovel(data[0].IMB_CLT_IDLOCADOR );


      if ( data[0].IMB_LCF_INCMUL == 'S' )
        $( "#i-inc-multa" ).prop( "checked", false );

      if ( data[0].IMB_LCF_INCJUROS == 'S' )
        $( "#i-inc-juros" ).prop( "checked", false );
      
      if ( data[0].IMB_LCF_INCTAX == 'S' )
        $( "#i-inc-taxa" ).prop( "checked", false );
      
      if ( data[0].IMB_LCF_INCIRRF == 'S' )
        $( "#i-inc-irrf" ).prop( "checked", false );
      
      if ( data[0].IMB_LCF_GARANTIDO == 'S' )
        $( "#i-garantia" ).prop( "checked", false );
      
      if ( data[0].IMB_LCF_INCISS == 'S' )
        $( "#i-inc-iss" ).prop( "checked", false );
        
      $("i-select-evento").text( data[0].IMB_TBE_NOME );    
      $("i-select-evento").val( data[0].IMB_TBE_ID );    
      $("#i-locadorcredeb").val( data[0].IMB_LCF_LOCADORCREDEB);    
      $("#i-locatariocredeb").val( data[0].IMB_LCF_LOCATARIOCREDEB );    
      $("#mask_date2").val( moment( data[0].IMB_LCF_DATAVENCIMENTO ).format('DD/MM/YYYY'));    
      $("#mask_currency").val(data[0].IMB_LCF_VALOR);    
      $("#I-IMB_LCF_ID").val( id );    

      $("#modallancamento").modal('show');

      });
    }
  }


  $("#i-div-salvarparcelas").click( function()
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

    function filtrarAberto()
    {

      $("#i-aberto").val('S');
      cargaLancamento(1);


    }

    function reexibirTodos()
    {
      $("#i-aberto").val('N');
      $("#i-select-evento-filtro").val('0');
            
      cargaLancamento(1);

    }

    function processarFiltro()
    {        
      $("#i-codigocliente").val('N');
      cargaLancamento(1);
      $("#modalfiltro").modal('hide');

    }


    function verificarSelecao() {
      var chks = document.getElementById("i-tbllancamento").getElementsByTagName("input");
      
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
   
   
          console.log('url>: '+url);
      //alert( regs );
            

   }    
    

  function gerarBoleto()
  {

    if(  $("#i-aberto").val() =='N' )
    {
      Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Primeiramente click em "Todos em Aberto" ',
                text: 'Para um processo mais seguro, antes de gerar boleto click na opção "Todos em Abreto" ',
                showConfirmButton: true,
                timer: 3500
              });
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
      Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Data de Vencimento ',
                text: 'Preenchimento Obrigatório! ',
                showConfirmButton: true,
                timer: 3500
              });
      return false;

    }



  }


  function calcularRecebimento()
  {

    if (!  isValidDate( $("#i-data-pagamento").val() ) )
    {
      alert("Data Inválida");
      $("#i-data-pagamento").val('');
    }
    else
      alert('calcular');

  }

  function isValidDate(date) {
  var matches = /^(\d{2})[-\/](\d{2})[-\/](\d{4})$/.exec(date);
  if (matches == null) return false;
  var d = matches[2];
  var m = matches[1] - 1;
  var y = matches[3];
  var composedDate = new Date(y, m, d);
  return composedDate.getDate() == d &&
    composedDate.getMonth() == m &&
    composedDate.getFullYear() == y;
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
  if  ( carregarOpcao( $("#I-IMB_ATD_ID").val(), 53,1, "{{route('direito.checar')}}") == false )  window.history.back();




</script>



@endpush