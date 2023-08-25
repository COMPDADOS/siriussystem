@extends( 'layout.app')
@section('scripttop')
<style>
.destaque1{
    background-image: url('../image/trib.jpg'); 
    background-size: 100%;
    border-radius: 15px;
    height: 260px;   
    padding-right: 10px;
    margin-right: 5px;
}
.div-center
{
    text-align:center;
}

.fundo-suave
{
    background-color:  #f2f2f2;
    border: 1px dashed;
}
</style>

@endsection


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                            <i class="fas fa-user"></i>Funcionários/Colaboradores
                            </div>
                            <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a>
                            </div>
                        </div>
                        
                        <div class="portlet-body form">
                            <div class="form-body">
                                <div class="row">
                                    <form name="form_cliente" 
                                        id="i-form-cliente" class="horizontal-form"
                                        onsubmit="onGravar( this ); return false;">
                                        <input type="hidden" id="I-IMB_ATD_IDLOCAL">
                                        <input type="hidden" id="I-IMB_IMB_ATDSEL">
                                        <input type="hidden" id="I-IMB_IMB2_ATDSEL">
                                        <div class="col-md-2 div-center">
                                           <img src="{{url('')}}/storage/images/{{Auth::user()->IMB_IMB_ID}}/logos/usuariosemimagem.jpg" alt="Girl in a jacket" width="100%" height="100%">
                                           <span class="div-center"><button class="btn btn-primary" type="button" onClick="upLoadFoto()">Upload da Foto</button></span>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label class="control-form">CPF</label>
                                                    <div class="form-group">
                                                    <input id = "IMB_ATD_CPF"
                                                            onkeydown="fMasc( this, mCPF )"
                                                                type="text" class="form-control bot-click"  placeholder="Somente números"
                                                                style="font-family: Tahoma; font-size: 16px"
                                                                autocomplete="off">
                                                               <p id="cpfresponse"></p>

                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Nome</label>
                                                        <input type="text" id='I-IMB_ATD_NOME' class="form-control" maxlenght="40" 
                                                            id="i-imb-forpag-nome" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label">Apelido</label>
                                                        <input type="text" class="form-control" 
                                                        id="I-IMB_ATD_APELIDO">
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <label class="control-label">Sexo</label>
                                                    <select class="form-control" id="IMB_ATD_SEXO">
                                                        <option value="F">Feminino</option>
                                                        <option value="M">Masculino</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 " id="i-div-somentecomercial">
                                                    <label class="control-form">Somente Comercial
                                                        <input class="form-control" type="checkbox" 
                                                            data-checkbox="icheckbox_flat-blue" 
                                                            name="comercial" id="I-IMB_ATD_COM">
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                          <label class="control-form">RG</label>
                                                        <input type="text" id="IMB_ATD_RG" 
                                                        class="form-control">
                                                    </div>
                                                </div>
                                                    
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Email</label>
                                                        <input type="email" class="form-control" 
                                                        id="I-IMB_ATD_EMAIL">
                                                    </div>
                                                </div>
                                            <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-form">Creci</label>
                                                        <input type="text" id="IMB_ATD_CRECI" 
                                                        class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="control-label">Tipo Creci</label>
                                                    <select class="form-control" id="IMB_ATD_TIPOCRECI">
                                                        <option value="F">Fisico</option>
                                                        <option value="J">Juridico</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <input type="text" id="I-IMB_ATD_DDD1" 
                                                        class="form-control" onkeypress="return isNumber(event)" onpaste="return false;">
                                                        <span>DDD</span>

                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <input type="text" id="I-IMB_ATD_TELEFONE_1" 
                                                        class="form-control"  onkeypress="return isNumber(event)" onpaste="return false;">
                                                        <span>Nº Fone</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <input type="text" min="01" max="99" id="I-IMB_ATD_DDD2" 
                                                        class="form-control" class="form-control"  onkeypress="return isNumber(event)" onpaste="return false;">
                                                        <span>DDD</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <input type="text" id="I-IMB_ATD_TELEFONE_2" class="form-control"  onkeypress="return isNumber(event)" onpaste="return false;">
                                                        <span>Nº Fone</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <input type="text" min="01" max="99" id="I-IMB_ATD_DDD3" 
                                                        class="form-control" class="form-control"  onkeypress="return isNumber(event)" onpaste="return false;">
                                                        <span>DDD</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <input type="text" id="I-IMB_ATD_TELEFONE_3" class="form-control"  onkeypress="return isNumber(event)" onpaste="return false;">
                                                        <span>Nº Fone</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                     <label class="control-label">Data Admissão</label>
                                                     <input class="form-control" class="form-control"
                                                     id="I-IMB_ATD_DATAADMISSAO" type="text" />
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                     <label class="control-label">Data Demissão</label>
                                                     <input class="form-control" class="form-control"
                                                     id="I-IMB_ATD_DATADEMISSAO" type="text" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="control-label">Área/Equipe</label>
                                                <select class="form-control" id="IMB_ATD_AREA">
                                                <option value="Vendas">Vendas</option>
                                                    <option value="Locação">Locação</option>
                                                    <option value="Lançamentos">Lançamentos</option>
                                                    <option value="Administrativo">Administrativo</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="control-label">Tipo Atendente</label>
                                                @php
                                                    $tas = app('App\Http\Controllers\ctrAtendente')->cargaTipoAtendente();
                                                @endphp
                                                <select class="form-control" id="IMB_TIPATE_ID">
                                                    <option value="">selecione</option>
                                                    @foreach( $tas as $ta)
                                                        <option value="{{$ta->IMB_TIPATE_ID}}">{{$ta->IMB_TIPATE_DESCRICAO}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="control-form">Habilitar Fila
                                                        <input class="form-control" type="checkbox" id="I-IMB_ATD_HABILITARFILA">
                                                    </label>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group" >
                                                    <label class="control-label">Unidade Matriz</label>
                                                    <select class="form-control" name="I-IMB_IMB_ID" id="i-select-unidade">
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group" >
                                                    <label class="control-label">Unidade do Colaborador</label>
                                                    <select class="form-control" name="I-IMB_IMB_ID2" id="i-select-unidade2">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-actions right">
                                            <button type="cancel" class="btn default" id="i-btn-cancelar" onClick="history.go(-1);">Cancelar</button>
                                            <button type="button" class="btn blue" id="i-btn-gravar" onClick="onGravar()">
                                                        <i class="fa fa-check"></i> Gravar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fas fa-user-secret"></i>Metodologia Pagamento de Comissões
                        </div>

                    </div>
                        
                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="row">
                                <div class="portlet-body form">
                                    <div class="col-md-12">
                                    <div class="col-md-5 div-center fundo-suave">
                                            <h5><u>Comissão Sobre Locações </u> </h5>
                                            <div class="col-md-6">
                                                <label class="control-label">% Captação</label>
                                                <input type="text" class="form-control valor" id="IMB_ATD_COMISSAOCAPLOC">
                                            </div>                                                
                                            <div class="col-md-6">
                                                <label class="control-label">% Corretagem</label>
                                                <input type="text" class="form-control valor" id="IMB_ATD_COMISSAOCORLOC">
                                            </div>                                                
                                        </div>
                                        <div class="col-md-5 div-center fundo-suave">
                                            <h5><u>Comissão Sobre Vendas </u> </h5>
                                            <div class="col-md-6">
                                                <label class="control-label">% Captação</label>
                                                <input type="text" class="form-control valor" id="IMB_ATD_COMISSAOCAPVENDA">
                                            </div>                                                
                                            <div class="col-md-6">
                                                <label class="control-label">% Corretagem</label>
                                                <input type="text" class="form-control valor" id="IMB_ATD_COMISSAOCORVENDA">
                                            </div>                                                
                                        </div>
                                        <div class="col-md-2 div-center fundo-suave">
                                            <h5><u>Pagamento</u> </h5>
                                            <div class="col-md-12">
                                                <label class="control-label">Dia Fixo(Mês)</label>
                                                <input type="number" class="form-control" id="IMB_ATD_COMISSAOPAGDIAFIXO" max="31" min="0">
                                            </div>
                                        </div>                                                
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fas fa-user-secret"></i>Segurança
                        </div>

                        <div class="tools">
                            <div>
                                <button class="btn btn-danger pull-right btn-md btn-outline " type="button" id="btn-limpar"
                                    onClick="abrirModalSenha()">Alterar Senha
                                </button>
                            </div>
                        </div>
                    </div>
                        
                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="row">
                                <div class="portlet-body form">
                                    <table  id="i-tbllancamento" class="table table-striped table-bordered table-hover" >
                                        <thead class="thead-dark">
                                            <tr>
                                                <th width="200" style="text-align:center"> Opção do Sistema </th>
                                                <th width="100" style="text-align:center"> Acessar</th>
                                                <th width="100" style="text-align:center"> Incluir </th>
                                                <th width="100" style="text-align:center"> Alterar </th>
                                                <th width="100" style="text-align:center"> Excluir </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="i-modal-senha">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form autocomplete="off">
                <div class="modal-body">
                    <div class="row form-actions right">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Senha</label>
                                <input type="password" autocomplete="off"
                                class="form-control" id="I-SENHA1" value=""/>
                            </div>
                        </div>
                        <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Confirmação</label>
                                    <input type="password"  class="form-control" id="I-SENHA2" autocomplete="off" value=""/>
                                </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">&nbsp;</label>
                                <a class="form-control btn btn-danger" href="#" onclick="alterarSenha();">Confirmar Alteração</a>
                            </div>
                        </div>                                            
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection            <!-- END CONTENT BODY -->

@push('script')
<script src="{{asset('/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/form-input-mask.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/global/plugins/jquery.input-ip-address-control-1.0.min.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
<script>

    $( document ).ready(function() 
    {
        (function($) {
            $('#I-IMB_ATD_DATAADMISSAO').mask('99/99/9999',{placeholder:"mm/dd/yyyy"});
            $('#I-IMB_ATD_DATADEMISSAO').mask('99/99/9999',{placeholder:"mm/dd/yyyy"});
        }
        )(jQuery);
        ;

        $("#I-SENHA1").val('');
        $("#I-SENHA2").val('');
        preencherUnidades();
        preencherUnidades2();
        preencherPefil();

        $("#i-div-somentecomercial").hide();
        
        if( $("#I-IMB_IMB_IDMASTER").val()==0 ) 
            $("#i-div-somentecomercial").show();

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

            

    });


    function preencherUnidades()
    {

        var id= "{{Auth::user()->IMB_IMB_ID}}";
        var url = "{{route('imobiliaria.carga')}}/"+id;
        console.log('url '+url );
        $.getJSON( url, function( data )
        {


            $("#i-select-unidade").empty();
            linha =  '<option value="0">Todas Unidades</option>';
            $("#i-select-unidade").append( linha );
            for( nI=0;nI < data.length;nI++)
            {
                    linha = 
                    '<option value="'+data[nI].IMB_IMB_ID+'" selected>'+
                                data[nI].IMB_IMB_NOME;

                    $("#i-select-unidade").append( linha );
            }
            $("#i-select-unidade").val( id );
            //preencherUnidades2( id );

        });


    }
    function preencherPefil()
    {

        var url = "{{route('perfil.carga')}}";
        console.log('url '+url );
        $.getJSON( url, function( data )
        {


            $("#IMB_ATP_ID").empty();
            linha =  '<option value="0">Selecione Perfil</option>';
            $("#IMB_ATP_ID").append( linha );
            for( nI=0;nI < data.length;nI++)
            {
                    linha = 
                    '<option value="'+data[nI].IMB_ATP_ID+'" selected>'+
                                data[nI].IMB_ATP_DESCRICAO;

                    $("#IMB_ATP_ID").append( linha );
            }
            $("#IMB_ATP_ID").val( "{{Auth::user()->IMB_ATD_ID}}" );
            //preencherUnidades2( id );
        });


    }

    function preencherUnidades2()
    {
        var id= "{{Auth::user()->IMB_IMB_ID}}";
        var url = "{{route('imobiliaria.carga')}}/"+ id

        $.getJSON( url, function( data )
        {
                $("#i-select-unidade2").empty();
                linha =  '<option value="0">Todas Unidades</option>';
                $("#i-select-unidade2").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    
                    linha = 
                        '<option value="'+data[nI].IMB_IMB_ID+'" selected>'+
                                    data[nI].IMB_IMB_NOME;

                    $("#i-select-unidade2").append( linha );
                }
                $("#i-select-unidade2").val( id );

        });
    }


    function onGravar()
    {
        if( $("#IMB_IMB_ID").val() == '-1' )
        {
            alert('Informe a imobiliária a qual pertence!');
            return false;

        }
    
        if( $("#IMB_ATP_ID").val() == '0' )
        {
            alert('Informe o perfil!');
            return false;

        }
    
        if( $("#IMB_IMB_ID2").val() == '-1' )
        {
            alert('Informe a unidade a qual pertence!');
            return false;

        }
    
        if( $("#I-SENHA1").val() != '' )
        {
            if( $("#I-SENHA1").val() != $( "#I-SENHA2").val() )
            {
                alert('Senhas e confirmação não são iguais');
                return false;
            }
        }

        $.ajaxSetup(
        {
            headers:    
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });        

        var dataadm='';
        var data = $("#I-IMB_ATD_DATAADMISSAO").val();
        if ( data != '' )
            dataadm =   data.substr( 6,4 )+'-'+
                    data.substr( 3,2 )+'-'+
                    data.substr( 0,2 );

        var datadem ='';
        data = $("#I-IMB_ATD_DATADEMISSAO").val();
        if ( data != '' )
            datadem =   data.substr( 6,4 )+'-'+
                    data.substr( 3,2 )+'-'+
                    data.substr( 0,2 );


        var comercial = 'N';

        if ( $( "#I-IMB_ATD_COM" ).is(":checked") )
           comercial = 'S';
//        alert( 'COMERCIAL '+comercial );
          
        
        cpfcjg ='';
        if( $("#IMB_ATD_CPF").val() )
        {
          cpfcjg=$("#IMB_ATD_CPF").val();
          cpfcjg = cpfcjg.replace('.','');
          cpfcjg = cpfcjg.replace('-','');
          cpfcjg = cpfcjg.replace('/','');
        }

        var atm = 
        {
            IMB_ATD_CPF :  cpfcjg,
            IMB_ATD_NOME :  $("#I-IMB_ATD_NOME").val(),
            IMB_ATD_APELIDO: $("#I-IMB_ATD_APELIDO").val(),
            IMB_ATD_EMAIL :  $("#I-IMB_ATD_EMAIL").val(),
            IMB_ATD_SENHA :  $("#I-SENHA1").val(),
            IMB_ATD_DDD1 :  $("#I-IMB_ATD_DDD1").val(),
            IMB_ATD_TELEFONE_1 :  $("#I-IMB_ATD_TELEFONE_1").val(),
            IMB_ATD_DDD2 :  $("#I-IMB_ATD_DDD2").val(),
            IMB_ATD_TELEFONE_2 :  $("#I-IMB_ATD_TELEFONE_2").val(),
            IMB_IMB_ID :  $("#i-select-unidade").val(),
            IMB_IMB_ID2 : $("#i-select-unidade2").val(),
            IMB_ATD_DATAADMISSAO: dataadm,
            IMB_ATD_DATADEMISSAO: datadem,
            IMB_ATD_SOMENTECOMERCIAL: comercial,
            IMB_ATP_ID  : $("#IMB_ATP_ID").val(),
            IMB_ATD_HABILITARFILA : $("#I-IMB_ATD_HABILITARFILA").prop( "checked" )   ? 'S' : 'N',
            IMB_TIPATE_ID  : $("#IMB_TIPATE_ID").val(),
            IMB_ATD_COMISSAOCAPLOC : realToDolar($("#IMB_ATD_COMISSAOCAPLOC").val()),
            IMB_ATD_COMISSAOCAPVENDA : realToDolar($("#IMB_ATD_COMISSAOCAPVENDA").val()),
            IMB_ATD_COMISSAOCORLOC : realToDolar($("#IMB_ATD_COMISSAOCORLOC").val()),
            IMB_ATD_COMISSAOCORVENDA : realToDolar($("#IMB_ATD_COMISSAOCORVENDA").val()),
            IMB_ATD_COMISSAOPAGDIAFIXO:$("#IMB_ATD_COMISSAOPAGDIAFIXO").val(),
        };

        
        var url="{{ route( 'atendente.store')}}";
        
        $.ajax(
        {
            url: url,
            dataType: 'JSON',
            type: "post",
            data: atm,
            async:false,
            success: function(data)
                {
                    
                    
                },
                error: function( error )
                {
                    console.log('erro '+error);
                }
                
        });
        window.history.back();
    }

    function permissoes()
    {
        $(document).ready(function() {
        var url = "{{ route('atendente.find')}}/"+$("#I-IMB_ATD_IDLOCAL").val();
        $.getJSON( url, function( data )
        {
            
            if( ( $("#I-IMB_IMB_IDMASTER").val() != 0 )  && ( data.IMB_IMB_ID != $("#I-IMB_IMB_IDMASTER").val() )  )
            {
                Swal.fire({
                position: 'center',
                icon: 'abort',
                title: 'Sem Permissão',
                showConfirmButton: true,
                timer: 3500
              });
              //window.history.back();

            }

        });
        
        });


    }
    
    function alterarSenha()
    {
        if( $("#I-SENHA1").val() != '' )
        {
            if( $("#I-SENHA1").val() != $( "#I-SENHA2").val() )
            {
                Swal.fire({
                        title: 'Ateração de Senha',
                        text: 'Senhas não conferem',
                        icon: 'abort',
                        confirmButtonText: 'Cancelar',
                        confirmButtonColor: '#ff0000'                        

                    })
                return false;
            }
        }

        $.ajaxSetup(
        {
            headers:    
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });        

        var atm = 
        {
            IMB_ATD_ID :  $("#I-IMB_ATD_IDLOCAL").val(),
            IMB_ATD_SENHA :  $("#I-SENHA1").val(),        
        }


        var url="{{ route( 'atendente.updpwd')}}";

        $.ajax(
        {
            url: url,
            dataType: 'JSON',
            type: "post",
            data: atm,
            async:false,
            success: function(data)
                {
                    Swal.fire({
                        title: 'Ateração de Senha',
                        text: 'Senha Alterada com sucesso',
                        icon: 'ok',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#4fb7fe'                        

                    });

                    $("i-modal-senha").modal('hide');
                

                },
                error: function( error )
                {
                    console.log('erro '+error);
                }
                
        });

    }

    function abrirModalSenha()
    {
        $("#i-modal-senha").modal('show');
    }


</script>
@endpush
