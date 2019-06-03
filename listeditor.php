<?php
include('include/bootstrap.php');
include('include/methods/editorfunctions.php');

//skulle föreslå att allt som har med databas att göra görs via 'include/methods/db.php' 
//och att anslutningarna till db görs därifrån med 'include/process/connect-process.php'
$uname = "dbtrain_1095";
$pass = "ldchnm";
$host = "dbtrain.im.uu.se";
$dbname = "dbtrain_1095";
$connect = new mysqli('localhost', 'root','', 'testprojekt');
$userid=24;
$listid = 6;
/*$query = "select name from lists where listID = '$listid'";
$check = $connect->query($query);
$res = $check -> fetch_array();
$title = $res['name'];*/
$name = "Test";
$user = "User";

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
		<div class="row">
            <div class="w-100 p-3 text-white text-center" id="listtitle"><?php echo $name ?> </div>
        </div>
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal body -->
      <div class="modal-body">
        <form class="form-inline" onsubmit="changetitle()" method="GET" id="search_form">
				<input type="text" class="form-control" name="newtitle" value="<?php echo $name?>">
					<div class="input-group-append">
						<input type="submit" class="btn btn-success" name="search" value="Go">
					</div>
		
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
                <div class="col-12">
				<div class="row">
                        <div class="w-100 p-3 text-white text-center"><button type="button" class="btn btn-dark" data-toggle="modal" data-target="#myModal">
				Change Title
			</button></div>
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

					<tr style="line-height: 70px;cursor:pointer;" id="<?php echo $co ?>" onclick="swapitems(this.id)">
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

	<div class="col-6">
		<form class="form-inline" action="" method="GET" id="search_form">
               <i class="fas fa-search" aria-hidden="true"></i>
               <input class="form-control form-control-sm ml-3 w-75" name="title" type="text" placeholder="Search"
                   aria-label="Search">
		</form>
		<?php
				if(isset($_GET['title']))
				{
				?>
				
				<div class="col-12" style="margin-top:40px;">
                    <div class="row">
                        <div class="w-100 p-3 text-white text-center">Add To List</div>
                    </div>
                    <table id="table" class="table table-striped table-dark table-bordered">
					<thead>
                    <tr>

                    <th style="width:5%; text-align: center;" scope="col"></th>
                    <th style="width:60%;" scope="col">Title</th>
                    <th style="width:10%; text-align: center;" scope="col">Year</th>
                    <th style="width:10%; text-align: center;" scope="col"></th>
                    </tr>
					</thead>
                    <tbody>

						<?php
						$hold = $_GET['title'];
						$title = str_replace(" ", "+",$hold);
						$content = file_get_contents("http://www.omdbapi.com/?s=$title&apikey=2c66b43f");
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
							<?php
							foreach($arr -> Search as $test)
							{
							?>
							
							<tr style="line-height: 70px;cursor:pointer;" id="<?php echo $test->imdbID ?>" onclick="add(this.id)">
							<td><img src="<?php echo $test-> Poster ?>" style="max-height:9.8vh"/></td>
							<td><?php echo $test-> Title ?></td>
							<td style="text-align: center;"><?php echo $test-> Year ?></td>
							<td style="text-align: center;"><img src="https://proxy.duckduckgo.com/iu/?u=http%3A%2F%2Fpngimg.com%2Fuploads%2Fplus%2Fplus_PNG26.png&f=1" style="height:50px;float:right;"/></td>
							<?php
							}
						}
						?>
					</div>
				<?php
				}
				?>
	</div>
</div>

	
</div>
</body>
</html>
