

@extends('layout.app')

@section('scripttop')
    <link href="{{asset('/global/plugins/bootstrap-colorpicker/css/colorpicker.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/global/plugins/jquery-minicolors/jquery.minicolors.css')}}" rel="stylesheet" type="text/css" />
   
    <link href="{{asset('/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
   
<style>
    .footer {
  position: fixed;
  bottom: 0;
  width: 85%;
  height: 50px;
  background:#e0ebeb;
}


.img-album
        {
            width: 70%;
            height: 100px;
            border-radius: 50%;
        }



    .font-20
    {
        font-size: 20px;
        background-color: darkgray;
        color:white;        
    }
    th, td
    {
        text-align: center;    
        padding: 0 16px !important; /* 0 de padding na vertical e 16px na horizontal */
    }

    .back-div-zelado
    {
        background-color: beige;
    }
    .back-div-sindico
    {
        background-color: antiquewhite
    }
    .bg-blue-fn-white
    {
        background-color: blue;
        color:white;
    }

    .border-05
    {
        border-width: 2px;
        border-color: red;
        border-style: dashed;
    }
    

</style>
@endsection


@section('content')


<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="#">Menu</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Condomínios</span>
        </li>
    </ul>
</div>

<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-blue">
            <span class="caption-subject bold uppercase"> Pesquisa</span>
            <i class="fa fa-search font-blue"></i>
        </div>
    </div>
    <div class="portlet-body form">
        <div class="form-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <input type="text" 
                        class="form-control" 
                                placeholder="por ser um pedaço do nome"
                                id="i-nome-pesquisa">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <button class="btn blue pull-right"  onClick="pesquisarCondominios()">Pesquisar</button>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <button class="btn blue pull-right" id='i-add' onClick="adicionar()">Adicionar</button>
                    </div>
                </div>
            </div>
        </div>

<!--        <hr style="margin-top: 40px;" /> -->
        <div class="row">
            <div class="col-md-12">
                <table  id="tabela" class="table table-bordered table-hover" >
                    <thead class="thead-dark">
                        <tr >
                            <th width="40" style="text-align:center"> Código </th>
                            <th style="text-align:center"> Nome do Condominio </th>
                            <th style="text-align:center"> Tipo </th>
                            <th style="text-align:center"> Administradora</th>
                            <th style="text-align:center"> Qtde. Imóveis</th>
                            <th style="text-align:center"> Inativado</th>
                            <th width="200" style="text-align:center"> Ações </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('layout.modalcondominios')
@include('layout.modaltranfcondominio')

@endsection

@push('script')

<script src="{{asset('/global/plugins/jquery-minicolors/jquery.minicolors.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/components-color-pickers.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>

<script>

var url = '';
    
$(document).ready(function() 
{


    $('#div-servicos .portlet-title .collapse').click();
    $('#div-sindico .portlet-title .collapse').click();
    $('#div-zelador .portlet-title .collapse').click();
    $('#div-caracteristicas .portlet-title .collapse').click();
    $('#div-medidas .portlet-title .collapse').click();
    
    
    $('#IMB_CND_CEP').on('blur', () => 
    {

        let token = document.head.querySelector('meta[name="csrf-token"]');
        if (token) 
        {
            window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
        } 

        if ($.trim($('#IMB_CND_CEP').val()) !== '') 
        {
            $('#mensagem').html('(Aguarde, consultando CEP ...)');
            const cep = $('#IMB_CND_CEP').val();
            const urlBuscaCEP = 'https://viacep.com.br/ws/'+cep+'/json';

            $.get(urlBuscaCEP, (resultadoCEP) => 
            {
                $('#tipologradouro').val('');
                $('#IMB_CND_ENDERECO').val(resultadoCEP.logradouro.substr(0,39) );
                $('#CEP_BAI_NOME').val(resultadoCEP.bairro.substr(0,29));
                $('#CEP_CID_NOME').val(resultadoCEP.localidade.substr( 0, 39 ));
                $('#CEP_UF_SIGLARES').val(resultadoCEP.uf);

            });
        }
    })
  

    $("#i-btn-cancelar").click( function()
    {
        $("#modalCondominios").modal('hide');

    });

    $(".select2").select2(
            {
                placeholder: 'Selecione ',
                width: null
        });

    $('.valor').inputmask('decimal', 
      {
        radixPoint:",",
        groupSeparator: ".",
        autoGroup: true,
        digits: 2,
        digitsOptional: false,
        placeholder: '0',
        rightAlign: false,
        onBeforeMask: function (value, opts) 
        {
          return value;
        }
      });
    
})

