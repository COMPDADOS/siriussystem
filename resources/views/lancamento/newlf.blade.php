@extends('layout.app')

@push('script')

@section('content')


<!-- BEGIN CONTENT -->
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <a href="/">Home</a>
      <i class="fa fa-circle"></i>
    </li>
    <li>
      <span>Lançamentos em Contrato</span>
    </li>
  </ul>
  
</div>

<div class="row">
  <div class="col-md-12">
    <div class="tabbable-line boxless tabbable-reversed">
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <form id="i-form-lancamento">
          <input type="hidden" id="IMB_IMB_IDMASTER" name="empresamaster" value="{{ Auth::User()->IMB_IMB_ID }}"> 
            <div class="portlet box blue">
              <div class="portlet-title">
                <div class="caption">
                  <i class="fa fa-gift"></i>Localização do Contrato
                </div>
                <div class="tools">
                  <a href="javascript:;" class="collapse"> </a>
                </div>
              </div>
              
              <div class="portlet-body form">
                <div class="form-body">
                  
                  <div class="row">
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label" >Nome</label>
                        <input type="text" maxlength="40" name="CIMB_CLT_NOME" class="form-control" id="i-nome"
                                        placeholder="Nome completo"
                                        autocomplete="off"                                        
                                        style="font-family: Tahoma; font-size: 16px"
                                        required >
                      </div>
                    </div>
                  </div>
                </div><!--< FIM div class="form-body">-->
              </div> <!-- FIM <div class="portlet-body form">-->
            </div> <!-- fim quadro <div class="portlet box blue">-->
          </form>
        </div> <!--class="tab-pane active" id="tab_1">-->
      </div><!--class="tab-content">-->
    </div><!--class="tabbable-line boxless tabbable-reversed">-->
  </div> <!--<div class="col-md-12">-->
</div> <!-- fim row unica -->

          <!-- BEGIN QUICK SIDEBAR -->

<a href="javascript:;" class="page-quick-sidebar-toggler">
  <i class="icon-login"></i>
</a>

<div class="page-quick-sidebar-wrapper" data-close-on-body-click="false">
</div>



@endsection
@push('script')

@endpush