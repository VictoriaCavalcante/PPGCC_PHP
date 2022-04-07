<?php

include "../../backend/conexao.php";
include "../../backend/SecaoModel.php";
include "../../backend/SubsecaoModel.php";

$secaoModel = new SecaoModel($cnx);
$subsecaoModel = new SubsecaoModel($cnx);

if (!isset($_GET['subsecao'])) {


    header("Location: ./");
}

$id_subsecao = $_GET['subsecao'];


if(!is_numeric($id_subsecao)){

    header("Location: ./");


}

$subsecao_atual = $subsecaoModel->getSubsecao($id_subsecao);


$secoes = $secaoModel->getSecaoAllIsAtivada();


$secao_atual = $secaoModel->getSecao($subsecao_atual->id_secao);


if (!$secao_atual) {

    header("Location: ./");
}


?>

<!doctype html>
<html lang="pt-BR">

<head>
    <title><?= $secao_atual->titulo ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="../../assets/dist/css/style.css">
    <link rel="stylesheet" href="../../assets/plugins/fontawesome-free/css/all.min.css">

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

            table {

                width: 100%;
            }
        }
    </style>

</head>

<body>


    <header>
        <div class="fundo-cabecalho">

            <div class="container" style="display:flex; flex-direction:row; justify-content:space-between; align-items:center;">
                <img src="../../assets/dist/img/ImagensPPGCC/ouo.svg"  class="logo">
            </div>

        </div>


        <?php

        include "./partials/menu.php"

        ?>
    </header>



    <main style="position: relative;min-height:80%;">

        <div class="container">



            <div class="row" id="frame-grande">

                <div class="col-3">


                    <!-- style="z-index: 10;width: 21%;position: fixed; left:90px;transition:left 0.1s linear;" -->
                    <ul class="list-group mt-5 mb-3 " style="position: sticky; top: 50px">

                        <li class="list-group-item  text-center font-weight-bold text-white text-truncate" style="font-size: 18px; background-color: #2969BD"><?= $secao_atual->titulo ?></li>

                        <?php

                        $subsecoes =  $subsecaoModel->getSubsecaoInSecaoIsAtivada($secao_atual->id);

                        $subsecao_ativada = "subsecao-ativada";
                        while ($subsecao = mysqli_fetch_array($subsecoes)) {

                        ?>

                            <?php if ($subsecao_atual->id == $subsecao['id']) { ?>

                                <a class="list-group-item text-left text-decoration-none text-dark text-truncate caixa-menu-lateral" href="./secao.php?subsecao=<?= $subsecao['id'] ?>">
                                    <div class="<?= $subsecao_ativada ?>"></div>
                                    <?= $subsecao['titulo'] ?>
                                </a>

                            <?php } else { ?>

                                <a class="list-group-item text-left text-decoration-none text-dark text-truncate caixa-menu-lateral" href="./secao.php?subsecao=<?= $subsecao['id'] ?>">
                                    <div class="menu-lateral-hover"></div>
                                    <?= $subsecao['titulo'] ?>
                                </a>

                            <?php } ?>

                        <?php

                        }

                        ?>


                    </ul>

                </div>

                <div class="col-9 mt-5 mb-5" style="overflow:hidden;word-break: break-word">

                    <h3 class="titulo-cabecalho"><?= $subsecao_atual->titulo ?></h3>
                    <hr>
                    <?= $subsecao_atual->conteudo ?>

                </div>

            </div>

            <div id="frame-pequeno">

                <div class="col mt-5 mb-5" style="overflow: hidden;word-break: break-word">

                    <h3><?= $subsecao_atual->titulo ?></h3>
                    <hr>
                    <?= $subsecao_atual->conteudo ?>

                </div>

            </div>


        </div>

    </main>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <?php

    include "./partials/footer.php";
    ?>
</body>


</html>