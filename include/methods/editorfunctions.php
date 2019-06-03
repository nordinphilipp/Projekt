<?php
include('include/process/connect_process.php');

function gettitle($listid){

$query = "select name from lists where listID = '$listid'";
$check = $connection->query($query);
$res = $check -> fetch_array();
$connection->close();
return $res['name'];
}

function getusername($userid){

$query = "select username from users where userID = '$userid'";
$check = $connection->query($query);
$res = $check -> fetch_array();
$connection->close();
return $res['username'];

}

function setrating($id){

$query2 = "SELECT rating FROM movies2 WHERE movieID = '$id'";
$check2 = $connection->query($query2);
	if ($check2 ->num_rows === 0){
$connection->close();
		return "0";
	}
	else
	{
		while($rowtwo = $check2->fetch_assoc())
		{
		$connection->close();
			return $rowtwo['rating'];
		}
	}
}

function orderinlist($id){

	$result = mysqli_query($connection, "SELECT * FROM movie_list where movieID = '$id'");
	$row = mysqli_fetch_array($result);
	$connection->close();
	return $row['orderinlist'];

}


function returnorder($x){
	$result = mysqli_query($connection, "SELECT * FROM movie_list where listID = '$x' ORDER BY orderinlist DESC LIMIT 1");
	$row = mysqli_fetch_array($result);
	$length=$row['orderinlist'];
	if(!is_numeric($length))
	{
		$length = 0;
	}
	$connection->close();
	return $length;
}

function fetchlist($x){

	$query = "select * from movie_list where listID = '$x' order by orderinlist asc";
	$check = $connection->query($query);
	$connection->close();
	return $check;
}
?>
