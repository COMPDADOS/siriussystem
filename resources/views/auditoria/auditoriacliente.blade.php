@extends('layout.app')
@section('scriptop')
<style>

.div-cor-fonte-white{
    color:white;
}
.div-cor-red {
  border-style: solid;
  border-color: red;
  color: white;
}

.div-cor-green {
    border-style: solid;
  border-color: green;
} 

.div-cor-blue {
    background-color: blue;    
    color: white;
} 

.div-cor-white{
    border-style: solid;
  border-color: white;
} 

td{text-align:center;}

</style>

@endsection

@section('content')


<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:history.back(-1)">Voltar</a>
            <i class="fa fa-circle"></i>
        </li>
    </ul>
</div>


<div class="portlet light bordered">
    <div class="portlet-body form">
        <!--<form acion="/cliente/list" method="get">-->
        <input type="hidden" id="IMB_CLT_ID" name="IMB_CLT_ID" value="{{$IMB_CLT_ID}}"> 
        <div class="form-body">
            <div class="row">
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped" id="resultTable">
                    <thead>
                        <th>Data/Hora</th>
                        <th>Alteração</th>
                        <th>Usuário</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@push('script')

<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>

<script type="text/javascript">

$(document).ready(function() 
{
    console.log("{{ route('log.cliente') }}");
    CargaLog()
});


function CargaLog()
  {
    var url = "{{ route('log.cliente') }}";
    dados = 
    {
        IMB_CLT_ID : $("#IMB_CLT_ID").val(),
    }
    $.ajax(
    {
      url:url,
      data:dados,
      datatype:'json',
      async:false,
      success: function( data )
      {
        linha = "";
        $("#resultTable>tbody").empty();
        console.log('leng: '+data.data.length);
        
        for( nI=0;nI < data.data.length;nI++)
        {
            var datalog = moment(data.data[nI].IMB_OBS_DTHATIVO).format('DD/MM/YYYY HH:MM');


          linha = 
            '<tr>' +
            '<td style="text-align:center valign="center">'+datalog+'</td>' +
            '<td style="text-align:center valign="center">'+data.data[nI].IMB_OBS_OBSERVACAO+'</td>' +
            '<td style="text-align:center valign="center">'+data.data[nI].IMB_ATD_NOME+'</td>' +
            '</tr>';
          $("#resultTable").append( linha );
        }
      }
    });
  }

  

</script>
@endpush
