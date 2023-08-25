@extends('layout.app')
@section('scripttop')
<style>
H3 {
    text-align: center;
    font-size: 20px;
    font-weight: bold;
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

        <form method="post" id="i-form-cliente" >
          <input type="hidden" id="i-numero-cliente" name="IMB_CLT_CODIGO">
          <input type="hidden" name="IMB_CLT_PRECADASTRO" value="S">
          <input type="hidden" id="i-usuario" value="{{Auth::user()->email}}"> 
          <input type="hidden" id="i-idusuario" value="{{Auth::user()->IMB_ATD_ID}}"> 
          <input type="hidden" id="i-idatendimento"> 
          <input type="hidden" id="IMB_IMB_IDMASTER" name="empresamaster" value="{{ Auth::User()->IMB_IMB_ID }}"> 

          <div class="portlet box blue">
              <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Dados do Cliente
                </div>
                  
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                </div>
              </div>
                
              <div class="portlet-body form">
                <div class="form-body">
                  <div class="row">
                    <div class="col-md-12">

                      <div class="col-md-6">
                        <div class="input-group">
                          <input type="hidden" id="i-codigocliente">
                          <input type="text" maxlength="40" name="CIMB_CLT_NOME" class="form-control" id="i-nome"
                                        placeholder="Preencha aqui com o nome do cliente"
                                        style="font-family: Tahoma; font-size: 16px"
                                        required >
                                        <span class="input-group-btn">
                            <button class="btn default" type="button" onClick="mostrarModalPesquisa()">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="col-md-12">
                              <a href="javascript:novoCadastroCliente();" >Cliente novo? Click aqui pra cadastrar!</a>
                            </div>
                          </div>
                        </div>

                      </div>

                      <div class="col-md-6">
                        <div class="input-group">
                          <span class="input-group-addon input-circle-left">
                            <i class="fa fa-envelope"></i>
                          </span>
                          <input maxlength="100" name="CIMB_CLT_EMAIL" type="email"
                                    class="form-control input-circle-right"
                                    placeholder="Preencha aqui o Email"
                                    id="i-email"
                                     required>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <H3 id="i-semcadastro">NOVO CADASTRO<H3>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-4">
                        <div class="input-group">
                          <label classe="control-form" >Status</label>
                          <select class="form-control" id="i-select-status">
                          </select>
                        </div>  
                      </div>
                      <div class="col-md-4">
                        <div class="input-group">
                          <label classe="control-form" >Forma de Contato</label>
                          <select class="form-control" id="i-select-forma">
                            <option value="">Selecione</option>
                            <option value="T">Telefone</option>
                            <option value="I">Imobiliária</option>
                            <option value="W">WhatsApp</option>
                            <option value="E">Email</option>
                            <option value="O">Outra</option>
                          </select>
                        </div>
                      </div>  
                      <div class="col-md-4">
                        <div class="input-group">
                          <label classe="control-form" >Direcionar Para Corretor:</label>
                          <select class="form-control" id="i-select-corretor">
                          </select>
                        </div>  
                      </div>
                    </div>
                  </div>
                  <div class="row">
                      <div class="form-actions right">
                        <button type="button" class="btn default" id="i-btn-cancelar-1" onClick="history.go(-1);">Cancelar</button>
                        <button type="button" class="btn blue" id="i-btn-gravar-1" onClick="Gravar()">
                                  <i class="fa fa-check"></i> Gravar Pré-Atendimento
                        </button>
                        <button type="button" class="btn green " id="i-btn-continuar-1" onClick="acessarAtendimento()">
                                  <i class="fa fa-check"></i> Continuar com Atendimento
                        </button>
                      </div>
                  </div>
                </div><!-- end form-body-->
              </div><!--FIM Portlet-body form">-->
          <div> 


          <div class="portlet box blue">
            <div class="portlet-title">
              <div class="caption">
                  <i class="fa fa-gift"></i>Telefones
              </div>
              <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                </div>
              </div>
              <div class="portlet-body form">
                <div class="form-body">
                  <table  id="tbltelefone" class="table table-striped table-bordered table-hover" >
                    <thead class="thead-dark">
                      <tr >
                        <th width="40" style="text-align:center"> DDD </th>
                        <th width="150" style="text-align:center"> Número </th>
                        <th style="text-align:center"> Tipo </th>
                        <th width="200" style="text-align:center"> Ações </th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                    
                  <div class="table-footer" >
                                <a  class="btn btn-sm btn-primary" 
                                role="button" onClick="telefoneModal()" >
                                Adicionar Telefone </a>
                  </div>                            
                </div><!-- end form-body-->
              </div> <!--FIM Portlet-body form">-->
            </div>

            
            <div class="portlet box blue">
              <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>imóveis Selecionados
                </div>
                  
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                </div>
              </div>
                
              <div class="portlet-body form">
                <div class="form-body">
                  <table  id="tblimoveiselecionados" class="table table-striped table-bordered table-hover" >
                    <thead class="thead-dark">
                      <tr >
                        <th width="40" style="text-align:center"> Código </th>
                        <th width="150" style="text-align:center"> Referência</th>
                        <th width="700" style="text-align:center"> Endereço </th>
                        <th width="100" style="text-align:center"> Ações </th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div><!-- end form-body-->
              </div><!--FIM Portlet-body form">-->

            </div> 
          </div>
        </form>
      </div><!--class="tab-content">-->
    </div><!--class="tabbable-line boxless tabbable-reversed">-->
  </div> <!--<div class="col-md-12">-->
</div> <!-- fim row unica -->

<form style="display: none" action="{{route('atendimento.atendimento')}}" method="POST" id="form-alt">            
@csrf
    <input type="hidden" id="id" name="id" />                
</form>
          <!-- BEGIN QUICK SIDEBAR -->

<a href="javascript:;" class="page-quick-sidebar-toggler">
  <i class="icon-login"></i>
</a>

<div class="page-quick-sidebar-wrapper" data-close-on-body-click="false">
</div>

      <div class="modal fade" id="modaltelefones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Adicionar  Telefone</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
      <!--        <form action="{{url('telefone/telefone/1')}}" method="get"> -->
              <input name="IMB_TLF_ID" type="hidden" class="form-control" id="i-id">

              <div class="row">
                 
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="ddd" class="col-form-label">DDD</label>
                    <input name="IMB_TLF_DDD" type="text" class="form-control" id="i-ddd"
                    onkeypress="return isNumber(event)" onpaste="return false;" required>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="numero" class="col-form-label">Número</label>
                    <input name="IMB_TLF_NUMERO" type="text" class="form-control" 
                    id="i-numero" onkeypress="return isNumber(event)" onpaste="return false;"
                    required>
                  </div>
                </div>

                <div class="col-md-7">
                  <div class="form-group">
                    <label for="tipo" class="col-form-label">Tipo</label>
                    <input name="IMB_TLF_TIPOTELEFONE"  type="text" 
                      class="form-control" id="i-tipo" placeholder="Celular, recado, etc..">
                  </div>
                </div>
              </div>

              <div class="modal-footer">
                  <button type="button" class="btn btn-primary" onClick="telefoneSalvar()">Gravar</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
              </div>
<!--              </form>-->
            </div>
          </div>
        </div>
      </div>


      @include( 'layout.clienterapido')
      @include('layout.modalpesquisacliente')

@endsection
@push('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>

<script>
$( document ).ready(function() 
{
  $("#i-btn-continuar").hide();
  $("#i-btn-continuar-1").hide();
  $("i-semcadastro").hide();
  $("#i-codigocliente").val('');
  $("#sirius-menu").click();

  preencherCorretor()  
  
});
$('#i-ddd').on('blur', () => 
    {
      if (  $('#i-ddd').val() > 99 ) 
      {
        alert('DDD Inválido');
        $('#i-ddd').val(''); 
    }
});

$('#i-ddd').on('blur', () => 
    {
      if (  $('#i-numero').val() > 999999999 ) 
      {
        alert('número Inválido');
        $('#i-numero').val(''); 
    }
});

 
  function telefoneSalvar()
  { 
    if(   $('#i-ddd').val() == '' )
      alert('DDD Obrigatório')
    else
    if(  $('#i-numero').val() == '' )
      alert('Número Obrigatório')
    if(  $('#i-tipo').val() == '' )
      alert('Tipo de Telefone Obrigatório')
    else
    {
      linha = 
        '<tr>'+
        '<td class="name" style="text-align:center valign="center">'+$("#i-ddd").val()+'</td>' +
        '<td class="name" style="text-align:center valign="center">'+$("#i-numero").val()+'</td>' +
        '<td class="name" style="text-align:center valign="center">'+$("#i-tipo").val()+'</td>' +
        '<td style="text-align:center" valign="center"> '+
            '<button type="button" onclick="remove(this)">Excluir</button>'+
        '</td>';
      
        linha = linha + '</tr>';
          $("#tbltelefone").append( linha );
    }
      
  }




  
  function telefoneModal()
  {

//    $("#i-numero-cliente").val('');
   $("#i-ddd").val('');
    $("#i-numero").val('');
    $("#i-tipo").val('');
    $("#modaltelefones").modal('show');
  }

  function telefoneApagar( id )
  {
    if (confirm("Tem certeza que deseja excluir este telefone?")) 
    {

      $("#tbltelefone").on("click", ".remover", function(e){
        $(this).closest('tr').remove(); 
      });
    }
  }

( function($) 
{
  remove = function(item) 
  {
    var tr = $(item).closest('tr');
    
    tr.fadeOut(400, function() 
    {
      tr.remove();  
    });

    return false;
  }
})(jQuery);    


function telefoneGravarDB()
{

    
    $('#tbltelefone tbody tr').each(function () 
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
      var telefone = 
      {
          IMB_TLF_ID_CLIENTE : 8,
          IMB_TLF_DDD : $(colunas[0]).text(),
          IMB_TLF_NUMERO : $(colunas[1]).text(),
          IMB_TLF_TIPOTELEFONE : $(colunas[2]).text()
      };

      console.log( 'telefones '+telefone );

      cliente=8;
      var url = "{{ route('telefone.salvar')}}/"+
            cliente+'/'+
            $(colunas[0]).text()+'/'+
            $(colunas[1]).text()+'/'+
            $(colunas[2]).text();

            $.post( url, telefone, function(data)
      {
        $("#modaltelefones").modal("hide");
      });
    });
};  


function Gravar()
{


  if ( $("#i-email").val() == '' )
     alert('Email é obrigatório!')
  else
  if ( $("#i-select-status").val() == '' )
     alert('Informe o status!')
  else
  if ( $("#i-select-forma").val() == '' )
     alert('Informe a forma de contato!')
  else
  if ( $("#tbltelefone>tbody>tr").length == 0 ) 
  {
    alert('É necessário no minimo um telefone!');
  }
  else
  if ( $("#i-codigocliente").val() == '')
  {
    alert('Necessariamente você precisa selecionar o cliente!');
  }
  else
  {
    
    $.ajaxSetup(
    {
        headers:    
        {
          'X-CSRF-TOKEN': "{{csrf_token()}}"
        }
    });        
            
    cliente = 
    {
      IMB_IMB_IDMASTER: $("#I-IMB_IMB_IDMASTER").val(),
      IMB_CLT_NOME: $("#i-nome").val(),
      IMB_CLT_EMAIL: $("#i-email").val(),
      IMB_CLT_ID: $("#i-codigocliente").val(),
      IMB_ATD_ID: $("#i-select-corretor").val(),
      
    };

    /*
    $.ajax({
      url : "{{ route( 'cliente.precadastro' ) }}",
      type : 'post',
      datatype: 'json',
      data: cliente,
      async:false,
      success:function( data )
      {
      
        $("#i-numero-cliente").val( data);
        console.log('Numero de Cliente Encontrado: '+data );

      },
      error:function()
      {
        alert('erro pra gravar o precadastro');
      }
    })

*/
    $('#tbltelefone tbody tr').each(function () 
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
      var telefone = 
      {
        IMB_TLF_ID_CLIENTE :$("#i-codigocliente").val(),
        IMB_TLF_DDD : $(colunas[0]).text(),
        IMB_TLF_NUMERO : $(colunas[1]).text(),
        IMB_TLF_TIPOTELEFONE : $(colunas[2]).text()
      };

      var url = "{{ route('telefone.salvar')}}/"+
          $("#i-codigocliente").val()+'/'+
          $(colunas[0]).text()+'/'+
          $(colunas[1]).text()+'/'+
          $(colunas[2]).text();

//      alert('gravando o telefone');
      $.post( url, telefone, function(data)
      {
      });
    });
      
    console.log('Numero de Cliente no Campo: '+$("#i-codigocliente").val() );

    atm =
    { 
        IMB_ATD_ID :  $("#i-select-corretor").val(),
        IMB_CLT_ID : $("#i-codigocliente").val(),
        IMB_ATD_EMAIL: $("#i-email").val()          ,
        IMB_IMB_ID : $("#IMB_IMB_IDMASTER").val()   ,
        VIS_ATA_HORA: RetornaHoraAtual(),      
    }
    $.ajaxSetup(
    {
        headers:
        {
          'X-CSRF-TOKEN': "{{csrf_token()}}"
        }
    });
    console.log(
        'ATM: '+atm.IMB_ATD_ID+' -  clt_ID'
              +atm.IMB_CLT_ID+' - email: '
              +atm.IMB_ATD_EMAIL);

    $.ajax
    ({
        url: "{{ route( 'atendimento.novo' ) }}",
        dataType: 'JSON',
        type: 'post',
        data: atm,
        async: false,
        success: function( data, textStatus, jQxhr )
        {
          
          $("#i-idatendimento").val( data );
          ati =
          { 
            VIS_ATM_ID :  $("#i-idatendimento").val() 
          }
            
          $("#i-btn-gravar").hide();
          $("#i-btn-gravar-1").hide();
          $("#i-btn-continuar").show();
          $("#i-btn-continuar-1").show();


          
        }
    });

    
  }
}

