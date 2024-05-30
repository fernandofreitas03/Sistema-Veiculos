<?php

include_once('config.php');
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $cor = $_POST['cor'];
    $ano = $_POST['ano'];
    $valor = $_POST['valor'];
    $statu = $_POST['statu'];

    $sqlInsert = "UPDATE veiculos 
        SET marca='$marca',modelo='$modelo',cor='$cor',ano='$ano',valor='$valor',statu='$statu'
        WHERE id=$id";
    $result = $conexao->query($sqlInsert);
    print_r($result);
}
header('Location: sistema.php');
