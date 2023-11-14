@extends("layout.app")
@section('scripttop')
<link href="{{asset('/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<style>

.cinza
{
    color:red;
}
.Inativo
{
    text-decoration: line-through;
}
.Rejeitado
{
    color:red;
}
.Liberado
{
    color:Blue;
}
.Aguardando-Retorno
{
    color:Black;
}
.div-center
{
  text-align:center;
}

.naoselecionada {
  text-decoration: line-through;
  color:red;
}

.liberado
{
    color:white;
    background-color:green;
}
.rejeitado
{
    color:white;
    background-color:red;
}

.div-right
{
    text-align:right;
}

.escondido
{
    display:none;
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
}

.cardtitulo {
  text-align: left;
  font-size: 16px;
  color: #4682B4;
  font-weight: bold;

}

.lbl-download-title {
  text-align: center;
  font-size: 20px;
  font-weight: bold;
}

hr {
    height: 2px;
}

div .half-size-line
{
    line-height: 92%;
}

td, th
{
    text-align:center;
}
div.corporel {
  width: 60%;
  height: 500px;
  overflow: scroll;
}

</style>
<script src="{{asset('/global/plugins/sweetalert/sweetalert2.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('/global/plugins/sweetalert/sweetalert2.min.css')}}">

@endsection
@section('content')

<div class="page-bar">
    <div class="col-md-12 div-center" id="div-aguarde-demons">
        <h3>Aguarde um momento....</h3>
    </div>

    <div class="col-md-12">

        <div class="col-md-12 escondido" id = "div-filtro-dem">
            <p>
                .
            </p>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-4">
                        <label> Locador</label>
                        <select  class="select2" id="i-locadores">
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="label-control" for="i-data-inicio">Data Inicial
                            <input class="form-control" type="date" id="i-data-inicio">
                        </label>
                    </div>
                    <div class="col-md-2">
                        <label class="label-control" for="i-data-fim">Data Final
                            <input class="form-control" type="date" id="i-data-fim">
                        </label>
                    </div>
                    <div class="col-md-1">
                        <label class="label-control">Pasta
                            <input class="form-control" type="text" id="IMB_CTR_REFERENCIA_DEMONST">
                        </label>
                    </div>
                    <div class="col-md-1">
                        <label class="label-control" for="i-data-fim">Cód.Imóvel
                            <input class="form-control" type="text" id="IMB_IMV_ID_DEMONST">
                        </label>
                    </div>        
                    <div class="col-md-2">
                        <label class="label-control" >&nbsp;</label>
                        <button title="Carregar informações"class="btn btn-primary" onClick="visualiarRelDemonstrativo()">Visualizar Informações</button>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-12">
                        <label class="control-label">Email do Locador</label>
                        <input class="form-control" type="text" id="i-email-locador-demonstrativo" >
                    </div>

                </div>
            </div>
            
        </div>

    </div>

</div>
<div class="col-md-12 escondido" id="div-rel">
    <div class="col-md-8 corporel" id="corpo-rel" >
    </div>
    <div class="col-md-1">
        <div class="row">
            <hr>
        </div>
        <div class="row">
            <div class="col-md-12 div-center">
            <a href="javascript: enviarDemonstrativoPorEmail()" title="Enviar por email"><i class="fa fa-envelope-o fa-3x" aria-hidden="true"></i></a>
            </div>
        </div>
        <div class="row">
            <hr>
        </div>
        <div class="row">
            <div class="col-md-12 div-center">
                <a href="javascript:cargaDemonstrativo('N')" title="Imprimir um Relatório com as Informações"><i class="fa fa-print fa-3x" aria-hidden="true"></i></a>
            </div>
        </div>
        <div class="row">
            <hr>
        </div>
        <div class="row">
            <div class="col-md-12 div-center">
                <a class="btn success" href="javascript:enviarTodos()" title="Enviar para todos os locadores que tiveram pagamento dentro do periodo informado"></i>Enviar em Lote</a>
            </div>
        </div>
    </div>
</div>
                    
</div>



@endsection

@push('script')

<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/jquery.base64.js')}}"></script>
<script src="{{asset('/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>

<script>

$( document ).ready(function()
{

    limparFiltros();
    $("#IMB_CTR_REFERENCIA_DEMONST").change(function()
    {
        if( $(this).val() =='' )
            cargaLocadores();
        else
            $.ajax(
            {
                url : "{{ route('locadores.contrato')}}/"+$(this).val(),
                dataType:'json',
                type:'get',
                async:false,
                success:function( data )
                {
                    $("#i-locadores").empty();
                    linha ='<option value="">Selecione o Locador</option>';
                    $("#i-locadores").append( linha );
                    for( nI=0;nI < data.length;nI++)
                    {
                        linha =
                            '<option value="'+data[nI].IMB_CLT_ID+'">'+
                                data[nI].IMB_CLT_NOME+
                                "</option>";
                        $("#i-locadores").append( linha );
                    }
                }
            });
    });
    $("#IMB_IMV_ID_DEMONST").change(function()
    {
        if( $(this).val() =='' )
            cargaLocadores();
        else
            $.ajax(
            {
                url : "{{ route('propimo.carga')}}/"+$(this).val(),
                dataType:'json',
                type:'get',
                async:false,
                success:function( data )
                {
                    $("#i-locadores").empty();
                    linha ='<option value="">Selecione o Locador</option>';
                    $("#i-locadores").append( linha );
                    for( nI=0;nI < data.length;nI++)
                    {
                        linha =
                            '<option value="'+data[nI].IMB_CLT_ID+'">'+
                                data[nI].IMB_CLT_NOME+
                                "</option>";
                        $("#i-locadores").append( linha );
                    }
                }
            });
    });

    


    //cargaCarteira();
    $("#sirius-menu").click();
    $("#i-locadores").change( function()
    {
        var url = "{{route('cliente.find')}}/"+$("#i-locadores").val();
        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                async:false,
                success:function( data )
                {
                    $("#i-email-locador-demonstrativo").val( data.IMB_CLT_EMAIL);
                }
            }
        )
        
    })

    
    $(".select2").select2(
        {
            placeholder: 'Selecione',
            width: null
        });
    cargaLocadores();
    $("#div-aguarde-demons").hide();
    $("#div-filtro-dem").show();



});

