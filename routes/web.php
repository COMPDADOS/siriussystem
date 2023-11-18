<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get( 'bbtoken', 'APIController@token' )->name('bbtoken');
Route::get( 'bbregistrar', 'APIController@registrar' )->name('bbregistrar');
Route::get( 'bblistar', 'APIController@listar' )->name('bblistar');
Route::get( 'bbconsultar', 'APIController@consultar' )->name('bbconsultar');
Route::get( 'bbbaixar', 'APIController@baixar' )->name('bbbaixar');
Route::get( 'bbatualizar', 'APIController@atualizar' )->name('bbatualizar');


Route::get('/whatsapp/init', 'ctrWhatsApp@instanceInit')->name('whastapp.instance');
Route::get('/whatsapp/scanqrcode', 'ctrWhatsApp@scanearQrCode')->name('whastapp.scanqrcode');
Route::get('/whatsapp/logout', 'ctrWhatsApp@logout')->name('whastapp.logout');
Route::get('/whatsapp/resetar', 'ctrWhatsApp@resetar')->name('whastapp.resetar');
Route::get('/whatsapp/enviarmsg', 'ctrWhatsApp@enviarMsg')->name('whastapp.enviarmsg');
Route::get('/whatsapp/trocadas/carga', 'ctrWhatsApp@mensagensTrocadas')->name('whastapp.mensagenstrocadas');
Route::get('/whatsapp/boletos/hoje', 'ctrWhatsApp@enviarBolVenHojeWhatsapp')->name('whastapp.boletoshoje');

Route::get('/whatsapp/trocadas/index', function()
{    return view( 'whatsapp.wsmensagens');
})->name('whatsapp.index');

Route::get('/testeofx', 'ctrTeste@ofx');
Route::get('/jonfilecli', 'ctrTeste@lerJson');
Route::get('/jonfileimv', 'ctrTeste@lerJsonImv');

Route::get('/testeb2', 'ctrTeste@banco2');
Route::get('/testecss', 'ctrTeste@testeCss');
Route::get('/testexml', 'ctrTeste@lerXml')->name('testexml');
Route::get('/testecriarrequest', 'ctrTeste@criarRequest')->name('testerequest');
Route::get('/dropzone2', 'ctrTeste@dragDrop')->name('dd');
Route::post( 'dropzone2/upload', 'ctrImagem@uploadDropZone')->name('dropzone.upload');

Route::post('/conciliacaobancaria/lerretorno/passo2', 'ctrLanctoCaixa@conciliacaoArquivoPasso2')->name('conciliacao.passo2');

Route::get( 'gerarnfexml', 'ctrIntegraNota@gerarXML')->name('gerarnfexml');
Route::get( 'gerarnfepdf', 'ctrIntegraNota@gerarPdf')->name('gerarnfepdf');
Route::post( 'cancelanfes', 'ctrIntegraNota@cancelaNfes')->name('cancelanfes');
Route::post( 'gerarnfes', 'ctrIntegraNota@gerarNfs')->name('gerarnfes');
Route::get( 'listarnfes', 'ctrIntegraNota@listNotas')->name('listarnfes');
Route::get( 'nfe/index', 'ctrIntegraNota@index')->name('nfe.index');

//parametrização
Route::get('/teste', function()
{
    return view('clicksign.teste');
});

Route::get('/testevariavel', 'ctrTeste@variavel');



Route::get('/portalcliente', 'ctrClienteAcesso@portal')->name('portalcliente');


//parametrização
Route::get('/param', 'ctrParametrizacao@index')->name('parametrizacao.index');
Route::get('/parametros1', 'ctrParametrizacao@pegarParametros1')->name('parametros1');

Route::get('/abastecerBairros', 'ctrRotinas@abastecerBairros')->name('abastecerbairros');


Route::get('/bancos/dist', 'ctrRedeBancaria@cargaDistinct')->name('bancos.distinct');
Route::get('/bairros/{nome?}', 'ctrRotinas@pegarBairros')->name('bairros.carga');


Route::get('/acesso', 'ctrAcesso@indexGeral')->name('acesso.geral');
Route::get('/acesso/criar', 'ctrAcesso@criaracesso')->name('acesso.criaracesso');
Route::get('/acesso/checaremail/{email?}', 'ctrAcesso@checarEmail')->name('acesso.checaremail');
Route::post('/acesso/gerarusuario', 'ctrAcesso@gerarUsuario')->name('acesso.gerarusuario');

Route::get('/dashboard/comercial/panorama', 'ctrDashboard@panorama')->name('dashboard.comercial.panorama');
Route::get('/dashboard/comercial/imoveisativos', 'ctrDashboard@imoveisAtivos')->name('dashboard.comercial.imoveisativos');
Route::get('/dashboard/comercial/totalimoveisdestaque', 'ctrDashboard@totalImoveisDestaque')->name('totalimoveisdestaque');
Route::get('/dashboard/comercial/ativosforadosite', 'ctrDashboard@meusAtivosForadoSite')->name('meusativosforadosite');
Route::get('/dashboard/comercial/imoveistotal', 'ctrDashboard@imoveisTotal')->name('imoveistotal');



Route::get('/metas/{idimb?}/{idage?}/{idatd?}', 'ctrMetas@metaGeral')->name('metas.carga');
Route::get('/metasagencia/{imb?}/{idimb2?}', 'ctrMetas@metaAgencia')->name('metas.carga');

Route::get('/historico/imovel/{iid?}', 'ctrHistoricoImovel@carga')->name('historicoimovel.carga');
Route::get('/historico/find/{id?}', 'ctrHistoricoImovel@find')->name('historicoimovel.find');



Route::get('/portais/carga/{id?}', 'ctrPortais@carga')->name('portais.carga');
Route::get('/portais/list', 'ctrPortais@list')->name('listarportais');
Route::get('/portais', 'ctrPortais@index')->name('portais');
Route::get('/portais/editar/{id?}', 'ctrPortais@show')->name('portais.editar');
Route::post('/portais/store', 'ctrPortais@store')->name('portais.novo');
Route::post('/portais/update', 'ctrPortais@update')->name('portais.salvar');
Route::post('/portais/destroy/{id?}', 'ctrPortais@destroy')->name('portais.apagar');
Route::post('/portais/imovel', 'ctrImovelPortal@store')->name('portalimovel.gravar');
Route::get('/portais/imovel/carga/{id?}', 'ctrImovelPortal@carga')->name('portalimovel.carga');
Route::post('/portais/imovel/apagar/{id?}', 'ctrImovelPortal@destroy')->name('portalimovel.apagar');
Route::get('/portais/replicar/{id?}', 'ctrImovelPortal@replicarTodosImoveis')->name('portalimovel.replicarimoveis');


//ROTINAS AUXILIARES
Route::get('/pegaatendente/{email?}', 'ctrAtendente@localizarAtd')->name('pegaratendente');
Route::get('/pegacodigounidadeatd/{id?}', 'ctrAtendente@codigoUnidadeAtd')->name('pegarcoduniatd');
Route::get('/peganomeunidadeatd/{id?}', 'ctrAtendente@nomeUnidadeAtd')->name('pegarnomuniatd');
Route::get('/setsession/{id?}/{empresanome?}', 'ctrAtendente@nomeUnidadeAtd')->name('setsession');

Route::get('/imobiliaria/find/{id?}', 'ctrImobiliaria@pegarImobiliaria')->name('pegarimobiliaria');
Route::get('/imobiliaria/findagencia/{id?}', 'ctrImobiliaria@pegarImobiliaria')->name('pegaragencia');
Route::get('/imobiliaria/carga/{id?}', 'ctrImobiliaria@carga')->name('imobiliaria.carga');
Route::post('/imobiliaria/store', 'ctrImobiliaria@store')->name('imobiliaria.store');
Route::get('/clienteanexo/carga/{id?}', 'ctrClienteAnexo@carga')->name('clienteanexo.carga');

Route::get('/fornecedores/list', 'ctrEmpresa@list')->name('fornecedores.list');
Route::get('/fornecedores', 'ctrEmpresa@index')->name('fornecedores.index');
Route::post('/fornecedores/salvar', 'ctrEmpresa@salvar')->name('fornecedores.salvar');
Route::get('/fornecedores/find/{id?}', 'ctrEmpresa@find')->name('fornecedores.find');
Route::get('/fornecedores/findjson/{id?}', 'ctrEmpresa@findJson')->name('fornecedores.findjson');

Route::get('/fornecedores/buscarcnpj/{cnpj?}', 'ctrEmpresa@porCnpj')->name('fornecedores.cnpj');

Route::get('/contasapagar',function()
{
    return view('contasapagar.lancamentoscp');
})->name('contasapagar');
Route::post('/contasapagar/salvarnovo', 'ctrContasPagar@store')->name('contaspagar.gravarnovo');
Route::get('/contasapagar/list', 'ctrContasPagar@list')->name('contaspagar.list');
Route::get('/contasapagar/totalizar', 'ctrContasPagar@totalizar')->name('contaspagar.totalizar');
Route::get('/contasapagar/buscar/{id?}', 'ctrContasPagar@buscar')->name('contaspagar.buscar');
Route::post('/contasapagar/desativar/{id?}', 'ctrContasPagar@desativar')->name('contaspagar.desativar');
Route::post('/contasapagar/baixar/{id?}', 'ctrContasPagar@baixar')->name('contaspagar.baixar');



Route::get('/calendario', 'ctrCalendar@index')->name('calendar.index');
Route::get('/calendario/carga', 'ctrCalendar@carga')->name('calendar.carga');
Route::post('/calendario/salvar', 'ctrCalendar@salvar')->name('calendar.salvar');


Route::get('/modulo/edit/{id?}', 'ctrModulo@edit')->name('modulo.edit');
Route::get('/modulo/delete/{id?}', 'ctrModulo@destroy')->name('modulo.delete');
Route::get('/modulo/show/{id?}', 'ctrModulo@show')->name('modulo.show');
Route::get('/modulo/new', 'ctrModulo@novo')->name('modulo.new');
Route::get('/modulo', 'ctrModulo@index')->name('modulo.index');
Route::get('/modulo/carga/{idmaster?}', 'ctrModulo@carga')->name('modulo.carga');
Route::post('/modulo/store', 'ctrModulo@store')->name('modulo.store');
Route::post('/modulo/update', 'ctrModulo@update')->name('modulo.update');
Route::get('/modulo/list/{page?}/{busca?}', 'ctrModulo@list')->name('modulo.list');
Route::get('/modulo/count/{busca?}', 'ctrModulo@countRecords')->name('modulo.count');

Route::get('/perfil', 'ctrPerfilUso@index')->name('perfil.index');
Route::get('/perfil/carga', 'ctrPerfilUso@carga')->name('perfil.carga');
Route::get('/perfil/buscar/{id?}', 'ctrPerfilUso@buscar')->name('perfil.buscar');
Route::post('/perfil/apagar/{id?}', 'ctrPerfilUso@apagar')->name('perfil.apagar');
Route::post('/perfil/salvar', 'ctrPerfilUso@salvar')->name('perfil.salvar');


Route::get('/direitos/carga/{id?}', 'ctrDireitos@carga')->name('direito.carga');
Route::post('/direitos/gerar/{idorigem?}/{iddestino?}', 'ctrDireitos@gerar')->name('direito.gerar');
Route::get('/direitos/{id?}', 'ctrDireitos@index')->name('direito.index');
Route::get('/direitos/checar/{id?}/{modulo?}/{opcao?}', 'ctrDireitos@checar')->name('direito.checar');


Route::get('/atendentedireitos/carga', 'ctrAtendenteDireitos@carga')->name('atendentedireito.carga');
Route::post('/atendentedireitos/permitir/{id?}/{permissao?}', 'ctrAtendenteDireitos@permitir')->name('atendentedireitodireito.permitir');
Route::post('/atendentedireitos/negar/{id?}/{permissao?}', 'ctrAtendenteDireitos@negar')->name('atendentedireitodireito.negar');
Route::post('/atendentedireitos/gerandopermissoesbase', 'ctrAtendenteDireitos@gerandoPermissoesBase')->name('atendentedireitodireito.permissaobase');



Route::get('/atendente', 'ctrAtendente@index')->name('atendente.index');
Route::get('/atendente/new', 'ctrAtendente@novo')->name('atendente.novo');
Route::get('/atendente/list/{empresa?}/{page?}/{busca?}/{somenteativos?}', 'ctrAtendente@list')->name('atendente.list');
Route::get('/atendente/carga/{empresa?}/{status?}', 'ctrAtendente@buscaTodosJson')->name('atendente.carga');
Route::get('/atendente/count/{empresa?}/{status?}', 'ctrAtendente@countRecords')->name('atendente.count');
Route::get('/atendente/cargaativos', 'ctrAtendente@cargaAtivos')->name('atendente.cargaativos');

Route::get('/atendente/find/{id?}', 'ctrAtendente@find')->name('atendente.find');
Route::get('/atendente/edit/{id?}', 'ctrAtendente@edit')->name('atendente.edit');
Route::get('/atendente/email/{email?}', 'ctrAtendente@findEmail')->name('atendente.findemail');
Route::post('/atendente/store', 'ctrAtendente@store')->name('atendente.store');
Route::post('/atendente/update', 'ctrAtendente@update')->name('atendente.update');
Route::post('/atendente/updpwd', 'ctrAtendente@alterarSenha')->name('atendente.updpwd');
Route::post('/atendente/desativar', 'ctrAtendente@desativar')->name('atendente.desativar');

Route::post('/atendente/perfillead/gravar', 'ctrAtendente@gravarPerfilAtd')->name( 'atendente.perfilatendimento.gravar');
Route::get('/atendente/perfillead/{id?}', 'ctrAtendente@atendentePerfilLead')->name( 'atendente.perfilatendimento');
Route::get('/atendente/perfilleadneg/{id?}', 'ctrAtendente@perfilAtmNegocio')->name( 'atendente.perfilatendimentoneg');
Route::get('/atendente/perfilleadtipimo/{id?}', 'ctrAtendente@perfilAtmTipoImovel')->name( 'atendente.perfilleadtipimo');
Route::get('/atendente/perfilleadcondom/{id?}', 'ctrAtendente@perfilAtmCondominio')->name( 'atendente.perfilleadcondom');
Route::get('/atendente/perfilleadbairro/{id?}', 'ctrAtendente@perfilAtmBairro')->name( 'atendente.perfilleadbairro');
Route::post('/atendente/perfil/apagarprefis/{id?}', 'ctrAtendente@apagarPerfis')->name( 'atendente.perfil.apagarperfis');

Route::get('/status/carga/{empresa?}', 'ctrStatusImovel@carga')->name('status.carga');


Route::get('formapagamento/formapagamento', 'ctrFormaPagamento@indexView')->name('formasdepagamento');
Route::get('formapagamento/carga', 'ctrFormaPagamento@carga')->name( 'formapagamento.carga');

Route::get('/condominio', 'ctrCondominio@index')->name('condominio.index');
Route::get('/condominio/carga/{empresa?}', 'ctrCondominio@carga')->name('condominio.carga');
Route::post('/condominio/apagar/{id?}', 'ctrCondominio@destroy')->name('condominio.apagar');
Route::get('/condominio/buscar/{id?}', 'ctrCondominio@buscar')->name('condominio.buscar');
Route::post('/condominio/salvar', 'ctrCondominio@salvar')->name('condominio.salvar');
Route::get('/condominio/pesquisar/{texto?}/{empresa?}', 'ctrCondominio@pesquisar')->name('condominio.pesquisar');
Route::post('/condominio/transferirimoveis', 'ctrCondominio@tranferirImoveisCondominios')->name('condominio.transfimoveis');

Route::get('/admcon', 'ctrAdmCondominio@index')->name('admcon.index');
Route::get('/admcon/buscar/{id?}', 'ctrAdmCondominio@buscar')->name('admcon.buscar');
Route::post('/admcon/salvar', 'ctrAdmCondominio@salvar')->name('admcon.salvar');
Route::get('/admcon/pesquisar/{texto?}/{empresa?}', 'ctrAdmCondominio@pesquisar')->name('admcon.pesquisar');
Route::post('/admcon/apagar/{id?}', 'ctrAdmCondominio@destroy')->name('admcon.apagar');

