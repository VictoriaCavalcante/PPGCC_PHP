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

    <link rel="stylesheet" href="../../assets/dist/css/style-contrele-permicoes.css">
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

                <?php

                if (isset($_GET['senha_errada']) && $_GET['senha_errada'] == 1) {
                ?>
                    <div class="alert alert-danger alert-dismissible w-100">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Erro!</strong> As senhas não coincidem.
                    </div>
                <?php
                }
                ?>

                <div class="card">

                    <div class="card-header">
                        <h3>Cadastrar Usuário</h3>
                    </div>
                    <div class="card-body">

                        <form action="../../backend/criarUsuario.php" method="POST" class="form1">

                            <label>Usuário</label>
                            <input type="text" placeholder="Login do Usuário" name="usuario" class="form-control usuario">
                            <input type="hidden" name="url_destino" class="url_destino" value="../pages/admin/configurarUsuario.php">
                            <input type="hidden" name="url_erro" value="../pages/admin/addUsuario.php">



                            <div class="lista-oculta">

                            </div>

                            <hr>
                            <div class="row w-50">

                                <div class="col pl-3">
                                    <label>Tipo de usuário</label>

                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" name="tipo_usuario" value="1" class="form-check-input" checked>Admin

                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <label class="form-check-label">

                                            <input type="radio" name="tipo_usuario" value="2" class="form-check-input"> Super-Admin

                                        </label>
                                    </div>
                                </div>

                                <div class="col pl-3">
                                    <label>Status</label>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" name="status" value="1" class="form-check-input" checked>Ativado

                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <label class="form-check-label">

                                            <input type="radio" name="status" value="0" class="form-check-input"> Desativado

                                        </label>
                                    </div>
                                </div>

                            </div>
                            <hr>

                            <label>Configurar Permissões</label>

                            <?php


                            $secaoModel = new SecaoModel($cnx);

                            $secoes = $secaoModel->getSecaoAll();


                            ?>
                            <div class="row border pb-1 w-100">
                                <div class="col-5">
                                    <label>Seções</label>
                                    <select id="caixa-secoes" class="form-control w-100" size="10" multiple>

                                        <option value=""></option>
                                        <?php while ($secao = mysqli_fetch_array($secoes)) { ?>

                                            <option class="border mb-2 border-top-0 border-left-0 border-right-0" value="<?= $secao['id'] ?>"><?= $secao['titulo'] ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                                <div class="col-2 campo-btn">

                                    <div class="are-btn-add">
                                        <a href="" title="Adicionar permissão" class="btn-add"><i class="fas fa-plus-circle label-btn btn1 text-success"></i></a>

                                    </div>

                                    <div class="are-btn-remove">
                                        <a href="" title="Remover permissão" class="btn-remove"><i class="fas fa-times-circle label-btn btn2 text-danger"></i></a>

                                    </div>



                                </div>
                                <div class="col-5">

                                    <label>Permissões</label>
                                    <select id="caixa-permissoes" name="secoes" class="form-control w-100" size="10" multiple>



                                    </select>
                                </div>
                            </div>
                            <hr>
                            <label>Defina Senha</label>

                            <div class="row mt-3 mb-3">
                                <div class="col">
                                    <input type="password" name="senha1" class="form-control senha1" placeholder="Senha">
                                </div>
                                <div class="col">
                                    <input type="password" name="senha2" class="form-control senha2" placeholder="Confirmação de senha">
                                </div>
                            </div>
                            <div class="row">
                                <div class="alert alert-success alert-dismissible sucesso w-100" style="display: none">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Sucesso!</strong> Usuario criado com sucesso.
                                </div>


                                <div class="alert alert-danger alert-dismissible erro w-100" style="display: none">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Erro!</strong> As senhas não coincidem.
                                </div>


                            </div>

                            <div class="text-center">

                                <button class="btn btn-success btn-salvar1">
                                    <i class="nav-icon fas fa-save"></i>
                                    Salvar
                                </button>

                                <a href="./configurarUsuario.php" class="btn btn-danger">
                                    <i class="fas fa-ban"></i>
                                    Cancelar
                                </a>
                            </div>
                        </form>

                        <script>
                            let ele = document.querySelector(".erro");
                            let senha1 = document.querySelector('.senha1');
                            let senha2 = document.querySelector('.senha2');
                            let form = document.querySelector('.form');

                            if (senha1.value != senha2.value) {

                                form.preventDefault();
                                ele.style.display = 'block';

                            }
                        </script>
                    </div>

                </div>
            </div>

        </section>


        <script src="../../assets/dist/js/caixaSelecao.js"></script>

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


</html>