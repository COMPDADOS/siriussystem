<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="/css/app.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    
    </head>        
    <body>
        <div class="container">
        <div class="form-group">
                <label for="tipoimovel">Selecione tipo</label>
                <select name="tipo_id" id="i-tipo" class="form-control">
                @foreach( $tipoimovel as $key =>$tipo )
                    <option value="{{$key}}" >{{$tipo}}</option>
                @endforeach
                </select>
            </div>
        </div>
        
    <script>
        $(document).ready( function(){
            $('#i-tipo').select2({
                placeholder : "Selecione o cliente"
            });


        })  
     </script>
        
    </body>


</html>