Route::get('/telefone/carga/{id?}', 'ctrTelefone@carga')->name('telefone.carga');
Route::get('/telefone/apagar/{id?}', 'ctrTelefone@destroy')->name('telefone.apagar');
Route::post('/telefone/salvar/{ìdtelefone?}/{idcliente?}/{ddd?}/{numero?}/{tipo?}', 'ctrTelefone@store')->name('telefone.salvar');
Route::post('/telefone/salvarcomddi/{id?}/{ddi?}/{ddd?}/{numero?}/{tipo?}', 'ctrTelefone@gravarComDDI')->name('telefone.salvarcomddi');
Route::post('/telefone/salvarlote', 'ctrTelefone@salvarLote')->name('telefone.salvarlote');
Route::get('/telefone/edit/{id?}', 'ctrTelefone@edit')->name('telefone.edit');
Route::get('/telefone/envolvidos/{id?}', 'ctrTelefone@telefoneEnvolvidosContrato')->name('telefone.envolvidos');
Route::post('/telefone/edit/salvar', 'ctrTelefone@editSalvar')->name('telefone.editsalvar');
/*
Route::get('formapagamento/formapagamento/new', 'ctrFormaPagamento@create');
Route::post('formapagamento/formapagamento', 'ctrFormaPagamento@store');
Route::post('formapagamento/formapagamento/{id}', 'ctrFormaPagamento@update');
Route::get('formapagamento/formapagamento/apagar/{id}', 'ctrFormaPagamento@destroy');
Route::get('formapagamento/formapagamento/editar/{id}', 'ctrFormaPagamento@edit');
Route::get('formapagamento/formapagamento/vereapagar/{id}', 'ctrFormaPagamento@vereapagar');
*/


Route::get('/corretores/cliente/{idcliente?}', 'ctrClienteUsuario@corretorCliente')->name('cliente.corretores');
Route::post('/corretores/cliente/gravar', 'ctrClienteUsuario@novo')->name('cliente.corretores.salvar');
Route::post('/corretores/cliente/deletar', 'ctrClienteUsuario@deletar')->name('cliente.corretores.deletar');

Route::get('/cliente/carga', 'ctrCliente@carga')->name('cliente.carga');
Route::get('/pesquisarcliente/{str?}', 'ctrCliente@buscaIncremental' )->name('buscaclienteincremental');
Route::get('/cliente', 'ctrCliente@index')->name('cliente.index');
Route::get('/cliente/add', 'ctrCliente@add')->name('cliente.add');
Route::get('/cliente/list/{id?}/{nome?}/{cnpj?}/{conjuge?}', 'ctrCliente@list')->name('cliente.list');
Route::get('/cliente/todos', 'ctrCliente@todos')->name('cliente.todos');
Route::get('/cliente/paginacao', 'ctrCliente@paginacao')->name('cliente.paginacao');
Route::get('/cliente/form', 'ctrCliente@form')->name('cliente.form');
Route::post('/cliente/edit/{id?}/{readonly?}', 'ctrCliente@edit')->name('cliente.edit');
Route::get('/cliente/editajax/{id?}', 'ctrCliente@editAjax')->name('cliente.editajax');
Route::post('/cliente/salvar', 'ctrCliente@update')->name('cliente.salvar');
Route::post('/cliente/store', 'ctrCliente@store')->name('cliente.store');
Route::get('/cliente/verificarcadastrado/{cpf?}', 'ctrCliente@checarjacadastrado')->name('cliente.checarcadastrocpf');
Route::post('/cliente/precadastro', 'ctrCliente@preCadastro')->name('cliente.precadastro');
Route::get('/cliente/find/{id?}', 'ctrCliente@localizar')->name('cliente.find');
Route::get('/cliente/tipo/{id?}', 'ctrCliente@tipoCliente')->name('cliente.tipo');
Route::post('/cliente/salvarajax', 'ctrCliente@updateAjax')->name('cliente.salvarajax');
Route::get('/cliente/telefone/{telefone?}', 'ctrCliente@localizarTelefone')->name('cliente.localizar.telefone');
Route::get('/cliente/pegartipo/{id?}', 'ctrCliente@pegarTipoCliente')->name('cliente.pegartipo');
Route::get('/cliente/verificarTemPerfil/{id?}', 'ctrCliente@verificarTemPerfil')->name('cliente.verificarTemPerfil');
Route::get('/cliente/perfil/{id?}', 'ctrClientePerfil@carga')->name('cliente.perfil');
Route::post('/cliente/perfil/apagar/{id?}', 'ctrClientePerfil@apagar')->name('cliente.perfil.apagar');
Route::get('/cliente/corretoratente/{id?}', 'ctrClientePerfil@carga')->name('cliente.corretoratende');
Route::post('/cliente/perfil/gravar', 'ctrClientePerfil@gravar')->name('cliente.perfil.gravar');
Route::post('/cliente/atualizaremail', 'ctrCliente@atualizarEmailCliente')->name('cliente.atualizaremail');
Route::get('/cliente/gargaemailtelefone', 'ctrCliente@cargaEmailTelefone')->name('cliente.cargaemailtelefone');
Route::get('/cliente/relclienteemailtelefone', 'ctrCliente@relEmailTelefone')->name('cliente.relemailtelefone');
Route::get('/cliente/show/{id?}', 'ctrCliente@show')->name('cliente.show');

Route::get('/tipdocpessoal/index', 'ctrTipoDocPessoal@index')->name('tipodocpessoal.index');
Route::get('/tipdocpessoal/carga', 'ctrTipoDocPessoal@carga')->name('tipodocpessoal.carga');
Route::get('/tipdocpessoal/find/{id?}', 'ctrTipoDocPessoal@find')->name('tipodocpessoal.find');
Route::post('/tipdocpessoal/salvar', 'ctrTipoDocPessoal@salvar')->name('tipodocpessoal.salvar');
Route::post('/tipdocpessoal/inativar/{id?}', 'ctrTipoDocPessoal@inativar')->name('tipodocpessoal.inativar');


Route::get('/bairros/{cidade?}', 'ctrImovel@bairrosCadastrados')->name('bairros.carga');
Route::get('/cidades', 'ctrImovel@cidadesCadastradas')->name('cidades.carga');
Route::post('/bairro/salvar', 'ctrBairro@salvar')->name('bairro.salvar');
Route::get('/bairro/carga/tabela/{cidade?}', 'ctrBairro@carga')->name('bairro.cargadatabela');
Route::post('/bairro/verificarexistencia', 'ctrBairro@verificar')->name('bairro.verificarexistencia');



Route::get('motivorescisao/motivorescisao', 'ctrMotivoRescisao@index');
Route::get('motivorescisao/motivorescisao/new', 'ctrMotivoRescisao@create');
Route::get('motivorescisao/motivorescisao/editar/{id}', 'ctrMotivoRescisao@edit');
Route::get('motivorescisao/motivorescisao/vereapagar/{id}', 'ctrMotivoRescisao@vereapagar');
Route::get('motivorescisao/motivorescisao/apagar/{id}', 'ctrMotivorescisao@destroy');
Route::post('motivorescisao/motivorescisao/{id}', 'ctrMotivoRescisao@update');
Route::post('motivorescisao/motivorescisao', 'ctrMotivoRescisao@store');

Route::get('ramoatividade/ramoatividade', 'ctrRamoAtividade@index');
Route::get('ramoatividade/ramoatividade/new', 'ctrRamoAtividade@create');
Route::get('ramoatividade/ramoatividade/editar/{id}', 'ctrRamoAtividade@edit');
Route::get('ramoatividade/ramoatividade/vereapagar/{id}', 'ctrRamoAtividade@vereapagar');
Route::get('ramoatividade/ramoatividade/apagar/{id}', 'ctrRamoAtividade@destroy');
Route::post('ramoatividade/ramoatividade', 'ctrRamoAtividade@store');
Route::post('ramoatividade/ramoatividade/{id}', 'ctrRamoAtividade@update');


Route::get('tipodocumento/carga', 'ctrTipoDocumento@carga')->name('tipodocumento.carga');



Route::get('tipoatendente/tipoatendente', 'ctrTipoAtendente@index');
Route::get('tipoatendente/tipoatendente/new', 'ctrTipoAtendente@create');
Route::get('tipoatendente/tipoatendente/editar/{id}', 'ctrTipoAtendente@edit');
Route::post('tipoatendente/tipoatendente', 'ctrTipoAtendente@store');
Route::post('tipoatendente/tipoatendente/{id}', 'ctrTipoAtendente@update');
Route::get('tipoatendente/tipoatendente/vereapagar/{id}', 'ctrTipoAtendente@vereapagar');
Route::get('tipoatendente/tipoatendente/apagar/{id}', 'ctrTipoAtendente@destroy');




Route::get('/tipocomercio/{empresa?}', 'ctrTipoComercio@index')->name('tipocomercio.index');
Route::get('/tipocomercio/carga/{empresa?}', 'ctrTipoComercio@carga')->name('tipocomercio.carga');
Route::get('/tipocomercio/buscar/{id?}', 'ctrTipoComercio@buscar')->name('tipocomercio.buscar');
Route::post('/tipocomercio/apagar/{id?}', 'ctrTipoComercio@destroy')->name('tipocomercio.apagar');
Route::post('/tipocomercio/store', 'ctrTipoComercio@store')->name('tipocomercio.store');
Route::post('/tipocomercio', 'ctrTipoComercio@update')->name('tipocomercio.update');

Route::get('/negocio/index', 'ctrNegocio@index')->name('tiponegocio');
Route::get('/negocio/carga', 'ctrNegocio@carga')->name('tiponegocio.carga');
Route::get('/negocio/buscar/{id?}', 'ctrNegocio@buscar')->name('tiponegocio.buscar');
Route::post('/negocio/negocio/store', 'ctrNegocio@store')->name('tiponegocio.store');
Route::post('/negocio/negocio', 'ctrNegocio@update')->name('tiponegocio.update');
Route::get('/negocio/negocio/new', 'ctrNegocio@create')->name('tiponegocio.new');
Route::post('/negocio/negocio/editar/{id?}', 'ctrNegocio@edit')->name('tiponegocio.editar');;
Route::post('/negocio/negocio/apagar/{id?}', 'ctrNegocio@destroy')->name('tiponegocio.apagar');

Route::get('/equipe/index', 'ctrEquipe@index')->name('equipe');
Route::get('/equipe/carga', 'ctrEquipe@carga')->name('equipe.carga');
Route::get('/equipe/buscar/{id?}', 'ctrEquipe@buscar')->name('equipe.buscar');
Route::post('/equipe/salvar', 'ctrEquipe@salvar')->name('equipe.salvar');
Route::post('/equipe/apagar/{id?}', 'ctrEquipe@destroy')->name('equipe.apagar');

Route::get('/equipenegocio/{id?}', 'ctrEquipe@equipeNegocio')->name('equipe.negocio');
Route::get('/membrosequipe/{id?}', 'ctrEquipe@membrosEquipe')->name('equipe.membros');
Route::post('/membrosequipe/gerente/{idequipe?}/{idmembro}/{gerente?}', 'ctrEquipe@membroGerenteEquipe')->name('equipe.gerenteonoff');



Route::get('/tipoimovel/tipoimovel', 'ctrTipoImovel@index')->name('tipoimovel');
Route::get('/tipoimovel/tipoimovel/new', 'ctrTipoImovel@create')->name('tipoimovel.new');
Route::post('/tipoimovel/tipoimovel/editar/{id?}', 'ctrTipoImovel@edit')->name('tipoimovel.editar');;
Route::post('/tipoimovel/tipoimovel/apagar/{id?}', 'ctrTipoImovel@destroy')->name('tipoimovel.apagar');
Route::post('/tipoimovel/tipoimovel/store', 'ctrTipoImovel@store')->name('tipoimovel.store');
Route::post('/tipoimovel/tipoimovel', 'ctrTipoImovel@update')->name('tipoimovel.update');
Route::get('/tipoimovel/carga', 'ctrTipoImovel@carga')->name('tipoimovel.carga');
Route::get('/tipoimovel/buscar/{id?}', 'ctrTipoImovel@buscar')->name('tipoimovel.buscar');



Route::get('statusimovel/statusimovelindex/{empresa?}', 'ctrStatusImovel@index')->name('statusimovel.index');
Route::get('/statusimovel/carga/{empresa?}', 'ctrStatusImovel@carga')->name('statusimovel.carga');
Route::get('/statusimovel/buscar/{id?}', 'ctrStatusImovel@buscar')->name('statusimovel.buscar');
Route::post('/statusimovel/apagar/{id?}', 'ctrStatusImovel@destroy')->name('statusimovel.apagar');
Route::post('/statusimovel/store', 'ctrStatusImovel@store')->name('statusimovel.store');
Route::post('/statusimovel', 'ctrStatusImovel@update')->name('statusimovel.update');


Route::get('/tipocliente/{empresa?}', 'ctrTipoCliente@index')->name('tipocliente.index');
Route::get('/tipocliente/carga/{empresa?}', 'ctrTipoCliente@carga')->name('tipocliente.carga');
Route::get('/tipocliente/buscar/{id?}', 'ctrTipoCliente@buscar')->name('tipocliente.buscar');
Route::post('/tipocliente/apagar/{id?}', 'ctrTipoCliente@destroy')->name('tipocliente.apagar');
Route::post('/tipocliente/store', 'ctrTipoCliente@store')->name('tipocliente.store');
Route::post('/tipocliente', 'ctrTipoCliente@update')->name('tipocliente.update');

Route::get('/tipoatendente/{empresa?}', 'ctrTipoAtendente@index')->name('tipoatendente.index');
Route::get('/tipoatendente/carga/{empresa?}', 'ctrTipoAtendente@carga')->name('tipoatendente.carga');
Route::get('/tipoatendente/buscar/{id?}', 'ctrTipoAtendente@buscar')->name('tipoatendente.buscar');
Route::post('/tipoatendente/apagar/{id?}', 'ctrTipoAtendente@destroy')->name('tipoatendente.apagar');
Route::post('/tipoatendente/store', 'ctrTipoAtendente@store')->name('tipoatendente.store');
Route::post('/tipoatendente', 'ctrTipoAtendente@update')->name('tipoatendente.update');

Route::get('/seguroincendio', 'ctrContratoSeguroIncendio@index')->name('seguroincendio.index');
Route::get('/seguroincendio/carga', 'ctrContratoSeguroIncendio@carga')->name('seguroincendio.carga');
Route::post('/seguroincendio/update', 'ctrContratoSeguroIncendio@update')->name('seguroincendio.update');
Route::get('/seguroincendio/new/{id?}', 'ctrContratoSeguroIncendio@new')->name('seguroincendio.new');

Route::get('/segurofianca', 'ctrContratoSeguroFianca@index')->name('segurofianca.index');
Route::get('/segurofianca/carga', 'ctrContratoSeguroFianca@carga')->name('segurofianca.carga');
Route::post('/segurofianca/update', 'ctrContratoSeguroFianca@update')->name('segurofianca.update');
Route::get('/segurofianca/new/{id?}', 'ctrContratoSeguroFianca@new')->name('segurofianca.new');
Route::get('/segurofianca/find/{id?}', 'ctrContratoSeguroFianca@find')->name('segurofianca.find');
Route::get('/segurofianca/contratosmarcos', 'ctrContratoSeguroFianca@cargaMarcadosSeguroFianca')->name('segurofianca.contratosmarcados');

Route::get('/caucao/mostrar/{id?}', 'ctrContratoCaucao@mostrar')->name('caucao.edit');
Route::get('/caucao', 'ctrContratoCaucao@index')->name('caucao.index');
Route::get('/caucao/carga', 'ctrContratoCaucao@carga')->name('caucao.carga');
Route::get('/caucao/new/{id?}', 'ctrContratoCaucao@new')->name('caucao.new');
Route::post('/caucao/update', 'ctrContratoCaucao@update')->name('caucao.update');

