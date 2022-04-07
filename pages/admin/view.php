<?php

include "../../backend/isLogado.php";


include('../../backend/conexao.php');
include "../../backend/SubsecaoModel.php";
include "../../backend/SecaoModel.php";
include "../../backend/UsuarioSecaoModel.php";


$secaoModel = new SecaoModel($cnx);
$subesecaoModel = new SubsecaoModel($cnx);
$usuarioSecaoModel = new UsuarioSecaoModel($cnx);


$usuario_logado = $_SESSION['usuario'];


// ######################################

if (!isset($_GET['subsecao'])) {

    header('Location: ./');
    die();
}


$id_subcesao = $_GET['subsecao'];

if (!is_numeric($id_subcesao)) {

    header('Location: ./');
    die();
}

$secao_atual = $subesecaoModel->getSubsecao($id_subcesao)->id_secao;

// verifica se o usuario tem acesso a essa pagina
if ($usuario_logado['permissao'] == '1' &&  !$usuarioSecaoModel->temPermissaoUsuarioSecao($usuario_logado['id'], $secao_atual, $cnx)) {

    header("Location: ./index.php");
}
$subsecaoFull = $subesecaoModel->getSubsecao($id_subcesao);


if (!$subsecaoFull) {

    header('Location: ./');
    die();
}

// ######################################



$subsecao_atual = $id_subcesao;


$visivel = "far fa-eye";
$marcada = "checked";
$ativado = $subsecaoFull->ativada;

if (!$ativado) {

    $visivel = 'far fa-eye-slash';
    $marcada = "";
}

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


    <script>


    </script>


    <script src="../../assets/tinymce/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        function example_image_upload_handler(blobInfo, success, failure, progress) {
            var xhr, formData;

            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '../../backend/upload.php');

            xhr.upload.onprogress = function(e) {
                progress(e.loaded / e.total * 100);
            };

            xhr.onload = function() {
                var json;

                if (xhr.status === 403) {
                    failure('HTTP Error: ' + xhr.status, {
                        remove: true
                    });
                    return;
                }

                if (xhr.status < 200 || xhr.status >= 300) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }

                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }

                success(json.location);
            };

            xhr.onerror = function() {
                failure('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
            };

            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());

            xhr.send(formData);
        };

        tinymce.init({
            selector: 'textarea',
            plugins: [
                'advlist autolink link image imagetools pagebreak list print preview hr searchreplace wordcount fullscreen codesample insertdatetime media save table paste emoticon'
            ],
            images_upload_handler: example_image_upload_handler,
            images_upload_url: '../../backend/upload.php',
            toolbar_sticky: true,
            menubar: 'insert',
            toolbar: 'pagebreak',
            pagebreak_separator: '<!-- my page break -->'

        });
    </script>

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

                        <div class="text-center w-100">
                            <form action="./configurarSubsecao.php" method="post" style="display: inline;">
                                <input type="hidden" name="id" value="<?= $subsecaoFull->id ?>">
                                <button class="btn btn-warning mt-2 text-white">
                                    <i class="nav-icon fas fa-cogs"></i>

                                    Configurar
                                </button>
                            </form>

                            <form action="./editarSubsecao.php" method="post" style="display:inline;">

                                <input type="hidden" name="subsecao" value="<?= $subsecaoFull->id ?>">
                                <button class="btn btn-primary mt-2">
                                    <i class="nav-icon fas fa-edit"></i>
                                    Editar
    
                                </button>

                            </form>

                            <button type="button" class="btn btn-danger mt-2" data-toggle="modal" data-target="#myModal">
                                <i class="nav-icon fas fa-trash"></i>
                                Excluir
                            </button>

                            <?php

                            $habilitado = '';

                            if ($subsecaoFull->conteudo == '') {

                                $habilitado = 'disabled';

                            ?>

                                <button type="button" class="btn btn-secondary mt-2 <?= $habilitado ?>" data-toggle="modal" data-target="#limpar" disabled>
                                    <i class="nav-icon fas fa-eraser"></i>
                                    Limpar

                                </button>

                            <?php

                            } else {

                            ?>

                                <button type="button" class="btn btn-secondary mt-2" data-toggle="modal" data-target="#limpar">
                                    <i class="nav-icon fas fa-eraser"></i>
                                    Limpar

                                </button>

                            <?php

                            }
                            ?>

                            <?php

                            include "./partial/modalPermissao.php";
                            ?>

                            <!-- <i class=" far fa-eye-slash" style="position: absolute;top:5%; right: 10%;top:5%; font-size: 26px;opacity: 0.4"></i> -->

                            <form action="" method="POST" style="position: absolute;top:5%; right: 5%;" id="form">

                                <i class="<?= $visivel ?>" id="icon-visibilidade" style="position: absolute;top:5%; right: 0px;top:5%; font-size: 26px;opacity: 0.4"></i>



                            </form>







                            <div class="modal" id="limpar">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Limpar Conteúdo</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <p style="font-size: 20px">
                                                Tem certeza que deseja limpar o conteúdo?
                                            </p>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">

                                            <form action="../../backend/limparSubsecao.php" method="post">
                                                <input type="hidden" name="url_destino" value="../pages/admin/view.php?subsecao=<?= $subsecaoFull->id ?>">
                                                <input type="hidden" name="id" value="<?= $subsecaoFull->id ?>">
                                                <input type="hidden" name="id_usuario" value="1">
                                                <button class="btn btn-success">Sim</button>
                                            </form>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="modal" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header ">
                                            <h4 class="modal-title">Excluir Subseção</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <p style="font-size: 20px;">
                                                Tem certeza que deseja excluir esta subseção?
                                            </p>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">

                                            <form action="../../backend/excluirSubsecao.php" method="post">
                                                <input type="hidden" name="url_destino" value="../pages/admin/">
                                                <input type="hidden" name="id" value="<?= $subsecaoFull->id ?>">
                                                <input type="hidden" name="id_secao" value="<?= $subsecaoFull->id_secao ?>">
                                                <input type="hidden" name="ordem" value="<?= $subsecaoFull->ordem ?>">
                                                <button class="btn btn-success">Sim</button>
                                            </form>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
                                        </div>

                                    </div>
                                </div>

                            </div>


                        </div>

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->

            <?php


            if ($subsecaoFull->conteudo !== '') {

            ?>

                <section class="container">
                    <div class="container">
                        <h1><?= $subsecaoFull->titulo ?></h1>
                        <hr>
                    </div>
                    <div class="container text-justify">

                        <?= $subsecaoFull->conteudo ?>

                    </div>

                </section>

            <?php } else { ?>

                <section>
                    <div class="container">
                        <h1><?= $subsecaoFull->titulo ?></h1>
                        <hr>
                    </div>
                    <div class="container text-justify">



                    </div>

                </section>

            <?php } ?>
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