@extends( 'layout.app')
@section('scripttop')
<link href="{{asset('/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

<style>
select[readonly].select2 + .select2-container {
  pointer-events: none;
  touch-action: none;
}
.dark {
      background-color: #383838;
    }

    /* Centralização do conteúdo */
    .center {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }


    .fundo-suave
{
    background-color:  #f2f2f2;
    border: 1px dashed;
}

input[type="checkbox"] {
      position: relative;
      width: 40px;
      height: 20px;
      -webkit-appearance: none; /* Aparência padrão do checkbox é anulada */
      background-color: red; /* cor de fundo */
      outline: none; /* sem borda externa */
      border-radius: 20px; /* arrendodamento dos cantos */
      box-shadow: inset 0 0 5px rgba(95, 85, 85, 0.2); /* sombra interna */
      transition: .2s; /* tempo de transição que vai ocorrer com a cor de fundo e com a posção da bolinha*/
      cursor: pointer;/* estabelecer que o mouse vai ter uma aparência como se fosse clicar em um botão */
    }

    input:checked[type="checkbox"] {
      background-color: #00b33c;/* cor de fundo que vai ser aplicada quando o checkbox tiver uma alteração para checked */
    }
/* O seletor :before pode criar objetos antes do elemento principal, no caso cria a bolinha do botão  */
    input[type="checkbox"]:before {
      content: '';
      position: absolute;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      top: 0;
      left: 0;
      background: #ffffff;
      transform: scale(1.2);
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
      transition: .2s;
    }

    input:checked[type="checkbox"]:before {
      left: 20px;
    }    
.destaque1{
    background-image: url('../image/trib.jpg');
    background-size: 100%;
    border-radius: 15px;
    height: 260px;
    padding-right: 10px;
    margin-right: 5px;
}

td
{
    text-align:center;
}
.color-red
{
    color:red;
}
.color-blue
{
    color:blue;
}

.img-50
{
        max-width:100%;
        width:150px;
}

