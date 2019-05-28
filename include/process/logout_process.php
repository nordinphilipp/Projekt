<?php
    //förstör sessionen om användare är inloggad
    if(!empty($_SESSION['logged_in'])){
        echo 'loggar ut';
        session_destroy();
    }else{
        echo 'Du är redan utloggad';
    }
    //ladda index.php efter en sekund
    header('refresh: 1; url=index.php ');   
?>