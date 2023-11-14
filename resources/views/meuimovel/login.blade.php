
<!DOCTYPE html>
<html>
<head>
    <title>{{$imb->IMB_IMB_NOME}}-Acesso do Cliente</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" href="{{asset('meuimovel/img/logo1.ico')}}"/>
    <!--Global styles -->
    <link rel="stylesheet" href="{{asset('meuimovel/css/components.css')}}" />
    <link rel="stylesheet" href="{{asset('meuimovel/css/custom.css')}}" />
    <!--End of Global styles -->
    <!--Plugin styles-->
    <link rel="stylesheet" href="{{asset('meuimovel/vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('meuimovel/vendors/wow/css/animate.css')}}"/>
    <!--End of Plugin styles-->
    <link rel="stylesheet" href="{{asset('meuimovel/css/pages/login1.css')}}"/>
    <style>
        .div-center
        {
            text-align:center;
        }

        .font-20
        {
            font-size:20px;
        }
        .font-14
        {
            font-size:14px;
        }

        .cor-locatario
        {
            background-color: #d9d9d9;
        }

    </style>
</head>
<body">
<div class="preloader" style=" position: fixed;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  z-index: 100000;
  backface-visibility: hidden;
  background:  #00cc44;">
    <div class="preloader_img" style="width: 200px;
  height: 200px;
  position: absolute;
  left: 48%;
  top: 48%;
  background-position: center;
z-index: 999999">
        <img src="{{asset('meuimovel/img/loader.gif')}}" style=" width: 40px;" alt="loading...">
    </div>
</div>
<div class="container wow fadeInDown" data-wow-delay="0.5s" data-wow-duration="2s">
    <div class="row bg-h2">
        <div class="col-lg-12 col-md-12 col-sm-12 login_top_bottom">
            <div class="row">
                <div class="col-lg-8  col-md-12  col-sm-12 mx-auto">
                    <div class="login_logo login_border_radius1 div-center">
                        <img class="img-200" src="{{env('APP_URL')}}/storage/images/{{$imb->IMB_IMB_ID}}/logos/logoportal.png" alt="">
                    </div>
                    <div class="bg-white login_content login_border_radius">
<!--                        <form action="#" id="login_validator" method="post" class="login_validator">-->
                            <input type="hidden" id="IMB_IMB_ID" value="{{$imb->IMB_IMB_ID}}">
                            <input type="hidden" id="IMB_IMB_NOME" value="{{$imb->IMB_IMB_NOME}}">
                            <input type="hidden" id="IMB_CLT_ID">
                            <input type="hidden" id="IMB_CLT_EMAIL">
                            <div class="form-group">
                                <label  class="col-form-label"> CPF ou CNPJ</label>
                                <div class="input-group input-group-prepend">
                                    <span class="input-group-text border-right-0 rounded-left input_email"><i
                                            class="fa fa-address-card-o text-primary"></i></span>
                                    <input type="text" class="form-control  form-control-md" id="cpf" name="cpf" placeholder="Somente Números.Sem traços e pontos">
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="optradio" id="i-cpf" checked >CPF
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="optradio" id="i-cnpj">CNPJ
                                    </label>
                                </div>                            
                            </div>

                            <!--</h3>-->
                            <div class="form-group">
                                <label for="password" class="col-form-label">Senha</label>
                                <div class="input-group input-group-prepend">
                                    <span class="input-group-text border-right-0 rounded-left addon_password"><i
                                            class="fa fa-lock text-primary"></i></span>
                                    <input type="password" class="form-control form-control-md" id="senha"   name="password" placeholder="Sua senha são os seis primeiros digitos do CPF ou CNPJ">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row div-center">
                                    <div class="col-lg-12 ">
                                        <button class="btn btn-primary" onClick="acessar()"><span class="font-20"><i class="fa fa-sign-in" aria-hidden="true"></i>Entrar</span></button>
                                    </div>
                                </div>
                            </div>
