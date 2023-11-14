<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Log;
use App\mdlVideosTreinamento;
use App\mdlCamposMesclagem;
use App\mdlCamposSistema;
use Auth;

class mdwSincronizaCampos
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $this->criarCampos();
        return $next($request);
    }

    public function criarCampos()
    {

        $tb = "CREATE TABLE if not exists WSMENSAGENS ( ".
            "ID BIGINT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY, ".
            "MTYPE VARCHAR(20) NOT NULL , ".
            "BODY_INSTANCE_KEY VARCHAR(200) NOT NULL, ".
            "BODY_KEY VARCHAR(100) NULL DEFAULT NULL , ".
            "BODY_KEY_REMOTEJID VARCHAR(100) NULL DEFAULT NULL , ".
            "BODY_KEY_FROMME CHAR(1) NULL DEFAULT NULL , ".
            "BODY_KEY_ID VARCHAR(100) NULL DEFAULT NULL , ".
            "BODY_MESSAGETIMESTAMP TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(), ".
            "BODY_PUSHNAME VARCHAR(100) NULL DEFAULT NULL, ".
            "BODY_BROADCAST CHAR(1) NULL DEFAULT NULL , ".
            "BODY_STATUS VARCHAR(1) NULL DEFAULT NULL , ".
            "MODY_MESSAGE_CONVERSATION TEXT NULL DEFAULT NULL, ".
            "IMB_CLT_ID INT(11) NULL DEFAULT NULL)";
            
       DB::statement("$tb");

        $tb = "CREATE TABLE if not exists IMB_RECURSOS (".
            "IMB_RSC_ID INT(11) NOT NULL  PRIMARY KEY AUTO_INCREMENT,".
            "IMB_RSC_NOME VARCHAR(100) NOT NULL,".
            "IMB_RSC_LABEL VARCHAR(50) NOT NULL,".
            "IMB_RSC_MODULO VARCHAR(50) NOT NULL,".
            "IMB_RSC_TIPORECURSO VARCHAR(20),".
            "IMB_RSC_GRUPO VARCHAR(50),".
            "IMB_RSC_DTHATIVO DATETIME,".
            "IMB_RSC_DTHINATIVO DATETIME)";
       DB::statement("$tb");

       $tb = "CREATE TABLE if not exists IMB_ATENDENTEDIREITOACESSO (".
            "IMB_ATD_ID INT(11) NOT NULL,".
            "IMB_DIRACE_INCLUSAO CHAR(1) NULL DEFAULT NULL ,".
            "IMB_DIRACE_ALTERACAO CHAR(1) NULL DEFAULT NULL,".
            "IMB_DIRACE_EXCLUSAO CHAR(1) NULL DEFAULT NULL ,".
            "IMB_DIRACE_ACESSO CHAR(1) NULL DEFAULT NULL ,".
            "IMB_DIRACE_ID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,".
            "IMB_RSC_ID INT(11) NOT NULL)";
       DB::statement("$tb");

        $tb = "CREATE TABLE if not exists  IMB_ATENDENTEPERFILLEADBAIRRO (".
         "   IMB_ATB_ID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,".
         "   IMB_ATL_ID INT(11) NOT NULL,".
         "   CEP_BAI_ID INT(11) NULL DEFAULT NULL)";
        DB::statement("$tb");

        
        $tb = "CREATE TABLE if not exists  IMB_ATENDENTEPERFILLEADCONDOM(".
            "IMB_ATC_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,".
            "IMB_CND_ID INT NOT NULL,".
            "IMB_ATL_ID INT NOT NULL)";
        DB::statement("$tb");


        $tb = "CREATE TABLE if not exists  IMB_ATENDENTEPERFILLEADTIPIMO(".
                            "IMB_ATI_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,".
                            "IMB_ATL_ID INT NOT NULL,".
                            "IMB_TIM_ID INT)";  
            DB::statement("$tb");

        $tb = "CREATE TABLE if not exists  IMB_ATENDENTEPERFILLEADNEGOCIO(".
            "IMB_ALN_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,".
            "IMB_ATL_ID INT NOT NULL,".
            "IMB_NEG_ID INT)";
            DB::statement("$tb");


            $tb = "CREATE TABLE if not exists  IMB_ATENDENTEPERFILLEAD(".
                "IMB_ATL_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,".
                "IMB_ATD_ID INT NOT NULL,".
                "IMB_NEG_ID VARCHAR(100),".
                "IMB_IMV_ID INT,".
                "IMB_ATL_FAIXAINICIALPRECO NUMERIC(12,2),".
                "IMB_ATL_FAIXAFINALPRECO NUMERIC(12,2),".
                "IMB_ATL_TIPOSIMOVEIS VARCHAR(400),".
                "IMB_ATL_CONDOMINIOS VARCHAR(1000),".
                "IMB_ATL_BAIRROS VARCHAR(3000),".
                "IMB_ATL_DTHATIVO DATETIME,".
                "IMB_ATL_DTJINATIVO DATETIME )";
            DB::statement("$tb");


            $tb = "CREATE TABLE if not exists IMB_CONDOMINIOIMAGEM (".
                "IMB_IMB_ID INT(11) NOT NULL,".
                "IMB_IMV_ID INT(11) NOT NULL,".
                "IMB_IMG_ID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,".
                "IMB_IMG_PRINCIPAL CHAR(1) NULL DEFAULT NULL, ".
                "IMB_IMG_NOME VARCHAR(200) NULL DEFAULT NULL ,".
                "IMB_IMV_DESCRICAO VARCHAR(500) NULL DEFAULT NULL  ,".
                "IMB_IMG_CAPA CHAR(1) NULL DEFAULT NULL  ,".
                "IMB_IMG_LANCAMENTO CHAR(1) NULL DEFAULT NULL  ,".
                "IMB_IMV_FINALIDADE CHAR(1) NULL DEFAULT NULL  ,".
                "IMB_IMG_NAOIRPROSITE CHAR(1) NULL DEFAULT NULL  ,".
                "IMB_IMG_SEQUENCIA BIGINT(20) NULL DEFAULT NULL, ".
                "IMB_IMG_ARQUIVO VARCHAR(500) NULL DEFAULT NULL  ,".
                "IMB_IMG_IMAGEM VARCHAR(500) NULL DEFAULT NULL  ,".
                "imb_img_dthativo DATE NULL DEFAULT NULL, ".
                "imb_atd_id INT(11) NULL DEFAULT NULL, ".
                "IMB_IMG_IMAGEMDESCOMP VARCHAR(100) NULL )";
            DB::statement("$tb");
            


        $tb = "CREATE TABLE if not exists IMB_EQUIPE (".
            "IMB_EQP_ID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,".
            "IMB_EQP_DESCRICAO VARCHAR(20) NOT NULL,".
            "IMB_EQP_OBSERVACAO VARCHAR(1000) NULL DEFAULT NULL ,".
            "IMB_IMB_ID INT(11) NOT NULL,".
            "IMB_EQP_DTHATIVO DATETIME NOT NULL,".
            "IMB_EQP_DTHINATIVO DATETIME )";
            DB::statement("$tb");


        $tb = "CREATE TABLE if not exists  IMB_EQUIPEMEMBROS(	".
                "IMB_EPM_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,	".
                "IMB_EQP_ID INT NOT NULL,	".
                "IMB_ATD_ID INT NOT NULL,	".
                "IMB_EPM_LIDER CHAR(01),	".
                "IMB_EPM_GERENTE CHAR(01),	".
                "IMB_EPM_DTHINATIVO DATETIME,	".
                "IMB_EPM_DTHATIVO DATETIME)	";
            DB::statement("$tb");
                    
                    
            $tb = "CREATE TABLE if not exists IMB_NEGOCIO (".
            "IMB_NEG_ID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,".
            "IMB_NEG_DESCRICAO VARCHAR(20) NOT NULL ,".
            "IMB_NEG_OBSERVACAO VARCHAR(1000) NULL DEFAULT NULL,".
            "IMB_IMB_ID INT(11) NOT NULL,".
            "IMB_NEG_DTHATIVO DATETIME NOT NULL,".
            "IMB_NEG_DTHINATIVO DATETIME NULL DEFAULT NULL)";
         DB::statement("$tb");
    
         $tb = "CREATE TABLE if not exists  IMB_EQUIPENEGOCIO (".
         "IMB_EQN_ID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,".
         'IMB_NEG_ID INT(11) NOT NULL,'.
         'IMB_EQP_ID INT(11) NOT NULL)';
      DB::statement("$tb");
 
$tb = "CREATE TABLE if not exists CAMPOSDOSISTEMA(".
            "id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,".
            "campo VARCHAR(100) NOT NULL,".
            "descricao VARCHAR(400) NOT null,".
            "formatacao varchar(100) )";
            DB::statement("$tb");


        $tb = "CREATE TABLE if not exists TMP_TAXASRECEBIDAS(".
            "IMB_TAXREC_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,".
            "IMB_IMB_ID INT NOT NULL,".
            "IMB_ATD_ID INT NOT NULL,".
            "FIN_RLD_VALOR NUMERIC(12,2),".
            "IMB_TAXREC_ORIGEM VARCHAR(20) NOT NULL,".
            "IMB_TBE_ID INT NOT NULL,".
            "IMB_TBE_NOME VARCHAR(40),".
            "IMB_RLD_DATAVENCIMENTO DATE,".
            "IMB_RLD_DATAPAGAMENTO DATE,".
            "FIN_CCX_ID VARCHAR(10),".
            "IMB_RLD_VALOR NUMERIC(12,2),".
            "IMB_RLD_OBSERVACAO VARCHAR(100),".
	        "IMB_CTR_REFERENCIA VARCHAR(10),".
	        "IMB_IMV_ID INT,".
	        "ENDERECOIMOVEL VARCHAR(80),".
	        "CONDOMINIO VARCHAR(40),".
	        "LOCADOR VARCHAR(40),".
	        "LOCATARIO VARCHAR(40),".
            "TOTALRELATORIO NUMERIC(12,2) )";
        DB::statement("$tb");

        

        $tb = "CREATE TABLE if not exists  BE_VISTORIADORES(".
            "usu_codigo INT NOT NULL PRIMARY KEY,".
            "username VARCHAR(30),".
            "first_name VARCHAR(30),".
            "last_name VARCHAR(30),".
            "usu_cpf VARCHAR(20),".
            "usu_vistoriador CHAR(1),".
            "Imobiliaria INT,".
            "IMB_IMB_ID INT,".
            "email VARCHAR(200) )";        
        DB::statement("$tb");
    

        $tb = "CREATE table if not exists BE_TIPOIMOVEL(".
        "tic_codigo INT NOT NULL PRIMARY KEY,".
        "tic_nome VARCHAR(50) NOT NULL,".
        "tic_dthsincroniza DATETIME NOT null)";
        DB::statement("$tb");

        $tb = "CREATE table if not exists BE_SUBTIPOIMOVEL(".
        "ist_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,".
        "tic_codigo INT NOT NULL,".
        "ist_codigo INT NOT NULL,".
        "ist_nome VARCHAR(50) NOT NULL,".
        "ist_dthsincroniza DATETIME NOT null);";        
        DB::statement("$tb");


        $tb = "CREATE TABLE if not exists  BE_CIDADES(".
            "cid_codigo INT NOT NULL PRIMARY KEY,".
            "cid_nome VARCHAR(40) NOT NULL,".
            "est_codigo INT NOT NULL)";
        DB::statement("$tb");
    
        $tb = "CREATE TABLE if not exists  IMB_ATENDENTEUNIDADE (".
            "IMB_ATU_ID INT NOT NULL PRIMARY KEY,".
            "IMB_ATD_ID INT NOT NULL,".
            "IMB_IMB_ID INT NOT NULL,".
            "IMB_ATU_STATUS CHAR(01))";
        DB::statement("$tb");
    

        $tb = "CREATE TABLE if not exists IMB_TIPOSDOCUMENTOSPESSOAIS(".
            "IMB_TDP_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,".
            "IMB_TPD_NOME VARCHAR(50) NOT NULL,".
            "IMB_TPD_DESTINO VARCHAR(20) NOT NULL,".
            "IMB_TPD_DTHINATIVO DATETIME)";
        DB::statement("$tb");

        $tb = "CREATE TABLE if not exists IMB_LEADS(".
            "IMB_LED_ID INT NOT NULL PRIMARY KEY auto_increment,".
            "IMB_IMB_ID INT NOT NULL,".
            "IMB_POR_ID INT NOT NULL,".
            "IMB_LED_DTHATIVO DATETIME NOT NULL,".
            "IMB_LED_DATAHORA DATETIME NOT NULL,".
            "IMB_LED_IP VARCHAR(100),".
            "IMB_LED_NOME VARCHAR(100),".
            "IMB_LED_EMAIL VARCHAR(200),".
            "IMB_LED_TELEFONE VARCHAR(200),".
            "IMB_IMV_ID INT ,".
            "IMB_IMV_REFERE VARCHAR(10),".
            "IMB_ATM_ID INT)";
        DB::statement("$tb");
        
        $tb = "CREATE TABLE IF NOT EXISTS BEVISTORIA (".
            "IMB_IMB_ID int(11) NOT NULL,".
            "BE_USERNAME varchar(200) NOT NULL,".
            "BE_PASSWORD varchar(200) NOT NULL,".
            "BE_ENDPOINT_LOGINGERATOKEN varchar(500) DEFAULT NULL,".
            "BE_ENDPOINT_TIPOSIMOVEIS varchar(500) DEFAULT NULL,".
            "BE_ENDPOINT_TIPOSTEMPLATES varchar(500) DEFAULT NULL,".
            "BE_ENDPOINT_TIPOSVISTORIAS varchar(500) DEFAULT NULL,".
            "BE_ENDPOINT_TIPOSASSINANTE varchar(500) DEFAULT NULL,".
            "BE_ENDPOINT_LISTACIDADES varchar(500) DEFAULT NULL,".
            "BE_ENDPOINT_VISTORIAAGENDA varchar(500) DEFAULT NULL,".
            "BE_ENDPOINT_VISTORIAGET varchar(500) DEFAULT NULL,".
            "BE_ENDPOINT_VISTORIAGERARLAUDO varchar(500) DEFAULT NULL,".
            "BE_ENDPOINT_VISTORIADELETEVISTORIA varchar(500) DEFAULT NULL,".
            "BE_ENDPOINT_VISTORIADORLIST varchar(500) DEFAULT NULL,".
            "BE_ENDPOINT_VISTORIADORADD varchar(500) DEFAULT NULL,".
            "BE_ENDPOINT_VISTORIADORDELETE varchar(500) DEFAULT NULL,".
            "BE_ENDPOINT_IMOBILIARIALIST varchar(500) DEFAULT NULL,".
            "BE_ENDPOINT_IMOBILIARIAAD varchar(500) DEFAULT NULL,".
            "BE_ENDPOINT_IMOBILIARIAUPD varchar(500) DEFAULT NULL,".
            "BE_ENDPOINT_IMOBILIARIADEL varchar(500) DEFAULT NULL,".
            "BE_ENDPOINT_WEBHOOKVISTORIAPRONTA varchar(500) DEFAULT NULL,".
            "PRIMARY KEY (IMB_IMB_ID) )";
        DB::statement("$tb");          

        $tb = "CREATE TABLE IF NOT EXISTS BE_VISTORIASGERADAS( ".
            "vis_vis_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,".
            "imb_imb_id INT not null,".
            "vis_codigo INT ,".
            "imo_codigo INT,".
            "imb_imv_id INT,".
            "imb_ctr_id INT,".
            "ImovelTipo_tic_nome VARCHAR(100),".
            "Imovel_Subtipo_ist_codigo INT,".
            "Imovel_ist_nome VARCHAR(100),".
            "Imovel_Imobiliaria_imb_codigo INT,".
            "Imovel_Imobiliaria_imb_nomefantasia VARCHAR(100),".
            "Imovel_Cidade_cid_nome VARCHAR(50),".
            "Imovel_Status VARCHAR(40),".
            "Imovel_imo_latitude VARCHAR(20),".
            "Imovel_imo_longitude VARCHAR(20),".
            "Imovel_imo_endereco VARCHAR(60),".
            "Imovel_imo_numero VARCHAR(20),".
            "Imovel_imo_complemento VARCHAR(20),".
            "Imovel_imo_bairro varchar(40),".
            "Imovel_imo_identificador INT,".
            "Vistoriador_usu_codigo int,".
            "Vistoriador_username VARCHAR(30),".
            "Vistoriador_first_name VARCHAR(30),".
            "Vistoriador_last_name VARCHAR(30),".
            "Vistoriador_email VARCHAR(200),".
            "Usuario_usu_codigo int,".
            "Usuario_username VARCHAR(30),".
            "Usuario_first_name VARCHAR(30),".
            "Usuario_last_name VARCHAR(30),".
            "Usuario_email VARCHAR(200),".
            "Status_vist_codigo INT,".
            "Status_vist_status VARCHAR(20),".
            "Tipo_visti_codigo INT,".
            "Tipo_visti_tipo VARCHAR(20),".
            "vis_datahora DATETIME,".
            "vis_datarealizacao DATETIME, ".
            "datahoraenviadaapp datetime )";
        DB::statement("$tb");          
          
        $tb = "ALTER TABLE IMB_MODULO ".
        "ADD IF NOT EXISTS IMB_MOD_GERAL CHAR(01), ".
        "ADD IF NOT EXISTS IMB_MOD_ADM CHAR(01), ".
        "ADD IF NOT EXISTS IMB_MOD_FIN CHAR(01), ".
        "ADD IF NOT EXISTS IMB_MOD_CRM CHAR(01) ";
        DB::statement("$tb");
        
        $tb = "ALTER TABLE IMB_MODULO ".
        "ADD IF NOT EXISTS IMB_MOD_CFG CHAR(01), ".
        "ADD IF NOT EXISTS IMB_MOD_ADM CHAR(01), ".
        "ADD IF NOT EXISTS IMB_MOD_FIN CHAR(01), ".
        "ADD IF NOT EXISTS IMB_MOD_CRM CHAR(01) ";
        DB::statement("$tb");
        
        $tb = "CREATE TABLE IF NOT EXISTS TMP_RESUMOACORDO        (".
        "   TMP_RAC_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,".
        "   IMB_TBE_ID INT NOT NULL,".
        "   IMB_TBE_NOME VARCHAR(100),".
        "  IMB_LCF_VALOR NUMERIC(12,2) ) ";
        DB::statement("$tb");

        $tb = "CREATE TABLE IF NOT EXISTS IMB_CONTRATOANEXOS".
        "(  IMB_CTA_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,".
        "    IMB_CTR_ID INT NOT NULL,".
        "    IMB_CLT_ID INT ,".
        "    IMB_IMV_ID INT ,".
        "    IMB_ATD_ID INT NOT NULL,".
        "    IMB_IMB_ID INT NOT NULL,".
        "    IMB_CTA_TIPO VARCHAR(30 ),".
        "    IMB_CTA_NOMEARQUIVO VARCHAR(255),".
        "    IMB_CTA_DESCRICAO VARCHAR(200),".
        "    IMB_CTA_DTHATIVO DATETIME NOT NULL,".
        "    IMB_CTA_EXTENSAO VARCHAR(10))";
        DB::statement("$tb");

        
        $tb = "ALTER TABLE IMB_CLIENTEATENDIMENTO ".
        " ADD IF NOT EXISTS IMB_CLA_CIENTE CHAR(01)";
        DB::statement("$tb");


        $tb = "CREATE TABLE if not exists IMB_ATENDIMENTOFILA(".
           "IMB_ATF_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT, ".
           "IMB_ATD_ID INT NOT NULL, ".
           "IMB_ATF_SEQUENCIA INT NOT NULL, ".
           "IMB_ATF_NOTIFICADO CHAR(01), ".
           "IMB_ATF_FINALIZADO CHAR(01), ".
           "IMB_ATF_EMATENDIMENTO CHAR(01) )";
        DB::statement("$tb");


        
//        $tb = "DROP TRIGGER IF EXISTS TG_RLD_INS ";
  //      DB::statement("$tb");
        
        
        $tb = " CREATE TABLE IF NOT EXISTS TMP_PREVISAORECEBIMENTO (IMB_CGR_ID INT(11) NOT NULL AUTO_INCREMENT,".
        "IMB_IMV_ID INT(11) NULL DEFAULT NULL,".
        "IMB_CGR_DESTINATARIO VARCHAR(40) NULL DEFAULT NULL  ,".
        "IMB_CGR_ENDERECO VARCHAR(50) NULL DEFAULT NULL  ,".
        "IMV_CGR_CEP VARCHAR(8) NULL DEFAULT NULL  ,".
        "IMB_CEP_BAI_NOME VARCHAR(30) NULL DEFAULT NULL  ,".
        "IMB_CEP_CID_NOME VARCHAR(40) NULL DEFAULT NULL  ,".
        "IMB_CGR_DATAVENCIMENTO DATE NULL DEFAULT NULL,".
        "IMB_CGR_VALOR DECIMAL(12,2) NULL DEFAULT NULL,".
        "CEP_UF_SIGLA VARCHAR(2) NULL DEFAULT NULL  ,".
        "IMB_CGR_CPF VARCHAR(20) NULL DEFAULT NULL  ,".
        "IMB_CGR_PESSOA CHAR(1) NULL DEFAULT NULL  ,".
        "IMB_CGR_VALORDESCONTONORMAL DECIMAL(12,2) NULL DEFAULT NULL,".
        "IMB_CGR_VALORPONTUALIDADE DECIMAL(12,2) NULL DEFAULT NULL,".
        "IMB_CGR_PONTUALIDADEVENCIMENTO DECIMAL(12,2) NULL DEFAULT NULL,".
        "IMB_CTR_ID INT(11) NULL DEFAULT NULL,".
        "IMB_CGR_SELECIONADA CHAR(1) NULL DEFAULT NULL  ,".
        "IMB_CGR_IMOVEL VARCHAR(100) NULL DEFAULT NULL  ,".
        "IMB_CGR_VALORIRRF DECIMAL(12,2) NULL DEFAULT NULL,".
        "FIN_CCR_ID VARCHAR(5) NULL DEFAULT NULL  ,".
        "IMB_ATD_ID INT(11) NULL DEFAULT NULL,".
        "IMB_CGR_ARQUIVO CHAR(1) NULL DEFAULT NULL  ,".
        "IMB_CGR_RENOVAR VARCHAR(20) NULL DEFAULT NULL  ,".
        "IMB_CGR_REAJUSTAR VARCHAR(20) NULL DEFAULT NULL  ,".
        "IMB_CTR_PARCELALT INT(11) NULL DEFAULT NULL,".
        "IMB_CGR_INCONSISTENCIA VARCHAR(100) NULL DEFAULT NULL  ,".
        "IMB_CGR_DATALIMITE DATE NULL DEFAULT NULL,".
        "IMB_CTR_REFERENCIA VARCHAR(10) NULL DEFAULT NULL  ,".
        "PRIMARY KEY (IMB_CGR_ID) USING BTREE)" ;
        DB::statement("$tb");

        $tb = "CREATE TABLE IF NOT EXISTS IMB_REGIAODACIDADE(".
            "IMB_RGC_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,".
            "IMB_IMB_ID INT NOT NULL,".
            "IMB_RGC_NOME VARCHAR(40) NOT NULL    )";        
        DB::statement("$tb");

        $tb = "CREATE TABLE IF NOT EXISTS TMP_PREVISAOTAXAADM (".
            "ID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,".
            "IMB_IMB_ID INT(11) NOT NULL,".
            "IMB_CTR_ID INT(11) NOT NULL,".
            "IMB_CTR_REFERENCIA VARCHAR(10) NULL,".
            "IMB_IMV_ID INT NOT NULL, ".
            "ENDERECO VARCHAR(100),".
            "LOCADOR VARCHAR(40) ,".
            "DATAVENCIMENTO DATE ,".
            "VALORTAXA DECIMAL(12,2) ,".
            "VALORTAXACONTRATO DECIMAL(12,2),".
            "IMB_ATD_ID INT(11) NOT NULL)";
        DB::statement("$tb");
        
        $tb = "CREATE TABLE IF NOT EXISTS TMP_PREVISAORECEBIMENTODETAIL (".
            "IMB_CGI_ID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,".
            "IMB_CGR_ID INT(11) NULL DEFAULT NULL,".
            "IMB_LCF_ID INT(11) NULL DEFAULT NULL,".
            "IMB_TBE_ID INT(11) NULL DEFAULT NULL,".
            "IMB_TBE_DESCRICAO VARCHAR(40) NULL DEFAULT NULL,".
            "IMB_RLT_LOCATARIOCREDEB CHAR(1) NULL DEFAULT NULL,".
            "IMB_RLT_LOCADORCREDEB CHAR(1) NULL DEFAULT NULL,".
            "IMB_LCF_VALOR DECIMAL(12,2) NULL DEFAULT NULL,".
            "IMB_LCF_OBSERVACAO VARCHAR(100) NULL DEFAULT NULL,".
            "IMB_ATD_ID INT(11) NULL DEFAULT NULL,".
            "IMB_LCF_DATAVENCIMENTO DATE NULL DEFAULT NULL,".
            "IMB_CLT_ID INT(11) NULL DEFAULT NULL,".
            "IMB_IMB_ID INT(11) NULL DEFAULT NULL)";        
        DB::statement("$tb");

        $tb = "CREATE TABLE IF NOT EXISTS TMP_RELRECEBIMENTODIA ( ".
            "TMP_RRD_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT, ".
            "IMB_RLT_NUMERO INT NOT NULL, ".
            "IMB_CTR_ID INT NOT NULL, ".
            "IMB_IMV_ID INT NOT NULL, ".
            "TMP_RRD_ENDERECOIMOVEL VARCHAR(100), ".
            "TMP_RRD_NOMELOCATARIO VARCHAR(100), ".
            "IMB_RLT_DATAPAGAMENTO DATE, ".
            "IMB_RLT_DATACOMPETENCIA DATE, ".
            "IMB_RLT_FORMAPAGAMENTO VARCHAR(20), ".
            "FIN_CCX_ID INT, ".
            "IMB_TBE_ID INT, ".
            "IMB_TBE_NOME VARCHAR(40), ".
            "IMB_LCF_OBSERVACAO VARCHAR(200), ".
            "IMB_ATD_ID INT)";
        DB::statement("$tb");

        $tb = "CREATE OR REPLACE VIEW VLANCAMENTOCAIXA( ".
        "    FIN_CAT_OPERACAO,  ".
        "    FIN_CFC_ID,  ".
        "    FIN_LCX_ANOMES, ".
        "    FIN_LCX_MESANO, ".
        "    FIN_LCX_DATAENTRADA, ".
        "    FIN_CAT_VALOR, ".
        "    FIN_CFC_TIPOORD, ".
        "    FIN_CFC_NOME, ".
        "    FIN_GCF_DESCRICAO, ".
        "    FIN_LCX_CONCILIADO, ".
        "    FIN_CAT_APARECERCONSOLID,  ".
        "    FIN_LCX_COMPETENCIA ".
        ") ".
        "AS ".
        "SELECT  ".
        "    FIN_CAT_OPERACAO, ".
        "    FIN_CATRAN.FIN_CFC_ID, ".
        "    CONCAT( YEAR(FIN_LCX_DATAENTRADA),LPAD(MONTH(FIN_LCX_DATAENTRADA ),2,'0')   )	, ".
        "    CONCAT( LPAD(MONTH(FIN_LCX_DATAENTRADA ),2,'0'),'/',YEAR(FIN_LCX_DATAENTRADA )  ), ".
        "    FIN_LCX_DATAENTRADA, ".
        "    CASE  ".
        "        WHEN FIN_CAT_OPERACAO = 'D' THEN FIN_CAT_VALOR * -1 ".
        "        WHEN FIN_CAT_OPERACAO = 'C' THEN FIN_CAT_VALOR  ".
        "    END VALOR, ".
        "    FIN_CFC_TIPORD, ".
        "    FIN_CFC_DESCRICAO, ".
        "    ( SELECT FIN_GRUPOCFC.FIN_GCF_DESCRICAO  ".
        "       FROM FIN_GRUPOCFC WHERE FIN_GRUPOCFC.FIN_GCF_ID = FIN_CFC.FIN_GCF_ID), ".
        "       FIN_LCX_CONCILIADO ".
        "       ,FIN_CAT_APARECERCONSOLID ".
        "       ,	FIN_LCX_COMPETENCIA ".
        "    FROM FIN_CATRAN, FIN_LANCTOCAIXA, FIN_CFC ".
        "    WHERE FIN_CATRAN.FIN_LCX_ID = FIN_LANCTOCAIXA.FIN_LCX_ID ".
        "    AND FIN_CATRAN.FIN_CFC_ID = FIN_CFC.FIN_CFC_ID;         ";
        DB::statement("$tb");

        $tb ="CREATE TABLE IF NOT EXISTS FIN_TABELACONCILIACAOARQUIVO  (".
            "FIN_CNC_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,".
            "FIN_CCX_ID INT NOT NULL,".
            "FIN_CNC_OPERACAO VARCHAR(10),".
            "FIN_CNC_VALOR NUMERIC(12,2),".
            "FIN_CNC_DATA DATE,".
            "FIN_CNC_DESCRICAO VARCHAR(500),".
            "FIN_CFC_UNIQUEID VARCHAR(100),".
            "FIN_LCX_ID INT)";
        DB::statement("$tb");
               
$this->verificarExistencia( "TMP_RELRECEBIMENTODIA","IMB_CTR_REFERENCIA","VARCHAR(10)" );


$this->verificarExistencia( "IMB_PARAMETROS2","IMB_PRM_DEMONSTRATIVOPDF", 'CHAR(01)');
$this->verificarExistencia( "IMB_PARAMETROS2","IMB_PRM_PLARECTCDATARECTO", 'CHAR(01)');
$this->verificarExistencia( "IMB_PARAMETROS2","IMB_PRM_WSAPELIDO", 'VARCHAR(20)');
$this->verificarExistencia( "IMB_PARAMETROS2","IMB_PRM_WSWEBHOOK", 'VARCHAR(1000)');
$this->verificarExistencia( "IMB_PARAMETROS2","IMB_PRM_TCPAR1COBRARTA", 'CHAR(01)');
$this->verificarExistencia( "IMB_PARAMETROS2","IMB_PRM_TCPAR1INCTA" , 'CHAR(01)');
$this->verificarExistencia( "IMB_PARAMETROS2","IMB_PRM_TCPAR2COBRARTA", 'CHAR(01)');
$this->verificarExistencia( "IMB_PARAMETROS2","IMB_PRM_TCPAR2INCTA" , 'CHAR(01)');
$this->verificarExistencia( "IMB_PARAMETROS2","IMB_PRM_TCPAR3COBRARTA", 'CHAR(01)');
$this->verificarExistencia( "IMB_PARAMETROS2","IMB_PRM_TCPAR3INCTA" , 'CHAR(01)');
$this->verificarExistencia( "IMB_PARAMETROS2","IMB_PRM_TCPAR4COBRARTA", 'CHAR(01)');
$this->verificarExistencia( "IMB_PARAMETROS2","IMB_PRM_TCPAR4INCTA" , 'CHAR(01)');
$this->verificarExistencia( "IMB_PARAMETROS2","IMB_TBE_IDSEGINC" , "INT");
$this->verificarExistencia( "IMB_CONTRATO","IMB_CTR_INCTAXAADM1" , 'CHAR(01)');
$this->verificarExistencia( "IMB_CONTRATO","IMB_CTR_INCTAXAADM2" , 'CHAR(01)');
$this->verificarExistencia( "IMB_CONTRATO","IMB_CTR_INCTAXAADM3" , 'CHAR(01)');
$this->verificarExistencia( "IMB_CONTRATO","IMB_CTR_INCTAXAADM4" , 'CHAR(01)');
$this->verificarExistencia( "IMB_CONTRATO","IMB_CTR_INCTAXAADM5" , 'CHAR(01)');
$this->verificarExistencia( "IMB_CONTRATO","IMB_CTR_INCTAXAADM6" , 'CHAR(01)');
$this->verificarExistencia( "IMB_CONTRATO","IMB_CTR_JURIDICOANOTACOES" , 'TEXT');
$this->verificarExistencia( "TMP_RESUMOACORDO","IMB_ATD_ID" , 'INT');
$this->verificarExistencia( "TMP_RESUMOACORDO","IMB_IMB_ID" , 'INT');
$this->verificarExistencia( "TMP_RESUMOACORDO","PROPORCAO" , 'NUMERIC(12,5)');
$this->verificarExistencia( "IMB_ATENDENTE","IMB_ATD_NOTIFICARNOVOATM" , 'CHAR(01)');
$this->verificarExistencia( "IMB_CONDOMINIO","IMB_CND_ZELADORTEL3OBS" , 'varchar(500)');
$this->verificarExistencia( "FIN_LANCTOCAIXA","FIN_LCX_UNIQUEIDBANK" , 'varchar( 100)');
$this->verificarExistencia( "IMB_CONTRATOSEGUROINCENDIO","IMB_SCT_VALORCOBERTURA",'numeric(12,2)' );
$this->verificarExistencia( "IMB_CONTRATOSEGUROINCENDIO","IMB_SCT_VALORSEGURO",'numeric(12,2)' );
$this->verificarExistencia( "IMB_PARAMETROS","IMB_PRM_ARREDONTARREAJSTE",'CHAR(01)' );
$this->verificarExistencia( "IMB_PARAMETROS2","IMB_PRM_DIADMAIS",'INT' );
$this->verificarExistencia( "IMB_PARAMETROS2","IMB_PRM_TOLERANCIABOLETO",'CHAR(01)' );
$this->verificarExistencia( "IMB_PARAMETROS","IMB_PRM_COBRARTARALTVEN",'CHAR(01)' );
$this->verificarExistencia( "IMB_PARAMETROS","IMB_TBE_VALORTARALTVEM",'numeric(12,2)' );
$this->verificarExistencia( "IMB_PARAMETROS","IMB_TBE_IDTARALTVEN",'int' );
$this->verificarExistencia( "IMB_PARAMETROS","IMB_PRM_IRRFMINIMO",'numeric(12,2)' );
$this->verificarExistencia( "IMB_PARAMETROS2","IMB_PRM_TOTALIMPOSTOS1005",'numeric(12,2)' );
$this->verificarExistencia( "IMB_PARAMETROS2","IMB_PRM_ISSLOCADORCREDEB",'char(01)' );
$this->verificarExistencia( "IMB_CONDOMINIO","IMB_CND_HORARIOVISITA",'VARCHAR(200)' );
$this->verificarExistencia( "IMB_CONDOMINIO","IMB_CND_HORARIOSERVICOS",'VARCHAR(200)' );
$this->verificarExistencia( "IMB_CONTROLECHAVE","IMB_CCH_SELECIONADO",'CHAR(01)' );
$this->verificarExistencia( "IMB_CONTROLECHAVE","IMB_ATD_IDSELECIONADO",'INT' );
$this->verificarExistencia( "IMB_CONTROLECHAVE","IMB_CCH_OBSERVACAORETORNO",'VARCHAR(255)' );
$this->verificarExistencia( "IMB_CONTROLECHAVE","IMB_CCH_EXPECTATIVA",'VARCHAR(5)' );
$this->verificarExistencia( "IMB_CONTROLECHAVE","IMB_CCH_OPINIAO",'VARCHAR(10)' );
$this->verificarExistencia( "IMB_CONTROLECHAVE","IMB_CCH_DEVOLUCAODATE",'date' );
$this->verificarExistencia( "IMB_CONTROLECHAVE","IMB_CCH_DEVOLUCAOHORA",'varchar(05)' );
$this->verificarExistencia( "IMB_CONTROLECHAVE","IMB_CCH_RESERVAR",'char(01)' );
$this->verificarExistencia( "IMB_CONTROLECHAVE","IMB_CCH_RESERVARDATALIMITE",'date' );
$this->verificarExistencia( "IMB_IMOVEIS","IMB_CCH_RESERVAR",'char(01)' );
$this->verificarExistencia( "IMB_IMOVEIS","IMB_CCH_RESERVARDATALIMITE",'date' );

$this->verificarExistencia( "IMB_PARAMETROS2","FIN_CCR_ID_COBRANCA",'VARCHAR(05)' );
$this->verificarExistencia( "IMB_PARAMETROS2","IMB_FORPAG_ID_LOCATARIO",'INT');
$this->verificarExistencia( "IMB_PARAMETROS2","IMB_PRM_NOTASERIE",'VARCHAR(3)');
$this->verificarExistencia( "IMB_PARAMETROS2","IMB_PRM_CODIGOIMOVELRECIBOS",'CHAR(01)');
$this->verificarExistencia( "IMB_PARAMETROS2","IMB_PRM_TOKENNFS",'VARCHAR(500)');


$this->verificarExistencia( "IMB_PARAMETROS2","IMB_TBE_IDRENOVACAO",'INT' );
$this->verificarExistencia( "IMB_CONTRATO","IMB_CTR_NUNCARETEIRRF",'CHAR(01)' );
$this->verificarExistencia( "TMP_RETORNOBANCARIO","IMB_CGR_VENCIMENTOORIGINAL",'DATE' );
$this->verificarExistencia( "TMP_RETORNOBANCARIO","FIN_CCX_ID",'INT' );
$this->verificarExistencia( "TMP_RETORNOBANCARIO","pagonaoconfere",'char(01)' );
$this->verificarExistencia( "TMP_RETORNOBANCARIO","MOTIVOREJEICAODESCRICAO",'VARCHAR(100)' );
$this->verificarExistencia( "IMB_ACORDO","IMB_ACD_DATAENTRADA",'DATE' );
$this->verificarExistencia( "FIN_APDOC","FIN_APD_DTHINATIVADO",'DATE' );
$this->verificarExistencia( "FIN_APDOC","FIN_CCX_IDBAIXA",'INT' );
$this->verificarExistencia( "IMB_EMPRESA","IMB_EEP_PIX",'VARCHAR(200)' );
$this->verificarExistencia( "IMB_SOLICITACAO","IMB_SOL_DTHVISUALIZACAO",'TIMESTAMP NULL DEFAULT NULL' );
$this->verificarExistencia( "IMB_SOLICITACAO","IMB_CLT_IDABERTURA",'INT' );
$this->verificarExistencia( "IMB_SOLICITACAO","IMB_SOL_PROTOCOLO",'VARCHAR(20)' );
$this->verificarExistencia( "IMB_SOLICITACAO","IMB_CLT_ID",'INT' );
$this->verificarExistencia( "IMB_SOLICITACAO","IMB_SOL_PRIORIDADE",'CHAR(01)' );
$this->verificarExistencia( "IMB_SOLICITACAOEVENTOS","IMB_IMB_ID",'INT' );
$this->verificarExistencia( "IMB_SOLICITACAO","IMB_ATD_IDNOTIFEXTRA",'INT' );
$this->verificarExistencia( "IMB_SOLICITACAO","IMB_SOL_PUBLICA",'CHAR(01)' );
$this->verificarExistencia( "IMB_SOLICITACAO","IMB_SOL_DTHVISUALIZADA",'DATETIME' );
$this->verificarExistencia( "IMB_SOLICITACAO","IMB_IMB_ID",'INT' );
$this->verificarExistencia( "FIN_APDOC","IMB_ATD_IDBAIXA",'INT' );
$this->verificarExistencia( "FIN_APDOC","FIN_APD_DTHBAIXA",'DATETIME' );
$this->verificarExistencia( "TMP_REPASSE","IMB_LCF_LIBERADOREPASSE",'VARCHAR(01)' );
$this->verificarExistencia( "TMP_REPASSE","TMP_REC_FIXADO",'VARCHAR(01)' );
$this->verificarExistencia( "TMP_RECEBIMENTO","TMP_REC_FIXADO",'VARCHAR(01)' );
$this->verificarExistencia( "TMP_PLANILHADEPOSITO","FIN_CCX_ID",'int' );
$this->verificarExistencia( "TMP_DADOSBOLETO","IMB_CTR_ID",'int' );
$this->verificarExistencia( "IMB_MOTIVORESCISAO","IMB_IMB_ID",'int' );
$this->verificarExistencia( "GER_DOCUMENTOAUTOMATICOS","GER_DCA_TIPO",'VARCHAR(20)' );
$this->verificarExistencia( "IMB_RECIBOLOCATARIO","IMB_RLT_ABATER",'CHAR(01)' );
$this->verificarExistencia( "TMP_DADOSBOLETO","agencia_dv",'varchar(02)' );
$this->verificarExistencia( "IMB_ATENDENTE","idcontratopublico",'int' );
$this->verificarExistencia( "IMB_COBRANCAGERADAPERM","IMB_CGR_ARQRETORNO",'VARCHAR(300)' );
$this->verificarExistencia( "IMB_CLIENTEANEXO","IMB_TPD_ID",'int' );
$this->verificarExistencia( "FIN_CONTACAIXA","FIN_CCX_COBPIX",'VARCHAR(400)' );
$this->verificarExistencia( "TMP_REPASSE","IMB_CLT_NOMELOCADOR",'VARCHAR(40)' );
$this->verificarExistencia( "IMB_TIPOIMOVEL","IMB_TIM_IDBESOFT",'int' );
$this->verificarExistencia( "FIN_LANCTOCAIXA","IMB_ATD_IDEXCLUSAO",'int' );
$this->verificarExistencia( "TMP_TAXASRECEBIDAS","IMB_RLD_VALOR",'NUMERIC(12,2)' );
$this->verificarExistencia( "TMP_ATRASADOSHEADER","ENCERRADO",'VARCHAR(20)' );
$this->verificarExistencia( "TMP_ATRASADOSHEADER","ACORDO",'VARCHAR(20)' );
$this->verificarExistencia( "BE_TIPOIMOVEL","IMB_IMB_ID",'INT' );
$this->verificarExistencia( "BE_SUBTIPOIMOVEL","IMB_IMB_ID",'INT' );
$this->verificarExistencia( "IMB_LEADS","IMB_LED_CIENTE",'CHAR(01)' );
$this->verificarExistencia( "IMB_SOLICITACAO","IMB_SOL_CIENTE",'CHAR(01)' );
$this->verificarExistencia( "FIN_CONTACAIXA","FIN_CCX_TIPOCONTA",'VARCHAR(20)' );
$this->verificarExistencia( "IMB_CONTROLECHAVE","IMB_CLA_ID",'INT' );
$this->verificarExistencia( "IMB_ATENDENTE","IMB_ATD_HABILITARFILA",'CHAR(01)' );
$this->verificarExistencia( "CEP_BAIRRO","CEP_CID_NOME",'VARCHAR(40)' );
$this->verificarExistencia( "IMB_LEADS","IMB_LED_DDD",'VARCHAR(3)' );
$this->verificarExistencia( "IMB_LEADS","IMB_IMV_REFERE",'VARCHAR(10)' );
$this->verificarExistencia( "IMB_LEADS","IMB_LED_MENSAGEM",'VARCHAR(500)' );
$this->verificarExistencia( "IMB_RECIBOLOCATARIO","IMB_RLT_ORIGEM",'VARCHAR(15)' );
$this->verificarExistencia( "IMB_LANCAMENTOFUTURO","IMB_LCF_ORIGEM",'VARCHAR(15)' );
$this->verificarExistencia( "GER_DOCUMENTOAUTOMATICOS","GER_DCA_UPLOAD",'VARCHAR(200)' );
$this->verificarExistencia( "GER_DOCUMENTOAUTOMATICOS","GER_DCA_DOWNLOAD",'VARCHAR(200)' );
$this->verificarExistencia( "GER_DOCUMENTOAUTOMATICOS","GER_DCA_WORD",'CHAR(01)' );
$this->verificarExistencia( "TMP_REPASSE","RECEBIDO",'CHAR(01)' );
$this->verificarExistencia( "TMP_DADOSBOLETO","IMB_CGR_VENCIMENTOORIGINAL",'varchar(10)' );
$this->verificarExistencia( "TMP_RELRECEBIMENTODIA","CREDITOS",'NUMERIC(12,2)' );
$this->verificarExistencia( "TMP_RELRECEBIMENTODIA","DEBITOS",'NUMERIC(12,2)' );
$this->verificarExistencia( "TMP_RELRECEBIMENTODIA","TOTALRECIBO",'NUMERIC(12,2)' );
$this->verificarExistencia( "IMB_PARAMETROS2","IMB_PRM_DATAREPASSEDODIA",'CHAR(01)' );
$this->verificarExistencia( "IMB_RECIBOLOCATARIO","IMB_RLT_PIX",'NUMERIC(12,2)' );

$this->videosTreinamento( 'acesso_ao_sistema.mp4', 'Acessando o Sirius System', 'sirius system acesso acessando entrando sistema plataforma'  );
        $this->videosTreinamento( 'Prontos_introducao.mp4', 'Introdução ao Ambiente de Aprendizado Virtual', 'Treinamentos cursos treinamento curso'  );
        $this->videosTreinamento( 'pronto_usuario_senha.mp4', 'Acessando com usuário e senha', 'usuario senha acesso esqueci esquecer esquecimento reenvio '  );
        $this->videosTreinamento( 'pronto_menu_geral.mp4', 'Entendendo o menu geral', 'menu portal acesso botões opção links '  );
        $this->videosTreinamento( 'pronto_menu_suspenso_introducao.mp4', 'Menu suspenso com opção de atalho', 'menu suspenso busca rápida agenda avisos '  );
        $this->videosTreinamento( 'pronto_localizacao_rapida_maria.mp4', 'Localização Rápida', 'Localização Rápida busca nome endereco interessado proprietário locador locatario '  );
        $this->videosTreinamento( 'acessando_cadastro_novo_cliente.mp4', 'Como cadastrar novos clientes', 'cadastrar novos clientes proprietario fiador locador interessado locatario '  );
        $this->videosTreinamento( 'cadastrando_novo_cliente.mp4', 'Como cadastrar novos clientes', 'cadastrar novos clientes proprietario fiador locador interessado locatario '  );
        $this->videosTreinamento( 'acessando_novo_imovel.mp4', 'Acessando área de novo imóvel', 'cadastrar novos imoveis imovel  '  );
        $this->videosTreinamento( 'cadastrando_novo_imovel_1.mp4', 'Cadastrando novo imóvel', 'cadastrar  novo incluir novos imoveis imovel  '  );
        $this->videosTreinamento( 'informando_proprietario_imovel.mp4', 'Informando proprietário do Imovel', 'Locador proprietário participacao informando '  );
        $this->videosTreinamento( 'alteracaocaixa.mp4', 'Alteração de Informações em Bancos/Caixa', 'Alterações caixa alteração'  );
        $this->videosTreinamento( 'reajustesdealuguel.mp4', 'Reajuste de Aluguéres', 'Reajuste reajustar aluguel contrato'  );
                                
                                        
        
                


        


                

    }


    public function verificarExistencia( $tabela, $campo, $tipo )
    {
        $schema = env('DB_DATABASE');
        $ret = DB::table( "INFORMATION_SCHEMA.COLUMNS")
        ->where('TABLE_NAME', '=', $tabela)
        ->where('COLUMN_NAME', '=', $campo)
        ->where('TABLE_SCHEMA','=',$schema)
        ->count();

        

        if( $ret <> 1)
        {
            DB::statement("ALTER TABLE $tabela ADD COLUMN IF NOT EXISTS $campo $tipo");
        }
    }

    public function insertsNecessarios( $campo, $tabela, $grupo, $descricao )
    {
        if( $tabela ==  'GER_CAMPOSMESCLAGEM' )
        {
            $camposmesclagem = mdlCamposMesclagem::where( 'GER_CMM_NOME','=', $campo )->first();

            if( $camposmesclagem == '' )
            {
                $camposmesclagem = new mdlCamposMesclagem;

                $camposmesclagem->GER_CMM_NOME = $campo;
                $camposmesclagem->GER_CMM_GRUPO = $grupo;
                $camposmesclagem->GER_CMM_DESCRICAO= $descricao;
                $camposmesclagem->GER_CMM_NOMECAMPO=$campo;
                $camposmesclagem->save();
            }
        }

    }

    public function videosTreinamento( $video, $descricao, $tag  )
    {
        $vd = mdlVideosTreinamento::where( 'IMB_VDT_ARQUIVO','=', $video )->first();
        if( $vd == '' )
        {
            $vdp = new mdlVideosTreinamento;
	        $vdp->IMB_VDT_TITULO = $descricao;
	        $vdp->IMB_VDT_TAGS = $tag;
            $vdp->IMB_VDT_ARQUIVO = $video;
            $vdp->IMB_VDT_DTHATIVO = date( 'Y/m/d');
            $vdp->save();
        }

    }

    public function camposdoSistema( $nomecampo, $descricao, $forma  )
    {
        $vd = mdlCamposSistema::where( 'campo','=', $nomecampo )->first();
        if( $vd == '' )
        {
            $vdp = new mdlCamposSistema;
	        $vdp->campo = $nomecampo;
	        $vdp->descricao = $descricao;
            $vdp->save();
        }

    }    
}
