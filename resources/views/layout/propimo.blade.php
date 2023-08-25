<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Proprietário(s) do Imóvel
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
        </div>
    </div>
    <div class="portlet-body form">
        <table  id="tbpropimo" class="table table-striped table-bordered table-hover" >
            <thead class="thead-dark">
                <tr>
                    <th style="text-align:center"> ID </th>
                    <th style="text-align:center"> Proprietario </th>
                    <th style="text-align:center" width="100" style="text-align:center"> Percentual </th>
                    <th style="text-align:center" width="100" style="text-align:center"> Principal </th>
                    <th width="200" style="text-align:center"> Ações </th>
                </tr>   
            </thead>
            <tbody>
            </tbody>
        </table>
        <div class="table-footer" >
            <a  class="btn btn-sm btn-primary" role="button" onClick="adicionarPropImo()" >
            Adicionar Proprietário </a>
            <!--data-toggle="modal" data-target="#modalFormaPagamento"-->
            <input type="hidden" id="i-totalperc">
            <input type="hidden" id="i-temprincipal">
        </div>                            
    </div>
</div>