Route::get('/statusatendimento/{empresa?}', 'ctrAtendimentoStatus@index')->name('statusatendimento.index');
Route::get('/statusatendimento/list/{empresa?}', 'ctrAtendimentoStatus@lista')->name('statusatendimentolista');
Route::get('/statusatendimento/apagar/{id?}', 'ctrAtendimentoStatus@destroy')->name('statusatendimento.apagar');
Route::get('/statusatendimento/editar/{id?}', 'ctrAtendimentoStatus@show')->name('statusatendimento.show');
Route::post('/statusatendimento/save', 'ctrAtendimentoStatus@store')->name('statusatendimento.salvar');

Route::get('/tabelaeventos', 'ctrTabelaEventos@index')->name('tabelaeventos.index');
Route::get('/tabelaeventos/find/{id?}', 'ctrTabelaEventos@find')->name('tabelaeventos.find');
Route::get('/tabelaeventos/buscajson/{id?}', 'ctrTabelaEventos@buscaJson')->name('tabelaeventos.buscajson');
Route::get('/tabelaeventos/carga', 'ctrTabelaEventos@carga')->name('tabelaeventos.carga');
Route::post('/tabelaeventos/store', 'ctrTabelaEventos@store')->name('eventos.store');

Route::get('indicereajuste/carga/{empresa?}', 'ctrIndiceReajuste@carga')->name('indicereajuste.carga');
Route::get('indicereajuste/indicereajuste/{empresa?}', 'ctrIndiceReajuste@index')->name('indicereajuste.index');
Route::get('indicereajuste/indicereajuste/new', 'ctrIndiceReajuste@create')->name('indicereajuste.novo');
Route::get('indicereajuste/find/{id?}', 'ctrIndiceReajuste@find')->name('indicereajuste.find');
Route::post('indicereajuste/salvar', 'ctrIndiceReajuste@salvar')->name('indicereajuste.salvar');
Route::post('indicereajuste/indicereajuste/{id?}', 'ctrIndiceReajuste@update')->name('indicereajuste.update');
Route::get('indicereajuste/indicereajuste/vereapagar/{id?}', 'ctrIndiceReajuste@vereapagar')->name('indicereajuste.apagar');
Route::get('indicereajuste/indicereajuste/apagar/{id?}', 'ctrIndiceReajuste@destroy')->name('indicereajuste.deletar');

Route::get('indicereajuste/tabcor/{id?}', 'ctrTabelaCorrecao@index')->name('indicemes.index');
Route::get('indicereajuste/tabcor/find/{id?}', 'ctrTabelaCorrecao@find')->name('indicemes.find');
Route::get('indicereajuste/tabcor/carga/{empresa?}', 'ctrTabelaCorrecao@carga')->name('indicemes.carga');
Route::post('indicereajuste/tabcor/gravar', 'ctrTabelaCorrecao@gravar')->name('indicemes.gravar');
Route::get('indicereajuste/tabcor/buscar/{id?}/{mes?}/{ano?}', 'ctrTabelaCorrecao@buscarIndiceMesAno')->name('indicemes.buscarmesano');


Route::post('/reajustar/confirmar', 'ctrRotinas@confirmarReajuste')->name('reajustar.confirmar');
Route::get('/reajustar/carga', 'ctrRotinas@reajustarCarga')->name('reajustar.carga');
Route::get('/renovar/carga', 'ctrRotinas@renovarCarga')->name('renovar.carga');
Route::post('/renovar/renovar', 'ctrRotinas@realizarRenovacao')->name('renovar.realizar');
Route::post('/reajustar/reajustar', 'ctrRotinas@realizarReajuste')->name('reajustar.realizar');
Route::post('/renovar/confirmar', 'ctrRotinas@confirmarRenovacao')->name('renovar.confirmar');
Route::get('/addmeses/{dia?}/{meses?}/{data?}', 'ctrRotinas@addMeses')->name('addmeses');
Route::get('/subtrairmeses/{dia?}/{meses?}/{data?}', 'ctrRotinas@subtrairMeses')->name('subtrairmeses');
Route::get('/parcelamentojson/{dia?}/{meses?}/{data?}/{valorparcela?}/{valortotal?}', 'ctrRotinas@parcelamentojson')->name('parcelamentojson');
Route::get('/reajustar/reajustarAutomatico', 'ctrRotinas@reajustarAutomatico')->name('reajustartudo');
Route::get('/reajustar/gravarparcelasaluguel/{dia?}/{data?}/{datareajuste}/{valorparcela?}/{idcontrato?}', 'ctrRotinas@gravarparcelasaluguel')->name('gravarparcelasaluguel');
Route::get('/completarlanctosaluguel', 'ctrRotinas@lancarAluguelEmTodosAtivosAteReajuste')->name('completarlanctosaluguel');
Route::post('/reajustar/estorar/{id?}', 'ctrRotinas@estornarReajuse')->name('reajuste.estornar');


Route::post('/acordo/gravar', 'ctrAcordo@store')->name('acordo.gravar');
Route::get('/acordo/contrato/carga/{id?}', 'ctrAcordo@acordosContrato')->name('acordo.contrato.carga');
Route::get('/acordo/contrato/detalhes/{idacordo?}', 'ctrAcordo@acordoDetalhes')->name('acordo.contrato.detalhes');
Route::get('/acordo/index', 'ctrAcordo@index')->name('acordos.index');
Route::get('/acordo/list', 'ctrAcordo@list')->name('acordos.list');


Route::get('/taxacontratodoctr/{id?}', 'ctrRotinas@taxaContratoDoContrato')->name('txcontratodocontrato');
Route::get('/taxacontratodoctrtotais/{id?}', 'ctrRotinas@taxaContratoValorTotal')->name('txcontratodocontratototais');
Route::get('/taxasrecebidas/index', function()
{
    return view( 'financeiro.taxasrecebidas');

})->name('taxasrecebidas.index');
Route::get('/taxasrecebidas/carga', 'ctrRotinas@taxasRetidas')->name('taxasrecebidas.carga');

Route::get('/repasse/previsao/taxaadm', 'ctrRepasse@previsaoTaxaAdm')->name('previsaotaxaadm');
Route::get('/repasse/previsao/taxaadm/calcular', 'ctrRepasse@calcularPrevisaoTaxAdmContrato')->name('previsaotaxaadm.calcular');
Route::get('/repasse/previsao/taxaadm/totalizar', 'ctrRepasse@totalizarPrevTaxAdm')->name('previsaotaxaadm.totalizar');


Route::get('/reajustar/index', function()
{
    return view('processos.reajustaraluguel');
})->name('reajustar.index');

Route::get('/renovar/index', function()
{
    return view('processos.renovarcontrato');
})->name('renovar.index');

Route::get('/reajustar/reajustados/index', function()
{
    return view('reports.admimoveis.relreajustesrealizados');
})->name('reajustados.index');

Route::get('/reajustar/reajustados/carga', 'ctrRotinas@cargaReajustados')->name('reajustes.realizados.carga');

Route::get('admcon/carga/{empresa?}', 'ctrAdmCondominio@carga')->name( 'admcon.carga');


Route::get('tabelamulta/tabelamulta', 'ctrTabelaMulta@index')->name( 'tabelamulta');

Route::post('/recebimento/{id?}', 'ctrRecebimento@index')->name('recebimento');
Route::get('/recebimento/calcular/{idcontrato?}/{datavencimento?}/{datapagamento?}/{liberarmulta1?}/{liberarmulta2?}/{liberarjuros?}/{origem?}',
                'ctrRecebimento@calcularRecebimento')->name('recebimento.calcular');
Route::get('/recebimento/totalizar', 'ctrRecebimento@totalizarLancamentos')->name('recebimento.totalizarlancamentos');
Route::get('/recebimento/item/delete/{id?}', 'ctrRecebimento@itemDelete')->name('recebimento.item.delete');
Route::get('/recebimento/recalcular/{idcontrato?}/{idimovel?}/{datavencimento?}/{datapagamento?}', 'ctrRecebimento@recalcularRecebimento')->name('recebimento.recalcular');
Route::get('/recebimento/fixarlancamento', 'ctrRecebimento@itemAlterarFixar')->name('recebimento.fixarlancamento');
Route::get('/recebimento/limpartmp', 'ctrRecebimento@limparTMP')->name('recebimento.limpartmp');
Route::get('/recebimento/previsao', 'ctrCobrancaGerada@previsaoRecebimento')->name('recebimento.previsao');
Route::get('/recebimento/previsao/gerar', 'ctrCobrancaGerada@selecionarContratosPrevisao')->name('recebimento.previsao.gerar');
Route::get('/recebimento/previsao/relatorio/{periodo?}', 'ctrCobrancaGerada@previsaoRecebimentoRelatorio')->name('recebimento.previsao.relatorio');



Route::post('/repasse/{id?}', 'ctrRepasse@index')->name('repasse');
Route::get('/repasse/calcular/{idcontrato?}/{datavencimento?}/{datapagamento?}/{somentemes?}', 'ctrRepasse@calcularRepasse')->name('repasse.calcular');
Route::get('/repasse/totalizar', 'ctrRepasse@totalizarLancamentos')->name('repasse.totalizarlancamentos');
Route::get('/repasse/item/delete/{id?}', 'ctrRepasse@itemDelete')->name('repasse.item.delete');
Route::get('/repasse/recalcular/{idcontrato?}/{idimovel?}/{datavencimento?}/{datapagamento?}', 'ctrRepasse@recalcularRepasse')->name('repasse.recalcular');
Route::get('/repasse/previsao/recebidos', 'ctrRepasse@previsaoRepasseJaRecebido')->name('repasse.previsao.recebidos');
Route::get('/repasse/previsao/garantidos', 'ctrRepasse@previsaoGarantidos')->name('repasse.previsao.garantidos');
Route::get('/repasse/previsao/todos', 'ctrRepasse@previsaoTodos')->name('repasse.previsao.todos');
Route::get('/repasse/fixarlancamento', 'ctrRepasse@itemAlterarFixar')->name('repasse.fixarlancamento');

Route::get('/repasse/previsao/relatorio/{idcliente?}', 'ctrRepasse@relPrevisaoRepasseRelatorio')->name('repasse.previsao.relatorio');
Route::get('/repasse/previsao/cargabasegerada/{idcliente?}', 'ctrRepasse@previsaoBaseGerada')->name('repasse.previsao.cargabasegerada');
//dropzone
Route::get('/dropzone', 'ctrImagem@dropzone')->name('dropzone.imagens');
Route::get('/dropzone/imoveis', 'ctrDropZone@imoveis')->name('dropzone.imoveis');
Route::post('/dropzone/fileupload', 'ctrImagem@fileUpload')->name('imoveis.fileupload');
Route::post('/dropzone/store', 'ctrImagem@dropzoneStore')->name('dropzone.store');
Route::get('/image/rotacionar/{idimg?}/{graus?}', 'ctrImagem@rotate')->name('image.rotate');





    # Rotas para Atendimentos
Route::get('/atendimento/listaratdclt/{idatd?}/{idcliente?}', 'ctrAtendimento@listarImovelAtdImvClt')->name('atendimento.listaratdclt');
Route::get('/atendimento', 'ctrAtendimento@index')->name('atendimento');
Route::post('/atendimento/atendimento', 'ctrAtendimento@atendimento')->name('atendimento.atendimento');
Route::get('/atendimento/ultimostatus/{id?}', 'ctrAtendimentoAgenda@ultimoStatus')->name('atendimento.ultimostatus');
Route::get('/atendimento/clienteadd', 'ctrAtendimento@clienteAdd')->name('atendimentocliente.add');
Route::get('/atendimento/list', 'ctrAtendimento@list')->name('atendimento.list');
Route::get('/atendimento/qabertos/{id?}', 'ctrAtendimento@qAbertos')->name('atendimento.abertos');
Route::post('/atendimento/abertos', 'ctrAtendimento@abertos')->name('atendimento.todosabertos');
//Route::post('/atendimento/selecionarimovel', 'ctrAtendimento@selecionarImoveis')->name('atendimento.selecionarimoveis');
Route::post('/atendimento/selecionarimovel', 'ctrAtendimento@selecionarImoveis')->name('atendimento.selecionarimoveis');
Route::get('/atendimento/cargaselecionados', 'ctrAtendimento@cargaSelecionados')->name('cargaselecionados');
Route::get('/atendimento/cargaselecionadosefetivos', 'ctrAtendimento@cargaSelecionadosEfetivos')->name('cargaselecionados-efetivos');
Route::get('/atendimento/apagarimvselec', 'ctrAtendimento@apagarImvSelec')->name('apagarimvselec');
Route::get('/atendimento/apagarimvselecEfetivo', 'ctrAtendimento@apagarImvSelecEfetivo')->name('apagarimvselecefetivo');
Route::post('/atendimento/novo', 'ctrAtendimento@store')->name('atendimento.novo');
Route::post('/atendimento/novoimoveis', 'ctrAtendimento@imoveis')->name('atendimento.imoveis');
Route::post('/atendimento/salvar', 'ctrAtendimento@save')->name('atendimento.salvar');
Route::get('/atendimento/buscar/{id?}', 'ctrAtendimento@buscarAtendimento')->name('atendimento.buscar');
Route::post('/atendimento/reabrir', 'ctrAtendimento@reabrir')->name('atendimento.reabrir');
Route::get('/atendimento/limparselecao/{id?}', 'ctrAtendimento@limparSelecao')->name('atendimento.limparselecao');
Route::get('/atendimento/idultimo/{id?}', 'ctrAtendimento@idUltimoAtendimento')->name('atendimento.idultimoatendimento');
Route::get('/atendimento/ultimoatendimento/{id?}', 'ctrAtendimento@UltimoAtendimento')->name('atendimento.ultimoatendimento');


Route::get('/atendimento/ing/atm/novo', 'ctrClienteAtendimento@novoAtendimento')->name('clienteatendimento.novo');
Route::get('/atendimento/ing/atm/clientes/{idcliente?}/{page?}', 'ctrClienteAtendimento@ingAtendimentoClientes')->name('atendimentos.cliente');
Route::post('/atendimento/ing/atm/novo/gravar', 'ctrClienteAtendimento@gravarNovo')->name('atendimento.cliente.novo');
Route::get('/atendimento/ing/atm/corretor/ultimo/{id?}', 'ctrClienteAtendimento@corretorDataUltAtm')->name('atendimento.cliente.ultimocorretor');
Route::get('/atendimento/ing/atm/aberto/ultimo/{id?}', 'ctrClienteAtendimento@atmAbertoCorretor')->name('atendimento.cliente.corcliatmabe');
Route::get('/atendimento/ing/atm/pendentescorretor', 'ctrClienteAtendimento@atmPendentesCorretor')->name('atendimento.cliente.atendimentopendente');
Route::get('/atendimento/ing/atm/pendentesoutrocorretor', 'ctrClienteAtendimento@atmPendentesOutroCorretor')->name('atendimento.cliente.atendimentooutropendente');
Route::get('/atendimento/nofiticarcorretor', 'ctrClienteAtendimento@notificarCorretorAtm')->name('atendimento.nofiticarcorretor');
Route::post('/atendimento/ciente', 'ctrClienteAtendimento@cienteAtm')->name('atendimento.cienteatm');

Route::get('/atendimento/notificarNovosLeads', 'ctrClienteAtendimento@notificarNovosLeads')->name('atendimento.notificarNovosLeads');
Route::post('/atendimento/leads/ciente', 'ctrClienteAtendimento@cienteLeads')->name('atendimento.leadsciente');
Route::get('/','ctrRotinas@cargaLeads')->name('leads.carga');
Route::get('/leads/index',function()
    {
        return view('leads.leadsindex');

    })->name('leads.leadsindex');
    Route::get('/leads/carga','ctrRotinas@cargaLeads')->name('leads.carga');

