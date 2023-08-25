@extends("layout.app")
@section('scripttop')
<style>

    .escondido
    {
        display: none;
    }

    .footer {
  position: fixed;
  bottom: 0;
  width: 100%;
  height: 40px;
  background:#a3c2c2;
}

.riscado {
   -webkit-text-decoration-line: line-through; /* Safari */
   text-decoration-line: line-through;
}
.div-center {
    text-align: center;
  }

.font-16-bold
{
    color:black;
    font-size:12px;
}

tr
{
    height:10px;
}
</style>
@endsection

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="col-md-11">
            <div class="col-md-2 div-center">
                <div class="form-check">
                    <input class="form-control" type="radio" name="flexRadioDefault" id="optnovoatendimento">
                    <label for="flexRadioDefault1">
                        <b>Criar novo atendimento</b>
                    </label>
                </div>
            </div>
            <div class="col-md-2 div-center">        
                <div class="form-check">
                    <input class="form-control" type="radio" name="flexRadioDefault" id="uptsequenciaatendimento" checked>
                    <label  for="flexRadioDefault2">
                    <b> Sequencia a um atendimento</b>
                    </label>
                </div>
            </div>
            <div class="col-md-1">
                <label>&nbsp;</label>
                <button class="form-control btn btn-primary" onClick="prosseguir()">Prosseguir</button>
            </div>
            <div class="col-md-6 escondido" id="div-localizaratm">
                <div class="col-md-10">
                    <label class="control-label">Localize o atendimento para dar sequência</label>
                    <select class="select2 form-control" id="i-localizaratm" >
                    </select>
                </div>            
    
                <div class="col-md-2">
                    <label >&nbsp;</label>
                    <button class="form-control btn btn-success" onClick="prosseguir2()">Prosseguir</button>
                </div>
            </div>
           </div>

        <div class="col-md-1">
            <div class="caption font-blue">
                <span class="caption-subject bold uppercase"> Saída de Chaves</span>
                
            </div>
        </div>
    </div>
    </div>

    <div class="row">
    </div>

    <div class="row">
        <div class="col-md-2">
        </div>
    </div>

    <div class="col-md-12 escondido" id="div-informacoes">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-2">
                    <label class="label-control">Motivo da Saída</label>
                        <select class="form-control" id="i-modivo">
                            <option value="V" selected>Visita de Cliente</option>
                            <option value="M" >Manutenção</option>
                        </select>
                    
                </div>
                    <div class="col-md-2">
                        <label class="label-control">Tipo que Pegou</label>
                            <select class="form-control" id="IMB_CCH_TIPOSOLICITANTE">
                                <option value="F">Funcionário/Corretor</option>
                                <option value="C">Cliente</option>
                                <option value="T">Terceiro/Parceiro</option>
                            </select>
                        
                    </div>
                    <div class="col-md-2" id="i-div-corretor">
                        <label for="tipo" class="control-label">Corretor que Pegou</label>
                            <input type="hidden" id="i-corretor">
                            <select class="form-control" id="i-select-corretor" >
                            </select>
                            <span><button class="btn btn-danger" onClick="preencherCorretor()">Exibir os Inativos</button></span>
                        
                    </div>                
                <div class="col-md-2">
                    <label class="label-control">Tempo para Devolução</label>
                        <select class="form-control" id="i-tempo">
                            <option value="4">4 Horas</option>
                            <option value="24">1 Dia</option>
                            <option value="48">2 Dias</option>
                            <option value="72">3 Dias</option>
                            <option value="96">4 Dias</option>
                            <option value="999">Indeterminado</option>
                        </select>
                    
                </div>
                <div class="col-md-2">
                    <label class="label-control">Previsão de Devolução</label>
                        <input type="text" class="form-control" id="i-previsao" readonly>
                    
                </div>
            </div>
        </div>

        <div class="portlet box light escondido" id="i-div-cliente">
            <div class="portlet-title ">
                <div class="caption">
                    <i class="fa fa-gift"></i>Dados do Cliente
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden"  id="IMB_CLT_ID">
                            <label class="control-label">Nome do Cliente</label>
                            <input type="text" class="form-control input-8" id="IMB_CLT_NOME">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="control-label">R.G.</label>
                            <input type="text" class="form-control input-8" id="IMB_CLT_RG">
                        </div>
                        <div class="col-md-6" id="div-dataultimoatd">
                            <label class="control-label">Último Atendimetno</label>
                            <input type="date" class="form-control input-8" id="i-ultimo-atendimento" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <label class="control-label">Telefone (I)</label>
                    <input type="text" class="form-control telefone input-8" id="i-telefone1" onchange="procurarTelefone( this)" >
                    <label class="control-label">Tipo</label>
                    <select class="form-control  input-8" id="i-telefone1-tipo">
                        <option value="Residencial">Residencial</option>
                        <option value="Comercial">Comercial</option>
                        <option value="Celular">Celular</option>
                        <option value="Whatsapp">Whatsapp</option>
                        <option value="Recado">Recado</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="control-label">Telefone (II)</label>
                    <input type="text" class="form-control telefone  input-8" id="i-telefone2">
                    <label class="control-label">Tipo</label>
                    <select class="form-control  input-8" id="i-telefone2-tipo">
                        <option value="Residencial">Residencial</option>
                        <option value="Comercial">Comercial</option>
                        <option value="Celular">Celular</option>
                        <option value="Whatsapp">Whatsapp</option>
                        <option value="Recado">Recado</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="control-label">Telefone (III)</label>
                    <input type="text" class="form-control telefone  input-8" id="i-telefone3">
                    <label class="control-label">Tipo</label>
                    <select class="form-control  input-8" id="i-telefone3-tipo">
                        <option value="Residencial">Residencial</option>
                        <option value="Comercial">Comercial</option>
                        <option value="Celular">Celular</option>
                        <option value="Whatsapp">Whatsapp</option>
                        <option value="Recado">Recado</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="control-label">Telefone (IV)</label>
                    <input type="text" class="form-control telefone  input-8" id="i-telefone4">
                    <label class="control-label">Tipo</label>
                    <select class="form-control  input-8" id="i-telefone4-tipo">
                        <option value="Residencial">Residencial</option>
                        <option value="Comercial">Comercial</option>
                        <option value="Celular">Celular</option>
                        <option value="Whatsapp">Whatsapp</option>
                        <option value="Recado">Recado</option>
                    </select>
                </div>
            </div>
            
            <div class="col-md-12">
                <label class="control-label">Email</label>
                <input class="form-control" type="email" id="IMB_CLT_EMAIL" placeholder="Mais de um email devem ser separados por ponto-e-vírgula">
            </div>

            <div class="row">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label class="label-control">Observação</label>
                <textarea class="form-control" rows="2" id="IMB_CCH_DESCRICAO" style="min-width: 100%"></textarea>
                
            </div>
        </div>


        <div class="portlet box yellow">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Imóveis pré-selecionados
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                </div>
            </div>

            <div class="portlet-body form">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table  id="tblimoveiselecionados" class="table table-striped table-bordered table-hover" >
                                <thead class="thead-dark">
                                <tr >
                                    <th width="40" style="text-align:center"> Código </th>
                                    <th width="150" style="text-align:center"> Referência</th>
                                    <th width="500" style="text-align:center"> Endereço </th>
                                    <th width="100" style="text-align:center"> Chave Número </th>
                                    <th width="100" style="text-align:center"> Chave Situação </th>
                                    <th width="100" style="text-align:center"> Ações </th>
                                    <th class="escondido"></th>
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


        <div class="row">
            <div class="col-md-12">
                <div class="footer">
                    <div class="form-actions div-center">
                        <button type="button" class="btn btn-danger botao-confirmacao " id="i-btn-cancelar" onClick="javascript:window.close();">Cancelar</button>
                        <button type="button" class="btn blue botao-confirmacao" id="i-btn-gravar-agenda" onClick="confirmar()">
                            <i class="fa fa-check"></i> Confirmar Saída de Chaves
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script type="text/javascript" src="{{asset('/js/jquery-ui-timepicker-addon.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/i18n/jquery-ui-timepicker-addon-i18n.min.js')}}"></script>

