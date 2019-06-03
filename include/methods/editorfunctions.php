<?php

function conn(){
$uname = "dbtrain_1095";
$pass = "ldchnm";
$host = "dbtrain.im.uu.se";
$dbname = "dbtrain_1095";
return new mysqli($host, $uname, $pass, $dbname);


}

function gettitle($listid){
$connect = conn();
$query = "select name from lists where listID = '$listid'";
$check = $connect->query($query);
$res = $check -> fetch_array();
	mysqli_close($connect);
return $res['name'];
}

function getusername($userid){
$connect = conn();
$query = "select username from users where userID = '$userid'";
$check = $connect->query($query);
$res = $check -> fetch_array();
	mysqli_close($connect);
return $res['username'];

}

function setrating($id){
$connect = conn();
$query2 = "SELECT rating FROM movies2 WHERE movieID = '$id'";
$check2 = $connect->query($query2);
	if ($check2 ->num_rows === 0){
			mysqli_close($connect);
		return "0";
	}
	else
	{
		while($rowtwo = $check2->fetch_assoc())
		{		mysqli_close($connect);
			return $rowtwo['rating'];
		}
	}
}

function orderinlist($id){
$connect = conn();
	$result = mysqli_query($connect, "SELECT * FROM movie_list where movieID = '$id'");
	$row = mysqli_fetch_array($result);
		mysqli_close($connect);
	return $row['orderinlist'];

}


function returnorder($x){
	$connect = conn();
	$result = mysqli_query($connect, "SELECT * FROM movie_list where listID = '$x' ORDER BY orderinlist DESC LIMIT 1");
	$row = mysqli_fetch_array($result);
	$length=$row['orderinlist'];
	if(!is_numeric($length))
	{
		$length = 0;
	}
		mysqli_close($connect);
	return $length;
}

function fetchlist($x){
	$connect = conn();
	$query = "select * from movie_list where listID = '$x' order by orderinlist asc";
	$check = $connect->query($query);
	mysqli_close($connect);
	return $check;
}
?>
