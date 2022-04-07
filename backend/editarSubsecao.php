
<?php

include "conexao.php";
include "SubsecaoModel.php";

$id = $_POST['id'];
$id_usuario = $_POST['id_usuario'];
$conteudo = $_POST['conteudo'];
$url = $_POST['url_destino'];

$subsecao = new SubsecaoModel($cnx);

$subsecao->editarConteudo($id,$id_usuario,$conteudo);

header("Location: $url");

?>