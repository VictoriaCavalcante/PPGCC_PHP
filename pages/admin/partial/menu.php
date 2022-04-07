<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->



    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>


    </ul>

    <ul class="nav-item ml-auto" style="font-size: 20px">
        <i class="fas fa-user-circle"></i>
        <?= $usuario_logado['usuario'] ?> - <?php 
            if($usuario_logado['permissao'] == 2){

                echo "Super Admin";
            }else{

                echo 'Admin';
            } 
        ?>
    </ul>
    <ul class="navbar-nav ml-auto">


        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="brand-link">
        <img src="../../assets\dist\img\logoUFAC.svg" alt="UFAC Logo" class="brand-image img-circle elevation-3" style="opacity: 1">
        <span class="brand-text font-weight-light">UFAC</span>
    </div>



    <!-- Sidebar Menu -->

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->

                <?php

                if (isset($menu_ativo) && $menu_ativo == 1) {
                ?>
                    <li class="nav-item">
                        <a href="./index.php" class="nav-link ativo">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Home
                            </p>
                        </a>
                    </li>
                <?php } else { ?>

                    <li class="nav-item">
                        <a href="./index.php" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Home
                            </p>
                        </a>
                    </li>

                <?php } ?>


                <?php

                if (isset($menu_ativo) && $menu_ativo == 2) {
                ?>
                    <li class="nav-item">
                        <a href="./noticia.php" class="nav-link ativo">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>
                                Notícias
                            </p>
                        </a>
                    </li>

                <?php } else { ?>

                    <li class="nav-item">
                        <a href="./noticia.php" class="nav-link">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>
                                Notícias
                            </p>
                        </a>
                    </li>

                <?php } ?>

                <?php

                if (isset($menu_ativo) && $menu_ativo == 3) {
                ?>

                    <li class="nav-item">
                        <a href="./defesas.php" class="nav-link ativo">
                            <i class="nav-icon fas fa-user-graduate"></i>
                            <p>
                                Defesas
                            </p>
                        </a>
                    </li>

                <?php } else { ?>

                    <li class="nav-item">
                        <a href="./defesas.php" class="nav-link">
                            <i class="nav-icon fas fa-user-graduate"></i>
                            <p>
                                Defesas
                            </p>
                        </a>
                    </li>


                <?php } ?>


                <?php

                $secaoModel = new SecaoModel($cnx);

                $resultado = $secaoModel->getSecaoId_usuario($usuario_logado['id']);


                // Esse loop mostra todas as seções cadastradas
                while ($secao = mysqli_fetch_array($resultado)) {

                    $menu_aberto = "";

                    if ($usuario_logado['permissao'] == 2) {

                        $id = $secao['id'];
                    } else {

                        $id = $secao['id_secao'];
                    }

                    if (isset($secao_atual) && $id == $secao_atual || (isset($id_secao_aberta_menu) && $secao['id'] == $id_secao_aberta_menu)) {

                        $menu_aberto = "menu-open";
                    }


                ?>


                    <li class="nav-item <?= $menu_aberto ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon <?= $secao['icon'] ?>"></i>
                            <p>
                                <?= $secao['titulo'] ?>
                            </p>


                            <i class="right fas fa-angle-left"></i>
                        </a>




                        <ul class="nav nav-treeview ml-3">

                            <?php


                            if ($usuario_logado['permissao'] == 2) {

                                $id_sec = $secao['id'];
                            } else {

                                $id_sec = $secao['id_secao'];
                            }


                            $sql = "SELECT * FROM subsecao WHERE id_secao = '$id_sec' ORDER BY ordem ASC";

                            $res = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));
                            while ($subsecao = mysqli_fetch_array($res)) {

                                $ativo = "";

                                if (isset($subsecao_atual) && $subsecao_atual == $subsecao['id']) {

                                    $ativo = "ativo";
                                }
                            ?>


                                <li class="nav-item">
                                    <a href="./view.php?subsecao=<?= $subsecao['id'] ?>" class="nav-link <?= $ativo ?>">
                                        <i class="nav-icon far fa-sticky-note"></i>
                                        <p><?= $subsecao['titulo'] ?></p>
                                    </a>
                                </li>


                            <?php }



                            if ($usuario_logado['permissao'] == 2) {

                                $active = '';
                                if (isset($configurar_secao_id) && $secao['id'] == $configurar_secao_id) {

                                    $active = 'ativo';
                                }
                            ?>

                                <li class="nav-item">
                                    <a href="./configurarSecao.php?id=<?= $secao['id'] ?>" class="nav-link <?= $active ?>">
                                        <i class="far fas fa-cogs mr-2"></i>
                                        <p>Configurar Seção</p>
                                    </a>
                                </li>

                            <?php

                            } else {


                            ?>
                                <li class="nav-item">
                                    <a href="" class="nav-link" data-toggle="modal" data-target="#permissao">
                                        <i class="far fas fa-cogs mr-2"></i>
                                        <p>Configurar Seção</p>
                                    </a>
                                </li>


                            <?php
                            }
                            $active = '';
                            if (isset($id_secao_aberta_menu) && $secao['id'] == $id_secao_aberta_menu) {

                                $active = 'ativo';
                            }
                            ?>
                            <li class="nav-item">
                                <a href="./addSubsecao.php?id_secao=<?= $id_sec ?>" class="nav-link <?= $active ?>">
                                    <i class="far fas fa-plus-circle mr-1"></i>
                                    <p>Nova Subseção</p>
                                </a>
                            </li>
                        </ul>

                    </li>

                <?php } ?>


                <?php

                if ($usuario_logado['permissao'] == 2) {
                    if (isset($novaSecao)) {
                ?>

                        <li class="nav-item">
                            <a href="./addSecao.php" class="nav-link ativo">
                                <i class="nav-icon fas fa-plus-circle"></i>
                                <p>
                                    Nova Seção
                                </p>
                            </a>
                        </li>

                    <?php } else { ?>
                        <li class="nav-item">
                            <a href="./addSecao.php" class="nav-link">
                                <i class="nav-icon fas fa-plus-circle"></i>
                                <p>
                                    Nova Seção
                                </p>
                            </a>
                        </li>
                    <?php }
                } else {

                    ?>
                    <li class="nav-item">
                        <a href="" class="nav-link" data-toggle="modal" data-target="#permissao">
                            <i class="nav-icon fas fa-plus-circle"></i>
                            <p>
                                Nova Seção
                            </p>
                        </a>
                    </li>


                <?php
                }
                ?>

                <?php if (isset($uploads)) { ?>

                    <li class="nav-item">
                        <a href="./upload.php" class="nav-link ativo">
                            <i class="nav-icon fas fa-upload"></i>
                            <p>
                                Uploads
                            </p>
                        </a>
                    </li>


                <?php
                } else {
                ?>

                    <li class="nav-item">
                        <a href="./upload.php" class="nav-link">
                            <i class="nav-icon fas fa-upload"></i>
                            <p>
                                Uploads
                            </p>
                        </a>
                    </li>
                <?php } ?>

                <?php

                if ($usuario_logado['permissao'] == '2') {

                    if (isset($usuarios)) {
                ?>

                        <li class="nav-item">
                            <a href="./configurarUsuario.php" class="nav-link ativo">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>
                                    Usuários
                                </p>
                            </a>
                        </li>

                    <?php

                    } else {
                    ?>

                        <li class="nav-item">
                            <a href="./configurarUsuario.php" class="nav-link">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>
                                    Usuários
                                </p>
                            </a>
                        </li>

                    <?php
                    }
                } else {

                    ?>

                    <li class="nav-item">
                        <a href="" class="nav-link" data-toggle="modal" data-target="#permissao">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>
                                Usuários
                            </p>
                        </a>
                    </li>

                <?php

                }
                ?>

                <li class="nav-item mb-5">
                    <a href="" class="nav-link" data-toggle="modal" data-target="#sair">
                        <i class="nav-icon fas fa-reply"></i>
                        <p>
                            Sair
                        </p>
                    </a>
                </li>

            </ul>
        </nav>

    </div>
</aside>