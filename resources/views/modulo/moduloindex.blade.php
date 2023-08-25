@extends('layout.app')
@push('script')


@section( 'scripttop')

<style>

label
    {
        font-weight: bold;        
    }
 .dark {
      background-color: #383838;
    }

    /* Centralização do conteúdo */
    .center {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

input[type="checkbox"] {
      position: relative;
      width: 40px;
      height: 15px;
      -webkit-appearance: none; /* Aparência padrão do checkbox é anulada */
      background-color: red; /* cor de fundo */
      outline: none; /* sem borda externa */
      border-radius: 30%; /* arrendodamento dos cantos */
      box-shadow: inset 0 0 5px rgba(95, 85, 85, 0.2); /* sombra interna */
      transition: .2s; /* tempo de transição que vai ocorrer com a cor de fundo e com a posção da bolinha*/
      cursor: pointer;/* estabelecer que o mouse vai ter uma aparência como se fosse clicar em um botão */
    }

    input:checked[type="checkbox"] {
      background-color: #00b33c;/* cor de fundo que vai ser aplicada quando o checkbox tiver uma alteração para checked */
    }
/* O seletor :before pode criar objetos antes do elemento principal, no caso cria a bolinha do botão  */
    input[type="checkbox"]:before {
      content: '';
      position: absolute;
      width: 15px;
      height: 15px;
      border-radius: 50%;
      top: 0;
      left: 0;
      background: #ffffff;
      transform: scale(1.2);
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
      transition: .2s;
    }

    input:checked[type="checkbox"]:before {
      left: 40px;
    }    

    .div-center
    {
        text-align:center;
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


.div-1 {
  background-color: lightblue;
}
.div-2 {
  background-color: #CCFFE5;
}

td{text-align:center;}
</style>

<script src="{{asset('/global/plugins/sweetalert/sweetalert2.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('/global/plugins/sweetalert/sweetalert2.min.css')}}">        


@endsection

@section('content')


<!-- BEGIN CONTENT -->
<div class="row">
  <div class="col-md-12">
    <div class="tabbable-line boxless tabbable-reversed">
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <form  id="i-form-lancamento" onsubmit="return false;" >
            <input type="hidden" id="IMB_IMB_IDMASTER" name="empresamaster" 
                value="{{ Auth::User()->IMB_IMB_ID }}"> 
            <div class="form-body">

            <div class="row">
              <div class="col-md-12">
              <div class="col-md-8">
                  <div class="form-group">
                    <input type="text" id='i-str' class="form-control" placeholder='Digite o nome ou parte do nome'>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <button id="i-btn-localizar" type="button" onClick="cargaModulos(1,'')">Localizar
                      
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <div class="portlet box blue i-div-informacoes">
              <div class="portlet-title">
                <div class="caption">
                  <i class="fa fa-gift"></i>Módulos
                </div>
                <div class="tools">
                  <button type="button" class="btn green btn-md btn-outline" onClick="novoModulo()"> 
                    Novo Módulo<i class="fa fa-plus"></i>
                  </button>
                </div>

              </div>
              
              <div class="portlet-body form">
                <table  id="i-tblfuncionarios" class="table table-striped table-bordered table-hover" >
                  <thead class="thead-dark">
                    <tr>
                      <th width="10%" style="text-align:center"> Ações </th>
                      <th width="50%" style="text-align:center"> Módulo </th>
                      <th width="10%" style="text-align:center"> Configuração </th>
                      <th width="10%" style="text-align:center"> CRM </th>
                      <th width="10%" style="text-align:center"> ERP Administrativo </th>
                      <th width="10%" style="text-align:center"> Financeiro </th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </form>
        </div> <!--class="tab-pane active" id="tab_1">-->
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

@endsection
@push('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="{{asset('/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/form-input-mask.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/global/plugins/jquery.input-ip-address-control-1.0.min.js')}}" type="text/javascript"></script>

<script>
  $( document ).ready(function() 
  {
    cargaModulos(1,'TODOSTODOSTODOS');
  });


  function cargaModulos( pagina, texto )
  {
    var texto = $("#i-str").val();
    if  ( texto == '' ) texto = 'TODOSTODOSTODOS';

    var url = "{{ route('modulo.list') }}"+"/"+pagina+'/'+texto;

    $.ajax(
    {
      url:url,
      datatype:'json',
      async:false,
      success: function( data )
      {
        console.log('total: '+data.length );
        linha = "";
        $("#i-tblfuncionarios>tbody").empty();
        for( nI=0;nI < data.length;nI++)
        {
          linha = 
            '<tr> '+
            '<td style="text-align:center" valign="center"> '+
              '<a href=javascript:alterar('+data[nI].IMB_MDL_ID+') class="btn btn-sm btn-primary">Alterar</a> '+
              '<a href=javascript:excluir('+data[nI].IMB_MDL_ID+') class="btn btn-sm btn-danger">Excluir</a> '+
            '</td> '+
            '<td style="text-align:center valign="center">'+data[nI].IMB_MDL_DESCRICAO+'</td>'+
            '<td>'+pegaConfig( data[nI] )+"</td>"+
            '<td>'+pegaCRM( data[nI] )+"</td>"+
            '<td>'+pegaADM( data[nI] )+"</td>"+
            '<td>'+pegaFIN( data[nI] )+"</td>"+
            '</tr>';
          $("#i-tblfuncionarios").append( linha );
          ligarDesligar( data[nI]);
        }
      }
    });
  }

    function alterar( id )
    {

      var url = "{{ route('modulo.edit') }}"+"/"+id;

      window.location = url;

    }

    function novoModulo()
    {
      var url = "{{ route('modulo.new') }}";

      window.location = url;

    }

    function excluir( id )
    {
      url ="{{route('modulo.delete')}}/"+id;

      $.ajax(
        {
          url   : url,
          type  : 'get',
          dataType: 'json',
          async:false,
          success: function()
          {
            alert( 'Excluido');
            cargaModulos(1,'TODOSTODOSTODOS');
          },
          error:function()
          {
            alert( 'erro para excluir');
          }
        }
      )
    }

    function pegaConfig( obj )
    {
      var id=obj.IMB_MDL_ID;
      return '<div><input  type="checkbox"  id="IMB_MOD_CFG'+id+'" disabled="disabled"></div';
    }
    function pegaCRM( obj )
    {
      var id=obj.IMB_MDL_ID;
      return '<div><input  type="checkbox"  id="IMB_MOD_CRM'+id+'" disabled="disabled"></div';
    }
    function pegaADM( obj )
    {
      var id=obj.IMB_MDL_ID;
      return '<div><input  type="checkbox"  id="IMB_MOD_ADM'+id+'" disabled="disabled"></div';
    }

    function pegaFIN( obj )
    {
      var id=obj.IMB_MDL_ID;
      return '<div><input  type="checkbox"  id="IMB_MOD_FIN'+id+'" disabled="disabled"></div';
    }

    function  ligarDesligar( obj )
    {
      var id=obj.IMB_MDL_ID;
      $("#IMB_MOD_CFG"+id ).prop( "checked", (obj.IMB_MOD_CFG =='S') );            
      $("#IMB_MOD_CRM"+id ).prop( "checked", (obj.IMB_MOD_CRM =='S') );            
      $("#IMB_MOD_ADM"+id ).prop( "checked", (obj.IMB_MOD_ADM =='S') );            
      $("#IMB_MOD_FIN"+id ).prop( "checked", (obj.IMB_MOD_FIN =='S') );            

    }



</script>



@endpush