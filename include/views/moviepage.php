<?php
//skulle föreslå att allt som har med databas att göra görs via 'include/methods/db.php' 
//och att anslutningarna till db görs därifrån med 'include/process/connect-process.php'
$movie = $_GET['id'];
$uname = "dbtrain_1095";
$pass = "ldchnm";
$host = "dbtrain.im.uu.se";
$dbname = "dbtrain_1095";
$connect = new mysqli($host, $uname, $pass, $dbname);
if(isset($_SESSION['userID']))
{
	$userid = $_SESSION['userID'];
}
else
{
	$userid = -1;
}
if(isset($_GET['addtolist']))
{
	$movie = $_GET['id'];
	$lists;
	foreach($_GET['checkbox'] as $value){
		$lists[] = $value;
	}
	
	
	
	foreach($lists as $v){
		$result = mysqli_query($connect, "SELECT orderinlist FROM movie_list where listID = '$v' ORDER BY orderinlist DESC LIMIT 1");
		$row = mysqli_fetch_array($result);
		$length=$row['orderinlist'];
		if(!is_numeric($length))
		{
			$length = 0;
		}
		$order = $length + 1;
		$state  = $connect->prepare("INSERT INTO movie_list(listID,movieID,orderinlist) VALUES(?,?,?)");
		$state->bind_param('sss',$v,$movie,$order);
		$state->execute();
		
	}
	
	header('location:moviepage.php?id='.$movie);
	
}
if(isset($_GET['addcomment']))
{
	$content = $_GET['comment'];
	//$time = date("Y-m-d h:i");
	$state  = $connect->prepare("INSERT INTO comments(movieID,comment,userID) VALUES(?,?,?)");
	$state->bind_param('sss',$movie,$content,$userid);
	$state->execute();
	header('location:moviepage.php?id='.$movie);
}
?>

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
  <body>

  <?php   
	$content = file_get_contents("http://www.omdbapi.com/?i=$movie&apikey=2c66b43f");
	$arr = json_decode($content);
  ?>
	<div class="card text-white bg-dark mb-3" style="max-width:1000px;margin:auto;">
		<div class="card-body">
			<div class="row">
				<div class="col"><h4 class="card-title"><?php echo $arr->Title ?></h4></div>
				<div class="col"></div>
				<div class="col">
				<?php if(!empty($_SESSION['userID']))
				{
				?>
					<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal" style="float:right">
						Add To A List
					</button>
		
					<div class="modal" id="myModal">
						<div class="modal-dialog">
							<div class="modal-content">

									<!-- Modal Header -->
									<div class="modal-header">
										<h4 class="modal-title">Add To List</h4>
										<button type="button" class="close" data-dismiss="modal">&times;</button>
									</div>
	
									<!-- Modal body -->
									<div class="modal-body">
										<form action="moviepage.php?id=$id" method="get">
										<?php
				
										$query = "select * from lists where userID = '$userid'";
										$check = $connect->query($query);
										$counter = 0;
										while($row = $check->fetch_array())//gå igenom alla resultat
										{
										$counter = $counter + 1;
										?>
										<div class="custom-control custom-checkbox">
											<input type="hidden" value="<?php echo $id?>" name="id"/>
											<input type="hidden" value="<?php echo $row['listID']?>" name="listid[]"/>
											<input type="checkbox" class="custom-control-input" id="customCheck<?php echo $counter?>" name="checkbox[]" value="<?php echo $row['listID']?>">
											<label class="custom-control-label" for="customCheck<?php echo $counter?>"><p><?php echo $row['name']?></p></label>
										</div><br>
					
										<?php
										}
										?>
										<button type="submit" name="addtolist" class="btn btn-danger">Add</button>
										</form> 
									</div>

									<!-- Modal footer -->
									<div class="modal-footer">
											<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
									</div>

							</div>
						</div>
					</div>	
					<?php
					}
					?>
				</div>
			</div>

			<div class="row">
				<div class="col"><img src="<?php echo $arr->Poster?>" style="width:200px;"/></div>
				<div class="col"><h4 class="card-title">Plot</h4><br><p><?php echo $arr->Plot ?></p></div>
			</div> 

		
			<div class="row">
				<div class="col-3"><p><?php echo $arr->Country ?></p></div>
				<div class="col-3"><h4 class="card-title">Rating</h4><br><p><?php echo $arr->imdbRating ?></p></div>
				<div class="col-3"><h4 class="card-title">Actors</h4><br><p><?php echo $arr->Actors ?></p></div>
				<div class="col-3"><h4 class="card-title">Director</h4><br><p><?php echo $arr->Director ?></p></div>
			</div>
			<div class="row">	
				<div class="col-12">
				<?php if(!empty($_SESSION['userID']))
				{
				?>
					<form action="" method="get">
						<input type="hidden" value="<?php echo $movie?>" name="id">
						<textarea class="form-control"  name="comment" placeholder="Comment..."></textarea>
						<button type="submit" class="btn btn-primary" name="addcomment">Submit</button>
					</form>
					<?php
					}
					?>
				</div>
			</div>
		<?php 
		//hämta email eller användarnamn för att visa istället för id
		$query = "select * from comments where movieID = '$movie' order by timestamp desc";//välj inlägg med nyast först
		$check = $connect->query($query);
		while($row = $check->fetch_array())
		{
		$userid = $row['userID'];
		$query2 = "select * from users where userID = '$userid'";//välj inlägg med nyast först
		$res = $connect->query($query2);
		while($resu = $res->fetch_array())
		{
		?>	
		<div class="row">
			<div class="col-12">
				<div class="media border p-3">
					<img src="<?php echo $resu['img']?>" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;">
					<div class="media-body">
						<h4><?php echo $resu['username']?><?php echo " "?><small><i><?php echo $row['timestamp']?></i></small></h4>
						<p><?php echo $row['comment']?></p>
					</div>
				</div>
			</div>
		</div>
		<?php
		}
		}
		?>

		</div>
	</div>
</body>
</html>
