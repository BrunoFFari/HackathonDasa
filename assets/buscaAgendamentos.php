<?php

    require_once 'conn.php';

    $select = "SELECT DATE_FORMAT(a.horario, \"%d/%m/%Y %H:%i\") AS hora, p.nome, a.id, a.status_agendamento FROM agendamentos a INNER JOIN pessoa p ON p.id = a.id_pessoa ORDER BY a.horario";

    $exec = mysqli_query($connection, $select);

    $objetoResult = array();

    $cont = 0;

    while($rs = mysqli_fetch_array($exec)){
        array_push($objetoResult, $rs);
    }

    echo json_encode($objetoResult);

?>
