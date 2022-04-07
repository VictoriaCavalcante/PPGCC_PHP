<?php


    class UsuarioSecaoModel{

        private $conexao;

        public function __contruct($cnx){

            $this->conexao = $cnx;
          

        }

        public function relacionar($id_usuario, $id_secao,$cnx){


            $sql = "INSERT INTO usuario_secao(id_usuario, id_secao) VALUES('$id_usuario', '$id_secao')";

           
            $res = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));

            return $res;

    
        }

        public function temPermissaoUsuarioSecao($id_usuario, $id_secao,$cnx){

            $sql = "SELECT * FROM usuario_secao WHERE id_usuario = '$id_usuario' AND id_secao = '$id_secao'";


            $res = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));

            $res = mysqli_fetch_object($res);

            if($res){

                return true;
            }

            return false;

        }

        // Busca todas as seções que ele pode acessar

        public function usuarioSecoes($id_usuario,$cnx){

            $sql = "SELECT * FROM usuario_secao WHERE id_usuario = '$id_usuario'";

            $res = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));

            return $res;
        }

        public function deletarSecoes($id_usuario,$cnx){


            $sql = "DELETE FROM usuario_secao WHERE id_usuario = '$id_usuario'";

            $res = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));

            return $res;


        }
    }



?>