<script>


$(document).ready(function()
{
    mostrarSelecionados();
    preencherCorretorAtivos();
    calcularDevolucao();


    $( "#i-datasaida" ).val(moment().format( 'DD/MM/YYYY'));
    $( "#i-horasaida" ).val(moment().format( 'HH:mm'));

    

    $('#i-localizaratm').select2({
        placeholder: "Localize seu atendimento",
        minimumInputLength: 5,
        allowClear: true,
        width: '100%',
        language: {
  	inputTooShort: function() {
  		return 'Digite o que procura';
  	}
  }
    });    



    $("#sirius-menu").click();
    $('.telefone').mask('(00) 00000-0000');
    $('.telefone').blur(function(event)
    {
        if($(this).val().length == 15)
        { // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
            $('.telefone').mask('(00) 00000-0009');
        }
        else
        {
            $('.telefone').mask('(00) 0000-00009');
        }
    });

    $("#IMB_CCH_TIPOSOLICITANTE").change(function()
    {
        if( $("#IMB_CCH_TIPOSOLICITANTE").val() == 'F')
        {
            $("#i-div-corretor").show();
            $("#i-div-cliente").hide();
        };
        if( $("#IMB_CCH_TIPOSOLICITANTE").val() == 'C' || $("#IMB_CCH_TIPOSOLICITANTE").val() == 'T')
        {
            $("#i-div-corretor").hide();
            $("#i-div-cliente").show();
            pegarDadosCliente();
        };

    });


    $("#i-tempo").change(function()
    {

        calcularDevolucao();

    });


    $.datepicker.regional['br'] =
    {
        closeText: 'ok',
        prevText: 'Anterior',
        nextText: 'Próximo',
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho',
        'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun',
        'Jul','Ago','Set','Out','Nov','Dez'],
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
        dayNamesShort: ['D','S','T','Q','Q','S', 'S'],
        dayNamesMin:  ['D','S','T','Q','Q','S', 'S'],
        weekHeader: 'wh',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: '',
        timeFormat: 'hh:mm',
        showTimepicker: false
  	};

	$.datepicker.setDefaults($.datepicker.regional['br']);

      	$('.dpicker').datetimepicker({
            timeFormat: 'hh:mm',
          timeOnlyTitle: 'timeonly',
          timeText: 'Horário',
          hourText: 'Hora',
          minuteText: 'Minuto',
          secondText: 'Segundo',
          currentText: 'Agora',
            closeText: 'Sair',
            format: 'DD-MM-YYYY',
            showTimepicker: false

        });

      	$('.timerpicker').timepicker({
            timeFormat: 'hh:mm',
          timeOnlyTitle: 'timeonly',
          timeText: 'Horário',
          hourText: 'Hora',
          minuteText: 'Minuto',
          secondText: 'Segundo',
          currentText: 'Agora',
            closeText: 'Sair',
            showDatePicker: false,
            showTimepicker: true

        });

        $('#i-horasaida').timepicker(
        {
          timeFormat: 'HH:mm',
          timeOnlyTitle: 'Selecione',
          timeText: 'Horário',
          hourText: 'Hora',
          minuteText: 'Minuto',
          currentText: 'Agora',
          closeText: 'Sair',
          showDatePicker: false,
          showTimepicker: true,
          use24hours: true
        });



});

