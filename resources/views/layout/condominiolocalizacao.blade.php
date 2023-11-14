<div class="col-md-12">
    <div class="col-md-10 back-div-zelado border-05">
        <div class="portlet box blue " id ="div-gerais">
            <div class="portlet-title" >
                <div class="caption">
                    <i class="fa fa-gift"></i>Dados Gerais
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                </div>
            </div>
            <div class="portlet-body form">
        
                <div class="col-md-12 back-div-zelado">
                    <input type="hidden"  id="IMB_CND_ID">
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Nome do Condominio</label>
                                <input maxlength="40" type="text"  class="form-control" 
                                    id="IMB_CND_NOME" value="" >
                            </div>
                        </div>  
                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="control-label">Cond. R$</label>
                                <input type="text"  class="form-control valor" 
                                            id="IMB_CND_VALCON" value="" >
                            </div>
                        </div>  
                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="control-label">IPTU R$</label>
                                    <input type="text"  class="form-control valor" 
                                        id="IMB_CND_VALORIPTU" value="" ><!-- novo -->
                            </div>
                        </div>  
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Finalidade(destinação)</label>
                                <select  class="form-control" id="IMB_CND_FINALIDADE"> <!-- novo -->
                                    <option value="Residencial">Residencial</option>
                                    <option value="Comercial">Comercial</option>    
                                    <option value="Temporada">Temporada</option>
                                </select>
                            </div>
                        </div>  
                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="control-label">Face Sol</label>
                                <select  class="form-control" id="IMB_CND_FACESOL"> <!-- novo -->
                                    <option value="Manhã">Manhã</option>
                                    <option value="Tarde">Tarde</option>    
                                    <option value="Lateral">Lateral</option>
                                </select>
                            </div>
                        </div>  
                                                            
                    </div>
                    
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <label class="control-label">Endereço</label>
                            <input type="text"  class="form-control  " 
                                        id="IMB_CND_ENDERECO" value="" maxlength="40">
                        </div>
                        <div class="col-md-1">
                            <label class="control-label">Número</label>
                            <input type="text"  class="form-control    " 
                                        id="IMB_CND_ENDERECONUMERO" value="" >
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Complemento</label>
                            <input type="text"  class="form-control  " 
                                        id="IMB_CND_ENDERECOCOMPLEMENTO" value="" >
                        </div>
                        <div class="col-md-1">
                            <label class="control-label">Cep</label>
                            <input type="text"  class="form-control  " 
                                        id="IMB_CND_CEP" value="" 
                                        onkeypress="return isNumber(event)" onpaste="return false;">
                        </div>                                    
                        <div class="col-md-2">
                            <label class="control-label">Bairro</label>
                            <input type="text"  class="form-control  " 
                                    id="CEP_BAI_NOME" value="" maxlength="30">
                        </div>                                    
                        <div class="col-md-2">
                            <label class="control-label">Cidade</label>
                            <input type="text"  class="form-control  " 
                                    id="CEP_CID_NOME" value="" maxlength="40">
                        </div>
                        <div class="col-md-1">
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
                        <div class="col-md-6">
                            <label >Site</label>
                            <input type="text" id="IMB_CND_URLSITE" class="form-control">
                        </div>
    
                        <div class="col-md-3">
                            <label >Email da Administração do Condomínio</label>
                            <input type="email" id="IMB_CND_EMAILADMINISTRACAO" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label >Email da Portaria</label>
                            <input type="email" id="IMB_CND_EMAILPORTARIA" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label">Informações sobre horário visitas</label>
                            <textarea  class="form-control" id="IMB_CND_HORARIOVISITA" cols="100%" rows="2"></textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Informações sobre horário para serviços</label>
                            <textarea  class="form-control" id="IMB_CND_HORARIOSERVICOS" cols="100%" rows="2"></textarea>
                        </div>            
                        <div class="col-md-4">
                            <label class="control-label">Observações Gerais</label>
                            <textarea class="form-control" id="IMB_CND_OBSERVACAO" rows="2"></textarea>
                        </div>            
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
    <div class="col-md-2">
        <div class="portlet box blue " id ="div-imagens">
            <div class="portlet-title" >
                <div class="caption">
                    <i class="fa fa-gift"></i>Imagens
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="col-md-12 div-center">
                    <p></p>
                    <p></p>
                    <a href="javascript:upLoadImagemDrop()"> <img class="img-album" src="https://www.siriussystem.com.br/sys/assets/global/img/imagenscondominio.png" alt="Imagens Condominio"></a>

                    <p></p>
                    <p></p>
                    <div class="div-center">
                        <button type="button" class="btn btn-primary form-control" onClick="mostrarImagensCondominio()">Acessar Imagens</button>
                    </div>                        
                    <p>&nbsp;</p>

                </div>
            </div>
        </div>
    </div>
</div>

<form style="display: none" action="{{route('imoveis.imagens.dragdrop')}}" method="get" id="form-imgcond"  target="_blank">
    <input type="hidden" id="i-idimovel-imgconddrag" name="id"/>
    <input type="hidden" name="tipo" value="C">
</form>

@push('script')


<script>

    function upLoadImagemDrop()
    {
        alert('');
        $("#i-idimovel-imgconddrag").val( $("#IMB_CND_ID").val());
        $("#galeria-update-btn").show();
        $("#form-imgcond").submit();

    }

    function mostrarImagensCondominio()
    {
        

        $("#modalCondominios").modal('hide');
        $("#modalCondominiosimagens").modal('show');
        CarregarImagensCondominio( $("#IMB_CND_ID").val());        
    
    }



</script>

@endpush
