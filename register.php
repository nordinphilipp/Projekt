<!DOCTYPE html>
<html lang="en">
    <head>
        <title>MovieMate</title>
        <link rel="stylesheet" href="css/main.css">
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <header>
            <div class="navbar">
                <a href="#">MovieMate</a>
                <a href="#">Browse</a>
                <a href="#">Search</a>
                <a href="#">Login</a>
            </div>
        </header> 
        <div class="articletwo">
            <div class="centrebox">
                <form name"minForm" onsubmit="return ValidateInfo()" method="POST"> <!-- GET istället för post? Redirect eller inte? -->
                    Username:
                    <input type="text" name="loginname"><br>
                    Email:
                    <input type="text" name="email"><br>
                    Password:
                    <input type="text" name="password"><br>
                    Password:
                    <input type="text" name="repeatPassword"><br>
					<input type="submit" name="send" value="Skicka"/>
                </form>
            </div>
        </div>
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