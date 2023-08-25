@extends('layout.app')

@push('script')
<script src="{{asset('/js/upload.js')}}" type="text/javascript"></script>
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
                url: "/imovel/imagem/4897/upload"
            });
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
                <ul class="nav nav-pills nav-justified">
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
                    <li>
                        <a href="#tab_1_1_5" data-toggle="tab">Corretor/Captador</a>
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
                                        <input type="hidden" id="i-unidade" value ="{{$imovel->IMB_IMB_ID2}}">
                                        <label class="control-label">Unidade</label>
                                        <select class="form-control" name="IMB_IMB_ID" id="i-select-unidade">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label>Tipo de Imóvel</label>
                                        <input type="hidden" value="{{$imovel->IMB_TIM_ID}}" id="i-tipoimovel">
                                        <select class="form-control" name="IMB_TIM_ID" id="i-select-tipoimovel">
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


                    </form>

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


                                    <table class="table" id="tblimagens">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th >Titulo</th>
                                                <th width="250" >Imagem</th>
                                                <th width="250" 
                                                    style="text-align:center"
                                                    > Ações </th>
                                            </tr>
                                        </thead>
                                        <tbody>
<!--                                            @foreach( $imagens as $img)


                                            <tr>
                                                <td style="text-align:center"
                                                    valign="center">{{$img->IMB_IMG_NOME}}
                                                </td>
                                                <td><img class="card-img-top" 
                                                    src="/images/imoveis/{{ $img->IMB_IMV_ID}}/thumbnail/thumb_{{$img->IMB_IMG_ARQUIVO}}" >
                                                </td>
                                                <td style="text-align:center"
                                                    valign="center"> 
                                                    <a href="#" 
                                                    class="btn btn-sm btn-primary">Editar</a>
                                                    <a href="#" 
                                                        class="btn btn-sm btn-danger">Excluir</a>
                                                    @if( $img->IMB_IMG_PRINCIPAL=='S' )
                                                    <a href="#" 
                                                        class="btn btn-sm btn-default">Principal</a>
                                                    @endif
                                                    @if( $img->IMB_IMG_PRINCIPAL<>'S' )
                                                    <a href="#" 
                                                        class="btn btn-sm btn-warning">Definir</a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
-->                                        
                                        </tbody>
                                    </table>
                            </div>

                            <form action="/upload" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="image-editor">
                                    <input type="hidden"  name="id" value="{{$imovel->IMB_IMV_ID}}" id='i-imv-id'>
                                    <input type="file"  class="custom-file-input" id="arquivo" name="arquivo[]" multiple>
                                    <button type="submit">Enviar</button>
                                </div>
                                </form>     


                        </div>
                    </div>

                    <div class="tab-pane" id="tab_1_1_5">

                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Corretor
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                </div>
                            </div>

                            <div class="portlet-body form">
                                <div class="form-body" id="galeria-imovel"></div>
                                    <table  id="tbcorimo" class="table table-striped table-bordered table-hover" >
                                    <thead class="thead-dark">
                                        <tr>
                                            <th style="text-align:center"> Nome </th>
                                            <th width="100" style="text-align:center"> Percentual </th>
                                            <th width="200" style="text-align:center"> Ações </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            <div class="table-footer" >
                                <a  class="btn btn-sm btn-primary" 
                                role="button" onClick="modalCorretor()" >
                                Adicionar Corretor </a>
                                <!--data-toggle="modal" data-target="#modalFormaPagamento"-->
                            </div>                            

                            </div>



                        </div>

                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Captador
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                </div>
                            </div>

                            <div class="portlet-body form">
                                <div class="form-body" id="galeria-imovel"></div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
    </div>
</div>

