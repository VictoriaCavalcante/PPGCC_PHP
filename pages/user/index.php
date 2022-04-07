<?php

include "../../backend/conexao.php";
include "../../backend/SecaoModel.php";
include "../../backend/SubsecaoModel.php";
include "../../backend/NoticiaModel.php";
include "../../backend/defesasModel.php";

$noticiamodel = new NoticiaModel($cnx);
$defesasmodel = new DefesasModel($cnx);

$secaoModel = new SecaoModel($cnx);
$subsecaoModel = new SubsecaoModel($cnx);

$secoes = $secaoModel->getSecaoAllIsAtivada();

$noticias = $noticiamodel->getNoticiaAll();
$defesas = $defesasmodel->getDefesas();


?>

<!doctype html>
<html lang="pt-BR">

<head>
    <title>PPGCC</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="../../assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../assets/dist/css/style.css">

    <link rel="stylesheet" href="../../assets/dist/css/style-noticias.css">
    <link rel="stylesheet" href="../../assets/dist/css/style-defesas.css">

    
</head>

<body>


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
                <div class="collapse navbar-collapse div-menu vertical-menu" id="collapsibleNavbar">
                    <ul class="navbar-nav">
                        <li class="nav-item pt-2 pb-2 mr-1">

                            <a class="nav-link text-white menu-ativado texto-menu" href="./index.php">

                                <i class="fas fa-home"></i>

                                Página Inicial

                            </a>
                        </li>

                        <?php

                        while ($secao =  mysqli_fetch_array($secoes)) {

                        ?>

                            <li class="nav-item dropdown pt-2 pb-2 mr-1">


                                <a class="nav-link  text-white menu-hover texto-menu" data-toggle="dropdown" href="./secao.php?secao=<?= $secao['id'] ?>"><?= $secao['titulo'] ?></a>


                                <div class="dropdown-menu caixa-menu-suspenso" style="z-index: 1000; position: absolute;">

                                    <?php

                                    $listaSubsecoes = $subsecaoModel->getSubsecaoInSecaoIsAtivada($secao['id']);
                                    while ($subsecao = mysqli_fetch_array($listaSubsecoes)) {
                                    ?>

                                        <a class="dropdown-item opcao-menu" style="z-index: 500;" href="./secao.php?subsecao=<?= $subsecao['id'] ?>"><?= $subsecao['titulo'] ?></a>
                                        

                                    <?php } ?>
                                </div>
                            </li>
                        <?php

                        }
                        ?>
                        <li class="nav-item pt-2 pb-2 mr-1">
                            <a class="nav-link text-white menu-hover texto-menu" href="noticias.php">Notícias</a>
                        </li>
                        <li class="nav-item pt-2 pb-2 mr-1">
                            <a class="nav-link text-white menu-hover texto-menu" href="defesas.php">Defesas</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>



    </header>

    <main style="position: relative;min-height:80%;">

        <div class="container mt-5">


            <h3><i class="fas fa-newspaper"></i> Notícias</h3>
            <hr>
            <div class="container-noticias">

                <div class="noticia-categoria">

                    <h3 class="texto-categoria text-white m-auto"> <strong>Últimas Notícias</strong></h3>

                </div>


                <div class="noticias">


                    <?php

                    $cont = 0;
                    while ($noticia = mysqli_fetch_array($noticias)) {

                        $cont++;

                        $img = $noticia['img'];
                    ?>
                        <div class="box-noticias">

                            <div class="box-img">
                                <img src="<?= $img ?>" class="img-noticia" alt="">
                            </div>
                            <div class="box-titulo">


                                <h3 class="style-titulo">
                                    <a href="viewnoticia.php?noticia_id=<?= $noticia['id'] ?>" title="<?= $noticia['titulo'] ?>">
                                        <strong>
                                            <?php

                                            if (strlen($noticia['titulo']) > 25) {
                                                $res = substr($noticia['titulo'], 0, 25) . '...';
                                                echo $res;
                                            } else {

                                                echo $noticia['titulo'];
                                            }

                                            ?>

                                        </strong>
                                    </a>
                                </h3>

                                <div class="w-100 pl-3 pr-3">
                                    <?php

                                    if (strlen($noticia['previa']) > 120) {

                                        $res = substr($noticia['previa'], 0, 120) . '...';
                                        echo $res;
                                    } else {

                                        echo $noticia['previa'];
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="btn-ler-noticia" style="font-size: 15px; color: black">

                                <?php
                                $dia = substr($noticia['data_publicacao'], 8, 2);
                                $mes = substr($noticia['data_publicacao'], 5, 2);
                                $ano = substr($noticia['data_publicacao'], 0, 4);

                                $hora = substr($noticia['data_publicacao'], 11, 2);
                                $minuto = substr($noticia['data_publicacao'], 14, 2);
                                ?>
                                <i class="far fa-calendar-alt mr-1"></i>

                                <?php echo " $dia/$mes/$ano" ?>

                                <i class="far fa-clock ml-3 mr-1"></i>

                                <?php echo " $hora:$minuto" ?>

                            </div>

                        </div>

                    <?php

                        if ($cont == 3) {
                            break;
                        }
                    }
                    if($cont == 0){
                    
                    ?>

                    


                    <p class="text-white mt-5">Nenhuma notícia</p>

                    <?php } ?>

                </div>


                <div class="container-rodape mt-3 mb-3">

                    <a href="./noticias.php" class="btn btn-primary"><i class="fas fa-bars"></i> Ver todas</a>
                </div>

            </div>



            <h3 class="mt-5">
                <i class="fas fa-user-graduate"></i> Defesas
            </h3>
            <hr>

            <div class="container-defesas">
                <div class="container-header">
                    <div class="container-dias" id="area-dia">
                        <h3>Próximas Defesas</h3>
                    </div>
                </div>


                <div class="container-body">

                    <br>

                    <?php
                    $cont = 0;
                    while ($defesa = mysqli_fetch_array($defesas)) {
                        $cont++;
                    ?>
                        <a href="viewdefesa.php?defesa_id=<?= $defesa['id'] ?>" class=" box-defesa">
                            <div class="box-header" title="<?= $defesa['titulo'] ?>">
                                <p class="texto-titulo">
                                    <?php
                                    if (strlen($defesa['titulo']) == 0)
                                        $res = 'Evento sem título';
                                    else if (strlen($defesa['titulo']) > 0 && strlen($defesa['titulo']) < 150)
                                        $res = substr($defesa['titulo'], 0, 150);
                                    else if (strlen($defesa['titulo']) > 0 && strlen($defesa['titulo']) >= 150)
                                        $res = substr($defesa['titulo'], 0, 150) . '...';
                                 
                                    echo $res;
                                    ?>
                                </p>

                            </div>
                            <hr>
                            <div class="box-info">

                                <div title="<?= $defesa['local'] ?>">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <?php
                                    if (strlen($defesa['local']) == 0)
                                        $res = 'Local não definido';
                                    else if (strlen($defesa['local']) > 0 && strlen($defesa['local']) < 35)
                                        $res = substr($defesa['local'], 0);
                                    else if (strlen($defesa['local']) > 0 && strlen($defesa['local']) >= 35)
                                        $res = substr($defesa['local'], 0, 35) . '...';
                                    echo $res;
                                    ?>
                                </div>
                                <div>
                                    <i class="far fa-calendar-alt"></i>
                                    <?php
                                    $dia = substr($defesa['horario'], 8, 2);
                                    $mes = substr($defesa['horario'], 5, 2);
                                    $ano = substr($defesa['horario'], 0, 4);
                                    echo $dia . '/' . $mes . '/' . $ano;
                                    ?>
                                    <i class="far fa-clock ml-3"></i>
                                    <?php
                                    $horario = substr($defesa['horario'], 11, 5);
                                    echo $horario;
                                    ?>
                                </div>
                            </div>

                        </a>


                    <?php
                        if ($cont == 3) {
                            break;
                        }
                    }

                    if($cont == 0){
                    ?>
                    <div class="w-100 text-center mt-5">
                        <p class="text-black">Nenhuma defesa</p>

                    </div>

                    <?php } ?>
                </div>



                <div class="container-btn-mostra-mais mb-5 mt-3">

                    <a href="defesas.php" class="btn btn-primary"><i class="fas fa-bars"></i> Ver todas</a>
                </div>

            </div>



        </div>



    </main>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="../../assets/dist/js/defesas-scripts.js"></script>
</body>

<?php

include "./partials/footer.php";
?>

</html>