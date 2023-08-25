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
        <title>Sirius System - Crie seu acesso</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Página de novo acesso ao Sirius System " name="description" />
        <meta content="Compdados Tecnologia" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{asset('/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="{{asset('/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{asset('/global/css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{asset('/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="{{asset('/pages/css/login.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class=" login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="index.html">
                <img src="{{asset('/pages/img/logo.png')}}" alt="" /> </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <!-- END FORGOT PASSWORD FORM -->
            <!-- BEGIN REGISTRATION FORM -->
            <form action="index.html" method="post">
                <h3 class="font-green">Assine</h3>
                <p class="hint"> Entre com seus dados pessoais nos campos abaixo: </p>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Nome Completo</label>
                    <input class="form-control" type="text" autocomplete="off"
                        placeholder="Nome Completo" name="fullname" id="IMB_ATD_NOME"/> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Fone DDD</label>
                    <input class="form-control" type="text" autocomplete="off"
                        placeholder="DDD" name="ddd" id="IMB_ATD_DDD1"/> 
                    <label class="control-label visible-ie8 visible-ie9">Fone Número</label>
                    <input class="form-control" type="text" autocomplete="off"
                        placeholder="Número Fone" name="phone" id="IMB_ATD_FONE1" /> 
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Cidade</label>
                    <input class="form-control placeholder-no-fix" type="text" 
                    placeholder="Cidade" name="city" id="CEP_CID_NOME" autocomplete="off"/> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">País</label>
                    <select name="country" class="form-control" id="IMB_ATD_PAIS">
                        <option value="-1">País</option>
                        <option value="55">Brasil</option>
                        <option value="1">Estados Unidos</option>
                        <option value="351">Portugal</option>
                        <option value="AF">Afghanistan</option>
                        <option value="AL">Albania</option>
                        <option value="DZ">Algeria</option>
                        <option value="AS">American Samoa</option>
                        <option value="AD">Andorra</option>
                        <option value="AO">Angola</option>
                        <option value="AI">Anguilla</option>
                        <option value="AR">Argentina</option>
                        <option value="AM">Armenia</option>
                        <option value="AW">Aruba</option>
                        <option value="AU">Australia</option>
                        <option value="AT">Austria</option>
                        <option value="AZ">Azerbaijan</option>
                        <option value="BS">Bahamas</option>
                        <option value="BH">Bahrain</option>
                        <option value="BD">Bangladesh</option>
                        <option value="BB">Barbados</option>
                        <option value="BY">Belarus</option>
                        <option value="BE">Belgium</option>
                        <option value="BZ">Belize</option>
                        <option value="BJ">Benin</option>
                        <option value="BM">Bermuda</option>
                        <option value="BT">Bhutan</option>
                        <option value="BO">Bolivia</option>
                        <option value="BA">Bosnia and Herzegowina</option>
                        <option value="BW">Botswana</option>
                        <option value="BV">Bouvet Island</option>
                        <option value="IO">British Indian Ocean Territory</option>
                        <option value="BN">Brunei Darussalam</option>
                        <option value="BG">Bulgaria</option>
                        <option value="BF">Burkina Faso</option>
                        <option value="BI">Burundi</option>
                        <option value="KH">Cambodia</option>
                        <option value="CM">Cameroon</option>
                        <option value="CA">Canada</option>
                        <option value="CV">Cape Verde</option>
                        <option value="KY">Cayman Islands</option>
                        <option value="CF">Central African Republic</option>
                        <option value="TD">Chad</option>
                        <option value="CL">Chile</option>
                        <option value="CN">China</option>
                        <option value="CX">Christmas Island</option>
                        <option value="CC">Cocos (Keeling) Islands</option>
                        <option value="CO">Colombia</option>
                        <option value="KM">Comoros</option>
                        <option value="CG">Congo</option>
                        <option value="CD">Congo, the Democratic Republic of the</option>
                        <option value="CK">Cook Islands</option>
                        <option value="CR">Costa Rica</option>
                        <option value="CI">Cote d'Ivoire</option>
                        <option value="HR">Croatia (Hrvatska)</option>
                        <option value="CU">Cuba</option>
                        <option value="CY">Cyprus</option>
                        <option value="CZ">Czech Republic</option>
                        <option value="DK">Denmark</option>
                        <option value="DJ">Djibouti</option>
                        <option value="DM">Dominica</option>
                        <option value="DO">Dominican Republic</option>
                        <option value="EC">Ecuador</option>
                        <option value="EG">Egypt</option>
                        <option value="SV">El Salvador</option>
                        <option value="GQ">Equatorial Guinea</option>
                        <option value="ER">Eritrea</option>
                        <option value="EE">Estonia</option>
                        <option value="ET">Ethiopia</option>
                        <option value="FK">Falkland Islands (Malvinas)</option>
                        <option value="FO">Faroe Islands</option>
                        <option value="FJ">Fiji</option>
                        <option value="FI">Finland</option>
                        <option value="FR">France</option>
                        <option value="GF">French Guiana</option>
                        <option value="PF">French Polynesia</option>
                        <option value="TF">French Southern Territories</option>
                        <option value="GA">Gabon</option>
                        <option value="GM">Gambia</option>
                        <option value="GE">Georgia</option>
                        <option value="DE">Germany</option>
                        <option value="GH">Ghana</option>
                        <option value="GI">Gibraltar</option>
                        <option value="GR">Greece</option>
                        <option value="GL">Greenland</option>
                        <option value="GD">Grenada</option>
                        <option value="GP">Guadeloupe</option>
                        <option value="GU">Guam</option>
                        <option value="GT">Guatemala</option>
                        <option value="GN">Guinea</option>
                        <option value="GW">Guinea-Bissau</option>
                        <option value="GY">Guyana</option>
                        <option value="HT">Haiti</option>
                        <option value="HM">Heard and Mc Donald Islands</option>
                        <option value="VA">Holy See (Vatican City State)</option>
                        <option value="HN">Honduras</option>
                        <option value="HK">Hong Kong</option>
                        <option value="HU">Hungary</option>
                        <option value="IS">Iceland</option>
                        <option value="IN">India</option>
                        <option value="ID">Indonesia</option>
                        <option value="IR">Iran (Islamic Republic of)</option>
                        <option value="IQ">Iraq</option>
                        <option value="IE">Ireland</option>
                        <option value="IL">Israel</option>
                        <option value="IT">Italy</option>
                        <option value="JM">Jamaica</option>
                        <option value="JP">Japan</option>
                        <option value="JO">Jordan</option>
                        <option value="KZ">Kazakhstan</option>
                        <option value="KE">Kenya</option>
                        <option value="KI">Kiribati</option>
                        <option value="KP">Korea, Democratic People's Republic of</option>
                        <option value="KR">Korea, Republic of</option>
                        <option value="KW">Kuwait</option>
                        <option value="KG">Kyrgyzstan</option>
                        <option value="LA">Lao People's Democratic Republic</option>
                        <option value="LV">Latvia</option>
                        <option value="LB">Lebanon</option>
                        <option value="LS">Lesotho</option>
                        <option value="LR">Liberia</option>
                        <option value="LY">Libyan Arab Jamahiriya</option>
                        <option value="LI">Liechtenstein</option>
                        <option value="LT">Lithuania</option>
                        <option value="LU">Luxembourg</option>
                        <option value="MO">Macau</option>
                        <option value="MK">Macedonia, The Former Yugoslav Republic of</option>
                        <option value="MG">Madagascar</option>
                        <option value="MW">Malawi</option>
                        <option value="MY">Malaysia</option>
                        <option value="MV">Maldives</option>
                        <option value="ML">Mali</option>
                        <option value="MT">Malta</option>
                        <option value="MH">Marshall Islands</option>
                        <option value="MQ">Martinique</option>
                        <option value="MR">Mauritania</option>
                        <option value="MU">Mauritius</option>
                        <option value="YT">Mayotte</option>
                        <option value="MX">Mexico</option>
                        <option value="FM">Micronesia, Federated States of</option>
                        <option value="MD">Moldova, Republic of</option>
                        <option value="MC">Monaco</option>
                        <option value="MN">Mongolia</option>
                        <option value="MS">Montserrat</option>
                        <option value="MA">Morocco</option>
                        <option value="MZ">Mozambique</option>
                        <option value="MM">Myanmar</option>
                        <option value="NA">Namibia</option>
                        <option value="NR">Nauru</option>
                        <option value="NP">Nepal</option>
                        <option value="NL">Netherlands</option>
                        <option value="AN">Netherlands Antilles</option>
                        <option value="NC">New Caledonia</option>
                        <option value="NZ">New Zealand</option>
                        <option value="NI">Nicaragua</option>
                        <option value="NE">Niger</option>
                        <option value="NG">Nigeria</option>
                        <option value="NU">Niue</option>
                        <option value="NF">Norfolk Island</option>
                        <option value="MP">Northern Mariana Islands</option>
                        <option value="NO">Norway</option>
                        <option value="OM">Oman</option>
                        <option value="PK">Pakistan</option>
                        <option value="PW">Palau</option>
                        <option value="PA">Panama</option>
                        <option value="PG">Papua New Guinea</option>
                        <option value="PY">Paraguay</option>
                        <option value="PE">Peru</option>
                        <option value="PH">Philippines</option>
                        <option value="PN">Pitcairn</option>
                        <option value="PL">Poland</option>
                        <option value="PR">Puerto Rico</option>
                        <option value="QA">Qatar</option>
                        <option value="RE">Reunion</option>
                        <option value="RO">Romania</option>
                        <option value="RU">Russian Federation</option>
                        <option value="RW">Rwanda</option>
                        <option value="KN">Saint Kitts and Nevis</option>
                        <option value="LC">Saint LUCIA</option>
                        <option value="VC">Saint Vincent and the Grenadines</option>
                        <option value="WS">Samoa</option>
                        <option value="SM">San Marino</option>
                        <option value="ST">Sao Tome and Principe</option>
                        <option value="SA">Saudi Arabia</option>
                        <option value="SN">Senegal</option>
                        <option value="SC">Seychelles</option>
                        <option value="SL">Sierra Leone</option>
                        <option value="SG">Singapore</option>
                        <option value="SK">Slovakia (Slovak Republic)</option>
                        <option value="SI">Slovenia</option>
                        <option value="SB">Solomon Islands</option>
                        <option value="SO">Somalia</option>
                        <option value="ZA">South Africa</option>
                        <option value="GS">South Georgia and the South Sandwich Islands</option>
                        <option value="ES">Spain</option>
                        <option value="LK">Sri Lanka</option>
                        <option value="SH">St. Helena</option>
                        <option value="PM">St. Pierre and Miquelon</option>
                        <option value="SD">Sudan</option>
                        <option value="SR">Suriname</option>
                        <option value="SJ">Svalbard and Jan Mayen Islands</option>
                        <option value="SZ">Swaziland</option>
                        <option value="SE">Sweden</option>
                        <option value="CH">Switzerland</option>
                        <option value="SY">Syrian Arab Republic</option>
                        <option value="TW">Taiwan, Province of China</option>
                        <option value="TJ">Tajikistan</option>
                        <option value="TZ">Tanzania, United Republic of</option>
                        <option value="TH">Thailand</option>
                        <option value="TG">Togo</option>
                        <option value="TK">Tokelau</option>
                        <option value="TO">Tonga</option>
                        <option value="TT">Trinidad and Tobago</option>
                        <option value="TN">Tunisia</option>
                        <option value="TR">Turkey</option>
                        <option value="TM">Turkmenistan</option>
                        <option value="TC">Turks and Caicos Islands</option>
                        <option value="TV">Tuvalu</option>
                        <option value="UG">Uganda</option>
                        <option value="UA">Ukraine</option>
                        <option value="AE">United Arab Emirates</option>
                        <option value="GB">United Kingdom</option>
                        <option value="UM">United States Minor Outlying Islands</option>
                        <option value="UY">Uruguay</option>
                        <option value="UZ">Uzbekistan</option>
                        <option value="VU">Vanuatu</option>
                        <option value="VE">Venezuela</option>
                        <option value="VN">Viet Nam</option>
                        <option value="VG">Virgin Islands (British)</option>
                        <option value="VI">Virgin Islands (U.S.)</option>
                        <option value="WF">Wallis and Futuna Islands</option>
                        <option value="EH">Western Sahara</option>
                        <option value="YE">Yemen</option>
                        <option value="ZM">Zambia</option>
                        <option value="ZW">Zimbabwe</option>
                    </select>
                </div>
                <p class="hint"> Abaixo informe os dados para acesso a conta: </p>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">EMail</label>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="Email" 
                    autocomplete="off" name="email" id="IMB_ATD_EMAIL"/> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Confirmação Email</label>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="Confirmação do Email" 
                    autocomplete="off" name="emailconfirmacao" id="IMB_ATD_EMAILCONFIRMACAO"/> </div>
                <div class="form-group margin-top-20 margin-bottom-20">
                    <label class="mt-checkbox mt-checkbox-outline">
                        <input type="checkbox" name="tnc" id="i-chk-confirmacao"/>Aceito os termos
                        <a href="javascript:;">Termos dos Serviços </a> &
                        <a href="javascript:;">Politica de Privacidade</a>
                        <span></span>
                    </label>
                    <div id="register_tnc_error"> </div>
                </div>
                <div class="form-actions">
                    <button type="button" id="register-back-btn" onClick="voltarLogin()"
                        class="btn green btn-outline">Cancelar
                    </button>
                    <button type="button" id="register-submit-btn" 
                    class="btn btn-success uppercase pull-right" onClick="registrar()">Registrar</button>
                </div>
            </form>
            <!-- END REGISTRATION FORM -->
        </div>
        <div class="copyright"> 2020 © Compdados Tecnologia </div>
        <!--[if lt IE 9]>
<script src="{{asset('/global/plugins/respond.min.js')}}"></script>
<script src="{{asset('/global/plugins/excanvas.min.js')}}"></script> 
<script src="{{asset('/global/plugins/ie8.fix.min.js')}}"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="{{ asset('/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{asset('/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/global/plugins/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{asset('/global/scripts/app.min.js')}}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="{{asset('/pages/scripts/login.min.js')}}" type="text/javascript"></script>
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

                
                $("#IMB_ATD_EMAIL").on('blur', () =>{
                    checarEmailCadastrado();
/*                    if( ! validadeEmail() ) 
                    {
                        $("#IMB_ATD_EMAIL").val('');
                    }
                    */
                });
            })

            function voltarLogin()
            {
                window.location = "{{route('home')}}";
            }

            function registrar()
            {
                var fone = $("#IMB_ATD_FONE1").val();
                
                checarEmailCadastrado();
                
                if( $("#IMB_ATD_EMAIL").val() != 
                    $("#IMB_ATD_EMAILCONFIRMACAO").val() )
                {
                    alert('A confirmação de email não confirma o email informado!');
                    return false;
                }


                if( $("#IMB_ATD_EMAIL").val() == '' )
                {
                    alert('Informe o email');
                    return false;
                }

                if( $("#CEP_CID_NOME").val() == '' )
                {
                    alert('Informe a cidade');
                    return false;
                }

                if( $("#IMB_ATD_PAIS").val() == '-1' )
                {
                    alert('Informe o país');
                    return false;
                }

                if( $("#IMB_ATD_DDD1").val() == '' )
                {
                    alert('Informe o DDD');
                    return false;
                }

                if( fone.substring( 0,1 ) < 8 )
                {
                    alert('Informe um número de celular válido!');
                    return false;
                }

                if( $("#IMB_ATD_FONE1").val() == '' )
                {
                    alert('Informe o numero do celular');
                    return false;
                }

                if( $("#IMB_ATD_NOME").val() == '' )
                {
                    alert('Informe o nome');
                    return false;
                }

                gerarUsuario();

            }

      
        
        function gerarUsuario()
        {

            url = "{{route('acesso.gerarusuario')}}";
            var atm = 
            {
                IMB_ATD_NOME :  $("#IMB_ATD_NOME").val(),
                IMB_ATD_EMAIL :  $("#IMB_ATD_EMAIL").val(),
                IMB_ATD_SENHA :  $("#SENHA").val(),
                IMB_ATD_DDI: $("IMB_ATD_PAIS").val(),
                IMB_ATD_DDD1 :  $("#IMB_ATD_DDD1").val(),
                IMB_ATD_TELEFONE_1 :  $("#IMB_ATD_FONE1").val(),
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
                url: url,
                dataType: 'JSON',
                type: "post",
                data: atm,
                async : false,
                success: function(data)
                    {
                        alert('Parabéns! Você agora faz parte da rede Sirius! Apoio aos corretores de imóveis de todo o país!');
                        voltarLogin();
                        //enviarSms( data );

                    },
                    error: function( error )
                    {
                        alert(error.statusText );
                    }
                    
            });
        }

        function checarEmailCadastrado()
        {

            url = "{{route('acesso.checaremail')}}/"+$("#IMB_ATD_EMAIL").val();
            console.log(url);
            $.ajax(
            {
                url     : url,
                datatype: 'json',
                type    : 'get',
                async   : false,
                success : function(data)
                {
                },
                error   : function()
                {
                    alert('Email já cadastrado em nosso banco de dados!');
                    $("#IMB_ATD_EMAIL").val('');
                    return false;
                }
            });

        }

        function validadeEmail()
        {
            var x=$("#IMB_ATD_EMAIL").val();
            var atpos=x.indexOf("@");
            var dotpos=x.lastIndexOf(".");
            console.log('email: '+x);
            if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
            {
                alert("Não é um endereço de e-mail válido");
                return false;
            }
        }
        </script>

    </body>

</html>