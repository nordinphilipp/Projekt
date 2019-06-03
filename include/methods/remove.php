<?php

$user = "dbtrain_1095";
    $pw = "ldchnm";
    $host = "dbtrain.im.uu.se";
    $db = "dbtrain_1095";
    $connection = new mysqli($host, $user, $pw, $db);

$listid = $_GET['list'];
$movieid = $_GET['movie'];
mysqli_query($connection, "delete from movie_list where movieID = '$movieid' and listID = '$listid'");

?>
