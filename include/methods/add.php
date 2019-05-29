<?php

$connect = mysqli_connect('localhost', 'root','','testprojekt');
$rating = "N/A";
$listid = $_GET['list'];
$userid = 1;
$movieid = $_GET['movie'];

$result = mysqli_query($connect, "SELECT orderinlist FROM listrelation where listID = '$v' ORDER BY orderinlist DESC LIMIT 1");
		$row = mysqli_fetch_array($result);
		$length=$row['orderinlist'];
		if(!is_numeric($length))
		{
			$length = 0;
		}
		$order = $length + 1;
		$state  = $connect->prepare("INSERT INTO listrelation(listID,movieID,orderinlist) VALUES(?,?,?)");
		$state->bind_param('sss',$listid,$movieis,$order);
		$state->execute();

?>