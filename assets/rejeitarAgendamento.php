<?php

    require_once 'conn.php';

    $select = "UPDATE agendamentos SET status_agendamento = 2 WHERE id = ".$_POST['agendamento'];
    $exec = mysqli_query($connection, $select);

    if($exec){
        echo('true');

        $buscaUsuario = "SELECT p.nome FROM agendamentos a INNER JOIN pessoa p ON p.id = a.id_pessoa WHERE a.id = ".$_POST['agendamento'];
        $exec = mysqli_query($connection, $buscaUsuario);
        $pessoa = mysqli_fetch_row($exec)[0];

        $insertNotificacao = "INSERT INTO notificacoes (mensagem) VALUES ('O paciente $pessoa cancelou a consulta. O próximo na lista de espera foi chamado.')";
        $exec = mysqli_query($connection, $insertNotificacao);

        //Procurar na lista de espera
        $select = "SELECT id_usuario, id FROM lista_espera WHERE id_agendamento = ".$_POST['agendamento']." ORDER BY id ASC LIMIT 1";
        $exec = mysqli_query($connection, $select);
        $objetoResult = array();

        while($rs = mysqli_fetch_array($exec)){
            array_push($objetoResult, $rs);
        }

        $id_lista_espera = $objetoResult[0]['id'];
        $id_usuario = $objetoResult[0]['id_usuario'];

        $update = "UPDATE agendamentos SET id_pessoa = $id_usuario, status_agendamento = 0 WHERE id = ".$_POST['agendamento'];
        $exec = mysqli_query($connection, $update);

        if($exec){
            $delete = "DELETE FROM lista_espera WHERE id = ". $id_lista_espera;
            $exec = mysqli_query($connection, $delete);
        }

    }else{
        echo('false');
    }

?>