<!--                        </form>-->
                        <div class="form-group div-center">
                            <!--
                            <div class="row">
                                    <div class="col-md-6 div-center cor-locatario font-20">
                                        <h4><u>Locatário<b>(inquilino)</b></u></h4>
                                        <p>
                                            Sua senha são os seis primeiros <br> algarismos de seu CPF/CNPJ</p>
                                        <p class="div-center">
                                    
                                    </div>
    
                                    <div class="col-md-6 div-center  cor-locatario  font-20">
                                        
                                            <h4><u>Locador(Proprietário)</b></u></h4>
                                        <a  href="javascript:email()">                                            
                                        <p>Esqueceu sua senha? <br> ou para o primeiro acesso <br> Click aqui para receber sua senha <br> e passar a utilizá-la</p> </a>
                                    
                                    </div>
                            </div>
    -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-telefones" tabindex="-1" role="dialog" aria-labelledby="modalLabel"aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="i-nome-cliente"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Escolha abaixo como quer receber sua senha
                </p>

                <table  id="i-telefones" class="table table-striped table-bordered table-hover" >
                    <thead class="thead-dark">
                        <tr >
                            <th width="40" style="text-align:center"> DDD </th>
                            <th style="text-align:center"> Numero </th>
                            <th width="200" style="text-align:center"> </th>        
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                
            </div>
                <div class="col-md-12 div-center">
                    Receber por email
                </div>
                <div class="col-md-12 div-center" id="i-email">
                </div>
                <div class="col-md-12 div-center">
                    <button title="Receber sua senha no email acima" class="btn btn-primary" onClick="email()"><i class="fa fa-envelope-o" aria-hidden="true"></i>Enviar
                    </button>
                </div>
                <hr>
        </div>
    </div>
</div>

<form style="display: none" action="{{route('meuimovel.meusimoveis')}}" method="get" id="frm-meusimoveis">            
@csrf
    <input type="hidden" id="idclientemeusimoveis" name="id" />                
</form>

<!-- global js -->
<script src="{{asset('meuimovel/js/jquery.min.js')}}"></script>
<script src="{{asset('meuimovel/js/popper.min.js')}}"></script>
<script src="{{asset('meuimovel/js/bootstrap.min.js')}}"></script>
<!-- end of global js-->
<!--Plugin js-->
<script src="{{asset('meuimovel/vendors/bootstrapvalidator/js/bootstrapValidator.min.js')}}"></script>
<script src="{{asset('meuimovel/vendors/wow/js/wow.min.js')}}"></script>
<!--End of plugin js-->
<script type="text/javascript" src="{{asset('/js/funcoes.js')}}"></script>
<script src="{{asset('meuimovel/js/pages/login1.js')}}"></script>