function cargaAdmCon()
{
    url = "{{ route('admcon.carga')}}/"+$("#I-IMB_IMB_IDMASTER").val();

    console.log( url );
    $.getJSON( url, function( data)
    {

        console.log('data '+data);
        $("#I-IMB_ADMCON_ID").empty();
        var linha = 
                '<option value="0">Opcional</option>';
        $("#I-IMB_ADMCON_ID").append( linha );
        for( nI=0;nI < data.length;nI++)
        {
            linha = 
                '<option value="'+data[nI].IMB_ADMCON_ID+'">'+
                data[nI].IMB_ADMCON_NOME+"</option>";
                $("#I-IMB_ADMCON_ID").append( linha );
        }       
    });

}

function cargaTotal()
{
    var url = "{{ route('condominio.carga') }}/"+$("#I-IMB_IMB_IDMASTER").val();
    $.getJSON( url, function( data)
    {
        pesquisarCondominios();
    });
}

    
    function apagar( id )
  {
    if (confirm("Tem certeza que deseja inativar este condominio?")) 
    {
      if ( id != '')
      {
        var url = "{{ route( 'condominio.apagar' )}}/"+id;

        $.ajaxSetup({
            headers:    
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
            });        

        $.ajax(
        {
            url : url,
            type: 'post',
            datatype: 'json',
            async:false,
            success: function()
            {
                alert('Inativado!');
                pesquisarCondominios();
                
            },
            error: function()
            {
                alert( 'erro ao inativar registro');
            }

        });
      }
      

    }

  }


  function adicionar( id )
    {
        $("#IMB_CND_ID").val( '');
        $("#IMB_CND_NOME").val( '');
        $('#IMB_ADMCON_ID').val('').trigger('change');
        $("#IMB_CND_VALCON").val( '');
        $("#IMB_CND_ENDERECO").val( '');
        $("#IMB_CND_ENDERECONUMERO").val( '');
        $("#IMB_CND_ENDERECOCOMPLEMENTO").val( '');
        $("#IMB_CND_CEP").val( '');
        $("#CEP_BAI_NOME").val( '');
        $("#IMB_CND_ZELADORNOME").val( '');
        $("#IMB_CND_ZELADORCELULAR").val( '');
        $("#IMB_CND_SINDICONOME").val( '');
        $("#IMB_CND_SINDICOCELULAR").val( '');
        $("#IMB_CND_HORARIOVISITA").val( '');
        $("#IMB_CND_HORARIOSERVICOS").val( '');
        $("#IMB_CND_OBSERVACAO").val( '');
        $("#CEP_UF_SIGLA").val( '');
        $("#CEP_CID_NOME").val( '');
        $('#IMB_ADMCON_IDPORTARIA').val('');

        $('#IMB_CND_VALCON').val(0);
        $('#IMB_CND_VALORIPTU').val(0);
        $('#IMB_CND_FINALIDADE').val('');
        $('#IMB_CND_FACESOL').val('');
        $('#IMB_CND_URLSITE').val('');
        $('#IMB_CND_EMAILADMINISTRACAO').val('');
        $('#IMB_CND_EMAILPORTARIA').val('');
        $('#IMB_CND_SINDICONOME').val('');
        $('#IMB_CND_SINDICOTEL1').val('');
        $('#IMB_CND_SINDICOTEL1OBS').val('');
        $('#IMB_CND_SINDICOTEL2').val('');
        $('#IMB_CND_SINDICOTEL2OBS').val('');
        $('#IMB_CND_SINDICOTEL3').val('');
        $('#IMB_CND_SINDICOTEL3OBS').val('');
        $('#IMB_CND_EMAILSINDICO').val('');
        $('#IMB_CND_ZELADORCONOME').val('');
        $('#IMB_CND_ZELADORCOTEL1').val('');
        $('#IMB_CND_ZELADORCOTEL1OBS').val('');
        $('#IMB_CND_ZELADORCOTEL2').val('');
        $('#IMB_CND_ZELADORCOTEL2OBS').val('');
        $('#IMB_CND_ZELADORCOTEL3').val('');
        $('#IMB_CND_ZELADORCOTEL3OBS').val('');
        $('#IMB_CND_EMAILZELADOR').val('');
        $('#IMB_CND_PORTARIA24').prop('checked',false);
        $('#IMB_CND_PORTARIATIPO').val('');
        $('#IMB_ADMCON_IDGAS').val('').trigger('change');
        $('#IMB_ADMCON_IDPORTARIA').val('').trigger('change');
        $('#IMB_CND_GASFORMA').val('');
        $('#IMB_CND_AGUAFORMA').val('');
        $('#IMB_CND_SALAOFESTAS').prop('checked',false);
        $('#IMB_CND_PISCINAADULTO').prop('checked',false);
        $('#IMB_CND_PISCINAINFANTIL').prop('checked',false);
        $('#IMB_CND_CHURRASQUEIRA').prop('checked',false);
        $('#IMB_CND_FORNOALENHA').prop('checked',false);
        $('#IMB_CND_PLAYGROUND').prop('checked',false);
        $('#imb_cnd_academia').prop('checked',false);
        $('#IMB_CND_QUADRA').prop('checked',false);
        $('#imb_cnd_quadratenis').prop('checked',false);
        $('#IMB_CND_CAMPOFUTEBOL').prop('checked',false);
        $('#IMB_CND_SALAOJOGOS').prop('checked',false);
        $('#IMB_CND_TRILHA').prop('checked',false);
        $('#IMB_CND_QUIOSQUE').prop('checked',false);
        $('#imb_cnd_brinquedoteca').prop('checked',false);
        $('#IMB_CND_CERCAELETRICA').prop('checked',false);
        $('#IMB_CND_SAUNACOL').prop('checked',false);
        $('#IMB_CND_CIRCUITOTV').prop('checked',false);
        $('#IMB_CND_GAS').prop('checked',false);
        
        $("#modalCondominios").modal('show');
    }

  function editar( id )
{
    $("#modalCondominios").modal('show');

    var url = "{{ route('condominio.buscar') }}/"+id;
    console.log( url );
    $.getJSON( url, function( data)
    {
        console.log( data );
        $("#IMB_CND_ID").val( data.IMB_CND_ID);
        $("#IMB_CND_NOME").val( data.IMB_CND_NOME);
        $('#IMB_ADMCON_ID').val(data.IMB_ADMCON_ID).trigger('change');
        $('#IMB_ADMCON_IDPORTARIA').val(data.IMB_ADMCON_IDPORTARIA).trigger('change');
        $('#IMB_ADMCON_IDGAS').val(data.IMB_ADMCON_IDGAS).trigger('change');
        $("#IMB_CND_VALCON").val( dolarToReal( data.IMB_CND_VALCON));
        $("#IMB_CND_ENDERECO").val( data.IMB_CND_ENDERECO);
        $("#IMB_CND_ENDERECONUMERO").val( data.IMB_CND_ENDERECONUMERO);
        $("#IMB_CND_ENDERECOCOMPLEMENTO").val( data.IMB_CND_ENDERECOCOMPLEMENTO);
        $("#IMB_CND_CEP").val( data.IMB_CND_CEP);
        $("#CEP_BAI_NOME").val( data.CEP_BAI_NOME);
        $("#IMB_CND_ZELADORNOME").val( data.IMB_CND_ZELADORNOME);
        $("#IMB_CND_ZELADORCELULAR").val( data.IMB_CND_ZELADORCELULAR);
        $("#IMB_CND_SINDICONOME").val( data.IMB_CND_SINDICONOME);
        $("#IMB_CND_SINDICOCELULAR").val( data.IMB_CND_SINDICOCELULAR);
        $("#IMB_CND_HORARIOVISITA").val( data.IMB_CND_HORARIOVISITA);
        $("#IMB_CND_HORARIOSERVICOS").val( data.IMB_CND_HORARIOSERVICOS);
        $("#IMB_CND_OBSERVACAO").val( data.IMB_CND_OBSERVACAO);
        $("#CEP_UF_SIGLA").val( data.CEP_UF_SIGLA);
        $("#CEP_CID_NOME").val( data.CEP_CID_NOME);
        $("#IMB_CND_TIPO").val( data.IMB_CND_TIPO);

        $('#IMB_CND_VALCON').val( dolarToReal(data.IMB_CND_VALCON));
        $('#IMB_CND_VALORIPTU').val(dolarToReal(data.IMB_CND_VALORIPTU));
        $('#IMB_CND_FINALIDADE').val(data.IMB_CND_FINALIDADE);
        $('#IMB_CND_FACESOL').val(data.IMB_CND_FACESOL);
        $('#IMB_CND_URLSITE').val(data.IMB_CND_URLSITE);
        $('#IMB_CND_EMAILADMINISTRACAO').val(data.IMB_CND_EMAILADMINISTRACAO);
        $('#IMB_CND_EMAILPORTARIA').val(data.IMB_CND_EMAILPORTARIA);
        $('#IMB_CND_SINDICONOME').val(data.IMB_CND_SINDICONOME);
        $('#IMB_CND_SINDICOTEL1').val(data.IMB_CND_SINDICOTEL1);
        $('#IMB_CND_SINDICOTEL1OBS').val(data.IMB_CND_SINDICOTEL1OBS);
        $('#IMB_CND_SINDICOTEL2').val(data.IMB_CND_SINDICOTEL2);
        $('#IMB_CND_SINDICOTEL2OBS').val(data.IMB_CND_SINDICOTEL2OBS);
        $('#IMB_CND_SINDICOTEL3').val(data.IMB_CND_SINDICOTEL3);
        $('#IMB_CND_SINDICOTEL3OBS').val(data.IMB_CND_SINDICOTEL3OBS);
        $('#IMB_CND_EMAILSINDICO').val(data.IMB_CND_EMAILSINDICO);
        $('#IMB_CND_ZELADORCONOME').val(data.IMB_CND_ZELADORCONOME);
        $('#IMB_CND_ZELADORCOTEL1').val(data.IMB_CND_ZELADORCOTEL1);
        $('#IMB_CND_ZELADORCOTEL1OBS').val(data.IMB_CND_ZELADORCOTEL1OBS);
        $('#IMB_CND_ZELADORCOTEL2').val(data.IMB_CND_ZELADORCOTEL2);
        $('#IMB_CND_ZELADORCOTEL2OBS').val(data.IMB_CND_ZELADORCOTEL2OBS);
        $('#IMB_CND_ZELADORCOTEL3').val(data.IMB_CND_ZELADORCOTEL3);
        $('#IMB_CND_ZELADORCOTEL3OBS').val(data.IMB_CND_ZELADORCOTEL3OBS);
        $('#IMB_CND_EMAILZELADOR').val(data.IMB_CND_EMAILZELADOR);
        $('#IMB_CND_PORTARIA24').prop('checked',( data.IMB_CND_PORTARIA24 == 'S') );
        $('#IMB_CND_PORTARIATIPO').val(data.IMB_CND_PORTARIATIPO);
        $('#IMB_ADMCON_IDGAS').val(data.IMB_ADMCON_IDGAS).trigger('change');
        $('#IMB_ADMCON_IDPORTARIA').val(data.IMB_ADMCON_IDPORTARIA).trigger('change');
        $('#IMB_CND_GASFORMA').val(data.IMB_CND_GASFORMA);
        $('#IMB_CND_AGUAFORMA').val(data.IMB_CND_AGUAFORMA);
        $('#IMB_CND_SALAOFESTAS').prop('checked',(data.IMB_CND_SALAOFESTAS =='S') );
        $('#IMB_CND_PISCINAADULTO').prop('checked',(data.IMB_CND_PISCINAADULTO =='S') );
        $('#IMB_CND_PISCINAINFANTIL').prop('checked',(data.IMB_CND_PISCINAINFANTIL =='S') );
        $('#IMB_CND_CHURRASQUEIRA').prop('checked',(data.IMB_CND_CHURRASQUEIRA =='S') );
        $('#IMB_CND_FORNOALENHA').prop('checked',(data.IMB_CND_FORNOALENHA =='S') );
        $('#IMB_CND_PLAYGROUND').prop('checked',(data.IMB_CND_PLAYGROUND =='S') );
        $('#imb_cnd_academia').prop('checked',(data.imb_cnd_academia =='S') );
        $('#IMB_CND_QUADRA').prop('checked',(data.IMB_CND_QUADRA =='S') );
        $('#imb_cnd_quadratenis').prop('checked',(data.imb_cnd_quadratenis =='S') );
        $('#IMB_CND_CAMPOFUTEBOL').prop('checked',(data.IMB_CND_CAMPOFUTEBOL =='S') );
        $('#IMB_CND_SALAOJOGOS').prop('checked',(data.IMB_CND_SALAOJOGOS =='S') );
        $('#IMB_CND_TRILHA').prop('checked',(data.IMB_CND_TRILHA =='S') );
        $('#IMB_CND_QUIOSQUE').prop('checked',(data.IMB_CND_QUIOSQUE =='S') );
        $('#imb_cnd_brinquedoteca').prop('checked',(data.imb_cnd_brinquedoteca =='S') );
        $('#IMB_CND_CERCAELETRICA').prop('checked',(data.IMB_CND_CERCAELETRICA =='S') );
        $('#IMB_CND_SAUNACOL').prop('checked',(data.IMB_CND_SAUNACOL =='S') );
        $('#IMB_CND_CIRCUITOTV').prop('checked',(data.IMB_CND_CIRCUITOTV =='S') );
        $('#IMB_CND_GAS').prop('checked',(data.IMB_CND_GAS =='S') );
        
        $('#IMB_CND_DORQUA').val(data.IMB_CND_DORQUA);
        $('#IMB_CND_GARCOB').val(data.IMB_CND_GARCOB);
        $('#IMB_CND_GARDES').val(data.IMB_CND_GARDES);
        $('#IMB_CND_AREUTI').val(data.IMB_CND_AREUTI);
        $('#IMB_CND_AREPRI').val(data.IMB_CND_AREPRI);
        $('#IMB_CND_DEPOSITO').prop('checked',(data.IMB_CND_DEPOSITO =='S') );

        $('#i-telefone-portaria').html( data.telefoneempport);
        $('#i-email-portaria').html( data.emailempport);
        
        $('#i-telefone-gas').html( data.telefonegas);
        $('#i-telefone-admcon').html( data.telefoneadmcon);
        $('#i-email-adm').html( data.emailadmcon);
        

        //prioridadeCarga(  data.VIS_PRI_ID );
    });
}

