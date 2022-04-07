<?php

    include "conexao.php";
    include "defesasModel.php";

    $defesaModel = new DefesasModel($cnx);

    $id_defesa = $_POST['id_defesa'];
    $titulo = $_POST['titulo'];
    $local = $_POST['local'];
    $horario = $_POST['horario'];
    $conteudo = $_POST['conteudo'];
    $id_usuario = $_POST['id_usuario'];
    $url = $_POST['url_destino'];


    $defesaModel->updateDefesa($id_defesa,$titulo,$local, $horario,$conteudo,$id_usuario);

    header("Location: $url");


?>