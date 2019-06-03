<?php

//skulle föreslå att allt som har med databas att göra görs via 'include/methods/db.php' 
//och att anslutningarna till db görs därifrån med 'include/process/connect-process.php'

$uname = "dbtrain_1095";
$pass = "ldchnm";
$host = "dbtrain.im.uu.se";
$dbname = "dbtrain_1095";
$connect = new mysqli($host, $uname, $pass, $dbname);

$listid = $_GET['list'];
$movieid1 = $_GET['movie1'];
$movieid2 = $_GET['movie2'];


$query = "select orderinlist from movie_list where movieID = '$movieid1' and listID = '$listid'";
$check = $connect->query($query);
$o1 = $check -> fetch_array();
	
$query2 = "select orderinlist from movie_list where movieID = '$movieid2' and listID = '$listid'";
$check2 = $connect->query($query2);
$o2 = $check2 -> fetch_array();
	
$order1 = $o1['orderinlist'];
$order2 = $o2['orderinlist'];

$q = "update movie_list set orderinlist = 0 where orderinlist = '$order1' and listID = '$listid'";
mysqli_query($connect,$q);
	
$q2 = "update movie_list set orderinlist = '$order1' where orderinlist = '$order2' and listID = '$listid'";
mysqli_query($connect,$q2);
	
$q3 = "update movie_list set orderinlist = '$order2' where orderinlist = 0 and listID = '$listid'";
mysqli_query($connect,$q3);

?>
