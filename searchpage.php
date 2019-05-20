<!DOCTYPE html>
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
  </head>
  <body style="background-color:rgb(79, 19, 6);">
    <?php
	include 'navbar.php';
	?>
	<div class="row" >
		<div class="col-12">
			<form action="" method="GET">
				<div class="input-group mb-3">
					<input type="text" class="form-control" name="title" placeholder="Search">
					<div class="input-group-append">
						<input type="submit" class="btn btn-success" name="search" value="Go">
					</div>
				</div>
			</form>	
		</div>
	</div>
			<?php
			if(isset($_GET['search']))
			{
			?>
	
					<div class="row">
					<div class="col-4"><h1 class="titles">Titles</h1></div>
					</div>
					<div class="row" style="padding:10px;">
						<div class="col-12">
							<?php
	
							$hold = $_GET['title'];
							$title = str_replace(" ", "+",$hold);
							$content = file_get_contents("https://www.omdbapi.com/?s=$title&type=movie&apikey=2c66b43f");
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
									<img class="card-img-top" src="<?php echo $test->Poster?>" alt="Card Image" style="min-height:300px;"/>
									<div class="card-body">
										<p class="card-text"><?php echo $test->Title?></p>
										<p class="card-text"><?php echo $test->Year ?></p>
										<form action="moviepage.php" method="GET">
											<input type="hidden" name="id" value="<?php echo $test -> imdbID?>" style="visibility:hidden;">	
											<input type="submit" name="submit" class="btn btn-dark" value="See Movie">
										</form>	
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
						//connect to database
						//get all users where the search is included in their username
						//print them out in cards in a loop
						
						?>
						<div class="card-deck">
								<div class="card" style="min-width:200px;max-width:200px;float:left;">
									<img class="card-img-top" src="" alt="Card Image"/>
									<div class="card-body">
										<p class="card-text">Username</p>
										<form action="#" method="GET">
											<input type="hidden" name="id" value="<?php //userid ?>" style="visibility:hidden;">	
											<input type="submit" name="submit" class="btn btn-success" value="See User" >
										</form>	
									</div>
								</div>	
							</div>
						</div>
						</div>
						
						
						<div class="row">
						<div class="col-4"><h1 class="titles">Lists</h1></div>
						</div>

						<div class="row" style="padding:10px;">
						<div class="col-4">
						<div class="card-deck">
								<div class="card" style="min-width:200px;max-width:200px;float:left;">
									<div class="card-body">
										<p class="card-text">Listname</p>
										<p class="card-text">Made By User</p>
										<p class="card-text">Main Genre</p>
										<form action="#" method="GET">
											<input type="hidden" name="id" value="<?php //userid ?>" style="visibility:hidden;">	
											<input type="submit" name="submit" class="btn btn-success" value="See List" >
										</form>	
									</div>
								</div>	
							</div>
						</div>
						</div>
	<?php
								
							}
							
	
	}
?>
  </body>
</html>

