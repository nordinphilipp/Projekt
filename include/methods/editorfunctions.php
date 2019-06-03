<?php
//skulle föreslå att allt som har med databas att göra görs via 'include/methods/db.php' 
//och att anslutningarna till db görs därifrån med 'include/process/connect-process.php'
function conn(){
$uname = "dbtrain_1095";
$pass = "ldchnm";
$host = "dbtrain.im.uu.se";
$dbname = "dbtrain_1095";
return new mysqli($host, $uname, $pass, $dbname);


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
	return $length;
}

function fetchlist($x){
	$connect = conn();
	$query = "select * from movie_list where listID = '$x' order by orderinlist asc";//välj inlägg med nyast först
	$check = $connect->query($query);
	return $check;
}
?>
