<?php


    include "conexao.php";
    include "NoticiaModel.php";

    $id_noticia = $_POST['id_noticia'];
    $url_destino = $_POST['url_destino'];

    echo "$id_noticia";
    $noticiaModel = new NoticiaModel($cnx);


    $noticiaModel->deleteNoticia($id_noticia);

    header("Location: $url_destino");

