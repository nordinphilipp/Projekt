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
                <div class="row-title">MovieMate Login</div>
                <form name"minForm" onsubmit="return ValidateInfo()" method="POST">
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Email/Username:</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="staticEmail" name="email" placeholder="user@mail.com">
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
                        <div class="col-sm-8">
                            Forgot password?<br>Register
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn red lighten-1" name="send" value="Skicka"/>Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <!-- Footer -->
        <div class="col-12 red darken-3" style="height: 3vh"></div>
			<?php
				$loginname = "";
				$password = "";
				$email = "";
				if(isset($_POST["email"], $_POST["password"]))
				{
					$email = $_POST['email'];
					$password = $_POST['password'];
					checkPassword($email, $password);
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
			if(document.minForm.loginname.value == "") 				// Kollar om "namn" i form är tom  OBS!! Fixa så att en tom sträng inte fungerar för att uppfylla detta villkor!!
			{
				alert("Du har missat att fylla i namn");
				return false;
			} 
			else if(document.minForm.password.value == "")	// Kollar om "m i form är skrivet i rätt format i form.
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
	session_start();
	function checkPassword($email, $password)
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
		
		$email = mysqli_real_escape_string($connection, $_POST['email']);
		$password = mysqli_real_escape_string($connection, $_POST['password']);
<<<<<<< HEAD
		$sql = "SELECT password FROM users WHERE email='$email'";
=======
		$hash = password_hash($password, PASSWORD_DEFAULT);
		$sql = "SELECT * FROM users WHERE userName='$loginname' AND pw='$hash'";
>>>>>>> f14f7bd1bd15678f86d652df2376958c4f74040e
		$result = $connection->query($sql);
		if($result)
		{
			$_SESSION['logged_in'] = true;
<<<<<<< HEAD
			$_SESSION['loginname'] = $loginname;
=======
			$_SESSION['userName'] = $loginname;
>>>>>>> f14f7bd1bd15678f86d652df2376958c4f74040e
			header("Location: index.php"); //Redirect till index
			
		}
		else
		{
			echo "Wrong password or username";
		} 
	} 
?>
	</body>
</html>

