<?php

    include "conexao.php";
    include "SubsecaoModel.php";

    $id = $_POST['id'];
    $id_usuario = $_POST['id_usuario'];
    $url_destino = $_POST['url_destino'];

    $subsecao = new SubsecaoModel($cnx);

    $subsecao->limparConteudo($id, $id_usuario);

    header("Location: $url_destino");

?>