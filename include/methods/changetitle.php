<?php
//skulle föreslå att allt som har med databas att göra görs via 'include/methods/db.php' 
//och att anslutningarna till db görs därifrån med 'include/process/connect-process.php'
$list = $_GET['list'];
$title = $_GET['name'];

$sql = "UPDATE movie_list name = '$title' where listID = '$list'";
$ch = $connect->query($sql);

?>