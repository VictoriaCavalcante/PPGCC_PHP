<?php

    include "conexao.php";


    $id = $_POST['id'];
    $id_usuario = $_POST['id_usuario'];
    $url = $_POST['url_destino'];
    $conteudo = $_POST['conteudo'];

    $sql = "UPDATE subsecao SET conteudo = '$conteudo', id_usuario = '$id_usuario'  WHERE id= '$id'";

    $res = mysqli_query($cnx,$sql) or die(mysqli_error($cnx));


    header("Location: $url");

?>