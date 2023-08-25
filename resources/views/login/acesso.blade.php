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
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Sirius System ERP/CRM Imobiliário</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Acesso ao Sirius System " name="description" />
        <meta content="Compdados Tecnologia" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="{{ asset('/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{ asset('/global/css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ asset('/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="{{ asset('/pages/css/login-5.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <script src="{{asset('/global/plugins/sweetalert/sweetalert2.min.js')}}"></script>
        <link rel="stylesheet" href="{{asset('/global/plugins/sweetalert/sweetalert2.min.css')}}">        
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class=" login">
        <!-- BEGIN : LOGIN PAGE 5-1 -->
        <div class="user-login-5">
            <div class="row bs-reset">
                <div class="col-md-6 bs-reset mt-login-5-bsfix">
                    <div class="login-bg" style="background-image:url({{ asset('/pages/img/login/bg1.jpg')}})">
                        <div class="text-right"> 
                            <img class="login-logo" src="{{ asset('/pages/img/login/logo.png')}}" /> 
                        </div>
                    </div>
                </div>

                <div class="col-md-6 login-container bs-reset mt-login-5-bsfix">
                    <div class="login-content">
                        <h1>Sirius System - Acesso ao sistema</h1>
                        <p> A partir de agora você poderá ter acesso ao Dashboard do sistema Sirius. Dependendo das permissões que tiver poderá ter 
                            acesso aos módulos: Administrativo/Financeiro, CRM/Atendimento, Consultas de Imóveis, Estatísticas e Gráficos. </p>
                        <form id="i-form-acesso" class="login-form" method="post" action="{{route('login')}}">
                            @csrf
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button>
                                <span>Entre com um email de identificação. </span>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <input class="form-control form-control-solid placeholder-no-fix form-group" 
                                    type="text" autocomplete="off" placeholder="Email" name="username" 
                                    id="username"/> </div>
                                <div class="col-xs-6">
                                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" 
                                    autocomplete="off" placeholder="Senha" name="password" required/
                                    id="password"> </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                </div>

                                <div class="col-sm-8 text-right">
                                    <div class="forgot-password">
                                        <a href="javascript:;" id="forget-password" class="forget-password">Esqueceu a Senha?</a>
                                    </div>
                                    <button class="btn green" type="submit" >Acessar</button>
                                </div>
                                <hr>
                                <div class="row">
                                </div>
                            </div>
                        </form>
                        <!-- BEGIN FORGOT PASSWORD FORM -->
                        <form class="forget-form">
                            <h3 class="font-green">Esqueceu sua senha?</h3>
                            <p> Entre com seu email utilizado para acesso</p>
                            <div class="form-group">
                                <input class="form-control placeholder-no-fix form-group" 
                                type="text" autocomplete="off" placeholder="Email" id="i-email" name="email" /> 
                            </div>
                            <div class="form-actions">
                                <button type="button" id="back-btn"  class="btn green btn-outline">Voltar</button>
                                <button type="button" id="i-enviar"  onClick="enviarSenha()" class="btn btn-success uppercase pull-right">Enviar</button>
                            </div>
                        </form>
                    </div>
                    <div class="login-footer">
                        <div class="row bs-reset">
                            <div class="col-xs-7 bs-reset">
                                <div class="login-copyright text-right">
                                    <p>Copyright &copy; Compdados Tecnologia</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END : LOGIN PAGE 5-1 -->
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<script src="../assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="{{ asset('/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{ asset('/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('/global/plugins/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('/global/plugins/backstretch/jquery.backstretch.min.js')}}" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{ asset('/global/scripts/app.min.js')}}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="{{ asset('/pages/scripts/login-5.js')}}" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
        <script>
            $(document).ready(function()
            {
                $('#clickmewow').click(function()
                {
                    $('#radio1003').attr('checked', 'checked');
                });

            })

            function enviarSenha()
            {

                var url = "{{ route( 'email.enviar.senha')}}/"+$("#i-email").val();
                $.ajax(
                {
                    type: "get",
                    url: url,
                    dataType: "json",
                    context: this,                    
                    success: function( data ) 
                    {

                        alert( 'Sirius System: Senha enviada para: '+$("#i-email").val()+'. Verifique sua caixa de entrada e acesse com a nova senha');

                    },
                    error: function()
                    {
                        alert( 'ERRO: no envio para: '+$("#i-email").val()+'. Ou você ainda não é nosso usuário, ou seu email não existe!');
                    }

                });



            }

            function acessar()
            {
                var email = $("#i-email").val();
                
                if( email == '' )
                {

                    Swal.fire({
                     position: 'center',
                    icon: 'warning',
                    title: 'Email obrigatório',
                    showConfirmButton: false,
                    timer: 2500
                    });


                    return false;

                }

                console.log('entrando ');
       
       
                var url = "{{ route('atendente.findemail')}}/"+email;

                $.ajax({
                    url : url,
                    type : 'get',
                    dataType:'json',
                })
                .success(function(data){
                    
                    if( data.length==0)
                    {
                        Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: 'Email/usuário não encontrado',
                        showConfirmButton: false,
                        timer: 3000
                        });
                        return false;
                    }
                    console.log('usuario '+data);


/*                    var senha = $("#i-senha").val();
                    var senhacript = stringToHash( senha );
                    console.log('Senha '+senha );
                    console.log('Senha Cript '+senhacript );
                    console.log('Senha BD '+data[0].IMB_ATD_SENHA);
                    if( data[0].IMB_ATD_SENHA !=  senhacript )
                    {
                        Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: 'Senha Inválida',
                        showConfirmButton: false,
                        timer: 3000
                        });
                        return false;
                    }
                    */
                    
                });


                $.ajaxSetup({
                   headers:    
                    {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                    }
                    });        

                    cred = 
                    {
                        username : $("#username").val(),
                        password  : $("#password").val()
                    }

                    url = "{{ route('login')}}";

                    console.log('username '+cred.username );
                    console.log('password '+cred.password );
                    console.log('$(#password) '+$("#password").val());
                    $.ajax({
                        url : url,
                        type : 'post',
                        data: cred,
                        dataType:'json',
                        success: function()
                        {

                            Swal.fire(
                                {
                            position: 'center',
                            icon: 'warning',
                            title: 'Um ótimo trabalho pra você!',
                            showConfirmButton: false,
                            timer: 3000
                            });
                        return false;

                        }
                    })

            }

            function stringToHash(string) 
            { 
                  
                var hash = 0; 
                    
                if (string.length == 0) return hash; 
                    
                for (i = 0; i < string.length; i++) { 
                    char = string.charCodeAt(i); 
                    hash = ((hash << 5) - hash) + char; 
                    hash = hash & hash; 
                }                     
                return hash; 
              }             

            function criarAcesso()
            {
                window.location = "{{route('acesso.criaracesso')}}";
            }
        </script>


    </body>

</html>