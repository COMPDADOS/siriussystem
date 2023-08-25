@extends('layout.app')

@push('script')
<script>
        function GaleriaCarregar(){
            $('#galeria-imovel').html('<i class="fa fa-5x fa-spinner fa-spin"></i>');
            $.get('/imovel/galeria/<?=$imovel->IMB_TIM_ID?>', function(data){
                $('#galeria-imovel').html(data);
            });
        }
        
        function GaleriaExcluir(_id){
            if (confirm('Deseja realmente excluir esta imagem?')){
                $('#galeria-imovel').html('<i class="fa fa-5x fa-spinner fa-spin"></i>');
                $.get('/sistema/adm/galeria_imovel.php?a=excluir&id='+_id, function(data){
                    GaleriaCarregar();
                });
            }
        }
        
        function GaleriaPrincipal(_id){
            if (confirm('Deseja realmente deixar esta imagem como a imagem principal?')){
                $('#galeria-imovel').html('<i class="fa fa-5x fa-spinner fa-spin"></i>');
                $.get('/sistema/adm/galeria_imovel.php?a=prin&id='+_id, function(data){
                    GaleriaCarregar();
                });
            }
        }
        
        var Upload = function (file) {
            this.file = file;
        };

        Upload.prototype.getType = function() {
            return this.file.type;
        };
        Upload.prototype.getSize = function() {
            return this.file.size;
        };
        Upload.prototype.getName = function() {
            return this.file.name;
        };
        Upload.prototype.doUpload = function () {
            var that = this;
            var formData = new FormData();

            // add assoc key values, this will be posts values
            formData.append("file", this.file, this.getName());
            formData.append("upload_file", true);

            $.ajax({
                type: "POST",
                //url: "{{ url('/imovel/galeria_imovel.php')}}?a=upload&nimovelpesquisa=<?=$imovel->IMB_TIM_ID?>",
                url: "/imovel/imagem/1293",
                /*
                xhr: function () {
                    var myXhr = $.ajaxSettings.xhr();
                    if (myXhr.upload) {
                        myXhr.upload.addEventListener('progress', that.progressHandling, false);
                    }
                    return myXhr;
                },
                success: function (data) {
                    alert('Imagem cadastrado com sucesso junto ao imóvel!');
                    GaleriaCarregar();
                },
                error: function (error) {
                    alert('Desculpe há uma falha para realizar este upload!');
                },
                async: true,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                timeout: 60000
            });
            */
        };

        Upload.prototype.progressHandling = function (event) {
            var percent = 0;
            var position = event.loaded || event.position;
            var total = event.total;
            var progress_bar_id = "#progress-wrp";
            if (event.lengthComputable) {
                percent = Math.ceil(position / total * 100);
            }
            // update progressbars classes so it fits your code
            $(progress_bar_id + " .progress-bar").css("width", +percent + "%");
            $(progress_bar_id + " .status").text(percent + "%");
            if (percent===100){
                window.setTimeout(function(){
                    percent = 0;
                    $(progress_bar_id + " .progress-bar").css("width", +percent + "%");
                    $(progress_bar_id + " .status").text(percent + "%");
                }, 1500);
            }
        };
    </script>
@endpush


@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="#">Cadastro</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="#">Imóveis</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Cadastro</span>
        </li>
    </ul>
</div>

<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject bold uppercase">Cadastro de Imóveis</span>
            <i class="fa fa-gift"></i>
        </div>
        <div class="tools">
            <a href="#portlet-config" data-toggle="modal" class="config"> </a>
        </div>
    </div>
    <div class="portlet-body">
        <form action="{{ route('imovel.save') }}" id="frmCadastro">
            <div class="tabbable-custom nav-justified">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active">
                        <a href="#tab_1_1_1" data-toggle="tab">Dados do Imóvel</a>
                    </li>
                    <li>
                        <a href="#tab_1_1_2" data-toggle="tab">Medidas / Imediações / Cômodos</a>
                    </li>
                    <li>
                        <a href="#tab_1_1_3" data-toggle="tab">Observações</a>
                    </li>
                    <li>
                        <a href="#tab_1_1_4" data-toggle="tab">Imagens</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1_1_1">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="icheck-inline checkbox">
                                            <label>
                                            &nbsp;&nbsp;&nbsp;<input type="checkbox" name="IMB_IMV_WEBIMOVEL" {{ ($imovel->IMB_IMV_WEBIMOVEL == 'S') ? 'checked' : null }} class="icheck" data-checkbox="icheckbox_flat-blue">
                                                Site&nbsp;&nbsp;&nbsp;&nbsp;
                                            </label>

                                            <label>
                                            &nbsp;&nbsp;&nbsp;<input type="checkbox" name="   IMB_IMV_DESTAQUE" {{ ($imovel->IMB_IMV_DESTAQUE == 'S') ? 'checked' : null }} class="icheck" data-checkbox="icheckbox_flat-blue">
                                                Destaque&nbsp;&nbsp;&nbsp;
                                            </label>
                                            <label>
                                            &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="IMB_IMV_WEBLANCAMENTO" {{ ($imovel->IMB_IMV_WEBLANCAMENTO == 'S') ? 'checked' : null }} class="icheck" data-checkbox="icheckbox_flat-blue">
                                                Lançto.&nbsp;&nbsp;&nbsp;&nbsp;
                                            </label>
                                            <label> 
                                            &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="IMB_IMV_ESCLUSIVO" {{ ($imovel->IMB_IMV_ESCLUSIVO = 'S') ? 'checked' : null }} class="icheck" data-checkbox="icheckbox_flat-blue">
                                                Exclusivo
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Data Cadastro</label>
                                        <input type="text" id="idatacadastro" name="IMB_IMV_DATACADASTRO" class="form-control" value="{{ date('d/m/Y', strtotime($imovel->IMB_IMV_DATACADASTRO)) }}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Atualização</label>
                                        <input type="text" name="IMB_IMV_DATAATUALIZACAO" class="form-control" value="{{ date('d/m/Y', strtotime($imovel->IMB_IMV_DATAATUALIZACAO)) }}" readonly >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" >
                                        <label class="control-label">Unidade</label>
                                        <select class="form-control" name="IMB_IMB_ID">
                                            @foreach ($imobiliaria as $unidade)
                                                <option {{ $imovel->IMB_IMB_ID2 == $unidade->IMB_IMB_ID }} value="{{ $unidade->IMB_IMB_ID }}">{{ $unidade->IMB_IMB_NOME }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label>Tipo de Imóvel</label>
                                        <select class="form-control" name="IMB_TIM_ID">
                                            @foreach ($tipoimovel as $tipo)
                                                <option value="{{ $tipo->IMB_TIM_ID }}" {{ ($tipo->IMB_TIM_ID == $imovel->IMB_TIM_ID) ? 'select' : null }}>
                                                    {{ $tipo->IMB_TIM_DESCRICAO }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="icheck-list checkbox">
                                            <label class="form-check-label">
                                                <input type="checkbox" value="S"name="IMB_IMV_TERREA" {{ ($imovel->IMB_IMV_TERREA == 'S') ? 'checked' : null }} class="icheck" data-checkbox="icheckbox_flat-blue">
                                                Térrea
                                            </label>
                                            <label class="form-check-label">
                                                <input type="checkbox" name="IMB_IMV_SOBRADO" {{ ($imovel->IMB_IMV_SOBRADO == 'S') ? 'checked' : null }} class="icheck" data-checkbox="icheckbox_flat-blue">
                                                Sobrado
                                            </label>
                                            <label class="form-check-label">
                                                <input type="checkbox" name="IMB_IMV_ASSOBRADADA" {{ ($imovel->IMB_IMV_ASSOBRADADA == 'S') ? 'checked' : null }} class="icheck" data-checkbox="icheckbox_flat-blue">
                                                Assobradada
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="icheck-list checkbox">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="IMB_IMV_PLACA" {{ ($imovel->IMB_IMV_PLACA == 'S') ? 'checked' : null }} class="icheck" data-checkbox="icheckbox_flat-blue">
                                                Tem Placa
                                            </label>
                                            <label class="form-check-label">
                                                <input type="checkbox" name="IMB_IMV_ACEITAFINANC" {{ ($imovel->IMB_IMV_ACEITAFINANC == 'S') ? 'checked' : null }} class="icheck" data-checkbox="icheckbox_flat-blue">
                                                Aceita Financ.
                                            </label>
                                            <label class="form-check-label">
                                                <input type="checkbox" name="IMB_IMV_PERMUTA" {{ ($imovel->IMB_IMV_PERMUTA == 'S') ? 'checked' : null }} class="icheck" data-checkbox="icheckbox_flat-blue">
                                                Aceita Permuta
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="icheck-list checkbox">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="IMB_IMV_ESCRIT" {{ ($imovel->IMB_IMV_ESCRIT == 'S') ? 'checked' : null }} class="icheck" data-checkbox="icheckbox_flat-blue">
                                                Tem Escritura
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 ">
                                    <div class="form-group">
                                        <label>Código</label>
                                        <input type="text" name="IMB_IMV_ID" class="form-control input-sm" value="{{ $imovel->IMB_IMV_ID }}">
                                    </div>
                                </div>

                                <div class="col-md-2 ">
                                    <div class="form-group">
                                        <label>Referência</label>
                                        <input type="text" name="IMB_IMV_REFERE"class="form-control input-sm" value="{{ $imovel->IMB_IMV_REFERE }}">
                                    </div>
                                </div>
                                <div class="col-md-2 ">  <!--deixando um espaço -->
                                </div>

                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label>R$ Venda</label>
                                        <input type="number" pattern="[0-9]+([.\,][0-9]+)?" step="0.01" text-align: right name="IMB_IMV_VALVEN" class="form-control" id="valorvenda" type="text" value="{{ $imovel->IMB_IMV_VALVEN ?$imovel->IMB_IMV_VALVEN : '0' }}">
                                    </div>
                                </div>

                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label>R$ Locação</label>
                                        <input type="number" pattern="[0-9]+([.\,][0-9]+)?" step="0.01" id="valorlocacao" class="form-control" name="IMB_IMV_VALLOC" value="{{ $imovel->IMB_IMV_VALLOC ? $imovel->IMB_IMV_VALLOC : '0' }}">
                                    </div>
                                </div>
                                    
                                <input  type="hidden" name="IMB_CLT_ID" id="IMB_CLT_ID" value="{{ $imovel->IMB_CLT_ID }}">
                                <input  type="hidden" name="IMB_CLT_IDORIGINAL" value="{{ $imovel->IMB_CLT_ID }}">
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="nomeprop">Proprietário</label>
                                        <div class="input-icon">
                                            <i class="fa fa-user fa-fw"></i>
                                            <input type="text"  id="nomeprop" class="form-control" 
                                            value="{{ $imovel->cliente->IMB_CLT_NOME }}" readonly>
                                        </div>
                                </div>
                                <div class="col-md-2">
                                    <span class="input-group-btn">
                                        <span></span>
                                        <button type="button" class="btn btn-lg btn-success" onClick="alterarProp()">
                                        <!-- data-toggle="modal"   data-target="#propModal" >-->
                                            <i class="fa fa-edit fa-fw"></i>Alterar Proprietário
                                        </button>
                                    </span>
                                </div>
                            </div>

                            <div class="row">
                                
                                <div class="col-md-12">
                                    <h3>Endereço / Localização</h3>
                                    <hr />
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Tipo</label>
                                        <input type="text" id="tipologradouro" name="IMB_IMV_ENDERECOTIPO" value="{{ $imovel->IMB_IMV_ENDERECOTIPO }}" class="form-control input-sm" style="font-family: Tahoma; font-size: 16px" placeholder="Rua,Avenida,Praça...">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-4 ">
                                    <div class="form-group">
                                        <label id="ilogradouro" >Logradouro</label>
                                        <input type="text" id="rua" name="IMB_IMV_ENDERECO" value="{{ $imovel->IMB_IMV_ENDERECO }}" class="form-control  mr-sm-0 input-sm" style="font-family: Tahoma; font-size: 16px">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Número</label>
                                        <input type="text" name="IMB_IMV_ENDERECONUMERO" value="{{ $imovel->IMB_IMV_ENDERECONUMERO }}" class="form-control input-sm" style="font-family: Tahoma; font-size: 16px">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Apt.</label>
                                        <input type="text" name="IMB_IMV_NUMAPT" value="{{ $imovel->IMB_IMV_NUMAPT ? $imovel->IMB_IMV_NUMAPT : '0'}}" class="form-control input-sm" style="font-family: Tahoma; font-size: 16px">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Complemento</label>
                                        <input type="text" name="IMB_IMV_ENDERECOCOMPLEMENTO"class="form-control input-sm" style="font-family: Tahoma; font-size: 16px" value="{{ $imovel->IMB_IMV_ENDERECOCOMPLEMENTO }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Condomínio</label>
                                        <select class="form-control" name="IMB_CND_ID">
                                            <option value='0'>Sem condominio</option>
                                            @foreach ($condominio as $cond)
                                                <option value="{{ $cond->IMB_CND_ID }}" {{ ($cond->IMB_CND_ID == $imovel->IMB_CND_ID) ? 'selected' : null }}>{{ ucwords($cond->IMB_CND_NOME) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Nome Prédio</label>
                                        <input type="text" name="IMB_IMV_PREDIO" class="form-control input-sm" value="{{ $imovel->IMB_IMV_PREDIO }}">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Andar</label>
                                        <input type="text" name="IMB_IMV_ANDAR" class="form-control input-sm" value="{{ $imovel->IMB_IMV_ANDAR ? $imovel->IMB_IMV_ANDAR : '0' }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Bairro</label>
                                        <input type="text" name="CEP_BAI_NOME" class="form-control input-sm" id="bairro" value="{{ $imovel->CEP_BAI_NOME }}" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-grupo">
                                    <div class="col-md-2">
                                        <label>Cep</label>
                                        <div class="input-group">
                                            <input type="text" name="IMB_IMV_ENDERECOCEP" class="form-control input-sm" id="cep" value="{{ $imovel->IMB_IMV_ENDERECOCEP }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Cidade</label>
                                        <input type="text" name="IMB_IMV_CIDADE" class="form-control input-sm" id="cidade" value="{{ $imovel->IMB_IMV_CIDADE }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>UF</label>
                                        <input type="text" name="IMB_IMV_ESTADO" class="form-control input-sm" id="uf" value="{{ $imovel->IMB_IMV_ESTADO }}" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Quadra</label>
                                        <input type="text" name="IMB_IMV_QUADRA" class="form-control input-sm" value="{{ $imovel->IMB_IMV_QUADRA }}">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Lote</label>
                                        <input type="text" name="IMB_IMV_LOTE" class="form-control input-sm" value="{{ $imovel->IMB_IMV_LOTE }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Botões -->
                            <div class="form-actions right">
                                <button type="cancel" class="btn default " id="i-btn-cancelar">Cancelar</button>
                                <button type="submit" class="btn blue " id="i-btn-gravar">
                                    <i class="fa fa-check"></i> Gravar
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_1_1_2">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Imediações</label>
                                    <input type="text" name="IMB_IMV_PROXIMIDADE" class="form-control input-sm" value="{{ $imovel->IMB_IMV_PROXIMIDADE }}">
                                </div>
                            </div>
                        </div>


                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Medida Terreno</label>
                                    <input type="text" name="IMB_IMV_MEDTER"  class="form-control" value="{{ $imovel->IMB_IMV_MEDTER }}" placeholder="ex.: 10x20">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Área Total(m2)</label>
                                    <input type="text" name="IMB_IMV_ARETOT"  class="form-control" value="{{ $imovel->IMB_IMV_ARETOT ? $imovel->IMB_IMV_ARETOT : '0' }}" id="areatotal">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Área Construída(m2)</label>
                                    <input type="text" name="IMB_IMV_ARECON"   class="form-control" value="{{ $imovel->IMB_IMV_ARECON ? $imovel->IMB_IMV_ARECON : '0' }}" id="areacontruida">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Área Útil(apto)(m2)</label>
                                    <input type="text" name="IMB_IMV_AREUTI"  class="form-control" value="{{ $imovel->IMB_IMV_AREUTI ? $imovel->IMB_IMV_AREUTI : '0' }}" id="areautil">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Dorm.</label>
                                    <input type="number" name="IMB_IMV_DORQUA"  
                                    min="0" max="999"
                                    class="form-control input-sm" value="{{ ($imovel->IMB_IMV_DORQUA ? $imovel->IMB_IMV_DORQUA : '0') }}">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">suites</label>
                                    <input type="number" name="IMB_IMV_SUIQUA"   
                                    class="form-control input-sm" value="{{ ( $imovel->IMB_IMV_SUIQUA ? $imovel->IMB_IMV_SUIQUA : '0' ) }}" >
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="checkbox icheck-primary">
                                    <input type="checkbox" name="IMB_IMV_DORAE" {{ ($imovel->IMB_IMV_DORAE == 'S') ? 'checked' : null }}>
                                    <label class="form-check-label">AE</label>
                                </div>

                                <div class="checkbox icheck-primary">
                                    <input type="checkbox" name="IMB_IMV_SUIHID" {{ ($imovel->IMB_IMV_SUIHID == 'S') ? 'checked' : null }}>
                                    <label class="form-check-label">Hidro </label>
                                </div>

                                <div class="checkbox icheck-primary">
                                    <input type="checkbox"  name="IMB_IMV_DORCLO" {{ ($imovel->IMB_IMV_DORCLO == 'S') ? 'checked' : null }}>
                                    <label class="form-check-label">Closet</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Salas</label>
                                    <input type="number" name="IMB_IMV_SALQUA"  class="form-control input-sm" value="{{  ($imovel->IMB_IMV_SALQUA ? $imovel->IMB_IMV_SALQUA : '0') }}">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="checkbox icheck-primary">
                                    <input type="checkbox" name="IMB_IMV_COZINHA" {{ ($imovel->IMB_IMV_COZINHA) ? 'checked' : null }} >
                                    <label class="form-check-label">Cozinha</label>
                                </div>

                                <div class="checkbox icheck-primary">
                                    <input type="checkbox" name="IMB_IMV_COZPLA" {{ ($imovel->IMB_IMV_COZPLA) ? 'checked' : null }} >
                                    <label class="form-check-label">Planejada</label>
                                </div>

                                <div class="checkbox icheck-primary">
                                    <input type="checkbox" name="IMB_IMV_LAVABO" {{ ($imovel->IMB_IMV_LAVABO) ? 'checked' : null }} >
                                    <label class="form-check-label">Lavabo</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="checkbox icheck-primary">
                                    <input type="checkbox"  name="IMB_IMV_EMPQUA" {{ ($imovel->IMB_IMV_EMPQUA) ? 'checked' : null }} >
                                    <label class="form-check-label">Dorm. Empr.</label>
                                </div>
                                <div class="checkbox icheck-primary">
                                    <input type="checkbox"  name="IMB_IMV_EMPWC" {{ ($imovel->IMB_IMV_EMPWC) ? 'checked' : null }} >
                                    <label class="form-check-label">WC Empreg.</label>
                                </div>

                                <div class="checkbox icheck-primary">
                                    <input type="checkbox"  name="IMB_IMV_DESPENSA" {{ ($imovel->IMB_IMV_DESPENSA) ? 'checked' : null }} >
                                    <label class="form-check-label">Despensa</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-1">
                            </div>

                            <div class="col-md-2">
                                <div class="checkbox icheck-primary">   
                                    <input type="checkbox"  name="IMB_IMV_PISCIN" {{ ($imovel->IMB_IMV_PISCIN == 'S') ? 'checked' : null }} >
                                    <label class="form-check-label">Piscina</label>
                                </div>

                                <div class="checkbox icheck-primary">
                                    <input type="checkbox"   name="IMB_IMV_EDICUL" {{ ($imovel->IMB_IMV_EDICUL == 'S') ? 'checked' : null }} >
                                    <label class="form-check-label">Edícula</label>
                                </div>

                                <div class="checkbox icheck-primary">
                                    <input type="checkbox"   name="IMB_IMV_QUINTA" {{ ($imovel->IMB_IMV_QUINTA == 'S') ? 'checked' : null }} >
                                    <label class="form-check-label">Quintal</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="checkbox icheck-primary">
                                    <input type="checkbox"   name="IMB_IMV_CHURRA" {{ ($imovel->IMB_IMV_CHURRA == 'S') ? 'checked' : null }} >
                                    <label class="form-check-label">Churrasqueira</label>
                                </div>

                                <div class="checkbox icheck-primary">
                                    <input type="checkbox"   name="IMB_IMV_PORELE" {{ ($imovel->IMB_IMV_PORELE == 'S') ? 'checked' : null }} >
                                    <label class="form-check-label">Portão Eletr.</label>
                                </div>

                                <div class="checkbox icheck-primary">
                                    <input type="checkbox"   name="IMB_IMV_SAUNA" {{ ($imovel->IMB_IMV_SAUNA == 'S') ? 'checked' : null }} >
                                    <label class="form-check-label">Sauna</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="checkbox icheck-primary">
                                    <input type="checkbox"   name="IMB_IMV_QUADRAPOLIESPORTIVA" {{ ($imovel->IMB_IMV_QUADRAPOLIESPORTIVA) ? 'checked' : null }} >
                                    <label class="form-check-label">Quadra</label>
                                </div>

                                <div class="checkbox icheck-primary">
                                    <input type="checkbox" name="IMB_IMV_SALFES" {{ ($imovel->IMB_IMV_SALFES == 'S') ? 'checked' : null }} >
                                    <label class="form-check-label">Salão Festas</label>
                                </div>

                                <div class="checkbox icheck-primary">
                                    <input type="checkbox" name="IMB_IMV_PLAGRO" {{ ($imovel->IMB_IMV_PLAGRO == 'S') ? 'checked' : null }} >
                                    <label class="form-check-label">Playground</label>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="control-label">Vagas Cobertas</label>

                                    <input type="number" name="IMB_IMV_GARCOB"   class="form-control" value="{{ $imovel->IMB_IMV_GARCOB ? $imovel->IMB_IMV_GARCOB : '0' }}" >
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="control-label">Vagas Descob.</label>
                                    <input type="number" name="IMB_IMV_GARDES"  class="form-control" value="{{ $imovel->IMB_IMV_GARDES  ? $imovel->IMB_IMV_GARDES : '0' }}" >
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label"><br>Idade Imóvel</label>
                                    <input type="text" name="IMB_IMV_IDADE" class="form-control" value="{{ $imovel->IMB_IMV_IDADE }}" >
                                </div>
                            </div>
                        </div>

                        <div class="form-actions right">
                            <button type="cancel" class="btn default" id="i-btn-cancelar-2">Cancelar</button>
                            <button type="submit" class="btn blue " id="i-btn-gravar-2">
                                <i class="fa fa-check"></i> Gravar
                            </button>
                        </div>

                    </div>

                    <div class="tab-pane" id="tab_1_1_3">
                    <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Obsevações do Imóvel(Uso interno)
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                </div>
                            </div>

                            <div class="portlet-body form">
                                <div class="form-body" ></div>
                                <div class="form-actions text-center">
                                    <textarea rows="10" name="IMB_IMV_OBSERV" style="min-width: 100%">{{$imovel->IMB_IMV_OBSERV}}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Obsevações na Internet(no site)
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                </div>
                            </div>

                            <div class="portlet-body form">
                                <div class="form-body" ></div>
                                <div class="form-actions text-center">
                                    <textarea rows="10" name="IMB_IMV_OBSWEB" style="min-width: 100%">{{$imovel->IMB_IMV_OBSWEB}}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions right">
                            <button type="cancel" class="btn default" id="i-btn-cancelar-2">Cancelar</button>
                            <button type="submit" class="btn blue " id="i-btn-gravar-2">
                                <i class="fa fa-check"></i> Gravar
                            </button>
                        </div>
                    </div>


                    <div class="tab-pane" id="tab_1_1_4">

                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Imagens
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                </div>
                            </div>

                            <div class="portlet-body form">
                                <div class="form-body" id="galeria-imovel"></div>
                                @foreach( $imagens as $img )
                                    <div class="col-sm-3 shadow">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Imagem {{$img->IMB_IMG_ID}} </h5>
                                                <p class="card-text"></p>
                                                <a href="#" class="btn btn-primary">d</a>
                                             </div>
                                        </div>
                                    </div>                                    
                                    @endforeach



                                    <div class="form-actions text-center">
                                        <input type="file" id="galeria-imagem-upload" accept="image/*" capture="camera" style="visibility: hidden;">
                                        <button type="button" id="galeria-imagem-btn" class="btn btn-primary"><i class="fa fa-camera-retro"></i> Fazer Upload / Tirar Foto</button>
                                        <div id="progress-wrp">
                                            <div class="progress-bar"></div>
                                            <div class="status">0%</div>
                                        </div>
                                    </div>
                                <div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="propModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Proprietário do Imóvel
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
                </div>
                <div class="portlet-body form">
                <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                            <label class="control-label">Sugestão</label>
                                <input type="text" id="i-str"  class="form-control">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="control-label"></label>
                                <button class="btn btn-primary" onClick="buscaIncremental()">Carregar Sugestões</button>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <select id="selclientelike">
                                </select>
                            </div>
                        </div>
                    </div>
    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" onClick="selecionarCliente()">Selecionar</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('script')
    <script type="text/javascript">
    
        $("#frmCadastro :input").prop("disabled", false);
    </script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>


        $(document).ready( function(){

            $("#galeria-imagem-upload").on("change", function (e) {
                var file = $(this)[0].files[0];
                var upload = new Upload(file);
                console.log('up');
                upload.doUpload();
            });
            $("#galeria-imagem-btn").click(function(){
                $("#galeria-imagem-upload").click();
            });
            

            $('#selcliente').select2(
            {/*
                ajax:{

                    url:'/pesquisarcliente',
                    type: 'post',
                    dataType: 'json',
                    delay:250,
                    data: function( params ){
                        return {
                            searchTerm: params.term
                        };
                    } ,
                    processResults: function( response)
                    {
                        return{
                            results: response   
                        };
                    },
                    cache: true
                }
                */
            });
        })  

        function selecionarCliente()
        {
            var clienteselecionado = $("#selclientelike").val();
            $("#IMB_CLT_ID").val( clienteselecionado);
            $("#propModal").modal('hide');
            nomeprop = $('#selclientelike').find(":selected").text();
            $("#nomeprop").val( nomeprop ); 
            
        }
        
        function alterarProp()
        {
            var prop = $("#nomeprop").val();
            $("#propModal").modal('show');
            $("#i-str").val( prop );
            buscaIncremental();

        }
        function buscaIncremental()
        {
            str = $("#i-str").val();
            $.getJSON( '/pesquisarcliente/'+str, function( data)
            {
                linha = "";
                $("#selclientelike").empty();
                for( nI=0;nI < data.length;nI++)
                {
                    linha = 
                        '<option value="'+data[nI].IMB_CLT_ID+'">'+
                        data[nI].IMB_CLT_NOME+"</option>";
                    $("#selclientelike").append( linha );
                        
                }
                console.log( linha );

            });
            
        }
     </script>

@endpush