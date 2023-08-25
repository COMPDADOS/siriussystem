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

                    <div class="portlet-body form div-background-perfil">
                      <div class="form-body div-background-perfil">
                        <div class="row">
                          <div class="col-md-12 div-center">
                            <label class="lbl-mensagem">Para que o radar seja esteja ativo, é necessário preencher os campos abaixo.</label>
                          </div>
                          <div class="col-md-12">
                            <button class="btn btn-primary" onClick="modalRegiao()">Adicionar Região</button>
                            <textarea class="form-control" id="i-regiao" cols="30" rows="3" placeholder="Informe a região" readyoly></textarea>
                          </div>
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
                                  <label class="control-label">Finalidade</label>
                                  <select class="form-control  font-bold" id="i-select-finalidade">
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
                                  <select  class="form-control  font-bold" id="i-select-tipo">
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
                                  <select  class="form-control  font-bold" id="i-select-condominio">
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
                                <select class="form-control" id="i-select-cidade">
                                </select>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Bairro
                                <select class="form-control" id="i-select-bairro">
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
    $(document).ready(function() {
        $( "#i-select-cidade" ).change(function() 
        {
            preencherBairros( $('#i-select-cidade').val());
        });    
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
                
                $("#i-select-cidade").empty();
                
                linha =  '<option value="">Selecione a Cidade</option>';
                $("#i-select-cidade").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha = 
                    '<option value="'+data[nI].IMB_IMV_CIDADE+'">'+
                        data[nI].IMB_IMV_CIDADE+"</option>";
                        $("#i-select-cidade").append( linha );
                        
                }

            });
            
        }
    function preencherBairros( cidade )
        {
            console.log( cidade );

            $.getJSON( "{{ route('bairros.carga')}}/"+cidade, function( data )
            {
                
                $("#i-select-bairro").empty();
                
                linha =  '<option value="">Selecione o Bairro</option>';
                $("#i-select-bairro").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha = 
                    '<option value="'+data[nI].CEP_BAI_NOME+'">'+
                        data[nI].CEP_BAI_NOME+'('+data[nI].IMB_IMV_CIDADE+')'+"</option>";
                        $("#i-select-bairro").append( linha );
                        
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
        $("#i-regiao").val( $("#i-select-cidade").val()+','+
                            $("#i-select-bairro").val() );
        var target_offset = $("#i-div-perfil").offset();
        var target_top = target_offset.top;
        $('html, body').animate({ scrollTop: target_top }, 0);                            
    }

    
    
</script>        

@endpush