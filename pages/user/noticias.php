<?php

include "../../backend/conexao.php";
include "../../backend/SecaoModel.php";
include "../../backend/SubsecaoModel.php";
include "../../backend/NoticiaModel.php";

$secaoModel = new SecaoModel($cnx);
$subsecaoModel = new SubsecaoModel($cnx);
$noticiaModel = new NoticiaModel($cnx);

$noticias = $noticiaModel->getNoticiaAll();
$secoes = $secaoModel->getSecaoAllIsAtivada();

?>

<!doctype html>
<html lang="pt-BR">

<head>
    <title>Notícias</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/plugins/fontawesome-free/css/all.min.css">

    <!-- <link rel="stylesheet" href="./assets/dist/css/style.css"> -->
    <link rel="stylesheet" href="../../assets/dist/css/style-noticia.css">
    <link rel="stylesheet" href="../../assets/dist/css/style.css">


</head>

<body>


    <header>
        <div class="fundo-cabecalho">

            <div class="container" style="display:flex; flex-direction:row; justify-content:space-between; align-items:center;">
                <img src="../../assets/dist/img/ImagensPPGCC/ouo.svg" class="logo">
            </div>

        </div>

        <?php

        include "./partials/menu.php"

        ?>
    </header>

    <main style="display: flex;flex-direction:column;min-height:75%">

        <!-- style="z-index: 10;width: 21%;position: fixed; left:90px;transition:left 0.1s linear;" -->
        <div class="noticia-titulo container">
            <h3><i class="fas fa-newspaper"></i> Notícias</h3>
            <hr>
        </div>
        <div class="noticias container">


            <?php
            $cont = 0;
            while ($not = mysqli_fetch_array($noticias)) {
                $img = $not['img'];
                $cont++;
            ?>

                <?php
                $dia = substr($not['data_publicacao'], 8, 2);
                $mes = substr($not['data_publicacao'], 5, 2);
                $ano = substr($not['data_publicacao'], 0, 4);

                $hora = substr($not['data_publicacao'], 11, 2);
                $minuto = substr($not['data_publicacao'], 14, 2);
                ?>

                <a class="link-titulo-noticia noticia" href="./viewnoticia.php?noticia_id=<?= $not['id'] ?>">


                    <div class="box-info">
                        <p>

                            <i class="far fa-calendar-alt"></i>
                            <?php echo "$dia/$mes/$ano" ?>
                        </p>
                        <p>
                            <i class="far fa-clock"></i>
                            <?php echo $hora . "h" . $minuto ?>

                        </p>
                        <p>

                            <i class="fas fa-align-left"></i> Notícia
                        </p>
                    </div>
                    <div class="box-conteudo">
                        <div class="container-img">
                            <img src="<?= $img ?>" alt="" class="img-noticia">
                        </div>
                        <div class="container-titulo">


                            <strong><?= $not['titulo'] ?></strong>

                        </div>
                    </div>


                </a>
            <?php
            }

            if($cont == 0){
            ?>

                <div>
                    Nenhuma Notícia
                </div>

            <?php } ?>

        </div>



    </main>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <?php include "./partials/footer.php" ?>


</body>

</html>