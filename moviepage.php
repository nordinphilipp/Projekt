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
	<link href="navbar.css" rel="stylesheet" type="text/css" />

  </head>
  <body>
  
	<?php 
	include('navbar.php');
	$id = $_GET['id'];
	$content = file_get_contents("https://www.omdbapi.com/?i=$id&apikey=2c66b43f");
	$arr = json_decode($content);
  
  ?>
	<div class="card" style="max-width:1000px;margin:auto;background-color:#d9d9d9;">
	<div class="card-body">
		<div class="row">
		<div class="col"><h4 class="card-title"><?php echo $arr->Title ?></h4></div>
				<div class="col"></div>
		<div class="col"><a href="#" class="btn btn-dark" style="float:right;" >Add To List</a></div>
		</div>
		
		<div class="row">
		<div class="col"><img src="<?php echo $arr->Poster?>" style="width:200px;"/></div>
		<div class="col"><h4 class="card-title">Plot</h4><br><p><?php echo $arr->Plot ?></p></div>
		</div> 
	
		<div class="row">
		<div class="col"><p class="card-text"><?php echo $arr->Country ?></p></div>
		<div class="col"><h4 class="card-title">Rating</h4><br><p class="card-text"><?php echo $arr->imdbRating ?></p></div>
		<div class="col"><h4 class="card-title">Actors</h4><br><p class="card-text"><?php echo $arr->Actors ?></p></div>
		<div class="col"><h4 class="card-title">Director</h4><br><p class="card-text"><?php echo $arr->Director ?></p></div>
		</div>
	
		
		
		<div class="row">	
			<div class="form-group">
				<label for="comment">Comment:</label>
				<textarea class="form-control"  id="comment" placeholder="insert to database"></textarea>
			</div>
		
		</div>

		<div class="row">
			<div class="col-12">
			<div class="media border p-3">
				<img src="<?php echo $arr->Poster?>" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;">
				<div class="media-body">
					<h4>Username<small><i>Posted on February 19, 2016</i></small></h4>
					<p>Comment</p>
				</div>
			</div>
			
			
			
			
			</div>
		</div>
		
	</div>
</div>
</body>
</html>