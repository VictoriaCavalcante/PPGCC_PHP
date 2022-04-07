<?php

    include "FileModel.php";
    include "conexao.php";

    $fileModel = new FileModel($_FILES['arquivo']);

    $id_usuario = $_POST['id_usuario'];
    
    if(!$fileModel->errorUpload($_FILES['arquivo'])){
        
        header("Location: ../pages/admin/upload.php?erro=1");
        die();
        
    }
    
    if(!$fileModel->verificaTamanho($_FILES['arquivo'])){
        
        header("Location: ../pages/admin/upload.php?erro=2");
        die();
    }

    if(!$fileModel->verificaTipo($_FILES['arquivo'])){

        header("Location: ../pages/admin/upload.php?erro=3");
        die();
    }

    if(mb_strpos($_FILES['arquivo']['name'],"'")){

        echo "Entrou aqui";
        header("Location: ../pages/admin/upload.php?erro=5");
        die();
    }

    $estado  = $fileModel->salvaArquivo($id_usuario,$cnx,$_FILES['arquivo']);


    // Verifica se o envio para o servido foi bem sucedido.
    if($estado == ''){

        header("Location: ../pages/admin/upload.php?erro=505");

    }else{
        
        header("Location: ../pages/admin/upload.php?sucesso");

    }
 

?>