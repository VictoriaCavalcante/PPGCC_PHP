<?php


class DefesasModel
{

    private $conexao;


    public function __construct($cnx)
    {
        $this->conexao = $cnx;
    }

    public function novaDefesa($titulo, $local, $horario, $conteudo, $id_usuario)
    {

        $sql = "INSERT INTO defesas (titulo, local, horario,conteudo, usuario_id) value (?, ?, ?, ?, ?)";


        $stmt = ($this->conexao)->prepare($sql);

        $stmt->bind_param("ssssi",$titulo,$local,$horario,$conteudo,$id_usuario);


        $stmt->execute();


    }


    public function getDefesas()
    {

        $sql = "SELECT * FROM defesas ORDER BY horario DESC";

        $res = mysqli_query($this->conexao, $sql) or die(mysqli_error($this->conexao));

        return $res;
    }

    public function buscaConteudo($texto){

        $sql = "SELECT * FROM defesas WHERE conteudo like '%$texto%'";

        $res = mysqli_query($this->conexao, $sql) or die(mysqli_error($this->conexao));

        return $res;
    }

    public function getDefesasUsuario($id_usuario){

        $sql = "SELECT * FROM defesas WHERE usuario_id = '$id_usuario' ORDER BY horario DESC";

        $res = mysqli_query($this->conexao, $sql) or die(mysqli_error($this->conexao));

        return $res;

    }


    function getDefesa($id)
    {

        $sql = "SELECT * FROM defesas WHERE id= '$id'";

        $res = mysqli_query($this->conexao, $sql) or die(mysqli_error($this->conexao));

        $obj = mysqli_fetch_object($res);

        return $obj;
    }

    function updateDefesa($id, $titulo, $local, $horario, $conteudo, $id_usuario)
    {


        $sql = "UPDATE defesas SET  horario= ?, titulo = ?, local= ?, conteudo= ?,usuario_id= ? WHERE id = ?";


        $stmt = ($this->conexao)->prepare($sql);

        $stmt->bind_param("ssssii", $horario, $titulo, $local, $conteudo, $id_usuario, $id);


        $stmt->execute();
    }

    function deleteDefesa($id)
    {

        $sql = "DELETE FROM defesas WHERE id = '$id'";

        mysqli_query($this->conexao, $sql) or die(mysqli_error($this->conexao));
    }
}
