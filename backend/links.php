<?php
   
header('Content-Type: application/json;charset=utf-8');
include "./isLogado.php";
include "conexao.php";
include "FileModel.php";

$usuario_logado = $_SESSION['usuario'];

$fileModel = new FileModel();

$res = $fileModel->listaArquivosApi($cnx,$usuario_logado['id'],$usuario_logado['permissao']);

$res = mysqli_fetch_all($res);



echo json_encode($res);