function mostrarSelecionados()
    {

        cliente =
        {
            IMB_ATD_ID : $("#i-idusuario").val()
        };


        url = "{{ route( 'cargaselecionados' ) }}";

        console.log('CARGA SELECIONADO: '+url );

        $.getJSON( url, function(data)
            {
                ;
                linha = "";
                $("#tblimoveiselecionados>tbody").empty();
                for( nI=0;nI < data.length;nI++)
                {
                    if( data[nI].SITUACAOCHAVE=='Indisponível')
                        linha = '<tr class="riscado">'
                    else
                        linha = '<tr>'


                    chavebox = data[nI].IMB_IMV_CHABOX;
                    if( chavebox === null ) chavebox = '-';
                    linha = linha +
                        '   <td class="div-center">'+data[nI].IMB_IMV_ID+'</td>'+
                        '   <td class="div-center">'+data[nI].IMB_IMV_REFERE+'</td>'+
                        '   <td class="div-center">'+data[nI].ENDERECO+'</td>'+
                        '   <td class="div-center">'+chavebox+'</td>'+
                        '   <td class="div-center">'+data[nI].SITUACAOCHAVE+'</td>'+

                        '   <td style="text-align:center"> '+
//                    '<a  class="btn btn-sm btn-primary" href=javascript:editarCorImo('+data[nI].IMB_CORIMO_ID+')>Editar</a>&nbsp;&nbsp;&nbsp;&nbsp;'+
//                    '           <button class="btn btn-sm btn-primary" onclick="editarCorImo('+data[nI].IMB_CORIMO_ID+' )">Editar</button>'+
//                    '           <button class="btn btn-sm btn-danger" onclick="apagarCorImo('+data[nI].IMB_CORIMO_ID+' )">Apagar</button>'+
                        '<a  class="btn btn-sm btn-danger" onclick="apagarImovelSelecao('+data[nI].IMB_IMS_ID+')"><i class="fa fa-trash" aria-hidden="true"></i></a>'+

                        '   </td>'+
                        '   <td class="escondido">'+data[nI].IMB_IMS_ID+'</td>'+

                        '</tr>';

                    $("#tblimoveiselecionados").append( linha );

                }
                $("#modalimoveisselecionados").modal('show');
            })
    }

    function preencherCorretor()
    {
        var empresa = "{{Auth::user()->IMB_IMB_ID}}";
        var url = "{{ route('atendente.carga')}}/0";

        $.ajax(
        {
            url     : url,
            dataType:'json',
            type:'get',
            async:false,
            success: function( data )
            {
                $("#i-select-corretor").empty();
                linha = '<option value="0">Selecione</option>';
                $("#i-select-corretor").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                    '<option value="'+data[nI].IMB_ATD_ID+'">'+
                        data[nI].IMB_ATD_NOME+"</option>";
                    $("#i-select-corretor").append( linha );
                }
            }
        });
    }

    function preencherCorretorAtivos( )
    {
        var url = "{{ route('atendente.cargaativos')}}";

        $.getJSON( url, function( data )
        {
            linha = "";
            $("#i-select-corretor").empty();
            linha = '<option value="0">Selecione</option>';
            $("#i-select-corretor").append( linha );
            for( nI=0;nI < data.length;nI++)
            {
                linha =
                        '<option value="'+data[nI].IMB_ATD_ID+'">'+
                        data[nI].IMB_ATD_NOME+"</option>";
                    $("#i-select-corretor").append( linha );
            }
        });

    }

    function procurarTelefone( telefone )
    {
        if( $("#IMB_CLT_NOME").val() != '' )
            return false;
        var ntelefone = telefone.value;
        ntelefone = ntelefone.replace( '(','' );
        ntelefone = ntelefone.replace(')','');
        ntelefone = ntelefone.replace('-','');
        ntelefone = ntelefone.replace(' ','');

        var url = "{{route('cliente.localizar.telefone')}}/"+ntelefone;
        console.log( url );

        $.ajax(
        {
            url       : url,
            type      : 'get',
            dataType  : 'json',
            async     : false,
            success   : function( data )
            {
                $("#modalclientecadastrado").modal( 'show');
                $("#IMB_CLT_ID").val( data.IMB_CLT_ID );
                $("#IMB_CLT_NOME").val( data.IMB_CLT_NOME );
                $("#IMB_CLT_EMAIL").val( data.IMB_CLT_EMAIL );
                $("#IMB_CLT_RG").val( data.IMB_CLT_RG );
                $("#i-nomecliente").html( data.IMB_CLT_NOME+' - '+data.FONES);
                cargaTelefones( data.IMB_CLT_ID );
                verificarUltimoAtendimento( data.IMB_CLT_ID );
            },
            error: function()
            {
                console.log('error: nada encontrado');
                $("#IMB_CLT_ID").val( '' );
                $("#IMB_CLT_NOME").val( '' );
                $("#i-nomecliente").html( '');
            }
            }
        )


    }

