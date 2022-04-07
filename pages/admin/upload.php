<?php

include "../../backend/isLogado.php";


include('../../backend/conexao.php');
include "../../backend/SubsecaoModel.php";
include "../../backend/SecaoModel.php";
include "../../backend/FileModel.php";
include "../../backend/NoticiaModel.php";
include "../../backend/defesasModel.php";
include "../../backend/UsuarioModel.php";

$usuario_logado = $_SESSION['usuario'];

$noticiaModel = new NoticiaModel($cnx);
$defesaModel = new DefesasModel($cnx);

$subesecaoModel = new SubsecaoModel($cnx);
$secaoModel = new SecaoModel($cnx);
$fileModel = new FileModel();
$usuarioModel = new UsuarioModel($cnx);

// Variavel que define a quantidade maxima que cada paginação comterá.
$cont_saltos = 30;


if (isset($_POST['valor_pesquisa'])) {

    $quantidade_arquivos = $fileModel->numArquivosBusca($cnx, $usuario_logado['id'], $usuario_logado['permissao'], $_POST['valor_pesquisa']);
} else {


    $quantidade_arquivos = $fileModel->numArquivos($cnx, $usuario_logado['id'], $usuario_logado['permissao']);
}

$num_maximo_indices = 30;

$num_indices = intdiv($quantidade_arquivos, $cont_saltos);
$resto = $quantidade_arquivos % $cont_saltos;

if ($resto != 0) {

    $num_indices += 1;
}

if ($num_indices > $num_maximo_indices) {

    $cont_saltos = intdiv($quantidade_arquivos, $num_maximo_indices);

    $resto_saltos = $quantidade_arquivos % $num_maximo_indices;

    $cont_saltos += $resto_saltos;

    $num_indices = intdiv($quantidade_arquivos, $cont_saltos);

    $resto = $quantidade_arquivos % $cont_saltos;

    if ($resto != 0) {

        $num_indices += 1;
    }
    $num_indices += $resto;
}


if (isset($_POST['indice_paginacao']) && $_POST['indice_paginacao'] != 1) {



    $indice_paginacao = $_POST['indice_paginacao'];



    if ($indice_paginacao < 1) {

        $indice_paginacao = 1;
    }

    if ($indice_paginacao > $num_indices) {

        $indice_paginacao = $num_indices;
    }
    $inicio = ($indice_paginacao - 1) * $cont_saltos;
    $fim = $cont_saltos;
} else {



    $indice_paginacao = 1;
    $inicio = 0;
    $fim = $cont_saltos;
}



if (isset($_POST['valor_pesquisa'])) {

    $arquivos = $fileModel->buscar($cnx, $_POST['valor_pesquisa'], $inicio, $fim);
} else {


    $arquivos = $fileModel->listaArquivosNome($cnx, $inicio, $fim);
}




