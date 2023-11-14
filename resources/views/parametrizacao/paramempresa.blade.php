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

    .footer-gravar
    {
        text-align:center;
    }
    .backencargogarantido
    {
        background-color:#fff2e6;
        color:black;
        text-decoration: bold;
    }

    .backencargonaogarantido
    {
        background-color:#b4ff99;
        color:black;
        text-decoration: bold;
    }
    .dark-soft
    {
        background-color:#f0f5f5;
        color:black;
        
    }
    .dark-soft-plus
    {
        background-color:#a3c2c2;
        color:black;
        border-style: dotted;
    }    
    .dark-soft-plus-dotted-1
    {
        background-color:white;
        color:black;
        border-style: dotted;
        border-width: 1px;
    }    
    .dark-soft-plus-1
    {
        background-color:#e0ebeb;
        color:black;
        border-style: dotted;
    }    
   
    .back-dark
    {
        background-color:black;
        color:white;
    }    
    
    .borda-preta-5
    {
        border-width: 1px;
        border-style: solid,3;
    }

    .div-center
    {
        text-align:center;
    }
    

</style>
@endsection


@section('content')


<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-blue">
            <span class="caption-subject bold uppercase"> Parametrizaçao Empresas(Imobililária)</span>
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
        <div class="row">
            <div class="col-md-12">
                <table  id="tabela" class="table table-bordered table-hover" >
                    <thead class="thead-dark">
                        <tr >
                            <th width="40" style="text-align:center"> Código </th>
                            <th style="text-align:center"> Razão Social </th>
                            <th style="text-align:center"> Nome Fantasia</th>
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

<div class="modal" tabindex="-1" role="dialog" id="mdlDadosImob">
    <div class="modal-dialog "style="width:99%;" >
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                         <div class="caption">
                            <i class="fa fa-gift"></i>Dados Imobiliária
                        </div>
                    </div>
                    <div class="portlet-body form">
                         <div class="form-body">
                             <input type="hidden"  id="IMB_IMB_ID">
                            <div class="row">
                                 <div class="col-md-5">
                                    <label class="control-label">
                                            Razão Social</label>
                                    <input maxlength="40" type="text"  class="form-control" 
                                    id="IMB_IMB_RAZAOSOCIAL" value="" >
                                </div>
                                <div class="col-md-3">
                                    <label class="control-label">
                                            Nome Fantasia</label>
                                    <input maxlength="40" type="text"  class="form-control" 
                                            id="IMB_IMB_NOME" value="" >
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">
                                            Pessoa</label>
                                    <select class="form-control" id="IMB_IMB_PESSOA">
                                            <option value="F">Física</option>
                                            <option value="J">Jurídica</option>
                                    </select>
                                </div>
                             
                                <div class="col-md-2">
                                    <label class="control-label">
                                         Creci                                        
                                    </label>
                                     <input maxlength="10" type="text"  class="form-control" id="IMB_IMB_CRECI" >
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <label class="control-label">Inscr. Estadual/R.G.
                                    </label>
                                    <input type="text" class="form-control" id="IMB_IMB_IE">
                                </div>
                                <div class="col-md-3">
                                    <label class="control-label">C.N.P.J. / C.P.F.
                                    </label>
                                    <input type="text" class="form-control" id="IMB_IMB_CGC">
                                </div>
                                <div class="col-md-3">
                                    <label class="control-label">Responsável/Representante
                                    </label>
                                    <input maxlength="40" type="text" class="form-control" id="IMB_IMB_REPRESENTANTE">
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">C.P.F.
                                    </label>
                                    <input type="text" class="form-control" id="IMB_IMB_REPRESENTANTECPF">
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Padrão
                                            <input type="checkbox" class="form-control" id="IMB_IMB_PADRAO">
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                     <label class="control-label">Endereço
                                    </label>
                                    <input maxlength="40" type="text" class="form-control" id="IMB_IMB_ENDERECO">
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Cep
                                    </label>
                                    <input maxlength="9" type="text" class="form-control" id="IMB_IMB_CEP">
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Bairro
                                    </label>
                                    <input maxlength="20" type="text" class="form-control" id="CEP_BAI_NOME">
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Cidade
                                    </label>
                                    <input maxlength="20" type="text" class="form-control" id="CEP_CID_NOME">
                                </div>
                                <div class="col-md-1">
                                    <label class="control-label">UF
                                    </label>
                                    <input maxlength="20" type="text" class="form-control" id="CEP_UF_SIGLA">
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Cód.IBGE Cidade
                                    </label>
                                    <input maxlength="10" type="text" class="form-control" id="IMB_PRM_CODIGOIBGE">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-1">
                                    <label class="control-label">DDD
                                    </label>
                                    <input maxlength="3" type="text" class="form-control" id="IMB_IMB_DDD">
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Telefone(1)
                                    </label>
                                    <input maxlength="10" type="text" class="form-control" id="IMB_IMB_TELEFONE1">
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Telefone(2)
                                    </label>
                                    <input maxlength="10" type="text" class="form-control" id="IMB_IMB_TELEFONE2">
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Whatsapp
                                    </label>
                                    <input maxlength="10" type="text" class="form-control" id="IMB_IMB_WHATSAPP">
                                </div>
                                <div class="col-md-5">
                                    <label class="control-label">
                                            Email Principal</label>
                                    <input  type="text"  class="form-control" 
                                    id="IMB_IMB_EMAIL">
                                 </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="control-label">
                                            URL Site</label>
                                    <input  type="text"  class="form-control" 
                                    id="IMB_IMB_URL">
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">Url Site(foto)</label>
                                        <input  type="text" class="form-control" id="IMB_IMB_URLIMOVELSITE">
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
                <div class="portlet box dark">
                    <div class="portlet-title">
                         <div class="caption">
                            <i class="fa fa-gift"></i>Opções para Parametrização
                        </div>
                    </div>
                    <div class="portlet-body form">
                         <div class="form-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <button class="btn dark form-control" onClick="geral()">Geral</button>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn dark form-control" onClick="encargos()" >Encargos</button>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn dark form-control" onClick="cobrancaBancaria()">Cobrança Bancária</button>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn dark form-control" onClick="impostos()">Impostos e NFE</button>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn dark form-control" onClick="recibos()">Config. Recibos</button>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn dark form-control" onClick="padroes()">Padrões</button>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn dark form-control" onClick="repasse()">Repasse</button>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn green form-control" onClick="paramWhatsApp()">WhatsApp</button>
                                </div>
                                                                

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onClick="onGravar( 'hide' )">Salvar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>


