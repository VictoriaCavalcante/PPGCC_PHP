<?php

include "../../backend/conexao.php";
include "../../backend/SecaoModel.php";
include "../../backend/SubsecaoModel.php";
include "../../backend/defesasModel.php";

$secaoModel = new SecaoModel($cnx);
$subsecaoModel = new SubsecaoModel($cnx);
$defesaModel = new defesasModel($cnx);

$defesas = $defesaModel->getDefesas();
$secoes = $secaoModel->getSecaoAllIsAtivada();


?>

<!doctype html>
<html lang="pt-BR">

<head>
    <title>Defesas</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../assets/dist/css/style.css">
    <link rel="stylesheet" href="../../assets/dist/css/style-defesas-lista.css">

    <style>
        main {
            display: flex;
            justify-content: center;
            min-height: 75%;
        }

        #lista-defesas {
            width: 50%;
        }

        @media all and (max-width: 480px) {
            #lista-defesas {
                width: 90%;
            }
        }
    </style>
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

    <main>

        <!-- style="z-index: 10;width: 21%;position: fixed; left:90px;transition:left 0.1s linear;" -->

        <div class="container">

            <div class="defesa-titulo container">
                <h3><i class="fas fa-user-graduate"></i> Defesas</h3>
                <hr>
            </div>

            <div class="defesas container">
                <?php
                $cont = 0;
                while ($defesa = mysqli_fetch_array($defesas)) {

                    $cont++;
                ?>


                    <?php
                    $dia = substr($defesa['horario'], 8, 2);
                    $mes = substr($defesa['horario'], 5, 2);
                    $ano = substr($defesa['horario'], 0, 4);

                    $hora = substr($defesa['horario'], 11, 2);
                    $minuto = substr($defesa['horario'], 14, 2);
                    ?>

                    <a class="link-defesa defesa" href="./viewdefesa.php?defesa_id=<?= $defesa['id'] ?>">


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

                                <i class="fas fa-graduation-cap"></i> Defesa
                            </p>
                        </div>
                        <div class="box-conteudo">

                            <div class="container-titulo">


                                <strong><?= $defesa['titulo'] ?></strong><br>
                                <div class="container-local">
                                    <i class="fas fa-map-marker-alt mt-1 mr-2"></i> <?= $defesa['local'] ?>

                                </div>
                            </div>
                        </div>


                    </a>
                <?php
                }

                if ($cont == 0) {
                ?>
                    <div>
                        Nenhuma Defesa
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <?php include "./partials/footer.php" ?>


</body>

</html>