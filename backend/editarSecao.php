<?php

include "conexao.php";

$id_secao = $_POST['id_secao'];
$titulo = $_POST['titulo'] . trim(" ");
$icon = $_POST['icon'];
$ordem = $_POST['ordem'];
$ativada = $_POST['ativada'];
$id_usuario = $_POST['id_usuario'];
$url_destino = $_POST['url_destino'];
$ordem_atual = $_POST['ordem_atual'];

$sql = "SELECT * FROM secao ORDER BY ordem ASC";

$fullSecao = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));

$array = mysqli_fetch_all($fullSecao);

echo "<pre>";
print_r($array);
echo "</pre>";

// header("Location: $url_destino");
