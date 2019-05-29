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
        <div class="container">
            <table>
                <tr>
                    <td><img class="miniature" src="https://d1csarkz8obe9u.cloudfront.net/posterpreviews/movie-night-flyer-template-7d7861e3d349b92b655900299d774a11_screen.jpg"></td>
                    <td><a href="#">movietitle</a></td>
                    <td><a >rating</a></td>
                                            <!-- Allt inom detta element ska genereras en gÃ¥ng per film i listan -->
                        <?php
						$uname = "dbtrain_951";
						$pass = "pqwkjl";
						$host = "dbtrain.im.uu.se";
						$dbname = "dbtrain_951";
						$connect = new mysqli($host, $uname, $pass, $dbname);
						$listid = $_GET['listID'];

						$query = "SELECT * from movie_list where listID = '$listid'";
						$check = $connect->query($query);
						$result = $check -> fetch_array();		//Behövs det en loop för att plocka ut alla movieID's här?
						$movieID = $result['movieID'];			//Kan jag plocka ut all information om filmerna med IMDB API:t eller måste jag ta jämföra movieID med movieID i table movies 
						echo $movieID;
						//Hämta information här någonstans om namnet på filmerna, samt annat som behövs från IMDB API?
						
						
						//Rating för filmerna nedan.
						$query2 = "SELECT tumbsUP FROM movies WHERE movieID = '$movieID'";
						$check = $connect->query($query2);
						$result = $check -> fetch_array();
						$tumbsUP = $result['tumbsUP'];
                        //foreach()

                        ?>
                </tr>
            </table>
        </div>
    </body>
</html>
