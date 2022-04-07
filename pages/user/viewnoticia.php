<?php

include "../../backend/conexao.php";
include "../../backend/SecaoModel.php";
include "../../backend/SubsecaoModel.php";
include "../../backend/NoticiaModel.php";

$secaoModel = new SecaoModel($cnx);
$subsecaoModel = new SubsecaoModel($cnx);
$noticiaModel = new NoticiaModel($cnx);

if (!isset($_GET['noticia_id'])) {

    header('Location: ./noticias.php');
}

if (!is_numeric($_GET['noticia_id'])) {

    header('Location: ./noticias.php');
}

$noticia_id = $_GET['noticia_id'];


$secoes = $secaoModel->getSecaoAllIsAtivada();

$noticia = $noticiaModel->getNoticia($noticia_id);

if (!$noticia) {

    header('Location: ./noticias.php');
}

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

    <link rel="stylesheet" href="../../assets/dist/css/style.css">
    <link rel="stylesheet" href="../../assets/plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="../../assets/dist/css/style-noticias.css">


    <style>
        @media all and (max-width: 480px) {

            img {

                width: 100%;
                height: auto;

            }


            iframe {

                width: 80%;
                height: auto;
            }
        }
    </style>
</head>

<body class="body-view-noticia">


    <header>
        <div class="fundo-cabecalho">

            <div class="container" style="display:flex; flex-direction:row; justify-content:space-between; align-items:center;">
                <img src="../../assets/dist/img/ImagensPPGCC/ouo.svg" class="logo">
            </div>

        </div>

        <nav class="navbar navbar-expand-md navbar-dark p-0" style="background-color: #2969BD;width: 100%;z-index:10;">
            <div class="container">
                <!-- Brand -->
                <!-- <a class="navbar-brand" href="https://www.ufac.br/">UFAC</a> -->

                <!-- Toggler/collapsibe Button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar links -->
                <div class="collapse navbar-collapse div-menu" id="collapsibleNavbar" style="font-family: Helvetica ; font-size: 18px">
                    <ul class="navbar-nav">
                        <li class="nav-item pt-2 pb-2 mr-1">
                            <a class="nav-link text-white menu-hover texto-menu" href="./index.php"> <i class="fas fa-home"></i> Página Inicial</a>
                        </li>

                        <?php

                        while ($secao =  mysqli_fetch_array($secoes)) {

                        ?>

                            <li class="nav-item dropdown pt-2 pb-2 mr-1">

                                <?php if (isset($secao) && isset($secao_atual) && $secao['id'] == $secao_atual->id) { ?>

                                    <a class="nav-link  text-white menu-ativado texto-menu" data-toggle="dropdown" href="./secao.php?secao=<?= $secao['id'] ?>"><?= $secao['titulo'] ?></a>

                                <?php } else { ?>

                                    <a class="nav-link  text-white menu-hover texto-menu" data-toggle="dropdown" href="./secao.php?secao=<?= $secao['id'] ?>"><?= $secao['titulo'] ?></a>

                                <?php } ?>

                                <div class="dropdown-menu" style="z-index: 1000;">

                                    <?php

                                    $listaSubsecoes = $subsecaoModel->getSubsecaoInSecaoIsAtivada($secao['id']);
                                    while ($subsecao = mysqli_fetch_array($listaSubsecoes)) {
                                    ?>

                                        <a class="dropdown-item" style="z-index: 500;" href="./secao.php?subsecao=<?= $subsecao['id'] ?>"><?= $subsecao['titulo'] ?></a>

                                    <?php } ?>
                                </div>
                            </li>
                        <?php

                        }
                        ?>
                        <li class="nav-item pt-2 pb-2 mr-1">


                            <a class="nav-link text-white menu-ativado texto-menu" href="noticias.php">Notícias</a>

                        </li>
                        <li class="nav-item pt-2 pb-2 mr-1">


                            <a class="nav-link text-white menu-hover texto-menu" href="defesas.php">Defesas</a>


                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>



    <main class="main-view-noticia">

        <div class="container mt-3 box-container-view">
            <div class="area-voltar">

                <a href="./noticias.php" class="link-voltar voltar btn btn-warning">
                    <i class="far fa-arrow-alt-circle-left"></i>

                    Voltar
                </a>
            </div>
            <hr>
            <h3 style="text-align: center;">
                <?= $noticia->titulo ?>
            </h3>
            
            <?php
            $dia = substr($noticia->data_publicacao, 8, 2);
            $mes = substr($noticia->data_publicacao, 5, 2);
            $ano = substr($noticia->data_publicacao, 0, 4);

            $hora = substr($noticia->data_publicacao, 11, 2);
            $minuto = substr($noticia->data_publicacao, 14, 2);
            ?>

            <div style="text-align: right;">
                <i class="far fa-calendar-alt ml-3"></i>
                <?php echo $dia . '/' . $mes . '/' . $ano; ?>
                <i class="far fa-clock ml-3"></i>
                <?php

                echo "$hora:$minuto";
                ?>
            </div>


            <hr>

            <div class="box-imagem-view">
                <img src="<?= $noticia->img ?>" class="img-noticia-cabecalho">

            </div>

            <div class="box-conteudo-view">

                <?= $noticia->conteudo ?>
            </div>

        </div>


    </main>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <?php include "./partials/footer.php" ?>

</body>

</html>