<?php

include "../../backend/isLogado.php";


include "../../backend/conexao.php";
include "../../backend/SubsecaoModel.php";
include "../../backend/defesasModel.php";
include "../../backend/SecaoModel.php";


if (!isset($_POST['defesa_id'])) {

    header("Location: ./defesas.php");
}



$defesaModel = new DefesasModel($cnx);

$usuario_logado = $_SESSION['usuario'];

$subsecaoModel = new SubsecaoModel($cnx);



$id_defesa = $_POST['defesa_id'];

if (!is_numeric($id_defesa)) {

    header("Location: ./defesas.php");
}

$defesa = $defesaModel->getDefesa($id_defesa);

if (!$defesa) {

    header("Location: ./defesas.php");
}

if ($defesa->usuario_id != $usuario_logado['id'] && $usuario_logado['permissao'] != '2')

    header("Location: ./defesas.php");


$menu_ativo = 3;

?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>Admin - Editar defesa</title>

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

                        <h3>Editar Defesa</h3>

                    </div>

                    <div class="card-body">

                        <form action="../../backend/editarDefesa.php" method="POST" class="text-left">

                            <label>Titulo</label>
                            <input type="text" name="titulo" class="form-control" placeholder="Digite o titulo" value="<?= $defesa->titulo ?>" required>
                            <br>
                            <label>Local</label>
                            <input type="text" name="local" class="form-control" placeholder="Digite o local" value="<?= $defesa->local ?>" required>
                            <br>
                            <label>Data e hora</label>
                            <input type="datetime-local" name="horario" class="form-control" value="<?= str_replace(' ', 'T', $defesa->horario) ?>" required>
                            <br>
                            <label>Conteudo</label>
                            <textarea name="conteudo" placeholder="Escreva o conteúdo aqui" class="conteudo"><?= $defesa->conteudo ?></textarea>
                            <input type="hidden" name="id_usuario" value="<?= $usuario_logado['id'] ?>">
                            <input type="hidden" name="url_destino" value="../pages/admin/defesas.php">
                            <input type="hidden" name="id_defesa" value="<?= $id_defesa ?>">
                            <div class="mt-3 text-center">
                                <button class="btn btn-success">
                                    <i class="nav-icon fas fa-save"></i>
                                    Salvar
                                </button>
                                <a href="defesas.php" class="btn btn-danger">
                                    <i class="fas fa-ban"></i>
                                    Cancelar
                                </a>
                            </div>
                        </form>


                    </div>
                </div>

            </div>



        </section>



        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include "footer.php"; ?>


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

    <?php

    include "./partial/modelSair.php";

    ?>
    <?php

    include "./partial/modalPermissao.php";
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