<!--modal CORIMO -->
<div class="modal" tabindex="-1" role="dialog" id="modalcorimo">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Corretor do Imóvel
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
                </div>
                    <form class="form-horizontal" id="formCorImo">
                        <input type="hidden" id="i-idcorimo" >
                        <input type="hidden" id="i-idimovel" name="IMB_IMV_ID" 
                                                value="{{$imovel->IMB_IMV_ID}}">
                        <input type="hidden" id="i-idempresa" name="IMB_IMB_ID"
                                               value="{{$imovel->IMB_IMB_ID}}">
                        <div class="portlet-body form">
                            <div class="form-body" >
                                <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Corretor</label>
                                            <select class="form-control" id="i-select-corretor" name="IMB_ATD_ID">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Percentual</label>
                                            <input type="numeric" id="i-percentual" min="1" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        <div class="modal-footer">
                            <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="submmit" class="btn btn-primary">Salvar mudanças</button>
                        </div>
                    </form>
            
                
            </div>
        </div>
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

        $.ajaxSetup({
            headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"

            }

        });



 
        $(document).ready( function(){

            $("#galeria-imagem-upload").on("change", function (e) {
                var file = $(this)[0].files[0];
                var upload = new Upload(file);
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

            });
            
        }



        function editarCorImo( id )
        {

            $.getJSON( '/api/corimo/'+id, function( data)
            {
                $("#i-idcorimo").val(data.IMB_CORIMO_ID);
                $("#i-idempresa").val(data.IMB_IMB_ID);
                $("#i-idimovel").val(data.IMB_IMV_ID);
                $("#i-percentual").val(data.IMB_CORIMO_PERCENTUAL);
//                setarSelectCorretor(data.IMB_ATD_ID);
//                alert($("#i-idcorimo").val());
                modalCorretor();            
            });
        }


        
        function CarregarCorImo()
        {
            str = $("#i-imv-id").val();
            $.getJSON( '/corimo/'+str, function( data)
            {
                linha = "";
                $("#tbcorimo>tbody").empty();
                for( nI=0;nI < data.length;nI++)
                {
                    linha = 
                    '<tr>'+
                    '   <td>'+data[nI].IMB_ATD_NOME+'</td>'+
                    '   <td>'+data[nI].IMB_CORIMO_PERCENTUAL+'</td>'+
                    '   <td style="text-align:center"> '+
                    '<a  class="btn btn-sm btn-primary" href=javascript:editarCorImo('+data[nI].IMB_CORIMO_ID+')>Editar</a>&nbsp;&nbsp;&nbsp;&nbsp;'+
//                    '           <button class="btn btn-sm btn-primary" onclick="editarCorImo('+data[nI].IMB_CORIMO_ID+' )">Editar</button>'+ 
//                    '           <button class="btn btn-sm btn-danger" onclick="apagarCorImo('+data[nI].IMB_CORIMO_ID+' )">Apagar</button>'+ 
                    '<a  class="btn btn-sm btn-danger" href=javascript:apagarCorImo('+data[nI].IMB_CORIMO_ID+')>     Apagar</a>'+
                    '   </td>'+
                    '</tr>';

                    $("#tbcorimo").append( linha );
                        
                }
                
            });
            


        }


        //área de IMAGENS
        function CarregarImagens()
        {
            str = $("#i-imv-id").val();
            console.log(str);
            $.getJSON( '/imagens/'+str, function( data)
            {
                linha = "";
                $("#tblimagens>tbody").empty();
                for( nI=0;nI < data.length;nI++)
                {
                    var nome = data[nI].IMB_IMG_NOME;
                    if( nome == null)
                        nome = "";
                    linha = 
                        '<tr>'+
                        '<td style="text-align:center valign="center">'+nome+'</td>' +
                        '<td><img class="card-img-top" src="/images/imoveis/'+
                                data[nI].IMB_IMV_ID+'/thumbnail/thumb_'+data[nI].IMB_IMG_ARQUIVO+'"></td>'+
                        '<td style="text-align:center" valign="center"> '+
                            '<a href="#" class="btn btn-sm btn-primary">Editar</a> '+
                            '<a href=javascript:apagarImagem('+data[nI].IMB_IMG_ID+') class="btn btn-sm btn-danger">Excluir</a> ';

                        if( data[nI].IMB_IMG_PRINCIPAL !='S')
                            linha = linha + 
                                '<a href=javascript:imagemPrincipal('+data[nI].IMB_IMV_ID+','+
                                data[nI].IMB_IMG_ID+') class="btn btn-sm btn-default">Definir</a> '+
                            '</td> ';
                        else
                            linha = linha + 
                                '<a class="btn btn-sm btn-success">Definida</a> '+
                            '</td> ';

                        linha = linha +
                        '</tr>';
                    
                    $("#tblimagens").append( linha );
                        
                }
                
            });

        }

        CarregarImagens();

        function imagemPrincipal( idimovel, idimagem)
        {
            
            $.ajax(
                    {
                        type: "get",
                        url: "/imagens/principal/"+idimovel+'/'+idimagem,
                        context: this,
                        success: function()
                        {
                            CarregarImagens();
            
                        },
                        error: function( error )
                        {
                            console.log(error);
                        }

                    });


        }

        function apagarImagem( id )
        {
            if (confirm("Tem certeza que deseja excluir a Imagem?")) 
            {
    
                $.ajax(
                    {
                        type: "delete",
                        url: "/api/imagem/"+id,
                        context: this,
                        success: function(){
                            CarregarImagens();
            
                        },
                        error: function( error ){
                            console.log(error);
                        }

                    }
                );
            }

        }


        //FINAL AREA IMAGENS

        function apagarCorImo( id )
        {
            if (confirm("Tem certeza que deseja excluir?")) 
            {
    
                $.ajax(
                    {
                        type: "delete",
                        url: "/api/corimo/"+id,
                        context: this,
                        success: function(){
                            CarregarCorImo();
            
                        },
                        error: function( error ){
                            console.log(error);
                        }

                    }
                );
            }

        }



        function modalCorretor()
        {
            $("#modalcorimo").modal('show');
            preencherCBCorretores();
        }

        function preencherCBCorretores()
        {
            $.getJSON( '/carregaratd', function( data )
            {
                linha = "";
                $("#i-select-corretor").empty();
                for( nI=0;nI < data.length;nI++)
                {
                    linha = 
                        '<option value="'+data[nI].IMB_ATD_ID+'">'+
                        data[nI].IMB_ATD_NOME+"</option>";
                    $("#i-select-corretor").append( linha );
                        
                }

            });
            
        }

        function criarCorImo()
        {
            corimo = 
            {
                IMB_IMB_ID : $("#i-idempresa").val(),
                IMB_IMV_ID : $("#i-idimovel").val(),
                IMB_ATD_ID : $("#i-select-corretor").val(),
                IMB_CORIMO_PERCENTUAL : $("#i-percentual").val()
            };

            $.post("/api/corimo", corimo, function(data){
                $("#modalcorimo").modal("hide");
            });


        };
        

        function salvarCorImo()
        {
            corimo = 
            {
                IMB_CORIMO_ID : $("#i-idcorimo").val(),
                IMB_IMB_ID : $("#i-idempresa").val(),
                IMB_IMV_ID : $("#i-idimovel").val(),
                IMB_ATD_ID : $("#i-select-corretor").val(),
                IMB_CORIMO_PERCENTUAL : $("#i-percentual").val()
            };

            $.ajax(
                    {
                        type: "put",
                        url: "/api/corimo/"+corimo.IMB_CORIMO_ID,
                        context: this,
                        data: corimo,
                        success: function(data){
                            $("#modalcorimo").modal("hide");
                            console.log( data);
                            CarregarCorImo();
            
                        },
                        error: function( error ){
                            console.log(error);
                        }

                    }
                );

        }

        $("#formCorImo").submit
        ( function( event )
		{ 
    		event.preventDefault();
            //alert($("#i-idcorimo").val());
            if( $("#i-idcorimo").val() != '' )
                salvarCorImo();
            else
		        criarCorImo();

            CarregarCorImo();
            
         });

       CarregarCorImo();
       preencherUnidades();
       preencherTipoImovel();

       function setarSelectCorretor(id)
        {   
	        var combo = document.getElementById("i-select-corretor");


            console.log('entrei')    ;
	        for (var i = 0; i < combo.options.length; i++)
	        {
                console.log(combo.option[i].value);
		        
                if (combo.options[i].value == id)
		        {
			        combo.options[i].selected = "true";
			        break;
		        }
	        }
        }
        function preencherUnidades()
        {

            $.getJSON( '/imobiliaria/carga', function( data )
            {
                nId =$("#i-unidade").val();


                $("#i-select-unidade").empty();
                
                linha =  '<option value="0">Todas Unidades</option>';
                $("#i-select-unidade").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha = 
                    '<option value="'+data[nI].IMB_IMB_ID+'">'+
                        data[nI].IMB_IMB_NOME;
                    linha = linha + "</option>";
                        $("#i-select-unidade").append( linha );
                       
                }

                $("#i-select-unidade").val( nId );

            });
            
        }

        function preencherTipoImovel()
        {

            $.getJSON( '/tipoimovel/carga', function( data )
            {
                nId = $("#i-tipoimovel").val();
console.log('tipo '+nId );

                $("#i-select-tipoimovel").empty();
                for( nI=0;nI < data.length;nI++)
                {
                    linha = 
                    '<option value="'+data[nI].IMB_TIM_ID+'">'+
                        data[nI].IMB_TIM_DESCRICAO;
                    linha = linha + "</option>";
                        $("#i-select-tipoimovel").append( linha );
                       
                }

                $("#i-select-tipoimovel").val( nId );

            });
            
        }




     </script>
    <script>
    </script>
@endpush