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
			$uname = "dbtrain_1095";
			$pass = "ldchnm";
			$host = "dbtrain.im.uu.se";
			$dbname = "dbtrain_1095";
			$connect = new mysqli($host, $uname, $pass, $dbname);
			$userID = $_GET['userID'];
			
			$recentlists = "SELECT listID from lists where userID = '$userID' ORDER BY listID LIMIT 3";
			$recentliststwo = $connect ->query($recentlists);
			$result = $recentliststwo -> fetch_array();
			$recentlistresult = $result['listID'];
			
			$userr = "SELECT username from users where userID = '$userID'";
			$userrr = $connect ->query($userr);
			$resuu = $userrr -> fetch_array();
			$userfinal = $resuu['username'];
			
			$listnames = "SELECT name from lists where listID ='$recentlistresult'";
			$listnameres = $connect -> query($listnames);
			$resultz = $listnameres -> fetch_array();
			$listnameresult = $resultz['name'];
			
        ?>
        <div class="container-fluid">
            <div class="row flex" style="height: calc(90vh - 2px)">
                <div class="col-2 red lighten-1">
                    <div class="row">
                        <div class="w-100 p-3 red darken-3 white-text text-center"><b>Popular</b></div>
                    </div>
                </div>
                <div class="col-8 red lighten-1">
                    <div class="row">
                        <div class="w-100 p-3 red darken-3 white-text text-center"><b><?php echo $userfinal?>'s Profile</b></div>
                    </div>
                    <br>
                    <div class="container-fluid white-text" style="border:0px;">
                        <div class="row" style="height: 100%;">
                            <div class="col">
                                <img src="assets/img/anonymous_user.png" alt="" class="img-thumbnail" style="height:50%;">
                            </div>
                            <div class="col">
                            </div>
                            <div class="col-sm-3" style="margin-right: 10px;">
                                <ul class="list-group black-text">
                                    <li class="list-group-item row d-flex align-items-center">
                                        <div class="col-md-12 text-center">Recently Watched</div>
                                    </li>
									<?php
						$recentmovies = "SELECT * from movies2 where userID = '$userID' ORDER BY lastWatched DESC LIMIT 5";
						$recentmoviestwo = $connect ->query($recentmovies);
						
							
						while($row = $recentmoviestwo->fetch_array())//gå igenom alla resultat
						{
							$movieID = $row['movieID'];
							$rating = $row['rating'];
							$content = file_get_contents("http://www.omdbapi.com/?i=$movieID&apikey=2c66b43f");
							$arr = json_decode($content);
							?>
                                    <li class="list-group-item row d-flex align-items-center">
                                        <div class="col-md-10 d-flex"><?php echo $arr -> Title?></div>
                                        <div class="col-md-2 d-flex"><img src="img/thumbsup.png" alt="..." class="img"></div>
                                    </li>
									<?php
									}
									?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class=col-12>
                    Recent Lists<span style="float: right">View All</span>
					
                    <div class=row d-flex align-items-center style="padding-top: 10px;">
					<?php
						$recentlists = "SELECT * from lists where userID = '$userID' ORDER BY listID LIMIT 3";
						$recentliststwo = $connect ->query($recentlists);
			
						while($row = $recentliststwo->fetch_array())//gå igenom alla resultat
						{
							$listnameloop = $row['name'];
							$idloop = $row['listID'];
							$link = "list.php?listID=$idloop";
							?>
                    <div class=col-12 d-flex style="border: 1px solid black; background-color: gray; height: 11vh;"><?php echo $listnameloop?><span style="float: right"><a href="<?php echo $link?>">View</a></span></div>
						<?php
						}
						?>
                    </div>
                <div class="col-2 red lighten-1">
                    <div class="row">
                        <div class="w-100 p-3 red darken-3 white-text text-center"><b>Friend Feed</b></div>

                    </div>
                </div>
				</div>
            </div>
        </div>
        <!-- Footer -->
        <div class="col-12 red darken-3" style="height: 3vh"></div>
    </div>
    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
</body>

</html>
