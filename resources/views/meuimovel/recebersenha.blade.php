
<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password 1 | Admire</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" href="{{asset('img/logo1.ico')}}"/>
    <!--Global styles -->
    <link rel="stylesheet" href="{{asset('meuimovel/css/components.css')}}" />
    <link rel="stylesheet" href="{{asset('meuimovel/css/custom.css')}}" />
    <!--End of Global styles -->
    <!--Plugin styles-->
    <link rel="stylesheet" href="{{asset('meuimovel/vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('meuimovel/vendors/wow/css/animate.css')}}"/>
    <!--End of Plugin styles-->
    <link rel="stylesheet" href="{{asset('meuimovel/css/pages/login1.css')}}"/>
</head>
<body>
<div class="container wow slideInDown" data-wow-duration="1s" data-wow-delay="0.5s">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-lg-4 col-sm-8 col-md-6 mx-auto forgotpwd_margin ">
                    <div class=" login_border_radius1">
                        <h3 class="text-center">
                            <img src="https://www.siriussystem.com.br/sys/storage/images/{{$imb->IMB_IMB_ID}}/logos/logoportal.png" alt="josh logo" class="admire_logo"><span class="text-white"> ADMIRE &nbsp;<br/>
                               Forgot Password</span>
                        </h3>
                    </div>
                    <form action="login1.html" id="login_validator1" method="post"
                          class="form-group  login_validator">
                        <div class="bg-white login_content login_border_radius">
                            <div class="form-group">
                                <label for="email_modal">Please enter your email to reset the password</label>
                                <div class="input-group input-group-prepend">
                            <span class="input-group-text border-right-0 addon_email"><i
                                    class="fa fa-envelope text-primary"></i></span>
                                    <input type="text" class="form-control email_forgot form-control-md"
                                           id="email_modal" name="email_modal" placeholder="E-mail">
                                </div>
                            </div>
                            <div class="form-group form-actions">
                                <button type="submit" class="btn btn-primary submit_email login_button" onclick="window.location.href='login1.html'">Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- global js -->
<script src="{{asset('meuimovel/js/jquery.min.js')}}"></script>
<script src="{{asset('meuimovel/js/index.js')}}"></script>
<script src="{{asset('meuimovel/js/bootstrap.min.js')}}"></script>
<!-- end of global js-->
<!--Plugin js-->
<script src="{{asset('meuimovel/vendors/bootstrapvalidator/js/bootstrapValidator.min.js')}}"></script>
<script src="{{asset('meuimovel/vendors/wow/js/wow.min.js')}}"></script>
<!--End of plugin js-->
<script src="{{asset('meuimovel/js/pages/forgot_password.js')}}"></script>
</body>

</html>