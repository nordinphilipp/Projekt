<?php

$connect = mysqli_connect('localhost', 'root','','testprojekt');
$rating = $_GET['rating'];
$listid = $_GET['list'];
$userid = 1;
$movieid = $_GET['movie'];
$sql = "update listrelation set rating = '$rating' where listID = '$listid' and movieID = '$movieid'";
mysqli_query($connect,$sql);

?>