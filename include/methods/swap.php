<?php

$user = "dbtrain_1095";
    $pw = "ldchnm";
    $host = "dbtrain.im.uu.se";
    $db = "dbtrain_1095";
    $connection = new mysqli($host, $user, $pw, $db);
$listid = $_GET['list'];
$movieid1 = $_GET['movie1'];
$movieid2 = $_GET['movie2'];


$query = "select orderinlist from movie_list where movieID = '$movieid1' and listID = '$listid'";
$check = $connection->query($query);
$o1 = $check -> fetch_array();
	
$query2 = "select orderinlist from movie_list where movieID = '$movieid2' and listID = '$listid'";
$check2 = $connection->query($query2);
$o2 = $check2 -> fetch_array();
	
$order1 = $o1['orderinlist'];
$order2 = $o2['orderinlist'];

$q = "update movie_list set orderinlist = 0 where orderinlist = '$order1' and listID = '$listid'";
mysqli_query($connection,$q);
	
$q2 = "update movie_list set orderinlist = '$order1' where orderinlist = '$order2' and listID = '$listid'";
mysqli_query($connection,$q2);
	
$q3 = "update movie_list set orderinlist = '$order2' where orderinlist = 0 and listID = '$listid'";
mysqli_query($connection,$q3);

?>