function limparSelecionados()
{
  
  var url = "{{route('atendimento.limparselecao')}}/1";  // o 1 é irrelevante, pois pego o auth::user()

  $.ajax(
    {
      url     : url,
      type    : 'get',
      dataType: 'json',
      async   : false,
      success : function()
      {
        console.log('LIMPOU');
      },
      error   : function()
      {
        alert('Erro ao excluir os selecionados');
      }
    });
}


function cargaSelecionados()
{
  cliente = 
  {
    IMB_ATD_ID : $("#i-idusuario").val()
  };

  url = "{{ route( 'cargaselecionados' ) }}";
        
  console.log( 'url: '+url );
  $.getJSON( url, function(data)
  {
    linha = "";
    $("#tblimoveiselecionados>tbody").empty();
    for( nI=0;nI < data.length;nI++)
    {
      linha = 
        '<tr>'+
        '   <td>'+data[nI].IMB_IMV_ID+'</td>'+
        '   <td>'+data[nI].IMB_IMV_REFERE+'</td>'+
        '   <td>'+data[nI].ENDERECO+'</td>'+
        '   <td style="text-align:center"> '+   
//                    '<a  class="btn btn-sm btn-primary" href=javascript:editarCorImo('+data[nI].IMB_CORIMO_ID+')>Editar</a>&nbsp;&nbsp;&nbsp;&nbsp;'+
//                    '           <button class="btn btn-sm btn-primary" onclick="editarCorImo('+data[nI].IMB_CORIMO_ID+' )">Editar</button>'+ 
//                    '           <button class="btn btn-sm btn-danger" onclick="apagarCorImo('+data[nI].IMB_CORIMO_ID+' )">Apagar</button>'+ 
              '<a  class="btn btn-sm btn-danger" onclick="apagarImovelSelecao('+data[nI].IMB_IMV_ID+')">Apagar</a>'+
        '    </td>'+
        '</tr>';
      $("#tblimoveiselecionados").append( linha );        
    }
  })
  
}

