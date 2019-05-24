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

				$uname = "dbtrain_951";
				$pass = "pqwkjl";
				$host = "dbtrain.im.uu.se";
				$dbname = "dbtrain_951";
				$connection = new mysqli($host, $uname, $pass, $dbname);

				if($connection->connect_error)
					{
						die("Connection failed: ".$connection.connect_error);
					}
				
				$query = "SELECT * FROM users";
				$result = $connection->query($query); 
			?>
		<script>
		function ValidateInfo()
		{
			//var retur = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;		//Fixa denna så att den enbart kollar .@.
			if(document.minForm.loginname.value == "") 				// Kollar om "användarnamn" i form är tom  OBS!! Fixa så att en tom sträng inte fungerar för att uppfylla detta villkor!!
			{
				alert("Du har missat att fylla i namn");
				return false;
			} 
			else if("/.+@.+\..+/".test(document.minForm.email.value == false))	// Ska det vara enbart form.email.value == false och inte document. före?
			{
				alert("Mailadressen: Felaktigt format");
				return false;
			}
			else if(".{6,}/".test(document.minForm.password.value))	// Kollar så att det valda lösenordet innehåller minst 6 tecken. 
			{
				alert("Du har missat att välja ett lösenord");
				return false;
			}
			else if(!document.minForm.repeatPassword.value === document.minForm.password.value)	// Kollar upp om båda fälten för lösenorden är lika.
			{
				alert("Lösenorden i fälten stämmer inte överens. Testa igen!");
				return false;
			}
			else
			{
				document.minForm.submit();
			}
		}
		</script>
<?php
	function Add($loginname, $email, $password)
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
		
		$loginname = mysqli_real_escape_string($connection, $_POST['loginname']);
		$email = mysqli_real_escape_string($connection, $_POST['email']);
		$password = mysqli_real_escape_string($connection, $_POST['password']);
		$hashedPw = password_hash($password, PASSWORD_DEFAULT);
		$sql = "INSERT INTO users(userName, email, pw) VALUES ('$loginname', '$email', '$hashedPw')";
		if(mysqli_query($connection, $sql))
		{
			$_SESSION['logged_in'] = true;
			$_SESSION['loginname'] = $loginname;
			header('location: index.php');
		}
		else
		{
			echo "Insertion error";
		} 
	}
?>
<?php
 include 'navbar.php';
 ?>
	</body>
</html>
