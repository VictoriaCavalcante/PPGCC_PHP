<?php

include "../../backend/isLogado.php";


include "../../backend/conexao.php";
include "../../backend/SubsecaoModel.php";
include "../../backend/defesasModel.php";
include "../../backend/SecaoModel.php";
include "../../backend/UsuarioModel.php";


$defesaModel = new DefesasModel($cnx);
$usuarioModel = new UsuarioModel($cnx);

$usuario_logado = $_SESSION['usuario'];

$subsecaoModel = new SubsecaoModel($cnx);


if ($usuario_logado['permissao'] == 2) {

    $defesas = $defesaModel->getDefesas();
} else {

    $defesas = $defesaModel->getDefesasUsuario($usuario_logado['id']);
}


$menu_ativo = 3

?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>Admin - Defesas</title>

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

                        <a class="btn btn-success mt-2" href="./addDefesas.php">
                            <i class="fas fa-plus"></i>
                            Nova Defesa
                        </a>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->

        <section class="content">


            <div class="container">



                <div class="card">
                    <div class="card-header">
                        <div class="row">

                            <div class="col-8">
                                <h3><i class="fas fa-user-graduate"></i> Defesas</h3>

                            </div>
                            <div class="col-4 text-center">

                                <input type="text" id="myInput" class="form-control" placeholder="Pesquise as defesas aqui">


                            </div>
                        </div>

                    </div>

                    <div class="card-body">
                        <table class="table">

                            <thead>
                                <th>Titulo</th>
                                <th>Local</th>
                                <th>Data/Hora</th>
                                <th>Usuário</th>
                                <th>Operações</th>
                            </thead>

                            <tbody id="myTable">

                                <?php

                                while ($defesa = mysqli_fetch_array($defesas)) {

                                ?>

                                    <tr>
                                        <td>
                                            <?php
                                            if (strlen($defesa['titulo']) > 30) {
                                                echo substr($defesa['titulo'], 0, 30) . '...';
                                            } else {
                                                echo $defesa['titulo'];
                                            }
                                            ?>
                                        </td>

                                        <td>
                                            <?php
                                            if (strlen($defesa['local']) > 20) {
                                                echo substr($defesa['local'], 0, 20) . '...';
                                            } else {
                                                echo $defesa['local'];
                                            }
                                            ?>
                                        </td>
                                        <td><?php

                                            $dia = substr($defesa['horario'], 8, 2);
                                            $mes = substr($defesa['horario'], 5, 2);
                                            $ano = substr($defesa['horario'], 0, 4);

                                            $hora = substr($defesa['horario'], 11, 2);
                                            $minuto = substr($defesa['horario'], 14, 2);

                                            ?>

                                            <i class="far fa-calendar-alt"></i>

                                            <?php

                                            echo "$dia/$mes/$ano";

                                            ?>

                                            <br>
                                            <i class="far fa-clock"></i>
                                            <?php
                                            echo $hora . ":" . $minuto


                                            ?>

                                        </td>

                                        <td>

                                            <?php

                                            $nomeUsuario = $usuarioModel->getUsuarioId($defesa['usuario_id'])->usuario;

                                            if (strlen($nomeUsuario) > 30) {
                                                echo substr($nomeUsuario, 0, 30) . '...';
                                            } else {
                                                echo $nomeUsuario;
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            
                                            <form action="editarDefesas.php" method="post" style="display:inline;">

                                                <input type="hidden" name="defesa_id" value="<?= $defesa['id'] ?>">
                                                <button class="btn btn-primary">
                                                    <i class="nav-icon fas fa-edit"></i>
                                                    Editar
                                                </button>
                                            </form>

                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#excluir<?= $defesa['id'] ?>">
                                                <i class="nav-icon fas fa-trash"></i>
                                                Excluir

                                            </button>
                                            <div class="modal" id="excluir<?= $defesa['id'] ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Excluir Defesa</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <p style="font-size: 20px">
                                                                Tem certeza que deseja excluir esta defesa?
                                                            </p>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">

                                                            <form action="../../backend/excluirDefesa.php" method="post">
                                                                <input type="hidden" name="url_destino" value="../pages/admin/defesas.php">
                                                                <input type="hidden" name="id_defesa" value="<?= $defesa['id'] ?>">

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



        </section>



        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include "footer.php"; ?>

    <?php

    include "./partial/modalPermissao.php";
    ?>

    <?php

    include "./partial/modelSair.php"
    ?>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->



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


<!-- AdminLTE for demo purposes -->
<!-- <script src="../../../../assets/dist/js/demo.js"></script> -->
<!-- Page specific script -->

</html>