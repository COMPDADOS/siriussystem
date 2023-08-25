<div id="printThis">
    <div class="modal" tabindex="-1" role="dialog" id="modalimovel">
        <div class="modal-dialog modal-lg"  role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="i-modalendimovel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        
                <input type="hidden" id="i-imovel">
                <H5 id="i-exclusividade"></H5>

                <div class="modal-body">
                    <div class="panel panel-default panel-fade">
                        <div class="panel-heading">
                            <div class="col-md-12 .cardtitulo">
                                Você só poderá incluir imagens após salvar e entrar para alterar o imovel
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="i-geral">
                                    <TABLE class="table" id="tbldadosimovel">
                                        <THEAD>
                                            <TR>
                                                <TH width="100">Informações Básicas</TH>
                                                <TH style="text-align:left">Valores</TH>
                                            </TR>
                                        </THEAD>
                                        <TBODY>
                                        </TBODY>
                                    </TABLE>
                                </div>

                                <div class="tab-pane fade in active" id="i-imagens">
                                    <table class="table" id="tblimagens">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th width="20%" >Imagem</th>
                                                <th width="60%"  >Titulo</th>
                                                <th width="20%" >Exibição</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="i-medidas">

                                    <div class="row">
                                        <h4 ><u><b><u>Área Interna<b></u>
                                        </h4>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="div-border-blue-center col-md-2">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Dormitórios
                                                            <span class="lbl-medidas-valores" id="i-dormitorio-medida"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="div-border-blue-center col-md-2">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas">Suítes
                                                            <span class="lbl-medidas-valores" id="i-suite-medida"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="div-border-blue-center col-md-1">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >WC
                                                            <span class="lbl-medidas-valores" id="i-wc-medida"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="div-border-blue-center col-md-1">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Salas</label>
                                                        <span class="lbl-medidas-valores" id="i-sala-medida"></span >
                                                    </div>
                                                </div>
                                                <div class="div-border-blue-center  col-md-1">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Edícula</label>
                                                        <span class="lbl-medidas-valores" id="i-edicula"></span>
                                                    </div>
                                                </div>                                        
                                                <div class="div-border-blue-center col-md-2">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Despensa</label>
                                                        <span class="lbl-medidas-valores" id="i-despensa"></span>
                                                    </div>
                                                </div>                                        
                                                <div class="div-border-blue-center col-md-2">
                                                    <div class="form-group">
                                                    <label class="lbl-medidas" >Garagem
                                                        <span  class="lbl-medidas-valores" id="i-garagem-medida"></span> 
                                                        </label>
                                                    </div>
                                                </div>  
                                                <div class="div-border-blue-center  col-md-1">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Cozinha
                                                            <span class="lbl-medidas-valores" id="i-cozinha-medida"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>      
                                        <div class="div-border-blue-center col-md-12">
                                            <span class="lbl-medidas-outrositens" id="i-outrosinternos"></span>
                                        </div>
                                    </div>  


                                    <div class="row">
                                        <h4 ><u><b>Medidas<b></u>
                                        </h4>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="div-border-blue-center  col-md-2">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Área Total</label>
                                                        <span class="lbl-medidas-valores" id="i-areatotal">Área Total</span>
                                                    </div>
                                                </div>
                                                <div class="div-border-blue-center col-md-2">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Área Const/Útil</label>
                                                        <span class="lbl-medidas-valores" id="i-areaconstruida">Área Const/Útil</span>
                                                    </div>
                                                </div>
                                                <div class="div-border-blue-center col-md-2">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Área Comum</label>
                                                        <span class="lbl-medidas-valores" id="i-areacomum"></span>
                                                    </div>
                                                </div>
                                                <div class="div-border-blue-center col-md-2">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Área Privativa</label>
                                                        <span class="lbl-medidas-valores" id="i-areaprivativa"></span>
                                                    </div>
                                                </div>
                                                <div class="div-border-blue-center col-md-2">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Área Externa</label>
                                                        <span class="lbl-medidas-valores" id="i-areaexterna"></span>
                                                    </div>
                                                </div>
                                                <div class="div-border-blue-center col-md-2">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Medida Terreno</label>
                                                        <span class="lbl-medidas-valores" id="i-dimensaoterreno"></span>
                                                    </div>
                                                </div>
                                            </div>      
                                        </div>
                                    </div>

                                    <div class="row">
                                        <h4><u><b>Lazer<b></u>
                                        </h4>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="div-border-blue-center col-md-1">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Piscina</label>
                                                        <span class="lbl-medidas-valores" id="i-piscina"></span>
                                                    </div>
                                                </div>
                                                <div class="div-border-blue-center col-md-1">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Sauna</label>
                                                        <span class="lbl-medidas-valores" id="i-sauna"></span>
                                                    </div>
                                                </div>
                                                <div class="div-border-blue-center  col-md-2">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Churrasqueira</label>
                                                        <span class="lbl-medidas-valores" id="i-churrasqueira"></span>
                                                    </div>
                                                </div>
                                                <div class="div-border-blue-center  col-md-1">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Quadra</label>
                                                        <span class="lbl-medidas-valores" id="i-quadra"></span>
                                                    </div>
                                                </div>
                                                <div class="div-border-blue-center  col-md-2">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Salão Festas</label>
                                                        <span class="lbl-medidas-valores" id="i-salao"></span>
                                                    </div>
                                                </div>
                                                <div class="div-border-blue-center  col-md-1">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Playgr.</label>
                                                        <span class="lbl-medidas-valores" id="i-playground"></span>
                                                    </div>
                                                </div>
                                                <div class="div-border-blue-center  col-md-1">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Quintal</label>
                                                        <span class="lbl-medidas-valores" id="i-quintal"></span>
                                                    </div>
                                                </div>
                                                <div class="div-border-blue-center  col-md-1">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Inst.TV</label>
                                                        <span class="lbl-medidas-valores" id="i-tvcabo"></span>
                                                    </div>
                                                </div>
                                                <div class="div-border-blue-center  col-md-2">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Campo Gramado</label>
                                                        <span class="lbl-medidas-valores" id="i-campogramado"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <h4><u><b>Área Externa<b></u>
                                        </h4>   
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="div-border-blue-center  col-md-1">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Murado</label>
                                                        <span class="lbl-medidas-valores" id="i-murado"></span>
                                                    </div>
                                                </div>
                                                <div class="div-border-blue-center  col-md-1">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Esquina</label>
                                                        <span class="lbl-medidas-valores" id="i-esquina"></span>
                                                    </div>
                                                </div>                                        
                                                <div class="div-border-blue-center  col-md-1">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Agua</label>
                                                        <span class="lbl-medidas-valores" id="i-agua"></span>
                                                    </div>
                                                </div>                                        
                                                <div class="div-border-blue-center  col-md-1">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Esgoto</label>
                                                        <span class="lbl-medidas-valores" id="i-esgoto"></span>
                                                    </div>
                                                </div>                                        
                                                <div class="div-border-blue-center  col-md-2">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Portão Eletr.</label>
                                                        <span class="lbl-medidas-valores" id="i-portao"></span>
                                                    </div>
                                                </div>                                        
                                                <div class="div-border-blue-center  col-md-1">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Sacada</label>
                                                        <span class="lbl-medidas-valores" id="i-sacada"></span>
                                                    </div>
                                                </div>                                        
                                                <div class="div-border-blue-center  col-md-1">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Asfalto</label>
                                                        <span class="lbl-medidas-valores" id="i-asfalto"></span>
                                                    </div>
                                                </div>                                        

                                                <div class="div-border-blue-center  col-md-2">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Sol da Manhã</label>
                                                        <span class="lbl-medidas-valores" id="i-solmanha"></span>
                                                    </div>
                                                </div>                                            
                                                <div class="div-border-blue-center  col-md-2">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Aquecedor</label>
                                                        <span class="lbl-medidas-valores" id="i-aquecedor"></span>
                                                    </div>
                                                </div>                                            
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                
                                    <div class="row">
                                        <h4 ><u><b>Segurança<b></u>
                                        </h4>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="div-border-blue-center col-md-1">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Alarme</label>
                                                        <span class="lbl-medidas-valores" id="i-alarme"></span>
                                                    </div>
                                                </div>
                                                <div class="div-border-blue-center col-md-2">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Cerca Elétrica</label>
                                                        <span class="lbl-medidas-valores" id="i-cercaeletrica"></span>
                                                    </div>
                                                </div>
                                                <div class="div-border-blue-center col-md-1">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Câmera</label>
                                                        <span class="lbl-medidas-valores" id="i-camera"></span>
                                                    </div>
                                                </div>
                                                <div class="div-border-blue-center col-md-2">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Interfone</label>
                                                        <span class="lbl-medidas-valores" id="i-interfone"></span>
                                                    </div>
                                                </div>
                                                <div class="div-border-blue-center col-md-2">
                                                    <div class="form-group">
                                                        <label class="lbl-medidas" >Portaria 24hs</label>
                                                        <span class="lbl-medidas-valores" id="i-p24"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="lbl-medidas" id="i-piso">Pìso: </label>
                                                    <label class="lbl-medidas-valores" id="i-piso"></label>
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
</div>
