<?php
/*Redirect till moviepage efter beh�ver fixas.
Redirect efter anv�ndare klickat p� knappen f�r att radera kommentar till delete_comment.php */

    include('include/bootstrap.php');
	$uname = "dbtrain_1095";
	$pass = "ldchnm";
	$host = "dbtrain.im.uu.se";
	$dbname = "dbtrain_1095";
	$connect = new mysqli($host, $uname, $pass, $dbname);
    $commentID = $_GET['id']; // Fixa
	$comment = "SELECT * from comments where commentID='$commentID'";
	$commentresult = $connect ->query($comment);
	$res = $commentresult -> fetch_array();
	$userID = $res['userID'];
	
	/* Fixa felmeddelande ifall anv�ndaren ej har beh�righet att �ndra lista, ist�llet f�r echo */
		if(!empty($_SESSION['logged_in']))
		{
			if($_SESSION['userID'] == 27)
				{
					$sql = "DELETE FROM comments WHERE commentID='$commentID'";
					mysqli_query($connect, $sql);
					//header("Location: moviepage.php?id=$movieID");
				}
			else if($_SESSION['userID'] == $userID)
				{
					$sql = "DELETE FROM comments WHERE commentID='$commentID'";
					mysqli_query($connect, $sql);
					//header("Location: list.php?id=$movieID");
				}
			else
			{
				echo "Du har ej beh�righet f�r att �ndra/ta bort denna lista.";		// Byt design
			}
		}
		else
		{
			echo "Du har ej beh�righet f�r att �ndra/ta bort denna lista.";
		}
?> 