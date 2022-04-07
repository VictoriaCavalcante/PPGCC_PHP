<?php


include "conexao.php";
include "FileModel.php";
include "defesasModel.php";
include "NoticiaModel.php";
include "SubsecaoModel.php";


$url_destino = $_POST["url"];
$id_usuario = $_POST['id_usuario'];


$fileModel = new FileModel();
$arquivos = $fileModel->listaArquivos($cnx, $id_usuario);


$noticiaModel = new NoticiaModel($cnx);
$defesasModel = new DefesasModel($cnx);
$subsecaoModel = new SubsecaoModel($cnx);

$erro = false;
while ($arquivo = mysqli_fetch_array($arquivos)) {

    $nomeArquivo = $arquivo['nome'];
    $id_arquivo = $arquivo['id'];
    // Verifica se um arquivo foi referencia no conteudo de uma seção
    if ($subsecaoModel->buscaConteudo($nomeArquivo)->num_rows == 0) {


        // Verifica se um arquivo foi referenciado no conteudo da defesa
        if ($defesasModel->buscaConteudo($nomeArquivo)->num_rows == 0) {


            if ($noticiaModel->buscaConteudo($nomeArquivo)->num_rows == 0) {



                $fileModel->deletaArquivo($id_arquivo, $cnx);
            } else {

                $erro = true;
            }
        } else {

            $erro = true;
        }
    } else {

        $erro = true;
    }
}


if(!$erro){

    header("Location: $url_destino");
    die();
}



header("Location: $url_destino?erro=6");
