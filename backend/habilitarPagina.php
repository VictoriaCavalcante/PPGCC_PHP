<?php


    include "./conexao.php";
    include "./SubsecaoModel.php";


    $subsecaoModel = new SubsecaoModel($cnx);

    $id = $_POST['id'];


    $subsecaoModel->setVisibilidade($id);

