<?php

    include "conexao.php";
    include "UsuarioModel.php";

    session_start();


    if(isset($_SESSION['usuario'])){

        header("Location: ../pages/admin");

    }

    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $usuarioModel = new UsuarioModel($cnx);


    $user = $usuarioModel->isValid($usuario,$senha);
    
    if($user){

        
        if($user->ativado == 1){
            
            $usuario = ['id'=>$user->id,'usuario'=>$user->usuario,'permissao'=>$user->permissao,'ativado'=>$user->ativado];
    
            $_SESSION['usuario'] = $usuario;
    
            header("Location: ../pages/admin");

        }else{

            header('Location: ../pages/user/login.php?erro=2');

        }

    }else{


        header('Location: ../pages/user/login.php?erro=1');

    }      

?>