function apagarImovelSelecao( id )
{
  cliente = 
  {
    IMB_ATD_ID : $("#i-idusuario").val(),
    IMB_IMV_ID : id
  };
  
  $.ajax({
    url : "{{ route( 'apagarimvselec' ) }}",
    type : 'get',
    data : cliente
  })
  .done(function(){
    cargaSelecionados();
  });
}

function continuarAtendimento()
{

  var atd = $("#i-idatendimento").val();

  url=" {{ route('atendimento.atendimento')}}/"+atd;

  $(location).attr('href', url );

}

function StatusCarga( id )
{
  var url = "{{ route('statusatendimentolista')}}/"+$("#I-IMB_IMB_IDMASTER").val() ;
  $.getJSON( url, function( data )
  {
    $("#i-select-status").empty();
    linha = "<option value=''>Selecione</option>";
    $("#i-select-status").append( linha )
    for( nI=0;nI < data.length;nI++)
    {
      if ( data[nI].VIS_ATS_ID  == id )
      {
        linha = 
          '<option value="'+data[nI].VIS_ATS_ID+'" selected>'+
                        data[nI].VIS_ATS_NOME+"</option>";
                        $("#i-select-status").append( linha )
      }
      else
      {
        linha = 
          '<option value="'+data[nI].VIS_ATS_ID+'">'+
            data[nI].VIS_ATS_NOME+"</option>";
          $("#i-select-status").append( linha );
      }       
    }

  });
}

