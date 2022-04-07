<?php

include "conexao.php";
include "SubsecaoModel.php";

$id_subsecao = $_POST['id_subsecao'];
$titulo = $_POST['titulo'] . trim(" ");
$ordem_destino = $_POST['ordem'];
$ativada = $_POST['ativada'];
$id_usuario = $_POST['id_usuario'];
$ordem_atual = $_POST['ordem_atual'];
$id_secao = $_POST['id_secao'];
$url_destino = $_POST['url_destino'];

$subSecao = new SubsecaoModel($cnx);

$subSecao->updateSubsecao($id_subsecao,$id_secao,$titulo,$ativada,$ordem_atual,$ordem_destino,$id_usuario);

header("Location: $url_destino");
