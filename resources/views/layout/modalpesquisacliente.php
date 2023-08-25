<div class="modal fade" id="modalpesquisacliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-body">
        <div class="portlet box blue">

          <div class="portlet-title">
            <div class="caption">
              <i class="fa fa-gift"></i>Clientes
            </div>
          </div>
      
          <div class="portlet-body form">
            <div class="row">
            <hr>
            </div>
          
            <div class="row">
              <div class="col-md-8">
                  <div class="form-group">
                      <input type="text" id="i-str"  
                      placeholder="digite aqui um pedaço do nome" 
                      class="form-control">
                  </div>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                  <button class="btn btn-primary" onClick="buscaIncremental()">Carregar Sugestões</button>
                  </div>
                </div>
            </div>
              
            <div class="row">
              <div class="col-md-10">
                <table  id="tblclientes" class="table table-striped table-bordered table-hover" >
                  <div class="col-md-10">
                  <thead class="thead-dark">
                    <div class="col-md-10">
                    <tr >
                      <div class="col-md-10">
                      <th width="40%" style="text-align:center"> Nome </th>
                      <th width="20%" style="text-align:center"> CPF </th>
                      <th width="20%" style="text-align:center"> RG </th>
                      <th width="20%" style="text-align:center"> Ações </th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                <div class="form-actions right">
                  <button type="button" class="btn btn-primary" onClick="novoCliente()">Incluir Cliente</button>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="modal-footer">

          <div class="row">
            <div class="col-md-12">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">sair</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
