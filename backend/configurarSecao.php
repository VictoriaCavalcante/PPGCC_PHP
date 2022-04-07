<?php

include "conexao.php";
include "SecaoModel.php";

$id_secao = $_POST['id_secao'];
$titulo = $_POST['titulo'] . trim(" ");
$icon = $_POST['icon'];
$ordem_destino = $_POST['ordem'];
$ativada = $_POST['ativada'];
$id_usuario = $_POST['id_usuario'];
$url_destino = $_POST['url_destino'];
$ordem_atual = $_POST['ordem_atual'];

$secaoModel = new SecaoModel($cnx);

if($icon == ''){

    $icon = $secaoModel->getSecao($id_secao)->icon;
    
}




$secaoModel->updateSecao($id_secao,$titulo,$icon,$ordem_destino,$ordem_atual,$ativada,$id_usuario);

header("Location: $url_destino");
