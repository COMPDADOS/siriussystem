@extends('layout.app')
@section('scripttop')
<style>

</style>    
 
 <script>       
  </script>

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
              <div class="caption">Reajustes de Aluguéres
              </div>
    
              <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
              </div>
            </div>
                
            <div class="portlet-body form">
              <div class="form-body">
                <div class="row">
                  
                  <div class="col-md-4">
                    <div class="form-group">
                      <input type="text" maxlength="40" class="form-control" id="i-nome"
                                        style="font-family: Tahoma; font-size: 16px"
                                        readonly >
                      <span>Nome</span>
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="form-group">
                      <input type="text"class="form-control" id="i-cpf"
                                        style="font-family: Tahoma; font-size: 16px"
                                        readonly >
                      <span>CPF</span>
                    </div>
                  </div>
                  
                  <div class="col-md-2">
                    <div class="form-group">
                      <input type="text"class="form-control" id="i-rg"
                                        style="font-family: Tahoma; font-size: 16px"
                                        readonly >
                      <span>RG</span>
                    </div>
                  </div>
                  

                  
                  <div class="col-md-2">
                        <a  class="btn btn-sm btn-info" 
                                role="button" onClick="complementarCliente()" >
                                Complementar </a>
                  </div>
                  <div class="col-md-2">
                        <a  class="btn btn-sm btn-primary" 
                                role="button" onClick="telefoneModal()" >
                                Adicionar Telefone </a>
                  </div>
                   
                </div>
                <div class="row">
                 <div class="col-md-6">
                    <table  id="tbltelefone" class="table table-striped table-bordered table-hover" >
                      <thead class="thead-dark">
                        <tr >
                          <th width="40" style="text-align:center"> DDD </th>
                          <th width="150" style="text-align:center"> Número </th>
                          <th style="text-align:center"> Tipo </th>
                          <th width="100" style="text-align:center"> Ações </th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>

                  <div class="col-md-6">
                    <div class="col-md-2 div-cor-azul" style="text-align:center" id="i-div-status">
                      <div class="form-group">
                        <label class="control-form" id="i-ultimo-status">--</label>
                      </div>
                      <span>Último Status</span>
                    </div>
                    
                    <div class="col-md-2 div-cor-azul" style="text-align:center">
                      <div class="form-group">
                        <label class="control-form" id="i-ultima-atualizacao">--</label>
                        </div>
                      <span>Última Atual.</span>
                    </div>

                    <div class="col-md-2 div-cor-azul" style="text-align:center">
                      <div class="form-group">
                        <label class="control-form" id="i-ultima-acesso">--</label>
                      </div>
                      <span>Atualizado por</span>
                    </div>
                  </div>
                </div>

                <class class="row">
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon input-circle-left">
                              <i class="fa fa-envelope"></i>
                      </span>
                      <input maxlength="100" name="CIMB_CLT_EMAIL" type="email"
                                      class="form-control input-circle-right"
                                      id="i-email"
                                      readonly>
                    </div>
                  </div>
                </div>

                <div id="i-div-atendimento">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-3">
                        <div class="input-group">
                          <input class="form-control" 
                                size="16" type="text" id="i-dthinicioatd" readonly/>
                        </div>
                        <span>Data/Hora Inicio</span>
                      </div>
                      <div class="col-md-3">
                        <div class="input-group">
                            <input class="form-control div-center" 
                                size="32" type="text" id="i-nomeatendenteinicio" readonly/>
                        </div>
                        <span>Colaborador que iniciou o atendimento</span>
                      </div>
                      <div class="col-md-2">
                          <label  id="i-encerrado" class="form-control div-center">E N C E R R A D O</label>
                      </div>

                      <div class="col-md-4">
                        <button type="button" class="btn btn-primary" 
                              id="i-btn-encerraratendimento" onClick="atendimentoFechar( {{ $id }})">Encerrar o Atendimento
                              <button type="button" class="btn btn-primary" 
                              id="i-btn-reabriratendimento" onClick="atendimentoReabrir( {{ $id }})">Reabrir Atendimento
                        </button>          
                        <button type="button" class="btn btn-primary" 
                              id="i-btn-notificar" onClick="notificarcliente( {{ $id }})">Notificar Cliente
                        </button>          
                      </div>
                    </div>
                  </div>
                </div>



                  

                <div id="i-relato">
                  <H3>----------------------------- Sobre o Relato -----------------------------</H3>
                  <div class="row">
                    <div class="col-md-12">
                      <input type="hidden" id="i-idrelato">
                      <div class="col-md-2">
                      <div class="input-group">
                          <input class="form-control dpicker" 
                              size="16" type="text" id="i-dataagenda"/>
                          <span class="input-group-btn">
                            <button class="btn default" type="button">
                                <i class="fa fa-calendar"></i>
                            </button>
                          </span>
                        </div>
                        <span class="help-block"> Data </span>
                      </div>
                      
                      <div class="col-md-2">
                        <div class="input-group">
                          <input class="form-control  timepicker-24"
                                id="i-horaagenda"
                                type="text" >
                          <span class="input-group-btn">
                            <button class="btn default" type="button">
                              <i class="fa fa-clock"></i>
                            </button>
                          </span>
                        </div>
                        <span class="help-block"> Hora </span>
                      </div>

                      <div class="col-md-3">
                        <div class="input-group">
                          <select class="form-control" id="i-select-status">
                          </select>
                        </div>
                        <span class="help-block"> Status </span>

                      </div>

                      <div class="col-md-2">
                        <div class="input-group">
                          <select class="form-control" id="i-select-prioridade">
                          </select>
                        </div>
                        <span class="help-block"> Prioridade </span>
                      </div>
                      
                      <div class="col-md-3">
                        <div class="input-group">
                          <select class="form-control" id="i-select-forma">
                          <option value="">Selecione</option>
                          <option value="T">Telefone</option>
                          <option value="I">Imobiliária</option>
                          <option value="W">WhatsApp</option>
                          <option value="E">Email</option>
                          <option value="O">Outra</option>
                          </select>
                        </div>
                        <span class="help-block"> Forma Contato </span>
                      </div>
                      

                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group last">
                      <label  class="control-label col-md-2"> ** Observações **</label>
                      <div class="col-md-10">
                        <textarea name="content" rows="10" 
                        data-width="600" class="form-control" id="i-observacoes"
                        ></textarea>
                        <span class="help-block"> Descreva acima mais informações sobre este atendimento </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-actions right">
                    <button type="button" class="btn default " id="i-btn-cancelar" onClick="agendaCancela()">Cancelar</button>
                    <button type="button" class="btn blue " id="i-btn-gravar-agenda" onClick="gravarAgenda()">
                          <i class="fa fa-check"></i> Gravar
                    </button>
                  </div>
                </div>
              </div><!-- end form-body-->
            </div><!--FIM Portlet-body form">-->
          </div>
          
          <div class="portlet box blue">
            <div class="portlet-title">
              <div class="caption">
                  <i class="fa fa-gift"></i>Relatos do Atendimento
              </div>
              <div class="tools">
                  <a href="javascript:;" class="collapse"> </a>
              </div>
              <div class="actions">
                <div class="btn-group btn-group-devided" data-toggle="buttons">
                    <button class="btn btn-transparent dark btn-outline btn-circle btn-sm"
                    onClick="agendaInforma(0)">
                      Adicionar Novo Relato
                    </button>
                </div>
              </div>
                  
            </div>
                
            <div class="portlet-body form">
              <div class="form-body">
                <div class="row">
                  <table  id="tblagenda" class="table table-striped table-bordered table-hover" >
                    <thead class="thead-dark">
                      <tr >
                        <th width="50" style="text-align:center"> Protoloco </th>
                        <th width="100" style="text-align:center"> Data </th>
                        <th width="60" style="text-align:center"> Hora </th>
                        <th width="600" style="text-align:center"> Informações </th>
                        <th width="200" style="text-align:center"> Ações </th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                  <div class="actions">
                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                      <button class="btn btn-transparent dark btn-outline btn-circle btn-sm"
                        onClick="agendaInforma(0)">
                        Adicionar Novo Relato
                      </button>
                    </div>
                  </div>
                </div>
              </div><!-- end form-body-->
            </div><!--FIM Portlet-body form">-->
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

          <!-- BEGIN QUICK SIDEBAR -->

