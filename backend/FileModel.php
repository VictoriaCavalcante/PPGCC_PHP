<?php



class FileModel
{

    private $file;
    private $tam_max = 1024 * 1024 * 100;
    private $tipos = ['pdf', 'doc', 'docx', 'png', 'jpeg', "jpg"];
    private $tipos_img = ['png', 'jpeg', "jpg"];
    private $pasta = '../assets/uploads/';


    public function deleteAll($cnx)
    {

        $sql_busca = "SELECT * FROM arquivo;";

        $arquivos = mysqli_query($cnx, $sql_busca) or die(mysqli_error($cnx));

        while ($arquivo = mysqli_fetch_array($arquivos)) {



            $this->deletaArquivo($arquivo['id'], $cnx);
        }
    }

    public function errorUpload($file)
    {

        if ($file['error'] != 0) {

            return false;
        }

        return true;
    }

    public function verificaTamanho($file)
    {

        if ($file['size'] > $this->tam_max) {

            return false;
        }

        return true;
    }


    public function verificaTipo($file)
    {


        $aux = explode('.', $file['name']);
        $tipo_arquivo = end($aux);


        for ($i = 0; $i <= count($this->tipos); $i++) {


            if (strtoupper($this->tipos[$i]) == strtoupper($tipo_arquivo)) {

                return true;
            }
        }

        return false;
    }

    public function verificaTipoImg($file)
    {


        $aux = explode('.', $file['name']);
        $tipo_arquivo = $aux[count($aux) - 1];

        // echo $tipo_arquivo;

        for ($i = 0; $i < count($this->tipos_img); $i++) {


            if (strtoupper($this->tipos_img[$i]) == strtoupper($tipo_arquivo)) {

                return true;
            }
        }

        return false;
    }


    public function salvaArquivo($id_usuario, $cnx, $file)
    {


        $aux = explode('.', $file['name']);
        $tipo = end($aux);
        $nome = $file['name'] . md5(date("Y-m-d H:i:s")) . '.' . $tipo;
        $caminho = $this->pasta . $nome;

        $movido = move_uploaded_file($file['tmp_name'], $caminho);

        if ($movido) {

            $caminho = "../$caminho";

            $sql = "INSERT INTO arquivo (nome, tipo, caminho, id_usuario) VALUES (
                                             ?, ?, ?, ?
                                            )";

            $stmt = ($cnx)->prepare($sql);

            $stmt->bind_param("sssi", $nome, $tipo, $caminho, $id_usuario);


            $stmt->execute();


            return $caminho;
        }

