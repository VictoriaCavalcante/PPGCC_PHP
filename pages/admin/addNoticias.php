<?php

include "../../backend/isLogado.php";


include('../../backend/conexao.php');
include "../../backend/SubsecaoModel.php";
include "../../backend/SecaoModel.php";

$usuario_logado = $_SESSION['usuario'];

$subesecaoModel = new SubsecaoModel($cnx);
$secaoModel = new SecaoModel($cnx);



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


    <style>
        iframe {
            max-width: 100%;
            height: 360px;
        }
    </style>


    <?php
    include "./partial/editor.php";
    ?>

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
        </aside>


        <?php

        include "./partial/modelSair.php";

        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="position:relative">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->


            <section class="container">

                <div class="card">
                    <div class="card-header">
                        <h3>Nova Notícia</h3>
                    </div>

                    <div class="card-body">

                        <form action="../../backend/criaNoticia.php" class="form" method="POST" enctype="multipart/form-data">

                            <label>Título</label>
                            <input name="titulo" type="text" placeholder="Título da notícia" class="form-control" required>
                            <br>
                            <label>Prévia</label>
                            <textarea name="previa" placeholder="Digite uma prévia do conteúdo da notícia" class="form-control" required></textarea>
                            <br>
                            <label>Imagem da Notícia</label>
                            <input type="file" name="img" class="form-control pt-1 inputfile" accept="image/*" required>

                            <?php

                            if (isset($_GET['erro']) && $_GET['erro'] == 1) {

                            ?>

                                <div class="alert alert-danger mt-3 alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>

                                    <strong>Error!</strong> Tipos de imagens aceitas: png, jpeg e jpg
                                </div>
                            <?php

                            }

                            ?>

                            <?php
                            if (isset($_GET['erro']) && $_GET['erro'] == 2) {

                            ?>

                                <div class="alert alert-danger mt-3 alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>

                                    <strong>Error!</strong> Arquivo contém nome com caracteres especiais
                                </div>
                            <?php

                            }

                            ?>
                            <div class="alert alert-danger mt-3 alert-dismissible notificacao" style="display: none;">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>

                                <strong>Error!</strong> Tipos de imagens aceitas: png, jpeg e jpg
                            </div>
                            <br>
                            <label>Conteúdo</label>
                            <textarea name="conteudo" class="form-control conteudo" placeholder="Escreva a notícia aqui"></textarea>

                            <input type="hidden" name="id_usuario" value="<?= $usuario_logado['id'] ?>">
                            <input type="hidden" name="url_destino" value="../pages/admin/noticia.php">
                            <input type="hidden" name="url_destino_error" value="../pages/admin/addNoticias.php">

                            <div class="text-center">

                                <button type="submit" class="btn btn-success mt-3" id="idPublicar">
                                    <i class="nav-icon fas fa-external-link-alt"></i>

                                    Publicar
                                </button>
                                <a href="noticia.php" class="btn btn-danger mt-3">
                                    <i class="fas fa-ban"></i>
                                    Cancelar
                                </a>
                            </div>


                        </form>
                    </div>

                </div>





            </section>

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include "footer.php"; ?>
        <?php

        include "./partial/modalPermissao.php";
        ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

</body>


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

<script src="../../assets/dist/js/validaEntradas.js"></script>

<!-- <script src="../../../../assets/dist/js/demo.js"></script> -->
<!-- Page specific script -->


</html>