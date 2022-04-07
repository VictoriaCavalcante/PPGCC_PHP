<?php


include "conexao.php";
include "FileModel.php";
include "defesasModel.php";
include "NoticiaModel.php";
include "SubsecaoModel.php";


$id_arquivo = $_POST['id_arquivo'];
$url_destino = $_POST['url_destino'];


$fileModel = new FileModel();
echo $id_arquivo;
$nomeArquivo = $fileModel->getArquivo($id_arquivo,$cnx)->nome;


$noticiaModel = new NoticiaModel($cnx);
$defesasModel = new DefesasModel($cnx);
$subsecaoModel = new SubsecaoModel($cnx);

// Verifica se um arquivo foi referencia no conteudo de uma seção
if($subsecaoModel->buscaConteudo($nomeArquivo)->num_rows == 0){


// Verifica se um arquivo foi referenciado no conteudo da defesa
    if($defesasModel->buscaConteudo($nomeArquivo)->num_rows == 0){

      
        if($noticiaModel->buscaConteudo($nomeArquivo)->num_rows == 0){

        

            $fileModel->deletaArquivo($id_arquivo, $cnx);
            
            header("Location: $url_destino");
            die();
            
        }

    }


}

header("Location: $url_destino?erro=4");



