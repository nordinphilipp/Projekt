<!--<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="bootstrap.min.js"></script>
  <link href="css/main.css" rel="stylesheet" type="text/css" />
  </head>-->
  <body>
    <?php
$uname = "dbtrain_1095";
$pass = "ldchnm";
$host = "dbtrain.im.uu.se";
$dbname = "dbtrain_1095";
$connect = new mysqli($host, $uname, $pass, $dbname);

			?>
	
			<div class="row">
			<div class="col-4"><h1 class="titles">Titles</h1></div>
			</div>
			<div class="row" style="padding:10px;">
				<div class="col-12">
					<?php
					$hold = $_GET['title'];
					$title = str_replace(" ", "+",$hold);
					$content = file_get_contents("http://www.omdbapi.com/?s=$title&type=movie&apikey=2c66b43f");
					$arr = json_decode($content);
					if($arr -> Response == "False" )
					{
					?>
						<div class="card">
							<h1 class="card-title">Nothing Found</h1>
						</div>			
					<?php
					}
					else{	
					?>
					<div class="card-deck">
					<?php
					foreach($arr -> Search as $test)
					{
					?>
					<div class="card" style="min-width:200px;max-width:200px;float:left;">
						<?php
						$pos = $test->Poster;
						if($pos == 'N/A'):
						?>
						<img class="card-img-top" src="http://cherrycreek.nebo.edu/sites/cherrycreek.nebo.edu/files/styles/large/public/movie-20clapper-20clipart-movie-film-clip-art-1000_1000.png?itok=OcC2I6Kt" style="min-height:300px;"/>
						<?php
						else:
						?>
						<img class="card-img-top" src="<?php echo $test->Poster?>"style="min-height:300px;"/>
						<?php
						endif;
						?>
						<div class="card-body">
						<p class="card-text"><a href="moviepage.php?id=<?php echo $test -> imdbID?>" class="stretched-link" style="color:black;"> <?php echo $test->Title?></a></p>
						<p class="card-text"><?php echo $test->Year ?></p>	
						</div>
					</div>	
					<?php
					}
					?>
					</div>
				</div>
			</div>
						
						
			<div class="row">
				<div class="col-4"><h1 class="titles">Users</h1></div>
			</div>
			<div class="row" style="padding:10px;">
				<div class="col-12">
				<?php
				
				$result = mysqli_query($connect, "SELECT * FROM users where username like '$hold'");
				while($row = $result->fetch_array())
				{
				?>
					<div class="card-deck">
						<div class="card" style="min-width:200px;max-width:200px;float:left;">
							<img class="card-img-top" src="" alt="Card Image"/>
							<div class="card-body">
								<p class="card-text"><a href="#?id=<?phpecho $name['username'] ?>" class="stretched-link" style="color:black;"><?php echo $name['username'] ?></a></p>	
							</div>
						</div>	
					</div>
					
				<?php
				}
				?>
				</div>
			</div>
			<div class="row">
				<div class="col-4"><h1 class="titles">Lists</h1>
				</div>
			</div>
			
			<div class="row" style="padding:10px;">
				<div class="col-4">
					<div class="card-deck">
					<?php
						$result = mysqli_query($connect, "SELECT * FROM lists where name like '$hold'");
						while($row = $result->fetch_array())
						{?>
						<div class="card" style="min-width:200px;max-width:200px;float:left;">
							<div class="card-body">
								<p class="card-text"><a href="#?id=<?php //linkid ?>" class="stretched-link" style="color:black;"><?php echo $name['name']?></a></p>	
								<p class="card-text">Made By User</p>
								<p class="card-text">Main Genre</p>
							</div>
						</div>	
						<?php
						}
						?>
					</div>
				</div>
			</div>
	<?php					
	}
	?>
  </body>
</html>
