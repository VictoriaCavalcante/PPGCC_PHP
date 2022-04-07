<?php

include "conexao.php";
include "FileModel.php";
include "NoticiaModel.php";

$noticia = new NoticiaModel($cnx);

$fileModel = new FileModel($cnx);

$id = $_POST['id'];
$titulo = $_POST['titulo'];
$previa = $_POST['previa'];
$conteudo = $_POST['conteudo'];
$img = $_FILES['img_nova'];
$id_usuario = $_POST['id_usuario'];
$url = $_POST['url_destino'];
$url_error = $_POST['url_destino_error'];
$img_atual = $_POST['img_atual'];

if(mb_strpos($img['name'],"'")){


    header("Location: $url?erro=2");
    die();
}

if($img['name'] == ''){

    $r = $noticia->updateNoticia($id, $previa, $titulo, $conteudo, $img_atual, $id_usuario);
    header("Location: $url?success=1");
    die();

}

if ($fileModel->verificaTipoImg($img)) {


    $caminho = $fileModel->salvaArquivo($id_usuario, $cnx, $img);

    $r = $noticia->updateNoticia($id, $previa, $titulo, $conteudo, $caminho, $id_usuario);

    
} else {

    header("Location: $url?erro=1");
    die();
}


header("Location: $url?success=1");
