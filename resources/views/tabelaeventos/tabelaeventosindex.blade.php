@extends('layout.app')
@push('script')


@section( 'scripttop')

<style>
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th
{
  padding:0; 
}
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


.lbl-medidas-valores {
  text-align: center;
  font-size: 14px;
  font-weight: bold;
  color: #4682B4; 
}


.div-1 {
  background-color: lightblue;
}
.div-2 {
  background-color: #CCFFE5;
}

td{text-align:center;}
</style>

<script src="{{asset('/global/plugins/sweetalert/sweetalert2.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('/global/plugins/sweetalert/sweetalert2.min.css')}}">        


@endsection

@section('content')


<!-- BEGIN CONTENT -->
<div class="row">
  <div class="col-md-12">
    <div class="tabbable-line boxless tabbable-reversed">
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <form  id="i-form-lancamento" onsubmit="return false;" >
            <div class="form-body">
            
              <div class="portlet box blue i-div-informacoes">
                <div class="portlet-title">
                  <div class="caption">
                   <i class="fa fa-gift"></i>Tabela de Eventos
                  </div>
                  <div class="tools">
                  </div>
              </div>
              
              <div class="portlet-body form">
                <table  id="i-tbllancamento" class="table table-striped table-bordered table-hover" >
                  <thead class="thead-dark">
                    <tr>
                      <th width="100" style="text-align:center"> Ações </th>
                      <th width="30" style="text-align:center" ><a href="javascript:ordem('IMB_TBE_ID')"> ID </a></th>
                      <th style="text-align:center"><a href="javascript:ordem('IMB_TBE_NOME')"> Nome Evento</a> </th>
                      <th width="60" style="text-align:center"> Taxa Adm.</th>
                      <th width="60" style="text-align:center"> I.R.R.F. </th>
                      <th width="60" style="text-align:center"> Multa </th>
                      <th width="60" style="text-align:center"> Correção </th>
                      <th width="60" style="text-align:center"> Juros </th>
                      <th width="60"  style="text-align:center"> I.S.S. </th>
                      <th width="60" style="text-align:center"> C.F.C. </th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <div id="i-div-pagination">
              </div>
            </div>
          </form>
        </div> <!--class="tab-pane active" id="tab_1">-->
      </div><!--class="tab-content">-->
    </div><!--class="tabbable-line boxless tabbable-reversed">-->
  </div> <!--<div class="col-md-12">-->
</div> <!-- fim row unica -->


<div class="modal fade" id="modaleventosmanut" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-target="#staticBackdrop">
  <div class="modal-dialog" style="width:90%;" >
    <div class="modal-content ">
      <div class="modal-body">
        <input type="hidden" id="ID">
        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption">
              <i class="fa fa-gift"></i> <label id="i-lbl-cfcdetalhe">Manutenção Evento</label> 
            </div>
          </div>

          <div class="portlet-body form">
            <div class="row">
            <div class="col-md-12">
              <div class="col-md-2">
                <label class="control-label">Código</label>
                <input class="form-control" type="text" id="IMB_TBE_ID" 
                onkeypress="return isNumber(event)" onpaste="return false;" >
              </div>
              <div class="col-md-5">
                <label class="control-label">Descrição</label>
                <input class="form-control" type="text" id="IMB_TBE_NOME" >
              </div>
              <div class="col-md-5">
                <label class="control-label">CFC</label>
                <select class="form-control" id="FIN_CFC_ID-TABEVENTOS">
                  <option value=""></option>
                </select>
              </div>
            </div>  
              
            <div class="col-md-12">
              <div class="col-md-2 div-center">
                <label class="label-control">Inc.Taxa Adm
                  <input type="checkbox" id="IMB_TBE_TAXAADM" class="form-control" >
                </label>
              </div>
                
              <div class="col-md-2 div-center">
                <label class="label-control">Inc.I.R.R.F.
                  <input type="checkbox" id="IMB_TBE_IRRF" class="form-control" >
                </label>
              </div>

              <div class="col-md-2 div-center">
                <label class="label-control">Inc. Multa
                  <input type="checkbox" id="IMB_TBE_MULTA" class="form-control" >
                </label>
              </div>

              <div class="col-md-2 div-center">
                <label class="label-control">Inc. Correção
                  <input type="checkbox" id="IMB_TBE_CORRECAO" class="form-control" >
                </label>
              </div>
              
              <div class="col-md-2 div-center">
                <label class="label-control">Inc.Juros
                  <input type="checkbox" id="IMB_TBE_JUROS" class="form-control" >
                </label>
              </div>
              <div class="col-md-2 div-center">
                <label class="label-control">Inc. I.S.S.
                  <input type="checkbox" id="IMB_TBE_INCISS" class="form-control" >
                </label>
              </div>
            </div>
            </div>            
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-6">
            </div>
            <div class="col-md-3">
              <button class="form-control btn btn-primary" onClick="gravarEventos();">Gravar </button>
            </div>
            <div class="col-md-3">
              <button class="form-control btn btn-danger" data-dismiss="modal">Cancelar </button>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>


          <!-- BEGIN QUICK SIDEBAR -->

