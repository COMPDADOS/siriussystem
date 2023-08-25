@extends('layout.app')
@section('scripttop')
<style>
.dashed{
    text-decoration: overline underline line-through;
    color:#999;
}
.td-rigth
  {
    text-align:right;
  }

.td-center
  {
    text-align:center;
  }

  .estornado
{
  text-decoration: line-through;
  color: #ffad99;
}
.total-selecionado 
{
  background-color:#b3d9ff;
  color:#003366;
  font-weight: bold;
  text-align:center;
}


.cardtitulo {
  text-align: left;
  font-size: 16px;
  color: #4682B4; 
  font-weight: bold;

}
.cardtitulo-20 {
  text-align: left;
  font-size: 20px;
  color: #4682B4; 
  font-weight: bold;

}

.escondido
{
  display:none;
}
 
</style>

@endsection

@section('content')

@include( 'layout.cabecalhocontrato')


<div class="portlet box blue " id="div-geral">
  <div class="portlet-title">
    <div class="caption" id="i-lbl-header-modalresumoparcelas">
      <i class="fa fa-gift"></i>
    </div>
  </div>
  <input type="hidden" id="i-chave">

  @php
  $historicos = app( 'App\Http\Controllers\ctrReciboLocatario')->carregarHistorico( $idcontrato,'semjson' );
  @endphp
  

  <div class="portlet-body form">
    <div class="row">
      <div class="col-md-12">
        <table  id="tblhistorico" class="table-striped table-bordered table-hover" >
          <thead class="thead-dark">
            <tr>
              <th width="15%" style="text-align:center"> Ações </th>
              <th width="15%" style="text-align:center"> Vencimento </th>
              <th width="15%" style="text-align:center"> Pagamento </th>
              <th width="20%" style="text-align:center"> Nº Recibo </th>
              <th width="15%" style="text-align:center"> Valor Pago </th>
              <th width="20%" style="text-align:center"> Conta </th>
            </tr>
          </thead>
          <tbody>
            @foreach( $historicos as $registro)
              @php
                $classe='';
                if( $registro->IMB_RLT_DTHINATIVO == null )
                  $classe='x';
                else
                  $classe='estornado';
              @endphp

                        
              <tr class="{{$classe}}">
                <td style="text-align:center" valign="center">
                <a href="javascript:cargaHistDet({{$registro->IMB_RLT_NUMERO}})" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-zoom-in"></span></a> 
                <a href="javascript:verRecibo({{$registro->IMB_RLT_NUMERO}})" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-print"></span></a> 
                  <a title="Estornar o recibo" href="javascript:estornarRecibo({{$registro->IMB_RLT_NUMERO}})" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span></a> 
                </td>
                <td class="td-center">{{date( 'd/m/Y', strtotime( $registro->IMB_RLT_DATACOMPETENCIA))}}</td>
                <td class="td-center">{{date( 'd/m/Y', strtotime( $registro->IMB_RLT_DATAPAGAMENTO))}}</td>
                <td class="td-center">{{ $registro->IMB_RLT_NUMERO}}</td>
                <td class="td-rigth">{{ number_format( $registro->TOTAL,2,',','.')}}</td>
                <td class="td-center">{{$registro->FIN_CCX_DESCRICAO}}</td>
              </tr>

            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@include( 'layout.modalhistltdet')

@endsection      

@push('script')

<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>


<script>
  $( document ).ready(function() 
  {
//    cabecalhoContrato( $("#IMB_CTR_ID").val() );

  });

  function  alhoContrato( idcontrato )
  {

    var url = "{{route('contrato.find')}}/"+idcontrato;
    console.log( url );

    $.ajax(
      {
        url       : url,
        type      : 'get',
        dataType  : 'json',
        async     : false,
        success   : function( data )
        {
          $("#i-locatario").val( data[0].IMB_CLT_NOME_LOCATARIO);
          $("#i-locador").val( data[0].PROPRIETARIO);
          $("#i-pasta").val( data[0].IMB_CTR_REFERENCIA);
          $("#i-lbl-header-imovel").html( 
            '('+data[0].IMB_IMV_ID+')-'+data[0].ENDERECOCOMPLETO);
            $("#i-iniciocontrato").val( moment(data[0].IMB_CTR_INICIO).format( 'DD/MM/YYYY'));
            $("#i-proximoreajuste").val( moment(data[0].IMB_CTR_DATAREAJUSTE).format( 'DD/MM/YYYY'));
//            cargaHistorico( idcontrato );
        }
      }
    )

  }

  function cargaHistorico( idcontrato )
  {

    url = "{{route('recibolocatario.carregarHistorico.puro')}}/"+idcontrato+'/';
    console.log( url );

    $.ajax(
      {
        url       : url,
        type      : 'get',
        dataType  : 'json',
        success   : function( data )
        {

          linha = "";
          $("#tblhistorico>tbody").empty();
          for( nI=0;nI < data.length;nI++)
          {
            var datavencimento  = moment( data[nI].IMB_RLT_DATACOMPETENCIA).format('DD/MM/YYYY');
            var datapagamento   = moment( data[nI].IMB_RLT_DATAPAGAMENTO).format('DD/MM/YYYY');
            var datainativo   = moment( data[nI].IMB_RLT_DTHINATIVO).format('DD/MM/YYYY');
            var classe='';
            if( datainativo == 'Invalid date' )
              classe=''
            else
              classe='estornado';
            
              var valor = parseFloat( data[nI].TOTAL );
            valor = formatarBRSemSimbolo( valor );

            linha = '<tr class="'+classe+'">'+ 
                    '<td style="text-align:center" valign="center"> '+
                      '<a href=javascript:cargaHistDet('+data[nI].IMB_RLT_NUMERO+') class="btn btn-sm btn-success"><span class="glyphicon glyphicon-zoom-in"></span></a> '+
                      '<a href=javascript:verRecibo('+data[nI].IMB_RLT_NUMERO+') class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-printer"></span></a> '+
                      '<a title="Estornar o recibo" href=javascript:estornarRecibo('+data[nI].IMB_RLT_NUMERO+') class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span></a> '+
                    '</td> '+
                    '<td class="td-center">'+datavencimento+'</td>' +
                    '<td class="td-center">'+datapagamento+'</td>' +
                    '<td class="td-center">'+data[nI].IMB_RLT_NUMERO+'</td>' +
                    '<td class="td-rigth">'+valor+' </td>' +
                    '<td class="td-center">'+data[nI].FIN_CCX_DESCRICAO+'</td>' +
                  '</tr>';
            $("#tblhistorico").append( linha );
          } 
        }
      });          
      $("#div-geral").show();

    }

    function verRecibo( idrecibo )
    {
      var url =  "{{route('recibolocatario.imprimir')}}/"+idrecibo+'/S ';
      window.open( url, '_blank' );
    }

    function estornarRecibo( idRecibo )
    {

      var txt;
      if (confirm("Confirma o Estorno?")) 
      {
        var url = "{{route('recibolocatario.estornar')}}";

        var dados = { IMB_RLT_NUMERO : idRecibo };

        $.ajaxSetup(
        {
          headers:
          {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
          }
        });

        $.ajax(
          {
            url:url,
            dataType:'json',
            type:'post',
            data:dados,
            success:function( data )
            {
              alert('Estornado ');
              window.close();
            },
            error:function( data )
            {
              alert('Erro ao estornar');
            }

          }
        );
      }
      else
        alert('estorno cancelado!');





    }
  


</script>




@endpush