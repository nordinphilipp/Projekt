<?php
    include('include/bootstrap.php');
	$uname = "dbtrain_1095";
	$pass = "ldchnm";
	$host = "dbtrain.im.uu.se";
	$dbname = "dbtrain_1095";
	$connect = new mysqli($host, $uname, $pass, $dbname);
    $listID = $_GET['listid'];
	$list = "SELECT * from lists where listID='$listID'";
	$listresult = $connect ->query($list);
	$res = $listresult -> fetch_array();
	$userID = $res['userID'];
	
	/* Fixa felmeddelande ifall användaren ej har behörighet att ändra lista, istället för echo */
		if(!empty($_SESSION['logged_in']))
		{
			if($_SESSION['userID'] == 27)
				{
					$sql = "DELETE FROM lists WHERE listID='$listID'";
					mysqli_query($connect, $sql);
					header("Location: list.php?listID=$listid");
				}
			else if($_SESSION['userID'] == $userID)
				{
					$sql = "DELETE FROM lists WHERE listID='$listID'";
					mysqli_query($connect, $sql);
					header("Location: list.php?listID=$listid");
				}
			else
			{
				echo "Du har ej behörighet för att ändra/ta bort denna lista.";
			}
		}
		else
		{
			echo "Du har ej behörighet för att ändra/ta bort denna lista.";
		}
?> 
