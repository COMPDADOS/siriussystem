@extends("layout.app")
@section('scripttop')
<style>

th { font-size: 12px; }
td { font-size: 12px; }

.div-center
{
  text-align:center;
}

.naoselecionada {
    color:red;
  }

.vermelho
{
  color:red;
  font-weight: bold;

}
.quitado {
    text-decoration: line-through;
    color: blue;
  }

  .td-rigth
  {
    text-align:right;
}

.div-right
{
    text-align:right;
}

.escondido
{
    display:none;
}

.lbl-medidas {
  text-align: center;
  font-size: 14px;

}
.lbl-medidas-valores {
  text-align: center;
  font-size: 14px;
  font-weight: bold;
  color: #4682B4;
}

.div-border-blue-center{
    border:solid 1px #4682B4;
    text-align: center;
}
.lbl-medidas-outrositens {
  text-align: left;
  font-size: 12px;
  color: #4682B4;
}

.cardtitulo {
  text-align: left;
  font-size: 16px;
  color: #4682B4;
  font-weight: bold;

}

.lbl-download-title {
  text-align: center;
  font-size: 20px;
  font-weight: bold;
}

hr {
    height: 2px;
}

div .half-size-line
{
    line-height: 92%;
}

th
{
    text-align:center;
}
.back-blue
{
  background-color:blue;
}

</style>
<script src="{{asset('/global/plugins/sweetalert/sweetalert2.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('/global/plugins/sweetalert/sweetalert2.min.css')}}">

@endsection
@section('content')
<div class="row">
    <div class="col-md-4">
      <a class="btn btn-success" href="{{route('cobrancabancaria.retornorelatliquidacoes')}}">Relatório de Liquidações</a>
      <a class="btn btn-primary" href="{{route('cobrancabancaria.relatorioretonototal')}}">Relatório de Retorno Geral</a>
    </div>
    <div class="col-md-2">

    </div>
    <div class="col-md-2">
      <label class="control-label">Ordem de Visualização</label>
      <select id="i-ordem" class="form-control">
        <option value="D">Data Vencimento</option>
        <option value="P" selected>Pasta</option>
        <option value="L">Nome Locatário</option>

      </select>

    </div>
    <button class="btn btn-danger pull-right" type="button" id="btn-baixar"
          onClick="baixaAutomatica()">Baixa Automática</button>
  </div>

  <div classs="back-blue">
    <input type="hidden" id="dados" >

    <div class="col-md-12">
      <div class="col-md-12 div-center" id="i-nomearquivo">
      </div>
      <table class="display compact" id="tbretorno">

        <thead>
          <th></th>
          <th></th>
          <th>#id</th>
          <th>Pasta</th>
          <th>Motivo</th>
          <th>Nosso Nº</th>
          <th>Pago em Banco</th>
          <th>Valor Título</th>
          <th>Encargos</th>
          <th>Endereço</th>
          <th>Locatário</th>
          <th>Vencto.Original</th>
          <th>Vencimento</th>
          <th>Data Pagto.</th>
          <th>Motivo Rejeicao</th>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>



@endsection

@push('script')

<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/jquery.btechco.excelexport.js')}}"></script>
<script src="{{asset('/js/jquery.base64.js')}}"></script>

<script>

$( document ).ready(function()
{
    $("#sirius-menu").click();
    cargaTmpRetorno();

    $("#i-ordem").change( function()
    {
      $('#tbretorno').DataTable().ajax.reload();

    })
});

function gerarExcel()
{
    $("#tbretorno").btechco_excelexport(
        {
            containerid: "tbretorno"
            , datatype: $datatype.Table
            , filename: 'retornobancario'
        });

}

function baixaAutomatica()
{
    var url = "{{route('previabaixaautomatica')}}";
    window.location = url;
  }


