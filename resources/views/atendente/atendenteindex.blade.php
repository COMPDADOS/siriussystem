@extends('layout.app')
@push('script')


@section( 'scripttop')

<style>
  .img-avatar
        {
            width: 50px;
            height: 50px;
            border-radius: 50%;
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
              <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" id='i-str' class="form-control" placeholder='Digite o nome ou parte do nome'>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <button id="i-btn-localizar" type="button" onClick="cargaFuncionarios(1,'')">Localizar
                    </button>
                  </div>
                </div>
                <div class="col-md-1 div-center">
                  <input class="form-control" type="checkbox" id="i-somenteativos">
                  <label for="i-somenteativos" class="control-label">Somente Ativos</label>

                </div>
              </div>
            </div>

            <div class="portlet box blue i-div-informacoes">
              <div class="portlet-title">
                <div class="caption">
                  <i class="fa fa-gift"></i>Funcionários/Colaboradores
                </div>
                @php  $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Usuarios', 'Usuarios / Colaboradores', 'GERAL', 'Usuários / Colaboradores','S', 'I', 'Botão')@endphp
                <div class="tools {{$acesso}}">
                  <button type="button" class="btn green btn-md btn-outline" onClick="novo()"> 
                    Novo Cadastro<i class="fa fa-plus"></i>
                  </button>
                </div>

              </div>
              
              <div class="portlet-body form">
                <table  id="i-tblfuncionarios" class="table table-striped table-bordered table-hover" >
                  <thead class="thead-dark">
                    <tr>
                      <th style="text-align:center">  </th>
                      <th width="33%" style="text-align:center"> Funcionário </th>
                      <th width="25%" style="text-align:center"> Email </th>
                      <th width="10%" style="text-align:center"> Unidade </th>
                      <th width="5%" style="text-align:center"> DDD </th>
                      <th width="10%" style="text-align:center"> Fone</th>
                      <th width="10%" style="text-align:center">Ações</th>
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
<div class="modal" tabindex="-1" role="dialog" id="modalatendimento">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Atendimentos com o Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered" id="tableatm">
                    <thead>
                        <th width="100" class="text-right">Ações</th>
                        <th width="50">#ID</th>
                        <th>Data/Hora</th>
                        <th>Data Encer.</th>
                        <th>Atendente</th>
                    </thead>
                </table>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">sair</button>
      </div>
    </div>
  </div>
</div>


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
    $("#sirius-menu").click();
  //cargaFuncionarios(1,'');
    //montarPaginacao();
  });


  function cargaFuncionarios( pagina, texto )
  {
    empresamaster = $("#I-IMB_IMB_IDMASTER").val();
    var texto = $("#i-str").val();
    if  ( texto == '' ) texto = 'TODOSTODOSTODOS';

    var somenteativos = $( '#i-somenteativos' ).prop( "checked" )   ? 'S' : 'N';
    var url = "{{ route('atendente.list') }}"+"/"+empresamaster+'/'+pagina+'/'+texto+'/'+somenteativos;
    console.log( 'url: ---> '+url);
    moment.locale('pt-br');
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
          
          var datademissao   = data[nI].IMB_ATD_DATADEMISSAO;
          var ddd = data[nI].IMB_ATD_DDD1;
          var fone = data[nI].IMB_ATD_TELEFONE_1;
          if ( ddd === null ) ddd='-';
          if ( fone === '' ) fone='-';

          tr = '<tr>';
          if ( datademissao != null ||  data[nI].IMB_ATD_ATIVO == 'I' ) 
            tr = '<tr class="linha-quitado">';

          //alert( 'Data demissao '+datademissao+'  '+tr);

          idatd=data[nI].IMB_ATD_ID;
          avatar = "{{env('APP_URL')}}/storage/images/{{Auth::user()->IMB_IMB_ID}}/usuarios/avatar"+idatd+'.jpg';

//          
          //var statuscode = checkStatus(avatar);
          //if (statuscode != 200)
//            avatar = "{{env('APP_URL')}}/storage/images/{{Auth::user()->IMB_IMB_ID}}/logos/logo_180_135_semimagem.jpg";
          //console.log(avatar);
          linha = 
            tr + 
            '<td><img id="img'+idatd+'" class="img-avatar" src="'+avatar+'" alt="Avatar"  onerror="javascript: avatarSemImagem('+idatd+');" /></td>'+
              '<td style="text-align:left">'+data[nI].IMB_ATD_NOME+'</td>' +
            '<td style="text-align:center valign="center">'+data[nI].email+'</td>' +
            '<td style="text-align:center valign="center">'+data[nI].UNIDADE+'</td>' +
            '<td style="text-align:center valign="center">'+ddd+'</td>' +
            '<td style="text-align:center valign="center">'+fone+'</td>'+
            '<td style="text-align:center" valign="center"> '+
            "  @php  $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Usuarios', 'Usuarios / Colaboradores', 'GERAL', 'Usuários / Colaboradores','S', 'A', 'Botão')@endphp "+
            '  <a href=javascript:alterar('+data[nI].IMB_ATD_ID+') class="glyphicon glyphicon-pencil btn btn-sm btn-primary {{$acesso}}"></a> '+
            "  @php  $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Usuarios', 'Usuarios / Colaboradores', 'GERAL', 'Usuários / Colaboradores','S', 'E', 'Botão')@endphp "+
              '<a  href=javascript:desativar('+data[nI].IMB_ATD_ID+') class="glyphicon glyphicon-trash btn btn-sm btn-danger {{$acesso}}"></a> '+
              '<a href=javascript:atendimentos('+data[nI].IMB_ATD_ID+') class="glyphicon glyphicon-headphones btn btn-sm btn-danger"></a> '+
            '</td> ';

              linha = linha +
                          '</tr>';
          $("#i-tblfuncionarios").append( linha );
        }
      }
    });
  }

  function montarPaginacao()
    { 

      empresamaster = $("#IMB_IMB_IDMASTER").val();
      var texto = $("#i-str").val();
      if  ( texto == '' ) texto = 'TODOSTODOSTODOS';

    
      var url = "{{ route('atendente.count') }}"+"/"+empresamaster+"/"+texto;
      $.ajax({
        url:url,
        datatype:'json',
        async:false,
        success: function( data )
        {
          var totalpaginas = Math.ceil( data / 15);
          console.log('paginas '+totalpaginas);
          linha='"<ul class="pagination">';
          for( nI=1;nI <= totalpaginas;nI++)
          {
            linha+= '<li><a href="javascript:cargaLancamento('+nI+')">'+nI+'</a></li>';

          };
          linha+"</ul>";

          $("#i-div-pagination").html( linha );
        }
      });

    }

    function alterar( id )
    {



        var url = "{{ route('atendente.edit') }}"+"/"+id;

      window.location = url;

    }

    function permissoes( id )
    {

      var url = "{{ route('direito.index') }}"+"/"+id;

      window.location = url;

    }

    function atendimentos( id )
        {

            var url= "{{ route( 'atendimento.listaratdclt' ) }}/"+id+"/0";
            console.log( 'URL: '+url);
            $.ajax(
            {
                url : url,
                type : 'get',
                success: function( data )
                {
                    linha = "";
                    $("#tableatm>tbody").empty();
                    for( nI=0;nI < data.data.length;nI++)
                    {

                        var inicio  = moment( data.data[nI].IMB_ATM_DTHINICIO).format('DD-MM-YYYY HH:mm');
                        var termino  = data.data[nI].IMB_ATM_DTHFIM;

                        if ( termino != null ) 
                            termino = 'Encerrado'
                        else
                            termino=moment( termino ).format('DD-MM-YYYY HH:mm');

                        if( termino == 'Invalid date' )
                           termino = '-';

                        linha = 
                            '<tr>'+
                            '<td style="text-align:center" valign="center"> '+
                                '<a href=javascript:visualizarAtm('+data.data[nI].VIS_ATM_ID+') class="btn btn-sm btn-primary">'+
                                '<span class="glyphicon glyphicon-search"></span></a> </td> '+
                            '<td style="text-align:center valign="center">'+data.data[nI].VIS_ATM_ID+'</td>' +
                            '<td style="text-align:center valign="center">'+inicio+'</td>' +
                            '<td style="text-align:center valign="center">'+termino+'</td>'+
                            '<td style="text-align:center valign="center">'+data.data[nI].IMB_ATD_NOME+'</td>' +
                            '</tr>';
                        $("#tableatm").append( linha );
                    }
                },
                error: function()
                {
                    alert('error');
                }
            });            


            $("#modalatendimento").modal('show');
        }

        function visualizarAtm( id )
        {
            window.location = "{{ route('atendimento.atendimento') }}/" + id;            
        }

        function novo()
        {
            window.location = "{{ route('atendente.novo') }}";
        }

        function desativar( id )
        {
        if (confirm("Confirma a Inativação?") == true) 
          {
            $.ajaxSetup(
              {
                  headers:
                  {
                  'X-CSRF-TOKEN': "{{csrf_token()}}"
                  }
              });

            var url = "{{route('atendente.desativar')}}";

            var dados = { IMB_ATD_ID : id };

            $.ajax(
              {
                url:url,
                dataType:'json',
                type:'post',
                data:dados,
                async:false,
                success:function()
                {

                  alert('Inativado');
                  cargaFuncionarios();
                },
                error:function( )
                {
                  alert('Houve um erro na inativação!');
                }
              }
            )

          }
        }

        function pegarAvatar( id)
        {
          return '<div>'+id+'</div>';

        }

        function checkStatus(imageUrl) 
      {
      var http = jQuery.ajax(
      {
          type:"HEAD",
          url: imageUrl,
        //  async: false
        })
      return http.status;

}        
function avatarSemImagem( id )
      {
          $("#img"+id).attr('src', "https://www.siriussystem.com.br/assets/img/semavatar.png");
      }

</script>



@endpush