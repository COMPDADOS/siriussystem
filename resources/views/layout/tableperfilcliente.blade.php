<div class="col-md-12">
    <table class="table table-bordered" id="tableperfil">
      <thead>
        <th class="div-center"></th>
        <th class="div-center">Região</th>
        <th class="div-center">Tipo</th>
        <th class="div-center">Venda Faixa em R$</th>
        <th class="div-center">Locação Faixa em  R$</th>
        <th class="div-center">Finalidade</th>
        <th class="div-center">Dorm.</th>
        <th class="div-center">Suíte</th>
        <th class="div-center">Garag.</th>
      </thead>
      <div class="table-footer" >
          <div class="table-footer" >
            <a  class="btn btn-sm btn-primary"  
                role="button" onClick="adicionarPerfil()" >
            Adicionar Perfil </a>
            <!--data-toggle="modal" data-target="#modalFormaPagamento"-->
        </div>
      </div>
     </table>
     <div class="row">
        <div class="col-md-12 div-right">
          <a href="#" class="btn btn-success">Buscar Imóveis Conforme Perfil(s) cadastrado(s)</a> 
        </div>
      </div>

  </div>

  @push('script')
  <script>
        function excluirPerfilCliente( id, idcliente )
        {
            if( confirm( 'Confirma a remoção deste registro de perfil do cliente?') == true )
            {
                var url = "{{route('cliente.perfil.apagar')}}/"+id;

                $.ajaxSetup(
                    {
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
                        success:function()
                        {
                            alert('Registro excluído!');
                            cargaPerfil( idcliente);
                        }
                    })
            }

        }

  </script>


  @endpush
