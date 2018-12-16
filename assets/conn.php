<?php
    $connection = new MySQLi('localhost', 'root', 'bcd127', 'db_dasa');
    if($connection->connect_error){
        //echo "Desconectado! Erro: " . $mysqli_connection->connect_error;
    }else{
        //echo "Conectado!";
    }
?>
