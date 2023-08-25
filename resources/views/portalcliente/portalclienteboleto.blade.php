
<!DOCTYPE html>
<html>
<head>
    <title>Login 1 | Admire</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" href="{{asset('/portalclientes/img/logo1.ico')}}"/>
    <!--Global styles -->
    <link type="text/css" rel="stylesheet" href="{{asset('/portalclientes/css/components.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('/portalclientes/css/custom.css')}}" />
    <!--End of Global styles -->
    <!--Plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('/portalclientes/vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('/portalclientes/vendors/wow/css/animate.css')}}"/>
    <!--End of Plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('/portalclientes/css/pages/login1.css')}}"/>
    <style>
        .font-branca
        {
            color:white;
        }
    </style>
</head>
<body>
<div class="preloader" style=" position: fixed;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  z-index: 100000;
  backface-visibility: hidden;
  background: #ffffff;">
    <div class="preloader_img" style="width: 200px;
  height: 200px;
  position: absolute;
  left: 48%;
  top: 48%;
  background-position: center;
z-index: 999999">
        <img src="{{asset('/portalclientes/img/loader.gif')}}" style=" width: 40px;" alt="loading...">
    </div>
</div>
<div class="container wow fadeInDown" data-wow-delay="0.5s" data-wow-duration="2s">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 login_top_bottom">
            <div class="row">
                <div class="col-lg-5  col-md-8  col-sm-12 mx-auto">
                    <div class="login_logo login_border_radius1">
                        <h4 class="text-center font-branca">
                                {{$imb->IMB_IMB_NOME}}</span>
                        </h4>
                    </div>
                    <div class="bg-white login_content login_border_radius">
<!--                        <form  class="login_validator">-->
                            <div class="form-group">
                                <label for="i-cpf" class="col-form-label"> CPF ou CNPJ</label>
                                <div class="input-group input-group-prepend">
                                    <span class="input-group-text border-right-0 rounded-left "><i
                                            class="fa fa-envelope text-primary"></i></span>
                                    <input type="text" class="form-control  form-control-md" id="i-cpf" name="cpf" placeholder="Somente Número"
                                    onkeypress="return isNumber(event)" onpaste="return false;"/>
                                </div>
                            </div>
                            <!--</h3>-->
                            <div class="form-group">
                                <label for="password" class="col-form-label">Senha</label>
                                <div class="input-group input-group-prepend">
                                    <span class="input-group-text border-right-0 rounded-left addon_password"><i
                                            class="fa fa-lock text-primary"></i></span>
                                    <input type="password" class="form-control form-control-md" id="i-password"   name="password" placeholder="Senha">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="button" class="form-control btn btn-primary" onClick="validar()">Entrar</button>
                                    </div>
                                </div>
                            </div>
  <!--                      </form>-->
                        <div class="form-group">
                            <div class="row">
                                
                                <div class="col-6 text-right forgot_pwd">
                                    <a href="forgot_password1.html" class="custom-control-description forgottxt_clr">Esqueceu sua senha? Click aqui</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function validar()
    {

        if( $("#i-cpf").val() == '' )
        {
            alert('Informe um CPF ou CNPJ válido!');
            return false;
        }
        if( $("#i-password").val() == '' )
        {
            alert('Informe sua senha');
            return false;
        }
        var url = "{{route('clienteacesso.validar')}}";

        dados = 
        {
            cpf : $("#i-cpf").val(),
            password : $("#i-password").val(),

        }

        $.ajaxSetup(
        {
            headers:
            {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });

        $.ajax(
            {
                url : url,
                dataType:'json',
                get:'get',
                data:dados,
                success:function( data )
                {
                    alert('ok' );
                },
                error:function(  )
                {
                    alert('erro');
                }
            }
        );
    }    
</script>
<!-- global js -->
<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('/portalclientes/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/portalclientes/js/popper.js')}}"></script>
<script type="text/javascript" src="{{asset('/portalclientes/js/bootstrap.min.js')}}"></script>
<!-- end of global js-->
<!--Plugin js-->
<script type="text/javascript" src="{{asset('/portalclientes/vendors/bootstrapvalidator/js/bootstrapValidator.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/portalclientes/vendors/wow/js/wow.min.js')}}"></script>
<!--End of plugin js-->
<script type="text/javascript" src="{{asset('/portalclientes/js/pages/login1.js')}}"></script>
</body>

</html>