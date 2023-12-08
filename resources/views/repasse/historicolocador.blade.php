@extends('layout.app')
@section('scripttop')
<style>

.estornado
{
  text-decoration: line-through;
  color: red;
}

.dashed{
    text-decoration: overline underline line-through;
    color:#999;
}
.td-rigth
  {
    text-align:right;
  }

.totalprocesso
{
  color:blue;
}
.td-center
  {
    text-align:center;
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

<div class="portlet box blue" id="div-geral">
  <div class="portlet-title">
    <div class="caption" id="i-lbl-header-modalresumoparcelas">
      <i class="fa fa-gift"></i>
    </div>
  </div>
  <input type="hidden" id="i-chave">
  <div class="portlet-body form ">
    @php
      $historicos = app( 'App\Http\Controllers\ctrReciboLocador')->carregarHistorico( $idcontrato,'semjson' );
    @endphp
  

    <div class="row">
      <div class="col-md-12">
        <table  id="tblhistoricolocador" class="table-striped table-bordered table-hover" >
          <thead class="thead-dark">
            <tr>
              <th width="15%" style="text-align:center"> Ações </th>
              <th width="20%" style="text-align:center"> Locador </th>
              <th width="7%" style="text-align:center"> Vencimento </th>
              <th width="7%" style="text-align:center"> Pagamento </th>
              <th width="7%" style="text-align:center"> Nº Recibo </th>
              <th width="7%" style="text-align:center"> Valor Pago </th>
              <th width="30%" style="text-align:center"> Conta </th>
              <th width="7%" style="text-align:center"></th>
            </tr>
          </thead>
          <tbody>
          @foreach( $historicos as $registro)
              @php
                $classe='';
                if( $registro->IMB_RLD_DTHINATIVO == null )
                  $classe='x';
                else
                  $classe='estornado';
              @endphp
              <tr class="{{$classe}}">
                <td style="text-align:center" valign="center">
                <a title="Alterar data de Repasse" href="javascript:alterarDataRepasse({{$registro->IMB_RLD_NUMERO}})" class="btn btn-sm btn-warning"><span class="fa fa-pencil"></span></a> 
                <a href="javascript:cargaHistDet({{$registro->IMB_RLD_NUMERO}})" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-zoom-in"></span></a> 
                <a href="javascript:verRecibo({{$registro->IMB_RLD_NUMERO}})" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-print"></span></a> 
                  <a title="Estornar o recibo" href="javascript:estornarRecibo({{$registro->IMB_RLD_NUMERO}})" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span></a> 
                </td>
                <td class="td-center">{{$registro->IMB_CLT_NOME}}</td>
                <td class="td-center">{{date( 'd/m/Y', strtotime( $registro->IMB_RLD_DATAVENCIMENTO))}}</td>
                <td class="td-center">{{date( 'd/m/Y', strtotime( $registro->IMB_RLD_DATAPAGAMENTO))}}</td>
                <td class="td-center">{{ $registro->IMB_RLD_NUMERO}}</td>
                <td class="td-rigth">{{ number_format( $registro->TOTAL,2,',','.')}}</td>
                <td class="td-center">{{$registro->FIN_CCX_DESCRICAO}}</td>
                <td class="td-center"><i title="O valor total para o vencimento {{date( 'd/m/Y', strtotime( $registro->IMB_RLD_DATAVENCIMENTO))}} foi de R$ {{ number_format( $registro->TOTALPROCESSO,2,',','.')}}, pago pela conta {{$registro->FIN_CCX_DESCRICAO}}" class="fa fa-exclamation-circle" aria-hidden="true"></i></td>

              </tr>

            @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@include(' layout.modaldata')
@include( 'layout.modalhistlddet')
@endsection      

@push('script')

<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>


<script>
  $( document ).ready(function() 
  {
    $("#sirius-menu").click();
//    cabecalhoContrato( $("#IMB_CTR_ID").val() );

  });

  function cabecalhoContrato( idcontrato )
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
        }
      }
    )

  }

  function cargaHistorico( idcontrato )
  {

    url = "{{route('recibolocador.carregarHistorico.puro')}}/"+idcontrato;

    $.ajax(
      {
        url       : url,
        type      : 'get',
        dataType  : 'json',
        async:false,
        success   : function( data )
        {

          linha = "";
          $("#tblhistoricolocador>tbody").empty();
          for( nI=0;nI < data.length;nI++)
          {
            var datavencimento  = moment( data[nI].IMB_RLD_DATAVENCIMENTO).format('DD/MM/YYYY');
            var datapagamento   = moment( data[nI].IMB_RLD_DATAPAGAMENTO).format('DD/MM/YYYY');
            var datainativo   = moment( data[nI].IMB_RLD_DTHINATIVO).format('DD/MM/YYYY');
            
            var valor = parseFloat( data[nI].TOTAL );
            var valorpro = parseFloat( data[nI].TOTALPROCESSO );
            valor = formatarBRSemSimbolo( valor );
            valorpro = formatarBRSemSimbolo( valorpro );
            if( datainativo == 'Invalid date' )
              classe=''
            else
              classe='estornado';
            

              linha = '<tr class="'+classe+'">'+ 
                    '<td style="text-align:center" valign="center"> '+
                      '<a href=javascript:verRecibo('+data[nI].IMB_RLD_NUMERO+') class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-zoom-in"></span></a> '+
                      '<a title="Estornar o recibo" href=javascript:estornarRecibo('+data[nI].IMB_RLD_NUMERO+') class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span></a> '+
                    '</td> '+
                    '<td class="td-center">'+data[nI].IMB_CLT_NOME+'</td>' +
                    '<td class="td-center">'+datavencimento+'</td>' +
                    '<td class="td-center">'+datapagamento+'</td>' +
                    '<td class="td-center">'+data[nI].IMB_RLD_NUMERO+'</td>' +
                    '<td class="td-rigth">'+valor+' </td>' +
                    '<td class="td-center">'+data[nI].FIN_CCX_DESCRICAO+'</td>' +
                    '<td class="td-rigth"><i title="O valor total para este contrato e para o vencimento '+datavencimento+' foi de R$ '+valorpro+'" class="fa fa-exclamation-circle" aria-hidden="true"></i></td>' +
                  '</tr>';
            $("#tblhistoricolocador").append( linha );
          } 
        }
      });          
      $("#div-carregagando").hide();
      $("#div-geral").show();
      

    }

    function verRecibo( idrecibo )
    {
      window.location = "{{route('recibolocador.imprimir')}}/"+idrecibo+'/S ';
    }
  

    function estornarRecibo( idRecibo )
    {

      var txt;
      if (confirm("Confirma o Estorno?")) 
      {
        var url = "{{route('recibolocador.estornar')}}";

        var dados = { IMB_RLD_NUMERO : idRecibo };

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
              alert( 'Já estornado!!' );
            }

          }
        );
      }
      else
        alert('estorno cancelado!');





    }
  
    function alterarDataRepasse( id )
    {
      $("#i-tipo-alteracao-data").val('recibolocador');
      $("#i-numero-recibo").val(id);
      $("#modaldata").modal('show');

    }

</script>




@endpush