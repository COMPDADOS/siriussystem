@extends('layout.app')
@push('script')


@section( 'scripttop')

<style>

.font-10
{
  font-size:10px;
}
.font-11
{
  font-size:10px;
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


.lbl-medidas-valores {
  text-align: center;
  font-size: 14px;
  font-weight: bold;
  color: #4682B4; 
}

.identificacao
  {
    color:white;
    font-size: 14px;
    font-weight: bold;    
  }

  .subtotal
  {
    color:black;
    font-size: 14px;
    font-weight: bold;    
    text-decoration: overline;
  }

.back-azul-titulo {
  background-color: blue;
  color:white;
}

  .div-1 {
  background-color: lightblue;
}
.div-2 {
  background-color: #CCFFE5;
}

.div-right
{
  text-align:right;
}

.juridico
{
  color:red;
}

.encerrado
{
  color:red;
  font-size: 20px;
  font-weight: bold;   
}
.acordo
{
  color:blue;
  font-size: 20px;
  font-weight: bold;   
}

.email
{
  color:blue;
  font-size: 12px;

}
.fone
{
  color:blue;
  font-size: 11px;

}

.red-font
{
  color:red;
}

.blue-font
{
  color:blue;
}


</style>


@endsection

@section('content')


<!-- BEGIN CONTENT -->
<div class="row">
  <div class="col-md-12">
    <div class="tabbable-line boxless tabbable-reversed">
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            <input type="hidden" id="IMB_IMB_IDMASTER" name="empresamaster" 
                value="{{ Auth::User()->IMB_IMB_ID }}"> 
            <div class="form-body">

            <div class="row">
              <div class="col-md-12">
                <div class="col-md-2">
                  <label class="control-label">Situação</label>
                    <input type="hidden" id="situacao" name="situacao" value="E">
                    <select class="form-control" id="i-situacao">
                      <option value="E">Excluindo os Juridicos</option>
                      <option value="J">Somente os Juridicos</option>
                      <option value="T">Todos</option>
                    </select>
              
                </div>
                <div class="col-md-3">
                  <label class="control-label">Quanto ao Vencimento</label>
                    <input type="hidden" id="opcaovencimento" name="opcaovencimento">
                    <select class="form-control" id="i-opcaovencimento"  >
                      <option value="A" selected>Somente do Vecto mais antigo</option>
                      <option value="P" >Repeitar o Período Informado</option>
                      <option value="D">Detalhar Meses</option>
                    </select>
                 
                </div>

                <div class="col-md-2">
                  <label class="label-control" for="i-data-inicio">Data Inicial</label>
                  <input class="form-control" type="date" id="i-data-inicio" name="i-data-inicio">
                  
                </div>
                <div class="col-md-2">
                  <label class="label-control" for="i-data-fim">Data Final</label>
                  <input class="form-control" type="date" id="i-data-fim" name="i-data-fim">
                  
                </div>
                <div class="col-md-1 div-center">
                    <button class="form-control btn btn-success" id='search-form' onClick="cargaResult()"> Processar</button>
                </div>
                <div class="col-md-1 div-center">
                    <button class="form-control btn btn-dark" id='search-form' onClick="totalizarInad()"> Totalizar</button>
                </div>
              </div>
              <div class="col-md-12">
                <div class="col-md-2 div-center">
                  <input class="form-control" type="checkbox" id="i-garantidos" name="i-garantidos">Somente Garantidos
                </div>
                <div class="col-md-2 div-center">
                  <input class="form-control"  type="checkbox" id="i-ativos" name="i-ativos" checked>Somente Ativos
                 
                </div>
                <div class="col-md-2 div-center">
                  <input class="form-control"  type="checkbox" id="i-acordos" name="i-acordos" >Somente Acordos
                 
                </div>
                <div class="col-md-2 subtotal escondido" id="div-total">
                  <label class="control-label">Total R$</label>
                  <input type="text" class="form-control subtotal div-center valor" id="i-totalinad">
                </div>
              </div>
            </div>

            <div class="portlet box blue i-div-informacoes">
              <div class="portlet-title">
                <div class="caption">
                  <i class="fa fa-gift"></i>Inadimplentes
                </div>
  
              </div>
              
              <div class="portlet-body form">
                <table  id="resultTable" class="table table-striped table-bordered table-hover" >
                  <thead >
                    <tr>
                      <th width="100%"></th>  
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <div id="i-div-pagination">
              </div>
            </div>
        </div> <!--class="tab-pane active" id="tab_1">-->
      </div><!--class="tab-content">-->
    </div><!--class="tabbable-line boxless tabbable-reversed">-->
  </div> <!--<div class="col-md-12">-->
</div> <!-- fim row unica -->
<form style="display: none" action="{{route('cliente.edit')}}" method="POST" id="form-alt-cliente-indexctr"  target="_blank">
@csrf
    <input type="hidden" id="id-cliente" name="id" />
    <input type="hidden" id="readonly" name="readonly" value="readonly"/>
</form>

@include('layout.modaldownload')

@include('layout.modalrealizarcobranca')

@include('layout.modaldetalhedebitoatraso')
          <!-- BEGIN QUICK SIDEBAR -->

<a href="javascript:;" class="page-quick-sidebar-toggler">
  <i class="icon-login"></i>
</a>

<div class="page-quick-sidebar-wrapper" data-close-on-body-click="false">
</div>

@endsection
@push('script')

<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script>
  
  
  $( document ).ready(function() 
  {
    $("#sirius-menu").click();

    $("#i-situacao").change( function()
    {
      $("#situacao").val( $("#i-situacao").val() );
    });

  

  });


  function cargaResult22222222()
  {
    var url = "{{ route('inadimplentes.calcular') }}";

    $.ajax(
    {
      url : url,
      dataType:'json', 
      Type: 'get',
      success:function(data)
      {

      }
    })

  }
  function cargaResult()
  {
    debugger;
    $("#i-total").val(0);

    if( $("#opcaovencimento").val() == '' ) $("#opcaovencimento").val('A') ;
    $("#opcaovencimento").val( $("#i-opcaovencimento").val() );
    var url = "{{ route('inadimplentes.calcular') }}";
    $('#resultTable').DataTable().destroy();
    $("#resultTable tr").remove();
    var rows_selected = [];
    var table = $('#resultTable').DataTable(
    {
      dom: 'Bfrtip',
        buttons: [
            'pageLength',
            'print',
            'excel'
        ],
      "pageLength": -1,
      "language": 
      {
          "sEmptyTable": "Nenhum registro encontrado",
          "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
          "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
          "sInfoPostFix": "",
          "sInfoThousands": ".",
          sLoadingRecords: '<div class="overlay"><img src="{{asset('/layouts/layout/img/loader.gif')}}"/></div>',
          sProcessing: '<div class="overlay"><img src="{{asset('/layouts/layout/img/loader.gif')}}"/></div>',
          "sZeroRecords": "Nenhum registro encontrado",
          "scrollY": "300px",
          "oPaginate": {
              "sNext": "Próximo",
              "sPrevious": "Anterior",
              "sFirst": "Primeiro",
              "sLast": "Último"
      }
    },
    bSort : false ,
    processing: true,
    serverSide: true,
    ajax: 
    { 
      url: url,
      data: function (d) 
      {
          d.situacao  = $('input[name=situacao]').val();
          d.opcaovencimento    = $('input[name=opcaovencimento]').val();
          d.datainicio    = moment($('input[name=i-data-inicio]').val()).format( 'DD/MM/YYYY');
          d.datafim    = moment($('input[name=i-data-fim]').val()).format( 'DD/MM/YYYY');
          d.garantidos        = $('input[name=i-garantidos]').prop('checked') ? 'S' : 'N';
          d.ativos        =  $('input[name=i-ativos]').prop('checked') ? 'S' : 'N';
          d.acordos        =  $('input[name=i-acordos]').prop('checked') ? 'S' : 'N';
      }
    },
    columns: 
    [
      {
          "data": 'IMB_IMV_ID', render: getInformacoes
      },
    ],
    searching: false
    });
//    table.draw();
    table.clear();
   // e.preventDefault();

  }



  function getInformacoes(data, type, full, meta) 
{
  
  var valoraluguel = parseFloat( full.IMB_CTR_VALORALUGUEL );


  var pasta = '-';
  if( full.IMB_CTR_REFERENCIA != '' ) pasta = full.IMB_CTR_REFERENCIA;

  var ultimacobranca = '';
  if( full.DATAULTIMACOBRANCA != null ) ultimacobranca = '** Último Cobrança: '+moment(full.DATAULTIMACOBRANCA).format('DD/MM/YYYY')+'**   ';
  
  var classjur = '';
  if( full.JURIDICO == 'JURÍDICO')
    classjur="juridico"  ;

 // if( encerrados === null ) encerrados ='';

    var fiador1='';
  if( full.FIADOR1NOME != '' )
    fiador1 =
        '     <div class="row">'+
        '      <div class="col-md-6 juridico">'+
        '         <b>'+'</b> <button onClick="cobrarCliente('+full.IMB_CLT_IDFIADOR1+','+full.IMB_CTR_ID+',2)"><i class="fa fa-phone-square" aria-hidden="true"></i></button>Fiador: <b><a href="javascript:alterarClienteIndexCtr('+full.IMB_CLT_IDFIADOR1+')">'+full.FIADOR1NOME+'</a></b>'+
        '      </div>'+
        '      <div class="col-md-6 email">'+
        '         <b>'+'</b> <button><i class="fa fa-envelope-o" aria-hidden="true" onClick="emailFiador('+full.IMB_CLT_IDFIADOR1+','+full.IMB_CTR_ID+')"></i></button>'+
        '         <button title="Gerar carta ao locatário"><i class="fa fa-print" aria-hidden="true" onClick="cartaFiador('+full.IMB_CLT_IDFIADOR1+','+full.IMB_CTR_ID+')"></i></button>Fiador: <b>'+full.FIADOR1EMAIL+
        '      </div>'+
        '     </div>';
    var fiador2='';
  if( full.FIADOR2NOME != '' )
    fiador2 =
        '     <div class="row">'+
        '      <div class="col-md-12 juridico">'+
        '         <b>'+'</b> <button onClick="cobrarCliente('+full.IMB_CLT_IDFIADOR2+','+full.IMB_CTR_ID+',2)"><i class="fa fa-phone-square" aria-hidden="true"></i></button>'+
        '        <button title="Gerar carta ao locatário"><i class="fa fa-print" aria-hidden="true" onClick="cartaFiador('+full.IMB_CLT_IDFIADOR2+','+full.IMB_CTR_ID+')"></i></button>Fiador: <b>'+full.FIADOR2NOME+'</b>'+
        '      </div>'+
        '     </div>';
  var linha = 
      '<div class="col-md-12">'+
      '     <div class="row">'+
      '       <div class="col-md-2">Imóvel: <b>'+full.IMB_IMV_ID+'</b>'+
      '       </div> '+
      '       <div class="col-md-2 '+classjur+'"><b>'+full.JURIDICO+'</b>'+
      '       </div>'+
      '       <div class="col-md-1">Pasta: <b>'+pasta+'</b>'+
      '       </div>'+
      '       <div class="col-md-1 encerrado"><b>'+full.ENCERRADO+'</b>'+
      '       </div>'+
      '       <div class="col-md-1 acordo"><b>'+full.ACORDO+'</b>'+
      '       </div>'+
      '<div class="col-md-1  div-center">'+
       '     <a href="/sys/lancamento?IMB_CTR_ID='+full.IMB_CTR_ID+'" target="_blank"><i class="btn btn-success fa fa-calculator" aria-hidden="true">Lançamentos</i></a>'+
      '    </div> '+
      '       <div class="col-md-4">'+
      '<b>'+full.ENDERECOCOMPLETO+'</b>'+
      '       </div>'+
      '     </div>'+
      '     <div class="row">'+
      '       <div class="col-md-2">'+
      '       <button  title="Total em Aberto" onClick="cargaDebitos('+full.IMB_CTR_ID+')"><i class="fas fa-calculator"></i></button>Aluguel: R$ <b>'+valoraluguel+'</b>'+
      '       </div>'+
      '       <div class="col-md-3 div-center">'+ultimacobranca+
      '       </div>'+
      '       <div class="col-md-1">'+
      '       </div>'+
      
      '       <div class="col-md-2">Vencto: <b>'+moment(full.IMB_CTR_VENCIMENTOLOCATARIO).format('DD/MM/YYYY')+'</b>'+
      '       </div>'+
      '       <div class="col-md-2">Dt Limite: <b>'+moment(full.IMB_CTR_DATALIMITE).format('DD/MM/YYYY')+'</b>'+
      '       </div>'+
      '     </div>'+
      '     <div class="row">'+
      '       <div class="col-md-6 juridico"><button onClick="cobrarCliente('+full.IMB_CLT_IDLOCATARIO+','+full.IMB_CTR_ID+',1)"><i class="fa fa-phone-square" aria-hidden="true"></i></button>Locatário: '+
      '       <b><a href="javascript:alterarClienteIndexCtr('+full.IMB_CLT_IDLOCATARIO+')">'+full.IMB_CLT_NOMELOCATARIO+'</a>'+
      '       </div>'+
      '       <div class="col-md-6 email">'+
      '         <button><i class="fa fa-envelope-o" aria-hidden="true"onClick="emailLocatario('+full.IMB_CLT_IDLOCATARIO+','+full.IMB_CTR_ID+')"></i></button>'+
      '         <button title="Gerar carta ao locatário"><i class="fa fa-print" aria-hidden="true"onClick="cartaLocatario('+full.IMB_CLT_IDLOCATARIO+','+full.IMB_CTR_ID+')"></i></button><b>'+full.IMB_CLT_EMAIL+'</b>'+
      '       </div>'+
      '     </div>'+
      fiador1+
      fiador2+
      '</div>';
  return linha;

}

function cobrarCliente( id, idContrato,tipo )
{
  
  cargaTelefone( id );
  
  indentificacao(  idContrato );
  $("#i-tipocliente").html( 'LOCATÁRIO');  //é o tipo de cliente topo onde sempre será locatário
  $("#i-contrato").val( idContrato );
  if( tipo == 1 ) $("#i-tipocliente-telefone").html( '   (LOCATÁRIO)');
  if( tipo == 2 ) $("#i-tipocliente-telefone").html( '   (FIADOR)');
  $("#i-anotacoes").val('') ;
  $("#modalrealizarcobranca").modal('show');

}


function emailLocatario( idLocatario, idContrato )
{

   var url = "{{route('emailcobrancalocatario')}}/"+idLocatario+'/'+idContrato ;
   console.log( url );
 
   $.ajax(
    {
      url:url,
      dataType:'json',
      type:'get',
      success:function()
      {
        alert('Email enviado e registro nos logs');

      },
      error:function()
      {
        alert('Falha ao gerar o email de cobrança para o locatario')
      }
    }
   )
}
function emailFiador( idFiador, idContrato )
{

   var url = "{{route('emailcobrancafiador')}}/"+idFiador+'/'+idContrato ;
   console.log( url );
 

   $.ajax(
    {
      url:url,
      dataType:'json',
      type:'get',
      success:function()
      {
        alert('Email enviado e registro nos logs');

      },
      error:function()
      {
        alert('Falha ao gerar o email de cobrança para o fiador')
      }
    }
   )
}

function cartaLocatario( idLocatario, idContrato )
{

   var url = "{{route('cartacobrancalocatario')}}/"+idLocatario+'/'+idContrato ;
   $.ajax(
    {
      url:url,
      dataType:'json',
      type:'get',
      success:function(data)
      {
        var url = '<a href="'+data+'" download>Click no Link para Baixar</a>';
                $("#i-filename-title").html( 'Geração de Documentos no Word');
                $("#div-download").empty();
                $("#div-download").append(url);
                $("#modaldownload").modal('show');
                $("#i-download").val( data );

      }
    }
   )
   

}

function cartaFiador( idFiador, idContrato )
{
   var url = "{{route('cartacobrancafiador')}}/"+idFiador+'/'+idContrato ;

   $.ajax(
    {
      url:url,
      dataType:'json',
      type:'get',
      success:function(data)
      {
        var url = '<a href="'+data+'" download>Click no Link para Baixar</a>';
                $("#i-filename-title").html( 'Geração de Documentos no Word');
                $("#div-download").empty();
                $("#div-download").append(url);
                $("#modaldownload").modal('show');
                $("#i-download").val( data );

      }
    }
   )
   
}

function totalizarInad()
{
  var url = "{{route('inadimplentes.totalgeral')}}";


  $.ajax(
    {
      url:url,
      dataType:'json',
      type:'get',
      success:function(data)
      {
        $("#i-totalinad").val( data );
        $("#div-total").show();
      }
    }
  )
}
function alterarClienteIndexCtr( id )
        {
            $("#id-cliente").val( id );
            $("#form-alt-cliente-indexctr").submit();
        }

</script>



@endpush