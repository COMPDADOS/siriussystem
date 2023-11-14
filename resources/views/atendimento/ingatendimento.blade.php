@extends('layout.app')
@section('scripttop')
<style>
H3 {
    text-align: center;
    font-size: 20px;
    font-weight: bold;
  }

.div-center {
    text-align: center;
  }

.escondido {
  display: none;
}

.backgrey
{
  background-color:#edeeee;
}

.input-8 {
  font-size: 12px;
}

.font-14 {
  font-size: 14px;
}

.font-azul
{
  color:blue;
}
.semperfil
{
  background-color: red;
  color:white;
}
.comperfil
{
  background-color: orange;
  color:black;
}
.footer {
  position: fixed;
  bottom: 0;
  width: 85%;
  height: 50px;
  background:#e0ebeb;
}

.botao-confirmacao
{
  width: 200px;
  height: 70px;
  font-size: 20px;
}

</style>
@endsection

@push('script')

@section('content')


<!-- BEGIN CONTENT -->
<div class="row">
  <div class="col-md-12">
    <div class="tabbable-line boxless tabbable-reversed">
      <div class="tab-content">
        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Novo Atendimento
            </div>

            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
            </div>
          </div>

          <div class="portlet-body form">
            <div class="form-body">
              <div class="backgrey">
                <div class="row">
                  <div class="col-md-12">
                    <div class="portlet box green">
                      <div class="portlet-title">
                        <div class="caption">
                          <i class="fa fa-gift"></i>Dados do Cliente
                        </div>
                        <div class="tools">
                          <a href="javascript:;" class="collapse"> </a>
                        </div>
                      </div>
                      <input type="hidden" id="IMB_CLT_ID">
                      <input type="hidden" id="IMB_CLA_IDRETORNO">
                      <input type="hidden" id="i-clienter-quer">
                      <input type="hidden" id="i-outrocorretor">

                      <div class="portlet-body form">
                        <div class="col-md-2">
                          <label class="control-label">Telefone (I)</label>
                          <input type="text" class="form-control telefone input-8" id="i-telefone1" onchange="procurarTelefone( this,1)" >
                          <label class="control-label">Tipo</label>
                          <select class="form-control  input-8" id="i-telefone1-tipo">
                            <option value="Residencial">Residencial</option>
                            <option value="Comercial">Comercial</option>
                            <option value="Celular">Celular</option>
                            <option value="Whatsapp">Whatsapp</option>
                            <option value="Recado">Recado</option>
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label class="control-label">Nome do Cliente</label>
                          <input type="text" class="form-control input-8" id="IMB_CLT_NOME">
                          <button id="btn-perfil" class="btn btn-danger form-control" onClick="abrirPerfil()";>Informar perfil para o cliente</button>

                        </div>
                        <div class="col-md-2">
                          <label class="control-label">Telefone (II)</label>
                          <input type="text" class="form-control telefone  input-8" id="i-telefone2">
                          <label class="control-label">Tipo</label>
                          <select class="form-control  input-8" id="i-telefone2-tipo">
                            <option value="Residencial">Residencial</option>
                            <option value="Comercial">Comercial</option>
                            <option value="Celular">Celular</option>
                            <option value="Whatsapp">Whatsapp</option>
                            <option value="Recado">Recado</option>
                        </select>
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">Telefone (III)</label>
                          <input type="text" class="form-control telefone  input-8" id="i-telefone3" >
                          <label class="control-label">Tipo</label>
                          <select class="form-control  input-8" id="i-telefone3-tipo">
                            <option value="Residencial">Residencial</option>
                            <option value="Comercial">Comercial</option>
                            <option value="Celular">Celular</option>
                            <option value="Whatsapp">Whatsapp</option>
                            <option value="Recado">Recado</option>
                          </select>
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">Telefone (IV)</label>
                          <input type="text" class="form-control telefone  input-8" id="i-telefone4" >
                          <label class="control-label">Tipo</label>
                          <select class="form-control  input-8" id="i-telefone4-tipo">
                            <option value="Residencial">Residencial</option>
                            <option value="Comercial">Comercial</option>
                            <option value="Celular">Celular</option>
                            <option value="Whatsapp">Whatsapp</option>
                            <option value="Recado">Recado</option>
                          </select>
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Email</label>
                            <input class="form-control" type="email" id="i-email" placeholder="Mais de um email devem ser separados por ponto-e-vírgula">
                          </div>

                        <div class="row">
                        </div>
                      </div>
                    </div>

                    <div class="portlet box green" id="div-pretensao">
                      <div class="portlet-title">
                        <div class="caption">

                          <i class="fa fa-gift"></i>Pretensão
                        </div>
                        <div class="tools">
                          <a href="javascript:;" class="collapse"> </a>
                        </div>
                      </div>
                      <div class="portlet-body form">
                        <div class="form-body">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-check">
                                  <input class="form-check-input" type="radio"
                                    id="id-especifico" value="1" name="optradio" onchange="intencao(this)" checked>
                                      <label class="form-check-label" for="id-especifico">
                                            O cliente já sabe qual imóvel esta pretendendo.
                                      </label>
                                </div>
                                <div class="col-md-12" id="div-opcao-1">
                                  <div class="row">
                                    <div class="col-md-4">
                                      <input type="text" class="form-control" id="I-IMB_IMV_REFERE"  placeholder="Referência">
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-primary" onClick="procurarImovel()"><i class="fa fa-search"></i>Procurar o Imóvel</button>
                                    </div>
                                  </div>
                                </div>

                                <div class="form-check">
                                  <input class="form-check-input" type="radio"
                                      id="id-procura" value="2" name="optradio" onchange="intencao(this)">
                                      <label class="form-check-label" for="id-procura" >
                                      O cliente está procurando por um imóvel ou quer negociar um imóvel próprio.
                                      </label>
                                  <div class="col-md-12 escondido" id="div-opcao-2">
                                    <div class="row">
                                      <div class="col-md-4">
                                        <label class="control-label">Finalidade</label>
                                        <select class='form-control' id="i-select-finalidade">
                                          <option value=""></option>
                                          <option value="C">Comercial</option>
                                          <option value="O">Coporativo</option>
                                          <option value="I">Industrial</option>
                                          <option value="R">Residencial</option>
                                          <option value="U">Rural</option>
                                          <option value="T">Temporada</option>
                                        </select>
                                      </div>
                                      <div class="col-md-4">
                                        <label class="control-label">Tipo</label>
                                        <select class='form-control' id="i-select-tipoimovel"></select>
                                      </div>
                                      <div class="col-md-1">
                                      </div>

                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="col-md-4">
                                  <label class="control-label">Pretensão  </label>
                                  <select class='form-control' id="i-select-pretensao">
                                    <option value="">Escolha</option>
                                    <option value="Comprar">Comprar</option>
                                    <option value="Alugar">Alugar</option>
                                    <option value="Vender">Vender</option>
                                    <option value="Locar">Locar</option>
                                  </select>
                             
                              </div>                                    

                                <div class="col-md-4">
                                  <label class="control-label">Mídia Orígem</label>
                                  <select class="form-control font-8" id="i-select-midia">
                                  </select>
                                </div>
                                <div class="col-md-4">
                                  <label class="control-label">Corretor Selecionado</label>
                                  <select class="form-control font-8" id="i-select-corretor">
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="portlet box yellow" id="div-perfil">
                    <div class="portlet-title">
                      <div class="caption">
                        <i class="fa fa-gift"></i>Perfil Informado
                      </div>
                      <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                      </div>
                    </div>
                    <div class="portlet-body form">
                      <div class="form-body">
                        <div class="row">
                          @include( 'layout.tableperfilcliente')                    
                        </div>
                      </div>
                    </div>
                  </div>                  
                  <div class="portlet box green">
                    <div class="portlet-title">
                      <div class="caption">
                        <i class="fa fa-gift"></i>Atendimento(agendamento)
                      </div>
                      <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                      </div>
                    </div>
                    <div class="portlet-body form">
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="col-md-2">
                              <div class="input-group">
                              <input class="form-control "
                                      size="16" type="date" id="i-dataagenda"/>
                              </div>
                              <span class="help-block"> Data </span>
                            </div>
                            <div class="col-md-2">
                              <div class="input-group">
                                <input class="form-control "
                                      id="i-horaagenda"
                                      type="time" >
                                </span>
                              </div>
                              <span class="help-block"> Hora </span>
                            </div>
                            <div class="col-md-3">
                              <div class="input-group">
                                <select class="form-control" id="i-select-prioridade">
                                </select>
                              </div>
                              <span class="help-block"> Prioridade </span>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group last">
                              <label  class="control-label col-md-2"> ** Descrição **</label>
                              <div class="col-md-10">
                                <textarea name="content" rows="5" data-width="600" class="form-control" id="i-observacoes"></textarea>
                                <span class="help-block"> Descreva acima mais informações sobre este atendimento </span>
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
          <div class="row">
            <div class="col-md-12">
              <div class="footer">
                <div class="form-actions div-center">
                    <button type="button" class="btn default botao-confirmacao " id="i-btn-cancelar" onClick="javascript:window.close();">Cancelar</button>
                    <button type="button" class="btn blue botao-confirmacao" id="i-btn-gravar-agenda" onClick="gravarAtendimento()">
                      <i class="fa fa-check"></i> Gravar
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <div>
      </div>
    </div>
  </div>
