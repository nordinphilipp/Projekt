<?php

$connect = mysqli_connect('localhost', 'root','','testprojekt');
$listid = $_GET['list'];
$userid = 1;
$movieid1 = $_GET['movie1'];
$movieid2 = $_GET['movie2'];


$query = "select orderinlist from listrelation where movieID = '$movieid1' and listID = '$listid'";
$check = $connect->query($query);
$o1 = $check -> fetch_array();
	
$query2 = "select orderinlist from listrelation where movieID = '$movieid2' and listID = '$listid'";
$check2 = $connect->query($query2);
$o2 = $check2 -> fetch_array();
	
$order1 = $o1['orderinlist'];
$order2 = $o2['orderinlist'];

$q = "update listrelation set orderinlist = 0 where orderinlist = '$order1' and listID = '$listid'";
mysqli_query($connect,$q);
	
$q2 = "update listrelation set orderinlist = '$order1' where orderinlist = '$order2' and listID = '$listid'";
mysqli_query($connect,$q2);
	
$q3 = "update listrelation set orderinlist = '$order2' where orderinlist = 0 and listID = '$listid'";
mysqli_query($connect,$q3);

?>