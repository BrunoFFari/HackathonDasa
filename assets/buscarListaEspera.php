<?php

    require_once 'conn.php';

    //echo("SELECT p.nome, p.celular FROM lista_espera le INNER JOIN pessoa p ON p.id = le.id_usuario WHERE le.id_agendamento = ". $_POST['agendamento']);

    $select = "SELECT le.id, p.nome, p.celeular FROM lista_espera le INNER JOIN pessoa p ON p.id = le.id_usuario WHERE le.id_agendamento = ". $_POST['agendamento'];

    $exec = mysqli_query($connection, $select);

    $objetoResult = array();

    while($rs = mysqli_fetch_array($exec)){
        array_push($objetoResult, $rs);
    }

    echo json_encode($objetoResult);

?>
