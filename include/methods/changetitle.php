<?php
include('include/process/connect_process.php');
$list = $_GET['list'];
$title = $_GET['name'];

$sql = "UPDATE lists SET name = '$title' WHERE listID = '$list'";
$ch = $connection->query($sql);

?>
