<?php



include "../../backend/conexao.php";
include "../../backend/UsuarioModel.php";
include "../../backend/isLogado.php";
include "../../backend/SecaoModel.php";


$usuario_logado = $_SESSION['usuario'];

$usuarioModel = new UsuarioModel($cnx);

$usuarioSuperAdmin = false;

if ($usuario_logado['permissao'] == '2') {

    $usuarioSuperAdmin = true;
}


$usuarios = true;

?>



<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>Admin - Gerênciar Usuários</title>

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
                <div class="row">
                    <div class="col text-center">
                        <a href="./addUsuario.php" class="btn btn-success">
                            <i class="fas fa-plus"></i>
                            Cadastrar Usuário
                        </a>
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->

        <section class="content">


            <div class="container">



                <?php if (isset($_GET['erro']) && $_GET['erro'] == 1) { ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Falha!</strong> Usuário já cadastrado.
                    </div>
                <?php } ?>

                <?php if (isset($_GET['erro']) && $_GET['erro'] == 2) { ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>

                        <strong>Falha!</strong> Houve uma falha na criação do usuário.
                    </div>
                <?php } else if (isset($_GET['erro']) && $_GET['erro'] == 2) { ?>

                    <div class="alert alert-danger alert-dismissible erro w-100" style="display: none">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Erro!</strong> As senhas forne
                    </div>
                <?php } ?>
                <?php if (isset($_GET['success'])) { ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>

                        <strong>Sucesso!</strong> Usuário criado com sucesso.
                    </div>
                <?php } ?>
                <div class="card">

                    <div class="card-header">
                        <div class="row">
                            <div class="col-8">

                                <h3><i class="nav-icon fas fa-user-cog"></i> Usuários</h3>
                            </div>

                            <div class="col-4 text-right">

                                <input type="text" id="myInput" class="form-control" placeholder="Pesquise o usuário aqui">


                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="text-center">

                            <table class="table">

                                <thead>
                                    <tr>
                                        <th>Usuário</th>
                                        <th>Permissão</th>
                                        <th>Status</th>
                                        <th>Operações</th>
                                    </tr>

                                </thead>

                                <tbody id="myTable">

                                    <?php

                                    $usuarios = $usuarioModel->getUsuarios();
                                    while ($usuario = mysqli_fetch_array($usuarios)) {

                                    ?>

                                        <tr>
                                            <td><?= $usuario['usuario'] ?></td>
                                            <td>
                                                <?php if ($usuario['permissao'] == '1') { ?>

                                                    Admin

                                                <?php } else { ?>

                                                    Super Admin

                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if ($usuario['ativado'] == '1') { ?>

                                                    Habilitado

                                                <?php } else { ?>

                                                    Desabilitado

                                                <?php } ?>
                                            </td>
                                            <td>

                                                <form action="./editarUsuario.php" method="post" style="display:inline;">

                                                    <input type="hidden" name="usuario_id" value="<?= $usuario['id'] ?>">
                                                    <button  class="btn btn-primary">
                                                        <i class="fas fa-edit"></i>
                                                        Editar
                                                    </button>
                                                </form>


                                                <button class="btn btn-danger" data-toggle="modal" data-target="#modalDelete<?= $usuario['id'] ?>">
                                                    <i class="fas fa-trash"></i>
                                                    Excluir
                                                </button>

                                                <div class="modal" id="modalDelete<?= $usuario['id'] ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header ">
                                                                <h4 class="modal-title">Excluir Usuário</h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <p style="font-size: 20px;">
                                                                    Tem certeza que deseja excluir o usuário: <?= $usuario['usuario'] ?>?
                                                                </p>
                                                            </div>

                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">

                                                                <form action="../../backend/deletetarUsuario.php" method="post">
                                                                    <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
                                                                    <input type="hidden" name="url" value="../pages/admin/configurarUsuario.php">
                                                                    <button class="btn btn-success">Sim</button>
                                                                </form>
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>

                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>

                                            </td>

                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>

                            </table>
                        </div>

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
<script>
    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>



</html>