Route::get('/atendimento/ing/atm/totalmeusclientes', 'ctrClienteUsuario@totalMeusClientes')->name('totalmeusclientes');
Route::get('/atendimento/ing/atm/meusinteressados', 'ctrClienteUsuario@meusInteressados')->name('meusinteressados');
Route::get('/atendimento/ing/atm/meusproprietarios', 'ctrClienteUsuario@meusInteressados')->name('meusproprietarios');
Route::get('/atendimento/ing/atm/interessadosdemaiscorretores', 'ctrClienteUsuario@interessadosDemaisCorretores')->name('interessadosdemaiscorretores');
Route::get('/atendimento/ing/atm/proprietariosdemaiscorretores', 'ctrClienteUsuario@proprietariosDemaisCorretores')->name('proprietariosdemaiscorretores');
Route::get('/atendimento/ing/atm/listar', 'ctrClienteAtendimento@listarAtendimentos')->name('listaratendimentos');
Route::post('/atendimento/ing/atm/transferir', 'ctrClienteAtendimento@transferirAtendimento')->name('transferiratendimento');
Route::get('/atendimento/ing/atm/dadosultatdcli/{id?}', 'ctrClienteAtendimento@dadosUltimoAtdCliente')->name('atendimento.dadosultatdcliente');
Route::get('/atendimento/ing/atm/dadosultatdcli/{id?}', 'ctrClienteAtendimento@dadosUltimoAtdCliente')->name('atendimento.dadosultatdcliente');
Route::get('/atendimento/ing/atm/ultimoAtendimentoClienteCorretor/{id?}', 'ctrClienteAtendimento@ultimoAtendimentoClienteCorretor')->name('atendimento.ultimoatendimentoclientecorretor');
Route::get('/atendimento/pegardadosatendimento/{id?}', 'ctrClienteAtendimento@pegarDadosAtendimento')->name('atendimento.pegardadosatendimento');
Route::get('/primeiroatendimentocliente/{id?}', 'ctrClienteAtendimento@primeiroAtendimentoCliente')->name('atendimento.primeiroatendimentocliente');
Route::post('/atendimento/fecharatendimento', 'ctrClienteAtendimento@fecharAtendimento')->name('atendimento.fechar');


Route::get('/regiao/carga', 'ctrRotinas@cargaRegiaoCidade')->name('regiaocidade.carga');

Route::get('/feriados/index', 'ctrFeriado@index')->name('feriados.feriadosindex');
Route::get('/feriados/carga', 'ctrFeriado@carga')->name('feriados.carga');
Route::post('/feriados/gravar', 'ctrFeriado@store')->name('feriados.gravar');
Route::get('/feriados/edit/{id?}', 'ctrFeriado@edit')->name('feriados.edit');
Route::post('/feriados/excluir/{id?}', 'ctrFeriado@destroy')->name('feriados.excluir');

//totais de atendimento
Route::get('/atendimento/ing/atm/totalmeusatendimentos', 'ctrClienteAtendimento@totalMeusAtendimetos')->name('atendimento.cliente.totalmeusatendimetos');
Route::get('/atendimento/ing/atm/totalatendimetosoutroscorretores', 'ctrClienteAtendimento@totalAtendimetosOutrosCorretores')->name('atendimento.cliente.totalatendimetosoutroscorretores');
Route::get('/atendimento/ing/atm/totalmeusatendimentosfinalizados', 'ctrClienteAtendimento@totalMeusAtendimentosFinalizados')->name('atendimento.cliente.totalmeusantendimentosfinalizados');
Route::get('/atendimento/ing/atm/totalmeusatendimentosemaberto', 'ctrClienteAtendimento@totalMeusAtendimentosEmAberto')->name('atendimento.cliente.totalmeusatendimentosemaberto');
Route::get('/atendimento/ing/atm/totalmeusatendimentosaltaprioridade', 'ctrClienteAtendimento@totalMeusAtendimentosAltaPrioridade')->name('atendimento.cliente.totalmeusatendimentosaltaprioridade');
Route::get('/atendimento/ing/atm/totalatendimentosfinalizadosdemaiscorretores', 'ctrClienteAtendimento@totalAtendimentosFinalizadosDemaisCorretores')->name('atendimento.cliente.totalatendimentosfinalizadosdemaiscorretores');
Route::get('/atendimento/ing/atm/totalatendimentosemabertodemaiscorretores', 'ctrClienteAtendimento@totalAtendimentosEmAbertoDemaisCorretores')->name('atendimentosemabdemaiscor');
Route::get('/atendimento/ing/atm/totalatendimentosaltaprioridadedemaiscor', 'ctrClienteAtendimento@totalAtendimentosAltaPrioridadeDemaisCor')->name('totalatendimentosaltaprioridadedemaiscor');
Route::get('/atendimento/ing/atm/localizaratendimentos', 'ctrClienteAtendimento@localizarAtendimentos')->name('localizaratendimentos');

Route::get('/atendimento/ing/atm/totalnovosimoveis', 'ctrDashboard@totalNovosImoveis')->name('totalnovosimoveis');




//NOTIFICACOES
Route::get('/notifica/novosimoveis', 'ctrImoveisNotificacoes@novosImoveis')->name('novosimoveisatd');
Route::get('/notifica/novosimoveisqtd', 'ctrImoveisNotificacoes@novosimoveisQtd')->name('novosimoveisatdqtd');
Route::post('/notifica/informarimovelvisualizado', 'ctrImoveisNotificacoes@informarImovelVisualizado')->name('informarimovelvisualizado');

Route::get('/notifica/novosclientes', 'ctrClienteNotificacoes@novosClientes')->name('novosclientesatd');
Route::get('/notifica/novosclientesqtd', 'ctrClienteNotificacoes@novosClientesQtd')->name('novosclientesatdqtd');
Route::post('/notifica/informarclientevisualizado', 'ctrClienteNotificacoes@informarClienteVisualizado')->name('informarclientevisualizado');


Route::get('/midia/carga', 'ctrMidia@carga')->name('midia.carga');


# Rotas para Agendamento de Atendimetno
Route::get('/atendimento/agenda/carga/{id?}', 'ctrAtendimentoAgenda@carga')->name('atendimento.agenda.carga');
Route::get('/atendimento/agenda/{id?}', 'ctrAtendimentoAgenda@busca')->name('atendimento.agenda.busca');
Route::post('/atendimento/agenda/gravar', 'ctrAtendimentoAgenda@store')->name('atendimento.agenda.gravar');
Route::post('/atendimento/agenda/encerramento', 'ctrAtendimentoAgenda@registroEncerramento')->name('atendimento.agenda.encerramento');
Route::get('/atendimento/agenda/qhoje/{id?}', 'ctrAtendimentoAgenda@qHoje')->name('atendimento.agenda.hoje');

    # Rotas para Imoveis
Route::get('/imovel/index', 'ctrImovel@index')->name('imovel.index');
Route::get('/imovel/endereco/{id?}', 'ctrRotinas@imovelEnderecoJson')->name('imovel.enderecocompleto');
Route::get('/imovel/list', 'ctrImovel@list')->name('imovel.list');
Route::get('/imovel/form/{id?}', 'ctrImovel@form')->name('imovel.form');
Route::post('/imovel/edit', 'ctrImovel@edit')->name('imovel.edit');
Route::get('/imovel/mostrar/{id?}', 'ctrImovel@mostrar')->name('imovel.mostrar');
//Route::get('/imovel/save', 'ctrImovel@update')->name('imovel.save');
Route::get('/imovel/add', 'ctrImovel@add')->name('imovel.add');
Route::delete('/imovel/apagar/{id?}', 'ctrImovel@destroy')->name('imovel.apagar');
Route::post('/imovel/save', 'ctrImovel@save')->name('imovel.save');
Route::get('/imovel/galeria/{id}', 'ctrImovel@galeria')->name('imovel.galeria');;
Route::post('/imovel/store', 'ctrImovel@store')->name('imovel.store');
Route::post('/imovel/imagem/{id}', 'ctrImagem@store')->name('imagem.store');
Route::get('/imovel/novoid', 'ctrImovel@pegarNovoID');
Route::get('/imovel/carga/{id?}', 'ctrImovel@carga')->name('imovel.carga');
Route::get('/imovel/cargajson/{id?}', 'ctrImovel@cargaJson')->name('imovel.cargajson');
Route::get('/imovel/detalhefoto/{id?}', 'ctrImovel@detalhecomfoto')->name('imovel.detalhecomfoto');
Route::post('/imovel/statustroca', 'ctrImovel@trocarStatusImovel')->name('imovel.trocarstatus');
Route::get('/imovel/teste', 'ctrImovel@teste')->name('imovel.teste');
Route::get('/imovel/dadosminimos', 'ctrImovel@dadosMinimos')->name('imovel.dadosminimos');
Route::get('/imovel/dadosminimosindex', 'ctrImovel@indexDadosMinimos')->name('imovel.indexdadosminimos');
Route::get('/imovel/getimovelproprietario', 'ctrImovel@getImovelProprietario')->name('carga.imovel.proprietarios');
Route::get('/imovel/relimovelproprietario', 'ctrImovel@relImovelProprietario')->name('rel.imovel.proprietarios');
Route::get('/imovel/getgeralimoveis', 'ctrImovel@getGeralImoveis')->name('carga.imovel.geral');
Route::get('/imovel/relgeralimoveis', 'ctrImovel@relGeralImoveis')->name('rel.imovel.geral');
Route::post('/imovel/clonar/{id?}', 'ctrImovel@clonar')->name('imoveis.clonar');
Route::get('/imovel/imagem/dragdrop', 'ctrImagem@dragDrop')->name('imoveis.imagens.dragdrop');
Route::get('/imovel/imagem/insertwatermark/{id?}', 'ctrImagem@inserirWM')->name('imoveis.imagens.insertwm');
Route::get('/imovel/locadorprincipal/{id?}', 'ctrRotinas@dadosLocadorPrincipal')->name('imovel.locadorprincipal');



Route::get('/corimo/{id}', 'ctrCorImo@lista')->name('corimo.lista');
Route::POST('/corimo/salvar', 'ctrCorImo@store')->name('corimo.salvar');
Route::delete('/corimo/apagar/{id?}', 'ctrCorImo@destroy')->name('corimo.apagar');
Route::get('/corimo/carga/{id?}', 'ctrCorImo@carga')->name('corimo.carga');
Route::get('/corimo/editar/{id?}', 'ctrCorImo@edit')->name('corimo.editar');

Route::get('/capimo/{id}', 'ctrCapImo@lista')->name('capimo.lista');
Route::POST('/capimo/salvar', 'ctrCapImo@store')->name('capimo.salvar');
Route::get('/capimo/carga/{id?}', 'ctrCapImo@carga')->name('capimo.carga');
Route::delete('/capimo/apagar/{id?}', 'ctrCapImo@destroy')->name('capimo.apagar');
Route::get('/capimo/editar/{id?}', 'ctrCapImo@edit')->name('capimo.editar');
Route::get('/capimo/usuariocaptador/{idusuario?}/{idimovel?}', 'ctrCapImo@usuarioEhCaptador')->name('capimo.usuariocaptador');

Route::post('/capctr/salvar', 'ctrCapCtr@store')->name('capctr.salvar');
Route::get('/capctr/carga/{id?}', 'ctrCapCtr@carga')->name('capctr.carga');
Route::post('/capctr/apagar/{id?}', 'ctrCapCtr@destroy')->name('capctr.apagar');

Route::post('/corctr/salvar', 'ctrCorCtr@store')->name('corctr.salvar');
Route::get('/corCtr/carga/{id?}', 'ctrCorCtr@carga')->name('corctr.carga');


Route::get('/propimo/carga/{id?}', 'ctrPropImo@carga')->name('propimo.carga');
Route::delete('/propimo/apagar/{id?}', 'ctrPropImo@destroy')->name('propimo.apagar');
Route::get('/propimo/editar/{id?}', 'ctrPropImo@edit')->name('propimo.editar');
Route::get('/propimo/find/{id?}', 'ctrPropImo@find')->name('propimo.find');
Route::post('/propimo/salvar', 'ctrPropImo@store')->name('propimo.salvar');
Route::get('/propimo/partictotal/{id?}', 'ctrPropImo@participacaoTotal')->name('propimo.parttotal');
Route::get('/propimo/temprincipal/{id?}', 'ctrPropImo@temPrincipal')->name('propimo.temprincipal');
Route::get('/propimo/imoveiscliente/{id?}', 'ctrPropImo@imoveisProprietario')->name('propimo.imoveisprop');

Route::get('/carregaratd', 'ctrAtendente@buscaTodosJson')->name('carregaratendentes');

Route::get('/imagens/{id?}', 'ctrImagem@indexJson')->name('imagens.imoveis');
Route::get('/imagens/condominio/{id?}', 'ctrImagem@cargaImagensCondominios')->name('imagens.condominios');
Route::get('/mostrarimagemprincipal/{id?}', 'ctrImagem@mostrarImagemprincipal')->name('mostrarimagem.principal');
Route::get('/imagem/{id?}', 'ctrImagem@imagem')->name('imagem');
Route::post('/imagens/principal/{idimovel?}/{idimagem?}', 'ctrImagem@principal')->name('imagem.principal');;
Route::post('/imagens/salvar/{idimagem?}', 'ctrImagem@update')->name('imagem.salvar');;
Route::get('/imagens/editar/{idimagem?}', 'ctrImagem@show')->name('imagem.editar');;
Route::get('/imagens/apagar/{id?}', 'ctrImagem@destroy')->name('imagem.apagar');
Route::get('/imagens/slider/{id?}', 'ctrImagem@slider')->name('imagem.slider');
Route::get('/imagens/album/{id?}', 'ctrImagem@album')->name('imagem.album');
Route::post('/imagens/apagarimovel/{id?}', 'ctrImagem@deletarImagensImovel')->name('imagem.apagarimovel');


Route::get('/menuadm', 'ctrContrato@menuAdmImoveis')->name('menuadm');

Route::get('/contratos/relatorio/geral/tela', function()
{
   return view( 'reports.admimoveis.telarelgeraldecontratos');
})->name('contrato.relatoriogeral.tela');
Route::get('/contratos/relatorio/geral/carga', 'ctrContrato@relGeralContratos')->name('contrato.relatoriogeral.carga');


Route::post('/contratos/anexo/update', 'ctrImagem@anexosUpdate')->name('anexoscontrato.update');
Route::post('/contratos/anexo/delete/{id?}', 'ctrImagem@anexosDelete')->name('anexoscontrato.delete');
Route::get('/contratos/download/{iddoc?}', 'ctrImagem@downloadDocto')->name('anexoscontrato.download');
Route::get('/contratos/anexos/{id?}', 'ctrContrato@anexos')->name('contrato.anexos');
Route::get('/contratos/anexos/contrato/{id?}', 'ctrImagem@cargaDocumentosContrato')->name('contrato.anexos.carga');


Route::get('/contratos', 'ctrContrato@index')->name('contrato.index');
Route::post('/contratos/edit', 'ctrContrato@edit')->name('contrato.edit');
Route::get('/contratos/find/{id?}', 'ctrContrato@find')->name('contrato.find');
Route::get('/contratos/findfull/{id?}', 'ctrContrato@findFull')->name('contrato.findfull');
Route::get('/contratos/findpasta/{id?}', 'ctrContrato@findPasta')->name('contrato.find.pasta');
Route::get('/contratos/list', 'ctrContrato@list')->name('contrato.list');
Route::get('/contratos/buscaporlt/{str?}/{imb_imb_id?}', 'ctrContrato@BuscaIncrementalCtrLocatario')->name('contrato.buscaporlt');
Route::get('/contratos/buscaporend/{str?}/{imb_imb_id?}', 'ctrContrato@BuscaIncrementalCtrEndereco')->name('contrato.buscaporend');
Route::get('/contratos/buscaporld/{str?}/{imb_imb_id?}', 'ctrContrato@BuscaIncrementalCtrLocador')->name('contrato.buscaporld');
Route::post('/contratos/novo', 'ctrContrato@novo')->name('contrato.novo');
Route::post('/contratos/gravarnovo', 'ctrContrato@store')->name('contrato.gravarnovo');
Route::get('/contratos/sequencia', 'ctrContrato@sequencia')->name('contrato.sequencia');
Route::get('/contratos/proximovenlt/{id?}', 'ctrRotinas@proximoVencimentoLT')->name('proximovenlt');
Route::get('/contratos/proximovenld/{id?}', 'ctrRotinas@proximoVencimentoLD')->name('proximovenld');
Route::post('/contratos/altven', 'ctrRotinas@alteracaoVencimento')->name('contrato.altven');
Route::get('/contratos/altven/carga/{id?}', 'ctrRotinas@alteracaoVenCarga')->name('contrato.altven.carga');
Route::get('/contratos/debitos/{id?}', 'ctrRotinas@relatorioDebitoCliente')->name('contrato.debitos');
Route::post('/contratos/rescisao/confirmar', 'ctrContrato@rescindir')->name('contrato.rescisao.confirmar');
Route::post('/contratos/reativar', 'ctrContrato@reativarContrato')->name('contrato.reativar');
Route::get('/contratos/emaillocatarioprincipal/{id?}', 'ctrRotinas@pegarEmailLocatarioPrincipal')->name('contrato.emaillocatarioprincipal');


