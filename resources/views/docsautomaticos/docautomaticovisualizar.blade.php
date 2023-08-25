@extends('layout.app')

@section('scripttop')
    <link href="{{asset('/global/plugins/bootstrap-colorpicker/css/colorpicker.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/global/plugins/jquery-minicolors/jquery.minicolors.css')}}" rel="stylesheet" type="text/css" />
    <script src="https://cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>
    <link href="{{asset('/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

      
<style>
    .div-center
    {
        text-align:center;
    }
    .div-nomedoc
    {
        font-size:20px;
        color:black;
        font-weight: bold;        
    }

</style>
@endsection


@section('content')

<div class="row">
    <div class="col-md-12 div-center">Nome do Documento
        <input type="hidden" id="GER_DCA_ID" value="{{$dca->GER_DCA_ID}}">
        <input class="form-control div-center" type="text" id="GER_DCA_NOME" value="{{$dca->GER_DCA_NOME}}">
    </div>
</div>

<div class="col-md-12">
    <div class="col-md-3">
        <label class="control-label">Tipo de Documento(<b>padrões</b>)</label>
        <select class="form-control" id="i-tipo-documento">
            <option value=""></option>
            <option value="cartacobrancalocatar">Usar como Carta Cobrança Locatário</option>
            <option value="emailcobrancalocatar">Usar como Email Cobrança Locatário</option>
            <option value="cartacobrancafiador">Usar como Carta Cobrança Fiador</option>
            <option value="emailcobrancafiador">Usar como Email Cobrança Fiador</option>
            <option value="emailreajustefiador">Usar como Email Aviso Reajuste Fiador</option>
            <option value="emailreajustelocatar">Usar como Email Aviso Reajuste Locatário</option>
            <option value="emaillocatarioimportante">Usar como Email Aviso Importante ao Locatário</option>
            <option value="avisodesocupacao">Usar como Aviso de Desocupação</option>
            
        </select>
        <hr>
        <select class="select2" id="selcampos">
            
        </select>
        <button class="btn btn-info form-control" onClick="incluirCampo()">Incluir o Campo</button>
        <hr>
        <button class="btn btn-success form-control" onClick="salvar()">Salvar Documento</button>
        <button class="btn btn-danger form-control">Sair sem Salvar</button>
        <hr>
        <div class="col-md-12 div-center">
            <h5>Utilizarei um padrão usando o MS-Word</h5>
            <input class="form-control" type="checkbox" id="i-padrao-word">
        </div>
        <div class="col-md-12 escondido" id="div-word">
            <h5>Nome do Arquivo Modelo</h5>
            <input type="text" class="form-control" id="i-upload">
            <h5>Nome do Arquivo Gerado</h5>
            <input type="text" class="form-control" id="i-download">
            <h5 class="div-center">Click no botão abaixo para upload do arquivo</h5>
            <button class="form-control btn btn-primary">Upload</button>

        </div>
    </div>
    <div class="col-md-9">
        <textarea class="escondido" name="editor1" id="GER_DCA_TEXTO" value="{{$dca->GER_DCA_TEXTO}}"></textarea>
    </div>        
</div>


@endsection

@push('script')

<script src="{{asset('/global/plugins/jquery-minicolors/jquery.minicolors.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/components-color-pickers.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>

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
    $(".select2").select2({
            placeholder: 'Selecione',
            width: null
        });

    $("#i-padrao-word").change( function()
    {
        if( $("#i-padrao-word").prop( "checked" ) )
            $("#div-word").show()
        else
            $("#div-word").hide();

    })
    cargaDocumento();  
    cargaCampos();      

   
});

function incluirCampo()
{
    if( $("#selcampos").val() == '' ) 
    {
        alert( 'Selecione o campo desejgado');
        return false;
    }
    var valor = $("#selcampos").val();
    CKEDITOR.instances['GER_DCA_TEXTO'].insertText( valor );
    $("#GER_DCA_TEXTO").show();    
};


function salvar()
{
    var url = "{{route('docsautomaticos.salvar')}}";

    var dados =
    {
        GER_DCA_ID : $("#GER_DCA_ID").val(),
        GER_DCA_NOME : $("#GER_DCA_NOME").val(),
        GER_DCA_TEXTO : CKEDITOR.instances.GER_DCA_TEXTO.getData(),
        GER_DCA_TIPO:$("#i-tipo-documento").val(),
        GER_DCA_UPLOAD:$("#i-upload").val(),
        GER_DCA_DOWNLOAD:$("#i-download").val(),
        GER_DCA_WORD : $("#i-padrao-word").prop( "checked" ) ? 'S' : 'N',
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

function cargaDocumento()
{
    var id = $("#GER_DCA_ID").val();
    var url = "{{route('docsautomaticos.buscar')}}/"+id;

    $.ajax(
        {
            url:url,
            dataType:'json',
            type:'get',
            success:function( data )
            {
                console.log( data );
                $("#GER_DCA_NOME").val(data.GER_DCA_NOME);
                $("#i-tipo-documento").val(data.GER_DCA_TIPO);
                $("#i-upload").val(data.GER_DCA_UPLOAD);
                $("#i-download").val(data.GER_DCA_DOWNLOAD);
                $("#div-word").hide();
                $("#i-padrao-word").prop( "checked", false ) ;
                if( data.GER_DCA_WORD == 'S')
                {
                    $("#i-padrao-word").prop( "checked", true ) 
                    $("#div-word").show();
                }
                    

                CKEDITOR.instances.GER_DCA_TEXTO.setData(data.GER_DCA_TEXTO)
            }
        });
}

function cargaCampos()
{
    var url = "{{ route('docsautomaticos.camposmesclagem')}}";
    $.getJSON( url, function( data )
    {
        $("#selcampos").empty();
        linha = '<option value=""></option>';
        $("#selcampos").append( linha );
        for( nI=0;nI < data.length;nI++)
        {
            if( data[nI].GER_CMM_NOMECAMPO != null )
            {
                var nomecampo = data[nI].GER_CMM_NOMECAMPO;

  //              nomecampo = nomecampo.replace( "**","");
//                nomecampo = nomecampo.replace( "**","");
                console.log( nomecampo );
                linha = 
                    '<option title="'+data[nI].GER_CMM_DESCRICAO+'" '+ 
                    'value="'+nomecampo+'">'+data[nI].GER_CMM_DESCRICAO+"</option>";
                    $("#selcampos").append( linha );
            }
        }

    });
                
}




</script>
@endpush