$uploads = true;

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>Admin - PPGCC Upload</title>

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
                        <h3> <i class="nav-icon fas fa-upload"></i> Uploads</h3>

                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-5">

                                <form method="post" action="../../backend/upload.php" enctype="multipart/form-data" id="form">

                                    <div class="row">

                                        <div class="col-8">

                                            <input type="file" name="arquivo" class="form-control pt-1 text-center" id="file" />
                                            <input type="hidden" name="id_usuario" value="<?= $usuario_logado['id'] ?>">

                                        </div>
                                        <div class="col-4">

                                            <button type="submit" class="btn btn-primary" id="btn-enviar">
                                                <i class="fas fa-upload"></i>
                                                Enviar
                                            </button>



                                        </div>
                                    </div>

                                </form>


                            </div>



                            <?php

                            include "./partial/modalPermissao.php";
                            ?>
                            <div class="col-7">
                                <div class="row">

                                    <div class="col-4 text-right">
                                        <div class="dropdown">

                                        </div>

                                    </div>
                                    <div class="col-8">
                                        <div class="row">

                                            <div class="col-12">
                                                <form action="./upload.php" method="post">

                                                    <?php

                                                    if (isset($_POST['valor_pesquisa'])) {

                                                    ?>
                                                        <input type="text" class="form-control inputValor w-75" style="display:inline;" name="valor_pesquisa" value="<?= $_POST['valor_pesquisa'] ?>" placeholder="Digite aqui">

                                                    <?php
                                                        unset($_POST['valor_pesquisa']);
                                                    } else {
                                                    ?>
                                                        <input type="text" class="form-control inputValor w-75" style="display:inline;" name="valor_pesquisa" placeholder="Digite aqui">

                                                    <?php
                                                    }


                                                    ?>
                                                    <button class="btn btn-primary mb-1" style="display:inline;">
                                                        <i class="fas fa-search"></i>
                                                    </button>

                                                </form>
                                            </div>


                                        </div>


                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <?php
                if (isset($_GET['sucesso'])) {
                ?>

                    <div class="alert alert-success mt-3 alert-dismissible" id="notifica-erro">

                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Sucesso:</strong> Upload feito com sucesso!

                    </div>
                    <?php

                }
                if (isset($_GET['erro'])) {

                    $erro = $_GET['erro'];
                    if ($erro == 1) {

                    ?>

                        <div class="alert alert-danger mt-3 alert-dismissible" id="notifica-erro">

                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Erro:</strong> Erro no servidor!

                        </div>
                    <?php

                    } else if ($erro == 2) {

                    ?>


                        <div class="alert alert-danger mt-3 alert-dismissible" id="notifica-erro">

                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Erro:</strong> Tamanho excedido do arquivo!

                        </div>

                    <?php

                    } else if ($erro == 3) {


                    ?>

                        <div class="alert alert-danger mt-3 alert-dismissible" id="notifica-erro">

                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Erro:</strong> Tipo de arquivo não suportado! Extensões suportadas(pdf, doc, docx, png, jpeg, jpg).

                        </div>
                    <?php
                    } else if ($erro == '505') {

                    ?>

                        <div class="alert alert-danger mt-3 alert-dismissible" id="notifica-erro">

                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Erro:</strong> Arquivo não pode ser enviado pro servidor. Contate o administrador do sistema.

                        </div>

                    <?php

                    } else if ($erro == 4) {
                    ?>

                        <div class="alert alert-warning mt-3 alert-dismissible" id="notifica-erro">

                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Alerta!</strong> O arquivo não pode ser excluído, pois ele está sendo utilizado.

                        </div>
                    <?php
                    } else if ($erro == 5) {

                    ?>

                        <div class="alert alert-danger mt-3 alert-dismissible" id="notifica-erro">

                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Erro:</strong> O nome do arquivo contém caracteres especiais

                        </div>

                    <?php
                    } else if ($erro == 6) {

                    ?>

                        <div class="alert alert-warning mt-3 alert-dismissible" id="notifica-erro">

                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Alerta!</strong> Alguns arquivos não puderam ser excluídos, pois estão sendo utilizados.

                        </div>

                <?php
                    }
                }
                ?>
                <div class="alert alert-warning mt-3 alert-dismissible" id="notifica-erro" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Alerta:</strong> Nenhum arquivo selecionado!
                </div>


                <script>
                    let form = document.getElementById('form');
                    let inputFile = document.getElementById('file');
                    let notificaerro = document.getElementById('notifica-erro');

                    form.addEventListener('submit', (event) => {

                        if (inputFile.value == "") {

                            event.preventDefault();
                            notificaerro.style.display = 'block';

                            setInterval(() => {

                                notificaerro.style.display = 'none';

                            }, 8000);
                        }


                    })
                </script>

                <?php

                if ($quantidade_arquivos > $cont_saltos) {
                ?>
                    <div class="row w-100">

                        <div class="col" style="display:flex; justify-content:center;">

                            <ul class="pagination">

                                <?php

                                $anterior_desativada = '';

                                if ($indice_paginacao == 1) {


                                    $anterior_desativada = 'disabled';
                                }
                                ?>

                                <li class="page-item <?= $anterior_desativada ?>">
                                    <form action="./upload.php" method="post">
                                        <input type="hidden" name="indice_paginacao" value="<?= $indice_paginacao - 1 ?>">
                                        <button class="page-link">Anterior</button>
                                    </form>
                                </li>

                                <?php


                                $cont_intervalo = 0;

                                $indice_inicial = 1;



                                for ($indice = $indice_inicial; $indice <= $num_indices; $indice++) {

                                    $ativo = "";

                                    if ($indice == $indice_paginacao) {
                                        $ativo = "active";
                                    }
                                ?>
                                    <li class="page-item <?= $ativo ?>">
                                        <form action="./upload.php" method="post">
                                            <input type="hidden" name="indice_paginacao" value="<?= $indice ?>">


                                            <button class="page-link"><?= $indice ?></button>

                                        </form>
                                    </li>

                                <?php
                                }
                                ?>


                                <?php

                                $prox_desativada = '';

                                if ($indice_paginacao == $num_indices) {

                                    $prox_desativada = 'disabled';
                                }
                                ?>

                                <li class="page-item <?= $prox_desativada ?>">

                                    <form action="./upload.php" method="post">
                                        <input type="hidden" name="indice_paginacao" value="<?= $indice_paginacao + 1 ?>">
                                        <button class="page-link">Proximo</button>
                                    </form>
                                </li>
                            </ul>
                        </div>

                    </div>

                <?php
                }
                ?>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-10">
                                <h3>
                                    Arquivos
                                </h3>
                            </div>
                            <div class="col-2">

                                <?php





                                if ($quantidade_arquivos > 0) {


                                ?>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#excluirUpload"><i class="fas fa-trash"></i> Excluir tudo</button>

                                <?php
                                } else {


                                ?>

                                    <button class="btn btn-danger disabled"> <i class="fas fa-trash"></i> Excluir tudo</button>

                                <?php
                                }
                                ?>

                                <div class="modal" id="excluirUpload">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Confirmação de exclusão</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <p>
                                                    Deseja excluir todos os arquivos?

                                                </p>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">

                                                <form action="../../backend/excluirTudoUpload.php" method="POST">

                                                    <input type="hidden" name="url" value="../pages/admin/upload.php">
                                                    <input type="hidden" name="id_usuario" value="<?= $usuario_logado['id'] ?>">
                                                    <button class="btn btn-success">Sim</button>
                                                </form>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <input type="hidden" name="id_usuario" id="id_usuario" value="<?= $usuario_logado['id'] ?>">

                        <table class="table" id="myTable">

                            <thead>
                                <tr>
                                    <th class="text-center">Tipo</th>
                                    <th class="text-center">Nome</th>
                                    <th class="text-center">Data</th>
                                    <th class="text-center">Usuário</th>
                                    <th class="text-center">Operações</th>
                                </tr>
                            </thead>


                            <tbody class="arquivos-table">


                                <?php

                                foreach ($arquivos as $arquivo) {

                                    if ($arquivo['id_usuario'] != $usuario_logado['id'] && $usuario_logado['permissao'] != 2) {

                                        continue;
                                    }
                                ?>

                                    <tr>
                                        <td style="text-align: center;">

                                            <?php
                                            if ($arquivo['tipo'] == 'pdf') {
                                            ?>
                                                <i class="fas fa-file-pdf" style="font-size: 24px;"></i>
                                            <?php } else if ($arquivo['tipo'] == 'doc' || $arquivo['tipo'] == 'docx') { ?>
                                                <i class="fas fa-file-word" style="font-size: 24px;"></i>
                                            <?php } else { ?>
                                                <i class="fas fa-file-image" style="font-size: 24px;"></i>

                                            <?php } ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php

                                            if (strlen($arquivo['nome']) > 30) {

                                                echo substr($arquivo['nome'], 0, 30) . "...";
                                            } else {

                                                echo $arquivo['nome'];
                                            }
                                            ?>

                                        </td>

                                        <td>
                                            <?php
                                            $dia = substr($arquivo['data_criacao'], 8, 2);
                                            $mes = substr($arquivo['data_criacao'], 5, 2);
                                            $ano = substr($arquivo['data_criacao'], 0, 4);

                                            $hora = substr($arquivo['data_criacao'], 11, 2);
                                            $minuto = substr($arquivo['data_criacao'], 14, 2);
                                            ?>

                                            <i class="far fa-calendar-alt"></i>
                                            <?php echo "$dia/$mes/$ano" ?>
                                            <br>
                                            <i class="far fa-clock"></i>
                                            <?php echo $hora . "h" . $minuto ?>
                                        </td>

                                        <td style="text-align: center;">
                                            <?php

                                            $id_user = $arquivo['id_usuario'];

                                            $nome_usuario = $usuarioModel->getUsuarioId($id_user)->usuario;

                                            if (strlen($nome_usuario) > 10) {
                                                echo substr($nome_usuario, 0, 10) . "...";
                                            } else {

                                                echo $nome_usuario;
                                            }
                                            ?>
                                        </td>

                                        <td style="text-align: center;">

                                            <a href="<?= $arquivo['caminho'] ?>" title="Baixar arquivo" class="btn btn-success" download>
                                                <i class="fas fa-download"></i>
                                            </a>

                                            <button class="btn btn-info ml-2" title="Vinculação do arquivo" data-toggle="modal" data-target="#modalUtilizado<?= $arquivo['id'] ?>">
                                                <i class="fas fa-link"></i>
                                            </button>

                                            <button class="btn btn-outline-danger ml-2" title="Excluir arquivo" data-toggle="modal" data-target="#modalDelete<?= $arquivo['id'] ?>">
                                                <i class="fas fa-trash"></i>
                                            </button>

                                            <div class="modal" id="modalUtilizado<?= $arquivo['id'] ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header ">
                                                            <h4 class="modal-title"> <i class="fas fa-link"></i> Vinculações do arquivo</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <?php
                                                            $nome_arquivo = $arquivo['nome'];

                                                            $noticias = $noticiaModel->buscaConteudo($nome_arquivo);
                                                            $defesas = $defesaModel->buscaConteudo($nome_arquivo);
                                                            $subsecoes = $subesecaoModel->buscaConteudo($nome_arquivo);

                                                            if ($noticias->num_rows == 0 && $defesas->num_rows == 0 && $subsecoes->num_rows == 0) {

                                                                echo "Arquivos não está sendo usado";
                                                            } else {

                                                                echo "O arquivo está sendo usado em:";
                                                            }
                                                            ?>
                                                            <br>
                                                            <br>


                                                            <div id="accordion<?= $arquivo['id'] ?>">

                                                                <?php

                                                                if ($noticias->num_rows != 0) {
                                                                ?>
                                                                    <div class="card">
                                                                        <div class="card-header card-link bg-info" data-toggle="collapse" href="#collapseOne<?= $arquivo['id'] ?>" style="cursor: pointer;">
                                                                            <div class="row">
                                                                                <div class="col-11">

                                                                                    Notícias
                                                                                </div>
                                                                                <div class="col-1">

                                                                                    <i class="mr-0 fas fa-angle-right"></i>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <div id="collapseOne<?= $arquivo['id'] ?>" class="collapse" data-parent="#accordion<?= $arquivo['id'] ?>">
                                                                            <div class="card-body">
                                                                                <?php while ($noticia = mysqli_fetch_array($noticias)) { ?>

                                                                                    <form action="./editarNoticias.php" method="post">
                                                                                        <input type="hidden" name="id" value="<?= $noticia['id'] ?>">
                                                                                        <button class="btn">
                                                                                            <?php
                                                                                            if (strlen($noticia['titulo']) > 50) {

                                                                                                echo substr($noticia['titulo'], 0, 50) . '...';
                                                                                            } else {

                                                                                                echo $noticia['titulo'];
                                                                                            }
                                                                                            ?>
                                                                                        </button>

                                                                                    </form>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php
                                                                }


                                                                if ($defesas->num_rows != 0) {
                                                                ?>

                                                                    <div class="card">
                                                                        <div class="card-header card-link bg-info" data-toggle="collapse" href="#collapseTwo<?= $arquivo['id'] ?>" style="cursor: pointer;">

                                                                            <div class="row">
                                                                                <div class="col-11">

                                                                                    Defesas
                                                                                </div>
                                                                                <div class="col-1">

                                                                                    <i class="mr-0 fas fa-angle-right"></i>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <div id="collapseTwo<?= $arquivo['id'] ?>" class="collapse" data-parent="#accordion<?= $arquivo['id'] ?>">
                                                                            <div class="card-body">
                                                                                <?php while ($defesa = mysqli_fetch_array($defesas)) { ?>

                                                                                    <form action="./editarDefesas.php" method="post">
                                                                                        <input type="hidden" name="defesa_id" value="<?= $defesa['id'] ?>">
                                                                                        <button class="btn">
                                                                                            <?php
                                                                                            if (strlen($defesa['titulo']) > 50) {

                                                                                                echo substr($defesa['titulo'], 0, 50) . '...';
                                                                                            } else {

                                                                                                echo $defesa['titulo'];
                                                                                            }
                                                                                            ?>
                                                                                        </button>

                                                                                    </form>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php
                                                                }


                                                                if ($subsecoes->num_rows != 0) {
                                                                ?>
                                                                    <div class="card">
                                                                        <div class="card-header card-link bg-info" data-toggle="collapse" href="#collapseTree<?= $arquivo['id'] ?>" style="cursor: pointer;">

                                                                            <div class="row">
                                                                                <div class="col-11">

                                                                                    Subseções
                                                                                    
                                                                                </div>
                                                                                <div class="col-1">

                                                                                    <i class="mr-0 fas fa-angle-right"></i>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <div id="collapseTree<?= $arquivo['id'] ?>" class="collapse" data-parent="#accordion<?= $arquivo['id'] ?>">
                                                                            <div class="card-body">
                                                                                <?php while ($subsecao = mysqli_fetch_array($subsecoes)) { ?>

                                                                                    <form action="./editarSubsecao.php" method="post">
                                                                                        <input type="hidden" name="subsecao" value="<?= $subsecao['id'] ?>">
                                                                                        <button class="btn">
                                                                                            <?php
                                                                                            if (strlen($subsecao['titulo']) > 50) {

                                                                                                echo substr($subsecao['titulo'], 0, 50) . '...';
                                                                                            } else {

                                                                                                echo $subsecao['titulo'];
                                                                                            }
                                                                                            ?>
                                                                                        </button>

                                                                                    </form>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                <?php
                                                                }


                                                                ?>
                                                            </div>

                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">



                                                            <button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>

                                                        </div>

                                                    </div>
                                                </div>

                                            </div>

                                            <div class="modal" id="modalDelete<?= $arquivo['id'] ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header ">
                                                            <h4 class="modal-title">Excluir arquivo</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <p style="font-size: 20px;">
                                                                Tem certeza que deseja excluir o arquivo?

                                                            </p>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">

                                                            <form action="../../backend/excluirArquivo.php" method="post">
                                                                <input type="hidden" name="id_arquivo" value="<?= $arquivo['id'] ?>">
                                                                <input type="hidden" name="url_destino" value="../pages/admin/upload.php">
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

                <?php

                if ($quantidade_arquivos > $cont_saltos) {
                ?>
                    <div class="row w-100">

                        <div class="col" style="display:flex; justify-content:center;">

                            <ul class="pagination">

                                <?php

                                $anterior_desativada = '';

                                if ($indice_paginacao == 1) {


                                    $anterior_desativada = 'disabled';
                                }
                                ?>

                                <li class="page-item <?= $anterior_desativada ?>">
                                    <form action="./upload.php" method="post">
                                        <input type="hidden" name="indice_paginacao" value="<?= $indice_paginacao - 1 ?>">
                                        <button class="page-link">Anterior</button>
                                    </form>
                                </li>

                                <?php



                                for ($indice = 1; $indice <= $num_indices; $indice++) {
                                ?>


                                    <?php
                                    $ativo = "";

                                    if ($indice == $indice_paginacao) {
                                        $ativo = "active";
                                    }
                                    ?>
                                    <li class="page-item <?= $ativo ?>">
                                        <form action="./upload.php" method="post">
                                            <input type="hidden" name="indice_paginacao" value="<?= $indice ?>">


                                            <button class="page-link"><?= $indice ?></button>

                                        </form>
                                    </li>

                                <?php
                                }
                                ?>


                                <?php

                                $prox_desativada = '';

                                if ($indice_paginacao == $num_indices) {

                                    $prox_desativada = 'disabled';
                                }
                                ?>

                                <li class="page-item <?= $prox_desativada ?>">

                                    <form action="./upload.php" method="post">
                                        <input type="hidden" name="indice_paginacao" value="<?= $indice_paginacao + 1 ?>">
                                        <button class="page-link">Proximo</button>
                                    </form>
                                </li>
                            </ul>
                        </div>

                    </div>

                <?php
                }
                ?>

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



    <!-- <script src="../../assets/dist/js/scripts-uploads.js"></script> -->


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
<!-- overlayScrollbars -->
<script src="../../assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../assets/dist/js/adminlte.js"></script>


</html>