<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Processo Automatico - Boletos</title>
</head>
<body>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="{{asset('/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
    
<script>

function enviarVariosBoletosJson()
{
   
        
        var time = new Date();
        var outraData = new Date();
        outraData.setDate(time.getDate() + 10); // Adiciona 15 dias        
        datafim = moment( outraData).format( 'YYYY/MM/DD');

        var dados = 
        {
            datainicio  : moment().format( 'YYYY/MM/DD'),
            datafim     :  datafim,
        }

        var url = "{{route('boleto.periodo.email.json')}}";
        console.log(url);

        $.ajax
        (
            {
                url:url,
                dataType:'json',
                type:'get',
                data:dados,
                async:false,
                success:function( data )
                {
                    for( nI=0;nI < data.length;nI++)
                    {
                        setTimeout(function(){ 


                        }, 10000); 
                        
                        if( data[nI].EMAIL  != '' )
                            enviarBoletoPorEmailJson( data[nI].IMB_CGR_ID,data[nI].FIN_CCI_BANCONUMERO, data[nI].EMAIL);
                        
                    };


                },
                complete:function()
                {
                }
            }
        )

   
    
    

}

function enviarBoletoPorEmailJson( id, banco, email)
{
    //console.log('enviarBoletoPorEmailJson');
//    alert('mail '+email );
 if( email == '')
   return false;

  var url = '';
  var erro = 1;



  if( banco ==  1 )
  {
     url ="{{route('boleto.001')}}/"+id+'/S/'+email;
     $.ajax(
       {
         url    : url,
         dataType: 'json',
         type:'get',
         async:false,
         beforeSend: function()
         {
        },
         success:function()
         {
            $("#preloader").hide();
          erro=0;
         },
         error:function()
         {
         }
       }
     );
  }
  if( banco == 33 )
  {
     url ="{{route('boleto.santander')}}/"+id+'/S/'+email;
     console.log('ATENCAO: '+url );
     $.ajax(
       {
         url    : url,
         dataType: 'json',
         type:'get',
         async:false,
         success:function()
         {
          erro=0;
          $("#preloader").hide();
         },
         error:function(request, status, error)
         {
            //alert(request.responseText);
         }
       }
     );
  }
  if( banco == 748 )
  {
     url ="{{route('boleto.748')}}/"+id+'/S/'+email;
     $.ajax(
       {
         url    : url,
         dataType: 'json',
         type:'get',
         async:false,
         success:function()
         {
//          alert('Email enviado!');
//          $("#modalenviandoemail").hide();
          //$("#preloader").hide();

          erro=0;

         },
         error:function(request, status, error)
         {
//           alert(request.responseText);
         }
       }
     );
  }

  if( banco == 756 )
  {
     url ="{{route('boleto.756')}}/"+id+'/S/'+email;
     $.ajax(
       {
         url    : url,
         dataType: 'json',
         type:'get',
         async:false,
         success:function()
         {
  //        alert('Email enviado!');
          //$("#preloader").hide();

          $("#modalenviandoemail").hide();
          erro=0;

         }
       }
     );
  }

  
  if( banco == 341 )
  {
    debugger;
     url ="{{route('boleto.itau')}}/"+id+'/S/'+email;
     $.ajax(
       {
         url    : url,
         dataType: 'json',
         type:'get',
         async:false,
         success:function()
         {
         // alert('Email enviado!');
         //$("#preloader").show();
         //$("#div-email").val('Email: '+email );
          erro=0;

         },
         error:function(data)
         {

//            alert('erro');
            console.log(data);

         }
       }
     );
  }
  if( banco == 84 )
  {
     url ="{{route('boleto.084')}}/"+id+'/S/'+email;
     $.ajax(
       {
         url    : url,
         dataType: 'json',
         type:'get',
         async:false,
         success:function()
         {
//          alert('Email enviado!');
          //$("#modalenviandoemail").hide();
          erro=0;

         }
       }
     );
  }

  if( banco == 237 )
  {
     url ="{{route('boleto.237')}}/"+id+'/S/'+email;
     $.ajax(
       {
         url    : url,
         dataType: 'json',
         type:'get',
         async:false,
         success:function()
         {
//          alert('Email enviado!');
//          $("#modalenviandoemail").hide();
          //$("#preloader").hide();

          erro=0;

         }
       }
     );
  }


///  if( erro == 1 )
    //alert('Email não enviado. Verifique se o endereço de email está correto!');
  
}

enviarVariosBoletosJson();

</script>

</body>

</html>