function cargaDemonstrativo( email)
{

    if( $("#FIN_CCX_ID").val() == '-1' )
    {
        alert('Informe a conta bancária');
        return false;
    }

    if( $("#i-data-inicio").val() == '' )
    {
        alert('Informe a data inicio');
        return false;
    }
        
    
    if( $("#i-data-fim").val() == '' )
    {
        alert('Informe a data fim');
        return false;
    }

    dados =
    {

        datainicial: $("#i-data-inicio").val(),
        datafinal: $("#i-data-fim").val(),
        idcliente: $("#i-locador").val(),
        email: email,
        IMB_CTR_ID : $("#IMB_CTR_REFERENCIA_DEMONST").val(),
        IMB_IMV_ID : $("#IMB_IMV_ID_DEMONST").val(),
    }

    if( email != 'S' )
    {

        var url = "{{route('recibolocador.demonstrativosnew')}}?IMB_CLT_ID="+
                    $("#i-locadores").val()+
                    "&datainicial="+$("#i-data-inicio").val()+
                    "&datafinal="+$("#i-data-fim").val()+"&email="+email+
                    "&IMB_IMV_ID="+$("#IMB_IMV_ID_DEMONST").val()+"&IMB_CTR_REFERENCIA="+$("#IMB_CTR_REFERENCIA_DEMONST").val()
        window.open(url,'_blank');
    }
    else
    {
        var url = "{{route('recibolocador.demonstrativosnew')}}?IMB_CLT_ID="+
                    $("#i-locadores").val()+
                    "&datainicial="+$("#i-data-inicio").val()+
                    "&datafinal="+$("#i-data-fim").val()+"&email="+email+
                    "&IMB_IMV_ID="+$("#IMB_IMV_ID_DEMONST").val()+"&IMB_CTR_REFERENCIA="+$("#IMB_CTR_REFERENCIA_DEMONST").val();

        $.ajax(
        {
            url:url,
            dataType:'json',
            type:'get',
//            async:false,
            success:function()
            {
                alert('Email enviado!');
            },
            complete:function()
            {
                alert('Email enviado');
            }
        });
    }


}


function gerarPDF()
{
    alert('Essa operação pode levar algum tempo para ser processada!');
    window.open( "{{route('cobranca.pdfcobrancagerada')}}", "_blank");

}
function cargaLocadores()
{

    $.ajax(
        {
            url : "{{ route('locadores.carga')}}",
            dataType:'json',
            type:'get',
            async:false,
            success:function( data )
            {
                $("#i-locadores").empty();
                linha ='<option value="">Selecione o Locador</option>';
                $("#i-locadores").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                        '<option value="'+data[nI].IMB_CLT_ID+'">'+
                            data[nI].IMB_CLT_NOME+data[nI].TEMLOCACAO+
                            "</option>";
                    $("#i-locadores").append( linha );
                }
            }
        });
}

function limparFiltros()
{
    cargaLocadores()
    $("#i-data-inicio").val(moment().add( -1,'M' ).format('YYYY-MM-DD'));
    $("#i-data-fim").val(moment().format('YYYY-MM-DD'));
    $("#i-locadores").val('');
}

function modalEmailLocadorDem()
{
    $("#modalemailgenerico").modal('show');
}

function enviarTodos()
{

    if (confirm("Todos os demonstrativos referentes ao periodo informado, serão enviados aos locadores. O sistema irá enviar pra todos e você pode continuar seu trabalho tranquilamente enquanto isso é realizado! Deseja continuar?") == true) 
    {
        var url = "{{route('processos.demodiario')}}";
        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                success:function( )
                {
                    alert('Demonstrativos do dia enviados aos locadores');
                },
                error:function()
                {
                    alert('Erro ao enviar os demonstraticos aos locadores');
                }
            }
        )
    }
}

function visualiarRelDemonstrativo()
{
     url = "{{route('recibolocador.demonstrativosnew')}}?IMB_CLT_ID="+
                    $("#i-locadores").val()+
                    "&datainicial="+$("#i-data-inicio").val()+
                    "&datafinal="+$("#i-data-fim").val()+"&email="+
                    "&IMB_IMV_ID="+$("#IMB_IMV_ID_DEMONST").val()+"&IMB_CTR_REFERENCIA="+$("#IMB_CTR_REFERENCIA_DEMONST").val()+"&retornajson=S";
 
       //Essa é a função success
    //O parâmetro é o retorno da requisição 
    $.ajax(
        {
            url:url,
            dataType:'json',
            type:'get',
            complete:function( data )
            {
                $('#div-rel').load(data);
            },
            success:function(data)
            {

            },
            error:function(res)
            {
                $('#div-rel').show();
                $('#corpo-rel').html(res.responseText);
                

            },
            done:function( data )
            {
            }

        }
    )
    
}

function enviarDemonstrativoPorEmail()
{
        var url = "{{route('cliente.atualizaremail')}}";

        var dados =
        {
            IMB_CLT_ID : $("#i-locadores").val(),
            email : $("#i-email-locador-demonstrativo").val(),
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
                url:url,
                dataType:'json',
                type:'post',
                data:dados,
                success:function()
                {

                }
            }
        );

        cargaDemonstrativo('S');

    
}
</script>

@endpush
