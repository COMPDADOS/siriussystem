@extends('meuimovel.meusimoveismenu')
@section( 'scripttop')
<style>
    .encerrado
    {
        color:white;
        background:red;
    }
    .ativo
    {
        color:white;
        background:blue;
    }
    .div-center
    {
        text-align:text;
    }

    .td-rigth
    {
        text-align:right;
    }

</style>
@endsection


@section('content')


<div class="row">
    <div class="col-lg-12">
        <div class="card m-t-35">
            <div class="card-header bg-white">
                Meus Contratos
            </div>
            <div class="card-body">
                <div class="table-responsive m-t-35">
                    <table class="table  table-striped">
                        <thead>
                            <tr>
                                <th width="5%" ></th>
                                <th width="5%" ></th>
                                <th width="5%" ></th>
                                <th width="10%" ># Contrato</th>
                                <th width="30%" >Endereço</th>
                                <th width="20%" >Bairro</th>
                                <th width="5%" >Dia Vencto</th>
                                <th width="10%" >Inicio</th>
                                <th width="10%" >Duraçao</th>
                                <th width="10%" >Próximo Reajuste</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $contratos as $contrato )
                            <tr>
                                <td><button class="btn btn-primary" onClick="dadosContrato({{$contrato->IMB_CTR_ID}})">Dados</button></td>
                                <td><button class="btn  btn-dark" onClick="boletos({{$contrato->IMB_CTR_ID}})">Boletos</button></td>
                                <td><button class="btn  btn-success" onClick="cargaHistorico({{$contrato->IMB_CTR_ID}})">Extrato</button></td>
                                <td>{{$contrato->IMB_CTR_REFERENCIA}}</td>
                                <td>{{$contrato->ENDERECO}}</td>
                                <td>{{$contrato->CEP_BAI_NOME}}</td>
                                <td>{{$contrato->IMB_CTR_DIAVENCIMENTO}}</td>
                                <td>{{date_format( date_create($contrato->IMB_CTR_INICIO),'d/m/Y')}}</td>
                                <td>{{$contrato->IMB_CTR_DURACAO}}Meses</td>
                                <td>{{date_format( date_create($contrato->IMB_CTR_DATAREAJUSTE),'d/m/Y')}}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-contratos" tabindex="-1" role="dialog" aria-labelledby="modalLabel"aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-md-12 div-center">
                    <h4>Dados do Contrato</h4>
                </div>
            </div>
            <div class="modal-body">
            <div class="row">
                    <div class="col-md-2" >
                        <p id="status"><input class="form-control" type="text" id="IMB_CTR_SITUACAO" readonly></p>
                    </div>
                    <div class="col-md-2">
                        <label class="label-control" >Inicio</label>
                        <input class="form-control" type="text" id="IMB_CTR_INICIO" readonly>
                    </div>
                    <div class="col-md-2">
                        <label class="label-control" >Término</label>
                        <input class="form-control" type="text" id="IMB_CTR_TERMINO" readonly>
                    </div>
                    <div class="col-md-1">
                        <label class="label-control" >Duração</label>
                        <input class="form-control" type="text" id="IMB_CTR_DURACAO" readonly>Meses
                    </div>
                    <div class="col-md-2">
                        <label class="label-control" >Próx.Reajuste</label>
                        <input class="form-control" type="text" id="IMB_CTR_DATAREAJUSTE" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="label-control" >Índice de Reajuste</label>
                        <input class="form-control" type="text" id="IMB_IRJ_NOME" readonly>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-2" >
                    </div>
                    <div class="col-md-2">
                        <label class="label-control" >Valor Aluguel</label>
                        <input class="form-control" type="text" id="IMB_CTR_VALORALUGUEL" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="label-control" >Desconto Até Vencimento</label>
                        <label id="i-tipo-bon-real"></label>
                        <input class="form-control" type="text" id="IMB_CTR_VALORBONIFICACAO4" readonly>
                        <label id="i-tipo-bon-perc"></label>
                    </div>
                    <div class="col-md-2">
                        <label class="label-control" >Próximo Vencto.</label>
                        <input class="form-control" type="text" id="IMB_CTR_VENCIMENTOLOCATARIO" readonly>
                    </div>
                    <div class="col-md-3 div-center">
                        <p></p>
                        <button class="btn btn-primary form-control"  onClick="fecharModals()">OK</button>
                    </div>
                </div>
                <div class="row div-center">
                    <span class="ativo" ID="i-emdia"></span>
                </div>
                <div class="row div-center">
                    <span class="encerrado"id="i-ematraso"></span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalboletos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:100%;" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Boletos em Aberto</h5>
      </div>
      <div class="modal-body">
          <table  id="i-boletos" class="table table-striped table-bordered table-hover" >
            <thead class="thead-dark">
                <tr >
                    <th style="text-align:center"> Data Vencimeto</th>
                    <th style="text-align:center"> Valor </th>
                    <th width="50" style="text-align:center"> Ações </th>       
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onClick="fecharModals()">fechar</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modalhistoricolt" tabindex="-1" role="dialog" 
            aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:100%;" >
        <div class="modal-content">
            <div class="modal-header">
            <h3 class="modal-title div-center" id="exampleModalLabel"> Extrato de Pagamento</h3>
                <p><h5 class="modal-title div-center" id="exampleModalLabel">Histórico de Pagamentos</h3></p>
                <button type="button" class="btn btn-dark" data-dismiss="modal" aria-label="Close" onClick="fecharModals()">Fechar
                    <span aria-hidden="true">&times;</span>                
                </button>
            </div>
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption" id="i-lbl-header-modalresumoparcelas">
                            <i class="fa fa-gift"></i>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="row">
                            <div class="col-md-12">
                                <table  id="tblhistorico" class="table-striped table-bordered table-hover" >
                                    <thead class="thead-dark">
                                        <tr>
                                            <th width="15%" style="text-align:center"> Vencimento </th>
                                            <th width="15%" style="text-align:center"> Pagamento </th>
                                            <th width="20%" style="text-align:center"> Nº Recibo </th>
                                            <th width="15%" style="text-align:center"> Valor Pago </th>
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