<a href="javascript:;" class="page-quick-sidebar-toggler">
  <i class="icon-login"></i>
</a>

<div class="page-quick-sidebar-wrapper" data-close-on-body-click="false">
</div>

      <div class="modal fade" id="modaltelefones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Adicionar  Telefone</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
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
  <!--              </form>--><!--        <form action="{{url('telefone/telefone/1')}}" method="get"> -->
            </div>
          </div>
        </div>
      </div>


      <div class="modal fade" id="modalsaidachaves" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Saída de Chaves</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input name="IMB_SAICHA_ID" type="hidden" class="form-control" id="IMB_SAICHA_ID">

              <div class="row">

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="IMB_CLT_NOME" class="col-form-label">Nome</label>
                    <input name="IMB_CLT_NOME" type="text" class="form-control" id="IMB_CLT_NOME">
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="IMB_CLT_CPF" class="col-form-label">CPF</label>
                    <input name="IMB_CLT_CPF" type="text" class="form-control" id="IMB_CLT_CPF" readonly >
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="IMB_CLT_RG" class="col-form-label">RG</label>
                    <input name="IMB_CLT_RG" type="text" class="form-control" id="IMB_CLT_RG">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-primary" onClick="telefoneSalvar()">Gravar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
              </div>
  <!--              </form>--><!--        <form action="{{url('telefone/telefone/1')}}" method="get"> -->
            </div>
          </div>
        </div>
      </div>      

