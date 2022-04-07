<?php

include "../../backend/isLogado.php";


include('../../backend/conexao.php');
include "../../backend/SubsecaoModel.php";
include "../../backend/SecaoModel.php";

$usuario_logado = $_SESSION['usuario'];

$subesecaoModel = new SubsecaoModel($cnx);
$secaoModel = new SecaoModel($cnx);


if (!isset($_POST['subsecao'])) {

  header('Location: ./');
}



$id_subsecao = $_POST['subsecao'];

if (!is_numeric($id_subsecao)) {

  header("Location: ./");
}


$subsecao_atual = $id_subsecao;
$subsecaoTitulo = $subesecaoModel->getSubsecao($id_subsecao)->titulo;
$secao_atual = $subesecaoModel->getSubsecao($id_subsecao)->id_secao;


$sql = "SELECT * FROM subsecao WHERE id = '$id_subsecao'";

$fullSubsecao = mysqli_query($cnx, $sql);


$fullSubsecao = mysqli_fetch_object($fullSubsecao);

if (!$fullSubsecao) {

  header('Location: ./');
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
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">

            </div><!-- /.col -->
            <div class="col-sm-6">

            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->

      <section class="content">

        <?php

        $url = '../../backend/editarSubsecao.php';


        if ($fullSubsecao->conteudo == '') {

          $url = '../../backend/criarConteudo.php';
        }

        ?>
        <form action="<?= $url ?>" method="POST">

          <input type="hidden" name="id" value="<?= $fullSubsecao->id ?>">
          <input type="hidden" name="url_destino" value="../pages/admin/view.php?subsecao=<?= $fullSubsecao->id ?>">
          <input type="hidden" name="id_usuario" value="<?= $usuario_logado['id'] ?>">
          <!-- <label for="">
            <h5>Título</h5>
          </label>
          <input class="form-control" type="text" name="titulo" placeholder="Digite o titulo" value=""> -->
          <br>
          <div class="row">
            <div class="col-md-12">
              <div class="card card-outline card-info">
                <div class="card-header">
                  <h2 class="card-title">
                    Editar Subseção: <?= $subsecaoTitulo ?>
                  </h2>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <textArea name="conteudo" class="form-control conteudo" placeholder="Escreva o artigo aqui">
                    <?= $fullSubsecao->conteudo ?>
                  </textArea>
                </div>

              </div>
            </div>

            <!-- /.col-->
          </div>
          <div class="text-center">

            <button class="btn btn-success mb-4">
              <i class="nav-icon fas fa-save"></i>
              Salvar
            </button>
            <a href="view.php?subsecao=<?= $id_subsecao ?>" class="btn btn-danger mb-4">
              <i class="fas fa-ban"></i>
              Cancelar
            </a>


          </div>
        </form>


      </section>

      <?php

      include "./partial/modalPermissao.php";
      ?>

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
<script src="../../assets/dist/js/adminlte.js"></script>
<script src="../../assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->

<!-- AdminLTE for demo purposes -->
<!-- <script src="../../../../assets/dist/js/demo.js"></script> -->
<!-- Page specific script -->

</html>