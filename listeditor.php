<?php
include('include/bootstrap.php');
include('include/methods/editorfunctions.php');
$uname = "dbtrain_1095";
$pass = "ldchnm";
$host = "dbtrain.im.uu.se";
$dbname = "dbtrain_1095";
$connect = new mysqli($host, $uname, $pass, $dbname);
$userid=24;
$listid = 6;
$query = "select name from lists where listID = '$listid'";
$check = $connect->query($query);
$res = $check -> fetch_array();
$title = $res['name'];


if(isset($_GET['add']))
{
	$movie = $_GET['id'];
	$result = mysqli_query($connect, "SELECT orderinlist FROM movie_list where listID = '$listid' ORDER BY orderinlist DESC LIMIT 1");
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

?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <link href="css/main.css" rel="stylesheet" type="text/css" />
  <script src="assets/js/editor.js"></script>
  <script src='assets/js/searchbar.js'></script>
  </head>
  <body>

  
<div class="row">
	<div class="col-6">
	<div class="container-fluid">
            <div class="row flex" style="height: calc(90vh - 2px)">
               
                <div class="col-12 red lighten-2">
                    <div class="row">
                        <div class="w-100 p-3 text-white text-center"><?php echo $title?></div>
                    </div>
                    <table id="table" class="table table-striped table-dark table-bordered">
					<thead>
                    <tr>
                    <th style="width:5%; text-align: center;" scope="col">#</th>
                    <th style="width:5%; text-align: center;" scope="col"></th>
                    <th style="width:60%;" scope="col">Title</th>
                    <th style="width:10%; text-align: center;" scope="col">Year</th>
                    <th style="width:10%; text-align: center;" scope="col">Runtime</th>
                    <th style="width:10%; text-align: center;" scope="col">Rating</th>
                    </tr>
					</thead>
                    <tbody>
                        <?php 
	$co = 0;
	$length = returnorder($listid);
	$check = fetchlist($listid);
	
	while($row = $check->fetch_array())//gå igenom alla resultat
	{
	
	$id = $row['movieID'];
	$result = mysqli_query($connect, "SELECT * FROM movie_list where movieID = '$id'");
	$row = mysqli_fetch_array($result);
	$order=$row['orderinlist'];
	
	$query2 = "SELECT rating FROM movies2 WHERE movieID = '$id'";
	$check2 = $connect->query($query2);
		if ($check2 ->num_rows ===0){
			$rating = "0";
		}
		else
		{
		while($rowtwo = $check2->fetch_assoc())
		{	
			$rating = $rowtwo['rating'];
		}
	}
	
	$co = $co + 1;
	$thumbs = "thumbs" . $co;
	$content = file_get_contents("http://www.omdbapi.com/?i=$id&apikey=2c66b43f");
	$arr = json_decode($content);
	?>

		<tr style="line-height: 70px;" id="<?php echo $co ?>" onclick="swapitems(this.id)">
		
		<input type="hidden" id="movie<?php echo $co?>" value="<?php echo $arr->imdbID ?>">
		
		<input type="hidden" id="listid" value="<?php echo $listid?>" name="list">
		<td  id="order<?php echo $co?>" style="text-align: center;" ><?php echo $order ?></td>
		<td><img src="<?php echo $arr-> Poster ?>" style="max-height:9.8vh"/></td>
        <td><?php echo $arr-> Title ?></td>
        <td style="text-align: center;"><?php echo $arr-> Year ?></td>
        <td style="text-align: center;"><?php echo $arr-> Runtime ?></td>
		
		
		<?php
					if($rating == "1"):
					?>
					<td style="text-align: center;"><img src="https://proxy.duckduckgo.com/iu/?u=https%3A%2F%2Fclipartwork.com%2Fwp-content%2Fuploads%2F2017%2F02%2Fclipart-for-thumbs-up.png&f=1" id="<?php echo $thumbs?>" style="height:30px;" onclick="thumbs(<?php echo $co?>)"/></td>
					<?php
					elseif($rating == "2"):
					?>
					<td style="text-align: center;"><img src="https://proxy.duckduckgo.com/iu/?u=https%3A%2F%2Fsignaturesatori.com%2Fwp-content%2Fuploads%2F2017%2F03%2Fthumbs-down.png&f=1" id="<?php echo $thumbs?>" style="height:30px;"onclick="thumbs(<?php echo $co?>)"/></td>
					<?php
					else:
					?>
					<td style="text-align: center;"><img src="https://proxy.duckduckgo.com/iu/?u=https%3A%2F%2Fsignaturesatori.com%2Fwp-content%2Fuploads%2F2017%2F03%2Fthumbs-down.png&f=1" id="<?php echo $thumbs?>" style="height:30px;"onclick="thumbs(<?php echo $co?>)"/></td>
					<?php endif;?>
		
		
		
        </tr>
	<?php
	}
	?>
                    </tbody>
					</table>
                    
                </div>
            </div>
       </div>	
	</div>
</div>
	
</div>
</body>
</html>
