<?php 

    include "conexao.php";
    include "defesasModel.php";

    $defesaModel = new DefesasModel($cnx);

    $titulo = $_POST['titulo'];
    $local = $_POST['local'];
    $horario = $_POST['horario'];
    $conteudo = $_POST['conteudo'];
    $id_usuario = $_POST['id_usuario'];
    $url_destino = $_POST['url_destino'];


    $defesaModel->novaDefesa($titulo,$local,$horario,$conteudo,$id_usuario);


    header("Location: $url_destino");



?>