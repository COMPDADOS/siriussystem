<div class="modal fade" id="modalrenovar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog "style="width:95%;" >
    <div class="modal-content">
      <div class="modal-body">
        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption" id="i-endereco-renovacao">
              <i class="fa fa-gift"></i>
            </div>
          </div>

          <div class="portlet-body form">
            <div class="row">
              <input type="hidden" id="i-ctr-id-renovacao">
              <hr>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="col-md-2">
                  <input type="hidden" id="IMB_CTR_FORMAREAJUSTE-renovacao">
                  <label class="control-label">Duração</label>
                  <input class="form-control" type="number" id="IMB_CTR_DURACAO-renovacao" >
                </div>
                
                <div class="col-md-2">
                  <label class="control-label">Início Contrato</label>
                  <input class="form-control" type="date" id="IMB_CTR_INICIO-renovacao" >
                </div>
                <div class="col-md-2">
                  <label class="control-label">Término Contrato</label>
                  <input class="form-control" type="date" id="IMB_CTR_TERMINO-renovacao" >
                </div>
                <div class="col-md-2">
                  <label class="control-label">Próx. Reajuste</label>
                  <input class="form-control" type="date" id="IMB_CTR_DATAREAJUSTE-renovacao" >
                </div>
                <div class="col-md-4">
                  <label class="control-label">Valor R$</label>
                  <input class="form-control valor" type="text" id="IMB_CTR_VALORALUGUEL-renovacao" readonly>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 div-direita">
                    <button class="btn btn-success" onClick="confirmarRenovacao()">Confirmar Renovação</button>
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
</div>


@push('script')
<script>


function realizarRenovacao( id )
{

  $("#IMB_CTR_INICIO-renovacao").blur( function()
    {
      calcularTerminoContrato();
      calcularProximoReajuste();

    })
    $("#IMB_CTR_DURACAO-renovacao").blur( function()
    {
      calcularTerminoContrato();
      calcularProximoReajuste();

    })
    var url = "{{route('renovar.realizar')}}";
    $("#i-ctr-id-renovacao").val( id );

    var dados =
    {
        IMB_CTR_ID : id,
        valordigitado: $("#i-valordigitado").val(),
    }

    $.ajaxSetup({
            headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
    });

    $.ajax(
        {
            url     : url,
            dataType:'json',
            type:'post',
            data:dados,
            async:false,
            success:function(data)
            {
                debugger;
                if( data[0].pasta === null )
                    pasta = ''
                else
                    pasta = data[0].pasta+' ';

                $("#i-endereco-renovacao").html( pasta+data[0].endereco);
                $("#IMB_CTR_DATAREAJUSTE-renovacao").val(  moment(data[0].IMB_CTR_DATAREAJUSTE).format('YYYY-MM-DD'));
                $("#IMB_CTR_INICIO-renovacao").val(  moment(data[0].IMB_CTR_INICIO).format('YYYY-MM-DD'));
                $("#IMB_CTR_TERMINO-renovacao").val(  moment(data[0].IMB_CTR_TERMINO).format('YYYY-MM-DD'));
                $("#IMB_CTR_DURACAO-renovacao").val(  data[0].IMB_CTR_DURACAO );
                $("#IMB_CTR_FORMAREAJUSTE-renovacao").val(  data[0].IMB_CTR_FORMAREAJUSTE );
                $("#IMB_CTR_VALORALUGUEL-renovacao").val( formatarBRSemSimbolo( parseFloat(data[0].IMB_CTR_VALORALUGUEL ) ) );
                $("#modalrenovar").modal('show');
                calcularTerminoContrato();
                calcularProximoReajuste();
                console.log( data );



            },
            error:function( data )
            {
                alert( 'Índice não encontrado' );
            },
            complete:function( data )
            {
              debugger;
              console.log( data );
            }
        }
    );

}

function confirmarRenovacao()
{
    var url = "{{route('renovar.confirmar')}}";

    var dados =
    {
        id :$("#i-ctr-id-renovacao").val(),
        IMB_CTR_DURACAO : $("#IMB_CTR_DURACAO-renovacao").val(),
        IMB_CTR_INICIO :  $("#IMB_CTR_INICIO-renovacao").val(),
        IMB_CTR_TERMINO :  $("#IMB_CTR_TERMINO-renovacao").val(),
        IMB_CTR_DATAREAJUSTE: $("#IMB_CTR_DATAREAJUSTE-renovacao").val(),
        IMB_CTR_VALORALUGUEL :  realToDolar( $("#IMB_CTR_VALORALUGUEL-renovacao").val()),
    }
    $.ajaxSetup({
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
            success:function()
            {
                alert('Confirmado');
                $("#modalrenovar").modal('hide');
                $( "#form-carga" ).submit();

            }
        }
    )


}

function calcularTerminoContrato()
    {
      debugger; 
      var dAnt = $("#IMB_CTR_INICIO-renovacao").val();
      var dFormatado = moment(dAnt).format("M-D-YYYY");

      var date = new Date( dFormatado );
      var mes = date.getMonth();


      var duracao = parseInt($("#IMB_CTR_DURACAO-renovacao").val());
	    //crio uma nova váriavel com a nova data, Date(ano, mes(soma da variavel enviada para o metodo + o mes atual, dia que eu coloquei padrão para 1
      var n_date = date.setMonth( mes + duracao )-1;
      n_date = moment( n_date ).format( 'YYYY-MM-DD');

      if ( n_date=='Invalid date') n_date='';
      $("#IMB_CTR_TERMINO-renovacao").val( n_date );
      calcularProximoReajuste();

    }

    function calcularProximoReajuste()
    {

      debugger;
      var dAnt = $("#IMB_CTR_INICIO-renovacao").val();
      var dFormatado = moment(dAnt).format("M-D-YYYY");

      var date = new Date( dFormatado );
      var mes = date.getMonth();

      var duracao = parseInt($("#IMB_CTR_FORMAREAJUSTE-renovacao").val());
	    //crio uma nova váriavel com a nova data, Date(ano, mes(soma da variavel enviada para o metodo + o mes atual, dia que eu coloquei padrão para 1
      var n_date = date.setMonth( mes + duracao );
      n_date = moment( n_date ).format( 'YYYY-MM-DD');

      if ( n_date=='Invalid date') n_date='';
      $("#IMB_CTR_DATAREAJUSTE-renovacao").val( n_date );

    }


</script>


@endpush
