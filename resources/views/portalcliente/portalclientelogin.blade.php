<!DOCTYPE html>
<html>
<head>
    <title>{{$imb->IMB_IMB_NOME}}-Acesso do Cliente</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" href="{{asset('/global/img/favicon.ico')}}" />    
            <!--Global styles -->
    <link type="text/css" rel="stylesheet" href="{{asset('/portalclientes/css/components.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('/portalclientes/css/custom.css')}}" />
    <!--End of Global styles -->
    <!--Plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('/portalclientes/vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('/portalclientes/vendors/wow/css/animate.css')}}"/>
    <!--End of Plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('/portalclientes/css/pages/login1.css')}}"/>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>        
    <style>
        .font-branca
        {
            color:white;
        }
        .div-center
        {
            text-align:center;
        }
        .underline
        {
            text-decoration-line: underline;
        }
        .img-200
            {
                max-width:100%;    
                width:250px;
				height:171px;            
				max-height:171px;            
			}    </style>
</head>
<body>
<div class="container wow fadeInDown" data-wow-delay="1.5s" data-wow-duration="2s">
    <div class="row">
        <p>

        </p>
        <p></p>
        <p></p>
    </div>
    <div class="row">
        <div class="col-md-12 div-center">
            <img class="img-200" src="https://www.siriussystem.com.br/sys/storage/images/{{$imb->IMB_IMB_ID}}/logos/logoportal.png" alt="">
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 login_top_bottom">
            <div class="row">
                <div class="col-lg-5  col-md-8  col-sm-12 mx-auto">
                    <div class="login_logo login_border_radius1">
                        <h4 class="text-center underline">
                                <b><u>{{$imb->IMB_IMB_NOME}} - Área do Cliente</u></b></span>
                        </h4>
                    </div>
                    <div class="bg-light login_content login_border_radius">
<!--                        <form  class="login_validator">-->
                            <input type="hidden" id="i-imb_imb_id" value = "{{$imb->IMB_IMB_ID}}">
                            <div class="form-group">
                                <label for="i-cpf" class="col-form-label"> CPF ou CNPJ</label>
                                <div class="input-group input-group-prepend">
                                    <span class="input-group-text border-right-0 rounded-left "><i
                                            class="fa fa-address-card-o text-primary"></i></span>
                                    <input type="text" class="form-control  form-control-md" id="i-cpf" name="cpf" placeholder="Somente Número"
                                    onkeypress="return isNumber(event)" onpaste="return false;"/>
                                </div>
                            </div>
                            <!--</h3>-->

<!--                            <div class="form-group">
                                <label for="password" class="col-form-label">Senha</label>
                                <div class="input-group input-group-prepend">
                                    <span class="input-group-text border-right-0 rounded-left addon_password"><i
                                            class="fa fa-lock text-primary"></i></span>
                                    <input type="password" class="form-control form-control-md" id="i-password"   name="password" placeholder="Senha">
                                </div>
                            </div>
    -->
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="button" class="form-control btn btn-primary" onClick="validar()">Entrar</button>
                                    </div>
                                </div>
                            </div>
  <!--                      </form>-->
                    </div>
                    <p class="div-center">Integrado ao Sirius System - CRM & ERP Imobiliário</p>

                </div>
            </div>            

        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalimoveis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:100%;" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Imóveis Alugados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <table  id="i-imoveis" class="table table-striped table-bordered table-hover" >
            <thead class="thead-dark">
                <tr >
                    <th style="text-align:center"> Endereço </th>
                    <th style="text-align:center"> Situação </th>
                    <th width="50" style="text-align:center"> Ações </th>       
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">fechar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalboletos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:100%;" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Boletos em Aberto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <table  id="i-boletos" class="table table-striped table-bordered table-hover" >
            <thead class="thead-dark">
                <tr >
                    <th style="text-align:center"> Data Vencimeto</th>
                    <th style="text-align:center"> Valor </th>
                    <th width="50" style="text-align:center"> Ações </th>       
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">fechar</button>
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
        /*if( $("#i-password").val() == '' )
        {
            alert('Informe sua senha');
            return false;
        }*/
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
                    var pasta='';
                    linha = "";
                    $("#i-imoveis>tbody").empty();
                    for( nI=0;nI < data.length;nI++)
                    {
                        linha = 
                            '<tr>'+
                            '<td style="text-align:center valign="center">'+data[nI].Endereco+'</td>' +
                            '<td style="text-align:center valign="center">Aberto</td>' +
                            '<td style="text-align:center" valign="center"> '+
                                '<a title="Visualizar os Boletos" href=javascript:selecionar('+data[nI].id+') class="btn btn-sm btn-primary"><i class="fa fa-barcode" aria-hidden="true"></i></a> '+
                            '</td> '+
                            '</tr>';
                    
                        $("#i-imoveis").append( linha );
                        $("#modalimoveis").modal('show');
                    }
                    
                },
                error:function(  )
                {
                    alert('Não encontrado informações com este número de documento!');
                }
            }
        );
    }  

    function selecionar( id )  
    {
        var url = "{{route('clienteacesso.boletos')}}/"+id;

        $.ajax(
            {
                url : url,
                dataType:'json',
                type:'get',
                success:function( data )
                {
                    linha = "";
                    $("#i-boletos>tbody").empty();
                    for( nI=0;nI < data.length;nI++)
                    {
                        var valor = parseFloat(data[nI].IMB_CGR_VALOR);
                        valor = formatarBRSemSimbolo(valor);

                        linha = 
                            '<tr>'+
                            '<td style="text-align:center valign="center">'+moment(data[nI].IMB_CGR_DATAVENCIMENTO).format('DD/MM/YYYY')+'</td>' +
                            '<td style="text-align:center valign="center">R$ '+valor+'</td>' +
                            '<td style="text-align:center" valign="center"> '+
                                '<a title="Download" href=javascript:imprimir('+data[nI].IMB_CGR_ID+','+data[nI].FIN_CCI_BANCONUMERO+') class="btn btn-sm btn-primary"><i class="fa fa-barcode" aria-hidden="true"></i></a> '+
                            '</td> '+
                            '</tr>';
                    
                        $("#i-boletos").append( linha );
                        $("#modalboletos").modal('show');
                    }

                }
            }
        )



    }
    function imprimir( id, banco )
    {
        var imb_id = $("#i-imb_imb_id").val();

        if( banco == 748 )
        {
            window.location = "{{route('boleto.cliente.748')}}/"+id+'/'+banco;
        }

        if( banco == 33 )
        {
            window.location = "{{route('boleto.cliente.033')}}/"+id+'/'+banco;
        }

        if( banco == 341 )
        {
            window.location = "{{route('boleto.cliente.341')}}/"+id+'/'+banco;
        }

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