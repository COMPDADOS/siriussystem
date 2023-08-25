<?php

$a = (isset($_GET['a']) ? $_GET['a']:'index');

switch ($a) {

    case 'upload':
        $pasta = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'imagens' . DIRECTORY_SEPARATOR . 'imoveis' . DIRECTORY_SEPARATOR . $nimovelpesquisa . DIRECTORY_SEPARATOR;
        if (!is_dir($pasta)) mkdir($pasta, 0777, true);
        $pasta_thumbs = $pasta . 'thumbs' . DIRECTORY_SEPARATOR;
        if (!is_dir($pasta_thumbs)) mkdir($pasta_thumbs, 0777, true);
        $filename = microtime(true) . '.' . strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
        if (move_uploaded_file($_FILES['file']['tmp_name'], $filename)) {
            // CARREGA IMAGEM ORIGINAL
            $im = new PQ_Image($filename);
            $im->Open();
            
            // DEFINE IMAGEM COM TAMANHO MÁXIMO
            $im->newWidth = 800; // AQUI DEFINIMOS O TAMANHO DA IMAGEM
            $im->quality = 80; // QUALIDADE 0 até 100
            $im->Resize();
            $im->SaveAs($pasta . $filename);
            
            // VAI CRIAR UMA IMAGEM PARA THUMB
            $im->newWidth = 370; // AQUI DEFINIMOS O TAMANHO DA IMAGEM
            $im->quality = 80; // QUALIDADE 0 até 100
            $im->Resize();
            $im->SaveAs($pasta_thumbs . $filename);

            // LIMPA A MEMÓRIA
            $im->Destroy();

            $imgtime = time();
            $sql_insere = "INSERT INTO IMB_IMAGEM (IMB_IMV_ID, IMB_IMG_SEQUENCIA, IMB_IMG_ARQUIVO) VALUES ({$nimovelpesquisa}, {$imgtime}, '{$filename}')";
            mysqli_query($conn, $sql_insere) or die("SQL faiô ({$sql_insere}): " . mysqli_error($conn));
            echo "Arquivo válido e enviado com sucesso.";
        } else {
            echo "Possível ataque de upload de arquivo!";
        }
        break;

    case 'excluir':
        $pasta = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'imagens' . DIRECTORY_SEPARATOR . 'imoveis' . DIRECTORY_SEPARATOR . $nimovelpesquisa . DIRECTORY_SEPARATOR;
        if (!is_dir($pasta)) mkdir($pasta, 0777, true);
        $sql_captura = "SELECT IMB_IMG_ARQUIVO FROM IMB_IMAGEM WHERE IMB_IMG_ID={$_GET['id']}";
        $query = mysqli_query($conn, $sql_captura) or die("SQL={$sql_captura} / ERRO=". mysqli_error($conn));
        $data = mysqli_fetch_array($query, MYSQLI_ASSOC);
        @unlink($pasta . $data['IMB_IMG_ARQUIVO']);
        $sql_excluir = "DELETE FROM IMB_IMAGEM WHERE IMB_IMG_ID={$_GET['id']}";
        mysqli_query($conn, $sql_excluir) or die("SQL={$sql_excluir} / ERRO=". mysqli_error($conn));
        break;

    case 'prin':
        $sql_captura = "SELECT IMB_IMG_ARQUIVO, IMB_IMV_ID FROM IMB_IMAGEM WHERE IMB_IMG_ID={$_GET['id']}";
        $query = mysqli_query($conn, $sql_captura) or die("SQL={$sql_captura} / ERRO=". mysqli_error($conn));
        $data = mysqli_fetch_array($query, MYSQLI_ASSOC);

        $sql_excluir = "UPDATE   IMB_IMAGEM SET IMB_IMG_PRINCIPAL = 'N' WHERE IMB_IMV_ID={$data['IMB_IMV_ID'] }";
        mysqli_query($conn, $sql_excluir) or die("SQL={$sql_excluir} / ERRO=". mysqli_error($conn));

        $sql_excluir = "UPDATE   IMB_IMAGEM SET IMB_IMG_PRINCIPAL = 'S' WHERE IMB_IMG_ID={$_GET['id'] }";
        mysqli_query($conn, $sql_excluir) or die("SQL={$sql_excluir} / ERRO=". mysqli_error($conn));
        break;

    default:
        $colunas = 0;
        $queryimg = "select * from IMB_IMAGEM where imb_imv_id = " . $nimovelpesquisa;
        $resultimg = mysqli_query($conn, $queryimg);
        while ($rowimg = mysqli_fetch_assoc($resultimg)) {
            $colunas++;
            if ($colunas === 1)
                echo '<div class="row">';
?>
<div class="col-xs-6 col-sm-4 col-md-2">
  <div class="thumbnail">
    <img src="/sistema/imagens/imoveis/<?php echo $nimovelpesquisa . '/thumbs/' . $rowimg['IMB_IMG_ARQUIVO'] ?>" width="100%" />
    <div class="caption text-center">
    <a href="javascript:void(GaleriaExcluir('<?= $rowimg['IMB_IMG_ID']?>'));" class="btn btn-danger" role="button"><i class="fa fa-trash"></i> Excluir</a>
    </div>
    <?php
        if( $rowimg['IMB_IMG_PRINCIPAL'] =='S' ) 
        {
            echo '<div class="caption text-center">';
            echo '<span>Principal</span>';
            echo '</div>';
        }
        else
        {
            echo '<div class="caption text-center">';
            echo '<a href="javascript:void(GaleriaPrincipal('.$rowimg['IMB_IMG_ID'].'))" class="fal fa-badge-check" role="button"><i class="fa fa-trash"></i> Definir como principal</a>';
            echo '</div>';
        }
    ?>

  </div>
</div>
<?php
            if ($colunas === 6) {
                echo '</div>';
                $colunas = 0;
            }
        }
        if ($colunas !== 0) {
            echo '</div>';
        }

        break;
}