<script>


    function acessar()
    {

        checarCpf();


        var cpf = $("#cpf").val();
        senha = $("#senha").val();
        var imb_imb_id = $("#IMB_IMB_ID").val();
        var url ="{{route('meuimovel.pegarclientecpf')}}/"+imb_imb_id+"/"+cpf;
        console.log( url );

        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                async:false,
                success:function(data)
                {
                    
                    console.log('senha banco: '+data[0].IMB_CLT_SENHA);
                    console.log('senha informada: '+senha);
                    

//                    if( data[0].IDPROP != '' && data[0].IMB_CLT_SENHA != null && data[0].IMB_CLT_SENHA != '' && data[0].IMB_CLT_SENHA+data[0].ANONASC != senha ) 
                    //{
                        //alert( 'CPF ou Senha Inválidos! Verifique a ultima senha recebida ou click no botão abaixo para receber nova senha');
                        //return false;
                    //}
                    //else
                    //{
                       if( data[0].IMB_CLT_SENHA == '' ||  data[0].IMB_CLT_SENHA === null)
                        {
                            seisdig = document.getElementById("cpf").value.substring(0, 6);
                            if( seisdig != senha )
                            {
                                alert( 'CPF ou Senha Inválidos!');
                                return false;
                            }
                            else
                                meusImoveis( data[0].IMB_CLT_ID );
                        }
                        else
                        {
                            if( data[0].IMB_CLT_SENHA != senha )
                            {
                            alert( 'CPF ou Senha Inválidos!');
                                return false;
                            }
                            else
                                meusImoveis( data[0].IMB_CLT_ID );

                        }
                        
//                    }
                }
            }
        );

    }

    function checarCpf()
    {

        if( $('input[id=i-cpf]').is(':checked') == false && $('input[id=i-cnpj]').is(':checked') == false )
        {
            alert('Por favor, informe se o documento é CPF ou CNPJ. Obrigado.');
            return false;
        }

        if( $('#cpf').val() == '' )
        {
            alert('Por favor, informe se o documento é CPF ou CNPJ. Obrigado.');
            return false;
        }


        var cpf = $("#cpf").val();
        
        if( $('input[id=i-cpf]').is(':checked') )
        {

            if ( is_cpf( cpf ) == false )
            {
                alert('CPF Inválido!');
                $("#i-cpf").val('');
                return false;
            }
        };
        if( $('input[id=i-cnpj]').is(':checked') )
        {

            if ( is_cnpj(cpf ) == false )
            {
                alert('CNPJ Inválido!');
                $("#i-cpf").val('');
                return false;
            }
        };


    }

    function modalContatos()
    {
        checarCpf();


        var cpf = $("#cpf").val();

        var imb_imb_id = $("#IMB_IMB_ID").val();

        var url ="{{route('meuimovel.pegarclientecpf')}}/"+imb_imb_id+"/"+cpf;

        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                async:false,
                success:function(data)
                {
                    console.log( data );
                    var sexo = data[0].IMB_CLT_SEXO;
                    
                    $("#modal-telefones").modal( 'show');
                    if( sexo == 'F')
                        $("#i-nome-cliente").html( 'Seja bem-vinda '+data[0].IMB_CLT_NOME )
                    else
                        $("#i-nome-cliente").html( 'Seja bem-vindo '+data[0].IMB_CLT_NOME )

                        linha = "";
                        
                    $("#i-email").html( data[0].IMB_CLT_EMAIL);
                    $("#IMB_CLT_ID").val( data[0].IMB_CLT_ID);

                    $("#i-telefones>tbody").empty();
                    for( nI=0;nI < data.length;nI++)
                    {
                        var prefixo = '';
                
                        linha = 
                            '<tr>'+
                                '<td class="div-center">'+data[nI].IMB_TLF_DDD+'</td>' +
                                '<td class="div-center">'+data[nI].IMB_TLF_NUMERO+'</td>' +
                                '<td class="div-center"> '+
                                '<a title="title="Receber sua senha neste telefone por SMS" href=javascript:sms('+data[nI].IMB_TLF_DDD+data[nI].IMB_TLF_NUMERO+') class="btn btn-sm btn-primary"><i class="far fa-sms"></i>SMS</a> '+
                                '</td> '+
                            '</tr>';
                        $("#i-telefones").append( linha );
                    }

                }
            }
        )


    }

    function sms( numero )
    {
        debugger;

       var imb=$("#IMB_IMB_NOME").val();
        var senha = $("#IMB_CLT_ID").val();

        url = "https://sms.mkmservice.com/api/?modo=envio&empresa=cdl.bauru&usuario=cdl.bauru&senha=mkm@@2017&telefone="+
        numero+"&mensagem=Imobiliária - Sua senha:"+senha+"&centro_custo=ShortCode&agendamento=";

//        var idcliente = $("#IMB_CLT_ID").val();

        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                success:function(data)
                {
                },
                complete:function(data)
                {
                        alert('Mensagem enviadas para o celular. Pode ser que demore uns minutos pra chegar');
                        $("#modal-telefones").modal('hide');
       
                },
                done:function()
                {
                    alert('done');
                }
            }
        )
    }

    function email()
    {


        checarCpf();

        var cpf = $("#cpf").val();
        senha = $("#senha").val();
        var imb_imb_id = $("#IMB_IMB_ID").val();
        var url ="{{route('meuimovel.pegarclientecpf')}}/"+imb_imb_id+"/"+cpf;

        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                async:false,
                success:function(data)
                {
            
                    $("#IMB_CLT_ID").val(data[0].IMB_CLT_ID) ;
                    $("#IMB_CLT_EMAIL").val(data[0].IMB_CLT_EMAIL) ;
                }
            }
        );

        if( confirm( 'Você solicitou uma nova senha e será enviada para o email: '+ $("#IMB_CLT_EMAIL").val() ) == true )
        {
            var dados = { idcliente:  $("#IMB_CLT_ID").val() };

            $.ajaxSetup(
                {
                    headers:
                    {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                    }
            });

            var url = "{{route('meuimovel.enviarsenhaclienteemail')}}";



            $.ajax(
                {
                    url:url,
                    dataType:'json',
                    data:dados,
                    type:'post',
                    success:function(data)
                    {
                        alert('Email enviado para '+$("#IMB_CLT_EMAIL").val());
                        $("#modal-telefones").modal('hide');
                    }
                })
        }
    }

    function meusImoveis( id )
    {
            $("#idclientemeusimoveis").val( id );
            $("#frm-meusimoveis").submit();
//            window.location = "{{ route('atendimento.atendimento') }}/" + id;            
    }    

</script>
</body>

</html>