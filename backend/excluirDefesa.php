<?php

    include "conexao.php";
    include "defesasModel.php";

    $defesaModel = new DefesasModel($cnx);

    $id_defesa = $_POST['id_defesa'];
    $url_destino = $_POST['url_destino'];

    $defesaModel->deleteDefesa($id_defesa);

    header("Location: $url_destino");


?>