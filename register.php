<!DOCTYPE html>
<html lang="en">
    <head>
 	<title>MovieMate</title>
        <meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    	<meta http-equiv="x-ua-compatible" content="ie=edge">
    	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    	<link href="css/bootstrap.min.css" rel="stylesheet">
    	<link href="css/mdb.min.css" rel="stylesheet">
    	<link href="css/main.css" rel="stylesheet">
    </head>
    <body>
	     <?php
            include 'navbar.php';
        ?>
        <div class="container-fluid red lighten-1" style="height: 90vh">
            <div class="center-box red darken-4 white-text">
                <div class="row-title">MovieMate Registration</div>
                <form name"minForm" onsubmit="return ValidateInfo()" method="POST">
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Email:</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="staticEmail" name="email" placeholder="user@mail.com">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="userName" class="col-sm-3 col-form-label">Username:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="userName" name="loginname" placeholder="User">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Password:</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="reapeatPassword" name="repeatPassword" placeholder="Repeat password">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-sm-8"></div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn red lighten-1" name="send" value="Skicka"/>Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
	<!-- Footer -->
	<div class="col-12 red darken-3" style="height: 3vh"></div>
			<?php
				$loginname = "";
				$email = "";
				$password = "";
				$repeatPassword = "";
				if(isset($_POST["loginname"], $_POST["email"], $_POST["password"], $_POST["repeatPassword"]))
				{
					$loginname = $_POST['loginname'];
					$email = $_POST['email'];
					$password = $_POST['password'];
					$repeatPassword = $_POST['repeatPassword'];
					Add($loginname, $email, $password);
				}
				/*
				echo $fName;
				echo $mail;
				echo $comment;   För att se om det går att hämta data ur databasen. */
			?>
			<?php
				$uname = "dbtrain_951";
				$pass = "pqwkjl";
				$host = "dbtrain.im.uu.se";
				$dbname = "dbtrain_951";
				$connection = new mysqli($host, $uname, $pass, $dbname);

				if($connection->connect_error)
					{
						die("Connection failed: ".$connection.connect_error);
					}
						echo "Connection worked.";
				
				$query = "SELECT * FROM users";
				$result = $connection->query($query); 
			?>
		<script>
		function ValidateInfo()
		{
			//var retur = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;		//Fixa denna så att den enbart kollar .@.
			if(document.form.loginname.value == "") 				// Kollar om "användarnamn" i form är tom  OBS!! Fixa så att en tom sträng inte fungerar för att uppfylla detta villkor!!
			{
				alert("Du har missat att fylla i namn");
				return false;
			} 
			else if("/.+@.+\..+/".test(document.form.email.value == false))	// Ska det vara enbart form.email.value == false och inte document. före?
			{
				alert("Mailadressen: Felaktigt format");
				return false;
			}
			else if(".{6,}/".test(document.form.password.value))	// Kollar så att det valda lösenordet innehåller minst 6 tecken. 
			{
				alert("Du har missat att välja ett lösenord");
				return false;
			}
			else if(!document.form.repeatPassword.value === document.form.password.value)	// Kollar upp om båda fälten för lösenorden är lika.
			{
				alert("Lösenorden i fälten stämmer inte överens. Testa igen!");
				return false;
			}
			else
			{
				document.form.submit();
			}
		}
		</script>
		<?php
			function Add($loginname, $email, $password)			// Funktion Add (som adderar till databasen i users) behöver fixas så att det ej går att registrera två användare med samma 																// nick och/eller lösenord
			{
				$uname = "dbtrain_951";
				$pass = "pqwkjl";
				$host = "dbtrain.im.uu.se";
				$dbname = "dbtrain_951";
				
				$connection = new mysqli($host, $uname, $pass, $dbname);
					if($connection->connect_error)
					{
						die("Connection failed: ".$connection.connect_error);
					}
						echo "Connection worked.";
					
				$loginname = my_mysqli_real_escape_string($connection, $_POST['loginname']); 
				$email = my_mysqli_real_escape_string($connection, $_POST['email']); 
				$password = mysqli_real_escape_string($connection, $_POST['password']);
				$hash = password_hash($password, PASSWORD_DEFAULT);
				
				$sql = "INSERT INTO users(userName, email, pw) VALUES ('$loginname', 'email', '$hash')"; 
				if(mysqli_query($connection, $sql))		// Detta kan raderas sedan om det fungerar att lägga till i databasen.
				{
					echo "Successful";
					$userID = mysql_insert_id(); // Vad gör denna?
					log_in($userID);
					header("Location: index.php");
				}
				else if(preg_match("/^Duplicate.*email.*/i", mysql_error())) // Denna kollar ifall mysql_error() innehåller något error som säger att det redan finns samma mailadress, duplic
				{
					echo "Error";
				}
			}
		?>
		<?php
			while($row = $result->fetch_assoc())  // För att hämta data från SQL-databasen. Kolla rad 96
			{
				echo "<br />Användarnamn: ".$row["userName"]. " Lösenord:".$row["pw"];
				echo "<br />";
			} 
		?>

	</body>
	// Förslag på förbättringar: Vid något fel vid registrering, försvinner all data som de skrivit in? Spar i så fall all data bortsett från lösenordet när de får skriva in igen.
	// Skriv ut felmeddelanden i php vid minForm istället för javascript. Se videon php form validation på studentportalen för mer info.
</html>