@include('layout.modalparamencargos')
@include('layout.modalparamcobbancaria')
@include('layout.modalparamimpostos')
@include('layout.modalparamgeral')
@include('layout.modalparamrecibos')
@include('layout.modalparampadroes')
@include('layout.modalparamrepasse')
@include('layout.modalparamwhatsapp')

                   

@endsection

@push('script')

<script src="{{asset('/global/plugins/jquery-minicolors/jquery.minicolors.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/components-color-pickers.min.js')}}" type="text/javascript"></script>

<script>
    
    $(document).ready(function() 
    {
        carga();
        cargaConta();
        cargaContaRepasse();
        cargaFormaRecebimento();
        cargaFormaRepasse();
        cargaCFC();
        cargaStatus();
        $("#sirius-menu").click();

        $('.valor-4').inputmask('decimal', 
        {
            radixPoint:",",
            groupSeparator: ".",
            autoGroup: true,
            digits: 4,
            digitsOptional: false,
            placeholder: '0',
            rightAlign: false,
            onBeforeMask: function (value, opts) 
            {
            return value;
            }
        });


        $('.valor-2').inputmask('decimal', 
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



    });

       
    
    


    
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
                carga();
                
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
        $("#IMB_IMB_ID").val( '');
        $("#IMB_IMB_RAZAOSOCIAL").val( '');
        $("#IMB_IMB_NOME").val( '');
        $("#IMB_IMB_PESSOA").val( '');
        $("#IMB_IMB_CRECI").val( '');
        $("#IMB_IMB_IE").val( '');
        $("#IMB_IMB_CGC").val( '');
        $("#IMB_IMB_REPRESENTANTE").val( '');
        $("#IMB_IMB_REPRESENTANTECPF").val( '');
        $("#IMB_IMB_PADRAO").val( '');
        $("#IMB_IMB_ENDERECO").val( '');
        $("#IMB_IMB_CEP").val( '');
        $("#CEP_BAI_NOME").val( '');
        $("#CEP_CID_NOME").val( '');
        $("#CEP_UF_SIGLA").val( '');
        $("#IMB_PRM_CODIGOIBGE").val( '');
        $("#IMB_IMB_DDD").val( '');
        $("#IMB_IMB_TELEFONE1").val( '');
        $("#IMB_IMB_TELEFONE2").val( '');
        $("#IMB_IMB_EMAIL").val( '');
        $("#IMB_IMB_URL").val( '');
        $("#IMB_IMB_URLIMOVELSITE").val( '');
        $("#FIN_CFC_IDDESCONTO").val( '');
        $("#FIN_CFC_IDMULTA").val( '');
        $("#FIN_CFC_IDJUROS").val( '');
        $("#VIS_STA_IDALUGADO").val( '');
        $("#IMB_PRM_MODRECLOCATARIO").val(''),
        
                    
        
        $("#mdlDadosImob").modal('show');
    }

  function editar( id )
{
    var url = "{{ route('pegarimobiliaria') }}/"+id;
    $.ajax(
        {
            url         : url,
            dataType    : 'json',
            type:       'get',
            async:false,
            success:function( data )
        {
        $("#IMB_IMB_ID").val( data.IMB_IMB_ID);
        $("#IMB_IMB_RAZAOSOCIAL").val( data.IMB_IMB_RAZAOSOCIAL);
        $("#IMB_IMB_NOME").val( data.IMB_IMB_NOME);
        $("#IMB_IMB_PESSOA").val( data.IMB_IMB_PESSOA);
        $("#IMB_IMB_CRECI").val( data.IMB_IMB_CRECI);
        $("#IMB_IMB_IE").val( data.IMB_IMB_IE);
        $("#IMB_IMB_CGC").val( data.IMB_IMB_CGC);
        $("#IMB_IMB_REPRESENTANTE").val(data.IMB_IMB_REPRESENTANTE);
        $("#IMB_IMB_REPRESENTANTECPF").val( data.IMB_IMB_REPRESENTANTECPF);
        $("#IMB_IMB_PADRAO").prop( 'checked',(data.IMB_IMB_PADRAO == 'S') );
        $("#IMB_IMB_ENDERECO").val( data.IMB_IMB_ENDERECO);
        $("#IMB_IMB_CEP").val( data.IMB_IMB_CEP);
        $("#CEP_BAI_NOME").val( data.CEP_BAI_NOME);
        $("#CEP_CID_NOME").val( data.CEP_CID_NOME);
        $("#CEP_UF_SIGLA").val( data.CEP_UF_SIGLA);
        $("#IMB_PRM_CODIGOIBGE").val(data.IMB_PRM_CODIGOIBGE);
        $("#IMB_IMB_DDD").val( data.IMB_IMB_DDD);
        $("#IMB_IMB_TELEFONE1").val( data.IMB_IMB_TELEFONE1);
        $("#IMB_IMB_TELEFONE2").val( data.IMB_IMB_TELEFONE2);
        $("#IMB_IMB_WHATSAPP").val( data.IMB_IMB_WHATSAPP);
        
        $("#IMB_IMB_EMAIL").val( data.IMB_IMB_EMAIL);
        $("#IMB_IMB_URL").val( data.IMB_IMB_URL);
        $("#IMB_IMB_URLIMOVELSITE").val( data.IMB_IMB_URLIMOVELSITE);
        $("#FIN_CFC_IDDESCONTO").val( data.FIN_CFC_IDDESCONTOS);
        $("#FIN_CFC_IDMULTA").val( data.FIN_CFC_IDMULTA);
        $("#FIN_CFC_IDJUROS").val( data.FIN_CFC_IDJUROS);
                
  
        pegarParametros( id );
        //Aba encarggos
               
        $("#mdlDadosImob").modal('show');
    }
        //prioridadeCarga(  data.VIS_PRI_ID );
    });
}


    function carga()
    {
        var url = "{{ route('imobiliaria.carga') }}/todas";
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
                    console.log(data);
                    datainativo = '';
                    var datainativo = moment( data[nI].IMB_IMB_DTHINATIVO ).format('DD/MM/YYYY');

                    if( datainativo == 'Invalid date' )
                            datainativo = '-';

                    linha = 
                            '<tr>'+
                            '   <td>'+data[nI].IMB_IMB_ID+'</td>'+
                            '   <td>'+data[nI].IMB_IMB_RAZAOSOCIAL+'</td>'+
                            '   <td>'+data[nI].IMB_IMB_NOME+'</td>'+
                            '   <td>'+datainativo +'</td>'+
                            '   <td style="text-align:center"> '+
                                    '<a href=javascript:apagar('+data[nI].IMB_IMB_ID+') class="btn btn-sm btn-danger">Excluir</a> '+
                                    '<a href=javascript:editar('+data[nI].IMB_IMB_ID+') class="btn btn-sm green">Editar</a>'+                              
                                '</td> ';
                            '</tr>';

                    $("#tabela").append( linha );
                        
                }
            }
        });
    }

    function onGravar( processo )
    {

        var  url = "{{route('imobiliaria.store')}}";


        var dados =
        {
            IMB_IMB_ID                  : $("#IMB_IMB_ID").val(),
            IMB_IMB_RAZAOSOCIAL         : $("#IMB_IMB_RAZAOSOCIAL").val(),
            IMB_IMB_NOME                : $("#IMB_IMB_NOME").val(),
            IMB_IMB_PESSOA              : $("#IMB_IMB_PESSOA").val(),
            IMB_IMB_CRECI               : $("#IMB_IMB_CRECI").val(),
            IMB_IMB_IE                  : $("#IMB_IMB_IE").val(),
            IMB_IMB_CGC                 : $("#IMB_IMB_CGC").val(),
            IMB_IMB_REPRESENTANTE       : $("#IMB_IMB_REPRESENTANTE").val(),
            IMB_IMB_REPRESENTANTECPF    : $("#IMB_IMB_REPRESENTANTECPF").val(),
            IMB_IMB_PADRAO              : $("#IMB_IMB_PADRAO").prop( "checked" )   ? 'S' : 'N',
            IMB_IMB_ENDERECO            : $("#IMB_IMB_ENDERECO").val(),
            IMB_IMB_CEP                 : $("#IMB_IMB_CEP").val(),
            CEP_BAI_NOME                : $("#CEP_BAI_NOME").val(),
            CEP_CID_NOME                : $("#CEP_CID_NOME").val(),
            CEP_UF_SIGLA                : $("#CEP_UF_SIGLA").val(),
            IMB_PRM_CODIGOIBGE          : $("#IMB_PRM_CODIGOIBGE").val(),
            IMB_IMB_DDD                 : $("#IMB_IMB_DDD").val(),
            IMB_IMB_TELEFONE1           : $("#IMB_IMB_TELEFONE1").val(),
            IMB_IMB_TELEFONE2           : $("#IMB_IMB_TELEFONE2").val(),
            IMB_IMB_WHATSAPP           : $("#IMB_IMB_WHATSAPP").val(),
            IMB_IMB_EMAIL               : $("#IMB_IMB_EMAIL").val(),
            IMB_IMB_URL                 : $("#IMB_IMB_URL").val(),
            IMB_IMB_URLIMOVELSITE       : $("#IMB_IMB_URLIMOVELSITE").val(),

            //aba emcargos
            IMB_PRM_JUROSAPOSUMMES      : $("#IMB_PRM_JUROSAPOSUMMES").prop( "checked" )   ? 'S' : 'N',
            IMB_PRM_COBBANJUROSDIA      : realToDolar( $("#IMB_PRM_COBBANJUROSDIA").val() ),
            IMB_PRM_COBBANCORRECAO      : realToDolar( $("#IMB_PRM_COBBANCORRECAO").val() ),
            IMB_PRM_MULTAREPASSEGAR      :  $("#IMB_PRM_MULTAREPASSEGAR").val() ,
            IMB_PRM_JUROSREPASSEGAR      : $("#IMB_PRM_JUROSREPASSEGAR").val() ,
            IMB_PRM_CORRECAOREPASSEGAR      : $("#IMB_PRM_CORRECAOREPASSEGAR").val() ,
            IMB_PRM_MULTAREPASSENAOGAR      : $("#IMB_PRM_MULTAREPASSENAOGAR").val() ,
            IMB_PRM_JUROSREPASSENAOGAR      :  $("#IMB_PRM_JUROSREPASSENAOGAR").val() ,
            IMB_PRM_CORRECAOREPASSENAOGAR      : $("#IMB_PRM_CORRECAOREPASSENAOGAR").val() ,
            IMB_PRM_PERDEBONIFAPOSDIAS      : $("#IMB_PRM_PERDEBONIFAPOSDIAS").val() ,
                        

            //cobranca bancária
            IMB_PRM_COBBANVALOR : realToDolar( $("#IMB_PRM_COBBANVALOR").val() ),
            IMB_PRM_DIADMAIS : $("#IMB_PRM_DIADMAIS").val(),
            IMB_PRM_TOLERANCIABOLETO : $("#IMB_PRM_TOLERANCIABOLETO").val(),
            IMB_PRM_BAIXARETBANDATAATUAL : $("#IMB_PRM_BAIXARETBANDATAATUAL").prop( "checked" )   ? 'S' : 'N',
            imb_prm_conciliarretornocob : $("#imb_prm_conciliarretornocob").prop( "checked" )   ? 'S' : 'N',
            IMB_PRM_BAIXAAUTOMTOTAL : $("#IMB_PRM_BAIXAAUTOMTOTAL").prop( "checked" )   ? 'S' : 'N',
            IMB_PRM_COBIMPRECRETORNO : $("#IMB_PRM_COBIMPRECRETORNO").prop( "checked" )   ? 'S' : 'N',
            IMB_PRM_COBRARTARALTVEN : $("#IMB_PRM_COBRARTARALTVEN").prop( "checked" )   ? 'S' : 'N',
            IMB_PRM_COBBANINSTRUCAO : $("#IMB_PRM_COBBANINSTRUCAO").val(),
            IMB_TBE_VALORTARALTVEM      : realToDolar( $("#IMB_TBE_VALORTARALTVEM").val() ),
            IMB_TBE_IDTARALTVEN : $("#IMB_TBE_IDTARALTVEN").val(),
            IMB_PRM_MENSAGEMBOLETO : $("#IMB_PRM_MENSAGEMBOLETO").val(),
            IMB_PRM_COBBANTOLERANCIA:  $("#IMB_PRM_COBBANTOLERANCIA").val(),
            IMB_PRM_COBMULTANDIASPER:  realToDolar( $("#IMB_PRM_COBMULTANDIASPER").val()),
            IMB_PRM_COBMULTANDIAS:  $("#IMB_PRM_COBBANTOLERANCIA").val(),
            IMB_PRM_USARPARCELAS : $("#IMB_PRM_USARPARCELAS").prop( "checked" )   ? 'S' : 'N',


                    //impostos
            IMB_PRM_ISSALIQUOTA:  realToDolar( $("#IMB_PRM_ISSALIQUOTA").val()),
            IMB_PRM_ISSALIQUOTA1005:  realToDolar( $("#IMB_PRM_ISSALIQUOTA1005").val()),
            IMB_PRM_TOTALIMPOSTOS:  realToDolar( $("#IMB_PRM_TOTALIMPOSTOS").val()),
            IMB_PRM_TOTALIMPOSTOS1005:  realToDolar( $("#IMB_PRM_TOTALIMPOSTOS1005").val()),
            IMB_PRM_IRRFMINIMO:  realToDolar($("#IMB_PRM_IRRFMINIMO").val()),
            IMB_PRM_INSCRICAOMUNICIPAL:  $("#IMB_PRM_INSCRICAOMUNICIPAL").val(),
            IMB_PRM_NFESUARIO:  $("#IMB_PRM_NFESUARIO").val(),
            IMB_PRM_NFESENHA:  $("#IMB_PRM_NFESENHA").val(),
            IMB_PRM_NOTASERIE:  $("#IMB_PRM_NOTASERIE").val(),
            IMB_PRM_TOKENNFS:  $("#IMB_PRM_TOKENNFS").val(),
                        
            IMB_PRM_NFELINKSISTEMA:  $("#IMB_PRM_NFELINKSISTEMA").val(),
            IMB_CODIGOATIVIDADE:  $("#IMB_CODIGOATIVIDADE").val(),
            IMB_PRM_ISSLOCADORCREDEB : $("#IMB_PRM_ISSLOCADORCREDEB").prop( "checked" )   ? 'S' : 'N',
            IMB_PRM_RETERISSTAXACONTRATO : $("#IMB_PRM_RETERISSTAXACONTRATO").prop( "checked" )   ? 'S' : 'N',
            IMB_PRM_ISSRESPEITARUSUARIO : $("#IMB_PRM_ISSRESPEITARUSUARIO").prop( "checked" )   ? 'S' : 'N',
            IMB_PRM_NUNCAIRRF : $("#IMB_PRM_NUNCAIRRF").prop( "checked" )   ? 'S' : 'N',
            IMB_PRM_IRRFRESPEITARCTR : $("#IMB_PRM_IRRFRESPEITARCTR").prop( "checked" )   ? 'S' : 'N',
            IMB_PRM_NFEAOBAIXAR : $("#IMB_PRM_NFEAOBAIXAR").prop( "checked" )   ? 'S' : 'N',
            
            //geral
            IMB_PRM_CODIFICACONTRATO:  $("#IMB_PRM_CODIFICACONTRATO").val(),
            IMB_PRM_VALORDOCELETRONICO:  realToDolar($("#IMB_PRM_VALORDOCELETRONICO").val()),
            IMB_PRM_MODULOAPROVACAO : $("#IMB_PRM_MODULOAPROVACAO").prop( "checked" )   ? 'S' : 'N',
            IMB_PRM_ARREDONTARREAJSTE : $("#IMB_PRM_ARREDONTARREAJSTE").prop( "checked" )   ? 'S' : 'N',
            IMB_PRM_REPASSEPEGATUDOABERTO : $("#IMB_PRM_REPASSEPEGATUDOABERTO").prop( "checked" )   ? 'S' : 'N',
            IMB_PRM_PONTUAL_SOB_ACORDO : $("#IMB_PRM_PONTUAL_SOB_ACORDO").prop( "checked" )   ? 'S' : 'N',

            //recibos
            IMB_PRM_PER_DIAS_INICIO:  $("#IMB_PRM_PER_DIAS_INICIO").val(),
            IMB_PRM_PER_DIAS_FIM:  $("#IMB_PRM_PER_DIAS_FIM").val(),
            IMB_PRM_RECIBO2FL_LD : $("#IMB_PRM_RECIBO2FL_LD").prop( "checked" )   ? 'S' : 'N',
            IMB_PRM_RECIBO2FL_LT : $("#IMB_PRM_RECIBO2FL_LT").prop( "checked" )   ? 'S' : 'N',
            IMB_PRM_REPASSENORECTO : $("#IMB_PRM_REPASSENORECTO").prop( "checked" )   ? 'S' : 'N',
            IMB_PRM_USARPARCELAS : $("#IMB_PRM_USARPARCELAS").prop( "checked" )   ? 'S' : 'N',
            IMB_PRM_REPASSEDIACERTO : $("#IMB_PRM_REPASSEDIACERTO").prop( "checked" )   ? 'S' : 'N',
            IMB_PRM_RESUMOREPNORECTO : $("#IMB_PRM_RESUMOREPNORECTO").prop( "checked" )   ? 'S' : 'N',
            IMB_PRM_RECLDDESCPONT : $("#IMB_PRM_RECLDDESCPONT").prop( "checked" )   ? 'S' : 'N',
            IMB_PRM_RECLDENDLD : $("#IMB_PRM_RECLDENDLD").prop( "checked" )   ? 'S' : 'N',
            IMB_PRM_NAODESTACARTA_IPTU : $("#IMB_PRM_NAODESTACARTA_IPTU").prop( "checked" )   ? 'S' : 'N',
            IMB_PRM_CONTAPROPNORECIBO : $("#IMB_PRM_CONTAPROPNORECIBO").prop( "checked" )   ? 'S' : 'N',
            IMB_PRM_REPASSEEMAIL : $("#IMB_PRM_REPASSEEMAIL").prop( "checked" )   ? 'S' : 'N',
            IMB_PRM_RECLTDADOSLOCADOR : $("#IMB_PRM_RECLTDADOSLOCADOR").prop( "checked" )   ? 'S' : 'N',
            imb_prm_reclddatabranco : $("#imb_prm_reclddatabranco").prop( "checked" )   ? 'S' : 'N',
            IMB_FORPAG_ID_LOCATARIO : $("#IMB_FORPAG-IDLOCATARIO").val(),
            FIN_CCR_ID_COBRANCA: $("#FIN_CCX_ID_PADRAO_REC").val(),
            FIN_CFC_IDDESCONTOS: $("#FIN_CFC_IDDESCONTO").val(),
            FIN_CFC_IDMULTA: $("#FIN_CFC_IDMULTA").val(),
            FIN_CFC_IDJUROS: $("#FIN_CFC_IDJUROS").val(),
            
                    //repasse
            IMB_PRM_TCPAR1COBRARTA : $("#IMB_PRM_TCPAR1COBRARTA").prop( "checked" )   ? 'S' : 'N',
            IMB_PRM_TCPAR1INCTA : $("#IMB_PRM_TCPAR1INCTA").prop( "checked" )   ? 'S' : 'N',
            IMB_PRM_TCPAR2COBRARTA : $("#IMB_PRM_TCPAR2COBRARTA").prop( "checked" )   ? 'S' : 'N',
            IMB_PRM_TCPAR2INCTA : $("#IMB_PRM_TCPAR2INCTA").prop( "checked" )   ? 'S' : 'N',
            IMB_PRM_TCPAR3COBRARTA : $("#IMB_PRM_TCPAR3COBRARTA").prop( "checked" )   ? 'S' : 'N',
            IMB_PRM_TCPAR3INCTA : $("#IMB_PRM_TCPAR3INCTA").prop( "checked" )   ? 'S' : 'N',
            IMB_PRM_TCPAR4COBRARTA : $("#IMB_PRM_TCPAR4COBRARTA").prop( "checked" )   ? 'S' : 'N',
            IMB_PRM_TCPAR4INCTA : $("#IMB_PRM_TCPAR4INCTA").prop( "checked" )   ? 'S' : 'N',

            IMB_PRM_DEMONSTRATIVOPDF : $("#IMB_PRM_DEMONSTRATIVOPDF").prop( "checked" )   ? 'S' : 'N',

            IMB_FORPAG_IDLOCADOR : $("#IMB_FORPAG_IDLOCADOR").val(),
            FIN_CCX_ID_PADRAO_REP : $("#FIN_CCX_ID_PADRAO_REP").val(),

            IMB_PRM_WSAPELIDO: $("#IMB_PRM_WSAPELIDO").val(),
            IMB_PRM_WSWEBHOOK: $("#IMB_PRM_WSWEBHOOK").val(),
            IMB_TBE_IDSEGINC: $("#IMB_TBE_IDSEGINC").val(),

            IMB_PRM_MODRECLOCATARIO: $("#IMB_PRM_MODRECLOCATARIO").val(),

            IMB_PRM_CODIGOIMOVELRECIBOS : $("#IMB_PRM_CODIGOIMOVELRECIBOS").prop( "checked" )   ? 'S' : 'N',

            VIS_STA_IDALUGADO: $("#VIS_STA_IDALUGADO").val(),

        
        }

        console.log( dados );
        $.ajaxSetup({
            headers:    
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });        

        $.ajax(
            {
                url             : url,
                dataType        : 'json',
                type            : 'post',
                data            : dados,
                success         : function( data )
                {

                    alert('Dados Gravados!');
                    if( processo == 'hide')
                    {
                        $("#mdlDadosImob").modal('hide');
                        carga();
                    }

                },
                error:function()
                {
                    alert('Erro na gravacao');
                }
            

            }
        )


    }

    function encargos()
    {
        if( $("#IMB_IMB_NOME").val() == '' )
        {
            alert('Informe no mínimo o nome da imobiliária antes de colocar informações sobre encargos no atraso de aluguel');
            return false;
        }
        $("#modalParamEncargos").modal('show');
    }

    function pegarParametros( id )
    {
        var url = "{{ route('parametros1') }}";

        dados = { id : id };
        $.ajaxSetup({
            headers:    
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });        


        $.ajax( 
            {
                url     : url,
                dataType: 'json',
                type    : 'get',
                data    : dados,
                success : function( data )
                {


                    $("#IMB_PRM_JUROSAPOSUMMES").prop( 'checked',(data.IMB_PRM_JUROSAPOSUMMES == 'S') );
                    $("#IMB_PRM_COBBANJUROSDIA").val( dolarToReal( data.IMB_PRM_COBBANJUROSDIA));
                    $("#IMB_PRM_COBBANCORRECAO").val( dolarToReal(data.IMB_PRM_COBBANCORRECAO));
                    $("#IMB_PRM_MULTAREPASSEGAR").val( data.IMB_PRM_MULTAREPASSEGAR);
                    $("#IMB_PRM_JUROSREPASSEGAR").val( data.IMB_PRM_JUROSREPASSEGAR);
                    $("#IMB_PRM_CORRECAOREPASSEGAR").val(data.IMB_PRM_CORRECAOREPASSEGAR);
                    $("#IMB_PRM_MULTAREPASSENAOGAR").val( data.IMB_PRM_MULTAREPASSENAOGAR);
                    $("#IMB_PRM_JUROSREPASSENAOGAR").val(data.IMB_PRM_JUROSREPASSENAOGAR);
                    $("#IMB_PRM_CORRECAOREPASSENAOGAR").val(data.IMB_PRM_CORRECAOREPASSENAOGAR);
                    $("#IMB_PRM_PERDEBONIFAPOSDIAS").val(data.IMB_PRM_PERDEBONIFAPOSDIAS);

                    //aba cobranca bancaria
                    $("#IMB_PRM_COBBANVALOR").val( dolarToReal(data.IMB_PRM_COBBANVALOR));
                    $("#IMB_TBE_VALORTARALTVEM").val( dolarToReal(data.IMB_TBE_VALORTARALTVEM));
                    $("#IMB_PRM_BAIXARETBANDATAATUAL").prop( 'checked',(data.IMB_PRM_BAIXARETBANDATAATUAL == 'S') );
                    $("#imb_prm_conciliarretornocob").prop( 'checked',(data.imb_prm_conciliarretornocob == 'S') );
                    $("#IMB_PRM_BAIXAAUTOMTOTAL").prop( 'checked',(data.IMB_PRM_BAIXAAUTOMTOTAL == 'S') );
                    $("#IMB_PRM_COBIMPRECRETORNO").prop( 'checked',(data.IMB_PRM_COBIMPRECRETORNO == 'S') );
                    $("#IMB_PRM_COBRARTARALTVEN").prop( 'checked',(data.IMB_PRM_COBRARTARALTVEN == 'S') );
                    $("#IMB_PRM_USARPARCELAS").prop( 'checked',(data.IMB_PRM_USARPARCELAS == 'S') );

                    $("#IMB_PRM_DIADMAIS").val( data.IMB_PRM_DIADMAIS);
                    $("#IMB_PRM_TOLERANCIABOLETO").val( data.IMB_PRM_TOLERANCIABOLETO);
                    $("#IMB_PRM_COBBANINSTRUCAO").val( data.IMB_PRM_COBBANINSTRUCAO);
                    $("#IMB_TBE_IDTARALTVEN").val( data.IMB_TBE_IDTARALTVEN);
                    $("#IMB_PRM_MENSAGEMBOLETO").val( data.IMB_PRM_MENSAGEMBOLETO);
                    $("#IMB_PRM_COBBANTOLERANCIA").val( data.IMB_PRM_COBBANTOLERANCIA);
                    $("#IMB_PRM_COBMULTANDIASPER").val( dolarToReal(data.IMB_PRM_COBMULTANDIASPER));
                    $("#IMB_PRM_COBMULTANDIAS").val( data.IMB_PRM_COBMULTANDIAS);

                    //impostos
                    
                    $("#IMB_PRM_TOKENNFS").val( data.IMB_PRM_TOKENNFS);
                    $("#IMB_PRM_ISSALIQUOTA").val( dolarToReal(data.IMB_PRM_ISSALIQUOTA));
                    $("#IMB_PRM_ISSALIQUOTA1005").val( dolarToReal(data.IMB_PRM_ISSALIQUOTA1005));
                    $("#IMB_PRM_TOTALIMPOSTOS").val( dolarToReal(data.IMB_PRM_TOTALIMPOSTOS));
                    $("#IMB_PRM_TOTALIMPOSTOS1005").val( dolarToReal(data.IMB_PRM_TOTALIMPOSTOS1005));
                    $("#IMB_PRM_IRRFMINIMO").val( dolarToReal( data.IMB_PRM_IRRFMINIMO));
                    $("#IMB_PRM_INSCRICAOMUNICIPAL").val( data.IMB_PRM_INSCRICAOMUNICIPAL);
                    $("#IMB_PRM_CODIGOIBGE").val( data.IMB_PRM_CODIGOIBGE);
                    $("#IMB_PRM_NFESUARIO").val( data.IMB_PRM_NFESUARIO);
                    $("#IMB_PRM_NFESENHA").val( data.IMB_PRM_NFESENHA);
                    $("#IMB_PRM_NOTASERIE").val( data.IMB_PRM_NOTASERIE);
                    $("#IMB_CODIGOATIVIDADE").val( data.IMB_CODIGOATIVIDADE);
                    $("#IMB_PRM_NFELINKSISTEMA").val( data.IMB_PRM_NFELINKSISTEMA);
                    $("#IMB_PRM_ISSLOCADORCREDEB").prop( 'checked',(data.IMB_PRM_ISSLOCADORCREDEB == 'S') );
                    $("#IMB_PRM_RETERISSTAXACONTRATO").prop( 'checked',(data.IMB_PRM_RETERISSTAXACONTRATO == 'S') );
                    $("#IMB_PRM_ISSRESPEITARUSUARIO").prop( 'checked',(data.IMB_PRM_ISSRESPEITARUSUARIO == 'S') );
                    $("#IMB_PRM_NUNCAIRRF").prop( 'checked',(data.IMB_PRM_NUNCAIRRF == 'S') );
                    $("#IMB_PRM_IRRFRESPEITARCTR").prop( 'checked',(data.IMB_PRM_IRRFRESPEITARCTR == 'S') );
                    $("#IMB_PRM_NFEAOBAIXAR").prop( 'checked',(data.IMB_PRM_NFEAOBAIXAR == 'S') );

    
                    //geral
                    $("#IMB_PRM_CODIFICACONTRATO").val( data.IMB_PRM_CODIFICACONTRATO);
                    $("#IMB_PRM_VALORDOCELETRONICO").val( dolarToReal(data.IMB_CODIGOATIVIDADE));
                    $("#IMB_PRM_MODULOAPROVACAO").prop( 'checked',(data.IMB_PRM_MODULOAPROVACAO == 'S') );
                    $("#IMB_PRM_ARREDONTARREAJSTE").prop( 'checked',(data.IMB_PRM_ARREDONTARREAJSTE == 'S') );
                    $("#IMB_PRM_REPASSEPEGATUDOABERTO").prop( 'checked',(data.IMB_PRM_REPASSEPEGATUDOABERTO == 'S') );
                    $("#IMB_PRM_PONTUAL_SOB_ACORDO").prop( 'checked',(data.IMB_PRM_PONTUAL_SOB_ACORDO == 'S') );


                    //recibos
                    $("#IMB_PRM_PER_DIAS_INICIO").val( data.IMB_PRM_PER_DIAS_INICIO);
                    $("#IMB_PRM_PER_DIAS_FIM").val( data.IMB_PRM_PER_DIAS_FIM);
                    $("#IMB_PRM_RECIBO2FL_LD").prop( 'checked',(data.IMB_PRM_RECIBO2FL_LD == 'S') );
                    $("#IMB_PRM_RECIBO2FL_LT").prop( 'checked',(data.IMB_PRM_RECIBO2FL_LT == 'S') );
                    $("#IMB_PRM_REPASSENORECTO").prop( 'checked',(data.IMB_PRM_REPASSENORECTO == 'S') );
                    $("#IMB_PRM_USARPARCELAS").prop( 'checked',(data.IMB_PRM_USARPARCELAS == 'S') );
                    $("#IMB_PRM_REPASSEDIACERTO").prop( 'checked',(data.IMB_PRM_REPASSEDIACERTO == 'S') );
                    $("#IMB_PRM_RESUMOREPNORECTO").prop( 'checked',(data.IMB_PRM_RESUMOREPNORECTO == 'S') );
                    $("#IMB_PRM_RECLDDESCPONT").prop( 'checked',(data.IMB_PRM_RECLDDESCPONT == 'S') );
                    $("#IMB_PRM_RECLDENDLD").prop( 'checked',(data.IMB_PRM_RECLDENDLD == 'S') );
                    $("#IMB_PRM_NAODESTACARTA_IPTU").prop( 'checked',(data.IMB_PRM_NAODESTACARTA_IPTU == 'S') );
                    $("#IMB_PRM_CONTAPROPNORECIBO").prop( 'checked',(data.IMB_PRM_CONTAPROPNORECIBO == 'S') );
                    $("#IMB_PRM_REPASSEEMAIL").prop( 'checked',(data.IMB_PRM_REPASSEEMAIL == 'S') );
                    $("#IMB_PRM_RECLTDADOSLOCADOR").prop( 'checked',(data.IMB_PRM_RECLTDADOSLOCADOR == 'S') );
                    $("#imb_prm_reclddatabranco").prop( 'checked',(data.imb_prm_reclddatabranco == 'S') );
                    $("#IMB_PRM_CODIGOIMOVELRECIBOS").prop( 'checked',(data.IMB_PRM_CODIGOIMOVELRECIBOS == 'S') );

                    $("#IMB_FORPAG-IDLOCATARIO").val( data.IMB_FORPAG_ID_LOCATARIO);
                    $("#FIN_CCX_ID_PADRAO_REC").val( data.FIN_CCR_ID_COBRANCA);
                    $("#FIN_CFC_IDDESCONTO").val( data.FIN_CFC_IDDESCONTOS);
                    $("#FIN_CFC_IDMULTA").val( data.FIN_CFC_IDMULTA);
                    $("#FIN_CFC_IDJUROS").val( data.FIN_CFC_IDJUROS);


                    //repasse
                    $("#IMB_PRM_TCPAR1COBRARTA").prop( 'checked',(data.IMB_PRM_TCPAR1COBRARTA == 'S') );
                    $("#IMB_PRM_TCPAR1INCTA").prop( 'checked',(data.IMB_PRM_TCPAR1INCTA == 'S') );
                    $("#IMB_PRM_TCPAR2COBRARTA").prop( 'checked',(data.IMB_PRM_TCPAR2COBRARTA == 'S') );
                    $("#IMB_PRM_TCPAR2INCTA").prop( 'checked',(data.IMB_PRM_TCPAR2INCTA == 'S') );
                    $("#IMB_PRM_TCPAR3COBRARTA").prop( 'checked',(data.IMB_PRM_TCPAR3COBRARTA == 'S') );
                    $("#IMB_PRM_TCPAR3INCTA").prop( 'checked',(data.IMB_PRM_TCPAR3INCTA == 'S') );
                    $("#IMB_PRM_TCPAR4COBRARTA").prop( 'checked',(data.IMB_PRM_TCPAR4COBRARTA == 'S') );
                    $("#IMB_PRM_TCPAR4INCTA").prop( 'checked',(data.IMB_PRM_TCPAR4INCTA == 'S') );
                    $("#VIS_STA_IDALUGADO").val(data.VIS_STA_IDALUGADO);
                    $("#IMB_PRM_MODRECLOCATARIO").val(data.IMB_PRM_MODRECLOCATARIO);
                                        
                    $("#IMB_TBE_IDSEGINC").val(data.IMB_TBE_IDSEGINC);


                    $("#IMB_PRM_WSAPELIDO").val( data.IMB_PRM_WSAPELIDO);
                    $("#IMB_PRM_WSWEBHOOK").val( data.IMB_PRM_WSWEBHOOK);


                    $("#IMB_FORPAG_IDLOCADOR").val( data.IMB_FORPAG_IDLOCADOR);
                    $("#FIN_CCX_ID_PADRAO_REP").val( data.FIN_CCX_ID_PADRAO_REP);
                                        
                    $("#IMB_PRM_DEMONSTRATIVOPDF").prop( 'checked',(data.IMB_PRM_DEMONSTRATIVOPDF == 'S') );
                    
                            
                },
                error:function()
                {
                    alert( 'Erro');
                }
            }
        )
  
    }

    function cobrancaBancaria()
    {
        $("#modalcobbancaria").modal( 'show');
    }

    function impostos()
    {
        $("#modalParamImpostos").modal( 'show');
    }

    function geral()
    {
        $("#modamparamgeral").modal( 'show');
        
    }

    function recibos()
    {
        $("#modalparamrecibos").modal( 'show');
    }

    function padroes()
    {
        $("#modalparampadroes").modal( 'show');
    }
    function repasse()
    {
        $("#modalparamrepasse").modal( 'show');
    }


    function cargaStatus()
    {
        url = "{{route('statusimovel.carga')}}/0";

        $.ajax(
        {
            url     : url,
            datatype: 'json',
            type    : 'get',
            async   : false,
            success : function( data )
            {
                console.log( data );
                linha = "";
                $("#VIS_STA_IDALUGADO").empty();
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                        '<option value="'+data[nI].VIS_STA_ID+'">'+
                        data[nI].VIS_STA_NOME+"</option>";
                    $("#VIS_STA_IDALUGADO").append( linha );
                }
            },
            error   : function( e )
            {
                alert('Erro ao carregar os Status'+e);
            }

        });


    }


    function cargaConta()
  { 
    $.getJSON( "{{ route('contacaixa.carga')}}/N", function( data )
    {
      $("#FIN_CCX_ID_PADRAO_REC").empty();
      linha =  '<option value="-1">Selecione</option>';
      $("#FIN_CCX_ID_PADRAO_REC").append( linha );
      for( nI=0;nI < data.length;nI++)
      {
        linha = 
        '<option value="'+data[nI].FIN_CCX_ID+'">'+
                          data[nI].FIN_CCX_DESCRICAO+"</option>";
        $("#FIN_CCX_ID_PADRAO_REC").append( linha );
      }
    });

  }
  function cargaContaRepasse()
  { 
    $.getJSON( "{{ route('contacaixa.carga')}}/N", function( data )
    {
      $("#FIN_CCX_ID_PADRAO_REP").empty();
      linha =  '<option value="-1">Selecione</option>';
      $("#FIN_CCX_ID_PADRAO_REP").append( linha );
      for( nI=0;nI < data.length;nI++)
      {
        linha = 
        '<option value="'+data[nI].FIN_CCX_ID+'">'+
                          data[nI].FIN_CCX_DESCRICAO+"</option>";
        $("#FIN_CCX_ID_PADRAO_REP").append( linha );
      }
    });

  }
  function cargaCFC()
  { 
    $.getJSON( "{{ route('cfc.carga')}}", function( data )
    {
        $("#FIN_CFC_IDMULTA").empty();
        $("#FIN_CFC_IDJUROS").empty();
        $("#FIN_CFC_IDDESCONTO").empty();
            
        linha =  '<option value="-1">Selecione</option>';
        $("#FIN_CFC_IDMULTA").append( linha );
        $("#FIN_CFC_IDJUROS").append( linha );
        $("#FIN_CFC_IDDESCONTO").append( linha );
        for( nI=0;nI < data.length;nI++)
        {
            linha = 
            '<option value="'+data[nI].FIN_CFC_ID+'">'+
                          data[nI].FIN_CFC_DESCRICAO+"</option>";
        $("#FIN_CFC_IDDESCONTO").append( linha );
        $("#FIN_CFC_IDJUROS").append( linha );
        $("#FIN_CFC_IDMULTA").append( linha );

      }
    });

  }

  function cargaFormaRecebimento()
  {
      
    $.getJSON( "{{ route('formapagamento.carga')}}", function( data )
    {
      $("#IMB_FORPAG-IDLOCATARIO").empty();
                
      linha =  '<option value="-1">Forma Pagamento</option>';
      $("#IMB_FORPAG-IDLOCATARIO").append( linha );
      for( nI=0;nI < data.length;nI++)
      {
        linha = 
          '<option value="'+data[nI].IMB_FORPAG_ID+'">'+
                        data[nI].IMB_FORPAG_NOME+"</option>";
        $("#IMB_FORPAG-IDLOCATARIO").append( linha );
      }
    });

  }

  function cargaFormaRepasse()
  {
      
    $.getJSON( "{{ route('formapagamento.carga')}}", function( data )
    {
      $("#IMB_FORPAG_IDLOCADOR").empty();
                
      linha =  '<option value="-1">Forma Repasse</option>';
      $("#IMB_FORPAG_IDLOCADOR").append( linha );
      for( nI=0;nI < data.length;nI++)
      {
        linha = 
          '<option value="'+data[nI].IMB_FORPAG_ID+'">'+
                        data[nI].IMB_FORPAG_NOME+"</option>";
        $("#IMB_FORPAG_IDLOCADOR").append( linha );
      }
    });

  }

  function iniciarAparelho()
  {
    onGravar('');
    url = "{{route('whastapp.instance')}}";

    dados = 
    {
            key : $("#IMB_PRM_WSAPELIDO").val(),
            webhook : true,
            webhookUrl : $("#IMB_PRM_WSWEBHOOK").val(),
 };

    $.ajax(
        {
            url:url,
            dataType:'json',
            type:'get',
            data:dados,
            success:function()
            {
                alert('Aparelho iniciar. Click no segundo passo para obter scanear o QRCODE');
            }
        });
  }  
  function scanearQrCode()
  {
    
    url = "{{route('whastapp.scanqrcode')}}?key="+ $("#IMB_PRM_WSAPELIDO").val();

    window.open( url, '_blank');
  }  

  function paramWhatsApp()
  {
    $("#modalParamWhatsApp").modal( 'show');
  }

  function resetarAparelho()
  {
    url = "{{route('whastapp.resetar')}}";

    dados = { key : $("#IMB_PRM_WSAPELIDO").val() };

    $.ajax(
        {
            url:url,
            dataType:'json',
            type:'get',
            data:dados,
            success:function()
            {
                alert('Restado! Agora execute o primeiro passo');
            }
        });
  }  

  function logoutAparelho()
  {
    url = "{{route('whastapp.logout')}}";

    dados = { 
            key : $("#IMB_PRM_WSAPELIDO").val()
    };

    $.ajax(
        {
            url:url,
            dataType:'json',
            type:'get',
            data:dados,
            success:function()
            {
                alert('Restado! Agora execute o primeiro passo');
            }
        });
  }  

  

  
  
</script>
@endpush












