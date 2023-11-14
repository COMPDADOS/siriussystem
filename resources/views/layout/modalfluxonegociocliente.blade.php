<div class="modal fade" id="modalrastrearatendimentocliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog "style="width:90%;" >    
    <div class="modal-content ">
      <div class="modal-body">
        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption">
              <i class="fa fa-gift"></i>Fluxo do Atendimento do Cliente 
            </div>
          </div>
      
          <div class="portlet-body form">
            <input type="hidden" id="id_cliente_rastrear">
            <div class="row">
              <div class="col-md-12" >
                <h3 id="lblsobreatd" class="barra-titulo"><u>Sobre os Atendimento a Este Cliente</u></h3>
                <div class="col-md-3 escondido div-center" id="div-atendimentoinicio">
                  <h4  id="i-nome-primeiro-atendimento"></h4>
                  <img class="img-100px" src="https://www.redentora-miami.com.br/sys/storage/images/1/usuarios/avatar1.jpg" alt="">
                  <h4  id="i-data-primeiro-atendimento"></h4>
                </div>
                <div class="col-md-9">
                  <table class="table table-bordered table-striped" id="tablerastreioatendimento">
                    <thead>
                        <th>Data/Hora</th>
                        <th>observaçao</th>
                        <th>status</th>
                        <th>Prioridade</th>
                    </thead>
                  </table>

                  
                  
                </div>
              </div>
            </div>
            <div class="col-md-12 escondido" id="div-locatariocontrato">
              <h3 class="barra-titulo"><u>Sobre o(s) Contrato(s) como <b>Locatário</b></u></h3>
              <table class="table table-bordered table-striped" id="tablelocatariocontrato">
                <thead>
                  <th>Data Locação</th>
                  <th>Pasta</th>
                  <th>Imóvel</th>
                  <th>Valor Aluguel</th>
                  <th>Situação</th>
                </thead>
              </table>
            </div>            
          </div>
          <div class="col-md-12 escondido" id="div-fiadorcontrato">
            <h3 class="barra-titulo"><u>Sobre o(s) Contrato(s) como <b>Fiador</b></u></h3>
            <table class="table table-bordered table-striped" id="tablefiadorcontrato">
              <thead>
                <th>Data Locação</th>
                <th>Pasta</th>
                <th>Imóvel</th>
                <th>Valor Aluguel</th>
                <th>Situação</th>
              </thead>
            </table>
          </div>            
          <div class="col-md-12 escondido" id="div-locador-imovel">
            <h3 class="barra-titulo"><u>Sobre o(s) Imóveis(s) como <b>Proprietário</b></u></h3>
            <table class="table table-bordered table-striped" id="tableproprietario">
              <thead>
                <th>Dt. Entrada</th>
                <th>#Imóvel</th>
                <th>Endereço</th>
                <th>Bairro</th>
                <th>Condomínio</th>
                <th>Status</th>
              </thead>
            </table>
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


@push('script')
<script>

function rastrearAtendimentoCliente( id )
{

  var url = "{{route('atendimento.primeiroatendimentocliente')}}/"+id;

  $.ajax( 
    {
      url : url,
      dataType:'json',
      type:'get',
      async:false,
      success:function(data)
      {
        $("#id_cliente_rastrear").val( id);
        $("#div-atendimentoinicio").show();
        $("#i-data-primeiro-atendimento").html('Atendimento Em: '+moment( data.IMB_CLA_DATACADASTRO).format('DD/MM/YYYY') );
        $("#i-nome-primeiro-atendimento").html('Atendido por  : '+data.IMB_ATD_NOME );
        $("#lblsobreatd").html( "Sobre os Atendimento a Este Cliente");
        $("#lblsobreatd").css( 'background-color', '#007399' );
        
        buscarAtendimentosCliente( id);
      },
      error:function()
      {
        $("#id_cliente_rastrear").val('');
        $("#div-atendimentoinicio").hide();
        $("#lblsobreatd").html( "Este cliente não teve  pré-atendimento");
        $("#lblsobreatd").css( 'background-color', 'red' );
        $("#tablerastreioatendimento>tbody").empty();
        $("#tablerastreioatendimento").hide();

      }
    }
  )

  $("#id_cliente_rastrear").val( id );
  $("#modalrastrearatendimentocliente").modal('show');

  buscarContratosLocacao( id );
  buscarContratosFiador( id );
  buscarImoveisLocador( id );

}

function buscarAtendimentosCliente( idcliente)
{
  var url = "{{route('listaratendimentos')}}";
  $("#tablerastreioatendimento").show();
  dados = { idcliente:idcliente };
  $.ajax(
    {
      url:url,
      dataType:'json',
      type:'get',
      async:false,
      data:dados,
      success:function( data )
      {
        linha = "";
        $("#tablerastreioatendimento>tbody").empty();
        for( nI=0;nI < data.data.length;nI++)
        {
          if( data.data[nI].IMB_ATD_ID != null )
          {
            linha = 
              '<tr>' +
              '<td style="text-align:center valign="center">'+moment(data.data[nI].IMB_CLA_DATAATENDIMENTO).format( 'DD/MM/YYYY HH:MM')+'</td>' +
              '<td style="text-align:center valign="center">'+data.data[nI].IMB_CLA_COMENTARIO+'</td>' +
              '<td style="text-align:center valign="center">'+data.data[nI].IMB_CLA_STATUS+'</td>' +
              '<td style="text-align:center valign="center">'+data.data[nI].VIS_PRI_NOME+'</td>' +
              '</tr>';
            $("#tablerastreioatendimento").append( linha );
            }
        }
        
      },
      error:function()
      {
        $("#tablerastreioatendimento>tbody").empty();

      }
    }
  )

}

