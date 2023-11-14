@section('scripttop')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
    .lbl-medidas-outrositens {
            text-align: left;
            font-size: 12px;
                color: #4682B4; 
    }
    .lbl-mensagem {
            text-align: left;
            font-size: 12px;
                color: black; 
    }
    .border-2
    {
        border-radius':'0px';
    }

</style>

@endsection

<div class="modal" tabindex="-1" role="dialog" id="modalperfil">
    <div class="modal-dialog "style="width:90%;" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Informe o Perfil do Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>        
            <div class="modal-body">
                <div id="i-div-perfil">
                  <div class="portlet box yellow" >
                    <div class="portlet-title">
                      <div class="caption">
                        <i class="fa fa-gift"></i>Perfil 
                      </div>
                    </div>

                    <input type="hidden" id="i-venda-minima">
                    <input type="hidden" id="i-venda-maxima">
                    <input type="hidden" id="i-locacao-minima">
                    <input type="hidden" id="i-locacao-maxima">
                    <input type="hidden" id="IMB_CLT_ID_PERFIL">
                    

                    <div class="portlet-body form div-background-perfil">
                      <div class="form-body div-background-perfil">
                        <div class="row">
                          <div class="col-md-12 div-center">
                            <label class="lbl-mensagem">Para que o radar seja esteja ativo, é necessário preencher os campos abaixo.</label>
                          </div>