.div-left
{
    text-align:left;
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
                                        <input type="hidden" id="I-IMB_ATD_IDLOCAL" value="{{$id}}">
                                        <input type="hidden" id="I-IMB_IMB_ATDSEL">
                                        <input type="hidden" id="I-IMB_IMB2_ATDSEL">
                                        <div class="col-md-2 div-center">
                                            <div id="i-div-img">
                                                <img id="imgavatar" class="img-50" src="{{env('APP_URL')}}/storage/images/{{Auth::user()->IMB_IMB_ID}}/usuarios/avatar{{$id}}.jpg" 
                                                onerror="javascript: avatarSemImagem('{{Auth::user()->IMB_IMB_ID}}');" alt="Avatar">
                                            </div>
                                            <label for="file"><u><i>Foto</i></u></label>
                                            <form id="fupForm" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <input type="hidden" name="id" value = "{{$id}}">
                                                    <input type="file" class="form-control" id="file" name="file"
                                                    style="display:none"
                                                     required accept="image/jpg"> 
                                                </div>
                                                
                                                <input type="submit" name="submit" class="btn btn-primary submitBtn" value="Upload" style="display:none" />
                                            </form>
                                            <div class="statusMsg"></div>                                            

                                        </div>
                                        <div class="col-md-10">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Nome</label>
                                                        <input type="text" id='I-IMB_ATD_NOME' class="form-control" maxlenght="40"
                                                            id="i-imb-forpag-nome" required autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label">Apelido</label>
                                                        <input type="text" class="form-control"
                                                        id="I-IMB_ATD_APELIDO" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Email</label>
                                                        <input type="email" class="form-control"
                                                        id="I-IMB_ATD_EMAIL" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-1">

                                                </div>
                                                <div class="col-md-1 " >
                                                    <label class="control-form">Status
                                                        <input  type="checkbox"
                                                            name="IMB_ATD_ATIVO" id="IMB_ATD_ATIVO">
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label class="control-label">Sexo</label>
                                                    <select class="form-control" id="IMB_ATD_SEXO">
                                                        <option value="F">Feminino</option>
                                                        <option value="M">Masculino</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="control-form">CPF</label>
                                                    <div class="form-group">
                                                        <input type="text" id="IMB_ATD_CPF"
                                                        class="form-control" onkeypress="return isNumber(event)" onpaste="return false;">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                          <label class="control-form">RG</label>
                                                        <input type="text" id="IMB_ATD_RG"
                                                        class="form-control" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-form">Creci</label>
                                                        <input type="text" id="IMB_ATD_CRECI"
                                                        class="form-control" autocomplete="off">
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
                                            <div class="col-md-3">
                                                <div class="form-group" >
                                                    <label class="control-label">Unidade Lotado</label>
                                                    <select class="form-control" name="I-IMB_IMB_ID" id="i-select-unidade">
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group" >
                                                    <label class="control-label">Unidade do Colaborador</label>
                                                    <select class="form-control" name="I-IMB_IMB_ID2" id="i-select-unidade2">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                @php
                                                    $imbs = app('App\Http\Controllers\ctrAtendente')->cargaUnidades( $id );
                                                @endphp

                                                
                                                <table  id="tblunidades" class="table table-striped table-bordered table-hover" >
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th class="div-center"> Acesso  </th>
                                                            <th class="div-center"> Unidade </th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach( $imbs as $imb )
                                                            @php
                                                                $status = '';
                                                                if( $imb->IMB_ATU_STATUS == 'S')
                                                                    $status = 'checked';

                                                            @endphp
                                                            <tr>
                                                                <td class="div-center" width="10%">
                                                                    <a href="javascript:mudarStatusUnidade( {{$imb->IMB_CLA_ID}} );"> 
                                                                        <input class="form-control" type="checkbox" id="i-atdimb-{{$imb->IMB_CLA_ID}}" {{$status}} >
                                                                    </a>

                                                                </td>
                                                                <td class="div-left">{{$imb->IMB_IMB_NOME}}</td>
                                                                <td>{{$imb->IMB_ATU_STATUS}}</td>
                                                            </tr>

                                                        @endforeach
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>


                                        <div class="form-actions right">
                                            <button type="cancel" class="btn default" id="i-btn-cancelar" onClick="history.go(-1);">Cancelar</button>
                                            <button type="button" class="btn blue" id="i-btn-gravar" onClick="onGravar()">
                                                        <i class="fa fa-check"></i> Gravar
                                            </button>
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
                                        <div class="col-md-4 div-center fundo-suave">
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
                                            <div class="col-md-4 div-center fundo-suave">
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
                                            <div class="col-md-4 div-center fundo-suave">
                                                <h5><u>Quando se Pagam as Comissões</u> </h5>
                                                <div class="col-md-6">
                                                    <label class="control-label">Dia Fixo(Mês)</label>
                                                     <input type="number" class="form-control" id="IMB_ATD_COMISSAOPAGDIAFIXO" max="31" min="0">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">Dia da Semana</label>
                                                    <select  id="IMB_ATD_COMISSAOPAGDIASEMANA" class="form-control">
                                                        <option value="2">Segunda</option>
                                                        <option value="3">Terça</option>
                                                        <option value="4">Quarta</option>
                                                        <option value="5">Quinta</option>
                                                        <option value="6">Sexta</option>
                                                        <option value="7">Sábado</option>
                                                    </select>
                                                </div>
                                            </div>                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                

                    <div class="portlet box yellow">
                        <div class="portlet-title">
                            <div class="caption">
                                            <i class="fas fa-user"></i>Perfil de Atendimento Para Colaborador
                            </div>
                            <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a>
                            </div>
                        </div>

                        <div class="portlet-body form">
                            <div class="form-body">
                                <div class="row">
                                    <table  id="i-perfil-atendimentos" class="table table-striped table-bordered table-hover" >
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="escondido" width="5%" style="text-align:center">  </th>
                                                <th><a href="javascript:criarLinha();"<b><i class="fa fa-plus-circle fa-2x" aria-hidden="true "></i></b></a></th>
                                                <th width="10%" style="text-align:center"> Negócio </th>
                                                <th width="15%" style="text-align:center"> Tipos Imóveis</th>
                                                <th width="10%" style="text-align:center"> De R$ </th>
                                                <th width="10%" style="text-align:center"> A R$ </th>
                                                <th width="20%" style="text-align:center"> Condominios </th>
                                                <th width="20%" style="text-align:center"> Bairros </th>
                                                <th width="10%" style="text-align:center">  </th>
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
                                <button class="btn btn-warning pull-right btn-md btn-outline " type="button" 
                                    onClick="permissoesUsuario( {{$id}})">Permissões
                                </button>
                                <button class="btn btn-primary pull-right btn-md btn-outline " type="button" 
                                    onClick="gerarBase({{$id}})">Gerar Pemissões com Base em Modelo
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="row">
                            <div class="col-md-12 escondido" id="div-base-usuario">
                                <div class="col-md-6">
                                    <input type="hidden" id="i-funcionariodestino">
                                    @php
                                        $atds = app('App\Http\Controllers\ctrAtendente')->cargaAtivos();
                                    @endphp
                                    <label class="control-label">Informe o Usuário Modelo</label>

                                    <select  class="multiple-select" id="i-idusuario-base">
                                        <option value="">Selecione o usuário....</option>
                                        @foreach( $atds as $atd)
                                            <option value="{{$atd->IMB_ATD_ID}}">{{$atd->IMB_ATD_NOME}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="">&nbsp;</label>
                                    <button onClick="gerarBaseEfetivacao()">Confirmar a Geração Conforme Permissões Base</button>
                                    

                                </div>

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
            <div class="modal-body">
                <form autocomplete="off">
                    <div class="row form-actions right">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Senha</label>
                                <input type="password"
                                class="form-control" id="I-SENHA1" autocomplete="off" value="" />
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
                </form>        
            </div>
        </div>
    </div>
</div>
@include('layout.modalPermissoes')

@endsection            <!-- END CONTENT BODY -->

@push('script')
<script src="{{asset('/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/form-input-mask.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/global/plugins/jquery.input-ip-address-control-1.0.min.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
<script src="{{asset('/global/plugins/sweetalert/sweetalert2.min.js')}}"></script>
<script>

    $( document ).ready(function()
    {
        cargaAtendente();
        cargaPerfilAtendimento();
        (function($) {
            $('#I-IMB_ATD_DATAADMISSAO').mask('99/99/9999',{placeholder:"mm/dd/yyyy"});
            $('#I-IMB_ATD_DATADEMISSAO').mask('99/99/9999',{placeholder:"mm/dd/yyyy"});
        }
        )(jQuery);
        ;

        $.ajaxSetup(
                {
                    headers:    
                    {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    }
                });        


        $("#file").change( function()
        {
            $("#fupForm").submit();
        })
        
        $("#fupForm").on('submit', function(e)
        {
            if( $("#file").val() == '' )
            {
                alert('Informe o arquivo!');
                return false;
            }
            e.preventDefault();
            $.ajax(
            {
                type: 'POST',
                url: "{{ route('imagensusuario')}}",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                success: function(response)
                {
                    $('.statusMsg').html('');
                    if(response.status == 1)
                    {
                        var app = "{{env('APP_URL')}}";
                        $('#fupForm')[0].reset();
                        $("#i-div-img").reset();
                        $("#i-div-img").html('');
                        $("#i-div-img").html('<img class="img-50" src="'+app+'/storage/images/{{Auth::user()->IMB_IMB_ID}}/usuarios/avatar{{$id}}.jpg" alt="Avatar"> ');
                    }
                    else
                    {
                        var app = "{{env('APP_URL')}}";
                        $('#fupForm')[0].reset();
                        $("#i-div-img").html('');
                        $("#i-div-img").html('<img class="img-50" src="'+app+'/storage/images/{{Auth::user()->IMB_IMB_ID}}/usuarios/avatar{{$id}}.jpg" alt="Avatar"> ');
                    }
                    alert('Enviado!!');
                }
            });
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


    });

    function cargaAtendente()
    {
        $("#I-SENHA1").val('');
        $("#I-SENHA2").val('');

        var id = $("#I-IMB_ATD_IDLOCAL").val();
        var url = "{{route('atendente.find')}}/"+id;
        $.ajax(
        {
            url:url,
            datatype:'json',
            async:false,
            success: function( data )
            {

                if( ( $("#I-IMB_IMB_IDMASTER").val() != 0 )  && ( data.IMB_IMB_ID != $("#I-IMB_IMB_IDMASTER").val() )  )
                {
                    window.history.back();
                    return false;
                }



                $("#I-IMB_IMB_ATDSEL").val( data.IMB_IMB_ID );
                $("#I-IMB_IMB2_ATDSEL").val( data.imb_imb_id2 );

                $("#IMB_ATD_CPF").val( data.IMB_ATD_CPF );
                $("#IMB_ATD_RG").val( data.IMB_ATD_RG );
                $("#IMB_ATD_CRECI").val( data.IMB_ATD_CRECI );






                $("#I-IMB_ATD_NOME").val( data.IMB_ATD_NOME );


                $("#I-IMB_ATD_EMAIL").val( data.IMB_ATD_EMAIL );
                $("#I-IMB_ATD_DDD1").val( data.IMB_ATD_DDD1 );
                $("#I-IMB_ATD_TELEFONE_1").val( data.IMB_ATD_TELEFONE_1 );
                $("#I-IMB_ATD_DDD2").val( data.IMB_ATD_DDD2 );
                $("#I-IMB_ATD_TELEFONE_2").val( data.IMB_ATD_TELEFONE_2 );
                $("#I-IMB_ATD_DATAADMISSAO").val( moment(data.IMB_ATD_DATAADMISSAO).format('DD/MM/YYYY') );
                $("#I-IMB_ATD_DATADEMISSAO").val( moment(data.IMB_ATD_DATADEMISSAO).format('DD/MM/YYYY') );
                $("#I-IMB_ATD_TELEFONE_2").val( data.IMB_ATD_TELEFONE_2 );
                $("#IMB_TIPATE_ID").val( data.IMB_TIPATE_ID );
                $("#IMB_ATD_ATIVO").prop( "checked", (data.IMB_ATD_ATIVO =='A') );
                $("#I-IMB_ATD_HABILITARFILA").prop( "checked", (data.IMB_ATD_HABILITARFILA =='S') );
                $("#IMB_ATD_COMISSAOCAPVENDA").val(dolarToReal(data.IMB_ATD_COMISSAOCAPVENDA));
                $("#IMB_ATD_COMISSAOCAPLOC").val(dolarToReal(data.IMB_ATD_COMISSAOCAPLOC));
                $("#IMB_ATD_COMISSAOCORVENDA").val(dolarToReal(data.IMB_ATD_COMISSAOCORVENDA));
                $("#IMB_ATD_COMISSAOCORLOC").val(dolarToReal(data.IMB_ATD_COMISSAOCORLOC));
                $("#IMB_ATD_COMISSAOPAGDIAFIXO").val(data.IMB_ATD_COMISSAOPAGDIAFIXO);
                $("#IMB_ATD_COMISSAOPAGDIASEMANA").val(data.IMB_ATD_COMISSAOPAGDIASEMANA);

                preencherUnidades();
                preencherUnidades2();
                preencherPefil( data.IMB_ATP_ID );
                cargaDireitos( data.IMB_ATD_ID );

            }
        });


    }

    function preencherUnidades()
    {

        var id= $("#I-IMB_IMB_ATDSEL").val();
        var url = "{{route('imobiliaria.carga')}}/"+id;
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
    function preencherPefil( id )
    {

        var url = "{{route('perfil.carga')}}";
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
            $("#IMB_ATP_ID").val( id );
            //preencherUnidades2( id );
        });


    }

    function preencherUnidades2()
    {
        var id= $("#I-IMB_IMB2_ATDSEL").val();
        var url = "{{route('imobiliaria.carga')}}/"+ $("#I-IMB_IMB_ATDSEL").val();;

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


        var ativo = 'I';

        if ( $( "#IMB_ATD_ATIVO" ).is(":checked") )
           ativo = 'A';
//        alert( 'COMERCIAL '+comercial );


        cpfcjg= '';

        if( $("#IMB_ATD_CPF").val() )
        {
          cpfcjg=$("#IMB_ATD_CPF").val();
          cpfcjg = cpfcjg.replace('.','');
          cpfcjg = cpfcjg.replace('-','');
          cpfcjg = cpfcjg.replace('/','');
        }


        var atm =
        {
            IMB_ATD_ID :  $("#I-IMB_ATD_IDLOCAL").val(),
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
            IMB_ATD_ATIVO: ativo,
            IMB_ATP_ID  : $("#IMB_ATP_ID").val(),
            IMB_ATD_CPF  : $("#IMB_ATD_CPF").val(),
            IMB_ATD_RG  : $("#IMB_ATD_RG").val(),
            IMB_ATD_CRECI  : $("#IMB_ATD_CRECI").val(),
            IMB_TIPATE_ID  : $("#IMB_TIPATE_ID").val(),
            IMB_ATD_COMISSAOCAPLOC : realToDolar($("#IMB_ATD_COMISSAOCAPLOC").val()),
            IMB_ATD_COMISSAOCAPVENDA : realToDolar($("#IMB_ATD_COMISSAOCAPVENDA").val()),
            IMB_ATD_COMISSAOCORLOC : realToDolar($("#IMB_ATD_COMISSAOCORLOC").val()),
            IMB_ATD_COMISSAOCORVENDA : realToDolar($("#IMB_ATD_COMISSAOCORVENDA").val()),
            IMB_ATD_COMISSAOPAGDIAFIXO:$("#IMB_ATD_COMISSAOPAGDIAFIXO").val(),
            IMB_ATD_COMISSAOPAGDIASEMANA:$("#IMB_ATD_COMISSAOPAGDIASEMANA").val(),
            IMB_ATD_HABILITARFILA : $("#I-IMB_ATD_HABILITARFILA").prop( "checked" )   ? 'S' : 'N',

        };

        var url="{{ route( 'atendente.update')}}";

        $.ajax(
        {
            url: url,
            dataType: 'JSON',
            type: "post",
            data: atm,
            async:false,
            success: function(data)
                {
                    alert('Gravado!');
                    cargaAtendente();
                    window.history.back();
                },
                error: function( error )
                {
                    console.log('erro '+error);
                }

        });

    }

    function permissoes()
    {
        $(document).ready(function() {


        });


    }

    function alterarSenha()
    {
        if( $("#I-SENHA1").val() != '' )
        {
            if( $("#I-SENHA1").val() != $( "#I-SENHA2").val() )
            {
                alert('senhas não conferem!');
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
                    alert('senha alterada!')/
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


    permissoes();

    function upLoadImagem()
    {

        debugger;
        var arquivos = $("#file").files;

            for (var i = 0; i < arquivos.length; i++)
            {

                var fd = new FormData();
                fd.append( 'arquivo', arquivos[i] );
                fd.append( 'id', $("#i-atd-id").val()  );
                alert('Enviado Imagem: '+(i+1)+'. Pressione aqui para continuar');
            
                $.ajaxSetup(
                {
                    headers:    
                    {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    }
                });        

                $.ajax(
                {
                    url: "{{ route('imagensusuario')}}",
                    type:'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success:function( data )
                    {
                        alert( data );
                    },
                    
                    complete: function( response )
                    {
                        if( response != 0 )
                        {

                            $("#galeria-imagem-upload").val('');


                        }
                        else
                        {
                            $("#galeria-imagem-upload").val('');
                            alert('Arquivo não encontrato');
                        }
                    }
                    ,error:function( e )
                    {
                        alert('error');
                    }
                });
            }
        


    }
    function avatarSemImagem( id )
      {
        $("#imgavatar").attr('src', "https://www.siriussystem.com.br/assets/img/semavatar.png");
      }

    function cargaPerfilAtendimento()
    {

        var url = "{{ route('atendente.perfilatendimento') }}/"+ $("#I-IMB_ATD_IDLOCAL").val();
        $.ajax(
        {
            url:url,
            datatype:'json',
            async:false,
            success: function( data )
            {
                linha = "";
                $("#i-perfil-atendimentos>tbody").empty();
                for( nI=0;nI < data.length;nI++)
                {
                    var fi = parseFloat(data[nI].IMB_ATL_FAIXAINICIALPRECO);
                    var ff = parseFloat(data[nI].IMB_ATL_FAIXAFINALPRECO);
                    linha =
                        '<tr id="tr'+data[nI].IMB_ATL_ID+'">' +
                            '<td  class="escondido">'+data[nI].IMB_ATL_ID+'</td>'+
                            '<td><input  type="checkbox" id="i-ativo-'+data[nI].IMB_ATL_ID+'"></td>'+
                            '<td style="text-align:center valign="center"><select name="atuacao[]" class="form-control multiple-select color-blue perfil'+data[nI].IMB_ATL_ID+'" id="i-atuacao'+data[nI].IMB_ATL_ID+'" multiple></select></td>' +
                            '<td style="text-align:center valign="center"><select name="tipoimovel[]" class="form-control multiple-select color-blue perfil'+data[nI].IMB_ATL_ID+'" id="i-tipoimovel'+data[nI].IMB_ATL_ID+'" multiple></select></td>' +
                            '<td style="text-align:center valign="center"><input id="faixainicial'+data[nI].IMB_ATL_ID+'" class="form-control valor perfil'+data[nI].IMB_ATL_ID+'" value="'+fi+'"></td>'+
                            '<td style="text-align:center valign="center"><input id="faixafinal'+data[nI].IMB_ATL_ID+'" class="form-control valor perfil'+data[nI].IMB_ATL_ID+'" value="'+ff+'"></td>'+
                            '<td style="text-align:center valign="center"><select name="condominio[]" class="form-control multiple-select color-blue perfil'+data[nI].IMB_ATL_ID+'" id="i-condominio'+data[nI].IMB_ATL_ID+'" multiple></select></td>' +
                            '<td style="text-align:center valign="center"><select name="bairro[]" class="form-control multiple-select color-blue perfil'+data[nI].IMB_ATL_ID+'" id="i-bairro'+data[nI].IMB_ATL_ID+'" multiple></select></td>' +
                            '<td>'+
                            '<a  class="btn btn-sm btn-success" href=javascript:alteraPerfil('+data[nI].IMB_ATL_ID+')><i class="fas fa-edit"></i></a>'+
                            '<a  class="btn btn-sm btn-primary" href=javascript:salvarPerfil('+data[nI].IMB_ATL_ID+')><i class="fas fa-save"></i></a>'+
                            
                            '</td>';
                        linha = linha +
                          '</tr>';
                    $("#i-perfil-atendimentos").append( linha );

        
                    cargaAtuacaoPerAte( data[nI].IMB_ATL_ID );
                    cargaTipoImvelPerfilAte( data[nI].IMB_ATL_ID );
                    cargaCondomimioPerfilAte( data[nI].IMB_ATL_ID );  
                    cargaBairroPerfilAte(  data[nI].IMB_ATL_ID );  

                    //cargaBairroPerfilAt( data[nI].IMB_ATL_ID );  
                    $(".multiple-select").select2(
                        {
                            placeholder: 'Selecione ',
                            width: null
                        });
                    
                    habilitarOnOfSelect( data[nI].IMB_ATL_ID, false )


                }
            }
        });
    }


    function cargaAtuacaoPerAte( id )
        {


            var url = "{{ route('atendente.perfilatendimentoneg')}}/"+id;
            $.getJSON( url, function( data )
            {
                $("#i-atuacao"+id).empty();
                linha = '<option value="">Selecione uma ou mais</option>';
                $("#i-atuacao"+id).append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                 
                    linha =
                    '<option value="'+data[nI].IMB_NEG_ID+'"'+data[nI].selection+'>'+
                        data[nI].IMB_NEG_DESCRICAO+"</option>";
                        $("#i-atuacao"+id).append( linha );

                }

            });

        }

        function cargaTipoImvelPerfilAte( id )
        {


            var url = "{{ route('atendente.perfilleadtipimo')}}/"+id;
            $.getJSON( url, function( data )
            {
                $("#i-tipoimovel"+id).empty();
                linha = '<option value="">Selecione uma ou mais</option>';
                $("#i-tipoimovel"+id).append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                 
                    linha =
                    '<option value="'+data[nI].IMB_TIM_ID+'"'+data[nI].selection+'>'+
                        data[nI].IMB_TIM_DESCRICAO+"</option>";
                        $("#i-tipoimovel"+id).append( linha );

                }

            });

        }

        function cargaCondomimioPerfilAte( id )
        {


            var url = "{{ route('atendente.perfilleadcondom')}}/"+id;
            $.getJSON( url, function( data )
            {
                $("#i-condominio"+id).empty();
                linha = '<option value="">Selecione uma ou mais</option>';
                $("#i-condominio"+id).append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                 
                    linha =
                    '<option value="'+data[nI].IMB_CND_ID+'"'+data[nI].selection+'>'+
                        data[nI].IMB_CND_NOME+"</option>";
                        $("#i-condominio"+id).append( linha );

                }

            });

        }



        function cargaBairroPerfilAte( id )
        {


            var url = "{{ route('atendente.perfilleadbairro')}}/"+id;
            $.getJSON( url, function( data )
            {
                $("#i-bairro"+id).empty();
                linha = '<option value="">Selecione uma ou mais</option>';
                $("#i-bairro"+id).append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                 
                    linha =
                    '<option value="'+data[nI].CEP_BAI_ID+'"'+data[nI].selection+'>'+
                        data[nI].CEP_BAI_NOME+"</option>";
                        $("#i-bairro"+id).append( linha );

                }

            });

        }        

        function habilitarOnOfSelect( id, status )
        {
            $('#i-bairro'+id).select2('enable', [status]);
            $('#i-condominio'+id).select2('enable', [status]);
            $('#i-atuacao'+id).select2('enable', [status]);
            $('#i-tipoimovel'+id).select2('enable', [status]);
            $(".perfil1").prop("readonly", status==false )
        }

        function alteraPerfil( id )
        {
            habilitarOnOfSelect( id, true )
        }

        function salvarPerfil( id )
        {

            idatd = $("#I-IMB_ATD_IDLOCAL").val();

            var url = "{{route('atendente.perfil.apagarperfis')}}/"+idatd;
            console.log( url );

            $.ajaxSetup(
            {
                headers:    
                { 'X-CSRF-TOKEN': "{{csrf_token()}}" }
            });        

            $.ajax( 
                {
                    url:url,
                    dataType:'json',
                    type:'post',
                    async:false,
                    success:function()
                    {

                    }
                }
            );

            var arraymembros = [];

            var table = document.getElementById('i-perfil-atendimentos');
            for (var r = 1, n = table.rows.length; r < n; r++)
            {
                idatl = table.rows[r].cells[0].innerHTML;
                faixainicial = $("#faixainicial"+idatl ).val();
                faixafinal = $("#faixafinal"+idatl ).val();
                atuacaosel = $('#i-atuacao'+idatl).select2('data');

                atua = atuacaosel.map( function(eLem )
                {
                    return eLem.id;
                });

            
                bairrossel = $('#i-bairro'+idatl).select2('data');
                bairros = bairrossel.map( function(eLem )
                {
                    return eLem.id;
                });

                condominiosel = $('#i-condominio'+idatl).select2('data');
                condominios = condominiosel.map( function(eLem )
                {
                    return eLem.id;
                });

                tipossel = $('#i-tipoimovel'+idatl).select2('data');
                tipos = tipossel.map( function(eLem )
                {
                    return eLem.id;
                });

                                
                $.ajaxSetup(
                {
                    headers:    
                    {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    }
                });        


                faixainicial = realToDolar( faixainicial);
                faixafinal = realToDolar( faixafinal);

                if( faixainicial > 200000000 ) 
                {
                    alert('O valor da faixa inicial excede o valor permitido');
                    return false;
                }
            
                if( faixafinal > 200000000 ) 
                {
                    alert('O valor da faixa final excede o valor permitido');
                    return false;
                }
            
            



                var atdper =
                {
                    IMB_ATD_ID :  $("#I-IMB_ATD_IDLOCAL").val(),
                    IMB_ATL_FAIXAINICIALPRECO : faixainicial,
                    IMB_ATL_FAIXAFINALPRECO : faixafinal,
                    tipos : tipos,
                    atua : atua,
                    bairros : bairros,
                    condominios: condominios,

                };
                console.log('**********************');
                console.log( 'faixa in '+faixainicial);

                var url="{{ route( 'atendente.perfilatendimento.gravar')}}";
                $.ajax(
                {
                    url: url,
                    dataType: 'JSON',
                    type: "post",
                    data: atdper,
                    success: function(data)
                    {
                    },
                    error: function( error )
                    {
                        console.log('erro '+error);
                    }

                });
                
                console.log(idatl+' - faixa inicial: '+faixainicial+ ' ' + faixafinal );
                console.log('atuacao: ');
                console.log( atua );
                console.log('bairros: ');
                console.log( bairros );
                console.log('condominios: ');
                console.log( condominios );
                console.log('tipos: ');
                console.log( tipos );
            }
        

            habilitarOnOfSelect( id, false )


        }

        function criarLinha()
        {
            var random = Math.floor(Math.random() * 10000000)+1;
            linha =
                        '<tr id="tr'+random+'">' +
                            '<td  class="escondido">'+random+'</td>'+
                            '<td></td>'+                            
                            '<td style="text-align:center valign="center"><select name="atuacao[]" class="form-control multiple-select color-blue perfil'+random+'" id="i-atuacao'+random+'" multiple></select></td>' +
                            '<td style="text-align:center valign="center"><select name="tipoimovel[]" class="form-control multiple-select color-blue perfil'+random+'" id="i-tipoimovel'+random+'" multiple></select></td>' +
                            '<td style="text-align:center valign="center"><input id="faixainicial'+random+'" class="form-control valor perfil'+random+'" value="0"></td>'+
                            '<td style="text-align:center valign="center"><input id="faixafinal'+random+'" class="form-control valor perfil'+random+'" value="0"></td>'+
                            '<td style="text-align:center valign="center"><select name="condominio[]" class="form-control multiple-select color-blue perfil'+random+'" id="i-condominio'+random+'" multiple></select></td>' +
                            '<td style="text-align:center valign="center"><select name="bairro[]" class="form-control multiple-select color-blue perfil'+random+'" id="i-bairro'+random+'" multiple></select></td>' +
                            '<td>'+
                            '<a  class="btn btn-sm btn-success" href=javascript:alteraPerfil('+random+')><i class="fas fa-edit"></i></a>'+
                            '<a  class="btn btn-sm btn-primary" href=javascript:salvarPerfil('+random+')><i class="fas fa-save"></i></a>'+
                            
                            '</td>';
                        linha = linha +
                          '</tr>';
                    $("#i-perfil-atendimentos").append( linha );
                    cargaAtuacaoPerAte( random );
                    cargaTipoImvelPerfilAte(random );
                    cargaCondomimioPerfilAte( random );  
                    cargaBairroPerfilAte(  random );  

                    $(".multiple-select").select2(
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

                    

            
        }

        function gerarBase( id )
        {
            $("#div-base-usuario").show();
            $("#i-funcionariodestino").val( id );
            $(".multiple-select").select2(
                        {
                            placeholder: 'Selecione ',
                            width: null
                        });
        }

        function gerarBaseEfetivacao()
        {
            var url = "{{route('atendentedireitodireito.permissaobase')}}";

            dados =
            {
                idorigem : $("#i-idusuario-base").val(),
                iddestino : $("#i-funcionariodestino").val(),
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
                data: dados,
                async:false,
                success: function(data)
                {
                    alert('Os direitos foram dados ao usuario conforme usuário base selecionado!');
                    $("#div-base-usuario").hide();
                },
                error: function( error )
                {
                    console.log('erro '+error);
                }

            });




        }




</script>
@endpush
