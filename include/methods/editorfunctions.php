<?php

function returnorder($x){
	$connect = new mysqli('localhost', 'root','','testprojekt');
	$result = mysqli_query($connect, "SELECT * FROM listrelation where listID = '$x' ORDER BY orderinlist DESC LIMIT 1");
	$row = mysqli_fetch_array($result);
	$length=$row['orderinlist'];
	if(!is_numeric($length))
	{
		$length = 0;
	}
	return $length;
}

function fetchlist($x){
	$connect = new mysqli('localhost', 'root','','testprojekt');
	$query = "select * from listrelation where listID = '$x' order by orderinlist asc";//välj inlägg med nyast först
	$check = $connect->query($query);
	return $check;
}


?>