function buscarContratosLocacao( id )
{
  
  var url = "{{route('locatariocontrato.contratosdolocatario')}}/"+id;
  console.log(url);

  $.ajax(
    {
      url:url,
      dataType:'json',
      type:'get',
      async:false,
      success:function( data )
      {
        $("#div-locatariocontrato").show();
        linha = "";
        $("#tablelocatariocontrato>tbody").empty();
        for( nI=0;nI < data.length;nI++)
        {
            var dataresc = data[nI].IMB_CTR_DATARESCISAO;
            if( dataresc === null ) dataresc = '-';
            linha = 
              '<tr>' +
              '<td style="text-align:center valign="center">'+moment(data[nI].IMB_CTR_INICIO).format( 'DD/MM/YYYY')+'</td>' +
              '<td style="text-align:center valign="center">'+data[nI].IMB_CTR_REFERENCIA+'</td>' +
              '<td style="text-align:center valign="center">'+data[nI].ENDERECO+'</td>' +
              '<td style="text-align:center valign="center">'+formatarBRSemSimbolo(parseFloat( data[nI].IMB_CTR_VALORALUGUEL ))+'</td>' +
              '<td style="text-align:center valign="center">'+data[nI].IMB_CTR_SITUACAO+'</td>' +
              '<td style="text-align:center valign="center">'+dataresc+'</td>' +
              '</tr>';
            $("#tablelocatariocontrato").append( linha );
        }
      },
      error:function( )
      {
        $("#div-locatariocontrato").hide();
      }
    })
    

}

function buscarContratosFiador( id )
{
  
  var url = "{{route('fiadorcontrato.contratosdofiador')}}/"+id;

  $.ajax(
    {
      url:url,
      dataType:'json',
      type:'get',
      async:false,
      success:function( data )
      {
        $("#div-fiadorcontrato").show();
        linha = "";
        $("#tablefiadorcontrato>tbody").empty();
        for( nI=0;nI < data.length;nI++)
        {
            var dataresc = data[nI].IMB_CTR_DATARESCISAO;
            if( dataresc === null ) dataresc = '-';
            linha = 
              '<tr>' +
              '<td style="text-align:center valign="center">'+moment(data[nI].IMB_CTR_INICIO).format( 'DD/MM/YYYY')+'</td>' +
              '<td style="text-align:center valign="center">'+data[nI].IMB_CTR_REFERENCIA+'</td>' +
              '<td style="text-align:center valign="center">'+data[nI].ENDERECO+'</td>' +
              '<td style="text-align:center valign="center">'+formatarBRSemSimbolo(parseFloat( data[nI].IMB_CTR_VALORALUGUEL ))+'</td>' +
              '<td style="text-align:center valign="center">'+data[nI].IMB_CTR_SITUACAO+'</td>' +
              '<td style="text-align:center valign="center">'+dataresc+'</td>' +
              '</tr>';
            $("#tablefiadorcontrato").append( linha );
        }
      },
      error:function( )
      {
        $("#div-fiadorcontrato").hide();
      }
    
    })
    
  }

  function buscarImoveisLocador( id )
{
  
  var url = "{{route('proprietario.imoveis')}}/"+id;

  $.ajax(
    {
      url:url,
      dataType:'json',
      type:'get',
      async:false,
      success:function( data )
      {
        $("#div-locador-imovel").show();
        linha = "";
        $("#tableproprietario>tbody").empty();
        for( nI=0;nI < data.length;nI++)
        {
           debugger;
            condominio = data[nI].CONDOMINIO;
            if( condominio === null ) condominio = '-';
            classe="font-black";

            if( data[nI].VIS_STA_NOME == 'Suspenso') classe = classe + ' font-riscado';
            linha = 
            '<tr class="'+classe+'">' +
              '<td style="text-align:center valign="center">'+moment(data[nI].IMB_IMV_DATACADASTRO).format( 'DD/MM/YYYY')+'</td>' +
              '<td style="text-align:center valign="center">'+data[nI].IMB_IMV_ID+'</td>' +
              '<td style="text-align:center valign="center">'+data[nI].ENDERECO+'</td>' +
              '<td style="text-align:center valign="center">'+data[nI].CEP_BAI_NOME+'</td>' +
              '<td style="text-align:center valign="center">'+condominio+'</td>' +
              '<td style="text-align:center valign="center">'+data[nI].VIS_STA_NOME+'</td>' +
              '</tr>';
            $("#tableproprietario").append( linha );        
        }
      },
      error:function( )
      {
        $("#div-locador-imovel").hide();
      }
    
    })
    
  }


</script>


@endpush

