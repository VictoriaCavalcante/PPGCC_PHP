<?php

include "../../backend/isLogado.php";


include "../../backend/conexao.php";
include "../../backend/SubsecaoModel.php";

$usuario_logado = $_SESSION['usuario'];

$subsecaoModel = new SubsecaoModel($cnx);

$subsecao_atual = -1;
$secao_atual = -1;

$id_secao = $_GET['id_secao'];

?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - adicionar Subseção</title>

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


</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../../assets/dist/img/ufac-logo.png" alt="AdminLTELogo" height="auto" width="80">
        </div>

        <!-- Navbar -->


        <!-- Navbar -->
        <?php

        include "./partial/menu.php";
        ?>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                    </div><!-- /.col -->
                    <div class="col-sm-6 text-right">

                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->

        <section class="content">


            <div class="container">


                <div class="card">
                    <div class="card-header">
                        <h3>Criar Subseção</h3>
                    </div>

                    <div class="card-body">

                        <form action="../../backend/criarSubsecao.php" method="post">

                            <div class="row p-0 mb-3">
                                <div class="col-8">
                                    <label for="titulo">Titulo</label>
                                    <input type="text" maxlength="30" name="titulo" autocomplete="off" id="titulo" class="form-control" placeholder="ex: Introdução">


                                </div>
                                <div class="col-4">
                                    <?php

                                   
                                    $res = $subsecaoModel->getSubcecaoInSecao($id_secao);

                                    $quantidade_secao = $res->num_rows + 1;


                                    ?>

                                    <label for="ordem">Ordem</label>
                                    <select name="ordem" id="ordem" class="form-control">
                                        <?php for ($ordem = 1; $ordem <= $quantidade_secao; $ordem++) { ?>

                                            <?php if ($ordem == $quantidade_secao) { ?>

                                                <option value="<?= $ordem ?>" selected>


                                                    <?= $ordem ?>

                                                </option>

                                            <?php } else { ?>


                                                <option value="<?= $ordem ?>" selected>


                                                    <?= $ordem ?>

                                                </option>


                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <label>Visibilidade da Página</label>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" value="1" class="form-check-input" name="ativada" checked>Ativada
                                </label>
                            </div>
                            <div class="form-check mb-4">
                                <label class="form-check-label">
                                    <input type="radio" value="0" class="form-check-input" name="ativada">Desativada
                                </label>
                            </div>


                            <input type="hidden" name="url_destino" value="../pages/admin/view.php?subsecao=">
                            <input type="hidden" name="id_usuario" value="<?= $usuario_logado['id'] ?>">
                            <input type="hidden" name="id_secao" value="<?= $id_secao ?>">
                            <div class="text-center">

                                <button type="submit" class="btn btn-success mt-5">Criar Subseção</button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>



        </section>



        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.2.0-rc
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <script>
        const inputTitulo = document.querySelector('#titulo');
        const label = document.querySelector('#label-icon');
        const icon = document.querySelector('#icon-menu');

        let titulo = '';
        inputTitulo.addEventListener('input', (event) => {


            label.innerHTML = inputTitulo.value;

        });

        function pegarIcon(ele) {

            let classes = (ele.value + "").split(' ');

            classes.forEach((valor) => {

                icon.classList.remove(icon.classList[1]);
                icon.classList.remove(icon.classList[2]);

                icon.classList.add(valor);

            })

        }
    </script>


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
<script src="../../assets/dist/js/pages/dashboard.js"></script>

<script src="../../assets/plugins/summernote/summernote-bs4.min.js"></script>

<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<!-- CodeMirror -->
<script src="../../plugins/codemirror/codemirror.js"></script>
<script src="../../plugins/codemirror/mode/css/css.js"></script>
<script src="../../plugins/codemirror/mode/xml/xml.js"></script>
<script src="../../plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="../../../../assets/dist/js/demo.js"></script> -->
<!-- Page specific script -->

</html>