<!-- MODAL DA AGENDA -->
<div class="modal fade" id="modalatendimentofechar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Informações para Fechamento do Atendimento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12" >
            <div class="col-md-2">
              <input type="text" class="form-control dpicker" id="i-datafechamento"/>
              <span>Dt Fechamento</span>
            </div>
            <div class="col-md-3">
              <select class="form-control" id="i-select-perspectiva">
                <option value="">Informe a perspectiva</option>
                <option value="1">Baixa</option>
                <option value="5">Média</option>
                <option value="10">Alta</option>
              </select>
              <span>Perspectiva de Sucesso</span>

            </div>
            <div class="col-md-3">
              <div class="form-control">
                <label><input type="checkbox" id="i-avisar">Avisar Cliente</label>
              </div>              
          </div>
          <div class="col-md-3">
          <div class="form-control">
                <label><input type="checkbox" id="i-nadaencontrado">Nada Encontrado</label>
              </div>              
          </div>
        </div>
        <div class="row">
          <div class="col-md-2">
              <label>** Observações **</label>
          </div>

          <div class="col-md-8">
            <textarea name="content" rows="10" 
                data-width="100%" class="form-control" id="i-observacoes-fechamento">
            </textarea>
            <span class="help-block"> Descreva acima mais informações sobre este atendimento </span>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="form-actions right">
          <button type="button" class="btn default " id="i-btn-cancelar" onClick="cargaAtendimento()">Cancelar</button>
          <button type="button" class="btn blue " id="i-btn-gravar" onClick="gravarFechamento()">
                        <i class="fa fa-check"></i> Gravar
          </button>
        </div>
      </div>
    </div>
  </div>
</div>


<form style="display: none" action="{{route('cliente.edit')}}" method="POST" id="form-alt-cli">            
@csrf
    <input type="hidden" id="id-clt-alt" name="id" />                
    <input type="hidden" id="readonly" name="readonly" value="N" />                
</form>


@endsection
@push('script')

<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('/js/jquery-ui-timepicker-addon.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/i18n/jquery-ui-timepicker-addon-i18n.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/jquery-ui-sliderAccess.js')}}"></script>

<script>


$( document ).ready(function() 
{
  
            

  $("#i-relato").hide();
  $("#i-btn-continuar").hide();
  
  cargaAtendimento();


  $('#clickmewow').click(function()
  {
    $('#radio1003').attr('checked', 'checked');
  });
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

  if ( $("#i-nome").val() == '' )
     alert('Nome é obrigatório!')
  else
  if ( $("#i-email").val() == '' )
     alert('Email é obrigatório!')
  else
  if ( $("#tbltelefone>tbody>tr").length == 0 ) 
  {
    alert('É necessário no minimo um telefone!');
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
      IMB_CLT_NOME: $("#i-nome").val(),
      IMB_CLT_EMAIL: $("#i-email").val()
    };

    $.post("{{ route( 'cliente.precadastro' ) }}", cliente, function(data)
    {

      $("#i-numero-cliente").val( data);

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
          IMB_TLF_ID_CLIENTE :$("#i-numero-cliente").val(),
          IMB_TLF_DDD : $(colunas[0]).text(),
          IMB_TLF_NUMERO : $(colunas[1]).text(),
          IMB_TLF_TIPOTELEFONE : $(colunas[2]).text()
        };

        var url = "{{ route('telefone.salvar')}}/"+
            $("#i-numero-cliente").val()+'/'+
            $(colunas[0]).text()+'/'+
            $(colunas[1]).text()+'/'+
            $(colunas[2]).text();

        $.post( url, telefone, function(data)
        {

          atm =
              { 
                  IMB_ATD_ID :  $("#i-idusuario").val(),
                  IMB_CLT_ID : $("#i-numero-cliente").val(),
                  IMB_ATD_EMAIL: $("#i-email").val()          
              }

              $.ajaxSetup(
              {
                  headers:
                  {
                      'X-CSRF-TOKEN': "{{csrf_token()}}"
                  }
              });


              console.log( 'atd: '+atm.IMB_ATD_ID+' - '+atm.IMB_CLT_ID );
              $.ajax(
              {
                url: "{{ route( 'atendimento.novo' ) }}",
                dataType: 'JSON',
                type: 'post',
                data: atm,
                success: function( data, textStatus, jQxhr )
                {
                  $("#i-idatendimento").val( data );

                  ati =
                  { 
                    IMB_ATD_EMAIL: $("#i-usuario").val(),
                    VIS_ATM_ID :  $("#i-idatendimento").val() 
                  }

                  
                  
                  
                  
                  //GRAVAR IMOVEIS SELCIONADOS JUNTO AO ATENDIMENTO EFETIVO
                  
/*                  $.ajaxSetup(
                  {
                      headers:
                      {
                          'X-CSRF-TOKEN': "{{csrf_token()}}"
                      }
                  });

                  
                  
                  console.log( 'EMAIL: '+ati.IMB_ATD_EMAIL
                  +'ATM: '+ati.VIS_ATM_ID);

                  $.ajax(
                  {
                      url: "{{ route( 'atendimento.imoveis' ) }}",
                      dataType: 'JSON',
                      type: 'post',
                      data: ati,
                      success: function( data, textStatus, jQxhr )
                      {

                      }
                  });
                */
                }
              });
        });
      });

         
    });

  }
}


