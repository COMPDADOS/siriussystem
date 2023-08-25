<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 4.7.5
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="pt-br">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
    <script src="{{asset('/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
    <link href="{{asset('/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />


<style>


th, td{
    vertical-align: middle !important; /* alinha verticalmente */
    height: 36px; /* altura customizada da celula */
    padding: 0 16px !important; /* 0 de padding na vertical e 16px na horizontal */
}

.lbl-medidas {
  text-align: center;
  font-size: 14px;
  
}
.lbl-medidas-valores {
  text-align: center;
  font-size: 14px;
  font-weight: bold;
  color: #4682B4; 
}

.div-border-blue-center{
    border:solid 1px #4682B4;
    text-align: center;
}
.lbl-medidas-outrositens {
  text-align: left;
  font-size: 12px;
  color: #4682B4; 
}

.cardtitulo {
  text-align: left;
  font-size: 16px;
  color: #4682B4; 
  font-weight: bold;

}

.lbl-medidas-left {
  text-align: left;
  font-size: 16px;
  font-weight: bold;

}

hr {
    height: 2px;
}

div .half-size-line
{
    line-height: 92%;
}

H-LEFT {
    text-align: left;
    color: #4682B4 ; 
    font-size: 16px;
    font-weight: bold;

}


h5 {
    text-align: center;
}

H5 {
    text-align: center;
    color: #4682B4 ; 
    font-size: 30px;
    font-weight: bold;

}

h4 {
  text-align: center;
}

h4-center-17 {
  text-align: center;
  font-size: 17px;
}

@media screen {
  #printSection {
      display: none;
      font-weight: bold;
  }
}

TH {
    text-align: center;
    width: 120px;
}
@media print {
  body * {
    visibility:hidden;
  }
  #printSection, #printSection * {
    visibility:visible;
  }
  #printSection {
    position:absolute;
    left:0;
    top:0;
  }
}
</style>
</head>

<body>

<input type="hidden" id="i-id-imovel" value="{{$id}}">
<p>
  <H5>Informações Sobre o imóvel {{$id}}</H5>
</p>  
<p>
  <label id="i-endereco-imovel"></label>
  <br>
  <label id="i-bairro-imovel"></label>
  <br>
  <label id="i-condominio-imovel"></label>
</p>

</body>

<script src="{{asset('/global/plugins/jquery.min.js')}}" type="text/javascript"></script>

<script>

  function pegarImovel()
  {
    var url = "{{ route('imovel.mostrar')}}/"+$("#i-id-imovel").val();
    $.ajax
    ({
      type: "get",
      url: url,
      dataType: "json",
      context: this,
      success: function( data )
      {  
        var endereco = '';                   
        if( data[0][ 'IMB_IMV_NUMAPT'] != '' )
        {
          endereco =  'Endereço: '+data[0][ 'IMB_IMV_ENDERECOTIPO']+' ' + 
              data[0][ 'IMB_IMV_ENDERECO']+' ' + 
              data[0][ 'IMB_IMV_ENDERECONUMERO']+' Apto: ' + 
              data[0][ 'IMB_IMV_NUMAPT']+' ' + 
              data[0][ 'IMB_IMV_ENDERECOCOMPLEMENTO'];
        }
        else
        {
          endereco = 'Endereço: '+data[0][ 'IMB_IMV_ENDERECOTIPO']+' ' + 
              data[0][ 'IMB_IMV_ENDERECO']+' ' + 
              data[0][ 'IMB_IMV_ENDERECONUMERO']+' ' + 
              data[0][ 'IMB_IMV_ENDERECOCOMPLEMENTO']
        
        };

        $("#i-endereco-imovel").html( endereco );
        $("#i-bairro-imovel").html('');
        $("#i-condominio-imovel").html('');
        
        if( data[0][ 'CEP_BAI_NOME'] != '' )
        {
          $("#i-bairro-imovel").html('Bairro: '+data[0][ 'CEP_BAI_NOME']);
        }

        if( data[0][ 'CONDOMINIO'] != '' )
        {
          $("#i-condominio-imovel").html( 'Condomínio: '+
                data[0][ 'CONDOMINIO']);
        };
             
      }
    });
  }

  pegarImovel();

</script>