<?php

include "../../backend/isLogado.php";


include('../../backend/conexao.php');

include "../../backend/NoticiaModel.php";
include "../../backend/SecaoModel.php";
include "../../backend/UsuarioModel.php";

$usuario_logado = $_SESSION['usuario'];
$usuarioModel = new UsuarioModel($cnx);
$noticiamodel = new NoticiaModel($cnx);



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
                    <div class="row mb-2">
                        <div class="text-center w-100">

                            <a class="btn btn-success mt-2" href="addNoticias.php">
                                <i class="fas fa-plus"></i>

                                Nova Notícia
                            </a>
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>

                <?php
                if (isset($_GET['erro']) && $_GET['erro'] == '1') {
                ?>
                    <div class="alert alert-danger mt-3 alert-dismissible notificacao">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Error!</strong> Tipo de imagem não foi aceita
                    </div>
                <?php
                } else if (isset($_GET['success']) && $_GET['success'] = 1) { ?>

                    <div class="alert alert-success mt-3 alert-dismissible notificacao">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Sucesso!</strong> Alterações feitas com sucesso!
                    </div>
                <?php

                }
                ?>


                <?php
                if (isset($_GET['erro']) && $_GET['erro'] == '2') {
                ?>
                    <div class="alert alert-danger mt-3 alert-dismissible notificacao">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Error!</strong> Arquivo contém nome com caracteres especiais
                    </div>
                <?php
                }
                ?>
                <section class="content">
                    <div class="container">


                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-8">

                                        <h3><i class="nav-icon fas fa-newspaper"></i> Notícias</h3>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" id="myInput" class="form-control" placeholder="Pesquise as notícias aqui">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Título</th>
                                                <th>Usuário</th>
                                                <th>Data/Hora</th>
                                                <th>Operações</th>
                                            </tr>
                                        </thead>

                                        <tbody id="myTable">
                                            <?php

                                            if ($usuario_logado['permissao'] == 1) {

                                                $noticias = $noticiamodel->getNoticiaUsuario($usuario_logado['id']);
                                            } else {

                                                $noticias = $noticiamodel->getNoticiaAll();
                                            }
                                            while ($noticia = mysqli_fetch_array($noticias)) {
                                            ?>
                                                <tr>
                                                    <td>
                                                        <?php
                                                        if (strlen($noticia['titulo']) > 50) {
                                                            echo substr($noticia['titulo'], 0, 50) . '...';
                                                        } else {
                                                            echo $noticia['titulo'];
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php

                                                        $nomeUsuario = $usuarioModel->getUsuarioId($noticia['id_usuario'])->usuario;
                                                        if (strlen($nomeUsuario) > 30) {
                                                            echo substr($nomeUsuario, 0, 30) . '...';
                                                        } else {
                                                            echo $nomeUsuario;
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php

                                                        $dia = substr($noticia['data_publicacao'], 8, 2);
                                                        $mes = substr($noticia['data_publicacao'], 5, 2);
                                                        $ano = substr($noticia['data_publicacao'], 0, 4);

                                                        $hora = substr($noticia['data_publicacao'], 11, 2);
                                                        $minuto = substr($noticia['data_publicacao'], 14, 2);
                                                        ?>

                                                        <i class="far fa-calendar-alt"></i>
                                                        <?php echo "$dia/$mes/$ano" ?>
                                                        <br>
                                                        <i class="far fa-clock"></i>
                                                        <?php echo $hora . ":" . $minuto ?>
                                                    </td>
                                                    <td>
                                                        <form action="editarNoticias.php" style="display:inline;" method="POST">
                                                            <input type="hidden" name="id" value="<?= $noticia['id'] ?>">
                                                            <button class="btn btn-primary">
                                                                <i class="fas fa-edit"></i>
                                                                Editar
                                                            </button>
                                                        </form>
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDelete<?= $noticia['id'] ?>">
                                                            <i class="nav-icon fas fa-trash"></i>
                                                            Excluir
                                                        </button>

                                                        <div class="modal" id="modalDelete<?= $noticia['id'] ?>">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">

                                                                    <!-- Modal Header -->
                                                                    <div class="modal-header ">
                                                                        <h4 class="modal-title">Excluir Notícia</h4>
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    </div>

                                                                    <!-- Modal body -->
                                                                    <div class="modal-body">
                                                                        <p style="font-size: 20px;">
                                                                            Tem certeza que deseja excluir a notícia: <?= $noticia['titulo'] ?>?
                                                                        </p>
                                                                    </div>

                                                                    <!-- Modal footer -->
                                                                    <div class="modal-footer">

                                                                        <form action="../../backend/excluirNoticia.php" method="post">
                                                                            <input type="hidden" name="id_noticia" value="<?= $noticia['id'] ?>">
                                                                            <input type="hidden" name="url_destino" value="../pages/admin/noticia.php">
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

            </div>

        </div>

        <?php include "footer.php"; ?>

        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>

    </div>
    <!-- ./wrapper -->

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