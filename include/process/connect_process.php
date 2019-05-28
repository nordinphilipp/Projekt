<?php
//connect om det finns en aktiv session
if(session_status() === PHP_SESSION_ACTIVE){
    //databasvariabler
    $host = 'localhost';
    $user = 'root';
    $pw = 'password';
    $db = 'moviemate';

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