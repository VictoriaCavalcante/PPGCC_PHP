<?php

    include "conexao.php";
    include "SecaoModel.php";

    $id = $_POST['id'];
    $ordem = $_POST['ordem'];
    $url = $_POST['url_destino'];

    $secaoModel = new SecaoModel($cnx);

    $secaoModel->deleteSecao($id,$ordem);
  
    header("Location: $url");
?>