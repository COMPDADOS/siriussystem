

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sirius System - Compdados Tecnologia em Sistemas Ltda</title>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

    <style type="text/css">
	      #imgpos
         {
        width:100%;
        height:100%;
		}
</style>
</head>
<body>

<div class="container">

  <div class="row">
    <div class="col mx-auto text-center">
     <a href="{{route('home')}}"> 
                                          
      <img class="img-responsive" src="{{url('')}}/storage/images/ate_breve.jpg" id="imgpos">
     </a> 
    </div>
  </div>

</div>
    

<script>

    ateBreve();
   
   function ateBreve()
   {
      
    setTimeout(function () {
        window.location.href = "{{env('APP_URL')}}";
    }, 3000); 
    
   }

</script>

</body>
</html>