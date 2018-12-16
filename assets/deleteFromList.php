<?php

    require_once 'conn.php';

    $select = "DELETE FROM lista_espera WHERE id = ". $_POST['id'];

    $exec = mysqli_query($connection, $select);

    if($exec){
        echo('true');
    }else{
        echo('false');
    }

?>
