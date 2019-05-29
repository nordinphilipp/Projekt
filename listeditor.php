<?php
include('include/bootstrap.php');
$connect = new mysqli('localhost', 'root','','testprojekt');
$listid = 1;
$query = "select name from list where listID = '$listid'";
$check = $connect->query($query);
$res = $check -> fetch_array();
$title = $res['name'];

?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.0.min.js"></script>
  <link href="css/main.css" rel="stylesheet" type="text/css" />
  <script src='assets/js/editor.js'></script>
  </head>
  <body>

  
<div class="row">
	<div class="col-1"></div>
	<div class="col-5" style="background-color:#d9d9d9;">
		
	<div class="row">
	<div class="col4"> <h1 style="border-bottom:1px solid black;"><?php echo $title ?></h1></div>
	</div>
	<div class="row">
	<?php 
	$co = 0;
	$result = mysqli_query($connect, "SELECT * FROM listrelation where listID = '$listid' ORDER BY orderinlist DESC LIMIT 1");
	$row = mysqli_fetch_array($result);
	$length=$row['orderinlist'];
	if(!is_numeric($length))
	{
		$length = 0;
	}
	$query = "select * from listrelation where listID = '$listid' order by orderinlist asc";//välj inlägg med nyast först
	$check = $connect->query($query);
	while($row = $check->fetch_array())//gå igenom alla resultat
	{
	$id = $row['movieID'];
	$co = $co + 1;
	$thumbs = "thumbs" . $co;
	$content = file_get_contents("https://www.omdbapi.com/?i=$id&apikey=2c66b43f");
	$arr = json_decode($content);
	?>
		<div class="row" style="width:100%;min-height:100px;padding:20px;">

			<div class="col-1">
			<h2 style="font-size:50px;color:black;"><?php echo $co?></h2>
			</div>
			<div class="col-10" id="<?php echo $co ?>" onclick="swapitems(this.id)" style="height:100%;border-right:1px solid black;">
				<div class="row">
				
					<input type="hidden" id="movie<?php echo $co?>" value="<?php echo $arr->imdbID ?>">
					<input type="hidden" id="listid" value="<?php echo $listid?>" name="list">
					<div class="col-3" style="height:20vh;">
						<img src="<?php echo $arr-> Poster ?>"  id="poster<?phpecho $co?>"style="max-height:9.8vh;"/>
					</div>
					
					<div class="col-8">
						<h4 id="title<?phpecho $co?>"><?php echo $arr-> Title ?></h4>
						<h5 id="year<?phpecho $co?>"><?php echo $arr-> Year ?></h5>
					</div>
				</div>
			</div>	
			<div class="col-1">

					<?php
					if($row['rating'] == "up"):
					?>
						<img src="https://proxy.duckduckgo.com/iu/?u=https%3A%2F%2Fclipartwork.com%2Fwp-content%2Fuploads%2F2017%2F02%2Fclipart-for-thumbs-up.png&f=1" id="<?php echo $thumbs?>" style="height:30px;" onclick="thumbs(<?php echo $co?>)"/>

					
					<?php
					else:?>
						<img src="https://proxy.duckduckgo.com/iu/?u=https%3A%2F%2Fsignaturesatori.com%2Fwp-content%2Fuploads%2F2017%2F03%2Fthumbs-down.png&f=1" id="<?php echo $thumbs?>" style="height:30px;"onclick="thumbs(<?php echo $co?>)"/>
					<?php endif;?>

			</div>
		</div>	
	<?php
	}
	?>

	</div>
	</div>
	<div class="col-1"></div>
	<div class="col-5">
		<div class="row">
			<div class="col-12">
				<form action="" method="GET">
					<div class="input-group mb-3">
						<input type="text" class="form-control" name="title" placeholder="Add To List">
						<div class="input-group-append">
							<input type="submit" class="btn btn-success" name="search" value="Go">
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<?php
				if(isset($_GET['search']))
				{
				?>
				<div class="row" style="padding:10px;">
					<div class="col">
						<?php
						$hold = $_GET['title'];
						$title = str_replace(" ", "+",$hold);
						$content = file_get_contents("https://www.omdbapi.com/?s=$title&type=movie&apikey=2c66b43f");
						$arr = json_decode($content);
						$count = 0;
						
						if($arr -> Response == "False" )
						{
						?>
							<div class="card">
								<h1 class="card-title">Nothing Found</h1>
							</div>			
						<?php
						}
						else
						{	
						?>
							<div class="card-deck">
							<?php
							foreach($arr -> Search as $test)
							{
								$count = $count + 1;
							?>
							<div class="card" style="min-width:200px;max-width:250px;float:left;min-height:80px;max-height:100px;">
								<div class="row">
									<div class="col">
									<a href="" class="stretched-link" style="color:black;"><?php echo $test->Title . " " . $test->Year ?> </a>
									</div>
									<div class="col">
									<a href="" class="stretched-link" style="color:black;">
									<img src="https://proxy.duckduckgo.com/iu/?u=http%3A%2F%2Fpngimg.com%2Fuploads%2Fplus%2Fplus_PNG26.png&f=1" style="height:50px;float:right;"/></a>
									</div>
								</div>
							</div>
							<?php
							}
							?>
							</div>
						<?php
						}
						?>
					</div>
				</div>
				<?php
				}
				?>
			</div>
		</div>
	</div>
</div>
</body>
</html>
