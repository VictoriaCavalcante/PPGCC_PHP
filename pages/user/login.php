<?php

include "../../backend/conexao.php";


session_start();

if (isset($_SESSION['usuario'])) {


    header("Location: ../admin");
}


?>

<!doctype html>
<html lang="pt-BR">

<head>
    <title>PPGCC - Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex">
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="../../assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/dist/css/style.css">

</head>

<body class="body-login">


    <div class="area">
        <div class="area-logo">

            <a href="./">
                <i class="fas fa-arrow-left area-btn-voltar" style="color: white"></i>

            </a>

            <img src="../../assets/dist/img/ufac-logo.png" id="img-logo-login" alt="logo da ufac">

        </div>
        <div class="area-login">
            <img src="../../assets/dist/img/logo-user.png" id="img-user" alt="">
            <form action="../../backend/logar.php" method="post" class="formulario-login">

                <div class="col">

                    <label for="">Usuário</label>
                    <span>
                        <input type="text" name="usuario" class="form-control input-usuario" placeholder="Usuário">
                    </span>

                    <label for="">Senha</label>
                    <span>

                        <input type="password" name="senha" class="form-control input-senha" placeholder="Senha">
                    </span>

                    <?php

                    if (isset($_GET['erro'])) {

                        if ($_GET['erro'] == 1) {

                    ?>
                            <div class="alert alert-danger mt-3 alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Erro!</strong> Usuário ou senha inválidos.
                            </div>
                        <?php
                        } else if ($_GET['erro'] == 2) {

                        ?>

                            <div class="alert alert-danger mt-3 alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Erro!</strong> Usuário está desativado, entre em contato com o administrador do sistema.
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-5">
                            Logar
                            <i class="fas fa-sign-in-alt"></i>
                        </button>

                    </div>
                </div>

            </form>
        </div>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>