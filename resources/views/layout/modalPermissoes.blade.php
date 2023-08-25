<div class="modal fade" id="modalpermissoes" style="overflow:hidden;"role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" style="width:90%;" >
    <input type="hidden" id="i-atdid-permissao">
    <div class="modal-content">
      <div class="modal-body">
        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption">
              <i class="fa fa-gift"></i>Permissões do Usuário
            </div>
            <div class="col-md-3">
              <select class="form-control" id="i-select-modulo">
                <option value="">Todos os Módulos</option>
                <option value="ADM">Módulo: <b>Administrativo</b></option>
                <option value="FIN">Módulo: <b>Financeiro</b></option>
                <option value="CRM">Módulo: <b>CRM</b></option>
                <option value="GERAL">Módulo: <b>GERAL</b></option>
              </select>
            </div>
            <div class="col-md-2">
            </div>
            <div class="col-md-3">
              <input class="form-control" type="text" placeholder="Busca rápida e pontual" id="i-permissao-busca-rapida">
            </div>
            <div class="col-md-1">
              <button type="button" class="form-control btn btn-dark" onClick="cargaDireitos(8888)">Localizar</button>
            </div>



          </div>
      
          <div class="portlet-body form">
            <div class="row">
              <div class="col-md-12">
                <table  id="i-direitos-perfil" class="table table-striped table-bordered table-hover" >
                  <thead class="thead-dark">
                      <tr>
                          <th width="10%" style="text-align:center"> Módulo </th>
                          <th width="20%" style="text-align:center"> Grupo</th>
                          <th width="30%" style="text-align:center"> Nome</th>
                          <th width="10%" style="text-align:center"> Acessar </th>
                          <th width="10%" style="text-align:center"> Incluir </th>
                          <th width="10%" style="text-align:center"> Alterar </th>
                          <th width="10%" style="text-align:center"> Excluir </th>
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


@push('script')
<script>

function permitir( id, permissao, status, idusuario )
  {

    $.ajaxSetup(
    {
      headers:    
      {
        'X-CSRF-TOKEN': "{{csrf_token()}}"
      }
    });        


    if ( status == 'N')
      var url="{{ route( 'atendentedireitodireito.permitir')}}/"+id+"/"+permissao
    else
      var url="{{ route( 'atendentedireitodireito.negar')}}/"+id+"/"+permissao;

    $.ajax(
    {
      url: url,
      dataType: 'JSON',
      type: "post",
      async:false,
      success: function(data)
      {
              cargaDireitos( idusuario);

      },
      error: function( error )
      {
        console.log('erro '+error);
      }
    });




  }

  function cargaDireitos( id )
    {

      id = $("#i-atdid-permissao").val();

        var dados = 
            { 
              'id' : id,
              'modulo': $("#i-select-modulo").val(),
              'conteudo': $("#i-permissao-busca-rapida").val(),
            }

        var url = "{{ route('atendentedireito.carga') }}";

        $.ajax(
        {
            url:url,
            datatype:'json',
            data:dados,
            success: function( data )
            {
                linha = "";
                $("#i-direitos-perfil>tbody").empty();
                for( nI=0;nI < data.length;nI++)
                {
                    var acesso='Negado';
                    acessoicon = '<i class="fa fa-ban fa-2x" aria-hidden="true" style="color:red"></i>';
                    if ( data[nI].IMB_DIRACE_ACESSO == 'S')
                    {
                        acesso=' Liberado ';
                        acessoicon = '<i class="fa fa-check-circle-o fa-2x" aria-hidden="true" style="color:green"></i>';
                    }

                    var incluir='Negado';
                    incluiricon = '<i class="fa fa-ban fa-2x" aria-hidden="true" style="color:red"></i>';
                    if ( data[nI].IMB_DIRACE_INCLUSAO == 'S')
                    {
                        incluir=' Liberado ';
                        incluiricon = '<i class="fa fa-check-circle-o fa-2x" aria-hidden="true"style="color:green"></i>';
                    }

                    var alterar='Negado';
                    alteraricon = '<i class="fa fa-ban fa-2x" aria-hidden="true" style="color:red"></i>';

                    if ( data[nI].IMB_DIRACE_ALTERACAO == 'S')
                    {
                        alterar='Liberado';
                        alteraricon = '<i class="fa fa-check-circle-o fa-2x" aria-hidden="true"style="color:green"></i>';              
                    }

                    var excluir='Negado';
                    excluiricon = '<i class="fa fa-ban fa-2x" aria-hidden="true" style="color:red"></i>';
                    if ( data[nI].IMB_DIRACE_EXCLUSAO == 'S')
                    {
                        excluir='Liberado';
                        excluiricon = '<i class="fa fa-check-circle-o fa-2x" aria-hidden="true"style="color:green"></i>';              
                    }

                    linha = 
                        '<tr>' +
                            '<td style="text-align:center valign="center">'+data[nI].IMB_RSC_MODULO+'</td>' +
                            '<td style="text-align:center valign="center">'+data[nI].IMB_RSC_GRUPO+'</td>' +
                            '<td style="text-align:center valign="center">'+data[nI].IMB_RSC_NOME+'</td>' +
                            '<td style="text-align:center valign="center" class="'+acesso+'">'+
                                '<a href=javascript:permitir('+data[nI].IMB_DIRACE_ID+',1,\''+data[nI].IMB_DIRACE_ACESSO+'\','+id+')>'+acessoicon+'</a> '+
                            '</td>' +
                            '<td style="text-align:center valign="center" class="'+incluir+'">'+
                                '<a href=javascript:permitir('+data[nI].IMB_DIRACE_ID+',2,\''+data[nI].IMB_DIRACE_INCLUSAO+'\','+id+')>'+incluiricon+'</a> '+
                            '</td>' +
                            '<td style="text-align:center valign="center" class="'+alterar+'">'+
                                '<a href=javascript:permitir('+data[nI].IMB_DIRACE_ID+',3,\''+data[nI].IMB_DIRACE_ALTERACAO+'\','+id+')>'+alteraricon+'</a> '+
                            '</td>' +
                            '<td style="text-align:center valign="center" class="'+excluir+'">'+
                                '<a href=javascript:permitir('+data[nI].IMB_DIRACE_ID+',4,\''+data[nI].IMB_DIRACE_EXCLUSAO+'\','+id+')>'+excluiricon+'</a> '+
                            '</td>' ;
                    linha = linha +
                          '</tr>';
                    $("#i-direitos-perfil").append( linha );
                }
            }
        });

    }

    function permissoesUsuario(id)
        {
          $("#i-select-modulo").change( function()
          {
            cargaDireitos(id);
    

          });

          $("#i-atdid-permissao").val( id );
          $("#modalpermissoes").modal('show');
          cargaDireitos( id );
        }



</script>


@endpush