function mostrarModalPesquisa()
{
  $("#i-str").val( $("#i-nome").val() );
  $("#i-codigocliente").val('');
  $("#i-semcadastro").hide();
  
  $("#modalpesquisacliente").modal('show');
  buscaIncremental();

}

function buscaIncremental()
    {

      str = $("#i-str").val();
        if( isNaN( str) )
        {
            var url = "{{ route('buscaclienteincremental') }}"+"/"+str;
        }
        else
            var url = "{{ route('cliente.localizar.telefone') }}"+"/"+str;
        
        //var url = "{{ route('buscaclienteincremental') }}"+"/"+str;

        console.log('busca '+url );
        
        $.getJSON( url, function( data)
        {
          linha = "";
          $("#tblclientes>tbody").empty();
          for( nI=0;nI < data.length;nI++)
          {
            linha = 
              '<tr>'+
              '   <td>'+data[nI].IMB_CLT_NOME+'</td>'+
              '   <td>'+data[nI].IMB_CLT_CPF+'</td>'+
              '   <td style="text-align:center valign="center">'+data[nI].FONES+'</td>' +
                  '   <td style="text-align:center"> '+   
//                    '<a  class="btn btn-sm btn-primary" href=javascript:editarCorImo('+data[nI].IMB_CORIMO_ID+')>Editar</a>&nbsp;&nbsp;&nbsp;&nbsp;'+
//                    '           <button class="btn btn-sm btn-primary" onclick="editarCorImo('+data[nI].IMB_CORIMO_ID+' )">Editar</button>'+ 
//                    '           <button class="btn btn-sm btn-danger" onclick="apagarCorImo('+data[nI].IMB_CORIMO_ID+' )">Apagar</button>'+ 
              '<a  class="btn btn-sm btn-primary" onclick="selecionarCliente( '+data[nI].IMB_CLT_ID+')">Selecionar</a>'+
        '    </td>'+
        '</tr>';
      $("#tblclientes").append( linha );        
    }

        });
    }

  function telefoneCarregar()
  { 
    str = $("#i-codigocliente").val();
    var url = "{{ route('telefone.carga') }}"+"/"+str;
    console.log( 'Telefone carga: ' + url ); 
    $.getJSON( url, function( data)
    {
      linha = "";
      $("#tbltelefone>tbody").empty();
      for( nI=0;nI < data.length;nI++)
      {
        linha = 
                        '<tr>'+
                        '<td style="text-align:center valign="center">'+data[nI].IMB_TLF_DDD+'</td>' +
                        '<td style="text-align:center valign="center">'+data[nI].IMB_TLF_NUMERO+'</td>' +
                        '<td style="text-align:center valign="center">'+data[nI].IMB_TLF_TIPOTELEFONE+'</td>' +
                        '<td style="text-align:center" valign="center"> '+
                              '<a href=javascript:telefoneApagar('+data[nI].IMB_TLF_ID+') class="btn btn-sm btn-danger">Excluir</a> '+
                          '</td> ';

                        linha = linha +
                        '</tr>';
        $("#tbltelefone").append( linha );
      }
    });
  }



