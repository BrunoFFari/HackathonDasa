<?php

    require_once 'conn.php';

    $select = "UPDATE agendamentos SET status_agendamento = 1 WHERE id = ".$_POST['agendamento'];

    $exec = mysqli_query($connection, $select);

    if($exec){
        echo('true');

        $buscaUsuario = "SELECT p.nome FROM agendamentos a INNER JOIN pessoa p ON p.id = a.id_pessoa WHERE a.id = ".$_POST['agendamento'];
        $exec = mysqli_query($connection, $buscaUsuario);
        $pessoa = mysqli_fetch_row($exec)[0];

        $insertNotificacao = "INSERT INTO notificacoes (mensagem) VALUES ('O paciente $pessoa confirmou a consulta.')";
        $exec = mysqli_query($connection, $insertNotificacao);

    }else{
        echo('false');
    }

?>