<!--
                          <div class="col-md-12">
                            <button class="btn btn-primary" onClick="modalRegiao()">Adicionar Região</button>
                            <textarea class="form-control" id="i-regiao" cols="30" rows="3" placeholder="Informe a região" readyoly></textarea>
                          </div>
                        -->
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label class="control-label">Venda
                                <input class="form-control"  type="checkbox" id="i-venda">
                                </label>
                                <label class="control-label div-center">Locação
                                  <input class="form-control" type="checkbox" id="i-locacao">
                                </label>

                                <div class="col-md-2 div-center">
                                  <label class="control-label">Região</label>
                                  <select class="form-control  font-bold" id="i-select-regiao-perfil">
                                  </select>
                                </div>
                                <div class="col-md-2 div-center">
                                  <label class="control-label">Finalidade</label>
                                  <select class="form-control  font-bold" id="i-select-finalidade-perfil">
                                      <option value="">Selecione....</option>
                                      <option value="Comercial">Comercial</option>
                                      <option value="Corporativa">Corporativa</option>
                                      <option value="Industrial">Industrial</option>
                                      <option value="Residencial">Residencial</option>
                                      <option value="Rural">Rural</option>
                                      <option value="Temporada">Temporada</option>
                                  </select>
                                </div>
                                <div class="col-md-2 div-center">
                                  <label class="control-label">Tipo do Imóvel</label>
                                  <select  class="form-control  font-bold" id="i-select-tipoimovel-perfil">
                                  </select>
                                </div>
                                <div class="col-md-1 div-center escondido" id="div-dormitorio">
                                  <label class="control-label div-center">Dorm.
                                    <input class="form-control" type="text" id="i-Dormitorio" onkeypress="return isNumber(event)" onpaste="return false;"/>
                                    <span class="font-8px-blue-italic">Ou Mais</span>
                                  </label>
                                </div>
                                <div class="col-md-1 div-center escondido" id="div-suite">
                                  <label class="control-label div-center">Suíte
                                    <input class="form-control" type="text" id="i-suite" onkeypress="return isNumber(event)" onpaste="return false;"/>
                                    <span class="font-8px-blue-italic">Ou Mais</span>
                                  </label>
                                </div>
                                <div class="col-md-1 div-center " id="div-garagem">
                                  <label class="control-label div-center">Garagem
                                    <input class="form-control" type="text" id="i-garagem" onkeypress="return isNumber(event)" onpaste="return false;"/>
                                    <span class="font-8px-blue-italic">Ou Mais</span>
                                  </label>
                                </div>
                                <div class="col-md-2 div-center ">
                                  <label class="control-label div-center">Margem +/-
                                    <select  class="form-control" id="i-margem">
                                      <option value="10">10%</option>
                                      <option value="20">20%</option>
                                      <option value="30">30%</option>
                                      <option value="40">40%</option>
                                      <option value="50">50%</option>
                                    </select>
                                  </label>
                                </div>
                              </div>  
                            </div>                            
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <div class="col-md-2 div-center escondido" id="div-valorvenda">
                                  <label class="control-label div-center">Valor Venda
                                    <input class="form-control valor valores-direita" type="text" id="i-valorvenda"/>
                                    <span class="font-10px-blue" id="i-margemvenda"></span>
                                    </label>
                                </div>
                                <div class="col-md-2 div-center escondido" id="div-valorlocacao">
                                  <label class="control-label div-center">Valor Locação
                                    <input class="form-control valor valores-direita" type="text" id="i-valorlocacao"/>
                                    <span class="font-10px-blue"  id="i-margemlocacao"></span>
                                    </label>
                                </div>                        
                                <div class="col-md-2 div-center">
                                  <label class="control-label">Condomínio/Empreend.</label>
                                  @php
                                    $cnds = app('App\Http\Controllers\ctrCondominio')->cargaSemJson( Auth::user()->IMB_IMB_ID );
                                  @endphp

                                  <select  class="form-control  font-bold" id="i-select-condominio">
                                      <option value=""></option>
                                      @foreach( $cnds as $cnd )
                                      <option value="{{$cnd->IMB_CND_ID}}">{{$cnd->IMB_CND_NOME}}</option>
                                      @endforeach
                                  </select>
                                </div>
                                <div class="col-md-2 div-center">
                                  <label class="control-label">Cond.Fechado?
                                  <select class="form-control" id="i-condominio-fechado">
                                    <option value=" ">Indiferente</option>
                                    <option value="S">Sim</option>
                                    <option value="N">Não</option>
                                  </select>
                                  </label>
                                </div>
                                
                                <div class="col-md-2 div-center escondido" id="div-areaconstruida">
                                  <label class="control-label div-center">Área Constr.
                                    <input class="form-control valor valores-direita" type="text" id="i-area-construida"/>
                                    </label>
                                </div>                        
                                <div class="col-md-2 div-center escondido" id="div-areatotal">
                                  <label class="control-label div-center">Área Total
                                    <input class="form-control valor valores-direita" type="text" id="i-area-total"/>
                                    </label>
                                </div>                        
                                <div class="col-md-2 div-center escondido" id="div-areautil">
                                  <label class="control-label div-center">Área Útil
                                    <input class="form-control valor valores-direita" type="text" id="i-area-util"/>
                                    </label>
                                </div>                        
                              </div>
                            </div>                          
                            <hr>
                            <div class="row">
                              <div class="col-md-10  div-center">
                              <a  class="btn btn-sm btn-primary" 
                                  role="button" onClick="gravarPerfil()" >
                                  Salvar Perfil 
                                </a>
                                <a  class="btn btn-sm btn-danger" 
                                  role="button" onClick="cancelarPerfil()" >
                                  Cancelar Perfil
                                </a>
                                  <!--data-toggle="modal" data-target="#modalFormaPagamento"-->
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
    </div>
</div>


<div class="modal" tabindex="-1" role="dialog" id="modalregiao">
    <div class="modal-dialog "style="width:60%;" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Informe a Região</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>        
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label">Cidade
                                <select class="form-control" id="i-select-cidade-perfil">
                                </select>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Bairro
                                <select class="form-control" id="i-select-bairro-perfil">
                                </select>
                            </label>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label" >&nbsp;</label>
                            <button class="btn btn-primary" onClick="confirmarRegiao()">Confirmar</button>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">&nbsp;</label>
                            <button class="btn btn-danger" onClick="fecharModalRegiao()">Cancelar</button>
                        </div>

                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>




@push('script')

