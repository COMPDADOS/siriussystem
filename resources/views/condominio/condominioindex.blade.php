

@extends('layout.app')

@section('scripttop')
    <link href="{{asset('/global/plugins/bootstrap-colorpicker/css/colorpicker.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/global/plugins/jquery-minicolors/jquery.minicolors.css')}}" rel="stylesheet" type="text/css" />

<style>
    th, td
    {
        text-align: center;    
        padding: 0 16px !important; /* 0 de padding na vertical e 16px na horizontal */
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

<div class="modal" tabindex="-1" role="dialog" id="mdlStatus">
    <div class="modal-dialog "style="width:90%;" >
        <div class="modal-content">
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>Condominio
                            </div>
                        </div>
                        <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                            <div class="form-body">
                                <input type="hidden"  id="IMB_CND_ID">
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Nome do Condominio</label>
                                            <input maxlength="40" type="text"  class="form-control" 
                                                id="IMB_CND_NOME" value="" >
                                        </div>
                                    </div>  
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">Valor Condomínio</label>
                                            <input type="text"  class="form-control valor" 
                                                id="IMB_CND_VALCON" value="" >
                                        </div>
                                    </div>  
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Administradora</label>
                                            <select id="IMB_ADMCON_ID"  class="form-control">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <label class="control-label">Tipo de Condomínio</label>
                                        <select class="form-control" id="IMB_CND_TIPO">
                                            <option value="Casas Residenciais">Casas Residenciais</option>
                                            <option value="Edificio Residencial">Edificio Residencial</option>
                                            <option value="Lojas Comerciais">Lojas Comerciais</option>
                                            <option value="Chácaras">Chácaras</option>
                                        </select>
                                    </div>


                                    <div class="col-md-5">
                                        <label class="control-label">Endereço</label>
                                            <input type="text"  class="form-control  " 
                                                id="IMB_CND_ENDERECO" value="" >
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label">Número</label>
                                            <input type="text"  class="form-control    " 
                                                id="IMB_CND_ENDERECONUMERO" value="" >
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label">Complemento</label>
                                            <input type="text"  class="form-control  " 
                                                id="IMB_CND_ENDERECOCOMPLEMENTO" value="" >
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        <label class="control-label">Cep</label>
                                            <input type="text"  class="form-control  " 
                                                id="IMB_CND_CEP" value="" 
                                                onkeypress="return isNumber(event)" onpaste="return false;">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label">Bairro</label>
                                            <input type="text"  class="form-control  " 
                                                id="CEP_BAI_NOME" value="" >

                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label">Cidade</label>
                                            <input type="text"  class="form-control  " 
                                                id="CEP_CID_NOME" value="" >
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label">Estado</label>
                                        <select class="form-control" id="CEP_UF_SIGLA">
                                            <option value="AC">Acre</option>
                                            <option value="AL">Alagoas</option>
                                            <option value="AP">Amapá</option>
                                            <option value="AM">Amazonas</option>
                                            <option value="BA">Bahia</option>
                                            <option value="CE">Ceará</option>
                                            <option value="DF">Distrito Federal</option>
                                            <option value="ES">Espírito Santo</option>
                                            <option value="GO">Goiás</option>
                                            <option value="MA">Maranhão</option>
                                            <option value="MT">Mato Grosso</option>
                                            <option value="MS">Mato Grosso do Sul</option>
                                            <option value="MG">Minas Gerais</option>
                                            <option value="PA">Pará</option>
                                            <option value="PB">Paraíba</option>
                                            <option value="PR">Paraná</option>
                                            <option value="PE">Pernambuco</option>
                                            <option value="PI">Piauí</option>
                                            <option value="RJ">Rio de Janeiro</option>
                                            <option value="RN">Rio Grande do Norte</option>
                                            <option value="RS">Rio Grande do Sul</option>
                                            <option value="RO">Rondônia</option>
                                            <option value="RR">Roraima</option>
                                            <option value="SC">Santa Catarina</option>
                                            <option value="SP">São Paulo</option>
                                            <option value="SE">Sergipe</option>
                                            <option value="TO">Tocantins</option>
                                            <option value="EX">Estrangeiro</option>                        
                                        </select>
                                    </div>


                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <label class="control-label">Nome Zelador</label>
                                        <input type="text"  class="form-control  " 
                                                id="IMB_CND_ZELADORNOME" value="" >
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label">Zelador Celular </label>
                                        <input type="text"  class="form-control  " 
                                                id="IMB_CND_ZELADORCELULAR" value="" >
                                    </div>
                                    <div class="col-md-2">

                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Nome Síndico</label>
                                        <input type="text"  class="form-control  " 
                                                id="IMB_CND_SINDICONOME" value="" >
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label">Síndico Celular</label>
                                        <input type="text"  class="form-control  " 
                                                id="IMB_CND_SINDICOCELULAR" value="" >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <label class="control-label">Informações sobre horário visitas</label>
                                        <input type="text"  class="form-control  " 
                                                id="IMB_CND_HORARIOVISITA" value="" >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <label class="control-label">Informações sobre horário para serviços</label>
                                        <input type="text"  class="form-control  " 
                                                id="IMB_CND_HORARIOSERVICOS" value="" >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-12">Observações Gerais
                                        <textarea class="form-control" id="IMB_CND_OBSERVACAO" rows="5"></textarea>
                                    </div>
                                </div>
                                    



                                <div class="form-actions right">
                                    <button type="button" class="btn default" id="i-btn-cancelar">Cancelar</button>
                                    <button type="button" class="btn blue" id="i-btn-gravar" onClick="criarStatus()">
                                            <i class="fa fa-check"></i> Gravar
                                    </button>                                            
                                </div>
                                                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        <div class="modal-footer">
        </div>
    </div>
</div>

@endsection

@push('script')

<script src="{{asset('/global/plugins/jquery-minicolors/jquery.minicolors.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/components-color-pickers.min.js')}}" type="text/javascript"></script>

<script>

var url = '';
    

    $("#i-btn-cancelar").click( function()
    {
        $("#mdlStatus").modal('hide');

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
        $("#IMB_ADMCON_ID").val( '');
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
        $("#mdlStatus").modal('show');
    }

  function editar( id )
{
    $("#mdlStatus").modal('show');

    var url = "{{ route('condominio.buscar') }}/"+id;
    $.getJSON( url, function( data)
    {
        $("#IMB_CND_ID").val( data.IMB_CND_ID);
        $("#IMB_CND_NOME").val( data.IMB_CND_NOME);
        $("#IMB_ADMCON_ID").val( data.IMB_ADMCON_ID);
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
                $("#mdlStatus").modal("hide");

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
                            '   <td style="text-align:center"> '+
                                    '<a href=javascript:apagar('+data[nI].IMB_CND_ID+') class="btn btn-sm btn-danger">Excluir</a> '+
                                    '<a href=javascript:editar('+data[nI].IMB_CND_ID+') class="btn btn-sm btn-primary">Editar</a>'+                              
                                '</td> ';
                            '</tr>';

                        $("#tabela").append( linha );
                        
                    }

                }
            });
        //}
    }

    cargaAdmCon();
    cargaTotal()

</script>
@endpush




