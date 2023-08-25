@section( 'scripttop')

<style>

.linha-fundo-vermelho {
  background-color:#ff0000;
  color:#003366;

}

.linha-fundo-azul {
  background-color:#b3d9ff;
  color:#003366;
  font-weight: bold;
}
.linha-quitado {
  text-decoration: line-through;
}


.dados-cabecalho {
  text-align: center;
  font-size: 10px;
  font-weight: bold;
  color: #4682B4; 
  background-color: #CCFFE5;
}


.div-1 {
  background-color: lightblue;
}
.div-2 {
  background-color: #CCFFE5;
}

td{text-align:center;}
</style>


@endsection



<div class="row">
    <div class="col-md-12 div-1">
        <div class="col-md-2" class="radio" >
            <label><input type="radio" name="opcaoselecao" value="P" checked >Pasta</label>
        </div>
        <div class="col-md-2" class="radio" >
            <label><input type="radio" name="opcaoselecao" value="T"  >Locatário</label>
        </div>
        <div class="col-md-2" class="radio" >
            <label><input type="radio" name="opcaoselecao" value="E" >Endereço</label>
        </div>
        <div class="col-md-2" class="radio" >
            <label><input type="radio" name="opcaoselecao" value="D" >Locador</label>
        </div>
        <div class="col-md-2" class="radio" >
            <label><input type="radio" name="opcaoselecao" value="D" >Cód.Imóvel</label>
        </div>
    </div>
</div>

<div class="row"> 
    <div class="col-md-12 div-1">
        <div class="col-md-12">
            <div class="input-group">
                <input type="text" maxlength="40" class="form-control" id="i-nome"
                                      placeholder="Barra de localização: Digite aqui o que precisa localizar"
                                        style="font-family: Tahoma; font-size: 16px"
                                        required >
                <span class="input-group-btn">
                    <button class="btn default" type="button" onClick="pesquisar()">
                                <i class="fa fa-search"></i>
                    </button>
                </span>                    
            </div>
        </div>
    </div>
</div>

  <div class="row">
  </div>
  <div class="row i-div-informacoes"> 
    <div class="col-md-12 div-2">
      <div class="col-md-2">
        <label class="dados-cabecalho label-control" id="I-LBL-IMB_IMV_ID"></label>
        </label>
      </div>
      <div class="col-md-2">
        <label class="dados-cabecalho label-control" id="I-LBL-IMB_CTR_REFERENCIA"></label>
      </div>
      <div class="col-md-6">
        <label class="dados-cabecalho label-control"  id="I-LBL-ENDERECOCOMPLETO"> </label>
      </div>
      <div class="col-md-2">
        <label class="dados-cabecalho  label-control" id="I-LBL-DIAVENCIMENTO"></label>
      </div>

    </div>
  </div>
  <div class="row i-div-informacoes"> 
    <div class="col-md-12 div-2">
      <div class="col-md-8">
        <label class="dados-cabecalho  label-control" id="I-LBL-PROPRIETARIO"></label>
      </div>
      <div class="col-md-4">
        <label class="dados-cabecalho  label-control" id="I-LBL-REPASSE"></label>
      </div>
    </div>
    <div class="col-md-12 div-2">
      <div class="col-md-8">
        <label class="dados-cabecalho  label-control" id="I-LBL-LOCATARIO"></label>
      </div>
      <div class="col-md-4">
        <label class="dados-cabecalho  label-control" id="I-LBL-RECEBIMENTO"></label>
      </div>
    </div>                  
  </div>
</div>
<!--
<div class="row i-div-ultimospagamentos"> 
    <div class="col-md-12 div-2">
      <div class="col-md-4">
        <label class="dados-cabecalho  label-control" id="I-LBL-ULTIMORECEBIMENTO"></label>
      </div>
      <div class="col-md-4">
        <label class="dados-cabecalho  label-control" id="I-LBL-ULTIMOREPASSE"></label>
      </div>
    </div>
  </div>
</div>
-->
@include( 'layout.modalbuscaltctr')

