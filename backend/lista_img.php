<?php
   
header('Content-Type: application/json;charset=utf-8');
include "./isLogado.php";
include "conexao.php";
include "FileModel.php";


$usuario_logado = $_SESSION['usuario'];

$tipos_img = ['png', 'jpeg', "jpg"];


$fileModel = new FileModel();

$response = $fileModel->listaArquivoImg($cnx,$usuario_logado['id'], $usuario_logado['permissao']);


$response = mysqli_fetch_all($response);

echo json_encode($response);
