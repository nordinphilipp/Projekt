<?php

$uname = "dbtrain_1095";
$pass = "ldchnm";
$host = "dbtrain.im.uu.se";
$dbname = "dbtrain_1095";
$connect = new mysqli($host, $uname, $pass, $dbname);

$listid = $_GET['list'];
$movieid = $_GET['movie'];
mysqli_query($connect, "delete from movie_list where movieID = '$movieid' and listID = '$listid'");


?>
