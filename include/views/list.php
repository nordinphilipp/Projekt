<html>
    <body>
        <div class="container-fluid">
            <div class="row flex" style="height: calc(90vh - 2px)">
                <div class="col-2 red lighten-1">
                </div>
                <div class="col-8 red lighten-2">
                    <div class="row">
                        <div class="w-100 p-3 text-white text-center"><!-- Hämta in listnamn här! -->En Lista</div>
                    </div>
                    <div class="row">
                        <div class="w-100 p-3 text-white text-center"><!-- Verktygslåda -->test</div>
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
                        <!-- Allt inom detta element ska genereras en gång per film i listan -->
                        <?php
                        //foreach()

                        ?>
                        <tr style="line-height: 70px;">
                            <th style="text-align: center;" scope="row"><!--Plats i listan-->1</th>
                            <td><!-- Poster från API/Placeholder--><img class="miniature" src="https://d1csarkz8obe9u.cloudfront.net/posterpreviews/movie-night-flyer-template-7d7861e3d349b92b655900299d774a11_screen.jpg"></td>
                            <td>EN FILM</td>
                            <td style="text-align: center;"><!-- Årtal från API -->2019</td>
                            <td style="text-align: center;"><!-- Speltid från API -->140 min</td>
                            <td style="text-align: center;"><!-- Sett eller inte från inloggad användare -->Yes</td>
                            <td style="text-align: center;"><!-- Listskaparens omdöme -->TMB_DOWN</td>
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
