<?php


class SubsecaoModel
{

    private $conexao;

    function __construct($conexao)
    {

        $this->conexao = $conexao;
    }

    function getSubsecaoAll()
    {

        $sql = "SELECT * FROM subsecao ORDER BY ordem ASC";

        $res = mysqli_query($this->conexao, $sql) or die(mysqli_error($this->conexao));

        return $res;
    }

    public function buscaConteudo($texto)
    {

        $sql = "SELECT * FROM subsecao WHERE conteudo like '%$texto%'";

        $res = mysqli_query($this->conexao, $sql) or die(mysqli_error($this->conexao));

        return $res;
    }

    public function getSubsecaoUsuario($id){

        $sql = "SELECT * FROM subsecao WHERE id= '$id'";

        $res = mysqli_query($this->conexao, $sql) or die(mysqli_error($this->conexao));

        return $res;
    }

    function getSubsecao($id)
    {

        $sql = "SELECT * FROM subsecao WHERE id= '$id'";

        $res = mysqli_query($this->conexao, $sql) or die(mysqli_error($this->conexao));


        $obj = mysqli_fetch_object($res);


        return $obj;
    }


    function getSubsecaoAllIsAtivada(): mysqli_result
    {

        $sql = "SELECT * FROM subsecao WHERE ativada = '1' ORDER BY ordem ASC";

        $res = mysqli_query($this->conexao, $sql) or die(mysqli_error($this->conexao));

        return $res;
    }

    function getSubcecaoInSecao($id_secao): mysqli_result
    {


        $sql = "SELECT * FROM subsecao WHERE id_secao = '$id_secao' ORDER BY ordem ASC";

        $res = mysqli_query($this->conexao, $sql) or die(mysqli_error($this->conexao));

        return $res;
    }



    function getSubsecaoInSecaoIsAtivada($id_secao): mysqli_result
    {

        $sql = "SELECT * FROM subsecao WHERE ativada = '1' and id_secao = '$id_secao' ORDER BY ordem ASC";

        $res = mysqli_query($this->conexao, $sql) or die(mysqli_error($this->conexao));

        return $res;
    }


    function setSubsecao($titulo, $ordem, $id_usuario, $id_secao, $ativada)
    {



        $fullSecao = $this->getSubcecaoInSecao($id_secao);

        while ($secao = mysqli_fetch_array($fullSecao)) {

            if ($secao['ordem'] >= $ordem) {

                $nova_posicao = $secao['ordem'] + 1;
                $id_sec = $secao['id'];
                $sql_atualizacao_ordem = "UPDATE subsecao SET ordem = '$nova_posicao' WHERE id= '$id_sec'";

                $resultado = mysqli_query($this->conexao, $sql_atualizacao_ordem) or die(mysqli_error($this->conexao));
            }
        }


        $sql = "INSERT INTO subsecao (id_secao, titulo, ordem, ativada, id_usuario,data_criacao) values ('$id_secao','$titulo','$ordem','$ativada','$id_usuario',now())";

        $resultado = mysqli_query($this->conexao, $sql) or die(mysqli_error($this->conexao));


        $sql = "SELECT * FROM subsecao ORDER BY data_criacao DESC";


        $resultado = mysqli_query($this->conexao, $sql) or die(mysqli_error($this->conexao));

        $array = mysqli_fetch_array($resultado);

        return $array;
    }






    function updateSubsecao($id_subsecao, $id_secao, $titulo, $ativada, $ordem_atual, $ordem_destino, $id_usuario)
    {


        $res1 = $this->getSubcecaoInSecao($id_secao);

        $lista_aux = [];


        foreach (mysqli_fetch_all($res1) as $secao) {


            $lista_aux["$secao[0]"] = $secao[4];
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

            $sql = "UPDATE subsecao set ordem = '$ordem' WHERE id = '$id'";

            mysqli_query($this->conexao, $sql);
        }

        $sql = "UPDATE subsecao set titulo = '$titulo', ativada='$ativada', id_usuario='$id_usuario' WHERE id = '$id_subsecao'";


        return mysqli_query($this->conexao, $sql) or die(mysqli_error($this->conexao));
    }


    function setVisibilidade($id)
    {

        $subsecao =  $this->getSubsecao($id);

        $estadoNovo = !($subsecao->ativada);

        $sql = "UPDATE subsecao set ativada = '$estadoNovo' WHERE id = '$id'";

        return mysqli_query($this->conexao, $sql) or die(mysqli_error($this->conexao));
    }

    function editarConteudo($id, $id_usuario, $conteudo)
    {

        $sql = "UPDATE subsecao SET conteudo = ? , id_usuario = ?  WHERE id= ?";

        $stmt = ($this->conexao)->prepare($sql);

        $stmt->bind_param("sii", $conteudo, $id_usuario, $id);


        $stmt->execute();
    }




    function limparConteudo($id, $id_usuario)
    {

        $this->editarConteudo($id, $id_usuario, '');
    }
}
