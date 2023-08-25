<?php
/*$servername = "localhost";
$database = "crecigo";
$username = "root";
$password = "";

$servername = "mysql.creci-to.com.br";
$database = "crecito";
$username = "crecito";
$password = "AYCpd2335392YA";
*/

$servername = "mysql.siriussystem.com.br";
$database = "siriussystem03";
$username = "siriussystem03";
$password = "AYAm2335392YA";
          

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
mysqli_set_charset($conn,"utf8");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$pastaimagemimoveis = '../../imagens/imoveis';


$width=0;
$heigth=0;

/*$myServer = "mssql.macro-br.com.br";
$myUser = "macrobr";
$myPass = "Cpd2335392";
$myDB = "macro-br	";
$titulo="Sirius System ";
$dbhandle = mssql_connect($myServer, $myUser, $myPass)
  or die("Couldn't connect to SQL Server on $myServer");



$instrucaoSQL = "SELECT imb_imb_nome, imb_imb_endereco, imb_imb_url, ".
" imb_imb_email, imb_imb_telefone1 FROM imb_imobiliaria";
$consulta = mssql_query($instrucaoSQL);
$numRegistros = mssql_num_rows($consulta);
$linha = mssql_fetch_array($consulta) ;
$empresa = utf8_encode($linha[ imb_imb_nome ]);
$empresaendereco =  utf8_encode( $linha[ imb_imb_endereco ]);
$empresaemail =  $linha[ imb_imb_email ];
$empresatelefone =  $linha[ imb_imb_telefone1];
$empresaurl   = $linha[ imb_imb_url];
*/
?>
