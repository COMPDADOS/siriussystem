<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="{{route('besoft.agendarvistoria')}}">
        @csrf
        <input type="text" name="csrf" value="{{csrf_token()}}">
        <button type="submit" >Agenda Vistoria</button>
    </form>        
    
</body>
</html>