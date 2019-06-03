<body>
    <?php
include('include/process/connect_process.php');

			?>
	
			<div class="row">
			<div class="col-4"><h1 class="titles">Titles</h1></div>
			</div>
			<div class="row" style="padding:10px;">
				<div class="col-12">
					<?php
					$hold = $_GET['title'];
					$title = str_replace(" ", "+",$hold);
					$content = file_get_contents("http://www.omdbapi.com/?s=$title&apikey=2c66b43f");
					$arr = json_decode($content);
					if($arr -> Response == "False" )
					{
					?>
						<div class="card text-white bg-dark mb-3" style="width:200px;">
							<h4 class="card-title">Nothing Found</h4>
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
					<div class="card text-white bg-dark mb-3" style="min-width:200px;max-width:200px;float:left;">
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
						<p class="card-text"><a href="moviepage.php?id=<?php echo $test -> imdbID?>" class="stretched-link" style="color:white;"> <?php echo $test->Title?></a></p>
						<p class="card-text"><?php echo $test->Year ?></p>	
						</div>
					</div>	
					<?php
					}
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
				
				$result = mysqli_query($connection, "SELECT * FROM users where username like '$hold'");
				while($row = $result->fetch_array())
				{
				?>
					<div class="card-deck">
						<div class="card text-white bg-dark mb-3" style="min-width:200px;max-width:200px;float:left;">
							<img class="card-img-top" src="<?phpecho $row['img']?>" alt="Card Image"/>
							<div class="card-body">
								<p class="card-text"><a href="#?id=<?phpecho $row['username'] ?>" class="stretched-link" style="color:black;"><?php echo $row['username'] ?></a></p>	
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
						$result = mysqli_query($connection, "SELECT * FROM lists where name like '$hold'");
						while($row = $result->fetch_array())
						{?>
						<div class="card text-white bg-dark mb-3"style="min-width:200px;max-width:200px;float:left;">
							<div class="card-body">
								<p><a href="#" class="stretched-link" style="color:black;"><?php echo $row['name']?></a></p>	
								<p>Made By <?php echo $row['userID']?></p>
							</div>
						</div>	
						<?php
						}
						$connection->close();
						?>
					</div>
				</div>
			</div>
  </body>
</html>
