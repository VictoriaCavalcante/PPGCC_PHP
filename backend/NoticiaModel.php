<?php

class NoticiaModel
{

    private $conexao;

    function __construct($conexao)
    {

        $this->conexao = $conexao;
    }

    // Busca e retorna todas seções
    function getNoticiaAll(): mysqli_result
    {

        $sql = "SELECT * FROM noticia ORDER BY id DESC";

        $res = mysqli_query($this->conexao, $sql) or die(mysqli_error($this->conexao));

        return $res;
    }


    // Busca uma seção pelo id e retorna um objeto contendo seus dados
    function getNoticia($id)
    {

        $sql = "SELECT * FROM noticia WHERE id= '$id'";

        $res = mysqli_query($this->conexao, $sql) or die(mysqli_error($this->conexao));

        $obj = mysqli_fetch_object($res);

        return $obj;
    }

    function getNoticiaUsuario($id_usuario)
    {

        $sql = "SELECT * FROM noticia WHERE id_usuario = '$id_usuario' ORDER BY id DESC";

        $res = mysqli_query($this->conexao, $sql) or die(mysqli_error($this->conexao));

        return $res;
    }


    public function buscaConteudo($texto)
    {

        $sql = "SELECT * FROM noticia WHERE conteudo like '%$texto%' OR img like '%$texto%'";

        $res = mysqli_query($this->conexao, $sql) or die(mysqli_error($this->conexao));

        return $res;
    }


    function salvarNoticia($titulo, $previa, $conteudo, $img, $id_usuario)
    {

        $sql = "INSERT INTO noticia (titulo, previa, conteudo, img, id_usuario) values (?,?,?,?,?)";


        $stmt = ($this->conexao)->prepare($sql);

        $stmt->bind_param("ssssi", $titulo, $previa, $conteudo, $img, $id_usuario);


        $stmt->execute();
    }


    function updateNoticia($id_noticia, $previa, $titulo, $conteudo, $img, $id_usuario)
    {

        $sql = "UPDATE noticia SET titulo = ? ,previa = ?, conteudo = ? , img = ? , id_usuario = ? WHERE id = ?";

        $stmt = ($this->conexao)->prepare($sql);

        $stmt->bind_param("ssssii", $titulo, $previa, $conteudo, $img, $id_usuario, $id_noticia);

        $res = $stmt->execute();
        return $res;
    }

    function deleteNoticia($id)
    {

        $sql_exclusao_secao = "DELETE FROM noticia WHERE id = '$id'";

        mysqli_query($this->conexao, $sql_exclusao_secao) or die(mysqli_error($this->conexao));
    }
}
