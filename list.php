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
            // Variabler fÃ¶r API
            // $content = file_get_contents("https://www.omdbapi.com/?i=$id&apikey=2c66b43f");
            // $arr = json_decode($content);
        ?>
        <div class="container-fluid">
            <div class="row flex" style="height: calc(90vh - 2px)">
                <div class="col-2 red lighten-1">
                </div>
                <div class="col-8 red lighten-2">
                    <div class="row">
                        <div class="w-100 p-3 text-white text-center"><!-- HÃ¤mta in listnamn hÃ¤r! -->En Lista</div>
                    </div>
                    <table class="table table-striped table-dark table-bordered">
                <thead>
                    <tr>
                    <th style="width:5%; text-align: center;" scope="col">#</th>
                    <th style="width:5%; text-align: center;" scope="col"></th>
                    <th style="width:50%;" scope="col">Title</th>
                    <th style="width:10%; text-align: center;" scope="col">Year</th>
                    <th style="width:10%; text-align: center;" scope="col">Runtime</th>
                    <th style="width:10%; text-align: center;" scope="col">Watched</th>
                    <th style="width:10%; text-align: center;" scope="col">Rating</th>
                    </tr>
                </thead>
                    <tbody>
                        <!-- Allt inom detta element ska genereras en gÃ¥ng per film i listan -->
                        <?php
						$uname = "dbtrain_1095";
						$pass = "ldchnm";
						$host = "dbtrain.im.uu.se";
						$dbname = "dbtrain_1095";
						$connect = new mysqli($host, $uname, $pass, $dbname);
						//$listid = $_GET['listID'];
						$listid = 6;
						$query = "SELECT * from movie_list where listID = '$listid'";
						$check = $connect->query($query);
						
						while($row = $check->fetch_array())//gå igenom alla resultat
						{
							$movieID = $row['movieID'];
							$content = file_get_contents("http://www.omdbapi.com/?i=tt6966692&apikey=2c66b43f");
							$arr = json_decode($content);
						}
						$query2 = "SELECT * FROM movies WHERE movieID = '$movieID'";
						$check = $connect->query($query2);
						while($row = $check->fetch_assoc())
						{	
							$rating = $row['rating'];
						}
                        //foreach()
	?>
	
		<div class="row" style="width:100%;min-height:100px;padding:20px;">

			<div class="col-10" id="" style="height:100%;border-right:1px solid black;">
				<div class="row">
				
					<input type="hidden" id="movie" value="<?php echo $arr->imdbID ?>">
					<input type="hidden" id="listid" value="<?php echo $listid?>" name="list">
					<div class="col-3" style="height:20vh;">
						<img src="<?php echo $arr-> Poster ?>"  id="poster"style="max-height:9.8vh"/>
					</div>
					
					<div class="col-8">
						<h4 id="title"><?php echo $arr-> Title ?></h4>
						<h5 id="year"><?php echo $arr-> Year ?></h5>
					</div>
				</div>
			</div>	
                        <tr style="line-height: 70px;">
                            <th style="text-align: center;" scope="row"><!--Plats i listan-->1</th>
                            <td><!-- Poster frÃ¥n API/Placeholder--><img class="miniature" src="https://d1csarkz8obe9u.cloudfront.net/posterpreviews/movie-night-flyer-template-7d7861e3d349b92b655900299d774a11_screen.jpg"></td>
                            <td>EN FILM</td>
                            <td style="text-align: center;"><!-- Ã…rtal frÃ¥n API -->2019</td>
                            <td style="text-align: center;"><!-- Speltid frÃ¥n API -->140 min</td>
                            <td style="text-align: center;"><!-- Sett eller inte frÃ¥n inloggad anvÃ¤ndare -->Yes</td>
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
                    </tbody>
            </table>
                    </div>
                </div>
                <div class="col-2 red lighten-1">
                </div>
            </div>
        </div>
    </div>
    </body>
</html>