<a href="javascript:;" class="page-quick-sidebar-toggler">
  <i class="icon-login"></i>
</a>

<div class="page-quick-sidebar-wrapper" data-close-on-body-click="false">


@endsection
@push('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="{{asset('/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/form-input-mask.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/global/plugins/jquery.input-ip-address-control-1.0.min.js')}}" type="text/javascript"></script>

<script>
  $( document ).ready(function() 
  {
    cargaCFC();
    cargaEventos();
    $("#sirius-menu").click();

  });



    function cargaEventos()
    { 

      var url = "{{ route('tabelaeventos.carga') }}";
      $.ajax(
      {
        url:url,
        datatype:'json',
        async:false,
        success: function( data )
        {
          linha = "";
          $("#i-tbllancamento>tbody").empty();
          for( nI=0;nI < data.length;nI++)
          {
            var taxaadm = '';
            if( data[nI].IMB_TBE_TAXAADM == 'S' )
              taxaadm='<i class="fa fa-check" aria-hidden="true"></i>';
  
              var irrf = '';
            if( data[nI].IMB_TBE_IRRF == 'S' )
              irrf='<i class="fa fa-check" aria-hidden="true"></i>';
  
              var multa = '';
            if( data[nI].IMB_TBE_MULTA == 'S' )
            multa='<i class="fa fa-check" aria-hidden="true"></i>';

            var correcao = '';
            if( data[nI].IMB_TBE_CORRECAO  == 'S' )
              correcao='<i class="fa fa-check" aria-hidden="true"></i>';

              var juros = '';
            if( data[nI].IMB_TBE_JUROS  == 'S' )
              juros='<i class="fa fa-check" aria-hidden="true"></i>';

              var iss = '';
            if( data[nI].IMB_TBE_INCISS  == 'S' )
              iss='<i class="fa fa-check" aria-hidden="true"></i>';

                          
  

            linha = '<tr>'+
                      '<td>'+
                        '<a href=javascript:editar(\''+data[nI].IMB_TBE_ID+'\') class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"></span></a> '+
//                        '<a href=javascript:apagar('+data[nI].IMB_TBE_ID+') class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a> '+
                      '</td>' +
                        '<td style="text-align:center valign="center">'+data[nI].IMB_TBE_ID+'</td>' +
                        '<td style="text-align:center valign="center">'+data[nI].IMB_TBE_NOME+'</td>' +
                        '<td style="text-align:center valign="center">'+taxaadm+'</td>' +
                        '<td style="text-align:center valign="center">'+irrf+'</td>' +
                        '<td style="text-align:center valign="center">'+multa+'</td>' +
                        '<td style="text-align:center valign="center">'+correcao+'</td>' +
                        '<td style="text-align:center valign="center">'+juros+'</td>' +
                        '<td style="text-align:center valign="center">'+iss+'</td>' +
                        '<td style="text-align:center valign="center">'+data[nI].FIN_CFC_ID+'</td>' +
                        '</tr>';
          $("#i-tbllancamento").append( linha );
        }
      }
    });
  }

  function cargaCFC()
  {
    var url = "{{route('cfc.carga')}}";

    $.ajax(
      {
        url:url,
        dataType:'json',
        type:'get',
        async:false,
        success:function( data ) 
        {
            $("#FIN_CFC_ID-TABEVENTOS").empty();

            linha =  '<option value="">Informe um CFC</option>';
            $("#FIN_CFC_ID-TABEVENTOS").append( linha );
            for( nI=0;nI < data.length;nI++)
            {
                linha =
                    '<option value="'+data[nI].FIN_CFC_ID+'">'+
                    data[nI].FIN_CFC_DESCRICAO+'<b>('+data[nI].FIN_CFC_ID+')</b></option>';
                $("#FIN_CFC_ID-TABEVENTOS").append( linha );
            }
      }
    });

    }

  function editar( id )
  {
    var url = "{{route('tabelaeventos.buscajson')}}/"+id;

    $.ajax(
      {
        url : url,
        dataType:'json',
        type:'get',
        async:false,
        success:function( data )
        {
          $("#ID").val( data.ID);
          $("#IMB_TBE_ID").val( data.IMB_TBE_ID);
          $("#IMB_TBE_NOME").val( data.IMB_TBE_NOME );
          $("#FIN_CFC_ID-TABEVENTOS").val( data.FIN_CFC_ID );
          $("#IMB_TBE_TAXAADM").prop( 'checked', ( data.IMB_TBE_TAXAADM == 'S'));
          $("#IMB_TBE_IRRF").prop( 'checked', ( data.IMB_TBE_IRRF == 'S'));
          $("#IMB_TBE_MULTA").prop( 'checked', ( data.IMB_TBE_MULTA == 'S'));
          $("#IMB_TBE_CORRECAO").prop( 'checked', ( data.IMB_TBE_CORRECAO == 'S'));
          $("#IMB_TBE_JUROS").prop('checked', ( data.IMB_TBE_JUROS == 'S'));
          $("#IMB_TBE_INCISS").prop( 'checked', ( data.IMB_TBE_INCISS == 'S'));
          $("#modaleventosmanut").modal('show');
        }
      })
  }

  function gravarEventos()
  {

    var url = "{{route('eventos.store')}}";

    var dados =
    {

      ID : $("#ID").val(),
      IMB_TBE_ID : $("#IMB_TBE_ID").val(),
      IMB_TBE_NOME : $("#IMB_TBE_NOME").val(),
      FIN_CFC_ID_TABEVENTOS : $("#FIN_CFC_ID-TABEVENTOS").val(),
      IMB_TBE_TAXAADM : $("#IMB_TBE_TAXAADM").prop('checked') ? 'S' : 'N',
      IMB_TBE_IRRF :$("#IMB_TBE_IRRF").prop('checked') ? 'S' : 'N',
      IMB_TBE_MULTA :$("#IMB_TBE_MULTA").prop('checked') ? 'S' : 'N',
      IMB_TBE_CORRECAO :$("#IMB_TBE_CORRECAO").prop('checked') ? 'S' : 'N',
      IMB_TBE_JUROS :$("#IMB_TBE_JUROS").prop('checked') ? 'S' : 'N',
      IMB_TBE_INCISS :$("#IMB_TBE_INCISS").prop('checked') ? 'S' : 'N',
    };

    $.ajaxSetup({
            headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });


    $.ajax(
      {
        url:url,
        dataType:'json',
        type:'post',
        data:dados,
        async:false,
        success:function( data )
        {
          alert('Gravado!');
          cargaEventos();
          $("#modaleventosmanut").modal('hide');          
        }
      }
    )
  }
  
</script>



@endpush