function cargaSelecionados()
{
  cliente = 
  {
    IMB_ATD_ID : $("#i-idusuario").val()
  };

  url = "{{ route( 'cargaselecionados' ) }}/"+
                $("#i-idusuario").val();
        
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

function cargaAtendimento()
{
  
  url = "{{ route( 'atendimento.buscar' ) }}/"+
                $("#i-idatendimento").val();
  console.log( 'url atendimento '+url);
        
  $.getJSON( url, function(data)
  {
    var datainicio = new Date(data[0].IMB_ATM_DTHINICIO);

//    alert( 'clt_id: '+data[0].IMB_CLT_ID );
    $("#i-nome").val( data[0].IMB_CLT_NOME);
    $("#i-email").val( data[0].IMB_CLT_EMAIL);
    $("#i-cpf").val( data[0].IMB_CLT_CPF);
    $("#i-rg").val( data[0].IMB_CLT_RG);
    $("#i-numero-cliente").val( data[0].IMB_CLT_ID);
    $("#i-dthinicioatd").val(moment(data[0].IMB_ATM_DTHINICIO).format('DD/MM/YYYY HH:mm') );
    $("#i-nomeatendenteinicio").val( data[0].name);
    
    $("#i-atendimentoinfo").html(
      'Atendimento Nº '+data[0].VIS_ATM_ID+
      ' - Iniciado em: '+datainicio.toLocaleDateString('pt-BR')+
      ' - Por: '+data[0].IMB_ATD_NOME );

      $("#i-nomeatendenteinicio").val( data[0].IMB_ATD_NOME );

    $("#i-btn-encerraratendimento").hide();
    $("#i-btn-reabriratendimento").hide();
    
    
    if( data[0].IMB_ATM_DTHFIM == null)
    {
      $("#i-btn-encerraratendimento").show()
      $("#i-encerrado").hide();
    }
    else
    {
      $("#i-btn-reabriratendimento").show();
      $("#i-encerrado").show();
    }
    
    telefoneCarregar();
    ultimoStatus( $("#i-idatendimento").val() );
    $("#modalatendimentofechar").modal('hide');
    //alert( '$("#i-numero-cliente").val' +$("#i-numero-cliente").val());
   
  })
  
}

function ultimoStatus( id )
{
  url = "{{ route( 'atendimento.ultimostatus' ) }}/"+id;
  $.getJSON( url, function(data)
  {
    if ( data.length > 0 ) 
    {
      $("#i-ultimo-status").html( data[0].VIS_ATS_NOME);
      $("#i-div-status").css("background",data[0].VIS_ATS_COLOR );    
      $("#i-ultima-atualizacao").html( moment(data[0].IMB_ATA_DATA).format('DD/MM/YYYY')+' '+
      data[0].VIS_ATA_HORA);
      $("#i-ultima-acesso").html( data[0].IMB_ATD_NOME);
    }
  });
}


function telefoneCarregar()
  { 
    str = $("#i-numero-cliente").val();
    var url = "{{ route('telefone.carga') }}"+"/"+str;
    console.log( url ); 
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

function agendaCarregar()
  { 
    str = $("#i-idatendimento").val();
    var url = "{{ route('atendimento.agenda.carga') }}"+"/"+str;
    console.log( url ); 
    $.getJSON( url, function( data)
    {


      linha = "";
      $("#tblagenda>tbody").empty();
      for( nI=0;nI < data.length;nI++)
      {
        
        var dataagenda = new Date(data[ nI ].VIS_ATA_DATA);

        var obs = data[nI].VIS_ATA_OBSERVACOES;
        if( obs == null)        
        {
          obs='';
        }
        var fec = data[nI].VIS_ATA_DATAHORAFECHADO;
        if( fec == null)        
        {
          fec='';
        }
        if( fec == '') 
        {
           fec='aberto';
        }
        linha = 
                        '<tr>'+
                        '<td style="text-align:center valign="center" id="i-protocolo'+data[nI].VIS_ATA_ID+'">'+data[nI].VIS_ATA_ID+'</td>' +
                        '<td style="text-align:center valign="center">'+moment(data[nI].VIS_ATA_DATA).format('DD/MM/YYYY')+'</td>' +
                        '<td style="text-align:center valign="center">'+data[nI].VIS_ATA_HORA+'</td>' +
                        '<td style="text-align:center valign="center">'+obs+'</td>' +
//                        '<td style="text-align:center valign="center">'+fec+'</td>' +
                        '<td style="text-align:center" valign="center"> '+
                              '<a href=javascript:agendaInforma('+data[nI].VIS_ATA_ID+') class="glyphicon glyphicon-search  btn btn-sm btn-success"></a> '+
                          '</td> ';

                        linha = linha +
                        '</tr>';
        $("#tblagenda").append( linha );
      }
    });
  }


  function agendaInforma( id )
  {
    
    
    $("#i-idrelato").val( id );

    var prioridade = 0;
    var url = "{{ route('atendimento.agenda.busca') }}"+"/"+id;
    console.log( 'url' + url);
    $.ajax(
    {
      url: url,
      type: "GET",
      dataType: "json",
      success: function (data) 
      {
         //        alert( moment().format('DD/MM/YYYY') );
         $("#i-relato").show();
         rolar_para( '#i-relato');
        if( id == 0 ) 
        {
          $("#i-dataagenda").val (moment().format('DD/MM/YYYY'));
          $("#i-horaagenda").val (moment().format("HH:mm"));
          $("#i-dataagenda-modal").val (moment().format('DD/MM/YYYY'));
          $("#i-horaagenda-modal").val (moment().format('HH:MM'));
          $("#i-observacoes").val('');
          StatusCarga( 0 );
          prioridade =  0 ;
        }
        else
        {

          var dataagenda = new Date(data[ 0 ].VIS_ATA_DATA);

          StatusCarga( data[0].VIS_ATS_ID );
          prioridade =  data[0].VIS_PRI_ID ;
          $("#i-dataagenda").val (dataagenda.toLocaleDateString('pt-BR'));
          $("#i-horaagenda").val (data[0].VIS_ATA_HORA);
          $("#i-dataagenda-modal").val (dataagenda.toLocaleDateString('pt-BR'));
          $("#i-horaagenda-modal").val (data[0].VIS_ATA_HORA),
          $("#i-observacoes").val( data[0].VIS_ATA_OBSERVACOES );

        }
        //$("#modalagenda").modal('show');
      }
    }).done(function() {
      prioridadeCarga(  prioridade );
   });
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
      linha = 
          '<option value="'+data[nI].VIS_ATS_ID+'">'+
           data[nI].VIS_ATS_NOME+"</option>";

       $("#i-select-status").append( linha );

    }
    $("#i-select-status").val( id );

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
          '<option value="'+data[nI].VIS_PRI_ID+'" selected>'+
                        data[nI].VIS_PRI_NOME+"</option>";
                        $("#i-select-prioridade").append( linha )
      }
      else
      {
        linha = 
          '<option value="'+data[nI].VIS_PRI_ID+'">'+
            data[nI].VIS_PRI_NOME+"</option>";
          $("#i-select-prioridade").append( linha );
      }       
    }

  });
}
function esconderModalAgenda()
{
//  $("#modalagenda").modal('hide');

}