Route::get('/contratos/vencimentocontratos', function()
{    return view('reports.admimoveis.relvencimentocontrato');
})->name('relvencontrato');

Route::get('/contratos/rescisoesrealizadas', function()
{    return view('reports.admimoveis.relresrealizadas');
})->name('relresrealizadas');

Route::get('/contratos/locacoesrealizadas', function()
{    return view('reports.admimoveis.rellocrealizadas');
})->name('rellocrealizadas');

Route::get('/imoveis/incricoes', function()
{    return view('reports.imovel.imovelinscricoes');
})->name('imoveisinscricoes');

Route::get('/imoveis/incricoes/carga', 'ctrImovel@imoveisIncricoes')->name('imoveis.incricoes.carga');
Route::get('/imoveis/pessoas/{id?}/{tipo?}', 'ctrImovel@imoveisPessoas')->name('imoveis.pessoas');
Route::get('/imoveis/geral', 'ctrImovel@imoveisGeral')->name('imoveis.geral');
Route::get('/proprietario/imoveis/{id?}', 'ctrPropImo@imoveisdoProprietario')->name('proprietario.imoveis');


Route::get('/contratos/vencimentocontratos/carga', 'ctrContrato@vencimentoContrato')->name('contrato.relvencontrato');
Route::get('/contratos/locrealizadas/carga', 'ctrContrato@locacoesRealizadas')->name('contrato.locrealizadascarga');
Route::get('/contratos/resrealizadas/carga', 'ctrContrato@rescisoesRealizadas')->name('contrato.resrealizadascarga');

Route::post('/avisodesocupacao/store', 'ctrAvisoDesocupacao@store')->name('avisodesocupacao.store');
Route::get('/avisodesocupacao/list', 'ctrAvisoDesocupacao@list')->name('avisodesocupacao.list');
Route::get('/avisodesocupacao', 'ctrAvisoDesocupacao@index')->name('avisodesocupacao');
Route::post('/avisodesocupacao/inativar/{id?}', 'ctrAvisoDesocupacao@inativar')->name('avisodesocupacao.inativar');

Route::post('/locatariocontrato/store',      'ctrLocatarioContrato@store')->name('locatariocontrato.store');
Route::get('/locatariocontrato/carga/{id?}', 'ctrLocatarioContrato@carga')->name('locatariocontrato.carga');
Route::post('/locatariocontrato/destroy/{id?}', 'ctrLocatarioContrato@destroy')->name('locatariocontrato.destroy');
Route::get('/locatarios/carga', 'ctrCliente@locatarios')->name('locatarios.carga');
Route::get('/locatario/principal/{id?}', 'ctrCliente@locatarioPrincipal')->name('locatario.principal');
Route::get('/locatarios/cargaativos', 'ctrLocatarioContrato@cargaAtivos')->name('locatariocontrato.cargaativos');
Route::get('/locatarios/contratosdolocatario/{id?}', 'ctrLocatarioContrato@contratosdoLocatario')->name('locatariocontrato.contratosdolocatario');



Route::get('/locadores/carga', 'ctrCliente@locadores')->name('locadores.carga');
Route::get('/locadores/contrato/{pasta?}', 'ctrPropImo@locadoresContrato')->name('locadores.contrato');

Route::get('/fiador/contratosdofiador/{id?}', 'ctrFiadorContrato@contratosdoFiador')->name('fiadorcontrato.contratosdofiador');

Route::post('/fiadorcontrato/store', 'ctrFiadorContrato@store')->name('fiadorcontrato.store');
Route::get('/fiadorcontrato/carga/{id?}', 'ctrFiadorContrato@carga')->name('fiadorcontrato.carga');
Route::post('/fiadorcontrato/destroy/{id?}', 'ctrFiadorContrato@destroy')->name('fiadorcontrato.destroy');

Route::post('/recibolocatario/estornar', 'ctrReciboLocatario@estornar')->name('recibolocatario.estornar');
Route::post('/recibolocatario/gravar', 'ctrReciboLocatario@store')->name('recibolocatario.gravar');
Route::get('/recibolocatariocontrole', 'ctrReciboLocatarioControle@gerar')->name('recibolocatariocontrole.gerar');
Route::get('/recibolocatario/imprimir/{id?}/{imprimir?}', 'ctrReciboLocatario@pegarRecibo')->name('recibolocatario.imprimir');
Route::get('/recibolocatario/historico/{id?}', 'ctrReciboLocatario@carregarViewHistLt')->name('recibolocatario.historico');
Route::get('/recibolocatario/historico/itensrecibo/{id?}', 'ctrReciboLocatario@itensdoRecibo')->name('recibolocatario.itensrecibo');
Route::get('/recibolocatario/carregarHistorico/{id?}/{semjson?}', 'ctrReciboLocatario@carregarHistorico')->name('recibolocatario.carregarHistorico.puro');
Route::get('/recibolocatario/ultimo', 'ctrReciboLocatario@ultimoReciboLocatario')->name('recibolocatario.ultimo');
Route::get('/recibolocatario/planilharecebimento', 'ctrReciboLocatario@planilhaRecebimento')->name('recibolocatario.planilharecebimento');

Route::get('/recibolocatario/totalrecebidoperiodo/{datainicio?}/{datafim?}/{empresa?}', 'ctrReciboLocatario@totalRecebidoPeriodo')->name('totalrecebidoperiodo');

Route::get('/extratopagamentolocatario/{id?}/{ini?}/{fim?}/{poremail?}/{email?}', 'ctrReciboLocatario@extratoRecebimentoLocatario')->name('extratopagamentolocatario');


Route::get('/recibolocatario/recebidodetalhado', 'ctrReciboLocatario@recebidoDetalhado')->name('recibolocatario.recebidodetalhado');

Route::get('/recibolocatario/recibos', 'ctrReciboLocatario@recibosLocatarioPeriodo')->name('recibolocatario.recibos');
Route::post('/recibolocatario/recebidoperiodo/{rec?}/{conta?}', 'ctrReciboLocatario@recebidoPeriodo')->name('recibolocatario.recebidoperiodo');

Route::get('/recibolocatario/recibos/{ini?}/{fim?}/{emp?}/{conta?}', 'ctrReciboLocatario@resumoRecebidoPeriodo')->name('recebido.resumo');
Route::get('/planilharecebimentos', function()
{
    return view('reports.admimoveis.planilharecebimentos');

})->name('planilharecebimento.index');

Route::get('/repassarrecebidos',  function()
{
    return view( 'reports.admimoveis.repassarrecebidos');
})->name('repassarrecebidos');

Route::get('/planilharepasses', function()
{
    return view('reports.admimoveis.planilharepasses');

})->name('planilharepasse.index');


Route::get('/movimentacaoporevento/carga', 'ctrRotinas@movimentacaoPorEvento')->name('movimentacaoporevento.carga');
Route::get('/movimentacaoporeventodetalherecebido/carga', 'ctrRotinas@movimentacaoPorEventoDetalheCarga')->name('movimentacaoporeventodetalherecebido.carga');
Route::get('/movimentacaoporeventodetalherecebido/view', 'ctrRotinas@movimentacaoPorEventoDetalheView')->name('movimentacaoporeventodetalherecebido.view');
Route::get('/movimentacaoporeventodetalherepassado/carga', 'ctrRotinas@movimentacaoPorEventoDetalheRepassadoCarga')->name('movimentacaoporeventodetalherepassado.carga');
Route::get('/movimentacaoporeventodetalherepassado/view', 'ctrRotinas@movimentacaoPorEventoDetalheRepassadoView')->name('movimentacaoporeventodetalherepassado.view');


Route::get('/movimentacaoporevento/index', function()
{
    return view( 'reports.admimoveis.movimentacaoporevento');
})->name('movimentacaoevento');

Route::get('/planilhadepositosindex', function()
{
    return view('reports.admimoveis.planilhadepositos');

})->name('planilhadepositos.index');


Route::get('/fluxocliente/{id?}', 'ctrRotinas@fluxoNegocioCliente')->name('fluxonegociocliente');
Route::post('/recibolocador/alterardatapag', 'ctrReciboLocador@alterarDataPagto')->name('recibolocador.alterardatapag');

Route::get('/recibolocadorcontrole', 'ctrReciboLocadorControle@gerar')->name('recibolocadorcontrole.gerar');
Route::post('/recibolocador/gravar', 'ctrReciboLocador@store')->name('recibolocadorcontrole.gravar');
Route::get('/recibolocador/historico/{id?}', 'ctrReciboLocador@carregarViewHistLd')->name('recibolocador.historico');
Route::get('/recibolocador/carregarHistorico/{id?}/{tiporetorno?}', 'ctrReciboLocador@carregarHistorico')->name('recibolocador.carregarHistorico.puro');
Route::get('/recibolocador/imprimir/{id?}/{imprimir?}', 'ctrReciboLocador@pegarRecibo')->name('recibolocador.imprimir');
Route::get('/recibolocador/imprimir/processo/{id?}', 'ctrReciboLocador@pegarRecibosPorProcesso')->name('recibolocador.imprimir.processo');
Route::post('/recibolocador/estornar', 'ctrReciboLocador@estornar')->name('recibolocador.estornar');
Route::get('/recibolocador/demonstrativos', 'ctrReciboLocador@demonstrativos')->name('recibolocador.demonstrativos');
Route::get('/recibolocador/demonstrativosindex', 'ctrReciboLocador@demonstrativosIndex')->name('recibolocador.demonstrativosindex');
Route::get('/recibolocador/planilharepasses', 'ctrReciboLocador@planilhaRepasse')->name('recibolocador.planilharepasses');
Route::get('/recibolocador/demonstrativosnew', 'ctrReciboLocador@demonstrativosNew')->name('recibolocador.demonstrativosnew');
Route::get('/recibolocador/historico/itensrecibo/{id?}', 'ctrReciboLocador@itensdoRecibo')->name('recibolocador.itensrecibo');

Route::get('/recibolocador/planilhadepositoscarga', 'ctrReciboLocador@repassadoPlanilhaDepositosGerar')->name('recibolocador.planilhadepositosgerar');
Route::post('/selecionardepositoonoff', 'ctrReciboLocador@selecionarDepositoOnOff')->name('selecionardepositoonoff');
Route::get('/recibolocador/informeirrf', 'ctrReciboLocador@informeirrf')->name('recibolocador.informeirrf');

Route::post('/recibolocador/repassadoperiodo/{rec?}', 'ctrReciboLocador@repassadoPeriodo')->name('recibolocador.repassadoperiodo');
Route::get('/recibolocador/totalpassadoperiodo/{datainicio?}/{datafim?}/{conta?}', 'ctrReciboLocador@totalRepassadoPeriodo')->name('totalrepassadoperiodo');
Route::get('/recibolocador/repassadoperiodorecibos', 'ctrReciboLocador@repassadoPeriodoRecibos')->name('repassadoperiodorecibos');

Route::get('/periodoinicial/{idcont?}/{data?}', 'ctrRotinas@periodoInicial')->name('periodoinicial');


Route::get('/tabelairrf', function()
{
    return view( 'tabelairrf.tabelairrf');

})->name('tabelairrf.index');
Route::get('/tabelairrf/carga', 'ctrTabelaIRRF@carga')->name('tabelairrf.carga');
Route::get('/tabelairrf/find/{id?}', 'ctrTabelaIRRF@find')->name('tabelairrf.find');
Route::post('/tabelairrf/salvar', 'ctrTabelaIRRF@store')->name('tabelairrf.salvar');




Route::post('/ficha/imovel', 'ctrFichas@fichaImovel')->name('ficha.imovel');

Route::get('/ficha/fichascaptacaoempreend','ctrFichas@fichasCaptacaoEmpreend')->name('ficha.fichascaptacaoempreend');
Route::get('/ficha/captacaoempreendimentos','ctrFichas@captacaoEmpreendimentos')->name('ficha.captacaoempreendimentos');


Route::get('/ficha/captacaoimovel','ctrFichas@fichasCaptacaoMenu')->name('ficha.fichascaptacao');
Route::get('/ficha/captacaoandarcorp','ctrFichas@captaCaoandarCorp')->name('ficha.captacaoandarcorp');
Route::get('/ficha/captacaoapartameto','ctrFichas@captacaoApartameto')->name('ficha.captacaoapartameto');
Route::get('/ficha/apartamentoduplex','ctrFichas@apartamentoDuplex')->name('ficha.apartamentoduplex');
Route::get('/ficha/apartamentotriplex','ctrFichas@apartamentoTriplex')->name('ficha.apartamentotriplex');
Route::get('/ficha/captacaoarea','ctrFichas@captacaoArea')->name('ficha.captacaoarea');
Route::get('/ficha/captacaobangalo','ctrFichas@captacaoBangalo')->name('ficha.captacaobangalo');
Route::get('/ficha/captacaobarracao','ctrFichas@captacaoBarracao')->name('ficha.captacaobarracao');
Route::get('/ficha/captacaoboxgaragem','ctrFichas@captacaoBoxGaragem')->name('ficha.captacaoboxgaragem');
Route::get('/ficha/captacaocasa','ctrFichas@captacaoCasa')->name('ficha.captacaocasa');
Route::get('/ficha/captacaochacara','ctrFichas@captacaoChacara')->name('ficha.captacaochacara');
Route::get('/ficha/captacaocobertura','ctrFichas@captacaoCobertura')->name('ficha.captacaocobertura');
Route::get('/ficha/captacaoconjunto','ctrFichas@captacaoConjunto')->name('ficha.captacaoconjunto');
Route::get('/ficha/captacaoedicula','ctrFichas@captacaoEdicula')->name('ficha.captacaoedicula');
Route::get('/ficha/captacaofazenda','ctrFichas@captacaoFazenda')->name('ficha.captacaofazenda');
Route::get('/ficha/captacaoflat','ctrFichas@captacaoFlat')->name('ficha.captacaoflat');
Route::get('/ficha/captacaogalpao','ctrFichas@captacaoGalpao')->name('ficha.captacaogalpao');
Route::get('/ficha/captacaoharas','ctrFichas@captacaoHaras')->name('ficha.captacaoharas');
Route::get('/ficha/captacaohoel','ctrFichas@captacaoHoel')->name('ficha.captacaohoel');
Route::get('/ficha/captacaoilha','ctrFichas@captacaoIlha')->name('ficha.captacaoilha');
Route::get('/ficha/captacaokitnet','ctrFichas@captacaoKitnet')->name('ficha.captacaokitnet');
Route::get('/ficha/captacaolaje','ctrFichas@captacaoLaje')->name('ficha.captacaolaje');
Route::get('/ficha/captacaoloft','ctrFichas@captacaoLoft')->name('ficha.captacaoloft');
Route::get('/ficha/captacaoloja','ctrFichas@captacaoLoja')->name('ficha.captacaoloja');
Route::get('/ficha/captacaopavilhao','ctrFichas@captacaoPavilhao')->name('ficha.captacaopavilhao');
Route::get('/ficha/captacaoponto','ctrFichas@captacaoPonto')->name('ficha.captacaoponto');
Route::get('/ficha/captacaopousada','ctrFichas@captacaoPousada')->name('ficha.captacaopousada');
Route::get('/ficha/captacaopredio','ctrFichas@captacaoPredio')->name('ficha.captacaopredio');
Route::get('/ficha/captacaorancho','ctrFichas@captacaoRancho')->name('ficha.captacaorancho');
Route::get('/ficha/captacaosala','ctrFichas@captacaoSala')->name('ficha.captacaosala');
Route::get('/ficha/captacaosalao','ctrFichas@captacaoSalao')->name('ficha.captacaosalao');
Route::get('/ficha/captacaositio','ctrFichas@captacaoSitio')->name('ficha.captacaositio');
Route::get('/ficha/captacaosobrado','ctrFichas@captacaoSobrado')->name('ficha.captacaosobrado');
Route::get('/ficha/captacaoterreno','ctrFichas@captacaoTerreno')->name('ficha.captacaoterreno');
Route::get('/ficha/personalizado/menupersonalizados','ctrFichas@menuPersonalizados')->name('ficha.menupersonalizados');

