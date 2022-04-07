<?php



include "conexao.php";
include "UsuarioModel.php";
include "UsuarioSecaoModel.php";

$usuarioModel = new UsuarioModel($cnx);
$usuarioSecaoModel = new UsuarioSecaoModel($cnx);

$usuario_id = $_POST['id_usuario'];
$usuario = $_POST['usuario'];
$url_destino = $_POST['url_destino'];
$tipoUsuario = $_POST['tipo_usuario'];
$status = $_POST['status'];
$senha1 = $_POST['senha1'];
$senha2 = $_POST['senha2'];



if (isset($_POST['lista'])) {


    $res = $usuarioSecaoModel->deletarSecoes($usuario_id, $cnx);

    $listaSecoes = $_POST['lista'];

    var_dump($listaSecoes);

    for ($i = 0; $i < count($listaSecoes); $i++) {

        $idSecao = intVal($listaSecoes[$i]);

        $usuarioSecaoModel->relacionar($usuario_id, $idSecao, $cnx);
    }
} else {

    $res = $usuarioSecaoModel->deletarSecoes($usuario_id, $cnx);
}



if ($senha1 == $senha2) {

    $usuarioModel->editarUsuario($usuario_id, $usuario, $tipoUsuario, $status, $senha1);
}

header("Location: $url_destino");
