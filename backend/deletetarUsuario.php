<?php

    include "conexao.php";
    include "UsuarioModel.php";

    $usuarioModel = new UsuarioModel($cnx);

    $id = $_POST['id'];
    $url = $_POST['url'];

    
    $usuarioModel->deletarUsuario($id);

    header("Location: $url");


?>