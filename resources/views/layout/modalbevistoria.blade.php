<div class="modal" style="overflow:hidden;" role="dialog" id="modalbevistoria" data-keyboard="false" data-backdrop="static">  
  <div class="modal-dialog "style="width:95%;" >
    <div class="modal-content">
      <div class="modal-header">
        <div class="col-md-12">
          <div class="col-md-3">
            <div class="logo-be">
              <img src="{{asset('/layouts/layout/img/logobesoft.png')}}" alt="">
            </div>
          </div>
          
            <h1 class="div-center">Vistoria da BeSoft</h1>
          
        </div>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="webhookauth">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-4">
              <label class="control-label"> <b>Selecione o Imóvel</b></label>
              <select  class="select2" id="i-endereco">
                  <option value="">Rua Antonio Alves, 10-30</option>
              </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="col-md-4">

              <label class="control-label">Logradouro</label>
              <input class="form-control" type="text" id="i-logradouro">
            </div>

          <div class="col-md-1">
              <label class="cotrol-label">Número</label>
              <input class="form-control" type="text" id="i-endereco-numero">
            </div>

            <div class="col-md-3">
              <label class="cotrol-label">Complemento</label>
              <input class="form-control" type="text" id="i-endereco-complemento">
            </div>

            <div class="col-md-2">
              <label class="control-label">Tipo Imóvel</label>
              <select class="form-control" id="i-tipo-imovel">
              </select>
            </div>
            <div class="col-md-2">
              <label class="control-label">Sub-Tipo Imóvel</label>
              <select class="form-control" id="i-subtipo-imovel">
              </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="col-md-4">
              <label class="control-label">Bairro</label>
              <input class="form-control" type="text" id="i-endereco-bairro">
            </div>
            <div class="col-md-4">
              <label class="control-label"><b>Contrato(Locatário)</b></label>
              <select  class="select2" id="i-contrato">
                  <option value=""></option>
              </select>
            </div>
            <div class="col-md-3">
              <label class="control-label"><b>Vistoriador<b></label>
              <select  class="select2" id="i-vistoriador">
                  <option value="">Lindomar Demetrius</option>
              </select>
            </div>
          </div>
          <div class="col-md-12">
          <div class="col-md-3">
              <label class="control-label"><b>Tipo de Vistoria</b></label>
              <select  class="select2" id="i-tipodevistoria">
                <option value="">Selecione</option>
                <option value="1">Captação</option>
                <option value="2">Entrada</option>
                <option value="3">Saída</option>
                <option value="4">Rotina</option>
              </select>
            </div>
            <div class="col-md-3">
              <label class="control-label"><b>Tipo de Mobilia</b></label>
              <select  class="select2" id="i-tipomobilia">
                <option value="Vazio">Vazio</option>
                <option value="Semi">Semi mobiliado</option>
                <option value="Mobiliado">Mobiliado</option>
              </select>
            </div>
            <div class="col-md-3">
              <label class="control-label"><b>Data Agendamento</b></label>
              <input type="date" class="form-control" id="i-dataaenda">
            </div>
            <div class="col-md-3">
              <label class="control-label"><b>Realizada em</b></label>
              <input type="date" class="form-control" id="i-datarealizada">
            </div>
          </div>
          <div class="col-md-12">
            <div class="col-md-12">
                <label class="control-label"><b>Informações Adicionais</b></label>
                <textarea  class="form-control" id="i-adicionais" cols="100%" rows="5"></textarea>
            </div>
          </div>
          <div class="col-md-12">
            <div class="col-md-9">

            </div>
            <div class="col-md-2">
              <button class="form-control btn btn-primary" onClick="confirmarAgendarVistoria()">Confirmar o Agendamento</button>
            </div>
            <div class="col-md-1">
              <button class="form-control btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>


          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@push( 'script')
<script>

cargaImoveis();

$("#i-endereco").change( function()
{
  var url = "{{ route('imovel.cargajson')}}/"+$("#i-endereco").val();
  console.log( url );

  $.ajax(
    {
      url:url,
      dataType:'json',
      type:'get',
      success:function( data )
      {
        console.log(data);
        $("#i-logradouro").val( data.IMB_IMV_ENDERECO);
        $("#i-endereco-numero").val( data.IMB_IMV_ENDERECONUMERO);
        $("#i-endereco-complemento").val( data.IMB_IMV_NUMAPT+' '+data.IMB_IMV_ENDERECOCOMPLEMENTO);
        $("#i-endereco-bairro").val( data.CEP_BAI_NOME);
      }
    }
  )

});

