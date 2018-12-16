<?php

    require_once 'conn.php';

    $nome = $_POST['nome'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $agendamento = $_POST['agendamento'];
    $tempo = $_POST['tempo'];
    
    $select = "INSERT INTO pessoa (nome, celeular, email) VALUES ('$nome', '$tel', '$email')";
    $exec = mysqli_query($connection, $select);

    if($exec){
        
        $select = "SELECT id FROM pessoa ORDER BY id DESC LIMIT 1";
        $exec = mysqli_query($connection, $select);

        $pessoa = mysqli_fetch_row($exec)[0];

        $select = "INSERT INTO lista_espera (id_agendamento, id_usuario, tempo_chegada) VALUES ($agendamento, $pessoa, $tempo)";
        $exec = mysqli_query($connection, $select);

        if($exec){
            echo('true');
        }else{
            echo("INSERT INTO lista_espera (id_agendamento, id_usuario, tempo_chegada) VALUES ($agendamento, $pessoa, $tempo)");
        }

    }else{
        echo('ERROINSERTCLIENTE');
    }

?>
