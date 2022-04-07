<?php

    include "conexao.php";
    include "FileModel.php";
    include "NoticiaModel.php";

    $noticia = new NoticiaModel($cnx);

    $fileModel = new FileModel($cnx);

    $titulo = $_POST['titulo'];
    $conteudo = $_POST['conteudo'];
    $previa = $_POST['previa'];
    $img = $_FILES['img'];
    $id_usuario = $_POST['id_usuario'];
    $url = $_POST['url_destino'];
    $url_error = $_POST['url_destino_error'];
        

    if(mb_strpos($img['name'],"'")){


        header("Location: $url_error?erro=2");
        die();
    }

    if ($fileModel->verificaTipoImg($img)){

        $caminho = $fileModel->salvaArquivo($id_usuario,$cnx,$img);
       
        $noticia->salvarNoticia($titulo,$previa,$conteudo, $caminho, $id_usuario);


    }else{

        header("Location: $url_error?erro=1");
        die();
    }
    header("Location: $url");
    
?>