<?php

$uname = "dbtrain_1095";
$pass = "ldchnm";
$host = "dbtrain.im.uu.se";
$dbname = "dbtrain_1095";
$connect = new mysqli($host, $uname, $pass, $dbname);


$rating = $_GET['rating'];
$userid = 24;
$movieid = $_GET['movie'];


$check = $connect->prepare("select * from movies2 where userID = '$userid' and movieID = '$movieid'");
$check->execute();
$check->store_result();
$rows = $check->num_rows;
$viewings = 1;
if($rows > 0)
{
	$sql = "update movies2 set rating = '$rating' where userID = '$userid' and movieID = '$movieid'";
	mysqli_query($connect,$sql);
}
else
{
	$state  = $connect->prepare("INSERT INTO movies2(userID,movieID,rating,viewings) VALUES(?,?,?,?)");
	$state->bind_param('ssss',$userid,$movieid,$rating,$viewings);
	$state->execute();
}
?>
