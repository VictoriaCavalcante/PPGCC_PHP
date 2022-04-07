<?php

include "conexao.php";
include "SubsecaoModel.php";

$titulo = $_POST['titulo'] . trim(" ");
$ordem = $_POST['ordem'];
$ativada = $_POST['ativada'];
$id_usuario = $_POST['id_usuario'];
$id_secao = $_POST['id_secao'];
$url_destino = $_POST['url_destino'];

$subsecao = new SubsecaoModel($cnx);

$array = $subsecao->setSubsecao($titulo,$ordem,$id_usuario,$id_secao,$ativada);

$url_destino = $url_destino . $array[0];

header("Location: $url_destino");
