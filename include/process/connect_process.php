<?php

//använd denna fil för att ansluta till databasen

//connect om det finns en aktiv session
if(session_status() === PHP_SESSION_ACTIVE){
    //databasvariabler
    $user = "dbtrain_1095";
    $pw = "ldchnm";
    $host = "dbtrain.im.uu.se";
    $db = "dbtrain_1095";

    $connection = new mysqli($host, $user, $pw, $db);

    if($connection->connect_error)
        {
            die("Connection failed: ".$connection.connect_error);
        }
            echo "Connection worked.";
}else{
    echo "ERROR: could not establish connection.";
}


?>