function  selecionarCliente( id)
{

  $("#modalpesquisacliente").modal('hide');
        
  //alert('id: '+id);
  var url = "{{ route('cliente.find') }}"+"/"+id;
  
  $.getJSON( url, function( data)
  {
    $("#i-codigocliente").val( id );
    $("#i-nome").val( data.IMB_CLT_NOME  );
    $("#i-email").val(data.IMB_CLT_EMAIL);
    telefoneCarregar();
  });
  
}
    

function novoCliente()
{
  $("#i-semcadastro").show();
  $("#i-codigocliente").val('');
  $("#i-semcadastro").css("background","#F00F0F");
  $("#modalpesquisacliente").modal('hide');

}

function acessarAtendimento()
{
  //alert('Direcionando para um atendimento');
  $("#id").val( $("#i-idatendimento").val() );
  $("#form-alt").submit();
}

$("#i-semcadastro").hide();


cargaSelecionados();
StatusCarga()

function novoCadastroCliente()
    {
        $("#modalnovocliente").modal( 'show');
    }

    function preencherCorretor()
        {
            var url = "{{ route('atendente.cargaativos')}}";
            console.log('corretor '+url );

            $.getJSON( url, function( data )
            {
              $("#i-select-corretor").empty();
                linha = '<option value="0">Escolha o Corretor</option>';
                $("#i-select-corretor").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha = 
                    '<option value="'+data[nI].IMB_ATD_ID+'">'+
                        data[nI].IMB_ATD_NOME+"</option>";
                        $("#i-select-corretor").append( linha );
                };
                $("#i-select-corretor").val( $("#i-idusuario").val());
            });
            
        }




</script>



@endpush