<script>
    $(document).ready(function() 
    {
      cargaregiao();
        $( "#i-select-cidade-perfil" ).change(function() 
        {
            preencherBairros( $('#i-select-cidade-perfil').val());
        });    
    });

    $("#i-valorvenda").on( "change", function()
    {
      calcularMargem();
    });
    $("#i-valorlocacao").on( "change", function()
    {
      calcularMargem();
    });

    $("#i-margem").on( "change", function()
    {
      calcularMargem();
    });

    $("#i-venda").on("change", function()
    {
      if ( $("#i-venda").prop( "checked" ) )
        $("#div-valorvenda").show()
      else
        $("#div-valorvenda").hide();
    });
    $("#i-locacao").on("change", function()
    {
      if ( $("#i-locacao").prop( "checked" ) )
        $("#div-valorlocacao").show()
      else
        $("#div-valorlocacao").hide();
    });

    $("#i-select-finalidade-perfil").on("change", function()
    {
      if ( $("#i-select-finalidade-perfil").val() == 'Residencial'
          || $("#i-select-finalidade-perfil").val() == 'Temporada'
          || $("#i-select-finalidade-perfil").val() == 'Rural' )
      {
          $("#div-dormitorio").show();
          $("#div-suite").show();
      }
      else
      {
        $("#div-dormitorio").hide();
        $("#div-suite").hide();

      }
    });

    $("#i-select-tipoimovel-perfil").on("change", function()
    {
      var areautil = [ '1','4','8','10','17','18','25','14','26','27','28','29','30','33'];
      var areatotal = [ '2','5','6','7','9','11','13','14','15','16','19','22','23','24','31','32'];
      var areaconstruida = [ '3','5','6','7','9','14','15','16','19','23','24','31','32' ];

      var selecao=$("#i-select-tipoimovel-perfil").val();
      var opcao = areautil.indexOf(selecao )

      $("#div-areautil").hide();
      $("#div-areatotal").hide();
      $("#div-areaconstruida").hide();

      if ( areautil.indexOf(selecao ) > -1 )
        $("#div-areautil").show();

        if ( areatotal.indexOf(selecao ) > -1 )
        $("#div-areatotal").show();

        if ( areaconstruida.indexOf(selecao ) > -1 )
        $("#div-areaconstruida").show();



    });


    function modalRegiao()
    {
        preencherCidades();
        $("#modalregiao").modal('show');

    }
    function preencherCidades()
        {

            $.getJSON( "{{ route('cidades.carga')}}", function( data )
            {
                
                $("#i-select-cidade-perfil").empty();
                
                linha =  '<option value="">Selecione a Cidade</option>';
                $("#i-select-cidade-perfil").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha = 
                    '<option value="'+data[nI].IMB_IMV_CIDADE+'">'+
                        data[nI].IMB_IMV_CIDADE+"</option>";
                        $("#i-select-cidade-perfil").append( linha );
                        
                }

            });
            
        }
    function preencherBairros( cidade )
        {
            var url = "{{ route('bairros.carga')}}/"+cidade;

            $.ajax(
              {
                url: url,
                dataType:'json',
                type:'get',
                success:function( data )
                {
                  $("#i-select-bairro-perfil").empty();
                
                  linha =  '<option value="">Selecione o Bairro</option>';
                  $("#i-select-bairro-perfil").append( linha );
                  for( nI=0;nI < data.length;nI++)
                  {
                    linha = 
                    '<option value="'+data[nI].CEP_BAI_ID+'">'+
                        data[nI].CEP_BAI_NOME+'('+data[nI].CEP_CID_NOME+')'+"</option>";
                        $("#i-select-bairro-perfil").append( linha );
                  }
                },
                error:function()
                {

                }
              });
        }

        function fecharModalRegiao()
    {
        $("#modalregiao").modal('hide');
        var target_offset = $("#i-div-perfil").offset();
        var target_top = target_offset.top;
        $('html, body').animate({ scrollTop: target_top }, 0);                            

    }

    function confirmarRegiao()
    {
        $("#modalregiao").modal('hide');
        $("#i-regiao").val( $("#i-regiao").val()+$('#i-select-bairro-perfil').find(':selected').text()+', ');
        var target_offset = $("#i-div-perfil").offset();
        var target_top = target_offset.top;
        $('html, body').animate({ scrollTop: target_top }, 0);                            
    }
    function cancelarPerfil()
  {
    $("#modalperfil").modal('hide');
  }

  function calcularMargem()
  {
    var margem = parseFloat($("#i-margem").val());

    var valorlocacao = parseFloat(realToDolar( $("#i-valorlocacao").val() ));
    var valorvenda = parseFloat(realToDolar( $("#i-valorvenda").val() ));

    $("#i-margemvenda").html( '' );
    $("#i-margemlocacao").html( '' );

    if( valorvenda != 0 && (! isNaN(valorvenda)) )
    {
      console.log('valorvenda '+valorvenda);
      var margemini = valorvenda - ( valorvenda * margem / 100 );
      var margemfim = valorvenda + ( valorvenda * margem / 100 );
      $("#i-margemvenda").html( 'De: '+formatarBRSemSimbolo( margemini )+
                              ' a: '+formatarBRSemSimbolo( margemfim ));
      $("#i-venda-minima").val(margemini);
      $("#i-venda-maxima").val(margemfim);

    }
    if( valorlocacao != 0 && (! isNaN(valorlocacao)) )
    {
      console.log('valorlocacao '+valorlocacao);
      var margemini = valorlocacao - ( valorlocacao * margem / 100 );
      var margemfim = valorlocacao + ( valorlocacao * margem / 100 );
      $("#i-margemlocacao").html( 'De: '+formatarBRSemSimbolo( margemini )+
                              ' a: '+formatarBRSemSimbolo( margemfim ));


      $("#i-locacao-minima").val(margemini);
      $("#i-locacao-maxima").val(margemfim);

    }

  }

  function gravarPerfil()
  {

    if ( ( ! $("#i-venda").prop( "checked" ) )  &&
         ( ! $("#i-locacao").prop( "checked" ) )  )
      alert('Informe se a procura é para comprar ou para alugar')
    else
    if ( $("#i-venda").prop( "checked" ) && $("#i-valorvenda").val()=='')
      alert( 'Informe o valor de venda que procura')
    else
    if ( $("#i-locacao").prop( "checked" ) && $("#i-valorlocacao").val()=='')
      alert( 'Informe o valor de locacao que procura')
    else
    if ( $("#i-regiao").val()=='' )
      alert( 'Informe a Região')
    else
    if ( $("#i-select-finalidade-perfil").val()=='' )
      alert( 'Informe a Finalidade')
    else
    if ( $("#i-select-tipoimovel-perfil").val()=='' )
      alert( 'Informe o tipo de imóvel')
    else
    {
      dados =
      {

        IMB_CLT_ID: $('#IMB_CLT_ID_PERFIL').val(),
        IMB_CLP_VALVENINI : realToDolar( $("#i-venda-minima").val()),
        IMB_CLP_VALVENFIM : realToDolar( $("#i-venda-maxima").val()),
        IMB_CLP_VALLOCINI: realToDolar( $("#i-locacao-minima").val()),
        IMB_CLP_VALLOCFIM: realToDolar( $("#i-locacao-maxima").val()),
        IMB_TIM_ID  : $("#i-select-tipoimovel-perfil").val(),
        IMB_IMV_FINALIDADE  : $("#i-select-finalidade-perfil").val(),
        IMB_RGC_ID : $("#i-select-regiao-perfil").val(),
        IMB_IMV_DORQUA  : $("#i-Dormitorio").val(),
        IMB_IMV_GARAGEM  : $("#i-garagem").val(),
        IMB_IMV_SUIQUA  : $("#i-suite").val(),
        IMB_IMV_AREUTI  : $("#i-area-util").val(),
        IMB_CLP_AREACONSTRUIDA  : $("#i-area-construida").val(),
        IMB_CLP_AREATOTAL  : $("#i-area-total").val(),
        IMB_IMV_EMCONDOMINIO :$("#i-condominio-fechado").val(),
      }

      $.ajaxSetup(
        {
          headers:
          {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
          }
        });

      var url = "{{route('cliente.perfil.gravar')}}";

      $.ajax(
        {
          url     : url,
          dataType: 'json',
          type    : 'post',
          data    : dados,
          success : function( data )
          {
            $("#modalperfil").modal('hide');
            debugger;
            cargaPerfil( $("#IMB_CLT_ID_PERFIL").val() );
          },
          error:function()
          {
            alert('Erro para gravar o perfil');
          }
        }
      );
    }

  }

  function cargaPerfil( id )
        {
            var url = "{{ route('cliente.perfil') }}/"+id;

            $.ajax(
            {
            url:url,
            datatype:'json',
            async:false,
            success: function( data )
            {
                linha = "";
                $("#tableperfil>tbody").empty();
                console.log('leng: '+data.length);

                for( nI=0;nI < data.length;nI++)
                {
                    $("#btn-perfil").addClass('comperfil');

                    var datacad = moment(data[nI].IMB_CLP_DATACADASTRO).format('DD/MM/YYYY');
                    
                    var valorinivenda =  parseFloat(data[nI].IMB_CLP_VALVENINI);
                    valorinivenda =formatarBRSemSimbolo(  valorinivenda );
                    var valorfimvenda =  parseFloat(data[nI].IMB_CLP_VALVENFIM);
                    valorfimvenda =formatarBRSemSimbolo(  valorfimvenda );
                    venda = 'R$ '+valorinivenda+ ' a R$ '+valorfimvenda;

                    var valoriniloc =  parseFloat(data[nI].IMB_CLP_VALLOCINI);
                    valoriniloc =formatarBRSemSimbolo(  valoriniloc );
                    var valorfimloc =  parseFloat(data[nI].IMB_CLP_VALLOCFIM);
                    valorfimloc =formatarBRSemSimbolo(  valorfimloc );
                    locacao = 'R$ '+valoriniloc+ ' a R$ '+valorfimloc;


                    var valorlocacao =  parseFloat(data[nI].IMB_CLP_VALLOCFIM);
                    valorlocacao =formatarBRSemSimbolo(  valorlocacao );

                  linha =
                    '<tr>' +
                    '<td style="text-align:center" valign="center"> '+
                      '<a title="Excluir este registro de perfil" href=javascript:excluirPerfilCliente('+data[nI].IMB_CLP_ID+','+data[nI].IMB_CLT_ID+') class="glyphicon glyphicon glyphicon-trash"></a> '+
                    '</td> '+
                    '<td class="div-center">'+data[nI].IMB_RGC_NOME+'</td>' +
                    '<td style="text-align:center valign="center">'+data[nI].IMB_TIM_DESCRICAO+'</td>' +
                    '<td class="div-center">'+venda+'</td>' +
                    '<td class="div-center">'+locacao+'</td>' +
                    '<td class="div-center">'+data[nI].IMB_IMV_FINALIDADE+'</td>' +
                    '<td class="div-center">'+data[nI].IMB_IMV_DORQUA+'</td>' +
                    '<td class="div-center">'+data[nI].IMB_IMV_SUIQUA+'</td>' +
                    '<td class="div-center">'+data[nI].IMB_IMV_GARAGEM+'</td>' +
                    '</tr>';
                $("#tableperfil").append( linha );
                }
            }
            });
        }

        function cargaregiao( )
        {
          
          var url = "{{route('regiaocidade.carga')}}";

          $.ajax(
            {
              url:url, 
              dataType:'json',
              type:'get',
              success:function(data)
              {
                $("#i-select-regiao-perfil").empty();
                
                linha =  '<option value="">Selecione a Região</option>';
                $("#i-select-regiao-perfil").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha = 
                    '<option value="'+data[nI].IMB_RGC_ID+'">'+
                        data[nI].IMB_RGC_NOME+"</option>";
                        $("#i-select-regiao-perfil").append( linha );
                        
                }

                
              }
            }
          )



        }
      
        function adicionarPerfil()
        {

          $("#modalperfil").modal('show');
          //$("#i-div-perfil").show();

        }

</script>        

@endpush