<?php



include "conexao.php";
include "UsuarioModel.php";
include "UsuarioSecaoModel.php";

$usuarioModel = new UsuarioModel($cnx);
$usuarioSecaoModel = new UsuarioSecaoModel($cnx);

$usuario = $_POST['usuario'];
$url_destino = $_POST['url_destino'];
$url_erro = $_POST['url_erro'];
$tipoUsuario = $_POST['tipo_usuario'];
$status = $_POST['status'];
$senha1 = $_POST['senha1'];
$senha2 = $_POST['senha2'];



if ($senha1 == $senha2) {

    if (!$usuarioModel->getUsuarioEmail($usuario)) {

        if ($usuarioModel->novoUsuario($usuario, $senha1, $tipoUsuario, $status)) {

            $obj = $usuarioModel->isValid($usuario, $senha1);


            if (isset($_POST['lista'])) {

                $listaSecoes = $_POST['lista'];


                for ($i = 0; $i < count($listaSecoes); $i++) {
                    $id_usuario = intVal($obj->id);
                    $idSecao = intVal($listaSecoes[$i]);

                    $usuarioSecaoModel->relacionar($id_usuario, $idSecao, $cnx);
                }
            }
        } else {

            header("Location: $url_destino?erro=2");
            die();
        }
    } else {

        header("Location: $url_destino?erro=1");
        die();
    }
}else{

    header("Location: $url_erro?senha_errada=1");
    die();

}


header("Location: $url_destino?success");
