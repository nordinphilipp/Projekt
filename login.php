<!DOCTYPE html>
<html lang="en">
    <head>
        <title>MovieMate</title>
        <link rel="stylesheet" href="css/main.css">
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
	<object type="text/html" class='navbarObject' data="navbar.html"></object>
        <div class="articletwo">
            <div class="centrebox">
                <form name"minForm" onsubmit="return ValidateInfo()" method="POST"> <!-- GET istället för post? Redirect eller inte? -->
                    Username/E-mail:
                    <input type="text" name="loginname"><br>
                    Password:
                    <input type="text" name="password"><br>
					<input type="submit" name="send" value="Skicka"/>
                </form>
            </div>
        </div>
			<?php
				$loginname = "";
				$password = "";
				if(isset($_POST["loginname"], $_POST["password"]))
				{
					$loginname = $_POST['loginname'];
					$password = $_POST['password'];
					Add($loginname, $password);
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
			var retur = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;		//Fixa denna så att den enbart kollar .@.
			if(document.form.loginname.value == "") 				// Kollar om "namn" i form är tom  OBS!! Fixa så att en tom sträng inte fungerar för att uppfylla detta villkor!!
			{
				alert("Du har missat att fylla i namn");
				return false;
			} 
			else if(document.form.password.value == "")	// Kollar om "m i form är skrivet i rätt format i form.
			{
				alert("Du har missat att välja ett lösenord");
				return false;
			}
			else
			{
				document.form.submit();
			}
		}
		</script>

		<?php
			while($row = $result->fetch_assoc())  // För att hämta data från SQL-databasen. Kolla rad 96
			{
				echo "<br />Användarnamn: ".$row["userName"]. " Lösenord:".$row["pw"];
				echo "<br />";
			} 
		?>
		<?php
			function VerifyPassword($password, $hash)
			{
				if(password_verify($password, $hash))
				{
					//Lösenordet matchar med hashen som är lagrad i databasen. Användaren loggas in. Vart redirectas?
				}
				else
				{
					//$wrongPassword = "<"// Lösenordet matchade ej. Popup med texten "Fel lösenord eller användarnamn. Försök igen" Skriv i php 
				}
			}
		?>
	</body>
</html>

