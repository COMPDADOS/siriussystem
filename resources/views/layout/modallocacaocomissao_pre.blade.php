<div class="modal" tabindex="-1" role="dialog" id="modalloccomissao_pre" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog "style="width:80%;" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Liberação de Valores de Comissões de Locações</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="portlet light bordered">
                    <div class="portlet-body form">

                        <input type="hidden" id="IMB_CTR_ID_COMLOC">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <h4 class="div-center"><u>Taxa Contrato <b>R$ <span id="i-val-tal"></span></u></b></h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <table  id="tabparcelas-tc" class="table table-striped table-bordered table-hover" >
                                        <thead class="thead-dark">
                                            <tr>
                                                <th width="33%"  style="text-align:center"> Data Vencto. </th>
                                                <th width="33%" style="text-align:center"> Data Locatário </th>
                                                <th width="33%" style="text-align:center"> Valor R$ </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-4">
                                    <table  id="tacaptadores-tc" class="table table-striped table-bordered table-hover" >
                                        <thead class="thead-dark">
                                            <tr>
                                                <th width="33%"  style="text-align:center"> Captador</th>
                                                <th width="33%" style="text-align:center"> Perc.</th>
                                                <th width="33%" style="text-align:center"> Valor R$ </th>
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


@push('script')

<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>

<script type="text/javascript">

$(document).ready(function() 
{


});

</script>
@endpush
