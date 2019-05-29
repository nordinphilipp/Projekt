<?php 
if(!empty($_SESSION['logged_in'])){
    ?> 
    <html>
        <body>
            <div class="container-fluid">
                <div class="row flex" style="height: calc(90vh - 2px)">
                    <div class="col-2 red lighten-1">
                        <div class="row">
                            <div class="w-100 p-3 red darken-3 white-text text-center"><b>Popular</b></div>
                        </div>
                    </div>
                    <div class="col-8 red lighten-1">
                        <div class="row">
                            <div class="w-100 p-3 red darken-3 white-text text-center"><b><?=$_SESSION['username']?></b></div>
                        </div>
                        <br>
                        <div class="container-fluid white-text" style="border:0px;">
                            <div class="row" style="height: 100%;">
                                <div class="col">
                                    <img src=<?= $img ?> alt="Profile picture" class="img-thumbnail" style="height:50%;">
                                    
                                    <form action="upload_process.php" method="POST" enctype="multipart/form-data">
                                        <label for="uploadFile">Byt profilbild</label><br>
                                        <input type="file" name="uploadFile" id="uploadFile"><br>
                                        <input type="submit" value="ladda upp" name="submit">
                                    </form>
                                
                                </div>
                                <div class="col">
                                </div>
                                <div class="col-sm-3" style="margin-right: 10px;">
                                    <ul class="list-group black-text movie_list">
                                        <li class="list-group-item row d-flex align-items-center">
                                            <div class="col-md-12 text-center">Recently Watched</div>
                                        </li>
                                        <li class="list-group-item row d-flex align-items-center">
                                            <div class="col-md-10 d-flex">1. Avatar</div>
                                            <div class="col-md-2 d-flex"><img src="img/thumbsup.png" alt="..." class="img"></div>
                                        </li>
                                        <li class="list-group-item row d-flex align-items-center">
                                            <div class="col-md-10 d-flex">1. Avatar</div>
                                            <div class="col-md-2 d-flex"><img src="img/thumbsup.png" alt="..." class="img"></div>
                                        </li>
                                        <li class="list-group-item row d-flex align-items-center">
                                            <div class="col-md-10 d-flex">1. Avatar</div>
                                            <div class="col-md-2 d-flex"><img src="img/thumbsup.png" alt="..." class="img"></div>
                                        </li>
                                        <li class="list-group-item row d-flex align-items-center">
                                            <div class="col-md-10 d-flex">1. Avatar</div>
                                            <div class="col-md-2 d-flex"><img src="img/thumbsup.png" alt="..." class="img"></div>
                                        </li>
                                        <li class="list-group-item row d-flex align-items-center">
                                            <div class="col-md-10 d-flex">1. Avatar</div>
                                            <div class="col-md-2 d-flex"><img src="img/thumbsup.png" alt="..." class="img"></div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class=col-12>
                            Recent Lists<span style="float: right">View All</span>
                            <div class=row d-flex align-items-center style="padding-top: 10px;">
                                <div class=col-12 d-flex style="border: 1px solid black; background-color: gray; height: 11vh;">1. Halloween 2019<span style="float: right">View</span></div>
                            </div>
                            <div class=row>
                                <div class=col-12 d-flex style="border: 1px solid black; background-color: gray; height: 11vh;">2. Bakisfilmer<span style="float: right">View</span></div>
                            </div>
                            <div class=row>
                                <div class=col-12 d-flex style="border: 1px solid black; background-color: gray; height: 11vh;">3. Favoritdokumentärer<span style="float: right">View</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2 red lighten-1">
                        <div class="row">
                            <div class="w-100 p-3 red darken-3 white-text text-center"><b>Friend Feed</b></div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
    </html>
<?php }else{
    echo 'Du måste logga in för att se din användarprofil';
    header('Location: login.php');
} ?>