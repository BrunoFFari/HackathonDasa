<?php

    require_once 'conn.php';

    $select = "SELECT * FROM notificacoes";

    $exec = mysqli_query($connection, $select);

    $objetoResult = array();

    $cont = 0;

    while($rs = mysqli_fetch_array($exec)){
        array_push($objetoResult, $rs);
    }

    echo json_encode($objetoResult);

?>