//rotinas documentos personalizados
Route::post('/docperson/store','ctrDocsPersonalizados@store')->name('docperson.store');
Route::get('/docperson/download/{arq?}','ctrDocsPersonalizados@download')->name('docperson.download');

Route::get('/resentantes/{id?}', 'ctrClienteRepresentante@indexJson')->name('representante.carga');
Route::post('/representantes/{id?}', 'ctrClienteRepresentante@store')->name('representante.save');
Route::get('/representantes/apagar/{id?}', 'ctrClienteRepresentante@destroy')->name('representante.apagar');


Route::get('/boletoperiodojson','ctrCobrancaGerada@cargaBoletosPeriodoJson')->name('boleto.periodo.email.json');
Route::get('/painelboletosenviadoscarga','ctrCobrancaGerada@painelBoletosEnviadosCarga')->name('boleto.painelenviadoscarga');
Route::get('/painelboletosenviadosindex', function()
{
    return view( 'cobrancabancaria.painelboletosenviados') ;
})->name('boleto.painelenviadosindex');



Route::get('/boleto/gerar/itau/{id?}/{email?}/{endendemail?}','ctrBoletoItau@index')->name('boleto.itau');



Route::get('/boleto/gerar/generico/{id?}','ctrCobranca@gerarGenerico')->name('boleto.generico');
Route::get('/boleto/gerar/santander/{id?}/{email?}/{endendemail?}','ctrBoleto033@index')->name('boleto.santander');
Route::get('/boleto/gerar/santander/cnab240','ctrBoletoSantander@cnab240')->name('boleto.cnab240');

Route::get('/boleto/gerar/756/{id?}/{email?}/{endendemail?}','ctrBoleto756@index')->name('boleto.756');
Route::get('/boleto/gerar/237/{id?}/{email?}/{endendemail?}','ctrBoleto237@index')->name('boleto.237');
Route::get('/boleto/gerar/001/{id?}/{email?}/{endendemail?}','ctrBoleto001@index')->name('boleto.001');
Route::get('/boleto/gerar/077/{id?}/{email?}/{endendemail?}','ctrBoleto077@index')->name('boleto.077');
Route::get('/boleto/gerar/084/{id?}/{email?}/{endendemail?}','ctrBoleto084@index')->name('boleto.084');
Route::get('/boleto/gerar/748/{id?}/{email?}/{endendemail?}','ctrBoleto748@index')->name('boleto.748');
Route::get('/boleto/gerarlote/748','ctrBoleto748@impressaoLote')->name('boleto.748.lote');
Route::get('/boleto/gerarlote/084','ctrBoleto084@impressaoLote')->name('boleto.084.lote');
Route::get('/boleto/gerarlote/001','ctrBoleto001@impressaoLote')->name('boleto.001.lote');

Route::get('/remessapagamentos/itau/gerar','ctrBoletoItau@remessaPagamentos')->name('pagamentos.itau.gerar');
Route::get('/remessapagamentos/084/gerar','ctrBoleto084@remessaPagamentos')->name('pagamentos.084.gerar');

Route::get('/remessapagamentos/itau/gerar/pix','ctrBoletoItau@remessaPix')->name('pagamentos.itau.gerar.pix');

Route::get('/cobrancabancaria', 'ctrCobrancaGerada@index')->name('cobranca.index');

Route::get('/cobrancabancaria/relgeradasconferencia', function()
{
    return view( 'reports.admimoveis.relcobrancagerada');

})->name('cobranca.relatorioconferencia');

Route::get('/cobrancabancaria/selecionartodas', 'ctrCobrancaGerada@selecionarTodos')->name('cobranca.selecionartodas');
Route::get('/cobrancabancaria/tirarselecoes', 'ctrCobrancaGerada@tirarSelecoes')->name('cobranca.tirarselecoes');

Route::get('/boleto/pegartellocatario/{id?}', 'ctrCobrancaGerada@pegarTelLocatarios')->name('boleto.pegartellocatarios');


Route::post('/cobrancabancaria/reprogramar', 'ctrCobrancaGerada@gerarCobrancaPermReprogramacao')->name('cobranca.reprogramar');
Route::post('/cobrancabancaria/reprogramartmp', 'ctrCobrancaGerada@gerarCobrancaTmpReprogramacao')->name('cobranca.reprogramartmp');

Route::get('/cobrancabancaria/gerar', 'ctrCobrancaGerada@selecionarContratos')->name('cobranca.gerar');
Route::get('/cobrancabancaria/geraravulso', 'ctrCobrancaGerada@gerarItensAvulsos')->name('cobranca.geraravulso');
Route::get('/cobrancabancaria/geradas/cargaitens/{id?}', 'ctrCobrancaGerada@cargaItens')->name('cobrancabancaria.cargaitens');
Route::get('/cobrancabancaria/geradas/cargaboletoheader/{id?}', 'ctrCobrancaGerada@cargaBoletoHeader')->name('cobrancabancaria.cargaboletoheader');
Route::get('/cobrancabancaria/geradas/carga', 'ctrCobrancaGerada@carga')->name('cobrancabancaria.cargageradas');
Route::get('/cobrancabancaria/geradas/geradas', 'ctrCobrancaGerada@geradas')->name('cobrancabancaria.cobrancagerada');
Route::get('/cobrancabancaria/geradas/bloquearboleto/{id?}/{sn?}', 'ctrCobrancaGerada@bloquearBoleto')->name('cobrancabancaria.bloquearboleto');
Route::get('/cobrancabancaria/pdfcobrancagerada', 'ctrCobrancaGerada@pdfCobrancaGerada')->name('cobranca.pdfcobrancagerada');
Route::get('/cobrancabancaria/gerarpermanente', 'ctrCobrancaGerada@gerarPermanente')->name('cobranca.gerarpermanente');
Route::get('/cobrancabancaria/gerarremessa', 'ctrCobrancaGerada@gerarRemessa')->name('cobranca.remessa');
Route::get('/cobrancabancaria/carteira/carga', 'ctrCobrancaGerada@cargaCarteira')->name('cobrancabancaria.cargacarteira');
Route::get('/cobrancabancaria/carteira', 'ctrCobrancaGerada@Carteira')->name('cobrancabancaria.carteira.index');
Route::get('/cobrancabancaria/geradas/cargaboletoheaderperm/{id?}', 'ctrCobrancaGerada@cargaBoletoHeaderPerm')->name('cobrancabancaria.cargaboletoheaderperm');
Route::get('/cobrancabancaria/geradas/cargaitensPerm/{id?}', 'ctrCobrancaGerada@cargaItensPerm')->name('cobrancabancaria.cargaitensperm');
Route::get('/cobrancabancaria/geradas/cargaitensPermsemjson/{id?}', 'ctrCobrancaGerada@cargaItensPermanenteSemJson')->name('cobrancabancaria.cargaitenspermsemjson');
Route::get('/cobrancabancaria/carteira/selecionarcobrancaperm/{id?}', 'ctrCobrancaGerada@selecionarCobrancaPerm')->name('cobrancabancaria.carteira.selecionarcobrancaperm');
Route::get('/cobrancabancaria/inativar/{id?}', 'ctrCobrancaGerada@inativarBoleto')->name('cobrancabancaria.inativar');
Route::get('/cobrancabancaria/lerretorno/index', 'ctrCobrancaGerada@lerRetorno')->name('cobrancabancaria.lerretorno.index');
Route::post('/cobrancabancaria/lerretorno/passo2', 'ctrCobrancaGerada@lerRetornoPasso2')->name('cobrancabancaria.lerretorno.passo2');
Route::get('/cobrancabancaria/baixaautomatica', 'ctrCobrancaGerada@baixaAutomatica')->name('cobrancabancaria.baixaautomatica');
Route::get('/cobrancabancaria/cargatmpretorno', 'ctrCobrancaGerada@cargaTmpRetorno')->name('cobrancabancaria.cargatmpretorno');
Route::post('/cobrancabancaria/selecionartmpretorno/{id?}', 'ctrCobrancaGerada@selecionarTMPRetorno')->name('cobrancabancaria.selecionartmpretorno');
Route::get('/cobrancabancaria/previabaixaautomatica','ctrCobrancaGerada@previewBaixaAutomatica')->name('previabaixaautomatica');
Route::get('/cobrancabancaria/previabaixaautomaticacarga','ctrCobrancaGerada@RetornoBancarioCarga')->name('previabaixaautomaticacarga');
Route::post('/cobrancabancaria/baixartitulo/{id?}/{pag?}/{ven?}/{cre?}/{ccx?}/{valpago?}', 'ctrCobrancaGerada@baixaBancaria')->name('cobrancabancaria.baixatitulo');
Route::get('/cobrancabancaria/baixartitulo/basemultajuros/{id?}', 'ctrCobrancaGerada@baseMultaJurosBoletoPerm')->name('cobrancabancaria.basemultajurosboletoperm');
Route::get('/cobrancabancaria/retornorelatliquidacoes', 'ctrCobrancaGerada@relatorioretornoliquida')->name('cobrancabancaria.retornorelatliquidacoes');
Route::get('/cobrancabancaria/relatorioretonototal', 'ctrCobrancaGerada@relatorioretorno')->name('cobrancabancaria.relatorioretonototal');
Route::get('/cobrancabancaria/boletosvencendo', 'ctrCobrancaGerada@boletosVencendoQtde')->name('cobrancabancaria.boletosvencendo');
Route::get('/cobrancabancaria/boletosvencendocarga', 'ctrCobrancaGerada@boletosVencendoCarga')->name('cobrancabancaria.boletosvencendocarga');

Route::get('/enderecocobranca/find/{id?}', 'ctrRotinas@enderecoCobrancaFind')->name('enderecocobranca.find');
Route::post('/enderecocobranca/gravar', 'ctrRotinas@enderecoCobrancaGravar')->name('enderecocobranca.gravar');
Route::post('/enderecocobranca/excluir/{id?}', 'ctrRotinas@enderecoCobrancaExcluir')->name('enderecocobranca.excluir');


Route::get('/cobrancabancaria/viewgerar', 'ctrCobrancaGerada@viewGerar')->name('cobranca.viewgerar');
Route::get('/cobrancabancaria/cargaboletos/contrato/{id?}', 'ctrCobranca@cargaBoletosContrato')->name('cobranca.cargaboletoscontrato');

Route::get('/relatorios/admimv/index', function()
{
    return view('reports.admimoveis.relatoriosadmimv');

})->name('');

Route::get('/relatorios/repasse/previsao', function()
{
    return view('repasse.previsaorepasse');

})->name('relatorioprevisaorepasse');



Route::get('/clttmp','ctrClienteTmp@criarTMP')->name('criartmp');
Route::get('/clttmplist','ctrClienteTmp@listar');

Route::post('/uploadimagem','ctrImagem@store')->name('imagensimoveis');
Route::post('/uploadimagem','ctrImagem@storeDragDrop')->name('imagensimoveisdragdrop');
Route::post('/uploadimagemusuario','ctrImagem@userStore')->name('imagensusuario');

Route::post('/uploaddocumentos','ctrImagem@storeDragDropDocumentosContratos')->name('imagensimoveisdragdropdocumentos');


//boletos
Route::get('/boletos/zerartmp/{id?}', 'ctrBoletotmp@zerarTmp')->name('boleto.zerartmp');
Route::post('/boletos/gerar/lf', 'ctrBoletotmp@gerarLf')->name('boleto.gerarlf');
Route::get('/boletos/gargaitenstmp/{id?}', 'ctrBoletotmp@cargaItensTmp')->name('boleto.cargaitenstmp');
Route::get('/boletos/excluir/{id?}', 'ctrBoletotmp@excluir')->name('boleto.selec.excluir');



//saida de
Route::get('/chaves', 'ctrSaidaChaves@index')->name('chaves');
Route::get('/chaves/saida', 'ctrSaidaChaves@saida')->name('saidachaves.saida');
Route::post('/chaves/saida/registrar', 'ctrSaidaChaves@registrar')->name('saidachaves.registrar');
Route::get('/chaves/listar', 'ctrSaidaChaves@list')->name('saidachaves.listar');
Route::get('/chaves/emvisitacao', 'ctrSaidaChaves@todosEmVisitacao')->name('saidachaves.emvisitacao');
Route::get('/chaves/clientecomchave/{id?}', 'ctrSaidaChaves@clienteComChave')->name('saidachaves.clientecomchave');
Route::post('/chaves/saida/selecionar', 'ctrSaidaChaves@selecionar')->name('saidachaves.selecionar');
Route::get('/chaves/saida/retorno', 'ctrSaidaChaves@retorno')->name('saidachaves.retorno');
Route::get('/chaves/selecionadascorretor/{id?}', 'ctrSaidaChaves@selecionadasCorretor')->name('saidachaves.selecionadascorretor');
Route::get('/chaves/show/{id?}', 'ctrSaidaChaves@show')->name('saidachaves.show');
Route::post('/chaves/confirmarretorno', 'ctrSaidaChaves@confirmarRetorno')->name('saidachaves.confirmaretorno');






//LANCAMENTOS FUTUROS
Route::get('/lancamento/rellancamentos', function()
{
    return view( 'reports.admimoveis.rellancamentos');

})->name('rellancamentos');


Route::get('/lancamento/edit/{id?}', 'ctrLancamentoFuturo@edit')->name('lancamento.edit');
Route::get('/lancamento/count/{id?}/{imb?}/{evento?}', 'ctrLancamentoFuturo@countRecords')->name('lancamento.count');
Route::get('/lancamento/lista/{id?}/{imb?}/{pagina?}/{evento?}/{aberto?}/{ven?}', 'ctrLancamentoFuturo@list')->name('lancamento.list');
Route::get('/lancamento/listavencimentos/{id?}', 'ctrLancamentoFuturo@listvencimentosselect')->name('lancamentovencimentos.select');
Route::get('/lancamento', 'ctrLancamentoFuturo@index')->name('lancamento.index');
Route::get('/lancamento/novo', 'ctrLancamentoFuturo@new')->name('lancamento.novo');
Route::post('/lancamento/gravar', 'ctrLancamentoFuturo@store')->name('lancamento.gravar');
Route::post('/lancamento/gravararray', 'ctrLancamentoFuturo@storeArray')->name('lancamento.gravararray');

Route::post('/lancamento/destativar/{id?}', 'ctrLancamentoFuturo@desativar')->name('lancamento.desativar');
Route::post('/lancamento/destativarlote/{array?}', 'ctrLancamentoFuturo@desativarLote')->name('lancamento.desativarlote');
//Route::get('/lancamento/aberto/locatario/{chave?}/{contrato?}/{somentedomes?}', 'ctrLancamentoFuturo@abertoLocatarioParcela')->name('parcelaaberta.locatario');
Route::get('/lancamento/aberto/locatario/{chave?}/{contrato?}/{somentedomes?}/{array?}', 'ctrLancamentoFuturo@abertoLocatarioParcela')->name('parcelaaberta.locatario');
Route::get('/lancamento/incidemulta/{idevento?}/{idlf?}', 'ctrLancamentoFuturo@incideMulta')->name('lancamento.incidemulta');
Route::get('/lancamento/incidejuros/{idevento?}/{idlf?}', 'ctrLancamentoFuturo@incideJuros')->name('lancamento.incidejuros');
Route::get('/lancamento/incideirrf/{idevento?}/{idlf?}', 'ctrLancamentoFuturo@incideIRRF')->name('lancamento.incideirrf');
Route::get('/lancamento/incidetaxaadm/{idevento?}/{idlf?}', 'ctrLancamentoFuturo@incideTaxaAdm')->name('lancamento.incidetaxaadm');
Route::get('/lancamento/incidecorrecao/{idevento?}/{idlf?}', 'ctrLancamentoFuturo@incideCorrecao')->name('lancamento.incidecorrecao');
Route::get('/lancamento/incideiss/{idevento?}/{idlf?}', 'ctrLancamentoFuturo@incideISS')->name('lancamento.incideiss');

