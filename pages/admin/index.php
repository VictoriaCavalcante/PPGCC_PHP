<?php

include "../../backend/isLogado.php";
include('../../backend/conexao.php');
include "../../backend/NoticiaModel.php";
include "../../backend/SecaoModel.php";

$usuario_logado = $_SESSION['usuario'];



$noticiamodel = new NoticiaModel($cnx);



$menu_ativo = 1;

?>



<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>Admin - PPGCC</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../../assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../../assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../../assets/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../assets/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../../assets/plugins/daterangepicker/daterangepicker.css">

    <link rel="stylesheet" href="../../assets/dist/css/style-admin.css">

    <link rel="stylesheet" href="../../assets/dist/css/style-home.css">


    <style>
        iframe {
            max-width: 100%;
            height: 360px;
        }
    </style>



</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">


        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../../assets/dist/img/ufac-logo.png" alt="AdminLTELogo" height="auto" width="80">
        </div>

        <!-- Navbar -->
        <?php

        include "./partial/menu.php";

        ?>
        <!-- /.sidebar -->


        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="box-main">

                        <div class="area-menu">

                            <a href="./noticia.php" class="box-menu bg-primary">
                                <div class="box-label">

                                    Notícias


                                </div>
                                <div class="box-icon">

                                    <i class="nav-icon fas fa-newspaper icon"></i>
                                </div>

                            </a>

                            <a href="./defesas.php" class="box-menu bg-warning">

                                <div class="box-label">

                                    Defesas
                                </div>
                                <div class="box-icon">

                                    <i class="nav-icon fas fa-user-graduate icon"></i>
                                </div>
                            </a>

                            <?php

                            if ($usuario_logado['permissao'] == 2) {
                            ?>

                                <a href="./addSecao.php" class="box-menu bg-secondary">

                                    <div class="box-label">
                                        Nova Seção
                                    </div>
                                    <div class="box-icon">

                                        <i class="nav-icon fas fa-plus-circle icon"></i>
                                    </div>
                                </a>
                            <?php

                            } else {

                            ?>
                                <a href="" class="box-menu bg-secondary"  data-toggle="modal" data-target="#permissao">

                                    <div class="box-label">
                                        Nova Seção
                                    </div>
                                    <div class="box-icon">

                                        <i class="nav-icon fas fa-plus-circle icon"></i>
                                    </div>
                                </a>
                            <?php
                            }
                            ?>
                            <a href="./upload.php" class="box-menu bg-info">

                                <div class="box-label">

                                    Uploads
                                </div>
                                <div class="box-icon">

                                    <i class="nav-icon fas fa-upload icon"></i>
                                </div>
                            </a>


                            <?php

                            if ($usuario_logado['permissao'] == '2') {

                            ?>
                                <a href="./configurarUsuario.php" class="box-menu bg-success">
                                    <div class="box-label">

                                        Usuários
                                    </div>
                                    <div class="box-icon">

                                        <i class="nav-icon fas fa-user-cog icon"></i>
                                    </div>
                                </a>
                            <?php } else { ?>

                                <a href="" class="box-menu bg-success" data-toggle="modal" data-target="#permissao" data-toggle="modal" data-target="#permissao">
                                    <div class="box-label">

                                        Usuários
                                    </div>
                                    <div class="box-icon">

                                        <i class="nav-icon fas fa-user-cog icon"></i>
                                    </div>
                                </a>
                            <?php } ?>
                            <a href="" class="box-menu bg-danger" data-toggle="modal" data-target="#sair">
                                <div class="box-label">

                                    Sair
                                </div>
                                <div class="box-icon icon">

                                    <i class="nav-icon fas fa-reply icon"></i>
                                </div>
                            </a>

                        </div>

                    </div><!-- /.container-fluid -->
                </div>


                <section class="content">

                </section>

            </div>

        </div>

        <?php include "footer.php"; ?>

        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>

        <?php

        include "./partial/modalPermissao.php";
        ?>
    </div>
    <!-- ./wrapper -->

    <?php

    include "./partial/modelSair.php";

    ?>

</body>



<!-- jQuery -->
<script src="../../assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../../assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../../assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../../assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../../assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../../assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../../assets/plugins/moment/moment.min.js"></script>
<script src="../../assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../../assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../assets/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="../../../../assets/dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

<!-- <script src="../../../../assets/dist/js/demo.js"></script> -->
<!-- Page specific script -->

</html>