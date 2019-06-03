<?php
    include('include/bootstrap.php');
	include('include/process/connect_process.php');
    $listID = $_GET['listid'];
	$list = "SELECT * from lists where listID='$listID'";
	$listresult = $connection ->query($list);
	$res = $listresult -> fetch_array();
	$userID = $res['userID'];
	
	/* Fixa felmeddelande ifall användaren ej har behörighet att ändra lista, istället för echo */
		if(!empty($_SESSION['logged_in']))
		{
			if($_SESSION['userID'] == 27)
				{
					$sql = "DELETE FROM lists WHERE listID='$listID'";
					mysqli_query($connection, $sql);
					header("Location: list.php?listID=$listid");
				}
			else if($_SESSION['userID'] == $userID)
				{
					$sql = "DELETE FROM lists WHERE listID='$listID'";
					mysqli_query($connection, $sql);
					header("Location: list.php?listID=$listid");
				}
			else
			{
				echo "Du har ej behörighet för att ändra/ta bort denna lista.";		// Byt design
			}
		}
		else
		{
			echo "Du har ej behörighet för att ändra/ta bort denna lista.";
		}
?> 