Route::get('/lancamento/aberto/locador/{chave?}/{contrato?}/{array?}/{somentedomes?}', 'ctrLancamentoFuturo@lancamentoLocadorAberto')->name('parcelaaberta.locatario');
Route::get('/lancamento/vencimentonumeroparcela/{ctr?}/{ldlt?}', 'ctrLancamentoFuturo@parcelasVencimentoNumero')->name('parcelaaberta.vencimentonumeroparcela');

Route::get('/lancamento/domes/locatario/{chave?}/{contrato?}/{array?}', 'ctrLancamentoFuturo@lancamentomeslocatario')->name('locatario.lancamentomes');
Route::get('/lancamento/verificaralugueljalancado/{contrato?}', 'ctrLancamentoFuturo@verificarAluguelJaLancado')->name('lancamento.verificaralugueljalancado');
Route::get('/lancamento/lancamentosrealizados', 'ctrLancamentoFuturo@lancamentosRealizados')->name('lancamentosrealizados');
Route::get('/lancamento/calcularmultaumlancto/{idcon?}/{idlf?}/{datapag?}', 'ctrRotinas@calcularMultaUmLancto')->name('calcularmultaumlancto');
Route::get('/lancamento/calcularjurosumlancto/{idcon?}/{idlf?}/{datapag?}', 'ctrRotinas@calcularJurosUmLancto')->name('calcularjurosumlancto');



// rotinas diversas
Route::get('/rotinas/gerarparcelamento/{diafixo?}/{meses?}/{datainicial?}/{valor?}/{usarvalor?}', 'ctrRotinas@gerarParcelamento')->name('rotina.gerarparcelamento');
Route::get('/rotinas/proximodiautil/emdias/{dti?}/{dtf?}', 'ctrRotinas@proximoDiaUtilemDias')->name('proximodiautil.emdias');
Route::get('/rotinas/proximodiautil', 'ctrRotinas@proximodiaUtil')->name('proximodiautil');
Route::get('/rotinas/diasvencido/{dven?}/{dpag?}', 'ctrRotinas@diasVencido')->name('diasdevencido');
Route::get('/rotinas/pegarbasescontrato/{idcontrato?}', 'ctrRotinas@pegarBasesContrato')->name('pegarbasescontrato');
Route::get('/rotinas/calcularirrf/{idimovel?}/{nvalorbase?}', 'ctrTabelaIRRF@calcularIRRF')->name('calcularirrf');

Route::get('/rotinas/setvarimovel/{id?}', 'ctrRotinas@setVariavelImovelGlobal')->name('setarvarimovel');
Route::get('/rotinas/getvarimovel', 'ctrRotinas@getVariavelImovelGlobal')->name('getarvarimovel');
Route::get('/rotinas/setvarcliente', 'ctrRotinas@setVariavelCliente')->name('setarvarcliente');
Route::get('/rotinas/setarlistadesatualizados', 'ctrRotinas@setarListaDesatualizados')->name('setarlistadesatualizados');


Route::get('/pegarpercentualmulta/{dias?}', 'ctrTabelaMulta@pegarBaseMulta')->name('pegarpercmultatabela');
Route::get('/calcularmultaatraso/{idcontrato?}/{vencimento?}/{datapagamento?}/{basemulta?}', 'ctrCobrancaGerada@calcularMultaBoleto')->name('calcularmultaatraso');
Route::get('/calcularjurosatraso/{idcontrato?}/{vencimento?}/{datapagamento?}/{basemulta?}', 'ctrCobrancaGerada@calcularJurosBoleto')->name('calcularjurosatraso');
Route::get('/calcularbasesitemcobranca/{id?}', 'ctrCobrancaGerada@basesItemCobranca')->name('calcularbasesitemcobranca');
Route::get('/calcularbasesitemcobrancatmp/{id?}', 'ctrCobrancaGerada@basesItemCobrancaTMP')->name('calcularbasesitemcobrancatmp');




//LANCAMENTOS EVENTOS
Route::get('/eventos/carga', 'ctrEvento@carga')->name('eventos.carga');
Route::get('/eventos/find/{id?}', 'ctrEvento@find')->name('eventos.find');

Route::get('/inadimplentes', 'ctrRotinas@inadimplentesIndex')->name('inadimplentes');
Route::get('/inadimplentes/calcular', 'ctrRotinas@inadimplentesCalcular')->name('inadimplentes.calcular');
Route::get('/inadimplentes/cobrancasrealizadas/{id?}', 'ctrRotinas@cobrancasRealizadas')->name('inadimplentes.cobrancasrealizadas');
Route::get('/inadimplentes/ultimacobranca/{id?}', 'ctrRotinas@ultimaCobrancaRealizada')->name('inadimplentes.ultimacobranca');
Route::post('/inadimplentes/gravarcobranca', 'ctrRotinas@gravarCobrancaRealizada')->name('inadimplentes.gravarcobranca');
Route::get('/inadimplentes/detalhe/{id?}/{origem?}', 'ctrRotinas@calcularDetalheAtrasados')->name('inadimplentes.detalhe');
Route::get('/inadimplentes/det/totalizar', 'ctrRotinas@totalizarTMPAtrasadosDetail')->name('inadimplentes.totalizar');
Route::get('/inadimplentes/totalizar', 'ctrRotinas@valorTotalAtrasados')->name('inadimplentes.totalgeral');


//mail
Route::get('/emailimoveisresumo', 'ctrMailImoveis@resumoimoveis')->name('mail-imoveis-resumo');
Route::get('/envio-mail-atendimento/{idatm?}', 'ctrEnvioEmailAtendimento@enviarEmail')->name('envio-mail-atendimento');


Route::get('/mail/bvlocatario', 'ctrMail@bvLocatario')->name('email.bvlocatario');
Route::get('/mail/send', 'ctrMail@send')->name('email.enviar');
Route::get('/mail/send/senha/{email?}', 'ctrMail@sendSenha')->name('email.enviar.senha');
Route::post('/mail/send/senha/cliente/email', 'ctrMail@sendSenhaClienteEmail')->name('meuimovel.enviarsenhaclienteemail');

Route::get('/prioridadeatendimento/list', 'ctrAtendimentoPrioridade@lista')->name('prioridadeatendimentolista');
Route::get('/prioridadeatendimento/buscar/{id?}', 'ctrAtendimentoPrioridade@prioridade')->name('prioridade.buscar');

Route::get('/self/cliente/checarcpf/{cpf?}', 'ctrAutoCadastro@checarjacadastrado')->name('autocadastro.cliente.cpf');
Route::post('/self/cliente/gravar', 'ctrAutoCadastro@store')->name('autocadastro.salvar');
Route::post('/self/cliente/telefone/gravar', 'ctrAutoCadastro@telefonegravar')->name('autocadastro.telefone.salvar');
Route::post('/self/cliente/enviaremailself/{email?}', 'ctrAutoCadastro@sendBoasVindas')->name('autocadastro.email.self');

Route::get('/self/config/{empresa?}', 'ctrAutoCadastro@lerArquivoIni')->name('autocadastro.config.concreto');
Route::get('/self/pegarempresa/{codigo?}', 'ctrAutoCadastro@pegarIdEmpresa')->name('autocadastro.pegarempresa');
Route::get('/self/cliente/{empresa}', 'ctrAutoCadastro@index');



//auditoria
Route::get('/auditoria/imovel', 'ctrAuditoria@logImovel')->name('log.imoveis');
Route::get('/auditoria/cliente/index/{id?}', 'ctrAuditoria@logClienteIndex')->name('log.cliente.index');
Route::get('/auditoria/cliente', 'ctrAuditoria@logCliente')->name('log.cliente');

Route::get('/auditoria', 'ctrAuditoria@geralIndex')->name('auditoria');
Route::get('/auditoria/carga', 'ctrAuditoria@cargaLog')->name('auditoria.cargalog');
Route::post('/auditoria/registrarmanual', 'ctrRotinas@gravarRelato')->name('relato.gravar');

//CALCULOS
Route::get('/calculo/rec/pontualidade/{id?}/{dataven?}/{datapag?}/{valor?}', 'ctrCalculoRec@calcularPontualidade')->name('calcula.rec.pontualidade');
Route::get('/calculo/rec/multa/{id?}/{dataven?}/{datapag?}/{valor?}', 'ctrCalculoRec@calcularMulta')->name('calcula.rec.multa');
Route::get('/calculo/rec/juros/{id?}/{dataven?}/{datapag?}/{valor?}', 'ctrCalculoRec@calcularJuros')->name('calcula.rec.juros');
Route::get('/calculo/rec/correcao/{id?}/{dataven?}/{datapag?}/{valor?}', 'ctrCalculoRec@calcularCorrecao')->name('calcula.rec.correcao');
Route::get('/calculo/rec/irrf/{id?}/{dataven?}/{datapag?}/{valor?}', 'ctrCalculoRec@calcularIrrf')->name('calcula.rec.irrf');
Route::get('/calculo/rec/calcular/{id?}/{dataven?}/{datapag?}', 'ctrCalculoRec@calcularRecebimento')->name('calcula.rec.calcular');


Route::get('/pdfresumoimovel/{id?}/{email?}', "ctrPdf@gerarresumoimovel")->name('pdfresumoimovel');
Route::get('/', 'LoginController@logado')->name('home');
Route::get('/index', 'LoginController@index')->name('index');
Route::post('/login', 'LoginController@login')->name('login');
//Route::get('/login', 'homeController@index')->name('login');


//AREA FINANCEIRA
Route::get('/grupocfc', 'ctrGrupoCFC@index')->name('grupocfc');
Route::get('/grupocfc/carga', 'ctrGrupoCFC@carga')->name('grupocfc.carga');
Route::get('/grupocfc/find/{id?}', 'ctrGrupoCFC@find')->name('grupocfc.find');
Route::post('/grupocfc/salvar', 'ctrGrupoCFC@salvar')->name('grupocfc.salvar');
Route::post('/grupocfc/inativar/{id?}', 'ctrGrupoCFC@inativar')->name('grupocfc.inativar');

Route::get('/cfc', 'ctrCFC@index')->name('cfc');
Route::get('/cfc/carga', 'ctrCFC@carga')->name('cfc.carga');
Route::post('/cfc/salvar', 'ctrCFC@salvar')->name('cfc.salvar');
Route::post('/cfc/inativar/{id?}', 'ctrCFC@inativar')->name('cfc.inativar');
Route::get('/cfc/find/{id?}', 'ctrCFC@find')->name('cfc.find');
Route::get('/cfc/buscainc/{texto?}', 'ctrCFC@buscaIncremental')->name('cfc.buscainc');

Route::get('/subconta', 'ctrSubConta@index')->name('subconta');
Route::get('/subconta/carga', 'ctrSubConta@carga')->name('subconta.carga');
Route::post('/subconta/salvar', 'ctrSubConta@salvar')->name('subconta.salvar');
Route::post('/subconta/inativar/{id?}', 'ctrSubConta@inativar')->name('subconta.inativar');
Route::get('/subconta/find/{id?}', 'ctrSubConta@find')->name('subconta.find');
Route::get('/subconta/buscainc/{texto?}', 'ctrSubConta@buscaIncremental')->name('subconta.buscainc');

Route::get('/contacaixa', 'ctrContaCaixa@index')->name('contacaixa');
Route::get('/contacaixa/carga/{som?}', 'ctrContaCaixa@carga')->name('contacaixa.carga');
Route::get('/contacaixa/find/{id?}', 'ctrContaCaixa@find')->name('contacaixa.find');
Route::get('/contacaixa/carga/{id?}', 'ctrContaCaixa@carga')->name('');
Route::post('/contacaixa/salvar', 'ctrContaCaixa@salvar')->name('contacaixa.salvar');
Route::post('/contacaixa/inativar/{id?}', 'ctrContaCaixa@inativar')->name('contacaixa.inativar');


Route::get('/solicitacoes/index', 'ctrSolicitacoes@index')->name('solicitacoes.index');
Route::get('/solicitacoes/list', 'ctrSolicitacoes@list')->name('solicitacoes.list');
Route::get('/solicitacoes/tipo/carga', 'ctrSolicitacoes@cargaTipo')->name('solicitacoes.tipo.carga');
Route::get('/solicitacoes/find/{id?}', 'ctrSolicitacoes@find')->name('solicitacoes.find');
Route::post('/solicitacoes/store', 'ctrSolicitacoes@store')->name('solicitacoes.store');
Route::post('/solicitacoeseventos/store', 'ctrSolicitacoes@solicitacoesEventosSalvar')->name('solicitacoeseventos.store');
Route::get('/solicitacoes/eventos/carga/{id?}', 'ctrSolicitacoes@solicitacoesEventos')->name('solicitacoes.eventos.carga');
Route::get('/solicitacoescomevento', 'ctrSolicitacoes@solicitacoesComEventosContrato')->name('solicitacoes.comevento');

Route::get('/solicitacoes/pendentes/count', 'ctrSolicitacoes@countPendentes')->name('solicitacoes.count.pendentes');

Route::get('/caixa/menu', 'ctrLanctoCaixa@menu')->name('caixa.menu');
Route::get('/caixa/consolidadodet', 'ctrLanctoCaixa@consolidadoDetalhado')->name('caixa.consolidadodetalhado');
Route::get('/caixa/consolidadodetsubconta', 'ctrLanctoCaixa@consolidadoDetalhadoSubConta')->name('caixa.consolidadodetalhadosubconta');
Route::get('/caixa/agruparcfc', 'ctrLanctoCaixa@agruparCFC')->name('caixa.agruparcfc');
Route::get('/caixa/cfcporperiodo', 'ctrLanctoCaixa@cfcPorPeriodo')->name('caixa.cfcporperiodo');
Route::get('/caixa/subcontaporperiodo', 'ctrLanctoCaixa@subContaPorPeriodo')->name('caixa.subcontaporperiodo');
Route::get('/caixa/analiticosubconta', 'ctrLanctoCaixa@analiticoSBC')->name('caixa.analiticosubconta');
Route::get('/caixa/relanaliticosubConta', 'ctrLanctoCaixa@relAnaliticoSBC')->name('caixa.relanaliticosubconta');
Route::get('/caixa/dre', 'ctrLanctoCaixa@dre')->name('caixa.dre');



Route::get('/caixa/consolidadocfc', function()
{
    return view( 'financeiro.consolidadocfc');

})->name('caixa.consolidadocfc');

Route::get('/caixa/consolidadosubconta', function()
{
    return view( 'financeiro.consolidadosubconta');

})->name('caixa.consolidadosubconta');

Route::get('/caixa/carga', 'ctrLanctoCaixa@carga')->name('caixa.carga');
Route::get('/caixa/index', 'ctrLanctoCaixa@index')->name('caixa.index');
Route::get('/caixa/find/{id?}', 'ctrLanctoCaixa@find')->name('caixa.lanc.find');
Route::post('/caixa/salvar', 'ctrLanctoCaixa@salvar')->name('caixa.lanc.salvar');
Route::get('/caixa/saldoinicial', 'ctrLanctoCaixa@saldoInicial')->name('caixa.saldoinicial');
Route::get('/caixa/saldofinal', 'ctrLanctoCaixa@saldoFinal')->name('caixa.saldofinal');
Route::post('/caixa/lancto/desativar/{id?}', 'ctrLanctoCaixa@desativarLancamento')->name('caixa.desativarlancto');
Route::post('/caixa/lancto/conciliar', 'ctrLanctoCaixa@concilarLancamento')->name('caixa.conciliarlancamento');
Route::post('/caixa/lancto/desconciliar', 'ctrLanctoCaixa@desconcilarLancamento')->name('caixa.desconciliarlancamento');

