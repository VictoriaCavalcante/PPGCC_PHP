<?php

include "../../backend/isLogado.php";


include('../../backend/conexao.php');
include "../../backend/SubsecaoModel.php";
include "../../backend/SecaoModel.php";
include "../../backend/NoticiaModel.php";

$usuario_logado = $_SESSION['usuario'];

$subesecaoModel = new SubsecaoModel($cnx);
$secaoModel = new SecaoModel($cnx);
$noticiaModel = new NoticiaModel($cnx);




$id = $_POST['id'];

$noticia = $noticiaModel->getNoticia($id);

$titulo = $noticia->titulo;
$conteudo = $noticia->conteudo;
$img_atual = $noticia->img;
$previa = $noticia->previa;
$id_noticia = $id;


$menu_ativo = 2;

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


                        Editar Notícia
                    </div>
                    <div class="card-body">

                        <form class="form form-editar" action="../../backend/editNoticia.php" method="POST" enctype="multipart/form-data">

                            <label>Título</label>
                            <input name="titulo" type="text" placeholder="Título da notícia" class="form-control inputText" value="<?= $titulo ?>" required>
                            <br>
                            <label>Prévia</label>
                            <textarea name="previa" placeholder="Digite uma prévia do conteúdo da notícia" class="form-control" required><?= $previa ?></textarea>
                            <br>
                            <label>Imagem da Notícia</label>
                            <img src="<?= $img_atual ?>" style="display:block;max-width:250px;max-height:250px;width: auto;height: auto;">

                          
                            <br>
                            <input type="file" name="img_nova" class="form-control pt-1" id="inputfileImg" value="<?= $img ?>" accept="image/*">



                            <br>
                            <label>Conteúdo</label>
                            <textarea name="conteudo" class="form-control conteudo" placeholder="Escreva a notícia aqui"><?= $conteudo ?></textarea>
                            <input type="hidden" name="id" value="<?= $id_noticia ?>">
                            <input type="hidden" name="id_usuario" value="<?= $usuario_logado['id'] ?>">
                            <input type="hidden" name="url_destino" value="../pages/admin/noticia.php">
                            <input type="hidden" name="url_destino_error" value="../pages/admin/editarNoticias.php">
                            <input type="hidden" name="img_atual" value="<?= $img_atual ?>">

                            <div class="text-center">

                                <button type="submit" class="btn btn-success mt-3">
                                    <i class="nav-icon fas fa-save"></i>
                                    Salvar
                                </button>
                                <a href="noticia.php" class="btn btn-danger mt-3">
                                    <i class="fas fa-ban"></i>
                                    Cancelar
                                </a>

                            </div>
                        </form>
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
<!-- Page specific script -->
<!-- <script src="../../assets/dist/js/validaEntradas.js"></script> -->

</html>