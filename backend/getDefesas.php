
<?php

header('Content-Type: application/json;charset=utf-8');

include "conexao.php";
include "defesasModel.php";


$defesaModel = new DefesasModel($cnx);

$res = $defesaModel->getDefesas();

$res = mysqli_fetch_array($res);

echo json_encode($res);

?>