function agendaCancela()
{
  $("#i-relato").hide();
}

function gravarAgenda()
{

  if( $("#i-select-prioridade").val() == '')
  {
    alert( 'Informe a Prioridade para este atendimento');
    return false;
  }

  ata =
  { 
    
    VIS_ATA_ID : $("#i-idrelato").val(),
	  VIS_ATM_ID: $("#i-idatendimento").val(),
	  VIS_ATA_DATA: $("#i-dataagenda").val(),
	  VIS_ATA_HORA: $("#i-horaagenda").val(),
	  VIS_ATA_DATAENCERRAMENTO: $("#i-datafechamento").val(),
	  VIS_ATA_HORAENCERRAMENTO: $("#i-horaagenda").val(),
	  VIS_ATD_IDINICIO:$("#i-idusuario").val(),
    VIS_ATA_OBSERVACOES:$("#i-observacoes").val(),
//	  VIS_ATA_DATAHORA:
	  //VIS_ATA_DATAHORAFECHADO:
    //IMB_ATA_PERPECTIVA:
	  VIS_PRI_ID:$("#i-select-prioridade").val(),
	  VIS_ATM_FORMA:$("#i-select-forma").val(),
	  //VIS_ATM_NADAENCONTRADO:
	  //VIS_ATM_AVISAR:
	  //VIS_ATM_CANCELAR:
	  VIS_ATS_ID: $("#i-select-status").val(),
    IMB_ATD_ID :  $("#i-idusuario").val(),
    IMB_CLT_ID : $("#i-numero-cliente").val(),
  }

  $.ajaxSetup(
  {
    headers:
    {
      'X-CSRF-TOKEN': "{{csrf_token()}}"
    }
  });

  console.log(
    'VIS_ATA_ID '+ata.VIS_ATA_ID+' <->  '+
	  'VIS_ATM_ID '+ata.VIS_ATM_ID+' <->  '+
	  'VIS_ATA_DATA '+ata.VIS_ATA_DATA+' <->  '+
	  'VIS_ATA_HORA '+ata.VIS_ATA_HORA+' <->  '+
	  'VIS_ATA_DATAENCERRAMENTO '+ata.VIS_ATA_DATAENCERRAMENTO+' <->  '+
	  'VIS_ATA_HORAENCERRAMENTO '+ata.VIS_ATA_HORAENCERRAMENTO+' <->  '+
	  'VIS_ATD_IDINICIO '+ata.VIS_ATD_IDINICIO+' <->  '+
    'VIS_ATA_OBSERVACOES '+ata.VIS_ATA_OBSERVACOES+' <->  '+
	  'VIS_PRI_ID '+ata.VIS_PRI_ID+' <->  '+
	  'VIS_ATM_FORMA '+ata.VIS_ATM_FORMA+' <->  '+
	  'VIS_ATS_ID '+ata.VIS_ATS_ID+' <->  '+
    'IMB_ATD_ID '+ata.IMB_ATD_ID+' <->  '+
    'IMB_CLT_ID '+ata.IMB_CLT_ID
    
  )

  $.ajax(
  {
    url: "{{ route( 'atendimento.agenda.gravar' ) }}",
    dataType: 'JSON',
    type: 'post',
    data: ata,
    success: function( data, textStatus, jQxhr )
    {
/*      limparAgenda();
      var id = $("#i-idrelato").val();
      var goto = "#i-protocolo";
      rolar_para( "#"+goto+id );*/

    },
    complete: function(){
      agendaCarregar();
      var id = $("#i-idrelato").val();
      var goto = "#i-protocolo";
      $("#i-relato").hide();
      rolar_para( goto+id );

    }
  });

    
}