</div>


@include( 'layout.modalperfil')
@include( 'layout.modaltelefonejacadastrado')
@include( 'layout.modalpesquisarimoveis')
@include( 'layout.clienterapido')
@include('layout.modalpesquisacliente')

@endsection
@push('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('/js/jquery-ui-timepicker-addon.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/i18n/jquery-ui-timepicker-addon-i18n.min.js')}}"></script>

<script>
$( document ).ready(function()
{
  preencherCidades();

  $("#IMB_CLT_NOME").focus(function()
  {
    $("#btn-perfil").show();
    if( $("#i-telefone1").val() == '' ) 
    {
      $( "#IMB_CLT_NOME" ).prop( "disabled", true );
      $("#btn-perfil").hide();
    }
    
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


  $( "#i-select-cidade" ).change(function() 
  {
    preencherBairros( $('#i-select-cidade').val());
  });    

  
  $('#i-telefone2').click(function()
  {
    if($('#i-telefone1').val() == '' )
    {
        alert('Informe primeiramente o campo do telefone I');
        $('#i-telefone1').focus();


    }
  });

  $('#i-telefone3').click(function()
  {
    if($('#i-telefone2').val() == '' )
    {
        alert('Informe primeiramente o campo do telefone II');
        $('#i-telefone2').focus();


    }
  });


  $('#i-telefone4').click(function()
  {
    if($('#i-telefone3').val() == '' )
    {
        alert('Informe primeiramente o campo do telefone III');
        $('#i-telefone3').focus();


    }
  });



  $('.telefone').mask('(00) 00000-0000');
  $('.telefone').blur(function(event)
  {
    if($(this).val().length == 15){ // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
      $('.telefone').mask('(00) 00000-0009');
    } else
    {
      $('.telefone').mask('(00) 0000-00009');
    }

  });

  $('input[name="optradio"]:checked').change( function()
    {
       //alert( 'valor: '+$('input[name="optradio"]:checked').val());
    })


  $( "#i-dataagenda" ).val(moment().format( 'YYYY-MM-DD'));
  $( "#i-horaagenda" ).val(moment().format( 'HH:mm'));
  $( "#tabs" ).tabs();



  $("#sirius-menu").click();

  $("#i-select-pretensao").change(function()
  {
    gerarObservacao();
  });


  $("#i-select-finalidade").change(function()
  {
    gerarObservacao();
  });

  $("#i-select-tipoimovel").change(function()
  {
    gerarObservacao();
  });


        $('#i-select-bairro').multiselect(
    {
        nonSelectedText: 'Selecione Bairro',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        buttonWidth:'330px'
        });


        $('#i-select-condominio').multiselect(
    {
        nonSelectedText: 'Selecione condomínio',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        buttonWidth:'300px'
        });


    $('#i-select-status').multiselect(
    {
        nonSelectedText: 'Selecione ',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        buttonWidth:'170px'
        });

  preencherMidia();
  preencherCorretores();
  preencherTipoImovel();
  prioridadeCarga();
  preencherFinalidade();
  preencherUnidades();

});

function intencao(radio)
{
  var opcao =  radio.value;

  if( opcao == 1 )
  {
    $("#div-opcao-1").show();
    $("#div-opcao-2").hide();
  }
  else
  if( opcao == 2 )
  {
    $("#div-opcao-1").hide();
    $("#div-opcao-2").show();
  };


}

function preencherMidia()
{

  var url = "{{route('midia.carga')}}";

  $.getJSON( url, function( data )
  {
    $("#i-select-midia").empty();

    linha =  '<option value="0">selecione</option>';
    var grupo = '';

    $("#i-select-midia").append( linha );
    for( nI=0;nI < data.length;nI++)
    {
      if( grupo != data[nI].IMB_MDI_GRUPO )
      {
        if( grupo != '' )
        {
          linha ='</optgroup>';
          $("#i-select-midia").append( linha );
        }

        linha = '<optgroup label="'+data[nI].IMB_MDI_GRUPO+'">';
        $("#i-select-midia").append( linha );
        grupo = data[nI].IMB_MDI_GRUPO;

      }

      var selecionada = '';
      if( data[ nI ].IMB_MDI_NOME == 'Site da Imobiliária' )
        selecionada='selected';
      linha =
        '<option value="'+data[nI].IMB_MDI_ID+'" '+selecionada+'>&nbsp;&nbsp;&nbsp;'+
                        data[nI].IMB_MDI_NOME+"</option>";
                        $("#i-select-midia").append( linha );

    }
    linha ='</optgroup>'
    $("#i-select-midia").append( linha );

  });

}

function preencherCorretores()
{
  var empresa = "{{Auth::user()->IMB_IMB_ID}}";
  var url = "{{ route('atendente.cargaativos')}}";
  var usuariologado = "{{Auth::user()->IMB_ATD_ID}}";

  console.log('ativo: '+url );
  $.ajax(
    {
      url : url,
      dataType:'json',
      type:'get',
      async:false,
      success:function( data )
      {
        $("#i-select-corretor").empty();
        linha = '<option value="0">Escolha o Corretor</option>';
        $("#i-select-corretor").append( linha );
        for( nI=0;nI < data.length;nI++)
        {
          linha = '<option value="'+data[nI].IMB_ATD_ID+'">'+
                data[nI].IMB_ATD_NOME+"</option>";
                $("#i-select-corretor").append( linha );
        }
        $("#i-select-corretor").val( usuariologado);
      }

    });

}

function procurarTelefone( telefone, campo )
{
//  if( $("#IMB_CLT_NOME").val() != '' )
  //   return false;

  var ntelefone = telefone.value;
  ntelefone = ntelefone.replace( '(','' );
  ntelefone = ntelefone.replace(')','');
  ntelefone = ntelefone.replace('-','');
  ntelefone = ntelefone.replace(' ','');

  debugger;
  $("#btn-perfil").show();
  console.log( telefone );
  $( "#IMB_CLT_NOME" ).prop( "disabled", false );
  if( campo == 1 && telefone == '' )
  {
      $("#btn-perfil").hide();
      alert('É necessário Informar um número de telefone');
  }
  
  

  var url = "{{route('cliente.localizar.telefone')}}/"+ntelefone;

  $.ajax(
    {
      url       : url,
      type      : 'get',
      dataType  : 'json',
      async     : false,
      success   : function( data )
      {

        if(   campo == 2 &&
              $("#i-telefone1").val() !='' &&
              data.IMB_CLT_ID != '' &&
              data.IMB_CLT_NOME != $("#IMB_CLT_NOME").val() )
        {
          alert( 'Já tem outro cliente com este telefone: '+data.IMB_CLT_NOME );
          return false;
        }

        if( campo == 1 )
        {

            $("#modalclientecadastrado").modal( 'show');
            $("#IMB_CLT_ID").val( data.IMB_CLT_ID );
            $("#IMB_CLT_NOME").val( data.IMB_CLT_NOME );

            $("#i-nomecliente").html( data.IMB_CLT_NOME+' - '+data.FONES);
            $("#div-opcoes-atendimento").empty();
            $("#div-opcoes-atendimento").append( '<div class="div-center"><button class="btn btn-primary" data-dismiss="modal">Fechar</div>')

            pegarAtendimentosCliente( data.IMB_CLT_ID );
            cargaTelefones( data.IMB_CLT_ID );
            cargaPerfil( data.IMB_CLT_ID );            

        }

//        $("#div-dados-cliente").append( '<p><div class="col-md-12 div-center"><h3>'+data.IMB_CLT_NOME+'</h3></div></p>');
        //$("#div-dados-cliente").append( '<p><div class="col-md-12 div-center" ><h5>Telefones: '+data.FONES+'</h5></div></p');



      },
      error: function()
      {
        console.log('error: nada encontrado');
        $("#IMB_CLT_ID").val( '' );
        $("#IMB_CLT_NOME").val( '' );
        $("#i-nomecliente").html( '');
      }
    }
  )


}

function pegarAtendimentosCliente( id )
{

  //var url = "{{route('atendimento.dadosultatdcliente')}}/"+id;
  var url = "{{route('cliente.corretores')}}/"+id;


  $.ajax(
    {
      url     : url,
      type    : 'get',
      datType : 'json',
      async   : false,
      success : function( data )
      {
          usuario="{{Auth::user()->IMB_ATD_ID}}";
          $("#div-atendimentos").empty();
          for( nI=0;nI < data.length;nI++)
          {

              if( data[nI].IMB_ATD_ID != usuario )
              {

                debugger;
                var ultimoatdcorretor = data[nI].ULTIMOATENDIMENTOPELOCORRETOR;
                if( ultimoatdcorretor != null )
                   ultimoatdcorretor = 'Atendimento em '+moment(data[nI].ULTIMOATENDIMENTOPELOCORRETOR).format('DD/MM/YYYY HH:mm')
                else
                  ultimoatdcorretor = '(Sem atendimento por este corretor)';

                $("#div-atendimentos").append( '<p><h3 class="div-center H3 font-azul">ATENÇÃO</h3></p>');
                $("#div-atendimentos").append( '<p><h3 class="div-center H3">Atendido por: '+
                '<span class="font-azul">'+data[nI].IMB_ATD_NOME+'</span><br>'+ultimoatdcorretor+'</h3></p>'+
                '<p><h3 class="div-center H3">Contato: '+data[nI].IMB_ATD_TELEFONE_1+' '+data[nI].IMB_ATD_TELEFONE_2)+'</h3></p>';
                $("#div-atendimentos").append( '<hr>');
                $("#div-atendimentos").append( '<div class="div-center"><button class="btn btn-success" onClick="continuarCorretor()">Continuar Atendendo como '+
                    data[nI].IMB_ATD_NOME+'</button></div>');

                    $("#div-opcoes-atendimento").empty();
                    $("#div-opcoes-atendimento").append( '<div class="div-center"><button class="btn btn-warning" id="btn-escolher-corretor" onClick="escolherCorretor()">Escolher Outro Corretor</button><button class="btn btn-danger" onClick="javascript:window.close();">Fechar</button></div>')

              }
              else
              {
                var ultimoatdcorretor = data[nI].ULTIMOATENDIMENTOPELOCORRETOR;
                if( ultimoatdcorretor != null )
                   ultimoatdcorretor = 'Último atendimento em '+moment(data[nI].ULTIMOATENDIMENTOPELOCORRETOR).format('DD/MM/YYYY HH:mm')
                else
                  ultimoatdcorretor = '(Sem atendimento por este corretor)';

                $("#div-atendimentos").append( '<p><h3 class="div-center H3">'+ultimoatdcorretor+' </h3></p>');
                $("#div-opcoes-atendimento").empty();
                $("#div-opcoes-atendimento").append( '<div class="div-center"><button class="btn btn-danger" data-dismiss="modal">OK</button></div>')
              }


          }
      }
    });
}

  function preencherTipoImovel()
    {
        var url = "{{ route('tipoimovel.carga')}}";
        $.getJSON( url, function( data )
        {
          $("#i-select-tipoimovel").empty();
          $("#i-select-tipoimovel-perfil").empty();
            
            var linha =  '<option value=""></option>';
            $("#i-select-tipoimovel").append( linha );
            $("#i-select-tipoimovel-perfil").append( linha );
                        
            for( nI=0;nI < data.length;nI++)
            {
                linha =
                    '<option value="'+data[nI].IMB_TIM_ID+'">'+
                        data[nI].IMB_TIM_DESCRICAO;
                linha = linha + "</option>";
                $("#i-select-tipoimovel").append( linha );
                $("#i-select-tipoimovel-perfil").append( linha );
            }
        });
    }

    function prioridadeCarga( id )
{
  $.getJSON( "{{ route('prioridadeatendimentolista')}}", function( data )
  {
    $("#i-select-prioridade").empty();
    linha = "<option value=''>Selecione</option>";
    $("#i-select-prioridade").append( linha )

    for( nI=0;nI < data.length;nI++)
    {
//      console.log( data );
      if ( data[nI].VIS_PRI_ID  == id )
      {
        linha =
          '<option value="'+data[nI].VIS_PRI_NOME+'" selected>'+
                        data[nI].VIS_PRI_NOME+"</option>";
                        $("#i-select-prioridade").append( linha )
      }
      else
      {
        linha =
          '<option value="'+data[nI].VIS_PRI_NOME+'">'+
            data[nI].VIS_PRI_NOME+"</option>";
          $("#i-select-prioridade").append( linha );
      }
    }

  });
}

function procurarImovel()
{
  $("#modalpesquisarimovel").modal('show');
}

function preencherUnidades()
  {
      $.getJSON( "{{ route('imobiliaria.carga')}}/"+$("#IMB_IMB_IDMASTER").val(), function( data )
      {

          $("#js-select-unidade").empty();

          linha =  '<option value="0">Todas Unidades</option>';
          $("#js-select-unidade").append( linha );
          for( nI=0;nI < data.length;nI++)
          {
              linha =
              '<option value="'+data[nI].IMB_IMB_ID+'">'+
                  data[nI].IMB_IMB_NOME+"</option>";
                  $("#js-select-unidade").append( linha );

          }
          $("#js-select-unidade").val( $("#IMB_IMB_IDMASTER").val());
      });

  }

   function preencherFinalidade()
   {
       $("#i-select-finalidade-cliente").empty();
       linha = '<option value="T">Finalidade</option>';
       $("#i-select-finalidade-cliente").append( linha );
       linha = '<option value="V">Venda</option>';
       $("#i-select-finalidade-cliente").append( linha );
       linha = '<option value="L">Locação</option>';
       $("#i-select-finalidade-cliente").append( linha );
   }

   function limparCampos( )
   {

       preencherFinalidade();
       preencherUnidades();

       $("#i-select-bairro").multiselect('clearSelection');
       $("#i-select-condominio").multiselect('clearSelection');
       $("#i-select-status").multiselect('clearSelection');

       $("#i-idcompletus").val('');
       $("#i-referencia").val('');
       $("#i-faixainicial").val('');
       $("#i-faixafinal").val('');
       $("#i-endereco").val('');
       $("#i-condominio").val('');
       $("#i-bairro").val('');
       $("#i-cidade").val('');
       $("#i-dormitorio").val('');
       $("#i-suite").val('');
       $("#i-proprietario").val('');

   }

  function gravarAtendimento()
  {

    table = document.getElementById('tableperfil');
    n = table.rows.length; 
    if( n == 1 )
    {
      $("#btn-perfil").addClass('semperfil');
      alert('Você não informou nenhum perfil para este cliente! É muito importante você registrar um perfil para o cliente!');
      return false;
    }

    if( $("#id-especifico").prop("checked") && $("#I-IMB_IMV_REFERE").val() == '' )
    {
      alert('Você informou que o cliente já sabe qual o imóvel pretende, mas ainda não informou qual imóvel ');
      return false;
    }

    debugger;
    if ( $("#i-select-midia").val() == '' )
    {
      alert('Informe a mídia de origem!');
      return false;
    }
    if ( $("#i-telefone1").val() == '' &&
         $("#i-telefone2").val() == '' &&
         $("#i-telefone3").val() == '' &&
         $("#i-telefone4").val() == '' )
      {
         alert( 'É necessário pelo menos um telefone')
        return false;
      };

  
    if ( $("#i-select-prioridade").val() == '' )
    {
      alert('Informe a prioridade');        
      return false;
    };

      cadastrarClienteAtendimento();

      //cadastrarTelefonesAtendimento();


      idatendimento = 0;
      //gravar o atendimento
      var url = "{{route('atendimento.cliente.novo')}}";

      var dados =
      {
        IMB_CLT_ID: $("#IMB_CLT_ID").val(),
        //IMB_ATD_ID: $("#i-select-corretor").val(),
        IMB_CLA_PRIORIDADE: $("#i-select-prioridade").val(),
        IMB_CLA_STATUS: 'Finalizado',
        IMB_CLA_DATAATENDIMENTO: $("#i-dataagenda").val()+' '+$("#i-horaagenda").val(),
        IMB_CLA_COMENTARIO: "Cliente Prpe-cadastrado",
        IMB_CLA_PRETENSAO : $("#i-select-pretensao").val(),
        IMB_CLA_FINALIDADE : $("#i-select-finalidade").val(),
      }

      gerarToken();

      $.ajax(
        {
          url       : url,
          dataType  : 'json',
          type      : 'post',
          async     : false,
          data      : dados,
          success   : function(data)
          {
          },
          error: function()
          {
            alert('Não foi possivel gravar o historico ');
          }
        }
      )

      var dados =
      {
        IMB_CLT_ID: $("#IMB_CLT_ID").val(),
        IMB_ATD_ID: $("#i-select-corretor").val(),
        IMB_CLA_PRIORIDADE: $("#i-select-prioridade").val(),
        IMB_CLA_STATUS: 'Em atendimento',
        IMB_CLA_DATAATENDIMENTO: $("#i-dataagenda").val()+' '+$("#i-horaagenda").val(),
        IMB_CLA_COMENTARIO: $("#i-observacoes").val(),
        IMB_CLA_PRETENSAO : $("#i-select-pretensao").val(),
        IMB_CLA_FINALIDADE : $("#i-select-finalidade").val(),

      }

      gerarToken();

      $.ajax(
        {
          url       : url,
          dataType  : 'json',
          type      : 'post',
          async     : false,
          data      : dados,
          success   : function(data)
          {
            idatendimento = data;

          },
          error: function()
          {
            alert('Não foi possivel gravar o historico ');
          }
        }
      )

      //VERIFICR SE JÁ EXISTE NA TABELA DE CLIENTE-USUARIO
      url = "{{route('cliente.corretores')}}/"+$("#IMB_CLT_ID").val();
      $.ajax(
        {
          url   : url,
          type  : 'get',
          dataType: 'json',
          async:false,
          success:function( data )
          {
            if( data.length ==  0 ||  $("#i-outrocorretor").val('S') )
            salvarCliUsuBD();
          }
        }
      )
      $("#i-btn-gravar-agenda").hide();
      alert( 'Atendimento registrado com sucesso! Agora vamos a procura dos imóveis que seu cliente procura');

      setCookie('3wt2oowd3ooo2oowt4',idatendimento,1 );
      window.open( "{{route('imovel.index')}}", '_blank');
      
      //window.close();
  }

  function salvarCliUsuBD()
  {

    $.ajaxSetup(
    {
      headers:
      {
        'X-CSRF-TOKEN': "{{csrf_token()}}"
      }
    });

    if( $("#i-outrocorretor").val() == 'S' )
    {
      sub='S';
      suqual='Interessado';
    }
    else
    {
      sub='N';
      suqual='';
    }

    corimo =
      {
        IMB_ATD_ID : $("#i-select-corretor").val(),
        IMB_CLT_ID : $("#IMB_CLT_ID").val(),
        IMB_CLU_TIPO: 'Interessado',
        SUBSTITUIR: sub,
        SUBSTITUIRQUAL:suqual,
      };

      var url = "{{ route('cliente.corretores.salvar')}}";

      $.ajax(
        {
          url:url,
          type:'post',
          datatype:'json',
          async:false,
          data: corimo,
          success:function( data)
          {
          },
          error: function( erro)
          {
            alert('Erro na gravação do corretor no cliente ');
          }
        });

    }


  function gerarObservacao()
  {

    $("#i-observacoes").val( 'O cliente quer '+' '+
    $("#i-select-pretensao option:selected").text()+' '+
    $("#i-select-tipoimovel option:selected").text()+' '+
    $("#i-select-finalidade option:selected").text());
  }

  function cargaTelefones( id )
  {

    url="{{route('telefone.carga')}}/"+id;

    $.ajax(
      {
        url       : url,
        type      : 'get',
        dataType  : 'json',
        success   : function( data )
        {
          for( nI=0;nI < data.length;nI++)
          {
            var ddd= data[nI].IMB_TLF_DDD;
            ddd=ddd.toString();

            var numero= data[nI].IMB_TLF_NUMERO;
            numero=numero.toString();

            var telefone = '('+ddd+') '+numero;

            console.log('ddd '+data[nI].IMB_TLF_DDD+' - tipo de telefone '+data[nI].IMB_TLF_NUMERO+' - tipo de telefone '+data[nI].IMB_TLF_TIPOTELEFONE);

            if( nI == 0 )
            {

              $("#i-telefone1").val(telefone);
              $("#i-telefone1-tipo").val( data[nI].IMB_TLF_TIPOTELEFONE);
            }
            if( nI == 1 )
            {
              $("#i-telefone2").val( telefone);
              $("#i-telefone2-tipo").val( data[nI].IMB_TLF_TIPOTELEFONE);
            }
            if( nI == 2 )
            {
              $("#i-telefone3").val( telefone);
              $("#i-telefone3-tipo").val( data[nI].IMB_TLF_TIPOTELEFONE);
            }
            if( nI == 3 )
            {
              $("#i-telefone4").val( telefone);
              $("#i-telefone4-tipo").val( data[nI].IMB_TLF_TIPOTELEFONE);
            }
          }

        }
      });
  }

	function gerarToken()
	{
	  $.ajaxSetup
		({
		  headers:
		  {
			  'X-CSRF-TOKEN': "{{csrf_token()}}"
		  }
		});
	}




  function escolherCorretor()
  {
    var usuario = "{{Auth::user()->IMB_ATD_ID}}";
    var opcao = 1;
    var modulo = 206;

    url = "{{route('direito.checar')}}/"+usuario+'/'+modulo+'/'+opcao;

    $.ajax(
    {
         url  : url,
         dataType:'json',
         type:'get',
         success:function(data)
         {
        //   alert('sucesso '+data );
           if( data != 'S')
           {
            $("#i-outrocorretor").val('N');
             alert('Você não tem permissão para redirecionar corretor em atendimentos');
             return false;
           }
           else
           {
            $("#modalclientecadastrado").modal('hide');
            $("#i-outrocorretor").val('S');
           }

         }
    })





  }

  function continuarCorretor()
  {

    $("#div-pretensao").hide();
    $("#modalclientecadastrado").modal('hide');

    var id = $("#IMB_CLT_ID").val();

    var url = "{{route('atendimento.ultimoatendimentoclientecorretor')}}/"+id;

    $.ajax
    (
      {
        url     : url,
        dataType: 'json',
        type:'get',
        async:false,
        success:function( data )
        {
          var usuariologado = "{{Auth::user()->IMB_ATD_ID}}";
          $("#i-select-corretor").val( usuariologado);
          $("#I-IMB_IMV_REFERE").val('XXXXXX');
          //alert(usuariologado);
        }
      }
    )


  }
  function abrirPerfil()
  {
    cadastrarClienteAtendimento();

    if( $("#IMB_CLT_ID").val() == '' )
    {
      alert('É necessário informar o cliente!');
      return false;
    }
    $("#IMB_CLT_ID_PERFIL").val( $("#IMB_CLT_ID").val() );
    $("#modalperfil").modal('show');
  }


  function cadastrarClienteAtendimento()
  {
        
    if ( $("#IMB_CLT_NOME").val().length < 2 )
    {
      alert('Nome de cliente inválido!');
      return false;
    };

    debugger;
    gerarToken();

    cliente =
    {
      IMB_CLT_NOME: $("#IMB_CLT_NOME").val(),
      IMB_CLT_EMAIL: $("#i-email").val(),
      IMB_CLT_ID: $("#IMB_CLT_ID").val(),

    };


    $.ajax(
    {
      url : "{{ route( 'cliente.precadastro' ) }}",
      type : 'post',
      datatype: 'json',
      data: cliente,
      async:false,
      success:function( data )
      {

        debugger;
        $("#IMB_CLT_ID").val( data);
        console.log('Numero de Cliente Encontrado: '+data );
        cadastrarTelefonesAtendimento();
      },
      error:function()
      {
        alert('erro pra gravar o precadastro');
      }
    })
  }


  function cadastrarTelefonesAtendimento()
  {
    if( $("#i-telefone1").val().length < 8 )
    {
      alert('Verifique o telefone I');
      return false;
    };
    if( $("#i-telefone2").val() != '' && $("#i-telefone2").val().length < 8 )
    {
      alert('Verifique o telefone II');
      return false;
    };

    if( $("#i-telefone3").val() != '' && $("#i-telefone3").val().length < 8 )
    {
      alert('Verifique o telefone III');
      return false;
    };
    
    if( $("#i-telefone4").val() != '' && $("#i-telefone4").val().length < 8 )
    {
      alert('Verifique o telefone IV');
      return false;
    };

    if( $("#i-telefone1").val() != '' )
      {

        debugger;
        gerarToken();
          // Criar objeto para armazenar os dados (com JSON essa tarefa fica mais simples)
        var tel = $("#i-telefone1").val();
        tel = tel.replace("-", "");
        tel = tel.replace("(", "");
        tel = tel.replace(")", "");
        tel = tel.replace(" ", "");
        
        var ddd = tel.substring(0,2);
        var telefone = tel.substring(2,15);

        var url = "{{ route('telefone.salvar')}}/"+
            $("#IMB_CLT_ID").val()+'/'+
            ddd+'/'+
            telefone+'/'+
            $("#i-telefone1-tipo").val();

        console.log('url grava fone '+url );

//      alert('gravando o telefone');
        $.post( url,  function(data)
        {
        });
      }

      if( $("#i-telefone2").val() != '' )
      {

        gerarToken();
          // Criar objeto para armazenar os dados (com JSON essa tarefa fica mais simples)
          var tel = $("#i-telefone2").val();
        tel = tel.replace("-", "");
        tel = tel.replace("(", "");
        tel = tel.replace(")", "");
        tel = tel.replace(" ", "");
        
        var ddd = tel.substring(0,2);
        var telefone = tel.substring(2,15);


        var url = "{{ route('telefone.salvar')}}/"+
            $("#IMB_CLT_ID").val()+'/'+
            ddd+'/'+
            telefone+'/'+
            $("#i-telefone2-tipo").val();

        console.log('url grava fone '+url );

//      alert('gravando o telefone');
        $.post( url,  function(data)
        {
        });
      }
      if( $("#i-telefone3").val() != '' )
      {

        gerarToken();
          // Criar objeto para armazenar os dados (com JSON essa tarefa fica mais simples)
          var tel = $("#i-telefone3").val();
        tel = tel.replace("-", "");
        tel = tel.replace("(", "");
        tel = tel.replace(")", "");
        tel = tel.replace(" ", "");
        
        var ddd = tel.substring(0,2);
        var telefone = tel.substring(2,15);

        var url = "{{ route('telefone.salvar')}}/"+
            $("#IMB_CLT_ID").val()+'/'+
            ddd+'/'+
            telefone+'/'+
            $("#i-telefone3-tipo").val();

        console.log('url grava fone '+url );

//      alert('gravando o telefone');
        $.post( url,  function(data)
        {
        });
      }

      if( $("#i-telefone4").val() != '' )
      {

        gerarToken();

          // Criar objeto para armazenar os dados (com JSON essa tarefa fica mais simples)
          var tel = $("#i-telefone4").val();
        tel = tel.replace("-", "");
        tel = tel.replace("(", "");
        tel = tel.replace(")", "");
        tel = tel.replace(" ", "");
        
        var ddd = tel.substring(0,2);
        var telefone = tel.substring(2,15);

        var url = "{{ route('telefone.salvar')}}/"+
            $("#IMB_CLT_ID").val()+'/'+
            ddd+'/'+
            telefone+'/'+
            $("#i-telefone4-tipo").val();

        console.log('url grava fone '+url );

//      alert('gravando o telefone');
        $.post( url,  function(data)
        {
        });
      }
    }

</script>



@endpush
