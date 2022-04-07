<?php

include "conexao.php";
include "SecaoModel.php";


$titulo = $_POST['titulo'] . trim(" ");
$icon = $_POST['icon'];
$ordem = $_POST['ordem'];
$ativada = $_POST['ativada'];
$id_usuario = $_POST['id_usuario'];
$url_destino = $_POST['url_destino'];

$secaoModel = new SecaoModel($cnx);

$secaoModel->setSecao($titulo,$icon,$ordem,$ativada,$id_usuario);


header("Location: $url_destino");