function gravarEncerramentoRegAgenda( $operacao )
{
  ata =
  { 
    
    VIS_ATA_ID : $("#i-idrelato").val(),
	  VIS_ATM_ID: $("#i-idatendimento").val(),
	  VIS_ATA_DATA: $("#i-dataagenda").val(),
	  VIS_ATA_HORA: $("#i-horaagenda").val(),
	  VIS_ATA_DATAENCERRAMENTO: $("#i-datafechamento").val(),
	  VIS_ATA_HORAENCERRAMENTO: $("#i-horaagenda").val(),
	  VIS_ATD_IDINICIO:$("#i-idusuario").val(),
    VIS_ATA_OBSERVACOES:$("#i-observacoes").val(),
//	  VIS_ATA_DATAHORA:
	  //VIS_ATA_DATAHORAFECHADO:
    //IMB_ATA_PERPECTIVA:
	  VIS_PRI_ID:$("#i-select-prioridade").val(),
	  VIS_ATM_FORMA:$("#i-select-forma").val(),
	  //VIS_ATM_NADAENCONTRADO:
	  //VIS_ATM_AVISAR:
	  //VIS_ATM_CANCELAR:
	  VIS_ATS_ID: $("#i-select-status").val(),
    IMB_ATD_ID :  $("#i-idusuario").val(),
    IMB_CLT_ID : $("#i-numero-cliente").val(),
    OPERACAO: $operacao,
  }

  $.ajaxSetup(
  {
    headers:
    {
      'X-CSRF-TOKEN': "{{csrf_token()}}"
    }
  });
  console.log(
    'VIS_ATA_ID '+ata.VIS_ATA_ID+' <->  '+
	  'VIS_ATM_ID '+ata.VIS_ATM_ID+' <->  '+
	  'VIS_ATA_DATA '+ata.VIS_ATA_DATA+' <->  '+
	  'VIS_ATA_HORA '+ata.VIS_ATA_HORA+' <->  '+
	  'VIS_ATA_DATAENCERRAMENTO '+ata.VIS_ATA_DATAENCERRAMENTO+' <->  '+
	  'VIS_ATA_HORAENCERRAMENTO '+ata.VIS_ATA_HORAENCERRAMENTO+' <->  '+
	  'VIS_ATD_IDINICIO '+ata.VIS_ATD_IDINICIO+' <->  '+
    'VIS_ATA_OBSERVACOES '+ata.VIS_ATA_OBSERVACOES+' <->  '+
	  'VIS_PRI_ID '+ata.VIS_PRI_ID+' <->  '+
	  'VIS_ATM_FORMA '+ata.VIS_ATM_FORMA+' <->  '+
	  'VIS_ATS_ID '+ata.VIS_ATS_ID+' <->  '+
    'IMB_ATD_ID '+ata.IMB_ATD_ID+' <->  '+
    'IMB_CLT_ID '+ata.IMB_CLT_ID+' <->  '+ata.OPERACAO
    
  )
  $.ajax(
  {
    url: "{{ route( 'atendimento.agenda.encerramento' ) }}",
    dataType: 'JSON',
    type: 'post',
    data: ata,
    success: function( data, textStatus, jQxhr )
    {
/*      limparAgenda();
      var id = $("#i-idrelato").val();
      var goto = "#i-protocolo";
      rolar_para( "#"+goto+id );*/

    },
    complete: function(){
      agendaCarregar();
      var id = $("#i-idrelato").val();
      var goto = "#i-protocolo";
      $("#i-relato").hide();
      rolar_para( goto+id );

    }
  });

    
}


