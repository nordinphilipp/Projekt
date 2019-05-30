<?php

$uname = "dbtrain_1095";
$pass = "ldchnm";
$host = "dbtrain.im.uu.se";
$dbname = "dbtrain_1095";
$connect = new mysqli($host, $uname, $pass, $dbname);
$rating = $_GET['rating'];
$listid = $_GET['list'];
$userid = 1;
$movieid = $_GET['movie'];
$sql = "update movies set rating = '$rating' where listID = '$listid' and movieID = '$movieid'";
mysqli_query($connect,$sql);

?>
