<?php
include 'navbar.php';
$connect = new mysqli('localhost', 'root','','testprojekt');
$listid = $_GET['list'];

$query = "select name from list where listID = '$listid'";
$check = $connect->query($query);
$res = $check -> fetch_array();
$title = $res['name'];

/*
$selectall = "select * from listrelation where listID = '$listid'";
$check = $connect->query($selectall);
$count = 0;
$movieids = array();
$orders = array();
$ratings = array();
while($row = $check->fetch_array())//gå igenom alla resultat
{
	$movieids[] = $row['movieID'];
	$orders[] = $row['orderinlist'];
	$ratings[] = $row['rating'];
	$count = $count + 1;
}*/
if(isset($_GET['swap']))
{
	foreach($_GET['swapitems'] as $value){
		$swaps[] = $value;
	}
	$key1 = $swaps[0];
	$key2 = $swaps[1];
	
	/*$pos1 = array_search($key1,$movieids);
	$pos2 = array_search($key2,$movieids);
	
	$temp = $movieids[$pos1];
	$movieids[$pos1] = $movieids[$pos2];
	$movieids[$pos2] = $temp;
	
	$temp = $ratings[$pos1];
	$ratings[$pos1] = $ratings[$pos2];
	$ratings[$pos2] = $temp;*/
	

	
	$query = "select orderinlist from listrelation where movieID = '$key1' and listID = '$listid'";
	$check = $connect->query($query);
	$o1 = $check -> fetch_array();
	
	$query2 = "select orderinlist from listrelation where movieID = '$key2' and listID = '$listid'";
	$check2 = $connect->query($query2);
	$o2 = $check2 -> fetch_array();
	
	$order1 = $o1['orderinlist'];
	$order2 = $o2['orderinlist'];

	$q = "update listrelation set orderinlist = 0 where orderinlist = $order1";
	$check = $connect->query($q);
	
	$q2 = "update listrelation set orderinlist = $order1 where orderinlist = $order2";
	$check = $connect->query($q2);
	
	$q3 = "update listrelation set orderinlist = $order2 where orderinlist = 0";
	$check = $connect->query($q3);
	header('location:listeditor.php?list=' . $listid);
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="bootstrap.min.js"></script>
  <link href="css/main.css" rel="stylesheet" type="text/css" />
  
  <script>
  
  var limit = 2;
  var counter = 0;
function checkbox(x){
	if(document.getElementById(x).checked == true)
	{
	counter = counter + 1;	
		if(counter > 2)
		{
		document.getElementById(x).checked = false;
		}
	}
	
	if(document.getElementById(x).checked == false)
	{
	counter = counter - 1;	
	}
	
}
function thumbsup(x){
	var element = document.getElementById("down" + x);
	element.style.opacity = "0.3";
	var element2 = document.getElementById("up" + x);
	element2.style.opacity = "1";
  return false;
}

function thumbsdown(x){
	
	var element = document.getElementById("up" + x);
	element.style.opacity = "0.3";
	var element2 = document.getElementById("down" + x);
	element2.style.opacity = "1";
	   
	var x =  "up";
	
	xmlhttp.open("GET", "gethint.php?rating=" + x + "&listID = "++", true);
    xmlhttp.send();
	   
	   
  return false;
}

  </script>
  </head>
  <body>

  
<div class="row">
	<div class="col-1"></div>
	<div class="col-5" style="background-color:#d9d9d9;">
		
	<div class="row">
	<div class="col4"> <h1 style="border-bottom:1px solid black;"><?php echo $title ?></h1></div>
	</div>
	<div class="row">
	<form action="listeditor.php" method="get" name="formedit">
	<input type="submit" value="Swap" name="swap">
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
	$thumbsup = "up" . $co;
	$thumbsdown = "down" . $co;
	$content = file_get_contents("https://www.omdbapi.com/?i=$id&apikey=2c66b43f");
	$arr = json_decode($content);
	?>
		<div class="row">
			<div class="col-2">
				<input type="checkbox" id="<?php echo $co?>" value="<?php echo $arr->imdbID ?>" name="swapitems[]" onchange="checkbox(this.id)">
			</div>
			
			<div class="col-10" style="height:10vh;width:100%;">
				<div class="row">
				
					<div class="col-3" style="height:20vh;">
						<img src="<?php echo $arr-> Poster ?>"  style="max-height:9.8vh;"/>
					</div>
					
					<div class="col-8">
						<h4><?php echo $arr-> Title ?></h4>
						<h5><?php echo $arr-> Year ?></h5>
					</div>
					
					<div class="col-1">
						<img src="https://proxy.duckduckgo.com/iu/?u=https%3A%2F%2Fclipartwork.com%2Fwp-content%2Fuploads%2F2017%2F02%2Fclipart-for-thumbs-up.png&f=1" id="<?php echo $thumbsup?>" style="height:30px;" onclick="thumbsup(<?php echo $co?>)"/>
						<img src="https://proxy.duckduckgo.com/iu/?u=https%3A%2F%2Fsignaturesatori.com%2Fwp-content%2Fuploads%2F2017%2F03%2Fthumbs-down.png&f=1" id="<?php echo $thumbsdown?>" style="height:30px;"onclick="thumbsdown(<?php echo $co?>)"/>
					</div>
				</div>
			</div>	
		</div>	
	<?php
	}
	?>
	<input type="hidden" value="<?php echo $listid?>" name="list">
		
	</form>
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
							?>
							<div class="card" style="min-width:200px;max-width:250px;float:left;min-height:80px;max-height:100px;">
								<div class="row">
									<div class="col">
									<a href="add.php?id=<?php echo $test -> imdbID?>&list=<?php echo 1 ?>&length=<?php echo $length ?>" class="stretched-link" style="color:black;"><?php echo $test->Title . " " . $test->Year ?> </a>
									</div>
									<div class="col">
									<a href="add.php?id=<?php echo $test -> imdbID?>&list=<?php echo 1 ?>&length=<?php echo $length ?>" class="stretched-link" style="color:black;">
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