        return '';
    }

    public function deletaArquivo($id_arquivo, $cnx)
    {

        $sql_busca = "SELECT * FROM arquivo WHERE id= '$id_arquivo'";

        $arquivo = mysqli_query($cnx, $sql_busca) or die(mysqli_error($cnx));
        $obj = mysqli_fetch_object($arquivo);

        $caminho = substr($obj->caminho, 3);

        unlink($caminho);


        $sql_deleta = "DELETE FROM arquivo WHERE id= '$id_arquivo'";

        return  mysqli_query($cnx, $sql_deleta) or die(mysqli_error($cnx));
    }

    public function listaArquivosData($cnx, $id_usuario)
    {

        $sql = "SELECT * FROM usuario WHERE id = '$id_usuario'";

        $res = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));

        $obj = mysqli_fetch_object($res);

        if ($obj->permissao == 1) {

            $sql = "SELECT * FROM arquivo INNER JOIN usuario ON arquivo.id_usuario = usuario.id WHERE  usuario.id = '$id_usuario' ORDER BY arquivo.id DESC";
        } else {

            $sql = "SELECT * FROM arquivo INNER JOIN usuario ON arquivo.id_usuario = usuario.id ORDER BY arquivo.id DESC";
        }


        $res = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));

        return mysqli_fetch_all($res);
    }


    public function listaArquivos($cnx, $id_usuario)
    {

        $sql = "SELECT * FROM usuario WHERE id = '$id_usuario'";

        $res = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));

        $usuario = mysqli_fetch_object($res);

        if ($usuario->permissao == 2) {

            $sql = "SELECT * FROM arquivo";
        } else {

            $sql = "SELECT * FROM arquivo WHERE id_usuario = '$id_usuario'";
        }

        $res = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));

        return $res;
    }


    public function listaArquivosNome($cnx, $inicio, $fim)
    {

        $sql = "SELECT arquivo.id, arquivo.tipo,arquivo.nome,arquivo.caminho, arquivo.data_criacao, arquivo.id_usuario FROM arquivo INNER JOIN usuario ON arquivo.id_usuario = usuario.id ORDER BY arquivo.data_criacao DESC LIMIT $inicio,$fim";

        $res = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));

        return $res;
    }

    public function listaArquivosApi($cnx, $id_usuario, $permissao)
    {


        if ($permissao == 2) {

            $sql = "SELECT * FROM arquivo";
        } else {

            $sql = "SELECT * FROM arquivo WHERE id_usuario = '$id_usuario'";
        }

        $res = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));


        return $res;
    }

    public function buscar($cnx, $texto_busca, $inicio, $fim)
    {

        $sql = "SELECT arquivo.id, arquivo.tipo,arquivo.nome,arquivo.caminho, arquivo.data_criacao, arquivo.id_usuario FROM arquivo INNER JOIN usuario ON arquivo.id_usuario = usuario.id WHERE arquivo.id LIKE '%$texto_busca%' OR arquivo.tipo LIKE '%$texto_busca%' OR arquivo.nome LIKE '%$texto_busca%' OR arquivo.caminho LIKE '%$texto_busca%' OR arquivo.data_criacao LIKE '%$texto_busca%' OR usuario.usuario LIKE '%$texto_busca%' ORDER BY arquivo.data_criacao DESC LIMIT $inicio,$fim";

        $res = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));

        return  $res;
    }
    public function numArquivos($cnx, $id_usuario, $status)
    {

        if ($status == 2) {

            $sql = "SELECT * FROM arquivo";
        } else {

            $sql = "SELECT * FROM arquivo WHERE id_usuario = '$id_usuario'";
        }
        $res = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));

        $cont = $res->num_rows;

        return $cont;
    }

    public function numArquivosBusca($cnx, $id_usuario, $status, $texto_busca)
    {

        if ($status == 2) {

            $sql = "SELECT arquivo.id, arquivo.tipo,arquivo.nome,arquivo.caminho, arquivo.data_criacao, arquivo.id_usuario FROM arquivo INNER JOIN usuario ON arquivo.id_usuario = usuario.id WHERE arquivo.id LIKE '%$texto_busca%' OR arquivo.tipo LIKE '%$texto_busca%' OR arquivo.nome LIKE '%$texto_busca%' OR arquivo.caminho LIKE '%$texto_busca%' OR arquivo.data_criacao LIKE '%$texto_busca%' OR usuario.usuario LIKE '%$texto_busca%' ORDER BY arquivo.data_criacao DESC";
        } else {

            $sql = "SELECT arquivo.id, arquivo.tipo,arquivo.nome,arquivo.caminho, arquivo.data_criacao, arquivo.id_usuario FROM arquivo INNER JOIN usuario ON arquivo.id_usuario = '$id_usuario' WHERE arquivo.id LIKE '%$texto_busca%' OR arquivo.tipo LIKE '%$texto_busca%' OR arquivo.nome LIKE '%$texto_busca%' OR arquivo.caminho LIKE '%$texto_busca%' OR arquivo.data_criacao LIKE '%$texto_busca%' OR usuario.usuario LIKE '%$texto_busca%' ORDER BY arquivo.data_criacao DESC";
        }

        $res = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));

        return  $res->num_rows;
    }

    public function listaArquivoImg($cnx, $id_usuario, $status)
    {

        if ($status == 2) {


            $sql = "SELECT * FROM arquivo WHERE ";


            for ($i = 0; $i < count($this->tipos_img); $i++) {

                $sql .= "tipo = '" . $this->tipos_img[$i] . "'";

                if ($i < (count($this->tipos_img) - 1)) {


                    $sql .= " or ";
                }
            }

            $sql .= " ORDER BY nome";
        }else{

            $sql = "SELECT * FROM arquivo WHERE id_usuario = '$id_usuario' AND (";


            for ($i = 0; $i < count($this->tipos_img); $i++) {

                $sql .= "tipo = '" . $this->tipos_img[$i] . "'";

                if ($i < (count($this->tipos_img) - 1)) {


                    $sql .= " or ";
                }
            }

            $sql .= ") ORDER BY nome";
        }

        $res = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));

        return $res;
    }

    public function filtrarPor($cnx, $tipo, $valor)
    {


        $sql = "SELECT * FROM arquivo INNER JOIN usuario ON arquivo.id_usuario = usuario.id WHERE $tipo LIKE '%$valor%' ORDER BY $tipo ASC";

        $res = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));

        // $res = mysqli_fetch_al($res);

        return $res;
    }

    public function getArquivo($id, $cnx)
    {

        $sql = "SELECT * FROM arquivo WHERE id = '$id'";

        $res = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));

        $res = mysqli_fetch_object($res);
        return $res;
    }
}
