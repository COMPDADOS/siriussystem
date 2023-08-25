<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>    
    <script src="//cdn.ckeditor.com/4.17.1/full/ckeditor.js"></script>    
    <script src="https://kit.fontawesome.com/1cda1b1db5.js" crossorigin="anonymous"></script>    
    <style>
        p {
    margin: 0;
}
        .verticalLine 
        {
            border-left: thick solid #ff0000;
        }
        .campos
        {
            color:white;
            background-color:blue;
        }

    </style>        
</head>
<body>
    <div class="content">
        <form>
            <hr>
            <div class="col-md-12">
                            <a title="Novo Documento" href=""><img src="{{asset('/global/img/novo_documento.png')}}" alt=""></a>
                            <a title="Abrir Documento" href=""><img src="{{asset('/global/img/abrirdocumento.png')}}" alt=""></a>
                            <a title="Salvar Documento" href=""><img src="{{asset('/global/img/salvardocumento.png')}}" alt=""></a>
                            <select class="form-control campos" id="i-select">
                            </select>
            </div>
            <div class="col-md-12">
                <textarea class="form-control" name="editor1" id="editor1" rows="20" cols="80">
                    
                </textarea>
            </div>
            <hr>
            <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>            
            <script>
            $(document).ready(function() 
            {
                CKEDITOR.replace( 'editor1' );
                CKEDITOR.config.removeButtons = 'Source, New, save,Preview,Find,About,Maximize,ShowBlocks';                
                CKEDITOR.config.removePlugins = 'elementspath';

                $("#i-select").change( function() 
                {
                CKEDITOR.instances.editor1.insertText( '<<'+$("#i-select").val()+'>>' );
                })

                cargaCampos();
            });

            function cargaCampos()
            {
                var url = "{{route('camposmesclagem')}}";

                $.getJSON( url, function( data )
                {
                    $("#i-select").empty();
                
                    linha =  '<option value="-1">Escolha o campo</option>';
                    $("#i-select").append( linha );
                    for( nI=0;nI < data.length;nI++)
                    {
                        linha = 
                            '<option value="'+data[nI].IMB_CMP_NOMEDOCAMPO+'">'+
                        data[nI].IMB_CMP_DESCRICAO+"</option>";
                        $("#i-select").append( linha );

                    }
                });
            }

            </script>
        </form>
    </div>        

    
</body>
</html>