function cargaTelefones( id )
  {

    url="{{route('telefone.carga')}}/"+id;

    $.ajax(
      {
        url       : url,
        type      : 'get',
        dataType  : 'json',
        success   : function( data )
        {
            for( nI=0;nI < data.length;nI++)
          {
            var ddd= data[nI].IMB_TLF_DDD;
            ddd=ddd.toString();

            var numero= data[nI].IMB_TLF_NUMERO;
            numero=numero.toString();

            var telefone = '('+ddd+') '+numero;

            console.log('ddd '+data[nI].IMB_TLF_DDD+' - tipo de telefone '+data[nI].IMB_TLF_NUMERO+' - tipo de telefone '+data[nI].IMB_TLF_TIPOTELEFONE);

            if( nI == 0 )
            {

              $("#i-telefone1").val(telefone);
              $("#i-telefone1-tipo").val( data[nI].IMB_TLF_TIPOTELEFONE);
            }
            if( nI == 1 )
            {
              $("#i-telefone2").val( telefone);
              $("#i-telefone2-tipo").val( data[nI].IMB_TLF_TIPOTELEFONE);
            }
            if( nI == 2 )
            {
              $("#i-telefone3").val( telefone);
              $("#i-telefone3-tipo").val( data[nI].IMB_TLF_TIPOTELEFONE);
            }
            if( nI == 3 )
            {
              $("#i-telefone4").val( telefone);
              $("#i-telefone4-tipo").val( data[nI].IMB_TLF_TIPOTELEFONE);
            }
          }

        }
      });
  }

  function apagarImovelSelecao( id )
    {

        cliente =
        {
            IMB_IMS_ID : id
        };

        console.log( cliente );
        $.ajax({
          url : "{{ route( 'apagarimvselec' ) }}",
          type : 'get',
          data : cliente
     })
     .done(function(){
        mostrarSelecionados();
     });
    }


    function calcularDevolucao()
    {
        var tempo = $("#i-tempo").val();
        var devolucao = moment().add( tempo, 'hours').format('DD/MM/YYYY HH:mm  ');
       $("#i-previsao").val( devolucao );
    }

    function confirmar()
    {

        
        if( $("#IMB_CCH_TIPOSOLICITANTE").val() == 'C' || $("#IMB_CCH_TIPOSOLICITANTE").val() == 'T')
        {

            if (    $("#i-telefone1").val() == '' &&
                $("#i-telefone2").val() == '' &&
                $("#i-telefone3").val() == '' &&
                $("#i-telefone4").val() == '' )
            {
                alert( 'É necessário pelo menos um telefone');
                return false;
            }
            else
            if( $("#i-telefone1").val().length < 8 )
            {
                    alert('Verifique o telefone I');
                return false;
            }
            else
            if( $("#i-telefone2").val() != '' && $("#i-telefone2").val().length < 8 )
            {
                    alert('Verifique o telefone II');
                return false;
            }
            else
            if( $("#i-telefone3").val() != '' && $("#i-telefone3").val().length < 8 )
            {
                    alert('Verifique o telefone III') ;
                return false;
            }
            else
            if( $("#i-telefone4").val() != '' && $("#i-telefone4").val().length < 8 )
            {
                    alert('Verifique o telefone IV');
                return false;
            }
            else
            if ( $("#IMB_CLT_NOME").val().length < 2 )
            {
                alert('Nome de cliente inválido!');
                return false;
            }
            else
            if ( $("#IMB_CLT_RG").val() =='' )
            {
                alert('Informe o RG!');
                return false;
            };
        }

        gerarToken();
        salvarCliente();
        salvarSaida();
        //window.close();

    }

    function salvarCliente()
    {


        gerarToken();

        cliente =
        {
            IMB_CLT_NOME: $("#IMB_CLT_NOME").val(),
            IMB_CLT_EMAIL: $("#IMB_CLT_EMAIL").val(),
            IMB_CLT_RG: $("#IMB_CLT_RG").val(),
            IMB_CLT_ID: $("#IMB_CLT_ID").val(),
        };


        $.ajax(
        {
            url : "{{ route( 'cliente.precadastro' ) }}",
            type : 'post',
            datatype: 'json',
            data: cliente,
            async:false,
            success:function( data )
            {
                $("#IMB_CLT_ID").val( data);
                console.log('Numero de Cliente Encontrado: '+data );
            },
            error:function()
            {
                alert('erro pra gravar o precadastro');
            }
        })

        if( $("#i-telefone1").val() != '' )
        {
            gerarToken();
                // Criar objeto para armazenar os dados (com JSON essa tarefa fica mais simples)
            var tel = $("#i-telefone1").val();
            var pos = tel.indexOf("-");
            var ddd = tel.substr(1,2);
            if( pos ==-1 )
                var telefone = tel.substr(5,10)
            else
                var telefone = tel.substr(5,pos-1-4)+tel.substr(pos+1,4);

            var url = "{{ route('telefone.salvar')}}/"+
                $("#IMB_CLT_ID").val()+'/'+
                  ddd+'/'+
                  telefone+'/'+
                $("#i-telefone1-tipo").val();
            $.post( url,  function(data)
            {
            });
        }

        if( $("#i-telefone2").val() != '' )
        {
            gerarToken();
                // Criar objeto para armazenar os dados (com JSON essa tarefa fica mais simples)
            var tel = $("#i-telefone2").val();
            var pos = tel.indexOf("-");
            var ddd = tel.substr(1,2);
            if( pos == -1 )
                var telefone = tel.substr(5,10)
            else
                var telefone = tel.substr(5,pos-1-4)+tel.substr(pos+1,4);

            var url = "{{ route('telefone.salvar')}}/"+
                  $("#IMB_CLT_ID").val()+'/'+
                  ddd+'/'+
                  telefone+'/'+
                  $("#i-telefone2-tipo").val();
            $.post( url,  function(data)
            {
            });
        }
        if( $("#i-telefone3").val() != '' )
        {
            gerarToken();
                // Criar objeto para armazenar os dados (com JSON essa tarefa fica mais simples)
            var tel = $("#i-telefone3").val();
            var pos = tel.indexOf("-");
            var ddd = tel.substr(1,2);
            if( pos == -1 )
                var telefone = tel.substr(5,10)
            else
                var telefone = tel.substr(5,pos-1-4)+tel.substr(pos+1,4);

            var url = "{{ route('telefone.salvar')}}/"+
                  $("#IMB_CLT_ID").val()+'/'+
                  ddd+'/'+
                  telefone+'/'+
                  $("#i-telefone3-tipo").val();

      //      alert('gravando o telefone');
            $.post( url,  function(data)
            {
            });
        }

        if( $("#i-telefone4").val() != '' )
        {
            gerarToken();

                // Criar objeto para armazenar os dados (com JSON essa tarefa fica mais simples)
            var tel = $("#i-telefone4").val();
            var pos = tel.indexOf("-");
            var ddd = tel.substr(1,2);
            if( pos == -1 )
            var telefone = tel.substr(5,10)
            else
                var telefone = tel.substr(5,pos-1-4)+tel.substr(pos+1,4);

            var url = "{{ route('telefone.salvar')}}/"+
                  $("#IMB_CLT_ID").val()+'/'+
                  ddd+'/'+
                  telefone+'/'+
                  $("#i-telefone4-tipo").val();

            $.post( url,  function(data)
            {
            });
        }


    }

	function gerarToken()
	{
	  $.ajaxSetup
		({
		  headers:
		  {
			  'X-CSRF-TOKEN': "{{csrf_token()}}"
		  }
		});
	}


    function salvarSaida()
    {


        if( $("#i-select-corretor").val() == 0 && $("#IMB_CCH_TIPOSOLICITANTE").val() =='F' )
        {
            alert('Informe o corretor');
            return false;

        }

        if( $("#IMB_CLT_ID").val() == 0 && $("#IMB_CCH_TIPOSOLICITANTE").val() =='C' )
        {
            alert('Informe o Cliente');
            return false;

        }

        if( $("#IMB_CLT_ID").val() == 0 && $("#IMB_CCH_TIPOSOLICITANTE").val() =='T' )
        {
            alert('Informe o Parceiro');
            return false;

        }


        var table = document.getElementById('tblimoveiselecionados');
        for (var r = 1, n = table.rows.length; r < n; r++)
        {
            if( table.rows[r].cells[4].innerHTML != 'Indisponível')
            {
                gerarToken();

                saida =
                {
                    IMB_IMV_ID          : table.rows[r].cells[0].innerHTML,
                    IMB_IMS_ID          : table.rows[r].cells[6].innerHTML,
                    IMB_CCH_STATUS      : 'Indisponível',
                    IMB_CLT_ID             : $("#IMB_CLT_ID").val(),
                    IMB_CCH_TIPOSOLICITANTE             : $("#IMB_CCH_TIPOSOLICITANTE").val(),
                    IMB_ATD_IDSOLICITANTE             : $("#i-select-corretor").val(),
                    IMB_ATD_IDDEVOLUCAO             : 0,
                    IMB_CCH_DTHDEVOLUCAOESPERADA             :$("#i-previsao").val(),
                    IMB_CCH_MOTIVO             : $("#i-modivo").val(),
                    IMB_CCH_DESCRICAO             : $("#IMB_CCH_DESCRICAO").val(),
                    IMB_CLA_ID             : $("#i-localizaratm").val(),
                };


                var url = "{{ route('saidachaves.registrar')}}";

                $.ajax(
                {
                    url:url,
                    type:'post',
                    datatype:'json',
                    async:false,
                    data: saida,
                    success:function( data)
                    {
                        alert( 'Saida de Chaves Realizada com Sucesso!');
                        window.close();
                    },
                    error: function()
                    {
                        alert('Erro na gravação da saida de chaves ');

                    }
                });

            }
        }

    }

    function verificarUltimoAtendimento( id )
    {

        var url = "{{ route('atendimento.idultimoatendimento') }}/"+id;

        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                async:false,
                success:function( data )
                {
                    if( data > 0 )
                    {
                        alert('Encontrei atendimento para este cliente. Irei pegar como base o atendimento mais recente!');

                        var url = "{{ route('atendimento.ultimoatendimento') }}/"+data;
                        $.ajax(
                            {
                                url:url,
                                dataType:'json',
                                type:'get',
                                async:false,
                                success:function( data )
                                {
                                    $("#div-dataultimoatd").show();
                                    $("#i-ultimo-atendimento").val( data.IMB_CLA_DATACADASTRO)

                                }
                            }
                        )



                    }


                }

            }
        )

    }

    function prosseguir()
    {
        cargaLocalizaAtendimentos();
        if( $("#optnovoatendimento").prop( 'checked' ) == true )
        {
            alert('Você será direcionado para tela de um novo atendimento.');
            window.open( "{{route('clienteatendimento.novo')}}",'_blank');
        }
            
        if(  $("#uptsequenciaatendimento").prop( 'checked' ) == true )
        {
            $("#div-localizaratm").show();
        }
    }

    function cargaLocalizaAtendimentos()
    {
        var url = "{{route('localizaratendimentos')}}";
        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                data:{ ativos : 'S' },
                success:function( data )
                {

                    $("#i-localizaratm").empty();

                    linha =  '<option value="0">Selecione o atendimento</option>';
                    $("#i-localizaratm").append( linha );
                    for( nI=0;nI < data.length;nI++)
                    {
                        linha =
                            '<option value="'+data[nI].IMB_CLA_ID+'">'+
                            data[nI].linha+"</option>";
                    $("#i-localizaratm").append( linha );

                    }
                }
            });
    }

    function prosseguir2()
    {
        $("#div-informacoes").show();
    }

    function pegarDadosCliente()
    {
        var url = "{{ route('atendimento.pegardadosatendimento')}}/"+$('#i-localizaratm').val();

        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                async:false,
                success:function(data)
                {
                    console.log( data );
                    $("#IMB_CLT_NOME").val( data.IMB_CLT_NOME );
                    $("#IMB_CLT_RG").val( data.IMB_CLT_RG );
                    $("#IMB_CLT_EMAIL").val( data.IMB_CLT_EMAIL );
                    $("#IMB_CLT_ID").val( data.IMB_CLT_ID );
                    $("#i-ultimo-atendimento").val( moment(data.IMB_CLA_DATAATENDIMENTO).format( 'YYYY-MM-DD') );
                    cargaTelefones( data.IMB_CLT_ID);
                }
            }
        )


    }




</script>

@endpush
