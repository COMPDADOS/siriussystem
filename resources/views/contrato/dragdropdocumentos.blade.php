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
        <h3 align="center">Enviar Arquivos Digitais</h3>
    <br />
        
    <input type="hidden" id="i-imagem-pendente">
    <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Selecione um ou vários arquivos</h3>
        </div>
        <div class="panel-body">
          <form id="dropzoneForm" class="dropzone" action="{{ route('imagensimoveisdragdropdocumentos') }}">
              <input type="hidden" name="id" id="IMB_CTR_ID_NODANE" value="{{$idcontrato}}">
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
                <h3 class="main-title div-center">Documentos Enviados</h3>
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
    acceptedFiles : "image/*,application/pdf, .png,.jpg,.gif,.bmp,.jpeg, .pdf, .txt, .docx .xlsx, .doc, .xls",
    parallelUploads: 20,
    init:function(){
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
        window.close();//CarregarImagens();
      });

    }

  };
function CarregarImagens()
    {
        nId = $("#IMB_CTR_ID_NODANE").val();

        $("#galeria-update-btn").hide();        
        var url = "{{ route( 'contrato.anexos.carga')}}/"+nId;

        var empresa = "{{Auth::user()->IMB_IMB_ID}}";
//        console.log('imagens '+url );
        $.getJSON( url, function( data)
        {
            $( "#galeria-imovel" ).empty();
            contador = 4;
            texto='';
            for( nI=0;nI < data.length;nI++)
            {

                texto = '<div class="col-md-3">'+
                        '   <div class="card">'+
                        '       <div class="card-body"> '+
                        '          <h5 class="card-title div-center">'+data[nI].IMB_CTA_DESCRICAO+'</h5>' +
                        '       </div> '+
                        '       <img class="img-album" src={{url('')}}/storage/documentos/'+empresa+'/contratos/'+data[nI].IMB_CTR_ID+'/'+data[nI].IMB_CTA_NOMEARQUIVO+'>'+
                        '       <a title="Alterar ou complementar informações para esta imagem" href=javascript:editarImagem('+data[nI].IMB_CTA_ID+') class="btn btn-sm btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>'+
                        '       <a title="Excluir a imagem" href=javascript:apagarImagem('+data[nI].IMB_CTA_ID+') class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>'+
                        '   </div> '+
                        '</div>';

                $( "#galeria-imovel" ).append( texto );                
                

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

</script>



@endpush