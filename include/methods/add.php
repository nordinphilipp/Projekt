<?php

//skulle föreslå att allt som har med databas att göra görs via 'include/methods/db.php' 
//och att anslutningarna till db görs därifrån med 'include/process/connect-process.php'
$uname = "dbtrain_1095";
$pass = "ldchnm";
$host = "dbtrain.im.uu.se";
$dbname = "dbtrain_1095";
$connect = new mysqli($host, $uname, $pass, $dbname);

$rating = "3";
$listid = $_GET['list'];
$userid = $_SESSION['userID'];
$movieid = $_GET['movie'];

$result = mysqli_query($connect, "SELECT orderinlist FROM movie_list where listID = '$v' ORDER BY orderinlist DESC LIMIT 1");
		$row = mysqli_fetch_array($result);
		$length=$row['orderinlist'];
		if(!is_numeric($length))
		{
			$length = 0;
		}
		$order = $length + 1;
		$state  = $connect->prepare("INSERT INTO movie_list(listID,movieID,orderinlist) VALUES(?,?,?)");
		$state->bind_param('sss',$listid,$movieis,$order);
		$state->execute();

?>
