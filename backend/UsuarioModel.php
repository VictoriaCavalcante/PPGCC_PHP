<?php

    class UsuarioModel{

        private $conexao;

        public function __construct($cnx){
            
            $this->conexao = $cnx;

        }

        public function novoUsuario($email, $senha, $permicao, $ativado){

            $sql = "INSERT INTO usuario (usuario, senha, permissao,ativado,data_cadastro) values('$email','$senha','$permicao','$ativado',now())";

            $res = mysqli_query($this->conexao, $sql) or die(mysqli_error($this->conexao));

            return $res;

        }

        public function getUsuarios(): mysqli_result{

            $sql = "SELECT * FROM usuario";

            $res = mysqli_query($this->conexao, $sql) or die(mysqli_error($this->conexao));

            return $res;

        }

        public function getUsuarioId($id){

            $sql = "SELECT * FROM usuario WHERE id= '$id'";

            $res = mysqli_query($this->conexao, $sql) or die(mysqli_error($this->conexao));

            $obj = mysqli_fetch_object($res);

            return $obj;

        }

        public function getUsuarioEmail($email){

            $sql = "SELECT * FROM usuario WHERE usuario like '%$email%'";

            $res = mysqli_query($this->conexao, $sql) or die(mysqli_error($this->conexao));

            $obj = mysqli_fetch_object($res);

            return $obj;

        }

        public function deletarUsuario($id){

            $sql = "DELETE FROM usuario WHERE id = '$id'";

            mysqli_query($this->conexao, $sql) or die(mysqli_error($this->conexao));

        }

        public function isValid($usuario,$senha){


            $sql = "SELECT * FROM usuario WHERE usuario='$usuario' AND senha = '$senha'";

            $res = mysqli_query($this->conexao,$sql) or die(mysqli_error($this->conexao));

            $obj = mysqli_fetch_object($res);

            return $obj;

        }



        public function editarUsuario($id_usuario,$usuario ,$permissao,$ativado,$senha){
    
            $sql = "UPDATE usuario SET usuario = ? ,senha = ?, permissao = ?, ativado = ? WHERE id = ?";

            $stmt = ($this->conexao)->prepare($sql);

            $stmt->bind_param("ssiii",$usuario,$senha,$permissao,$ativado,$id_usuario);

            $stmt->execute();
            
        }
    }



?>