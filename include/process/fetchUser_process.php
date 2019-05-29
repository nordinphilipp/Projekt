<?php
    if(!empty($_SESSION['logged_in'])){
        include('include/methods/db.php');   
    $user = fetchUser($_SESSION['userID']);
    $username = $user['username'];
    $email = $user['email'];
    $img = $user['img'];
    }
?>