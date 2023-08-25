@extends("layout.app")
@section('scripttop')
<style>
.cards
{
  background-color:white;
  height:300px;
  width:90%¨;
}

.texto-red
{
  color:red;
  font-family: verdana;

}
.cor-azul
{
  color:#0099e6;
  font-family: verdana;

}
  .div-center {
    text-align: center;
}

.div-right {
    text-align: right;
  }

  .div-left {
    text-align: left;
  }


.semespaco
  {margin-top: 0px !important; 
  margin-bottom: 0px !important; 
  padding-top: 0px !important; 
  padding-bottom: 0px !important;"
}
.clientes
{
  color:black;
  font-family: verdana;

}


td
{
  height:50%;
}
.total
{
  color: white;
  background-color: red;
  font-size:14px;
  font-family: verdana;
  align:center;
  border-radius: 25px;
}
.titulo
{
  color: red;
  font-size:14px;
  font-family: verdana;
}
.underline
{
  text-decoration: underline;    

}
</style>
@endsection
@section('content')
<div class="row">
  <div class="col-sm-6">
    
    <div class="card  cards">
      <div class="card-body div-center">
        <div class="row"></div>
        <h3 class="card-title underline">
        <img src="{{asset('/layouts/layout/img/warning.png')}}" alt="">
        Alertas</h3>
        <div class="row">
          <div class="col-md-12">
            <table class="table table-striped table-hover"  id="resultTable">
                <thead>
                  <th></th>
                  <th></th>
                </thead>
              </table>
          </div>
        </div>
      </div>
    </div>

  </div>
  <div class="col-sm-6 ">

    <div class="card  cards">
      <div class="card-body div-center">
        <div class="row"></div>      
        <h3 class="card-title underline">
        <img src="{{asset('/layouts/layout/img/realestate.png')}}" alt="">
        Imóveis</h3>
        <p class="card-text"></p>
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-6 div-center">
                <h2 class="cor-azul">{{$totalativos}}</h2>
                <span class="cor-azul">Ativos</span>
              </div>
              <div class="col-md-6 div-center">
                <h2 class="cor-azul">{{$novosimoveis}}</h2>
                <span class="cor-azul">Novos</span>
              </div>
            </div>
            <a href="javascript:listarDesatualizada()">
              <div class="row">
                <div class="col-md-6 div-right" title="Imóveis desatualizados há mais de 60 dias">
                  <span class="texto-red">{{$imoveisdesatualizados}}</span>
                </div>
                <div class="col-md-6 div-left">
                    <span class="Clientes">Desatualizados</span>
                </div>
              </div>
            </a>
            
            <a href="javascript:listarDesatualizada()">
              <div class="row">
                <div class="col-md-6 div-right" title="Imóveis desatualizados há mais de 60 dias">
                  <span class="texto-red">{{$foradosite}}</span>  
                </div>
                <div class="col-md-6 div-left">
                  <span class="Clientes">Ativos Fora do Site</span>
                </div>
              </div>
            </a>
          </div>
        </div>
        
      </div>

    </div>
  </div>
</div>
@endsection


@push('script')

<script>
    $(document).ready(function() 
    {
      cargaAtmAbertoCorretor();
      cargaAtmAbertoOutroCorretor();
    });

    function cargaAtmAbertoCorretor()
  {

    $("#resultTable>tbody").empty();

    url = "{{route('atendimento.cliente.atendimentopendente')}}";

    $.ajax(
      {
      url   : url,
      dataType: 'json',
      type    : 'get',
      success : function( data )
      {
        linha = "";
        nomes='';
        //$("#i-totalabertocorretor").html( data.recordsTotal);
        for( nI=0;nI < data.data.length;nI++)
        {
          if( nI > 3 )   break;
          nomes = nomes + data.data[ nI ].IMB_CLT_NOME+', ';
        }
        nomes = nomes + '....';
        linha = 
          '<tr>'+
          '   <td><a href="#"><div class="titulo semespaco">Meus Atendimentos em Aberto</div>'+
          '       '+nomes+'</a></td>'+
          '   <td class="div-center"><a href="#"><div class="total  div-center">'+ data.recordsTotal+'</div></a></td>'+
          '</tr>';

          $("#resultTable").append( linha );
      }
      });



  }

  function cargaAtmAbertoOutroCorretor()
  {

    url = "{{route('atendimento.cliente.atendimentooutropendente')}}";

    $.ajax(
      {
      url   : url,
      dataType: 'json',
      type    : 'get',
      success : function( data )
      {
        linha = "";
        nomes='';
        //$("#i-totalabertocorretor").html( data.recordsTotal);
        for( nI=0;nI < data.data.length;nI++)
        {
          if( nI > 3 )   break;
          nomes = nomes + data.data[ nI ].IMB_CLT_NOME+', ';
        }
        nomes = nomes + '....';
        linha = 
          '<tr>'+
          '   <td><a href="#"><div class="titulo semespaco">Atendimentos em Aberto de Outros</div>'+
          '       '+nomes+'</a></td>'+
          '   <td class="div-center"><a href="#"><div class="total div-center">'+ data.recordsTotal+'</div></a></td>'+
          '</tr>';
          $("#resultTable").append( linha );
      }
      });



  }

  function listarDesatualizada()
  {
    
    window.location = "{{ route('setarlistadesatualizados') }}";
    window.location = "{{ route('imovel.index') }}";

  }




  
</script>

@endpush