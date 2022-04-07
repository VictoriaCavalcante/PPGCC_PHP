<?php

class SecaoModel
{

    private $conexao;

    function __construct($conexao)
    {

        $this->conexao = $conexao;
    }

    // Busca e retorna todas seções
    function getSecaoAll(): mysqli_result
    {

        $sql = "SELECT * FROM secao ORDER BY ordem ASC";

        $res = mysqli_query($this->conexao, $sql) or die(mysqli_error($this->conexao));

        return $res;
    }

    // busca todas as seções ativas
    function getSecaoAllIsAtivada():mysqli_result{

        $sql = "SELECT * FROM secao WHERE ativada = '1' ORDER BY ordem ASC";

        $res = mysqli_query($this->conexao,$sql) or die(mysqli_error($this->conexao));

        return $res;
    }
    // Busca uma seção pelo id e retorna um objeto contendo seus dados
    function getSecao($id)
    {

        $sql = "SELECT * FROM secao WHERE id= '$id'";

        $res = mysqli_query($this->conexao, $sql) or die(mysqli_error($this->conexao));

        $obj = mysqli_fetch_object($res);

        return $obj;
    }


    function setSecao($titulo, $icon, $ordem, $ativada, $id_usuario)
    {


        $fullSecao = $this->getSecaoAll();

        while ($secao = mysqli_fetch_array($fullSecao)) {

            if ($secao['ordem'] >= $ordem) {

                $nova_posicao = $secao['ordem'] + 1;
                $id_secao = $secao['id'];
                $sql_atualizacao_ordem = "UPDATE secao SET ordem = '$nova_posicao' WHERE id= '$id_secao'";

                $resultado = mysqli_query($this->conexao, $sql_atualizacao_ordem) or die(mysqli_error($this->conexao));
            }
        }


        $sql = "INSERT INTO secao (titulo, icon, ordem, ativada, id_usuario,data_criacao) values ('$titulo','$icon','$ordem','$ativada','$id_usuario',now())";

        return mysqli_query($this->conexao, $sql) or die(mysqli_error($this->conexao));
    }


    function updateSecao($id_secao, $titulo, $icon, $ordem_destino, $ordem_atual, $ativada, $id_usuario)
    {



        $res1 = $this->getSecaoAll();

        $lista_aux = [];

        foreach (mysqli_fetch_all($res1) as $secao) {


            $lista_aux["$secao[0]"] = $secao[3];
        }



        foreach ($lista_aux as $id => $ordem) {

            if ($ordem_destino > $ordem_atual) {

                if ($lista_aux[$id] == $ordem_atual) {

                    $lista_aux[$id] = $ordem_destino;
                } else {

                    if ($lista_aux[$id] == $ordem_destino) {

                        $lista_aux[$id] = $lista_aux[$id] - 1;
                        break;
                    }
                    if ($lista_aux[$id] > $ordem_atual)
                        $lista_aux[$id] = $lista_aux[$id] - 1;
                }
            } else if ($ordem_destino < $ordem_atual) {

                if ($lista_aux[$id] == $ordem_atual) {

                    $lista_aux[$id] = $ordem_destino;
                    break;
                }

                if ($lista_aux[$id] >= $ordem_destino) {

                    $lista_aux[$id] =  $lista_aux[$id] + 1;
                }
            }
        }



        foreach ($lista_aux as $id => $ordem) {

            $sql = "UPDATE secao set ordem = $ordem WHERE id = $id";

            mysqli_query($this->conexao, $sql);
        }


        $sql = "UPDATE secao set titulo = '$titulo', icon = '$icon', ativada='$ativada', id_usuario='$id_usuario' WHERE id = '$id_secao'";


        return mysqli_query($this->conexao, $sql) or die(mysqli_error($this->conexao));
    }

    function deleteSecao($id,$ordem)
    {

        

        $sql_exclusao_associados = "DELETE FROM subsecao WHERE 	id_secao = '$id'";

        $res = mysqli_query($this->conexao, $sql_exclusao_associados) or die(mysqli_error($this->conexao));

      
        $res = $this->getSecaoAll();

        while ($secao = mysqli_fetch_array($res)) {

            if ($secao['ordem'] > $ordem) {

                $nova_posicao = $secao['ordem'] - 1;
                $id_secao = $secao['id'];
                $sql_atualizacao_ordem = "UPDATE secao SET ordem = '$nova_posicao' WHERE id= '$id_secao'";

                $resultado = mysqli_query($this->conexao, $sql_atualizacao_ordem) or die(mysqli_error($this->conexao));
            }
        }

        $sql_exclusao_secao = "DELETE FROM secao WHERE id = '$id'";

        mysqli_query($this->conexao, $sql_exclusao_secao) or die(mysqli_error($this->conexao));
    }

    function getSecaoId_usuario($id_usuario){

        $sql = "SELECT permissao FROM usuario WHERE id = '$id_usuario'";

        $res = mysqli_query($this->conexao, $sql) or die(mysqli_error($this->conexao));

        $usuario_permisao = mysqli_fetch_object($res);


        if($usuario_permisao->permissao == 1){

            $sql = "SELECT * FROM secao INNER JOIN usuario_secao ON secao.id = usuario_secao.id_secao AND usuario_secao.id_usuario = '$id_usuario' ORDER BY secao.ordem ASC";

        }else{


            $sql = "SELECT * FROM secao ORDER BY ordem ASC";
            
        }
        


        $res = mysqli_query($this->conexao, $sql) or die(mysqli_error($this->conexao));

        return $res;

    }

}