function criarStatus()
    {
        
           $.ajaxSetup({
            headers:    
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
            });     

            
            var valorcondominio = 0;
            if( $("#IMB_CND_VALCON").val() != '' )
               valorcondominio = realToDolar($("#IMB_CND_VALCON").val());
               

            corimo = 
                {
                                   
                    IMB_ADMCON_ID : $("#IMB_ADMCON_ID").val(),
                    IMB_CND_ID : $("#IMB_CND_ID").val(),
                    IMB_CND_NOME : $("#IMB_CND_NOME").val(),
                    IMB_CND_VALCON : valorcondominio,
                    IMB_CND_ENDERECO : $("#IMB_CND_ENDERECO").val(),
                    IMB_CND_ENDERECONUMERO : $("#IMB_CND_ENDERECONUMERO").val(),
                    IMB_CND_ENDERECOCOMPLEMENTO : $("#IMB_CND_ENDERECOCOMPLEMENTO").val(),
                    IMB_CND_CEP : $("#IMB_CND_CEP").val(),
                    CEP_BAI_NOME : $("#CEP_BAI_NOME").val(),
                    IMB_CND_ZELADORNOME : $("#IMB_CND_ZELADORNOME").val(),
                    IMB_CND_ZELADORCELULAR : $("#IMB_CND_ZELADORCELULAR").val(),
                    IMB_CND_SINDICONOME : $("#IMB_CND_SINDICONOME").val(),
                    IMB_CND_SINDICOCELULAR : $("#IMB_CND_SINDICOCELULAR").val(),
                    IMB_CND_HORARIOVISITA : $("#IMB_CND_HORARIOVISITA").val(),
                    IMB_CND_HORARIOSERVICOS : $("#IMB_CND_HORARIOSERVICOS").val(),
                    IMB_CND_OBSERVACAO : $("#IMB_CND_OBSERVACAO").val(),
                    CEP_UF_SIGLA : $("#CEP_UF_SIGLA").val(),
                    CEP_CID_NOME : $("#CEP_CID_NOME").val(),
                    IMB_CND_TIPO : $("#IMB_CND_TIPO").val(),                    
                    IMB_CND_VALCON : realToDolar($("#IMB_CND_VALCON").val()),                    
                    IMB_CND_VALORIPTU : realToDolar($("#IMB_CND_VALORIPTU").val()),                    
                    IMB_CND_FINALIDADE : $("#IMB_CND_FINALIDADE").val(),                    
                    IMB_CND_FACESOL : $("#IMB_CND_FACESOL").val(),                    
                    IMB_CND_URLSITE : $("#IMB_CND_URLSITE").val(),                    
                    IMB_CND_EMAILADMINISTRACAO : $("#IMB_CND_EMAILADMINISTRACAO").val(),                    
                    IMB_CND_EMAILPORTARIA : $("#IMB_CND_EMAILPORTARIA").val(),                    
                    IMB_CND_SINDICONOME :    $("#IMB_CND_SINDICONOME").val(),                    
                    IMB_CND_SINDICOTEL1    : $("#IMB_CND_SINDICOTEL1").val(),                    
                    IMB_CND_SINDICOTEL1OBS : $("#IMB_CND_SINDICOTEL1OBS").val(),                    
                    IMB_CND_SINDICOTEL2    : $("#IMB_CND_SINDICOTEL2").val(),                    
                    IMB_CND_SINDICOTEL2OBS : $("#IMB_CND_SINDICOTEL2OBS").val(),                    
                    IMB_CND_SINDICOTEL3    : $("#IMB_CND_SINDICOTEL3").val(),                    
                    IMB_CND_SINDICOTEL3OBS : $("#IMB_CND_SINDICOTEL3OBS").val(),                    
                    IMB_CND_EMAILSINDICO : $("#IMB_CND_EMAILSINDICO").val(),                    
                    IMB_CND_ZELADORNOME :    $("#IMB_CND_ZELADORNOME").val(),                    
                    IMB_CND_ZELADORTEL1    : $("#IMB_CND_ZELADORTEL1").val(),                    
                    IMB_CND_ZELADORTEL1OBS : $("#IMB_CND_ZELADORTEL1OBS").val(),                    
                    IMB_CND_ZELADORTEL2    : $("#IMB_CND_ZELADORTEL2").val(),                    
                    IMB_CND_ZELADORTEL2OBS : $("#IMB_CND_ZELADORTEL2OBS").val(),                    
                    IMB_CND_ZELADORTEL3    : $("#IMB_CND_ZELADORTEL3").val(),                    
                    IMB_CND_ZELADORTEL3OBS : $("#IMB_CND_ZELADORTEL3OBS").val(),                    
                    IMB_CND_EMAILZELADOR : $("#IMB_CND_EMAILZELADOR").val(),                    
                    IMB_CND_PORTARIATIPO : $("#IMB_CND_PORTARIATIPO").val(),                    
                    IMB_ADMCON_IDGAS : $("#IMB_ADMCON_IDGAS").val(),                    
                    IMB_ADMCON_IDPORTARIA : $("#IMB_ADMCON_IDPORTARIA").val(),                    
                    IMB_CND_GASFORMA : $("#IMB_CND_GASFORMA").val(),                    
                    IMB_CND_AGUAFORMA : $("#IMB_CND_AGUAFORMA").val(),                    
                    IMB_CND_SALAOFESTAS : $("#IMB_CND_SALAOFESTAS").prop( "checked" )   ? 'S' : 'N',
                    IMB_CND_PORTARIA24 : $("#IMB_CND_PORTARIA24").prop( "checked" )   ? 'S' : 'N',
                    IMB_CND_PISCINAINFANTIL : $("#IMB_CND_PISCINAINFANTIL").prop( "checked" )   ? 'S' : 'N',
                    IMB_CND_CHURRASQUEIRA : $("#IMB_CND_CHURRASQUEIRA").prop( "checked" )   ? 'S' : 'N',
                    IMB_CND_FORNOALENHA : $("#IMB_CND_FORNOALENHA").prop( "checked" )   ? 'S' : 'N',
                    IMB_CND_PLAYGROUND : $("#IMB_CND_PLAYGROUND").prop( "checked" )   ? 'S' : 'N',
                    imb_cnd_academia : $("#imb_cnd_academia").prop( "checked" )   ? 'S' : 'N',
                    IMB_CND_QUADRA : $("#IMB_CND_QUADRA").prop( "checked" )   ? 'S' : 'N',
                    imb_cnd_quadratenis : $("#imb_cnd_quadratenis").prop( "checked" )   ? 'S' : 'N',
                    IMB_CND_CAMPOFUTEBOL : $("#IMB_CND_CAMPOFUTEBOL").prop( "checked" )   ? 'S' : 'N',
                    IMB_CND_SALAOJOGOS : $("#IMB_CND_SALAOJOGOS").prop( "checked" )   ? 'S' : 'N',
                    IMB_CND_TRILHA : $("#IMB_CND_TRILHA").prop( "checked" )   ? 'S' : 'N',
                    IMB_CND_QUIOSQUE : $("#IMB_CND_QUIOSQUE").prop( "checked" )   ? 'S' : 'N',
                    imb_cnd_brinquedoteca : $("#imb_cnd_brinquedoteca").prop( "checked" )   ? 'S' : 'N',
                    IMB_CND_CERCAELETRICA : $("#IMB_CND_CERCAELETRICA").prop( "checked" )   ? 'S' : 'N',
                    IMB_CND_SAUNACOL : $("#IMB_CND_SAUNACOL").prop( "checked" )   ? 'S' : 'N',
                    IMB_CND_CIRCUITOTV : $("#IMB_CND_CIRCUITOTV").prop( "checked" )   ? 'S' : 'N',
                    IMB_CND_GAS : $("#IMB_CND_GAS").prop( "checked" )   ? 'S' : 'N',
                    IMB_CND_PISCINAADULTO : $("#IMB_CND_PISCINAADULTO").prop( "checked" )   ? 'S' : 'N',

                    IMB_CND_DORQUA : $("#IMB_CND_DORQUA").val(),                    
                    IMB_CND_GARCOB : $("#IMB_CND_GARCOB").val(),                    
                    IMB_CND_GARDES : $("#IMB_CND_GARDES").val(),                    
                    IMB_CND_DEPOSITO : $("#IMB_CND_DEPOSITO").prop( "checked" )   ? 'S' : 'N',                
                    IMB_CND_AREUTI : $("#IMB_CND_AREUTI").val(),                    
                    IMB_CND_AREPRI : $("#IMB_CND_AREPRI").val(),  
                };

        url = "{{ route( 'condominio.salvar' ) }}";

        $.ajax(
        {
            url: url,
            data: corimo,
            datatype:'json',
            type:'post',
            async:false,
            success: function()
            {
                $("#modalCondominios").modal("hide");

                pesquisarCondominios();
            },
            error: function()
            {
                alert( 'Houve erro na tentativa da gravação');
            }

        });

    };

    function pesquisarCondominios()
    {
          if( $("#i-nome-pesquisa").val() == '' ) $("#i-nome-pesquisa").val('TODOS');
//        if( $("#i-nome-pesquisa").val() != '' )
        //{
            var url = "{{ route('condominio.pesquisar') }}/"+
                        $("#i-nome-pesquisa").val()+'/'+
                        $("#I-IMB_IMB_IDMASTER").val();
            console.log('url '+url );
            $.ajax(
            {
                url: url,
                datatype: 'json',
                type: 'get',
                success : function(data)
                {
                    linha = "";
                    $("#tabela>tbody").empty();
                    for( nI=0;nI < data.length;nI++)
                    {
                        datainativo = '';
                        var datainativo = moment( data[nI].IMB_CND_DTHINATIVO ).format('DD/MM/YYYY');

                        if( datainativo == 'Invalid date' )
                            datainativo = '-';

                        var admcon = data[nI].IMB_ADMCON_NOME;
                        if (admcon === null) 
                            admcon = '-';
                
                        var admfon = data[nI].IMB_ADMCON_FONE1;
                        if (admfon === null) 
                           admfon = '-';

                        linha = 
                            '<tr>'+
                            '   <td>'+data[nI].IMB_CND_ID+'</td>'+
                            '   <td>'+data[nI].IMB_CND_NOME+'</td>'+
                            '   <td>'+data[nI].IMB_CND_TIPO+'</td>'+
                            '   <td>'+admcon+'</td>'+
                                '   <td>'+datainativo +'</td>'+
                                '   <td>'+data[nI].qtd+'</td>'+
                            '   <td style="text-align:center"> '+
                                    '<a href=javascript:apagar('+data[nI].IMB_CND_ID+') class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a> '+
                                    '<a href=javascript:editar('+data[nI].IMB_CND_ID+') class="btn btn-sm btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>'+      
                                    '<a href="javascript:abreModalTranfCondominio('+data[nI].IMB_CND_ID+', \''+data[nI].IMB_CND_NOME+'\')" class="btn btn-sm btn-warning"><i class="fa fa-exchange"></i></a>'+    
                                                    
                                '</td> ';
                            '</tr>';

                        $("#tabela").append( linha );
                        
                    }

                }
            });
        //}
    }

    function CarregarImagensCondominio( id )
    {
        
        $( "#galeria-img-condominio" ).empty();        
        $("#galeria-update-btn").hide();        
        var url = "{{ route( 'imagens.condominios')}}/"+id;

        var empresa = "{{Auth::user()->IMB_IMB_ID}}";
        console.log('recarregar');
        $.getJSON( url, function( data)
        {
            
            contador = 4;
            texto='';
            for( nI=0;nI < data.length;nI++)
            {

                console.log('recarregando');
                console.log( data[nI]);
                if( data[nI].IMB_IMG_PRINCIPAL !='S')
                    principal = '<a title="Definir essa imagem como a imagem principal" href=javascript:imagemPrincipal('+data[nI].IMB_IMV_ID+','+
                                    data[nI].IMB_IMG_ID+') class="btn btn-sm btn-warning"><i class="fa fa-check-square-o" aria-hidden="true"></i></a> '
                else
                    principal =
                        '<a class="btn btn-sm btn-success">Principal</a> ';

                bloqnet = '';
                texto = '<div class="col-lg-3 border-05">'+
                        '   <div class="card">'+
                        '       <div class="card-body"> '+
                        '          <h5 class="card-title div-center">'+data[nI].IMB_IMG_NOME+'</h5>' +
                        '       </div> '+
                        
                        '       <a title="click na imagem para ir para o album" href="javascript:verImagem('+data[nI].IMB_IMV_ID+', \''+data[nI].IMB_IMG_ARQUIVO+'\' )"><img class="img-album" src={{url('')}}/storage/images/'+empresa+'/condominios/'+data[nI].IMB_IMV_ID+'/'+data[nI].IMB_IMG_ARQUIVO+'></a>'+
                        '       <a title="Alterar ou complementar informações para esta imagem" href=javascript:editarImagem('+data[nI].IMB_IMG_ID+') class="btn btn-sm btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>'+
                        '       <a title="Rotacionar Imagem para Direita em 90º" href=javascript:rotacionar('+data[nI].IMB_IMV_ID+','+data[nI].IMB_IMG_ID+',90) class="btn btn-sm btn-secondary"><i class="fa fa-rotate-right" aria-hidden="true"></i></a>'+
                        '       <a title="Rotacionar Imagem para Esquerda em 90º" href=javascript:rotacionar('+data[nI].IMB_IMV_ID+','+data[nI].IMB_IMG_ID+',-90) class="btn btn-sm btn-secondary"><i class="fa fa-rotate-left" aria-hidden="true"></i></a>'+
                                                
                        '&nbsp;&nbsp;<a title="Excluir a imagem" href=javascript:apagarImagem('+data[nI].IMB_IMG_ID+') class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>'+
                        '&nbsp;&nbsp;'+principal+
                        '   </div> '+
                        '</div>';
                $( "#galeria-img-condominio" ).append( texto );                

            }


        });
    }


    cargaAdmCon();
    cargaTotal()

</script>
@endpush




