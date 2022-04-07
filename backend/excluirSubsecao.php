<?php

    include "conexao.php";

    $id = $_POST['id'];
    $url = $_POST['url_destino'];
    $ordem = $_POST['ordem'];
    $id_secao = $_POST['id_secao'];


    $sql_ordenar = "SELECT * FROM subsecao WHERE id_secao = '$id_secao' ORDER BY ordem ASC";

    $res = mysqli_query($cnx,$sql_ordenar) or die(mysqli_error($cnx));

    while($secao = mysqli_fetch_array($res)){

        if ($secao['ordem'] > $ordem) {

            $nova_posicao = $secao['ordem'] - 1;
            $id_subsecao = $secao['id'];
            $sql_atualizacao_ordem = "UPDATE subsecao SET ordem = '$nova_posicao' WHERE id= '$id_subsecao'";
    
            $resultado = mysqli_query($cnx, $sql_atualizacao_ordem) or die(mysqli_error($cnx));
        }

    }

    $sql_exclusao_secao = "DELETE FROM subsecao WHERE id = '$id'";
    
    mysqli_query($cnx,$sql_exclusao_secao) or die(mysqli_error($cnx));

    header("Location: $url");
?>