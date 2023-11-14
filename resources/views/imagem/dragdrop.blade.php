@extends('layout.app')

@section('scripttop')
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

<style>
    .sortable {
  padding: 0;
  -webkit-touch-callout: none;
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
.sortable li {
			float: left;
			width: 120px;
			height: 120px;
    overflow:hidden;
    border:1px solid red;
			text-align: center;
      margin:5px;
		}
	li.sortable-placeholder {
			border: 1px dashed #CCC;
			background: none;
		}
    .div-center
    {
        text-align:center;
    }
    .img-album
        {
            width: 100%;
            height: 300px;
            border-radius: 50%;
        }
    div.outset 
    {
        border-style: groove;;
    }
    div.inset
    {
        border-style: groove;
    }
    .bg-inativo
{
    background-color:#f5c9ce;
}



</style>
@endsection

@section('content')
<div class="container-fluid">
    <br />
        <h3 align="center">Enviar Imagens</h3>
    <br />
        
    <input type="hidden" id="i-imagem-pendente">
    <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Selecione uma ou várias imagens</h3>
        </div>
        <div class="panel-body">
          <form id="dropzoneForm" class="dropzone" action="{{ route('imagensimoveisdragdrop') }}">
                <input type="hidden" name="id" id="i-imv-dragdrop" value="{{$id}}">
                <input type="hidden" name="tipo" id="i-tipo" value="{{$tipo}}">
            @csrf
          </form>
          <div align="center">
              <button type="button" class="btn btn-info" id="submit-all">Upload</button>
              <button type="button" class="btn btn-info" onClick="fecharDragDrop()">Fechar</button>
          </div>
        </div>
    </div>
    <br />
    <div>
        <div class="container">
            <div class="col-md-12">
                <h3 class="main-title div-center">Imagens Enviadas</h3>
            </div>
            <div id="galeria-imovel"></div>
        </div>
    </div>

</div>
@include('layout.modalimagem')
@endsection

@push('script')

<script>
Dropzone.options.dropzoneForm = {
    autoProcessQueue : false,
    acceptedFiles : ".png,.jpg,.gif,.bmp,.jpeg",
    parallelUploads: 20,
    init:function()
    {
      var submitButton = document.querySelector("#submit-all");
      myDropzone = this;

      this.on("addedfile", function(file) {  $("#i-imagem-pendente").val('1');});

      submitButton.addEventListener('click', function(){
        $("#i-imagem-pendente").val('0');
        myDropzone.processQueue();
      });

      this.on("complete", function(){
        if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
        {
          var _this = this;
          _this.removeAllFiles();
          $("#i-imagem-pendente").val('0');
        }
        CarregarImagens();
      });

    }

  };
function CarregarImagens()
    {
        debugger;
        nId = $("#i-imv-dragdrop").val();

        $("#galeria-update-btn").hide();   
        var url = "{{ route( 'imagens.imoveis')}}/"+nId;
        tipo = 'imoveis';
        if( $("#i-tipo").val() == 'C' )
        {
            tipo='condominios';
            var url = "{{ route( 'imagens.condominios')}}/"+nId;
        }

        console.log( url );
            

        
        var empresa = "{{Auth::user()->IMB_IMB_ID}}";
//        console.log('imagens '+url );
        $.getJSON( url, function( data)
        {
            $( "#galeria-imovel" ).empty();
            contador = 4;
            texto='';
            for( nI=0;nI < data.length;nI++)
            {

                if( data[nI].IMB_IMG_PRINCIPAL !='S')
                    principal = '<a title="Definir essa imagem como a imagem principal" href=javascript:imagemPrincipal('+data[nI].IMB_IMV_ID+','+
                                    data[nI].IMB_IMG_ID+') class="btn btn-sm btn-warning"><i class="fa fa-check-square-o" aria-hidden="true"></i></a> '
                else
                    principal +
                        '<a class="btn btn-sm btn-success">Principal</a> ';

                texto = '<div class="col-md-3">'+
                        '   <div class="card">'+
                        '       <div class="card-body"> '+
                        '          <h5 class="card-title div-center">'+data[nI].IMB_IMG_NOME+'</h5>' +
                        '       </div> '+
                        '       <img class="img-album" src={{url('')}}/storage/images/'+empresa+'/'+tipo+'/'+data[nI].IMB_IMV_ID+'/'+data[nI].IMB_IMG_ARQUIVO+'>'+
                        '       <a title="Alterar ou complementar informações para esta imagem" href=javascript:editarImagem('+data[nI].IMB_IMG_ID+') class="btn btn-sm btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>'+
                        '       <a title="Excluir a imagem" href=javascript:apagarImagem('+data[nI].IMB_IMG_ID+') class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>'+
                        principal+
                        '   </div> '+
                        '</div>';

                /*
                texto = 
                    '<div class="col-md-3 inset">'+
                    '   <div class="card">'+
                    '       <a title="Alterar ou complementar informações para esta imagem" href=javascript:editarImagem('+data[nI].IMB_IMG_ID+') class="btn btn-sm btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>'+
                    '       <a title="Excluir a imagem" href=javascript:apagarImagem('+data[nI].IMB_IMG_ID+') class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>'+
                    principal+
                    '       <img class="img-album card-img-top" src="{{url('')}}/storage/images/'+
                        empresa+'/imoveis/'+data[nI].IMB_IMV_ID+'/'+data[nI].IMB_IMG_ARQUIVO+'">';

                var nome = data[nI].IMB_IMG_NOME;
                if( nome == null)
                    nome = "&nbsp;";
                        
                texto = texto + '<p>'+nome+'</p>'
                        
                texto = texto +'</div></div>';

*/
                $( "#galeria-imovel" ).append( texto );                
                
                
/*                
                var detalhes ='<hr><ul>';


                var capa= data[nI].IMB_IMG_CAPA;
                if( capa == 'S')
                    detalhes = detalhes +'<li>Capa</li>';

                var principal= data[nI].IMB_IMG_CAPA;
                if( principal == 'S')
                detalhes = detalhes +'<li>Imagem Principal</li>';

                var naoirprosite= data[nI].IMB_IMG_NAOIRPROSITE;
                if( naoirprosite == 'S')
                    detalhes = detalhes +'<li>Não ir pro Site</li>';
                    naoirprosite = 'Fora do Site';

                detalhes = detalhes +'</ul>';

                var nome = data[nI].IMB_IMG_NOME;
                if( nome == null)
                    nome = "";
                linha =
                        '<tr>'+
                        '<td><a href=javascript:carrousel('+data[nI].IMB_IMG_ID+')><img class="img-mini" src="{{url('')}}/storage/images/'+
                        $("#I-IMB_IMB_IDMASTER").val()+'/imoveis/thumb/'+data[nI].IMB_IMV_ID+'/100_75'+data[nI].IMB_IMG_ARQUIVO+'"</a></td>'+
                        '<td style="text-align:center valign="center">'+nome+detalhes+'</td>' +
                        '<td style="text-align:center" valign="center"> '+
                            '<a href=javascript:editarImagem('+data[nI].IMB_IMG_ID+') class="btn btn-sm btn-primary">Editar</a> '+
                            '<a href=javascript:apagarImagem('+data[nI].IMB_IMG_ID+') class="btn btn-sm btn-danger">Excluir</a> ';

                if( data[nI].IMB_IMG_PRINCIPAL !='S')
                    linha = linha +
                                '<a href=javascript:imagemPrincipal('+data[nI].IMB_IMV_ID+','+
                                data[nI].IMB_IMG_ID+') class="btn btn-sm btn-default">Definir</a> '+
                            '</td> ';
                else
                    linha = linha +
                                '<a class="btn btn-sm btn-success">Definida</a> '+
                            '</td> ';
                    linha = linha +
                        '</tr>';

                $("#tblimagens").append( linha );
*/

            }


        });
    }
    function imagemPrincipal( idimovel, idimagem)
    {
        $.ajaxSetup({
            headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
            });

            var url = "{{ route('imagem.principal') }}"+"/"+idimovel+"/"+idimagem;

        $.ajax(
            {
                type: "post",
                url: url,
                context: this,
                success: function()
                {
                    CarregarImagens(idimovel );
                },
                error: function( error )
                {
                    console.log(error);
                }

        });


    }

    function apagarImagem( id )
    {
        if (confirm("Tem certeza que deseja excluir a Imagem?"))
        {

            $.ajaxSetup({
            headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
            });

            var url = "{{ route('imagem.apagar') }}"+"/"+id;
            console.log( url );
            $.ajax
            (
                {
                    type: "get",
                    url: url,
                    context: this,
                    success: function(){
                        CarregarImagens( $("#IMB_IMV_ID").val() );
                    },
                    error: function( error ){
                        console.log(error);
                    }
                }
            );
            }

    }

    function editarImagem( id )
    {

        var url = "{{ route('imagem.editar') }}"+"/"+id;
        $.getJSON( url, function( data)
        {
            $("#i-idimg").val(data.IMB_IMG_ID);
            $("#i-nomeimagem").val(data.IMB_IMG_NOME);
            $("#i-idimovel-img").val(data.IMB_IMV_ID);
            $("#i-imagemprincipal" ).prop( "checked", (data.IMB_IMG_PRINCIPAL =='S') );
            $("#i-imagemnaoirsite").prop( "checked", (data.IMB_IMG_NAOIRPROSITE =='S') );
            $("#i-imagemcapa").prop( "checked", (data.IMB_IMG_CAPA =='S') );
//            setarSelectCorretor(data.IMB_ATD_ID);
            $("#modalimagem").modal('show');
        });

    }

    function fecharDragDrop()
    {
        if( $("#i-imagem-pendente").val() == '1' ) 
        {
            if( confirm('Você selecionou imagens mas ainda não fez o upload. Se continuar irá perder as imagens selecionadas! Click no botão UPLOAD para confirmar o envio! Posso cancelar as imagens?') == true )
                window.close()
            else
                return false;
        };

        window.close();
    }

    CarregarImagens();

</script>



@endpush