$("#i-tipo-imovel").change( function()
{
  cargaSubTiposImoveis( $("#i-tipo-imovel").val());

})

  function sincronizarTipoImoveis()
  {
    var url = "{{route('besoft.sincronizartiposimoveis')}}";
    $.ajax(
    {
      url:url,
      datatype:'json',
      type:'get',
      async:false,
      success:function()
      {
        cargaTiposImoveis();
        cargaSubTiposImoveis();
                
        alert('Tipos e Sub-tipos de imóveis sincronizados com sucesso!');

                
      }
    });
  }

  function sincronizarVistoriadores()
  {
    var url = "{{route('besoft.vistoriadores.sincroniza')}}";
    $.ajax(
    {
      url:url,
      datatype:'json',
      type:'get',
      async:false,
      success:function()
      {
        alert('Vistoriadores sincronizados com sucesso!');
        cargaVistoriadores();

                
      }
    });
  }

  function sincronizarCidades()
  {
    var url = "{{route('besoft.cidades.sincroniza')}}";
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
      datatype:'json',
      type:'post',
      async:false,
      success:function()
      {
        alert('Cidades sincronizados com sucesso!');
        //cargaVistoriadores();

                
      }
    });
  }

  function cargaVistoriadores()
  {
    var url = "{{ route('besoft.vistoriadores')}}";
    $.ajax(
    {
      url:url,
      datatype:'json',
      type:'get',
      async:false,
    })
    .then(function(data)
      {

        $("#i-vistoriador").empty();
        linha =  '<option value="">Selecione o Vistoriador</option>';
        $("#i-vistoriador").append( linha );
        for( nI=0;nI < data.length;nI++)
        {
            linha =
              '<option value="'+data[nI].usu_codigo+'"><b>'+data[nI].first_name+' '+data[nI].last_name+'('+data[nI].username+')</b></option>';
            $("#i-vistoriador").append( linha );
        }
       
    });
  }

  function cargaTiposImoveis()
  {
    var url = "{{ route('besoft.tiposimoveis')}}";
    $.ajax(
    {
      url:url,
      datatype:'json',
      type:'get',
      async:false,
    })
    .then(function(data)
      {

        $("#i-tipo-imovel").empty();
        linha =  '<option value="">Selecione Tipo Imóvel</option>';
        $("#i-tipo-imovel").append( linha );
        for( nI=0;nI < data.length;nI++)
        {
            linha =
              '<option value="'+data[nI].tic_codigo+'"><b>'+data[nI].tic_nome+'</b></option>';
            $("#i-tipo-imovel").append( linha );


        }
       
    });
  }

  function cargaSubTiposImoveis( id )
  {
    var url = "{{ route('besoft.listasubtiposimoveis')}}/"+id;
        $.ajax(
    {
      url:url,
      datatype:'json',
      type:'get',
      async:false,
      success:function( data )
      {

        $("#i-subtipo-imovel").empty();
        linha =  '<option value="">Selecione Sub Tipo Imóvel</option>';
        $("#i-subtipo-imovel").append( linha );
        for( nI=0;nI < data.length;nI++)
        {
   

          linha = '<option value="'+data[nI].ist_codigo+'">'+data[nI].ist_nome+'</option>';
              $("#i-subtipo-imovel").append( linha );
          }
        }
       
    });
  }

  function confirmarAgendarVistoria()
  {
    var dados = 
    {
      tipo                  : $("#i-tipodevistoria").val(),
      informacao_adicional  : $("#i-adicionais").val(),
      data                  : $("#i-dataaenda").val(),
      empresa               : "{{Auth::user()->IMB_IMB_ID}}",
      webhook               : "https://link_de_retorno_quando_vistori",
      webhookauth           : "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpYXQiOjE2NDM3MzM4MjF9.Y5oo2714ity2zi7V3fdgbH8gd-KjL6JAvrm8A1a0u1c",//$("#webhookauth").val(),
      imovel                : 
                            { 
                              identificador :  $("#i-endereco").val(),
                              tipo : $("#i-tipo-imovel").val(),
                              subtipo : $("#i-subtipo-imovel").val(),
                              endereco :  $("#i-endereco option:selected").text(),
                              numero:$("#i-endereco-numero").val(),
                              complemento:$("#i-endereco-complemento").val(),
                              bairro: $("#i-endereco-bairro").val(),
                              Cidade:1000,
                            },
      vistoriador           : 
                            {
                              "nome": $("#i-vistoriador").val(),
                              "cpf": '06781484818',
                              "telefone":"14991857709",
                              "email":"limndomar@compdados.com.br"

                            }
    }

    $.ajaxSetup(
      {
        headers:
        {
          'X-CSRF-TOKEN': "{{csrf_token()}}"
        }
      });

    var url = "{{route('besoft.agendarvistoria')}}";
    $.ajax(
      {
        url:url,
        dataType:'json',
        type:'post',
        data:dados,
        complete:function( data)
        {
          var codret = data.status;

          if( codret == 200) 
          {
            alert('Vistoria cadastrada com sucesso!');
            $("#modalbevistoria").modal('hide');
            $('#search-form').submit();
          }
          else
            alert('Atenção, vistoria não cadastrada!')
          
/*
          var retorno = data.responseText;
          retorno = JSON.parse( retorno );
          console.log( retorno );

          console.log( data );
          */
        } 
      }
    )


    return true;
  }

  function cargaImoveis()
  {
    var url = "{{ route('imoveis.geral')}}";
        $.ajax(
    {
      url:url,
      datatype:'json',
      type:'get',
      async:false,
      success:function( data )
      {
        $("#i-endereco").empty();
        linha =  '<option value="">Selecione o Endereço</option>';
        $("#i-endereco").append( linha );
        for( nI=0;nI < data.length;nI++)
        {
          linha = '<option value="'+data[nI].IMB_IMV_ID+'">'+data[nI].enderecocompleto+'</option>';
          $("#i-endereco").append( linha );
        }
      }
    });
  }

</script>

@endpush