function cargaTmpRetorno ()
{

  var table = $('#tbretorno').DataTable(
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
        buttons:
        {
          pageLength:
          {
                _: "Mostrar %d Linhas",
                '-1': "Linhas por Página"
          }
        },
        "sEmptyTable": "Nenhum registro encontrado",
        "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
        "sInfoFiltered": "(Filtrados de _MAX_ registros)",
        "sInfoPostFix": "",
        "sInfoThousands": ".",
        sLoadingRecords: '<img src="{{asset('/layouts/layout/img/loader.gif')}}"/>',
        sProcessing: '<img src="{{asset('/layouts/layout/img/loader.gif')}}"/>',
        "sZeroRecords": "Nenhum registro encontrado",
        "sSearch": "Pesquisar",
        "oPaginate":
        {
          "sNext": "Próximo",
          "sPrevious": "Anterior",
          "sFirst": "Primeiro",
          "sLast": "Último"
        },
      },
      bLengthChange: true,
      lengthMenu: [[10, 20, 30, -1], [10, 20, 30, "All"]],
      bSort : false ,
      responsive: false,
      processing: true,
      serverSide: true,
      ajax:
      {
        url:"{{route('cobrancabancaria.cargatmpretorno')}}",
        data: function (d)
        {
          d.ordem = $("#i-ordem").val()
        }
      },
      columns:
      [
        {data: 'selecionado', render:pegarClick},
        {data: 'valorjapago', render:jaPago},
        {data: 'imb_imv_id', render:status},
        {data: 'imb_ctr_referencia',render:status},
        {data: 'nomeocorrencia', render:status},
        {data: 'nossonumero', render:status},
        {data: 'valorpago', render:formatarValor},
        {data: 'valorcobranca',render:formatarValor},
        {data: 'encargos',render:formatarValor},
        {data: 'endereco', render:status},
        {data: 'locatario', render:status},
        {data: 'IMB_CGR_VENCIMENTOORIGINAL', render:formatarData},
        {data: 'datavencimento', render:formatarData},
        {data: 'datapagamento', render:formatarData},
        {data: 'MOTIVOREJEICAODESCRICAO'},
    ],
    "columnDefs":
    [
      {
        "targets": 0,
        "orderable": false
      } ,
    ],
    searching: true,
    "ordering": true
  });

  $('#search-form').on('submit', function(e)
  {
    table.draw();
    e.preventDefault();
  });

}
function cargaTmpRetornoold()
{


  var url="{{route('cobrancabancaria.cargatmpretorno')}}";

  $.ajax(
    {
      url:url,
      dataType:'json',
      type:'get',
      success:function( data )
      {
        linha = "";
          $("#tbretorno>tbody").empty();
          for( nI=0;nI < data.length;nI++)
          {
            var datavencimento  = moment( data[nI].datavencimento).format('DD/MM/YYYY');
            var datapagamento   = moment( data[nI].datapagamento).format('DD/MM/YYYY');
            var datacredito   = moment( data[nI].datacredito).format('DD/MM/YYYY');

            var pasta = data[nI].imb_ctr_referencia;
            if( pasta === null ) pasta = '';
            if( datacredito == 'Invalid date' )
              datacredito='';
              classe=''

              var valorcobranca = parseFloat( data[nI].valorcobranca );
              valorcobranca = formatarBRSemSimbolo( valorcobranca );

              var valorpago = parseFloat( data[nI].valorpago );
              valorpago = formatarBRSemSimbolo( valorpago );

              var encargos = parseFloat( data[nI].encargos );
              encargos = formatarBRSemSimbolo( encargos );

            var selecionado = '<i class="fa fa-square-o" aria-hidden="true"></i>';
            if( data[nI].selecionado == 'S' )
               selecionado = '<i class="fa fa-check-square-o" aria-hidden="true"></i>';

            var classe="";
            if(  data[nI].valorjapago  != 0 )
                classe=" quitado"
            else
            if( data[nI].observacoes  != '' )
              classe=" naoselecionado";

            debugger;
            if( data[nI].pagonaoconfere =='S' )
              classe="vermelho";
             

            linha =
            '<tr class="'+classe+'">'+
                '<td class="div-center" ><div><a href="javascript:selecionar('+data[nI].idtable+')">'+selecionado+'</a></div></td>'+
                    '<td class="td-center">'+data[nI].imb_imv_id+'</td>' +
                    '<td class="td-center">'+pasta+'</td>' +
                    '<td class="td-center">'+data[nI].nomeocorrencia+'</td>' +
                    '<td class="td-rigth">'+data[nI].nossonumero+' </td>' +
                    '<td class="div-right">'+valorpago+' </td>' +
                    '<td class="div-right">'+valorcobranca+' </td>' +
                    '<td class="td-center">'+datacredito+'</td>' +
                    '<td class="div-right">'+encargos+'</td>' +
                    '<td class="td-center">'+data[nI].observacoes+'</td>' +
                    '<td class="td-center">'+data[nI].endereco+'</td>' +
                    '<td class="td-center">'+data[nI].locatario+'</td>' +
                    '<td class="td-center">'+datavencimento+'</td>' +
                    '<td class="td-center">'+datapagamento+'</td>' +
                  '</tr>';
            $("#tbretorno").append( linha );
          }

      }
    }
  )

}

function selecionar( id )
  {
    $.ajaxSetup(
    {
      headers:
      {
        'X-CSRF-TOKEN': "{{csrf_token()}}"
      }
    });

    var url = "{{route('cobrancabancaria.selecionartmpretorno')}}/"+id;

    $.ajax(
      {
        url : url,
        dataType: 'json',
        type:'post',
        success: function( data )
        {
          var iddoc = data;
          $('#tbretorno').DataTable().ajax.reload();
          //cargaTmpRetorno();

        },
        error:function()
        {
          alert('Erro ao selecionar documento');
        }
      }
    );


  }

  function formatarData( data )
  {
    if( data != null )
      return moment( data ).format( 'DD/MM/YYYY'); 
    return '-';


  }
  function formatarValor( data )
  {
    var classe="";
    if(  data.valorjapago  != 0 )
        classe=" quitado ";

    if( data.observacoes  != '' )
        classe=" naoselecionado ";
    if( data.pagonaoconfere =='S' )
        classe="vermelho";


    var formatada = data;
    return '<div class="'+classe+' div-right">'+formatada+'</div>';

  }

  function pegarClick(data, type, full, meta)
  {
    //dd( full);
    if( full.valorjapago == 0 || full.codigoocorrencia == '06')
    {
      var selecionado = '<i class="fa fa-square-o" style="font-size:30px" aria-hidden="true"></i>';
      if ( full.selecionado != null)
      {
        if( full.selecionado == 'S' )
          selecionado = '<i class="fa fa-check-square-o" style="font-size:30px" aria-hidden="true"></i>';
      }
      return '<a href="javascript:selecionar('+full.idtable+')">'+selecionado+'</a>';
    }
    return '<div>-</div>';
  }


  function status(data, type, full, meta)
  {

    var classe="";
    if(  full.valorjapago  != 0 )
        classe=" quitado ";

    if( full.observacoes  != '' )
        classe=" naoselecionado ";
    
    if( full.pagonaoconfere =='S' )
        classe="vermelho";


    return '<div class="'+classe+'">'+data+'</div>';

  }

  function jaPago(data, type, full, meta)
  {
    if( data != 0 )
      return '<div class="vermelho">JÁ PAGO</div>';
    
    return '<div></div>';

  }

</script>

@endpush
