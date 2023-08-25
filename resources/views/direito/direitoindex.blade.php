@extends('layout.app')
@push('script')


@section( 'scripttop')

<style>

.Liberado
{
  color:blue;
}


.Negado
{
  color:red;
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
  <h2 class="td" id="i-header-perfil"></h2>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tabbable-line boxless tabbable-reversed">
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <form  id="i-form-lancamento" onsubmit="return false;" >
            <input type="hidden" id="IMB_IMB_IDMASTER" name="empresamaster" 
                value="{{ Auth::User()->IMB_IMB_ID }}"> 
            <input type="hidden" id="IMB_ATP_ID" value="{{$id}}">
            <div class="form-body">
            <div class="row">
              <div class="col-md-12">
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" id='i-str' class="form-control" placeholder='Digite o nome ou parte do texto'>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <button id="i-btn-localizar" class="form-control btn btn-primary" type="button" onClick="cargaDireitos()">Localizar
                    </button>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <select class="form-control" id="i-select-atendente" placeholder='"Perfil Base'>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <button class="form-control btn btn-danger" id="i-btn-gerar" type="button" onClick="gerarBaseado()">Gerar
                    </button>
                  </div>
                </div>

              </div>
            </div>
            <div class="portlet box blue i-div-informacoes">
              <div class="portlet-title">
                <div class="caption">
                  <i class="fa fa-gift"></i>Direitos de Acessos
                </div>
                <div class="tools">
                </div>

              </div>
              
              <div class="portlet-body form">
                <table  id="i-tbllancamento" class="table table-striped table-bordered table-hover" >
                  <thead class="thead-dark">
                    <tr>
                      <th width="100" style="text-align:center"> Ações </th>
                      <th width="200" style="text-align:center"> Opção do Sistema </th>
                      <th width="100" style="text-align:center"> Acesso</th>
                      <th width="100" style="text-align:center"> Incluir </th>
                      <th width="100" style="text-align:center"> Alterar </th>
                      <th width="100" style="text-align:center"> Excluir </th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <div id="i-div-pagination">
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
    
    pegarPerfil( $("#IMB_ATP_ID").val() );

    cargaDireitos();
    cargaFuncionario();
  });



    function cargaDireitos()
    { 

      str = $("#IMB_ATP_ID").val();



      filtro = $("#i-str").val();
      if ( filtro == '' ) filtro = "TODOSTODOSTODOS";
      empresamaster = $("#IMB_IMB_IDMASTER").val();
      var url = "{{ route('direito.carga') }}"+"/"+str+"/"+filtro;
      $.ajax(
     {
      url:url,
      datatype:'json',
      async:false,
      success: function( data )
      {
        linha = "";
        $("#i-tbllancamento>tbody").empty();
        for( nI=0;nI < data.length;nI++)
        {

          var acesso='Negado';
          acessoicon = '<i class="fa fa-ban fa-2x" aria-hidden="true" style="color:red"></i>';
          if ( data[nI].IMB_DIRACE_ACESSO == 'S')
          {
              acesso=' Liberado ';
              acessoicon = '<i class="fa fa-check-circle-o fa-2x" aria-hidden="true" style="color:green"></i>';
          }

          var incluir='Negado';
          incluiricon = '<i class="fa fa-ban fa-2x" aria-hidden="true" style="color:red"></i>';
          if ( data[nI].IMB_DIRACE_INCLUSAO == 'S')
          {
            incluir=' Liberado ';
            incluiricon = '<i class="fa fa-check-circle-o fa-2x" aria-hidden="true"style="color:green"></i>';

          }

          var alterar='Negado';
          alteraricon = '<i class="fa fa-ban fa-2x" aria-hidden="true" style="color:red"></i>';

          if ( data[nI].IMB_DIRACE_ALTERACAO == 'S')
          {
            alterar='Liberado';
            alteraricon = '<i class="fa fa-check-circle-o fa-2x" aria-hidden="true"style="color:green"></i>';              
          }

          var excluir='Negado';
          excluiricon = '<i class="fa fa-ban fa-2x" aria-hidden="true" style="color:red"></i>';
          if ( data[nI].IMB_DIRACE_EXCLUSAO == 'S')
          {
            excluir='Liberado';
            excluiricon = '<i class="fa fa-check-circle-o fa-2x" aria-hidden="true"style="color:green"></i>';              

          }


          linha = 
            '<tr>' +
            '<td style="text-align:center" valign="center"> '+
              '<a href=javascript:alterar('+data[nI].IMB_DIRACE_ID+') class="btn btn-sm btn-primary">Alterar</a> '+
            '</td> '+
            '<td style="text-align:center valign="center">'+data[nI].IMB_MDL_DESCRICAO+'</td>' +
            '<td style="text-align:center valign="center" class="'+acesso+'">'+
            '<a href=javascript:permitir('+data[nI].IMB_DIRACE_ID+',1,\''+data[nI].IMB_DIRACE_ACESSO+'\')>'+acessoicon+'</a> '+
            '</td>' +
            '<td style="text-align:center valign="center" class="'+incluir+'">'+
              '<a href=javascript:permitir('+data[nI].IMB_DIRACE_ID+',2,\''+data[nI].IMB_DIRACE_INCLUSAO+'\')>'+incluiricon+'</a> '+
            '</td>' +
            '<td style="text-align:center valign="center" class="'+alterar+'">'+
            '<a href=javascript:permitir('+data[nI].IMB_DIRACE_ID+',3,\''+data[nI].IMB_DIRACE_ALTERACAO+'\')>'+alteraricon+'</a> '+
            '</td>' +
            '<td style="text-align:center valign="center" class="'+excluir+'">'+
              '<a href=javascript:permitir('+data[nI].IMB_DIRACE_ID+',4,\''+data[nI].IMB_DIRACE_EXCLUSAO+'\')>'+excluiricon+'</a> '+
            '</td>' ;
              linha = linha +
                          '</tr>';
          $("#i-tbllancamento").append( linha );
        }
      }
    });
  }

  function cargaFuncionario()
  {
    $.getJSON( "{{ route('perfil.carga')}}", function( data )
    {
      $("#i-select-atendente").empty();
      linha = '<option value="0">Perfil Base</option>';
      $("#i-select-atendente").append( linha );
      for( nI=0;nI < data.length;nI++)
      {
        linha = 
          '<option value="'+data[nI].IMB_ATP_ID+'">'+
            data[nI].IMB_ATP_DESCRICAO+"</option>";
            $("#i-select-atendente").append( linha );
      }
    });
  }

  function gerarBaseado()
  {

    if( $("#i-select-atendente").val() == '0' )
    {
      Swal.fire
      ({
          position: 'center',
          icon: 'abort',
          title: 'Informe o Perfil Base!',
          showConfirmButton: true,
          timer: 3500
      })
      return false;
    }

    Swal.fire
    ({
      title: 'Concedendo direitos a acessos?',
      text: "Posso continuar?!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Confirmar'
    }).then((result) => 
    {
        if (result.value) 
        {
      
          $.ajaxSetup(
          {
            headers:    
            {
              'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
          });        

          var destino = $("#IMB_ATP_ID").val();

          var url="{{ route( 'direito.gerar')}}/"+$("#i-select-atendente").val()+"/"+destino;        
          $.ajax(
          {
            url: url,
            dataType: 'JSON',
            type: "post",
            success: function(data)
            {
              Swal.fire
              ({
                position: 'center',
                icon: 'success',
                title: 'Informações Gravadas com Sucesso!',
                showConfirmButton: true,
                timer: 3500
              });

              cargaDireitos();

            },
            error: function( error )
            {
              console.log('erro '+error);
            }
          });
        }
    })
  }


  function permitir( id, permissao, status )
  {

    $.ajaxSetup(
    {
      headers:    
      {
        'X-CSRF-TOKEN': "{{csrf_token()}}"
      }
    });        


    if ( status == 'N')
      var url="{{ route( 'direito.permitir')}}/"+id+"/"+permissao
    else
      var url="{{ route( 'direito.negar')}}/"+id+"/"+permissao;

    $.ajax(
    {
      url: url,
      dataType: 'JSON',
      type: "post",
      success: function(data)
      {
              cargaDireitos();

      },
      error: function( error )
      {
        console.log('erro '+error);
      }
    });




  }

  function negar( id, permissao )
  {

    $.ajaxSetup(
    {
      headers:    
      {
        'X-CSRF-TOKEN': "{{csrf_token()}}"
      }
    });        


    var url="{{ route( 'direito.negar')}}/"+id+"/"+permissao;
    $.ajax(
    {
      url: url,
      dataType: 'JSON',
      type: "post",
      success: function(data)
      {
      
        cargaDireitos();

      },
      error: function( error )
      {
        console.log('erro '+error);
      }
    });




  }

  function pegarPerfil( id )
  {

    var url = "{{route('perfil.buscar')}}/"+id;
    console.log( url );

    $.ajax(
      {
        url           : url,
        type          : 'get',
        dataType      : 'json',
        success       : function( data )
        {
          $("#i-header-perfil").html( 'Perfil: '+data.IMB_ATP_DESCRICAO);
          
        },
        error         : function()
        {
          $("#i-header-perfil").html( 'Perfil: '+data.IMB_ATP_DESCRICAO);

        }
      });
  }

  
</script>



@endpush