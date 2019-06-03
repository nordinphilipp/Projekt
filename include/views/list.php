<?php
		$userID = $_GET['userID'];
		$userinfo = fetchUserInfo($userID);
?>   

   <html>
        <body>
            <div class="container-fluid">
                <div class="row flex" style="height: calc(90vh - 2px)">
                    <div class="col-2">
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <div class="w-100 p-3 red darken-3 white-text text-center"><b><?=$userinfo['username']?>'s Profile</b></div>
                        </div>
                        <br>
                        <div class="container-fluid white-text" style="border:0px;">
                            <div class="row" style="height: 100%;">
                                <div class="col">
                                    <img src=<?= $userinfo['img'] ?> alt="Profile picture" class="img-thumbnail" style="height:50%; max-height: 200px; max-width: 200px;">
                                    
                                    <form action="upload_process.php" method="POST" enctype="multipart/form-data">
                                        <label for="uploadFile">Byt profilbild</label><br>
                                        <input type="file" name="uploadFile" id="uploadFile"><br>
                                        <input type="submit" value="ladda upp" name="submit">
                                    </form>
                                
                                </div>
                                <div class="col">
                                </div>
                                <div class="col-sm-3" style="margin-right: 10px;">
                                    <ul class="list-group white-text movie_list">
                                        <li class="list-group-item row d-flex align-items-center bg-dark">
                                            <div class="col-md-12 text-center">Recently Watched</div>
                                        </li>
                                      <?php
						$recentmoviestwo = fetchRecentlyWatched($userID);
					
						
						while($row = $recentmoviestwo->fetch_array())//gå igenom alla resultat
						{
							$movieID = $row['movieID'];
							$rating = $row['rating'];
							$content = file_get_contents("http://www.omdbapi.com/?i=$movieID&apikey=2c66b43f");
							$arr = json_decode($content);
							?>
                                    <li class="list-group-item row d-flex align-items-center bg-dark">
                                        <div class="col-md-10 d-flex"><?php echo $arr -> Title?></div>
										<?php
										if($rating == "1"):
										?>
										<div class="col-md-2 d-flex"><img src="assets/img/ratings/thumbs_up.png" alt="..." class="img" style="max-height: 30px; max-width: 30px;"></div>
										<?php
										elseif($rating == "2"):
										?>
										<div class="col-md-2 d-flex"><img src="assets/img/ratings/thumbs_down.png" alt="..." class="img" style="max-height: 30px; max-width: 30px;"></div>
										<?php
										else:
										?>
										<div class="col-md-2 d-flex"><img src="assets/img/ratings/no_vote.png" alt="..." class="img" style="max-height: 30px; max-width: 30px;"></div>
										<?php endif;?>
										<?php
										}
										?>
                            
                                    </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class=col-12>
                            Recent Lists<span style="float: right">View All</span>
                            <div class=row d-flex align-items-center style="padding-top: 10px; line-height: 60px;">
                               <?php
						$recentlists = fetchRecentLists($userID);
						
						while($row = $recentlists->fetch_array())//gå igenom alla resultat
						{
							$listnameloop = $row['name'];
							$idloop = $row['listID'];
							$link = "list.php?listID=$idloop";
							?>
                    <div class=col-12 d-flex style="border: 1px solid black; background-color: #333; height: 60px; color: white;"><?php echo $listnameloop?><span style="float: right"><a href="<?php echo $link?>">View</a></span></div>
						<?php
						}
						?>
                    
                </div>
            </div>
        </body>
    </html>