function atendimentoFechar( id )
{

  $("#i-datafechamento").val( moment().format('DD/MM/YYYY'));
  $("#modalatendimentofechar").modal('show');


}


function atendimentoReabrir()
{

  $.ajaxSetup(
    {
      headers:
      {
        'X-CSRF-TOKEN': "{{csrf_token()}}"
      }
    });

    atm =
    {
      VIS_ATM_ID : $("#i-idatendimento").val(),
      IMB_ATD_ID : $("#i-idusuario").val(),
    }

    url = "{{ route( 'atendimento.reabrir' ) }}";

    $.post( url, atm, function(data)
    {
      gravarEncerramentoRegAgenda('R');      
      Swal.fire({
        title: 'Reabertura de Atendimento',
        text: 'Reabertura feita com sucesso. Registro de relato criado automaticamente',
        icon: 'ok',
        confirmButtonText: 'OK'
      })
      cargaAtendimento();
    });
}
function gravarFechamento()
{
  
  if ( $("#i-select-perspectiva").val() == '' )
  {
    alert('É obrigatório a informação da Perspecitiva');
  }
  else
  {
    var avisar = "N";
    if ( $('#i-avisar').is(':checked') )
    {
      avisar = "S";
    }

    var nadaencontrado = "N";
    if ($('#i-nadaencontrado').is(':checked') )
    {
      nadaencontrado = "S";
    }

    
    atm =
    { 
      VIS_ATM_ID : $("#i-idatendimento").val(),
      VIS_ATM_DTHFIM : $("#i-datafechamento").val(),
      IMB_ATM_PERPECTIVA : $("#i-select-perspectiva").val(),
      IMB_ATM_OBSERVACAO : $("#i-observacoes-fechamento").val(),
      IMB_ATM_AVISAR : avisar,
      IMB_ATM_NADAENCONTRATO : nadaencontrado,
      IMB_ATD_IDFECHAMENTO: $("#i-idusuario").val()
    }
    
    $.ajaxSetup(
    {
      headers:
      {
        'X-CSRF-TOKEN': "{{csrf_token()}}"
      }
    });

    $.ajax(
    {
      url : "{{ route( 'atendimento.salvar' ) }}",
      dataType: 'JSON',
      type: 'post',
      data: atm,
      success: function( data, textStatus, jQxhr )
      {
        $("#modalatendimentofechar").modal('hide');
      },
      complete: function()
      {
        gravarEncerramentoRegAgenda('E');      
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Gravando Informações!',
          showConfirmButton: false,
          timer: 1500
        });
        cargaAtendimento();
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Recarregando informações!',
          showConfirmButton: false,
          timer: 1500
        })
        limparSelecionados();

        
      }
    }).done( function()
    {
      //alert('');
    });
  }
}

