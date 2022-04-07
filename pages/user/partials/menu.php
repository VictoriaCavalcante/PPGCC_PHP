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
                    <a class="nav-link text-white menu-hover texto-menu" href="./index.php">

                        <i class="fas fa-home"></i>

                        Página Inicial
                    </a>
                </li>

                <?php

                while ($secao =  mysqli_fetch_array($secoes)) {

                  
                ?>

                    <li class="nav-item dropdown pt-2 pb-2 mr-1 <?= $secao_ativa ?>">

                        <?php if (isset($secao) && isset($secao_atual) && $secao['id'] == $secao_atual->id) { ?>

                            <a class="nav-link  text-white menu-ativado texto-menu <?= $secao_ativa ?>" data-toggle="dropdown" href="./secao.php?secao=<?= $secao['id'] ?>"><?= $secao['titulo'] ?></a>

                        <?php } else { ?>

                            <a class="nav-link  text-white menu-hover texto-menu <?= $secao_ativa ?>" data-toggle="dropdown" href="./secao.php?secao=<?= $secao['id'] ?>"><?= $secao['titulo'] ?></a>

                        <?php } ?>

                        <div class="dropdown-menu caixa-menu-suspenso" style="z-index: 1000;">

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
                    <?php if (isset($noticias)) { ?>

                        <a class="nav-link text-white menu-ativado texto-menu" href="noticias.php">Notícias</a>

                    <?php } else { ?>

                        <a class="nav-link text-white menu-hover texto-menu" href="noticias.php">Notícias</a>

                    <?php } ?>

                </li>
                <li class="nav-item pt-2 pb-2 mr-1">

                    <?php if (isset($defesas)) { ?>

                        <a class="nav-link text-white menu-ativado texto-menu" href="defesas.php">Defesas</a>

                    <?php } else { ?>
                        <a class="nav-link text-white menu-hover texto-menu" href="defesas.php">Defesas</a>

                    <?php } ?>
                </li>
            </ul>
        </div>
    </div>
</nav>