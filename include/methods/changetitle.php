<?php
$user = "dbtrain_1095";
    $pw = "ldchnm";
    $host = "dbtrain.im.uu.se";
    $db = "dbtrain_1095";
    $connection = new mysqli($host, $user, $pw, $db);

$list = $_GET['list'];
$title = $_GET['name'];

$sql = "UPDATE lists SET name = '$title' WHERE listID = '$list'";
$ch = $connection->query($sql);
echo $ch;
?>
