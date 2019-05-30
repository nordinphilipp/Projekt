<!DOCTYPE html>
<html>
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
            include 'navbar.php';
			$uname = "dbtrain_1095";
			$pass = "ldchnm";
			$host = "dbtrain.im.uu.se";
			$dbname = "dbtrain_1095";
			$connect = new mysqli($host, $uname, $pass, $dbname);
			$listid = $_GET['listID'];
			$query = "SELECT * from movie_list where listID = '$listid'";
			$check = $connect->query($query);
			$listtitle = "SELECT * from lists where listID = '$listid'";
			$titleresult = $connect ->query($listtitle);
			$res = $titleresult -> fetch_array();
			$title = $res['name'];
			$user = $res['userID'];
			$userr = "SELECT username from users where userID = '$user'";
			$userrr = $connect ->query($userr);
			$resuu = $userrr -> fetch_array();
			$userfinal = $resuu['username'];
			
						
			
        ?>
        <div class="container-fluid">
            <div class="row flex" style="height: calc(90vh - 2px)">
                <div class="col-2 red lighten-1">
                </div>
                <div class="col-8 red lighten-2">
                    <div class="row">
                        <div class="w-100 p-3 text-white text-center"><?php echo $title?> - a list by <?php echo $userfinal ?></div>
                    </div>
                    <table class="table table-striped table-dark table-bordered">
                <thead>
                    <tr>
                    <th style="width:5%; text-align: center;" scope="col">#</th>
                    <th style="width:5%; text-align: center;" scope="col"></th>
                    <th style="width:60%;" scope="col">Title</th>
                    <th style="width:10%; text-align: center;" scope="col">Year</th>
                    <th style="width:10%; text-align: center;" scope="col">Runtime</th>
                    <!--<th style="width:10%; text-align: center;" scope="col">Watched</th>-->
                    <th style="width:10%; text-align: center;" scope="col">Rating</th>
                    </tr>
                </thead>
                    <tbody>
                        <!-- Allt inom detta element ska genereras en gÃ¥ng per film i listan -->
                        <?php
						
						while($row = $check->fetch_array())//gå igenom alla resultat
						{
							$id = $row['movieID'];
							$order = $row['orderinlist'];
							$query2 = "SELECT rating FROM movies1 WHERE movieID = '$id'";
							$check = $connect->query($query2);
						while($row = $check->fetch_assoc())
						{	
							$rating = $row['rating'];
						}
							$content = file_get_contents("http://www.omdbapi.com/?i=$id&apikey=2c66b43f");
							$arr = json_decode($content);
							?>
							<tr style="line-height: 70px;">
                            <th style="text-align: center;" scope="row"><?php echo $order ?></th>
                            <td><!-- Poster frÃ¥n API/Placeholder--><img src="<?php echo $arr-> Poster ?>" style="max-height:9.8vh"/></td>
                            <td><?php echo $arr-> Title ?></td>
                            <td style="text-align: center;"><?php echo $arr-> Year ?></td>
                            <td style="text-align: center;"><?php echo $arr-> Runtime ?></td>
                            <!--<td style="text-align: center;">Yes</td>-->
                             <?php
							if($rating == "0")
							{
							?>
							<td style="text-align: center;"><!-- Listskaparens omdÃ¶me -->Neutral</td>
							<?php
							}
							elseif($rating == "1")
							{
							?>
							<td style="text-align: center;"><!-- Listskaparens omdÃ¶me -->TMB_UP</td>
							<?php
							}
							elseif($rating == "2")
							{
							?>
							<td style="text-align: center;"><!-- Listskaparens omdÃ¶me -->TMB_DOWN</td>
							<?php
							}
							?>
                        </tr>
						<?php
						}
						?>
	
                    </tbody>
            </table>
                    
                </div>
                <div class="col-2 red lighten-1">
                </div>
            </div>
        </div>
    </body>
</html>
