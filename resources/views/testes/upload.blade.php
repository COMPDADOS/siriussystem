<form class="col-lg-10 offset-lg-1" id="formulario-atividade-extra">
  <!--Departamento -->

  <!-- CAMPO DETALHES -->

  <label>Detalhes</label>
  <textarea name="detalhes-da-atividade-modal" id="detalhes-da-atividade-modal" placeholder="Descreva detalhes sobre a atividade que será realizada"></textarea>


  <label for="arquivo-modal">Insira o arquivo:</label>
  <input type="file" name="arquivo-cliente[]" id="arquivo-cliente" multiple />

  <input name="salvar-atividade-extra" id="salvar-atividade-extra" class="btn btn-md btn-primary" type="submit" value="Criar Atividade">

</form>


<script>

//CÓDIGO PARA PREENCHIMENTO DA LISTA COM OS DADOS DA PESQUISA 
$(document).ready(function() 
{

    $('#formulario-atividade-extra-cliente').submit(function(e) 
    {
        e.preventDefault();
        var formulario_extra = $(this);
        var retorno = inserirFormulario(formulario_extra);
    });
});


function inserirFormulario(dados) {

  arquivo = $("#arquivo-cliente");
  arquivo = arquivo[0];
  file = arquivo.files;
  file = file[0];
  // Apenas 2MB é permitido
  if (file != undefined) {
    if (file.size > 2 * 1024 * 1024) {
      alert("Arquivo excede os 2 Megas");
      return false;
    }
  }

  alert( 'ddad ');
  var formul = $('#formulario-atividade-extra-cliente')[0];
  var data = new FormData(formul);
  $.ajax({
    type: "POST",
    enctype: 'multipart/form-data',
    url: "{{route('testeenviarupload')}}",
    data: data,
    processData: false,
    contentType: false,
    cache: false,
    timeout: 600000,


  }).done(function(data) {

    if (data == "atividadecriadacomsucesso") {
      $('#modal-confirmacao').modal('show');

      //Limpar o formulário
      $('#formulario-atividade-extra-cliente').each(function() {
        this.reset();
      });

    } else {
      $('#modal-negacao').modal('show');
      console.log(data);

      //Limpar o formulário
      $('#formulario-atividade-extra-cliente').each(function() {
        this.reset();
      });

    }


  }).fail(function() {
    alert("Ativou o fail do AJAX");

  }).always(function(data) {
    console.log(data);

  });
}
</script>