Route::get('/catran/carga/{id?}', 'ctrCaTran@carga')->name('caixa.catranlanc');
Route::post('/catran/store', 'ctrCaTran@store')->name('caixa.catran.store');

Route::get('/camposmesclagempesquisar', function()
{
    return view('docsautomaticos.camposdemesclagem');
})->name('camposmesclagempesquisar');

Route::get('/camposmesclagem', 'ctrRotinas@camposMesclagem')->name('camposmesclagemvisualizar');

Route::get('/sms/enviar', 'ctrRotinas@sms')->name('sms.enviar');



Route::get('/portal/quantidadeimv/{id?}', 'ctrPortais@quantidadeImoveis')->name('portal.quantidadeimoveis');


Route::get('/documentosautomaticos/index', 'ctrDocsAutomaticos@index')->name('docsautomaticos.index');
Route::get('/documentosautomaticos/carga', 'ctrDocsAutomaticos@carga')->name('docsautomaticos.carga');
Route::post('/documentosautomaticos/salvar', 'ctrDocsAutomaticos@salvar')->name('docsautomaticos.salvar');
Route::get('/documentosautomaticos/visualizar/{id?}', 'ctrDocsAutomaticos@visualizar')->name('docsautomaticos.visualizar');
Route::get('/documentosautomaticos/novo', 'ctrDocsAutomaticos@novo')->name('docsautomaticos.novo');
Route::get('/documentosautomaticos/buscar/{id?}', 'ctrDocsAutomaticos@buscar')->name('docsautomaticos.buscar');
Route::post('/documentosautomaticos/desativar/{id?}', 'ctrDocsAutomaticos@desativar')->name('docsautomaticos.desativar');

Route::post('/documentosautomaticos/salvarmesclado', 'ctrDocsAutomaticos@salvarMesclado')->name('docsautomaticos.salvarmesclado');


Route::get('/verificarsereajusta/{idcontrato?}/{ven?}/{json?}', 'ctrRotinas@verificarReajustes')->name('verificarsereajusta');

Route::get('/documentosautomaticos/word', 'ctrDocsAutomaticos@gerarWord')->name('docsautomaticos.word');


Route::get('/camposmesclagem/carga', 'ctrDocsAutomaticos@cargaCamposMesclagem')->name('docsautomaticos.camposmesclagem');

Route::get('/mesclarcampo/{texto?}/{idimovel?}/{idcontrato?}', 'ctrDocsAutomaticos@mesclarCampo')->name('docsautomaticos.mesclarcampo');
Route::get('/criarregistrocampomesclagem/{grupo?}/{campo?}/{qtd?}/{titulo?}', 'ctrDocsAutomaticos@criarRegistroNovoCampo')->name('criarregistrocampomesclagem');
Route::get('/gerardocautomatico/{iddoc?}/{idcliente?}/{idcontrato?}/{idimovel?}/{naogerar?}', 'ctrDocsAutomaticos@gerarDocAutomatico')->name('docsautomaticos.gerardocautomatico');
Route::get('/documentomesclado/{iddoc?}', 'ctrDocsAutomaticos@documentoMesclado')->name('docsautomaticos.documentomesclado');
Route::get('/documentomesclado/buscar/{iddoc?}', 'ctrDocsAutomaticos@buscarDocumentoMesclado')->name('docsautomaticos.documentomescladobuscar');
Route::get('/documentosgerados', 'ctrDocsAutomaticos@documentosGerados')->name('docsautomaticos.documentosgerados');
Route::post('/docautomaticoupload', 'ctrDocsAutomaticos@upload')->name('docsautomaticos.upload');
Route::get('/docautomatico/reciboap/{id?}/{idconta?}', 'ctrDocsAutomaticos@reciboContasPagar')->name('docsautomaticos.reciboap');




Route::get('/admimoveis/relatorios', 'ctrRotinas@relatoriosAdmImoveis')->name('admimoveis.relatorios');

Route::get('/clicksign/telatestes', 'ctrClickSign@telaTestes')->name('clicksign.telatestes');
Route::get('/clicksign/teste', 'ctrClickSign@teste')->name('clicksign.teste');
Route::post('/clicksign/uploadfile', 'ctrClickSign@uploadFile')->name('clicksign.uploadfile');
Route::get('/arquivo/filetobase64/{file?}', 'ctrImagem@fileToBase64')->name('arquivo.filetobase64');



Route::group( ['middleware' => [ 'auth'] ],
    function()
    {
        Route::get('/logout','LoginController@logout')->name('logout');

    });



//graficos
Route::get('/grafico/locacoes/realizadas', 'ctrEstatisticas@novasLocacoes')->name('estatisticas.locacoesrealizadas');
Route::get('/grafico/rescisoes/realizadas', 'ctrEstatisticas@rescisoesRealizadas')->name('estatisticas.rescisoesrealizadas');
Route::get('/grafico/taxaadm', 'ctrEstatisticas@porTaxaAdm')->name('estatisticas.taxaadm');
Route::get('/grafico/inadimplencia', 'ctrEstatisticas@inadimplencia')->name('estatisticas.inadimplencia');
Route::get('/grafico/concentracaorecebimentos', 'ctrEstatisticas@concentracaoRecebimentos')->name('estatisticas.concentracaorecebimentos');
Route::get('/grafico/faixadevaloraluguel', 'ctrEstatisticas@faixadeValorAluguel')->name('estatisticas.faixadevaloraluguel');
Route::get('/grafico/crm/atmativos', 'ctrEstatisticas@crmAtendimentos')->name('estatisticas.atmativos');

Route::get('/estatistica/admimoveis', function(){ return view( 'estatisticas.estatadmimovel');})->name('estatistica.admimovel');
Route::get('/estatistica/crm', function(){ return view( 'estatisticas.estatcrm');})->name('estatistica.crm');



//    Route::get('/', 'ctrSite@index')->name('index');
    Route::get('/site', 'ctrSite@index')->name('siteindex');
    Route::get('/site/pesquisar', 'ctrSite@pesquisar')->name('site.pesquisa');;
    Route::get('/site/pesquisar', 'ctrSite@pesquisar')->name('pesquisar');;
    Route::get('/site/detalhe/{id?}', 'ctrSite@detalhe')->name('site.detalhe');;
    Route::get('/site/detalhe/{id?}', 'ctrSite@album')->name('detalhe');;

    Route::get('/siriuspage', 'ctrSiriusPage@Index')->name('siriuspage');;

    Route::get('/pdfresumoimovel/{id?}/{email?}', "ctrPdf@gerarresumoimovel")->name('pdfresumoimovel');

    Route::get('/videostreinamento/index', "ctrVideosTreinamento@index")->name('videostreinamentos.index');
    Route::get('/videostreinamento/list', "ctrVideosTreinamento@list")->name('videostreinamentos.list');

    Route::get('/rotinas/gerarparcelamentojson/{diafixo?}/{meses?}/{datainicial?}/{valorparcela?}/{valortotal?}/{idcontrato?}', 'ctrRotinas@parcelamentoJson')->name('rotina.gerarparcelamentojson');

    Route::get('/mkt/camp1', 'ctrMkt@camp1')->name('mkt.camp1');
    Route::get('/mkt/camp1/enviar', 'ctrMkt@enviarCamp1')->name('mkt.camp1.enviar');

    Route::get('/integracoes/xml-olx/{token}/{imb?}/{portal?}', 'IntegracaoController@xmlolx')->name('integracao-xml-olx');
    Route::get('/integracoes/xml-chavenamao/{token}/{imb?}/{portal?}', 'IntegracaoController@xmlChaveMao')->name('integracao-xml-chavemao');
    Route::get('/api/integracao', 'ctrApiIntegracao@list')->name('api.integracao');
    Route::get('/integracoes/zap/{idportal?}', 'ctrApiIntegracao@gerarRemessaZap')->name('integracao-xml-zap');
    
    Route::get('/cliente/meuimovel/login/{id?}', 'ctrClienteAcesso@loginMeuImovel')->name('meuimovel.login');
    Route::get('/cliente/meuimovel/recebersenha/{id?}', 'ctrClienteAcesso@meuImovelRecSenha')->name('meuimovel.recebersenha');
    Route::get('/cliente/meuimovel/pegarclientecpf/{idimb?}/{cpf?}', 'ctrClienteAcesso@clienteCPF')->name('meuimovel.pegarclientecpf');
    Route::post('/cliente/meuimovel/senha/enviar/sms', 'ctrClienteAcesso@meuImovelEnviarSenhaSMS')->name('meuimovel.enviarsenhasms');
    Route::get('/cliente/meuimovel/meusimoveis', 'ctrClienteAcesso@meusImoveis')->name('meuimovel.meusimoveis');
    Route::get('/cliente/meuimovel/meuscontratos/{id?}', 'ctrClienteAcesso@meusContratos')->name('meuimovel.meuscontratos');
    Route::post('/cliente/meuimovel/dadoscontrato', 'ctrClienteAcesso@dadosContrato')->name('meuimovel.dadoscontrato');
    Route::get('/cliente/meuimovel/dadoscontrato/boletos/{id?}', 'ctrClienteAcesso@boletos')->name('meuimovel.boletos');
    Route::get('/cliente/meuimovel/historicolt/{id?}', 'ctrClienteAcesso@carregarHistoricoLT')->name('meuimovel.historicoslt');
    Route::get('/cliente/meuimovel/demonstrativosnew', 'ctrClienteAcesso@demonstrativosNew')->name('portal.demonstrativosnew');

    Route::get('/processosautomaticos','ctrProcessosAutomaticos@boletosAutomaticos')->name('processosautomaticos');
    Route::get('/processosautomaticosjson', function()
        {
            return view( 'cobrancabancaria.telaprocessoautomatico');
    })->name('processosautomaticosjson');
    Route::get('/processosautomaticos/demonstrativosdiario','ctrProcessosAutomaticos@demonstrativosLocadorDiario')->name('processos.demodiario');

    Route::get('/cartacobranca/fiador/carta/{idcontrato?}/{idcliente?}','ctrDocsAutomaticos@cartaCobrancaFiador')->name('cartacobrancafiador');
    Route::get('/email/fiador/{idcontrato?}/{idcliente?}','ctrDocsAutomaticos@emailCobrancaFiador')->name('emailcobrancafiador');
        
 
    Route::get('/emailcobrancafiador/{idcontrato?}/{idcliente?}','ctrDocsAutomaticos@emailCobrancaLocatario')->name('emailcobrancalocatario');
    Route::get('/cartacobranca/locatario/carta/{idcontrato?}/{idcliente?}','ctrDocsAutomaticos@cartaCobrancaLocatario')->name('cartacobrancalocatario');
    Route::get('/avisoreajuste/locatario/{idcontrato?}/{idcliente?}','ctrDocsAutomaticos@emailAvisoReajusteLocatario')->name('avisoreajustelocatario');
    Route::get('/avisoreajuste/locatario/periodo','ctrDocsAutomaticos@emailAvisoReajusteLocatarioPeriodo')->name('avisoreajustelocatarioperiodo');
    Route::get('/avisoimportante/locatario','ctrDocsAutomaticos@emailLocatarioImportante')->name('avisoimportantelocatario');
    Route::get('/avisodesocupacao/{idavi?}','ctrDocsAutomaticos@avisoDesocupacao')->name('avisodesocupacao');
        
    Route::get('/cliente/acesso/login/{id?}', 'ctrClienteAcesso@iniciar')->name('clienteacesso.login');
    Route::get('/cliente/acesso/validar', 'ctrClienteAcesso@validar')->name('clienteacesso.validar');

    Route::get('/cliente/acesso/boletos/{id?}', 'ctrClienteAcesso@boletos')->name('clienteacesso.boletos');

    Route::get('/cliente/boleto/748/{id?}/{imb?}','ctrClienteBoleto748@index')->name('boleto.cliente.748');
    Route::get('/cliente/boleto/756/{id?}/{imb?}','ctrClienteBoleto756@index')->name('boleto.cliente.756');
    Route::get('/cliente/boleto/237/{id?}/{imb?}','ctrClienteBoleto237@index')->name('boleto.cliente.237');
    Route::get('/cliente/boleto/341/{id?}/{imb?}','ctrClienteBoleto341@index')->name('boleto.cliente.341');
    Route::get('/cliente/boleto/033/{id?}/{imb?}','ctrClienteBoleto033@index')->name('boleto.cliente.033');
    Route::get('/cliente/localizarcpf','ctrClienteAcesso@localizarNomePorCpf')->name('areacliente.localizarcpf');

    Route::get('/dimob/index','ctrDimob@index')->name('dimob.index');
    Route::get('/dimob/gerar/tela','ctrDimob@telaGerar')->name('dimob.tela');
    Route::post('/dimob/gerar','ctrDimob@gerar')->name('dimob.gerar');
    Route::get('/dimob/consultarbase/carga','ctrDimob@consularBase')->name('dimob.consultarbase.carga');
    Route::get('/dimob/consultarbase/index', function()
    {
        return view( 'dimob.dimobmanutencao');
    })->name('dimob.consultarbase.index');
    
    
    route::get( '/besoft/painel','ctrbeSoft@painel')->name('besoft.painel');
    route::get( '/besoft/vistoria/list','ctrbeSoft@getVistoria')->name('besoft.vistorias');
    route::get( '/besoft/login','ctrbeSoft@login')->name('besoft.login');
    
    route::get( '/besoft/tiposimoveis','ctrbeSoft@listaTiposImoveis')->name('besoft.tiposimoveis');
    route::get( '/besoft/subtiposimoveis/{id?}','ctrbeSoft@listaSubTiposImoveis')->name('besoft.listasubtiposimoveis');
        
    route::get( '/besoft/sincronizartiposimoveis','ctrbeSoft@sincronizarTiposImoveis')->name('besoft.sincronizartiposimoveis');
    route::get( '/besoft/tipostemplates','ctrbeSoft@listaTiposTemplates')->name('besoft.tipostemplates');
    route::get( '/besoft/tiposvistorias','ctrbeSoft@listaTiposVistorias')->name('besoft.tiposvistorias');
    route::get( '/besoft/listatiposassinantes','ctrbeSoft@listaTiposAssinantes')->name('besoft.listatiposassinantes');
    route::get( '/besoft/listacidades','ctrbeSoft@listaCidades')->name('besoft.listacidades');
    route::post( '/besoft/agendarvistoria','ctrbeSoft@agendarVistoria')->name('besoft.agendarvistoria');
    route::get( '/besoft/teste','ctrbeSoft@teste')->name('besoft.teste');
    route::get( '/besoft/vistoriadores','ctrbeSoft@listVistoriadores')->name('besoft.vistoriadores');
    route::get( '/besoft/vistoriadores/sincroniza','ctrbeSoft@sincronizarVistoriadores')->name('besoft.vistoriadores.sincroniza');
    route::post( '/besoft/cidades/sincronizar','ctrbeSoft@sincronizarCidades')->name('besoft.cidades.sincroniza');
    route::get( '/besoft/gerarlaudo','ctrbeSoft@gerarLaudo')->name('besoft.gerarlaudo');
    
    
    //BOTCONVERSAS
    route::get( '/botconversa/cliente/pegarnomeporcpf/{cpf?}','ctrBotConversa@pegaClienteCpf')->name('botconversa.pegarnomeporcpf');
    route::get( '/botconversa/cliente/procurarBoletoCpf/{cpf?}','ctrBotConversa@procurarBoletoCpf')->name('botconversa.procurarBoletoCpff');
    

    route::delete( '/besoft/apagarvistoria/{id?}','ctrbeSoft@apagarVistoria')->name('besoft.apagarvistoria');
    
    
    route::post( '/lead/captura/vivareal','ctrLeads@capturarVivaReal')->name('leads.captura.vivareal');
    

    

