

@extends('layout.app')

@section('scripttop')
    <link href="{{asset('/global/plugins/bootstrap-colorpicker/css/colorpicker.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/global/plugins/jquery-minicolors/jquery.minicolors.css')}}" rel="stylesheet" type="text/css" />
    <script src="https://cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>


<style>
@page {
    margin-top: 0cm;
    margin-bottom : 0cm;
}     
    .div-center
    {
        text-align:center;
    }
    .div-nomedoc
    {
        font-size:20px;
        color:white;
        background-color:blue;
        font-weight: bold;
        text-align:center;

    }

    p { margin-bottom:-5px;margin-top:-5px; }


</style>
@endsection


@section('content')

<div class="row">
    <input type="hidden" id="mesc-idimovel">
    <input type="hidden" id="mesc-idcliente">
    <input type="hidden" id="mesc-idcontrato">
    <div class="col-md-12">
        <div class="col-md-2">
            <button title="Salvar" class="btn btn-secondary"
            class="form-control" onClick="salvar()"><i class="fa fa-save" style="font-size:40px"></i></button>
        </div>
        <input type="hidden" id="GER_DCG_ID" value="{{$iddoc}}">
        <input class="form-control div-nomedoc" type="text" id="GER_DCA_NOME" value="{{$titulo}}">
    </div>
</div>

<div class="col-md-12">
    <textarea class="escondido" name="editor1" id="GER_DCA_TEXTO"></textarea>
</div>


@endsection

@push('script')

<script src="{{asset('/global/plugins/jquery-minicolors/jquery.minicolors.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/components-color-pickers.min.js')}}" type="text/javascript"></script>

<script>

$( document ).ready(function()
{
    $("#sirius-menu").click();
    CKEDITOR.replace( 'editor1',
    {
      height: 400,
      baseFloatZIndex: 10005,
      removeButtons: 'PasteFromWord'
    });

    CKEDITOR.config.removePlugins = "elementspath";
    CKEDITOR.config.resize_enabled = false;    
    CKEDITOR.editorConfig = function( config )
    {
    	config.saveFunction = function(data) 
        {
    	},
        config.applicationTitle = false;        
    };
    $(".select2").select2({
            placeholder: 'Selecione',
            width: null
        });

    cargaDocumentoMesclado();


});



function cargaDocumentoMesclado()
{
    var id = $("#GER_DCG_ID").val();
    var url = "{{route('docsautomaticos.documentomescladobuscar')}}/"+id;

    $.ajax(
        {
            url:url,
//            dataType:'json',
            type:'get',
            contentType: "application/json; charset=utf-8",
            async:false,

            success:function( data )
            {
                console.log( data );
                CKEDITOR.instances.GER_DCA_TEXTO.setData(data)
                $("#GER_DCA_TEXTO").show();
            },
            complete:function()
            {
            }
        });
}

function salvar()
{
    var url = "{{route('docsautomaticos.salvarmesclado')}}";

    var dados =
    {
        GER_DCG_ID : $("#GER_DCG_ID").val(),
        GER_DCA_NOME : $("#GER_DCA_NOME").val(),
        GER_DCA_TEXTO : CKEDITOR.instances.GER_DCA_TEXTO.getData(),
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
                alert( 'gravado!');
            }
        });

}



</script>
@endpush




