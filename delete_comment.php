<?php
    include('include/bootstrap.php');
	include('include/process/connect_process.php');
    $commentID = $_GET['id']; 
	$comment = "SELECT * from comments where commentID='$commentID'";
	$commentresult = $connection ->query($comment);
	$res = $commentresult -> fetch_array();
	$userID = $res['userID'];
	$movieID = $res['movieID'];
	
	/* Fixa felmeddelande ifall användaren ej har behörighet att ändra lista, istället för echo */
		if(!empty($_SESSION['logged_in']))
		{
			if($_SESSION['accessLevel'] == 2)
				{
					$sql = "DELETE FROM comments WHERE commentID='$commentID'";
					mysqli_query($connection, $sql);
					header("Location: moviepage.php?id=$movieID");
				}
			else if($_SESSION['userID'] == $userID)
				{
					$sql = "DELETE FROM comments WHERE commentID='$commentID'";
					mysqli_query($connection, $sql);
					header("Location: moviepage.php?id=$movieID");
				}
			else
			{
				echo '<script> displayAlert("Du har ej behörighet")</script>';			
			}
		}
		else
		{
			echo '<script> displayAlert("Du har ej behörighet")</script>';
			
		}
?> 