function limparSelecionados()
{

  var url = "{{ route( 'atendimento.limparselecao' ) }}/"+$("#i-idusuario").val();
  
  $.ajax(
  {
    url : url,
    dataType: 'JSON',
    type: "get",
    success: function( data, textStatus, jQxhr )
    {
    }
  });

}

function limparAgenda()
{

  $("#i-relato").val('');
  $("#i-idatendimento").val('');
  $("#i-dataagenda").val('');
  $("#i-horaagenda").val('');
  $("#i-datafechamento").val('');
  $("#i-horaagenda").val('');
  $("#i-idusuario").val('');
  $("#i-observacoes").val('');
  $("#i-select-prioridade").val('');
  $("#i-select-forma").val('');
  $("#i-select-status").val('');
  $("#i-idusuario").val('');
  $("#i-numero-cliente").val('');
  $("#i-relato").hide();
  agendaCarregar();

}



$("#i-encerrado").css("background","#E80C0C" );    


StatusCarga(989898);
cargaSelecionados();
agendaCarregar();
//agendaInforma( 0 );


var table = $('#resultTable').DataTable({
            "language": 

{
    "sEmptyTable": "Nenhum registro encontrado",
    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
    "sInfoPostFix": "",
    "sInfoThousands": ".",
    "sLengthMenu": "_MENU_ resultados por página",
    "sLoadingRecords": "Carregando...",
    "sProcessing": "Processando...",
    "sZeroRecords": "Nenhum registro encontrado",
    "sSearch": "Pesquisar",
    "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
    },
    "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
    }
},
            processing: true,
            serverSide: true,
            ajax: {
                url:"{{ route('atendimento.list') }}",
                data: function (d) {
                    d.id = $('input[name=id]').val();
                    d.inicio = $('input[name=inicio]').val();
                    d.nome = $('input[name=nome]').val();
                    d.termino = $('input[name=termino]').val();
                }
            },
            columns: [
                {data: 'VIS_ATM_ID'         , name: 'VIS_ATM_ID'},
                {data: 'IMB_ATM_DTHINICIO'  , name: 'IMB_ATM_DTHINICIO'},
                {data: 'IMB_CLT_NOME'       , name: 'IMB_CLT_NOME'},
                {data: "IMB_ATM_DTHFIM"     , name: "IMB_ATM_DTHFIM"},
            ],
            "columnDefs": 
            [ 
                {
                    "targets": 4,
                    "data": null,
                    "defaultContent": "<div style='text-align:center'><button class='glyphicon glyphicon-trash btn btn-danger pull-right del-imv'></button><button class='glyphicon glyphicon-pencil btn btn-primary pull-right alt-imv'></button><button class='btn green-meadow glyphicon glyphicon-search pull-right show-imv'></button>",
                } ,
                { targets: 1, render:function(data)
                  {
                    return moment(data).format('DD/MM/YYYY HH:MM');
                  }
                },
                { targets: 3, render:function(data)
                  {
                    if( data = null) then
                      return 'em aberto';
                      
                    return moment(data).format('DD/MM/YYYY HH:MM');
                  }
                }
            ],
            searching: false
        });

        $.datepicker.regional['br'] = {
            closeText: 'ok',
            prevText: 'Anterior',
            nextText: 'Próximo',
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
            yearSuffix: '',
            timeFormat: 'hh:mm',
            showTimepicker: false

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
            showTimepicker: false

        });

      	$('.timerpicker').timepicker({
            timeFormat: 'hh:mm',
          timeOnlyTitle: 'timeonly',
          timeText: 'Horário',
          hourText: 'Hora',
          minuteText: 'Minuto',
          secondText: 'Segundo',
          currentText: 'Agora',
            closeText: 'Sair',
            showDatePicker: false,
            showTimepicker: true

        });

        $('#i-horaagenda').timepicker(
        {
          timeFormat: 'HH:mm',
          timeOnlyTitle: 'Selecione',
          timeText: 'Horário',
          hourText: 'Hora',
          minuteText: 'Minuto',
          currentText: 'Agora',
          closeText: 'Sair',
          showDatePicker: false,
          showTimepicker: true,
          use24hours: true
        });

        function notificarcliente(id )
        {
          
          url= "{{ route('envio-mail-atendimento') }}/" + id;            

          $.ajax({
             type: "GET",
             url: url,
             success: function(data)
             {

             },
             error: function()
             {
               alert('erro')
             }
          });          

        }


        function complementarCliente()
        {
          $("#id-clt-alt").val( $("#i-numero-cliente").val() );
          $("#readonly").val('N');
          $("#form-alt-cli").submit();
        }



</script>



@endpush