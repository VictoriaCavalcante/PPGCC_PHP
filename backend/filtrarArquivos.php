<?php

header('Content-Type: application/json');

include "./conexao.php";
include "./FileModel.php";

$fileModel = new FileModel();

$tipo = $_POST['tipo'];
$valor = $_POST['valor'];
$id_usuario = $_POST['id_usuario'];
$res = '';



if($tipo == '' || $valor == ''){
    
    $res = $fileModel->listaArquivosData($cnx,$id_usuario);
    
}else{
    
    $res = $fileModel->filtrarPor($cnx, $tipo,$valor,$id_usuario);

}


echo json_encode($res);