@endsection

@push('script')
    <script>
        function dadosContrato( id )
        {
            var dados = { id : id };

            var url = "{{route('meuimovel.dadoscontrato')}}";
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

                        var classe='';

                        $("#i-emdia").html('');
                        $("#i-ematraso").html('');

                        if( data.IMB_CTR_SITUACAO == 'ENCERRADO' ) classe='class="encerrado"';
                        if( data.IMB_CTR_SITUACAO == 'ATIVO' ) classe='class="ativo"';
                        console.log( data.IMB_CTR_VALORALUGUEL);
                        var valor = data.IMB_CTR_VALORALUGUEL;
                        valor = parseFloat( valor);
                        valor = 'R$ '+formatarBRSemSimbolo( valor );
                        
                        var valorbon = data.IMB_CTR_VALORBONIFICACAO4;
                        valorbon = parseFloat( valorbon);
                        valorbon =formatarBRSemSimbolo( valorbon );
                        if( valorbon == 'NaN' ) valorbon = '';
                                                

                        var tipo = data.IMB_CTR_BONIFICACAOTIPO;

                        if( tipo == 'P') valorbon = valorbon+' %';
                        if( tipo == 'V') valorbon = 'R$ '+valorbon;

                        $("#status").html( '<span '+classe+'>'+data.IMB_CTR_SITUACAO+'</span>');
                        $("#IMB_CTR_INICIO").val( moment( data.IMB_CTR_INICIO).format('DD/MM/YYYY'));
                        $("#IMB_CTR_TERMINO").val( moment( data.IMB_CTR_TERMINO).format('DD/MM/YYYY'));
                        $("#IMB_CTR_DURACAO").val( data.IMB_CTR_DURACAO);
                        $("#IMB_CTR_DATAREAJUSTE").val( moment( data.IMB_CTR_DATAREAJUSTE).format('DD/MM/YYYY'));
                        $("#IMB_IRJ_NOME").val( data.IMB_IRJ_NOME);
                        $("#IMB_CTR_VALORALUGUEL").val( valor ) ;
                        $("#IMB_CTR_VALORBONIFICACAO4").val( valorbon ) ;
                        $("#IMB_CTR_VENCIMENTOLOCATARIO").val( moment( data.IMB_CTR_VENCIMENTOLOCATARIO).format('DD/MM/YYYY'));
                        if(moment().isBefore(data.IMB_CTR_VENCIMENTOLOCATARIO))
                            $("#i-emdia").html("Parabéns, você está em dia com seus pagamentos")
                        else
                            if(moment().isAfter(data.IMB_CTR_VENCIMENTOLOCATARIO))
                            $("#i-ematraso").html("Vocês está em atraso com seu pagamento")
                        
                        $("#modal-contratos").modal('show');
                    }
                }
            );
        }
        function fecharDadosContrato()
        {
            $("#modal-contratos").modal('hide');
        }

        function boletos( id )  
    {
        var url = "{{route('meuimovel.boletos')}}/"+id;
        console.log( url );

        $.ajax(
            {
                url : url,
                dataType:'json',
                type:'get',
                success:function( data )
                {
                    linha = "";
                    $("#i-boletos>tbody").empty();
                    for( nI=0;nI < data.length;nI++)
                    {
                        var valor = parseFloat(data[nI].IMB_CGR_VALOR);
                        valor = formatarBRSemSimbolo(valor);

                        linha = 
                            '<tr>'+
                            '<td style="text-align:center valign="center">'+moment(data[nI].IMB_CGR_DATAVENCIMENTO).format('DD/MM/YYYY')+'</td>' +
                            '<td style="text-align:center valign="center">R$ '+valor+'</td>' +
                            '<td style="text-align:center" valign="center"> '+
                                '<a title="Download" href=javascript:imprimir('+data[nI].IMB_CGR_ID+','+data[nI].FIN_CCI_BANCONUMERO+') class="btn btn-sm btn-primary"><i class="fa fa-barcode" aria-hidden="true"></i>Boleto</a> '+
                            '</td> '+
                            '</tr>';
                    
                        $("#i-boletos").append( linha );
                        $("#modalboletos").modal('show');
                    }

                }
            }
        )



    }

    function imprimir( id, banco )
    {
        var imb_id = $("#i-imb_imb_id").val();

        if( banco == 748 )
            window.location = "{{route('boleto.748')}}/"+id+'/N/X';

        if( banco == 756 )
            window.location = "{{route('boleto.756')}}/"+id+'/N/X';

        if( banco == 237 )
            window.location = "{{route('boleto.237')}}/"+id+'/N/X';

        if( banco == 1 )
            window.location = "{{route('boleto.001')}}/"+id+'/N/X';

        if( banco == 33 )
            window.open("{{route('boleto.santander')}}/"+id+'/N/X', '_blank');

        if( banco == 341 )
            window.location = "{{route('boleto.cliente.341')}}/"+id+'/'+banco;

    }            

    function cargaHistorico( idcontrato )
  {

    url = "{{route('meuimovel.historicoslt')}}/"+idcontrato;
    console.log( url );

    $.ajax(
      {
        url       : url,
        type      : 'get',
        dataType  : 'json',
        success   : function( data )
        {

            if( data.length == 0 ) 
            {
                alert('Nada encontrato' );
                return false;
            }
        
          linha = "";
          $("#tblhistorico>tbody").empty();
          for( nI=0;nI < data.length;nI++)
          {
            var datavencimento  = moment( data[nI].IMB_RLT_DATACOMPETENCIA).format('DD/MM/YYYY');
            var datapagamento   = moment( data[nI].IMB_RLT_DATAPAGAMENTO).format('DD/MM/YYYY');
            var valor = parseFloat( data[nI].TOTAL );
            valor = formatarBRSemSimbolo( valor );

            linha = '<tr>'+ 
                    '<td class="div-center">'+datavencimento+'</td>' +
                    '<td class="div-center">'+datapagamento+'</td>' +
                    '<td class="div-center">'+data[nI].IMB_RLT_NUMERO+'</td>' +
                    '<td class="td-rigth"> R$ '+valor+' </td>' +
                  '</tr>';
            $("#tblhistorico").append( linha );
            $("#modalhistoricolt").modal( 'show');
          } 
        }
      });          
    }

    function fecharModals()
    {
        $("#modalhistoricolt").modal( 'hide');
        $("#modal-contratos").modal( 'hide');
        $("#modalboletos").modal( 'hide');
                
        
    }

    </script>


@endpush




