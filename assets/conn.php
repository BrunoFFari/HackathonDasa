<?php
    $connection = new MySQLi('dasahack.cz21qmza9hz3.us-west-2.rds.amazonaws.com', 'root', 'hackdasa', 'db_hack');
    if($connection->connect_error){
        //echo "Desconectado! Erro: " . $mysqli_connection->connect_error;
    }else{
        //echo "Conectado!";
    }
?>
