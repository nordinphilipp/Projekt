<?php

    $user = "dbtrain_1095";
    $pw = "ldchnm";
    $host = "dbtrain.im.uu.se";
    $db = "dbtrain_1095";
    $connection = new mysqli($host, $user, $pw, $db);



$rating = $_GET['rating'];
$userid = $_SESSION['userID'];
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
$connection->close();
?>
